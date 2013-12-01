function validarHoja(){
	var columnas = document.getElementsByName( "nombre_columnas[]" );

	for( var i = 1 ; i < columnas.length ; ++i ){
		if( !esValidaColumna( columnas[i] ) ){
			return false;
		}
	}
	
	var calificaciones = document.getElementsByName( "calificaciones[]" );
	//calificaciones.pop();

	//	document.getElementById( "hoja_form" ).submit();
}


function esValidaColumna( nombre_columna ){
	var div = document.getElementById( "wrapper2" );
	var error_columna_vacia = document.getElementById( "error_columna_vacia" );
	
	var alfabeto_regexp = /^[a-z0-9 ]+$/i;
	var error_regexp = document.getElementById( "error_nombre_columna" ); 
	
	if( nombre_columna.value.trim() == "" ){
		if( error_columna_vacia == null ){
			if( error_regexp != null )
				div.removeChild( error_regexp );
			error_columna_vacia = document.createElement( "div" );
			error_columna_vacia.setAttribute( "class", "error" );
			error_columna_vacia.setAttribute( "id", "error_columna_vacia" );
			error_columna_vacia.appendChild( document.createTextNode( "Falta llenar nombres de columna." ) );
			div.insertBefore( error_columna_vacia, div.firstChild );
		}
		return false;
	}
	else if( !alfabeto_regexp.test( nombre_columna.value ) ){
		if( error_regexp == null ){
			if( error_columna_vacia != null )
				div.removeChild( error_columna_vacia );
			error_regexp = document.createElement( "div" );
			error_regexp.setAttribute( "class", "error" );
			error_regexp.setAttribute( "id", "error_nombre_columna" );
			error_regexp.appendChild( document.createTextNode( "Caracteres inválidos en el nombre de la columna." ) );
			div.insertBefore( error_regexp, div.firstChild );
		}
		return false;
	}
	else{
		if( error_columna_vacia != null)
			div.removeChild( error_columna_vacia );

		if( error_regexp != null )
			div.removeChild( error_regexp );
	}
	return true;

}


