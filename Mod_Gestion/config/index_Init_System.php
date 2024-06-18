<?php

	require 'Inclu/Admin_Inclu_01b2.php';

	if(isset($_POST['config'])){
							
		if($form_errors = validate_form()){ show_form($form_errors); } 
			else {	process_form();
					require '../Mod_Admin/Inclu/my_bbdd_clave.php';
					require '../Mod_Admin/Conections/conection.php';
					mysqli_report(MYSQLI_REPORT_OFF);
					global $db;
					@$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
				if (!$db){ 	global $dbconecterror;
							$dbconecterror = @$dbname." * ".mysqli_connect_error()."\n"; 
							print ("NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
							show_form();
					} elseif($db) { config_one();
									crear_tablas();
									ayear();
									global $tablepf;
									print($tablepf);
										}
					}
							
	} else { show_form(); }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function config_one(){
	
	if(file_exists('config/year.txt')){unlink("config/year.txt");
					$data1 = "\n \t UNLINK config/year.txt";}
			else {print("ERROR UNLINK config/year.txt </br>");
					$data1 = "\n \t ERROR UNLINK config/year.txt";}

	if(file_exists('config/ayear.php')){unlink("config/ayear.php");
					$data2 = "\n \t UNLINK config/ayear.php";}
			else {print("ERROR UNLINK config/ayear.php </br>");
					$data2 = "\n \t ERROR UNLINK config/ayear.php";}

	if(!file_exists('config/year.txt')){
			if(file_exists('config/year_Init_System.txt')){
				copy("config/year_Init_System.txt", "config/year.txt");
				$data3 = "\n \t RENAME config/year_Init_System.txt TO config/year.txt";
			} else {print("ERROR RENAME config/year_Init_System.txt TO config/year.txt </br>");
				$data3 = "\n \t ERROR RENAME config/year_Init_System.txt TO config/year.txt";}
			}

	if(!file_exists('config/ayear.php')){
			if(file_exists('config/ayear_Init_System.php')){
				copy("config/ayear_Init_System.php", "config/ayear.php");
				$data4 = "\n \t RENAME config/ayear_Init_System.php TO config/ayear.php";
			} else {print("ERROR RENAME config/ayear_Init_System.php TO config/ayear.php </br>");
				$data4 = "\n \t ERROR RENAME config/ayear_Init_System.php TO config/ayear.php";}
			}
	
	global $cfone;
	$cfone ="\n SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3.$data4;

	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	require 'config/validate_Init_System.php';
	
	return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	/************** CREAMOS EL ARCHIVO DE CONFIGURACIÓN **************/

	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";
	$clave = "'".$_POST['clave']."'";

	/*
	$bddata = '<?php
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$db_host = '.$host.'; 
	$db_user = '.$user.'; 
	$db_pass = '.$pass.'; 
	$db_name = '.$name.'; 
	?>';
	*/
	
	$bddata = '<?php
	if(file_exists("../Mod_Admin/Conections/conection.php")){
	require "../Mod_Admin/Conections/conection.php";
	} else {
	global $cero_conection;
	$cero_conection = 1;
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$db_host = '.$host.'; 
	$db_user = '.$user.'; 
	$db_pass = '.$pass.'; 
	$db_name = '.$name.';}
	?>';

	/* CREA EL ARCHIVO DE CONEXIONES */

	$filename = "../Mod_Admin/Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);

	$_SESSION["clave"] = strtolower($_POST['clave'])."_";
	// CREA EL ARCHIVO my_bbdd_clave.php $_SESSION['clave'].
	$filenameb = "../Mod_Admin/Inclu/my_bbdd_clave.php";
	$fw2b = fopen($filenameb, 'w+');
	$myclave = '<?php $_SESSION[\'clave\'] = "'.$_SESSION["clave"].'"; ?>';
	fwrite($fw2b, $myclave);
	fclose($fw2b);

	global $tablepf;
	$tablepf = "<table align='center'>
				<tr>
					<td colspan='2' align='center'>
							SE HA CREADO EL ARCHIVO DE CONEXIONES.
						</br>
							CON LAS SIGUIENTES VARIABLES.
					</td>
				</tr>
				<tr>
					<td>VARIABLE HOST ADRESS</td>
					<td>\$db_host = ".$host."; \n</td>		
				</tr>								
				<tr>
					<td>VARIABLE USER NAME</td>
					<td>\$db_user = ".$user."; \n</td>		
				</tr>	
				<tr>
					<td>VARIABLE PASSWORD</td>
					<td>\$db_pass = ".$pass."; \n</td>		
				</tr>	
				<tr>
					<td>VARIABLE BBDD NAME</td>
					<td>\$db_name = ".$name."; \n</td>		
				</tr>
				<tr>
					<td >CLAVE TABLES BBDD</td>
					<td >\$clave = ".$clave.";</td>		
				</tr>
			</table>";
									
	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	
	function crear_tablas(){
	
	require "config/crearTablas.php";
	require "../AppsConect/CreaTablasModGestion.php";
						
// CREA EL DIRECTORIO DE IMAGENES.

	$vname2 = "docgastos_".date('Y');
	$carpeta = "gastos/".$vname2;
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		copy("gastos/untitled.png", $carpeta."/untitled.png");
		copy("gastos/pdf.png", $carpeta."/pdf.png");}
		else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");}
	
	$vname3 = "docgastos_".(date('Y')-1);
	$carpeta3 = "gastos/".$vname3;
	if (!file_exists($carpeta3)) {
		mkdir($carpeta3, 0777, true);
		copy("gastos/untitled.png", $carpeta3."/untitled.png");
		copy("gastos/pdf.png", $carpeta3."/pdf.png");}
		else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta3."\n");}
	
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
global $cfone;				global $text;				global $text2;
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = $cfone."\n - CONFIG INIT ".$datein.".\n * ".$db_name.". \n * ".$db_host.". \n * ".$db_user.". \n * ".$db_pass."\n".$dbconecterror.$text.$text2."\n";
$filename = "logs/Config/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
	fclose($log);

	}	

///////////////////////

function modif(){
									   							
	$filename = "config/ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',";
	$contenido = implode("\n",$contenido);
	
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
}

function modif2(){

	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

function ayear(){
	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){}
	elseif($fget != date('Y')){ 	modif();
									modif2();
												}
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if(isset($_POST['config'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
									'clave' => '',);
								   }
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
		
	print("<table align='center' style=\"margin-top:10px;\">
					<tr>
					<td style='color:red' align='center'>
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
			SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px;\">
				<tr>
					<th colspan=2 class='BorderInf'>
							INIT CONFIG DATA
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td style='text-align:right !important;' width=140px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=180px>
		<input type='text' name='host' size=25 maxlength=25 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td>
		<input type='text' name='user' size=25 maxlength=25 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td>
		<input type='text' name='pass' size=25 maxlength=25 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td>
		<input type='text' name='name' size=25 maxlength=25 value='".$defaults['name']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'	
						<font color='#FF0000'>*</font>
						TABLES SYSTEM CLAVE
					</td>
					<td>
		<input type='text' name='clave' size=25 maxlength=3 value='".$defaults['clave']."' />
					</td>
				</tr>
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' class='botonverde' />
						<input type='hidden' name='config' value=1 />
					</td>
				</tr>
		</form>														
			</table>"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

	require 'Inclu/Admin_Inclu_02.php';

?>