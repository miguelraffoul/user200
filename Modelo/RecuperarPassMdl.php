<?php

class RecuperarPassMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function cambiarPasswordAlumno( $correo, $new_pass ) {
		$consulta = "UPDATE alumno SET password = \"$new_pass\" WHERE email = \"$correo\"";
		if( $this -> bd -> insertar( $consulta ) )
			if( $this -> bd -> affectedRows() > 0 )
				return true;
		return false;
	}

	public function cambiarPasswordProfesor( $correo, $new_pass ) {
		$consulta = "UPDATE profesor SET password = \"$new_pass\" WHERE email = \"$correo\"";
		if( $this -> bd -> insertar( $consulta ) )
			if( $this -> bd -> affectedRows() > 0 )
				return true;
		return false;
	}

	public function cambiarPasswordAdministrador( $correo, $new_pass ) {
		$consulta = "UPDATE administrador SET password = \"$new_pass\" WHERE email = \"$correo\"";
		if( $this -> bd -> insertar( $consulta ) )
			if( $this -> bd -> affectedRows() > 0 )
				return true;
		return false;
	}
}