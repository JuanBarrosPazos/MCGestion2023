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

					if($_POST['oculto']){
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
	
	show_form();
	
	$secc = "feed".$_POST['seccion'];
	$secc = "`".$secc."`";
	
	$orden = $_POST['Orden'];
	$fil = "%".$_POST['producto']."%";
	$camp2 = $_POST['campo2'];
	if ($_POST['dy'] == 0){ 
							$dy1 = '';}
										else {	$dy1 = $_POST['dy'];
												$dy1 = $dy1;
																	}
	if ($_POST['dm'] == 0){ 
							$dm1 = '';}
										else {	$dm1 = $_POST['dm'];
												$dm1 = "-".$dm1."-";
																	}
	if ($_POST['dd'] == 0){ 
							$dd1 = '';}
										else {	$dd1 = $_POST['dd'];
												$dd1 = $dd1;
																	}
	if ($_POST['dw'] == 0){ 
							$dw1 = '';}
										else {	$dw1 = $_POST['dw'];
												$dw1 = $dw1;
																	}
	if ($_POST['campo2'] !== '`nsemana`'){	$dw1 = ''; }
														else {	$dy1 = '';
																$dm1 = '';
																$dd1 = '';	}
																	

	$fil2 = "%".$dw1.$dy1.$dm1.$dd1."%";

	
$sqlb = "SELECT * FROM $secc WHERE `producto` LIKE '$fil' AND $camp2 LIKE '$fil2' ORDER BY $orden";
 	
	$qb = mysqli_query($db, $sqlb);


	global $db;
	global $_sec;

	$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];
	$producto = "feedpro".$_POST['seccion'];

	if(!$qb){
			
/*
	print("</br> <font color='#FF0000'>Se ha producido un error: </form>".mysqli_error($db)."</br>");
	
*/
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
											TIENE QUE SELECCIONAR UNA SECCIÓN PARA VER LOS DATOS.
												</br></br>
													Y ORDENENARLOS SEGÚN SUS PREFERENCIAS.
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
													NO HAY DATOS EN ".$_sec."
											</font>
										</td>
									</tr>
								</table>");

				} else { print ("<table align='center'>
									<tr>
									<tr style='font-size:13px'>
										<th colspan=17 class='BorderInf'>
												FEEDBACK ".$_sec."
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
											PRO REF
										</th>																			
										
										<th class='BorderInfDch'>
											PRO NAME
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
										
										<th class='BorderInfDch'>
											IN
										</th>																				
										
										<th class='BorderInfDch'>
											DATE IN
										</th>																				
										
										<th class='BorderInfDch'>
											BAD
										</th>																				
										
										<th class='BorderInfDch'>
											DATE BAD
										</th>																														
										
										<th class='BorderInfDch'>
											CASH
										</th>
										
										<th class='BorderInfDch'>
											CASH.€
										</th>	
																												
										<th class='BorderInfDch'>						
											DATE CASH
										</th>	
																												
										<th class='BorderInfDch'>
											STOCK
										</th>										
										
										<th class='BorderInf'>
											COMENTARIOS
										</th>

									</tr>"
								);
			
			while($rowb = mysqli_fetch_row($qb)){

	$semana = date('W');
	$date = date('Y-m-d');

	if(($rowb[5] == '') || ($rowb[5] == '0')){	
												$rowb[5] = $date;
																	}
	
	if(($rowb[1] == '') || ($rowb[1] == '0')){	
												$rowb[1] = $semana;
																	}

	if(($rowb[10] == '') || ($rowb[10] == '0')){	
												$rowb[10] = $date;
																	}
	if(($rowb[7] == '') || ($rowb[7] == '0')){
												$kgbad = "SIN FECHA";	
												$rowb['datekgbad'] = $kgbad;
																	}
						
	if(($rowb[2] == '') || ($rowb[2] == '0')){
												$provalor = "NO NAME";	
												$rowb[2] = $provalor;
																	}
							
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
															".$rowb[4]."%
													</td>
																				
													<td class='BorderInfDch' align='right'>
															".$rowb[5]."
													</td>
																										
													<td class='BorderInfDch' align='right'>
															".$rowb[6]."
													</td>
														
													<td class='BorderInfDch' align='right'>
															".$rowb[7]."
													</td>
														
													<td class='BorderInfDch' align='right'>
															".$rowb[8]."
													</td>
														
													<td class='BorderInfDch' align='center'>
															".$rowb[9]."
													</td>
													
													<td class='BorderInfDch'>
															".$rowb[10]."
													</td>
													
													<td class='BorderInfDch' align='center'>
															".$rowb[11]."
													</td>
													
													<td class='BorderInfDch' align='right'>
															".$rowb[12]."
													</td>
													
													<td class='BorderInfDch' align='right'>
															".$rowb[13]."
													</td>
													
													<td class='BorderInfDch' align='center'>
															".$rowb[14]."
													</td>
													
													<td class='BorderInfDch' align='right'>
															".$rowb[15]."
													</td>
													
											<td class='BorderInf' align='left' width='140px'>
															".$rowb[16]."
													</td>
														
												</tr>");
					
						} /* Fin del while.*/ 

						print("	</table>");
			
						} /* Fin segundo else anidado en if */
		
				} /* Fin de primer else . */
		
		} /* Fin ver_todo_1();*/

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	if($_POST['oculto1']){
		$defaults = $_POST;
		}	
			elseif($_POST['oculto']){
		$defaults = $_POST;
		}
			 else {
				$defaults = array ('seccion' => $section,
								   'Orden' => $ordenar,
								   'producto' => $producto,
								   'campo2' => $campos2,
								   'dy' => '',
								   'dm' => '',
								   'dd' => '',
								   'dw' => '',
								   );
								   		}

	global $db;
	global $_sec;

	$sqlx =  "SELECT * FROM `secciones` WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];
	$producto = "feedpro".$_POST['seccion'];
		
		$_sec = 'VER FEEDBACK STOCK';
		
	$ordenar = array (	'`id` ASC' => 'ORDER RESULTS',
						'`producto` ASC' => 'PRODUCT A-Z',
						'`producto` DESC' => 'PRODUCT Z-A',
						'`nsemana` DESC' => 'N. WEEK 53-01',
						'`nsemana` ASC' => 'N. WEEK 01-53',
															);
						
	$campos2 = array (	'`id`' => 'FILTRO FECHAS',
						'`nsemana`' => 'Nº WEEK',
						'`borrado`' => 'DATE DELETE',
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
	$dw = array (	'' => 'SEMANA',
					'00' => '00',
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
					'32' => '32',
					'33' => '33',
					'34' => '34',
					'35' => '35',
					'36' => '36',
					'37' => '37',
					'38' => '38',
					'39' => '39',
					'40' => '40',
					'41' => '41',
					'42' => '42',
					'43' => '43',
					'44' => '44',
					'45' => '45',
					'46' => '46',
					'47' => '47',
					'48' => '48',
					'49' => '49',
					'50' => '50',
					'51' => '51',
					'52' => '52',
					'53' => '53',
										);


		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td colspan='4'>
						FEEDBACK STOCK ".$_sec."
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
	if ($_POST['seccion'] !== '') {
		print("
			<table align='center' style='border:0px;margin-top:4px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
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

	global $db;
	$sqlp =  "SELECT * FROM `$producto` ORDER BY `valor` ASC ";
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
		
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Stocks.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_data_ver(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	
		if ($_POST['dy'] == 0){ $dy = '';}	else {	$dy = ", ".$_POST['dy'];}
		if ($_POST['dm'] == 0){	$dm = '';}	else {	$dm = ", ".$_POST['dm'];}
		if ($_POST['dd'] == 0){ $dd = '';}	else {	$dd = ", ".$_POST['dd'];}
		if ($_POST['dw'] == 0){ $dw = '';}	else {	$dw = ", ".$_POST['dw'];}
		if ($_POST['campo2'] !== '`nsemana`'){	$dw = ''; } else {	$dy = '';
																	$dm = '';
																	$dd = '';	}
		if( $_POST['campo2'] == '`id`'){	
			$value = ", SIN FILTROS ";}
		elseif( $_POST['campo2'] !== '`nsemana`'){	
			$value = ", FILTRO: ".$_POST['campo2'].$dy.$dm.$dd;}
		elseif( $_POST['campo2'] == '`nsemana`'){	
			$value = ", FILTRO: ".$_POST['campo2'].$dw;}
	 
		if($_POST['producto'] == ''){ $pro = ", TODOS";}
		else{ $pro = ", ".$_POST['producto'];}
	 
		global $text;
		$text = "- STOCK FEEDBACK VER ".$ActionTime.". ".$secc.$pro.$value;
		
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