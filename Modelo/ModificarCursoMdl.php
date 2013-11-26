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

	public function eliminarDiasClase( $clave ) {
		$consulta = "DELETE FROM diaclase WHERE Curso_clave_curso = \"$clave\"";
		$this -> bd -> consultaEspecifica( $consulta );
	}

	public function agregarDiaClase( $clave, $dia, $hora_inicio, $hora_fin ) {
		$consulta = "INSERT INTO diaclase
				(hora_inicio, hora_fin, dia, Curso_clave_curso )
				VALUES(
					\"$hora_inicio\",
					\"$hora_fin\",
					\"$dia\",
					\"$clave\"
				)";
		$this -> bd -> insertar( $consulta );
	}

	public function actualizarCurso( $clave, $nombre, $seccion, $ciclo, $profesor, $asignatura ) {
		$consulta = "UPDATE curso SET
					nombre = \"$nombre\",
					seccion = \"$seccion\",
					CicloEscolar_idCicloEscolar = \"$ciclo\",
					Profesor_codigo = \"$profesor\",
					activo = TRUE,
					Asignatura_idAsignatura = \"$asignatura\"
					WHERE clave_curso = \"$clave\"";
		$this -> bd -> insertar( $consulta );
	}
}