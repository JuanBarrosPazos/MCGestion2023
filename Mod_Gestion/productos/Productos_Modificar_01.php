<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){
	
					print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
					
					master_index();

					if($_POST['oculto']){
											process_form();
											accion_modifica_01();													
								} else {
											show_form();

							}

				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){

	show_form();

	require "../config/TablesNames.php";
 	$sqlc =  "SELECT * FROM $secc ORDER BY `valor` ASC";
	$qc = mysqli_query($db, $sqlc);

	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];

	if(!$qc){ print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr align='center'>
				<td><font color='red'><b>LA TABLA ".$producto." NO EXISTE.</font></td>
						</tr>
					</table>");
		} else {
			if(mysqli_num_rows($qc)== 0){
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													NO HAY DATOS EN ".$rowseccion['nombre'].".
											</font>
										</td>
									</tr>
								</table>");

				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=7 class='BorderInf'>
												".$rowseccion['nombre']."
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
											REFERENCIA
										</th>																				
										<th class='BorderInfDch'>
											COMENT
										</th>																				
										<th class='BorderInf' colspan='2'>
											&nbsp;
										</th>																				
								</tr>
										");
			
	while($rowc = mysqli_fetch_assoc($qc)){

	if ($rowc['valor'] == ''){}
				
	elseif($rowc['valor'] != ''){	
										
			print (	"<tr align='center'>
									
				<form name='oculto2' action='Productos_Modificar_02.php' method='POST'>
				
<input name='seccion' type='hidden' value='".$_POST['seccion']."' />

													<td class='BorderInfDch'>
<input name='id' type='hidden' value='".$rowc['id']."' />".$rowc['id']."
													</td>
														
													<td class='BorderInfDch' align='left'>
<input name='valor' type='hidden' value='".$rowc['valor']."' />".$rowc['valor']."
													</td>
													
													<td class='BorderInfDch' align='left'>
<input name='nombre' type='hidden' value='".$rowc['nombre']."' />".$rowc['nombre']."
													</td>
													
													<td class='BorderInfDch' align='left'>
<input name='ref' type='hidden' value='".$rowc['ref']."' />".$rowc['ref']."
													</td>
																			
													<td class='BorderInfDch' align='left'>
<input name='coment' type='hidden' value='".$rowc['coment']."' />".$rowc['coment']."
													</td>
						
						<td align='right' class='BorderInf'>
										<input type='submit' value='MODIFICAR DATOS' />
										<input type='hidden' name='oculto2' value=1 />
			</form>
						</td>
						<td align='center' class='BorderInf'>			
<form name='oculto2' action='Productos_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

						<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
						<input name='id' type='hidden' value='".$rowc['id']."' />
						<input name='valor' type='hidden' value='".$rowc['valor']."' />
						<input name='nombre' type='hidden' value='".$rowc['nombre']."' />
						<input name='ref' type='hidden' value='".$rowc['ref']."' />
								<input type='submit' value='MODIFICAR IMAGENES' />
								<input type='hidden' name='oculto2' value=1 />
</form>						
					</td>
					</tr>");
					
	}	/* FIN DEL CONDICIONAL ELSEIF*/
	
			} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

		
			} /* Fin de primer else . */
		
	}	/* Final process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form(){
	
	global $ordenar;
	global $producto;
	
	if($_POST['oculto1']){
		$defaults = $_POST;
				$defaults = array ('seccion' => $_POST['seccion'],
								   'Orden' => $ordenar,
								   'producto' => $producto,
								   );
		}	
			elseif($_POST['oculto']){
		$defaults = $_POST;
		}
			 else {
				$defaults = array ('seccion' => $_POST['seccion'],
								   'Orden' => $ordenar,
								   'producto' => $producto,
								   );
								   		}
										
	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='4'>
						MODIFICAR PRODUCTOS ".$rowseccion['nombre']."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UNA SECCIÓN' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td align='left'>

						<select name='seccion'>");

	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $secciones ORDER BY `valor` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['valor']."' ");
					
					if($rows['valor'] == $defaults['seccion']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows['nombre']." </option>");
		}

	} 


	print ("	</select>
					</td>
			</tr>
				
		</form>	
			
			</table>				
						"); 
	
	}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_modifica_01(){

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
	
		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = "- PRODUCTOS MODIFICA 1 ".$ActionTime.". ".$secc."\n";
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
		
				require '../Inclu/Master_Index_Productos.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>