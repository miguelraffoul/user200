<?php

class AltaAlumnoCtl {
	private $modelo;

	private function generarPass(){
		$fecha = getdate();
		$fecha_string = implode( "", $fecha );
		$nuevo_pass = substr( str_shuffle( $fecha_string ), 0, 8 );
		return $nuevo_pass;
	}

	public function ejecutar() {
		require_once( "Modelo/AltaAlumnoMdl.php" );
		$this -> modelo = new AltaAlumnoMdl();

		if( empty( $_POST ) ) {
			require_once( "Vista/AltaAlumno.html" );
		}
		else {
			$nombre = $_POST["nombre"];
			$codigo = $_POST["codigo"];
			$carrera = $_POST["ingenierias"];
			$correo = $_POST["mail"];
			$pass = $this -> generarPass();
			$celular = $_POST["celular"];
			$git = $_POST["cuenta_git"];
			$pagina = $_POST["pagina_web"];

			$resultado = $this -> modelo -> alta( trim( $codigo ), trim( $nombre ), $carrera, trim( $correo ), sha1( $pass ) );
			if( $resultado !== FALSE ) {
				if( $celular !== "" ) {
					$this -> modelo -> agregarCelular( $codigo, $celular );
				}
				if( $git !== "" ) {
					$this -> modelo -> agregarGit( $codigo, trim( $git ) );
				}
				if( $pagina !== "" ) {
					$this -> modelo -> agregarPagina( $codigo, trim( $pagina ) );
				}
				header( "Location: index.php?ctl=lista_alumnos&act=lista" );
			}
			else {
				require_once( "Vista/Error.html" );
			}
		}
	}
}