<?php

class RegistroCursoCtl {
	private $modelo;

	private function altaCurso() {
		$nombre = trim( $_POST['nombre'] );
		$seccion = trim( $_POST['seccion'] );
		$nrc = trim( $_POST['nrc'] );
		$academia = $_POST['academia'];
		$ciclo = $_POST['ciclo'];
		$dia = $_POST['dia'];
		$horas_dia = $_POST['horas_dia'];
		$hora_inicio = $_POST['hora_inicio'];

		if( $this -> modelo -> agregarCurso( $nrc, $nombre, $seccion, $ciclo, "424242" ) ) {
			if( $academia != "0" ){
				$this -> modelo -> agregarAcademia( $nrc, $academia );
			}
			array_shift( $dia );
			array_shift( $horas_dia );
			array_shift( $hora_inicio );
			for( $i = 0; $i < count( $dia ); ++$i ){
				$array = explode( ":", $hora_inicio[$i] );
				$array[0] = $array[0] + $horas_dia[$i];
				$hora_fin = implode( ":", $array );
				$this -> modelo -> agregarDiaClase( $nrc, $dia[$i], $hora_inicio[$i], $hora_fin );
			}
			header( "Location: index.php?ctl=profesor" );
		}
		else {
			require_once( "Vista/Error.html" );
		}
	}

	public function ejecutar() {
		require_once( "Modelo/RegistroCursoMdl.php" );
		$this -> modelo = new RegistroCursoMdl();

		switch ( $_GET['act']) {
			case 'alta':
				if( empty( $_POST ) ) {
					require_once( "Vista/RegistroCurso.html" );
				}
				else {
					$this -> altaCurso ();
				}
				break;
			case 'carga_academias':
				$deptos_array = $this -> modelo -> obtenerAcademias();
				if( $deptos_array )
					echo json_encode( $deptos_array );
				break;
			case 'carga_ciclos':
				$ciclos_array = $this -> modelo -> obtenerCiclos();
				if( $ciclos_array )
					echo json_encode( $ciclos_array );
				break;
		}
	}
}