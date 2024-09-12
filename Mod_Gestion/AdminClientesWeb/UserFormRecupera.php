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
						DATOS DEL USUARIO A RECUPERAR
					</th>
				</tr>
				<th colspan=2 width=100% class='BorderInf'>
					<form name='boton' action='ClienteVer.php' method='post' style='display: inline-block;' >
							<input type='submit' value='INICIO CLIENTES' />
							<input type='hidden' name='todo' value=1 />
					</form>
					<form name='boton' action='Feedback_ClienteVer.php' method='post' ".$estilo." >
						<input type='submit' value='INICIO FEEDBACK' />
						<input type='hidden' name='volver' value=1 />
					</form>

				</th>
	
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
		<input name='id' type='hidden' value='".$defaults['id']."' />					
		<input name='ref' type='hidden' value='".$defaults['ref']."' />	
		<input type='hidden' name='Nombre'value='".$defaults['Nombre']."' />
		<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
		<input name='myimg' type='hidden' value='".$defaults['myimg']."' />
		<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
		<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
		<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />					
		<input type='hidden' name='doc' value='".$defaults['doc']."' />
		<input type='hidden' name='dni' value='".$defaults['dni']."' />
		<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
		<input type='hidden' name='Email' value='".$defaults['Email']."' />
		<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
		<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
		<input type='hidden' name='Usuario2' value='".$defaults['Usuario2']."' />
		<input type='hidden' name='Password' value='".$defaults['Password']."' />
		<input type='hidden' name='Password2' value='".$defaults['Password2']."' />
		<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
		<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
		<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
				<tr>
					<td>	
						<font color='#F1BD2D'>*</font>Referencia Usuario:</td>
					<td>".$defaults['ref']."</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Nombre:</td>
					<td>".$defaults['Nombre']."
					</td>
				</tr>
					
				<tr>
					<td><font color='#F1BD2D'>*</font>Apellidos:</td>
					<td>".$defaults['Apellidos']."
					</td>
				</tr>

				<tr>
					<td><font color='#F1BD2D'>*</font>Tipo Documento:</td>
					<td>".$defaults['doc']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>N&uacute;mero:</td>
					<td>".$defaults['dni']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Control:</td>
					<td>".$defaults['ldni']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Mail:</td>
					<td>".$defaults['Email']."
					</td>
				</tr>	
				<tr>
					<td><font color='#F1BD2D'>*</font>Nivel Usuario:</td>
					<td>".$defaults['Nivel']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Nombre de Usuario:</td>
					<td>".$defaults['Usuario']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Password:</td>
					<td>".$defaults['Password']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Dirección:</td>
					<td>".$defaults['Direccion']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Teléfono 1:</td>
					<td>".$defaults['Tlf1']."
					</td>
				</tr>
				<tr>
					<td><font color='#F1BD2D'>*</font>Teléfono 2:</td>
					<td>".$defaults['Tlf2']."
					</td>
				</tr>
				<tr height=40px>
					<td colspan='2' align='right'>
						<input type='submit' value='RECUPERAR ESTOS DATOS' />
						<input type='hidden' name='modifica' value=1 />
					</td>
				</tr>
		</form>														
			</table>");

?>