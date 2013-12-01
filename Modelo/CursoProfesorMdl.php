<?php

class CursoProfesorMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerRubros( $id_curso ){
		$consulta = "SELECT *FROM rubro WHERE Curso_clave_curso = \"$id_curso\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function eliminarRubro( $id_rubro ) {
		$consulta = "DELETE FROM rubro WHERE idRubro = \"$id_rubro\"";
		return $this -> bd -> consultaEspecifica( $consulta );
	}
}