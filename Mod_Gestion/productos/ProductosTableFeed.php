<?php

    global $TdBorrado;  
    if(isset($_POST['borrado'])){
            $TdBorrado = "<tr>
                            <td style='text-align:right;'>BORRADO</td>
                            <td>".$_POST['borrado']."</td>
                        </tr> ";
    }else{ $TdBorrado = ""; }

    global $TableFeed;
    $TableFeed = "<table align='center' style='margin-top:10px;' >
                    <tr>
                        <th colspan=2 style='color:#F1BD2D;'>
                        ".$TitleForm."
                        </th>
                    </tr>
                    <tr>
                        <td colspan=2 style='text-align:right;' >".$ProductosBotonera."</td>
                    </tr>
                    <tr>
                        <td style='text-align:right; width:100px;' >SECCION</td>
                        <td>".$_POST['seccion']."</td>
                    </tr>				
                    <tr>
                        <td style='text-align:right;' >ID </td>
                        <td>".$_POST['id']."</td>
                    </tr>				
                    <tr>
                        <td style='text-align:right;'>VALOR </td>
                        <td>".$_POST['valor']."</td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>NOMBRE</td>
                        <td>".$_POST['nombre']."</td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>REFERENCIA</td>
                        <td>".$_POST['ref']."</td>
                    </tr>
                    ".$TdBorrado."
                    <tr>
                        <td colspan=2 style='text-align:center;'>COMENTARIOS</td>
                    </tr>
                    <tr>
                        <td colspan=2 style='width:250px;' >".$_POST['coment']."</td>
                    </tr>
                    ".$TrForm."
                </table>";

?>