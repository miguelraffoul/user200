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

	function obtenerDiasInhabiles( $id_ciclo ){
		$consulta = "SELECT *FROM diainhabil WHERE CicloEscolar_idCicloEscolar = \"$id_ciclo\"";
		$dia_inhabil_datos = $this -> bd -> consultaGeneral( $consulta );
		return $dia_inhabil_datos;
	}
}