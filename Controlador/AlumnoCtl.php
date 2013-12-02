<?php

class AlumnoCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/AlumnoMdl.php" );
		$this -> modelo = new AlumnoMdl();

		switch ( $_GET['act'] ) {
			case 'mostrar_datos':
				require_once( "Vista/Alumno.html" );
				break;
			
			default:
				$msj_error = "Acción invalida";
				$vista = file_get_contents( "Vista/Error.html" );
				$vista = str_replace( "{ERROR}", $msj_error, $vista );
				echo $vista;
				break;
		}
	}
}