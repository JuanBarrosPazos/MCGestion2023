<?php
//session_start();
	global $rutaHeader;		$rutaHeader = "../";
	require $rutaHeader.'Inclu/Inclu_Header.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require '../../Mod_Admin/Inclu/error_hidden.php';
	//require '../Inclu/Admin_head.php';

	require 'ClavesPerdidasFunciones.php';
	require 'ClavesPerdidasLogica.php';
	
	require $rutaHeader.'Inclu/Inclu_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */

?>
