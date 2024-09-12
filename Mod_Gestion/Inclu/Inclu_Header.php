<?php

print('<!DOCTYPE html>
          <head>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta http-equiv="content-type" content="text/html" charset="utf-8" />
            <meta http-equiv="Content-Language" content="es-es">
            <META NAME="Language" CONTENT="Spanish">

            <meta name="description" content="Juan Manuel Barros Pazos, Descargas " />

            <meta name="keywords" content="Juan Manuel Barros Pazos, Descargas " />
            <meta name="robots" content="all, index, follow" />

            <meta name="audience" content="All" />

          <title>Juan Barros Pazos</title>
          <link href="'.$rutaHeader.'Css/gestion.css" rel="stylesheet" type="text/css" />

          <script src="'.$rutaHeader.'MenuVertical/SpryMenuBar.js" type="text/javascript"></script>
          <link href="'.$rutaHeader.'MenuVertical/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />

          <link href="'.$rutaHeader.'Images/favicon.png" type="favicon.ico" rel="shortcut icon" />

          <meta name="google-site-verification" content="eZH2zCJFS0R2mpv-pG5sLmYowSRSmDA48lBLzwfFj1I" />

          <script src="'.$rutaHeader.'Scripts/swfobject_modified.js" type="text/javascript"></script>');

?>

<script type="text/javascript">

 function hora(){
	var fecha = new Date()
	
	var diames = fecha.getDate()

	var daytext = fecha.getDay()
	if (daytext == 0)
	daytext = "Domingo"
	else if (daytext == 1)
	daytext = "Lunes"
	else if (daytext == 2)
	daytext = "Martes"
	else if (daytext == 3)
	daytext = "Miercoles"
	else if (daytext == 4)
	daytext = "Jueves"
	else if (daytext == 5)
	daytext = "Viernes"
	else if (daytext == 6)
	daytext = "Sabado"
 
	var mes = fecha.getMonth() + 1
	var ano = fecha.getYear()
	
	if (fecha.getYear() < 2000) 
	ano = 1900 + fecha.getYear()
	else 
	ano = fecha.getYear()
	
	var hora = fecha.getHours()
	var minuto = fecha.getMinutes()
	var segundo = fecha.getSeconds()
	
	if(hora>=12 && hora<=23)
	m="P.M"
	else
	m="A.M"
 
	if (hora < 10) {hora = "0" + hora}
	if (minuto < 10) {minuto = "0" + minuto}
	if (segundo < 10) {segundo = "0" + segundo}
 
 var nowhora = daytext + " " + diames + " / " + mes + " / " + ano + " - " + hora + ":" + minuto + ":" + segundo
 document.getElementById('hora').firstChild.nodeValue = nowhora
 tiempo = setTimeout('hora()',1000)
 }
 </script>

<script type="text/JavaScript">

  function limitat(elEvento, maximoCaracteres) {
    var elemento = document.getElementById("titulo");
  
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    if(codigoCaracter == 37 || codigoCaracter == 39) {
      return true;
    }
  
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

  </script>

  <script type="text/JavaScript">
    function limita(elEvento, maximoCaracteres) {
      var elemento = document.getElementById("modulos");
    
      var evento = elEvento || window.event;
      var codigoCaracter = evento.charCode || evento.keyCode;
      if(codigoCaracter == 37 || codigoCaracter == 39) {
        return true;
      }
    
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
</script>

<script type="text/JavaScript">

  function limitaa(elEvento, maximoCaracteres) {
    var elemento = document.getElementById("academia");
  
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    if(codigoCaracter == 37 || codigoCaracter == 39) {
      return true;
    }
  
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
</script>


<script type="text/JavaScript">

  function limitac(elEvento, maximoCaracteres) {
    var elemento = document.getElementById("coment");
  
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    if(codigoCaracter == 37 || codigoCaracter == 39) {
      return true;
    }
  
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
</script>

</head>

<body topmargin="0" onload="hora()">

<div id="Conte">
  <div id="head"> 
  	<span style="font-size:18px">JUAN MANUEL BARR&Oacute;S PAZOS<br></span>
	<font color="#fff"><span id="hora">000000</span></font>
   </div>
  <div style="clear:both"></div>
   
<!-- <div id="Caja2tut"> -->
  <div id="Caja2Admin">



