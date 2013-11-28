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

function desplegarFechas( fecha_input ) {
	var fecha_array = fecha_input.value.split( "/" );
	fecha_array.reverse();
	var fecha_sql = fecha_array.join( "-" );
	//console.log( fecha_sql );
	$.ajax({
		type: 'POST',
		data: {fecha:fecha_sql},
		url: 'index.php?ctl=asistencias&act=obtener_fechas',
		dataType: 'json',
		success: function ( json ) {
			console.log( json );
		},
		error: function() {
			console.log( "chin D:" );
		}
	});
}

function marcarAsistencia() {
	validarFecha()
}

function marcarFalta() {
	validarFecha()
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
	}
}

/*Nomas pa' tener el ejemplo
function cargarAcademias() {
	$.ajax({
		url: 'index.php?ctl=registro_curso&act=carga_academias',
		dataType: 'json',
		success: function ( json ) {
			var select = document.getElementById( 'academia' );
			for( i in json ) {
				var option = document.createElement( 'option' );
				var texto = document.createTextNode( json[i].nombre );
				option.setAttribute( 'value', json[i].idDepartamento );
				option.appendChild( texto );
				select.appendChild( option );
			}
		},
		error: function () {
        	console.log( "no funciono carga de academias" );
      	}
	});
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
*/