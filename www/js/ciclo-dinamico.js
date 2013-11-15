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
			if( json !== false ){
				var elemento_lista_temp = document.getElementById( 'template' );
				for( i in json ){

					var nuevo_elemento = elemento_lista_temp.cloneNode();
					nuevo_elemento.removeAttribute( "style" );
					nuevo_elemento.removeAttribute( "id" );
					
					var input_ciclo = nuevo_elemento.getElementsByTagName( "input" );
					input_ciclo[0].setAttribute( "value", json[i].idCicloEscolar );

					var enlace = nuevo_elemento.getElementsByTagName( "a" );
					enlace[0].appendChild( document.createTextNode( "Ciclo " + json[i].idCicloEscolar ) );
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
			if( json !== false ){
				document.getElementById( "ciclo_select" ).value = json[0].idCicloEscolar ;
				document.getElementById( "inicio_ciclo" ).value = json[0].inicio;
				document.getElementById( "fin_ciclo" ).value = json[0].fin;
			}
			console.log( json );
		},
		error: function(){
			alert( "No funciono mostrar Ciclo en modificar" );
		}
	});
}