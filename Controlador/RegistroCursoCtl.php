<?php

class RegistroCursoCtl {
	private $modelo;

	function ejecutar() {
		require_once( "Modelo/RegistroCursoMdl.php" );
		$this -> modelo = new RegistroCursoMdl();

		switch ( $_GET['act']) {
			case 'alta':
				if( empty( $_POST ) ) {
					require_once( "Vista/RegistroCurso.html" );
				}
				else {

				}
				break;
			case 'carga_academias':
				$deptos_array = $this -> modelo -> obtenerAcademias();
				if( $deptos_array )
					echo json_encode( $deptos_array );
				break;
			case 'carga_ciclos':
				$ciclos_array = $this -> modelo -> obtenerCiclos();
				if( $ciclos_array )
					echo json_encode( $ciclos_array );
				break;
		}
	}
}