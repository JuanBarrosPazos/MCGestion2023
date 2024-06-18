<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $admin WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();


						if($_POST['oculto']){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
										//	accion_Stock_Crear();
											}
							
							} else {
										show_form();
								}
				}
					else { 
					
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
	
		if($_FILES['myimg1']['size'] == 0){}
		else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','pdf','PDF');
	
	$extension1 = substr($_FILES['myimg1']['name'],-3);
	// print($extension1);
	// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
	$ext_correcta1 = in_array($extension1, $ext_permitidas);

	$tipo_correcto1 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg1']['type']);

	if(!$ext_correcta1){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg1']['name'];
			}
/*	
		elseif(!$tipo_correcto1){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg1']['name'];
			}
*/	
	
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
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','pdf','PDF');
		
		$extension2 = substr($_FILES['myimg2']['name'],-3);
		// print($extension2);
		// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
		$ext_correcta2 = in_array($extension2, $ext_permitidas);

	$tipo_correcto2 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg2']['type']);

		if(!$ext_correcta2){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg2']['name'];
			}
/*
		elseif(!$tipo_correcto2){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg2']['name'];
			}
*/
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
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','pdf','PDF');
		
		$extension3 = substr($_FILES['myimg3']['name'],-3);
		// print($extension3);
		// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
		$ext_correcta3 = in_array($extension3, $ext_permitidas);

	$tipo_correcto3 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg3']['type']);

		 
		if(!$ext_correcta3){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg3']['name'];
			}
/*
		elseif(!$tipo_correcto3){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg3']['name'];
			}
*/
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
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','pdf','PDF');
		
		$extension4 = substr($_FILES['myimg4']['name'],-3);
		// print($extension4);
		// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
		$ext_correcta4 = in_array($extension4, $ext_permitidas);

	$tipo_correcto4 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg4']['type']);

		if(!$ext_correcta4){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg4']['name'];
			}
/*
		elseif(!$tipo_correcto4){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg4']['name'];
			}
*/
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
	
	if(strlen(trim($_POST['factnum'])) == 0){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnum'])) < 5){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}

	elseif (!preg_match('/^[A-Z,0-9\s]+$/',$_POST['factnum'])){
$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}

/*
	
	if(strlen(trim($_POST['factdate'])) == 0){
		$errors [] = "FECHA <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factdate'])) < 5){
		$errors [] = "FECHA <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Caracteres no válidos.</font>";
		}
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}
*/

	 /*VALIDAMOS EL CAMPO factnom */
	
	if(strlen(trim($_POST['factnom'])) == 0){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnom'])) < 5){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}

	 /*VALIDAMOS EL CAMPO factnif */
	
	if(strlen(trim($_POST['factnif'])) == 0){
		$errors [] = "NIF/CIF <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnif'])) < 5){
		$errors [] = "NIF/CIF <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[A-Z,0-9\s]+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}

	/* Validamos el campo iva. */
	
	if($_POST['factiva'] == ''){
		$errors [] = "IVA: <font color='#FF0000'>SELECCIONE EL TIPO DE IVA</font>";
		}
					
	/* VALIDAMOS EL CAMPO factivae */
	
		if(strlen(trim($_POST['factivae1'])) == 0){
			$errors [] = "IVA € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae1'])){
			$errors [] = "IVA € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae1'])){
			$errors [] = "IVA € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factivae2'])) == 0){
			$errors [] = "IVA € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae2'])){
			$errors [] = "IVA € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae2'])){
			$errors [] = "IVA € <font color='#FF0000'>SOLO NUMEROS</font>";
			}
	/* VALIDAMOS EL CAMPO factpvp */
	
		if(strlen(trim($_POST['factpvp1'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvp2'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	/* VALIDAMOS EL CAMPO factpvptot */
	
		if(strlen(trim($_POST['factpvptot1'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot1'])){
			$errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot1'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvptot2'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot2'])){
			$errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot2'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	 /*VALIDAMOS EL CAMPO coment. */
		
	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "COMENTARIOS <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['coment'])) < 20){
		$errors [] = "COMENTARIOS <font color='#FF0000'>Más de 20 carácteres.</font>";
		}
		
	elseif (strlen(trim($_POST['coment'])) > 19){

	if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ €]+$/',$_POST['coment'])){
		$errors [] = "COMENTARIOS  <font color='#FF0000'>A escrito caracteres no permitidos. { } [ ] ¿ ? < > ¡ ! @ # ...</font>";
		}
	}

	 /*VALIDAMOS EL CAMPO dy & dm & dd */
		
	if(trim($_POST['dy']) == ''){
		$errors [] = "YEAR <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dm']) == ''){
		$errors [] = "MONTH <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dd']) == ''){
		$errors [] = "DAY <font color='#FF0000'>Campo obligatorio.</font>";
		}

////////////////

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;

	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;

	$fiva = $_POST['factiva'];
	
	$civae = $factpvp * ($fiva / 100);
	$civae = number_format($civae,2);
	if(trim($factivae) != trim($civae)){
			$errors [] = "IVA € <font color='#FF0000'>Cantidad no correcta</font> ".$civae." OK";
	}
	
	$cftot = $factpvp + $civae;
	$cftot = number_format($cftot,2);
	if(trim($factpvptot) != trim($cftot)){
			$errors [] = "TOTAL € <font color='#FF0000'>Cantidad no correcta</font> ".$cftot." OK";
	}
	
////////////////////
	
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	global $db_name;	
	
	global $dyt1;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {$dy1 = $_POST['dy'];
														$dy1 = $dy1;
														$dyt1 = "20".$_POST['dy'];
																		}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {$dm1 = $_POST['dm'];
												$dm1 = "/".$dm1."/";}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {$dd1 = $_POST['dd'];
												$dd1 = $dd1;}

	global $factdate;
	$factdate = $_POST['dy']."/".$_POST['dm']."/".$_POST['dd'];

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;

	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;

	require "../config/TablesNames.php";

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						SE HA GRABADO EN ".strtoupper($gastos)."
					</th>
				</tr>
				<tr>
					<td>NUMERO</td>
					<td>".$_POST['factnum']."</td>
					<td>FECHA</td>
					<td>".$factdate."</td>
				</tr>
				<tr>
					<td>RAZON SOCIAL</td>
					<td>".$_POST['factnom']."</td>
					<td>NIF / CIF</td>
					<td>".$_POST['factnif']."</td>
				</tr>
				<tr>
					<td>IVA %</td>
					<td>".$_POST['factiva']."</td>
					<td>IVA €</td>
					<td width=250px>".$factivae."</td>
				</tr>
				<tr>
					<td>SUBTOTAL</td>
					<td>".$factpvp."</td>
					<td>TOTAL</td>
					<td>".$factpvptot."</td>
				</tr>
				<tr>
					<td>DESCRIPCION</td>
					<td colspan='3'>".$_POST['coment']."</td>
				</tr>
			</table>";	
		
	/************* CREAMOS LAS IMAGENES EN LA IMG PRO SECCION ***************/

	require "../config/TablesNames.php";
	$sqlc =  "SELECT * FROM `$db_name`.$gastos WHERE `factnum` = '$_POST[factnum]'";
	$qc = mysqli_query($db, $sqlc);
	$countc = mysqli_num_rows($qc);
	$rowsc = mysqli_fetch_assoc($qc);
	$exist = print("<div align='center'>YA EXISTE LA FACTURA</div>");
		
	if($countc > 0){$exist;
					show_form();}
	else{
		
		/////////////

	if($_FILES['myimg1']['size'] == 0){$new_name1 = 'untitled.png';
			$new_name1 = $_POST['factnum']."_1.png";
			$rename_filename1 = "docgastos_".$dyt1."/".$new_name1;								
			copy("docgastos_".$dyt1."/untitled.png", $rename_filename1);
			}
		else{

			$safe_filename1 = trim(str_replace('/', '', $_FILES['myimg1']['name']));
			$safe_filename1 = trim(str_replace('..', '', $safe_filename1));
	
			$nombre1 = $_FILES['myimg1']['name'];
			$nombre1_tmp = $_FILES['myimg1']['tmp_name'];
			$tipo1 = $_FILES['myimg1']['type'];
			$tamano1 = $_FILES['myimg1']['size'];
	
			$destination_file1 = "docgastos_".$dyt1."/".$safe_filename1;
		
	    if( file_exists("docgastos_".$dyt1."/".$nombre1) ){
				unlink("docgastos_".$dyt1."/".$nombre1);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg1']['tmp_name'], $destination_file1)){

			// Renombrar el archivo:
			$extension1 = substr($_FILES['myimg1']['name'],-3);
			// print($extension1);
			// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
			global $new_name1;
			$new_name1 = $_POST['factnum']."_1.".$extension1;
			$rename_filename1 = "docgastos_".$dyt1."/".$new_name1;								
			rename($destination_file1, $rename_filename1);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file1);}
		}

		/////////////

	if($_FILES['myimg2']['size'] == 0){$new_name2 = 'untitled.png';
			$new_name2 = $_POST['factnum']."_2.png";
			$rename_filename2 = "docgastos_".$dyt1."/".$new_name2;								
			copy("docgastos_".$dyt1."/untitled.png", $rename_filename2);
			}
		else{

			$safe_filename2 = trim(str_replace('/', '', $_FILES['myimg2']['name']));
			$safe_filename2 = trim(str_replace('..', '', $safe_filename2));
	
			$nombre2 = $_FILES['myimg2']['name'];
			$nombre2_tmp = $_FILES['myimg2']['tmp_name'];
			$tipo2 = $_FILES['myimg2']['type'];
			$tamano2 = $_FILES['myimg2']['size'];
	
			$destination_file2 = "docgastos_".$dyt1."/".$safe_filename2;
		
	    if( file_exists("docgastos_".$dyt1."/".$nombre2) ){
				unlink("docgastos_".$dyt1."/".$nombre2);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg2']['tmp_name'], $destination_file2)){

			// Renombrar el archivo:
			$extension2 = substr($_FILES['myimg2']['name'],-3);
			// print($extension2);
			// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
			global $new_name2;
			$new_name2 = $_POST['factnum']."_2.".$extension2;
			$rename_filename2 = "docgastos_".$dyt1."/".$new_name2;								
			rename($destination_file2, $rename_filename2);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file2);}
		}
			
		/////////////

	if($_FILES['myimg3']['size'] == 0){$new_name3 = 'untitled.png';
			$new_name3 = $_POST['factnum']."_3.png";
			$rename_filename3 = "docgastos_".$dyt1."/".$new_name3;								
			copy("docgastos_".$dyt1."/untitled.png", $rename_filename3);
			}
		else{

			$safe_filename3 = trim(str_replace('/', '', $_FILES['myimg3']['name']));
			$safe_filename3 = trim(str_replace('..', '', $safe_filename3));
	
			$nombre3 = $_FILES['myimg3']['name'];
			$nombre3_tmp = $_FILES['myimg3']['tmp_name'];
			$tipo3 = $_FILES['myimg3']['type'];
			$tamano3 = $_FILES['myimg3']['size'];
	
			$destination_file3 = "docgastos_".$dyt1."/".$safe_filename3;
		
	    if( file_exists("docgastos_".$dyt1."/".$nombre3) ){
				unlink("docgastos_".$dyt1."/".$nombre3);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg3']['tmp_name'], $destination_file3)){

			// Renombrar el archivo:
			$extension3 = substr($_FILES['myimg3']['name'],-3);
			// print($extension3);
			// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
			global $new_name3;
			$new_name3 = $_POST['factnum']."_3.".$extension3;
			$rename_filename3 = "docgastos_".$dyt1."/".$new_name3;								
			rename($destination_file3, $rename_filename3);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file3);}
		}
			
		/////////////
		
	if($_FILES['myimg4']['size'] == 0){$new_name4 = 'untitled.png';
			$new_name4 = $_POST['factnum']."_4.png";
			$rename_filename4 = "docgastos_".$dyt1."/".$new_name4;								
			copy("docgastos_".$dyt1."/untitled.png", $rename_filename4);
			}
		else{

			$safe_filename4 = trim(str_replace('/', '', $_FILES['myimg4']['name']));
			$safe_filename4 = trim(str_replace('..', '', $safe_filename4));
	
			$nombre4 = $_FILES['myimg4']['name'];
			$nombre4_tmp = $_FILES['myimg4']['tmp_name'];
			$tipo4 = $_FILES['myimg4']['type'];
			$tamano4 = $_FILES['myimg4']['size'];
	
			$destination_file4 = "docgastos_".$dyt1."/".$safe_filename4;
		
	    if( file_exists("docgastos_".$dyt1."/".$nombre4) ){
				unlink("docgastos_".$dyt1."/".$nombre4);
			//	print("** El archivo ".$nombre1." Ya existe, seleccione otra imagen.</br>");
			}
			
		elseif (move_uploaded_file($_FILES['myimg4']['tmp_name'], $destination_file4)){

			// Renombrar el archivo:
			$extension4 = substr($_FILES['myimg4']['name'],-3);
			// print($extension4);
			// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
			global $new_name4;
			$new_name4 = $_POST['factnum']."_4.".$extension4;
			$rename_filename4 = "docgastos_".$dyt1."/".$new_name4;								
			rename($destination_file4, $rename_filename4);
		}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file4);}
		}
			
		/////////////
		
	require "../config/TablesNames.php";

	$sqla = "INSERT INTO `$db_name`.$gastos (`factnum`, `factdate`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$factpvptot', '$_POST[coment]', '$new_name1', '$new_name2', '$new_name3', '$new_name4')";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
					} else {
							print("* MODIFIQUE LA ENTRADA: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
			
	}
	
			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $proveedores WHERE `ref` = '$_POST[proveedores]'";
	$qx = mysqli_query($db, $sqlx);
	$rowprovee = mysqli_fetch_assoc($qx);
	$_rsocial = $rowprovee['rsocial'];
	$_ref = $rowprovee['ref'];
	$_dni = $rowprovee['dni'];
	$_ldni = $rowprovee['ldni'];
	global $_dnil;
	$_dnil = $_dni.$_ldni;
	
	if($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array (	'proveedores' => $_POST['proveedores'],
									'dy' => $_POST['dy'],
									'dm' => $_POST['dm'],
									'dd' => $_POST['dd'],
									'factnum' => $_POST['factnum'],
								//	'factdate' => $_POST['factdate'],
								   	'factnom' => $rowprovee['rsocial'],
								   	'factnif' => $_dnil,
								   	'factiva' => $_POST['factiva'],
									'factivae1' => $_POST['factivae1'],	
									'factivae2' => '00',	
									'factpvp1' => $_POST['factpvp1'],	
									'factpvp2' => '00',	
									'factpvptot1' => $_POST['factpvptot1'],	
									'factpvptot2' => '00',	
									'coment' => $_POST['coment'],	
									'myimg1' => $_POST['myimg1'],	
									'myimg2' => $_POST['myimg2'],	
									'myimg3' => $_POST['myimg3'],	
									'myimg4' => $_POST['myimg4'],	
																	);
							   											}

	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
		
	$factiva = array (	'' => 'IVA',
						'21' => '21 %',
						'10' => '10 %',
						'4' => '4 %',
									);

	require '../config/ayear.php';
								
	$dm = array (	'' => 'MONTH',
					'01' => '01',
					'02' => '02',
					'03' => '03',
					'04' => '04',
					'05' => '05',
					'06' => '06',
					'07' => '07',
					'08' => '08',
					'09' => '09',
					'10' => '10',
					'11' => '11',
					'12' => '12',
									);
	
	$dd = array (	'' => 'DAY',
					'01' => '01',
					'02' => '02',
					'03' => '03',
					'04' => '04',
					'05' => '05',
					'06' => '06',
					'07' => '07',
					'08' => '08',
					'09' => '09',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
					'21' => '21',
					'22' => '22',
					'23' => '23',
					'24' => '24',
					'25' => '25',
					'26' => '26',
					'27' => '27',
					'28' => '28',
					'29' => '29',
					'30' => '30',
					'31' => '31',
									);
										

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='auto'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td colspan='4' align='center'>
							SELECCIONE UN PROVEEDOR
					</td>
				</tr>		
				<tr>
					<td>
					<div style='float:left'>
						<input type='submit' value='SELECCIONE PROVEEDOR' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					<div style='float:left'>

						<select name='proveedores'>");

						
	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $proveedores ORDER BY `rsocial` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == $defaults['proveedores']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows['rsocial']." </option>");
		}

	}  

	print ("	</select>
					</div>
				</td>
			</tr>
	
		</form>	
			
			</table>				
				"); 
				
////////////////////

	if ($_POST['oculto1'] || $_POST['oculto'] ) {
	if (($_POST['proveedores'] == '') && ($defaults['factnom'] == '')) { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
										SELECCIONE UN PROVEEDOR
											</font>
										</td>
									</tr>
								</table>");
												}	
	if ($_POST['proveedores'] != '') {
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

								INGRESAR GASTO					
 
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

<input type='hidden' name='proveedores' value='".$defaults['proveedores']."' />
				<tr>
					<td>
						NUMERO
					</td>
					<td>

<input type='text' name='factnum' size=22 maxlength=20 value='".$defaults['factnum']."' />

					</td>
				</tr>
									
				<tr>
					<td>						
						FECHA
					</td>
					<td>
					
				<div style='float:left'>
				
				<select name='dy'>");
				

				foreach($dy as $optiondy => $labeldy){
					
					print ("<option value='".$optiondy."' ");
					
					if($optiondy == $defaults['dy']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldy </option>");
												}	
																
	print ("	</select>
					</div>
					
					<div style='float:left'>

						<select style='margin-left:12px' name='dm'>");

				foreach($dm as $optiondm => $labeldm){
					
					print ("<option value='".$optiondm."' ");
					
					if($optiondm == $defaults['dm']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldm </option>");
												}	
																
	print ("	</select>
					</div>

					<div style='float:left'>

						<select style='margin-left:12px' name='dd'>");

				foreach($dd as $optiondd => $labeldd){
					
					print ("<option value='".$optiondd."' ");
					
					if($optiondd == $defaults['dd']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldd </option>");
												}	
																
	print ("	</select> 
					</div>

					</td>
				</tr>
									
				<tr>
					<td>						
						RAZON SOCIAL
					</td>
					<td>
<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						NIF/CIF
					</td>
					<td>
<input type='hidden' name='factnif'value='".$defaults['factnif']."' />".$defaults['factnif']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						IVA %
					</td>
					<td>
						<select name='factiva'>");

				foreach($factiva as $optionfactiva => $labelfactiva){
					
					print ("<option value='".$optionfactiva."' ");
					
					if($optionfactiva == $defaults['factiva']){
															print ("selected = 'selected'");
																								}
													print ("> $labelfactiva </option>");
												}	
	
	print ("</select>
					
					</td>
				</tr>

				<tr>
					<td>						
						IVA €
					</td>
					<td>
<input style='text-align:right' type='text' name='factivae1' size=5 maxlength=5 value='".$defaults['factivae1']."' />
,
<input type='text' name='factivae2' size=2 maxlength=2 value='".$defaults['factivae2']."' />
.€
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						SUBTOTAL €
					</td>
					<td>
<input style='text-align:right' type='text' name='factpvp1' size=5 maxlength=5 value='".$defaults['factpvp1']."' />
,
<input type='text' name='factpvp2' size=2 maxlength=2 value='".$defaults['factpvp2']."' />
.€
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						TOTAL €
					</td>
					<td>
<input style='text-align:right' type='text' name='factpvptot1' size=5 maxlength=5 value='".$defaults['factpvptot1']."' />
,
<input type='text' name='factpvptot2' size=2 maxlength=2 value='".$defaults['factpvptot2']."' />
.€
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>
						DESCRIPCIÓN
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
						PDF / FOTO 1
					</td>
					<td>
		<input type='file' name='myimg1' value='".$defaults['myimg1']."' />						
					</td>
				</tr>

				<tr>
					<td>
						PDF / FOTO 2
					</td>
					<td>
		<input type='file' name='myimg2' value='".$defaults['myimg2']."' />						
					</td>
				</tr>

				<tr>
					<td>
						PDF / FOTO 3
					</td>
					<td>
		<input type='file' name='myimg3' value='".$defaults['myimg3']."' />						
					</td>
				</tr>

				<tr>
					<td>
						PDF / FOTO 4
					</td>
					<td>
		<input type='file' name='myimg4' value='".$defaults['myimg4']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR GASTO' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				
						"); 
		}
	}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Stock_Crear(){

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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Gastos.php';
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

	require '../Inclu/Admin_Inclu_02.php';

?>