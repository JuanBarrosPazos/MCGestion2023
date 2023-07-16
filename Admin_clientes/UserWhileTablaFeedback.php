<?php

		global $KeyRecuperaFeedback;
		global $KeyBorraFeedback;
		global $accion;
		global $valor;
        global $PopUp;
 
		if($KeyRecuperaFeedback == 1){
			$accion = "Feedback_Cliente_Recuperar_02.php";
			$valor = "RECUPERAR DATOS FEEDBACK";
            $PopUp = "";
		 } elseif ($KeyBorraFeedback == 1){ 
			$accion = "Feedback_Cliente_Borrar_02.php";
			$valor = "BORRAR DATOS FEECBACK";
            $PopUp = "";
		} else { $accion = "Feedback_Cliente_Ver_02.php";
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
				<form name='ver' action='Feedback_Cliente_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\" style='display: inline-block;'>
						<input name='id' type='hidden' value='".$rowb['id']."' />
						<input name='ref' type='hidden' value='".$rowb['ref']."' />
						<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />
						<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />
						<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />
						<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
						<input name='doc' type='hidden' value='".$rowb['doc']."' />
						<input name='dni' type='hidden' value='".$rowb['dni']."' />
						<input name='ldni' type='hidden' value='".$rowb['ldni']."' />
						<input name='Email' type='hidden' value='".$rowb['Email']."' />
						<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />
						<input name='Password' type='hidden' value='".$rowb['Password']."' />
						<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
						<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
						<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />
						<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
						<input name='lastout' type='hidden' value='".$rowb['lastout']."' />					
						<input name='visitadmin' type='hidden' value='".$rowb['visitadmin']."' />					
						<input name='borrado' type='hidden' value='".$rowb['borrado']."' />
								<input type='submit' value='VER DETALLES' />
								<input type='hidden' name='oculto2' value=1 />
				</form>

				<form name='modifica' action='Feedback_Cliente_Recuperar_02.php' method='POST' style='display: inline-block;'>
						<input name='id' type='hidden' value='".$rowb['id']."' />
						<input name='ref' type='hidden' value='".$rowb['ref']."' />
						<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />
						<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />
						<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />
						<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
						<input name='doc' type='hidden' value='".$rowb['doc']."' />
						<input name='dni' type='hidden' value='".$rowb['dni']."' />
						<input name='ldni' type='hidden' value='".$rowb['ldni']."' />
						<input name='Email' type='hidden' value='".$rowb['Email']."' />
						<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />
						<input name='Password' type='hidden' value='".$rowb['Password']."' />
						<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
						<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
						<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />
						<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
						<input name='lastout' type='hidden' value='".$rowb['lastout']."' />					
						<input name='visitadmin' type='hidden' value='".$rowb['visitadmin']."' />
						<input name='borrado' type='hidden' value='".$rowb['borrado']."' />									
								<input type='submit' value='RECUPERAR DATOS USUARIO' />
								<input type='hidden' name='oculto2' value=1 />
				</form>

				<form name='modifica' action='Feedback_Cliente_Borrar_02.php' method='POST' style='display: inline-block;'>
						<input name='id' type='hidden' value='".$rowb['id']."' />
						<input name='ref' type='hidden' value='".$rowb['ref']."' />
						<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />
						<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />
						<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />
						<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
						<input name='doc' type='hidden' value='".$rowb['doc']."' />
						<input name='dni' type='hidden' value='".$rowb['dni']."' />
						<input name='ldni' type='hidden' value='".$rowb['ldni']."' />
						<input name='Email' type='hidden' value='".$rowb['Email']."' />
						<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />
						<input name='Password' type='hidden' value='".$rowb['Password']."' />
						<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
						<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
						<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />
						<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
						<input name='lastout' type='hidden' value='".$rowb['lastout']."' />					
						<input name='visitadmin' type='hidden' value='".$rowb['visitadmin']."' />
						<input name='borrado' type='hidden' value='".$rowb['borrado']."' />											
								<input type='submit' value='BORRAR FEEDBACK USUARIO' />
								<input type='hidden' name='oculto2' value=1 />
				</form>
			</td>
		</tr>");
			} 

		print("</table>");

	}

?> 
