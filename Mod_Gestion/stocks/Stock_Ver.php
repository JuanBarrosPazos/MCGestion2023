<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){
	
					print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
					
					master_index();

					if($_POST['oculto']){
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
	
	$orden = $_POST['Orden'];
	$fil = "%".$_POST['producto']."%";
	$camp2 = $_POST['campo2'];
	
	if ($_POST['dy'] == 0){ $dy1 = '';} else {	$dy1 = $_POST['dy'];
												$dy1 = $dy1;
																	}
	if ($_POST['dm'] == 0){ $dm1 = '';} else {	$dm1 = $_POST['dm'];
												$dm1 = "-".$dm1."-";
																	}
	if ($_POST['dd'] == 0){ $dd1 = '';} else {	$dd1 = $_POST['dd'];
												$dd1 = $dd1;
																	}
	if ($_POST['dw'] == 0){ $dw1 = '';} else {	$dw1 = $_POST['dw'];
												$dw1 = $dw1;
																	}
	if ($_POST['campo2'] != '`nsemana`'){	$dw1 = ''; } else {	$dy1 = '';
																$dm1 = '';
																$dd1 = '';	}
																	
	$fil2 = "%".$dw1.$dy1.$dm1.$dd1."%";

if(strlen($_POST['vsolo']) == 0){
	require "../config/TablesNames.php";
	$sqlb = "SELECT * FROM $tablastock3 WHERE `producto` LIKE '$fil' AND $camp2 LIKE '$fil2' ORDER BY $orden";
}
if(strlen($_POST['vsolo']) != 0){
	require "../config/TablesNames.php";
	$sqlb = "SELECT * FROM $tablastock3 WHERE `producto` LIKE '$fil' AND $camp2 LIKE '$fil2' AND `kgdifer` > '0' ORDER BY $orden";
}
	$qb = mysqli_query($db, $sqlb);
	
/////////////////////	
/* PARA SUMAR KGIN */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qkgin = mysqli_query($db, $sqlb);
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
if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qkgbad = mysqli_query($db, $sqlb);
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
if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qkgcash = mysqli_query($db, $sqlb);
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
		
/////////////////////	
/* PARA SUMAR UNIT DIFER */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qkgdifer = mysqli_query($db, $sqlb);
	$rowkgdifer = mysqli_num_rows($qkgdifer);
	$sumakgdifer = 0;
		  for($i=0; $i<$rowkgdifer; $i++)
										{
											$ver = mysqli_fetch_array($qkgdifer);

	$sumakgdifer = $sumakgdifer + $ver['kgdifer'];
											}
}

/* FIN PARA SUMAR UNIT DIFER */
/////////////////////////

/////////////////////	
/* PARA SUMAR PVPTOT */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qpvptot = mysqli_query($db, $sqlb);
	$rowpvptot = mysqli_num_rows($qpvptot);
	$sumapvptot = 0;
		  for($i=0; $i<$rowpvptot; $i++)
										{
											$ver = mysqli_fetch_array($qpvptot);

	$sumapvptot = $sumapvptot + $ver['pvptot'];
											}
}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qivae = mysqli_query($db, $sqlb);
	$rowivae = mysqli_num_rows($qivae);
	$sumaivae = 0;
		  for($i=0; $i<$rowivae; $i++)
										{
											$ver = mysqli_fetch_array($qivae);

	$sumaivae = $sumaivae + ($ver['ivae'] * $ver['kgcash']);
											}
}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	$sumakgbadkgcash = $sumakgbad + $sumakgcash;
	$sumakgtot = $sumakgbadkgcash + $sumakgdifer;	
	
/////////////////////////

	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	
	global $_sec;
	$_sec = $rowseccion['nombre'];
	
	$producto = "pro".$_POST['seccion'];

	if(!$qb){
			
/*
	print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."</br>");
	
*/
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
								LA TABLA ".$rowseccion['nombre']." NO EXISTE.
											</font>
										</td>
									</tr>
								</table>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													NO HAY DATOS EN ".$rowseccion['nombre']."
											</font>
										</td>
									</tr>
								</table>");

				} else { print ("<table align='center'>
									<tr style='font-size:13px'>
										<th colspan=17 class='BorderInf'>
												SECCION ".$rowseccion['nombre']."
										</th>
									</tr>
									<tr style='font-size:12px'>
										<th class='BorderInfDch'>
											ID
										</th>																				
										<th class='BorderInfDch'>
											WEEK
										</th>										
										<th class='BorderInfDch'>
											REF PRO
										</th>																			
										<th class='BorderInfDch'>
											NAME PRO
										</th>																			
										<th class='BorderInfDch'>
											PSIVA.€
										</th>																			
										<th class='BorderInfDch'>
											IVA.%
										</th>																			
										<th class='BorderInfDch'>
											IVA.€
										</th>																			
										<th class='BorderInfDch'>
											PVP.€
										</th>																			
										<th bgcolor='#DCEDED' class='BorderInfDch'>
											IN
										</th>																				
										<th class='BorderInfDch'>
											DATE IN
										</th>																				
										<th bgcolor='#DCEDED' class='BorderInfDch'>
											BAD
										</th>																				
										<th class='BorderInfDch'>
											DATE BAD
										</th>																														
										<th bgcolor='#DCEDED' class='BorderInfDch'>
											CASH
										</th>
										<th bgcolor='#DCEDED' class='BorderInfDch'>
											CASH.€
										</th>	
										<th class='BorderInfDch'>						
											DATE CASH
										</th>	
										<th bgcolor='#DCEDED' class='BorderInfDch'>
											STOCK
										</th>										
										<th class='BorderInf'>
											COMENTARIOS
										</th>

									</tr>");
			
			while($rowb = mysqli_fetch_row($qb)){

if(strlen($_POST['tcomen']) == 0){$tcomen = substr($rowb[16],-76);}
else{$tcomen = $rowb[16];}

							print (	"<tr align='center'>
										<td class='BorderInfDch'>
															".$rowb[0]."
										</td>
										<td class='BorderInfDch'>
															".$rowb[1]."
										</td>
										<td class='BorderInfDch' align='left'>
															".$rowb[2]."
										</td>
										<td class='BorderInfDch' align='center'>
															".$rowb[3]."
										</td>
										<td class='BorderInfDch' align='right'>
															".$rowb[4]."
										</td>
										<td class='BorderInfDch' align='right'>
															".$rowb[5]."%
										</td>
										<td class='BorderInfDch' align='right'>
															".$rowb[6]."
										</td>
										<td class='BorderInfDch'>
															".$rowb[7]."
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
															".$rowb[8]."
													</td>
										<td class='BorderInfDch' align='center'>
															".$rowb[9]."
										</td>
										<td  bgcolor='#DCEDED'class='BorderInfDch' align='right'>
															".$rowb[10]."
										</td>
										<td class='BorderInfDch' align='center'>
															".$rowb[11]."
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
															".$rowb[12]."
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
															".$rowb[13].".€
										</td>
										<td class='BorderInfDch' align='center'>
															".$rowb[14]."
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
															".$rowb[15]."
										</td>
										<td class='BorderInf' align='left' width='140px'>
															".$tcomen."
										</td>
												</tr>");
										}
						print("		<tr>
										<td colspan='17' class='BorderInf'>
										</td>
									</tr>
									<tr>
										<td colspan='3'  class='BorderInfDch' align='center'>
												TOTALES
										</td>
										<td colspan='3' class='BorderInf' align='right'>
												IVA REPERCUTIDO €
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
											".$sumaivae.".€
										</td>
										<td class='BorderInf' align='right'>
												IN
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
											".$sumakgin."
										</td>
										<td class='BorderInf' align='right'>
											BAD
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
											".$sumakgbad."
										</td>
										<td class='BorderInf' align='right'>
											CASH
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
											".$sumakgcash."
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
											".$sumapvptot.".€
										</td>
										<td class='BorderInf' align='right'>
											STOCK
										</td>
										<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>
											".$sumakgdifer."
										</td>
										<td class='BorderInf' align='center'>
																");
					$stock1 = $sumakgin - $sumakgtot;
					if ($sumakgtot = $sumakgin){ print (" CUADRADO A 0");}
					elseif ($sumakgin > $sumakgtot){ print (" STOCK + ".$stock1." unit");}
					elseif ($sumakgin < $sumakgtot){ print (" STOCK - ".$stock1." unit");}
								print("	</td>
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
	global $campos2;
	
	if($_POST['oculto1']){
		$defaults = $_POST;
				$defaults = array ('seccion' => $_POST['seccion'],
								   'Orden' => $ordenar,
								   'producto' => $producto,
								   'proname' => $_POST['proname'],
								   'campo2' => $campos2,
								   'dy' => '',
								   'dm' => '',
								   'dd' => '',
								   'dw' => '',
								   );
		}	
			elseif($_POST['oculto']){
		$defaults = $_POST;
		}
			 else {
				$defaults = array ('seccion' => $_POST['seccion'],
								   'Orden' => $ordenar,
								   'producto' => $producto,
								   'proname' => $_POST['proname'],
								   'campo2' => $campos2,
								   'dy' => '',
								   'dm' => '',
								   'dd' => '',
								   'dw' => '',
								   );
								   		}
										

	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];

	$ordenar = array (	'`id` ASC' => 'ORDER RESULTS',
						'`producto` ASC' => 'PRODUCT A-Z',
						'`producto` DESC' => 'PRODUCT Z-A',
						'`nsemana` ASC' => 'N. WEEK 01-53',
						'`nsemana` DESC' => 'N. WEEK 53-01',
															);
	
	$campos2 = array (	'`id`' => 'FILTRO FECHAS',
						'`datekgin`' => 'DATE IN',
						'`datekgbad`' => 'DATE BAD',
						'`datecash`' => 'DATE CASH',
													);
	
	require '../config/ayear.php';
	
	$dm = array (	'' => 'MES',
					'01' => '01',
					'02' => '02',
					'03' => '03',
					'04' => '04',
					'05' => '05',
					'06' => '06',
					'07' => '07',
					'08' => '08',
					'09' => '09',
					'10' => '10',
					'11' => '11',
					'12' => '12',
								);
	
	$dd = array (	'' => 'DÍA',
					'01' => '01',
					'02' => '02',
					'03' => '03',
					'04' => '04',
					'05' => '05',
					'06' => '06',
					'07' => '07',
					'08' => '08',
					'09' => '09',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
					'21' => '21',
					'22' => '22',
					'23' => '23',
					'24' => '24',
					'25' => '25',
					'26' => '26',
					'27' => '27',
					'28' => '28',
					'29' => '29',
					'30' => '30',
					'31' => '31',
								);

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='auto'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td colspan='4' align='center'>
							VER STOCKS ".$_sec."
					</td>
				</tr>		
				<tr>
					<td>
					<div style='float:left'>
						<input type='submit' value='SELECCIONE SECCIÓN' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					<div style='float:left'>

						<select name='seccion'>");

						
			/* RECORREMOS el LOS VALORES DE LA TABLA PARA CONSTRUIR CON ELLOS UN SELECT */	
			
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
					</div>
				</td>
			</tr>
	
				
		</form>	
		
			
			</table>				
				"); 
				
/////////////////////////

	if ($_POST['oculto1'] || $_POST['oculto'] ) {
	if ($_POST['seccion'] == '') { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
										SELECCIONE SECCIÓN.
												</br></br>
										Y FILTRE LOS DATOS.
											</font>
										</td>
									</tr>
								</table>");
												}	
	if ($_POST['seccion'] != '') {
		print("
			<table align='center' style='border:0px;margin-top:4px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<th align='left'>
					<div style='float:left'>
					<input type='checkbox' name='vsolo' value='yes' ");
					if($defaults['vsolo'] == 'yes') {print(" checked=\"checked\"");}
			print(" />
					</div>
					<div style='float:left'>
						&nbsp;* SOLO ENTRADAS CON STOCKS > 0
					</div>
					
					<div style='float:left;margin-left:120px'>
					<input type='checkbox' name='tcomen' value='yes' ");
					if($defaults['tcomen'] == 'yes') {print(" checked=\"checked\"");}
			print(" />
					</div>
					<div style='float:left'>
						&nbsp;* LEER TODOS LOS COMENTARIOS
					</div>
					</th>
				</tr>

				<tr>
					<td>
					<div style='float:left'>
						<input type='submit' value='FILTRE CONSULTA' />
						<input type='hidden' name='oculto' value=1 />
					</div>
											
			<input name='seccion' type='hidden' value='".$_POST['seccion']."' />

					<div style='float:left'>

						<select name='Orden'>");

				
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("	</select>
					</div>
					
						<div style='float:left'>

						<select name='producto'>");

	require "../config/TablesNames.php";
	$sqlp =  "SELECT * FROM $secc ORDER BY `valor` ASC ";
	$qp = mysqli_query($db, $sqlp);
	if(!$qp){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rowp = mysqli_fetch_assoc($qp)){
					
					print ("<option value='".$rowp['valor']."' ");
					
					if($rowp['valor'] == $defaults['producto']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rowp['nombre']." </option>");
													global $proname;
													$proname = $rowp['nombre'];
		}

	} 
																
	print ("	</select>
				<input name='proname' type='hidden' value='".$proname."' />
					</div>

						<div style='float:left'>

						<select name='campo2'>");

				
				foreach($campos2 as $option2 => $label2){
					
					print ("<option value='".$option2."' ");
					
					if($option2 == $defaults['campo2']){
															print ("selected = 'selected'");
																								}
													print ("> $label2 </option>");
												}	

	print ("	</select>
					</div>

																
					<div style='float:left'>

						<select name='dy'>");

				
				foreach($dy as $optiondy => $labeldy){
					
					print ("<option value='".$optiondy."' ");
					
					if($optiondy == $defaults['dy']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldy </option>");
												}	
																
	print ("	</select>
					</div>

					<div style='float:left'>

						<select name='dm'>");

					
				foreach($dm as $optiondm => $labeldm){
					
					print ("<option value='".$optiondm."' ");
					
					if($optiondm == $defaults['dm']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldm </option>");
												}	
																
	print ("	</select>
					</div>

					<div style='float:left'>

						<select name='dd'>");

				
				foreach($dd as $optiondd => $labeldd){
					
					print ("<option value='".$optiondd."' ");
					
					if($optiondd == $defaults['dd']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldd </option>");
												}	
																
	print ("	</select>
					</div>
								
				</td>
			</tr>
				
		</form>	
			
			</table>				
				"); 
	}
		}
	
	}	
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Stocks.php';
		
				}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_data_ver(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'user' || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
		if ($_POST['dy'] == 0){ $dy = '';}	else {	$dy = ", ".$_POST['dy'];}
		if ($_POST['dm'] == 0){	$dm = '';}	else {	$dm = ", ".$_POST['dm'];}
		if ($_POST['dd'] == 0){ $dd = '';}	else {	$dd = ", ".$_POST['dd'];}
		if ($_POST['dw'] == 0){ $dw = '';}	else {	$dw = ", ".$_POST['dw'];}
		if ($_POST['campo2'] != '`nsemana`'){	$dw = ''; } else {	$dy = '';
																	$dm = '';
																	$dd = '';	}
		if( $_POST['campo2'] == '`id`'){	
			$value = ", SIN FILTROS ";}
		elseif( $_POST['campo2'] != '`nsemana`'){	
			$value = ", FILTRO: ".$_POST['campo2'].$dy.$dm.$dd;}
		elseif( $_POST['campo2'] == '`nsemana`'){	
			$value = ", FILTRO: ".$_POST['campo2'].$dw;}
			
		if($_POST['producto'] == ''){ $pro = ", TODOS";}
		else{ $pro = ", ".$_POST['producto'];}
 
		global $text;
		$text = "- STOCK VER ".$ActionTime.". ".$secc.$pro.$value;
		
		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text."\n";
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