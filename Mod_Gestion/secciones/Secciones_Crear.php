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
		if(isset($_POST['oculto'])){
				if($form_errors = validate_form()){
									show_form($form_errors);
						} else { process_form();
								 accion_seccion_crear();
									}
			} else { show_form(); }
	} else { require "../Inclu/AccesoDenegado.php";	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	$errors = array();

	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[valor]' OR `nombre` = '$_POST[nombre]' ";
	$qb = mysqli_query($db, $sqlb);
	//$rowb = mysqli_fetch_assoc($qb);
	if( mysqli_num_rows($qb) > 0){ 
		$errors [] = "<font color='#FF0000'>ESTA SECCION YA EXISTE</font>";
	 } else { }

	if(strlen(trim($_POST['valor'])) == 0){
		$errors [] = "Valor: <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['valor'])) < 4){
		$errors [] = "Valor: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['valor'])){
		$errors [] = "Valor: <font color='#FF0000'>Solo texto.</font>";
		}
		
	elseif (!preg_match('/^[a-z]+$/',$_POST['valor'])){
		$errors [] = "Valor: <font color='#FF0000'>Solo minusculas sin espacios ni acentos.</font>";
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
	
	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						CREADA UNA NUEVA SECCI&Oacute;N
					</th>
				</tr>
				<tr>
					<td width=120px>Valor:</td>
					<td width=200px>".$_POST['valor']."</td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td>".$_POST['nombre']."</td>
				</tr>				
			</table>";	 
		
	/* ******* 	GRABAMOS LA SECCION EN LA TABLA SECCIONES	******** */

	global $valor;
	$valor = $_POST['valor'];
	global $nombre;
	$nombre = $_POST['nombre'];

	require "../config/TablesNames.php";

	$sql = "INSERT INTO `$db_name`.$secciones (`valor`, `nombre`) VALUES ('$_POST[valor]', '$_POST[nombre]')";
		
	if(mysqli_query($db, $sql)){
			global $tx1;
			$tx1 ="  * HA CREADO LA SECCION ".$_POST['nombre']." / ".$_POST['valor']."\n";
			print( $tabla );
		} else { global $tx1;
				 $tx1 = "* L.114: ".mysqli_error($db)."\n";	
				 print("<font color='#FF0000'>* L.114: </font>".mysqli_error($db))."</br>";
					}

	/************** CREAMOS LA TABLA STOCK E INSERTAMOS DATOS INICIALES ***************/
					
	$nombre1 = $_SESSION['clave']."STOCK".$_POST['nombre'];
	//$valor1 = $_SESSION['clave']."stock".$_POST['valor'];

	require "../config/TablesNames.php";

	$sql1 = "CREATE TABLE `$db_name`.$StockValor (
  `id` int(4) NOT NULL auto_increment,
  `nsemana` int(2) NOT NULL,
  `producto` varchar(24) collate utf8_spanish2_ci,
  `proname` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `psiva` decimal(7,2) unsigned NOT NULL default 00.00,
  `iva` int(2) NOT NULL default 00.00,
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
			global $tx2;
			$tx2 = "  * HA CREADO LA TABLA ".$nombre1."\n";
	} else { global $tx2;
			 $tx2 = "* L.132: ".mysqli_error($db)."\n";					
			 print("< color='#FF0000'>* L.132: </font>".mysqli_error($db))."</br>";
				}

	$nombre1b = $_POST['nombre']." STOCK";

	require "../config/TablesNames.php";

	$sql1c = "INSERT INTO `$db_name`.$nametables (`valortabla`, `nombreseccion`) VALUES ('$StockValor', '$nombre1b')";
		
	if(mysqli_query($db, $sql1c)){
			global $tx3;
			$tx3 = "  * HA GRABADO EN NAMETABLES ".$nombre1b."\n";
		} else {
				global $tx3;
				$tx3 = "* L.166: ".mysqli_error($db)."\n";	
				print("<font color='#FF0000'>* L.166: </font>".mysqli_error($db))."</br>";
						}
					
	/************* CREAMOS LA TABLA FEEDBACK DE STOCKS ****************/

	$name2 = $_SESSION['clave']."FEED".$_POST['nombre'];
	//$value2 = $_SESSION['clave']."feed".$_POST['valor'];

	require "../config/TablesNames.php";

	$sql2 = "CREATE TABLE `$db_name`.$feedtable3 (
  `id` int(4) NOT NULL auto_increment,
  `nsemana` int(2) NOT NULL,
  `producto` varchar(24) collate utf8_spanish2_ci,
  `proname` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `psiva` decimal(7,2) unsigned NOT NULL default 00.00,
  `iva` int(2) NOT NULL default 00.00,
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
		global $tx4;
		$tx4 = "  * HA CREADO LA TABLA ".$name2."\n";
		} else { global $tx4;
				 $tx4 = "* L.184: ".mysqli_error($db)."\n";					
				 print("<font color='#FF0000'>* L.184: </font>".mysqli_error($db))."</br>";
					}
					
	$name2b = $_POST['nombre']." FEED";

	require "../config/TablesNames.php";

	$sql2c = "INSERT INTO `$db_name`.$nametables (`valortabla`, `nombreseccion`) VALUES ('$feedtable3', '$name2b')";
		
	if(mysqli_query($db, $sql2c)){
			global $tx5;
			$tx5 = "  * HA GRABADO EN NAMETABLES ".$name2b."\n";
		} else { global $tx5;
				 $tx5 = "* L.219: ".mysqli_error($db)."\n";	
				 print("<font color='#FF0000'>* L.219: </font>".mysqli_error($db))."</br>";
					}
					
	/************* CREAMOS LA TABLA DE VALORES Y VARIABLES DE PRODUCTOS ****************/

	$name3 = $_SESSION['clave']."PRO".$_POST['nombre'];
	//$value3 = $_SESSION['clave']."pro".$_POST['valor'];
	$prod3 = $_POST['nombre'];

	require "../config/TablesNames.php";

	$sql3 = "CREATE TABLE `$db_name`.$feedtable2b (
  `id` int(4) NOT NULL auto_increment,
  `valor` varchar(14) collate utf8_spanish2_ci,
  `nombre` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `ref` varchar(14) collate utf8_spanish2_ci NOT NULL DEFAULT 'NO CODE',
  `psiva` decimal(7,2) unsigned NOT NULL default 00.00,
  `iva` int(2) NOT NULL default 00.00,
  `ivae` decimal(7,2) unsigned NOT NULL default 00.00,
  `pvp` decimal(7,2) unsigned NOT NULL default 00.00,
  `stock` decimal(7,2) unsigned NOT NULL default 00.00,
  `coment`  text collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $sql3)){
			global $tx6;
			$tx6 = "  * HA CREADO LA TABLA ".$name3."\n";
		} else { global $tx6;
				 $tx6 = "* L.237: ".mysqli_error($db)."\n";					
				 print("<font color='#FF0000'>* L.237: </font>".mysqli_error($db))."</br>";
					}
				
	require "../config/TablesNames.php";

	$sql3b = "INSERT INTO `$db_name`.$feedtable2b (`id`, `valor`, `nombre`, `ref`, `stock`, `coment`) VALUES (1, '', 'PRODUCTOS $prod3', 'A1234567890', '00.00', 'Init Values')";
		
	if(mysqli_query($db, $sql3b)){
			global $tx7;
			$tx7 = "  * HA GRABADO INIT VALUES ".$name3."\n";
		} else { global $tx7;
				 $tx7 = "* L.262: ".mysqli_error($db)."\n";	
				 print("<font color='#FF0000'>* L.262: </font>".mysqli_error($db))."</br>";
					}

	$name3b = $_POST['nombre']." PRO";

	require "../config/TablesNames.php";

	$sql3b = "INSERT INTO `$db_name`.$nametables (`valortabla`, `nombreseccion`) VALUES ('$feedtable2b', '$name3b')";
		
	if(mysqli_query($db, $sql3b)){
			global $tx8;
			$tx8 = "  * HA GRABADO EN NAMETABLES ".$name3b."\n";
		} else { global $tx8;
				 $tx8 = "* L.276: ".mysqli_error($db)."\n";	
				 print("<font color='#FF0000'>* L.276: </font>".mysqli_error($db))."</br>";
					}

	/************* CREAMOS LA TABLA DE PRODUCTOS FEEDBACK ****************/

	$name4 = $_SESSION['clave']."FEEDPRO".$_POST['nombre'];
	//$value4 = $_SESSION['clave']."feedpro".$_POST['valor'];
	$prod4 = $_POST['nombre'];

	require "../config/TablesNames.php";

	$sql4 = "CREATE TABLE `$db_name`.$feedtable2 (
  `id` int(4) NOT NULL auto_increment,
  `valor` varchar(14) collate utf8_spanish2_ci,
  `nombre` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `ref` varchar(14) collate utf8_spanish2_ci NOT NULL DEFAULT 'NO CODE',
  `psiva` decimal(7,2) unsigned NOT NULL default 00.00,
  `iva` int(2) NOT NULL default 00.00,
  `ivae` decimal(7,2) unsigned NOT NULL default 00.00,
  `pvp` decimal(7,2) unsigned NOT NULL default 00.00,
  `stock` decimal(7,2) unsigned NOT NULL default 00.00,
  `coment` text collate utf8_spanish2_ci,
  `borrado` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $sql4)){
			global $tx9;
			$tx9 = "  * HA CREADO LA TABLA ".$name4."\n";
		} else { global $tx9;
				 $tx9 = "* L.294: ".mysqli_error($db)."\n";					
				 print("<font color='#FF0000'>* L.294: </font>".mysqli_error($db))."</br>";
					}
/**/
	require "../config/TablesNames.php";

	$sql4b = "INSERT INTO `$db_name`.$feedtable2 (`id`, `valor`, `nombre`, `ref`, `stock`, `coment`, `borrado`) VALUES (0, '', 'FEED PRO $prod4', 'A1234567890', '00.00', 'Init Values', '1900-10-10' )";
		
	if(mysqli_query($db, $sql4b)){
			global $tx10;
			$tx10 = "  * HA GRABADO INIT VALUES ".$name4."\n";
		} else { global $tx10;
				 $tx10 = "* L.320: ".mysqli_error($db)."\n";	
				 print("<font color='#FF0000'>* L.320: </font>".mysqli_error($db))."</br>";
					}

	$name4b = $_POST['nombre']." FEED PRO";

	require "../config/TablesNames.php";

	$sql3b = "INSERT INTO `$db_name`.$nametables (`valortabla`, `nombreseccion`) VALUES ('$feedtable2', '$name4b')";
		
	if(mysqli_query($db, $sql3b)){
			global $tx11;
			$tx11 = "  * HA GRABADO EN NAMETABLES ".$name4b."\n";
		} else { global $tx11;
				 $tx11 = "* L.334: ".mysqli_error($db)."\n";	
				 print("<font color='#FF0000'>* L.334: </font>".mysqli_error($db))."</br>";
					}
					
	/************* CREAMOS LA TABLA DE IMAGENES PRODUCCTOS ****************/

	$name5 = $_SESSION['clave']."IMGPRO".$_POST['nombre'];
	//$value5 = $_SESSION['clave']."imgpro".$_POST['valor'];
	global $prod5;
	$prod5 = "imgpro".$_POST['valor'];

	require "../config/TablesNames.php";

	$sql5 = "CREATE TABLE `$db_name`.$secc3 (
  `id` int(4) NOT NULL auto_increment,
  `producto` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `proname` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $sql5)){
			global $tx12;
			$tx12 = "  * HA CREADO LA TABLA ".$name5."\n";
	} else { global $tx12;
			 $tx12 = "='#FF0000'>* L.353: ".mysqli_error($db)."\n";					
			 print("<font color='#FF0000'>* L.353: </font>".mysqli_error($db))."</br>";
				}
					
// CREA EL DIRECTORIO DE IMAGENES.

$carpeta = "../imgpro/".$prod5;
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
	global $tx13;
	$tx13 = "  * HA CREADO EL DIRECTORIO ".$carpeta."/ \n";
	copy("../imgpro/untitled.png", $carpeta."/untitled.png");
} else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
			global $tx13;
			$tx13 = "  * NO HA CREADO EL DIRECTORIO ".$carpeta."/ \n";
				}
				
	/*****************************/

	global $tx;
	$tx = $tx1.$tx2.$tx3.$tx4.$tx5.$tx6.$tx7.$tx8.$tx9.$tx10.$tx11.$tx12.$tx13;
	
			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else { $defaults = array ( 'valor' => '',
									 'nombre' => '',);
								   		}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
		
	print("<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
						<b>EL CAMPO VALOR, DA EL VALOR A LAS VARIABLES
						<br>
						Y NOMBRE DE TABLAS QUE SE CREARÁN AUTOMÁTICAMENTE.
						</br></b>
						TABLA STOCK, TABLA FEEDBACK, TABLA PRODUCTOS, VINCULADAS A LA SECCIÓN.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							CREAR NUEVA SECCI&Oacute;N
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
				<tr>
					<td width=120px>	
						<font color='#FF0000'>*</font>Valor:
					</td>
					<td width=200px>
		<input type='text' name='valor' size=25 maxlength=22 value='".$defaults['valor']."' />
					</td>
				</tr>
				<tr>
					<td width=120px>	
						<font color='#FF0000'>*</font>Nombre:
					</td>
					<td width=200px>
		<input type='text' name='nombre' size=25 maxlength=22 value='".$defaults['nombre']."' />
					</td>
				</tr>
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='NUEVA SECCION' />
						<input type='hidden' name='oculto' value=1 />
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

function accion_seccion_crear(){

	global $db;
	global $rowout;
	global $secc;
	global $tx;
	
	$valor = $_POST['valor'];
	$nombre = $_POST['nombre'];	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	global $text;
	$text = "- SECCION CREAR ".$ActionTime.". ".$nombre.". ".$valor;

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
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>