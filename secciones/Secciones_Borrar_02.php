<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	global $db;
	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
													show_form();
													accion_Borrar_01();
													
							} elseif ($_POST['borrar']){
													ejecuta();
													accion_Borrar_02();
								
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

function ejecuta(){
	
	global $db;
	global $db_name;
	global $nombre;
	global $valor;
	
	/******** 	SI NO EXISTE CREA LA SECCION EN LA TABLA GLOBALFEEDSECCION
				Y SI NO HAY ERRORES EJECUTA LA FUNCION PROCESS_FORMR();		*********/

	$gfs =  "SELECT * FROM `$db_name`.`globalfeedseccion` WHERE `globalfeedseccion`.`valor` = '$_POST[valor]'";
	
	$qgfs = mysqli_query($db, $gfs);
	$rowgfs = mysqli_fetch_assoc($qgfs);

	if(mysqli_num_rows($qgfs) == 0){

	$gfs2 = "INSERT INTO `$db_name`.`globalfeedseccion` (`valor`, `nombre`) VALUES ('$_POST[valor]', '$_POST[nombre]')";
		
	if(mysqli_query($db, $gfs2)){
		
			global $tx1;
			$tx1 = "  * RESPALDO GLOBALFEEDSECCION ".$_POST['nombre']." / ".$_POST['valor']."\n";
			process_form();
			
				} else {
						global $tx1;
						$tx1 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
						print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
							}
			} else {	global $tx;
						$tx = "  * YA EXISTE LA SECCION.\n";
						print("* YA EXISTE LA SECCION.</br>");
						}
	
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
						Se han borrado estos datos del registro.
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

	/************** GRABA LOS DATOS DE STOCK EN GLOBALFEEDSTOCK *****************/

	$feedtable = "stock".$_POST['valor'];
	$feedtable = "`".$feedtable."`";

	$sqlgfst =  "SELECT * FROM `$db_name`.$feedtable ";
	$qgfst = mysqli_query($db, $sqlgfst);

	global $tx2;
	$tx2 = "  * RESPALDO GLOBALFEEDSTOCK ".$_POST['valor']."\n";

	while($rowfeed = mysqli_fetch_assoc($qgfst)){

	require '../Conections/conection.php';

	$dbf1 = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf1){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
			
	$sqlf1 = "INSERT INTO `$db_name`.`globalfeedstock` (`vseccion`, `nsemana`, `producto`, `proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`) VALUES ('$_POST[valor]','$rowfeed[nsemana]', '$rowfeed[producto]', '$rowfeed[proname]', '$rowfeed[psiva]', '$rowfeed[iva]', '$rowfeed[ivae]', '$rowfeed[pvp]', '$rowfeed[kgin]', '$rowfeed[datekgin]',  '$rowfeed[kgbad]', '$rowfeed[datekgbad]', '$rowfeed[kgcash]', '$rowfeed[pvptot]', '$rowfeed[datecash]', '$rowfeed[kgdifer]', '$rowfeed[coment]')";
	
	if(mysqli_query($dbf1, $sqlf1)){

global $tx2;
$tx2 = $tx2."     ".$rowfeed['producto'].". WEEK IN:".$rowfeed['nsemana'].". DATE IN:".$rowfeed['datekgin']."\n";
					} else { 
						global $tx2;
						$tx2 = "<font color='#FF0000'>* </font>".mysqli_error($dbf1)."\n";
						print ("<font color='#FF0000'>* </font></br> ".mysqli_error($dbf1).".</br>");
													}
								} /* FIN DEL WHILE */

	/************** GRABA LOS DATOS DE FEEDSTOCK EN GLOBALFEEDSTOCKF *****************/

	$feedtable3 = "feed".$_POST['valor'];
	$feedtable3 = "`".$feedtable3."`";

	$sqlgfst3 =  "SELECT * FROM `$db_name`.$feedtable3 ";
	$qgfst3 = mysqli_query($db, $sqlgfst3);

	global $tx3;
	$tx3 = "  * RESPALDO GLOBALFEEDSTOCKF ".$_POST['valor']."\n";

	while($rowfeed3 = mysqli_fetch_assoc($qgfst3)){

	require '../Conections/conection.php';

	$dbf3 = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf3){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
			
	$sqlf3 = "INSERT INTO `$db_name`.`globalfeedstockf` (`vseccion`, `nsemana`, `producto`, `proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`, `borrado`) VALUES ('$_POST[valor]','$rowfeed3[nsemana]', '$rowfeed3[producto]', '$rowfeed3[proname]', '$rowfeed3[psiva]', '$rowfeed3[iva]', '$rowfeed3[ivae]', '$rowfeed3[pvp]', '$rowfeed3[kgin]', '$rowfeed3[datekgin]',  '$rowfeed3[kgbad]', '$rowfeed3[datekgbad]', '$rowfeed3[kgcash]', '$rowfeed3[pvptot]', '$rowfeed3[datecash]', '$rowfeed3[kgdifer]', '$rowfeed3[coment]', '$rowfeed3[borrado]')";
	
	if(mysqli_query($dbf3, $sqlf3)){

global $tx3;
$tx3 = $tx3."     ".$rowfeed3['producto'].". WEEK IN:".$rowfeed3['nsemana'].". DATE IN:".$rowfeed3['datekgin']."\n";
				} else {
						global $tx3;
						$tx3 = "<font color='#FF0000'>* </font>".mysqli_error($dbf3)."\n";
						print ("<font color='#FF0000'>* </font></br> ".mysqli_error($dbf3).".</br>");
											}
								} /* FIN DEL WHILE */

	/************** GRABA LOS DATOS DE FEEDPRODUCTOS EN GLOBALFEEDPROF *****************/

	$feedtable2 = "feedpro".$_POST['valor'];
	$feedtable2 = "`".$feedtable2."`";

	$sqlgfp =  "SELECT * FROM `$db_name`.$feedtable2 ";
	$qgfp = mysqli_query($db, $sqlgfp);

	global $tx4;
	$tx4 = "  * RESPALDO GLOBALFEEDPROF ".$_POST['valor']."\n";

	while($rowgfp = mysqli_fetch_assoc($qgfp)){

	require '../Conections/conection.php';

	$dbf2 = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf2){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
			
	$sqlf2 = "INSERT INTO `$db_name`.`globalfeedprof` (`vseccion`, `valor`, `nombre`, `ref`, `coment`, `borrado`) VALUES ('$_POST[valor]','$rowgfp[valor]', '$rowgfp[nombre]', '$rowgfp[ref]', '$rowgfp[coment]', '$rowgfp[borrado]')";
	
	if(mysqli_query($dbf2, $sqlf2)){
		
		global $tx4;
		$tx4 = $tx4."     ".$rowgfp['nombre']." / ".$rowgfp['valor']."\n";
					} else {
						global $tx4;
						$tx4 = "<font color='#FF0000'>* </font>".mysqli_error($dbf2)."\n";
						print ("<font color='#FF0000'>* </font></br> ".mysqli_error($dbf2).".</br>");
									}
								} /* FIN DEL WHILE */

	/************** GRABA LOS DATOS DE PRODUCTOS EN GLOBALFEEDPRO *****************/

	$feedtable2b = "pro".$_POST['valor'];
	$feedtable2b = "`".$feedtable2b."`";

	$sqlgfp2 =  "SELECT * FROM `$db_name`.$feedtable2b ";
	$qgfp2 = mysqli_query($db, $sqlgfp2);

	global $tx5;
	$tx5 = "  * RESPALDO GLOBALFEEDPRO ".$_POST['valor']."\n";

	while($rowgfp2 = mysqli_fetch_assoc($qgfp2)){

	require '../Conections/conection.php';

	$dbf2b = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf2b){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
			
	$sqlf2b = "INSERT INTO `$db_name`.`globalfeedpro` (`vseccion`, `valor`, `nombre`, `ref`, `coment`) VALUES ('$_POST[valor]','$rowgfp2[valor]', '$rowgfp2[nombre]', '$rowgfp2[ref]', '$rowgfp2[coment]')";
	
	if(mysqli_query($dbf2b, $sqlf2b)){

		global $tx5;
		$tx5 = $tx5."     ".$rowgfp2['nombre']." / ".$rowgfp2['valor']."\n";
				}else {
						global $tx5;
						$tx5 = "<font color='#FF0000'>* </font>".mysqli_error($dbf2b)."\n";
						print ("<font color='#FF0000'>* </font></br> ".mysqli_error($dbf2b).".</br>");
										}
								} /* FIN DEL WHILE */

	/***********	BORRAMOS SECCION DE TABLA SECCIONES		***************/
	
	$nombre = $_POST['nombre'];
	$valor = $_POST['valor'];

	$sql2c = "DELETE FROM `$db_name`.`secciones` WHERE `secciones`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sql2c)){
			global $tx6;
	$tx6 = "  * BORRADO EN TABLA SECCIONES: ".$_POST['nombre']." / ".$_POST['valor']."\n";
				} else {
					global $tx6;
					$tx6 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
									}

	/*************	BORRAMOS TABLA STOCK SECCION X, Y EN NAMETABLES	***************/
	
	$name1 = "STOCK".$_POST['nombre'];
	$value1 = "stock".$_POST['valor'];

	$sqlt = "DROP TABLE `$db_name`.`$value1` ";

	if(mysqli_query($db, $sqlt)){
			global $tx7;
			$tx7 = "  * HA BORRADO LA TABLA ".$name1."\n";
				} else {
					global $tx7;
					$tx7 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}

	$fil1 = "%".$value1."%";
	$name1b = $_POST['nombre']." STOCK";
					
$sqlnt1 = "DELETE FROM `$db_name`.`nametables` WHERE `nametables`.`valortabla` LIKE '$fil1' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt1)){
			global $tx8;
			$tx8 = "  * SE HA BORRADO NAMETABLES ".$name1b."\n";
				} else {
					global $tx8;
					$tx8 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}

	/*************	BORRAMOS TABLA FEED SECCION X, Y EN NAMETABLES	***************/

	$name2 = "FEED".$_POST['nombre'];
	$value2 = "feed".$_POST['valor'];

	$sqlt2 = "DROP TABLE `$db_name`.`$value2` ";

	if(mysqli_query($db, $sqlt2)){
			global $tx9;
			$tx9 = "  * HA BORRADO LA TABLA ".$name2."\n";
				} else {
					global $tx9;
					$tx9 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}

	$fil2 = "%".$value2."%";
	$name2b = $_POST['nombre']." FEED";
					
$sqlnt2 = "DELETE FROM `$db_name`.`nametables` WHERE `nametables`.`valortabla` LIKE '$fil2' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt2)){
			global $tx10;
			$tx10 = "  * SE HA BORRADO NAMETABLES ".$name2b."\n";
				} else {
					global $tx10;
					$tx10 = "<font color='#FF0000'>* </font>;".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}

	/*************	BORRAMOS TABLA PRO SECCION X, Y EN NAMETABLES	***************/

	$name3 = "PRO".$_POST['nombre'];
	$value3 = "pro".$_POST['valor'];

	$sqlt3 = "DROP TABLE `$db_name`.`$value3` ";

	if(mysqli_query($db, $sqlt3)){
			global $tx11;
			$tx11 = "  * HA BORRADO LA TABLA ".$name3."\n";
				} else {
					global $tx11;
					$tx11 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}

	$fil3 = "%".$value3."%";
	$name3b = $_POST['nombre']." PRO";
					
$sqlnt3 = "DELETE FROM `$db_name`.`nametables` WHERE `nametables`.`valortabla` LIKE '$fil3' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt3)){
			global $tx12;
			$tx12 = "  * SE HA BORRADO NAMETABLES ".$name3b."\n";
				} else {
					global $tx12;
					$tx12 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}

	/*************	BORRAMOS TABLA FEEDPRO SECCION X, Y EN NAMETABLES	***************/

	$name4 = "FEEDPRO".$_POST['nombre'];
	$value4 = "feedpro".$_POST['valor'];

	$sqlt4 = "DROP TABLE `$db_name`.`$value4` ";

	if(mysqli_query($db, $sqlt4)){
			global $tx13;
			$tx13 = "  * HA BORRADO LA TABLA ".$name4."\n";
				} else {
					global $tx13;
					$tx13 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}

	$fil4 = "%".$value4."%";
	$name4b = $_POST['nombre']." FEED PRO";
					
$sqlnt4 = "DELETE FROM `$db_name`.`nametables` WHERE `nametables`.`valortabla` LIKE '$fil4' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt4)){
			global $tx14;
			$tx14 = "  * SE HA BORRADO NAMETABLES ".$name4b."\n";
				} else {
					global $tx14;
					$tx14 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>* </font></br> ".mysqli_error($db).".</br>");
										}
	/****************************/

	global $tx1;
	global $tx;
	$tx = $tx1.$tx2.$tx3.$tx4.$tx5.$tx6.$tx7.$tx8.$tx9.$tx10.$tx11.$tx12.$tx13.$tx14;
	
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
								   
	print("
			<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
					AL BORRAR UNA SECCIÓN SE BORRARÁN
					</br>
 					TODAS LAS TABLAS DEPENDIENTES EN LA BBDD.
					</td>
				</tr>
			</table>

			<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
							SE BORRARÁ ESTA SECCIÓN.
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
				</tr>
				<tr>
					<th colspan=2 class='BorderInf' style=\"text-align:right\">
							<a href='Secciones_Borrar_01.php' >
													CANCELAR
							</a>
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
						<input type='submit' value='BORRAR DATOS PERMANENETEMENTE' />
						<input type='hidden' name='borrar' value=1 />
					</td>
				</tr>
				
		</form>														
			
	</table>				
				");
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				}

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Borrar_02(){

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
	$text = "- SECCION BORRAR 3 ".$ActionTime.". ID: ".$_POST['id'].". ".$nombre.". ".$valor;

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

function accion_Borrar_01(){

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
	$text = "- SECCION BORRAR 2 ".$ActionTime.". ID: ".$_POST['id'].". ".$nombre.". ".$valor;

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