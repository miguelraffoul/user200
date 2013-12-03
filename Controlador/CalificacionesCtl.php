<?php

class CalificacionesCtl{
	private $modelo;


	public function ejecutar(){
		require_once( 'Modelo/CalificacionesMdl.php' );
		$this -> modelo = new CalificacionesMdl();

		switch( $_GET['act'] ){

			case 'mostrar_pagina':
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/Calificaciones.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;
			
			default:
				$msj_error = "Acción inválida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}
	}


}