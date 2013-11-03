<?php

class CambioContraMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function esAlumno( $pass, $nuevo_pass ) {
		$consulta = "SELECT * FROM alumno WHERE password = \"$pass\"";
		if( $this -> bd -> consultaEspecifica( $consulta ) ) {
			$consulta = "UPDATE alumno SET password = \"$nuevo_pass\" WHERE password = \"$pass\"";
			$this -> bd -> insertar( $consulta );
			return true;
		}
		return false;
	}

	function esProfesor( $pass, $nuevo_pass ) {
		$consulta = "SELECT * FROM profesor WHERE password = \"$pass\"";
		if( $this -> bd -> consultaEspecifica( $consulta ) ) {
			echo "es profesor";
			$consulta = "UPDATE profesor SET password = \"$nuevo_pass\" WHERE password = \"$pass\"";
			$this -> bd -> insertar( $consulta );
			return true;
		}
		return false;	
	}

	function esAdministrador( $pass, $nuevo_pass ) {
		$consulta = "SELECT * FROM administrador WHERE password = \"$pass\"";
		if( $this -> bd -> consultaEspecifica( $consulta ) ) {
			echo "es admin";
			$consulta = "UPDATE administrador SET password = \"$nuevo_pass\" WHERE password = \"$pass\"";
			$this -> bd -> insertar( $consulta );
			return true;
		}
		return false;
	}
	
}