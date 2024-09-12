<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if(isset($_POST['oculto2'])){	info_01();
										show_form();
		} elseif(isset($_POST['oculto'])){
				// SI NO HA COBRADO LA FACTURA.
				if(!isset($_POST['xl'])){
						print("<div style='text-align:center; margin:auto;'>
									* HA DE MARCAR LA CASILLA DE CONFIRMACIÓN
								</div>");
							show_form();
				}elseif(isset($_POST['xl'])){
							//print("* SI SELECCIONADO");
							process_form_2();
									}
		}else{show_form();}
							
	}else{ require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form_2(){
	
		global $db; 			global $db_name;
		global $vname; 			global $dyt1;		$dyt1 = $_SESSION['dyt1'];
		
		global $rutaOld;		$rutaOld = "../cb23_Docs/docingresos_".$_SESSION['dyt1']."/";
		global $rutaNew;		$rutaNew  = "../cb23_Docs/docingresos_pendientes/";
		
		global $vnamei; 		$vnamei = "`".$_SESSION['clave']."ingresos_pendientes`";
		global $vnamed; 		$vnamed = "`".$_SESSION['clave']."ingresos_".$_SESSION['dyt1']."`";

		global $rutPend;	$rutPend = '';
		global $pend;	$pend = "";
		require 'Botonera.php';
		global $title;			$title = 'SE HA INSERTADO LA FACTURA EN ';

		require 'FactDate.php';
		require 'FormatNumber.php';
		
		require 'Modificar03FunctProcessForm2.php';

		/*
			global $dyx; 		$dyx = $_POST['dy'];
			global $dmx; 		$dmx = "M".$_POST['dm'];

			global $mes;
			if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
			elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
			elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
			elseif(($dmx == "10")||($dmx == "11")||($dmx == "12")){$mes = "TRI4";}
		*/
	
	} // FIN process_form_2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){

		global $db; 	global $db_name;

		global $rutPend;	$rutPend = '';
		global $pend;	$pend = "";
		require 'Botonera.php';
		global $titulo; 		$titulo = "MARCAR COMO NO PAGADO ESTE INGRESO";
		global $titInput;		$titInput = "GUARDAR COMO INGRESO PENDIENTE DE PAGO";
		global $TituloCheck;	$TituloCheck = "SI NO SE HA PAGADO LA FACTURA MARQUE LA CASILLA";

		if(isset($_POST['oculto2'])){ $_SESSION['yold'] = substr($_POST['factdate'],0,4); }else{ }

		global $rutaOld;		$rutaOld = "../cb23_Docs/docingresos_".$_SESSION['yold']."/";
		//echo "* ".$rutaOld."<br>";
		global $rutaDir; 	$rutaDir = $rutaOld;
		
		require 'Modificar03FunctShowForm.php';

	} // FIN function show_form($errors=[])

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_01(){

		global $db;
		
		$TitBut = "\n\tFiltro => \n\tDATE: ".$_POST['factdate'].".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";

		$ActionTime = date('H:i:s');

		global $text;
		$text = "\n- INGRESO PENDIENTE MODIFICAR SELECCIONADO FACTURA PAGADA ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
		require 'WriteLog.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_02(){

	global $db; 		global $factivae;
	global $factpvp; 	global $factpvptot; 	global $factdate;

	$ActionTime = date('H:i:s');

	global $text;
	$text = "\n- INGRESO PENDIENTE MODIFICADO FACTURA PAGADA ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);

		require 'WriteLog.php';


	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaIngresos;	$rutaIngresos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	 require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>