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
										accion_Feedback_Admin_01();
										}
										
								
								elseif($_POST['oculto']){
									
										if($form_errors = validate_form()){
											show_form($form_errors);
												} else {
													process_form();
													accion_Feedback_Admin_01();
													}
									
									} else {
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
	$doc = $_POST['doc'];
		
	if (strlen(trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape;}
	
	$sqlc = "SELECT * FROM `feedback` WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
 	
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

				} else { print ("<table align='center'>
									<tr>
										<th colspan=14 class='BorderInf'>
						Administradores con estos criterios : ".mysqli_num_rows($qc)." Resultados.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
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
											Email
										</th>
										
										<th class='BorderInfDch'>
											User
										</th>
										
										<th class='BorderInfDch'>
											Pass
										</th>
										
										<th class='BorderInfDch'>
											Dirección
										</th>
										
										<th class='BorderInfDch'>
											Teléfono 1
										</th>
										
										<th class='BorderInf'>
											Teléfono 2
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
				
			print (	"<tr align='center'>
									
				<form name='modifica' action='Feedback_Admin_Recuperar_02.php' method='POST'>
				
	<input name='lastin' type='hidden' value='".$rowc['lastin']."' />
	<input name='lastout' type='hidden' value='".$rowc['lastout']."' />
	<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />
	<input name='ref' type='hidden' value='".$rowc['ref']."' />

						<td class='BorderInfDch'>
	<input name='ID' type='hidden' value='".$rowc['ID']."' />".$rowc['ID']."
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
		<img src='img_admin/".$rowc['myimg']."' height='40px' width='30px' />
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
		<input name='Email' type='hidden' value='".$rowc['Email']."' />".$rowc['Email']."
						</td>
													
						<td class='BorderInfDch'>
		<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />".$rowc['Usuario']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Password' type='hidden' value='".$rowc['Password']."' />".$rowc['Password']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />".$rowc['Direccion']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />".$rowc['Tlf1']."
						</td>
						
						<td class='BorderInf'>
		<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />".$rowc['Tlf2']."
						</td>
						
					</tr>
					
					<tr>
						<td colspan=12 class='BorderInf'>
										&nbsp;
						</td>
						
						<td colspan=2 align='center' class='BorderInf'>
												<input type='submit' value='Recuperar Admin' />
												<input type='hidden' name='oculto2' value=1 />
				</form>
						</td>
	
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
						Feedback Admin Recuperar
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
						<input type='submit' value='Ver Todos Feedback Admin' />
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
	
	$doc = $_POST['doc'];

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
									

				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=14 class='BorderInfDch'>
									Todos los datos : ".mysqli_num_rows($qb)." Resultados.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
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
											IMG
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
											Email
										</th>
										
										<th class='BorderInfDch'>
											User
										</th>
										
										<th class='BorderInfDch'>
											Pass
										</th>
										
										<th class='BorderInfDch'>
											Dirección
										</th>
										
										<th class='BorderInfDch'>
											Teléfono 1
										</th>
										
										<th class='BorderInf'>
											Teléfono 2
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
			print (	"<tr align='center'>
									
		<form name='modifica' action='Feedback_Admin_Recuperar_02.php' method='POST'>
						
						<td class='BorderInfDch'>
	<input name='ID' type='hidden' value='".$rowb['ID']."' />".$rowb['ID']."
	<input name='ref' type='hidden' value='".$rowb['ref']."' />
						</td>
						
						<td class='BorderInfDch'>
		<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />".$rowb['Nivel']."
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
												
						<td class='BorderInfDch'>
		<input name='doc' type='hidden' value='".$rowb['doc']."' />".$rowb['doc']."
						</td>
						
						<td class='BorderInf'>
		<input name='dni' type='hidden' value='".$rowb['dni']."' />".$rowb['dni']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='ldni' type='hidden' value='".$rowb['ldni']."' />".$rowb['ldni']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Email' type='hidden' value='".$rowb['Email']."' />".$rowb['Email']."
						</td>	
												
						<td class='BorderInfDch'>
		<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />".$rowb['Usuario']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Password' type='hidden' value='".$rowb['Password']."' />".$rowb['Password']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />".$rowb['Direccion']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />".$rowb['Tlf1']."
						</td>
						
						<td class='BorderInf'>
		<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />".$rowb['Tlf2']."
						</td>
				
		<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
		<input name='lastout' type='hidden' value='".$rowb['lastout']."' />
		<input name='visitadmin' type='hidden' value='".$rowb['visitadmin']."' />
						
										</tr>
					<tr>
						<td colspan=12 class='BorderInf'>
										&nbsp;
						</td>
						<td colspan=2 align='center' class='BorderInfDch'>
										<input type='submit' value='Recuperar Admin' />
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

function accion_Feedback_Admin_01(){

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
		$text = "- ADMIN FEEDBACK RECUPERAR 1 ".$ActionTime.". ".$nombre." ".$apellido;
		
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