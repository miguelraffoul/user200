<?php

class LogInCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/LogInMdl.php" );
		$this -> modelo = new LogInMdl();

		if( empty( $_POST ) ) {
			require_once( "Vista/index.html" );
		} 
		else {
			$codigo = $_POST['codigo'];
			$pass = $_POST['pass'];

			if( $this -> modelo -> esAdministrador( $codigo, $pass ) ) {
				header( "Location: index.php?ctl=ciclo_escolar&act=mostrar_pagina" );
			}
			else if( $this -> modelo -> esProfesor( $codigo, $pass ) ) {
				header( "Location: index.php?ctl=profesor" );
			} 
			else if( $this -> modelo -> esAlumno( $codigo, $pass ) ) {
				header( "Location: index.php?ctl=alumno" ); 
			}
			else {
				require_once( "Vista/Error.html" );
			}
		}
	}
}