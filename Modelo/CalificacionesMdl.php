<?php

class CalificacionesMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerAlumnosNombreId( $id_curso ){
		$consulta = "SELECT nombre, codigo FROM alumno INNER JOIN alumno_has_curso ON codigo = Alumno_codigo 
					 WHERE Curso_clave_curso = \"$id_curso\" AND activo = TRUE ORDER BY nombre ASC";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerRubros( $id_curso ){
		$consulta = "SELECT nombre, idRubro FROM rubro WHERE Curso_clave_curso = \"$id_curso\" ";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerPromediosRubro( $id_rubro ){
		$consulta = "SELECT calificacion FROM rubrocelda INNER JOIN rubrocolumna ON Columna_idColumna = idColumna 
					 WHERE Rubro_idRubro = \"$id_rubro\" AND nombre = 'Promedio' ";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	

}