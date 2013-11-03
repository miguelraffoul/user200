<?php

switch( $_GET["ctl"] ){
	case "login":
		require_once( "Controlador/LogInCtl.php" );
		$ctl = new LogInCtl();
		break;
	case "ciclo_escolar":
		require_once( "Controlador/CicloEscolarCtl.php" );
		$ctl = new CicloEscolarCtl();
		break;
	case "ciclo_nuevo":
		require_once( "Controlador/CicloNuevoCtl.php" );
		$ctl = new CicloNuevoCtl();
		break;
	case "profesor":
		require_once( "Controlador/ProfesorCtl.php" );
		$ctl = new ProfesorCtl();
		break;
	case "alumno":
		require_once( "Controlador/AlumnoCtl.php" );
		$ctl = new AlumnoCtl();
		break;
}

$ctl -> ejecutar();