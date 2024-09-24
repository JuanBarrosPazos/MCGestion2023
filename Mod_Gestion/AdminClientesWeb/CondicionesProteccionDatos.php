<?php
global $rutaHeader;		$rutaHeader = "../";
require $rutaHeader.'Inclu/Inclu_Header.php';

global $DivAsterisco;
$DivAsterisco = "<div style='color:#F1BD2D; display:inline-block; vertical-align:top;'>*</div>";

global $StyleTextConte;
$StyleTextConte = "style='clear:both; margin:1.4em auto 1.4em auto; width:60%; float:none; font-size:1.1em;'";

global $StyleText;
$StyleText = "style='display:inline-block; width:96%;'";

  print("<div style='color:#F1BD2D; display:block; margin:1.4em auto 1.4em auto; width:fit-content; font-size: 1.4em;'>
            PROTECCION DE DATOS
        </div>

          <div class='limpiar'></div>

        <div ".$StyleTextConte.">
            ".$DivAsterisco."
            <div ".$StyleText.">
                EN VIRTUD DE LO ESTABLECIDO EN LA LEY ORGÁNICA 15/1999, DE 13 DE DICIEMBRE, DE PROTECCION DE DATOS DE CARACTER PERSONAL, SUS DATOS SERÁN INCORPORADOS A UNA BASE DE DATOS, Y FICHERO DE DATOS PERSONALES.
            </div>
        </div>

          <div class='limpiar'></div>
        
        <div ".$StyleTextConte.">
          ".$DivAsterisco."
          <div ".$StyleText.">
                CON LA FINALIDAD DE PERMITIRLE EL ACCESO A LA ZONA RESTRIGIDA DE DESCARGAS, DONDE ENCOTRARÁ LOS TUTORIALES DE LIBRE DISTRIBUCIÓN O PROPIEDAD DE JUAN BARRÓS, DE LOS CUALES PODRÁ DISPONER CONFORME A LAS 
                <a href='CondicionesUso.php' target='_blank'> CONDICIONES DE USO</a>
                , ESTABLECIDAS EN EL APARTADO ANEXO.
          </div>
        </div>

          <div class='limpiar'></div>

        <div ".$StyleTextConte.">
            ".$DivAsterisco."
            <div ".$StyleText.">
                REMITIRLE LAS ÚLTIMAS NOVEDADES ASÍ COMO PARA MANTENERLE PERMANENETEMENTE INFORMADO SOBRE LAS ACITVIDADES Y NOVEDADES EN LOS PRODUCOTS Y SERVICIOS DE ESTA WEB.
            </div>
        </div>

          <div class='limpiar'></div>

        <div ".$StyleTextConte.">
            ".$DivAsterisco."
            <div ".$StyleText.">
            ASIMISMO, LE INFORMAMOS QUE EL FICHERO Y LA BASE DATOS, A LOS QUE SE INCORPORAN SUS DATOS SE ALOJA EN EL SERVIDOR DE JUAN BARRÓS PAZOS, UBICADO EN ESPAÑA.
            </div>
        </div>

          <div class='limpiar'></div>

        <div ".$StyleTextConte.">
            ".$DivAsterisco."
            <div ".$StyleText.">
              USTED PUEDE EJERCITAR LOS DERECHOS DE ACCESO, RECTIFICACIÓN, CANCELACIÓN Y OPOSICIÓN AL TRATAMIENTO DE SUS DATOS PERSONALES, UTILIZANDO LAS HERRAMIENTAS QUE SE PONEN A SU DISPOSICIÓN EN LA WEB A LA QUE ESTÁ ACCEDIENDO O POR CORREO ELECTRÓNICO NOTIFICANDOLO A 
              <a href='mailto:juanbarrospazos@live.com?subject=Baja de la Base de Datos 3D CAD&body=DESEO QUE MIS DATOS SEAN BORRADOS TOALMENTE DE LA BASE DE DATOS Y DE TODOS LOS FICHEROS ANEXOS, PARA LO CUÁL LE ADJUNTO MIS DATOS DE USUARIO.'>juanbarrospazos@live.com</a>, 
              O DIREGIÉNDOSE POR ESCRITO A JUAN BARRÓS PAZOS, C/. POR DEFINIR, PALMA DE MALLORCA, ESPAÑA.
           </div>
        </div>

          <div class='limpiar'></div>");

    require '../Inclu/Inclu_Footer.php';

    global $Redir;
    $Redir = "<script type='text/javascript'>
                    function redir(){ window.close(); }
                    setTimeout('redir()',120000); /* microsegundos */
                </script>";
    print ($Redir);

?>