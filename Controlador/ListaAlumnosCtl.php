<?php

class ListaAlumnosCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ListaAlumnosMdl.php" );
		$this -> modelo = new ListaAlumnosMdl();

		switch( $_GET['act'] ) {
			case "lista":
				$vista = file_get_contents( "Vista/ModificarEliminar.html" );
				$vista = str_replace( "&lt;Nombre Curso&gt;", $_SESSION['nombre_curso'], $vista );
				echo $vista;
				break;
			case "carga_alumnos":
				$lista_alumnos = $this -> modelo -> obtenerAlumnos();
				if( $lista_alumnos )
					echo json_encode( $lista_alumnos );
				break;
			case "eliminar_alumno":
				$codigo = $_POST['codigo'];
				$curso = $_SESSION['clave_curso'];
				$this -> modelo -> eliminarAlumno( $codigo );
				break;
		}
	}
}