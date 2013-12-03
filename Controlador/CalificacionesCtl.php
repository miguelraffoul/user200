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

			case 'mostrar_datos':
				$this -> obtenerDatosTabla( '12345' );//$_SESSION['clave_curso'] );
				break;
			
			default:
				$msj_error = "Acción inválida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}
	}

	function obtenerDatosTabla( $id_curso ){
		$datos_tabla;
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( $id_curso );
		$rubros = $this -> modelo -> obtenerRubros( $id_curso );

		$columnas = [];
		if( is_array( $rubros ) ){
			$rubros_length = count( $rubros );
			for( $i = 0 ; $i < $rubros_length ; ++$i ){
				$columna_promedio = $this -> modelo -> obtenerPromediosRubro( $rubros[$i]['idRubro'] );
				//var_dump( $columna_promedio );
				array_push( $columnas, $columna_promedio );  
			}
			//var_dump( $columnas );			
			$datos_tabla = [ $alumnos, $rubros, $columnas ];
			//var_dump( $datos_tabla );
			echo json_encode( $datos_tabla );
		}
		else{
			$datos_tabla = [ $alumnos, $rubros ];
			//var_dump( $datos_tabla );
			echo json_encode( $datos_tabla );
		}
	}


}