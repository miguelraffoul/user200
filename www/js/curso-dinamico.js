function agregarDiaCurso( opcion ) {
	var opciones_select = document.getElementById( 'dias_curso' ).getElementsByTagName( 'option' );
	for( var i = 0; i < opciones_select.length; ++i ){
		if( opciones_select[i].value == opcion.value ) {
			opciones_select[i].setAttribute( 'disabled', 'disabled' );
			break;
		}
	}

	var plantilla = document.getElementById( 'dia_curso_template' );
	var nuevo_dia = plantilla.cloneNode();
	nuevo_dia.removeAttribute( 'style' );
	nuevo_dia.setAttribute( 'id', opcion.value );
	var input_dia = nuevo_dia.getElementsByTagName( 'input' );
	input_dia[0].value = diaValor( opcion.value );
	var titulo = nuevo_dia.getElementsByTagName( 'p' );
	titulo[0].appendChild( document.createTextNode( diaValor( opcion.value ) ) );

	document.getElementById( 'alta_curso_der' ).appendChild( nuevo_dia );
} 

function diaValor( valor ){
	switch( valor ) {
		case '1':
			return 'Lunes';
		case '2':
			return 'Martes';
		case '3':
			return 'Miércoles';
		case '4':
			return 'Jueves';
		case '5':
			return 'Viernes'
		case '6':
			return 'Sábado';
	}
}

function eliminarDiaCurso( dia ){
	var opciones_select = document.getElementById( 'dias_curso' ).getElementsByTagName( 'option' );
	for( var i = 0; i < opciones_select.length; ++i ){
		if( opciones_select[i].value == dia.parentNode.id ) {
			opciones_select[i].removeAttribute( 'disabled' );
			break;
		}
	}
	document.getElementById( 'alta_curso_der' ).removeChild( dia.parentNode );
	if( document.getElementsByClassName( 'dia_curso' ).length  == 1 )
		document.getElementById( 'dias_curso').selectedIndex = 0;
}

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

function cargarCiclos() {
	$.ajax({
		url: 'index.php?ctl=registro_curso&act=carga_ciclos',
		dataType: 'json',
		success: function ( json ) {
			var select = document.getElementById( 'ciclo' );
			for( i in json ) {
				var option = document.createElement( 'option' );
				var texto = document.createTextNode( json[i].idCicloEscolar );
				option.setAttribute( 'value', json[i].idCicloEscolar );
				option.appendChild( texto );
				select.appendChild( option );
			}
		},
		error: function () {
        	console.log( "no funciono carga de ciclos" );
      	}
	});
}