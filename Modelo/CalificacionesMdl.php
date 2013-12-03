<?php

class CalificacionesMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BasesDeDatos::obtenerInstancia();
	}

}