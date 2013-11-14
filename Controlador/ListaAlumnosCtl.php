<?php

class ListaAlumnosCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ListaAlumnosMdl.php" );
		$this -> modelo = new ListaAlumnosMdl();

		switch( $_GET['act'] ) {
			case "lista":
				require_once( "Vista/ModificarEliminar.html" );
				break;
			case "carga_alumnos":
				$lista_alumnos = $this -> modelo -> obtenerAlumnos();
				if( $lista_alumnos )
					echo json_encode( $lista_alumnos );
				break;
			case "eliminar_alumno":
				$codigo = $_POST['codigo'];
				$this -> modelo -> eliminarAlumno( $codigo );
				break;
		}
	}
}