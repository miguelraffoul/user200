<?php


class CicloEscolarCtl{
	
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CicloNuevoMdl.php");
		$this -> modelo = new CicloNuevoMdl();

		switch ($_GET['act']){

			case "listar_ciclos":

				if(empty($_POST))
					require_once("Vista/CicloEscolar.html");
				else
					$this -> listaCiclo();
				break;

			default:
				require_once("Vista/Error.html");
		}

		function listaCiclo(){
			
		}
	}
}