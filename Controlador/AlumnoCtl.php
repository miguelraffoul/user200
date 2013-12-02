<?php

class AlumnoCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/AlumnoMdl.php" );
		$this -> modelo = new AlumnoMdl();

		switch ( $_GET['act'] ) {
			case 'mostrar_datos':
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/Alumno.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;
			case 'cargar_datos':
				$datos_cursos = $this -> modelo -> obtenerDatosCursos( $_SESSION['codigo_usuario'] );
				echo json_encode( $datos_cursos );
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