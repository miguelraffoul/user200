<?php

class RegistroCursoMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function agregarCurso( $clave, $nombre, $seccion, $ciclo, $profesor ) {
		$consulta = "INSERT INTO curso
				(clave_curso, nombre, seccion, CicloEscolar_idCicloEscolar, Profesor_codigo)
				VALUES (
					\"$clave\",
					\"$nombre\",
					\"$seccion\",
					\"$ciclo\",
					\"$profesor\"
				)";
		return $this -> bd -> insertar( $consulta );
	}

	public function agregarAcademia( $clave, $academia  ) {
		$consulta = "UPDATE curso SET Departamento_idDepartamento = \"$academia\" WHERE clave_curso = \"$clave\"";		
		$this -> bd -> insertar( $consulta );
	}

	public function agregarDiaClase( $clave, $dia, $hora_inicio, $hora_fin ) {
		$consulta = "INSERT INTO diaclase
				(hora_inicio, hora_fin, dia, curso_clave_curso)
				VALUES(
					\"$hora_inicio\",
					\"$hora_fin\",
					\"$dia\",
					\"$clave\"
				)";
		$this -> bd -> insertar( $consulta );
	}

	public function obtenerAcademias() {
		$consulta = "SELECT * FROM departamento";
		$departamentos_array = $this -> bd -> consultaGeneral( $consulta );

		return $departamentos_array;
	}
	
	public function obtenerCiclos() {

		$consulta = "SELECT * FROM cicloescolar";
		$ciclos_array = $this -> bd -> consultaGeneral( $consulta );

		return $ciclos_array;
	}
}