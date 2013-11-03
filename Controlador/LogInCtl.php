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
				require_once( "Vista/CicloEscolar.html" );
			}
			else if( $this -> modelo -> esProfesor( $codigo, $pass ) ) {
				require_once( "Vista/Profesor.html" );
			} 
			else if( $this -> modelo -> esAlumno( $codigo, $pass ) ) {
				require_once( "Vista/Alumno.html" );
			}
			else {

			}
		}
	}
}