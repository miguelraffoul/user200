function validarFormCE(){
	
	var form = document.getElementById( 'form_ciclo' );

	var elemento = document.getElementById( 'ciclo_select' );
	var error_vacio = document.getElementById( 'error_ciclo_vacio' );

	if( elemento.selectedIndex == 0 ){
		if( error_vacio == null){
			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_ciclo_vacio' );
			error_vacio.appendChild( document.createTextNode( 'Selecciona un ciclo' ) );

			form.insertBefore( error_vacio, elemento.nextSibling );
		}
	}
	else{
		if( error_vacio != null )
			form.removeChild( error_vacio );
	}

	var fecha_inicio = document.getElementById( 'inicio_curso' );
	error_vacio = document.getElementById( 'error_fechai_vacia');

	if( fecha_inicio.value == "" ){
		if( error_vacio == null){
			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_fechai_vacia' );
			error_vacio.appendChild( document.createTextNode( 'Selecciona una fecha' ) );

			form.insertBefore( error_vacio, fecha_inicio.nextSibling );
		}	
	}
	else{
		if( error_vacio != null )
			form.removeChild( error_vacio );
	} 


	var fecha_fin = document.getElementById( 'fin_curso' );
	error_vacio = document.getElementById( 'error_fechaf_vacia');

	if( fecha_fin.value == "" ){
		if( error_vacio == null){
			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_fechaf_vacia' );
			error_vacio.appendChild( document.createTextNode( 'Selecciona una fecha.' ) );

			form.insertBefore( error_vacio, fecha_fin.nextSibling );
		}	
	}
	else{
		if( error_vacio != null )
			form.removeChild( error_vacio );
	} 

	validarIntervaloCE( form, fecha_inicio, fecha_fin );


	var div_dia_inhabil = document.getElementById( 'dia_inhabil' );
	var dia_inhabil = document.getElementById( 'fecha_dia_inhabil' );
	error_vacio = document.getElementById( 'error_dia_inhabil_vacio' );

	if( dia_inhabil.value == "" ){
		if( error_vacio == null){
			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_dia_inhabil_vacio' );
			error_vacio.appendChild( document.createTextNode( 'Selecciona una fecha.' ) );

			div_dia_inhabil.insertBefore( error_vacio, dia_inhabil.nextSibling );
		}	
	}
	else{
		if( error_vacio != null )
			div_dia_inhabil.removeChild( error_vacio );
	}

	validarDiaInhabilCE( div_dia_inhabil, fecha_inicio, fecha_fin, dia_inhabil );

	var alfabeto_regexp = /^[a-z ]+$/i;
	elemento = document.getElementById( 'descripcion' );
	error_vacio = document.getElementById( 'error_descripcion_vacio' );
	error_regexp = document.getElementById( 'error_descripcion_regexp' );


	if(  elemento.value == "" ){
		
		if( error_vacio == null){

			if( error_regexp != null )
				div_dia_inhabil.removeChild( error_regexp );

			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_descripcion_vacio' );
			error_vacio.appendChild( document.createTextNode( 'Rellena este campo') );

			//insertar mensaje en el formulario
			div_dia_inhabil.insertBefore( error_vacio, elemento.nextSibling );
		}

	}
	else if( !alfabeto_regexp.test( elemento.value ) ){

		if( error_regexp == null){

			if( error_vacio != null )
				div_dia_inhabil.removeChild( error_vacio );

			error_regexp = document.createElement( 'div' );
			error_regexp.setAttribute( 'class', 'error' );
			error_regexp.setAttribute( 'id', 'error_descripcion_regexp' );
			error_regexp.appendChild( document.createTextNode( 'Introducir solo caracteres alfabéticos' ) );

			//insertar mensaje en el formulario
			div_dia_inhabil.insertBefore( error_regexp, elemento.nextSibling );
		}
	}
	else{
		if( error_vacio != null)
			div_dia_inhabil.removeChild( error_vacio );

		if( error_regexp != null )
			div_dia_inhabil.removeChild( error_regexp );
	}



	

}


//VALIDACON DE INTERVALO ENTRE FECHA INICIO Y FIN
function validarIntervaloCE( form, fecha_inicio, fecha_fin ){

	if( fecha_fin.value != "" && fecha_inicio.value != "" ){
		var fi = ( fecha_inicio.value ). split("/").reverse().join("/");
		var ff = ( fecha_fin.value ).split("/").reverse().join("/");

		var error_fecha = document.getElementById( "error_fecha_intervalo" );
		if( fi >= ff ){
			if( error_fecha == null ){
				error_fecha = document.createElement( "div" );
				error_fecha.setAttribute( "class", "error" );
				error_fecha.setAttribute( "id", "error_fecha_intervalo" );
				error_fecha.appendChild( document.createTextNode( "*La fecha inicio y fin del ciclo son inválidas" ) );

				form.insertBefore( error_fecha, fecha_fin.nextSibling );
			}
		}
		else{
			if( error_fecha != null )
				form.removeChild( error_fecha );
		}
			
	}

}


//VALIDACON DE DIA INHABIL DENTRO DE FECHA INICIO Y FIN
function validarDiaInhabilCE( div_dia, fecha_inicio, fecha_fin, dia_inhabil ){

	if( fecha_fin.value != "" && fecha_inicio.value != "" && dia_inhabil.value != "" ){
		var fi = ( fecha_inicio.value ). split("/").reverse().join("/");
		var ff = ( fecha_fin.value ).split("/").reverse().join("/");
		var di = ( dia_inhabil.value ).split("/").reverse().join("/");

		var error_dia_invalido = document.getElementById( "error_dia_invalido" );
		if( di < fi || di > ff ){
			if( error_dia_invalido == null ){
				error_dia_invalido = document.createElement( "div" );
				error_dia_invalido.setAttribute( "class", "error" );
				error_dia_invalido.setAttribute( "id", "error_dia_invalido" );
				error_dia_invalido.appendChild( document.createTextNode( "El dia inhábil no pertenece al ciclo" ) );

				div_dia.insertBefore( error_dia_invalido, dia_inhabil.nextSibling );
			}
		}
		else{
			if( error_dia_invalido != null )
				div_dia.removeChild( error_dia_invalido );
		}
			
	}

}