<?php

class CursoProfesorMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerRubros(){

		$curso = "cc200";
		$consulta = "SELECT *FROM rubro WHERE Curso_clave_curso = \"$curso\"";
		$rubros_array = $this -> bd -> consultaGeneral( $consulta );
		return $rubros_array;
	}
}