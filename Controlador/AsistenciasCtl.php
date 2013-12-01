<?php

class AsistenciasCtl {
	private $modelo;

	private function esFechaValida( $inicio, $fin, $fecha ) {
		$inicio_time = strtotime( $inicio );
		$fin_time = strtotime( $fin );
		$fecha_time = strtotime( $fecha );

		if( $inicio_time <= $fecha_time && $fecha_time <= $fin_time )
			return true;
		return false;
	}

	private function valorDia( $dia ) {
		switch( $dia ) {
			case "Lunes":
				return 1;
			case "Martes":
				return 2;
			case "Miércoles":
				return 3;
			case "Jueves":
				return 4;
			case "Viernes":
				return 5;
			case "Sábado":
				return 6;
		}
	}

	private function proximaFecha( $fecha, $buscada ) {
		$fechatime = strtotime( $fecha );
		while( date( "N", $fechatime ) != $this -> valorDia( $buscada ) ) {
			$fechatime += 86400;//24hrs
		}
		return $fechatime;
	}

	private function diasClaseToTime( $fecha, $dias_clase ) {
		$time_array = array();
		for( $it = 0; $it < count( $dias_clase ); ++$it )
			$time_array[] = $this -> proximaFecha( $fecha, $dias_clase[$it]['dia'] );
		sort( $time_array );
		return $time_array;
	}

	private function calcularDiasHabiles( $fin_ciclo, $dias_inhabiles, $dias_clase, $fecha ) {
		$dias_clase_t = $this -> diasClaseToTime( $fecha, $dias_clase );
		$dias_habiles = 0;
		$contador = 0;
		$bandera = false;
		while( $dias_clase_t[$contador] < strtotime( $fin_ciclo ) ) {
			if( is_array( $dias_inhabiles ) ) {
				for( $it = 0; $it < count( $dias_inhabiles ); ++$it ) {
					if( date( 'Y-m-d', $dias_clase_t[$contador] ) == $dias_inhabiles[$it]['fecha'] )
						$bandera = true;
				}
			}
			if( !$bandera )
				++$dias_habiles;
			$bandera = false;
			$dias_clase_t[$contador] += 604800; //7 días
			if( ++$contador >= count( $dias_clase_t ) )
				$contador = 0;
		}
		return $dias_habiles;
	}

	private function generarIntervaloClases( $fin_ciclo, $dias_inhabiles, $dias_clase, $fecha ) {
		$intervalo_clases = array();
		$dias_clase_t = $this -> diasClaseToTime( $fecha, $dias_clase );
		$contador = 0;
		$bandera = false;
		while( count( $intervalo_clases ) < 6 ) {
			if( $dias_clase_t[$contador] > strtotime( $fin_ciclo ) )
				break;

			if( is_array( $dias_inhabiles ) ) {
				for( $it = 0; $it < count( $dias_inhabiles ); ++$it ) {
					if( date( 'Y-m-d', $dias_clase_t[$contador] ) == $dias_inhabiles[$it]['fecha'] )
						$bandera = true;
				}
			}
			if( !$bandera )
				$intervalo_clases[] = date( 'Y-m-d', $dias_clase_t[$contador] );
			$bandera = false;
			$dias_clase_t[$contador] += 604800; //7 días
			if( ++$contador >= count( $dias_clase_t ) )
				$contador = 0;
		}
		return $intervalo_clases;
	}

	function ejecutar() {
		require_once( "Modelo/AsistenciasMdl.php" );
		$this -> modelo = new AsistenciasMdl();

		switch ( $_GET['act'] ) {
			case "mostrar_datos":
				$ciclo = $this -> modelo -> obtenerCicloCurso( $_SESSION['clave_curso'] );
				$dias_inhabiles = $this -> modelo -> obtenerDiasInhabiles( $ciclo[0]['idCicloEscolar'] );
				$dias_clase = $this -> modelo -> obtenerDiasClase( $_SESSION['clave_curso'] );
				$dias_habiles = $this -> calcularDiasHabiles( $ciclo[0]['fin'], $dias_inhabiles, $dias_clase, $ciclo[0]['inicio'] );
				$_SESSION['dias_habiles'] = $dias_habiles;
				require_once( "Vista/Asistencias.html" );
				break;
			case "carga_alumnos":
				$lista_alumnos = $this -> modelo -> obtenerAlumnos( $_SESSION['clave_curso'] );
				echo json_encode( $lista_alumnos );
				break;
			case "obtener_fechas":
				$ciclo = $this -> modelo -> obtenerCicloCurso( $_SESSION['clave_curso'] );
				$dias_inhabiles = $this -> modelo -> obtenerDiasInhabiles( $ciclo[0]['idCicloEscolar'] );
				$dias_clase = $this -> modelo -> obtenerDiasClase( $_SESSION['clave_curso'] );
				$fecha = $_POST['fecha'];
				if( $this -> esFechaValida( $ciclo[0]['inicio'], $ciclo[0]['fin'], $fecha ) ) {
					$intervalo_clases = $this -> generarIntervaloClases( $ciclo[0]['fin'], $dias_inhabiles, $dias_clase, $fecha );
					echo json_encode( $intervalo_clases );
				}
				else
					echo false;				
				break;
			case "obtener_asistencias":
				$fechas = $_POST['fechas'];
				$alumnos = $_POST['alumnos'];
				$asistencias_alumnos = array();
				for( $it = 0; $it < count( $alumnos ); ++$it ) {
					$asistencias_alumnos[] = $this -> modelo -> obtenerAsistenciasIntervalo( $alumnos[$it], $_SESSION['clave_curso'], $fechas[0], end( $fechas ) );
				}
				echo json_encode( $asistencias_alumnos );
				break;
			case "marcar_asistencia":
				$fecha = $_POST['fecha'];
				$alumno = $_POST['alumno'];
				$asistencia = $this -> modelo -> obtenerAsistencia( $alumno, $_SESSION['clave_curso'], $fecha );
				if( is_array( $asistencia ) )
					$this -> modelo -> actualizarAsistencia( $alumno, $_SESSION['clave_curso'], $fecha );
				else 
					$this -> modelo -> marcarAsistencia( $alumno, $_SESSION['clave_curso'], $fecha );
				$asistencias = $this -> modelo -> obtenerCantidadAsistencias( $alumno, $_SESSION['clave_curso'] );
				$promedio_asistencias = (100 / $_SESSION['dias_habiles']) * $asistencias; 
				$this -> modelo -> actualizarPromedioAsistencias( $alumno, $_SESSION['clave_curso'], $promedio_asistencias );
				echo json_encode( array( $_POST['fila'],  $promedio_asistencias ) );
				break;
			case "marcar_falta":
				$resultado = array();
				$fecha = $_POST['fecha'];
				$alumno = $_POST['alumno'];
				$resultado[] = $_POST['fila'];
				$asistencia = $this -> modelo -> obtenerAsistencia( $alumno, $_SESSION['clave_curso'], $fecha );
				if( is_array( $asistencia ) )
					$this -> modelo -> actualizarFalta( $alumno, $_SESSION['clave_curso'], $fecha );
				else 
					$this -> modelo -> marcarFalta( $alumno, $_SESSION['clave_curso'], $fecha );
				$asistencias = $this -> modelo -> obtenerCantidadAsistencias( $alumno, $_SESSION['clave_curso'] );
				$promedio_asistencias = (100 / $_SESSION['dias_habiles']) * $asistencias; 
				$this -> modelo -> actualizarPromedioAsistencias( $alumno, $_SESSION['clave_curso'], $promedio_asistencias );
				$resultado[] = $promedio_asistencias;
				echo json_encode( $resultado );
				break;
			default:
				$msj_error = "Acción invalida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}
	}
}