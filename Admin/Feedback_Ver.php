<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

								if($_POST['todo']){
										show_form();							
										ver_todo();
										accion_Feedback_01();
										}
								
								elseif($_POST['oculto']){
									
										if($form_errors = validate_form()){
											show_form($form_errors);
												} else {
													process_form();
													accion_Feedback_01();
													}
									}
									
								else {
										show_form();
										}
								
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

function validate_form(){
	
	$errors = array();
	
	if ( (strlen(trim($_POST['Nombre'])) == 0) && (strlen(trim($_POST['Apellidos'])) == 0) ){
		$errors [] = " <font color='#FF0000'>UNO DE LOS DOS CAMPOS OBLIGATORIO</font>";
		}
	
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	show_form();
		
	$nom = "%".$_POST['Nombre']."%";
	$ape = "%".$_POST['Apellidos']."%";
	$orden = $_POST['Orden'];
		
	if (strlen(trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape;}
	
	$sqlc =  "SELECT * FROM `feedback` WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
 	
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

				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=11 class='BorderInf'>
					Administradores con estos criterios  : ".mysqli_num_rows($qc)." Resultados.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											Nivel
										</th>
										
										<th class='BorderInfDch'>
											Referencia
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
											Usuario
										</th>
										
										<th class='BorderInfDch'>
											Password
										</th>
										
										<th class='BorderInfDch'>
											Date Delete
										</th>
										
										<th class='BorderInfDch'>
											Last In
										</th>
										
										<th class='BorderInfDch'>
											Last Out
										</th>
										
										<th class='BorderInf'>
											Nº In
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
 			
			print (	"<tr align='center'>
									
				<form name='ver' action='Feedback_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\">

	<input name='ID' type='hidden' value='".$rowc['ID']."' />
						
						<td class='BorderInfDch'>
	<input name='Nivel' type='hidden' value='".$rowc['Nivel']."' />".$rowc['Nivel']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='ref' type='hidden' value='".$rowc['ref']."' />".$rowc['ref']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />".$rowc['Nombre']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />".$rowc['Apellidos']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
		<img src='img_admin/".$rowc['myimg']."' height='40px' width='30px' />
						</td>
												
	<input name='doc' type='hidden' value='".$rowc['doc']."' />
												
	<input name='dni' type='hidden' value='".$rowc['dni']."' />
												
	<input name='ldni' type='hidden' value='".$rowc['ldni']."' />
												
	<input name='Email' type='hidden' value='".$rowc['Email']."' />
													
						<td class='BorderInfDch'>
	<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />".$rowc['Usuario']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='Password' type='hidden' value='".$rowc['Password']."' />".$rowc['Password']."
						</td>
						
	<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
						
	<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
						
	<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
						
						<td class='BorderInfDch'>
	<input name='borrado' type='hidden' value='".$rowc['borrado']."' />".$rowc['borrado']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='lastin' type='hidden' value='".$rowc['lastin']."' />".$rowc['lastin']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='lastout' type='hidden' value='".$rowc['lastout']."' />".$rowc['lastout']."
						</td>
						
						<td class='BorderInf'>
	<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />".$rowc['visitadmin']."
						</td>
						
					</tr>
					
					<tr>
						<td colspan=8 class='BorderInf'>
										&nbsp;
						</td>
						<td colspan=2 align='center' class='BorderInf'>
										<input type='submit' value='VER DETALLES' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
			</form>
										
					</tr>");
								}  

						print("</table>");
			
						} 

			} 
		
	}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		}
	elseif($_POST['todo']){
		$defaults = $_POST;
		} else {
				$defaults = array ('Nombre' => '',
								   'Apellidos' => '',
								   'Orden' => $ordenar);
								   						}
	
	if ($errors){
		print("<font color='#FF0000'>
				Solucione estos errores: </font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."</br>");
			}
		}
		
	$ordenar = array (	'`ID` ASC' => 'ID Ascendente',
						'`ID` DESC' => 'ID Descendente',
						'`Nombre` ASC' => 'Nombre Ascendente',
						'`Nombre` DESC' => 'Nombre Descendente',
						'`Apellidos` ASC' => 'Apellidos Ascenedente',
						'`Apellidos` DESC' => 'Apellidos Descendente',
						'`Email` ASC' => 'Dirección de Email Ascendente',
						'`Email` DESC' => 'Dirección de Email Descendente',
						'`Tlf1` ASC' => 'Teléfono 1 Ascendente',
						'`Tlf1` DESC' => 'Teléfono 1 Descendente',
						'`Tlf2` ASC' => 'Teléfono 2 Ascendente',
						'`Tlf2` DESC' => 'Teléfono 2 Descendente',
																);

	print("
			<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>
						VER FEEDBACK.
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='Realizar Consulta' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td>	
						Nombre:
					</td>
					<td>
			<input type='text' name='Nombre' size=20 maxlenth=10 value='".$defaults['Nombre']."' />
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						Apellido:
					</td>
					<td>
	<input type='text' name='Apellidos' size=20 maxlenth=10 value='".$defaults['Apellidos']."' />
					</td>
				</tr>
	

						");
						
	print ("		
				
				</form>	
				
				<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center'>
						<input type='submit' value='Ver Todos los Administradores' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>	
						Ordenar Por:
					</td>
					<td>

						<select name='Orden'>");
						
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("	</select>
					</td>
				</tr>
		
		</form>														
			
			</table>				
						"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;

	$orden = $_POST['Orden'];

	$sqlb =  "SELECT * FROM `feedback` ORDER BY $orden ";
 	
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>.");
									

				} else { print ("<table align='center'>
									<tr>
										<th colspan=11 class='BorderInf'>
									Todos los usuarios : ".mysqli_num_rows($qb)." Resultados.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
											Nivel
										</th>
										
										<th class='BorderInfDch'>
											Referencia
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
											Usuario
										</th>
										
										<th class='BorderInfDch'>
											Password
										</th>
																				
										<th class='BorderInfDch'>
											Date Delete
										</th>
										
										<th class='BorderInfDch'>
											Last In
										</th>
										
										<th class='BorderInfDch'>
											Last Out
										</th>
										
										<th class='BorderInf'>
											Nº In
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
			print (	"<tr align='center'>
									
<form name='ver' action='Feedback_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\">

	<input name='ID' type='hidden' value='".$rowb['ID']."' />
						
						<td class='BorderInfDch'>
	<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />".$rowb['Nivel']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='ref' type='hidden' value='".$rowb['ref']."' />".$rowb['ref']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />".$rowb['Nombre']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />".$rowb['Apellidos']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
		<img src='img_admin/".$rowb['myimg']."' height='40px' width='30px' />
						</td>
												
	<input name='doc' type='hidden' value='".$rowb['doc']."' />
						
	<input name='dni' type='hidden' value='".$rowb['dni']."' />
						
	<input name='ldni' type='hidden' value='".$rowb['ldni']."' />
						
	<input name='Email' type='hidden' value='".$rowb['Email']."' />
												
						<td class='BorderInfDch'>
	<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />".$rowb['Usuario']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='Password' type='hidden' value='".$rowb['Password']."' />".$rowb['Password']."
						</td>
						
	<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
						
	<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
						
	<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />
						
						<td class='BorderInfDch'>
	<input name='borrado' type='hidden' value='".$rowb['borrado']."' />".$rowb['borrado']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='lastin' type='hidden' value='".$rowb['lastin']."' />".$rowb['lastin']."
						</td>
						
						<td class='BorderInfDch'>
	<input name='lastout' type='hidden' value='".$rowb['lastout']."' />".$rowb['lastout']."
						</td>
						
						<td class='BorderInf'>
	<input name='visitadmin' type='hidden' value='".$rowb['visitadmin']."' />".$rowb['visitadmin']."
						</td>
						
					</tr>
					<tr>
						<td colspan=8 class='BorderInf'>
												&nbsp;
						</td>
						<td colspan=2 align='center' class='BorderInf'>
									<input type='submit' value='VER DETALLES' />
									<input type='hidden' name='oculto2' value=1 />
						</td>
										
				</form>
										
					</tr>");
								}

						print("</table>");

						} 

			} 
		
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Admin.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Feedback_01(){

	global $db;
	global $rowout;
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
	$text = "- ADMIN FEEDBACK VER ".$ActionTime.". ".$nombre." ".$apellido;

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