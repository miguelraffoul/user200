<?php

class ListaAlumnosMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}	

	public function obtenerAlumnos() {
		$consulta = "SELECT * FROM alumno";
		$alumnos_array = $this -> bd -> consultaGeneral( $consulta );

		return $alumnos_array;
	}

	public function eliminarAlumno( $codigo, $curso ) {
		$consulta = "UPDATE alumno_has_curso SET activo = FALSE WHERE Alumno_codigo = \"$codigo\" AND Curso_clave_curso= \"$curso\"";
		return $this -> bd -> consultaEspecifica( $consulta );
	}
}