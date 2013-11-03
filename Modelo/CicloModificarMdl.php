<?php

class CicloModificarMdl(){
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerCiclo( $id_ciclo ){
		$consulta "SELECT *fROM cicloescolar WHERE idCicloEscolar = $id_ciclo";

		$ciclo_datos = $this -> bd -> consultaEspecifica( $consulta );

		return $ciclo_datos;
	}
}