<?php

class RegistroCursoCtl {
	private $modelo;

	private function altaCurso() {
		$curso = $_POST['curso'];
		$seccion = trim( $_POST['seccion'] );
		$nrc = trim( $_POST['nrc'] );
		$ciclo = $_POST['ciclo'];
		$dia = $_POST['dia'];
		$horas_dia = $_POST['horas_dia'];
		$hora_inicio = $_POST['hora_inicio'];
		$asignatura = $_POST['asignatura'];

		$existente = $this -> modelo -> buscarCurso( $nrc );

		if( $existente === false ) {
			if( $this -> modelo -> agregarCurso( $nrc, $asignatura, $seccion, $ciclo, $_SESSION['codigo_usuario'], $curso ) ) {
				array_shift( $dia );
				array_shift( $horas_dia );
				array_shift( $hora_inicio );
				for( $i = 0; $i < count( $dia ); ++$i ){
					$array = explode( ":", $hora_inicio[$i] );
					$array[0] = $array[0] + $horas_dia[$i];
					$hora_fin = implode( ":", $array );
					$this -> modelo -> agregarDiaClase( $nrc, $dia[$i], $hora_inicio[$i], $hora_fin );
				}
				header( "Location: index.php?ctl=profesor&act=cursos" );
			}
			else {
				$msj_error = "Error al registrar curso, vuelve a intentar";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
			}
		}
		else {
			if( $existente['activo'] ) {
				$msj_error = "Ya existe un curso activo con la misma clave.";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
			}
			else {
				$this -> modelo -> eliminarDiasClase( $nrc );
				$this -> modelo -> actualizarCurso( $nrc, $asignatura, $seccion, $ciclo, $_SESSION['codigo_usuario'], $curso );
				array_shift( $dia );
				array_shift( $horas_dia );
				array_shift( $hora_inicio );
				for( $i = 0; $i < count( $dia ); ++$i ){
					$array = explode( ":", $hora_inicio[$i] );
					$array[0] = $array[0] + $horas_dia[$i];
					$hora_fin = implode( ":", $array );
					$this -> modelo -> agregarDiaClase( $nrc, $dia[$i], $hora_inicio[$i], $hora_fin );
				}
				header( "Location: index.php?ctl=profesor&act=cursos" );
			}
		}
	}

	public function ejecutar() {
		require_once( "Modelo/RegistroCursoMdl.php" );
		$this -> modelo = new RegistroCursoMdl();

		switch ( $_GET['act']) {
			case 'alta':
				if( empty( $_POST ) ) {
					$nombre = explode( " ", $_SESSION['nombre_usuario'] );
					$vista = file_get_contents( "Vista/RegistroCurso.html" );
					$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
					echo $vista;
				}
				else {
					$this -> altaCurso ();
				}
				break;
			case 'carga_academias':
				$deptos_array = $this -> modelo -> obtenerAcademias();
				if( $deptos_array )
					echo json_encode( $deptos_array );
				break;
			case 'carga_cursos':
				$depto = $_POST['departamento'];
				$cursos_array = $this -> modelo -> obtenerCursos( $depto );
				if( $cursos_array )
					echo json_encode( $cursos_array );
				break;
			case 'carga_ciclos':
				$ciclos_array = $this -> modelo -> obtenerCiclos();
				if( $ciclos_array )
					echo json_encode( $ciclos_array );
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