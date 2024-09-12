<?php

    global $new_name1;      global $new_name2;      global $new_name3;      global $new_name4;
	global $ProductoValor;	global $LogText;

		if($_FILES['myimg1']['size'] == 0){
			$new_name1 = 'untitled.png';
			$new_name1 = $ProductoValor."_1.png";
			$rename_filename1 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name1;
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename1);
		}else{
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
			}elseif (move_uploaded_file($_FILES['myimg1']['tmp_name'], $destination_file1)){
				// Renombrar el archivo:
				$extension1 = substr($_FILES['myimg1']['name'],-3);
				$new_name1 = $ProductoValor."_1.".$extension1;
				$rename_filename1 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name1;								
				rename($destination_file1, $rename_filename1);
			}else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}
		}

	if($_FILES['myimg2']['size'] == 0){$new_name2 = 'untitled.png';
			$new_name2 = $ProductoValor."_2.png";
			$rename_filename2 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name2;								
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename2);
	}else{	$safe_filename2 = trim(str_replace('/', '', $_FILES['myimg2']['name']));
			$safe_filename2 = trim(str_replace('..', '', $safe_filename2));

			$nombre2 = $_FILES['myimg2']['name'];
			$nombre2_tmp = $_FILES['myimg2']['tmp_name'];
			$tipo2 = $_FILES['myimg2']['type'];
			$tamano2 = $_FILES['myimg2']['size'];

			$destination_file2 = "../imgpro/imgpro".$_POST['seccion']."/".$safe_filename2;

			if( file_exists("../imgpro/imgpro".$_POST['seccion']."/".$nombre2) ){
				unlink("../imgpro/imgpro".$_POST['seccion']."/".$nombre2);
			//	print("** El archivo ".$nombre2." Ya existe, seleccione otra imagen.</br>");
			}elseif (move_uploaded_file($_FILES['myimg2']['tmp_name'], $destination_file2)){
				// Renombrar el archivo:
				$extension2 = substr($_FILES['myimg2']['name'],-3);
				// print($extension2);
				// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
				$new_name2 = $ProductoValor."_2.".$extension2;
				$rename_filename2 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name2;								
				rename($destination_file2, $rename_filename2);
			}else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}
		}
			
	if($_FILES['myimg3']['size'] == 0){$new_name3 = 'untitled.png';
			$new_name3 = $ProductoValor."_3.png";
			$rename_filename3 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name3;								
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename3);
	}else{	$safe_filename3 = trim(str_replace('/', '', $_FILES['myimg3']['name']));
			$safe_filename3 = trim(str_replace('..', '', $safe_filename3));

			$nombre3 = $_FILES['myimg3']['name'];
			$nombre3_tmp = $_FILES['myimg3']['tmp_name'];
			$tipo3 = $_FILES['myimg3']['type'];
			$tamano3 = $_FILES['myimg3']['size'];

			$destination_file3 = "../imgpro/imgpro".$_POST['seccion']."/".$safe_filename3;

			if( file_exists("../imgpro/imgpro".$_POST['seccion']."/".$nombre3) ){
				unlink("../imgpro/imgpro".$_POST['seccion']."/".$nombre3);
			//	print("** El archivo ".$nombre3." Ya existe, seleccione otra imagen.</br>");
			}elseif (move_uploaded_file($_FILES['myimg3']['tmp_name'], $destination_file3)){
				// Renombrar el archivo:
				$extension3 = substr($_FILES['myimg3']['name'],-3);
				// print($extension3);
				// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
				$new_name3 = $ProductoValor."_3.".$extension3;
				$rename_filename3 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name3;								
				rename($destination_file3, $rename_filename3);
			}else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}

		}
			
	if($_FILES['myimg4']['size'] == 0){$new_name4 = 'untitled.png';
			$new_name4 = $ProductoValor."_4.png";
			$rename_filename4 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name4;								
			copy("../imgpro/imgpro".$_POST['seccion']."/untitled.png", $rename_filename4);
	}else{	$safe_filename4 = trim(str_replace('/', '', $_FILES['myimg4']['name']));
			$safe_filename4 = trim(str_replace('..', '', $safe_filename4));

			$nombre4 = $_FILES['myimg4']['name'];
			$nombre4_tmp = $_FILES['myimg4']['tmp_name'];
			$tipo4 = $_FILES['myimg4']['type'];
			$tamano4 = $_FILES['myimg4']['size'];

			$destination_file4 = "../imgpro/imgpro".$_POST['seccion']."/".$safe_filename4;

			if( file_exists("../imgpro/imgpro".$_POST['seccion']."/".$nombre4) ){
				unlink("../imgpro/imgpro".$_POST['seccion']."/".$nombre4);
			//	print("** El archivo ".$nombre4." Ya existe, seleccione otra imagen.</br>");
			}elseif (move_uploaded_file($_FILES['myimg4']['tmp_name'], $destination_file4)){
				// Renombrar el archivo:
				$extension4 = substr($_FILES['myimg4']['name'],-3);
				// print($extension4);
				// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
				$new_name4 = $ProductoValor."_4.".$extension4;
				$rename_filename4 = "../imgpro/imgpro".$_POST['seccion']."/".$new_name4;								
				rename($destination_file4, $rename_filename4);
			}else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_POST['seccion']."/");}

		}

?>