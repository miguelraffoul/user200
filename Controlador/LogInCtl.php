<?php

class LogInCtl {
	private $modelo;

	public function ejecutar() {/*
		require_once( "Modelo/LogInMdl.php" );
		$this -> modelo = new LogInMdl();*/

		if( empty( $_POST ) ) {
			require_once( "Vista/index.html" );
		} 
		else {
			$codigo = $_POST['codigo'];
			$pass = $_POST['pass'];
			echo $codigo;
			echo $pass;
			require_once( "Vista/index.html" );
		}
	}
}