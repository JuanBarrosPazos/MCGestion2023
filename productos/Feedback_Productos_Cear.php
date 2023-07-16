<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $gst_admin WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();


						if($_POST['oculto']){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											accion_Stock_Crear();
											}
							
							} else {
										show_form();
								}
				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	global $sqld;
 	
	global $qd;
	
	global $rowd;

	$errors = array();
	
	if(strlen(trim($_POST['valor'])) == 0){
		$errors [] = "VALOR <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['valor'])) < 6){
		$errors [] = "VALOR <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['valor'])){
		$errors [] = "VALOR <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z,A-Z,0-9._]+$/',$_POST['valor'])){
		$errors [] = "VALOR <font color='#FF0000'>Sin espacios ni acentos. Se permite . o _ </font>";
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
		$errors [] = "REFERENCIA  <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[A-Z,0-9\s]+$/',$_POST['ref'])){
		$errors [] = "REFERENCIA  <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
}

		
if (strlen(trim($_POST['coment'])) > 0){

	if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ €]+$/',$_POST['coment'])){
		$errors [] = "COMENTARIOS  <font color='#FF0000'>A escrito caracteres no permitidos. { } [ ] ¿ ? < > ¡ ! @ # ...</font>";
		}
}

	return $errors;


		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];
	$producto = "feedpro".$_POST['seccion'];

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SE HA GRABADO FEEDPRO".$_sec."
					</th>
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
						COMENTARIOS.
					</td>
					<td>"
						.$_POST['coment'].
					"</td>
				</tr>
								
			</table>"; 
		
	$FBaja = 'CREADO MANUALMENTE';

	require "../config/TablesNames.php";
	
	$sql = "INSERT INTO `$db_name`.$tablafeedpro2 (`valor`, `nombre`, `ref`, `coment`, `borrado`) VALUES ('$_POST[valor]', '$_POST[nombre]', '$_POST[ref]', '$_POST[coment]', '$FBaja')";
		
	if(mysqli_query($db, $sql)){
			print("</br>
					SE HAN GRABADO LOS DATOS");
			print( $tabla );
				} else {
				print("</br>
				<font color='#FF0000'>
		* </font></br> ".mysqli_error($db))."
				</br>";
				show_form ();
				
					}
		
			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	global $producto;
	
	if($_POST['oculto1']){
		$defaults = $_POST;
				$defaults = array (	'seccion' => $_POST['seccion'],
									'valor' => $_POST['valor'],
								   	'nombre' => $_POST['nombre'],
								   	'ref' => $_POST['ref'],
								   	'coment' => $_POST['coment'],
								   	'producto' => $producto,								   );
		} 
	elseif($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'seccion' => $_POST['seccion'],
									'valor' => $_POST['valor'],
								   	'nombre' => $_POST['nombre'],
								   	'ref' => $_POST['ref'],
								   	'coment' => '',
								   	'producto' => $producto,
												);
								   					}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
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
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						GRABAR DATOS EN FEEDPRO".$_sec."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UNA SECCIÓN' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

						<select name='seccion'>");
						
	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $gst_secciones ORDER BY `valor` ASC ";
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['valor']."' ");
					
					if($rows['valor'] == $defaults['seccion']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows['nombre']." </option>");
												
										}
								
									} 

	print ("	</select>
					</td>
			</tr>
	
		</form>	
			
			</table>				
				"); 
				
	if ($_POST['oculto1'] || $_POST['oculto'] ) {
	if ($_POST['seccion'] == '0') { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
										HA DE SELECCIONAR UNA SECCIÓN PARA GRABAR DATOS.
											</font>
										</td>
									</tr>
								</table>");
												}	

//////////////////////////

		if ($_POST['seccion'] == ''){print("
								<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													SELECCIONE UNA SECCIÓN.
											</font>
										</td>
									</tr>
								</table>");} 
								
	elseif ($_POST['seccion'] != '') { 
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							NUEVO PRODUCTO EN FEEDPRO".$_sec."
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						

			<tr>								
						<td>
				<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
						</td>
			</tr>

				<tr>
					<td>
						VALOR
					</td>
					<td>

		<input type='text' name='valor' size=25 maxlength=20 value='".$defaults['valor']."' />

					</td>
				</tr>
									
				<tr>
					<td>						
						NOMBRE
					</td>
					<td>
		<input type='text' name='nombre' size=25 maxlength=20 value='".$defaults['nombre']."' />
					</td>
				</tr>
									
				<tr>
					<td>						
						REFERENCIA
					</td>
					<td>
		<input type='text' name='ref' size=25 maxlength=14 value='".$defaults['ref']."' />
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
								
				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='Grabar estos datos' />
						<input type='hidden' name='oculto' value=1 />
				</tr>
				
		</form>														
			
			</table>				
				");
											}
												}
	
	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Stock_Crear(){

	global $rowout;
	global $tablafeedpro2;

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTOS FEEDBACK CREAR ".$ActionTime.". ".$tablafeedpro2.", ".$_POST['nombre'].", ".$_POST['valor'].", ".$_POST['ref'].", ".$_POST['coment'];

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