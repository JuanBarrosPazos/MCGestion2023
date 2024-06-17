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

					if($_POST['oculto1']){
											process_form();
											accion_data_ver();
								} else {
											show_form();

							}

				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function process_form(){
		
	show_form();
	
	require "../config/TablesNames.php";
	$sqs1 = "SELECT * FROM $secc ORDER BY `valor` ASC";
	$qb = mysqli_query($db, $sqs1);
	
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];

	if(!$qb){ print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr align='center'>
							<td><font color='red'><b>SELECCIONE UNA SECCION.</font></td>
						</tr>
					</table>");
		} else {
			if(mysqli_num_rows($qb) < 2){
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													NO HAY DATOS EN LA ".$rowseccion['nombre']."
											</font>
										</td>
									</tr>
								</table>");

				} else { 	
							
							print ("<table align='center'>
									<tr>
										<th colspan=11 class='BorderInf'>
											PRODUCTOS SECCION ".$rowseccion['nombre']."
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
											PVN€
										</th>																				
										<th class='BorderInfDch'>
											IVA%
										</th>																				
										<th class='BorderInfDch'>
											IVA€
										</th>																				
										<th class='BorderInfDch'>
											PVP€
										</th>																				
										<th class='BorderInfDch'>
											STOCK
										</th>	
																													
										<th class='BorderInfDch'>
										</th>
																														
										<th class='BorderInf'>
											COMENT
										</th>																				

									</tr>
												");

			while($rowb = mysqli_fetch_row($qb)){

	if ($rowb[1] == ''){}
				
	elseif($rowb[1] != ''){	
										
	$rowb1 = $rowb[1];

	require "../config/TablesNames.php";
	$sqs1 = "SELECT * FROM $tablastock3 WHERE `producto` = '$rowb1' ";
	$qs1 = mysqli_query($db, $sqs1);
	
/////////////////////	
/* PARA SUMAR KGIN */

if(!$qs1){print(mysqli_error($db).".</br>");
}
else{
	$qkgin = mysqli_query($db, $sqs1);
	$rowkgin = mysqli_num_rows($qkgin);
	$sumakgin=0;
		  for($i=0; $i<$rowkgin; $i++)
										{
											$ver = mysqli_fetch_array($qkgin);
									/*		print ("<tr>
														<td align='center'>".$ver['kgin']."</td>
											  		</tr>
															");	*/
	$sumakgin = $sumakgin + $ver['kgin'];
										}
}
			/*			print("Suma es ".$sumakgin."");		*/
			
/* FIN PARA SUMAR KGIN */
/////////////////////////
		

/////////////////////	
/* PARA SUMAR UNIT BAD */

if(!$qs1){print(mysqli_error($db).".</br>");
}
else{
	$qkgbad = mysqli_query($db, $sqs1);
	$rowkgbad = mysqli_num_rows($qkgbad);
	$sumakgbad=0;
		  for($i=0; $i<$rowkgbad; $i++)
										{
											$ver = mysqli_fetch_array($qkgbad);

	$sumakgbad = $sumakgbad + $ver['kgbad'];
										}
}

/* FIN PARA SUMAR UNIT BAD */
/////////////////////////

/////////////////////	
/* PARA SUMAR UNIT CASH */

if(!$qs1){print(mysqli_error($db).".</br>");
}
else{
	$qkgcash = mysqli_query($db, $sqs1);
	$rowkgcash = mysqli_num_rows($qkgcash);
	$sumakgcash=0;
		  for($i=0; $i<$rowkgcash; $i++)
										{
											$ver = mysqli_fetch_array($qkgcash);

	$sumakgcash = $sumakgcash + $ver['kgcash'];
											}
}

/* FIN PARA SUMAR UNIT KGCASH */
/////////////////////////
		
	$rowb4 = $sumakgin - ($sumakgbad + $sumakgcash);

										print (	"<tr align='center'>
										
<form name='ver' action='Productos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=640px')\">

	<input name='seccion' type='hidden' value='".$_POST['seccion']."' />

													<td class='BorderInfDch'>
	<input name='id' type='hidden' value='".$rowb[0]."' />".$rowb[0]."
													</td>
														
													<td class='BorderInfDch' align='right'>
	<input name='valor' type='hidden' value='".$rowb[1]."' />".$rowb[1]."
													</td>
													
													<td class='BorderInfDch' align='left'>
	<input name='nombre' type='hidden' value='".$rowb[2]."' />".$rowb[2]."
													</td>
													
													<td class='BorderInfDch' align='right'>
	<input name='ref' type='hidden' value='".$rowb[3]."' />".$rowb[3]."
													</td>
																			
													<td class='BorderInfDch' align='right'>
															".$rowb[4]." €
													</td>
																			
													<td class='BorderInfDch' align='right'>
															".$rowb[5]." %
													</td>
																			
													<td class='BorderInfDch' align='right'>
															".$rowb[6]." €
													</td>
																			
													<td class='BorderInfDch' align='right'>
															".$rowb[7]." €
													</td>
																			
													<td class='BorderInfDch' align='right'>
															".$rowb[8]."
													</td>
																			
													<td class='BorderInfDch' align='right'>
									<input type='submit' value='IMAGENES' />
									<input type='hidden' name='oculto2' value=1 />
													</td>
																			
													<td class='BorderInf' align='left' width=200px>
															".$rowb[9]."
													</td>
										</form>						
												");
				} /*FIN CONDICIONAL ELSEIF */
						} /* Fin del while.*/ 
	
						print("
									</tr>	
						</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	} /* Fin ver_todo_1();*/

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

		print(" <table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='4'>
						VER PRODUCTOS ".$rowseccion['nombre']."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UNA SECCIÓN' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

						<select name='seccion'>");

	require "../config/TablesNames.php";
	$sqs1 =  "SELECT * FROM $secciones ORDER BY `valor` ASC ";
	$qb = mysqli_query($db, $sqs1);
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
	
	}	/* Fin show_form(); */
		
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
///

function accion_data_ver(){

	global $db;
	global $rowout;

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
		$logtext = "- PRODUCTOS VER TODOS ".$ActionTime.". ".$secc."\n";
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