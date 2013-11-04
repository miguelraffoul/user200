<?php

class ProfesorCtl {
	private $modelo;

	public function ejecutar() {
		require_once( "Modelo/ProfesorMdl.php" );
		$this -> modelo = new ProfesorMdl();
		switch( $_GET['act'] ) {
			case "ciclos":
				require_once( "Vista/Profesor.html" );
				break;
			case "cargar_ciclos":
				$cursos = $this -> modelo -> cargarCiclos();
				if( $cursos )
					echo json_encode( $cursos ); 
				break;
		}
	}
}