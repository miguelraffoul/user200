function cargarListaAlumnos() {
	$.ajax({
		url: 'index.php?ctl=lista_alumnos&act=carga_alumnos',
		dataType: 'json',
		success: function( json ) {
			var plantilla = document.getElementById( 'template' );
			for( i in json ) {
				var alumno = plantilla.cloneNode();
				alumno.removeAttribute( 'id' );
				alumno.removeAttribute( 'style' );
				var alumno_nombre = alumno.getElementsByTagName( 'a' );
				alumno_nombre[0].appendChild( document.createTextNode( json[i].nombre ) );
				var alumno_codigo = alumno.getElementsByTagName( 'td' );
				alumno_codigo[2].appendChild( document.createTextNode( json[i].codigo ) );
				document.getElementById( 'cuerpo_tabla' ).appendChild( alumno );
			}
		},
		error: function() {
			console.log( "Falla al cargar alumnos" );
		}
	});
}