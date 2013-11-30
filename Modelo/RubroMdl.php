<?php

class RubroMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function agregarRubro( $nombre_rubro, $valor_rubro, $tiene_hoja, $columnas ){
 
		$consulta = "INSERT INTO rubro ( nombre, valor, tieneHojaEval, Curso_clave_curso ) 
					 VALUES ( \"$nombre_rubro\", \"$valor_rubro\", \"$tiene_hoja\", 'cc200')";

		$consulta_exitosa = $this -> bd -> insertar( $consulta );

		if( $consulta_exitosa ){
			if( $tiene_hoja === 1 )
				$this -> agregarHojaEval( $this -> bd -> idInsertado(), $columnas );
			return $consulta_exitosa;	
		}
		else
			return FALSE;
	}	

	function agregarHojaEval( $id_rubro, $columnas ){
		$consulta = "INSERT INTO hojaevaluacion ( cantidad_columnas, Rubro_idRubro ) 
					 VALUES ( \"$columnas\", \"$id_rubro\" )";
		$consulta_exitosa = $this -> bd -> insertar( $consulta );

		if( $consulta_exitosa )
			return TRUE;
		else
			return FALSE;
	}

	function obtenerNombreRubro( $id_rubro ){
		$consulta = "SELECT *FROM nombre WHERE idRubro = \"$id_rubro\"";
		$nombre_rubro = $this -> bd -> consultaGeneral( $consulta );
		return $nombre_rubro;
	}	
}
