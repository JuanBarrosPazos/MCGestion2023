<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

 	print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
	master_index();
		if(isset($_POST['todo'])){ 	show_form();							
									ver_todo();
									accion_Modificar_01();
				} else { show_form();
						 ver_todo(); }
		} else { require "../Inclu/AccesoDenegado.php"; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else { $defaults = array ( 'valor' => '',
									'nombre' => '',);
							}
	
	if ($errors){
		print("<font color='#FF0000'>
				Solucione estos errores: </font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."</br>");
			}
		}

		global $FormTitulo;
		$FormTitulo = "MODIFICAR SECCIONES";
		print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<td style='color:red' align='center'>
						<b>EL CAMPO VALOR</b> DA EL VALOR A LAS VARIABLES<br>
							Y NOMBRES DE TABLAS QUE SE HAN CREADO AUTOMÁTICAMENTE.<br>
						<b>SI SE MODIFICA</b> SE MODIFICARÁ EL NOMBRE<br>
							DE TODAS LAS TABLAS DEPENDIENTES AUTOMÁTICAMENTE
					</td>
				</tr>
				</table>");
				
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
	$sqlb =  "SELECT * FROM $secciones WHERE `valor` <>'' ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center'>
										<tr><td>
											<font color='#FF0000'>NO HAY DATOS</font>
										</td></tr>
									</table>");
									
				} else { print ("<table align='center'>
									<tr>
										<th colspan=4 class='BorderInf'>SECCIONES ".mysqli_num_rows($qb)."</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>ID</th>
										<th class='BorderInfDch'>VALOR</th>
										<th class='BorderInfDch'>NOMBRE</th>
										<th class='BorderInf'>&nbsp;</th>
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
	if ($rowb['valor'] == '0'){}
				
	elseif($rowb['valor'] != '0'){	
										
			print (	"<tr align='center'>
									
		<form name='modifica' action='Secciones_Modificar_02.php' method='POST'>
						<td class='BorderInfDch'>
		<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>
						<td class='BorderInfDch' align='left'>
		<input name='valor' type='hidden' value='".$rowb['valor']."' />".$rowb['valor']."
						</td>
						<td class='BorderInfDch' align='left'>
		<input name='nombre' type='hidden' value='".$rowb['nombre']."' />".$rowb['nombre']."
						</td>
						<td colspan=2 align='center' class='BorderInfDch'>
								<input type='submit' value='MODIFICAR SECCION' />
								<input type='hidden' name='oculto2' value=1 />
						</td>
			</form>
					</tr>");
					
	} /* FIN DEL CONDICIONAL ELSEIF */
	
			} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Modificar_01(){

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
	$logtext = "- SECCIONES MODIFICA 1 ".$ActionTime.". TODAS SIN FILTROS.\n";
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