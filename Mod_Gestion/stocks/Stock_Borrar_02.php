<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $admin WHERE `id` = '$_POST[id]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){
				 /* Si el nivel de acceso es correcto. */	
 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
								show_form();
								accion_Borrar_01();																				
								}
							elseif($_POST['oculto']){
								
												process_form();
													Feedback();
											accion_Borrar_02();																				
								} 
									else {
											show_form();
									}

				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	
	global $secc;
	$secc = "stock".$_POST['seccion'];
	$secc = "`".$secc."`";

	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];

	$semana = date('W');

	$date = date('Y-m-d');

	$datekgbad = array ('SIN FECHA' => 'NO INSERTAR FECHA',
						''.$fechakgbad.'' => 'INSERTAR FECHA'
															);														
	$entrada = $_POST['kgin'];
	$perecedero = $_POST['kgbad'];
	$caja = $_POST['kgcash'];
	$diferencia = ($entrada - $perecedero) - $caja;
	if (($entrada - $perecedero) < 0){ $diferencia = '-' .$diferencia;}

	$tabla = "<table align='center' style=\"margin-top:20px\">

				<tr>
					<th colspan=2  class='BorderInf'>
						SE HAN BORRADO LOS DATOS.
					</th>
				</tr>
				
				<tr>
					<td>						
						WEEK
					</td>
					<td>"
						.$_POST['nsemana'].
					"</td>
				</tr>
				
				<tr>
					<td>
						PRO REF
					</td>
					<td>"
						.$_POST['producto'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						PRO NAME
					</td>
					<td>"
						.$_POST['proname'].
					"</td>
				</tr>				
				
				<tr>
					<td>						
						 UNIT ENTRADA
					</td>
					<td>"
						.$_POST['kgin'].
					"</td>
				</tr>
				
				<tr>
					<td>						
						UNIT € PSIVA
					</td>
					<td>"
						.$_POST['psiva'].
					" €
					</td>
				</tr>
				
				<tr>
					<td>						
						TIPO IVA
					</td>
					<td>"
						.$_POST['iva'].
						" %
					</td>
				</tr>
				
				<tr>
					<td>						
						IVA €
					</td>
					<td>"
						.$_POST['ivae'].
					" €
					</td>
				</tr>
				
				<tr>
					<td>						
						UNIT € PVP
					</td>
					<td>"
						.$_POST['pvp'].
					" €
					</td>
				</tr>
				
				<tr>
					<td>
						FECHA ENTRADA
					</td>
					<td>"
						.$_POST['datekgin'].
					"</td>
				</tr>
				
				<tr>
					<td>						
						UNIT PERECEDEROS
					</td>
					<td>"
						.$_POST['kgbad'].
					"</td>
				</tr>
				
				<tr>
					<td>
						FECHA PERECEDEROS
					</td>
					<td>"
						. $_POST['datekgbad'].
					"</td>
				</tr>
				
				
				<tr>
				
					<td>						
						UNIT CAJA
					</td>
					<td>"
						.$_POST['kgcash'].
					"</td>
				</tr>
				
				<tr>
					<td>						
						CAJA TOT €
					</td>
					<td>"
						.$_POST['pvptot'].
					" €
					</td>
				</tr>
				
				<tr>
					<td>						
						DATE CASH
					</td>
					<td>"
						.$date.
					"</td>
				</tr>
				
				<tr>
					<td>
						COMENTARIOS
					</td>
					<td width=200px>"
						.$_POST['coment'].
					"</td>
				</tr>
			</table>";	
		
	$id = $_POST['id'];

	require "../config/TablesNames.php";
	
	$sqlc = "DELETE FROM `$db_name`.$tablastock3 WHERE $tablastock3.`id` = '$_POST[id]' LIMIT 1  ";

	if(mysqli_query($db, $sqlc)){ print( $tabla );
		} else { print("<font color='#FF0000'>
						SE HA PRODUCIDO UN ERROR: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
							}
		
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function Feedback(){
	
	$FBaja = date('Y-m-d/H:i:s');
	
	$entrada = $_POST['kgin'];
	$perecedero = $_POST['kgbad'];
	$caja = $_POST['kgcash'];
	$diferencia = ($entrada - $perecedero) - $caja;

	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
			
	require "../config/TablesNames.php";

	$sqlf = "INSERT INTO `$db_name`.$feedtable ( `nsemana`,`producto`,`proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`, `borrado`) VALUES ( '$_POST[nsemana]','$_POST[producto]', '$_POST[proname]', '$_POST[psiva]', '$_POST[iva]', '$_POST[ivae]', '$_POST[pvp]', '$_POST[kgin]', '$_POST[datekgin]',  '$_POST[kgbad]', '$_POST[datekgbad]', '$_POST[kgcash]', '$_POST[pvptot]', '$_POST[datecash]', '$diferencia', '$_POST[coment]', '$FBaja')";
	
	if(mysqli_query($dbf, $sqlf)){	global $texfd;
									$texfd = "\n\t RESPALDO DE DATOS EN ".$feedtable;
						} 
						else {
				print("<font color='#FF0000'>
						* SE HA PRODUCIDO UN ERROR AL GRABAR FEEDBACK: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($dbf)).
						"</br>";
					}
			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

					
			$id = $_POST['id'];

function show_form($errors=[]){
		
	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	
	global $_sec;
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];

//////////////////////////

	$fechakgbad = date('Y-m-d');

	$datekgbad = array ('SIN FECHA' => 'NO INSERTAR FECHA',
						''.$fechakgbad.'' => 'INSERTAR FECHA'
															);														
	$entrada = $_POST['kgin'];
	$perecedero = $_POST['kgbad'];
	$caja = $_POST['kgcash'];
	$diferencia = ($entrada - $perecedero) - $caja;
	if (($entrada - $perecedero) < 0){ $diferencia = '-' .$diferencia;}

/////////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							BORRAR DATOS STOCK ".$rowseccion['nombre']."
					</th>
				</tr>
				
				<tr>
					<th colspan=2 class='BorderInf'>
						<font color='#FF0000'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO.
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
				</tr>
				
			<form name='borrar' method='post' action='$_SERVER[PHP_SELF]'>
			
		<input name='id' type='hidden' value='".$defaults['id']."' />					

				<tr>								
					<td>
	<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
					</td>
				</tr>

				<tr>
					<td>
						ID
					</td>
					<td>
	<input name='id' type='hidden' value='".$_POST['id']."' />".$_POST['id']."
					</td>
				</tr>

				<tr>
					<td>						
						WEEK
					</td>
					<td>
	<input name='nsemana' type='hidden' value='".$_POST['nsemana']."' />".$_POST['nsemana']."
					</td>
				</tr>
									
				<tr>
					<td>
						PRODUCT REF
					</td>
					<td>
	<input name='producto' type='hidden' value='".$_POST['producto']."' />".$_POST['producto']."
					</td>
				</tr>
				
				<tr>
					<td>
						PRODUCT NAME
					</td>
					<td>
	<input name='proname' type='hidden' value='".$_POST['proname']."' />".$_POST['proname']."
					</td>
				</tr>
				
				<tr>
					<td>						
						UNIT ENTRADA
					</td>
					<td>
	<input name='kgin' type='hidden' value='".$_POST['kgin']."' />".$_POST['kgin']."
					</td>
				</tr>
					
				<tr>
					<td>
						UNIT PSIVA €
					</td>
					<td>
	<input name='psiva' type='hidden' value='".$_POST['psiva']."' />".$_POST['psiva']."
					</td>
				</tr>
				
				<tr>
					<td>
						TIPO IVA €
					</td>
					<td>
	<input name='iva' type='hidden' value='".$_POST['iva']."' />".$_POST['iva']."
					</td>
				</tr>
				
				<tr>
					<td>
						IVA €
					</td>
					<td>
	<input name='ivae' type='hidden' value='".$_POST['ivae']."' />".$_POST['ivae']."
					</td>
				</tr>
				
				<tr>
					<td>
						UNIT € PVP
					</td>
					<td>
	<input name='pvp' type='hidden' value='".$_POST['pvp']."' />".$_POST['pvp']."
					</td>
				</tr>
				
				<tr>
					<td>
						FECHA ENTRADA
					</td>
					<td>
	<input name='datekgin' type='hidden' value='".$_POST['datekgin']."' />".$_POST['datekgin']."
					</td>
				</tr>
								
				<tr>
					<td>						
						UNIT PERECEDEROS
					</td>
					<td>
					
	<input name='kgbad' type='hidden' value='".$_POST['kgbad']."' />".$_POST['kgbad']."

					</td>
				</tr>
				
				<tr>
					<td>
						FECHA PERECEDEROS
					</td>
					<td>

	<input name='datekgbad' type='hidden' value='".$_POST['datekgbad']."' />".$_POST['datekgbad']."

					</td>
				</tr>
										
				<tr>
					<td>						
						UNIT CAJA
					</td>
					<td>

	<input name='kgcash' type='hidden' value='".$_POST['kgcash']."' />".$_POST['kgcash']."

					</td>
				</tr>
								
				<tr>
					<td>						
						TOT CASH €
					</td>
					<td>

	<input name='pvptot' type='hidden' value='".$_POST['pvptot']."' />".$_POST['pvptot']."

					</td>
				</tr>
								
				<tr>
					<td>						
						DATE CASH
					</td>
					<td>
	<input name='datecash' type='hidden' value='".$_POST['datecash']."' />".$_POST['datecash']."
					</td>
				</tr>

				<tr>
					<td>
						COMENTARIOS:
					</td>
					<td>
					
	<input name='coment' type='hidden' value='".$_POST['coment']."' />".$_POST['coment']."

					</td>
				</tr>
				
				<tr align='center'>
					<td colspan='2'>
			<input type='submit' value='BORRAR DEFINITIVAMENTE DEL REGISTRO' />
			<input type='hidden' name='oculto' value=1 />
					</td>

				</tr>
				
		</form>														
			
			</table>				

				"); 

	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Borrar_02(){

	global $db;
	global $rowout;
	global $_sec;
	$secc = $_sec;	

	global $texfd;

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- STOCK BORRAR 3 ".$ActionTime.". ".$secc.".\n\t ID: ".$_POST['id'].".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$_POST['proname'];

	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = $text.$texfd."\n";
	$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Borrar_01(){

	global $db;
	global $rowout;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	
global $text;
$text = "- STOCK BORRAR 2 ".$ActionTime.". ".$secc.".\n\t ID: ".$_POST['id'].".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$_POST['proname'];

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
	
	function master_index(){
		
				require '../Inclu/Master_Index_Stocks.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>