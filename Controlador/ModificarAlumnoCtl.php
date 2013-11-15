<?php

class ModificarAlumnoCtl{
	private $modelo;

	public function ejecutar(){
		require_once( "Modelo/ModificarAlumnoMdl.php" );
		$this -> modelo = new ModificarAlumnoMdl();

		switch ( $_GET['act'] ){
			case 'mostar_datos':
				$_SESSION['codigo_alumno'] = $_POST['codigo'];
				require_once( "Vista/ModificarA.html" );
				break;
			case 'cargar_datos':
				$codigo = $_SESSION['codigo_alumno'];
				$resultado = $this -> modelo -> obtenerDatosAlumno( $codigo );
				echo json_encode( $resultado );
				break;
		}
	}
}