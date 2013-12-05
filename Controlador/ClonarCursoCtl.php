<?php

class ClonarCursoCtl {
	private $modelo;

	private function guardarCambios() {
		$nrc = trim( $_POST['nrc'] );
		$curso = $_POST['curso'];
		$seccion = trim( $_POST['seccion'] );
		$ciclo = $_POST['ciclo'];
		$dia = $_POST['dia'];
		$horas_dia = $_POST['horas_dia'];
		$hora_inicio = $_POST['hora_inicio'];
		$asignatura = $_POST['asignatura'];

		$existente = $this -> modelo -> obtenerDatosCurso( $nrc );
		if( is_array( $existente ) ) {
			$msj_error = "Ya existe un curso activo con la misma clave.";
			$vista = file_get_contents( "Vista/Error.html" );
			$vista = str_replace( "{ERROR}", $msj_error, $vista );
			echo $vista;
		}
		else {
			$this -> modelo -> agregarCurso( $nrc, $asignatura, $seccion, $ciclo, $_SESSION['codigo_usuario'], $curso );
			array_shift( $dia );
			array_shift( $horas_dia );
			array_shift( $hora_inicio );
			for( $i = 0; $i < count( $dia ); ++$i ){
				$array = explode( ":", $hora_inicio[$i] );
				$array[0] = $array[0] + $horas_dia[$i];
				$hora_fin = implode( ":", $array );
				$this -> modelo -> agregarDiaClase( $nrc, $dia[$i], $hora_inicio[$i], $hora_fin );
			}
			$rubros = $this -> modelo -> obtenerRubros( $_SESSION['clave_curso'] );
			if( is_array( $rubros ) ) {
				for( $i = 0; $i < count( $rubros ); ++$i ) {
					$id = $this -> modelo -> agergarRubro( $nrc, $rubros[$i]['nombre'], $rubros[$i]['valor'], 
			        										$rubros[$i]['tieneColumnasEx'], $rubros[$i]['cantidad_columnas'] ); 
					$columnas = $this -> modelo -> obtenerColumnas( $rubros[$i]['idRubro'] );
					for( $j = 0; $j < count( $columnas ); ++$j )
						$this -> modelo -> agregarColumna( $id, $columnas[$j]['nombre'] );
				}	
			}
			header( "Location: index.php?ctl=profesor&act=cursos" );
		}
	}

	public function ejecutar() {
		require_once( "Modelo/ClonarCursoMdl.php" );
		$this -> modelo = new ClonarCursoMdl();

		switch ( $_GET['act'] ) {
			case 'mostar_datos':
				$_SESSION['clave_curso'] = $_POST['clave_curso'];

				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/ClonarCurso.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
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
				$this -> guardarCambios();
				break;
			default:
				$msj_error = "Acción inválida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}
	}
}