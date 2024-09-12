<?php 

    global $db;     global $db_name;

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* ADMIN */

    global $Admin;
    $Admin = "`".$_SESSION['clave']."admin`";

    global $VisitasAdmin;
    $VisitasAdmin = "`".$_SESSION['clave']."visitasadmin`";

    global $Feedback;
    $Feedback = "`".$_SESSION['clave']."feedback`";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* VISITAS */

    global $VisitasClientesWeb;
    $VisitasClientesWeb = "`".@$_SESSION['clave']."visitasclientesweb`";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* CLIENTES */

    global $ClientesWeb;
    $ClientesWeb = "`".@$_SESSION['clave']."clientesweb`";

    global $ClientesWebFeedback;
    $ClientesWebFeedback = "`".@$_SESSION['clave']."clienteswebfeed`";

    global $producveedores;
    $producveedores = "`".@$_SESSION['clave']."producveedores`";

    global $producveedoresfeed;
    $producveedoresfeed = "`".@$_SESSION['clave']."producveedoresfeed`";
    
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* CAJA */

    global $CajaShop;
    $CajaShop = "`".@$_SESSION['clave']."cajashop`";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* PRODUCTO / VALOR / SECCIONES */

    global $Productos;
    $Productos = "`".@$_SESSION['clave']."productos`";

    global $ProductosFeed;
    $ProductosFeed = "`".@$_SESSION['clave']."productosfeed`";

    global $valor;
    $valor = "`".@$_SESSION['clave']."valor`";

    global $Secciones;
    $Secciones = "`".@$_SESSION['clave']."secciones`";

	global $SeccionesFeed;
	$SeccionesFeed = "`".@$_SESSION['clave']."seccionesfeed`";

    /*
    global $Stocks;
    $Stocks = "`".$_SESSION['clave']."stocks`";
    
    global $StocksFeed;
    $StocksFeed = "`".$_SESSION['clave']."stocksfeed`";
    */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
    
    global $NameTables;
    $NameTables = "`".$_SESSION['clave']."nametables`";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    global $VentasShop;     global $dyt1;
    $VentasShop = "`".@$_SESSION['clave']."ventasshop_".$dyt1."`";

	//global $modvn;
	//$modvn = "`".@$_SESSION['clave']."ventasshop_".date('Y')."`";

	//global $modvn2;
	//$modvn2 = "`".@$_SESSION['clave']."ventasshop_".(date('Y')-1)."`";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    // OJO
    global $GastosShop;
	$GastosShop = "`".@$_SESSION['clave']."gastosshop_".@$dyt1."`";

    global $GastosShop2;
	$GastosShop2 = "`".@$_SESSION['clave']."gastosshop_".date('Y')."`";

	global $GastosShop3;
	$GastosShop3 = "`".@$_SESSION['clave']."gastosshop_".(date('Y')-1)."`";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    //global $secc;	
	//$secc = "`".@$_SESSION['clave'].@$_POST['seccion']."produc"."`";

    //   global $producto;
    //    $producto = $_SESSION['clave'].@$_POST['seccion']"produc".;
    //    $secc = "`".$producto."`";

    //global $secc1;
    //$secc1 = "`".@$_SESSION['clave'].@$_POST['seccion']."producimg"."`";

    //global $secc2;
    //$secc2 = "`".@$_SESSION['clave'].@$_SESSION['miseccion']."producimg"."`";

    //global $secc3;
    //$secc3 = "`".@$_SESSION['clave'].@$_POST['valor']."producimg"."`";

	//global $seccx;
	//$seccx = "`".@$_SESSION['clave'].@$rowvnt['vseccion']."produc"."`";

	//global $seccx2;
	//$seccx2 = "`".@$_SESSION['clave'].@$_POST['seccion']."produc"."`";

    //global $seccx3;
	//$seccx3 = "`".@$_SESSION['clave'].@$_POST['vseccion']."produc"."`";

    // global $tablaproduc;
	// $tablaproduc = "`".@$_SESSION['clave'].@$_POST['vseccion']."produc"."`";

    // global $tablaproduc2;
	// $tablaproduc2 = "`".@$_SESSION['clave'].@$rowvnt['vseccion']."produc"."`";


    // global $tablafeedproduc;
	// $tablafeedproduc = "`".@$_SESSION['clave'].@$rowvnt['vseccion']."producfeed"."`";

	// global $tablafeedproduc2;
	// $tablafeedproduc2 = "`".@$_SESSION['clave'].@$_POST['seccion']."producfeed"."`";
	// $tablafeedproduc2 = $tablafeedproduc2;

    // global $tablafeedproduc3;
	// $tablafeedproduc3 = "`".@$_SESSION['clave'].@$_POST['vseccion']."producfeed"."`";
    
    //global $sstock;
	//$sstock = "`".@$_SESSION['clave'].@$rowrc['vseccion']."produc"."`";

	//global $Stocks;
	//$Stocks = "`".@$_SESSION['clave'].@$_POST['vseccion']."stock"."`";

	//global $tablastock2;
	//$tablastock2 = "`".@$_SESSION['clave'].@$rowvnt['vseccion']."stock"."`";

	//global $SeccionValor; 
    //global $StockValor;
    //$StockValor = "`".@$_SESSION['clave'].$SeccionValor."stock"."`";
   
	//global $tablastock3;
	//$tablastock3 = "`".@$_SESSION['clave'].@$_POST['seccion']."stock"."`";

    //global $StocksFeed;
    //$StocksFeed = "`".@$_SESSION['clave'].@$_POST['seccion']."feedstock"."`";

    //global $feedtable3;
	//$feedtable3 = "`".@$_SESSION['clave'].$SeccionValor."stockfeed"."`";

    //global $feedtable2;
	//$feedtable2 = "`".@$_SESSION['clave'].@$_POST['valor']."feedproduc"."`";

    //global $feedtable2b;
	//$feedtable2b ="`".@$_SESSION['clave'].@$_POST['valor']."produc"."`";

?>