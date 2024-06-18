<?php
session_start();

	require 'Inclu/Inclu_Menu_00.php'; 
	require '../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../Mod_Admin/Conections/conection.php';
	require '../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require "Inclu/Only.index.php";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
					suma_denegado ();
					show_form($form_errors);
			}else{ 	admin_entrada();
					suma_acces();
					process_form();
					ayear();
								}
		}elseif(isset($_POST['salir'])){ salir();
										 show_form();
		}elseif(isset($_SESSION['Nivel'])){
								admin_entrada();
								process_form();
								//ayear();
		}else{ 	suma_visit();	
				//show_form();
				global $redir;
				$redir = "<script type='text/javascript'>
								function redir(){
								window.location.href='../Mod_Admin/index.php';
							}
							setTimeout('redir()',10); /* 10 microsegundos */
							</script>";
				print ($redir);
			}
												
///////////////////////

function modif(){
									   							
	$filename = "config/ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
	$contenido = implode("\n",$contenido);
	
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
}

function modif2(){

	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

function tventas(){
	
	global $db;
	global $db_name;
	
	$vname = $_SESSION['clave']."ventas_".date('Y');
	$vname = "`".$vname."`";
	
	$tv = "CREATE TABLE `$db_name`.$vname (
  `id` int(4) NOT NULL auto_increment,
  `ini` varchar(3) collate utf8_spanish2_ci NOT NULL,
  `cname` varchar(52) collate utf8_spanish2_ci NOT NULL,
  `refcaja` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `clname` varchar(52) collate utf8_spanish2_ci NOT NULL,
  `refclient` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `oper` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `nsemana` int(2) NOT NULL,
  `datecash` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `vseccion` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `producto` varchar(20) collate utf8_spanish2_ci,
  `proname` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `kgcash` decimal(7,2) unsigned NOT NULL,
  `psiva` decimal(7,2) unsigned NOT NULL,
  `iva` int(2) NOT NULL,
  `ivae` decimal(7,2) unsigned NOT NULL,
  `pvp` decimal(7,2) unsigned NOT NULL,
  `pvptot` decimal(10,2) unsigned NOT NULL,
  `pago` varchar(20) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $tv)){

				} else {print( "* NO OK TABLA VENTAS. ".mysqli_error($db)."\n");}
	
	}
	
function tgastos(){
	
	global $db;
	global $db_name;
	
	$vname = $_SESSION['clave']."gastos_".date('Y');
	$vname = "`".$vname."`";
	
	$tg = "CREATE TABLE `$db_name`.$vname (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $tg)){

				} else {print( "* NO OK TABLA GASTOS. ".mysqli_error($db)."\n");}
	
// CREA EL DIRECTORIO DE IMAGENES.

	$vname2 = "docgastos_".date('Y');
	
	$carpeta = "gastos/".$vname2;
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		copy("imgpro/untitled.png", $carpeta."/untitled.png");
		copy("gastos/pdf.png", $carpeta."/pdf.png");}
		else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");}
	}
	
///////////////////////

function ayear(){
	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){
		print("EL AÑO ES EL MISMO ".date('Y')." == ".$fget);
		}
	elseif($fget != date('Y')){ 
		print("EL AÑO NO ES EL MISMO ".date('Y')." != ".$fget);
		modif();
		modif2();
		tventas();
		tgastos();
		}
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function admin_entrada(){

	global $db;		
	global $db_name;
	global $userid;
	global $uservisita;

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	$total = $uservisita + 1;
	$datein = date('Y-m-d/H:i:s');

	require "config/TablesNames.php";

	$sqladin = "UPDATE `$db_name`.$admin SET `lastin` = '$datein', `visitadmin` = '$total' WHERE $admin .`id` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladin)){
			// print("* ");
				} else {
				print("</br>
				<font color='#FF0000'>
		* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."
				</br>";
							}
					
	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = "\n** INICIO SESION => .".$datein.".\n \t User Ref: ".$_SESSION['ref'].".\n \t ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."\n \n";
	$filename = "logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	
	require "config/TablesNames.php";
	
	$sqlv =  "SELECT * FROM $visitasadmin ";
	$qv = mysqli_query($db, $sqlv);
	
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;

	$idv = 69;
	
	if(mysqli_query($db, $sqlv)){ 
				print("<div style='clear:both'></div>
						<table align='right' style='margin-top:0px'>
							<tr>	
								<td align='right'><font color='#59746A'>VISITAS:</font>	</td>
								<td  align='right'><font color='#59746A'>".$tot."</font></td>
							</tr>
							<tr>
								<td align='right'><font color='#59746A'>ACCESOS PERMITIDOS:</font></td>
								<td align='right'><font color='#59746A'>".$rowv['acceso']."</font></td>
							</tr>
							<tr>
								<td align='right'><font color='#59746A'>ACCESOS DENEGADOS:</font></td>
								<td align='right'><font color='#59746A'>".$rowv['deneg']."</font></td>
							</tr>
						</table>
						</br>");
		} else { print("<font color='#FF0000'>* Error: </font></br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."</br>");
					}

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function suma_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	
	require "config/TablesNames.php";

	$sqlv =  "SELECT * FROM $visitasadmin";
	$qv = mysqli_query($db, $sqlv);
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;

	$idv = 69;
	
	$sqlv = "UPDATE `$db_name`.$visitasadmin SET `admin` = '$sumavisit' WHERE $visitasadmin.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqlv)){ print(" </br>");
			} else { print("<font color='#FF0000'>* Error: </font></br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."</br>");
						}
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function suma_acces(){

	global $db;
	global $db_name;
	global $rowa;
	global $sumaacces;
	
	require "config/TablesNames.php";

	$sqla =  "SELECT * FROM $visitasadmin";
	$qa = mysqli_query($db, $sqla);
	$rowa = mysqli_fetch_assoc($qa);
	
	$_SESSION['acceso'] = $rowa['acceso'];
	
	$tota = $rowa['acceso'];

	global $sumaacces;
	$sumaacces = $tota + 1;

	$idv = 69;
	
	$sqla = "UPDATE `$db_name`.$visitasadmin SET `acceso` = '$sumaacces' WHERE $visitasadmin.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){ print ('</br>');
			} else { print("<font color='#FF0000'>* Error: </font></br>
							&nbsp;&nbsp;&nbsp;".mysqli_error($db)."</br>");
						}

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function suma_denegado(){

	global $db;
	global $db_name;
	global $rowd;
	global $sumadeneg;
	
	require "config/TablesNames.php";

	$sqld =  "SELECT * FROM $visitasadmin";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);
	
	$_SESSION['deneg'] = $rowd['deneg'];
	
	$dng = $rowd['deneg'];
	
	global $sumadeneg;
	$sumadeneg = $dng + 1;

	$idd = 69;
	
	$sqld = "UPDATE `$db_name`.$visitasadmin SET `deneg` = '$sumadeneg' WHERE $visitasadmin.`idv` = '$idd' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){ print("	</br>");
			} else { print("<font color='#FF0000'>* Error: </font></br>
							&nbsp;&nbsp;&nbsp;".mysqli_error($db)."</br>");
				}
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	global $db;
	global $sql;
	global $q;
	global $row;
	
	$errors = array();
	
	if (strlen(trim($_POST['Usuario'])) == 0){
		$errors [] = "Usuario: Campo obligatorio.";
		}
	
	if (strlen(trim($_POST['Password'])) == 0){
		$errors [] = "Password: Campo Obligatorio:";
		}
		
	if(trim($_POST['Usuario'] != @$row['Usuario'])){
		$errors [] = "Nombre o Password incorrecto.";
		}
	
	elseif(trim($_POST['Password'] != @$row['Password'])){
		$errors [] = "Nombre o Password incorrecto.";
		}

	return $errors;

		}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
					
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){				 
			print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
			master_index();
			recup_compra();					
		} else { 		
					require "../Inclu/AccesoDenegado.php";			
					}
		}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array ('Usuario' => '',
								   'Password' => '');
								   }
	
	if ($errors){
		print("<font color='#FF0000'>Solucione estos errores:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* Campo </font>".$errors [$a]."</br>");
			}
		}
		
	print("".show_visit()."<div style='clear:both'></div>
			<table align='center' style=\"margin-top:2px; margin-bottom:8px\" >
				<tr>
					<th colspan=2 width=100% valign=\"bottom\" class='BorderInf'>
						SUS DATOS DE ACCESO
					</th>
				</tr>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td>USUARIO</td>
					<td>
<input type='Password' name='Usuario' size=20 maxlength=50 value='".$defaults['Usuario']."' />
					</td>
				</tr>
				<tr>
					<td>PASSWORD</td>
					<td>
<input type='Password' name='Password' size=20 maxlength=50 value='".$defaults['Password']."' />
					</td>
				</tr>
				<tr>
					<td valign='middle' align='right' colspan='2'>
						<input type='submit' value='ACCEDER' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
		</form>	
			</table>"); 
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function recup_compra(){
	
	global $db;
	global $db_name;

	unset($_SESSION['oper']);

	require "config/TablesNames.php";

	$rc =  "SELECT * FROM $caja WHERE `ini` > '0' ";
	$qrc = mysqli_query($db, $rc);
	$count = mysqli_num_rows($qrc);
		
	if($count < 1){print("<div align='center' style='margin-bottom:120px;margin-top:120px'>
								NO HAY COMPRAS PENDIENTES
						</div>");}
		
	else{	print ("<table align='center'>
						<tr style='font-size:14px'>
							<th colspan=7 class='BorderInf'>SESIONES DE COMPRAS</th>
						</tr>
						<tr style='font-size:12px'>
							<th class='BorderInfDch'>CAJERO/A</th>
							<th class='BorderInfDch'>REF CAJA</th>
							<th class='BorderInfDch'>OPER SESION</th>		
							<th class='BorderInfDch'>FECHA</th>
							<th class='BorderInfDch'>REF CLIENTE</th>										
							<th colspan='2' class='BorderInf'></th>
						</tr>");
									
	while($rowrc = mysqli_fetch_assoc($qrc)){
		
	global $refclient;
	$refclient = $rowrc['refclient'];
	
	print (	"<tr align='center'>
										
	<form name='recup_compra2' method='post' action='caja/caja_00.php'>
	
						<td class='BorderInfDch' align='left'>
	<input name='cname' type='hidden' value='".$rowrc['cname']."' />".$rowrc['cname']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='refcaja' type='hidden' value='".$rowrc['refcaja']."' />".$rowrc['refcaja']."
						</td>
						<td class='BorderInfDch' align='right'>
	<input name='oper' type='hidden' value='".$rowrc['oper']."' />".$rowrc['oper']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='datecash' type='hidden' value='".$rowrc['datecash']."' />".$rowrc['datecash']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='refclient' type='hidden' value='".$rowrc['refclient']."' />".$rowrc['refclient']."
						</td>
						
			<td class='BorderInf'>
							<div style='float:left;margin-right:6px'>
								<input type='submit' value='RECUPERA COMPRA' />
								<input type='hidden' name='recup_compra2' value=1 />
				</form>	
			</div>
					</td>");

	require "config/TablesNames.php";

	$ncl =  "SELECT * FROM $clientes WHERE `ref` = '$refclient' ";
	$qncl = mysqli_query($db, $ncl);
	$rowncl = mysqli_fetch_assoc($qncl);
	$_SESSION['nclient'] = $rowncl['Nivel'];
	//  print(" ".$_SESSION['nclient']);
		if(mysqli_num_rows($qncl) == 0){
				$ncl =  "SELECT * FROM `admin` WHERE `ref` = '$refclient' ";
				$qncl = mysqli_query($db, $ncl);
				$rowncl = mysqli_fetch_assoc($qncl);
				$_SESSION['nclient'] = $rowncl['Nivel'];
			//	print(" ".$_SESSION['nclient']);
							}
if($refclient != ''){

	if(($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){$h = 'height=620px';}
	else {$h = 'height=250px';}

	if($_SESSION['nclient'] == 'cliente'){
		require "config/TablesNames.php";
		$dtcl =  "SELECT * FROM $clientes WHERE `ref` = '$refclient' ORDER BY `Nombre` ASC ";
		$qdtcl = mysqli_query($db, $dtcl);
		$h = 'height=620px';}

	elseif(($_SESSION['nclient'] == 'admin') || ($_SESSION['nclient'] == 'plus') || ($_SESSION['nclient'] == 'user') || ($_SESSION['nclient'] == 'caja')){
		require "config/TablesNames.php";
		$dtcl =  "SELECT * FROM $admin WHERE `ref` = '$refclient' ORDER BY `Nombre` ASC ";
		$qdtcl = mysqli_query($db, $dtcl);}

		while($rowdtcl = mysqli_fetch_assoc($qdtcl)){

		print("	<td class='BorderInf'>
				<div style='float:left;margin-right:6px'>
	
	<form name='data_client' action='caja/Cliente_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,".$h."')\">

		<input name='id' type='hidden' value='".$rowdtcl['id']."' />
		<input name='Nivel' type='hidden' value='".$rowdtcl['Nivel']."' />
		<input name='ref' type='hidden' value='".$rowdtcl['ref']."' />
		<input name='Nombre' type='hidden' value='".$rowdtcl['Nombre']."' />
		<input name='Apellidos' type='hidden' value='".$rowdtcl['Apellidos']."' />
		<input name='myimg' type='hidden' value='".$rowdtcl['myimg']."' />
		<input name='doc' type='hidden' value='".$rowdtcl['doc']."' />
		<input name='dni' type='hidden' value='".$rowdtcl['dni']."' />
		<input name='ldni' type='hidden' value='".$rowdtcl['ldni']."' />
		<input name='Email' type='hidden' value='".$rowdtcl['Email']."' />
		<input name='Usuario' type='hidden' value='".$rowdtcl['Usuario']."' />
		<input name='Password' type='hidden' value='".$rowdtcl['Password']."' />
		<input name='Direccion' type='hidden' value='".$rowdtcl['Direccion']."' />
		<input name='Tlf1' type='hidden' value='".$rowdtcl['Tlf1']."' />
		<input name='Tlf2' type='hidden' value='".$rowdtcl['Tlf2']."' />
		<input name='lastin' type='hidden' value='".$rowdtcl['lastin']."' />
		<input name='lastout' type='hidden' value='".$rowdtcl['lastout']."' />
		<input name='visitadmin' type='hidden' value='".$rowdtcl['visitadmin']."' />

		<input type='submit' value='CONSULTAR DATOS CLIENTE' />
		<input type='hidden' name='data_client' value=1 />
	
	</form>	
			</div>
		</td>");
		} /* FIN DEL WHILE */
	}

	print("	</tr>");
					}

	print("	</table>");
				}
		}

function recup_compra2(){
	
	$_SESSION['oper'] = $_POST['oper'];
//	print("* INIT CAJA SESION.".$_SESSION['oper']);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){

		require 'Inclu/Master_Index_00.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function salir() {		unset($_SESSION['id']);
							unset($_SESSION['Nivel']);
							unset($_SESSION['Nombre']);
							unset($_SESSION['Apellidos']);
							unset($_SESSION['doc']);
							unset($_SESSION['dni']);
							unset($_SESSION['ldni']);
							unset($_SESSION['Email']);
							unset($_SESSION['Usuario']);
							unset($_SESSION['Password']);
							unset($_SESSION['Direccion']);
							unset($_SESSION['Tlf1']);
							unset($_SESSION['Tlf2']);
							unset($_SESSION['nclient']);
					print("Se ha cerrado la sesión.</br>");
				}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inclu/Inclu_Footer_01.php';

?>