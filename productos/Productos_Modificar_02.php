<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

	$sqld =  "SELECT * FROM `admin` WHERE `ID` = '$_POST[ID]'";
 	
	$qd = mysqli_query($db, $sqld);
	
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
								show_form();
								accion_modifica_01();
													}
							elseif($_POST['oculto']){
								
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else {
												process_form();
												accion_modifica_02();
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

	$errors = array();
	
	
	if(strlen(trim($_POST['valor2'])) == 0){
		$errors [] = "VALOR <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['valor2'])) < 6){
		$errors [] = "VALOR <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['valor2'])){
		$errors [] = "VALOR <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z,0-9._]+$/',$_POST['valor2'])){
		$errors [] = "VALOR <font color='#FF0000'>Solo minusculas. Se permite . o _ .</font>";
		}

	
	if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "NOMBRE <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 5){
		$errors [] = "NOMBRE <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['nombre'])){
		$errors [] = "NOMBRE <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[A-Z,0-9\s]+$/',$_POST['nombre'])){
		$errors [] = "NOMBRE <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
	
	
if (strlen(trim($_POST['ref'])) > 0){
		
	if (strlen(trim($_POST['ref'])) < 10){
		$errors [] = "REFERENCIA <font color='#FF0000'>Más de 9 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['ref'])){
	$errors [] = "REFERENCIA  <font color='#FF0000'>No valido. Se permite _</font>";
		}
		
	elseif (!preg_match('/^[a-z,0-9_\s]+$/',$_POST['ref'])){
	$errors [] = "REFERENCIA  <font color='#FF0000'>Solo minusculas. Se permite _ o espacio.</font>";
		}
}

		
if (strlen(trim($_POST['coment'])) > 0){

	if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ €]+$/',$_POST['coment'])){
		$errors [] = "COMENTARIOS  <font color='#FF0000'>A escrito caracteres no permitidos. { } [ ] ¿ ? < > ¡ ! @ # ...</font>";
		}
}

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;

	global $secc;	
	$secc = "pro".$_POST['seccion'];
	
	global $db;
	global $_sec;

	$sql =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sql);
	$rowseccion = mysqli_fetch_assoc($q);
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
						.$_POST['valor2'].
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
					<td>"
						.$_POST['coment'].
					"</td>
				</tr>
								
			</table>	
		";	

/******** MODIFICA VARIABLE Y NOMBRE DEL PRODUCTO EN LA TABLA PRODUCTO   *********/

	$secc = "pro".$_POST['seccion'];
	$secc = "`".$secc."`";
	
	global $db_name;

$sqlc = "UPDATE `$db_name`.$secc SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]', `ref` = '$_POST[ref]', `coment` = '$_POST[coment]' WHERE $secc.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print("</br>
				SE HAN MODIFICADO PRO".$_sec." / ".$_POST['nombre'].".");
			print( $tabla );
				} else {
				print("<font color='#FF0000'>
						* </font>&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
							}


/******** SI NO EXISTE CREA EL PRODUCTO EN LA TABLA FEED PRODUCTO SECCIÓN *********/

	global $db;

			$mod2 = "feedpro".$_POST['seccion'];
			$mod2 = "`".$mod2."`";

	$sql2 =  "SELECT * FROM `$db_name`.$mod2 WHERE $mod2.`valor` = '$_POST[valor1]'";
	$q2 = mysqli_query($db, $sql2);
	$row2 = mysqli_fetch_assoc($q2);

	if(mysqli_num_rows($q2)== 0){

	$FBaja = 'CREATE AUTO';
	$sql3 = "INSERT INTO `$db_name`.$mod2 (`valor`, `nombre`, `ref`, `coment`, `borrado`) VALUES ('$_POST[valor2]', '$_POST[nombre]', '$_POST[ref]', '$_POST[coment]', '$FBaja')";
		
	if(mysqli_query($db, $sql3)){
			print("</br>
					SE HA CREADO EL PRODUCTO EN FEEDPRO".$_sec." / ".$_POST['nombre'].".");
				} else {
				print("</br>
				<font color='#FF0000'>* </font></br> ".mysqli_error($db))."
				</br>";
					}
									}

/******** MODIFICA VARIABLE Y NOMBRE DEL PRODUCTO EN LA TABLA FEEDPRODUCTO *********/

		if(mysqli_num_rows($q2)!== 0) {											
											
			global $db;
			global $_sec;
		
			$mod2 = "feedpro".$_POST['seccion'];
			$mod2 = "`".$mod2."`";
			$filmod = $_POST['valor1'];
			$filmod = "%".$filmod."%";

$sqlmod2 = "UPDATE `$db_name`.$mod2 SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]', `ref` = '$_POST[ref]', `coment` = '$_POST[coment]' WHERE $mod2.`valor` LIKE '$filmod' ";

			if(mysqli_query($db, $sqlmod2)){
					print("</br>
		SE HA MODIFICADO EN ".$mod2.": ".$_POST['valor2']." / ".$_POST['nombre'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
						}
						

/************* MODIFICA LA VARIABLE DEL PRODUCTO Y NOMBRE EN LA TABLA STOCK ***************/
	
	global $db_name;
	global $db;
	
			$mod = "stock".$_POST['seccion'];
			$mod = "`".$mod."`";
			$filmod = $_POST['valor1'];
			$filmod = "%".$filmod."%";
			$valormod = $_POST['valor2'];
			
$sqlmod = "UPDATE `$db_name`.$mod SET `producto` = '$valormod', `proname` = '$_POST[nombre]' WHERE $mod.`producto` LIKE '$filmod' ";

			if(mysqli_query($db, $sqlmod)){
					print("</br>
	HA MODIFICADO LAS VARIABLES EN ".$mod.": ".$_POST['valor1']." POR ".$_POST['valor2'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
									
/************* MODIFICA LA VARIABLE DEL PRODUCTO Y NOMBRE EN LA TABLA FEED  ***************/

			$modf = "feed".$_POST['seccion'];
			$modf = "`".$modf."`";
			$filmod = $_POST['valor1'];
			$filmod = "%".$filmod."%";
			$valormod = $_POST['valor2'];

	$sqlmodf = "UPDATE `$db_name`.$modf SET `producto` = '$valormod', `proname` = '$_POST[nombre]' WHERE $modf.`producto` LIKE '$filmod' ";

			if(mysqli_query($db, $sqlmodf)){
					print("</br>
	HA MODIFICADO LAS VARIABLES EN ".$modf.": ".$_POST['valor1']." POR ".$_POST['valor2'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
		

/********** MODIFICA LA VARIABLE Y NOMBRE DEL PRODUCTO EN LA TABLA VENTAS	***********/

	$modvn = "ventas_".date('Y');
	$modvn = "`".$modvn."`";
	
	$vn =  "SELECT * FROM `$db_name`.$modvn WHERE $modvn.`producto` = '$_POST[valor1]'";
	$qvn = mysqli_query($db, $vn);
	if(mysqli_num_rows($qvn)!== 0) {											
		
			$filmod = $_POST['valor1'];
			$filmod = "%".$filmod."%";
			$valormod = $_POST['valor2'];

	$sqlmodvn = "UPDATE `$db_name`.$modvn SET `producto` = '$valormod', `proname` = '$_POST[nombre]' = '$valormod' WHERE $modvn.`producto` LIKE '$filmod' ";

			if(mysqli_query($db, $sqlmodvn)){
					print("</br>
	HA MODIFICADO LAS VARIABLES EN ".$modvn.": ".$_POST['valor1']." POR ".$_POST['valor2'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
								}
//////////////
		
	$modvn2 = "ventas_".(date('Y')-1);
	$modvn2 = "`".$modvn2."`";
	
	$vn2 =  "SELECT * FROM `$db_name`.$modvn2 WHERE $modvn2.`producto` = '$_POST[valor1]'";
	$qvn2 = mysqli_query($db, $vn2);
	if(mysqli_num_rows($qvn2)!== 0) {											
		
			$filmod2 = $_POST['valor1'];
			$filmod2 = "%".$filmod2."%";
			$valormod2 = $_POST['valor2'];

	$sqlmodvn2 = "UPDATE `$db_name`.$modvn2 SET `producto` = '$valormod2', `proname` = '$_POST[nombre]' WHERE $modvn2.`producto` LIKE '$filmod2' ";

			if(mysqli_query($db, $sqlmodvn2)){
					print("</br>
	HA MODIFICADO LAS VARIABLES EN ".$modvn2.": ".$_POST['valor1']." POR ".$_POST['valor2'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
						}
							
/********** MODIFICA LA VARIABLE Y NOMBRE DEL PRODUCTO EN LA TABLA CAJA	***********/
	

	global $db_name;
	global $db;
	
			$modcj = "caja";
			$modcj = "`".$modcj."`";
			
	$cj =  "SELECT * FROM `$db_name`.`caja` WHERE $modcj.`producto` = '$_POST[valor1]'";
	$qcj = mysqli_query($db, $cj);

		if(mysqli_num_rows($qcj)!== 0) {											

			$filmod = $_POST['valor1'];
			$filmod = "%".$filmod."%";
			$valormod = $_POST['valor2'];
			
$sqlmod = "UPDATE `$db_name`.$modcj SET `producto` = '$valormod', `proname` = '$_POST[nombre]' WHERE $modcj.`producto` LIKE '$filmod' ";

			if(mysqli_query($db, $sqlmod)){
					print("</br>
	HA MODIFICADO LAS VARIABLES EN ".$modcj.": ".$_POST['valor1']." POR L392".$_POST['valor2'].".");
						} else {
						print("<font color='#FF0000'>
								* </font>&nbsp;&nbsp;".mysqli_error($db))."
								</br>";
									}
		}
		
}

		
//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
		
	if($_POST['oculto2']){
		
				$defaults = array ( 'id' => $_POST['id'],
									'seccion' => $_POST['seccion'],
									'valor1' => $_POST['valor'],
									'valor2' => $_POST['valor'],
								   	'nombre' => $_POST['nombre'],
								   	'ref' => $_POST['ref'],
								   	'coment' => $_POST['coment'],
								   	'producto' => $producto,
																		 );
								   											}
								   
		elseif($_POST['oculto']){
			
				$defaults = array ( 'id' => $_POST['id'],
									'seccion' => $_POST['seccion'],
									'valor1' => $_POST['valor1'],
									'valor2' => $_POST['valor2'],
								   	'nombre' => $_POST['nombre'],
								   	'ref' => $_POST['ref'],
								   	'coment' => $_POST['coment'],
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
		

	global $db;
	global $_sec;

	$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
 	
	$q = mysqli_query($db, $sqlx);

	$rowseccion = mysqli_fetch_assoc($q);
	
	$_sec = $rowseccion['nombre'];
	
	$producto = "pro".$_POST['seccion'];

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=5 class='BorderInf'>

							MODIFICAR PROCUTO EN ".$_sec."
					</th>
				</tr>
				
			<form name='oculto' method='post' action='$_SERVER[PHP_SELF]'>
						

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
	<input type='hidden' name='valor1' value='".$defaults['valor1']."' />".$defaults['valor1']."

					</td>
				</tr>

				<tr>
					<td>
						NUEVO VALOR
					</td>
					<td>

	<input type='text' name='valor2' size=16 maxlength=14 value='".$defaults['valor2']."' />

					</td>
				</tr>
									
				<tr>
					<td>						
						NOMBRE
					</td>
					<td>
	<input type='text' name='nombre' size=25 maxlength=23 value='".$defaults['nombre']."' />
					</td>
				</tr>
									
				<tr>
					<td>						
						REFERENCIA
					</td>
					<td>
	<input type='text' name='ref' size=16 maxlength=14 value='".$defaults['ref']."' />
					</td>
				</tr>
					
					</td>
				</tr>


				<tr>
					<td>
						COMENTARIOS:
					</td>
					<td>
					
	<textarea cols='35' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment'>".$defaults['coment']."</textarea>
	
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 200 characters            
				</div>

					</td>
				</tr>
				
				<tr align='center' height=60px>
					<td >
						<input type='submit' value='Modificar Estos Datos' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				

				");

	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_modifica_02(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTOS MODIFICA 3 ".$ActionTime.". ".$secc.".\n\t ID: ".$_POST['id'].".\n\t Pro Name: ".$_POST['nombre'].".\n\t Pro Valor Old: ".$_POST['valor1'].".\n\t Pro Valor New: ".$_POST['valor2'].".\n\t Pro Ref: ".$_POST['ref'].".\n\t Coment: ".$_POST['coment'];

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

function accion_modifica_01(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTOS MODIFICA 2 ".$ActionTime.". ".$secc.".\n\t ID: ".$_POST['id'].".\n\t Pro Name: ".$_POST['nombre'].".\n\t Pro Valor: ".$_POST['valor'].".\n\t Pro Ref: ".$_POST['ref'].".\n\t Coment: ".$_POST['coment'];

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
	
	function master_index(){
		
				require '../Inclu/Master_Index_Productos.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
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