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

		if(isset($_POST['oculto2'])){ info_01();
									  show_form();
		}elseif(isset($_POST['oculto'])){	
				// SI NO HA MARCADO PARA BORRAR.
				if(!isset($_POST['xl'])){
					print("<div style='text-align:center; margin:auto;'>
								* HA DE MARCAR LA CASILLA DE CONFIRMACIÓN
							</div>");
						show_form();
				}elseif(isset($_POST['xl'])){
							process_form();
							info_02();
							}
		} else {show_form();}

	} else { require '../Inclu/table_permisos.php'; } 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){

		global $rutPend;	$rutPend = '';
		global $pend;		$pend = "";
		require 'Botonera.php';
		
		require 'FactDate.php';

		global $db; 		global $db_name; 		
		global $dyt1;		$dyt1 = $_POST['dy'];

		require 'FormatNumber.php';

		/////////////
		global $vnamei; 		$vnamei = "`".$_SESSION['clave']."ingresosfeed`";
		global $sent;
		$sent = "INSERT INTO `$db_name`.$vnamei (`factnum`, `factnumini`, `factdate`, `factdateini`, `refcliente`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`, `factcrea`, `factmodif`, `ruta`) VALUES ('$_POST[factnum]', '$_POST[factnumini]', '$factdate', '$_POST[factdateini]', '$_POST[clienteingresos]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1]', '$_SESSION[myimg2]', '$_SESSION[myimg3]', '$_SESSION[myimg4]', '$_POST[factcrea]', '$_POST[factmodif]', '$_POST[delruta]' )";

		if(mysqli_query($db, $sent)){

			global $vname; 		$vname = "`".$_SESSION['clave']."ingresos_".$dyt1."`";
			$sqla = "DELETE FROM `$db_name`.$vname  WHERE $vname.`id` = '$_POST[id]'  ";
			if(mysqli_query($db, $sqla)){
				global $title;			$title = 'SE HA BORRADO EN ';
				global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
				global $Modif2;			$Modif2= "style='display:none; visibility: hidden;'";
				global $ModImg2;		$ModImg2= "style='display:none; visibility: hidden;'";
				global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
				global $Ver2;			$Ver2= "style='display:none; visibility: hidden;'";
				
				global $ConteBotones;	$ConteBotones = "style='display:block;'";
				require 'TableFormResult.php';			
			}else{ print("* ERROR L.56: ".mysqli_error($db));
						show_form ();
						global $texerror; $texerror = "\n\t ".mysqli_error($db);
							}
		}else{
			print("* ERROR L.51: ".mysqli_error($db));
			show_form ();
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}
		
		/*
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Ver.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);
		*/

	} // FIN process_form()
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form(){
	
		global $rutPend;	$rutPend = '';
		global $pend;		$pend = "";
		require 'Botonera.php';
		global $TituloCheck;	$TituloCheck = "CONFIRME EL BORRADO CON EL CHECKBOX";

		global $dyt1;
		
		if(isset($_POST['oculto2'])){

			require 'FunctShowFormOculto2Var.php';

			$sesionref2 = "docingresos_".$dyt1;
			global $DelRuta;		$DelRuta ="../cb23_Docs/".$sesionref2."/";

			global $VarArray;	$VarArray = 1;
			require 'ArrayTotal.php';

	}elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
	}

		////////////////////

		global $titulo; 	$titulo = "ELIMINAR INGRESO";
		global $titInput;	$titInput = "BORRAR INGRESO PENDIENTE";
		global $Borrar2;	$Borrar2= "style='display:none; visibility: hidden;'";

		global $checked;

		if(@$defaults['xl'] == 'yes') { $checked = "checked='checked'";}else{ $checked = ""; }
		
		global $Checkbox;
		$Checkbox = "<tr>
						<td colspan='2' style='text-align:center;' >
							".$TituloCheck." : &nbsp; 
							<input type='checkbox' name='xl' value='yes' ".$checked."/>
						</td>
					</tr>";

		global $rutaDirTr;
		$rutaDirTr ="<tr>
						<td style='text-align: right !important;' >RUTA DIR</td>
						<td>".@$defaults['delruta']."</td>			
					</tr>";

		require 'TableBorrar.php';
		
	} // FIN function show_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_01(){

		global $db;
	
		$TitBut = "\n\tFiltro => \n\tDATE: ".$_POST['factdate'].".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";

		$ActionTime = date('H:i:s');

		global $text;
		$text = "\n- INGRESO SELECCIONADO MODIFICAR ".$ActionTime.$TitBut;
		
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
		$text = "\n- INGRESO MODIFICADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

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