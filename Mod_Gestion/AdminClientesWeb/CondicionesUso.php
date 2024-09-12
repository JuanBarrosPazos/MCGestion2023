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
            CONDICIONES DE USO
        </div>

          <div class='limpiar'></div>

        <div ".$StyleTextConte.">
            ".$DivAsterisco."
            <div ".$StyleText.">
                LOS USUARIOS SE COMPROMETEN A RESPETAR EL NOMBRE DEL AUTOR Y SU OBRA EN TODO MOMENTO.
            </div>
        </div>

          <div class='limpiar'></div>
        
        <div ".$StyleTextConte.">
          ".$DivAsterisco."
           <div ".$StyleText.">
             LA APROPIACIÓN DE LOS CRÉDITOS DEL AUTOR Y EL USO DE LOS CONTENIDOS AQUÍ PRESENTADOS NO SERÁ RESPONSABILIDAD DE LOS PROPIETARIOS DE ESTA WEB.
            </div>
        </div>

          <div class='limpiar'></div>

        <div ".$StyleTextConte.">
            ".$DivAsterisco."
            <div ".$StyleText.">
          AL REGISTRARME EN ESTA WEB Y ACCEDER A ELLA, HE ACEPTADO TODAS ESTAS CONDICIONES Y LAS MOIDFICACIONES FUTURAS QUE SE PUEDAN PRODUCIR EN ELLAS.
            </div>
        </div>

          <div class='limpiar'></div>");

  require '../Inclu/Inclu_Footer.php';

    global $Redir;  global $RedirUrl;   global $RedirUrl;
    $Redir = "<script type='text/javascript'>
                    function redir(){ window.close(); }
                    setTimeout('redir()',120000); /* microsegundos */
                </script>";
    print ($Redir);

?>
