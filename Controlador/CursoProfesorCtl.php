<?php

class CursoProfesorCtl{
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CursoProfesorMdl.php");
		$this -> modelo = new CursoProfesorMdl();
		
		switch ($_GET['act']){
			case 'mostrar_pagina':
				if( !empty($_POST) ){
					$_SESSION['clave_curso'] = $_POST['clave_curso'];
					$_SESSION['nombre_curso'] = $_POST['nombre_curso'];
				}
				$this -> mostrarPagina( "Vista/CursoProfesor.html", $_SESSION['nombre_curso'],
							   "&lt;Nombre de curso&gt;" );
				break;

			case "listar_rubros":
				$rubros_array = $this -> modelo -> obtenerRubros( $_SESSION['clave_curso'] );
				echo json_encode( $rubros_array );
				break;

			case "eliminar_rubros":
				$id_rubros = $_POST['id_rubros'];
				$this -> eliminarRubros( $id_rubros );
				break;

			default:
				$this -> mostrarPagina( "Vista/Error.html", "Acción inválida",
							   "{ERROR}" );
				break;
		}
	}

	function eliminarRubros( $id_rubros ){
		$rubros_length = count( $id_rubros );
		for( $i = 0 ; $i < $rubros_length ; ++$i )
			$this -> modelo -> eliminarRubro( $id_rubros[$i] );
	}


	function mostrarPagina( $vista, $msj_nuevo, $msj_reemplazar ){
		$vista_desplegar = file_get_contents(  $vista );
		$vista_desplegar = str_replace( $msj_reemplazar, $msj_nuevo, $vista_desplegar );
		echo $vista_desplegar;
	}
}