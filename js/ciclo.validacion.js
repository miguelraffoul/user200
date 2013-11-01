function validarFormCE(){
	
	var form = document.getElementById( 'form_ciclo' );
	var fecha_inicio = document.getElementById( 'inicio_ciclo' );
	var fecha_fin = document.getElementById( 'fin_ciclo' );

	validarCiclosSelect( form );
	validarIntervaloCE( form, fecha_inicio, fecha_fin );
	validarDiasInhabilesEnCE( fecha_inicio, fecha_fin );

	
}


function validarCiclosSelect( form ){

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
		return false;
	}
	else{
		if( error_vacio != null )
			form.removeChild( error_vacio );
	}

	return true;
}


function validarIntervaloCE( form, fecha_inicio, fecha_fin ){

	var es_fi_valido = validarInicioCiclo( form, fecha_inicio);
	var es_ff_valido = validarFinCiclo( form, fecha_fin);

	if(  es_fi_valido && es_ff_valido ){
		var fi = ( fecha_inicio.value ). split("/").reverse().join("/");
		var ff = ( fecha_fin.value ).split("/").reverse().join("/");

		var error_fecha = document.getElementById( "error_fecha_intervalo" );
		if( fi >= ff ){
			if( error_fecha == null ){
				error_fecha = document.createElement( "div" );
				error_fecha.setAttribute( "class", "error" );
				error_fecha.setAttribute( "id", "error_fecha_intervalo" );
				error_fecha.appendChild( document.createTextNode( "*El rango de fechas es inválido" ) );

				form.insertBefore( error_fecha, fecha_fin.nextSibling );
			}
		}
		else{
			if( error_fecha != null )
				form.removeChild( error_fecha );
			return true;
		}	
	}
	
	return false;
}




function validarInicioCiclo( form, fecha_inicio ){

	var error_vacio = document.getElementById( 'error_fechai_vacia');

	if( fecha_inicio.value == "" ){
		if( error_vacio == null){
			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_fechai_vacia' );
			error_vacio.appendChild( document.createTextNode( 'Selecciona una fecha' ) );

			form.insertBefore( error_vacio, fecha_inicio.nextSibling );
		}	
		return false;
	}
	else{
		if( error_vacio != null )
			form.removeChild( error_vacio );
	}

	return true;
}


function validarFinCiclo( form, fecha_fin ){

	var error_vacio = document.getElementById( 'error_fechaf_vacia');

	if( fecha_fin.value == "" ){
		if( error_vacio == null){
			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_fechaf_vacia' );
			error_vacio.appendChild( document.createTextNode( 'Selecciona una fecha.' ) );

			form.insertBefore( error_vacio, fecha_fin.nextSibling );
		}	
		return false;
	}
	else{
		if( error_vacio != null )
			form.removeChild( error_vacio );
	} 

	return true;
}


function validarDiasInhabilesEnCE( fecha_inicio, fecha_fin ){

	var div_dias_inhabiles = document.getElementById( "dias_inhabiles" );
	
	var	dia_inhabil = new Array();
	var	descripcion = new Array();
	dia_inhabil = $( '.fecha_dia_inhabil' ).toArray();
	descripcion = $( '.descripcion' ).toArray();
	dia_inhabil.pop();
	descripcion.pop();

	var error_vacio = document.getElementById( 'error_dia_inhabil_vacio' );
	var error_dia_invalido = document.getElementById( "error_dia_invalido" );
	var error_dia_repetido = document.getElementById( "error_dia_repetido" );

	//HAY DIAS INHABILES
	if( dia_inhabil.length == 0 ){

		if( error_vacio != null )
			div_dias_inhabiles.removeChild( error_vacio );

		if( error_dia_invalido != null )
			div_dias_inhabiles.removeChild( error_dia_invalido );

		if( error_dia_repetido != null )
			div_dias_inhabiles.removeChild( error_dia_repetido );

		return true;
	}


	//DIAS INHABILES VACIOS
	for( var i = 0 ; i < dia_inhabil.length ; ++i ){

		if( !validarDiaInhabil( div_dias_inhabiles, dia_inhabil[i], descripcion[i] ) ){

			if( error_dia_invalido != null )
			div_dias_inhabiles.removeChild( error_dia_invalido );

			if( error_dia_repetido != null )
				div_dias_inhabiles.removeChild( error_dia_repetido );

			return false;
		}
	}


	// DIAS INHABILES DENTRO DE INTERVALO
	if( fecha_fin.value != "" && fecha_inicio.value != "" ){

		var fi = ( fecha_inicio.value ). split("/").reverse().join("/");
		var ff = ( fecha_fin.value ).split("/").reverse().join("/");

		for( var i = 0 ; i < dia_inhabil.length ; ++i ){

			var di = ( dia_inhabil[i].value ).split("/").reverse().join("/");
			error_dia_invalido = document.getElementById( "error_dia_invalido" );
			
			if( di < fi || di > ff ){
				if( error_dia_repetido != null )
					div_dias_inhabiles.removeChild( error_dia_repetido );

				if( error_dia_invalido == null ){
					error_dia_invalido = document.createElement( "div" );
					error_dia_invalido.setAttribute( "class", "error" );
					error_dia_invalido.setAttribute( "id", "error_dia_invalido" );
					error_dia_invalido.appendChild( document.createTextNode( "*Hay dias inhabiles que no pertenecen al ciclo" ) );

					div_dias_inhabiles.insertBefore( error_dia_invalido, div_dias_inhabiles.lastChild );
				}
				return false;
			}
			else{
				if( error_dia_invalido != null )
					div_dias_inhabiles.removeChild( error_dia_invalido );
			}
		}
			
	}
	else
		return false;


	//DIAS INHABILES REPETIDOS
	console.log("hola");
	for( var i = 0 ; i < dia_inhabil.length ; ++i ){
		for( var j = i + 1 ; j < dia_inhabil.length ; ++j ){
			 error_dia_repetido = document.getElementById( "error_dia_repetido" );

			if( dia_inhabil[i].value == dia_inhabil[j].value ){
				if( error_dia_repetido == null ){
					error_dia_repetido = document.createElement( "div" );
					error_dia_repetido.setAttribute( "class", "error" );
					error_dia_repetido.setAttribute( "id", "error_dia_repetido" );
					error_dia_repetido.appendChild( document.createTextNode( "*Hay dias inhabiles repetidos" ) );

					div_dias_inhabiles.insertBefore( error_dia_repetido, div_dias_inhabiles.lastChild );
				} 
				return false;
			}
			else{
				if( error_dia_repetido != null )
					div_dias_inhabiles.removeChild( error_dia_repetido );
			}
		}
	}

	return true;
}




function validarDiaInhabil( div_dias_inhabiles, dia_inhabil, descripcion ){

	var error_vacio = document.getElementById( 'error_dia_inhabil_vacio' );

	if( dia_inhabil.value == "" || descripcion.value == "" ){
		if( error_vacio == null){
			error_vacio = document.createElement( 'div' );
			error_vacio.setAttribute( 'class', 'error' );
			error_vacio.setAttribute( 'id', 'error_dia_inhabil_vacio' );
			error_vacio.appendChild( document.createTextNode( '*Falta llenar campos en dias inhábiles' ) );

			div_dias_inhabiles.insertBefore( error_vacio, div_dias_inhabiles.lastChild );
		}
		return false;	
	}
	else{
		if( error_vacio != null )
			div_dias_inhabiles.removeChild( error_vacio );
		return true;
	}

}




