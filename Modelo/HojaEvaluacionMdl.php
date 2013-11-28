<?php

class HojaEvaluacionMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function agregarColumna( $nombre_columna, $id_rubro ){
		$consulta = "INSERT INTO rubrocolumna ( nombre, Rubro_idRubro ) 
		             VALUES ( \"$nombre_columna\", \"$id_rubro\" )";
		$this -> bd -> insertar( $consulta );  
		return $this -> bd -> idInsertado();
	}

	function obtenerAlumnos( $id_curso ){
		$consulta = "SELECT Alumno_codigo FROM alumno_has_curso WHERE Curso_clave_curso = \"$id_curso\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function agregarCelda( $calificacion, $id_columna, $id_alumno, $id_curso ){
		$consulta = "INSERT INTO rubrocelda ( calificacion, Columna_idColumna, 
											Alumno_has_Curso_Alumno_codigo, Alumno_has_Curso_Curso_clave_curso )
					 VALUES ( \"$calificacion\", \"$id_columna\", \"$id_alumno\", \"$id_curso\" )";
		return $this -> bd -> insertar( $consulta );
	}

}