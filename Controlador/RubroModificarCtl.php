<?php

class RubroModificarCtl{
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/RubroModificarMdl.php");
		$this -> modelo = new RubroModificarMdl();

		switch ($_GET['act']){

			case 'mostrar_pagina':
				require_once( 'Vista/RubroModificar.html' ); 
				break;

			case 'cargar_rubro':
				$_SESSION['id_rubro'] = $_POST['id_rubro'];
				require_once( 'Vista/RubroModificar.html' ); 
				break;

			case 'mostrar_datos':
				$rubro = $this -> modelo -> obtenerRubro( $_SESSION['id_rubro'] );
				echo json_encode( $rubro );
				break;

			case 'modificar_rubro':
				break;

			default:
				require_once("Vista/Error.html");
		}
	}
}