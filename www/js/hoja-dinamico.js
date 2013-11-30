function mostrarHojaEvaluacion(){
	$.ajax({
		url: 'index.php?ctl=hoja_evaluacion&act=cargar_hoja',
		dataType: 'json',
		success: function( json ){
			if( Array.isArray( json ) ){
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
					agregarPromedio( nuevo_tr, template_calificacion.cloneNode(), json[2][count].calificacion );
					count = count + 1;
					tabla_body.appendChild( nuevo_tr );
					document.getElementById( "pt_nombre" ).setAttribute( "colspan", json[0].length );
				}
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

