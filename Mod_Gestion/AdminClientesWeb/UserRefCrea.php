<?php

	global $nombre; global $apellido;	
	if((isset($_POST['Nombre']))&&(isset($_POST['Apellidos']))){
			$nombre = $_POST['Nombre'];
	 		$apellido = $_POST['Apellidos'];
	}else{
			$nombre = "";
			$apellido = "";
	}

	global $rf1;	global $rf2;	global $rf3;	global $rf4;

	if (preg_match('/^(\w{1})/',$nombre,$ref1)){ $rf1 = $ref1[1];
												 $rf1 = trim($rf1);
												/*print($ref1[1]."</br>");*/
																			}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$nombre,$ref2)){	$rf2 = $ref2[2];
															$rf2 = trim($rf2);
															/*print($ref2[2]."</br>");*/
																							}
	if (preg_match('/^(\w{1})/',$apellido,$ref3)){	$rf3 = $ref3[1];
													$rf3 = trim($rf3);
													/*print($ref3[1]."</br>");*/
																			}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$apellido,$ref4)){ $rf4 = $ref4[2];
															 $rf4 = trim($rf4);
															/*print($ref4[2]."</br>");*/
																							}

	global $rf;
	$rf = $rf1.$rf2.$rf3.$rf4.@$_POST['dni'].@$_POST['ldni'];
	$rf = trim($rf);
	
?>