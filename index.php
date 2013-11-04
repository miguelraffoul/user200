<?php 	

switch( $_GET["ctl"] ){
	case "login":
		require_once( "Controlador/LogInCtl.php" );
		$ctl = new LogInCtl();
		break;
	case "cambiar_contrasenia":
		require_once( "Controlador/CambioContraCtl.php" );
		$ctl = new CambioContraCtl();
		break;
	case "ciclo_escolar":
		require_once( "Controlador/CicloEscolarCtl.php" );
		$ctl = new CicloEscolarCtl();
		break;
	case "ciclo_nuevo":
		require_once( "Controlador/CicloNuevoCtl.php" );
		$ctl = new CicloNuevoCtl();
		break;
	case "ciclo_modificar":
		require_once( "Controlador/CicloModificarCtl.php" );
		$ctl = new CicloModificarCtl();
		break;
	case "profesor":
		require_once( "Controlador/ProfesorCtl.php" );
		$ctl = new ProfesorCtl();
		break;
	case "curso_profesor":	
		require_once( "Controlador/CursoProfesorCtl.php" );
		$ctl = new CursoProfesorCtl();
		break;
	case "registro_curso":
		require_once( "Controlador/RegistroCursoCtl.php" );
		$ctl = new RegistroCursoCtl();
		break;
	case "alta_alumno":
		require_once( "Controlador/AltaAlumnoCtl.php" );
		$ctl = new AltaAlumnoCtl();
		break;
	case "alumno":
		require_once( "Controlador/AlumnoCtl.php" );
		$ctl = new AlumnoCtl();
		break;
	case "rubro":
		require_once( "Controlador/RubroCtl.php" );
		$ctl = new RubroCtl();
		break;
}

$ctl -> ejecutar();