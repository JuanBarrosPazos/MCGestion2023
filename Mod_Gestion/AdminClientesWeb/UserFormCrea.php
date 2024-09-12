<?php

    global $condiciones;           global $KeyClienteCero;
    global $CheckCondiciones;      global $CheckDatos;
    global $Action;

    if($KeyClienteCero == 1){

        $condiciones = "<tr>
                        <td colspan=2 style='padding-left:1.8em;'>
            <input type='checkbox' name='Condiciones' value='".@$defaults['Condiciones']."' ".$CheckCondiciones." required />
                            <font color='#F1BD2D'>*</font>
                <a href='CondicionesUso.php' target='_blank'>
                    HE LEIDO Y ACEPTO EL USO DEL SERVICIO
                 </a>
					    </td>
                    </tr>
                    <tr>
                        <td colspan=2 style='padding-left:1.8em;'>
        	<input type='checkbox' name='Datos' value='".@$defaults['Datos']."' ".$CheckDatos." required />
                            <font color='#F1BD2D'>*</font>
                <a href='CondicionesProteccionDatos.php' target='_blank' style='display:inline-block;' >
                    HE LEIDO Y ACEPTO EL TRATAMIENTO DATOS
                </a>
                        </td>
                    </tr>";

        $Action = "../index.php";

    }else{ $condiciones = "";   $Action = "ClienteVer.php"; }
    
    if($rf == ""){ $rf = "AUTOMATICA"; }else{ }

        print("<table align='center' style=\"margin-top:10px\">
                    <tr>
                        <th colspan=2 style='color:#F1BD2D;' >
                <div style='display:inline-block; margin: 0.4em 0.1em 0.1em 0.1em;'> ".$Titulo."</div>
                <form name='boton' action='".$Action."' method='post' style='display:inline-block; float:right;'>
                    <button type='submit' title='CANCELAR Y VOLVER' class='botonrojo imgButIco CancelWhite'>
                    </button>
							<input type='hidden' name='todo' value=1 />
               </form>
                        </th>
                    </tr>
                    <tr>
                        <td width = 120px style='text-align:right;'>REF USER &nbsp;&nbsp;</td>
                        <td width = 270px>".$rf."</td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>NOMBRE <font color='#F1BD2D'>*</font></td>
                        <td>
        <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
            <input type='text' name='Nombre' size=28 maxlength=25 pattern='[a-zA-Z\s]{3,25}' placeholder='MI NOMBRE' value='".$defaults['Nombre']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>APELLIDOS <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Apellidos' size=28 maxlength=25 pattern='[a-zA-Z\s]{3,25}' placeholder='MIS APELLIDOS' value='".$defaults['Apellidos']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>DOCUMENTO <font color='#F1BD2D'>*</font></td>
                        <td>
            <select name='doc' required>");
                        foreach($doctype as $option => $label){
                            print ("<option value='".$option."' ");
                            if($option == $defaults['doc']){ print ("selected = 'selected'"); }
                                print ("> $label </option>");
                        }	
                            
        print ("</select>
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>NUMERO <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='dni' size=12 maxlength=8 pattern='[0-9]{8,8}' placeholder='NUM. DOC.' value='".$defaults['dni']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>CONTROL <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='ldni' size=4 maxlength=1 pattern='[A-Z]{1,1}' value='".$defaults['ldni']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>MAIL <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='email' name='Email' size=40 maxlength=50 placeholder='MI EMAIL EN MINUSCULAS' value='".$defaults['Email']."' required />
                        </td>
                    </tr>	
                    <tr>
                        <td style='text-align:right;'>NIVEL USUARIO<font color='#F1BD2D'>*</font></td>
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
                        <td style='text-align:right;'>USER NAME <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Usuario' size=12 maxlength=10 placeholder='USUARIO' value='".$defaults['Usuario']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>USER NAME <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Usuario2' size=12 maxlength=10 placeholder='CONFIRME' value='".$defaults['Usuario2']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>PASSWORD <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Password' size=12 maxlength=10 placeholder='PASSWORD' value='".$defaults['Password']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>PASSWORD <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Password2' size=12 maxlength=10 placeholder='CONFIRME' value='".$defaults['Password2']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>DIRECCION <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Direccion' size=40 maxlength=50 placeholder='MI DIRECCION' value='".$defaults['Direccion']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>TELEFONO 1 <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Tlf1' size=12 maxlength=9 pattern='[0-9\s]{9,9}' placeholder='TELEFONO 1' value='".$defaults['Tlf1']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>TELEFONO 2<font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='text' name='Tlf2' size=12 maxlength=9 pattern='[0-9\s]{9,9}' placeholder='TELEFONO 2' value='".$defaults['Tlf2']."' required />
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>IMAGEN <font color='#F1BD2D'>*</font></td>
                        <td>
            <input type='file' name='myimg' value='".@$defaults['myimg']."' required />						
                        </td>
                    </tr>"
                    .$condiciones.
                    "<tr>
                        <td colspan='2'  align='right' valign='middle'>
                <button type='submit' title='REGISTRARME CON ESTOS DATOS' class='botonverde imgButIco SaveBlack'>
                </button>
                            <input type='hidden' name='oculto' value=1 />
                        </td>
                    </tr>
            </form>														
                </table>"); 

?>