<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
	master_index();
			if(isset($_POST['todo'])){ 	show_form();							
										ver_todo();
										accion_Ver_01();
					} else { show_form();
							 ver_todo(); }
		} else { require "../Inclu/AccesoDenegado.php"; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['todo'])){
		$defaults = $_POST;
		} 
	
		global $FormTitulo;
		$FormTitulo = "VER SECCIONES";
		require "SeccionFormFiltro.php";

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $orden;
	if(!isset($_POST['Orden'])){
		$orden = "`id` ASC";
	} else { $orden = $_POST['Orden']; }

	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $gst_secciones WHERE `valor` <> '' ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("<font color='#FF0000'>:.53: </font>".mysqli_error($db)."</br>");
		} else {
			if(mysqli_num_rows($qb)== 0){
					print ("<table align='center'>
								<tr><td>
									<font color='#FF0000'> HAY DATOS</font>
								</td></tr>
							</table>");

			} else { $nunrows = (mysqli_num_rows($qb) - 1);
					print ("<table align='center'>
							<tr>
								<th colspan=3 class='BorderInf'>SECCIONES : ".$nunrows."</th>
							</tr>
							<tr>
								<th class='BorderInfDch'>ID</th>
								<th class='BorderInfDch'>VALOR</th>
								<th class='BorderInf'>NOMBRE</th>
							</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
	if ($rowb['valor'] == '0'){}
				
	elseif($rowb['valor'] != '0'){	
			print (	"<tr align='center'>
						<td class='BorderInfDch'>".$rowb['id']."</td>
						<td class='BorderInfDch' align='left'>".$rowb['valor']."</td>
						<td class='BorderInf' align='left'>".$rowb['nombre']."</td>
					</tr>");
	} /* FIN DEL CONDICIONAL ELSEIF*/
				} /* Fin del while.*/ 

		print("</table>");

				} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function accion_Ver_01(){

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = "- SECCIONES VER TODAS ".$ActionTime."\n";
	$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>