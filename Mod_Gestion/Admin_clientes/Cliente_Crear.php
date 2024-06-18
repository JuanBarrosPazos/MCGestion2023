<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require "../config/TablesNames.php";
	/*
	$sqld =  "SELECT * FROM $clientes WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);
	*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){
			print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
			master_index();
		if(isset($_POST['oculto'])){
				if($form_errors = validate_form()){ 
					show_form($form_errors);
					} else { process_form();
							 accion_admin_crear();
								}
						} else { show_form(); }
		} else { 					require "../Inclu/AccesoDenegado.php";			

								
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;
	
		require 'validate.php';	

		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
		require "UserRefCrea.php";

		global $safe_filename;
		$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
		$safe_filename = trim(str_replace('..', '', $safe_filename));

		//$imgNombre = $_FILES['myimg']['name'];
		//$imgNombre_tmp = $_FILES['myimg']['tmp_name'];
		//$imgTipo = $_FILES['myimg']['type'];
		//$imgTamano = $_FILES['myimg']['size'];
		  
		global $destination_file;
		$destination_file = 'img_cliente/'.$safe_filename;
		
		// RENOMBRA LA IMAGEN
		// EXTRAIGO LA EXTENSION
			global $extension;
			$extension = substr($_FILES['myimg']['name'],-3);
			if(($extension == "peg")||($extension == "PEG")){
				$extension = substr($_FILES['myimg']['name'],-4);
			} else { }

		// print($extension);
		// [DEPECRATED] => $extension = end(explode('.', $_FILES['myimg']['name']) );
			date('H:i:s');
			date('Y_m_d');
			global $dt;
			$dt = date('is');

		global $imgNewName;
		$imgNewName = $rf."_".$dt.".".$extension;

		global $rename_filename;
		$rename_filename = "img_cliente/".$imgNewName;	
		//rename($destination_file, $rename_filename);

/**************************************/
	global $titulo;
	$titulo = "SE HA REGISTRADO COMO ADMISTRADOR";
	global $rutImg;
	$rutImg = "img_cliente/"; 
	global $safe_filename;
	$safe_filename = $imgNewName;
	global $tabla;

	require "UserTablaCrea.php";	

	if(file_exists($destination_file)){
		print("<br><font color='#FF0000'>**</font> LA IMAGEN ".$destination_file." YA EXISTE, SERÁ BORRADA</br>");
		// BORRA LA IMAGEN ORIGINAL SI EXISTE ['img_cliente/'.$safe_filename;]
		unlink($destination_file);
		show_form();
	} else {

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	require "../config/TablesNames.php";

	$sql = "INSERT INTO `$db_name`.$clientes (`ref`,`Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$imgNewName', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
	if(mysqli_query($db, $sql)){

		global $destination_file;
		move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file);
		global $tabla;
		print( $tabla );
		global $rename_filename;
		rename($destination_file, $rename_filename);

		if(!file_exists($rename_filename)){ print("NO SE HA PODIDO GUARDAR EN ".$rename_filename);
		}else{ /*print ("LA IMAGEN SE HA GUARDADO OK...");*/ }

		} else { print("</br><font color='#FF0000'>* MODIFIQUE L.117 </font></br> ".mysqli_error($db))."</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
					}
			}
			
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'Nombre' => '',
									'Apellidos' => '',
									'myimg' => @$_POST['myimg'],	
									'Nivel' => '',
									'ref' => '',
									'doc' => '',
									'dni' => '',
									'ldni' => '',
									'Email' => 'Solo letras minúsculas',
									'Usuario' => '',
									'Usuario2' => '',
									'Password' => '',
									'Password2' => '',
									'Direccion' => '',
									'Tlf1' => '',
									'Tlf2' => '');
								   }
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
		 
		global $ArrayCliente;
		$ArrayCliente = 1;
		require "ArrayTotal.php";

		require "UserRefCrea.php";

		global $textit;
		$textit = "DATOS DEL NUEVO ADMINISTRADOR";

		require "UserFormCrea.php";
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu/Master_Index_Clientes.php';
		
		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function accion_admin_crear(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $rf;
	global $texerror;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

	global $text;
	if ($nombre == ''){$text = "- ERROR LA IMAGEN YA EXISTE";}
	else{$text = "- ADMIN CREAR ".$ActionTime.". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];			
	}

	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror."\n";
	$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>
