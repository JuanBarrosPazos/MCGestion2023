<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $gst_admin WHERE `id` = '$_POST[id]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
								show_form();
								accion_Borrar_01();																				
								}
							elseif($_POST['oculto']){
								
												process_form();
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
	
	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	
	global $_sec;
	$_sec = $rowseccion['nombre'];
				
	$producto = "feedpro".$_POST['seccion'];

	/*	************** */
	
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
						SE HAN BORRADO ESTOS DATOS.
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
						UNIT IN
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
						PVP €
					</td>
					<td>"
						.$_POST['pvp'].
					"</td>
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
						UNIT BAD
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
						CASH
					</td>
					<td>"
						.$_POST['kgcash'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TOT CASH €
					</td>
					<td>"
						.$_POST['pvptot'].
					"</td>
				</tr>				
				
				<tr>
					<td>						
						DATE CASH
					</td>
					<td>"
						.$_POST['datecash'].
					"</td>
				</tr>
				
				<tr>
					<td>
						COMENTARIOS.
					</td>
					<td>"
						.$_POST['coment'].
					"</td>
				</tr>
			</table>";	

		
	$id = $_POST['id'];
	
	require "../config/TablesNames.php";

	$sqlc = "DELETE FROM `$db_name`.$feedtable WHERE $feedtable.`id` = '$_POST[id]' LIMIT 1  ";

	if(mysqli_query($db, $sqlc)){	global $texd;
									$texd = "\n\t SE HA BORRADO FEEDSTOCK ".$_sec.".";
									print( $tabla );
				} else {
				print("<font color='#FF0000'>
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

					

function show_form($errors=[]){

	global $id;
	$id = $_POST['id'];

	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	
	global $_sec;
	$_sec = $rowseccion['nombre'];
	
	$producto = "feedpro".$_POST['seccion'];

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
	
	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

						BORRAR FEEDBACK STOCKS ".$_sec."
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
			
			<input name='id' type='hidden' value='".$id['id']."' />					

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
						PRO REF
					</td>
					<td>

<input name='producto' type='hidden' value='".$_POST['producto']."' />".$_POST['producto']."

					</td>
				</tr>
				
				<tr>
					<td>
						PRO NAME
					</td>
					<td>

<input name='proname' type='hidden' value='".$_POST['proname']."' />".$_POST['proname']."

					</td>
				</tr>
				
				<tr>
					<td>
						PSIVA €
					</td>
					<td>

<input name='psiva' type='hidden' value='".$_POST['psiva']."' />".$_POST['psiva']."

					</td>
				</tr>
				
				<tr>
					<td>
						TIPO IVA
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
						PVP €
					</td>
					<td>

<input name='pvp' type='hidden' value='".$_POST['pvp']."' />".$_POST['pvp']."

					</td>
				</tr>
				
				<tr>
					<td>						
						UNIT IN
					</td>
					<td>

<input name='kgin' type='hidden' value='".$_POST['kgin']."' />".$_POST['kgin']."

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
						UNIT BAD
					</td>
					
					<td>

<input name='kgbad' type='hidden' value='".$_POST['kgbad']."' />".$_POST['kgbad']."

					</td>
				</tr>

					<td>
						DATE BAD
					</td>
					
					<td>

<input name='datekgbad' type='hidden' value='".$_POST['datekgbad']."' />".$_POST['datekgbad']."

					</td>
				</tr>

				<tr>
					<td>						
						CASH
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
			<input type='submit' value='BORRAR DATOS DEFINITIVAMENTE' />
			<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				

				");

			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Borrar_02(){

	global $db;
	global $rowout;
	global $feedtable;

	global $texd;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ $dir = 'Admin';}
	
global $text;
$text = "- STOCK FEEDBACK BORRAR 3 ".$ActionTime.". ".$feedtable.".\n\t ID: ".$_POST['id'].".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$_POST['proname'];

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text.$texd."\n";
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
	global $feedtable;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ $dir = 'Admin';}
	
global $text;
$text = "- STOCK FEEDBACK BORRAR 2 ".$ActionTime.". ".$feedtable.".\n\t ID: ".$_POST['id'].".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$_POST['proname'];

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