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
			$consulta_exitosa = $this -> agregarHojaEval( $);
			return $consulta_exitosa;	
		}
		else
			return FALSE;
	}

	function agregarHojaEval(){

	}
}