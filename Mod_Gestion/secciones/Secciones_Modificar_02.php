<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require "../config/TablesNames.php";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
	master_index();
		if (isset($_POST['oculto2'])){ 	show_form();
										accion_Modificar_01();
			} elseif($_POST['modifica']){
					if($margarita = validate_form()){ show_form($margarita);
						} else { process_form();
								 accion_Modificar_02();
												}
					} else { show_form(); }
	} else { require "../Inclu/AccesoDenegado.php"; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();

	require "../config/TablesNames.php";
	@$sqlb =  "SELECT * FROM $secciones WHERE (`valor` <> '' AND `id` <> '$_POST[id]') AND (`valor` = '$_POST[valor]' OR `nombre` = '$_POST[nombre]')  ";
	$qb = mysqli_query($db, $sqlb);
	//print ("** ".mysqli_num_rows($qb)."<br>");
	//print ("** ".$_POST['id']."<br>");
	//$rowb = mysqli_fetch_assoc($qb);
	if( mysqli_num_rows($qb) > 0){ 
		$errors [] = "<font color='#FF0000'>ESTA SECCION YA EXISTE</font>";
	 } else { }

	 /*
	@$sqlc =  "SELECT * FROM $secciones WHERE `id` = '$_POST[id]' AND (`valor` = '$_POST[valor]' OR`nombre` = '$_POST[nombre]')  ";
	$qc = mysqli_query($db, $sqlc);
	if( mysqli_num_rows($qc) > 0){ 
		$errors [] = "<font color='#FF0000'>NO HA MODIFICADO NINGUN CAMPO</font>";
	 } else { }
	*/

	if(strlen(trim($_POST['valor2'])) == 0){
		$errors [] = "Valor Nuevo: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['valor2'])) < 4){
		$errors [] = "Valor Nuevo: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['valor2'])){
		$errors [] = "Valor Nuevo: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[a-z]+$/',$_POST['valor2'])){
	$errors [] = "Valor Nuevo: <font color='#FF0000'>Solo minusculas sin espacios ni acentos</font>";
		}

	
	if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "Nombre: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 5){
		$errors [] = "Nombre: <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[A-Z\s]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo mayusculas sin acentos.</font>";
		}

		return $errors;

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	
	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2  class='BorderInf'>NUEVOS DATOS DE LA SECCION.</th>
				</tr>
				<tr>
					<td width=200px>ID:</td>
					<td width=200px>".$_POST['id']."</td>
				</tr>
				<tr>
					<td>Valor:</td>
					<td>".$_POST['valor2']."</td>
				</tr>				
				<tr>
					<td>Nombre:</td>
					<td>".$_POST['nombre']."</td>
				</tr>				
			</table>";	 

	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE SE MODIFICA	****************/
	/***********************************************************************/

	if(trim($_POST['valor1'] != $_POST['valor2'])){
		/*
		print("Valor 1 ".$_POST['valor1']." y Valor Nuevo ".$_POST['valor2']." 
		<font color='#FF0000'>NO SON IGUALES</font>");
		*/
		
	global $nombre;
	$nombre = $_POST['nombre'];
	global $valor;
	$valor = $_POST['valor2'];
	
	/*************	MODIFICA VARIABLE DE SECCION Y NOMBRE	*****************/
	
	require "../config/TablesNames.php";

	$sqlc = "UPDATE `$db_name`.$secciones SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE $secciones.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			global $tx1;
			$tx1 = "  * HA MODIFICADO. ".$_POST['valor1']." POR ".$valor." / ".$nombre. "\n";
			print( $tabla );
				} else {
						global $tx1;
						$tx1 = "* L.130:".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* L.130:</font>".mysqli_error($db))."</br>";
						show_form ();
					}
					
	/*************	MODIFICA NOMBRE DE LA TABLA STOCK Y NAMETABLES	****************/

	$tableoldstock = "`".$_SESSION['clave']."stock".$_POST['valor1']."`";
	$tablenewstock = "`".$_SESSION['clave']."stock".$_POST['valor2']."`";

	$sqlalt1 = "ALTER TABLE `$db_name`.$tableoldstock RENAME `$db_name`.$tablenewstock; ";

	if(mysqli_query($db, $sqlalt1)){
	global $tx2;
	$tx2 = "  * HA MODIFICADO NOMBRE DE TABLA ".$tableoldstock. " POR ".$tablenewstock."\n";
				} else {
	global $tx2;
	$tx2 = "* L.148: ".mysqli_error($db)."\n";
	print("<font color='#FF0000'>* L.148: </font>".mysqli_error($db))."</br>";
							}

	$filx1 = "%".$_SESSION['clave']."stock".$_POST['valor1']."%";
	$nametablestock = $_POST['nombre']." STOCK";
				
	require "../config/TablesNames.php";

	$sqlntx1 = "UPDATE `$db_name`.$nametables SET `valortabla` = '$tablenewstock', `nombreseccion` = '$nametablestock' WHERE $nametables.`valortabla` LIKE '$filx1' LIMIT 1 ";

	if(mysqli_query($db, $sqlntx1)){
			global $tx3;
			$tx3 = "  * HA MODIFICADO NAMETABLES: ".$nametablestock." & ".$tablenewstock."\n";
				} else {
				global $tx3;
				$tx3 = "* L.164: ".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* L.164: </font>".mysqli_error($db))."</br>";
							}
							
	/**************	MODIFICA NOMBRE DE LA TABLA PRODUCTOS Y NAMETABLES	***************/

	$tableoldpro = "`".$_SESSION['clave']."pro".$_POST['valor1']."`";
	$tablenewpro = "`".$_SESSION['clave']."pro".$_POST['valor2']."`";

	$sqlalt2 = "ALTER TABLE `$db_name`.$tableoldpro RENAME `$db_name`.$tablenewpro ";

	if(mysqli_query($db, $sqlalt2)){
		
	global $tx4;
	$tx4 = "  * HA MODIFICADO NOMBRE DE TABLA ".$tableoldpro. " POR ".$tablenewpro."\n";
				} else {
	global $tx4;
	$tx4 = "* L.180: ".mysqli_error($db)."\n";					
	print("<font color='#FF0000'>* L.180: </font>".mysqli_error($db))."</br>";
							}

	$filx2 = "%".$_SESSION['clave']."pro".$_POST['valor1']."%";
	$nametablepro = $_POST['nombre']." PRO";
				
	require "../config/TablesNames.php";

	$sqlntx2 = "UPDATE `$db_name`.$nametables SET `valortabla` = '$tablenewpro', `nombreseccion` = '$nametablepro' WHERE $nametables.`valortabla` LIKE '$filx2' LIMIT 1 ";

	if(mysqli_query($db, $sqlntx2)){
			global $tx5;
			$tx5 = "  * HA MODIFICADO NAMETABLES: ".$nametablepro." & ".$tablenewpro."\n";
				} else {
				global $tx5;
				$tx5 = "* L.197: ".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* L.197: </font>".mysqli_error($db))."</br>";
							}
					
	/************	MODIFICA NOMBRE DE LA TABLA FEED Y NAMETABLES	*****************/

	$tableoldfeed = "`".$_SESSION['clave']."feed".$_POST['valor1']."`";
	$tablenewfeed = "`".$_SESSION['clave']."feed".$_POST['valor2']."`";

	$sqlalt3 = "ALTER TABLE `$db_name`.$tableoldfeed RENAME `$db_name`.$tablenewfeed ";

	if(mysqli_query($db, $sqlalt3)){
	global $tx6;
	$tx6 = "  * HA MODIFICADO NOMBRE DE TABLA ".$tableoldfeed. " POR ".$tablenewfeed."\n";
				} else {
						global $tx6;
						$tx6 = "* L.213: ".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* L.213: </font>".mysqli_error($db))."</br>";
							}

	$filx3 = "%".$_SESSION['clave']."feed".$_POST['valor1']."%";
	$nametablefeed = $_POST['nombre']." FEED";
				
	require "../config/TablesNames.php";

	$sqlntx3 = "UPDATE `$db_name`.$nametables SET `valortabla` = '$tablenewfeed', `nombreseccion` = '$nametablefeed' WHERE $nametables.`valortabla` LIKE '$filx3' LIMIT 1 ";

	if(mysqli_query($db, $sqlntx3)){
			global $tx7;
			$tx7 = "  * HA MODIFICADO NAMETABLES: ".$nametablefeed." & ".$tablenewfeed."\n";
				} else {
				global $tx7;
				$tx7 = "* L.229: ".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* L.229: </font>".mysqli_error($db))."</br>";
							}
							
	/************	MODIFICA NOMBRE DE LA TABLA FEEDPRO Y NAMETABLES	*****************/

	$tableoldfeedpro = "`".$_SESSION['clave']."feedpro".$_POST['valor1']."`";
	$tablenewfeedpro = "`".$_SESSION['clave']."feedpro".$_POST['valor2']."`";

	$sqlalt4 = "ALTER TABLE `$db_name`.$tableoldfeedpro RENAME `$db_name`.$tablenewfeedpro ";

	if(mysqli_query($db, $sqlalt4)){

global $tx8;
$tx8 = "  * HA MODIFICADO NOMBRE DE TABLA ".$tableoldfeedpro. " POR ".$tablenewfeedpro."\n";
				} else {
						global $tx8;
						$tx8 = "* :.245: ".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* ;L.245: </font>".mysqli_error($db))."</br>";
							}

	$filx4 = "%".$_SESSION['clave']."feedpro".$_POST['valor1']."%";
	$nametablefeedpro = $_POST['nombre']." FEED PRO";
				
	require "../config/TablesNames.php";

	$sqlntx4 = "UPDATE `$db_name`.$nametables SET `valortabla` = '$tablenewfeedpro', `nombreseccion` = '$nametablefeedpro' WHERE $nametables.`valortabla` LIKE '$filx4' LIMIT 1 ";

	if(mysqli_query($db, $sqlntx4)){

	global $tx9;
	$tx9 = "  * HA MODIFICADO NAMETABLES: ".$nametablefeedpro." & ".$tablenewfeedpro."\n";
				} else {
				global $tx9;
				$tx9 = "* L.262: ;".mysqli_error($db)."\n";
				print("<font color='#FF0000'>* L.262: </font>;".mysqli_error($db))."</br>";
							}
	
	/************	MODIFICA NOMBRE DE LA TABLA IMGPRO	*****************/

	$tableoldimgpro = "`".$_SESSION['clave']."imgpro".$_POST['valor1']."`";
	$tablenewimgpro = "`".$_SESSION['clave']."imgpro".$_POST['valor2']."`";
	

	$sqlalt5 = "ALTER TABLE `$db_name`.$tableoldimgpro RENAME `$db_name`.$tablenewimgpro ";

	if(mysqli_query($db, $sqlalt5)){

global $tx10;
$tx10 = "  * HA MODIFICADO NOMBRE DE TABLA ".$tableoldimgpro. " POR ".$tablenewimgpro."\n";
				} else {
						global $tx10;
						$tx10 = "* L.279: ".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* L.279: </font>".mysqli_error($db))."</br>";
							}

// RENOMBRA LA CARPETA DE IMAGENES

		$carpeta = "../imgpro/"."imgpro".$_POST['valor1'];
		$carpeta2 = "../imgpro/"."imgpro".$_POST['valor2'];
		rename($carpeta, $carpeta2);
		global $tx11;
		$tx11 = "  * HA MODIFICADO EL DIRECTORIO ".$carpeta."/ POR ".$carpeta2."\n";
		
/////////////////////////////

	global $tx;
	$tx = $tx1.$tx2.$tx3.$tx4.$tx5.$tx6.$tx7.$tx8.$tx9.$tx10.$tx11;
	
		} /* FIN DEL IF */
		
					
	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE NO CAMBIA	****************/
	/***********************************************************************/

	elseif(trim($_POST['valor1'] == $_POST['valor2'])){
		/*
		print("Valor 1 ".$_POST['valor1']." y Valor Nuevo ".$_POST['valor1']." 
		<font color='#FF0000'>SON IGUALES</font>");
		*/

	global $nombre;
	$nombre = $_POST['nombre'];
	global $valor;
	$valor = $_POST['valor2'];


	/************	MODIFICA EL NOMBRE EN SECCIONES	*****************/
	
	require "../config/TablesNames.php";

	$sqlc = "UPDATE `$db_name`.$secciones SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE $secciones.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			global $tx10;
			$tx10 = "  * HA MODIFICADO ".$_POST['valor1']." POR ".$valor." / ".$_POST['nombre']."\n";
			print( $tabla );
				} else {
						global $tx10;
						$tx10 = "* L.334: ".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* L.334: </font>".mysqli_error($db))."</br>";
								show_form ();
							}

	/*************	MODIFICA EL NOMBRE EN NAMETABLES STOCK	****************/

	$stock2 = "`".$_SESSION['clave']."stock".$_POST['valor2']."`";
	$fil1 = "%".$_SESSION['clave']."stock".$_POST['valor2']."%";
	$nametablestock = $_POST['nombre']." STOCK";
				
	require "../config/TablesNames.php";

	$sqlnt1 = "UPDATE `$db_name`.$nametables SET `valortabla` = '$stock2', `nombreseccion` = '$nametablestock' WHERE $nametables.`valortabla` LIKE '$fil1' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt1)){
			global $tx11;
			$tx11 = "  * HA MODIFICADO NAMETABLES ".$nametablestock."\n";
				} else { global $tx11;
						 $tx11 = "* L.354: ".mysqli_error($db)."\n";
						 print("<font color='#FF0000'>* L.354: </font>".mysqli_error($db))."</br>";
							}
							
	/*************	MODIFICA EL NOMBRE EN NAMETABLES FEED	****************/

	$feed2 = "`".$_SESSION['clave']."feed".$_POST['valor2']."`";
	$fil2 = "%".$_SESSION['clave']."feed".$_POST['valor2']."%";
	$nametablefeed = $_POST['nombre']." FEED";
				
	require "../config/TablesNames.php";

	$sqlnt2 = "UPDATE `$db_name`.$nametables SET `valortabla` = '$feed2', `nombreseccion` = '$nametablefeed' WHERE $nametables.`valortabla` LIKE '$fil2' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt2)){
			global $tx12;
			$tx12 = "  * HA MODIFICADO NAMETABLES ".$nametablefeed."\n";
				} else {
						global $tx12;
						$tx12 = "* L.372: ".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* :.372: </font>".mysqli_error($db))."</br>";
							}
					
	/*************	MODIFICA EL NOMBRE EN NAMETABLES PRO	****************/

	$pro2 = "`".$_SESSION['clave']."pro".$_POST['valor2']."`";
	$fil3 = "%".$_SESSION['clave']."pro".$_POST['valor2']."%";
	$nametablepro = $_POST['nombre']." PRO";
				
	require "../config/TablesNames.php";

	$sqlnt3 = "UPDATE `$db_name`.$nametables SET `valortabla` = '$pro2', `nombreseccion` = '$nametablepro' WHERE $nametables.`valortabla` LIKE '$fil3' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt3)){
			global $tx13;
			$tx13 = "  * HA MODIFICADO NAMETABLES: ".$nametablepro."\n";
				} else {
						global $tx13;
						$tx13 = "* L.390: ".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* L.390: </font>".mysqli_error($db))."</br>";
							
							} /* FINAL DEL ELSEIF */

	/************	MODIFICA EL NOMBRE EN NAMETABLES FEEDPRO	*****************/

	$feedpro2 = "`".$_SESSION['clave']."feedpro".$_POST['valor2']."`";
	$fil4 = "%".$_SESSION['clave']."feedpro".$_POST['valor2']."%";
	$nametablepro = $_POST['nombre']." FEED PRO";
				
	require "../config/TablesNames.php";

	$sqlnt4 = "UPDATE `$db_name`.$nametables  SET `valortabla` = '$feedpro2', `nombreseccion` = '$nametablepro' WHERE $nametables.`valortabla` LIKE '$fil4' LIMIT 1 ";

	if(mysqli_query($db, $sqlnt4)){
			global $tx14;
			$tx14 = "  * HA MODIFICADO NAMETABLES: ".$nametablepro."\n";
				} else {
						global $tx14;
						$tx14 = "* L.409: ".mysqli_error($db)."\n";
						print("<font color='#FF0000'>* L.409: </font>".mysqli_error($db))."</br>";
							} /* FINAL DEL ELSEIF */
							
	global $tx;
	$tx = $tx10.$tx11.$tx12.$tx13.$tx14;
	
	}	/* FINAL CONDICIONAL IF BBDD*/

			}	/* Final de la función process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto2'])){
				$defaults = array ( 'id' => $_POST['id'],
									'valor1' => $_POST['valor'],
									'valor2' => $_POST['valor'],
									'nombre' => $_POST['nombre'],);
					}
								   
	elseif(isset($_POST['modifica'])){
				$defaults = array ( 'id' => $_POST['id'],
									'valor1' => $_POST['valor1'],
									'valor2' => $_POST['valor2'],
									'nombre' => $_POST['nombre'],);
								}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>** </font>".$errors [$a]."</br>");
			}
		}
		
	print("<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
						<b>EL CAMPO VALOR</b> DA EL VALOR A LAS VARIABLES<br>
							Y NOMBRES DE TABLAS QUE SE HAN CREADO AUTOMÁTICAMENTE.<br>
						<b>SI SE MODIFICA</b> SE MODIFICARÁ EL NOMBRE<br>
							DE TODAS LAS TABLAS DEPENDIENTES AUTOMÁTICAMENTE
					</td>
				</tr>
			</table>
			<table align='center' border=0>
				<tr>
					<th colspan=2 class='BorderInf'>
						INTRODUZCA LOS NUEVOS DATOS.
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<tr>
					<td><font color='#FF0000'>*</font>Id:</td>
					<td>
		<input type='hidden' name='id' value='".$defaults['id']."' />".$defaults['id']."
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Valor:</td>
					<td>
		<input type='hidden' name='valor1' value='".$defaults['valor1']."' />".$defaults['valor1']."
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Valor Nuevo:</td>
					<td>
		<input type='text' name='valor2' size=25 maxlength=22 value='".$defaults['valor2']."' />
					</td>
				</tr>
				<tr>
					<td><font color='#FF0000'>*</font>Nombre:</td>
					<td>
		<input type='text' name='nombre' size=25 maxlength=22 value='".$defaults['nombre']."' />
					</td>
				</tr>
				<tr height=60px>
					<td colspan='2' align='right'>
						<input type='submit' value='MODIFICAR SECCION' />
						<input type='hidden' name='modifica' value=1 />
					</td>
				</tr>
		</form>														
			</table>"); 
	
				}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function accion_Modificar_02(){

	global $tx;
		
	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- SECCIONES MODIFICA 3 ".$ActionTime." / ID: ".$_POST['id']." ".$_POST['nombre']." ".$_POST['valor1']." => ".$_POST['valor2'];

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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Modificar_01(){

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- SECCIONES MODIFICA 2 ".$ActionTime." / ID: ".$_POST['id']." ".$_POST['nombre']." ".$_POST['valor'];

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