<?php

class CicloModificarMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function obtenerCiclo( $id_ciclo ){
		$consulta = "SELECT *FROM cicloescolar WHERE idCicloEscolar = \"$id_ciclo\"";
		$ciclo_datos = $this -> bd -> consultaGeneral( $consulta );
		return $ciclo_datos;
	}

	function obtenerDiasInhabiles( $id_ciclo ){
		$consulta = "SELECT *FROM diainhabil WHERE CicloEscolar_idCicloEscolar = \"$id_ciclo\"";
		$dia_inhabil_datos = $this -> bd -> consultaGeneral( $consulta );
		return $dia_inhabil_datos;
	}

	function actualizarFechaCiclo( $id_ciclo, $inicio_ciclo, $fin_ciclo ){
		$consulta = "UPDATE cicloescolar SET inicio = \"$inicio_ciclo\" WHERE idCicloEscolar = \"$id_ciclo\"";
		$resultado1 = $this -> bd -> insertar( $consulta );

		$consulta = "UPDATE cicloescolar SET fin = \"$fin_ciclo\" WHERE idCicloEscolar = \"$id_ciclo\"";
		$resultado2 = $this -> bd -> insertar( $consulta );

		if( $resultado1 && $resultado2 )
			return TRUE;
		return FALSE;
	}

	function eliminarDiasInhabiles( $id_ciclo ){
		$consulta = "DELETE FROM diainhabil WHERE CicloEscolar_idCicloEscolar = \"$id_ciclo\"";
		return $this -> bd -> insertar( $consulta );
	}

	function agregarDiaInhabil( $id_ciclo, $fd_inhabil, $descripcion ){
		$consulta = "INSERT INTO diainhabil ( fecha, motivo, CicloEscolar_idCicloEscolar )
					 VALUES ( \"$fd_inhabil\", \"$descripcion\", \"$id_ciclo\" )";

		return $this -> bd -> insertar( $consulta );
	}


}