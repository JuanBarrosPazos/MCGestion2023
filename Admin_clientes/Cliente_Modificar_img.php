<?php
session_start();

	require '../Inclu/Admin_Inclu_popup.php';
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

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'cliente')){
 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".</br>");
				
	if (isset($_POST['oculto2'])){ show_form();}
			elseif(isset($_POST['imagenmodif'])){
						if($form_errors = validate_form()){
								show_form($form_errors);
						} else { process_form();
								 accion_Modificar_02();
									}
				} else { show_form(); }
	} else { require "../Inclu/AccesoDenegado.php"; }

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
	
		global $imgOld;
		$imgOld = $_POST['imgOld'];

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

		global $rf;
		$rf = $_POST['ref'];
		global $imgNewName;
		$imgNewName = $rf."_".$dt.".".$extension;

		global $rename_filename;
		$rename_filename = "img_cliente/".$imgNewName;	
		//rename($destination_file, $rename_filename);

	/////////////////////////////

		global $titulo;
		$titulo = "SE HA MODIFICADO LA IMAGEN";
		global $rutImg;
		$rutImg = "img_cliente/";

		global $KeyModifImg;
		$KeyModifImg = 1;
		global $tabla;
		require "UserTablaCrea.php";	

	/* if( file_exists( 'img_cliente/'.$nombre) ){
							print("El archivo ".$nombre." ya existe, seleccione otra imagen."
							);
							show_form();
		} elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){ LO QUE SEA... }
	*/

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	require "../config/TablesNames.php";

	$sqlc = "UPDATE `$db_name`.$gst_clientes SET `myimg` = '$imgNewName' WHERE $gst_clientes.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){

		global $destination_file;
		move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file);
		global $KeyModifImg;
		global $tabla;
		print( $tabla );
		if(file_exists($rutImg.$imgOld)){
			// BORRA LA IMAGEN ORIGINAL SI EXISTE ['img_cliente/'.$safe_filename;]
			unlink($rutImg.$imgOld);
		} else { }
	
		global $rename_filename;
		rename($destination_file, $rename_filename);

		if(!file_exists($rename_filename)){
					print("NO SE HA PODIDO GUARDAR EN ".$rename_filename);}
			else{ print ("LA IMAGEN SE HA GUARDADO OK..."); }

	} else { print("<font color='#FF0000'>
						* MODIFIQUE L.116 </font>&nbsp;&nbsp;&nbsp;".mysqli_error($db))."</br>";
						show_form ();
				}

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	global $rf;
	$rf = $_POST['ref'];

	if(isset($_POST['oculto2'])){
				$defaults = array ( 'id' => $_POST['id'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'imgOld' => $_POST['myimg'],
									'ref' => $_POST['ref'],
									'Nivel' => $_POST['Nivel'],									
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Usuario2' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Password2' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'], );
	}elseif(isset($_POST['imagenmodif'])){
				global $img2;
				$img2 = $_POST['imgOld'];
				$defaults = array ( 'id' => $_POST['id'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $img2,
									'imgOld' => $_POST['imgOld'],
									'Nivel' => $_POST['Nivel'],										
									'ref' => $_POST['ref'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Usuario2' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Password2' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],);
								}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>** </font>".$errors [$a]."</br>");
			}
		}
		
	print("<table align='center' border=0 style='margin-top:90px;'>
				<tr>
					<th colspan=2 class='BorderInf'>SELECCIONE UNA NUEVA IMAGEN.</th>
				</tr>
				<tr>
					<th class='BorderInf'>
				LA IMAGEN ACTUAL DE</br>".$defaults['Nombre']." ".$defaults['Apellidos'].". **".$rf."
					</th>
					<th class='BorderInf'>
						<img src='img_cliente/".$defaults['myimg']."' height='120px' width='90px' />
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
				<tr>
					<td>Seleccione una Fotografía:</td>
					<td>
		<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>
		<input type='hidden' name='imgOld' value='".$defaults['imgOld']."' />
		<input type='hidden' name='id' value='".$defaults['id']."' />					
		<input type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
		<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
		<input type='hidden' name='doc' value='".$defaults['doc']."' />
		<input type='hidden' name='dni' value='".$defaults['dni']."' />
		<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
		<input type='hidden' name='Email' value='".$defaults['Email']."' />
		<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
		<input type='hidden' name='ref' value='".$defaults['ref']."' />
		<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
		<input type='hidden' name='Usuario2' value='".$defaults['Usuario2']."' />
		<input type='hidden' name='Password' value='".$defaults['Password']."' />
		<input type='hidden' name='Password2' value='".$defaults['Password2']."' />
		<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
		<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
		<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr align='center' height=60px>
					<td></td>
					<td >
						<input type='submit' value='MODIFICAR LA IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
					</td>
					<td align='right'></td>
				</tr>
		</form>														
				<tr>
					<td class='BorderSup'></td>
					<td align='right' class='BorderSup'></td>
				</tr>
				<tr>
					<td class='BorderSup'></td>
					<td align='right' class='BorderSup'>
						<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
								<input type='submit' value='CERRAR VENTANA' />
								<input type='hidden' name='oculto2' value=1 />
						</form>
					</td>
				</tr>
			</table>");
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

function accion_Modificar_02(){

	global $db;
	global $rowout;
	
	global $nombre;
	global $apellido;
	global $destination_file;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}

	global $text;
	$text = "- ADMIN MODIFICAR IMG ".$ActionTime.". ID:".$_POST['id'].". ".$nombre." ".$apellido." / ".$destination_file;

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

	require '../Inclu/Admin_Inclu_02.php';
		
?>