<?php

class ProfesorMdl {
	private $bd;

	public function __construct() {
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}
	
	public function obtenerCursos( $profesor ) {
		$consulta = "SELECT c.clave_curso, c.nombre FROM curso AS c, cicloescolar AS c_e 
					WHERE c.activo = TRUE 
					AND c.Profesor_codigo = \"$profesor\"
					AND c.CicloEscolar_idCicloEscolar = c_e.idCicloEscolar
					AND c_e.activo = TRUE";
		$cursos_array = $this -> bd -> consultaGeneral( $consulta );

		return $cursos_array;
	}

	public function eliminarCurso( $id_curso ) {
		$consulta = "UPDATE curso SET activo = FALSE WHERE clave_curso = \"$id_curso\"";
		$this -> bd -> consultaEspecifica( $consulta );
	} 
}