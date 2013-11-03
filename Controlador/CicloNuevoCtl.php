<?php

class CicloNuevoCtl{

	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CicloNuevoMdl.php");
		$this -> modelo = new CicloNuevoMdl();

		switch ($_GET['act']){

			case "agregar_ciclo":

				if(empty($_POST)){
					require_once("Vista/CicloNuevo.html");
				}
				else{

					
					$ciclo_select = $_POST["ciclo_select"];
					$inicio_ciclo = $_POST["inicio_ciclo"];
					$fin_ciclo = $_POST["fin_ciclo"];
					$fd_inhabil = $_POST["fecha_dia_inhabil"];
					$descripcion = $_POST["descripcion"];

					array_pop( $fd_inhabil );
					array_pop( $descripcion );

					$fi_ciclo = $this -> darFormatoFecha( $inicio_ciclo ); 
					$ff_ciclo = $this -> darFormatoFecha( $fin_ciclo ); 

					$longitud = count( $fd_inhabil );
					for( $i = 0 ; $i < $longitud ; $i = $i + 1 ){
						$fd_inhabil[$i] = $this -> darFormatoFecha( $fd_inhabil[$i] );
						$descripcion[$i] = trim( $descripcion[$i] );
					}

					$resultado = $this -> modelo -> agregarCiclo($ciclo_select, $fi_ciclo, $ff_ciclo, $fd_inhabil, $descripcion);

					if($resultado!==FALSE)
						require_once("Vista/CicloEscolar.html");
					else
						require_once("Vista/Error.html");
				}
				break;

			default:
				require_once("Vista/404.html");
		}
	}


	function darFormatoFecha( $fecha ){

		$fecha_datos = explode( "/", $fecha );
		return $fecha_datos[2] . "-" . $fecha_datos[1] . "-" . $fecha_datos[0];
	}

}