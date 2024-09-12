º<?php

    global $new_name1;      global $new_name2;      global $new_name3;      global $new_name4;

		if($_FILES['myimg1']['size'] == 0){
			$new_name1 = 'untitled.png';
			$new_name1 = $_POST['valor']."_1.png";
		}else{
			$extension1 = substr($_FILES['myimg1']['name'],-3);
			$new_name1 = $_POST['valor']."_1.".$extension1;
		}

		if($_FILES['myimg2']['size'] == 0){
			$new_name2 = 'untitled.png';
			$new_name2 = $_POST['valor']."_2.png";
		}else{
			$extension2 = substr($_FILES['myimg2']['name'],-3);
			$new_name2 = $_POST['valor']."_2.".$extension2;
		}

		if($_FILES['myimg3']['size'] == 0){
			$new_name3 = 'untitled.png';
			$new_name3 = $_POST['valor']."_3.png";
		}else{
			$extension3 = substr($_FILES['myimg3']['name'],-3);
			$new_name3 = $_POST['valor']."_3.".$extension3;
		}

		if($_FILES['myimg4']['size'] == 0){
			$new_name4 = 'untitled.png';
			$new_name4 = $_POST['valor']."_4.png";
		}else{
			$extension4 = substr($_FILES['myimg3']['name'],-3);
			$new_name4 = $_POST['valor']."_4.".$extension4;
		}

?>