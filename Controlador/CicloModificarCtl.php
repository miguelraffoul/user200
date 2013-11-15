<?php

class CicloModificarCtl{

	private $modelo;

	public function ejecutar(){
		require_once( 'Modelo/CicloModificarMdl.php' );
		$this -> modelo = new CicloModificarMdl();

		switch ($_GET['act']){

			case 'mostrar_pagina':
				$_SESSION['id_ciclo'] = $_POST['id_ciclo'];
				require_once( 'Vista/CicloModificar.html');
				break;

			case 'mostrar_datos':
				$id_ciclo = $_SESSION['id_ciclo'];
				$consulta_exitosa = $this -> modelo -> obtenerCiclo( $id_ciclo );
				echo json_encode( $consulta_exitosa );		
				break;

			case "modifica_ciclo":
				/*$id_ciclo = $_POST[ 'id_ciclo' ];
				$consulta_exitosa = $this -> modelo -> objeterCiclo( $id_ciclo );*/				
				break;

			default:
				require_once( "Vista/Error.html" );
		}

	}
}