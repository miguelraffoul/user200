function validarCheckBox(){
	
	var div_evaluacion = document.getElementById( "evaluacion" );
	var table = document.getElementById( "tabla_evaluacion" );
	var checkbox = document.getElementsByTagName( "input" );
	
	var esta_alguno_seleccionado = false;
	for( var i = 0 ; i < checkbox.length ; ++i ){
		if( checkbox[i].type == "checkbox" && checkbox[i].checked ){
			esta_alguno_seleccionado = true;
			break;
		}
	}


	var error_no_seleccionado = document.getElementById( "error_no_seleccionado" );
	if( esta_alguno_seleccionado == false ){
		
		if( error_no_seleccionado == null ){
			error_no_seleccionado = document.createElement( "div" );
			error_no_seleccionado.setAttribute( "class", "error" );
			error_no_seleccionado.setAttribute( "id", "error_no_seleccionado" );
			error_no_seleccionado.appendChild( document.createTextNode( "No se ha seleccionado ningún rubro." ) );
			
			div_evaluacion.insertBefore( error_no_seleccionado, table.nextSibling );
		}

	}
	else{
		if( error_no_seleccionado != null )
			div_evaluacion.removeChild( error_no_seleccionado );
	}


}