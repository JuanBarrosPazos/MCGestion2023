<?php

	global $KeyFeedback;
	if($KeyFeedback == 1){
		$estilo = "style='display: inline-block; float:right;'";
	}else{
		$estilo = "style='visivility: hidden; display: none;'";
	}

	print("<table align='center' border=0>
	".$TrAlert."
				<tr>
					<th colspan=2 style='color:#F1BD2D;'>
					<div style='display:inline-block; vertical-align:top; margin: 1.1em 0.2em 0.1em 0.2em;'>
						DATOS DEL USUARIO
					</div>
						<img src='img_cliente/".$defaults['myimg']."' height='44px' width='33px' />
					</th>
				</tr>
				<tr>
					<th colspan=2>
						<form name='boton' action='FeedbackClienteVer.php' method='post' ".$estilo." >
					<button type='submit' title='INICIO FEEDBACK' class='botonverde imgButIco CachedBlack' >
					</button>
							<input type='hidden' name='todo' value=1 />
						</form>

						<form name='boton' action='ClienteVer.php' method='post' style='display: inline-block; float:right;' >
							<button type='submit' title='INICIO CLIENTES' class='botonverde imgButIco PersonsBlack'>
							</button>
								<input type='hidden' name='todo' value=1 />
						</form>
					</th>
				</tr>
				<tr>
					<td style='text-align:right;'>REFERENCIA</td>
					<td>".$defaults['ref']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>NOMBRE</td>
					<td>".$defaults['Nombre']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>APELLIDOS</td>
					<td>".$defaults['Apellidos']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DOCUMENTO</td>
					<td>".$defaults['doc']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>NUMERO</td>
					<td>".$defaults['dni']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>CONTROL</td>
					<td>".$defaults['ldni']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>MAIL</td>
					<td>".$defaults['Email']."</td>
				</tr>	
				<tr>
					<td style='text-align:right;'>NIVEL</td>
					<td>".$defaults['Nivel']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>USUARIO</td>
					<td>".$defaults['Usuario']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>PASSWORD</td>
					<td>".$defaults['Password']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DIRECCION</td>
					<td>".$defaults['Direccion']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TELEFONO 1</td>
					<td>".$defaults['Tlf1']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TELEFONO 2</td>
					<td>".$defaults['Tlf2']."</td>
				</tr>
				<tr height=40px>
					<td colspan='2' align='right'>
						<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
							<input type='hidden' name='id' value='".$defaults['id']."' />					
							<input type='hidden' name='ref' value='".$defaults['ref']."' />	
							<input type='hidden' name='Nombre'value='".$defaults['Nombre']."' />
							<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
							<input type='hidden' name='myimg' value='".$defaults['myimg']."' />
							<input type='hidden' name='doc' value='".$defaults['doc']."' />
							<input type='hidden' name='dni' value='".$defaults['dni']."' />
							<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
							<input type='hidden' name='Email' value='".$defaults['Email']."' />
							<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
							<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
							<input type='hidden' name='Usuario2' value='".@$defaults['Usuario2']."' />
							<input type='hidden' name='Password' value='".$defaults['Password']."' />
							<input type='hidden' name='Password2' value='".@$defaults['Password2']."' />
							<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
							<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
							<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
							<input type='hidden' name='lastin' value='".$defaults['lastin']."' />
							<input type='hidden' name='lastout' value='".$defaults['lastout']."' />
							<input type='hidden' name='visitadmin' value='".$defaults['visitadmin']."' />

							<button type='submit' title='".$Title."' class='".$BotonClass."'>
							</button>
							<input type='hidden' name='".$InputName."' value=1 />
						</form>														
					</td>
				</tr>
			</table>");

?>