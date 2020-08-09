<?php
session_start();
 
		require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

	global $userid;
	
	$userid = $_SESSION['ID'];
	
///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){
 		print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
		master_index();
					
		if ($_POST['cerrar']){	admin_salida();
								desconex();
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
		
				
/////////////////////////////////////////////////////////////////////////////////////////////////

function admin_salida(){

	global $db;
	global $db_name;
	global $userid;
	
	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

	$dateadout = date('Y-m-d/H:i:s');

	$sqladout = "UPDATE `$db_name`.`admin` SET `lastout` = '$dateadout' WHERE `admin`.`ID` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladout)){
				} else {
				print("</br>
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

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){

		require '../Inclu/Master_Index_mcgexit.php';

				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
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
			
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Inclu_Footer_01.php';

?>