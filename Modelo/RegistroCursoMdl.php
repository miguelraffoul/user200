<?php

class RegistroCursoMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerAcademias() {
		$consulta = "SELECT * FROM departamento";
		$departamentos_array = $this -> bd -> consultaGeneral( $consulta );

		return $departamentos_array;
	}
	
	function obtenerCiclos() {

		$consulta = "SELECT * FROM cicloescolar";
		$ciclos_array = $this -> bd -> consultaGeneral( $consulta );

		return $ciclos_array;
	}
}