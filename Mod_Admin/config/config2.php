<?php

	require '../Inclu/error_hidden.php'; 
	require '../Inclu/Admin_head.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['inscancel'])){	
				global $textConfig;
				$textConfig = "OPCION MANTENER TABLAS Y DIRECTORIOS".PHP_EOL;
				config_one();
				print("<table align='center' style=\"margin-top:12px;\">
							<tr>
								<td>
				 					<a href='../index.php'>
										ACCEDA AL SISTEMA
				 					</a>
			 					</td>
							 </tr>
						</table>");
						}
	elseif(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
				show_form($form_errors);
									} else {process_form();
														}
	} else {show_form();
			global $text;
			$text = "PRIMER ADMIN MASTER CARGADO FORMULARIO INICIAL";
			ini_log();}
								
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){
	
	if(file_exists('../index.php')){unlink("../index.php");
					$data1 = PHP_EOL."\t UNLINK ../index.php";}
			else {print("DON`T UNLINK ../index.php </br>");
					$data1 = PHP_EOL."\t DON`T UNLINK ../index.php";}

	if(!file_exists('../index.php')){
			if(file_exists('index_Play_System.php')){
				copy("index_Play_System.php", "../index_Play_System.php");
				$data2 = PHP_EOL."\t COPY ../index_Play_System.php";
				} else {print("DON`T COPY index_Play_System.php </br>");
						$data2 = PHP_EOL."\t DON`T COPY index_Play_System.php";}
			} 

	if(file_exists('../index_Play_System.php')){
				rename("../index_Play_System.php", "../index.php");
				$data3 = PHP_EOL."\t RENAME ../index_Play_System.php TO ../index.php";
			} else {print("DON`T RENAME ../index_Play_System.php TO ../index.php </br>");
				$data3 = PHP_EOL."\t DON`T RENAME ../index_Play_System.php TO ../index.php";}
	
	global $text; global $textConfig;
	$text = $textConfig."** SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3;
	ini_log();
	
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
		require 'validate.php';	
		
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
/*	REFERENCIA DE USUARIO	*/
global $rf1;	global $rf2;	global $rf3;	global $rf4;

if (preg_match('/^(\w{1})/',$_POST['Nombre'],$ref1)){	$rf1 = $ref1[1];
														$rf1 = trim($rf1);
														/*print($ref1[1]."</br>");*/
														}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Nombre'],$ref2)){	$rf2 = $ref2[2];
																$rf2 = trim($rf2);
														/*print($ref2[2]."</br>");*/
														}
if (preg_match('/^(\w{1})/',$_POST['Apellidos'],$ref3)){	$rf3 = $ref3[1];
															$rf3 = trim($rf3);
														/*print($ref3[1]."</br>");*/
														}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Apellidos'],$ref4)){	$rf4 = $ref4[2];
																	$rf4 = trim($rf4);
														/*print($ref4[2]."</br>");*/
														}

	global $rf;
	$rf = $rf1.$rf2.$rf3.$rf4.$_POST['dni'].$_POST['ldni'];
	$rf = trim($rf);
	$rf = strtolower($rf);

	$_SESSION['iniref'] = $rf;

	/**************************************/
	/**************************************/

	global $carpetaimg;
	
	global $trf; 			$trf = $_SESSION['iniref'];
	
	global $vn1; 			$vn1 = "img_admin";
	global $carpetaimg; 	$carpetaimg = "../Users/".$trf."/".$vn1;

	if($_FILES['myimg']['size'] == 0){
			global $new_name;
			$new_name = $rf.".png";
	} else{
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		global $new_name;
		$new_name = $rf.".".$extension;
	}

	global $nombre;		$nombre = $_POST['Nombre'];

	global $apellido;	$apellido = $_POST['Apellidos'];
	
	// ENCRIPTO EL PASSWOR ANTES DE GUARDARLO EN LA BBDD
	global $password; 		$password = $_POST['Password'] ;
	global $passwordhash; 	$passwordhash = password_hash($password, PASSWORD_DEFAULT, array ("cost"=>10));
	//$passwordhash = password_hash($password, PASSWORD_DEFAULT, ['cost'=>10]);

	global $db_name;

	global $table_name_a; 	$table_name_a = "`".$_SESSION['clave']."admin`";
	//echo "<br>*** ".$table_name_a."<br>";
	global $tlf2;
	if(strlen(trim($_POST['Tlf2'])) == 0){
		$tlf2 = 0;
	} else { $tlf2 = $_POST['Tlf2']; }

	$sql = "INSERT INTO `$db_name`.$table_name_a (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Pass`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$new_name', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$passwordhash', '$password', '$_POST[Direccion]', '$_POST[Tlf1]', '$tlf2')";
		
	if(mysqli_query($db, $sql)){	// CREA EL ARCHIVO MYDNI.TXT $_SESSION['webmaster'].
										$filename = "../Inclu/webmaster.php";
										$fw2 = fopen($filename, 'w+');
										$mydni = '<?php $_SESSION[\'webmaster\'] = '.$_POST['dni'].'; ?>';
										fwrite($fw2, $mydni);
										fclose($fw2);

	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						SE HA REGISTRADO COMO ADMINISTRADOR.
					</th>
				</tr>");
								
		global $rutaimg; 	$rutaimg = "src='".$carpetaimg."/".$new_name."'";
		require '../Admin/table_data_resum.php';
				
	print("	<tr>
				<td colspan=3 align='right' class='BorderSup'>
					<a href=\"../index.php\">
						ADMINISTRADOR ACCESO A INICIO DEL SISTEMA 
					</a>
				</td>
			</tr>
		</table>");

$datein = date('Y-m-d H:i:s');
global $text;
$text = PHP_EOL."** CREADO MASTER ADMIN 1. ".$datein.PHP_EOL."\t USER REF: ".$rf.PHP_EOL."\t NAME: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t USER: ".$_POST['Usuario'].PHP_EOL."\t PASS: ".$_POST['Password'].PHP_EOL;

	crear_tablas();
	upImg();

	ini_log();
	config_one();
				
	} else {	print("</br>
				<font color='#FF0000'>
		* DATOS NO VALIDOS, MODIFIQUE ENTRADA L151: </font></br> ".mysqli_error($db))."
		<br>* ".$_POST['Tlf2']."
				</br>";
				show_form();
				global $text;
				$text = "* ERROR BBDD, MODIFIQUE ENTRADA L187: ".mysqli_error($db);
				ini_log();
				
					}
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function y(){
	global $trf;
	$trf = $_SESSION['iniref'];
	$carpeta = "../Users/".$trf;
	$filename = $carpeta."/ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
	$contenido = implode("\n",$contenido);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
}

function modif(){
	$filename = "../Users/".$_SESSION['iniref']."/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	}

function crear_tablas(){
	
	global $db;	 		global $db_name;
	global $db_host;	global $db_user;
	global $db_pass;	global $db_name;
	global $dbconecterror;
	
	global $trf;		$trf = $_SESSION['iniref'];
	
// CREA EL DIRECTORIO DE USUARIO.

	global $carpeta;	$carpeta = "../Users/".$trf;

	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data1 = "\t* OK DIRECTORIO USUARIO ".$carpeta."\n";
		}
		else{
		print("* YA EXISTE EL DIRECTORIO USUARIO ".$carpeta."<br>");
		$data1 = "\t* YA EXISTE EL DIRECTORIO USUARIO ".$carpeta."\n";
		}

	if (file_exists($carpeta)){
		copy("../Images/untitled.png", $carpeta."/untitled.png");
		copy("../Images/pdf.png", $carpeta."/pdf.png");
		copy("ayear_Init_System.php", $carpeta."/ayear.php");
		copy("year.txt", $carpeta."/year.txt");
		copy("SecureIndex2.php", $carpeta."/index.php");
		global $data1;
		$data1 = $data1."\t* OK USER SYSTEM FILES ".$carpeta."\n";
		y();
		modif();
		}
		else{
		print("* ERROR USER SYSTEM FILES ".$carpeta."<br>");
		global $data1;
		$data1 = $data1."\t* ERROR USER SYSTEM FILES".$carpeta."\n";
		}
	
	// CREA EL DIRECTORIO DE IMAGEN DE USUARIO.

	$vn1 = "img_admin";
	$carpetaimg = "../Users/".$trf."/".$vn1;
	if (!file_exists($carpetaimg)) {
		mkdir($carpetaimg, 0777, true);
		copy("../Images/untitled.png", $carpetaimg."/untitled.png");
		global $data2;
		$data2 = "\t* OK DIRECTORIO ".$carpetaimg."\n";
		}
		else{print("* YA EXISTE EL DIRECTORIO  ".$carpetaimg."<br>");
		global $data2;
		$data2 = "\t* YA EXISTE EL DIRECTORIO  ".$carpetaimg."\n";
		}
	
	// CREA EL DIRECTORIO DE LOG DE USUARIO.

	$vn1 = "log";
	$carpetalog = "../Users/".$trf."/".$vn1;
	if (!file_exists($carpetalog)) {
		mkdir($carpetalog, 0777, true);
		global $data3;
		$data3 = "\t* OK DIRECTORIO ".$carpetalog."\n";
		}
		else{print("* YA EXISTE EL DIRECTORIO ".$carpetalog."<br>");
		global $data3;
		$data3 = "\t* YA EXISTE EL DIRECTORIO ".$carpetalog."\n";
		}
	
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
	$datein = date('Y-m-d H:i:s');
	global $text;
	$text = PHP_EOL."** CONFIG INIT ".$datein.PHP_EOL."* ".$db_name.PHP_EOL."* ".$db_host.PHP_EOL.". * ".$db_user.PHP_EOL."* ".$db_pass.PHP_EOL.$dbconecterror.$data1.$data2.$data3.PHP_EOL;
	ini_log();

	}	


	function upImg(){
		global $carpetaimg;
		global $rf;
		if($_FILES['myimg']['size'] == 0){
			$nombre = $carpetaimg."/untitled.png";
			global $new_name;
			$new_name = $rf.".png";
			$rename_filename = $carpetaimg."/".$new_name;							
			copy("untitled.png", $rename_filename);
												}
												
	else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			$safe_filename = trim(str_replace('..', '', $safe_filename));

		 	$nombre = $_FILES['myimg']['name'];
		  	$nombre_tmp = $_FILES['myimg']['tmp_name'];
		  	$tipo = $_FILES['myimg']['type'];
		  	$tamano = $_FILES['myimg']['size'];
		  
			$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
			
			// Renombrar el archivo:
			$extension = substr($_FILES['myimg']['name'],-3);
			// print($extension);
			// $extension = end(explode('.', $_FILES['myimg']['name']) );
			global $new_name;
			$new_name = $rf.".".$extension;
			$rename_filename = $carpetaimg."/".$new_name;								
			rename($destination_file, $rename_filename);

			// print("El archivo se ha guardado en: ".$destination_file);
	
			}
			
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		
		}

	} // FIN UPIMG

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){ $defaults = $_POST; } 
	else {  global $array_cero;
			$array_cero = 1; 
			require '../Admin/admin_array_total.php';
				}
	
	if ($errors){
		print("<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
					<td style='text-align:left !important'>");
		
		global $text;
		$text = "show_form(); ERRORES VALIDACION FORMULARIO ADMIN MASTER";
		ini_log();

		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");

				// ESCRIBE ERRORES EN INI_LOG
				global $text;
				$text = $errors[$a];
				$logdate = date('Y_m_d');
				$logtext = "\t ** ".$text.PHP_EOL;
				$filename = "logs/ini_log_".$logdate.".log";
				$log = fopen($filename, 'ab+');
				fwrite($log, $logtext);
				fclose($log);
			}
		print("</td>
				</tr>
				</table>");
			}
			
	/*******************************/

		global $config2;
		$config2 = 1;

	/*******************************/
	global $array_nive_doc;
			$array_nive_doc = 1;
			require '../Admin/admin_array_total.php';
	
	/*******************************/
			
		global $imgform;
		$imgform = "config2";
		require '../Admin/table_crea_admin.php';

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutas.php';
		require '../Inclu_Menu/Master_Index.php';
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ini_log(){

	$ActionTime = date('H:i:s');

	global $text;

    $logdate = date('Y_m_d');

    $logtext = "** ".$ActionTime.PHP_EOL."\t ** ".$text.PHP_EOL;
    $filename = "logs/ini_log_".$logdate.".log";
    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>