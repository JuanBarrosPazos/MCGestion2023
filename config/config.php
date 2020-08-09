<?php

	require '../Inclu/Admin_Inclu_01b.php';

	if($_POST['config']){
							
		if($form_errors = validate_form()){ show_form($form_errors); } 
		else {	process_form();
				require '../Conections/conection.php';
				$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		
				
			if (!$db){ 	global $dbconecterror;
						$dbconecterror = $dbname." * ".mysqli_connect_error()."\n"; 
						print ("NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
						show_form();
						
						} elseif($db) { config_one();
								 		crear_tablas();
								 		ayear();
										}
				}
							
	} else {show_form();}

//////////////////////////////////////////////////////////////////////////////////////////////

function config_one(){
	
	if(file_exists('year.txt')){unlink("year.txt");
					$data1 = "\n \t UNLINK year.txt";}
			else {print("ERROR UNLINK year.txt </br>");
					$data1 = "\n \t ERROR UNLINK year.txt";}


	if(file_exists('ayear.php')){unlink("ayear.php");
					$data2 = "\n \t UNLINK ayear.php";}
			else {print("ERROR UNLINK ayear.php </br>");
					$data2 = "\n \t ERROR UNLINK ayear.php";}

	if(!file_exists('year.txt')){
			if(file_exists('year_Init_System.txt')){
				copy("year_Init_System.txt", "year.txt");
				$data3 = "\n \t RENAME year_Init_System.txt TO year.txt";
			} else {print("ERROR RENAME year_Init_System.txt TO year.txt </br>");
				$data3 = "\n \t ERROR RENAME year_Init_System.txt TO year.txt";}
			}

	if(!file_exists('ayear.php')){
			if(file_exists('ayear_Init_System.php')){
				copy("ayear_Init_System.php", "ayear.php");
				$data4 = "\n \t RENAME ayear_Init_System.php TO ayear.php";
			} else {print("ERROR RENAME ayear_Init_System.php TO ayear.php </br>");
				$data4 = "\n \t ERROR RENAME ayear_Init_System.php TO ayear.php";}
			}
	
	global $cfone;
	$cfone ="\n SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3.$data4;

	}
	
//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	
	if(strlen(trim($_POST['host'])) == 0){
		$errors [] = "HOST: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['host'])) < 4){
		$errors [] = "HOST: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 \.]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['user'])) == 0){
		$errors [] = "USER: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['user'])) < 4){
		$errors [] = "USER: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 \.]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['pass'])) == 0){
		$errors [] = "PASS: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['pass'])) < 4){
		$errors [] = "PASS: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 \.]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['name'])) == 0){
		$errors [] = "NAME: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['name'])) < 4){
		$errors [] = "NAME: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 \.]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>NO VALIDOS</font>";
		}

			return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	/************** CREAMOS EL ARCHIVO DE CONFIGURACIÓN **************/

	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";

	$bddata = '<?php
				$db_host = '.$host.'; 
				$db_user = '.$user.'; 
				$db_pass = '.$pass.'; 
				$db_name = '.$name.'; 
				?>';
	
	$filename = "../Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	
		print("	<table align='center'>
		
					<tr>
						<td colspan='2' align='center'>
								SE HA CREADO EL ARCHIVO DE CONEXIONES.
							</br>
								CON LAS SIGUIENTES VARIABLES.
						</td>
					</tr>
					<tr>
						<td>
								VARIABLE HOST ADRESS
						</td>
						<td>
								\$db_host = ".$host."; \n
						</td>		
					</tr>								

					<tr>
						<td>
								VARIABLE USER NAME
						</td>
						<td>
								\$db_user = ".$user."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE PASSWORD
						</td>
						<td>
								\$db_pass = ".$pass."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE BBDD NAME
						</td>
						<td>
								\$db_name = ".$name."; \n
						</td>		
					</tr>
													
				</table>
				
							");
							
			}	

//////////////////////////////////////////////////////////////////////////////////////////////
	
	function crear_tablas(){
	
	global $db;	
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/
					
	$admin = "CREATE TABLE `$db_name`.`admin` (
  `ID` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL,
  `Tlf2` int(9) NOT NULL,
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
		
					global $table1;
					$table1 = "\t* OK TABLA ADMIN. \n";
			
				} else {
					
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db)." \n";
					
					}
					
	/************** CREAMOS LA TABLA CLIENTES ***************/
					
	$admin = "CREATE TABLE `$db_name`.`clientes` (
  `ID` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'cliente',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL,
  `Tlf2` int(9) NOT NULL,
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
		
					global $table2;
					$table2 = "\t* OK TABLA CLIENTES. \n";
			
				} else {
					
					global $table2;
					$table2 = "\t* NO OK TABLA CLIENTES. ".mysqli_error($db)." \n";
					
					}
					
	$vc = "INSERT INTO `$db_name`.`clientes` (`ref`,`Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES('000000', 'cliente', 'Anonimo', 'Anonimo', 'untitled.png', '000000', '000000', '0', '000000', '', '', '000000', '000000', '000000')";
		
	if(mysqli_query($db, $vc)){
						
					global $table3;
					$table3 = "\t* OK INIT VALUES EN CLIENTES. \n";

				} else {
					
					global $table3;
					$table3 = "\t* NO OK INIT VALUES EN CLIENTES. ".mysqli_error($db)." \n";
				
					}
					
	/************* CREAMOS LA TABLA FEEDBACK ****************/

	$feedback = "CREATE TABLE `$db_name`.`feedback` (
  `ID` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL,
  `Tlf2` int(9) NOT NULL,
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL,
  `borrado` varchar(22) collate utf8_spanish2_ci NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $feedback)){
										
					global $table5;
					$table5 = "\t* OK TABLA FEEDBACK. \n";
					
				} else {
					
					global $table5;
					$table5 = "\t* NO OK TABLA FEEDBACK. ".mysqli_error($db)." \n";

					}
					
	/************* CREAMOS LA TABLA CLIENTES FEEDBACK ****************/

	$feedback = "CREATE TABLE `$db_name`.`clientesfeedback` (
  `ID` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'cliente',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL,
  `Tlf2` int(9) NOT NULL,
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL,
  `borrado` varchar(22) collate utf8_spanish2_ci NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $feedback)){
										
					global $table6;
					$table6 = "\t* OK TABLA CLIENTES FEEDBACK. \n";
					
				} else {
					
					global $table6;
					$table6 = "\t* NO OK TABLA CLIENTES FEEDBACK. ".mysqli_error($db)." \n";

					}
					
	/************* CREAMOS LA TABLA NAMETABLES ****************/

	$nametables = "CREATE TABLE `$db_name`.`nametables` (
  `id` int(3) NOT NULL auto_increment,
  `valortabla` varchar(22) collate utf8_spanish2_ci,
  `nombreseccion` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`,`valortabla`,`nombreseccion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $nametables)){
		
					global $table7;
					$table7 = "\t* OK TABLA NAMETABLES. \n";

				} else {
					
					global $table7;
					$table7 = "\t* NO OK TABLA NAMETABLES. ".mysqli_error($db)." \n";
				
					}
					
	/************* CREAMOS LA TABLA SECCIONES ****************/

	$secciones = "CREATE TABLE `$db_name`.`secciones` (
  `id` int(3) NOT NULL auto_increment,
  `valor` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `nombre` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`,`valor`,`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $secciones)){
		
					global $table8;
					$table8 = "\t* OK TABLA SECCIONES. \n";
			
				} else {
					
					global $table8;
					$table8 = "\t* NO OK TABLA SECCIONES. ".mysqli_error($db)." \n";
				
					}
					
	$vd = "INSERT INTO `$db_name`.`secciones` (`id`, `valor`, `nombre`) VALUES ('0', '', 'SECCIONES')";
		
	if(mysqli_query($db, $vd)){
						
					global $table9;
					$table9 = "\t* OK INIT VALUES EN SECCIONES. \n";

				} else {
										
					global $table9;
					$table9 = "\t* NO OK INIT VALUES EN SECCIONES. ".mysqli_error($db)." \n";
				
					}
					
	/************* CREAMOS LA TABLA GLOBALFEEDSECCION ****************/

	$gfs = "CREATE TABLE `$db_name`.`globalfeedseccion` (
  `id` int(3) NOT NULL auto_increment,
  `valor` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `nombre` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`,`valor`,`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gfs)){

					global $table10;
					$table10 = "\t* OK TABLA GLOBALFEEDSECCION. \n";
			
				} else {
					
					global $table10;
					$table10 = "\t* NO OK TABLA GLOBALFEEDSECCION. ".mysqli_error($db)." \n";
				
					}
					
	/************** CREAMOS LA TABLA GLOBALFEEDSTOCK  ***************/
					
	$gfst = "CREATE TABLE `$db_name`.`globalfeedstock` (
  `id` int(4) NOT NULL auto_increment,
  `vseccion` varchar(22) collate utf8_spanish2_ci NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gfst)){

					global $table11;
					$table11 = "\t* OK TABLA GLOBALFEEDSTOCK. \n";

				} else {
					
					global $table11;
					$table11 = "\t* NO OK TABLA GLOBALFEEDSTOCK. ".mysqli_error($db)."\n";

					}
					
	/************** CREAMOS LA TABLA GLOBALFEEDSTOCKF  ***************/
					
	$gfstf = "CREATE TABLE `$db_name`.`globalfeedstockf` (
  `id` int(4) NOT NULL auto_increment,
  `vseccion` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `nsemana` int(2) NOT NULL,
  `producto` varchar(20) collate utf8_spanish2_ci,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gfstf)){

					global $table12;
					$table12 = "\t* OK TABLA GLOBALFEEDSTOCKF. \n";
					
				} else {
					
					global $table12;
					$table12 = "\t* NO OK TABLA GLOBALFEEDSTOCK. ".mysqli_error($db)."\n";

					}
					
	/************* CREAMOS LA TABLA DE GLOBALFEEDPRO ****************/

	$gfp = "CREATE TABLE `$db_name`.`globalfeedpro` (
  `id` int(4) NOT NULL auto_increment,
  `vseccion` varchar(22) collate utf8_spanish2_ci,
  `valor` varchar(14) collate utf8_spanish2_ci,
  `nombre` varchar(24) collate utf8_spanish2_ci NOT NULL,
  `ref` varchar(14) collate utf8_spanish2_ci NOT NULL DEFAULT 'NO CODE',
  `psiva` decimal(7,2) unsigned NOT NULL,
  `iva` int(2) NOT NULL,
  `ivae` decimal(7,2) unsigned NOT NULL,
  `pvp` decimal(7,2) unsigned NOT NULL,
  `stock` decimal(7,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gfp)){

					global $table13;
					$table13 = "\t* OK TABLA GLOBALFEEDPRO. \n";
					
				} else {
					
					global $table13;
					$table13 = "\t* NO OK TABLA GLOBALFEEDPRO. ".mysqli_error($db)."\n";

					}
					
	/************* CREAMOS LA TABLA DE GLOBALFEEDPROF ****************/

	$gfpf = "CREATE TABLE `$db_name`.`globalfeedprof` (
  `id` int(4) NOT NULL auto_increment,
  `vseccion` varchar(22) collate utf8_spanish2_ci,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gfpf)){

					global $table14;
					$table14 = "\t* OK TABLA GLOBALFEEDPROF. \n";
				} else {
					
					global $table14;
					$table14 = "\t* NO OK TABLA GLOBALFEEDPROF. \n";

					}
					
	/************* CREAMOS LA TABLA VISITAS ****************/

	$visitas = "CREATE TABLE `$db_name`.`visitas` (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	if(mysqli_query($db, $visitas)){
										
					global $table15;
					$table15 = "\t* OK TABLA VISITAS. \n";
			
				} else {
					
					global $table15;
					$table15 = "\t* NO OK TABLA VISITAS. ".mysqli_error($db)." \n";
				
					}
					
	$vd = "INSERT INTO `$db_name`.`visitas` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
(69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
						
			print ("<table align='center'>
									<tr>
										<td>
											<a href='config2.php'>
														CREE EL USUARIO ADMINISTRADOR
											</a>
										</td>
									</tr>
								</table>
										");			
										
					global $table16;
					$table16 = "\t* OK INIT VALUES EN VISITAS. \n";

				} else {
					
					global $table16;
					$table16 = "\t* NO OK INIT VALUES EN VISITAS. ".mysqli_error($db)." \n";
				
					}
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	$visitas = "CREATE TABLE `$db_name`.`visitasadmin` (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	if(mysqli_query($db, $visitas)){
										
					global $table17;
					$table17 = "\t* OK TABLA VISITAS ADMIN. \n";
			
				} else {
					
					global $table17;
					$table17 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db)." \n";
				
					}
					
	$vd = "INSERT INTO `$db_name`.`visitasadmin` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
(69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
						
					global $table18;
					$table18 = "\t* OK INIT VALUES EN VISITAS ADMIN. \n";

				} else {
					
					global $table18;
					$table18 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db)." \n";
				
					}
					
	/************** CREAMOS LA TABLA CAJA  ***************/
					
	$gcj = "CREATE TABLE `$db_name`.`caja` (
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
  `producto` varchar(20) collate utf8_spanish2_ci NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gcj)){

					global $table19;
					$table19 = "\t* OK TABLA CAJA. \n";

				} else {
					
					global $table19;
					$table19 = "\t* NO OK TABLA CAJA. ".mysqli_error($db)."\n";

					}
					
	/************** CREAMOS LA TABLA VENTAS este año  ***************/
					
	$vname = "ventas_".date('Y');
	$vname = "`".$vname."`";
	
	$gcj = "CREATE TABLE `$db_name`.$vname (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gcj)){

					global $table20;
					$table20 = "\t* OK TABLA VENTAS. \n";

				} else {
					
					global $table20;
					$table20 = "\t* NO OK TABLA VENTAS. ".mysqli_error($db)."\n";

					}
					
	/************** CREAMOS LA TABLA VENTAS año anterior  ***************/
					
	$vname = "ventas_".(date('Y')-1);
	$vname = "`".$vname."`";
	
	$gcj2 = "CREATE TABLE `$db_name`.$vname (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $gcj2)){

					global $table21;
					$table21 = "\t* OK TABLA VENTAS. \n";

				} else {
					
					global $table21;
					$table21 = "\t* NO OK TABLA VENTAS. ".mysqli_error($db)."\n";

					}
					
	/************** CREAMOS LA TABLA GASTOS  ***************/

	$vname = "gastos_".date('Y');
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tg)){
					global $table22;
					$table22 = "\t* OK TABLA GASTOS. \n";
				} else {print( "* NO OK TABLA VENTAS. ".mysqli_error($db)."\n");
					global $table22;
					$table22 = "\t* NO OK TABLA GASTOS. ".mysqli_error($db)."\n";
				}
				
	/************** CREAMOS LA TABLA GASTOS del año anterior  ***************/

	$vname = "gastos_".(date('Y')-1);
	$vname = "`".$vname."`";
	
	$tg2 = "CREATE TABLE `$db_name`.$vname (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tg2)){
					global $table23;
					$table23 = "\t* OK TABLA GASTOS. \n";
				} else {print( "* NO OK TABLA VENTAS. ".mysqli_error($db)."\n");
					global $table23;
					$table23 = "\t* NO OK TABLA GASTOS. ".mysqli_error($db)."\n";
				}
				
	/************** CREAMOS LA TABLA PROVEEDORES ***************/
					
	$provee = "CREATE TABLE `$db_name`.`proveedores` (
  `ID` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL,
  `Tlf2` int(9) NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $provee)){
		
					global $table24;
					$table24 = "\t* OK TABLA PROVEEDORES. \n";
			
				} else {
					
					global $table24;
					$table24 = "\t* NO OK TABLA PROVEEDORES. ".mysqli_error($db)." \n";
					
					}
					
	/************** CREAMOS LA TABLA PROVEEDORES FEED ***************/
					
	$proveefeed = "CREATE TABLE `$db_name`.`proveedoresfeed` (
  `ID` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL,
  `Tlf2` int(9) NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $proveefeed )){
		
					global $table25;
					$table25 = "\t* OK TABLA PROVEEDORES FEED. \n";
			
				} else {
					
					global $table25;
					$table25 = "\t* NO OK TABLA PROVEEDORES FEED. ".mysqli_error($db)." \n";
					
					}
					
// CREA EL DIRECTORIO DE IMAGENES.

	$vname2 = "docgastos_".date('Y');
	$carpeta = "../gastos/".$vname2;
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		copy("../gastos/untitled.png", $carpeta."/untitled.png");
		copy("../gastos/pdf.png", $carpeta."/pdf.png");}
		else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");}
	
	$vname3 = "docgastos_".(date('Y')-1);
	$carpeta3 = "../gastos/".$vname3;
	if (!file_exists($carpeta3)) {
		mkdir($carpeta3, 0777, true);
		copy("../gastos/untitled.png", $carpeta3."/untitled.png");
		copy("../gastos/pdf.png", $carpeta3."/pdf.png");}
		else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta3."\n");}
	
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
global $cfone;
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = $cfone."\n - CONFIG INIT ".$datein.".\n * ".$db_name.". \n * ".$db_host.". \n * ".$db_user.". \n * ".$db_pass."\n".$dbconecterror.$table1.$table2.$table3.$table4.$table5.$table6.$table7.$table8.$table9.$table10.$table11.$table12.$table13.$table14.$table15.$table16.$table17.$table18.$table19.$table20.$table21.$table22.$table23.$table24.$table25."\n";
$filename = "../logs/Config/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

	}	

///////////////////////

function modif(){
									   							
	$filename = "ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',";
	$contenido = implode("\n",$contenido);
	
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
}

function modif2(){

	$filename = "year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

function ayear(){
	$filename = "year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){}
	elseif($fget !== date('Y')){ 	modif();
									modif2();
}

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if($_POST['config']){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
														);
								   }
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
		
	print("
	
			<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
					
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
				SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px\">

				<tr>
					<th colspan=2 class='BorderInf'>

							INIT CONFIG DATA
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=200px>
		<input type='text' name='host' size=25 maxlength=22 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td width=200px>
		<input type='text' name='user' size=25 maxlength=22 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td width=200px>
		<input type='text' name='pass' size=25 maxlength=22 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td width=200px>
		<input type='text' name='name' size=25 maxlength=22 value='".$defaults['name']."' />
					</td>
				</tr>
					
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' />
						<input type='hidden' name='config' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>