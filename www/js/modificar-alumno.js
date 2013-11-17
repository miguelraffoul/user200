function cargarDatosAlumno() {
	$.ajax({
		url: 'index.php?ctl=modificar_alumno&act=cargar_datos',
		dataType: 'json',
		success: function( json ) {
			document.getElementById( 'nombre' ).value = json[0].nombre;
			document.getElementById( 'codigo' ).value = json[0].codigo;
			document.getElementById( 'carrera' ).value = json[0].carrera;
			document.getElementById( 'mail' ).value = json[0].email;
			if( json[0].celular != null && json[0].celular !=  "") {
				document.getElementById( 'tiene_celular' ).checked = true;
				document.getElementById( 'campo_celular' ).removeAttribute( 'style' );
				document.getElementById( 'celular' ).value = json[0].celular;
			}
			if( json[0].cuenta_github != null && json[0].cuenta_github != "" ) {
				document.getElementById( 'tiene_github' ).checked = true;
				document.getElementById( 'campo_github' ).removeAttribute( 'style' );
				document.getElementById( 'cuenta_git' ).value = json[0].cuenta_github;
			}
			if( json[0].pagina_web != null && json[0].pagina_web != ""  ) {
				document.getElementById( 'tiene_pagina' ).checked = true;
				document.getElementById( 'campo_pagina' ).removeAttribute( 'style' );
				document.getElementById( 'pagina_web' ).value = json[0].pagina_web;
			}
		},
		error: function() {
			console.log( "error al cargar datos de alumno" );
		}
	});
}