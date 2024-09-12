<?php

	/* ******* 	GRABAMOS LA SECCION EN LA TABLA SECCIONES	******** */

	//global $valor; 		$valor = $_POST['valor'];
	//global $nombre;		$nombre = $_POST['nombre'];

	require "../config/TablesNames.php";
	$sql = "INSERT INTO `$db_name`.$Secciones (`valor`, `nombre`) VALUES ('$SeccionValor', '$SeccionNombre')";
		
    global $tx1;
    if(mysqli_query($db, $sql)){
            $tx1 ="\n\t* HA CREADO LA SECCION ".$_POST['nombre']." / ".$_POST['valor']."";
		    print( $tabla );
	}else{  print("* ERROR SQL L.14 ".mysqli_error($db))."</br>";
			$tx1 = "\n\t*ERROR SQL L.14: ".mysqli_error($db);	
				}

	/************** CREAMOS LA TABLA STOCK E INSERTAMOS DATOS INICIALES **************
					
	global $nombre1;    $nombre1 = $_SESSION['clave'].$_POST['nombre']."STOCK";
	//$valor1 = $_SESSION['clave'].$_POST['valor']."stock";

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
  `stock` decimal(7,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	global $tx2;
	if(mysqli_query($db, $sql1)){
	        $tx2 = "\n\t* HA CREADO LA TABLA ".$nombre1;
	}else{  print("* ERROR SQL L.27 ".mysqli_error($db))."</br>";
			$tx2 = "\n\t* ERROR SQL L.27: ".mysqli_error($db);					
				}

	global $nombre1b;   $nombre1b = $_POST['nombre']."STOCK";

	require "../config/TablesNames.php";

	$sql1c = "INSERT INTO `$db_name`.$NameTables (`valortabla`, `nombreseccion`) VALUES ('$StockValor', '$nombre1b')";
		
    global $tx3;
    if(mysqli_query($db, $sql1c)){
            $tx3 = "\n\t* HA GRABADO EN NAMETABLES ".$nombre1b;
	}else{	print("* ERROR SQL L.60 ".mysqli_error($db))."</br>";
			$tx3 = "\n\t* ERROR SQL L.60: ".mysqli_error($db);	
				}
*/					
	/************* CREAMOS LA TABLA FEEDBACK DE STOCKS ***************

	global $name2;  $name2 = $_SESSION['clave'].$_POST['nombre']."FEEDSTOCK";
	//$value2 = $_SESSION['clave'].$_POST['valor']."feed";

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
  `stock` decimal(7,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `borrado` varchar(22) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	global $tx4;
	if(mysqli_query($db, $sql2)){
            $tx4 = "\n\t* HA CREADO LA TABLA ".$name2;
	}else{  print("* ERROR SQL L.76 ".mysqli_error($db))."</br>";
			$tx4 = "\n\t* ERROR SQL L.76: ".mysqli_error($db);					
				}
					
	global $name2b;     $name2b = $_POST['nombre']." FEED";

	require "../config/TablesNames.php";

	$sql2c = "INSERT INTO `$db_name`.$NameTables (`valortabla`, `nombreseccion`) VALUES ('$feedtable3', '$name2b')";
		
	global $tx5;
	if(mysqli_query($db, $sql2c)){
			$tx5 = "\n\t* HA GRABADO EN NAMETABLES ".$name2b;
	}else{  print("* L.110 ".mysqli_error($db))."</br>";
			$tx5 = "\n\t* ERROR SQL L.110: ".mysqli_error($db);	
				}
*/					
	/************* CREAMOS LA TABLA DE VALORES Y VARIABLES DE PRODUCTOS ***************

	global $name3;      $name3 = $_SESSION['clave'].$_POST['nombre']."PRODUCT";
	//$value3 = $_SESSION['clave'].$_POST['valor']."product";
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
		
	global $tx6;	
    if(mysqli_query($db, $sql3)){
            $tx6 = "\n\t* HA CREADO LA TABLA ".$name3;
	}else{  print("* ERROR SQL L.127 ".mysqli_error($db))."</br>";
			$tx6 = "\n\t* ERROR SQL L.127: ".mysqli_error($db);					
				}
				
	require "../config/TablesNames.php";

	$sql3b = "INSERT INTO `$db_name`.$feedtable2b (`id`, `valor`, `nombre`, `ref`, `stock`, `coment`) VALUES (1, '', 'PRODUCTOS $prod3', 'A1234567890', '00.00', 'Init Values')";
		
	global $tx7;
	if(mysqli_query($db, $sql3b)){
            $tx7 = "\n\t* HA GRABADO INIT VALUES ".$name3;
	}else{  print("* ERROR SQL L.151 ".mysqli_error($db))."</br>";
			$tx7 = "\n\t* ERROR SQL L.151: ".mysqli_error($db);	
				}

	global $name3b;     $name3b = $_POST['nombre']." PRO";

	require "../config/TablesNames.php";

	$sql3b = "INSERT INTO `$db_name`.$NameTables (`valortabla`, `nombreseccion`) VALUES ('$feedtable2b', '$name3b')";
		
	global $tx8;	
    if(mysqli_query($db, $sql3b)){
            $tx8 = "\n\t* HA GRABADO EN NAMETABLES ".$name3b;
	}else{  print("* ERROR SQL ERROR SQL L.164 ".mysqli_error($db))."</br>";
			$tx8 = "\n\t* ERROR SQL L.164: ".mysqli_error($db);	
				}
*/
	/************* CREAMOS LA TABLA DE PRODUCTOS FEEDBACK ***************

	global $name4;      $name4 = $_SESSION['clave'].$_POST['nombre']."FEEDPRODUCT";
	//$value4 = $_SESSION['clave'].$_POST['valor']."feedproduct";
	$prod4 = $_POST['nombre'];

	require "../config/TablesNames.php";

	$sql4 = "CREATE TABLE IF NOT EXISTS `$db_name`.$feedtable2 (
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
		
	global $tx9;	
    if(mysqli_query($db, $sql4)){
            $tx9 = "\n\t* HA CREADO LA TABLA ".$name4;
	}else{  print("* ERROR SQL L.181 ".mysqli_error($db))."</br>";
			$tx9 = "\n\t* ERROR SQL L.181: ".mysqli_error($db);					
					}
*/
/*
	require "../config/TablesNames.php";

	$sql4b = "INSERT INTO `$db_name`.$feedtable2 (`id`, `valor`, `nombre`, `ref`, `stock`, `coment`, `borrado`) VALUES (0, '', 'FEED PRO $prod4', 'A1234567890', '00.00', 'Init Values', '1900-10-10' )";
		
	global $tx10;	
    if(mysqli_query($db, $sql4b)){
            $tx10 = "\n\t* HA GRABADO INIT VALUES ".$name4;
	}else{  print("* ERROR SQL L.206 ".mysqli_error($db))."</br>";
			$tx10 = "\n\t* ERROR SQL L.206: ".mysqli_error($db);	
				}

	global $name4b;     $name4b = $_POST['nombre']." FEED PRODUCT";

	require "../config/TablesNames.php";

	$sql3b = "INSERT INTO `$db_name`.$NameTables (`valortabla`, `nombreseccion`) VALUES ('$feedtable2', '$name4b')";
		
	global $tx11;
    if(mysqli_query($db, $sql3b)){
			$tx11 = "\n\t* HA GRABADO EN NAMETABLES ".$name4b;
	}else{  print("* ERROR SQL L.219 ".mysqli_error($db))."</br>";
			$tx11 = "\n\t* ERROR SQL L.219: ".mysqli_error($db);	
				}
*/				
	/************* CREAMOS LA TABLA DE IMAGENES PRODUCTOS ***************

	$name5 = $_SESSION['clave'].$_POST['nombre']."IMGPRODUCT";
	//$value5 = $_SESSION['clave'].$_POST['valor']."imgproduct";
	global $prod5;      $prod5 = "imgpro".$_POST['valor'];

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
		
	global $tx12;
    if(mysqli_query($db, $sql5)){
            $tx12 = "\n\t* HA CREADO LA TABLA ".$name5;
	}else{  print("* ERROR SQL L.236 ".mysqli_error($db))."</br>";
			$tx12 = "* ERROR SQL L.236: ".mysqli_error($db);					
				}
*/					
// CREA EL DIRECTORIO DE IMAGENES.

    global $carpeta;    $carpeta = "../imgpro/imgpro".$SeccionValor;
    global $tx13;	
    if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
            $tx13 = "\n\t* HA CREADO EL DIRECTORIO ".$carpeta."/";
            copy("../imgpro/untitled.png", $carpeta."/untitled.png");
    } else{ print("* NO HA CREADO EL DIRECTORIO ".$carpeta."<br>");
            $tx13 = "\n\t* NO HA CREADO EL DIRECTORIO ".$carpeta."/";
                    }

	global $tx;
	$tx = $tx1./*$tx2.$tx3.$tx4.$tx5.$tx6.$tx7.$tx8.$tx9.$tx10.$tx11.$tx12.*/$tx13;

?>