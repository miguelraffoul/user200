<?php

class RegistroCursoMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function buscarCurso( $clave ) {
		$consulta = "SELECT * FROM curso WHERE clave_curso = \"$clave\"";
		$resultado = $this -> bd -> consultaEspecifica( $consulta );
		if( $resultado )
			if( $resultado -> num_rows > 0 )
				return $resultado -> fetch_assoc();
		return false;
	}

	public function agregarCurso( $clave, $nombre, $seccion, $ciclo, $profesor, $asignatura ) {
		$consulta = "INSERT INTO curso
				(clave_curso, nombre, seccion, CicloEscolar_idCicloEscolar, Profesor_codigo, activo, Asignatura_idAsignatura)
				VALUES (
					\"$clave\",
					\"$nombre\",
					\"$seccion\",
					\"$ciclo\",
					\"$profesor\",
					TRUE,
					\"$asignatura\"
				)";
		return $this -> bd -> insertar( $consulta );
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

	public function eliminarDiasClase( $clave ) {
		$consulta = "DELETE FROM diaclase WHERE Curso_clave_curso = \"$clave\"";
		$this -> bd -> consultaEspecifica( $consulta );
	}

	public function obtenerAcademias() {
		$consulta = "SELECT * FROM departamento";
		$departamentos_array = $this -> bd -> consultaGeneral( $consulta );

		return $departamentos_array;
	}

	public function obtenerCursos( $departamento ) {
		$consulta = "SELECT * FROM asignatura WHERE Departamento_idDepartamento = $departamento";
		$asignatura_array = $this -> bd -> consultaGeneral( $consulta );

		return $asignatura_array;
	}
	
	public function obtenerCiclos() {
		$consulta = "SELECT * FROM cicloescolar WHERE activo = TRUE";
		$ciclos_array = $this -> bd -> consultaGeneral( $consulta );

		return $ciclos_array;
	}
}