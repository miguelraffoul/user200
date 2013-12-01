function validarHoja(){
	var div = document.getElementById( "wrapper2" );
	eliminarError( div, document.getElementById( "error_columna_vacia" ) );
	eliminarError( div, document.getElementById( "error_nombre_columna" ) );
	eliminarError( div, document.getElementById( "error_calificacion_vacia" ) );
	eliminarError( div, document.getElementById( "error_calificacion" ) );

	var columnas = document.getElementsByName( "nombre_columnas[]" );
	for( var i = 1 ; i < columnas.length - 1 ; ++i ){
		if( !esValidaColumna( columnas[i] ) ){
			return false;
		}
	}
	
	var calificaciones = document.getElementsByName( "calificaciones[]" );
	for( var i = 1 ; i < calificaciones.length - 1 ; ++i ){
		if( !esValidaCalificacion( calificaciones[i]) )
			return false;
	}
	
}


function esValidaColumna( nombre_columna ){
	var div = document.getElementById( "wrapper2" );
	var error_columna_vacia = document.getElementById( "error_columna_vacia" );
	
	var alfabeto_regexp = /^[a-z0-9 ]+$/i;
	var error_regexp = document.getElementById( "error_nombre_columna" ); 
	
	if( nombre_columna.value.trim() == "" ){
		error_columna_vacia = document.createElement( "div" );
		error_columna_vacia.setAttribute( "class", "error" );
		error_columna_vacia.setAttribute( "id", "error_columna_vacia" );
		error_columna_vacia.appendChild( document.createTextNode( "Falta llenar nombres de columna." ) );
		div.insertBefore( error_columna_vacia, div.lastChild );
		return false;
	}
	
	if( !alfabeto_regexp.test( nombre_columna.value ) ){
		error_regexp = document.createElement( "div" );
		error_regexp.setAttribute( "class", "error" );
		error_regexp.setAttribute( "id", "error_nombre_columna" );
		error_regexp.appendChild( document.createTextNode( "Caracteres inválidos en el nombre de la columna." ) );
		div.insertBefore( error_regexp, div.lastChild );
		return false;
	}

	return true;
}


function esValidaCalificacion( calificacion ){
	var div = document.getElementById( "wrapper2" );
	var error_calificacion_vacia = document.getElementById( "error_calificacion_vacia" );
	
	var alfabeto_regexp = /[0-9]|[0-9]\.[0-9]|NP|SD/i;
	var error_regexp = document.getElementById( "error_calificacion" ); 

	if( calificacion.value.trim() == "" ){
		error_calificacion_vacia = document.createElement( "div" );
		error_calificacion_vacia.setAttribute( "class", "error" );
		error_calificacion_vacia.setAttribute( "id", "error_calificacion_vacia" );
		error_calificacion_vacia.appendChild( document.createTextNode( "Falta llenar calificaciones." ) );
		div.insertBefore( error_calificacion_vacia, div.lastChild );
		return false;
	}
	
	if( !alfabeto_regexp.test(calificacion.value ) ){
		error_regexp = document.createElement( "div" );
		error_regexp.setAttribute( "class", "error" );
		error_regexp.setAttribute( "id", "error_calificacion" );
		error_regexp.appendChild( document.createTextNode( "Solo se permiten calificaciones del 1 al 10 incluyendo SD Y NP." ) );
		div.insertBefore( error_regexp, div.lastChild );
		return false;
	}
	
	return true;
}


function eliminarError( padre, error ){
	if( error != null )
		padre.removeChild( error );
}