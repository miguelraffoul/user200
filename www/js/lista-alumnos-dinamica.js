function cargarListaAlumnos() {
	$.ajax({
		url: 'index.php?ctl=lista_alumnos&act=carga_alumnos',
		dataType: 'json',
		success: function( json ) {
			var plantilla = document.getElementById( 'template' );
			for( i in json ) {
				if( json[i].activo == 1 ) {
					var alumno = plantilla.cloneNode();
					alumno.removeAttribute( 'id' );
					alumno.removeAttribute( 'style' );
					var alumno_nombre = alumno.getElementsByTagName( 'a' );
					alumno_nombre[0].appendChild( document.createTextNode( json[i].nombre ) );
					var alumno_codigo = alumno.getElementsByTagName( 'td' );
					alumno_codigo[2].appendChild( document.createTextNode( json[i].codigo ) );
					document.getElementById( 'cuerpo_tabla' ).appendChild( alumno );
				}
			}
		},
		error: function() {
			console.log( "Falla al cargar alumnos" );
		}
	});
}

function eliminarAlumnos( boton ) {
	var checkboxes = document.getElementById( 'cuerpo_tabla' ).getElementsByTagName( 'input' );
	var alumnos_seleccionados = false;
	for( var i = 1; i < checkboxes.length; ++i ) {
		if ( checkboxes[i].checked ) {
			alumnos_seleccionados = true;
		}
	}
	var error = document.getElementById( 'error_no_seleccion' );
	if( error != null )
		error.parentNode.removeChild( error );	

	if( alumnos_seleccionados ) {
		var confirmacion = confirm( "Corfirme borrado de alumn@(s)" );
		if( confirmacion ) {
			for( var i = 0; i < checkboxes.length; ++i ){
				if ( checkboxes[i].checked ) {
					var tds = checkboxes[i].parentNode.parentNode.getElementsByTagName( 'td' );
					var codigo = tds[2].innerHTML;
					eliminarAlumno( codigo );
				}
			}
		}
	}
	else {
		error = document.createElement( 'div' );
		error.setAttribute( 'id', 'error_no_seleccion' );
		error.setAttribute( 'class', 'error' );
		error.appendChild( document.createTextNode( 'Seleccione por lo menos un(a) alumno(a)' ) );
		boton.parentNode.insertBefore( error, boton );
	}
}

function eliminarAlumno( id ) {
	$.ajax({
		type: 'POST',
		data: {codigo:id},
		url: 'index.php?ctl=lista_alumnos&act=eliminar_alumno',
		success: function() {
			window.location.replace( "index.php?ctl=lista_alumnos&act=lista" );
		}
	});
}