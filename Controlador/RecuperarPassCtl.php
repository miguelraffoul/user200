<?php

class RecuperarPassCtl {
	private $modelo;

	private function generarPass() {
		$fecha = getdate();
		$fecha_string = implode( "", $fecha );
		$nuevo_pass = substr( str_shuffle( $fecha_string ), 0, 8 );
		return $nuevo_pass;
	}

	public function ejecutar() {
		require_once( "Modelo/RecuperarPassMdl.php" );
		$this -> modelo = new RecuperarPassMdl();

		if( empty( $_POST ) ) {
			require_once( "Vista/Recupera.html" );
		}
		else {
			$correo = $_POST['mail'];
			$pass = $this -> generarPass();

			$vista = file_get_contents( "Vista/EnvioRecupera.html" );
			$vista = str_replace( "{correo}", $correo, $vista );

			require_once( "SmartMail.php" );
			$mail = new SmartMail();

			if( $this -> modelo -> cambiarPasswordAlumno( $correo, sha1( $pass ) ) ) {
				$mail -> enviarNuevoPassword( $pass, $correo );
				echo $vista;
			}
			else if( $this -> modelo -> cambiarPasswordProfesor( $correo, sha1( $pass ) ) ) {
				$mail -> enviarNuevoPassword( $pass, $correo );
				echo $vista;			
			}
			else if( $this -> modelo -> cambiarPasswordAdministrador( $correo, sha1( $pass ) ) ) {
				$mail -> enviarNuevoPassword( $pass, $correo );
				echo $vista;			
			}
			else {
				require_once( "Vista/Error.html" );
			}
		}
	}
}