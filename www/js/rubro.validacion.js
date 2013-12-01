function validarFormRubro(){
	var form = document.getElementById( 'rubro_evaluacion' );
	var div_columnas_rubro = document.getElementById( 'div_columnas_rubro' );

	var nombre_valido, valor_rubro_valido, columnas_rubro_valido; 

	nombre_valido = validarNombre( form );
	valor_rubro_valido = validarValor( form );
	columnas_rubro_valido = validarColumnasRubro( div_columnas_rubro );

	if( nombre_valido && valor_rubro_valido && columnas_rubro_valido )
		form.submit();
	
}



function mostrarColumnasRubro( tiene_columnas_extra_checkbox ){
	var div_columnas_rubro = document.getElementById( "div_columnas_rubro" ); 

	if( tiene_columnas_extra_checkbox.checked )
		div_columnas_rubro.setAttribute( "style", "display: block;" );
	else
		div_columnas_rubro.setAttribute( "style", "display: none;" );

}



function validarNombre( form ){

	var alfabeto_regexp = /^[a-z ]+$/i;
	var elemento = document.getElementById( 'nombre_rubro' );
	var error_vacio = document.getElementById( 'error_nombre_rubro_vacio' );
	var error_regexp = document.getElementById( 'error_nombre_rubro_regexp' );


	if(  elemento.value.trim() == "" ){
		
		if( error_vacio == null){

			if( error_regexp != null )
				form.removeChild( error_regexp );

			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_nombre_rubro_vacio' );
			error_vacio.appendChild( document.createTextNode( 'Rellana este campo') );

			//insertar mensaje en el formulario
			form.insertBefore( error_vacio, elemento.nextSibling );
		}
		return false;

	}
	else if( !alfabeto_regexp.test( elemento.value ) ){

		if( error_regexp == null){

			if( error_vacio != null )
				form.removeChild( error_vacio );

			error_regexp = document.createElement( 'div' );
			error_regexp.setAttribute( 'class', 'error' );
			error_regexp.setAttribute( 'id', 'error_nombre_rubro_regexp' );
			error_regexp.appendChild( document.createTextNode( 'Introducir solo caracteres alfabéticos' ) );

			//insertar mensaje en el formulario
			form.insertBefore( error_regexp, elemento.nextSibling );
		}
		return false;
	}
	else{
		if( error_vacio != null)
			form.removeChild( error_vacio );

		if( error_regexp != null )
			form.removeChild( error_regexp );
	}

	return true;
}


function validarValor( form ){

	var numero_regexp = /^[0-9]+$/i;
	var elemento = document.getElementById( 'valor_rubro' );
	var error_vacio = document.getElementById( 'error_valor_rubro_vacio' );
	var error_regexp = document.getElementById( 'error_valor_rubro_regexp' );

	if(  elemento.value.trim() == "" ){
		
		if( error_vacio == null){

			if( error_regexp != null )
				form.removeChild( error_regexp );

			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_valor_rubro_vacio' );
			error_vacio.appendChild( document.createTextNode( 'Rellena este campo') );

			//insertar mensaje en el formulario
			form.insertBefore( error_vacio, elemento.nextSibling );
		}
		return false;

	}
	else if( !numero_regexp.test( elemento.value.trim() ) ){

		if( error_regexp == null){

			if( error_vacio != null )
				form.removeChild( error_vacio );

			error_regexp = document.createElement( 'div' );
			error_regexp.setAttribute( 'class', 'error' );
			error_regexp.setAttribute( 'id', 'error_valor_rubro_regexp' );
			error_regexp.appendChild( document.createTextNode( 'Introducir solo números positivos' ) );

			//insertar mensaje en el formulario
			form.insertBefore( error_regexp, elemento.nextSibling );
		}
		return false;
	}
	else{
		if( error_vacio != null)
			form.removeChild( error_vacio );

		if( error_regexp != null )
			form.removeChild( error_regexp );
	}
	return true;
}


function validarColumnasRubro( div_columnas_rubro ){
	
	var numero_regexp = /^[0-9]+$/i;
	var elemento = document.getElementById( 'columnas_extra' );
	var error_vacio = document.getElementById( 'error_columnas_rubro_vacio' );
	var error_regexp = document.getElementById( 'error_columnas_rubro_regexp' );

	if( document.getElementById('tiene_columnas_extra').checked ){
		if(  elemento.value.trim() == "" ){
		
			if( error_vacio == null){

				if( error_regexp != null )
					div_columnas_rubro.removeChild( error_regexp );

				error_vacio = document.createElement( 'div' );
				error_vacio.setAttribute( 'class', 'error' );
				error_vacio.setAttribute( 'id', 'error_columnas_rubro_vacio' );
				error_vacio.appendChild( document.createTextNode( 'Rellena este campo') );

				//insertar mensaje en el formulario
				div_columnas_rubro.insertBefore( error_vacio, elemento.nextSibling );
			}
			return false;

		}
		else if( !numero_regexp.test( elemento.value.trim() ) || parseInt( elemento.value ) <= 0 ){

			if( error_regexp == null){

				if( error_vacio != null )
					div_columnas_rubro.removeChild( error_vacio );

				error_regexp = document.createElement( 'div' );
				error_regexp.setAttribute( 'class', 'error' );
				error_regexp.setAttribute( 'id', 'error_columnas_rubro_regexp' );
				error_regexp.appendChild( document.createTextNode( 'Introducir solo números mayores a 0' ) );

				//insertar mensaje en el formulario
				div_columnas_rubro.insertBefore( error_regexp, elemento.nextSibling );
			}
			return false;
		}
		else{
			if( error_vacio != null)
				div_columnas_rubro.removeChild( error_vacio );

			if( error_regexp != null )
				div_columnas_rubro.removeChild( error_regexp );
		}
	}

	return true;
}