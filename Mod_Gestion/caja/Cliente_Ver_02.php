<?php
session_start();

	require '../Inclu/Admin_Inclu_popup.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){
				
						
							if($_POST['data_client']){
													process_form();
																	} 
								
				} else { 
					
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
	
if (($_POST['Nivel'] == 'admin') || ($_POST['Nivel'] == 'plus') || ($_POST['Nivel'] == 'user') || ($_POST['Nivel'] == 'caja')){$ruta = '../Admin/img_admin/';}
if ($_POST['Nivel'] == 'cliente'){$ruta = '../Admin_clientes/img_cliente/';}
$_SESSION['nclient'] = $_POST['Nivel'];

if (($_SESSION['nclient'] == 'cliente') || ($_SESSION['Nivel'] == 'admin')){ $h = "height='120'px";
																		  $w = "width='90'px";
																				}
								else { 	$h1 = 120 - ((120 * 20)/100);
										$h = "height='".$h1."'px";
										$w1 = 90 - ((90 * 20)/100);
										$w = "width='".$w1."'px";
																	}
											
	print("<table align='center' width=490px>
				<tr>
					<th colspan=3  class='BorderInf'>
						DATOS DEL CLIENTE
					</th>
				</tr>
				
				<tr>
					<td width=140px>
						ID:
					</td>
					<td>"
						.$_POST['id'].
					"</td>
					<td rowspan='4' align='center' width='180px'>
	<img src='".$ruta."".$_POST['myimg']."' ".$h." ".$w." />
					</td>
				</tr>
					");
				
if (($_SESSION['nclient'] == 'cliente') || ($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')) {
	
		print("
				<tr>
					<td>
						Nivel:
					</td>
					<td>"
						.$_POST['Nivel'].
					"</td>
				</tr>
					");
			}
		
	print("		
				<tr>
					<td>
						Referencia:
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nombre:
					</td>
					<td>"
						.$_POST['Nombre'].
					"</td>
				</tr>
						
				<tr>
					<td>
						Apellidos:
					</td>
					<td>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
						");

				
if (($_SESSION['nclient'] == 'cliente') || ($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){
	
		print("
				<tr>
					<td>
						Tipo Documento:
					</td>
					<td colspan='2'>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td colspan='2'>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Control:
					</td>
					<td colspan='2'>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				<tr>
					<td>
						Usuario:
					</td>
					<td colspan='2'>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td colspan='2'>"
						.$_POST['Password'].
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
					<td>
						Last IN:
					</td>
					<td colspan='2'>"
						.$_POST['lastin'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Last Out:
					</td>
					<td colspan='2'>"
						.$_POST['lastout'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nº Visitas:
					</td>
					<td colspan='2'>"
						.$_POST['visitadmin'].
					"</td>
				</tr>
					");
				}
	print("				
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
	$text = "- CLIENTE DETALLES ".$ActionTime.". ".$nombre." ".$apellido;

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
///

	require '../Inclu/Admin_Inclu_02.php';
		
?>