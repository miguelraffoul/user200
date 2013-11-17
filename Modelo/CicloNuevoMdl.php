<?php

class CicloNuevoMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function agregarCiclo( $ciclo_select, $fi_ciclo, $ff_ciclo, $fd_inhabil, $descripcion ){

		$consulta = "INSERT INTO cicloescolar ( idCicloEscolar, inicio, fin, Administrador_codigo, activo ) 
					 VALUES ( \"$ciclo_select\", \"$fi_ciclo\", \"$ff_ciclo\", '123admin', TRUE )";

		$consulta_exitosa = $this -> bd -> insertar( $consulta );

		if( $consulta_exitosa ){
			$consulta_exitosa = $this -> agregarDiasInhabiles( $ciclo_select, $fd_inhabil, $descripcion );
			return $consulta_exitosa;	
		}
		else
			return FALSE;
	}


	function agregarDiasInhabiles( $ciclo_select, $fd_inhabil, $descripcion ){

		$longitud = count( $fd_inhabil );

		for( $i = 0 ; $i < $longitud ; $i = $i + 1 ){
			$temp_dia = $fd_inhabil[$i];
			$temp_desc = $descripcion[$i];
			$consulta = "INSERT INTO diainhabil (fecha, motivo, CicloEscolar_idCicloEscolar )
					 	 VALUES ( \"$temp_dia\", \"$temp_desc\", \"$ciclo_select\" )";

			$consulta_exitosa = $this -> bd -> insertar( $consulta );

			if( $consulta_exitosa === FALSE )
				return FALSE;
		}

		return TRUE;
	}
}