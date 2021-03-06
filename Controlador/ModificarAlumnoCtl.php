<?php

class ModificarAlumnoCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ModificarAlumnoMdl.php" );
		$this -> modelo = new ModificarAlumnoMdl();

		switch ( $_GET['act'] ) {
			case 'mostar_datos':
				$_SESSION['codigo_alumno'] = $_POST['codigo'];

				$nombre = explode( " ", $_SESSION['nombre_usuario'] );
				$curso = $_SESSION['nombre_curso'];
				$vista = file_get_contents( "Vista/ModificarA.html" );
				$vista = str_replace( "&lt;Nombre&gt;", $nombre[0], $vista );
				$vista = str_replace( "&lt;Nombre Curso&gt;", $curso, $vista );
				echo $vista;
				break;
			case 'cargar_datos':
				$codigo = $_SESSION['codigo_alumno'];
				$resultado = $this -> modelo -> obtenerDatosAlumno( $codigo );
				echo json_encode( $resultado );
				break;
			case 'guardar_cambios':
				$nombre = $_POST["nombre"];
				$codigo = $_SESSION['codigo_alumno'];
				$carrera = $_POST["ingenierias"];
				$correo = $_POST["mail"];
				$celular = $_POST["celular"];
				$git = $_POST["cuenta_git"];
				$pagina = $_POST["pagina_web"];
				
				$this -> modelo -> actualizarNombre( $codigo, trim( $nombre ) );
				$this -> modelo -> actualizarCarrera( $codigo, $carrera );
				$this -> modelo -> actualizarCorreo( $codigo, trim( $correo ) );
				$this -> modelo -> actualizarCelular( $codigo, $celular );
				$this -> modelo -> actualizarGit( $codigo, trim( $git ) );
				$this -> modelo -> actualizarPagina( $codigo, trim( $pagina ) );

				header( "Location: index.php?ctl=lista_alumnos&act=lista" ); 
				break;
		}
	}
}