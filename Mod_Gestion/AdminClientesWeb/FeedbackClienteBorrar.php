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
		
			if (isset($_POST['oculto2'])){ 	show_form();
											log_info();
					} elseif(isset($_POST['borrar'])){ 	process_form();
														log_info();
										} else { show_form(); }
		} else { require "../Inclu/AccesoDenegado.php"; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	
	global $tabla;
	$tabla = "<table align='center'>
				<tr>
					<th colspan=3  class='BorderInf'>SE HAN BORRADO ESTOS DATOS DEFINITIVAMENTE</th>
				</tr>
				<tr>
					<th colspan=3 class='BorderInf'>
						<form name='boton' action='FeedbackClienteVer.php' method='post' >
								<input type='submit' value='INCIO FEEDBACK ADMINISTRADORES' />
								<input type='hidden' name='volver' value=1 />
						</form>
					</th>
				</tr>
				<tr>
					<td width=150px>ID:</td>
					<td width=200px>".$_POST['id']."</td>
				<tr>
					<td width=150px>Ref User:</td>
					<td width=200px>".$_POST['ref']."</td>
					<td rowspan=5>
						<img src='img_cliente/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
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
	
	$sql = "DELETE FROM `$db_name`.$ClientesWebFeedback WHERE $ClientesWebFeedback.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sql)){
				global $tabla;
				print( $tabla );
				if(file_exists("img_cliente/".$_POST['myimg'])){
					// BORRA LA IMAGEN ORIGINAL SI EXISTE ['img_cliente/'.$safe_filename;]
					unlink("img_cliente/".$_POST['myimg']);
				} else { }
		} else { print("<font color='#F1BD2D'>ERROR L.213:</font>&nbsp;".mysqli_error($db))."</br>";
						show_form ();
					}

	}	

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
								   
	print("
			<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3 class='BorderInf' style='color:#F1BD2D;'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
					</th>
				</tr>
				<tr>
					<th colspan=3 class='BorderInf' style=\"text-align:right\">
						<form name='boton' action='FeedbackClienteVer.php' method='post' >
								<input type='submit' value='CANCELAR Y VOLVER' />
								<input type='hidden' name='todo' value=1 />
						</form>
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<input name='id' type='hidden' value='".$defaults['id']."' />					
				<input name='ref' type='hidden' value='".$defaults['ref']."' />					
				<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
				<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
				<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />					
	
		<tr>
			<td>	
						Nivel:
			</td>
			
			<td>
				".$defaults['Nivel']."
				<input  type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
			</td>
			
			<td rowspan='5' align='center' width='180px'>
						<img src='img_cliente/".$_POST['myimg']."' height='120px' width='90px' />
						<input name='myimg' type='hidden' value='".$_POST['myimg']."' />

			</td>
		</tr>
					
		<tr>
			<td>	
						Nombre:
			</td>
			
			<td>
				".$defaults['Nombre']."
				<input  type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
			</td>
		</tr>
					
		<tr>
			<td>
						Apellidos:
			</td>
			
			<td>
				".$defaults['Apellidos']."
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						Tipo Documeno:
			</td>
			
			<td>
				".$defaults['doc']."
				<input type='hidden' name='doc' value='".$defaults['doc']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						N&uacute;mero:
			</td>
			
			<td>
				".$defaults['dni']."
				<input type='hidden' name='dni' value='".$defaults['dni']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						Control:
			</td>
			
			<td colspan='2'>
				".$defaults['ldni']."
				<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
			</td>
		</tr>
				

		<tr>
			<td>
						Mail:
			</td>
			<td colspan='2'>
				".$defaults['Email']."
				<input type='hidden'' name='Email' value='".$defaults['Email']."' />
			</td>
		</tr>	
				
		<tr>
			<td>
						Nombre de Usuario:
			</td>
			<td colspan='2'>
				".$defaults['Usuario']."
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
			</td>
		</tr>
							
		<tr>
			<td>
						Password:
			</td>
			<td colspan='2'>
				".$defaults['Password']."
				<input type='hidden' name='Password' value='".$defaults['Password']."' />
			</td>
		</tr>

		<tr>
			<td>
						Dirección:
			</td>
			<td colspan='2'>
				".$defaults['Direccion']."
				<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td>
						Teléfono 1:
			</td>
			<td colspan='2'>
				".$defaults['Tlf1']."
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
			</td>
		</tr>
				
		<tr>
			<td class='BorderInf'>
						Teléfono 2:
			</td>
			<td class='BorderInf' colspan='2'>
				".$defaults['Tlf2']."
				<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
			</td>
		</tr>
				
		<tr align='center'>
			<td colspan='3' align='right'>
				<input type='submit' value='BORRAR DATOS PERMANENTEMENTE' />
				<input type='hidden' name='borrar' value=1 />
			</td>
		</tr>
				
</form>														
			
	</table>");
	
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

	global $nombre;		$nombre = $_POST['Nombre'];
	global $apellido;	$apellido = $_POST['Apellidos'];
	global $rf; 		$rf = $_POST['ref'];
		
	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }
		
	$ActionTime = date('H:i:s');
	
	
	global $LogText;
	$LogText = "- ADMIN FEEDBACK BORRAR 2 ".$ActionTime.". ".$nombre." ".$apellido.".\n\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].".\n\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

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