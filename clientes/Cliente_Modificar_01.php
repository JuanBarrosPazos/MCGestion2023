<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'cliente'){

print("WELLCOME ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].". REF CLIENT: ".$_SESSION['ref']);
				
					master_index();

					process_form();

					if($_POST['oculto2']){ accion_Modificar_01(); } 
								
				} else { 
					
						print("<table align='center' style=\"margin-top:200px;margin-bottom:200px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													ACCESO RESTRINGIDO.
												</br></br>
													CONSULTE SUS PERMISOS ADMINISTRATIVOS.
											</font>
										</td>
									</tr>
								</table>");
								
							}

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	
	$nombre = $_SESSION['Nombre'];
	$apellido = $_SESSION['Apellidos'];
	
		
	$sqlc =  "SELECT * FROM `clientes` WHERE `Nombre` = '$nombre' AND `Apellidos` = '$apellido'  ";
 	
	$qc = mysqli_query($db, $sqlc);
	
	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
					
			show_form();	
			
		} else {
			
			if(mysqli_num_rows($qc)== 0){
							print ("<table align='center' style=\"border:0px\">
										<tr>
											<td align='center'>
												<font color='#FF0000'>
														NINGÚN DATO SE CIÑE A ESTOS CRITERIOS.
													</br>
														INTENTELO CON OTROS PARÁMETROS.
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<table align='center' style='margin-top:20px'>
									
								<tr>
									<td align='center' colspan='10' class='BorderInf'>
												ESTOS SON SUS DATOS DE USUARIO
									</td>
								</tr>
								
									<tr>
										<th class='BorderInfDch'>
											Referencia
										</th>
										
										<th class='BorderInfDch'>
											Nivel
										</th>
										
										<th class='BorderInfDch'>
											Nombre
										</th>
										
										<th class='BorderInfDch'>
											Apellidos
										</th>
										
										<th class='BorderInfDch'>
										</th>
										
										<th class='BorderInfDch'>
											Docu
										</th>
										
										<th class='BorderInf'>
											N&uacute;mero
										</th>
										
										<th class='BorderInfDch'>
										</th>
										
										<th class='BorderInfDch'>
											Usuario
										</th>
										
										<th class='BorderInf'>
											Password
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
				
			print (	"<tr align='center'>
									

	<form name='ver' action='Cliente_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\">

		<input name='ID' type='hidden' value='".$rowc['ID']."' />
		<input name='Email' type='hidden' value='".$rowc['Email']."' />
		<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
		<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
		<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
		<input name='lastin' type='hidden' value='".$rowc['lastin']."' />
		<input name='lastout' type='hidden' value='".$rowc['lastout']."' />
		<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />
						
						<td class='BorderInfDch'>
		<input name='ref' type='hidden' value='".$rowc['ref']."' />".$rowc['ref']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='Nivel' type='hidden' value='".$rowc['Nivel']."' />".$rowc['Nivel']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />".$rowc['Nombre']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />".$rowc['Apellidos']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
		<img src='../Admin_clientes/img_cliente/".$rowc['myimg']."' height='40px' width='30px' />
						</td>
												
						<td class='BorderInfDch'>
		<input name='doc' type='hidden' value='".$rowc['doc']."' />".$rowc['doc']."
						</td>
													
						<td class='BorderInf'>
		<input name='dni' type='hidden' value='".$rowc['dni']."' />".$rowc['dni']."
						</td>
													
						<td class='BorderInfDch'>
		<input name='ldni' type='hidden' value='".$rowc['ldni']."' />".$rowc['ldni']."
						</td>
													
						<td class='BorderInfDch'>
		<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />".$rowc['Usuario']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Password' type='hidden' value='".$rowc['Password']."' />".$rowc['Password']."
						</td>
						
					</tr>
					
					<tr>
						<td colspan=4 class='BorderInf'>
										&nbsp;
						</td>
						<td colspan=2 align='center' class='BorderInfDch'>
										<input type='submit' value='VER DETALLES' />
										<input type='hidden' name='oculto2' value=1 />
	</form>

				<td colspan=2 align='center' class='BorderInf'>
						
	<form name='modifica_dat' action='Cliente_Modificar_02.php' method='POST'\">
	
			<input name='ID' type='hidden' value='".$rowc['ID']."' />
			<input name='ref' type='hidden' value='".$rowc['ref']."' />
			<input name='Nivel' type='hidden' value='".$rowc['Nivel']."' />
			<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />
			<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />
			<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
			<input name='doc' type='hidden' value='".$rowc['doc']."' />
			<input name='dni' type='hidden' value='".$rowc['dni']."' />
			<input name='ldni' type='hidden' value='".$rowc['ldni']."' />
			<input name='Email' type='hidden' value='".$rowc['Email']."' />
			<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />
			<input name='Password' type='hidden' value='".$rowc['Password']."' />						
			<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
			<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
			<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
			<input name='lastin' type='hidden' value='".$rowc['lastin']."' />
			<input name='lastout' type='hidden' value='".$rowc['lastout']."' />
			<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />

										<input type='submit' value='MODIFICAR DATOS' />
										<input type='hidden' name='oculto2' value=1 />
	
	</form>

		</td>	
				</td>
	
				<td colspan=2 align='center' class='BorderInf'>
						
	<form name='modifica_img' action='Cliente_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px,height=560px')\">

			<input name='ID' type='hidden' value='".$rowc['ID']."' />
			<input name='ref' type='hidden' value='".$rowc['ref']."' />
			<input name='Nivel' type='hidden' value='".$rowc['Nivel']."' />
			<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />
			<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />
			<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
			<input name='doc' type='hidden' value='".$rowc['doc']."' />
			<input name='dni' type='hidden' value='".$rowc['dni']."' />
			<input name='ldni' type='hidden' value='".$rowc['ldni']."' />
			<input name='Email' type='hidden' value='".$rowc['Email']."' />
			<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />
			<input name='Password' type='hidden' value='".$rowc['Password']."' />						
			<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
			<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
			<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
			<input name='lastin' type='hidden' value='".$rowc['lastin']."' />
			<input name='lastout' type='hidden' value='".$rowc['lastout']."' />
			<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />

										<input type='submit' value='MODIFICAR IMAGEN' />
										<input type='hidden' name='oculto2' value=1 />
			</form>

		</td>	
					</tr>");
								} /* Fin del while.*/ 

						print("</table>");

						} /* Fin segundo else anidado en if */
		
			} /* Fin de primer else . */
		
	}	/* Final process_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		
				require '../Inclu/Master_In_Clientes.php';
		
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Modificar_01(){

	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = $_POST['Orden'];
	
	if ($_POST['todo']){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	$ActionTime = date('H:i:s');
	
	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

	global $text;
	$text = "- CLIENTE MODIFICAR 1 ".$ActionTime.". ".$nombre." ".$apellido;

	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = $text."\n";
	$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>