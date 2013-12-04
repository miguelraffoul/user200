<?php

class LogOutCtl {
	public function ejecutar() {
        session_unset();
        session_destroy();
        
        setcookie( session_name(), '', time() - 3600 );
        header( "Location: index.php?ctl=login" );
	}
}