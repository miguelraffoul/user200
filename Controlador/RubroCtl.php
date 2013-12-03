<?php

class RubroCtl{

	private $modelo;

	public function ejecutar(){

		require_once("Modelo/RubroMdl.php");
		$this -> modelo = new RubroMdl();

		switch ($_GET['act']){

			case "agregar_rubro":
				if( !empty($_POST) )
					$this -> nuevoRubro( $_SESSION['clave_curso']);
				
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/RubroEvaluacion.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;

			default:
				$msj_error = "Acción inválida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
		}
	}

	function nuevoRubro( $id_curso ){
		$nombre_rubro = $_POST['nombre_rubro'];
		$valor_rubro = $_POST['valor_rubro'];

		$tiene_columnas_extra;
		$num_columnas_extra;
		if( array_key_exists( "tiene_columnas_extra", $_POST ) ){
			$tiene_columnas_extra = true;
			$num_columnas_extra = $_POST["columnas_extra"];
		}
		else{
			$tiene_columnas_extra = false;
			$num_columnas_extra = 0 ;
		}

		 $id_rubro = $this -> modelo -> agregarRubro( $nombre_rubro, $valor_rubro, $tiene_columnas_extra, 
												      $num_columnas_extra + 1, $id_curso );

		 if( $id_rubro !== FALSE ){
		 	$this -> agregarHojaEval( $id_rubro, $num_columnas_extra + 1, $id_curso );
		 	header( "Location: index.php?ctl=curso_profesor&act=mostrar_pagina" );
		 }
		 else{
		 	$msj_error = "No se agregó rubro correctamente.";
			$vista = file_get_contents( "Vista/Error.html" );
			$vista = str_replace( "{ERROR}", $msj_error, $vista );
			echo $vista;
		 }
	}

	
	function agregarHojaEval( $id_rubro, $columnas_length, $id_curso ){
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
	}

}