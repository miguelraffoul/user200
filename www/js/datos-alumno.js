function cargarDatos() {
	$.ajax({
		url: 'index.php?ctl=alumno&act=cargar_datos',
		dataType: 'json',
		success: function( json ) {
			tabla = document.getElementById( 'cuerpo_tabla' );
			plantilla_fila = document.getElementById( 'template_tr' );
			var acumulador = 0;
			var contador = 0;
			for( i in json ) {
				var fila = plantilla_fila.cloneNode();
				fila.removeAttribute( 'id' );
				fila.removeAttribute( 'style' );
				var tds = fila.getElementsByTagName( 'td' );
				tds[0].innerText = json[i].nombre + " - " + json[i].CicloEscolar_idCicloEscolar;
				tds[1].innerText = Number( json[i].promedio_asist ).toFixed( 2 ) + "%";
				tds[2].innerText = Number( json[i].promedio ).toFixed( 2 );

				tabla.appendChild( fila );
			
				acumulador += Number( json[i].promedio );
				++contador;
			}
			acumulador /= contador;
			document.getElementById( 'promedio' ).innerText = acumulador.toFixed( 2 );
		},
		error: function() {
			console.log( "que pedo u.u" );
		}
	});
}