<?php

	global $KeyFeedback;
	if($KeyFeedback == 1){
		$estilo = "style='display: inline-block;'";
	} else {
		$estilo = "style='visivility: hidden; display: none;'";
	}

	print("<table align='center' border=0>
				<tr>
					<th colspan=2 class='BorderInf'>
						<img src='img_cliente/".$defaults['myimg']."' height='44px' width='33px' />
						INTRODUZCA LOS NUEVOS DATOS EN EL FORMULARIO.
					</th>
				</tr>
				<th colspan=3 width=100% class='BorderInf'>
					<form name='boton' action='Cliente_Ver.php' method='post' style='display: inline-block;' >
							<input type='submit' value='INICIO CLIENTES' />
							<input type='hidden' name='volver' value=1 />
					</form>
					<form name='boton' action='Feedback_Cliente_Ver.php' method='post' ".$estilo." >
						<input type='submit' value='INICIO FEEDBACK' />
						<input type='hidden' name='volver' value=1 />
					</form>

				</th>
	
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
		<input name='id' type='hidden' value='".$defaults['id']."' />					
		<input name='ref' type='hidden' value='".$defaults['ref']."' />	
		<input name='myimg' type='hidden' value='".$defaults['myimg']."' />
		<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
		<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
		<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>Referencia Usuario:</td>
					<td>".$defaults['ref']."</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Nombre:</td>
					<td>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td><font color='#FF0000'>*</font>pellidos:</td>
					<td>
		<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td><font color='#FF0000'>*</font>Tipo Documento:</td>
					<td>
		<select name='doc'>");
				foreach($doctype as $option => $label2){
					print ("<option value='".$option."' ");
					if($option == $defaults['doc']){ print ("selected = 'selected'"); }
									print ("> $label2 </option>");
							}	
						
	print ("</select>
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>N&uacute;mero:</td>
					<td>
		<input type='text' name='dni' size=28 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Control:</td>
					<td>
		<input type='text' name='ldni' size=28 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Mail:</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				<tr>
					<td><font color='#FF0000'>*</font>Nivel Usuario:</td>
					<td>
		<select name='Nivel'>");

				foreach($Nivel as $optionnv => $labelnv){
					print ("<option value='".$optionnv."' ");
					if($optionnv == $defaults['Nivel']){ print ("selected = 'selected'"); }
								print ("> $labelnv </option>");
							}	
	print ("</select>
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Nombre de Usuario:</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Confirme el Usuario:</td>
					<td>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Password:</td>
					<td>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Confirme el Password:</td>
					<td>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Dirección:</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Teléfono 1:</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Teléfono 2:</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				<tr height=40px>
					<td colspan='2' align='right'>
						<input type='submit' value='MODIFICAR DATOS' />
						<input type='hidden' name='modifica' value=1 />
					</td>
				</tr>
		</form>														
			</table>");

?>