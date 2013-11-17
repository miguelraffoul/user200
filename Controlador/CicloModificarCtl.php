<?php

class CicloModificarCtl{

	private $modelo;

	public function ejecutar(){
		require_once( 'Modelo/CicloModificarMdl.php' );
		$this -> modelo = new CicloModificarMdl();

		switch ($_GET['act']){

			case 'mostrar_pagina':
				$_SESSION['id_ciclo'] = $_POST['id_ciclo'];
				require_once( 'Vista/CicloModificar.html');
				break;

			case 'mostrar_datos':
				$id_ciclo = $_SESSION['id_ciclo'];
				$array_ciclo = $this -> modelo -> obtenerCiclo( $id_ciclo );
				$array_dias = $this -> modelo -> obtenerDiasInhabiles( $id_ciclo );
				
				if( $array_dias === false )
					echo json_encode( $array_ciclo );		
				else
					echo json_encode( array_merge( $array_ciclo, $array_dias ) );
				break;

			case "modifica_ciclo":
				/*$id_ciclo = $_POST[ 'id_ciclo' ];
				$consulta_exitosa = $this -> modelo -> objeterCiclo( $id_ciclo );*/				
				break;

			default:
				require_once( "Vista/Error.html" );
		}

	}
}