<?php

switch($_GET["ctl"]){
	case "login":
		require_once("Controlador/LogInCtl.php");
		$ctl = new LogInCtl();
		break;
	
	case "ciclo_nuevo":
		require_once("Controlador/CicloNuevoCtl.php");
		$ctl = new CicloNuevoCtl();
		break;

	case "":
		break;
}

$ctl -> ejecutar();