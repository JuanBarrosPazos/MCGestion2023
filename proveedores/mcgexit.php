<?php
session_start();
 

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

	global $userid;
	$userid = $_SESSION['id'];
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){
 		print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
		master_index();
					
		if ($_POST['cerrar']){	admin_salida();
								desconex();
												}	
					} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}
		
				
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function admin_salida(){

	global $userid;
	global $dir;

	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

	$dateadout = date('Y-m-d/H:i:s');

	require "../config/TablesNames.php";

	$sqladout = "UPDATE `$db_name`.$gst_admin SET `lastout` = '$dateadout' WHERE $gst_admin.`id` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladout)){ // print("* ");
		} else { print("</br>
				 <font color='#FF0000'>
				 * FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."
				 </br>";
			}
					
	$text = "** FIN SESION ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']." => ".$dateadout;
	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = "\n".$text."\n \n";
	$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){

		require '../Inclu/Master_Index_mcgexit.php';

				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function desconex(){

			print("<table align='center'style=\"margin-top:80px; margin-bottom:80px;\">
						<form name='salir' action='../Admin_index.php' method='post'>
							<tr>
								<td valign='bottom' align='center'>
									<input type='submit' value='CONFIRME CERRAR SESIÓN' />
								</td>
							</tr>								
									<input type='hidden' name='salir' value=1 />
						</form>	
					</table>
							");
	
			} 
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

//	require 'Inclu/Admin_Inclu_02.php';

	require '../Inclu/Inclu_Footer_01.php';

?>