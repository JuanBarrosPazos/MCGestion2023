<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

$sqld =  "SELECT * FROM `admin` WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
 	
	$qd = mysqli_query($db, $sqld);
	
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

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
				}
					else { 
					
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
	
		if($_FILES['myimg1']['size'] == 0){}
		else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
	
	$extension1 = substr($_FILES['myimg1']['name'],-3);
	// print($extension1);
	// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
	$ext_correcta1 = in_array($extension1, $ext_permitidas);

	$tipo_correcto1 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg1']['type']);

		if(!$ext_correcta1){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg1']['name'];
			}

		elseif(!$tipo_correcto1){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg1']['name'];
			}

	elseif ($_FILES['myimg1']['size'] > $limite){
	$tamanho1 = $_FILES['myimg1']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg1']['name']." es mayor de 500 KBytes. ".$tamanho1." KB";
			}
		
			elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}
		
//////////////

		if($_FILES['myimg2']['size'] == 0){}
		else{
		 
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
		
		$extension2 = substr($_FILES['myimg2']['name'],-3);
		// print($extension2);
		// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
		$ext_correcta2 = in_array($extension2, $ext_permitidas);

	$tipo_correcto2 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg2']['type']);

		 
		if(!$ext_correcta2){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg2']['name'];
			}

		elseif(!$tipo_correcto2){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg2']['name'];
			}

	elseif ($_FILES['myimg2']['size'] > $limite){
	$tamanho2 = $_FILES['myimg2']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg2']['name']." es mayor de 500 KBytes. ".$tamanho2." KB";
			}
		
			elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

//////////////

		if($_FILES['myimg3']['size'] == 0){}
		else{
		 
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
		
		$extension3 = substr($_FILES['myimg3']['name'],-3);
		// print($extension3);
		// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
		$ext_correcta3 = in_array($extension3, $ext_permitidas);

	$tipo_correcto3 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg3']['type']);

		 
		if(!$ext_correcta3){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg3']['name'];
			}

		elseif(!$tipo_correcto3){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg3']['name'];
			}

	elseif ($_FILES['myimg3']['size'] > $limite){
	$tamanho3 = $_FILES['myimg3']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg3']['name']." es mayor de 500 KBytes. ".$tamanho3." KB";
			}
		
			elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

//////////////

		if($_FILES['myimg4']['size'] == 0){}
		else{
		 
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
		
		$extension4 = substr($_FILES['myimg4']['name'],-3);
		// print($extension4);
		// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
		$ext_correcta4 = in_array($extension4, $ext_permitidas);

	$tipo_correcto4 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg4']['type']);

		if(!$ext_correcta4){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg4']['name'];
			}

		elseif(!$tipo_correcto4){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg4']['name'];
			}

	elseif ($_FILES['myimg4']['size'] > $limite){
	$tamanho4 = $_FILES['myimg4']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg4']['name']." es mayor de 500 KBytes. ".$tamanho4." KB";
			}
		
			elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

		///////////////////////////////////////////////////////////////////////////////////

	
	if(strlen(trim($_POST['valor'])) == 0){
		$errors [] = "VALOR <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['valor'])) < 6){
		$errors [] = "VALOR <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['valor'])){
		$errors [] = "VALOR <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z,0-9._]+$/',$_POST['valor'])){
		$errors [] = "VALOR <font color='#FF0000'>Solo mminusculas. Se permite . o _ </font>";
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
	global $db_name;	
	global $secc;	
	$secc = $_POST['seccion'];
	

	global $_sec;

	$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SE HA GRABADO EN ".$_sec."
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
					<td width=250px>"
						.$_POST['coment'].
					"</td>
				</tr>
								
			</table>	
		";	 
		
	/************* CREAMOS LAS IMAGENES EN LA IMG PRO SECCION ***************/

		$secc1 = "imgpro".$_POST['seccion'];
		$secc1 = "`".$secc1."`";

		$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `producto` = '$_POST[valor]'";
		$qc = mysqli_query($db, $sqlc);
		global $conutc;
		$countc = mysqli_num_rows($qc);
		$rowsc = mysqli_fetch_assoc($qc);
		global $exist;
		$exist = print("<div align='center'>YA EXISTE EL PRODUCTO</div>");
	if($countc > 0){$exist;
					show_form();}
	else{
		
		/////////////

	if($_FILES['myimg1']['size'] == 0){
			$new_name1 = 'untitled.png';
			$new_name1 = $_POST['valor']."_1.png";
			$rename_filename1 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name1;								
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename1);
												}
		else{

			$safe_filename1 = trim(str_replace('/', '', $_FILES['myimg1']['name']));
			$safe_filename1 = trim(str_replace('..', '', $safe_filename1));
	
			$nombre1 = $_FILES['myimg1']['name'];
			$nombre1_tmp = $_FILES['myimg1']['tmp_name'];
			$tipo1 = $_FILES['myimg1']['type'];
			$tamano1 = $_FILES['myimg1']['size'];
	
			$destination_file1 = "../imgpro/imgpro".$_POST['seccion']."/".$safe_filename1;
		
	    if( file_exists("../imgpro/imgpro".$_POST['seccion']."/".$nombre1) ){
				unlink("../imgpro/imgpro".$_POST['seccion']."/".$nombre1);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg1']['tmp_name'], $destination_file1)){

			// Renombrar el archivo:
			$extension1 = substr($_FILES['myimg1']['name'],-3);
			// print($extension1);
			// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
			global $new_name1;
			$new_name1 = $_POST['valor']."_1.".$extension1;
			$rename_filename1 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name1;								
			rename($destination_file1, $rename_filename1);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}
		}

		/////////////

	if($_FILES['myimg2']['size'] == 0){$new_name2 = 'untitled.png';
			$new_name2 = $_POST['valor']."_2.png";
			$rename_filename2 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name2;								
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename2);
		}
		else{
			
			$safe_filename2 = trim(str_replace('/', '', $_FILES['myimg2']['name']));
			$safe_filename2 = trim(str_replace('..', '', $safe_filename2));

			$nombre2 = $_FILES['myimg2']['name'];
			$nombre2_tmp = $_FILES['myimg2']['tmp_name'];
			$tipo2 = $_FILES['myimg2']['type'];
			$tamano2 = $_FILES['myimg2']['size'];

			$destination_file2 = "../imgpro/imgpro".$_POST['seccion']."/".$safe_filename2;

			if( file_exists("../imgpro/imgpro".$_POST['seccion']."/".$nombre2) ){
				unlink("../imgpro/imgpro".$_POST['seccion']."/".$nombre2);
			//	print("** El archivo ".$nombre2." Ya existe, seleccione otra imagen.</br>");
				}
			elseif (move_uploaded_file($_FILES['myimg2']['tmp_name'], $destination_file2)){
				// Renombrar el archivo:
				$extension2 = substr($_FILES['myimg2']['name'],-3);
				// print($extension2);
				// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
				global $new_name2;
				$new_name2 = $_POST['valor']."_2.".$extension2;
				$rename_filename2 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name2;								
				rename($destination_file2, $rename_filename2);
			}	
			else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}

			}
			
		/////////////

	if($_FILES['myimg3']['size'] == 0){$new_name3 = 'untitled.png';
			$new_name3 = $_POST['valor']."_3.png";
			$rename_filename3 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name3;								
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename3);
		}
		else{
			
			$safe_filename3 = trim(str_replace('/', '', $_FILES['myimg3']['name']));
			$safe_filename3 = trim(str_replace('..', '', $safe_filename3));

			$nombre3 = $_FILES['myimg3']['name'];
			$nombre3_tmp = $_FILES['myimg3']['tmp_name'];
			$tipo3 = $_FILES['myimg3']['type'];
			$tamano3 = $_FILES['myimg3']['size'];

			$destination_file3 = "../imgpro/imgpro".$_POST['seccion']."/".$safe_filename3;

			if( file_exists("../imgpro/imgpro".$_POST['seccion']."/".$nombre3) ){
				unlink("../imgpro/imgpro".$_POST['seccion']."/".$nombre3);
			//	print("** El archivo ".$nombre3." Ya existe, seleccione otra imagen.</br>");
				}
			elseif (move_uploaded_file($_FILES['myimg3']['tmp_name'], $destination_file3)){
				// Renombrar el archivo:
				$extension3 = substr($_FILES['myimg3']['name'],-3);
				// print($extension3);
				// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
				global $new_name3;
				$new_name3 = $_POST['valor']."_3.".$extension3;
				$rename_filename3 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name3;								
				rename($destination_file3, $rename_filename3);
			}	
			else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}

			}
			
		/////////////
		
	if($_FILES['myimg4']['size'] == 0){$new_name4 = 'untitled.png';
			$new_name4 = $_POST['valor']."_4.png";
			$rename_filename4 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name4;								
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename4);
		}
		else{
			
			$safe_filename4 = trim(str_replace('/', '', $_FILES['myimg4']['name']));
			$safe_filename4 = trim(str_replace('..', '', $safe_filename4));

			$nombre4 = $_FILES['myimg4']['name'];
			$nombre4_tmp = $_FILES['myimg4']['tmp_name'];
			$tipo4 = $_FILES['myimg4']['type'];
			$tamano4 = $_FILES['myimg4']['size'];

			$destination_file4 = "../imgpro/imgpro".$_POST['seccion']."/".$safe_filename4;

			if( file_exists("../imgpro/imgpro".$_POST['seccion']."/".$nombre4) ){
				unlink("../imgpro/imgpro".$_POST['seccion']."/".$nombre4);
			//	print("** El archivo ".$nombre4." Ya existe, seleccione otra imagen.</br>");
				}
			elseif (move_uploaded_file($_FILES['myimg4']['tmp_name'], $destination_file4)){
				// Renombrar el archivo:
				$extension4 = substr($_FILES['myimg4']['name'],-3);
				// print($extension4);
				// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
				global $new_name4;
				$new_name4 = $_POST['valor']."_4.".$extension4;
				$rename_filename4 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name4;								
				rename($destination_file4, $rename_filename4);
			}	
			else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}

			}
			
		/////////////
		
		global $db;
		global $db_name;

		$secc2 = "imgpro".$_POST['seccion'];
		$secc2 = "`".$secc2."`";

	$sqla = "INSERT INTO `$db_name`.$secc2 (`producto`,`proname`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[valor]', '$_POST[nombre]', '$new_name1', '$new_name2', '$new_name3', '$new_name4')";
		
		if(mysqli_query($db, $sqla)){} 
						else {
							print("* MODIFIQUE LA ENTRADA: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
		
	}
	
	/************* CREAMOS EL PRODUCTO EN LA TABLA PRO SECCION ***************/

	$secc3 = "pro".$_POST['seccion'];
	$secc3 = "`".$secc3."`";

	global $db_name;
	
	$sqld =  "SELECT * FROM `$db_name`.$secc3 WHERE `valor` = '$_POST[valor]'";
	$qd = mysqli_query($db, $sqld);
	$countd = mysqli_num_rows($qd);
	$rowsd = mysqli_fetch_assoc($qd);
	global $conutc;
	global $exist;
	if($countc > 0){$exist = '';}
	if($countd > 0){$exist;}
	else{
	$sql = "INSERT INTO `$db_name`.$secc3 (`valor`, `nombre`, `ref`, `coment`) VALUES ('$_POST[valor]', '$_POST[nombre]', '$_POST[ref]', '$_POST[coment]')";
		
	if(mysqli_query($db, $sql)){
								print( $tabla );
				} else {
				print("</br>
				<font color='#FF0000'>* </font></br> ".mysqli_error($db))."
				</br>";
				show_form ();
				}
			}

		/************* CREAMOS EL PRODUCTO EN LA TABLA FEED PRO SSECCION *******************/

	$secc4 = "feedpro".$_POST['seccion'];
	$secc4 = "`".$secc4."`";

	global $db_name;

	$FBaja = 'CREATE AUTO';
	
	$sqlf =  "SELECT * FROM `$db_name`.$secc4 WHERE `valor` = '$_POST[valor]'";
	$qf = mysqli_query($db, $sqlf);
	$countf = mysqli_num_rows($qf);
	$rowsf = mysqli_fetch_assoc($qf);
	global $conutc;
	global $conutd;
	global $exist;
	if(($countc > 0)||($countd > 0)){$exist = '';}
	if($countf > 0){$exist;}
	else{
	$sql = "INSERT INTO `$db_name`.$secc4 (`valor`, `nombre`, `ref`, `coment`, `borrado`) VALUES ('$_POST[valor]', '$_POST[nombre]', '$_POST[ref]', '$_POST[coment]', '$FBaja')";
		
	if(mysqli_query($db, $sql)){
			print("");
				} else {
				print("</br>
				<font color='#FF0000'>* </font></br> ".mysqli_error($db))."
				</br>";
					}
	}
	
	
			}	/* Final process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto1']){
		$defaults = $_POST;
				$defaults = array (	'seccion' => $_POST['seccion'],
									'valor' => $_POST['valor'],
								   	'nombre' => $_POST['nombre'],
								   	'ref' => $_POST['ref'],
								   	'coment' => $_POST['coment'],
								   	'producto' => $producto,	
									'myimg1' => $_POST['myimg1'],	
									'myimg2' => $_POST['myimg2'],	
									);
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
									'myimg1' => $_POST['myimg1'],	
									'myimg2' => $_POST['myimg2'],	
												);
								   					}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
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
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						CREAR PRODUCTO EN LA SECCIÓN ".$_sec."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UNA SECCIÓN' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

						<select name='seccion'>");
						
			/* RECORREMOS el LOS VALORES DE LA TABLA PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `secciones` ORDER BY `valor` ASC ";
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
										HA DE SELECCIONAR UNA SECCIÓN PARA CREAR PRODUCTOS.
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
								
	elseif ($_POST['seccion'] !== '') { 
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							NUEVO PRODUCTO EN ".$_sec."
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
						

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

		<input type='text' name='valor' size=16 maxlength=14 value='".$defaults['valor']."' />

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
								
				<tr>
					<td>
						FOTOGRAFÍA 1
					</td>
					<td>
		<input type='file' name='myimg1' value='".$defaults['myimg1']."' />						
					</td>
				</tr>

				<tr>
					<td>
						FOTOGRAFÍA 2
					</td>
					<td>
		<input type='file' name='myimg2' value='".$defaults['myimg2']."' />						
					</td>
				</tr>

				<tr>
					<td>
						FOTOGRAFÍA 3
					</td>
					<td>
		<input type='file' name='myimg3' value='".$defaults['myimg3']."' />						
					</td>
				</tr>

				<tr>
					<td>
						FOTOGRAFÍA 4
					</td>
					<td>
		<input type='file' name='myimg4' value='".$defaults['myimg4']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='CREAR PRODUCTO' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				
						"); 
											}
												}
	
			}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Stock_Crear(){

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
$text = "- PRODUCTO CREAR ".$ActionTime.". ".$secc.".\n\t Pro Name: ".$_POST['nombre'].".\n\t Pro Valor: ".$_POST['valor'].".\n\t Pro Ref: ".$_POST['ref'].".\n\t Coment: ".$_POST['coment'];

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