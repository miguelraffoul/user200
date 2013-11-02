function validarFormInicio () {
	var error = document.getElementById( 'inicio_error' );
	if( error != null ) {
		error.parentNode.removeChild( error );
	}

	var codigo = document.getElementById( 'codigo' );
	var pass = document.getElementById( 'pass' );

	var mensaje_error = "Llenar ambos campos correctamente";
	var div = document.createElement( 'div' );
	div.setAttribute( 'class', 'error' );
	div.setAttribute( 'id', 'inicio_error' );
	div.appendChild( document.createTextNode( mensaje_error ) );

	if( codigo.value.trim() == "" || pass.value.trim() == "" ) {
		codigo.parentNode.insertBefore( div, codigo );
	}
	else {
		pass.value = sha1( pass.value );
		document.getElementById( 'formulario_inicio' ).submit();
	}
}

function validarNombre() {
	var nombre = document.getElementById( 'nombre' );
	var nombre_error = document.getElementById( 'nombre_error' );
	if( nombre_error != null )
		nombre_error.parentNode.removeChild( nombre_error );
	if( nombre.value.trim() != "" ) {
		var reg_exp = /^[a-z\s]+$/i;
		if( !reg_exp.test( nombre.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'nombre_error' );
			div.appendChild( document.createTextNode( "Utiliza unicamente letras" ) );

			var padre = nombre.parentNode;
			padre.insertBefore( div, nombre.nextSibling );
		}
		else
			return true;
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'nombre_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = nombre.parentNode;
		padre.insertBefore( div, nombre.nextSibling );
	}

	return false;
}

function validarCodigo()  {
	var codigo = document.getElementById( 'codigo' );
	var codigo_error = document.getElementById( 'codigo_error' );
	if( codigo_error != null )
		codigo_error.parentNode.removeChild( codigo_error );
	if( codigo.value != "" ) {
		var reg_exp = /^[0-9a-z]+$/i;
		if( !reg_exp.test( codigo.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'codigo_error' );
			div.appendChild( document.createTextNode( "Utiliza unicamente letras y digitos" ) );

			var padre = codigo.parentNode;
			padre.insertBefore( div, codigo.nextSibling );
		}
		else
			return true;
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'codigo_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = codigo.parentNode;
		padre.insertBefore( div, codigo.nextSibling );
	}

	return false;
}

function validarSelect( id_select ) {
	var select = document.getElementById( id_select );
	var select_error = document.getElementById( id_select + '_error' );
	if( select_error != null )
		select_error.parentNode.removeChild( select_error );
	if( select.selectedIndex == 0  ) {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', id_select + '_error' );
		div.appendChild( document.createTextNode( 'Selecciona ' + id_select ) );

		var padre = select.parentNode;
		padre.insertBefore( div, select.nextSibling );

		return false;
	}
	return true;
}

function validarCorreo() {
	var mail = document.getElementById( 'mail' );
	var mail_error = document.getElementById( 'mail_error' );
	if( mail_error != null )
		mail_error.parentNode.removeChild( mail_error );
	if( mail.value != "" ) {
		var reg_exp = /^[a-z0-9][a-z0-9_\.]+@[a-z0-9_\.]+\.[a-z]+$/i;
		if( !reg_exp.test( mail.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'mail_error' );
			div.appendChild( document.createTextNode( "Formato Incorrecto" ) );

			var padre = mail.parentNode;
			padre.insertBefore( div, mail.nextSibling );
		}
		else
			return true;
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'mail_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = mail.parentNode;
		padre.insertBefore( div, mail.nextSibling );
	}
	return false;
}

function validarEnvioRecupera(){
	if( validarCorreo() ){
		document.getElementById( 'formulario' ).submit();
		window.location.href = "EnvioRecupera.html";
	}
}


function validarCelular() {
	var celular = document.getElementById( 'celular' );
	var celular_error = document.getElementById( 'celular_error' );
	if( celular_error != null )
		celular_error.parentNode.removeChild( celular_error );
	if( celular.value != "" ) {
		var reg_exp = /^[0-9]+$/;
		if( !reg_exp.test( celular.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'celular_error' );
			div.appendChild( document.createTextNode( "Introduce unicamente digitos" ) );

			var padre = celular.parentNode;
			padre.insertBefore( div, celular.nextSibling );
		}
		else
			return true;
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'celular_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = celular.parentNode;
		padre.insertBefore( div, celular.nextSibling );
	}

	return false;
}

function validarCampoOcional( campo_id ) {
	var campo = document.getElementById( campo_id );
	var campo_error = document.getElementById( campo_id + '_error' );
	if( campo_error != null )
		campo_error.parentNode.removeChild( campo_error );
	if( campo.value.trim() == "" ) {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', campo_id + '_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = campo.parentNode;
		padre.insertBefore( div, campo.nextSibling );

		return false;
	}

	return true;
}

function estaActivado( checkbox ) {
	if( checkbox.checked ) {
		if( checkbox.id == "tiene_celular" ) {
			var campo = document.getElementById( 'campo_celular' );
			campo.setAttribute( 'style', 'display: block' );
		}
		else if( checkbox.id == "tiene_github" ) {
			var campo = document.getElementById( 'campo_github' );
			campo.setAttribute( 'style', 'display: block' );
		}
		else { //tiene_pagina
			var campo = document.getElementById( 'campo_pagina' );
			campo.setAttribute( 'style', 'display: block' );
		}

	}
	else {
		if( checkbox.id == "tiene_celular" ) {
			var campo = document.getElementById( 'campo_celular' );
			campo.setAttribute( 'style', 'display: none' );

			var celular_error = document.getElementById( 'celular_error' );
			if( celular_error != null )
				celular_error.parentNode.removeChild( celular_error );
		}
		else if( checkbox.id == "tiene_github" ) {
			var campo = document.getElementById( 'campo_github' );
			campo.setAttribute( 'style', 'display: none' );
		
			var github_error = document.getElementById( 'cuenta_git_error' );
			if( github_error != null )
				github_error.parentNode.removeChild( github_error );
		}
		else { //tiene_pagina
			var campo = document.getElementById( 'campo_pagina' );
			campo.setAttribute( 'style', 'display: none' );
		
			var pagina_error = document.getElementById( 'pagina_web_error' );
			if( pagina_error != null )
				pagina_error.parentNode.removeChild( pagina_error );
		}
	}
}

function validarFormAltaAlumno() {

	var nombre_valido, codigo_valido, carrera_valida, correo_valido;

	nombre_valido = validarNombre();
	codigo_valido =validarCodigo();
	carrera_valida = validarSelect( 'carrera' );
	correo_valido = validarCorreo();

	var celular_valido, cuenta_valida, pagina_valida;


	var celular = document.getElementById( 'tiene_celular' );
	if( celular.checked )
		celular_valido = validarCelular();
	else
		celular_valido = true;

	var github = document.getElementById( 'tiene_github' );
	if( github.checked )
		cuenta_valida = validarCampoOcional( 'cuenta_git' );
	else
		cuenta_valida = true;

	var pagina = document.getElementById( 'tiene_pagina' );
	if( pagina.checked )
		pagina_valida = validarCampoOcional( 'pagina_web' );
	else
		pagina_valida = true;

	if( nombre_valido && codigo_valido && carrera_valida && correo_valido &&
		celular_valido && cuenta_valida && pagina_valida )
		document.getElementById( 'formulario_registro' ).submit();
}


function validarAltaArchivo() {
	var archivo = document.getElementById( 'archivo' );
	var archivo_error = document.getElementById( 'archivo_error' );
	if( archivo_error != null )
		archivo_error.parentNode.removeChild( archivo_error );
	if( archivo.value == "" ) {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'archivo_error' );
		div.appendChild( document.createTextNode( "Debes seleccionar un archivo" ) );

		archivo.parentNode.insertBefore( div, archivo.nextSibling );
	}
	else{
		document.getElementById( 'formulario_registro' ).submit();
	}
}

function validarFormModifAlumno() {

	var nombre_valido, codigo_valido, carrera_valida, correo_valido;

	nombre_valido = validarNombre();
	codigo_valido = validarCodigo();
	carrera_valida = validarSelect( 'carrera' );
	correo_valido = validarCorreo();

	if( nombre_valido && codigo_valido && carrera_valida && correo_valido )
		document.getElementById( 'form_modificar_alumno' ).submit();
}

function validarGenerico( id_elemento ) {
	var elemento = document.getElementById( id_elemento );
	var elemento_error = document.getElementById( id_elemento + '_error' );
	if( elemento_error != null )
		elemento_error.parentNode.removeChild( elemento_error );
	if( elemento.value.trim() != "" ) {
		var reg_exp = /^[a-z0-9\s]+$/i;
		if( !reg_exp.test( elemento.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', id_elemento + '_error' );
			div.appendChild( document.createTextNode( "Formato no valido" ) );

			var padre = elemento.parentNode;
			padre.insertBefore( div, elemento.nextSibling );
			
			return false;
		}
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', id_elemento + '_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = elemento.parentNode;
		padre.insertBefore( div, elemento.nextSibling );
	
		return false;
	}
	return true;
}

function validarDiaCurso( div_dia ) {
	var inputs = div_dia.getElementsByTagName( 'input' );
	var horas_dia = inputs[0].value;
	var hora_inicio = inputs[1].value;
	
	if( horas_dia.trim() != "" ) {
		var reg_exp = /^[0-9]+$/;
		if( reg_exp.test( horas_dia ) ) {
			if( horas_dia <= 0 || horas_dia > 24 )
				return false;
		}
		else
			return false;
	}
	else
		return false;

	if( hora_inicio.trim() != "" ) {
		var reg_exp = /^[0-9]{1,2}\:[0-9]{1,2}$/;
		if( reg_exp.test( hora_inicio ) ) {
			var arreglo_hora = hora_inicio.split( ":" );
			if( arreglo_hora[0] < 0 || arreglo_hora[0] >= 24 )
				return false;
			if( arreglo_hora[1] < 0 || arreglo_hora[1] >= 60 )
				return false;
		}
		else
			return false;
	}
	else
		return false;


	return true;
}

function validarHorario() {
	var div_horario = document.getElementById( 'alta_curso_der' );

	var error = document.getElementById( 'horario_error' );
	if( error != null )
		div_horario.removeChild( error );

	var select_dias = document.getElementById( 'dias_curso' );
	if( select_dias.selectedIndex == 0 ) {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'horario_error' );
		div.appendChild( document.createTextNode( "Selecciona por lo menos un dia de clase" ) );
		div_horario.appendChild( div );

		return false;
	}
	
	var dias = $( '.dia_curso' ).toArray();
	dias.shift();
	for( var i = 0; i < dias.length; ++i ) {
		if( !validarDiaCurso( dias[i] ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'horario_error' );
			div.appendChild( document.createTextNode( "Llenar todos los campos correctamente" ) );
			div_horario.appendChild( div );
			
			return false;
		}
	}

	return true;
}

function validarFormRegistroCurso() {
	var nombre = validarGenerico( 'nombre' );
	var seccion = validarGenerico( 'seccion' ); 
	var academia = validarGenerico( 'academia' );
	var ciclo = validarSelect( 'ciclo' ); 
	var horario = validarHorario();

	//validacion NRC
	var nrc = document.getElementById( 'nrc' );
	var nrc_error = document.getElementById( 'nrc_error' );
	if( nrc_error != null )
		nrc_error.parentNode.removeChild( nrc_error );
	if( nrc.value.trim() != "" ) {
		var reg_exp = /^[0-9]+$/;
		if( !reg_exp.test( nrc.value ) ) {
			var div = document.createElement( 'div' );
			div.setAttribute( 'class', 'error' );
			div.setAttribute( 'id', 'nrc_error' );
			div.appendChild( document.createTextNode( "Utiliza unicamente digitos" ) );

			var padre = nrc.parentNode;
			padre.insertBefore( div, nrc.nextSibling );
		}
		else {
			if( nombre && seccion && academia && ciclo && horario ) {
				document.getElementById( 'alta_curso' ).submit();
			}
		}
	}
	else {
		var div = document.createElement( 'div' );
		div.setAttribute( 'class', 'error' );
		div.setAttribute( 'id', 'nrc_error' );
		div.appendChild( document.createTextNode( "Rellena este campo" ) );

		var padre = nrc.parentNode;
		padre.insertBefore( div, nrc.nextSibling );
	}
}

function validarFormCambioPass() {

	var error = document.getElementById( 'cambio_error' );
	if( error != null ) {
		error.parentNode.removeChild( error );
	}

	var pass_actual = document.getElementById( 'pass_actual' );
	var nuevo_pass = document.getElementById( 'nuevo_pass' );
	var confirmacion = document.getElementById( 'confirmacion' );

	var div = document.createElement( 'div' );
	div.setAttribute( 'class', 'error' );
	div.setAttribute( 'id', 'cambio_error' );

	if( pass_actual.value.trim() != "" && nuevo_pass.value.trim() != "" && confirmacion.value.trim() != "" ) {		
		if( nuevo_pass.value != confirmacion.value ) {
			pass_actual.value = "";
			nuevo_pass.value = "";
			confirmacion.value = "";
			
			div.appendChild( document.createTextNode( 'La nueva constraseña no coincide' ) );
			confirmacion.parentNode.insertBefore( div, confirmacion.nextSibling  );
		}
		else {
			pass_actual.value = sha1( pass_actual.value );
			nuevo_pass.value = sha1( nuevo_pass.value );
			confirmacion.value = sha1( confirmacion.value );

			document.getElementById( 'formulario' ).submit();
		}
	}
	else {
		pass_actual.value = "";
		nuevo_pass.value = "";
		confirmacion.value = "";

		div.appendChild( document.createTextNode( 'Llenar todos los campos' ) );
		confirmacion.parentNode.insertBefore( div, confirmacion.nextSibling );
	}
}




/****			HELPER FUNCTIONS 			***/

function utf8_encode (argString) {
  // http://kevin.vanzonneveld.net
  // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: sowberry
  // +    tweaked by: Jack
  // +   bugfixed by: Onno Marsman
  // +   improved by: Yves Sucaet
  // +   bugfixed by: Onno Marsman
  // +   bugfixed by: Ulrich
  // +   bugfixed by: Rafal Kukawski
  // +   improved by: kirilloid
  // +   bugfixed by: kirilloid
  // *     example 1: utf8_encode('Kevin van Zonneveld');
  // *     returns 1: 'Kevin van Zonneveld'

  if (argString === null || typeof argString === "undefined") {
    return "";
  }

  var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  var utftext = '',
    start, end, stringl = 0;

  start = end = 0;
  stringl = string.length;
  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;

    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(
         (c1 >> 6)        | 192,
        ( c1        & 63) | 128
      );
    } else if (c1 & 0xF800 != 0xD800) {
      enc = String.fromCharCode(
         (c1 >> 12)       | 224,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    } else { // surrogate pairs
      if (c1 & 0xFC00 != 0xD800) { throw new RangeError("Unmatched trail surrogate at " + n); }
      var c2 = string.charCodeAt(++n);
      if (c2 & 0xFC00 != 0xDC00) { throw new RangeError("Unmatched lead surrogate at " + (n-1)); }
      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(
         (c1 >> 18)       | 240,
        ((c1 >> 12) & 63) | 128,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    }
    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }
      utftext += enc;
      start = end = n + 1;
    }
  }

  if (end > start) {
    utftext += string.slice(start, stringl);
  }

  return utftext;
}

function sha1 (str) {
  // http://kevin.vanzonneveld.net
  // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // + namespaced by: Michael White (http://getsprink.com)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // -    depends on: utf8_encode
  // *     example 1: sha1('Kevin van Zonneveld');
  // *     returns 1: '54916d2e62f65b3afa6e192e6a601cdbe5cb5897'
  var rotate_left = function (n, s) {
    var t4 = (n << s) | (n >>> (32 - s));
    return t4;
  };

/*var lsb_hex = function (val) { // Not in use; needed?
    var str="";
    var i;
    var vh;
    var vl;

    for ( i=0; i<=6; i+=2 ) {
      vh = (val>>>(i*4+4))&0x0f;
      vl = (val>>>(i*4))&0x0f;
      str += vh.toString(16) + vl.toString(16);
    }
    return str;
  };*/

  var cvt_hex = function (val) {
    var str = "";
    var i;
    var v;

    for (i = 7; i >= 0; i--) {
      v = (val >>> (i * 4)) & 0x0f;
      str += v.toString(16);
    }
    return str;
  };

  var blockstart;
  var i, j;
  var W = new Array(80);
  var H0 = 0x67452301;
  var H1 = 0xEFCDAB89;
  var H2 = 0x98BADCFE;
  var H3 = 0x10325476;
  var H4 = 0xC3D2E1F0;
  var A, B, C, D, E;
  var temp;

  str = utf8_encode(str);
  var str_len = str.length;

  var word_array = [];
  for (i = 0; i < str_len - 3; i += 4) {
    j = str.charCodeAt(i) << 24 | str.charCodeAt(i + 1) << 16 | str.charCodeAt(i + 2) << 8 | str.charCodeAt(i + 3);
    word_array.push(j);
  }

  switch (str_len % 4) {
  case 0:
    i = 0x080000000;
    break;
  case 1:
    i = str.charCodeAt(str_len - 1) << 24 | 0x0800000;
    break;
  case 2:
    i = str.charCodeAt(str_len - 2) << 24 | str.charCodeAt(str_len - 1) << 16 | 0x08000;
    break;
  case 3:
    i = str.charCodeAt(str_len - 3) << 24 | str.charCodeAt(str_len - 2) << 16 | str.charCodeAt(str_len - 1) << 8 | 0x80;
    break;
  }

  word_array.push(i);

  while ((word_array.length % 16) != 14) {
    word_array.push(0);
  }

  word_array.push(str_len >>> 29);
  word_array.push((str_len << 3) & 0x0ffffffff);

  for (blockstart = 0; blockstart < word_array.length; blockstart += 16) {
    for (i = 0; i < 16; i++) {
      W[i] = word_array[blockstart + i];
    }
    for (i = 16; i <= 79; i++) {
      W[i] = rotate_left(W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16], 1);
    }


    A = H0;
    B = H1;
    C = H2;
    D = H3;
    E = H4;

    for (i = 0; i <= 19; i++) {
      temp = (rotate_left(A, 5) + ((B & C) | (~B & D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    for (i = 20; i <= 39; i++) {
      temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    for (i = 40; i <= 59; i++) {
      temp = (rotate_left(A, 5) + ((B & C) | (B & D) | (C & D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    for (i = 60; i <= 79; i++) {
      temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    H0 = (H0 + A) & 0x0ffffffff;
    H1 = (H1 + B) & 0x0ffffffff;
    H2 = (H2 + C) & 0x0ffffffff;
    H3 = (H3 + D) & 0x0ffffffff;
    H4 = (H4 + E) & 0x0ffffffff;
  }

  temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
  return temp.toLowerCase();
}