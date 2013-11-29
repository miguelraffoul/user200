<?php

class AsistenciasMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function obtenerAlumnos( $curso ) {
		$consulta = "SELECT a.nombre, a.codigo FROM alumno As a, alumno_has_curso AS b WHERE a.codigo = b.Alumno_codigo AND b.activo = TRUE AND b.Curso_clave_curso = \"$curso\" ORDER BY a.nombre";
		return  $this -> bd -> consultaGeneral( $consulta );
	}

	public function obtenerCicloCurso( $curso ) {
		$consulta = "SELECT c_e.idCicloEscolar, c_e.inicio, c_e.fin FROM cicloescolar AS c_e, curso AS c WHERE c.clave_curso = \"$curso\" AND c_e.idCicloEscolar = c.CicloEscolar_idCicloEscolar";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	public function obtenerDiasInhabiles( $ciclo ) {
		$consulta = "SELECT * FROM diainhabil WHERE CicloEscolar_idCicloEscolar = \"$ciclo\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	public function obtenerDiasClase( $curso ) {
		$consulta = "SELECT * FROM diaclase WHERE Curso_clave_curso = \"$curso\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}
}