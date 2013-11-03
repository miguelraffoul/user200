<?php

class LogInMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function esAlumno( $codigo, $pass ) {
		$query = "SELECT * FROM alumno";
		if( $resultado = $this -> bd -> consultaGeneral( $query ) ) {
			foreach ( $resultado as $fila ) {
				if( $fila['codigo'] == $codigo && $fila['password'] == $pass )
					return true;
			}
		}
		return false;
	}

	function esProfesor( $codigo, $pass ) {
		$query = "SELECT * FROM profesor";
		if( $resultado = $this -> bd -> consultaGeneral( $query ) ) {
			foreach ( $resultado as $fila ) {
				if( $fila['codigo'] == $codigo && $fila['password'] == $pass )
					return true;
			}
		}
		return false;
	}

	function esAdministrador( $codigo, $pass ) {
		$query = "SELECT * FROM administrador";
		if( $resultado = $this -> bd -> consultaGeneral( $query ) ) {
			foreach ( $resultado as $fila ) {
				if( $fila['codigo'] == $codigo && $fila['password'] == $pass )
					return true;
			}
		}
		return false;
	}
}