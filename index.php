<?php

switch($_GET["ctl"]){
	case "login":
		require_once("Controlador/LogInCtl.php");
		$ctl = new LogInCtl();
		break;
	case "":
		break;
	case "":
		break;
}

$ctl -> ejecutar();