<?php

class CambioContraMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function esAlumno( $pass, $nuevo_pass ) {
		$consulta = "UPDATE alumno SET password = \"$nuevo_pass\" WHERE password = \"$pass\"";
		$result = $this -> bd -> insertar( $consulta );
		var_dump( $result );
		if( $result )
			if( $this -> bd -> affectedRows() > 0 )
				return true;
		return false;
	}

	function esProfesor( $pass, $nuevo_pass ) {
		$consulta = "UPDATE profesor SET password = \"$nuevo_pass\" WHERE password = \"$pass\"";
		$result = $this -> bd -> insertar( $consulta );
		var_dump( $result );
		if( $result )
			if( $this -> bd -> affectedRows() )
				return true;
		return false;	
	}

	function esAdministrador( $pass, $nuevo_pass ) {
		$consulta = "UPDATE administrador SET password = \"$nuevo_pass\" WHERE password = \"$pass\"";
		$result = $this -> bd -> insertar( $consulta );
		var_dump( $result );
		if( $result )
			if( $this -> bd -> affectedRows() )
				return true;
		return false;
	}
	
}