<?php

		global $KeyRecuperaFeedback;
		global $KeyBorraFeedback;
		global $accion;
		global $valor;
        global $PopUp;
 
		if($KeyRecuperaFeedback == 1){
			$accion = "FeedbackClienteRecuperar.php";
			$valor = "RECUPERAR DATOS FEEDBACK";
            $PopUp = "";
		 } elseif ($KeyBorraFeedback == 1){ 
			$accion = "Feedback_ClienteBorrar.php";
			$valor = "BORRAR DATOS FEECBACK";
            $PopUp = "";
		} else { $accion = "Feedback_ClienteVer02.php";
			     $valor = "VER DETALLES";
                 $PopUp = "target='popup' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\"";
                }


		if(mysqli_num_rows($qb)== 0){
				print ("<table align='center' style=\"border:0px\">
							<tr>
								<td align='center'>
									<font color='#FF0000'>
										NO HAY DATOS
									</font>
								</td>
							</tr>
						</table>");

		} else { print ("<table align='center'>
							<tr>
								<th colspan=16 class='BorderInf'>
									RESULTADOS : ".mysqli_num_rows($qb)." Resultados.
								</th>
							</tr>
							<tr>
								<th class='BorderInfDch'>ID</th>
								<th class='BorderInfDch'>Referencia</th>
								<th class='BorderInfDch'>Nivel</th>
								<th class='BorderInfDch'>Nombre</th>
								<th class='BorderInfDch'>Apellidos</th>
								<th class='BorderInfDch'></th>
								<th class='BorderInfDch'>Docu</th>
								<th class='BorderInf'>N&uacute;mero</th>
								<th class='BorderInfDch'></th>
								<th class='BorderInfDch'>Email</th>
								<th class='BorderInfDch'>Usuario</th>
								<th class='BorderInfDch'>Password</th>
								<th class='BorderInfDch'>Dirección</th>
								<th class='BorderInfDch'>Teléfono 1</th>
								<th class='BorderInfDch'>Teléfono 2</th>
								<th class='BorderInf'>Borrado</th>
							</tr>");
			
		while($rowb = mysqli_fetch_assoc($qb)){
				
		print (	"<tr align='center'>
						<td class='BorderInfDch'>".$rowb['id']."</td>
						<td class='BorderInfDch'>".$rowb['ref']."</td>
						<td class='BorderInfDch'>".$rowb['Nivel']."</td>
						<td class='BorderInfDch'>".$rowb['Nombre']."</td>
						<td class='BorderInfDch'>".$rowb['Apellidos']."</td>
						<td class='BorderInfDch'>
						<img src='img_cliente/".$rowb['myimg']."' height='40px' width='30px' />
						</td>
						<td class='BorderInfDch'>".$rowb['doc']."</td>
						<td class='BorderInf'>".$rowb['dni']."</td>
						<td class='BorderInfDch'>".$rowb['ldni']."</td>
						<td class='BorderInfDch'>".$rowb['Email']."</td>
						<td class='BorderInfDch'>".$rowb['Usuario']."</td>
						<td class='BorderInfDch'>".$rowb['Password']."</td>
						<td class='BorderInfDch'>".$rowb['Direccion']."</td>
						<td class='BorderInfDch'>".$rowb['Tlf1']."</td>
						<td class='BorderInfDch'>".$rowb['Tlf2']."</td>
						<td class='BorderInf'>".$rowb['borrado']."</td>
					</tr>
					<tr>


						<td colspan=16 align='right' class='BorderInfDch'>
				<form name='ver' action='Feedback_ClienteVer02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\" style='display: inline-block;'>
						<input type='hidden' name='id' value='".$rowb['id']."' />
						<input type='hidden' name='ref' value='".$rowb['ref']."' />
						<input type='hidden' name='Nivel' value='".$rowb['Nivel']."' />
						<input type='hidden' name='Nombre' value='".$rowb['Nombre']."' />
						<input type='hidden' name='Apellidos' value='".$rowb['Apellidos']."' />
						<input type='hidden' name='myimg' value='".$rowb['myimg']."' />
						<input type='hidden' name='doc' value='".$rowb['doc']."' />
						<input type='hidden' name='dni' value='".$rowb['dni']."' />
						<input type='hidden' name='ldni' value='".$rowb['ldni']."' />
						<input type='hidden' name='Email' value='".$rowb['Email']."' />
						<input type='hidden' name='Usuario' value='".$rowb['Usuario']."' />
						<input type='hidden' name='Password' value='".$rowb['Password']."' />
						<input type='hidden' name='Direccion' value='".$rowb['Direccion']."' />
						<input type='hidden' name='Tlf1' value='".$rowb['Tlf1']."' />
						<input type='hidden' name='Tlf2' value='".$rowb['Tlf2']."' />
						<input type='hidden' name='lastin' value='".$rowb['lastin']."' />
						<input type='hidden' name='lastout' value='".$rowb['lastout']."' />					
						<input type='hidden' name='visitadmin' value='".$rowb['visitadmin']."' />					
						<input type='hidden' name='borrado' value='".$rowb['borrado']."' />
								<input type='submit' value='VER DETALLES' />
								<input type='hidden' name='oculto2' value=1 />
				</form>

				<form name='modifica' action='FeedbackClienteRecuperar.php' method='POST' style='display: inline-block;'>
						<input type='hidden' name='id' value='".$rowb['id']."' />
						<input type='hidden' name='ref' value='".$rowb['ref']."' />
						<input type='hidden' name='Nivel' value='".$rowb['Nivel']."' />
						<input type='hidden' name='Nombre' value='".$rowb['Nombre']."' />
						<input type='hidden' name='Apellidos' value='".$rowb['Apellidos']."' />
						<input type='hidden' name='myimg' value='".$rowb['myimg']."' />
						<input type='hidden' name='doc' value='".$rowb['doc']."' />
						<input type='hidden' name='dni' value='".$rowb['dni']."' />
						<input type='hidden' name='ldni' value='".$rowb['ldni']."' />
						<input type='hidden' name='Email' value='".$rowb['Email']."' />
						<input type='hidden' name='Usuario' value='".$rowb['Usuario']."' />
						<input type='hidden' name='Password' value='".$rowb['Password']."' />
						<input type='hidden' name='Direccion' value='".$rowb['Direccion']."' />
						<input type='hidden' name='Tlf1' value='".$rowb['Tlf1']."' />
						<input type='hidden' name='Tlf2' value='".$rowb['Tlf2']."' />
						<input type='hidden' name='lastin' value='".$rowb['lastin']."' />
						<input type='hidden' name='lastout' value='".$rowb['lastout']."' />					
						<input type='hidden' name='visitadmin' value='".$rowb['visitadmin']."' />
						<input type='hidden' name='borrado' value='".$rowb['borrado']."' />									
								<input type='submit' value='RECUPERAR DATOS USUARIO' />
								<input type='hidden' name='oculto2' value=1 />
				</form>

				<form name='modifica' action='Feedback_ClienteBorrar.php' method='POST' style='display: inline-block;'>
						<input type='hidden' name='id' value='".$rowb['id']."' />
						<input type='hidden' name='ref' value='".$rowb['ref']."' />
						<input type='hidden' name='Nivel' value='".$rowb['Nivel']."' />
						<input type='hidden' name='Nombre' value='".$rowb['Nombre']."' />
						<input type='hidden' name='Apellidos' value='".$rowb['Apellidos']."' />
						<input type='hidden' name='myimg' value='".$rowb['myimg']."' />
						<input type='hidden' name='doc' value='".$rowb['doc']."' />
						<input type='hidden' name='dni' value='".$rowb['dni']."' />
						<input type='hidden'  name='ldni'value='".$rowb['ldni']."' />
						<input type='hidden' name='Email' value='".$rowb['Email']."' />
						<input type='hidden' name='Usuario' value='".$rowb['Usuario']."' />
						<input type='hidden' name='Password' value='".$rowb['Password']."' />
						<input type='hidden' name='Direccion' value='".$rowb['Direccion']."' />
						<input type='hidden' name='Tlf1' value='".$rowb['Tlf1']."' />
						<input type='hidden' name='Tlf2' value='".$rowb['Tlf2']."' />
						<input type='hidden' name='lastin' value='".$rowb['lastin']."' />
						<input type='hidden' name='lastout' value='".$rowb['lastout']."' />					
						<input type='hidden' name='visitadmin' value='".$rowb['visitadmin']."' />
						<input type='hidden' name='borrado' value='".$rowb['borrado']."' />											
								<input type='submit' value='BORRAR FEEDBACK USUARIO' />
								<input type='hidden' name='oculto2' value=1 />
				</form>
			</td>
		</tr>");
			} 

		print("</table>");

	}

?> 
