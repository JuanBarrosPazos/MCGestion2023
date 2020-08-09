<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

	$sqld =  "SELECT * FROM `admin` WHERE `ID` = '$_POST[ID]'";
 	
	$qd = mysqli_query($db, $sqld);
	
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
								show_form();
								accion_modifica_01();
								}
							elseif($_POST['oculto']){
								
												process_form();
												accion_modifica_02();
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

	$errors = array();
	
	if($_POST['producto'] == '0'){
		$errors [] = "PRODUCTO: <font color='#FF0000'>NO HA SELECCIONADO NINGÚN PRODUCTO.</font>";
		}
	
	if($_POST['kgin'] == '00'){
		$errors [] = "KG ENTRADA: <font color='#FF0000'>NO HAY KG</font>";
		}
					
	if($_POST['kgin'] < $_POST['kgbad']){
	$errors [] = "KG PERECEDEROS: <font color='#FF0000'>MAS	PERECEDEROS QUE DE ENTRADA</font>";
		}
					
	if($_POST['kgcash'] > $_POST['kgin']){
		$errors [] = "KG CAJA: <font color='#FF0000'>MAS DE CAJA QUE DE ENTRADA</font>";
		}
		
	$vkgin = $_POST['kgin'];
	$vkgbad = $_POST['kgbad'];
	$vkgcash = $_POST['kgcash'];
	$vdif = $vkgin - $vkgbad;
	$vtot = $vdif - $vkgcash;
	/* if (($vdif - $vkcash) < 0){ $vtot = '- ' .$vtot;} */
	
	if($_POST['kgcash'] > $vdif){
		$errors [] = 
					"KG CAJA:
							</br> 
							<font color='#FF0000'>
					MAS DE CAJA QUE LA DIFERENCIA ENTRE ENTRADA Y PERECEDEROS ".$vdif." Kg. 
							</br> 
					DIFENECIA TOTAL NEGATIVA ".$vtot." Kg.
							</font>";
										}
			
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;

	global $secc;	
	$secc = "stock".$_POST['seccion'];
	$secc = "`".$secc."`";
	
	global $db;
	global $_sec;

	$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];
	$producto = "feedpro".$_POST['seccion'];
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
						DATOS RECUPERADOS.
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
						.$date.
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
				
			</table>	
		";	 

	
	global $db_name;

	$sqlc = "INSERT INTO `$db_name`.$secc (`nsemana`,`producto`, `proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`) VALUES ( '$_POST[nsemana]', '$_POST[producto]', '$_POST[proname]', '$_POST[psiva]', '$_POST[iva]', '$_POST[ivae]', '$_POST[pvp]', '$_POST[kgin]', '$_POST[datekgin]',  '$_POST[kgbad]', '$_POST[datekgbad]', '$_POST[kgcash]', '$_POST[pvptot]', '$_POST[datecash]', '$diferencia', '$_POST[coment]')";

	if(mysqli_query($db, $sqlc)){
									print("");
			print( $tabla );
				} else {
				print("<font color='#FF0000'>
						* ERROR: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						
							}

	global $secc2;	
	$secc2 = "feed".$_POST['seccion'];
	$secc2 = "`".$secc2."`";

					global $db;
					global $_sec;
				
					$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
					$q = mysqli_query($db, $sqlx);
					$rowseccion = mysqli_fetch_assoc($q);
					$_sec = $rowseccion['nombre'];
					$producto = "feedpro".$_POST['seccion'];

	$sqlx = "DELETE FROM `$db_name`.$secc2 WHERE $secc2.`id` = '$_POST[id]' LIMIT 1  ";

	if(mysqli_query($db, $sqlx)){
									global $texf;
									$texf = "\n\t DATOS RECUPERADOS EN ".$secc.".";
									$texf = $texf."\n\t SE HA BORRADO EL RESPALDO ".$secc2.".";
				} else {
				print("<font color='#FF0000'>
						SE HA PRODUCIDO UN ERROR: </font>
						</br>
						&nbsp;&nbsp;$nbsp;".mysqli_error($db))."
						</br>";
							}
		
			}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
		

					global $db;
					global $_sec;
				
					$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
					$q = mysqli_query($db, $sqlx);
					$rowseccion = mysqli_fetch_assoc($q);
					$_sec = $rowseccion['nombre'];
					$producto = "pro".$_POST['seccion'];

	
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							RECUPERAR DATOS ".$_sec."
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						

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
				
				<tr height=40px>
					<td colspan='2'  align='right'>
						<input type='submit' value='RECUPERAR DATOS' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
					
				</tr>
				
		</form>	
		
		</table>													

				"); 

					}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_modifica_02(){

	global $db;
	global $rowout;
	global $secc;
	global $texf;
	
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	
global $text;
$text = "- STOCK FEEDBACK RECUPERAR 3 ".$ActionTime.". ".$secc.".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$_POST['proname'];

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text.$texf."\n";
		$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_modifica_01(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	
global $text;
$text = "- STOCK FEEDBACK RECUPERAR 2 ".$ActionTime.". ".$secc.".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$_POST['proname'];

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
	
	function master_index(){
		
		
				require '../Inclu/Master_Index_Stocks.php';
		
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
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