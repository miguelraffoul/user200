<?php


class CicloEscolarCtl{
	
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CicloEscolarMdl.php");
		$this -> modelo = new CicloEscolarMdl();
		
		switch ($_GET['act']){

			case 'mostrar_pagina':
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/CicloEscolar.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;

			case "listar_ciclos":
				$ciclos_array = $this -> modelo -> obtenerCiclos();

				echo json_encode( $ciclos_array );
				break;

			case "modificar":
				$ciclo = $_POST['id_ciclo'];
				$this -> modelo -> eliminarCiclo( $ciclo );
				break;

			default:
				$msj_error = "Acción invalida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}

	}

}