<?php

	global $KeyFeedback;
	if($KeyFeedback == 1){
		$estilo = "style='display: inline-block;'";
	} else {
		$estilo = "style='display: inline-block; visivility: hidden; display: none;'";
	}

	print("<table align='center' border=0>
				<tr>
					<th colspan=2>
						<div style='display:inline-block; color:#F1BD2D; margin: 1.2em 0.1em 0.1em 0.1em;'>
							MODIFICAR DATOS ACTUALES
						</div>
							<img src='img_cliente/".$defaults['myimg']."' height='54px' width='43px' style='display:inline-block; float:right;'>
					</th>
				</tr>
				<tr>
					<th colspan=2 style='text-align:right;' >
				<form name='boton' action='ClienteVer.php' method='post' style='display:inline-block;' >
						<button type='submit' title='INICIO CLIENTES' class='botonverde imgButIco InicioBlack' >
						</button>
								<input type='hidden' name='todo' value=1 />
				</form>
				<form name='boton' action='FeedbackClienteVer.php' method='post' ".$estilo." >
						<button type='submit' title='INICIO FEEDBACK' class='botonverde imgButIco CachedBlack' >
						</button>
							<input type='hidden' name='volver' value=1 />
				</form>
				<form name='boton' action='ClienteVer.php' method='post' style='display:inline-block;' >
						<button type='submit' title='CANCELAR Y VOLVER' class='botonverde imgButIco CancelBlack' >
						</button>
							<input type='hidden' name='todo' value=1 />
				</form>
					</th>
				</tr>
				<tr>
					<td style='text-align:right;'>	
						REFERENCIA </td>
					<td>".$defaults['refnew']."</td>
				</tr>
				<tr>
                    <td style='text-align:right;'>NOMBRE <font color='#F1BD2D'>*</font></td>
					<td>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			<input name='id' type='hidden' value='".$defaults['id']."' />					
			<input name='refnew' type='hidden' value='".$defaults['refnew']."' />	
			<input name='myimg' type='hidden' value='".$defaults['myimg']."' />
			<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
			<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
			<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />
							
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
						<td colspan='2' align='right'>
                <button type='submit' title='MODIFICAR DATOS' class='botonverde imgButIco SaveBlack'>
                </button>
							<input type='hidden' name='modifica' value=1 />
			</form>														
						</td>
					</tr>
				</table>");

?>