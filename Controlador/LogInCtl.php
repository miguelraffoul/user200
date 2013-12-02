<?php

class LogInCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/LogInMdl.php" );
		$this -> modelo = new LogInMdl();

		if( !isset( $_SESSION['usuario'] ) ) {
			if( empty( $_POST ) ) {
				require_once( "Vista/index.html" );
			} 
			else {
				$codigo = $_POST['codigo'];
				$pass = $_POST['pass'];

				$usuario = $this -> modelo -> esAdministrador( $codigo, $pass );
				if( is_array( $usuario ) ) {
					$_SESSION['usuario'] = 'administrador';
					$_SESSION['codigo_usuario'] = $usuario[0]['codigo'];
					$_SESSION['nombre_usuario'] = $usuario[0]['nombre'];
					header( "Location: index.php?ctl=ciclo_escolar&act=mostrar_pagina" );
				}
				else {
					$usuario = $this -> modelo -> esProfesor( $codigo, $pass );
					if( is_array( $usuario ) ) {
						$_SESSION['usuario'] = 'profesor';
						$_SESSION['codigo_usuario'] = $usuario[0]['codigo'];
						$_SESSION['nombre_usuario'] = $usuario[0]['nombre'];
						header( "Location: index.php?ctl=profesor&act=cursos" );
					}
					else {
						$usuario = $this -> modelo -> esAlumno( $codigo, $pass );
						if( is_array( $usuario ) ) {
							$_SESSION['usuario'] = 'alumno';
							$_SESSION['codigo_usuario'] = $usuario[0]['codigo'];
							$_SESSION['nombre_usuario'] = $usuario[0]['nombre'];
							header( "Location: index.php?ctl=alumno&act=mostrar_datos" );
						}
						else {
							$msj_error = "No se encontro ningun usuario con los datos especificados";
							$vista = file_get_contents( "Vista/Error.html" );
							$vista = str_replace( "{ERROR}", $msj_error, $vista );
							echo $vista;
						}
					}
				} 
			}
		}
		else {
			switch ( $_SESSION['usuario'] ) {
				case 'administrador':
					header( "Location: index.php?ctl=ciclo_escolar&act=mostrar_pagina" );
					break;
				case 'profesor':
					header( "Location: index.php?ctl=profesor&act=cursos" );
					break;
				case 'alumno':
					header( "Location: index.php?ctl=alumno&act=mostrar_datos" );
					break;
			}
		}
	}
}