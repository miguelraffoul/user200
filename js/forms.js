function validarFormInicio () {
	var error = document.getElementById( 'inicio_error' );
	if( error != null ) {
		error.parentNode.removeChild( error );
	}

	var codigo = document.getElementById( 'codigo' );
	var pass = document.getElementById( 'pass' );

	var mensaje_error = "Llenar ambos campos correctamente";
	var div = document.createElement( 'div' );
	div.setAttribute( 'class', 'error' );
	div.setAttribute( 'id', 'inicio_error' );
	div.appendChild( document.createTextNode( mensaje_error ) );

	if( codigo.value == "" || pass.value == "" ) {
		codigo.parentNode.insertBefore( div, codigo );
	}

}

function validarNombre() {
	var nombre = document.getElementById( 'nombre' );
	var nombre_error = document.getElementById( 'nombre_error' );
	if( nombre_error != null )
		nombre_error.parentNode.removeChild( nombre_error );
	if( nombre.value != "" ) {
		var reg_exp = /^[a-z\s]+$/i;
		if( !reg_exp.test( nombre.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'nombre_error' );
			div.appendChild( document.createTextNode( "Utiliza unicamente letras" ) );

			var padre = nombre.parentNode;
			padre.insertBefore( div, nombre.nextSibling );
		}
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'nombre_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = nombre.parentNode;
		padre.insertBefore( div, nombre.nextSibling );
	}
}

function validarCodigo()  {
	var codigo = document.getElementById( 'codigo' );
	var codigo_error = document.getElementById( 'codigo_error' );
	if( codigo_error != null )
		codigo_error.parentNode.removeChild( codigo_error );
	if( codigo.value != "" ) {
		var reg_exp = /^[0-9a-z]+$/i;
		if( !reg_exp.test( codigo.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'codigo_error' );
			div.appendChild( document.createTextNode( "Utiliza unicamente letras y digitos" ) );

			var padre = codigo.parentNode;
			padre.insertBefore( div, codigo.nextSibling );
		}
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'codigo_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = codigo.parentNode;
		padre.insertBefore( div, codigo.nextSibling );
	}
}

function validarCarrera() {
	var carrera = document.getElementById( 'carrera' );
	var carrera_error = document.getElementById( 'carrera_error' );
	if( carrera_error != null )
		carrera_error.parentNode.removeChild( carrera_error );
	if( carrera.selectedIndex == 0  ) {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'carrera_error' );
		div.appendChild( document.createTextNode( "Selecciona una carrera" ) );

		var padre = carrera.parentNode;
		padre.insertBefore( div, carrera.nextSibling );
	}
}

function validarCorreo() {
	var mail = document.getElementById( 'mail' );
	var mail_error = document.getElementById( 'mail_error' );
	if( mail_error != null )
		mail_error.parentNode.removeChild( mail_error );
	if( mail.value != "" ) {
		var reg_exp = /^[a-z0-9][a-z0-9_\.]+@[a-z0-9_\.]+\.[a-z]+$/i;
		if( !reg_exp.test( mail.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'mail_error' );
			div.appendChild( document.createTextNode( "Formato Incorrecto" ) );

			var padre = mail.parentNode;
			padre.insertBefore( div, mail.nextSibling );
		}
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'mail_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = mail.parentNode;
		padre.insertBefore( div, mail.nextSibling );
	}
}

function validarPassword() {
	var pass = document.getElementById( 'pass' );
	var pass_error = document.getElementById( 'pass_error' );
	if( pass_error != null )
		pass_error.parentNode.removeChild( pass_error );
	if( pass.value == "" ) {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'pass_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = pass.parentNode;
		padre.insertBefore( div, pass.nextSibling );		
	}	
}

function validarFormAltaAlumno() {
	validarNombre();
	validarCodigo();
	validarCarrera();
	validarCorreo();
	validarPassword();
}

function validarFormModifAlumno() {
	validarNombre();
	validarCodigo();
	validarCarrera();
	validarCorreo();
}