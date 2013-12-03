<?php

class RubroModificarCtl{
	private $modelo;

	public function ejecutar(){

		require_once("Modelo/RubroModificarMdl.php");
		$this -> modelo = new RubroModificarMdl();

		switch ($_GET['act']){

			case 'mostrar_pagina':
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/RubroModificar.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;

			case 'cargar_rubro':
				$_SESSION['id_rubro'] = $_POST['id_rubro'];
				break;

			case 'mostrar_datos':
				$rubro = $this -> modelo -> obtenerRubro( $_SESSION['id_rubro'] );
				echo json_encode( $rubro );
				break;

			case 'modificar_datos':
				$nombre = $_POST['nombre_rubro'];
				$valor = $_POST['valor_rubro'];
				$this -> modelo -> actualizarDatos( $_SESSION['id_rubro'], $nombre, $valor );
				header( "Location: index.php?ctl=curso_profesor&act=mostrar_pagina" );
				break;

			default:
				$msj_error = "No se agregó rubro correctamente.";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
		}
	}
}