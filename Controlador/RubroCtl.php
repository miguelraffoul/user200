<?php

class RubroCtl{

	private $modelo;

	public function ejecutar(){

		require_once("Modelo/RubroMdl.php");
		$this -> modelo = new RubroMdl();

		switch ($_GET['act']){

			case "mostrar_pagina":
				$_SESSION['id_rubro'] = $_POST['nombre_rubro'];							
				require_once("Vista/RubroEvaluacion.html");
				break;

			case "datos_rubro":
				$this -> mostrarRubro();
				break;

			case "eliminar_rubro":
				$nombre = $_POST['nombre'];
				$this -> modelo -> eliminarAlumno( $nombre );
				break;

			case "agregar_rubro":
				if(empty($_POST))
					require_once("Vista/RubroEvaluacion.html");
				else
					$this -> nuevoRubro();
				break;

			default:
				require_once("Vista/Error.html");
		}
	}

	function mostrarRubro(){		
		$id_rubro = $_SESSION['id_rubro'];
		$nombre_rubro = $this -> modelo -> obtenerNombreRubro( $id_rubro );
		
	/*	$array_dias = $this -> modelo -> obtenerDiasInhabiles( $id_ciclo );
				
		if( is_array( $array_dias ) )
			echo json_encode( array_merge( $array_ciclo, $array_dias ) );		
		else
			echo json_encode( $array_ciclo );	*/
	}

	function nuevoRubro(){

		$nombre_rubro = $_POST["nombre_rubro"];
		$valor_rubro = $_POST["valor_rubro"];

		$resultado = 0;
		if( array_key_exists( "tiene_hoja", $_POST ) ){
			$tiene_hoja = $_POST["tiene_hoja"];
			$columnas = $_POST["columnas_rubro"];
			$resultado = $this -> modelo -> agregarRubro( $nombre_rubro, $valor_rubro, 1, $columnas );
		}
		else
			$resultado = $this -> modelo -> agregarRubro( $nombre_rubro, $valor_rubro, 0, 0 );

		

		if($resultado!==FALSE)
			require_once("Vista/CursoProfesor.html");
		else
			require_once("Vista/Error.html");
	}
}