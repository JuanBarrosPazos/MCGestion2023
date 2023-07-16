<?php

    global $db;	
    global $db_host;
    global $db_user;
    global $db_pass;
    global $db_name;
    global $dbconecterror;

		/************** CREAMOS LA TABLA ADMIN ***************/
	
	global $table_name_ad;
	$table_name_ad = "`".$_SESSION['clave']."gst_admin`";

	$admin = "CREATE TABLE `$db_name`.$table_name_ad (
  `id` int(4) NOT NULL auto_increment,
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
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
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
					
	/************* CREAMOS LA TABLA FEEDBACK ****************/

	global $table_name_fed;
	$table_name_fed = "`".$_SESSION['clave']."gst_feedback`";

	$feedback = "CREATE TABLE `$db_name`.$table_name_fed (
  `id` int(4) NOT NULL auto_increment,
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
	`Tlf1`varchar(9) NOT NULL default '0',
	`Tlf2`varchar(9) NOT NULL default '0',
	`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
	`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
	`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
	`borrado` varchar(22) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
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
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	global $table_name_vst;
	$table_name_vst = "`".$_SESSION['clave']."gst_visitasadmin`";

	$visitas = "CREATE TABLE `$db_name`.$table_name_vst (
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


    $vd = "INSERT INTO `$db_name`.$table_name_vst (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES (69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
					global $table18;
					$table18 = "\t* OK INIT VALUES EN VISITAS ADMIN. \n";
      } else { global $table18;
					     $table18 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db)." \n";
				}
					
	/************* CREAMOS LA TABLA VISITAS ****************/

	global $table_name_vstb;
	$table_name_vstb = "`".$_SESSION['clave']."gst_visitas`";

	$visitas = "CREATE TABLE `$db_name`.$table_name_vstb (
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

    $vd = "INSERT INTO `$db_name`.$table_name_vstb (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES (69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
						
			print ("<table align='center'>
									<tr>
										<td>
											<a href='config/config2.php'>
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
					
	/************** CREAMOS LA TABLA CLIENTES ***************/

	global $table_name_cl;
	$table_name_cl = "`".$_SESSION['clave']."gst_clientes`";

	$admin = "CREATE TABLE `$db_name`.$table_name_cl (
  `id` int(4) NOT NULL auto_increment,
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
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
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
	
    $vc = "INSERT INTO `$db_name`.$table_name_cl (`ref`,`Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES('000000', 'cliente', 'Anonimo', 'Anonimo', 'untitled.png', '000000', '000000', '0', '000000', '', '', '000000', '000000', '000000')";
		
	if(mysqli_query($db, $vc)){
						
					global $table3;
					$table3 = "\t* OK INIT VALUES EN CLIENTES. \n";

				} else {
					
					global $table3;
					$table3 = "\t* NO OK INIT VALUES EN CLIENTES. ".mysqli_error($db)." \n";
				
					}
					
	/************* CREAMOS LA TABLA CLIENTES FEEDBACK ****************/

	global $table_name_clf;
	$table_name_clf = "`".$_SESSION['clave']."gst_clientesfeedback`";
	
	$feedback = "CREATE TABLE `$db_name`.$table_name_clf (
  `id` int(4) NOT NULL auto_increment,
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
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  `borrado` varchar(22) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
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

	global $table_name_nt;
	$table_name_nt= "`".$_SESSION['clave']."gst_nametables`";

	$nametables = "CREATE TABLE `$db_name`.$table_name_nt (
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

	global $table_name_sec;
	$table_name_sec = "`".$_SESSION['clave']."gst_secciones`";

	$secciones = "CREATE TABLE `$db_name`.$table_name_sec (
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

      $vd = "INSERT INTO `$db_name`.$table_name_sec (`id`, `valor`, `nombre`) VALUES ('0', '', 'SECCIONES')";
		
    if(mysqli_query($db, $vd)){
						
					global $table9;
					$table9 = "\t* OK INIT VALUES EN SECCIONES. \n";

				} else {
										
					global $table9;
					$table9 = "\t* NO OK INIT VALUES EN SECCIONES. ".mysqli_error($db)." \n";
				
					}
					
	/************* CREAMOS LA TABLA GLOBALFEEDSECCION ****************/

	global $table_name_gfs;
	$table_name_gfs = "`".$_SESSION['clave']."gst_globalfeedseccion`";

	$gfs = "CREATE TABLE `$db_name`.$table_name_gfs (
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

	global $table_name_gfst;
	$table_name_gfst = "`".$_SESSION['clave']."gst_globalfeedstock`";

	$gfst = "CREATE TABLE `$db_name`.$table_name_gfst (
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

	global $table_name_gfstb;
	$table_name_gfstb = "`".$_SESSION['clave']."gst_globalfeedstockf`";

	$gfstf = "CREATE TABLE `$db_name`.$table_name_gfstb (
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

	global $table_name_gfp;
	$table_name_gfp = "`".$_SESSION['clave']."gst_globalfeedpro`";

	$gfp = "CREATE TABLE `$db_name`.$table_name_gfp  (
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

	global $table_name_gfpf;
	$table_name_gfpf = "`".$_SESSION['clave']."gst_globalfeedprof`";

	$gfpf = "CREATE TABLE `$db_name`.$table_name_gfpf (
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
					
	/************** CREAMOS LA TABLA CAJA  ***************/

	global $table_name_cj;
	$table_name_cj = "`".$_SESSION['clave']."gst_caja`";

	$gcj = "CREATE TABLE `$db_name`.$table_name_cj (
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
					
	$vname = $_SESSION['clave']."gst_ventas_".date('Y');
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
					
	$vname = $_SESSION['clave']."gst_ventas_".(date('Y')-1);
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

	$vname = $_SESSION['clave']."gst_gastos_".date('Y');
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

	$vname = $_SESSION['clave']."gst_gastos_".(date('Y')-1);
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

	global $table_name_pro;
	$table_name_pro = "`".$_SESSION['clave']."gst_proveedores`";

	$provee = "CREATE TABLE `$db_name`.$table_name_pro (
  `id` int(4) NOT NULL auto_increment,
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
  UNIQUE KEY `id` (`id`),
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

	global $table_name_prf;
	$table_name_prf = "`".$_SESSION['clave']."gst_proveedoresfeed`";

	$proveefeed = "CREATE TABLE `$db_name`.$table_name_prf (
  `id` int(4) NOT NULL auto_increment,
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
  UNIQUE KEY `id` (`id`),
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


?>