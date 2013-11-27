<?php

class AsistenciasMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function obtenerAlumnos( $curso ) {
		$consulta = "SELECT a.nombre, a.codigo FROM alumno As a, alumno_has_curso AS b WHERE a.codigo = b.Alumno_codigo AND b.activo = TRUE AND b.Curso_clave_curso = \"$curso\"";
		return  $this -> bd -> consultaGeneral( $consulta );
	}
}