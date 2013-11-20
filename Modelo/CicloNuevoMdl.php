<?php

class CicloNuevoMdl{
	private $bd;

	function __construct(){
		require_once( "BaseDeDatos.php" );
		$this -> bd = BaseDeDatos::obtenerInstancia();
	}

	function existe( $id_ciclo ){
		$consulta = "SELECT idcicloEscolar FROM cicloescolar WHERE idCicloEscolar = \"$id_ciclo\"";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function estaActivo( $id_ciclo ){
		$consulta = "SELECT idcicloEscolar FROM cicloescolar WHERE idCicloEscolar = \"$id_ciclo\" AND activo = TRUE";
		return $this -> bd -> consultaGeneral( $consulta );
	}

	function activarCiclo( $id_ciclo ){
		$consulta = "UPDATE cicloescolar SET activo = TRUE WHERE idCicloEscolar = \"$id_ciclo\"";
		return $this -> bd -> insertar( $consulta );
	}


	function agregarFechaCiclo( $ciclo_select, $fi_ciclo, $ff_ciclo ){
		$consulta = "INSERT INTO cicloescolar ( idCicloEscolar, inicio, fin, Administrador_codigo, activo ) 
					 VALUES ( \"$ciclo_select\", \"$fi_ciclo\", \"$ff_ciclo\", '123admin', TRUE )";
		return $this -> bd -> insertar( $consulta );
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