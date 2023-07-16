<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
		
	require "../config/TablesNames.php";
	/*
	$sqld =  "SELECT * FROM $gst_clientes WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);
	*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

 	print("HOLA CREE SU PERFIL DE CLIENTE.");

	if(isset($_POST['oculto'])){
							
		if($form_errors = validate_form()){
					show_form($form_errors);
		} else { process_form();
				 accion_admin_crear();
					}
	} else { show_form(); }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	global $qd;
	global $rowd;
	
	require 'validate_cliente.php';	
		
	if(!isset($_POST['Condiciones'])){
	$errors [] = "Condiciones del servicio: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}

	if(!isset($_POST['Datos'])){
	$errors [] = "Tratamiento de datos: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}

			return $errors;

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	
	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
	$safe_filename = trim(str_replace('..', '', $safe_filename));

	$nombre = $_FILES['myimg']['name'];
	$nombre_tmp = $_FILES['myimg']['tmp_name'];
	$tipo = $_FILES['myimg']['type'];
	$tamano = $_FILES['myimg']['size'];
		
	global $destination_file;
	$destination_file = '../Admin_clientes/img_cliente/'.$safe_filename;

		
	require "../Admin_clientes/UserRefCrea.php";

/**************************************/

	global $titulo;
	$titulo = "SE HA REGISTRADO COMO CLIENTE";
	global $rutImg;
	$rutImg = "../Admin_clientes/img_cliente/";

	global $KeyClienteCero;
	$KeyClienteCero = 1;

	global $tabla;

	require "UserTablaCrea.php";	

	if( file_exists( '../Admin_clientes/img_cliente/'.$nombre) ){
		print("<br><font color='#FF0000'>**</font> El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
		show_form();

	} else {

		global $nombre;
		global $apellido;
		$nombre = $_POST['Nombre'];
		$apellido = $_POST['Apellidos'];

		global $KeyClienteCero;
		$KeyClienteCero = 1;
		require "../config/TablesNames.php";

	$sql = "INSERT INTO `$db_name`.$gst_clientes (`ref`,`Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$safe_filename', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
	if(mysqli_query($db, $sql)){
			print( $tabla );
			move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file);

			if( !file_exists( $destination_file ) ){
						print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
				else{ print ("LA IMAGEN SE HA GUARDADO OK..."); }

		} else { print("</br>
				<font color='#FF0000'>* MODIFIQUE L.245 </font></br> ".mysqli_error($db))."
				</br>";
				show_form ();
				global $texerror;
				$texerror = "\n\t ".mysqli_error($db);
			}
					// print("El archivo se ha guardado en: ".$destination_file);
		} 

	}	/* Final de la función process_form(); */

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
									'Tlf2' => '',
									'Condiciones' => '',
									'Datos' => '',);
								   }
								   	
	if ($errors){
		print("<font color='#FF0000'></br>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
		
		global $ArrayAdmin;
		$ArrayAdmin = 1;
		global $ArrayCliente;
		$ArrayCliente = 1;
	require "../Admin_clientes/ArrayTotal.php";
	
	require "../Admin_clientes/UserRefCrea.php";

	global $textit;
	$textit = "DATOS DEL NUEVO CLIENTE";


	print(" <table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							DATOS DEL NUEVO CLIENTE
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
						
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Ref User:
					</td>
					<td width=360px>
									".$rf."
					</td>
				</tr>
					
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td width=360px>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' required />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
	<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' required />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Tipo Documento:
					</td>
					<td>
<select name='doc' required>");

						
				foreach($doctype as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['doc']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
					

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td>
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' required />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control:
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' required />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' required />
					</td>
				</tr>	
				
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nivel Usuario:
					</td>
					<td>
<select name='Nivel' required>");

						
				foreach($Nivel as $optionnv => $labelnv){
					
					print ("<option value='".$optionnv."' ");
					
					if($optionnv == $defaults['Nivel']){
															print ("selected = 'selected'");
																								}
													print ("> $labelnv </option>");
												}	
	global $KeyCondiciones;
	$KeyCondiciones = 1;

	print ("</select>
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre de Usuario:
					</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' required />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Usuario:
					</td>
					<td>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' required />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' required />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Password:
					</td>
					<td>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' required />
					</td>
				</tr>


				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' required />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' required />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' required />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Seleccione una Fotografía:
					</td>
					<td>
		<input type='file' name='myimg' value='".@$defaults['myimg']."' required />						
					</td>
				</tr>
				
				<tr>
					<td align='right'>
						<font color='#FF0000'>*</font>
			<input type='checkbox' name='Condiciones' value='yes' ");
				if(@$defaults['Condiciones'] == 'yes') {print(" checked=\"checked\"");}
								
			print(" required />
					</td>
					<td>
						<a href=\"Condiciones_Uso.html\" target=\"_blank\">
						He leido y acepto las condiciones de uso del servicio.
						</a>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<font color='#FF0000'>*</font>
				<input type='checkbox' name='Datos' value='yes' ");
					if(@$defaults['Datos'] == 'yes') {print(" checked='checked'");}
			
			print(" required />
					</td>
					<td>
						<a href=\"Proteccion_Datos.html\" target=\"_blank\">
						He leido y acepto las condiciones tratamiento de datos.
						</a>
					</td>
				</tr>				
				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='Registrarme con estos datos' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
				</tr>
		</form>														
			</table>				
						");
			
			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu/Master_In_Clientes.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function accion_admin_crear(){

	global $nombre;
	global $apellido;
	global $text;
	global $rf;	
	global $texerror;

	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	$ActionTime = date('H:i:s');
	
if ($nombre == ''){$text = "- ERROR LA IMAGEN YA EXISTE";}
else{$text = "- CLIENTE CREAR ".$ActionTime.". Ref User:".$rf.".\n \t Name: ".$nombre." ".$apellido.". \n \t User: ".$_POST['Usuario'].".\n \t Pass: ".$_POST['Password'];			
	}
	
	$logname = $_POST['Nombre'];	
	$logape = $_POST['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror."\n";
	$filename = "../logs/Clientes/".$logdate."_".$logdocu.".log";
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