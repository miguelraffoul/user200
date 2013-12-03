<?php

class ProfesorCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ProfesorMdl.php" );
		$this -> modelo = new ProfesorMdl();
		switch( $_GET['act'] ) {
			case "cursos":
				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$vista = file_get_contents( "Vista/Profesor.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				echo $vista;
				break;
			case "carga_cursos":
				$cursos = $this -> modelo -> obtenerCursos( $_SESSION['codigo_usuario'] ); //Implementar sesiones con id profesor
				if( $cursos )
					echo json_encode( $cursos ); 
				break;
			case "eliminar_curso":
				$id_curso = $_POST['curso'];
				$this -> modelo -> eliminarCurso( $id_curso );
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