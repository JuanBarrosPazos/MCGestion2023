<?php

//error_reporting (0);
	
	$errors = array();

	require "TablesNames.php";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		
	require "../Admin/UserRefCrea.php";
			
	/* COMPROBAMOS SI EXISTE EL ADMINISTRADOR */

		global $db;
		global $db_name;
		
		$admin =  "SELECT * FROM `$db_name`.$gst_admin WHERE `ref` = '$rf'";
		$qadmin = mysqli_query($db, $admin);
		$cadmin = mysqli_num_rows($qadmin);
		
	if($cadmin > 0){$errors [] = "YA EXISTE EL ADMINISTRADOR ".$rf;}
	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		require "validateComun.php";
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	// VALIDAMOS LA IMAGEN DE USUARIO.

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// PRESUNTAMENTE DEPRECATED
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "HA DE SELECCIONAR UNA FOTOGRAFIA";
			global $img2;
			$img2 = 'untitled.png';
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "EXTENSION ARCHIVO NO ADMITIDA ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	*/
		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "ARCHIVO ".$_FILES['myimg']['name']." MAYOR DE 500 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "CARGA ARCHIVO INTERRUMPIDA";
				global $img2;
				$img2 = 'untitled.png';
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "ARCHIVO NO CARGADO";
					global $img2;
					$img2 = 'untitled.png';
					}

/* La función devuelve el array errors. */
	
/* Creado por Juan Barros Pazos 2021 */
?>