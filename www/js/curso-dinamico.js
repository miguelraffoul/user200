function agregarDiaCurso( opcion ) {
	var opciones_select = document.getElementById( 'dias_curso' ).options;
	for( var i = 0; i < opciones_select.length; ++i ){
		if( opciones_select[i].value == opcion.value ) {
			opciones_select[i].setAttribute( 'disabled', 'disabled' );
			break;
		}
	}

	var plantilla = document.getElementById( 'dia_curso_template' );
	var nuevo_dia = plantilla.cloneNode();
	nuevo_dia.removeAttribute( 'style' );
	nuevo_dia.setAttribute( 'id', opcion.value );
	var input_dia = nuevo_dia.getElementsByTagName( 'input' );
	input_dia[0].value = diaValor( opcion.value );
	var titulo = nuevo_dia.getElementsByTagName( 'p' );
	titulo[0].appendChild( document.createTextNode( diaValor( opcion.value ) ) );

	document.getElementById( 'alta_curso_der' ).appendChild( nuevo_dia );
} 

function diaValor( valor ) {
	switch( valor ) {
		case '1':
			return 'Lunes';
		case '2':
			return 'Martes';
		case '3':
			return 'Miércoles';
		case '4':
			return 'Jueves';
		case '5':
			return 'Viernes'
		case '6':
			return 'Sábado';
	}
}

function valorDia( dia ) {
	switch( dia ) {
		case 'Lunes':
			return 1;
		case 'Martes':
			return 2;
		case 'Miércoles':
			return 3;
		case 'Jueves':
			return 4;
		case 'Viernes':
			return 5;
		case 'Sábado':
			return 6;
	}
}

function eliminarDiaCurso( dia ) {
	var opciones_select = document.getElementById( 'dias_curso' ).options;
	for( var i = 0; i < opciones_select.length; ++i ){
		if( opciones_select[i].value == dia.parentNode.id ) {
			opciones_select[i].removeAttribute( 'disabled' );
			break;
		}
	}
	document.getElementById( 'alta_curso_der' ).removeChild( dia.parentNode );
	if( document.getElementsByClassName( 'dia_curso' ).length  == 1 )
		document.getElementById( 'dias_curso').selectedIndex = 0;
}

function cargarAcademias() {
	$.ajax({
		url: 'index.php?ctl=registro_curso&act=carga_academias',
		dataType: 'json',
		success: function ( json ) {
			var select = document.getElementById( 'academia' );
			for( i in json ) {
				var option = document.createElement( 'option' );
				var texto = document.createTextNode( json[i].nombre );
				option.setAttribute( 'value', json[i].idDepartamento );
				option.appendChild( texto );
				select.appendChild( option );
			}
		},
		error: function () {
        	console.log( "no funciono carga de academias" );
      	}
	});
}

function cargarCursos( id_academia ) {
	var select = document.getElementById( 'curso' );
	var opciones = select.getElementsByTagName( 'option' );
	for( var it = opciones.length - 1; it > 0; --it )
		select.removeChild( opciones[it] );

	$.ajax({
		type: 'POST',
		data: {departamento:id_academia},
		url: 'index.php?ctl=registro_curso&act=carga_cursos',
		dataType: 'json',
		success: function( json ) {
			for( i in json ) {
				var option = document.createElement( 'option' );
				var texto = document.createTextNode( json[i].nombre );
				option.setAttribute( 'value', json[i].idAsignatura );
				option.appendChild( texto );
				select.appendChild( option );
			}
		},
		error: function() {
			console.log( "error ajax" );
		} 
	});
}

function establecerAsignatura( asignatura ) {
	var opciones = asignatura.getElementsByTagName( 'option' );
	document.getElementById( 'asignatura' ).value = opciones[asignatura.selectedIndex].text;
}

function cargarCiclos() {
	$.ajax({
		url: 'index.php?ctl=registro_curso&act=carga_ciclos',
		dataType: 'json',
		success: function ( json ) {
			var select = document.getElementById( 'ciclo' );
			for( i in json ) {
				var option = document.createElement( 'option' );
				var texto = document.createTextNode( json[i].idCicloEscolar );
				option.setAttribute( 'value', json[i].idCicloEscolar );
				option.appendChild( texto );
				select.appendChild( option );
			}
		},
		error: function () {
        	console.log( "no funciono carga de ciclos" );
      	}
	});
}

function mostrarListaCursos() {
	$.ajax({
		url: 'index.php?ctl=profesor&act=carga_cursos',
		dataType: 'json',
		success: function( json ) {
			if( Array.isArray( json ) ) {
				var plantilla = document.getElementById( 'template' );
				for( i in json ) {
					var curso = plantilla.cloneNode();
					curso.removeAttribute( 'style' );
					curso.setAttribute( 'id', json[i].clave_curso );
					var curso_inputs = curso.getElementsByTagName( 'input' );
					curso_inputs[0].value = curso_inputs[1].value = curso_inputs[2].value =json[i].clave_curso;
					curso_inputs[3].value = json[i].nombre;
					var curso_enlace = curso.getElementsByTagName( 'a' );
					curso_enlace[0].appendChild( document.createTextNode( json[i].nombre + " - " + json[i].CicloEscolar_idCicloEscolar ) );
					document.getElementById( 'lista_cursos' ).appendChild( curso );
				}
			}
		},
		error: function() {
			alert( "No hay cursos disponibles" );
		}
	});
}

function eliminarCurso( boton ) {
	var id_curso = boton.parentNode.id;
	$.ajax({
		type: 'POST',
		data: {curso:id_curso},
		url: 'index.php?ctl=profesor&act=eliminar_curso',
		success: function() {
			window.location.replace( "index.php?ctl=profesor&act=cursos" );
		}
	});
}

function enviarForm( boton ) {
	boton.parentNode.submit();
}

function cargarDatosCursoModificar() {
	$.ajax({
		url: 'index.php?ctl=modificar_curso&act=cargar_datos',
		dataType: 'json',
		success: function( json ) {
			$.ajax({
				type: 'POST',
				data: {asignatura:json[0].asignatura_idAsignatura},
				url: 'index.php?ctl=modificar_curso&act=cargar_asignatura',
				dataType: 'json',
				success: function( json2 ) {
					var academia = document.getElementById( 'academia' );
					academia.value =  json2[0].Departamento_idDepartamento;
					$.ajax({
						type: 'POST',
						data: {departamento:json2[0].Departamento_idDepartamento},
						url: 'index.php?ctl=registro_curso&act=carga_cursos',
						dataType: 'json',
						success: function( json3 ) {
							var curso = document.getElementById( 'curso' );
							for( i in json3 ) {
								var option = document.createElement( 'option' );
								var texto = document.createTextNode( json3[i].nombre );
								option.setAttribute( 'value', json3[i].idAsignatura );
								option.appendChild( texto );
								curso.appendChild( option );
							}
							curso.value = json[0].asignatura_idAsignatura;		
						}
					});
				}
			});	
			document.getElementById( 'asignatura' ).value = json[0].nombre;
			document.getElementById( 'seccion' ).value = json[0].seccion;
			document.getElementById( 'ciclo' ).value = json[0].CicloEscolar_idCicloEscolar;
			document.getElementById( 'nrc' ).value = json[0].clave_curso;
		}
	});
}

function cargarDatosCursoClonar() {
	$.ajax({
		url: 'index.php?ctl=modificar_curso&act=cargar_datos',
		dataType: 'json',
		success: function( json ) {
			$.ajax({
				type: 'POST',
				data: {asignatura:json[0].asignatura_idAsignatura},
				url: 'index.php?ctl=modificar_curso&act=cargar_asignatura',
				dataType: 'json',
				success: function( json2 ) {
					var academia = document.getElementById( 'academia' );
					academia.value =  json2[0].Departamento_idDepartamento;
					$.ajax({
						type: 'POST',
						data: {departamento:json2[0].Departamento_idDepartamento},
						url: 'index.php?ctl=registro_curso&act=carga_cursos',
						dataType: 'json',
						success: function( json3 ) {
							var curso = document.getElementById( 'curso' );
							for( i in json3 ) {
								var option = document.createElement( 'option' );
								var texto = document.createTextNode( json3[i].nombre );
								option.setAttribute( 'value', json3[i].idAsignatura );
								option.appendChild( texto );
								curso.appendChild( option );
							}
							curso.value = json[0].asignatura_idAsignatura;
							curso.setAttribute( 'disabled', 'disabled' );
							document.getElementById( 'curso_oculto' ).value = json[0].asignatura_idAsignatura;		
						}
					});
					academia.setAttribute( 'disabled', 'disabled' );
				}
			});	
			document.getElementById( 'asignatura' ).value = json[0].nombre;
			document.getElementById( 'seccion' ).value = json[0].seccion;
			eliminarCicloActual( json[0].CicloEscolar_idCicloEscolar );
		}
	});
}

function eliminarCicloActual( ciclo ) {
	var opciones = document.getElementById( 'ciclo' ).options;
	for( var i = 0; i < opciones.length; ++i ) {
		if( opciones[i].value == ciclo ) {
			document.getElementById( 'ciclo' ).removeChild( opciones[i] );
			break;
		}
	}
}

function cargarDiasClase() {
	$.ajax({
		url: 'index.php?ctl=modificar_curso&act=cargar_dias_clase',
		dataType: 'json',
		success: function( json ) {
			var opciones_select = document.getElementById( 'dias_curso' ).options;
			for( i in json ) {
				var plantilla = document.getElementById( 'dia_curso_template' );
				var nuevo_dia = plantilla.cloneNode();
				nuevo_dia.removeAttribute( 'style' );
				nuevo_dia.setAttribute( 'id', valorDia( json[i].dia ) );
				var input_dia = nuevo_dia.getElementsByTagName( 'input' );
				input_dia[0].value = json[i].dia;
				var inicio = json[i].hora_inicio.split( ":" );
				var fin = json[i].hora_fin.split( ":" );
				input_dia[1].value = fin[0] - inicio[0];
				input_dia[2].value = json[i].hora_inicio;
				var titulo = nuevo_dia.getElementsByTagName( 'p' );
				titulo[0].appendChild( document.createTextNode( json[i].dia ) );
				document.getElementById( 'alta_curso_der' ).appendChild( nuevo_dia );
				for( var x = 1; x < opciones_select.length; ++x ){
					if( opciones_select[x].text == json[i].dia ) {
						opciones_select[x].setAttribute( 'disabled', 'disabled' );
						opciones_select[x].setAttribute( 'selected', 'selected' );
						break;
					}
				}
			}
		}
	});
}

function mostrarListaRubros(){
	$.ajax({
		url: 'index.php?ctl=curso_profesor&act=listar_rubros',
		dataType: 'json',
		success: function( json ){
			if( json !== false ){
				var elemento_lista_temp = document.getElementById( 'template' );
				for( i in json ){

					var nuevo_elemento = elemento_lista_temp.cloneNode();
					nuevo_elemento.removeAttribute( "style" );
					nuevo_elemento.removeAttribute( "id" );

					var td = nuevo_elemento.getElementsByTagName( 'td' );
					enlace_rubro = td[1].firstChild;
					enlace_rubro.setAttribute( "id", json[i].idRubro );
					enlace_rubro.appendChild( document.createTextNode(  json[i].nombre ) );
					enlace_valor = td[3];
					enlace_valor.appendChild( document.createTextNode( json[i].valor ) );
					document.getElementById( "lista_rubros" ).appendChild( nuevo_elemento );
				
				}
			}
		},
		error: function () {
        	alert("no funciono carga rubros");
      	}
	});
}

function eliminarRubrosSeleccionados() {
	var tabla_evaluacion = document.getElementById( 'tabla_evaluacion' );
	var checkboxes = tabla_evaluacion.getElementsByTagName( 'input' );
	
	var hay_rubros_seleccionados = false;
	var rubros_seleccionados = new Array();
	var tr_a_eliminar = new Array();
	for( var i = 2; i < checkboxes.length; ++i ) {
		if ( checkboxes[i].checked ) {
			hay_rubros_seleccionados = true;
			var tds = checkboxes[i].parentNode.parentNode.getElementsByTagName( 'td' )
			rubros_seleccionados.push( tds[1].firstChild.id );
			tr_a_eliminar.push( checkboxes[i].parentNode.parentNode );
		}
	}
	
	var div = document.getElementById( "evaluacion" );
	var error = document.getElementById( 'error_no_seleccion' );
	if( error != null )
		div.removeChild( error );	

	if( hay_rubros_seleccionados ) {
		var confirmacion = confirm( "Corfirme borrado de rubros" );
		if( confirmacion ){
			var tbody = tabla_evaluacion.getElementsByTagName( "tbody" ); 
			for( var i = 0 ; i < tr_a_eliminar.length ; ++i )
				tbody[0].removeChild( tr_a_eliminar[i] );
			eliminarRubros( rubros_seleccionados );
		}
	}
	else {
		error = document.createElement( 'div' );
		error.setAttribute( 'id', 'error_no_seleccion' );
		error.setAttribute( 'class', 'error' );
		error.appendChild( document.createTextNode( 'Seleccione por lo menos un rubro' ) );
		div.insertBefore( error, tabla_evaluacion.nextSibling );
	}
}

function eliminarRubros( id_rubros ) {
	//console.log( id_rubros );
	/*$.ajax({
		type: 'POST',
		data: {nombre:id},
		url: 'index.php?ctl=&act=eliminar_rubro',
		success: function() {
			window.location.replace( "index.php?ctl=curso_profesor&act=mostrar_pagina" );
		}
	});*/
}