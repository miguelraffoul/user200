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
				$cursos = $this -> modelo -> obtenerCursos();
				if( $cursos )
					echo json_encode( $cursos ); 
				break;
			case "eliminar_curso":
				$id_curso = $_POST['curso'];
				$this -> modelo -> eliminarCurso( $id_curso );
				break;
		}
	}
}