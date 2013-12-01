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
				$this -> cargarHoja();
				break;

			case 'guardar_hoja':
				$this -> guardarHoja();
				break;

			case 'modificar_hoja':
				break;
		}
	}

	/*function agregarHoja( $columnas_length ){
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( '12345' );
		$alumnos_length = count( $alumnos );
		
		for( $i = 1 ; $i <= $columnas_length ; $i++ ){
			$id_columna = $this -> modelo -> agregarColumna( "Columna"."$i", 2 );
			for( $j = 0 ; $j < $alumnos_length ; $j++ )
				$this -> modelo -> agregarCelda( 0, $id_columna, $alumnos[$j]['codigo'], '12345' );
		}

		$id_columna = $this -> modelo -> agregarColumna( "Promedio", 2 );
		for( $j = 0 ; $j < $alumnos_length ; $j++ )
			$this -> modelo -> agregarCelda( 0, $id_columna, $alumnos[$j]['codigo'], '12345' );
	}*/

	function cargarHoja(){
		$columnas = $this -> modelo -> obtenerColumnasNombreId( 2 ); 
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( '12345' );
		
		$alumnos_length = count( $alumnos );
		$columnas_length = count( $columnas ); 
		$celdas_totales = array(); 
		for( $i = 0 ; $i < $alumnos_length ; ++$i ){
			$celdas = $celdas_totales;
			$celdas_temp = $this -> modelo -> obtenerCeldasPorAlumno( 2, $alumnos[$i]['codigo'] );
			if( !is_array( $celdas_temp ) && $celdas_temp === TRUE ){
				for( $j = 0 ; $j < $columnas_length ; ++$j )
					$this -> modelo -> agregarCelda( 0, $columnas[$j]['idColumna'], $alumnos[$i]['codigo'], '12345' );
				$celdas_temp =  $this -> modelo -> obtenerCeldasPorAlumno( 2, $alumnos[$i]['codigo'] );
			}
			$celdas_totales = array_merge( $celdas, $celdas_temp );
		}

		$hoja_evaluacion = [ $columnas, $alumnos, $celdas_totales ];
		//var_dump( $hoja_evaluacion );
		echo json_encode( $hoja_evaluacion );
	}

	function guardarHoja(){
		$this -> modelo -> eliminarHoja( 2 );
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( '12345' );
		$columnas = $_POST['nombre_columnas'];
		$calificaciones = $_POST['calificaciones'];

		array_shift( $columnas );
		array_shift( $calificaciones );
		$columnas_length = count( $columnas );
		$alumnos_length = count( $alumnos );
		
		$id_columna = array();
		for( $i = 0 ; $i < $columnas_length ; ++$i ){
			$id_temp = $this -> modelo -> agregarColumna( $columnas[$i], 2 );
			array_push( $id_columna, $id_temp );
		}

		var_dump( $id_columna );
		$count = 0;
		for( $j = 0 ; $j < $alumnos_length ; $j++ ){
			for( $i = 0 ; $i < $columnas_length ; $i++ ){
				$this -> modelo -> agregarCelda( strtoupper( $calificaciones[$count] ), $id_columna[$i], $alumnos[$j]['codigo'], '12345' );
				$count = $count + 1;
			}
		}
	}


}