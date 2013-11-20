<?php

class CicloEscolarMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerCiclos(){

		$consulta = "SELECT *FROM cicloescolar WHERE activo = TRUE";
		$ciclos_array = $this -> bd -> consultaGeneral( $consulta );

		return $ciclos_array;
	}

	function eliminarCiclo( $ciclo ){
		$consulta = "UPDATE cicloescolar SET activo = FALSE WHERE idCicloEscolar = \"$ciclo\"";
		$resultado1 = $this -> bd -> insertar( $consulta ); 

		$consulta = "UPDATE curso SET activo = FALSE WHERE CicloEscolar_idCicloEscolar = \"$ciclo\"";
		$resultado2 = $this -> bd -> insertar( $consulta );

		if( $resultado1 && $resultado2 )
			return TRUE;
		return FALSE;
	}

}