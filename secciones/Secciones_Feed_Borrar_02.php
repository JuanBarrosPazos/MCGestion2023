<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
													show_form();
													accion_recupera_01();
													
							} elseif ($_POST['borrar']){
													process_form();
													accion_recupera_02();
								
								} else {
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

function process_form(){
	
	global $db;
	global $db_name;
	global $nombre;
	global $valor;
	
	print("<table align='center'>
				<tr>
					<th colspan=2  class='BorderInf'>
						SE ELIMINADO RESPALDO DE SECCION.
					</th>
				</tr>
				
				<tr>
					<td width=120px>
						ID:
					</td>
					<td width=160px>"
						.$_POST['id'].
					"</td>
					
				</tr>
				
				<tr>
					<td>
						Valor:
					</td>
					<td>"
						.$_POST['valor'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nombre:
					</td>
					<td>"
						.$_POST['nombre'].
					"</td>
				</tr>

			</table>	
		");	

	/******** 	BORRAMOS LA SECCION EN LA TABLA GLOBALFEEDSECCIONES	*********/

	$valord1 = $_POST['valor'];
	$nombred1 = $_POST['nombre'];

	$sqld1 = "DELETE FROM `$db_name`.`globalfeedseccion` WHERE `globalfeedseccion`.`valor` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld1)){
	global $tx1;
	$tx1 = "  * BORRADO RESPALDO GLOBALFEEDSECCION ".$_POST['valor']." / ".$_POST['nombre']."\n";
				} else {
					
				global $tx1;
				$tx1 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
							}
					
	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDSTOCK	*********/

$sqlgfst3 =  "SELECT * FROM `$db_name`.`globalfeedstock` WHERE `globalfeedstock`.`vseccion` = '$_POST[valor]' ";
	$qgfst3 = mysqli_query($db, $sqlgfst3);

	global $tx2;
	$tx2 = "  * BORRADO RESPALDO GLOBALFEEDSTOCK ".$_POST['valor'].":\n";

	while($rowfeed3 = mysqli_fetch_assoc($qgfst3)){

	$sqld2 = "DELETE FROM `$db_name`.`globalfeedstock` WHERE `globalfeedstock`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld2)){

	global $tx2;
	$tx2 = $tx2."     ".$rowfeed3['producto']." IN WEEK:".$rowfeed3['nsemana'].". IN DATE:".$rowfeed3['datekgin']."\n";
				} else {
					
				global $tx2;
				$tx2 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
						}

				} /* FIN DEL WHILE */

	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDSTOCKF	*********/

	$sqlgfstf4 =  "SELECT * FROM `$db_name`.`globalfeedstockf` WHERE `globalfeedstockf`.`vseccion` = '$_POST[valor]' ";
	$qgfstf4 = mysqli_query($db, $sqlgfstf4);

	global $tx3;
	$tx3 = "  * BORRADO RESPALDO GLOBALFEEDSTOCKF ".$_POST['valor'].":\n";

	while($rowfeedf4 = mysqli_fetch_assoc($qgfstf4)){
				
	$sqld2f = "DELETE FROM `$db_name`.`globalfeedstockf` WHERE `globalfeedstockf`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld2f)){

	global $tx3;
	$tx3 = $tx3."     ".$rowfeedf4['producto']." IN WEEK:".$rowfeedf4['nsemana'].". IN DATE:".$$rowfeedf4['datekgin']."\n";
				} else {
					
				global $tx3;
				$tx3 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
						}
	
				} /* FIN DEL WHILE */

	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDPRO	*********/

	$sqlpro =  "SELECT * FROM `$db_name`.`globalfeedpro` WHERE `globalfeedpro`.`vseccion` = '$_POST[valor]' ";
	$qpro = mysqli_query($db, $sqlpro);

	global $tx4;
	$tx4 = "  * BORRADO RESPALDO GLOBALFEEDPRO ".$_POST['valor'].":\n";

	while($rowpro = mysqli_fetch_assoc($qpro)){

$sqld3 = "DELETE FROM `$db_name`.`globalfeedpro` WHERE `globalfeedpro`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld3)){
			global $tx4;
			$tx4 = $tx4."     ".$rowpro['nombre'].". ".$rowpro['valor'].". REF:".$rowpro['ref']."\n";
				} else {
					
				global $tx4;
				$tx4 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
								}

				} /* FIN DEL WHILE */

	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDPROF	*********/

	$sqlprof =  "SELECT * FROM `$db_name`.`globalfeedprof` WHERE `globalfeedprof`.`vseccion` = '$_POST[valor]' ";
	$qprof = mysqli_query($db, $sqlprof);

	global $tx5;
	$tx5 = "  * BORRADO RESPALDO GLOBALFEEDPROF ".$_POST['valor'].":\n";

	while($rowprof = mysqli_fetch_assoc($qprof)){

$sqld3 = "DELETE FROM `$db_name`.`globalfeedprof` WHERE `globalfeedprof`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld3)){
	
	global $tx5;
	$tx5 = $tx5."     ".$rowprof['nombre'].". ".$rowprof['valor'].". REF:".$rowprof['ref']."\n";
				} else {
					
				global $tx5;
				$tx5 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
								}

				} /* FIN DEL WHILE */

	/****************************/
	
	global $tx;
	$tx = $tx1.$tx2.$tx3.$tx4.$tx5;
	
			}	

//////////////////////////////////////////////////////////////////////////////////////////////
					
function show_form(){
		
	if($_POST['oculto2']){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
															);
								   						}
	if($_POST['borrar']){
		
				$defaults = array ( 'id' => $_POST['id'],
									'valor' => $_POST['valor'],
									'nombre' => $_POST['nombre'],
															);
								   						}
								   
	print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
							SE ELIMINARÁ RESPALDO DE SECCIÓN.
						</font>
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<tr>
					<td>	
						Id:
				</td>
				
				<td>
				".$defaults['id']."
				<input  type='hidden' name='id' value='".$defaults['id']."' />
			</td>
			
				</tr>
							
				<tr>
					<td>
						Valor:
					</td>
					
					<td>
				".$defaults['valor']."
				<input type='hidden' name='valor' value='".$defaults['valor']."' />
					</td>
				</tr>
				
				<tr>
					<td>	
						Nombre:
					</td>
					
					<td>
				".$defaults['nombre']."
				<input  type='hidden' name='nombre' value='".$defaults['nombre']."' />
					</td>
				</tr>
							
				<tr>
					<td colspan='2' align='right'>
						<input type='submit' value='BORRAR FEED SECCION' />
						<input type='hidden' name='borrar' value=1 />
					</td>
				</tr>
				
		</form>														
			
	</table>				

				"); 
	
	}	/* Fin show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_recupera_02(){

	global $db;
	global $rowout;
	global $nombre;
	global $valor;
	global $tx;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- SECCION FEED BORRAR 3 ".$ActionTime.". / ID: ".$_POST['id'].". ".$_POST['nombre'].". ".$_POST['valor'];

	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = $text."\n".$tx."\n";
	$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

								}

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_recupera_01(){

	global $db;
	global $rowout;
	global $nombre;
	global $valor;
	
	$nombre = $_POST['nombre'];
	$valor = $_POST['valor'];	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	global $text;
	$text = "- SECCION FEED BORRAR 2 ".$ActionTime.". / ID: ".$_POST['id'].". ".$nombre.". ".$valor;

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