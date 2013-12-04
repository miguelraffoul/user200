function validarHoja(){
	var div = document.getElementById( "wrapper2" );
	eliminarError( div, document.getElementById( "error_columna_vacia" ) );
	eliminarError( div, document.getElementById( "error_nombre_columna" ) );
	eliminarError( div, document.getElementById( "error_columna_repetida" ) );
	eliminarError( div, document.getElementById( "error_calificacion_vacia" ) );
	eliminarError( div, document.getElementById( "error_calificacion" ) );

	var columnas = document.getElementsByName( "nombre_columnas[]" );
	for( var i = 1 ; i < columnas.length - 1 ; ++i ){
		if( !esValidaColumna( columnas[i], div ) ){
			return false;
		}
	}


	if( hayColumnasRepetidas( columnas, div ) )
		return false;
	
	var calificaciones = document.getElementsByName( "calificaciones[]" );
	for( var i = 1 ; i < calificaciones.length - 1 ; ++i ){
		if( !esValidaCalificacion( calificaciones[i], div ) )
			return false;
	}

	document.getElementById( "hoja_form" ).submit();
	return true;
}

function validarCalificaciones(){
	var div = document.getElementById( "wrapper2" );
	eliminarError( div, document.getElementById( "error_calificacion_vacia" ) );
	eliminarError( div, document.getElementById( "error_calificacion" ) );

	var calificaciones = document.getElementsByName( "calificaciones[]" );
	for( var i = 1 ; i < calificaciones.length - 1 ; ++i ){
		if( !esValidaCalificacion( calificaciones[i], div ) )
			return false;
	}
	return true;
}


function esValidaColumna( nombre_columna, div ){

	var error_columna_vacia = document.getElementById( "error_columna_vacia" );
	
	var alfabeto_regexp = /^[a-z0-9 ]+$/i;
	var error_regexp = document.getElementById( "error_nombre_columna" ); 
	
	if( nombre_columna.value.trim() == "" ){
		error_columna_vacia = document.createElement( "div" );
		error_columna_vacia.setAttribute( "class", "error" );
		error_columna_vacia.setAttribute( "id", "error_columna_vacia" );
		error_columna_vacia.appendChild( document.createTextNode( "Falta llenar nombres de columna." ) );
		div.insertBefore( error_columna_vacia, div.lastChild );
		return false;
	}
	
	if( !alfabeto_regexp.test( nombre_columna.value ) ){
		error_regexp = document.createElement( "div" );
		error_regexp.setAttribute( "class", "error" );
		error_regexp.setAttribute( "id", "error_nombre_columna" );
		error_regexp.appendChild( document.createTextNode( "Caracteres inválidos en el nombre de la columna." ) );
		div.insertBefore( error_regexp, div.lastChild );
		return false;
	}
	return true;	
}


function esValidaCalificacion( calificacion, div ){
	var error_calificacion_vacia = document.getElementById( "error_calificacion_vacia" );
	
	var calificacion_regexp = /^[0-9]$|^[0-9]\.[0-9]$|^10$|^10\.0$|^NP$|^SD$/i;
	var error_regexp = document.getElementById( "error_calificacion" ); 

	if( calificacion.value.trim() == "" ){
		error_calificacion_vacia = document.createElement( "div" );
		error_calificacion_vacia.setAttribute( "class", "error" );
		error_calificacion_vacia.setAttribute( "id", "error_calificacion_vacia" );
		error_calificacion_vacia.appendChild( document.createTextNode( "Falta llenar calificaciones." ) );
		div.insertBefore( error_calificacion_vacia, div.lastChild );
		return false;
	}
	
	if( !calificacion_regexp.test(calificacion.value ) ){
		error_regexp = document.createElement( "div" );
		error_regexp.setAttribute( "class", "error" );
		error_regexp.setAttribute( "id", "error_calificacion" );
		error_regexp.appendChild( document.createTextNode( "Solo se permiten calificaciones del 0 al 10 incluyendo SD Y NP." ) );
		div.insertBefore( error_regexp, div.lastChild );
		return false;
	}


	return true;
}


function hayColumnasRepetidas( columnas, div ){
	var temp;
	columnas_length = columnas.length;

	for( var i = 1 ; i < columnas_length ; ++i ){
		temp = columnas[i].value;
		for( var j = i + 1 ; j < columnas_length ; ++j ){

			if( temp.toUpperCase() == columnas[j].value.toUpperCase() ){

				var error_columna_repetida = document.createElement( "div" );
				error_columna_repetida.setAttribute( "class", "error" );
				error_columna_repetida.setAttribute( "id", "error_columna_repetida" );
				error_columna_repetida.appendChild( document.createTextNode( "No se permite columnas con nombres iguales." ) );
				div.insertBefore( error_columna_repetida, div.lastChild );
				return true;
			}
		}
	}
	return false;
}

function calcularPromedio(){

	if( validarCalificaciones() ){
		var filas = document.getElementsByTagName( "tr" );

		var total_filas = filas.length - 3;
		if( total_filas > 0 ){
			var promedio_total = 0;
			var promedio;
			for( var i = 2 ; i < filas.length - 1 ; ++i ){
				var calificaciones = filas[i].getElementsByTagName( "input" );
				var suma = 0;
				for( var j = 0 ; j < calificaciones.length - 1 ; ++j ){
					if( calificaciones[j].value.toUpperCase() != "NP" && 
						calificaciones[j].value.toUpperCase() != "SD" )
						suma = suma + parseFloat( calificaciones[j].value );
				}
				promedio = suma / ( calificaciones.length - 1 )
				calificaciones[j].value = promedio.toFixed(1);
				promedio_total = promedio_total + parseFloat( promedio.toFixed( 1 ) );
			}
			promedio_total = promedio_total / total_filas;
			document.getElementById( "total_promedio" ).textContent = promedio_total.toFixed( 1 ) ;
			document.getElementById( "boton_guardar" ).disabled = false;
		}
	}
}

function eliminarError( padre, error ){
	if( error != null )
		padre.removeChild( error );
}