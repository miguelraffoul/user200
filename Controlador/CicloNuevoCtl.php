<?php

class CicloNuevoCtl{

	private $modelo;

	public function ejecutar(){

		require_once("Modelo/CicloNuevoMdl.php");
		$this -> modelo = new CicloNuevoMdl();

		switch ($_GET['act']){

			case "agregar_ciclo":
				if(empty($_POST))
					require_once("Vista/CicloNuevo.html");
				else
					$this -> nuevoCiclo();
				break;

			default:
				require_once("Vista/Error.html");
		}
	}


	function nuevoCiclo(){

		$ciclo_select = $_POST["ciclo_select"];

		if( is_array( $this -> modelo -> existe( $ciclo_select ) ) ){
			if( is_array( $this -> modelo -> estaActivo( $ciclo_select ) ) )
				require_once("Vista/Error.html");
			else
				$this -> actualizarCiclo( $ciclo_select );
		}
		else
			$this -> agregarCiclo( $ciclo_select );
	}


	function actualizarCiclo( $id_ciclo ){
		$inicio_ciclo = $_POST["inicio_ciclo"];
		$fin_ciclo = $_POST["fin_ciclo"];
		$fd_inhabil = $_POST["fecha_dia_inhabil"];
		$descripcion = $_POST["descripcion"];

		array_pop( $fd_inhabil );
		array_pop( $descripcion );

		$fi_ciclo = $this -> darFormatoFecha( $inicio_ciclo ); 
		$ff_ciclo = $this -> darFormatoFecha( $fin_ciclo );
		 
		if( $this -> modelo -> actualizarFechaCiclo( $id_ciclo, $fi_ciclo, $ff_ciclo ) &&
			$this -> modelo -> eliminarDiasInhabiles( $id_ciclo ) ){
			$longitud = count( $fd_inhabil );
			for( $i = 0 ; $i < $longitud ; $i = $i + 1 ){
				$fd_inhabil[$i] = $this -> darFormatoFecha( $fd_inhabil[$i] );
				$descripcion[$i] = trim( $descripcion[$i] );
				if( !$this -> modelo -> agregarDiaInhabil( $id_ciclo, $fd_inhabil[$i], $descripcion[$i] ) ){
					require_once( 'Vista/Error.html' );
					return FALSE;
				}
			}
		}
		else{
			require_once( 'Vista/Error.html' );
			return FALSE;
		}

		require_once("Vista/CicloEscolar.html");
		return TRUE;
	}


	function agregarCiclo( $id_ciclo ){
		$inicio_ciclo = $_POST["inicio_ciclo"];
		$fin_ciclo = $_POST["fin_ciclo"];
		$fd_inhabil = $_POST["fecha_dia_inhabil"];
		$descripcion = $_POST["descripcion"];

		array_pop( $fd_inhabil );
		array_pop( $descripcion );

		$fi_ciclo = $this -> darFormatoFecha( $inicio_ciclo ); 
		$ff_ciclo = $this -> darFormatoFecha( $fin_ciclo );
		 
		if( $this -> modelo -> agregarFechaCiclo( $id_ciclo, $fi_ciclo, $ff_ciclo ) ){
			$longitud = count( $fd_inhabil );
			for( $i = 0 ; $i < $longitud ; $i = $i + 1 ){
				$fd_inhabil[$i] = $this -> darFormatoFecha( $fd_inhabil[$i] );
				$descripcion[$i] = trim( $descripcion[$i] );
				if( !$this -> modelo -> agregarDiaInhabil( $id_ciclo, $fd_inhabil[$i], $descripcion[$i] ) ){
					require_once( 'Vista/Error.html' );
					return FALSE;
				}
			}
		}
		else{
			require_once( 'Vista/Error.html' );
			return FALSE;
		}

		require_once("Vista/CicloEscolar.html");
		return TRUE;
	}


	function darFormatoFecha( $fecha ){

		$fecha_datos = explode( "/", $fecha );
		return $fecha_datos[2] . "-" . $fecha_datos[1] . "-" . $fecha_datos[0];
	}

}