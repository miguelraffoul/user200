<?php

class HojaEvaluacionCtl{
	private $modelo;

	public function ejecutar(){

		require_once( 'Modelo/HojaEvaluacionMdl.php' );
		$this -> modelo = new ModeloEvaluacionMdl();

		switch( $_GET['act'] ){
			case 'mostrar_pagina':
				require_once( "Vista/HojaEvaluacion.html" );
				break;

			case 'guardar_hoja':
				break;

			case 'cargar_hoja':
				break;

			case 'modificar_hoja':
				break;
		}
	}
}