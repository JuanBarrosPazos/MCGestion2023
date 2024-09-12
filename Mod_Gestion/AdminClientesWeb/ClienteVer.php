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

	if($_SESSION['Nivel']=='admin'){

		master_index();
		if(isset($_POST['todo'])){ 	show_form();							
									ver_todo();
									log_info();
		}elseif(isset($_POST['oculto'])){
				if($form_errors = validate_form()){
					show_form($form_errors);
				}else{ 	process_form();
						log_info();
							}
		}else{ show_form(); }

	}elseif($_SESSION['Nivel']=='cliente'){	master_index();
											ver_todo();
											unset($_SESSION['refcl']);
	}else{ require "../Inclu/AccesoDenegado.php"; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();
	
	if((strlen(trim($_POST['Nombre'])) == 0)&&(strlen(trim($_POST['Apellidos'])) == 0)){
		$errors [] = "UNO DE LOS DOS CAMPOS OBLIGATORIO";
	}else{ }
	
	return $errors;

} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $nombre;		$nombre = $_POST['Nombre'];
	global $apellido;	$apellido = $_POST['Apellidos'];
	
	show_form();
		
	global $nom;	$nom = "%".$_POST['Nombre']."%";
	global $ape;	$ape = "%".$_POST['Apellidos']."%";

	if(strlen(trim($_POST['Apellidos'])) == 0){ $ape = $nom; }else{ }
	if(strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape; }else{ }
	
	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }
		
	require "../config/TablesNames.php";
	//$sqlb =  "SELECT * FROM $ClientesWeb WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
	$sqlb =  "SELECT * FROM $ClientesWeb WHERE (`Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape') AND `doc` <> 'local' ORDER BY `Nombre` ASC ";
	
		$qb = mysqli_query($db, $sqlb);
	
		if(!$qb){ print("* ERROR SQL L.70 </font>".mysqli_error($db)."</br>");
					show_form();	
		}else{ 	global $KeyBorraUser;	$KeyBorraUser = 1;
				require "UserWhileTabla.php";
		} // FIN ELSE WHILE TABLA 
	} // FIN function process_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){
		
		global $Orden;
		if(!isset($_POST['Orden'])){ $Orden = "`id` ASC"; }else{ $Orden = $_POST['Orden']; }
			global $defaults;
		if(isset($_POST['oculto'])){
				$defaults = array ('Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'Orden' => $Orden);
		}elseif(isset($_POST['todo'])){
				$defaults = array ('Nombre' => '', 'Apellidos' => '','Orden' => $Orden);
		}else{	$defaults = array ('Nombre' => '', 'Apellidos' => '','Orden' => $Orden);
					}
		
		require 'TableValidateErrors.php';

		global $FormTitulo;		$FormTitulo = "VER CLIENTES";
		
		if($_SESSION['Nivel']=='Admin'){ require "UserFormFiltro.php"; }else{ }
		
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }

	global $nombre;			$nombre = $_SESSION['Nombre']; 
	global $apellido;		$apellido = $_SESSION['Apellidos'];
	global $clref;			$clref = $_SESSION['ref'];

	require "../config/TablesNames.php";
	if($_SESSION['Nivel']=='admin'){
		//$sqlb =  "SELECT * FROM $ClientesWeb ORDER BY $orden ";
		$sqlb =  "SELECT * FROM $ClientesWeb WHERE `doc` <> 'local' ORDER BY $orden ";
	}elseif($_SESSION['Nivel']=='cliente'){
		$sqlb =  "SELECT * FROM $ClientesWeb WHERE `ref` = '$clref' LIMIT 1 ";
	}

	$qb = mysqli_query($db, $sqlb);
	
	global $KeyIndex;	$KeyIndex = 0;
	if(!$qb){
			print("*ERROR SQL L.123 ".mysqli_error($db)."</br>");
	}else{ 	global $KeyBorraUser;	$KeyBorraUser = 1;
			require "UserWhileTabla.php";
	} // FIN ELSE WHILE TABLA

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaindex;          $rutaindex = '../';
		global $rutaOut;            $rutaOut = $rutaindex.'../';

		require '../Inclu_Menu/rutaindex.php';
		global $AdminClientesWeb;       $AdminClientesWeb = '';
		global $ClientesWeb;			$ClientesWeb = '../ClientesWeb/';
		require '../Inclu_Menu/Master_Index.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function log_info(){

	global $nombre;			global $apellido;

	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }
	
	if(isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;}	

	global $LogText;
	$LogText = "- ADMIN VER ".$nombre." ".$apellido;

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