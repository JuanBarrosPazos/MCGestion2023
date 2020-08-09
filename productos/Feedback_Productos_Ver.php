<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';
		
	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){
	
					print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
					
					master_index();

					if($_POST['oculto1']){
											process_form();
											accion_data_ver();
								} else {
											show_form();

							}

				} else { 
					
						print("<table align='center' style=\"margin-top:200px;margin-bottom:200px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													ACCESO RESTRINGIDO.
												</br></br>
													CONSULTE SUS PERMISOS ADMINISTRATIVOS.
											</font>
										</td>
									</tr>
								</table>");
							}

/////////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
		
	global $db;
	global $secc;
	global $_sec;
	
	
	show_form();
	
	$secc = "feedpro".$_POST['seccion'];
	$secc = "`".$secc."`";
	
$sqlb = "SELECT * FROM $secc ORDER BY `valor` ASC";
 	
	$qb = mysqli_query($db, $sqlb);
	
	global $db;
	global $_sec;

	$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
 	
	$q = mysqli_query($db, $sqlx);

	$rowseccion = mysqli_fetch_assoc($q);
	
	$_sec = $rowseccion['nombre'];
	
	$producto = "feedpro".$_POST['seccion'];

	/*	************** */

	if(!$qb){
			
/*
	print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."</br>");
	
*/
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
								SELECCIONE UNA SECCION.
											</font>
										</td>
									</tr>
								</table>");
			
		} else {
			
			if(mysqli_num_rows($qb)< 2){
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

				} else { print ("<table align='center'>
										<th colspan=10 class='BorderInf'>
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
										<th class='BorderInf'>
											COMENT
										</th>																				
									</tr>
												");
			
			while($rowb = mysqli_fetch_row($qb)){

	if ($rowb[1] == ''){}
				
				
	elseif($rowb[1] !== ''){	
										
										print (	"<tr align='center'>
													<td class='BorderInfDch'>
															".$rowb[0]."
													</td>
														
													<td class='BorderInfDch' align='right'>
															".$rowb[1]."
													</td>
													
													<td class='BorderInfDch' align='left'>
															".$rowb[2]."
													</td>
													
													<td class='BorderInfDch' align='right'>
															".$rowb[3]."
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
																			
													<td class='BorderInf' align='left' width=250px>
															".$rowb[9]."
													</td>
														
															");
					
				}
						} /* Fin del while.*/ 
	
						print("

									</tr>	
														
						</table>");
			
						} /* Fin segundo else anidado en if */

		
			} /* Fin de primer else . */
		
	
	} /* Fin ver_todo_1();*/


//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
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
										
	global $db;
	global $_sec;

	$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];
	$producto = "feedpro".$_POST['seccion'];

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='4'>
						VER FEEDBACK PRODUCTOS ".$rowseccion['nombre']."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UNA SECCIÓN' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

						<select name='seccion'>");

	global $db;
	$sqlb =  "SELECT * FROM `secciones` ORDER BY `valor` ASC ";
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
		
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Productos.php';
		
				}

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_data_ver(){

	global $db;
	global $rowout;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = "- PRODUCTOS FEEDBACK VER TODOS ".$ActionTime.". ".$secc."\n";
		$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>