<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $admin WHERE `id` = '$_POST[id]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
								show_form();
								accion_modifica_01();
								}
							elseif($_POST['oculto']){
												process_form();
												accion_modifica_02();
								} else {
											show_form();
									}

				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	require "../config/TablesNames.php";
	$sql =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sql);
	$rowseccion = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = "FEED PRO ".$rowseccion['nombre'];

	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2  class='BorderInf'>
						NUEVOS DATOS.
					</th>
				</tr>
				
				<tr>
					<td>
						ID
					</td>
					<td>"
						.$_POST['id'].
					"</td>
				</tr>				
				
				<tr>
					<td>						
						VALOR
					</td>
					<td>"
						.$_POST['valor'].
					"</td>
				</tr>
				
				<tr>
					<td>						
						NOMBRE
					</td>
					<td>"
						.$_POST['nombre'].
					"</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>						
						COMENTARIOS
					</td>
					<td width=250px>"
						.$_POST['coment'].
					"</td>
				
				<tr>
					<td>						
						BORRADO
					</td>
					<td width=250px>"
						.$_POST['borrado'].
					"</td>
				</tr>
			</table>";	
		
	require "../config/TablesNames.php";

	$sqlc = "DELETE FROM `$db_name`.$tablafeedpro2 WHERE $tablafeedpro2.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print("</br>
				SE HAN BORRADO LOS DATOS EN ".$_sec." / ".$_POST['nombre'].".");
			print( $tabla );
				} else {
				print("<font color='#FF0000'>
						* </font>&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
							}

			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
		
	global $producto;

	if($_POST['oculto2']){
		
				$defaults = array ( 'id' => $_POST['id'],
									'seccion' => $_POST['seccion'],
									'valor' => $_POST['valor'],
								   	'nombre' => $_POST['nombre'],
								   	'ref' => $_POST['ref'],
								   	'coment' => $_POST['coment'],
									'borrado' => $_POST['borrado'],
							   		'producto' => $producto,
																		 );
								   											}
								   
		elseif($_POST['oculto']){
			
				$defaults = array ( 'id' => $_POST['id'],
									'seccion' => $_POST['seccion'],
									'valor' => $_POST['valor'],
								   	'nombre' => $_POST['nombre'],
								   	'ref' => $_POST['ref'],
								   	'coment' => $_POST['coment'],
									'borrado' => $_POST['borrado'],
								   	'producto' => $producto,
																		 );
						} 
		
		else{
			
				$defaults = $_POST;
									}
									
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>** </font>".$errors [$a]."</br>");
			}
		}
		
	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];
	
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=5 class='BorderInf'>

							BORRAR PROCUTO EN FEED ".$_sec."
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						

		<input name='seccion' type='hidden' value='".$_POST['seccion']."' />

				<tr>
					<td>
						ID
					</td>
					<td>
		<input name='id' type='hidden' value='".$_POST['id']."' />".$_POST['id']."
					</td>
				</tr>

				<tr>
					<td>
						VALOR
					</td>
					<td>
	<input type='hidden' name='valor' value='".$defaults['valor']."' />".$defaults['valor']."

					</td>
				</tr>

				<tr>
					<td>						
						NOMBRE
					</td>
					<td>
	<input type='hidden' name='nombre' value='".$defaults['nombre']."' />".$defaults['nombre']."
					</td>
				</tr>
									
				<tr>
					<td>						
						REFERENCIA
					</td>
					<td>
		<input type='hidden' name='ref' value='".$defaults['ref']."' />".$defaults['ref']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>
						COMENTARIOS
					</td>
					<td width=250px>
		<input type='hidden' name='coment' value='".$defaults['coment']."' />".$defaults['coment']."
	
					</td>
				</tr>

				<tr>
					<td>
						BORRADO
					</td>
					<td width=250px>
		<input type='hidden' name='borrado' value='".$defaults['borrado']."' />".$defaults['borrado']."
	
					</td>
				</tr>
				
				<tr height=40px>
					<td  colspan=2 align='right'>
						<input type='submit' value='BORRAR FEED PRO' />
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
///

function accion_modifica_02(){

	global $rowout;
	global $tablafeedpro2;

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTOS FEEDBACK BORRAR 3 ".$ActionTime.". ".$tablafeedpro2.", ".$_POST['id'].", ".$_POST['nombre'].", ".$_POST['valor'].", ".$_POST['ref'].", ".$_POST['coment'].", ".$_POST['borrado'];

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
///

function accion_modifica_01(){

	global $rowout;
	global $tablafeedpro2;
	
	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTOS FEEDBACK BORRAR 2 ".$ActionTime.". ".$tablafeedpro2.", ".$_POST['id'].", ".$_POST['nombre'].", ".$_POST['valor'].", ".$_POST['ref'].", ".$_POST['coment'].", ".$_POST['borrado']."\n";

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text.".log";
		$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Productos.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>