<?php
session_start();

	require '../Inclu/Admin_Inclu_popup.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

$sqld =  "SELECT * FROM `clientes` WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
 	
	$qd = mysqli_query($db, $sqld);
	
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".</br>");
				
							if ($_POST['oculto2']){
								show_form();
								}
							elseif($_POST['imagenmodif']){
								
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else {
												process_form();
												accion_Modificar_02();
												}
								
								} else {
											show_form();
									}

				} else { 
					
						print("<table align='center' style=\"margin-top:200px;margin-bottom:200px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													ACCESO RESTRINGIDO.
												</br></br>
													CONSULTE SUS PERMISOS ADMINISTRATIVOS.
											</font>
										</td>
									</tr>
								</table>");
								
							}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;
	
		require '../Inclu/validate_cliente.php';	
		
			return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	
	global $safe_filename;
	
			$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			$safe_filename = trim(str_replace('..', '', $safe_filename));

		  $nombre = $_FILES['myimg']['name'];
		  $nombre_tmp = $_FILES['myimg']['tmp_name'];
		  $tipo = $_FILES['myimg']['type'];
		  $tamano = $_FILES['myimg']['size'];
		  
			global $destination_file;
			$destination_file = 'img_cliente/'.$safe_filename;

	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3  class='BorderInf'>
						Estos son los nuevos datos de registro.
					</th>
				</tr>
				
				<tr>
					<td width=200px>
						Nombre:
					</td>
					<td width=200px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='4' align='center' width='100px'>
						<img src='img_cliente/".$safe_filename."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						Apellidos:
					</td>
					<td>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Tipo Documento:
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Control:
					</td>
					<td colspan=2>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td colspan=2>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tipo Usuario
					</td>
					<td colspan=2>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Usuario:
					</td>
					<td colspan=2>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td colspan=2>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				<tr>
				
					<td>
						Dirección:
					</td>
					<td colspan=2>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 1:
					</td>
					<td colspan=2>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 2:
					</td>
					<td colspan=2>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
												
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>	
						";	


	/* if( file_exists( 'img_cliente/'.$nombre) ){
							print("El archivo ".$nombre." ya existe, seleccione otra imagen."
							);
							show_form();
			}
			
			else*/if (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){


	global $db_name;

	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	$sqlc = "UPDATE `$db_name`.`clientes` SET `myimg` = '$safe_filename' WHERE `clientes`.`ID` = '$_POST[ID]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print("</br>
					Se han modificado los datos correctamente");
			print( $tabla );
				} else {
				print("<font color='#FF0000'>
						* ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						
							}

					// print("El archivo se ha guardado en: ".$destination_file);
			}
			
			else {
					print("No se ha podido guardar el archivo en el direcctorio img_cliente/");
			}


			}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
global $dt;
	
$id = $_POST['ID'];
	
global $db; 	
	
$img = 	$_POST['myimg'];
$dt = $_POST['doc'];

	if($_POST['oculto2']){
		

				$defaults = array ( 'ID' => $_POST['ID'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $img,
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
									'Tlf2' => $_POST['Tlf2'],
																		 );
								   											}
								   
		elseif($_POST['imagenmodif']){
				global $img2;
				$defaults = array ( 'ID' => $_POST['ID'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $img2,
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
									'Tlf2' => $_POST['Tlf2'],
																		 );
								}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>** </font>".$errors [$a]."</br>");
			}
		}
		
	print("
			<table align='center' border=0 style='margin-top:90px;'>
			
				<tr>
					<th colspan=2 class='BorderInf'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
				</tr>
				
				<tr>
					<th class='BorderInf'>
				LA IMAGEN ACTUAL DE : </br>".$defaults['Nombre']." ".$defaults['Apellidos'].".
					</th>
					<th class='BorderInf'>
						<img src='img_cliente/".$defaults['myimg']."' height='120px' width='90px' />
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			
				<tr>
					<td>
							Seleccione una Fotografía:	
					</td>
					<td>
		<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

			
	<input type='hidden' name='ID' value='".$defaults['ID']."' />					
	<input type='hidden' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
	<input type='hidden' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
	<input type='hidden' name='doc' size=28 maxlength=25 value='".$defaults['doc']."' />
	<input type='hidden' name='dni' size=28 maxlength=8 value='".$defaults['dni']."' />
	<input type='hidden' name='ldni' size=28 maxlength=1 value='".$defaults['ldni']."' />
	<input type='hidden' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
	<input type='hidden' name='Nivel' size=52 maxlength=50 value='".$defaults['Nivel']."' />
	<input type='hidden' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
	<input type='hidden' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
	<input type='hidden' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
	<input type='hidden' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
	<input type='hidden' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
	<input type='hidden' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
	<input type='hidden' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr align='center' height=60px>
					<td>
					</td>
					<td >
						<input type='submit' value='MODIFICAR LA IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
						
					</td>
					
					<td align='right'>
						
					</td>
				</tr>
				
		</form>														
			
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
					</td>
				</tr>
				
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>				
			
				"); 

	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Clientes.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Modificar_02(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $destination_file;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- CLIENTE MODIFICAR IMG ".$ActionTime.". ID:".$_POST['ID'].". ".$nombre." ".$apellido." / ".$destination_file;

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

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>