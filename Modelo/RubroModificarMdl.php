<?php

class RubroModificarMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerRubro( $id_rubro ){
		$consulta = "SELECT *FROM rubro WHERE idRubro = \"$id_rubro\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function actualizarDatos( $id_rubro, $nombre, $valor ){
		$consulta = "UPDATE rubro SET nombre = \"$nombre\", valor = \"$valor\" WHERE idRubro = \"$id_rubro\"";
		return $this -> bd -> insertar( $consulta );
	}
}