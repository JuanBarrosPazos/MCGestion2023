<?php

	global $Ruta;		global $RutaClientesWeb;
	global $KeyIndex;

	global $BotonRefresca;
	if(($_SESSION['Nivel']=='cliente')||($_SESSION['Nivel']=='caja')){
		$BotonRefresca = "<form name='todo' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;'>
					<button type='submit' title='REFRESCAR VISTA DESPUES DE MODIFICAR DATOS...' class='botonlila imgButIco RestoreWhite'>
					</button>
						<input type='hidden' name='todo' value=1 />
						<input type='hidden' name='Orden' value='`id` ASC' />
					</form>";
	}else{
		$BotonRefresca = "";
	}

	if($KeyIndex == 1){ 
		$Ruta = "";
		$RutaClientesWeb = "AdminClientesWeb/";
	}else{ 
		$Ruta = ""; 
		$RutaClientesWeb = "";
	}

	global $KeyFeedback; 	
	global $ActionModifRecup;	global $TituloModifRecup;	global $BotonModifRecup;	
	global $ActionBorraUser;	global $TituloBorraUser;
	if($KeyFeedback == 1){ 
		$ActionModifRecup = "FeedbackClienteRecuperar.php";
		$TituloModifRecup = "RECUPERAR DATOS USUARIO";
		$BotonModifRecup = "RestoreBlack";
		$ActionBorraUser = "FeedbackClienteBorrar.php";
		$TituloBorraUser = "BORRAR FEEDBACK USUARIO";
	}else{
		$ActionModifRecup = "ClienteModificar.php";
		$TituloModifRecup = "MODIFICAR DATOS";
		$BotonModifRecup = "DatosBlack";
		$ActionBorraUser = "ClienteBorrar.php";
		$TituloBorraUser = "BORRAR USUARIO";
	}

	if(mysqli_num_rows($qb)== 0){
			print ("<table align='center' style=\"border:0px\">
						<tr>
							<td align='center' style='color:#F1BD2D;' >NO HAY DATOS</td>
						</tr>
					</table>");
	}else{	print ("<table align='center'>
					<tr>
						<th colspan=5 class='BorderInf'>
							<div style='display:inline-block; margin-top:0.6em;'>
								RESULTADOS ".mysqli_num_rows($qb)." RESULTADOS
						</div>
					</th>
						</tr>
						<tr>
							<th class='BorderInfDch'>Referencia</th>
							<th class='BorderInfDch'>Nivel</th>
							<th class='BorderInfDch'>Nombre</th>
							<th class='BorderInfDch'>Apellidos</th>
							<th class='BorderInf'></th>
						</tr>");
			
	while($rowb = mysqli_fetch_assoc($qb)){
				
			print("<tr align='center'>
					<td class='BorderInfDch'>".$rowb['ref']."</td>
					<td class='BorderInfDch'>".$rowb['Nivel']."</td>
					<td class='BorderInfDch'>".$rowb['Nombre']."</td>
					<td class='BorderInfDch'>".$rowb['Apellidos']."</td>
					<td class='BorderInf'>
			<img src='".$Ruta.$RutaClientesWeb."img_cliente/".$rowb['myimg']."' height='40px' width='30px' />
					</td>
				</tr>");

		if($rowb['doc'] == "local"){ 

		}else{ print("<tr>
					<td colspan=5 align='right' class='BorderInf'>
			".$BotonRefresca."
			<form name='ver' action='".$Ruta.$RutaClientesWeb."ClienteVer02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" style='display: inline-block;'>
				<button type='submit' title='VER DETALLES' class='botonverde imgButIco DetalleBlack'>
				</button>");

			require 'UserWhileTablaRow.php';

			print("<input type='hidden' name='oculto2' value=1 />
			</form>");

		if($KeyFeedback == 1){ 
		}else{
			print("<form name='modifica_img' action='".$Ruta.$RutaClientesWeb."ClienteModificarImg.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=380px,height=480px')\" style='display: inline-block;'>
				<button type='submit' title='MODIFICAR IMAGEN' class='botonlila imgButIco FotoBlack'>
				</button>");
			require 'UserWhileTablaRow.php';
			print("<input type='hidden' name='oculto2' value=1 />
			</form>");
		}

			print("<form name='modifica' action='".$Ruta.$RutaClientesWeb.$ActionModifRecup."' method='POST' style='display: inline-block;'>
				<button type='submit' title='".$TituloModifRecup."' class='botonlila imgButIco ".$BotonModifRecup."'>
				</button>");

			require 'UserWhileTablaRow.php';
				
			print("<input type='hidden' name='oculto2' value=1 />
			</form>
			
			<form name='modifica' action='".$Ruta.$RutaClientesWeb.$ActionBorraUser."' method='POST' style='display: inline-block; margin-left: -0.2em'>
				<button type='submit' title='".$ActionBorraUser."' class='botonrojo imgButIco DeleteBlack'>
				</button>");

			require 'UserWhileTablaRow.php';
				
			print("<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>");
				} // FIN ELSE SI NO ES UN VALOR PREDETERMINADO LOCAL
		} // FIN DEL WHILE
	print("</table>");

	}

?>