<?php

class AltaAlumnoMdl {
	private $bd;

	function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function buscarAlmuno( $codigo ) {
		$consulta = "SELECT * FROM alumno WHERE codigo = \"$codigo\"";
		$resultado = $this -> bd -> consultaEspecifica( $consulta );
		if( $resultado )
			if( $resultado -> num_rows > 0 )
				return $resultado -> fetch_assoc();
		return false;
	}

	function alta( $codigo, $nombre, $carrera, $correo, $pass ) {
		$consulta = "INSERT INTO alumno
				(codigo, nombre, carrera, email, password)
				VALUES (
					\"$codigo\",
					\"$nombre\",
					\"$carrera\",
					\"$correo\",
					\"$pass\"
				)";
		return $this -> bd -> insertar( $consulta );
	}

	function agregarCelular( $codigo, $celular ) {
		$consulta = "UPDATE alumno SET celular = \"$celular\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	function agregarGit( $codigo, $git ) {
		$consulta = "UPDATE alumno SET cuenta_github = \"$git\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	function agregarPagina( $codigo, $pagina ) {
		$consulta = "UPDATE alumno SET pagina_web = \"$pagina\" WHERE codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );
	}

	function actualizarDatos( $codigo, $nombre, $carrera, $correo, $pass, $celular, $git, $pagina ) {
		$consulta = "UPDATE alumno SET
					nombre = \"$nombre\",
					carrera = \"$carrera\",
					email = \"$correo\",
					password = \"$pass\",
					celular = \"$celular\",
					cuenta_github = \"$git\",
					pagina_web = \"$pagina\"
					WHERE  codigo = \"$codigo\"";
		$this -> bd -> insertar( $consulta );			
	}

	function buscarCursoLigado( $codigo ){
		$consulta = "SELECT * FROM alumno_has_curso WHERE Alumno_codigo = \"$codigo\"";;
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function ligarCurso( $codigo, $curso ) {
		$consulta = "INSERT INTO alumno_has_curso (Alumno_codigo, Curso_clave_curso, activo, promedio)
					 VALUES( \"$codigo\", \"$curso\",TRUE ,0.0)";
		return $this -> bd -> insertar( $consulta );
	}

	public function activarLigaCurso( $codigo, $curso ) {
		$consulta = "UPDATE alumno_has_curso SET activo = TRUE WHERE Alumno_codigo = \"$codigo\" AND Curso_clave_curso= \"$curso\"";
		return $this -> bd -> consultaEspecifica( $consulta );
	}
}