<?php

	global $db;		global $db_name;	global $sqld;		global $qd;			global $rowd;
	require "../config/TablesNames.php";

	$kgin1 = $_POST['kgin1'];			$kgin2 = $_POST['kgin2'];
	global $kgin;						$kgin= $kgin1.".".$kgin2;
	$kgin = floatval($kgin);			$kgin = number_format($kgin,2,".","");

	$kgbad1 = $_POST['kgbad1'];			$kgbad2 = $_POST['kgbad2'];	
	global $kgbad;						$kgbad = $kgbad1.".".$kgbad2;
	$kgbad = floatval($kgbad);			$kgbad = number_format($kgbad,2,".","");

	$kgcash1 = $_POST['kgcash1'];		$kgcash2 = $_POST['kgcash2'];
	global $kgcash;						$kgcash = $kgcash1.".".$kgcash2;
	$kgcash = floatval($kgcash);		$kgcash = number_format($kgcash,2,".","");

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	$errors = array();

	if($_FILES['myimg1']['size'] == 0){
	}else{
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
		$extension1 = substr($_FILES['myimg1']['name'],-3);
		$ext_correcta1 = in_array($extension1, $ext_permitidas);
		$tipo_correcto1 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg1']['type']);

		if(!$ext_correcta1){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg1']['name'];
		}elseif(!$tipo_correcto1){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg1']['name'];
		}elseif ($_FILES['myimg1']['size'] > $limite){
			$tamanho1 = $_FILES['myimg1']['size'] / 1024;
			$errors [] = "El archivo".$_FILES['myimg1']['name']." es mayor de 500 KBytes. ".$tamanho1." KB";
		}elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_PARTIAL){
			$errors [] = "La carga del archivo se ha interrumpido.";
		}elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_NO_FILE){
			$errors [] = "Es archivo no se ha cargado.";
		}
	}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if($_FILES['myimg2']['size'] == 0){
	}else{
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
		$extension2 = substr($_FILES['myimg2']['name'],-3);
		$ext_correcta2 = in_array($extension2, $ext_permitidas);
		$tipo_correcto2 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg2']['type']);
		 
		if(!$ext_correcta2){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg2']['name'];
		}elseif(!$tipo_correcto2){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg2']['name'];
		}elseif($_FILES['myimg2']['size'] > $limite){
			$tamanho2 = $_FILES['myimg2']['size'] / 1024;
			$errors [] = "El archivo".$_FILES['myimg2']['name']." es mayor de 500 KBytes. ".$tamanho2." KB";
		}elseif($_FILES['myimg2']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
		}elseif($_FILES['myimg2']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
		}else{ }
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if($_FILES['myimg3']['size'] == 0){
	}else{
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
		$extension3 = substr($_FILES['myimg3']['name'],-3);
		$ext_correcta3 = in_array($extension3, $ext_permitidas);
		$tipo_correcto3 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg3']['type']);
		 
		if(!$ext_correcta3){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg3']['name'];
		}elseif(!$tipo_correcto3){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg3']['name'];
		}elseif($_FILES['myimg3']['size'] > $limite){
			$tamanho3 = $_FILES['myimg3']['size'] / 1024;
			$errors [] = "El archivo".$_FILES['myimg3']['name']." es mayor de 500 KBytes. ".$tamanho3." KB";
		}elseif($_FILES['myimg3']['error'] == UPLOAD_ERR_PARTIAL){
			$errors [] = "La carga del archivo se ha interrumpido.";
		}elseif($_FILES['myimg3']['error'] == UPLOAD_ERR_NO_FILE){
			$errors [] = "Es archivo no se ha cargado.";
		}else{ }
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if($_FILES['myimg4']['size'] == 0){
	}else{
		$limite = 500 * 1024;
		$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
		$extension4 = substr($_FILES['myimg4']['name'],-3);
		$ext_correcta4 = in_array($extension4, $ext_permitidas);
		$tipo_correcto4 = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg4']['type']);
		if(!$ext_correcta4){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg4']['name'];
		}elseif(!$tipo_correcto4){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg4']['name'];
		}elseif($_FILES['myimg4']['size'] > $limite){
			$tamanho4 = $_FILES['myimg4']['size'] / 1024;
			$errors [] = "El archivo".$_FILES['myimg4']['name']." es mayor de 500 KBytes. ".$tamanho4." KB";
		}elseif($_FILES['myimg4']['error'] == UPLOAD_ERR_PARTIAL){
			$errors [] = "La carga del archivo se ha interrumpido.";
		}elseif($_FILES['myimg4']['error'] == UPLOAD_ERR_NO_FILE){
			$errors [] = "Es archivo no se ha cargado.";
		}else{ }
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	global $ProductoValor;
		$ProductoValor = trim(str_replace(' ', '', $_POST['nombre']));
		$ProductoValor = strtolower($ProductoValor);
	// CONSULTO QUE NO EXISTE OTRO VALOR IGUAL EN LA BBDD
	$sqlProdV =  "SELECT * FROM `$db_name`.$Productos WHERE `valor` = '$ProductoValor'";
	$qdV = mysqli_query($db, $sqlProdV);
	global $CountProdV;		$CountProdV = mysqli_num_rows($qdV);
	if(strlen((trim($ProductoValor))) == 0){
		$errors [] = "VALOR <font color='#F1BD2D'>NO TIENE DATOS</font>";
	}elseif($CountProdV > 0){
			$errors [] = "<font color='#F1BD2D'>ESTE VALOR DE PRODUCTO YA EXISTE</font>";
	}else{ }
	/*
	if(strlen(trim($_POST['valor'])) == 0){
		$errors [] = "VALOR <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif(strlen(trim($_POST['valor'])) < 6){
		$errors [] = "VALOR <font color='#F1BD2D'>MAS DE 5 CARACTERES</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['valor'])){
		$errors [] = "VALOR <font color='#F1BD2D'>CARACTERES NO VALIDOS</font>";
	}elseif (!preg_match('/^[a-z,0-9._]+$/',$_POST['valor'])){
		$errors [] = "VALOR <font color='#F1BD2D'>SOLO MINUSCULAS SE PERMITE . O _ </font>";
	}else{ }
	*/

	// CONSULTO QUE NO EXISTE OTRO NOMBRE IGUAL EN LA BBDD
	$sqlProdN =  "SELECT * FROM `$db_name`.$Productos WHERE `nombre` = '$_POST[nombre]'";
	$qdN = mysqli_query($db, $sqlProdN);
	global $CountProdN;		$CountProdN = mysqli_num_rows($qdN);
	if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "NOMBRE <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif($CountProdN > 0){
		$errors [] = "<font color='#F1BD2D'>ESTE NOMBRE DE PRODUCTO YA EXISTE</font>";
	}elseif(strlen(trim($_POST['nombre'])) < 6){
		$errors [] = "NOMBRE <font color='#F1BD2D'>MAS DE 5 CARACTERES</font>";
	}elseif(!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['nombre'])){
		$errors [] = "NOMBRE <font color='#F1BD2D'>CARACTERES NO VALIDOS</font>";
	}elseif(!preg_match('/^[A-Z,0-9\s]+$/',$_POST['nombre'])){
		$errors [] = "NOMBRE <font color='#F1BD2D'>SOLO MAYUSCULAS O NUMEROS SIN ACENTOS</font>";
	}else{ }
	
	
	// CONSULTO QUE NO EXISTE OTRA REFERENCIA IGUAL EN LA BBDD
	$sqlProdR =  "SELECT * FROM `$db_name`.$Productos WHERE `ref` = '$_POST[ref]'";
	$qdR = mysqli_query($db, $sqlProdR);
	global $CountProdR;		$CountProdR = mysqli_num_rows($qdR);
	if(strlen(trim($_POST['ref'])) == 0){
		$errors [] = "REFERENCIA <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif($CountProdR > 0){
		$errors [] = "<font color='#F1BD2D'>ESTA REFERENCIA DE PRODUCTO YA EXISTE</font>";
	}elseif (strlen(trim($_POST['ref'])) < 7){
		$errors [] = "REFERENCIA <font color='#F1BD2D'>MAS DE 6 CARACTERES</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['ref'])){
		$errors [] = "REFERENCIA  <font color='#F1BD2D'>NO VALIDO SE PERMITE _</font>";
	}elseif (!preg_match('/^[a-z,0-9_\s]+$/',$_POST['ref'])){
		$errors [] = "REFERENCIA  <font color='#F1BD2D'>SOLO MINUSCULAS SE PERMITE _ O ESPACIO.</font>";
	}else{ }

	if (strlen(trim($_POST['coment'])) > 0){
		if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ €]+$/',$_POST['coment'])){
			$errors [] = "COMENTARIOS  <font color='#F1BD2D'>CARACTERES NO PERMITIDOS { } [ ] ¿ ? < > ¡ ! @ # ...</font>";
		}else{ }
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	if($_POST['iva'] == ''){
		$errors [] = "IVA <font color='#F1BD2D'>SELECCIONE EL TIPO DE IVA</font>";
	}else{ }
					
	if(strlen(trim($_POST['kgin1'])) == ''){
		$errors [] = "UNIT ENTRADA <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif(!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgin1'])){
		$errors [] = "UNIT ENTRADA <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['kgin1'])){
		$errors [] = "UNIT ENTRADA <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}else{ }

	if(strlen(trim($_POST['kgin2'])) == ''){
		$errors [] = "DEC ENTRADA <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgin2'])){
		$errors [] = "DEC ENTRADA <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['kgin2'])){
		$errors [] = "DEC ENTRADA <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}else{ }

	if(strlen(trim($_POST['pvp1'])) == ''){
		$errors [] = "€ PVP SIN IVA <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['pvp1'])){
		$errors [] = "€ PVP SIN IVA <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['pvp1'])){
		$errors [] = "€ PVP SIN IVA <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}else{ }

	if(strlen(trim($_POST['pvp2'])) == ''){
		$errors [] = "CENT PVP SIN IVA <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['pvp2'])){
		$errors [] = "CENT PVP SIN IVA <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['pvp2'])){
		$errors [] = "CENT PVP SIN IVA <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}else{ }

	if(strlen(trim($_POST['kgbad1'])) == ''){
		$errors [] = "UNIT PERECEDEROS <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgbad1'])){
		$errors [] = "UNIT PERECEDEROS <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['kgbad1'])){
		$errors [] = "UNIT PERECEDEROS <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}elseif($kgin < $kgbad){
		$errors [] = " <font color='#F1BD2D'>MAS PERECEDEROS QUE UNIT ENTRADA</font>";
	}else{ }

	
	if(strlen(trim($_POST['kgbad2'])) == ''){
		$errors [] = "DEC PERECEDEROS <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgbad2'])){
		$errors [] = "DEC PERECEDEROS <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['kgbad2'])){
		$errors [] = "DEC PERECEDEROS <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}else{ }

	if(strlen(trim($_POST['kgcash1'])) == 0){
		$errors [] = "UNIT CAJA <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgcash1'])){
		$errors [] = "UNIT CAJA <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['kgcash1'])){
		$errors [] = "UNIT CAJA <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}elseif($kgcash > $kgin){
		$errors [] = "<font color='#F1BD2D'>MAS CAJA QUE ENTRADA</font>";
	}else{ }
			
	if(strlen(trim($_POST['kgcash2'])) == 0){
		$errors [] = "DEC CAJA <font color='#F1BD2D'>CAMPO OBLIGATORIO</font>";
	}elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgcash2'])){
		$errors [] = "DEC CAJA <font color='#F1BD2D'>CARACTERES NO VALIDOS.</font>";
	}elseif (!preg_match('/^[0-9]+$/',$_POST['kgcash2'])){
		$errors [] = "DEC CAJA <font color='#F1BD2D'>SOLO NUMEROS</font>";
	}else{ }

	$vkgin = $kgin;
	$vkgbad = $kgbad;
	$vkgcash = $kgcash;
	$vdif = $vkgin - $vkgbad;
	$vtot = $vdif - $vkgcash;
	/* if (($vdif - $vkcash) < 0){ $vtot = '- ' .$vtot;} */
	
	if($kgcash > $vdif){
		$errors [] = "<font color='#F1BD2D'>ENTRADA ".$kgin." - PERECEDEROS ".$kgbad." - CAJA ".$vkgcash."<br>** DIFER TOTAL ".$vtot.".</font>";
			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
?>