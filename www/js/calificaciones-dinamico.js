function mostrarTablaCalificaciones(){
	$.ajax({
		url: 'index.php?ctl=calificaciones&act=mostrar_datos',
		dataType: 'json',
		success: function( json ){
			var celda_template = document.getElementById( "celda_template" );
			if( Array.isArray( json[0] ) && Array.isArray( json[1] ) ){
				var filas_body = document.getElementById( "filas_body" );
				var tr_columnas = document.getElementById( "tr_columnas" ); 
				var columna_template = document.getElementById( "columna_template" );
				var celda_template = document.getElementById( "celda_template" );
				var tr_template = document.getElementById( "template_tr" );
				
				//imprimir columnas
				for( var i = 0 ; i < json[1].length ; ++i ){
					var nueva_columna = columna_template.cloneNode();
					nueva_columna.removeAttribute( "id" );
					nueva_columna.textContent = json[1][i].nombre;
					tr_columnas.appendChild( nueva_columna );
				}
				var nueva_columna = columna_template.cloneNode();
				nueva_columna.removeAttribute( "id" );
				nueva_columna.textContent = "Promedio";
				tr_columnas.appendChild( nueva_columna );

				//imprimir alumnos
				var promedio_final_curso = 0;
				for( var i = 0 ; i < json[0].length ; ++i ){
					var nuevo_tr = tr_template.cloneNode();
					nuevo_tr.removeAttribute( "id" );
					var nuevo_alumno = celda_template.cloneNode();
					nuevo_alumno.removeAttribute( "style" ); 
					nuevo_alumno.removeAttribute("id");
					nuevo_alumno.setAttribute("class", "cell-columna-alumno" );
					nuevo_alumno.textContent = json[0][i].nombre;
					nuevo_tr.appendChild( nuevo_alumno );
					filas_body.appendChild( nuevo_tr );
					//imprimir calificaciones de rubro
					var promedio = 0;
					for( var j = 0 ; j < json[2].length ; ++j ){
						var nueva_calificacion = celda_template.cloneNode();
						nueva_calificacion.removeAttribute( "style" ); 
						nueva_calificacion.removeAttribute("id");
						nueva_calificacion.textContent = json[2][j][i].calificacion;
						promedio = promedio + parseFloat( json[2][j][i].calificacion );
						nuevo_tr.appendChild( nueva_calificacion );
					}
					var nuevo_promedio = celda_template.cloneNode();
					nuevo_promedio.removeAttribute( "style" ); 
					nuevo_promedio.removeAttribute("id");
					promedio = promedio / json[2].length;
					nuevo_promedio.textContent = promedio.toFixed(1);
					nuevo_tr.appendChild( nuevo_promedio );
					promedio_final_curso = promedio_final_curso + parseFloat( promedio );
				}

				document.getElementById( "pt_nombre" ).setAttribute( "colspan", json[1].length + 1 );
				promedio_final_curso = promedio_final_curso / json[0].length;
				document.getElementById( "total_promedio" ).textContent = promedio_final_curso.toFixed(1);

			}
			else{
				celda_template.removeAttribute( "style" );
				celda_template.removeAttribute( "id" );
				celda_template.textContent = "Promedio";
			}
		},
		error: function (){
			alert( "No puede visualizarse la tabla." );
		}
	});
}