<?php

class HojaEvaluacionCtl{
	private $modelo;

	public function ejecutar(){

		require_once( 'Modelo/HojaEvaluacionMdl.php' );
		$this -> modelo = new HojaEvaluacionMdl();

		switch( $_GET['act'] ){

			case 'mostrar_pagina':
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/HojaEvaluacion.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
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
				$msj_error = "Acción inválida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}
	}


	function mostrarDatos( $id_curso, $id_rubro ){
		$columnas = $this -> modelo -> obtenerColumnasNombreId( $id_rubro ); 
		$alumnos = $this -> modelo -> obtenerAlumnosNombreId( $id_curso );
		$nombre_rubro = $this -> modelo -> obtenerNombreRubro( $id_rubro );
		
		if( is_array( $alumnos ) )
			$alumnos_length = count( $alumnos );
		else
			$alumnos_length = 0;
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
		//echo json_encode( $alumnos_length );
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
		$this -> calcularPromedioAlumnos( $id_curso, $alumnos );
		
		header( "Location: index.php?ctl=curso_profesor&act=mostrar_pagina" );
	}

	function mostrarPagina( $vista, $msj_nuevo, $msj_reemplazar ){
		$vista_desplegar = file_get_contents(  $vista );
		$vista_desplegar = str_replace( $msj_reemplazar, $msj_nuevo, $vista_desplegar );
		echo $vista_desplegar;
	}

	function calcularPromedioAlumnos( $id_curso, $alumnos ){
		$alumnos_length = count( $alumnos );
		for( $i = 0 ; $i < $alumnos_length ; ++$i ){
			$promedios = $this -> modelo -> obtenerPromediosAlumno( $id_curso, $alumnos[$i]['codigo'] );
			$promedios_length = count( $promedios );
			$suma_promedios = 0;
			for( $j = 0 ; $j < $promedios_length ; ++$j )
				$suma_promedios = $suma_promedios + $promedios[$j]['calificacion'];
			$promedio_total = number_format( $suma_promedios / $promedios_length, 1);
			$resultado = $this -> modelo -> guardarPromedioCurso( $id_curso, $alumnos[$i]['codigo'], 
													  			  $promedio_total );
		}
	}

}