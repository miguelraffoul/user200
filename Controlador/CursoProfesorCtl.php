<?php

class CursoProfesorCtl{
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CursoProfesorMdl.php");
		$this -> modelo = new CursoProfesorMdl();
		
		switch ($_GET['act']){
			case 'mostrar_pagina':
				$_SESSION['clave_curso'] = $_POST['clave_curso'];
				$_SESSION['nombre_curso'] = $_POST['nombre_curso'];
				$vista = file_get_contents("Vista/CursoProfesor.html");
				$vista = str_replace( "&lt;Nombre de curso&gt;", $_SESSION['nombre_curso'], $vista );
				echo $vista;
				break;

			case "listar_rubros":
				$rubros_array = $this -> modelo -> obtenerRubros();
				echo json_encode( $rubros_array );
				break;

			default:
				$msj_error = "Acción invalida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
		}
	}
}