<?php

class CicloModificarCtl{

	private $modelo

	public function ejecutar(){
		require_once( "Modelo/CicloModificarMdl.php" );
		$this -> modelo = new CicloModificarMdl();

		switch ($_GET['act']){

			case "muestra_pagina":
				require_once( "Vista/CicloModificar.html");
				break;

			case "muestra_datos":
				$id_ciclo = $_POST["id_ciclo"];
				$consulta_exitosa = $this -> modelo -> objeterCiclo( $id_ciclo );

				if( $consulta_exitosa === TRUE )
					echo json_encode( $consulta_exitosa );
				else
					require_once( "Vista/Error.html" );
				break;

			case "modifica_ciclo":
			break;

			default:
				require_once( "Vista/Error.html" );
	}

}