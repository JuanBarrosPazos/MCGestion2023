<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'cliente')){
 			print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
			master_index();
						if (isset($_POST['oculto2'])){
								show_form();
								accion_Borrar_01();
						} elseif($_POST['borrar']){ process_form();
													Feedback();
													accion_Borrar_02();
				} else { show_form(); }
		} else { require "../Inclu/AccesoDenegado.php";	}
 
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $tabla;
	$tabla = "<table align='center'>
				<tr>
					<th colspan=3  class='BorderInf'>
						SE HA BORRADO ESTE USUARIO.
					</th>
				</tr>
				<tr>
					<th colspan=3 class='BorderInf'>
						<form name='boton' action='Cliente_Modificar_01.php' method='post' >
								<input type='submit' value='INCIO CLIENTES' />
								<input type='hidden' name='volver' value=1 />
						</form>
					</th>
				</tr>
				<tr>
					<td width=150px>ID:</td>
					<td width=200px>".$_POST['id']."</td>
					<td rowspan=5>
						<img src='../Admin_clientes/img_cliente/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				<tr>
					<td width=150px>Referencia:</td>
					<td width=200px>".$_POST['ref']."</td>
				</tr>
				<tr>
					<td width=150px>Nivel:</td>
					<td width=200px>".$_POST['Nivel']."</td>
				</tr>
				<tr>
					<td width=150px>Nombre:</td>
					<td width=200px>".$_POST['Nombre']."</td>
				</tr>
				<tr>
					<td>Apellidos:</td>
					<td>".$_POST['Apellidos']."</td>
				</tr>				
				<tr>
					<td>Tipo Documento:</td>
					<td>".$_POST['doc']."</td>
				</tr>				
				<tr>
					<td>N&uacute;mero:</td>
					<td colspan=2>".$_POST['dni']."</td>
				</tr>				
				<tr>
					<td>Control:</td>
					<td colspan=2>".$_POST['ldni']."</td>
				</tr>				
				<tr>
					<td>Mail:</td>
					<td colspan=2>".$_POST['Email']."</td>
				</tr>
				<tr>
					<td>Usuario:</td>
					<td colspan=2>".$_POST['Usuario']."</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td colspan=2>".$_POST['Password']."</td>
				</tr>
				<tr>
					<td>Direcci&oacute;n:</td>
					<td colspan=2>".$_POST['Direccion']."</td>
				</tr>
				<tr>
					<td>Tel&eacute;fono 1:</td>
					<td colspan=2>".$_POST['Tlf1']."</td>
				</tr>
				<tr>
					<td>Tel&eacute;fono 2:</td>
					<td colspan=2>".$_POST['Tlf2']."</td>
				</tr>
				<tr>
					<td>Last In:</td>
					<td colspan=2>".$_POST['lastin']."</td>
				</tr>
				<tr>
					<td>Last Out:</td>
					<td colspan=2>".$_POST['lastout']."</td>
				</tr>
				<tr>
					<td>Nº Visitas:</td>
					<td colspan=2>".$_POST['visitadmin']."</td>
				</tr>
			</table>";	

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	require "../config/TablesNames.php";
	
	$sql = "DELETE FROM `$db_name`.$clientes WHERE $clientes.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sql)){
			global $tabla;
			print( $tabla );
		} else { print("<font color='#FF0000'>ERROR L.127: </font>&nbsp;".mysqli_error($db))."</br>";
						show_form ();
					}

	} // FIN FUCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
	$id = $_POST['id'];

function show_form(){
		
	if(isset($_POST['oculto2'])){
		
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nivel' => $_POST['Nivel'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],
									'lastin' => $_POST['lastin'],
									'lastout' => $_POST['lastout'],
									'visitadmin' => $_POST['visitadmin'],
																		 );
								   											}
	if(isset($_POST['borrar'])){
		
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nivel' => $_POST['Nivel'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],
									'lastin' => $_POST['lastin'],
									'lastout' => $_POST['lastout'],
									'visitadmin' => $_POST['visitadmin'],
																		 );
								   											}
								   
	print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO.
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
				</tr>
				<th colspan=3 width=100% class='BorderInf'>
					<form name='boton' action='Cliente_Modificar_01.php' method='post' >
							<input type='submit' value='CANCELAR Y VOLVER' />
							<input type='hidden' name='volver' value=1 />
					</form>
				</th>
	
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<input name='id' type='hidden' value='".$defaults['id']."' />					
				<input name='ref' type='hidden' value='".$defaults['ref']."' />					
				<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
				<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
				<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />					
		<tr>
			<td>Nivel:</td>
			<td>
				".$defaults['Nivel']."
				<input  type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
			</td>
			
			<td rowspan='5' align='center' width='180px'>
				<img src='../Admin_clientes/img_cliente/".$_POST['myimg']."' height='120px' width='90px' />
						<input name='myimg' type='hidden' value='".$_POST['myimg']."' />
			</td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td>
				".$defaults['Nombre']."
				<input  type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
			</td>
		</tr>
		<tr>
			<td>Apellidos:</td>
			<td>
				".$defaults['Apellidos']."
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
			</td>
		</tr>
		<tr>
			<td>Tipo Documeno:</td>
			<td>
				".$defaults['doc']."
				<input type='hidden' name='doc' value='".$defaults['doc']."' />
			</td>
		</tr>
		<tr>
			<td>N&uacute;mero:</td>
			<td>
				".$defaults['dni']."
				<input type='hidden' name='dni' value='".$defaults['dni']."' />
			</td>
		</tr>
		<tr>
			<td>Control:</td>
			<td colspan='2'>
				".$defaults['ldni']."
				<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
			</td>
		</tr>
		<tr>
			<td>Mail:</td>
			<td colspan='2'>
				".$defaults['Email']."
				<input type='hidden'' name='Email' value='".$defaults['Email']."' />
			</td>
		</tr>	
		<tr>
			<td>Nombre de Usuario:</td>
			<td colspan='2'>
				".$defaults['Usuario']."
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
			</td>
		</tr>
		<tr>
			<td>Password:</td>
			<td colspan='2'>
				".$defaults['Password']."
				<input type='hidden' name='Password' value='".$defaults['Password']."' />
			</td>
		</tr>
		<tr>
			<td>Dirección:</td>
			<td colspan='2'>
				".$defaults['Direccion']."
				<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
			</td>
		</tr>
		<tr>
			<td>Teléfono 1:</td>
			<td colspan='2'>
				".$defaults['Tlf1']."
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
			</td>
		</tr>
		<tr>
			<td class='BorderInf'>Teléfono 2:</td>
			<td class='BorderInf' colspan='2'>
				".$defaults['Tlf2']."
				<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
			</td>
		</tr>
		<tr align='right'>
			<td colspan='3'>
				<input type='submit' value='ELIMINAR DATOS PERMANENTEMENTE' />
				<input type='hidden' name='borrar' value=1 />
			</td>
		</tr>
	</form>														
		</table>"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function Feedback(){
	
	$FBaja = date('Y-m-d/H:i:s');
	
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';	
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require "../config/TablesNames.php";
	
	$sqlf = "INSERT INTO `$db_name`.$clientesfeedback (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`, `borrado`, `lastin`, `lastout`, `visitadmin`) VALUES ('$_POST[ref]', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[myimg]', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]', '$FBaja', '$_POST[lastin]', '$_POST[lastout]', '$_POST[visitadmin]')";
	
	if(mysqli_query($db, $sqlf)){ print("FOK.");
		} else { print("<font color='#FF0000'>
						* SE HA PRODUCIDO UN ERROR AL GRABAR FEEDBACK: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($dbf)).
						"</br>";
					}
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

function accion_Borrar_02(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;	
	global $rf;
	
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- ADMIN BORRAR 3 ".$ActionTime.". ID:".$_POST['id'].". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

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

function accion_Borrar_01(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $rf;
	
	$rf = $_POST['ref'];
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
$text = "- ADMIN BORRAR 2 ".$ActionTime.". ID:".$_POST['id'].". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

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
