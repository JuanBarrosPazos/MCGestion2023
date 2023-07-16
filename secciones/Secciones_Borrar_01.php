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
									accion_Borrar_01();
					} else { show_form();
							 ver_todo(); }
		} else { require "../Inclu/AccesoDenegado.php";	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	if(isset($_POST['todo'])){
		$defaults = $_POST;
		} else {global $ordenar;
				$defaults = array ('nombre' => '',
								   'valor' => '',
								   'Orden' => $ordenar);
							}
	
	if ($errors){
		print("<font color='#FF0000'>Solucione estos errores: </font></br>");
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."</br>");
			}
		}
		
		global $FormTitulo;
		$FormTitulo = "BORRAR SECCION";
		print("<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
					AL BORRAR UNA SECCIÓN SE BORRARÁN
					</br>
 					TODAS LAS TABLAS DEPENDIENTES EN LA BBDD.
					</td>
					</tr>
				</table>");
		require "SeccionFormFiltro.php";
	
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function ver_todo(){
		
	global $orden;
	if(!isset($_POST['Orden'])){
		$orden = "`id` ASC";
	} else { $orden = $_POST['Orden']; }

	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $gst_secciones WHERE `valor` <> '' ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>.");
									
				} else { print ("<table align='center'>
									<tr>
										<th colspan=4 class='BorderInf'>
									Todos los usuarios : ".mysqli_num_rows($qb)." Resultados.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											VALOR
										</th>
										
										<th class='BorderInfDch'>
											NOMBRE
										</th>
										
										<th class='BorderInfDch'>
												&nbsp;
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
	if ($rowb['valor'] == '0'){}
				
				
	elseif($rowb['valor'] != '0'){	
										
			print (	"<tr align='center'>
									
				<form name='modifica' action='Secciones_Borrar_02.php' method='POST'>

						<td class='BorderInfDch'>
	<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='valor' type='hidden' value='".$rowb['valor']."' />".$rowb['valor']."
						</td>
							
						<td class='BorderInfDch' align='left'>
	<input name='nombre' type='hidden' value='".$rowb['nombre']."' />".$rowb['nombre']."
						</td>
							
						<td colspan=2 align='center' class='BorderInf'>
										<input type='submit' value='BORRAR SECCION' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
										
				</form>
										
					</tr>");
					
	} /* FIN DEL CONDICONAL ELSEIF */
				
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
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Borrar_01(){

	global $db;
	global $rowout;
	global $nombre;
	global $valor;	

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
	$logtext = "- SECCION BORRAR 1 ".$ActionTime.". TODAS SIN FILTROS.\n";
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