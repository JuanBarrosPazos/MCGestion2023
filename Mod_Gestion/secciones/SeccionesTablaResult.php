<?php

	    global $SeccionValor;       global $Title;

        global $SeccionNombre;
        $SeccionNombre = trim(str_replace(' ', '', $_POST['nombre']));
        $SeccionNombre = strtoupper(trim($SeccionNombre));
        global $Id;
        if(isset($_POST['id'])){ $Id = $_POST['id'];  }else{ $Id = ""; }
        global $TrId;
        $TrId = "<tr>
                    <td width=80px style='text-align:right;'>ID </td>
                    <td width=80px>".$Id."</td>
                </tr>";

    switch (true){
        case ((isset($_POST['nombre']))&&(!isset($_POST['id']))):
                $SeccionValor = trim(str_replace(' ', '', $_POST['nombre']));
                $TrId = "";
            break;
        case (isset($_POST['valor2'])):
                $SeccionValor = trim(str_replace(' ', '', $_POST['valor2']));
            break;
        case ((!isset($_POST['valor2']))&&(isset($_POST['valor']))):
                $SeccionValor = trim(str_replace(' ', '', $_POST['valor']));
            break;
        default:
            $SeccionNombre = "";     $SeccionValor = "";     $TrId = "";    $Title = "RESULTADOS";
            break;
    } // FIN SWITCH
    $SeccionValor = strtolower(trim($SeccionValor));

    global $TablaResultados;
    $TablaResultados = "<table align='center' style='margin-top:10px'>
                <tr>
                    <th colspan=2 style='text-align:center;' >
            <form name='crear' action='SeccionesCrear.php' method='POST' style='display: inline-block;' >
                <button type='submit' title='CREAR NUEVA SECCION' class='botonverde imgButIco AddBlack'></button>
                    <input type='hidden' name='oculto2' value=1 />
            </form>
            <form name='crear' action='SeccionesVer.php' method='POST' style='display: inline-block;'>
                <button type='submit' title='INICIO SECCIONES' class='botonverde imgButIco InicioBlack'></button>
                    <input type='hidden' name='oculto2' value=1 />
            </form>
            <form name='crear' action='SeccionesFeedVer.php' method='POST' style='display:inline-block;'>
                <button type='submit' title='INICIO SECCIONES FEEDBACK' class='botonazul imgButIco CachedBlack'>
                </button>
                    <input type='hidden' name='oculto2' value=1 />
            </form>
                    </th>
                </tr>				
                <tr>
                    <th colspan=2 style='text-align:center; color:#F1BD2D;' >".$Title."</th>
                </tr>
                ".$TrId."
                <tr>
                    <td style='text-align:right; width:80px;' >NOMBRE </td>
                    <td style='width:80px;'>".$SeccionNombre."</td>
                </tr>
                <tr>
                    <td style='text-align:right; width:80px;'>VALOR </td>
                    <td>".$SeccionValor."</td>
                </tr>				
            </table>"; 

?>