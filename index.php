<?php 	

session_start();

switch( $_GET["ctl"] ){
	case "login":
		require_once( "Controlador/LogInCtl.php" );
		$ctl = new LogInCtl();
		break;
	case "recuperar_contrasenia":
		require_once( "Controlador/RecuperarPassCtl.php" );
		$ctl = new RecuperarPassCtl();
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
	case "clonar_curso":
		require_once( "Controlador/ClonarCursoCtl.php" );
		$ctl = new ClonarCursoCtl();
		break;
	case "modificar_curso":
		require_once( "Controlador/ModificarCursoCtl.php" );
		$ctl = new ModificarCursoCtl();
		break;
	case "alta_alumno":
		require_once( "Controlador/AltaAlumnoCtl.php" );
		$ctl = new AltaAlumnoCtl();
		break;
	case "lista_alumnos":
		require_once( "Controlador/ListaAlumnosCtl.php" );
		$ctl = new ListaAlumnosCtl();
		break;
	case "modificar_alumno":
		require_once( "Controlador/ModificarAlumnoCtl.php" );
		$ctl = new ModificarAlumnoCtl();
		break;
	case "asistencias":
		require_once( "Controlador/AsistenciasCtl.php" );
		$ctl = new AsistenciasCtl();
		break;
	case "alumno":
		require_once( "Controlador/AlumnoCtl.php" );
		$ctl = new AlumnoCtl();
		break;
	case "rubro":
		require_once( "Controlador/RubroCtl.php" );
		$ctl = new RubroCtl();
		break;

	case "hoja_evaluacion":
		require_once( "Controlador/HojaEvaluacionCtl.php" );
		$ctl = new HojaEvaluacionCtl();
}

$ctl -> ejecutar();