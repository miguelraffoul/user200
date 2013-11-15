<?php

class CicloModificarMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerCiclo( $id_ciclo ){
		$consulta = "SELECT *FROM cicloescolar WHERE idCicloEscolar = \"$id_ciclo\"";

		$ciclo_datos = $this -> bd -> consultaGeneral( $consulta );

		return $ciclo_datos;
	}
}