<?php

    global $condiciones;
    $condiciones = "print(\"
                    <tr>
                        <td align='right'>
                            <font color='#FF0000'>*</font>
                        <input type='checkbox' name='Condiciones' value='yes'\");
                    if(".@$defaults['Condiciones']." == 'yes') { print(\" checked=\"checked\"\");}
                    print(\" required />
					    </td>
					    <td>
                            <a href=\"Condiciones_Uso.html\" target=\"_blank\">
                                He leido y acepto las condiciones de uso del servicio.
                            </a>
					    </td>
                    </tr>
                    <tr>
                        <td align='right'>
                            <font color='#FF0000'>*</font>
        				<input type='checkbox' name='Datos' value='yes' \");
                        if(".@$defaults['Datos']." == 'yes') {print(\" checked='checked'\"\");}
                    print(\" required />
					    </td>
					    <td>
                            <a href=\"Proteccion_Datos.html\" target=\"_blank\">
                                He leido y acepto las condiciones tratamiento de datos.
                            </a>
                        </td>
                    </tr> \");
                    ";

    global $KeyCondiciones;
    if($KeyCondiciones == 1){ }else{ $condiciones = "";}
    
    if(strlen($rf == "")){
        $rf = "REF USER SE GENERA DE FORMA AUTOMATICA";
    } else { }

    global $keyConfig2;
    global $BotonCancel;
    if($keyConfig2 == 1){
        $BotonCancel = "";
    } else {
        $BotonCancel = "<tr>
                            <th colspan=3 width=100% class='BorderInf'>
                                <form name='boton' action='Admin_Ver.php' method='post' >
                                        <input type='submit' value='CANCELAR Y VOLVER' />
                                        <input type='hidden' name='volver' value=1 />
                                </form>
                            </th>
                        </tr>";
            }

    print("<table align='center' style=\"margin-top:10px\">
                    <tr>
                        <th colspan=2 class='BorderInf'>
                                ".$textit."
                        </th>
                    </tr>".$BotonCancel."
        <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
                    <tr>
                        <td width=180px><font color='#FF0000'>*</font>Ref User:</td>
                        <td width=360px>".$rf."</td>
                    </tr>
                    <tr>
                        <td width=180px><font color='#FF0000'>*</font>Nombre:</td>
                        <td width=360px>
            <input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Apellidos:</td>
                        <td>
        <input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Tipo Documento:</td><td>
        <select name='doc' required>");
                    foreach($doctype as $option => $label){
                        print ("<option value='".$option."' ");
                        if($option == $defaults['doc']){ print ("selected = 'selected'");
                            }
                            print ("> $label </option>");
                        }	
                            
        print ("</select>
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>N&uacute;mero:</td>
                        <td>
            <input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Control:</td>
                        <td>
            <input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <font color='#FF0000'>*</font>
                            Mail:
                        </td>
                        <td>
            <input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' required />
                        </td>
                    </tr>	
                    <tr>
                        <td>
                            <font color='#FF0000'>*</font>
                            Nivel Usuario:
                        </td>
                        <td>
            <select name='Nivel' required>");
                    foreach($Nivel as $optionnv => $labelnv){ print ("<option value='".$optionnv."' ");
                        if($optionnv == $defaults['Nivel']){ print ("selected = 'selected'");}
                                            print ("> $labelnv </option>");
                                    }	
        print ("</select>
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Nombre de Usuario:</td>
                        <td>
            <input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Confirme el Usuario:</td>
                        <td>
            <input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Password:</td>
                        <td>
            <input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Confirme el Password:</td>
                        <td>
        <input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Dirección:</td>
                        <td>
        <input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Teléfono 1:</td>
                        <td>
            <input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Teléfono 2:</td>
                        <td>
            <input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td><font color='#FF0000'>*</font>Seleccione una Fotografía:</td>
                        <td>
            <input type='file' name='myimg' value='".@$defaults['myimg']."' required />						
                        </td>
                    </tr>");

            $condiciones;

            print(" <tr>
                        <td colspan='2'  align='right' valign='middle'  class='BorderSup'>
                            <input type='submit' value='REGISTRARME CON ESTOS DATOS' />
                            <input type='hidden' name='oculto' value=1 />
                        </td>
                    </tr>
            </form>														
                </table>"); 

?>