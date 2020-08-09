<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

								if($_POST['todo']){
										show_form();							
										ver_todo();
										accion_Ver_01();
										}
								
								elseif($_POST['oculto']){
									
										if($form_errors = validate_form()){
											show_form($form_errors);
												} else {
													process_form();
													accion_Ver_01();
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
	
	if ( (strlen(trim($_POST['ref'])) == 0) && (strlen(trim($_POST['dni'])) == 0) && (strlen(trim($_POST['rsocial'])) == 0) ){
		$errors [] = " <font color='#FF0000'>UNO DE LOS TRES CAMPOS OBLIGATORIO</font>";
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
	
	if ($_POST['rsocial'] == ''){$rso = 'ññ';}
	else{$rso = "%".$_POST['rsocial']."%";}
	global $rsocial;
	$rsocial = $_POST['rsocial'];
	
	if ($_POST['dni'] == ''){$dni = 'ññ';}
	else{$dni = $_POST['dni'];}
	global $dnie;
	$dnie = $_POST['dni'];
	
	if ($_POST['ref'] == ''){$ref = 'ññ';}
	else{$ref = $_POST['ref'];}
	global $refer;
	$refer = $_POST['ref'];
	
	$orden = $_POST['Orden'];
		
$sqlc =  "SELECT * FROM `proveedores` WHERE `ref` = '$ref' OR `dni` = '$dni' OR `rsocial` LIKE '$rso' ORDER BY $orden ";
 	
	$qc = mysqli_query($db, $sqlc);
	
	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
			
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

				} else { 	
							print ("<table align='center'>
									<tr>
										<th colspan=7 class='BorderInf'>
									BORRAR PROVEEDORES : ".mysqli_num_rows($qc).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											REFERENCIA
										</th>
										
										<th class='BorderInfDch'>
											DNI
										</th>
										
										<th class='BorderInfDch'>
											RAZON SOCIAL
										</th>
										
										<th colspan='3' class='BorderInf'>
											
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
 			
			print (	"<tr align='center'>
									
		<form name='modifica' action='Provee_Borrar_02.php' method='POST'>

						<td align='left' class='BorderInfDch'>
		<input name='ID' type='hidden' value='".$rowc['ID']."' />".$rowc['ID']."
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='ref' type='hidden' value='".$rowc['ref']."' />".$rowc['ref']."
						</td>
							
						<td align='left' class='BorderInfDch'>
		<input name='dni' type='hidden' value='".$rowc['dni']."' />".$rowc['dni'].$rowc['ldni']."
		<input name='ldni' type='hidden' value='".$rowc['ldni']."' />
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='rsocial' type='hidden' value='".$rowc['rsocial']."' />".$rowc['rsocial']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
		<img src='img_provee/".$rowc['myimg']."' height='40px' width='30px' />
						</td>
												
		<input name='doc' type='hidden' value='".$rowc['doc']."' />
		<input name='Email' type='hidden' value='".$rowc['Email']."' />
		<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
		<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
		<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
						
			<td colspan=2 align='center' class='BorderInf'>
								<input type='submit' value='BORRAR DATOS' />
								<input type='hidden' name='oculto2' value=1 />
			</td>
	</form>
										
			</tr>");
								} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		}
	elseif($_POST['todo']){
		$defaults = $_POST;
		} else {
				$defaults = array ('rsocial' => '',
								   'ref' => '',
								   'dni' => '',
								   'Orden' => $ordenar);
								   						}
	
	if ($errors){
		print("<font color='#FF0000'>
				Solucione estos errores: </font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."</br>");
			}
		}
		
	$ordenar = array (	'`rsocial` ASC' => 'R. SOCIAL ASC',
						'`rsocial` DESC' => 'R. SOCIAL DESC',
						'`ref` ASC' => 'REF. ASC',
						'`ref` DESC' => 'REF. DESC',
						'`dni` ASC' => 'DNI. ASC',
						'`dni` DESC' => 'DNI. DESC',
														);

	print("
			<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>
						BORRAR PROVEEDORES
					</th>
				</tr>
				
	<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='CONSULTA' />
						<input type='hidden' name='oculto' value=1 />
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

				<tr>
					<td>
					</td>
					<td>	
						REFERENCIA
					</td>
					<td>
	<input type='text' name='ref' size=20 maxlenth=20 value='".$defaults['ref']."' />
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						Nº DNI
					</td>
					<td>
	<input type='text' name='dni' size=20 maxlenth=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
					</td>
					<td>	
						RAZON SOCIAL
					</td>
					<td>
	<input type='text' name='rsocial' size=20 maxlenth=20 value='".$defaults['rsocial']."' />
					</td>
				</tr>
				
	</form>	
				
	<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center'>
						<input type='submit' value='TODOS LOS PROVEEDORES' />
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
				"); /* Fin del print */
	
	}	/* Fin show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;

	$orden = $_POST['Orden'];

	$sqlb =  "SELECT * FROM `proveedores` ORDER BY $orden ";
 	
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
									
				} else { 	
							
							print ("<table align='center'>
									<tr>
										<th colspan=7 class='BorderInf'>
									BORRAR PROVEEDORES ".mysqli_num_rows($qb).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											REFERENCIA
										</th>
										
										<th class='BorderInfDch'>
											DNI
										</th>
										
										<th class='BorderInfDch'>
											RAZON SOCIAL
										</th>
										
										<th colspan='3' class='BorderInf'>
											
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
			print (	"<tr align='center'>
									
		<form name='modifica' action='Provee_Borrar_02.php' method='POST'>

						<td align='left' class='BorderInfDch'>
		<input name='ID' type='hidden' value='".$rowb['ID']."' />".$rowb['ID']."
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='ref' type='hidden' value='".$rowb['ref']."' />".$rowb['ref']."
						</td>
							
						<td align='left' class='BorderInfDch'>
		<input name='dni' type='hidden' value='".$rowb['dni']."' />".$rowb['dni'].$rowb['ldni']."
		<input name='ldni' type='hidden' value='".$rowb['ldni']."' />
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='rsocial' type='hidden' value='".$rowb['rsocial']."' />".$rowb['rsocial']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
		<img src='img_provee/".$rowb['myimg']."' height='40px' width='30px' />
						</td>
												
		<input name='doc' type='hidden' value='".$rowb['doc']."' />
		<input name='Email' type='hidden' value='".$rowb['Email']."' />
		<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
		<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
		<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />
						
			<td colspan=2 align='center' class='BorderInf'>
								<input type='submit' value='BORRAR DATOS' />
								<input type='hidden' name='oculto2' value=1 />
			</td>
										
	</form>
										
			</tr>");
					
					} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Proveedores.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Ver_01(){

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
	$text = "- PROVEEDORES BORRAR 01 ".$ActionTime.". ".$nombre." ".$apellido;

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