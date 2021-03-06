function eliminarDiaInhabil( dia_inhabil ){

	var div_dias_inhabiles = document.getElementById( "dias_inhabiles" );
	dias_inhabiles.removeChild( dia_inhabil.parentNode );

}



function agregarDiaInhabil(){
	
	var div_dias_inhabiles = document.getElementById( "dias_inhabiles" );
	var div_dia = document.getElementById( "dia_inhabil_template" )

	var nuevo_dia_inhabil = div_dia.cloneNode( true );
	nuevo_dia_inhabil.removeAttribute( "id" );
	nuevo_dia_inhabil.removeAttribute( "style" );

	div_dias_inhabiles.insertBefore( nuevo_dia_inhabil, div_dias_inhabiles.firstChild );

	return nuevo_dia_inhabil;
}


function mostrarListaCiclos(){

	$.ajax({
		url: 'index.php?ctl=ciclo_escolar&act=listar_ciclos',
		dataType: 'json',
		success: function( json ){
			if( Array.isArray( json ) ){
				var elemento_lista_temp = document.getElementById( 'template' );

				for( i in json ){

					var nuevo_elemento = elemento_lista_temp.cloneNode( true );
					nuevo_elemento.removeAttribute( "style" );
					nuevo_elemento.setAttribute( "id", json[i].idCicloEscolar );
					
					var input_ciclo = nuevo_elemento.getElementsByTagName( "input" );
					input_ciclo[0].setAttribute( "value", json[i].idCicloEscolar );

					var enlace = nuevo_elemento.getElementsByTagName( "a" );
					enlace[1].appendChild( document.createTextNode( "Ciclo " + json[i].idCicloEscolar ) );
					document.getElementById( "lista_ciclos" ).appendChild( nuevo_elemento );
				
				}
			}
		},
		error: function () {
        	alert("No funcionó la carga de ciclos");
      	}
	});
}


function enviar( ciclo ){
	ciclo.parentNode.submit();
}


function  mostrarCiclo(){
	$.ajax({
		url: 'index.php?ctl=ciclo_modificar&act=mostrar_datos',
		dataType: 'json',
		success: function( json ){
			if( Array.isArray( json ) ){
				var titulo = document.createTextNode( "Ciclo " + json[0].idCicloEscolar );
				document.getElementById( "titulo" ).appendChild( titulo );

				var option = document.createElement( "option" );
				option.appendChild( document.createTextNode( json[0].idCicloEscolar ) );
				document.getElementById( "ciclo_select" ).appendChild( option );

				document.getElementById( "inicio_ciclo" ).value = formatoFecha( json[0].inicio );
				document.getElementById( "fin_ciclo" ).value = formatoFecha( json[0].fin );

				for( var i = 1 ; i < json.length ; ++i ){
					var nuevo_dia_inhabil = agregarDiaInhabil();
					var temp = nuevo_dia_inhabil.getElementsByTagName( "input" );
					temp[0].setAttribute( "value", formatoFecha( json[i].fecha ) );

					temp = nuevo_dia_inhabil.getElementsByTagName( "textarea" );
					temp[0].appendChild( document.createTextNode( json[i].motivo ) );
				}
			}
		},
		error: function(){
			alert( "No funciono mostrar Ciclo en modificar" );
		}
	});
}

function eliminarCiclo( ciclo ){
	var id = ciclo.parentNode.parentNode.id;
	
	$.ajax({
		type: 'POST',
		data: {id_ciclo:id},
		url: 'index.php?ctl=ciclo_escolar&act=modificar',
		success: function (){
			window.location.replace( 'index.php?ctl=ciclo_escolar&act=mostrar_pagina' );
		},
		error: function (){
			alert( "no funciona" );
		}
	});
}


function formatoFecha( fecha ){
	var fecha_formato = fecha.split( "-" );
	var temp = fecha_formato[2] + "/" + fecha_formato[1] + "/" + fecha_formato[0]; 
	return temp;
}