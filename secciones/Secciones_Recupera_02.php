<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////

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
	
	print("<table align='center'>
				<tr>
					<th colspan=2  class='BorderInf'>
						SE HAN RECUPERADO LA SECCION.
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
		");	/* Final del print*/ 

	global $db;
	global $db_name;
	global $nombre;
	global $valor;
	
	/******** 	GRABAMOS LA SECCION EN LA TABLA SECCIONES	*********/

	$valor = $_POST['valor'];
	$nombre = $_POST['nombre'];

	$sql = "INSERT INTO `$db_name`.`secciones` (`valor`, `nombre`) VALUES ('$_POST[valor]', '$_POST[nombre]')";
		
	if(mysqli_query($db, $sql)){
			global $tx1;
			$tx1 = "  * HA CREADO LA SECCION ".$_POST['nombre']." / ".$_POST['valor']."\n";
				} else {
						global $tx1;
						$tx1 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
								}

	/******** 	BORRAMOS LA SECCION EN LA TABLA GLOBALFEEDSECCIONES	*********/

	$valord1 = $_POST['valor'];
	$nombred1 = $_POST['nombre'];

	$sqld1 = "DELETE FROM `$db_name`.`globalfeedseccion` WHERE `globalfeedseccion`.`valor` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld1)){
			global $tx2;
			$tx2 = "  * BORRADO GLOBALFEEDSECCION ".$_POST['nombre']." / ".$_POST['valor']."\n";
				} else {
					
				global $tx2;
				$tx2 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font></br> ".mysqli_error($db))."</br>";
								}

	/************** CREAMOS LA TABLA STOCK Y EN NAMETABLES ***************/
						
	$nombre1 = "STOCK".$_POST['nombre'];
	$valor1 = "stock".$_POST['valor'];

	$sql1 = "CREATE TABLE `$db_name`.`$valor1` (
  `id` int(4) NOT NULL auto_increment,
  `nsemana` int(2) NOT NULL,
  `producto` varchar(24) collate utf8_spanish2_ci,
  `proname` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `psiva` decimal(7,2) unsigned NOT NULL,
  `iva` int(2) NOT NULL,
  `ivae` decimal(7,2) unsigned NOT NULL,
  `pvp` decimal(7,2) unsigned NOT NULL,
  `kgin` decimal(7,2) unsigned NOT NULL,
  `datekgin` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `kgbad` decimal(7,2) unsigned NOT NULL,
  `datekgbad` varchar(20) collate utf8_spanish2_ci default NULL,
  `kgcash` decimal(7,2) unsigned NOT NULL,
  `pvptot` decimal(10,2) unsigned NOT NULL,
  `datecash` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `kgdifer` decimal(7,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $sql1)){
			global $tx3;
			$tx3 = "  * HA CREADO LA TABLA ".$valor1."\n";

				} else {
					
	global $tx3;
	$tx3 = "<font color='#FF0000'>* NO HA CREADO LA TABLA </font> ".mysqli_error($db)."\n";
	print("<font color='#FF0000'>* NO HA CREADO LA TABLA </font> ".mysqli_error($db))."</br>";
				
					}
					
	$nombre1b = $_POST['nombre']." STOCK";

	$sql1c = "INSERT INTO `$db_name`.`nametables` (`valortabla`, `nombreseccion`) VALUES ('$valor1', '$nombre1b')";
		
	if(mysqli_query($db, $sql1c)){
			global $tx4;
			$tx4 = "  * HA CREADO NAMETABLES ".$nombre1b."\n";
				} else {
				
				global $tx4;
				$tx4 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font></br> ".mysqli_error($db))."</br>";
					}
					
	/************* CREAMOS LA TABLA FEEDBACK DE STOCKS ****************/

	$name2 = "FEED".$_POST['nombre'];
	$value2 = "feed".$_POST['valor'];

	$sql2 = "CREATE TABLE `$db_name`.`$value2` (
  `id` int(4) NOT NULL auto_increment,
  `nsemana` int(2) NOT NULL,
  `producto` varchar(24) collate utf8_spanish2_ci,
  `proname` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `psiva` decimal(7,2) unsigned NOT NULL,
  `iva` int(2) NOT NULL,
  `ivae` decimal(7,2) unsigned NOT NULL,
  `pvp` decimal(7,2) unsigned NOT NULL,
  `kgin` decimal(7,2) unsigned NOT NULL,
  `datekgin` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `kgbad` decimal(7,2) unsigned NOT NULL,
  `datekgbad` varchar(20) collate utf8_spanish2_ci default NULL,
  `kgcash` decimal(7,2) unsigned NOT NULL,
  `pvptot` decimal(10,2) unsigned NOT NULL,
  `datecash` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `kgdifer` decimal(7,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `borrado` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $sql2)){
			global $tx5;
			$tx5 = "  * HA CREADO LA TABLA ".$value2."\n";
			
				} else {
					
global $tx5;
$tx5 = "<font color='#FF0000'>* NO SE HA CREADO LA TABLA: </font> ".mysqli_error($db)."\n";
print("<font color='#FF0000'>* NO SE HA CREADO LA TABLA: </font> ".mysqli_error($db))."</br>";
					}

	$name2b = $_POST['nombre']." FEED";

	$sql2c = "INSERT INTO `$db_name`.`nametables` (`valortabla`, `nombreseccion`) VALUES ('$value2', '$name2b')";
		
	if(mysqli_query($db, $sql2c)){
			global $tx6;
			$tx6 = "  * HA CREADO NAMETABLES ".$name2b."\n";
				} else {
					
				global $tx6;
				$tx6 = "<font color='#FF0000'>* </font></br> ".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font></br> ".mysqli_error($db))."</br>";
					}
					
	/************* CREAMOS LA TABLA DE VALORES Y VARIABLES DE PRODUCTOS ****************/

	$name3 = "PRO".$_POST['nombre'];
	$value3 = "pro".$_POST['valor'];
	$prod3 = $_POST['nombre'];


	$sql3 = "CREATE TABLE `$db_name`.`$value3` (
  `id` int(4) NOT NULL auto_increment,
  `valor` varchar(14) collate utf8_spanish2_ci,
  `nombre` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `ref` varchar(14) collate utf8_spanish2_ci NOT NULL DEFAULT 'NO CODE',
  `psiva` decimal(7,2) unsigned NOT NULL,
  `iva` int(2) NOT NULL,
  `ivae` decimal(7,2) unsigned NOT NULL,
  `pvp` decimal(7,2) unsigned NOT NULL,
  `stock` decimal(7,2) unsigned NOT NULL,
  `coment`  text collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $sql3)){
			global $tx7;
			$tx7 = "  * HA CREADO LA TABLA ".$value3."\n";
			
				} else {
					
	global $tx7;
	$tx7 = "<font color='#FF0000'>* NO SE HA CREADO LA TABLA </font>".mysqli_error($db)."\n";
	print("<font color='#FF0000'>* NO SE HA CREADO LA TABLA </font>".mysqli_error($db))."</br>";
				
					}

	$name3b = $_POST['nombre']." PRO";

	$sql3b = "INSERT INTO `$db_name`.`nametables` (`valortabla`, `nombreseccion`) VALUES ('$value3', '$name3b')";
		
	if(mysqli_query($db, $sql3b)){
			global $tx8;
			$tx8 = "  * HA CREADO NAMETABLES ".$name3b."\n";
				} else {
					
				global $tx8;
				$tx8 = "<font color='#FF0000'>* </font> ".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font> ".mysqli_error($db))."</br>";
					}

	/************* CREAMOS LA TABLA DE PRODUCCTOS FEEDBACK ****************/

	$name4 = "FEEDPRO".$_POST['nombre'];
	$value4 = "feedpro".$_POST['valor'];
	$prod4 = $_POST['nombre'];


	$sql4 = "CREATE TABLE `$db_name`.`$value4` (
  `id` int(4) NOT NULL auto_increment,
  `valor` varchar(14) collate utf8_spanish2_ci,
  `nombre` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `ref` varchar(14) collate utf8_spanish2_ci NOT NULL DEFAULT 'NO CODE',
  `psiva` decimal(7,2) unsigned NOT NULL,
  `iva` int(2) NOT NULL,
  `ivae` decimal(7,2) unsigned NOT NULL,
  `pvp` decimal(7,2) unsigned NOT NULL,
  `stock` decimal(7,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci,
  `borrado` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $sql4)){
			global $tx9;
			$tx9 = "  * HA CREADO LA TABLA ".$value4."\n";
			
				} else {
					
	global $tx9;
	$tx9 = "<font color='#FF0000'>* NO SE HA CREADO LA TABLA </font>".mysqli_error($db)."\n";
	print("<font color='#FF0000'>* NO SE HA CREADO LA TABLA </font>".mysqli_error($db))."</br>";
					}
					
$name4b = $_POST['nombre']."FEED PRO";

	$sql3b = "INSERT INTO `$db_name`.`nametables` (`valortabla`, `nombreseccion`) VALUES ('$value4', '$name4b')";
		
	if(mysqli_query($db, $sql3b)){
			global $tx10;
			$tx10 = "  * HA CREADO NAMETABLES ".$name4b."\n";
				} else {
					
				global $tx10;
				$tx10 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($db))."</br>";
					}
					
	/************** GRABA LOS DATOS DE GLOBALFEEDSTOCK  EN STOCK *****************/

	$feedtable = "stock".$_POST['valor'];
	$feedtable = "`".$feedtable."`";

	$sqlgfst =  "SELECT * FROM `$db_name`.`globalfeedstock` WHERE `vseccion` = '$_POST[valor]'";
	$qgfst = mysqli_query($db, $sqlgfst);

	global $tx11;
	$tx11 = "  * RECUPERADO STOCK ".$_POST['valor'].":\n";

	while($rowfeed = mysqli_fetch_assoc($qgfst)){

	require '../Conections/conection.php';

	$dbf1 = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf1){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
			
$sqlf1 = "INSERT INTO `$db_name`.$feedtable ( `nsemana`, `producto`, `proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`) VALUES ('$rowfeed[nsemana]', '$rowfeed[producto]', '$rowfeed[proname]', '$rowfeed[psiva]', '$rowfeed[iva]', '$rowfeed[ivae]', '$rowfeed[pvp]', '$rowfeed[kgin]', '$rowfeed[datekgin]',  '$rowfeed[kgbad]', '$rowfeed[datekgbad]', '$rowfeed[kgcash]', '$rowfeed[pvptot]', '$rowfeed[datecash]', '$rowfeed[kgdifer]', '$rowfeed[coment]')";
	
	if(mysqli_query($dbf1, $sqlf1)){
	
global $tx11;
$tx11 = $tx11."     ".$rowfeed['producto']." WEEK IN:".$rowfeed['nsemana'].". DATE IN:".$rowfeed['datekgin']."\n";
						} 
						else {
				global $tx11;
				$tx11 = "<font color='#FF0000'>* </font>".mysqli_error($dbf1)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($dbf1))."</br>";
					}
								} /* FIN DEL WHILE */

	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDSTOCK	*********/

	$sqla =  "SELECT * FROM `$db_name`.`globalfeedstock` WHERE `globalfeedstock`.`vseccion` = '$_POST[valor]' ";
	$qa = mysqli_query($db, $sqla);

	global $tx12;
	$tx12 = "  * BORRADO GLOBALFEEDSTOCK ".$_POST['valor'].":\n";

	while($rowa = mysqli_fetch_assoc($qa)){

global $tx12;
$tx12 = $tx12."     ".$rowa['producto']." IN WEEK:".$rowa['nsemana'].". IN DATE:".$rowa['datekgin']."\n";
				
				} /* FIN DEL WHILE */

	$sqld2 = "DELETE FROM `$db_name`.`globalfeedstock` WHERE `globalfeedstock`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld2)){
			global $tx12;
			$tx12 = $tx12;
				} else {
					
				global $tx12;
				$tx12 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($db)).".</br>";
								}

	/************** GRABA LOS DATOS DE GLOBALFEEDSTOCKF  EN FEEDSTOCK *****************/

	$feedtablef = "feed".$_POST['valor'];
	$feedtablef = "`".$feedtablef."`";

	$sqlgfstf =  "SELECT * FROM `$db_name`.`globalfeedstockf` WHERE `vseccion` = '$_POST[valor]'";
	$qgfstf = mysqli_query($db, $sqlgfstf);

	global $tx13;
	$tx13 = "  * RECUPERADO FEED STOCK ".$_POST['valor'].":\n";

	while($rowfeedf = mysqli_fetch_assoc($qgfstf)){

	require '../Conections/conection.php';

	$dbf1f = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf1f){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
			
$sqlf1f = "INSERT INTO `$db_name`.$feedtablef ( `nsemana`, `producto`, `proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`, `borrado`) VALUES ('$rowfeedf[nsemana]', '$rowfeedf[producto]', '$rowfeedf[proname]', '$rowfeedf[psiva]', '$rowfeedf[iva]', '$rowfeedf[ivae]', '$rowfeedf[pvp]', '$rowfeedf[kgin]', '$rowfeedf[datekgin]',  '$rowfeedf[kgbad]', '$rowfeedf[datekgbad]', '$rowfeedf[kgcash]', '$rowfeedf[pvptot]', '$rowfeedf[datecash]', '$rowfeedf[kgdifer]', '$rowfeedf[coment]', '$rowfeedf[borrado]')";
	
	if(mysqli_query($dbf1f, $sqlf1f)){

global $tx13;
$tx13 = $tx13."     ".$rowfeedf['producto']." WEEK IN:".$rowfeedf['nsemana'].". DATE IN:".$rowfeedf['datekgin']."\n";
						} 
						else {
				global $tx13;
				$tx13 = "<font color='#FF0000'>* </font>".mysqli_error($dbf1f)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($dbf1f))."</br>";
						}
								} /* FIN DEL WHILE */

	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDSTOCKF	*********/

	$sqlb =  "SELECT * FROM `$db_name`.`globalfeedstockf` WHERE `globalfeedstockf`.`vseccion` = '$_POST[valor]' ";
	$qb = mysqli_query($db, $sqlb);

	global $tx14;
	$tx14 = "  * BORRADO GLOBALFEEDSTOCKF ".$_POST['valor'].":\n";

	while($rowb = mysqli_fetch_assoc($qb)){

				
global $tx14;
$tx14 = $tx14."     ".$rowb['producto']." IN WEEK:".$rowb['nsemana'].". IN DATE:".$rowb['datekgin']."\n";
				} /* FIN DEL WHILE */
				
	$sqld2f = "DELETE FROM `$db_name`.`globalfeedstockf` WHERE `globalfeedstockf`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld2f)){
			global $tx14;
			$tx14 = $tx14;
				} else {
					
				global $tx14;
				$tx14 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($db)).".</br>";
								}

	/************** GRABA LOS DATOS DE GLOBALFEEDPROF EN FEEDPRODUCTOS *****************/

	$feedtable2 = "feedpro".$_POST['valor'];
	$feedtable2 = "`".$feedtable2."`";

	$sqlgfp =  "SELECT * FROM `$db_name`.`globalfeedprof` WHERE `vseccion` = '$_POST[valor]'";
	$qgfp = mysqli_query($db, $sqlgfp);

	global $tx15;
	$tx15 = "  * RECUPERADO FEED PRO ".$_POST['valor'].":\n";

	while($rowgfp = mysqli_fetch_assoc($qgfp)){

	require '../Conections/conection.php';

	$dbf2 = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf2){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
			
	$sqlf2 = "INSERT INTO `$db_name`.$feedtable2 ( `valor`, `nombre`, `ref`, `coment`, `borrado`) VALUES ( '$rowgfp[valor]', '$rowgfp[nombre]', '$rowgfp[ref]', '$rowgfp[coment]', '$rowgfp[borrado]')";
	
	if(mysqli_query($dbf2, $sqlf2)){
	
		global $tx15;
		$tx15 = $tx15."     ".$rowgfp['nombre']." / ".$rowgfp['valor']."\n";

						} 
						else {
				global $tx15;
				$tx15 = "<font color='#FF0000'>* </font>".mysqli_error($dbf2)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($dbf2))."</br>";
					}
								} /* FIN DEL WHILE */
	
	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDPROF	*********/

	$sqlc =  "SELECT * FROM `$db_name`.`globalfeedprof` WHERE `globalfeedprof`.`vseccion` = '$_POST[valor]' ";
	$qc = mysqli_query($db, $sqlc);

	global $tx16;
	$tx16 = "  * BORRADO GLOBALFEEDPROF ".$_POST['valor'].":\n";

	while($rowc = mysqli_fetch_assoc($qc)){

	global $tx16;
	$tx16 = $tx16."     ".$rowc['nombre']." / ".$rowc['valor']."\n";
				
				} /* FIN DEL WHILE */
				
	$sqld3 = "DELETE FROM `$db_name`.`globalfeedprof` WHERE `globalfeedprof`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld3)){
			global $tx16;
			$tx16 = $tx16;
				} else {
					
				global $tx16;
				$tx16 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($db)).".</br>";
								}

	/************** GRABA LOS DATOS DE GLOBALFEEDPRO EN PRODUCTOS *****************/

	$feedtable3 = "pro".$_POST['valor'];
	$feedtable3 = "`".$feedtable3."`";

	$sqlgfp3 =  "SELECT * FROM `$db_name`.`globalfeedpro` WHERE `vseccion` = '$_POST[valor]'";
	$qgfp3 = mysqli_query($db, $sqlgfp3);

	global $tx17;
	$tx17 = "  * RECUPERADO PRO ".$_POST['valor'].":\n";

	while($rowgfp3 = mysqli_fetch_assoc($qgfp3)){

	require '../Conections/conection.php';

	$dbf3 = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf3){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
	$sqlf3 = "INSERT INTO `$db_name`.$feedtable3 ( `valor`, `nombre`, `ref`, `coment`) VALUES ( '$rowgfp3[valor]', '$rowgfp3[nombre]', '$rowgfp3[ref]', '$rowgfp3[coment]')";
	
	if(mysqli_query($dbf3, $sqlf3)){

		global $tx17;
		$tx17 = $tx17."     ".$rowgfp3['nombre']." / ".$rowgfp3['valor']."\n";
						} 
						else {
				global $tx17;
				$tx17 = "<font color='#FF0000'>* </font>".mysqli_error($dbf3)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($dbf3))."</br>";
					}
								} /* FIN DEL WHILE */

	/******** 	BORRAMOS LOS DATOS DE GLOBALFEEDPRO	*********/

	$sqld =  "SELECT * FROM `$db_name`.`globalfeedpro` WHERE `globalfeedpro`.`vseccion` = '$_POST[valor]' ";
	$qd = mysqli_query($db, $sqld);

	global $tx18;
	$tx18 = "  * BORRADO GLOBALFEEDPRO ".$_POST['valor'].":\n";

	while($rowd = mysqli_fetch_assoc($qd)){

	global $tx18;
	$tx18 = $tx18."     ".$rowd['nombre']." / ".$rowd['valor']."\n";
				
				} /* FIN DEL WHILE */
				
$sqld3 = "DELETE FROM `$db_name`.`globalfeedpro` WHERE `globalfeedpro`.`vseccion` = '$_POST[valor]' ";
		
	if(mysqli_query($db, $sqld3)){
			global $tx18;
			$tx18 = $tx18;
				} else {
					
				global $tx18;
				$tx18 = "<font color='#FF0000'>* </font>".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* </font>".mysqli_error($db)).".</br>";
								}

	/****************************/
	
	global $tx;
	$tx = $tx1.$tx2.$tx3.$tx4.$tx5.$tx6.$tx7.$tx8.$tx9.$tx10.$tx11.$tx12.$tx13.$tx14.$tx15.$tx16.$tx17.$tx18;

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
							SE RECUPERARÁ ESTA SECCIÓN.
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
						<input type='submit' value='RECUPERAR SECCION' />
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

function accion_recupera_02(){

	global $db;
	global $rowout;
	global $tx;
	global $nombre;
	global $valor;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	global $text;
	$text = "- SECCION RECUPERA 3 ".$ActionTime.". ".$nombre.". ".$valor;

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
	$text = "- SECCION RECUPERA 2 ".$ActionTime.". ".$nombre.". ".$valor;

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