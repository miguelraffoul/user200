<?php

class CicloModificarCtl{

	private $modelo

	public function ejecutar(){
		$this -> modelo = new CicloModificarMdl();

		switch ($_GET['act']){

			case "modificar_ciclo":
			break;

			default:
				require_once( "Vista/Error.html" );
	}

}