function mostrarHojaEvaluacion(){
	$.ajax({
		url: 'index.php?ctl=hoja_evaluacion&act=cargar_hoja',
		dataType: 'json',
		success: function( json ){
			if( Array.isArray( json ) ){
				var tr_columnas = document.getElementById( "tr_columnas" );
				var template_columna = document.getElementById( "template_columna" );

				for( var i = 0 ; i < json[0].length ; ++i ){
					var columna = template_columna.cloneNode();
					var nombre_columna = columna.getElementsByTagName( "input" );

					columna.removeAttribute( "id" );
					columna.removeAttribute( "style" );
					nombre_columna[0].setAttribute( "value", json[0][i].nombre );
					tr_columnas.appendChild( columna );
				}

				var tabla_body = document.getElementById( "filas_body" );
				var template_alumno = document.getElementById( "template_alumno" );
				var template_calificacion = document.getElementById( "template_calificacion" );
				var z = 0;

				for( var i = 0 ; i < json[1].length ; ++i ){
					var nuevo_tr = document.getElementById( "template_tr" ).cloneNode();
					nuevo_tr.removeAttribute( "id" );
					var alumno = template_alumno.cloneNode();
					var nombre_alumno = alumno.getElementsByTagName( "p" );

					alumno.removeAttribute( "id" );
					alumno.removeAttribute( "style" );
					nombre_alumno[0].appendChild( document.createTextNode( json[1][i].nombre ) );
					nuevo_tr.appendChild( alumno );
					

					for( var j = 0 ; j < json[0].length ; ++j ){
						var calificacion = template_calificacion.cloneNode();
						calificacion.removeAttribute( "id" );
						calificacion.removeAttribute( "style" );

						var input = calificacion.getElementsByTagName( "input" );
						input[0].setAttribute( "value", json[2][z].calificacion );
						z = z + 1;
						nuevo_tr.appendChild( calificacion );
					}
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