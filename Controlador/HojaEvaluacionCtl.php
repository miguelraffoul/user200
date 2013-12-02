<?php

class HojaEvaluacionCtl{
	private $modelo;

	public function ejecutar(){

		require_once( 'Modelo/HojaEvaluacionMdl.php' );
		$this -> modelo = new HojaEvaluacionMdl();

		switch( $_GET['act'] ){
			/*case 'agregar_hoja':
				$this -> agregarHoja( 3 );
				break;*/

			case 'mostrar_pagina':
				require_once( "Vista/HojaEvaluacion.html" );
				break;

			case 'cargar_hoja':
				$_SESSION['id_rubro'] = $_POST['id_rubro'];
				break;

			case 'mostrar_datos':
				$this -> mostrarDatos( $_SESSION['clave_curso'], $_SESSION['id_rubro'] );
				break;

			case 'guardar_hoja':
				$this -> guardarHoja( $_SESSION['clave_curso'], $_SESSION['id_rubro'] );
				break;

			case 'modificar_hoja':
				break;

			default:
				$this -> mostrarPagina( "Vista/Error.html", "Acción inválida",
							   		    "{ERROR}" );
				break;
		}
	}

	/*function agregarHoja( $columnas_length ){
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( $id_curso );
		$alumnos_length = count( $alumnos );
		
		for( $i = 1 ; $i <= $columnas_length ; $i++ ){
			$id_columna = $this -> modelo -> agregarColumna( "Columna"."$i", $id_rubro );
			for( $j = 0 ; $j < $alumnos_length ; $j++ )
				$this -> modelo -> agregarCelda( 0, $id_columna, $alumnos[$j]['codigo'], $id_curso );
		}

		$id_columna = $this -> modelo -> agregarColumna( "Promedio", $id_rubro );
		for( $j = 0 ; $j < $alumnos_length ; $j++ )
			$this -> modelo -> agregarCelda( 0, $id_columna, $alumnos[$j]['codigo'], $id_curso );
	}*/

	function mostrarDatos( $id_curso, $id_rubro ){
		$columnas = $this -> modelo -> obtenerColumnasNombreId( $id_rubro ); 
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( $id_curso );
		$nombre_rubro = $this -> modelo -> obtenerNombreRubro( $id_rubro );
		
		$alumnos_length = count( $alumnos );
		$columnas_length = count( $columnas ); 
		$celdas_totales = array(); 
		for( $i = 0 ; $i < $alumnos_length ; ++$i ){
			$celdas = $celdas_totales;
			$celdas_temp = $this -> modelo -> obtenerCeldasPorAlumno( $id_rubro, $alumnos[$i]['codigo'] );
			if( !is_array( $celdas_temp ) && $celdas_temp === TRUE ){
				for( $j = 0 ; $j < $columnas_length ; ++$j )
					$this -> modelo -> agregarCelda( 0, $columnas[$j]['idColumna'], $alumnos[$i]['codigo'], $id_curso );
				$celdas_temp =  $this -> modelo -> obtenerCeldasPorAlumno( $id_rubro, $alumnos[$i]['codigo'] );
			}
			$celdas_totales = array_merge( $celdas, $celdas_temp );
		}

		$hoja_evaluacion = [ $columnas, $alumnos, $celdas_totales, $nombre_rubro[0] ];
		//var_dump( $hoja_evaluacion );
		echo json_encode( $hoja_evaluacion );
	}

	function guardarHoja( $id_curso, $id_rubro ){
		$this -> modelo -> eliminarHoja( $id_rubro );
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( $id_curso );
		$columnas = $_POST['nombre_columnas'];
		$calificaciones = $_POST['calificaciones'];

		array_shift( $columnas );
		array_shift( $calificaciones );
		$columnas_length = count( $columnas );
		$alumnos_length = count( $alumnos );
		
		$id_columna = array();
		for( $i = 0 ; $i < $columnas_length ; ++$i ){
			$id_temp = $this -> modelo -> agregarColumna( $columnas[$i], $id_rubro );
			array_push( $id_columna, $id_temp );
		}

		//var_dump( $id_columna );
		$count = 0;
		for( $j = 0 ; $j < $alumnos_length ; $j++ ){
			for( $i = 0 ; $i < $columnas_length ; $i++ ){
				$this -> modelo -> agregarCelda( strtoupper( $calificaciones[$count] ), $id_columna[$i], $alumnos[$j]['codigo'], $id_curso );
				$count = $count + 1;
			}
		}
		require_once( 'Vista/CursoProfesor.html' );
	}

	function mostrarPagina( $vista, $msj_nuevo, $msj_reemplazar ){
		$vista_desplegar = file_get_contents(  $vista );
		$vista_desplegar = str_replace( $msj_reemplazar, $msj_nuevo, $vista_desplegar );
		echo $vista_desplegar;
	}

}