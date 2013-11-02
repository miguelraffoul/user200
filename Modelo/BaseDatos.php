<?php

class BaseDatos {
	private $nombre = 'cc409_user200';
	private $host = 'localhost';
	private $usuario = 'cc409_user200';
	private $pass = 'JTDjymKMYR'; 
	private $conexion;
	private static $instancia;

	private function __construct(){
	    $this -> conexion = new mysqli( $this -> host, $this -> usuario, $this -> pass, $this -> nombre );
	    if( $this -> conexion -> connect_errno )
	    	die( "<br>Error en la conexión" );
	}

	public static function obtenerInstancia(){
	    if( !isset( self::$instancia ) ){
	        self::$instancia = new Database();
	    }
	    return self::$instancia;     
	}

	public function consultaEspecifica( $consulta ) {
	    //queries   
	    $sql = $this -> conexion -> query( $consulta ); 
	    return $sql;
	}

	public function consultaGeneral( $consulta ) {
	    //queries   
	    $sql = $this -> conexion -> query( $consulta ); 
	    while( $row = $sql -> fetch_assoc() )
			$array[] = $row;
		return $array;
	}
}