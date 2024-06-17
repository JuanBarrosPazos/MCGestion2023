<?php

    global $LinkAcceso;
	global $KeyLinkAcceso;
	global $rf;
	
	global $KeyClienteCero;
	global $WinClose;
	global $KeyModifImg;

	if($KeyClienteCero == 1){
		$ModifImgBotonIni = "<tr><th colspan=3 class='BorderInf'>
								<form name='boton' action='../index.php' method='post' >
										<input type='submit' value='INICIO CLIENTES' />
										<input type='hidden' name='volver' value=1 />
								</form>
							</th></tr>";
	} elseif($KeyModifImg == 1){
		$ModifImgBotonIni = "";
		$WinClose = "<tr><td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
							<input type='submit' value='CERRAR VENTANA' />
							<input type='hidden' name='oculto2' value=1 />
						</form>
					</td></tr>";
		$safe_filename = $imgNewName;
	} else {
		$ModifImgBotonIni = "<tr><th colspan=3 class='BorderInf'>
								<form name='boton' action='Cliente_Modificar_01.php' method='post' >
										<input type='submit' value='INICIO CLIENTES' />
										<input type='hidden' name='volver' value=1 />
								</form>
							</th></tr>";
		$WinClose = "";
	}

    if($KeyLinkAcceso == 1){
			$LinkAcceso = "<tr>
							<td colspan=3 align='right' class='BorderSup'>
						<a href=\"Cliente_Modificar_01.php\">ADMINISTRADOR ACCESO A INICIO DEL SISTEMA</a>
							</td>
						</tr>";
        } else { $LinkAcceso = "";}

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>".$titulo."</th>
				</tr>
					".$ModifImgBotonIni."
				<tr>
					<td width=150px>Nombre:</td>
					<td width=200px>".$_POST['Nombre']."</td>
					<td rowspan='4' align='center' width='100px'>
						<img src='".$rutImg.$safe_filename."' height='120px' width='90px' />
					</td>
				</tr>
				<tr>
					<td>Apellidos:</td>
					<td>".$_POST['Apellidos']."</td>
				</tr>				
				<tr>
					<td>Tipo Documento:</td>
					<td>".$_POST['doc']."</td>
				</tr>				
				<tr>
					<td>N&uacute;mero:</td>
					<td>".$_POST['dni']."</td>
				</tr>				
				<tr>
					<td>Control:</td>
					<td colspan='2'>".$_POST['ldni']."</td>
				</tr>				
				<tr>
					<td>Mail:</td>
					<td colspan='2'>".$_POST['Email']."</td>
				</tr>
				<tr>
					<td>Tipo Usuario</td>
					<td colspan='2'>".$_POST['Nivel']."</td>
				</tr>
				<tr>
					<td>Referencia Usuario</td>
					<td colspan='2'>".$rf."</td>
				</tr>
				<tr>
					<td>suario:</td>
					<td colspan='2'>".$_POST['Usuario']."</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td colspan='2'>".$_POST['Password']."</td>
				</tr>
				<tr>
					<td>Pais:</td>
					<td colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				<tr>
					<td>Teléfono 1:</td>
					<td colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				<tr>
					<td>Teléfono 2:</td>
					<td colspan='2'>".$_POST['Tlf2']."</td>
				</tr>".$LinkAcceso.$WinClose."
			</table>";	 

?>