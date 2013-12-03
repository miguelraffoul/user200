function mostrarHojaEvaluacion(){
	$.ajax({
		url: 'index.php?ctl=hoja_evaluacion&act=mostrar_datos',
		dataType: 'json',
		success: function( json ){
			if( Array.isArray( json ) ){
				document.getElementById( "titulo_hoja" ).textContent = json[3].nombre;
				var tr_columnas = document.getElementById( "tr_columnas" );
				var template_columna = document.getElementById( "template_columna" );

				for( var i = 0 ; i < json[0].length - 1 ; ++i )
					agregarColumna( tr_columnas, template_columna.cloneNode(), json[0][i].nombre );
				agregarColumnaPromedio( tr_columnas, template_columna.cloneNode(), json[0][i].nombre );

				var tabla_body = document.getElementById( "filas_body" );
				var template_alumno = document.getElementById( "template_alumno" );
				var template_calificacion = document.getElementById( "template_calificacion" );
				var count = 0;
				var nuevo_tr;
				var promedio_total = 0;

				for( var i = 0 ; i < json[1].length ; ++i ){
					nuevo_tr = document.getElementById( "template_tr" ).cloneNode();
					nuevo_tr.removeAttribute( "id" );
					var alumno = template_alumno.cloneNode();
					var nombre_alumno = alumno.getElementsByTagName( "p" );

					alumno.removeAttribute( "id" );
					alumno.removeAttribute( "style" );
					nombre_alumno[0].appendChild( document.createTextNode( json[1][i].nombre ) );
					nuevo_tr.appendChild( alumno );
					

					for( var j = 0 ; j < json[0].length - 1 ; ++j ){
						agregarCalificacion( nuevo_tr, template_calificacion.cloneNode(), json[2][count].calificacion );
						count = count + 1;
					}
					promedio_total = promedio_total + parseFloat( json[2][count].calificacion );
					agregarPromedio( nuevo_tr, template_calificacion.cloneNode(), json[2][count].calificacion );
					count = count + 1;
					tabla_body.appendChild( nuevo_tr );
					document.getElementById( "pt_nombre" ).setAttribute( "colspan", json[0].length );
				}

				promedio_total = promedio_total / json[1].length;
				document.getElementById( "total_promedio" ).textContent = promedio_total.toFixed(1);
				//Remuevo el checkbox del th promedio
				var promedios = document.getElementsByClassName( "td-disabled" );
				var inputs = promedios[0].getElementsByTagName( "input" );
				promedios[0].removeChild( inputs[1] );
			}
		},
		error: function(){
			alert("No funcionó la carga de la hoja");
		}
	});
}

function agregarCalificacion( tr_padre, td_calificacion, valor_calificacion ){
	td_calificacion.removeAttribute( "id" );
	td_calificacion.removeAttribute( "style" );

	var input = td_calificacion.getElementsByTagName( "input" );
	input[0].setAttribute( "value", valor_calificacion );
	tr_padre.appendChild( td_calificacion );
}

function agregarPromedio( tr_padre, td_calificacion, valor_calificacion ){
	td_calificacion.removeAttribute( "id" );
	td_calificacion.removeAttribute( "style" );
	td_calificacion.setAttribute( "class", "td-disabled" );

	var input = td_calificacion.getElementsByTagName( "input" );
	input[0].readOnly = true;
	input[0].setAttribute( "value", valor_calificacion );
	tr_padre.appendChild( td_calificacion );
}

function agregarColumna( tr_padre, th_columna, nombre ){
	th_columna.removeAttribute( "id" );
	th_columna.removeAttribute( "style" );

	var nombre_columna = th_columna.getElementsByTagName( "input" );
	nombre_columna[0].setAttribute( "value", nombre );
	tr_padre.appendChild( th_columna );
}

function agregarColumnaPromedio( tr_padre, th_columna, nombre ){
	th_columna.removeAttribute( "id" );
	th_columna.removeAttribute( "style" );
	th_columna.setAttribute( "class", "td-disabled" );

	var nombre_columna = th_columna.getElementsByTagName( "input" );
	nombre_columna[0].readOnly = true;
	nombre_columna[0].setAttribute( "value", nombre );
	tr_padre.appendChild( th_columna );
}

function eliminarColumnas() {
	var error = document.getElementById( "error_eliminar" );
	if( error != null )
		error.parentNode.removeChild( error );

	var columnas = document.getElementsByTagName( "th" );
	var alumnos = document.getElementById( "filas_body" ).getElementsByTagName( "tr" );
	var bandera = true;
	for( var it = columnas.length - 2; it > 1; --it ) {
		if( !columnas[it].lastChild.previousSibling.checked )
			bandera = false;
	}
	if( !bandera ){
		var contador = 0;
		for( var it = columnas.length - 2; it > 1; --it ) {
			if( columnas[it].lastChild.previousSibling.checked ) {
				for( var it2 = 1; it2 < alumnos.length; ++it2 ) {
					var tds = alumnos[it2].getElementsByTagName( "td" );
					alumnos[it2].removeChild( tds[it - 1] );
				}
				++contador;
				columnas[it].parentNode.removeChild( columnas[it] );
			}
		}
		console.log( contador );
		var tab = document.getElementById( "pt_nombre" );
		tab.setAttribute( "colspan", Number( tab.getAttribute( "colspan" ) ) - contador );
	}
	else {
		var div = document.getElementById( "wrapper2" ); 
		error_eliminar = document.createElement( "div" );
		error_eliminar.setAttribute( "class", "error" );
		error_eliminar.setAttribute( "id", "error_eliminar" );
		error_eliminar.appendChild( document.createTextNode( "No es posible eliminar todas las columas." ) );
		div.insertBefore( error_eliminar, div.lastChild );
	}
}

function agregarColuma() {
	var columnas = document.getElementsByTagName( "th" );
	var nueva_columna = document.getElementById( "template_columna" ).cloneNode();
	nueva_columna.removeAttribute( "id" );
	nueva_columna.removeAttribute( "style" );
	nueva_columna.firstChild.nextSibling.value = "Columna " + (columnas.length - 2) ;
	var thead = document.getElementById( "tr_columnas" );
	thead.insertBefore( nueva_columna, thead.lastChild );

	var template_calificacion = document.getElementById( "template_calificacion" );
	var alumnos = document.getElementById( "filas_body" ).getElementsByTagName( "tr" );	
	for( var it = 1; it < alumnos.length; ++it ) {
		var nueva_celda = template_calificacion.cloneNode();
		nueva_celda.removeAttribute( "id" );
		nueva_celda.removeAttribute( "style" );
		nueva_celda.firstChild.nextSibling.value = 0;
		alumnos[it].insertBefore( nueva_celda, alumnos[it].lastChild );
	}

	var tab = document.getElementById( "pt_nombre" );
	tab.setAttribute( "colspan", Number( tab.getAttribute( "colspan" ) ) + 1 );
}