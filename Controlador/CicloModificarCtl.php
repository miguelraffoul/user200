<?php

class CicloModificarCtl{

	private $modelo;

	public function ejecutar(){
		require_once( 'Modelo/CicloModificarMdl.php' );
		$this -> modelo = new CicloModificarMdl();

		switch ($_GET['act']){

			case 'mostrar_pagina':
				$_SESSION['id_ciclo'] = $_POST['id_ciclo'];
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/CicloModificar.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;

			case 'mostrar_datos':
				$this -> mostrarDatos();
				break;

			case "modificar":
				$this -> modificarCiclo(); 
				break;

			default:
				$msj_error = "Acción inválida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}

	}

	function mostrarDatos(){
		$id_ciclo = $_SESSION['id_ciclo'];
		$array_ciclo = $this -> modelo -> obtenerCiclo( $id_ciclo );
		$array_dias = $this -> modelo -> obtenerDiasInhabiles( $id_ciclo );
				
		if( is_array( $array_dias ) )
			echo json_encode( array_merge( $array_ciclo, $array_dias ) );		
		else
			echo json_encode( $array_ciclo );
	}
	

	function modificarCiclo(){

		$ciclo_select = $_POST["ciclo_select"];
		$inicio_ciclo = $_POST["inicio_ciclo"];
		$fin_ciclo = $_POST["fin_ciclo"];
		$fd_inhabil = $_POST["fecha_dia_inhabil"];
		$descripcion = $_POST["descripcion"];

		$fi_ciclo = $this -> darFormatoFecha( $inicio_ciclo ); 
		$ff_ciclo = $this -> darFormatoFecha( $fin_ciclo ); 

		$consulta = $this -> modelo -> actualizarFechaCiclo( $ciclo_select, $fi_ciclo, $ff_ciclo );

		if( $consulta && $this -> modelo -> eliminarDiasInhabiles( $ciclo_select ) ){
			if( is_array( $fd_inhabil ) ){
				array_pop( $fd_inhabil );
				array_pop( $descripcion );

				$longitud = count( $fd_inhabil );
				for( $i = 0 ; $i < $longitud ; $i = $i + 1 ){
					$fd_inhabil[$i] = $this -> darFormatoFecha( $fd_inhabil[$i] );
					$descripcion[$i] = trim( $descripcion[$i] );
					if( !$this -> modelo -> agregarDiaInhabil( $ciclo_select, $fd_inhabil[$i], $descripcion[$i] ) ){
						require_once( 'Vista/Error.html' );
						return FALSE;
					}
				}
			}
		}
		else{
			require_once( 'Vista/Error.html' );
			return FALSE;
		}

		require_once( 'Vista/CicloEscolar.html' );
		return TRUE;
	}



	function darFormatoFecha( $fecha ){

		$fecha_datos = explode( "/", $fecha );
		return $fecha_datos[2] . "-" . $fecha_datos[1] . "-" . $fecha_datos[0];
	}

}