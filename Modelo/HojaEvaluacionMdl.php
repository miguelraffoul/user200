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

	function agregarCelda( $calificacion, $id_columna, $id_alumno, $id_curso ){
		$consulta = "INSERT INTO rubrocelda ( calificacion, Columna_idColumna, 
											Alumno_has_Curso_Alumno_codigo, Alumno_has_Curso_Curso_clave_curso )
					 VALUES ( \"$calificacion\", \"$id_columna\", \"$id_alumno\", \"$id_curso\" )";
		return $this -> bd -> insertar( $consulta );
	}

	function obtenerNombreRubro( $id_rubro ){
		$consulta = "SELECT nombre FROM rubro WHERE idRubro = \"$id_rubro\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerAlumnosId( $id_curso ){
		$consulta = "SELECT Alumno_codigo FROM alumno_has_curso WHERE Curso_clave_curso = \"$id_curso\" AND activo = TRUE";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerAlumnosNombreId( $id_curso ){
		$consulta = "SELECT nombre, codigo FROM alumno INNER JOIN alumno_has_curso ON codigo = Alumno_codigo 
					 WHERE Curso_clave_curso = \"$id_curso\" AND activo = TRUE ORDER BY nombre ASC";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerColumnasId( $id_rubro ){
		$consulta = "SELECT *FROM rubrocolumna WHERE Rubro_idRubro = \"$id_rubro\" ";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerColumnasNombreId( $id_rubro ){
		$consulta = "SELECT nombre, idColumna FROM rubrocolumna WHERE Rubro_idRubro = \"$id_rubro\" ";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerCeldas( $id_rubro ){
		$consulta = "SELECT calificacion, idCelda FROM rubrocelda INNER JOIN rubrocolumna 
					 ON Columna_idColumna = idColumna WHERE Rubro_idRubro = \"$id_rubro\"";
		
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function obtenerCeldasPorAlumno( $id_rubro, $id_alumno ){
		$consulta = "SELECT calificacion, idCelda FROM rubrocelda INNER JOIN rubrocolumna 
					 ON Columna_idColumna = idColumna WHERE Rubro_idRubro = \"$id_rubro\" AND
					 Alumno_has_Curso_Alumno_codigo = \"$id_alumno\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function eliminarHoja( $id_rubro ){
		$consulta = "DELETE FROM rubrocolumna WHERE Rubro_idRubro = \"$id_rubro\"";
		return $this -> bd -> insertar( $consulta );
	}

	function obtenerPromediosAlumno( $id_curso, $alumno ){
		$consulta = "SELECT calificacion FROM rubrocelda INNER JOIN rubrocolumna ON Columna_idColumna = idColumna 
		             WHERE nombre = 'Promedio' AND Alumno_has_Curso_Alumno_codigo = \"$alumno\" 
		             						   AND Alumno_has_Curso_Curso_clave_curso = \"$id_curso\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function guardarPromedioCurso( $id_curso, $id_alumno, $promedio ){
		$consulta = "UPDATE alumno_has_curso SET promedio = \"$promedio\" WHERE Alumno_codigo = \"$id_alumno\" 
					 AND Curso_clave_curso = \"$id_curso\"";
		return $this -> bd -> insertar( $consulta );
	}

}