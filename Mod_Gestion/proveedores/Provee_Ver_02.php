<?php
session_start();

	require '../Inclu/Admin_Inclu_popup.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){
				
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
							
							if($_POST['oculto2']){
													process_form();
													accion_Ver_02();
								} 
								
				}
					else { 
					
											require "../Inclu/AccesoDenegado.php";			


							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	print("<table align='center' width=490px>
				<tr>
					<th colspan=3  class='BorderInf'>
						DATOS DEL PROVEEDOR
					</th>
				</tr>
				
				<tr>
					<td width=140px>
						ID
					</td>
					<td>"
						.$_POST['id'].
					"</td>
					<td rowspan='5' align='center' width='180px'>
						<img src='img_provee/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>
						RAZON SOCIAL
					</td>
					<td>"
						.$_POST['rsocial'].
						
					"</td>
				</tr>				
				
				<tr>
					<td>
						Tipo Documento:
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td>"
						.$_POST['dni']." ".$_POST['ldni'].
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
						Direcci&oacute;n:
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 1:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 2:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
								
			</table>	
						");


			}
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Ver_02(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	global $text;
	$text = "- PROVEEDORES VER 02 ".$ActionTime.". ".$nombre." ".$apellido;

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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>