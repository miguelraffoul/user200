function eliminarDiaInhabil( dia_inhabil ){

	var div_dias_inhabiles = document.getElementById( "dias_inhabiles" );
	dias_inhabiles.removeChild( dia_inhabil.parentNode );

}



function agregarDiaInhabil(){
	
	var div_dias_inhabiles = document.getElementById( "dias_inhabiles" );
	var div_dia = document.getElementById( "dia_inhabil_template" )

	var nuevo_dia_inhabil = div_dia.cloneNode();
	nuevo_dia_inhabil.removeAttribute( "id" );
	nuevo_dia_inhabil.removeAttribute( "style" );

	div_dias_inhabiles.insertBefore( nuevo_dia_inhabil, div_dias_inhabiles.firstChild );
}


function mostrarListaCiclos(){

	$.ajax({
		url: 'index.php?ctl=ciclo_escolar&act=listar_ciclos',
		dataType: 'json',
		success: function( json ){
			var elemento_lista_temp = document.getElementById( 'template' );
			for( i in json ){

				var nuevo_elemento = elemento_lista_temp.cloneNode();
				nuevo_elemento.removeAttribute( "style" );
				
				var enlace = document.createElement( "a" );
				enlace.setAttribute( "value", json[i].idCicloEscolar );
				enlace.setAttribute( "href", "javascript:abrirCiclo(this)" ); //"index.php?ctl=ciclo_nuevo&act=agregar_ciclo"

				enlace.appendChild( document.createTextNode( "Ciclo " + json[i].idCicloEscolar ) );
				nuevo_elemento.appendChild( enlace );
				document.getElementById( "lista_ciclos" ).appendChild( nuevo_elemento );
			}
		},
		error: function () {
        	alert("no funciono");
      	}
	});
}


function abrirCiclo( ciclo_seleccionado ){
	var id = ciclo_seleccionado.value;

	alert( id );

	/*$.ajax({
		type: 'POST';
		data: {id_ciclo:id},
		url: 'index.php?ctl=ciclo_modificar&act=mostrar_pagina'
		success: function(){
			alert("hola");
		}
	});*/
}