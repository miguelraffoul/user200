<?php

class LogInMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function esAlumno( $codigo, $pass ) {
		$consulta = "SELECT * FROM alumno WHERE codigo = \"$codigo\" AND password = \"$pass\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function esProfesor( $codigo, $pass ) {
		$consulta = "SELECT * FROM profesor WHERE codigo = \"$codigo\" AND password = \"$pass\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function esAdministrador( $codigo, $pass ) {
		$consulta = "SELECT * FROM administrador WHERE codigo = \"$codigo\" AND password = \"$pass\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}
}