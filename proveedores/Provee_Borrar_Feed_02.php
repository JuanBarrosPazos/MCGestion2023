<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $gst_admin WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){

 			print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
			master_index();

			if ($_POST['oculto2']){
					show_form();
				// 	accion_Modificar_01();
								}
						elseif($_POST['borra']){
										process_form();
									//	accion_Modificar_02();
							} else {
										show_form();
										unset($_SESSION['dudas']);
									}
				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
		require "../config/TablesNames.php";
		$pimg =  "SELECT * FROM `$db_name`.$gst_proveedoresfeed WHERE `ref` = '$rf' ";
		$qpimg = mysqli_query($db, $pimg);
		$rowpimg = mysqli_fetch_assoc($qpimg);
		
		global $dudas;
		$dudas = trim($_SESSION['myimg']);

		print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>HA BORRADO AL PROVEEDOR</th>
				</tr>
				<tr>
					<td>RAZON SOCIAL</td>
					<td>".$_POST['rsocial']."</td>
					<td rowspan='5' align='center'>
			<img src='img_provee/".$dudas."' height='120px' width='90px' />
					</td>
				</tr>
				<tr>
					<td>DOCUMENTO</td>
					<td>".$_POST['doc']."</td>
				</tr>				
				<tr>
					<td>NUMERO</td>
					<td>".$_POST['dni']."</td>
				</tr>				
				<tr>
					<td>CONTROL</td>
					<td>".$_POST['ldni']."</td>
				</tr>				
				<tr>
					<td>MAIL</td>
					<td colspan='2'>".$_POST['Email']."</td>
				</tr>
				<tr>
					<td>REFERENCIA</td>
					<td>".$_POST['ref']."</td>
				</tr>
				<tr>
					<td>PAIS</td>
					<td colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				<tr>
					<td>TELEFONO 1</td>
					<td colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				<tr>
					<td>TELEFONO 2</td>
					<td colspan='2'>".$_POST['Tlf2']."</td>
				</tr>
			</table>" );
			
	require "../config/TablesNames.php";
	
	$sql = "DELETE FROM `$db_name`.$gst_proveedoresfeed WHERE $gst_proveedoresfeed.`id` = '$_POST[id]' LIMIT 1 ";
	
	if(mysqli_query($db, $sql)){
								unlink("img_provee/".$dudas);
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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form(){
	
	$_SESSION['myimg'] = $_POST['myimg'];

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=3 class='BorderInf'>

							BORRARÁ EL PROVEEDOR
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						ID
					</td>
					<td>
<input type='hidden' name='id' value='".$_POST['id']."' />".$_POST['id']."
					</td>
					<td rowspan='4' align='center'>
						<img src='img_provee/".$_SESSION['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						REFERENCIA
					</td>
					<td>
<input type='hidden' name='ref' value='".$_POST['ref']."' />".$_POST['ref']."
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						RAZON SOCIAL
					</td>
					<td>
<input type='hidden' name='rsocial' value='".$_POST['rsocial']."' />".$_POST['rsocial']."
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						DOCUMENTO
					</td>
					<td>
					
<input type='hidden' name='doc' value='".$_POST['doc']."' />".$_POST['doc']."

					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
							NÚMERO
					</td>
					<td colspan=2>
<input type='hidden' name='dni' value='".$_POST['dni']."' />".$_POST['dni']."
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							CONTROL
					</td>
					<td colspan=2>
<input type='hidden' name='ldni' value='".$_POST['ldni']."' />".$_POST['ldni']."
					</td>
				</tr>
				
					<td>
						<font color='#FF0000'>*</font>
							MAIL
					</td>
					<td colspan=2>
<input type='hidden'' name='Email' value='".$_POST['Email']."' />".$_POST['Email']."
					</td>
				</tr>	
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							DIRECCIÓN
					</td>
					<td colspan=2>
<input type='hidden' name='Direccion' value='".$_POST['Direccion']."' />".$_POST['Direccion']."
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							TELÉFONO 1
					</td>
					<td colspan=2>
<input type='hidden' name='Tlf1' value='".$_POST['Tlf1']."' />".$_POST['Tlf1']."
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							TELEÉFONO 2
					</td colspan=2>
					<td>
<input type='hidden' name='Tlf2' value='".$_POST['Tlf2']."' />".$_POST['Tlf2']."
					</td>
				</tr>
				
				<tr>
					<td colspan='3'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='BORRAR DATOS' />
						<input type='hidden' name='borra' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); /* Fin del print */
	
	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Proveedores.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_admin_crear(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $rf;
	global $texerror;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

global $text;
if ($nombre == ''){$text = "- ERROR LA IMAGEN YA EXISTE";}
else{$text = "- PROVEEDORES FEED 02 ".$ActionTime.". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];			
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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>