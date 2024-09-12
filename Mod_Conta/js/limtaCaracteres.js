
//<!--
// Esta función limita el número de carácteres del text area de titulo.
function limitat(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("titulo");
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfot(maximoCaracteres) {
  var elemento = document.getElementById("titulo");
  var info = document.getElementById("infot");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}

// Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 200);" onkeyup="actualizaInfo(200)" para limitar los caracteres a 200 en este caso.

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// Esta función limita el número de carácteres del text area de modulos.
function limita(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("modulos");
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfo(maximoCaracteres) {
  var elemento = document.getElementById("modulos");
  var info = document.getElementById("infom");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}

// Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 200);" onkeyup="actualizaInfo(200)" para limitar los caracteres a 200 en este caso.

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// Esta función limita el número de carácteres del text area de academia.
function limitaa(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("academia");
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfoa(maximoCaracteres) {
  var elemento = document.getElementById("academia");
  var info = document.getElementById("infoa");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}

// Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 200);" onkeyup="actualizaInfo(200)" para limitar los caracteres a 200 en este caso.

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// Esta función limita el número de carácteres del text area de academia.
function limitac(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("coment");
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfoc(maximoCaracteres) {
  var elemento = document.getElementById("coment");
  var info = document.getElementById("infoc");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+" caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}

// Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 200);" onkeyup="actualizaInfo(200)" para limitar los caracteres a 200 en este caso.

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
