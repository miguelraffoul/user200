<?php

class AsistenciasCtl {
	private $modelo;

	function ejecutar() {
		require_once( "Modelo/AsistenciasMdl.php" );
		$this -> modelo = new AsistenciasMdl();

		switch ( $_GET['act'] ) {
			case "mostrar_datos":
				require_once( "Vista/Asistencias.html" );
				break;
			case "carga_alumnos":
				$lista_alumnos = $this -> modelo -> obtenerAlumnos( $_SESSION['clave_curso'] );
				echo json_encode( $lista_alumnos );
				break;
			case "obtener_ciclo":
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