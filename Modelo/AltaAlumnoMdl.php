<?php

class AltaAlumnoMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function buscarAlmuno( $codigo ) {
		$consulta = "SELECT * FROM alumno WHERE codigo = $codigo";
		$resultado = $this -> bd -> consultaEspecifica( $consulta );
		if( $resultado )
			if( $resultado -> num_rows > 0 )
				return $resultado -> fetch_assoc();
		return false;
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

	function actualizarDatos( $codigo, $nombre, $carrera, $correo, $pass, $celular, $git, $pagina ) {
		$consulta = "UPDATE alumno SET
					nombre = \"$nombre\",
					carrera = \"$carrera\",
					email = \"$correo\",
					activo = TRUE,
					password = \"$pass\",
					celular = \"$celular\",
					cuenta_github = \"$git\",
					pagina_web = \"$pagina\"
					WHERE  codigo = $codigo";
		$this -> bd -> insertar( $consulta );			
	}
}