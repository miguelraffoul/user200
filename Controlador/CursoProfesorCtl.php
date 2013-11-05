<?php

class CursoProfesorCtl{
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CursoProfesorMdl.php");
		$this -> modelo = new CursoProfesorMdl();
		
		switch ($_GET['act']){

			case 'mostrar_pagina':
				require_once("Vista/CursoProfesor.html");
				break;

			case "listar_rubros":
				$rubros_array = $this -> modelo -> obtenerRubros();
				echo json_encode( $rubros_array );
				break;

			default:
				require_once("Vista/Error.html");
		}

	}
}