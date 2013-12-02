<?php

class RubroCtl{

	private $modelo;

	public function ejecutar(){

		require_once("Modelo/RubroMdl.php");
		$this -> modelo = new RubroMdl();

		switch ($_GET['act']){

			/*case "mostrar_pagina":
				$_SESSION['id_rubro'] = $_POST['nombre_rubro'];							
				require_once("Vista/RubroEvaluacion.html");
				break;

			case "datos_rubro":
				$this -> mostrarRubro();
				break;*/

			case "agregar_rubro":
				if(empty($_POST))
					require_once("Vista/RubroEvaluacion.html");
				else{
					$this -> nuevoRubro( $_SESSION['clave_curso']);
				}
				break;

			default:
				require_once("Vista/Error.html");
		}
	}

	/*function mostrarRubro(){		
		$id_rubro = $_SESSION['id_rubro'];
		$nombre_rubro = $this -> modelo -> obtenerNombreRubro( $id_rubro );
		
		$array_dias = $this -> modelo -> obtenerDiasInhabiles( $id_ciclo );
				
		if( is_array( $array_dias ) )
			echo json_encode( array_merge( $array_ciclo, $array_dias ) );		
		else
			echo json_encode( $array_ciclo );	
	}*/

	function nuevoRubro( $id_curso ){
		var_dump( $_POST );
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
		 	require_once("Vista/CursoProfesor.html");
		 }
		 else
		 	require_once("Vista/Error.html");
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