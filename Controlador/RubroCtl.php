<?php

class RubroCtl{

	private $modelo;

	public function ejecutar(){

		require_once("Modelo/RubroMdl.php");
		$this -> modelo = new RubroMdl();

		switch ($_GET['act']){

			case "agregar_rubro":

				if(empty($_POST))
					require_once("Vista/RubroEvaluacion.html");
				else
					$this -> nuevoRubro();
				break;

			default:
				require_once("Vista/Error.html");
		}
	}


	function nuevoRubro(){

		$nombre_rubro = $_POST["nombre_rubro"];
		$valor_rubro = $_POST["valor_rubro"];

		$resultado = 0;
		if( array_key_exists( "tiene_hoja", $_POST ) ){
			$tiene_hoja = $_POST["tiene_hoja"];
			$columnas = $_POST["columnas_rubro"];
			$resultado = $this -> modelo -> agregarRubro( $nombre_rubro, $valor_rubro, 1, $columnas );
		}
		else
			$resultado = $this -> modelo -> agregarRubro( $nombre_rubro, $valor_rubro, 0, 0 );

		

		if($resultado!==FALSE)
			require_once("Vista/RubroEvaluacion.html");
		else
			require_once("Vista/Error.html");
	}
}