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
	var label = nuevo_dia.getElementsByTagName( 'p' );
	label[0].appendChild( document.createTextNode( diaValor( opcion.value ) ) );

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