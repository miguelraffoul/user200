<?php

class CambioContraCtl {
	private $modelo;

	function ejecutar() {
		require_once( "Modelo/CambioContraMdl.php" );
		$this -> modelo = new CambioContraMdl();
	
		if( empty( $_POST ) ) {
			require_once( "Vista/CambioContrasena.html" );
		}
		else {
			$actual = $_POST['pass_actual'];
			$nueva = $_POST['nuevo_pass'];
			$confirmacion = $_POST['confirmacion'];

			if( !$this -> modelo -> esAdministrador( $actual, $nueva ) ) { 
				if( !$this -> modelo -> esProfesor( $actual, $nueva ) ) {
					$this -> modelo -> esAlumno( $actual, $nueva );
				}
			}

			header( "Location: index.php?ctl=login" );			
		}
	}
}