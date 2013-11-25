<?php

class ModificarCursoMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function obtenerDatosCurso( $clave ) {
		$consulta = "SELECT * FROM curso WHERE clave_curso = \"$clave\"";
		return $this -> bd -> consultaGeneral( $consulta ); 
	}

	public function obtenerDatosAsignatura( $id ) {
		$consulta = "SELECT * FROM asignatura WHERE idAsignatura = $id";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	public function obtenerDiasClase( $clave ) {
		$consulta = "SELECT * FROM diaclase WHERE Curso_clave_curso = \"$clave\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}
}