<?php

class AltaAlumnoCtl {
	private $modelo;

	private function generarPass( $nombre, $codigo ) {
		$nombre_arr = explode( " ", $nombre );
		$nombre_arr[] = $codigo;
		$fecha = getdate();
		$datos = $fecha + $nombre_arr;
		$datos_string = implode( "", $datos );
		$nuevo_pass = substr( str_shuffle( $datos_string ), 0, 8 );
		return $nuevo_pass;
	}

	private function altaSimple() {
		$nombre = trim( $_POST["nombre"] );
		$codigo = trim( $_POST["codigo"] );
		$carrera = $_POST["ingenierias"];
		$correo = trim( $_POST["mail"] );
		$pass = $this -> generarPass( $nombre, $codigo );
		$celular = $_POST["celular"];
		$git = trim( $_POST["cuenta_git"] );
		$pagina = trim( $_POST["pagina_web"] );

		$alumno = $this -> modelo -> buscarAlmuno( $codigo  );
		if(  $alumno === false ) {
			$resultado = $this -> modelo -> alta( $codigo , $nombre, $carrera, $correo, sha1( $pass ) );
			if( $resultado !== FALSE ) {
				if( $celular !== "" ) {
					$this -> modelo -> agregarCelular( $codigo, $celular );
				}
				if( $git !== "" ) {
					$this -> modelo -> agregarGit( $codigo, $git );
				}
				if( $pagina !== "" ) {
					$this -> modelo -> agregarPagina( $codigo, $pagina );
				}

				$this -> modelo -> ligarCurso( $codigo, $_SESSION['clave_curso'] );

				require_once( "SmartMail.php" );
				$mail = new SmartMail();
				$mail -> enviarPassword( $nombre, $pass, $correo );

				header( "Location: index.php?ctl=lista_alumnos&act=lista" );
			}
			else {
				require_once( "Vista/Error.html" );
			}
		}
		else {
			$ligas_curso = $this -> modelo -> buscarCursoLigado( $codigo );
			$contador = 0;
			$encontrado = false;
			foreach( $ligas_curso as $fila ) {
                if( $fila['activo'] ) 
                	$contador++; 
                if( $fila['Curso_clave_curso'] == $_SESSION['clave_curso'] )
                	$encontrado = true;  
            }
			if( $contador == 0 ) {
				$this -> modelo -> actualizarDatos( $codigo, $nombre, $carrera, $correo, sha1( $pass ), $celular, $git, $pagina );
				
				require_once( "SmartMail.php" );
				$mail = new SmartMail();
				$mail -> enviarPassword( $nombre, $pass, $correo );
				if( $encontrado )
					$this -> modelo -> activarLigaCurso( $codigo, $_SESSION['clave_curso'] );
				else 
					$this -> modelo -> ligarCurso( $codigo, $_SESSION['clave_curso'] );
				
			}
			else {
				if( $encontrado )
					$this -> modelo -> activarLigaCurso( $codigo, $_SESSION['clave_curso'] );
				else 
					$this -> modelo -> ligarCurso( $codigo, $_SESSION['clave_curso'] );
			}
			header( "Location: index.php?ctl=lista_alumnos&act=lista" );
		}
	}

	public function altaArchivo() {
		$contenido = file_get_contents( $_FILES['archivo']['tmp_name'] );
		$alumnos = explode( PHP_EOL, $contenido );
		
		$regexp_nombre = '/^[a-z\s]+$/i';
		$reqexp_codigo = '/^[0-9a-z]+$/i';
		$regexp_correo = '/^[a-z0-9][a-z0-9_\.]+@[a-z0-9_\.]+\.[a-z]+$/i';
		$regexp_celular = '/^[0-9]+$/';
		$carreras = array( "computacion", "informatica", "biomedica", "electronica" );

		require_once( "SmartMail.php" );

		foreach ( $alumnos as &$alumno ) {
			$alumno = explode( ",", $alumno );
			if( !preg_match( $regexp_nombre, $alumno[0] ) )
				continue;
			if( !preg_match( $reqexp_codigo, $alumno[1] ) )
				continue;
			if( array_search( $alumno[2], $carreras ) === FALSE )
				continue;
			if( !preg_match( $regexp_correo, $alumno[3] ) )
				continue;
			if( $this -> modelo -> buscarAlmuno( $alumno[1] ) === false ) {
				$pass = $this -> generarPass( $alumno[0], $alumno[1] );
				$this -> modelo -> alta( $alumno[1] , $alumno[0], $alumno[2], $alumno[3] ,sha1( $pass ) );
				if( $alumno[4] != "" && preg_match( $regexp_celular, $alumno[4] ) )
					$this -> modelo -> agregarCelular( $alumno[1], $alumno[4] );
				if( $alumno[5] != "" )
					$this -> modelo -> agregarGit( $alumno[1], $alumno[5] );
				if( $alumno[6] != "" )
					$this -> modelo -> agregarPagina( $alumno[1], $alumno[6] );

				$this -> modelo -> ligarCurso( $alumno[1], $_SESSION['clave_curso'] );
				$mail = new SmartMail();
				$mail -> enviarPassword( $alumno[0], $pass, $alumno[3] );
			}
		}
		header( "Location: index.php?ctl=lista_alumnos&act=lista" );
	}

	public function ejecutar() {
		require_once( "Modelo/AltaAlumnoMdl.php" );
		$this -> modelo = new AltaAlumnoMdl();

		switch ( $_GET['act']) {
			case 'mostrar_pagina':
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/AltaAlumno.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;
			case 'alta_simple':
				$this -> altaSimple();
				break;
			case 'alta_archivo':
				$this -> altaArchivo();
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