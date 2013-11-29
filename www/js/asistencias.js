function cargarAlumnos() {
	$.ajax({
		url: 'index.php?ctl=asistencias&act=carga_alumnos',
		dataType: 'json',
		success: function ( json ) {
			var cuerpo = document.getElementById( 'cuerpo_tabla' );
			var plantilla = document.getElementById( 'template_tr' );
			for( i in json ) {
				var fila = plantilla.cloneNode();
				fila.removeAttribute( 'style' );
				fila.setAttribute( 'id', json[i].codigo );
				var tds = fila.getElementsByTagName( 'td' );
				tds[1].appendChild( document.createTextNode( json[i].nombre ) );
				cuerpo.appendChild( fila );
			}
		},
		error: function () {
        	console.log( "no funciono carga de alumnos" );
      	}
	});
}

function sqlToDatePickerFormat( fecha ) {
	var fecha_array = fecha.split( "-" );
	fecha_array.reverse();
	return fecha_array.join( "/" );
}

function datePickerToSqlFormat( fecha ) {
	var fecha_array = fecha.split( "/" );
	fecha_array.reverse();
	return fecha_array.join( "-" );
}

function limpiarTabla( encabezado, filas ) {
	var columnas = encabezado.getElementsByTagName( 'th' );
	for( var it = columnas.length - 1; it > 1; --it ) {
		encabezado.removeChild( columnas[it] );
		for( var j = 1; j < filas.length; ++j ){
			filas[j].removeChild( filas[j].lastChild );
		}
	}
}

function desplegarFechas( fecha_input ) {
	var error = document.getElementById( 'fecha_error' );
	if( error != null ) 
		error.parentNode.removeChild( error );

	var fecha_sql = datePickerToSqlFormat( fecha_input.value );
	$.ajax({
		type: 'POST',
		data: {fecha:fecha_sql},
		url: 'index.php?ctl=asistencias&act=obtener_fechas',
		dataType: 'json',
		success: function ( json ) {
			var encabezado = document.getElementById( 'encabezado_tabla' );
			var filas = document.getElementById( 'cuerpo_tabla' ).getElementsByTagName( 'tr' );
			limpiarTabla( encabezado, filas );

			var plantilla_fecha = document.getElementById( 'template_chbx' );
			var plantilla_asis = document.getElementById( 'template_asistencia' );
			var plantilla_falta = document.getElementById( 'template_falta' );
			for( i in json ) {
				var th = document.createElement( 'th' );
				th.setAttribute( 'id', json[i] );
				var temp_chbx = plantilla_fecha.cloneNode();
				temp_chbx.removeAttribute( 'id' );
				temp_chbx.removeAttribute( 'style' );
				th.appendChild( temp_chbx );
				th.appendChild( document.createTextNode( sqlToDatePickerFormat( json[i] ) ) );
				encabezado_tabla.appendChild( th );
				for( var j = 1; j < filas.length; ++j ){
					$.ajax({
						async: false,
						type: 'POST',
						data: {fecha: json[i], alumno: filas[j].id},
						url: 'index.php?ctl=asistencias&act=obtener_asistencia',
						dataType: 'json',
						success: function( json2 ) {
							var td = document.createElement( 'td' );
							if( Array.isArray( json2 ) ) {
								if( json2[0].asistencia != 0 ) {
									var asist = plantilla_asis.cloneNode();
									asist.removeAttribute( 'id' );
									asist.removeAttribute( 'style' );
									td.appendChild( asist );
								}
								else {
									var falta = plantilla_falta.cloneNode();
									falta.removeAttribute( 'id' );
									falta.removeAttribute( 'style' );
									td.appendChild( falta );
								}
							}
							filas[j].appendChild( td );
						}
					});
				}
			}
		},
		error: function() {			
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'fecha_error' );
			div.appendChild( document.createTextNode( "Fecha invalida" ) );
			fecha_input.parentNode.appendChild( div );
		}
	});
}

function validarFecha() {
	var fecha_input = document.getElementById( 'asistencias_desde' );
	
	var error = document.getElementById( 'fecha_error' );
	if( error != null ) 
		error.parentNode.removeChild( error );
	
	if( fecha_input.value == "" ) {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'fecha_error' );
		div.appendChild( document.createTextNode( "Introduce una fecha" ) );
		fecha_input.parentNode.appendChild( div );
		return false;
	}
	return true;
}

function marcarAsistencia() {
	if( validarFecha() ) {
		var encabezado = document.getElementById( 'encabezado_tabla' ).getElementsByTagName( 'th' );
		var filas = document.getElementById( 'cuerpo_tabla' ).getElementsByTagName( 'tr' );
		var plantilla_asis = document.getElementById( 'template_asistencia' );
		
		for( var i = 2; i < encabezado.length; ++i ){
			if( encabezado[i].firstChild.checked ) {
				for( var j = 1; j < filas.length; ++j ){
					var tds = filas[j].getElementsByTagName( 'td' );
					if( tds[0].firstChild.checked ) {
						$.ajax({
							type: 'POST',
							data: {fecha: encabezado[i].id, alumno: filas[j].id},
							url: 'index.php?ctl=asistencias&act=marcar_asistencia',
							success: function() {
								console.log( "si se pudo ^.^" );
							}
						});
						if( tds[i].firstChild )
							tds[i].removeChild( tds[i].firstChild );
						var asist = plantilla_asis.cloneNode();
						asist.removeAttribute( 'id' );
						asist.removeAttribute( 'style' );
						tds[i].appendChild( asist );
					}
				} 
			}
		}
	}
}

function marcarFalta() {
	if( validarFecha() ) {
		var encabezado = document.getElementById( 'encabezado_tabla' ).getElementsByTagName( 'th' );
		var filas = document.getElementById( 'cuerpo_tabla' ).getElementsByTagName( 'tr' );
		var plantilla_falta = document.getElementById( 'template_falta' );
		
		for( var i = 2; i < encabezado.length; ++i ){
			if( encabezado[i].firstChild.checked ) {
				for( var j = 1; j < filas.length; ++j ){
					var tds = filas[j].getElementsByTagName( 'td' );
					if( tds[0].firstChild.checked ) {
						$.ajax({
							type: 'POST',
							data: {fecha: encabezado[i].id, alumno: filas[j].id},
							url: 'index.php?ctl=asistencias&act=marcar_falta',
							success: function() {
								console.log( "si se pudo ^.^" );
							}
						});
						if( tds[i].firstChild )
							tds[i].removeChild( tds[i].firstChild );
						var falta = plantilla_falta.cloneNode();
						falta.removeAttribute( 'id' );
						falta.removeAttribute( 'style' );
						tds[i].appendChild( falta );
					}
				} 
			}
		}
	}}