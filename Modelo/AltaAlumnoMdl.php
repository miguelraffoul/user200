<?php

class AltaAlumnoMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function alta( $codigo, $nombre, $carrera, $correo, $pass ) {
		$consulta = "INSERT INTO alumno
				(codigo, nombre, carrera, email, activo, password)
				VALUES (
					\"$codigo\",
					\"$nombre\",
					\"$carrera\",
					\"$correo\",
					TRUE,
					\"$pass\"
				)";
		return $this -> bd -> insertar( $consulta );
	}

	function agregarCelular( $codigo, $celular ) {
		$consulta = "UPDATE alumno SET celular = \"$celular\" WHERE codigo = $codigo";
		$this -> bd -> insertar( $consulta );
	}

	function agregarGit( $codigo, $git ) {
		$consulta = "UPDATE alumno SET cuenta_github = \"$git\" WHERE codigo = $codigo";
		$this -> bd -> insertar( $consulta );
	}

	function agregarPagina( $codigo, $pagina ) {
		$consulta = "UPDATE alumno SET pagina_web = \"$pagina\" WHERE codigo = $codigo";
		$this -> bd -> insertar( $consulta );
	}
}