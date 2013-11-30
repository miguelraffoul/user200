<?php

class ClonarCursoCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ClonarCursoMdl.php" );
		$this -> modelo = new ClonarCursoMdl();

		switch ( $_GET['act'] ) {
			case 'mostar_datos':
				$_SESSION['clave_curso'] = $_POST['clave_curso'];
				require_once( "Vista/ClonarCurso.html" );
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
				break;
			case 'cargar_dias_clase':
				$clave = $_SESSION['clave_curso'];
				$resultado = $this -> modelo -> obtenerDiasClase( $clave );
				echo json_encode( $resultado );
				break;
			case 'guardar_cambios':
				
				header( "Location: index.php?ctl=profesor&act=cursos" );
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