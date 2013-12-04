<?php

class AlumnoMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerDatosCursos( $codigo ){
		$consulta = "SELECT c.nombre, c.CicloEscolar_idCicloEscolar, a.promedio_asist, a.promedio 
					 FROM alumno_has_curso AS a, curso AS c 
					 WHERE a.Alumno_codigo = \"$codigo\" AND 
					 a.Curso_clave_curso = c.clave_curso AND
					 a.activo = TRUE";
		return $this -> bd -> consultaGeneral( $consulta );
	}
}