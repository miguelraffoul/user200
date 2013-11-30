<?php

class ProfesorCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ProfesorMdl.php" );
		$this -> modelo = new ProfesorMdl();
		switch( $_GET['act'] ) {
			case "cursos":
				require_once( "Vista/Profesor.html" );
				break;
			case "carga_cursos":
				$cursos = $this -> modelo -> obtenerCursos( "424242" ); //Implementar sesiones con id profesor
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