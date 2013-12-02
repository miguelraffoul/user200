function mostrarRubro(){
	$.ajax({
		url: 'index.php?ctl=ciclo_modificar&act=mostrar_datos',
		dataType: 'json',
		success: function( json ){
			if( Array.isArray( json ) ){
				
			}

		},
		error: function(){
			alert( "No se pudo mostrar ciclo" );
		}
	});
}