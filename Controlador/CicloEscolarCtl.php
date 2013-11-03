<?php


class CicloEscolarCtl{
	
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CicloEscolarMdl.php");
		$this -> modelo = new CicloEscolarMdl();
		
		switch ($_GET['act']){

			case 'mostrar_pagina':
				require_once("Vista/CicloEscolar.html");
				break;

			case "listar_ciclos":
				$ciclos_array = $this -> modelo -> obtenerCiclos();
			
				if( $ciclos_array !== FALSE )
					echo json_encode( $ciclos_array );
				break;

			default:
				require_once("Vista/Error.html");
		}

	}

}