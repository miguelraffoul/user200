<?php

class ModificarAlumnoMdl{
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function obtenerDatosAlumno( $codigo ){
		$consulta = "SELECT * FROM alumno WHERE codigo = $codigo";
		return $this -> bd -> consultaGeneral( $consulta ); 
	}
}