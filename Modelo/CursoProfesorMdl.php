<?php

class CursoProfesorMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerRubros( $curso ){
		$consulta = "SELECT *FROM rubro WHERE Curso_clave_curso = \"$curso\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function eliminarRubro( $nombre ) {
		$consulta = "UPDATE rubro SET activo = FALSE WHERE nombre = \"$nombre\"";
		return $this -> bd -> consultaEspecifica( $consulta );
	}
}