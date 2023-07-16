<?php 

    global $db;
    global $db_name;

///////////////

/* ADMIN */

    global $gst_admin;
    $gst_admin = "`".$_SESSION['clave']."gst_admin`";

    global $gst_visitasadmin;
    $gst_visitasadmin = "`".$_SESSION['clave']."gst_visitasadmin`";

    global $gst_feedback;
    $gst_feedback = "`".$_SESSION['clave']."gst_feedback`";

    global $gst_globalfeedstock;
    $gst_globalfeedstock = "`".$_SESSION['clave']."gst_globalfeedstock`";

    global $gst_globalfeedstockf;
	$gst_globalfeedstockf = "`".$_SESSION['clave']."gst_globalfeedstockf`";

	global $gst_globalfeedprof;
	$gst_globalfeedprof = "`".$_SESSION['clave']."gst_globalfeedprof`";


    global $gst_nametables;
    $gst_nametables = "`".$_SESSION['clave']."gst_nametables`";

///////////////

/* VISITAS */

    global $gst_visitas;
    $gst_visitas = "`".@$_SESSION['clave']."gst_visitas`";



///////////////

/* CLIENTES */

    global $gst_clientes;
    $gst_clientes = "`".@$_SESSION['clave']."gst_clientes`";


    global $gst_clientesfeedback;
    $gst_clientesfeedback = "`".@$_SESSION['clave']."gst_clientesfeedback`";

    global $gst_proveedores;
    $gst_proveedores = "`".@$_SESSION['clave']."gst_proveedores`";

    global $gst_proveedoresfeed;
    $gst_proveedoresfeed = "`".@$_SESSION['clave']."gst_proveedoresfeed`";

    
///////////////

/* CAJA */

    global $gst_caja;
    $gst_caja = "`".@$_SESSION['clave']."gst_caja`";


///////////////

/* PRODUCTO / VALOR / SECCIONES */

    global $producto;
    $producto = "`".@$_SESSION['clave']."producto`";

    global $valor;
    $valor = "`".@$_SESSION['clave']."valor`";


    global $gst_secciones;
    $gst_secciones = "`".@$_SESSION['clave']."gst_secciones`";



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

	global $gst_globalfeedseccion;
	$gst_globalfeedseccion = "`".@$_SESSION['clave']."gst_globalfeedseccion`";





	global $seccx;
	$seccx = "`".@$_SESSION['clave'].@$rowvnt['vseccion']."`";

	global $seccx2;
	$seccx2 = "`".@$_SESSION['clave'].@$_POST['seccion']."`";

    global $seccx3;
	$seccx3 = "`".@$_SESSION['clave'].@$_POST['vseccion']."`";




    global $gst_ventas;
    $gst_ventas = "`".@$_SESSION['clave']."gst_ventas_".@$dyt1."`";

	global $modvn;
	$modvn = "`".@$_SESSION['clave']."gst_ventas_".date('Y')."`";

	global $modvn2;
	$modvn2 = "`".@$_SESSION['clave']."gst_ventas_".(date('Y')-1)."`";


    // OJO
    global $gst_gastos;
	$gst_gastos = "`".@$_SESSION['clave']."gst_gastos_".@$dyt1."`";

    global $gst_gastos2;
	$gst_gastos2 = "`".@$_SESSION['clave'].'gst_gastos_'.date('Y')."`";

	global $gst_gastos3;
	$gst_gastos3 = "`".@$_SESSION['clave'].'gst_gastos_'.(date('Y')-1)."`";
    
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