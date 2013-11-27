function cargarAlumnos() {
	$.ajax({
		url: 'index.php?ctl=asistencias&act=carga_alumnos',
		dataType: 'json',
		success: function ( json ) {
			var cuerpo = document.getElementById( 'cuerpo_tabla' );
			var plantilla = document.getElementById( 'template_tr' );
			for( i in json ) {
				var fila = plantilla.cloneNode();
				fila.removeAttribute( 'id' );
				fila.removeAttribute( 'style' );
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
*/