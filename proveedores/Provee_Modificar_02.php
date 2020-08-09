<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

	$sqld =  "SELECT * FROM `admin` WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

 			print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
			master_index();

			if ($_POST['oculto2']){
					show_form();
				// accion_Modificar_01();
								}
						elseif($_POST['modifica']){
								
							if($form_errors = validate_form()){
								show_form($form_errors);
									} else {
										process_form();
									//	accion_Modificar_02();
												}
							} else {
										show_form();
										unset($_SESSION['dudas']);
										unset($_SESSION['dniold']);
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
	
		global $sqld;
		global $qd;
		global $rowd;
	
		require '../Inclu/validate_provee.php';	
		
			return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	
	if (preg_match('/^(\w{1})/',$_POST['rsocial'],$ref1)){	$rf1 = $ref1[1];
															$rf1 = trim($rf1);
																			}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['rsocial'],$ref2)){$rf2 = $ref2[2];
																	$rf2 = trim($rf2);
																			}
	global $rf;
	$rf = $rf1.$rf2.$_POST['dni'].$_POST['ldni'];
	$rf = trim($rf);
			
	$sqldni =  "SELECT * FROM `$db_name`.`proveedores` WHERE `proveedores`.`dni` = '$_POST[dni]'";
	$qdni = mysqli_query($db, $sqldni);
	$rowdni = mysqli_fetch_assoc($qdni);

//	print($_SESSION['dniold']);
	global $dniold;
	$dniold = $_SESSION['dniold'];
	$dniold = trim($dniold);
	$dniold = "%".$dniold."%";
	
	global $ldniold;
	$ldniold = $_SESSION['ldniold'];
	$ldniold = trim($ldniold);
	$ldniold = "%".$ldniold."%";

	global $refold;
	$refold = $_SESSION['refold'];
	$refold = trim($refold);
	$refold = "%".$refold."%";
	
	global $dnif;
	$dnif = $_SESSION['dniold'].$_SESSION['ldniold'];
	$dnif = trim($dnif);
	$dnif = "%".$dnif."%";
	
	global $factnif;
	$factnif = $_POST['dni'].$_POST['ldni'];
	$factnif = trim($factnif);

	if ($_POST['ID'] == $rowdni['ID']){
		
	$sql = "UPDATE `$db_name`.`proveedores` SET `ref` = '$rf', `rsocial` = '$_POST[rsocial]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE `proveedores`.`ID` = '$_POST[ID]' LIMIT 1 ";
		
	$sqf = "UPDATE `$db_name`.`proveedoresfeed` SET `ref` = '$rf', `rsocial` = '$_POST[rsocial]',  `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE `proveedoresfeed`.`dni` LIKE '$dniold' LIMIT 1 ";
		
	$Year = date('Y');
	$Year2 = $Year - 1;
	$gastos = 'gastos_'.$Year;
	$gastos2 ='gastos_'.$Year2;

	$dnif = $_POST['dni'].$_POST['ldni'];

$sg1 = "UPDATE `$db_name`.`$gastos` SET `refprovee` = '$rf', `factnif` = '$factnif', `factnom` = '$_POST[rsocial]' WHERE `$gastos`.`factnif` LIKE '$dnif' ";


$sg2 = "UPDATE `$db_name`.`$gastos2` SET `refprovee` = '$rf', `factnif` = '$factnif', `factnom` = '$_POST[rsocial]' WHERE `$gastos2`.`factnif` LIKE '$dnif' ";

		}
	
	else{
		
	$sql = "UPDATE `$db_name`.`proveedores` SET  `ref`= '$rf', `rsocial` = '$_POST[rsocial]', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE `proveedores`.`ID` = '$_POST[ID]' LIMIT 1 ";
	
	$sqf = "UPDATE `$db_name`.`proveedoresfeed` SET  `ref`= '$rf', `rsocial` = '$_POST[rsocial]', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE `proveedoresfeed`.`dni` LIKE '$dniold' LIMIT 1 ";
	
	$Year = date('Y');
	$Year2 = $Year - 1;
	$gastos = 'gastos_'.$Year;
	$gastos2 ='gastos_'.$Year2;

	$dnif = $_POST['dni'].$_POST['ldni'];

$sg1 = "UPDATE `$db_name`.`$gastos` SET `refprovee` = '$rf', `factnif` = '$factnif', `factnom` = '$_POST[rsocial]' WHERE `$gastos`.`factnif` LIKE '$dnif' ";


$sg2 = "UPDATE `$db_name`.`$gastos2` SET `refprovee` = '$rf', `factnif` = '$factnif', `factnom` = '$_POST[rsocial]' WHERE `$gastos2`.`factnif` LIKE '$dnif' ";

	}
	
	if(mysqli_query($db, $sg1)){ print("* OK");
				} else {
				print("<font color='#FF0000'>* ".mysqli_error($db))."</br>";
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}

	if(mysqli_query($db, $sg2)){ print("* OK");
				} else {
				print("<font color='#FF0000'>* ".mysqli_error($db))."</br>";
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}

	if(mysqli_query($db, $sqf)){print("TODO VA BIEN");}else {
				print("</br><font color='#FF0000'>* ERROR </font>".mysqli_error($db));}

	if(mysqli_query($db, $sql)){
		
	//	$fil = "%".$rf."%";
		$pimg =  "SELECT * FROM `$db_name`.`proveedores` WHERE `ref` = '$rf' ";
		$qpimg = mysqli_query($db, $pimg);
		$rowpimg = mysqli_fetch_assoc($qpimg);
		$_SESSION['dudas'] = $rowpimg['myimg'];
		global $dudas;
		$dudas = $_SESSION['dudas'];
		$dudas = trim($dudas);
	//	print("** ".$rowpimg['myimg']);

		print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						HA REGISTRADO UN NUEVO PROVEEDOR.
					</th>
				</tr>
								
				<tr>
					<td width=150px>
						RAZON SOCIAL
					</td>
					<td width=200px>"
						.$_POST['rsocial'].
					"</td>
					<td rowspan='5' align='center' width='100px'>
			<img src='img_provee/".$dudas."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						DOCUMENTO
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						NUMERO
					</td>
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						CONTROL
					</td>
					<td>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						MAIL
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$rf.
					"</td>
				</tr>
				
				<tr>
				
					<td>
						PAIS
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TELEFONO 1
					</td>
					<td colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TELEFONO 2
					</td>
					<td colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
								
			</table>" );
			
			
				} else {

				print("</br>
				<font color='#FF0000'>
			* MODIFIQUE LA ENTRADA: </font></br> ".mysqli_error($db))."
				</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
					}
	
			}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto2']){
		
	$_SESSION['dniold'] = $_POST['dni'];
	$_SESSION['refold'] = $_POST['ref'];
	$_SESSION['ldniold'] = $_POST['ldni'];
	
				$defaults = array ( 'ID' => $_POST['ID'],
									'rsocial' => $_POST['rsocial'],
									'myimg' => $_POST['myimg'],	
									'ref' => $_POST['ref'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2']);
								   								}
																
		elseif($_POST['modifica']){
			global $img2;
			$img2 = 'untitled.png';
				$defaults = array ( 'ID' => $_POST['ID'],
									'rsocial' => $_POST['rsocial'],
									'myimg' => $_POST['myimg'],	
									'ref' => $_POST['ref'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2']);
																}
	
		else{$defaults = $_POST;}
		
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
	
	$doctype = array (	'DNI' => 'DNI/NIF Espa&ntilde;oles',
						'NIE' => 'NIE/NIF Extranjeros',
						'NIFespecial' => 'NIF Persona F&iacute;sica Especial',
						'NIFsa' => 'NIF Sociedad An&oacute;nima',
						'NIFsrl' => 'NIF Sociedad Responsabilidad Limitada',
						'NIFscol' => 'NIF Sociedad Colectiva',
						'NIFscom' => 'NIF Sociedad Comanditaria',
						'NIFcbhy' => 'NIF Comunidad Bienes y Herencias Yacentes',
						'NIFscoop' => 'NIF Sociedades Cooperativas',
						'NIFasoc' => 'NIF Asociaciones',
						'NIFcpph' => 'NIF Comunidad Propietarios Propiedad Horizontal',
						'NIFsccspj' => 'NIF Sociedad Civil, con o sin Personalidad Juridica',
						'NIFee' => 'NIF Entidad Extranjera',
						'NIFcl' => 'NIF Corporaciones Locales',
						'NIFop' => 'NIF Organismo Publico',
						'NIFcir' => 'NIF Congragaciones Instituciones Religiosas',
						'NIFoaeca' => 'NIF Organos Admin Estado y Comunidades Autonomas',
						'NIFute' => 'NIF Uniones Temporales de Empresas',
						'NIFotnd' => 'NIF Otros Tipos no Definidos',
						'NIFepenr' => 'NIF Establecimientos Permanentes Entidades no Residentes',
										);
	
if (preg_match('/^(\w{1})/',$_POST['rsocial'],$ref1)){	$rf1 = $ref1[1];
														$rf1 = trim($rf1);
																						}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['rsocial'],$ref2)){	$rf2 = $ref2[2];
																$rf2 = trim($rf2);
																						}
global $rf;
$rf = $rf1.$rf2.$_POST['dni'].$_POST['ldni'];
$rf = trim($rf);

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							DATOS DEL NUEVO PROVEEDOR
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
			<input type='hidden' name='ID' value='".$defaults['ID']."' />
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						REFERENCIA
					</td>
					<td width=360px>
									".$rf."
					</td>
				</tr>
					
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						RAZON SOCIAL
					</td>
					<td width=360px>
		<input type='text' name='rsocial' size=30 maxlength=30 value='".$defaults['rsocial']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						DOCUMENTO
					</td>
					<td>
					
			<select name='doc'>");

				foreach($doctype as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['doc']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	

	print ("</select>
					</td>
				</tr>
					

				<tr>
					<td>
						<font color='#FF0000'>*</font>
							NÚMERO
					</td>
					<td>
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							CONTROL
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				
					<td>
						<font color='#FF0000'>*</font>
							MAIL
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							DIRECCIÓN
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							TELÉFONO 1
					</td>
					<td>
		<input type='number' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<tr>
					<td>
						<font color='#FF0000'>*</font>
							TELEÉFONO 2
					</td>
					<td>
		<input type='number' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='MODIFICAR DATOS' />
						<input type='hidden' name='modifica' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); /* Fin del print */
	
	}	/* Fin show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Proveedores.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Modificar_02(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $rf;
	global $texerror;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

global $text;
if ($nombre == ''){$text = "- ERROR LA IMAGEN YA EXISTE";}
else{$text = "- PROVEEDORES MODIFICAR 02 ".$ActionTime.". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];			
	}

	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror."\n";
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