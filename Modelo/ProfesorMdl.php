<?php

class ProfesorMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}
	
	public function obtenerCursos() {
		$consulta = "SELECT * FROM curso";
		$cursos_array = $this -> bd -> consultaGeneral( $consulta );

		return $cursos_array;
	}
}