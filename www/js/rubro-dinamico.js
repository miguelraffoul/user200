function mostrarRubro(){
	$.ajax({
		url: 'index.php?ctl=rubro_modificar&act=mostrar_datos',
		dataType: 'json',
		success: function( json ){
			if( Array.isArray( json) ){
				document.getElementById( "titulo_rubro" ).textContent = json[0].nombre;
				document.getElementById( "nombre_rubro" ).value = json[0].nombre;
				document.getElementById( "valor_rubro" ).value = json[0].valor;
			}
		},
		error: function(){
			alert( "No se pudo mostrar ciclo" );
		}
	});
}


function mostrarColumnasRubro( tiene_columnas_extra_checkbox ){
	var div_columnas_rubro = document.getElementById( "div_columnas_rubro" ); 

	if( tiene_columnas_extra_checkbox.checked )
		div_columnas_rubro.setAttribute( "style", "display: block;" );
	else
		div_columnas_rubro.setAttribute( "style", "display: none;" );

}