<?php

class RubroMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function agregarRubro( $nombre_rubro, $valor_rubro, $tiene_columnas_extra, $num_columnas, $id_curso ){
		$consulta = "INSERT INTO rubro ( nombre, valor, tieneColumnasEx, cantidad_columnas, Curso_clave_curso )
					 VALUES ( \"$nombre_rubro\", \"$valor_rubro\", \"$tiene_columnas_extra\", \"$num_columnas\", \"$id_curso\")";
		$consulta_exitosa = $this -> bd -> insertar( $consulta );

		if( $consulta_exitosa ){
			return $this -> bd -> idInsertado();	
		}
		else
			return FALSE;
	}	


	function obtenerNombreRubro( $id_rubro ){
		$consulta = "SELECT *FROM nombre WHERE idRubro = \"$id_rubro\"";
		$nombre_rubro = $this -> bd -> consultaGeneral( $consulta );
		return $nombre_rubro;
	}	


	//METODOS PARA CREAR HOJA DE EVALUACION 
	function obtenerAlumnosNombreId( $id_curso ){
		$consulta = "SELECT nombre, codigo FROM alumno INNER JOIN alumno_has_curso ON codigo = Alumno_codigo 
					 WHERE Curso_clave_curso = \"$id_curso\" AND activo = TRUE ORDER BY nombre ASC";
		return $this -> bd -> consultaGeneral( $consulta );
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
}
