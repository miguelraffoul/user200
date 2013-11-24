function validarFormCE(){
	
	var form = document.getElementById( 'form_ciclo' );
	var fecha_inicio = document.getElementById( 'inicio_ciclo' );
	var fecha_fin = document.getElementById( 'fin_ciclo' );

	var ciclo_seleccionado_valido;
	ciclo_seleccionado_valido = validarCiclosSelect( form );

	if( ciclo_seleccionado_valido ){
		var fecha_ciclo_valido, dias_inhabiles_validos;
	
		fecha_ciclo_valido = validarIntervaloCE( form, fecha_inicio, fecha_fin );
		dias_inhabiles_validos = validarDiasInhabilesEnCE( fecha_inicio, fecha_fin );

		if( fecha_ciclo_valido && dias_inhabiles_validos )
			form.submit();
	}

	
}

function validarFormCEModificado(){
	var form = document.getElementById( 'form_ciclo' );
	var fecha_inicio = document.getElementById( 'inicio_ciclo' );
	var fecha_fin = document.getElementById( 'fin_ciclo' );

	var fecha_ciclo_valido, dias_inhabiles_validos;
	fecha_ciclo_valido = validarIntervaloCE( form, fecha_inicio, fecha_fin );
	dias_inhabiles_validos = validarDiasInhabilesEnCE( fecha_inicio, fecha_fin );

	if(  fecha_ciclo_valido && dias_inhabiles_validos )
		form.submit();
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

	var es_fi_valido = esValidoInicioCiclo( form, fecha_inicio);
	var es_ff_valido = esValidoFinCiclo( form, fecha_fin);

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




function esValidoInicioCiclo( form, fecha_inicio ){

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


	if( !esFechaDeCiclo( form, fecha_inicio, "error_fechai_intervalo" ) ){
		return false;
	}

	return true;
}


function esValidoFinCiclo( form, fecha_fin ){

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

	if( !esFechaDeCiclo( form, fecha_fin, "error_fechaf_intervalo" ) )
		return false;

	return true;
}

function esFechaDeCiclo( form, fecha, error ){
	var ciclo_select = document.getElementById( "ciclo_select" );
	var error_fecha_ciclo = document.getElementById( error ); 

	var fecha_array = fecha.value.split( "/" );
	var year = ciclo_select.value.substring( 0, 4 );
	var ciclo = ciclo_select.value.charAt( 4 );

	if( year != fecha_array[2] || ( ciclo == "A" && parseInt( fecha_array[1] ) > 6 ) || 
		( ciclo == "B" && parseInt( fecha_array[1] ) <= 6 ) ){
		
		if( error_fecha_ciclo == null ){

			var error_fecha = document.getElementById( "error_fecha_intervalo" );
			if( error_fecha != null )
				form.removeChild( error_fecha );

			error_fecha_ciclo = document.createElement( 'div' );
			error_fecha_ciclo.setAttribute( 'class', 'error' );
			error_fecha_ciclo.setAttribute( 'id', error );
			error_fecha_ciclo.appendChild( document.createTextNode( "La fecha no coincide con el ciclo " + year + " (A: Enero-Junio, B: Julio-Diciembre)." ) );

			form.insertBefore( error_fecha_ciclo, fecha.nextSibling );
		}
		return false;

	}
	else{
		if( error_fecha_ciclo != null )
			form.removeChild( error_fecha_ciclo );
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

	if( dia_inhabil.value == "" || descripcion.value.trim() == "" ){
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




