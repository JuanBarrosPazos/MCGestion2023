<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $gst_admin WHERE `id` = '$_POST[id]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){
				 /* Si el nivel de acceso es correcto. */	
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
	$sql =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sql);
	$rowseccion = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowseccion['nombre'];

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
				</tr>
								
			</table>	
		";

	require "../config/TablesNames.php";
	$sql2x =  "SELECT * FROM `$db_name`.$secc WHERE $secc.`valor` = '$_POST[valor]'";
	$q2x = mysqli_query($db, $sql2x);
	$row2x = mysqli_fetch_assoc($q2x);

	if(mysqli_num_rows($q2x)== 0){

	$sqlc = "INSERT INTO `$db_name`.$secc (`valor`, `nombre`, `ref`, `coment`) VALUES ('$_POST[valor]', '$_POST[nombre]', '$_POST[ref]', '$_POST[coment]')";

	if(mysqli_query($db, $sqlc)){
			print("</br>
				SE HA RECUPERADO EL PRODUCTO EN SECCION ".$_sec." / ".$_POST['nombre'].".");
			print( $tabla );
				} else {
				print("<font color='#FF0000'>
						* </font>&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
							}


	/**************  SI SE RECUPERA EL PRODUCTO 
								GRABA LOS DATOS DE FEED STOCK EN STOCK *****************/

	$feedfil = $_POST['valor'];
	$feedfil = "%".$feedfil."%";
			
	require "../config/TablesNames.php";
	$sqlfeed =  "SELECT * FROM `$db_name`.$feedtable WHERE $feedtable.`producto` LIKE '$feedfil'";
			$qfeed = mysqli_query($db, $sqlfeed);
//			$rowfeed = mysqli_fetch_assoc($qfeed);
	while($rowfeed = mysqli_fetch_assoc($qfeed)){
													
						/*	print(	"* ".$rowfeed['producto'].".</br>	
									* ".$rowfeed['nsemana'].".</br>
									* ".$rowfeed['kgin'].".</br>
									* ".$rowfeed['datekgin'].".</br>"
							);	*/	
										
	$FBaja = date('Y-m-d/H:i:s');
	$entrada = $rowfeed['kgin'];
	$perecedero = $rowfeed['kgbad'];
	$caja = $rowfeed['kgcash'];
	$diferencia = ($entrada - $perecedero) - $caja;

	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
			
	require "../config/TablesNames.php";

	$sqlf = "INSERT INTO `$db_name`.$tablastock3 (`nsemana`, `producto`,`proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`) VALUES ('$rowfeed[nsemana]', '$rowfeed[producto]', '$rowfeed[proname]', '$rowfeed[psiva]', '$rowfeed[iva]', '$rowfeed[ivae]', '$rowfeed[pvp]', '$rowfeed[kgin]', '$rowfeed[datekgin]',  '$rowfeed[kgbad]', '$rowfeed[datekgbad]', '$rowfeed[kgcash]', '$rowfeed[pvptot]', '$rowfeed[datecash]', '$diferencia', '$rowfeed[coment]')";
	
	if(mysqli_query($dbf, $sqlf)){
	print("</br>
	HA GRABADO LAS ENTRADAS EN STOCK ".$_POST['nombre']." / ".$rowfeed['producto'].". OK. ");
						} 
						else {
				print("<font color='#FF0000'>
						* </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($dbf)).
						"</br>";
					}
								} /* FIN DEL WHILE */

	/************* SI SE RECUPERA EL PRODUCTO 
						BORRA LOS PRODUCTOS DEL FEED STOCK ******************/

	$filmod = $_POST['valor'];
	$filmod = "%".$filmod."%";
			
	require "../config/TablesNames.php";
	
	$sqlmod = "DELETE FROM `$db_name`.$feedtable WHERE $feedtable.`producto` LIKE '$filmod' ";

			if(mysqli_query($db, $sqlmod)){
					print("</br>
	SE HAN BORRADO LOS PRODUCTOS EN FEED STOCK ".$feedtable.": ".$_POST['valor'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
									

	} /* FIN DEL IF DE RECUPERAR PRODCUTO 
				Y SI NO SE RECUPERA EL PRODUCTO
						LOS SIGUIENTE => 	*/
	
	else {print("<table align='center' style='margin-top:60px'>
					<tr>
						<th>
						<font color='#FF0000'>
						EL PRODUCTO ".$_POST['valor']." / ".$_POST['nombre'].
						"</br></br> 
						YA EXISTE.
						</br></br>
						NO SE PUEDE RECUPERAR.
						</font>
						</th>
					</tr>
				</table>");
					}

	/******************************

	$filmod = $_POST['valor'];
	$filmod = "%".$filmod."%";
			
	require "../config/TablesNames.php";
	
	$sqlmod = "DELETE FROM `$db_name`.$tablafeedpro2 WHERE $tablafeedpro2.`id` LIKE '$_POST[id]' LIMIT 1 ";

			if(mysqli_query($db, $sqlmod)){
					print("</br>
	SE HA BORRADO EL PRODUCTO EN ".$tablafeedpro2." / ".$_POST['valor'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
									*/

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
	$sqlx =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowseccion['nombre'];
	$producto = "feedpro".$_POST['seccion'];

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=5 class='BorderInf'>

							RECUPERAR PROCUTO EN SECCION ".$_sec."
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
						COMENTARIOS:
					</td>
					<td width=250px>
		<input type='hidden' name='coment' value='".$defaults['coment']."' />".$defaults['coment']."
	
					</td>
				</tr>
				
				<tr>
					<td>						
						BORRADO
					</td>
					<td>
		<input type='hidden' name='borrado' value='".$defaults['borrado']."' />".$defaults['borrado']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr height=40px>
					<td  colspan=2 align='right'>
						<input type='submit' value='RECUPERAR PRODUCTO' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				

				"); 

	
	}	/* Fin de la función show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_modifica_02(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTOS FEEDBACK RECUPERAR 3: ".$ActionTime.". ".$secc.", ".$_POST['id'].", ".$_POST['nombre'].", ".$_POST['valor'].", ".$_POST['ref'].", ".$_POST['coment'];

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

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTOS FEEDBACK RECUPERAR 2: ".$ActionTime.". ".$secc.", ".$_POST['id'].", ".$_POST['nombre'].", ".$_POST['valor'].", ".$_POST['ref'].", ".$_POST['coment'].", DELETE DATE: ".$_POST['borrado'];

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