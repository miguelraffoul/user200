<?php

class ClonarCursoMdl {
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

	public function obtenerRubros( $curso ) {
		$consulta = "SELECT * FROM rubro WHERE Curso_clave_curso = \"$curso\"";
		return $this -> bd -> consultaGeneral( $consulta );
 	}

	public function obtenerColumnas( $rubro ) {
		$consulta = "SELECT * FROM rubrocolumna WHERE Rubro_idRubro = \"$rubro\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	public function agergarRubro( $curso, $nombre, $valor, $tiene_columnas_ex, $columnas ) {
		$consulta = "INSERT INTO rubro 
					(nombre, valor, tieneColumnasEx, cantidad_columnas, Curso_clave_curso)
					 VALUES (
					 	\"$nombre\",
					 	\"$valor\",
					 	\"$tiene_columnas_ex\",
					 	\"$columnas\",
					 	\"$curso\"
					 )";
		$this -> bd -> insertar( $consulta );
		return $this -> bd -> idInsertado();
	} 

	public function agregarColumna( $rubro, $nombre ) {
		$consulta = "INSERT INTO rubrocolumna 
					(nombre, Rubro_idRubro) VALUES ( \"$nombre\", \"$rubro\" )";
		$this -> bd -> insertar( $consulta );
	}
}