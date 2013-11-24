<?php

class ProfesorMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}
	
	public function obtenerCursos() {
		$consulta = "SELECT * FROM curso";
		$cursos_array = $this -> bd -> consultaGeneral( $consulta );

		return $cursos_array;
	}

	public function eliminarCurso( $id_curso ) {
		$consulta = "UPDATE curso SET activo = FALSE WHERE clave_curso = \"$id_curso\"";
		$this -> bd -> consultaEspecifica( $consulta );
	} 
}