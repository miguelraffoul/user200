<?php

class ModificarCursoCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ModificarCursoMdl.php" );
		$this -> modelo = new ModificarCursoMdl();

		switch ( $_GET['act'] ) {
			case 'mostar_datos':
				$_SESSION['clave_curso'] = $_POST['clave_curso'];
				require_once( "Vista/ModificarCurso.html" );
				break;
			case 'cargar_datos':
				$clave = $_SESSION['clave_curso'];
				$resultado = $this -> modelo -> obtenerDatosCurso( $clave );
				echo json_encode( $resultado );
				break;
			case 'cargar_asignatura':
				$idAsignatura = $_POST['asignatura'];
				$resultado = $this -> modelo -> obtenerDatosAsignatura( $idAsignatura );
				echo json_encode( $resultado );
			case 'guardar_cambios':
				break;
		}
	}
}