<?php

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
			print("<table align='center'>
						<tr>
							<td style='color:#F1BD2D;'>
									CONTACTO WEB MASTER
							</td>
						</tr>
						<tr>
							<td style='text-align:center;'>
			<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
				<button type='button' title='CONTACTO WEB MASTER' class='botonverde imgButIco PersonsBlack'>
				</button>
			</a>
							</td>
						</tr>
					</table>");
												
			show_form($form_errors);
										
		}else{print("<table align='center' style=\"margin-top:20px\">
							<tr>
								<td style='color:#0080C0;'>
										SE HA PROCESADO SU PETICION CORRECTAMENTE.
								</td>
							</tr>
							<tr>
								<td style='color:#0080C0;'>
										PULSE ENVIAR PARA RECIBIR SUS DATOS VIA MAIL.
								</td>
							</tr>
						</table>");
											
			process_form();
		} /* Fin del if $_POST['oculto']*/

	}elseif(isset($_POST['oculto2'])){ 	process_Mail();
										unset($_SESSION['']);

	}else{ show_form(); }

?>