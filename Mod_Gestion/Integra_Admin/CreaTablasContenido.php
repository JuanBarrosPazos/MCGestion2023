<?php

global $db;             global $db_host;        global $db_user;        global $db_pass;
global $db_name;        global $dbconecterror;
 
/************* CREAMOS LA TABLA ADMIN *************/
/************* CREAMOS LA TABLA FEEDBACK *************/
/************* CREAMOS LA TABLA VISITAS ADMIN *************/
/************* CREAMOS LA TABLA IP CONTROL*************/
                
/************* CREAMOS LA TABLA CLIENTES *************/

global $table_name_cl;
$table_name_cl = "`".$_SESSION['clave']."clientes`";

$clientes = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_cl (
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
`Tlf1` int(9) NOT NULL,
`Tlf2` int(9) NOT NULL,
`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL,
`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL,
`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL,
UNIQUE KEY `id` (`id`),
UNIQUE KEY `ref` (`ref`),
UNIQUE KEY `dni` (`dni`),
UNIQUE KEY `Email` (`Email`),
UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
    
if(mysqli_query($db, $clientes)){
         global $table01a;
         $table01a = "\t* OK TABLA CLIENTES MOD GESTION. \n";

        $vc = "INSERT INTO `$db_name`.$table_name_cl (`ref`,`Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES('000000', 'cliente', 'Anonimo', 'Anonimo', 'untitled.png', '000000', '000000', '0', '000000', '', '', '000000', '000000', '000000')";
        
        if(mysqli_query($db, $vc)){
                global $table01b;
                $table01b = "\t* OK INIT VALUES EN CLIENTES MOD GESTION. \n";
        } else { global $table01b;
                $table01b = "\t* NO OK INIT VALUES EN CLIENTES MOD GESTION. ".mysqli_error($db)." \n";
                }

} else { global $table01a;
         $table01a = "\t* NO OK TABLA CLIENTES MOD GESTION. ".mysqli_error($db)." \n";
        }
                
/************* CREAMOS LA TABLA CLIENTES FEEDBACK CLIENTES *************/

global $table_name_fcl;
$table_name_fcl = "`".$_SESSION['clave']."clientesfeedback`";

$feedbackcl = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_fcl (
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
`Tlf1` int(9) NOT NULL,
`Tlf2` int(9) NOT NULL,
`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL,
`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL,
`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL,
`borrado` varchar(22) collate utf8_spanish2_ci NOT NULL,
UNIQUE KEY `id` (`id`),
UNIQUE KEY `ref` (`ref`),
UNIQUE KEY `dni` (`dni`),
UNIQUE KEY `Email` (`Email`),
UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
    
if(mysqli_query($db, $feedbackcl)){
        global $table02;
        $table02 = "\t* OK TABLA CLIENTES FEEDBACK MOD GESTION. \n";
}else{  global $table02;
        $table02 = "\t* NO OK TABLA CLIENTES FEEDBACK MOD GESTION. ".mysqli_error($db)." \n";
        }

/************* CREAMOS LA TABLA VISITAS CLIENTES ****************/

global $table_name_vstb;
$table_name_vstb = "`".$_SESSION['clave']."visitascliente`";
 
$visitasClient = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_vstb (
`idv` int(2) NOT NULL,
`visita` int(10) NOT NULL,
`admin` int(10) NOT NULL,
`deneg` int(10) NOT NULL,
`acceso` int(10) NOT NULL,
PRIMARY KEY  (`idv`)
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
                 
if(mysqli_query($db, $visitasClient)){
        global $table15;
        $table15 = "\t* OK TABLA VISITAS CLIENTES. \n";

        $vd = "INSERT INTO `$db_name`.$table_name_vstb (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES (69, 0, 0, 0, 0)";

        if(mysqli_query($db, $vd)){
                global $table16;
                $table16 = "\t* OK INIT VALUES EN VISITAS. \n";
        } else { global $table16;
                $table16 = "\t* NO OK INIT VALUES EN VISITAS. ".mysqli_error($db)." \n";
                        }
} else { global $table15;
         $table15 = "\t* NO OK TABLA VISITAS CLIENTES. ".mysqli_error($db)." \n";
                }
 
/************* CREAMOS LA TABLA NAMETABLES *************/

global $table_name_ntb;
$table_name_ntb = "`".$_SESSION['clave']."nametables`";

$nametables = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_ntb (
`id` int(3) NOT NULL auto_increment,
`valortabla` varchar(22) collate utf8_spanish2_ci,
`nombreseccion` varchar(22) collate utf8_spanish2_ci NOT NULL,
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`,`valortabla`,`nombreseccion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
    
if(mysqli_query($db, $nametables)){
                global $table03;
                $table03 = "\t* OK TABLA NAMETABLES MOD GESTION. \n";
    } else { global $table03;
             $table03 = "\t* NO OK TABLA NAMETABLES MOD GESTION. ".mysqli_error($db)." \n";
        }
                
/************* CREAMOS LA TABLA SECCIONES *************/

global $table_name_sec;
$table_name_sec = "`".$_SESSION['clave']."secciones`";

$secciones = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_sec (
`id` int(3) NOT NULL auto_increment,
`valor` varchar(22) collate utf8_spanish2_ci NOT NULL,
`nombre` varchar(22) collate utf8_spanish2_ci NOT NULL,
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`,`valor`,`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
    
if(mysqli_query($db, $secciones)){
                global $table04a;
                $table04a = "\t* OK TABLA SECCIONES MOD GESTION. \n";
    } else { global $table04a;
             $table04a = "\t* NO OK TABLA SECCIONES MOD GESTION. ".mysqli_error($db)." \n";
        }
                
$vd = "INSERT INTO `$db_name`.$table_name_sec (`id`, `valor`, `nombre`) VALUES ('0', '', 'SECCIONES')";
    
if(mysqli_query($db, $vd)){
                global $table04b;
                $table04b = "\t* OK INIT VALUES EN SECCIONES MOD GESTION. \n";
    } else { global $table04b;
             $table04b = "\t* NO OK INIT VALUES EN SECCIONES MOD GESTION. ".mysqli_error($db)." \n";
        }
                
/************* CREAMOS LA TABLA GLOBALFEEDSECCION *************/

global $table_name_gfs;
$table_name_gfs = "`".$_SESSION['clave']."globalfeedseccion`";

$gfs = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_gfs (
`id` int(3) NOT NULL auto_increment,
`valor` varchar(22) collate utf8_spanish2_ci NOT NULL,
`nombre` varchar(22) collate utf8_spanish2_ci NOT NULL,
PRIMARY KEY  (`id`),
UNIQUE KEY `id` (`id`,`valor`,`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
    
if(mysqli_query($db, $gfs)){
                global $table05;
                $table05 = "\t* OK TABLA GLOBALFEEDSECCION MOD GESTION. \n";
    } else { global $table05;
             $table05 = "\t* NO OK TABLA GLOBALFEEDSECCION MOD GESTION. ".mysqli_error($db)." \n";
        }
                
/************* CREAMOS LA TABLA GLOBALFEEDSTOCK  *************/

global $table_name_gfst;
$table_name_gfst = "`".$_SESSION['clave']."globalfeedstock`";

$gfst = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_gfst (
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
                global $table06;
                $table06 = "\t* OK TABLA GLOBALFEEDSTOCK MOD GESTION. \n";
    } else { global $table06;
             $table06 = "\t* NO OK TABLA GLOBALFEEDSTOCK MOD GESTION. ".mysqli_error($db)."\n";
        }
                
/************* CREAMOS LA TABLA GLOBALFEEDSTOCKF  *************/

global $table_name_gfstf;
$table_name_gfstf = "`".$_SESSION['clave']."globalfeedstockf`";

$gfstf = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_gfstf (
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
                global $table07;
                $table07 = "\t* OK TABLA GLOBALFEEDSTOCKF MOD GESTION. \n";
    } else { global $table07;
             $table07 = "\t* NO OK TABLA GLOBALFEEDSTOCKF MOD GESTION. ".mysqli_error($db)."\n";
        }
                
/************* CREAMOS LA TABLA DE GLOBALFEEDPRO *************/

global $table_name_gfp;
$table_name_gfp = "`".$_SESSION['clave']."globalfeedpro`";

$gfp = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_gfp (
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
                global $table08;
                $table08 = "\t* OK TABLA GLOBALFEEDPRO MOD GESTION. \n";
    } else { global $table08;
             $table08 = "\t* NO OK TABLA GLOBALFEEDPRO MOD GESTION. ".mysqli_error($db)."\n";
        }
                
/************* CREAMOS LA TABLA DE GLOBALFEEDPROF *************/

global $table_name_gfpf;
$table_name_gfpf = "`".$_SESSION['clave']."globalfeedprof`";

$gfpf = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_gfpf (
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
                global $table09;
                $table09 = "\t* OK TABLA GLOBALFEEDPROF MOD GESTION. \n";
    } else { global $table09;
             $table09 = "\t* NO OK TABLA GLOBALFEEDPROF MOD GESTION. \n";
        }
                
/************* CREAMOS LA TABLA CAJA  *************/

global $table_name_gcj;
$table_name_gcj = "`".$_SESSION['clave']."caja`";

$gcj = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_gcj (
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
                global $table10;
                $table10 = "\t* OK TABLA CAJA. \n";
    } else { global $table10;
             $table10 = "\t* NO OK TABLA CAJA. ".mysqli_error($db)."\n";
        }
                
/************* CREAMOS LA TABLA VENTAS este año  *************/

global $vname;
$vname = $_SESSION['clave']."ventas_".date('Y');
$vname = "`".$vname."`";

$gcj = "CREATE TABLE IF NOT EXISTS `$db_name`.$vname (
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
                global $table11;
                $table11 = "\t* OK TABLA VENTAS MOD GESTION. \n";
    } else { global $table11;
             $table11 = "\t* NO OK TABLA VENTAS MOD GESTION. ".mysqli_error($db)."\n";
        }
                
/************* CREAMOS LA TABLA VENTAS año anterior  *************/

global $vname;
$vname = $_SESSION['clave']."ventas_".(date('Y')-1);
$vname = "`".$vname."`";

$gcj2 = "CREATE TABLE IF NOT EXISTS `$db_name`.$vname (
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
                global $table12;
                $table12 = "\t* OK TABLA VENTAS. \n";
    } else { global $table12;
             $table12 = "\t* NO OK TABLA VENTAS. ".mysqli_error($db)."\n";
        }
                
/************* CREAMOS LA TABLA GASTOS  *************/

global $vname;
$vname = $_SESSION['clave']."gastos_".date('Y');
$vname = "`".$vname."`";

$tg = "CREATE TABLE IF NOT EXISTS `$db_name`.$vname (
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
                global $table13;
                $table13 = "\t* OK TABLA GASTOS MOD GESTION. \n";
    } else { global $table13;
             $table13 = "\t* NO OK TABLA GASTOS MOD GESTION. ".mysqli_error($db)."\n";
        }
            
/************** CREAMOS LA TABLA GASTOS del año anterior  *************/

global $vname;
$vname = $_SESSION['clave']."gastos_".(date('Y')-1);
$vname = "`".$vname."`";

$tg2 = "CREATE TABLE IF NOT EXISTS `$db_name`.$vname (
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
                global $table14;
                $table14 = "\t* OK TABLA GASTOS -1 MOD GESTION. \n";
    } else { global $table14;
             $table14 = "\t* NO OK TABLA GASTOS -1 MOD GESTION. ".mysqli_error($db)."\n";
        }
            
/************* CREAMOS LA TABLA PROVEEDORES *************/

global $table_name_prv;
$table_name_prv = "`".$_SESSION['clave']."proveedores`";

$provee = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_prv (
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
                global $table15;
                $table15 = "\t* OK TABLA PROVEEDORES MOD GESTION. \n";
    } else { global $table15;
             $table15 = "\t* NO OK TABLA PROVEEDORES MOD GESTION. ".mysqli_error($db)." \n";
        }
                
/************* CREAMOS LA TABLA PROVEEDORES FEED *************/

global $table_name_prvf;
$table_name_prvf = "`".$_SESSION['clave']."proveedoresfeed`";

$proveefeed = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_prvf (
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
                global $table16;
                $table16 = "\t* OK TABLA PROVEEDORES FEED MOD GESTION. \n";
    } else { global $table16;
             $table16 = "\t* NO OK TABLA PROVEEDORES FEED MOD GESTION. ".mysqli_error($db)." \n";
        }
                
// CREA EL DIRECTORIO DE IMAGENES.

        $vname2 = "docgastos_".date('Y');
        $carpeta = "../Mod_Gestion/gastos/".$vname2;
        if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
        copy("../Mod_Gestion/gastos/untitled.png", $carpeta."/untitled.png");
        copy("../Mod_Gestion/gastos/pdf.png", $carpeta."/pdf.png");}
        else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");}

        $vname3 = "docgastos_".(date('Y')-1);
        $carpeta3 = "../Mod_Gestion/gastos/".$vname3;
        if (!file_exists($carpeta3)) {
        mkdir($carpeta3, 0777, true);
        copy("../Mod_Gestion/gastos/untitled.png", $carpeta3."/untitled.png");
        copy("../Mod_Gestion/gastos/pdf.png", $carpeta3."/pdf.png");}
        else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta3."\n");}

/*************	PASAMOS LOS PARAMETROS A .LOG	*************/

global $text;
$text = PHP_EOL."\n - CONFIG INIT GESTION ".$datein.".\n * ".$db_name.". \n * ".$db_host.". \n * ".$db_user.". \n * ".$db_pass."\n".$dbconecterror.$table01a.$table01b.$table02.$table03.$table04a.$table04b.$table06.$table05.$table06.$table07.$table08.$table09.$table10.$table11.$table12.$table13.$table14.$table15.$table16."\n";

?>
