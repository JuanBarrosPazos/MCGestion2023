
<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $gst_clientes WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
if ($_SESSION['Nivel'] == 'admin'){
		print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
		master_index();
			if (isset($_POST['oculto2'])){ show_form();
										   accion_Feedback_Admin_01();
					} elseif(isset($_POST['modifica'])){
							if($form_errors = validate_form()){
										show_form($form_errors);
							} else { process_form();
									 accion_Feedback_Admin_Recuperar_02();
										}
			} else { show_form(); }
	} else { require "../Inclu/AccesoDenegado.php";	}

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
	
	global $titulo;
	$titulo = "DATOS ADMINISTRADOR RECUPERADO";

	//require "UserRefCrea.php";
	global $rf;
	$rf = $_POST['ref'];

	global $rutImg;
	$rutImg = "img_cliente/";
	global $safe_filename;
	$safe_filename = $_POST['myimg'];

	require "UserTablaCrea.php";

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	require "../config/TablesNames.php";

	$sqlc = "INSERT INTO `$db_name`.$gst_clientes SET `ref` = '$rf', `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `myimg` = '$_POST[myimg]', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Usuario` = '$_POST[Usuario]', `Password` = '$_POST[Password]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]', `lastin` = '$_POST[lastin]', `lastout` = '$_POST[lastout]', `visitadmin` = '$_POST[visitadmin]' ";

	if(mysqli_query($db, $sqlc)){
							print( $tabla );
				} else {
					print("<font color='#FF0000'>* ERROR L.76</font></br>&nbsp;".mysqli_error($db))."</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}
							
	//require "../config/TablesNames.php";
	
	$sqlc2 = "DELETE FROM `$db_name`.$gst_clientesfeedback WHERE $gst_clientesfeedback.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc2)){
					print("HA RECUPERADO FEEDBACK ADMIN");
				} else {
				print("<font color='#FF0000'>ERROR L.93 </font></br>&nbsp;".mysqli_error($db))."</br>";
							}

			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

			
	global $dt;
	$id = $_POST['id'];

function show_form($errors=[]){
	
	$dt = $_POST['doc'];
	
	global $img;
	$img = 	$_POST['myimg'];

	//require "UserRefCrea.php";

	if(isset($_POST['oculto2'])){
		$defaults = array ( 'id' => $_POST['id'],
							'ref' => $_POST['ref'],
							'Nombre' => $_POST['Nombre'],
							'Apellidos' => $_POST['Apellidos'],
							'myimg' => $_POST['myimg'],
							'Nivel' => $_POST['Nivel'],								
							'doc' => $dt,
							'dni' => $_POST['dni'],
							'ldni' => $_POST['ldni'],
							'Email' => $_POST['Email'],
							'Usuario' => $_POST['Usuario'],
							'Usuario2' => $_POST['Usuario'],
							'Password' => $_POST['Password'],
							'Password2' => $_POST['Password'],
							'Direccion' => $_POST['Direccion'],
							'Tlf1' => $_POST['Tlf1'],
							'Tlf2' => $_POST['Tlf2'],
							'lastin' => $_POST['lastin'],
							'lastout' => $_POST['lastout'],
							'visitadmin' => $_POST['visitadmin'],);
						}
								   
		elseif(isset($_POST['modifica'])){
			global $img2;
			$img2 = 'untitled.png';

		$defaults = array ( 'id' => $_POST['id'],
							'ref' => $_POST['ref'],
							'Nombre' => $_POST['Nombre'],
							'Apellidos' => $_POST['Apellidos'],
							'myimg' => $_POST['myimg'],
							'Nivel' => $_POST['Nivel'],							
							'doc' => $dt,
							'dni' => $_POST['dni'],
							'ldni' => $_POST['ldni'],
							'Email' => $_POST['Email'],
							'Usuario' => $_POST['Usuario'],
							'Usuario2' => $_POST['Usuario2'],
							'Password' => $_POST['Password'],
							'Password2' => $_POST['Password2'],
							'Direccion' => $_POST['Direccion'],
							'Tlf1' => $_POST['Tlf1'],
							'Tlf2' => $_POST['Tlf2'],
							'lastin' => $_POST['lastin'],
							'lastout' => $_POST['lastout'],
							'visitadmin' => $_POST['visitadmin'],);
					}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>** </font>".$errors [$a]."</br>");
			}
		}
		
		global $KeyFeedback;
		$KeyFeedback = 1;
		global $ArrayCliente;
		$ArrayCliente = 1;
		require "ArrayTotal.php";

		require "UserFormRecupera.php";

	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Clientes.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Feedback_Admin_Recuperar_02(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;	
	global $texerror;
	global $rf;

	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

global $text;
$text = "- ADMIN FEEDBACK RECUPERAR 3 ".$ActionTime.". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

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
///

function accion_Feedback_Admin_01(){

	global $db;
	global $rowout;

	global $rf;
	$rf = $_POST['ref'];

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	global $orden;
	if(!isset($_POST['Orden'])){
		$orden = "`id` ASC";
	} else { $orden = $_POST['Orden']; }

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

global $text;
$text = "- ADMIN FEEDBACK RECUPERAR 2 ".$ActionTime.". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = $text."\n";
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
///

	require '../Inclu/Admin_Inclu_02.php';
		
?>