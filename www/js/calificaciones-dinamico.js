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
				for( var i = 0 ; i < json[1].length ; ++i )
					mostrarColumna( tr_columnas, columna_template.cloneNode(), json[1][i].nombre );
				mostrarColumna( tr_columnas, columna_template.cloneNode(), "Promedio"  );

				//imprimir alumnos
				var promedio_final_curso = 0;
				for( var i = 0 ; i < json[0].length ; ++i ){
					var nuevo_tr = tr_template.cloneNode();
					nuevo_tr.removeAttribute( "id" );
					var nuevo_alumno = celda_template.cloneNode();
					nuevo_alumno.setAttribute("class", "cell-columna-alumno" );
					nuevo_alumno.removeAttribute( "style" ); 
					nuevo_alumno.removeAttribute("id");
					nuevo_alumno.textContent = json[0][i].nombre;
					nuevo_tr.appendChild( nuevo_alumno );

					filas_body.appendChild( nuevo_tr );

					//imprimir calificaciones de rubro
					var promedio = 0;
					for( var j = 0 ; j < json[2].length ; ++j ){
						var rubro = json[2][j][i];
						mostrarCelda( nuevo_tr, celda_template.cloneNode(), rubro.calificacion );
						promedio = promedio + parseFloat( rubro.calificacion ) * ( parseFloat( json[1][j].valor ) / 100 );
					}
					mostrarCelda( nuevo_tr, celda_template.cloneNode(), promedio.toFixed(1) );
					promedio_final_curso = promedio_final_curso + parseFloat( promedio );
				}

				document.getElementById( "pt_nombre" ).setAttribute( "colspan", json[1].length + 1 );
				promedio_final_curso = promedio_final_curso / json[0].length;
				document.getElementById( "total_promedio" ).textContent = promedio_final_curso.toFixed(1);

			}
			else{
				var promedio = document.getElementById("promedio_celda");
				promedio.removeAttribute( "style" );
				promedio.removeAttribute( "id" );
			}
		},
		error: function (){
			alert( "No puede visualizarse la tabla." );
		}
	});
}


function mostrarColumna( tr_columnas, nueva_columna, valor ){
	nueva_columna.removeAttribute( "id" );
	nueva_columna.textContent = valor;
	tr_columnas.appendChild( nueva_columna );
}

function mostrarCelda( tr, nueva_celda, valor ){
	nueva_celda.removeAttribute( "style" ); 
	nueva_celda.removeAttribute("id");
	nueva_celda.textContent = valor;
	tr.appendChild( nueva_celda );
}