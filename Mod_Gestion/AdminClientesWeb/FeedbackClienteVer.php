<?php
session_start();

	global $rutaHeader;		$rutaHeader = "../";
	require $rutaHeader.'Inclu/Inclu_Header.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

		if(isset($_POST['todo'])){  show_form();							
									ver_todo();
									log_info();
				}elseif(isset($_POST['oculto'])){
							if($form_errors = validate_form()){
											show_form($form_errors);
								}else{ process_form();
										 log_info();
										}
					}else{ show_form(); }
		}else{ require "../Inclu/AccesoDenegado.php"; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	$errors = array();
	
	if ( (strlen(trim($_POST['Nombre'])) == 0) && (strlen(trim($_POST['Apellidos'])) == 0) ){
		$errors [] = " <font color='#FF0000'>UNO DE LOS DOS CAMPOS OBLIGATORIO</font>";
		}
	
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	show_form();
		
	$nom = "%".$_POST['Nombre']."%";
	$ape = "%".$_POST['Apellidos']."%";

	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }
		
	if (strlen(trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape;}
	
	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $ClientesWebFeedback WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
 	
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){ print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
				show_form();	
		}else{
			
				require "UserWhileTablaFeedback.php";

			} // FIN ELSE WHILE TABLA
		
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		}
	elseif(isset($_POST['todo'])){
		$defaults = $_POST;
		}else{global $ordenar;
				$defaults = array ('Nombre' => '',
								   'Apellidos' => '',
								   'Orden' => $ordenar);
								   						}
	
	if ($errors){
		print("<font color='#FF0000'>
				Solucione estos errores: </font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."</br>");
			}
		}
		
		global $KeyFeedback;
		$KeyFeedback = 1;
		global $FormTitulo;
		$FormTitulo = "VER FEEDBACK";
		require "UserFormFiltro.php";

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function ver_todo(){
		
	global $db;

	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }

	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $ClientesWebFeedback ORDER BY $orden ";
 	
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		}else{
			
			require "UserWhileTablaFeedback.php";

			} // FIN ELSE WHILE TABLA
		
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaindex;          $rutaindex = '../';
		global $rutaOut;            $rutaOut = $rutaindex.'../';
		require '../Inclu_Menu/rutaindex.php';
		global $AdminClientesWeb;        $AdminClientesWeb = '';
	
		require '../Inclu_Menu/Master_Index.php';
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function log_info(){

	global $nombre;
	global $apellido;
	
	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;}	

	$ActionTime = date('H:i:s');

	global $LogText;
	$LogText = "- ADMIN FEEDBACK VER ".$ActionTime.". ".$nombre." ".$apellido;

	require '../logs/LogInfo.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	require '../Inclu/Inclu_Footer.php';
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>