<?php 

    global $db;
    global $db_name;

///////////////

/* ADMIN */

    global $admin;
    $admin = "`".$_SESSION['clave']."admin`";

    global $visitasadmin;
    $visitasadmin = "`".$_SESSION['clave']."visitasadmin`";

    global $feedback;
    $feedback = "`".$_SESSION['clave']."feedback`";

    global $globalfeedstock;
    $globalfeedstock = "`".$_SESSION['clave']."globalfeedstock`";

    global $globalfeedstockf;
	$globalfeedstockf = "`".$_SESSION['clave']."globalfeedstockf`";

	global $globalfeedprof;
	$globalfeedprof = "`".$_SESSION['clave']."globalfeedprof`";


    global $nametables;
    $nametables = "`".$_SESSION['clave']."nametables`";

///////////////

/* VISITAS */

    global $visitasClient;
    $visitasClient = "`".@$_SESSION['clave']."visitascliente`";


///////////////

/* CLIENTES */

    global $clientes;
    $clientes = "`".@$_SESSION['clave']."clientes`";


    global $clientesfeedback;
    $clientesfeedback = "`".@$_SESSION['clave']."clientesfeedback`";

    global $proveedores;
    $proveedores = "`".@$_SESSION['clave']."proveedores`";

    global $proveedoresfeed;
    $proveedoresfeed = "`".@$_SESSION['clave']."proveedoresfeed`";

    
///////////////

/* CAJA */

    global $caja;
    $caja = "`".@$_SESSION['clave']."caja`";


///////////////

/* PRODUCTO / VALOR / SECCIONES */

    global $producto;
    $producto = "`".@$_SESSION['clave']."producto`";

    global $valor;
    $valor = "`".@$_SESSION['clave']."valor`";


    global $secciones;
    $secciones = "`".@$_SESSION['clave']."secciones`";



    global $secc;	
	$secc = "`".@$_SESSION['clave']."pro".@$_POST['seccion']."`";

    global $tablapro3;
	$tablapro3 = "`".@$_SESSION['clave']."pro".@$_POST['seccion']."`";

    /*
        global $producto;
        $producto = $_SESSION['clave']."pro".@$_POST['seccion'];
        $secc = "`".$producto."`";
    */
 

    global $secc1;
    $secc1 = "`".@$_SESSION['clave']."imgpro".@$_POST['seccion']."`";

    global $secc2;
    $secc2 = "`".@$_SESSION['clave']."imgpro".@$_SESSION['miseccion']."`";

    global $secc3;
    $secc3 = "`".@$_SESSION['clave']."imgpro".@$_POST['valor']."`";

	global $globalfeedseccion;
	$globalfeedseccion = "`".@$_SESSION['clave']."globalfeedseccion`";





	global $seccx;
	$seccx = "`".@$_SESSION['clave'].@$rowvnt['vseccion']."`";

	global $seccx2;
	$seccx2 = "`".@$_SESSION['clave'].@$_POST['seccion']."`";

    global $seccx3;
	$seccx3 = "`".@$_SESSION['clave'].@$_POST['vseccion']."`";




    global $ventas;
    $ventas = "`".@$_SESSION['clave']."ventas_".@$dyt1."`";

	global $modvn;
	$modvn = "`".@$_SESSION['clave']."ventas_".date('Y')."`";

	global $modvn2;
	$modvn2 = "`".@$_SESSION['clave']."ventas_".(date('Y')-1)."`";


    // OJO
    global $gastos;
	$gastos = "`".@$_SESSION['clave']."gastos_".@$dyt1."`";

    global $gastos2;
	$gastos2 = "`".@$_SESSION['clave'].'gastos_'.date('Y')."`";

	global $gastos3;
	$gastos3 = "`".@$_SESSION['clave'].'gastos_'.(date('Y')-1)."`";
    
    //

    global $tablapro;
	$tablapro = "`".@$_SESSION['clave']."pro".@$_POST['vseccion']."`";

    global $tablapro2;
	$tablapro2 = "`".@$_SESSION['clave']."pro".@$rowvnt['vseccion']."`";


    global $tablafeedpro;
	$tablafeedpro = "`".@$_SESSION['clave']."feedpro".@$rowvnt['vseccion']."`";

	global $tablafeedpro2;
	$tablafeedpro2 = "`".@$_SESSION['clave']."feedpro".@$_POST['seccion']."`";
	$tablafeedpro2 = $tablafeedpro2;

    global $tablafeedpro3;
	$tablafeedpro3 = "`".@$_SESSION['clave']."feedpro".@$_POST['vseccion']."`";




    global $sstock;
	$sstock = "`".@$_SESSION['clave']."pro".@$rowrc['vseccion']."`";

	global $tablastock;
	$tablastock = "`".@$_SESSION['clave']."stock".@$_POST['vseccion']."`";

	global $tablastock2;
	$tablastock2 = "`".@$_SESSION['clave']."stock".@$rowvnt['vseccion']."`";

    global $StockValor;
    $StockValor = "`".@$_SESSION['clave']."stock".@$_POST['valor']."`";

   
	global $tablastock3;
	$tablastock3 = "`".@$_SESSION['clave']."stock".@$_POST['seccion']."`";

    global $feedtable;
    $feedtable = "`".@$_SESSION['clave']."feed".@$_POST['seccion']."`";

    global $feedtable3;
	$feedtable3 = "`".@$_SESSION['clave']."feed".@$_POST['valor']."`";

    global $feedtable2;
	$feedtable2 = "`".@$_SESSION['clave']."feedpro".@$_POST['valor']."`";

    global $feedtable2b;
	$feedtable2b ="`".@$_SESSION['clave']."pro".@$_POST['valor']."`";



///////////////



?>