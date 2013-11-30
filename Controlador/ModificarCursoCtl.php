<?php

class ModificarCursoCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ModificarCursoMdl.php" );
		$this -> modelo = new ModificarCursoMdl();

		switch ( $_GET['act'] ) {
			case 'mostar_datos':
				$_SESSION['clave_curso'] = $_POST['clave_curso'];
				require_once( "Vista/ModificarCurso.html" );
				break;
			case 'cargar_datos':
				$clave = $_SESSION['clave_curso'];
				$resultado = $this -> modelo -> obtenerDatosCurso( $clave );
				echo json_encode( $resultado );
				break;
			case 'cargar_asignatura':
				$idAsignatura = $_POST['asignatura'];
				$resultado = $this -> modelo -> obtenerDatosAsignatura( $idAsignatura );
				echo json_encode( $resultado );
				break;
			case 'cargar_dias_clase':
				$clave = $_SESSION['clave_curso'];
				$resultado = $this -> modelo -> obtenerDiasClase( $clave );
				echo json_encode( $resultado );
				break;
			case 'guardar_cambios':
				$clave = $_SESSION['clave_curso'];
				$this -> modelo -> eliminarDiasClase( $clave );

				$curso = $_POST['curso'];
				$seccion = trim( $_POST['seccion'] );
				$ciclo = $_POST['ciclo'];
				$dia = $_POST['dia'];
				$horas_dia = $_POST['horas_dia'];
				$hora_inicio = $_POST['hora_inicio'];
				$asignatura = $_POST['asignatura'];

				$this -> modelo -> actualizarCurso( $clave, $asignatura, $seccion, $ciclo, "424242", $curso );
				array_shift( $dia );
				array_shift( $horas_dia );
				array_shift( $hora_inicio );
				for( $i = 0; $i < count( $dia ); ++$i ){
					$array = explode( ":", $hora_inicio[$i] );
					$array[0] = $array[0] + $horas_dia[$i];
					$hora_fin = implode( ":", $array );
					$this -> modelo -> agregarDiaClase( $clave, $dia[$i], $hora_inicio[$i], $hora_fin );
				}
				header( "Location: index.php?ctl=profesor&act=cursos" );
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