<?php

class ModificarAlumnoMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	public function obtenerDatosAlumno( $codigo ) {
		$consulta = "SELECT * FROM alumno WHERE codigo = \"$codigo\"";
		return $this -> bd -> consultaGeneral( $consulta ); 
	}

	public function actualizarNombre( $codigo, $nombre ) {
		$consulta = "UPDATE alumno SET nombre = \"$nombre\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	public function actualizarCarrera( $codigo, $carrera ) {
		$consulta = "UPDATE alumno SET carrera = \"$carrera\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	public function actualizarCorreo( $codigo, $correo ) {
		$consulta = "UPDATE alumno SET email = \"$correo\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	public function actualizarCelular( $codigo, $celular ) {
		$consulta = "UPDATE alumno SET celular = \"$celular\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	public function actualizarGit( $codigo, $git ) {
		$consulta = "UPDATE alumno SET cuenta_github = \"$git\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	public function actualizarPagina( $codigo, $pagina ) {
		$consulta = "UPDATE alumno SET pagina_web = \"$pagina\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}
}