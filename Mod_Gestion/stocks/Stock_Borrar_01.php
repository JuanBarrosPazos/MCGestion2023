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
											accion_Borrar_01();												
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
	if ($_POST['campo2'] != '`nsemana`'){	$dw1 = ''; }
														else {	$dy1 = '';
																$dm1 = '';
																$dd1 = '';	}
																	

	$fil2 = "%".$dw1.$dy1.$dm1.$dd1."%";

 
	require "../config/TablesNames.php";
	$sqlc =  "SELECT * FROM $tablastock3 WHERE `producto` LIKE '$fil' AND $camp2 LIKE '$fil2' ORDER BY $orden";
	$qc = mysqli_query($db, $sqlc);
	
	$sqlx =  "SELECT * FROM $secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];
	$producto = "pro".$_POST['seccion'];

	if(!$qc){
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

				} else { print ("<table align='center'>
									<tr style='font-size:13px'>
										<th colspan=18 class='BorderInf'>
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
										
										<th class='BorderInfDch'>
											COMENTARIOS
										</th>

										<th class='BorderInf'>
											
										</th>

												</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
				
			print (	"<tr align='center'>
									
				<form name='modifica' action='Stock_Borrar_02.php' method='POST'>
				
		<input name='seccion' type='hidden' value='".$_POST['seccion']."' />

						<td class='BorderInfDch'>
		<input name='id' type='hidden' value='".$rowc['id']."' />".$rowc['id']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='nsemana' type='hidden' value='".$rowc['nsemana']."' />".$rowc['nsemana']."
						</td>
						
						<td class='BorderInfDch' align='center'>
		<input name='producto' type='hidden' value='".$rowc['producto']."' />".$rowc['producto']."
						</td>
						
						<td class='BorderInfDch' align='center'>
		<input name='proname' type='hidden' value='".$rowc['proname']."' />".$rowc['proname']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='psiva' type='hidden' value='".$rowc['psiva']."' />".$rowc['psiva']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='iva' type='hidden' value='".$rowc['iva']."' />".$rowc['iva']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='ivae' type='hidden' value='".$rowc['ivae']."' />".$rowc['ivae']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='pvp' type='hidden' value='".$rowc['pvp']."' />".$rowc['pvp']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='kgin' type='hidden' value='".$rowc['kgin']."' />".$rowc['kgin']."
						</td>
													
						<td class='BorderInfDch'>
		<input name='datekgin' type='hidden' value='".$rowc['datekgin']."' />".$rowc['datekgin']."
						</td>
													
						<td class='BorderInfDch' align='right'>
		<input name='kgbad' type='hidden' value='".$rowc['kgbad']."' />".$rowc['kgbad']."
						</td>
													
						<td class='BorderInfDch'>
		<input name='datekgbad' type='hidden' value='".$rowc['datekgbad']."' />".$rowc['datekgbad']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='kgcash' type='hidden' value='".$rowc['kgcash']."' />".$rowc['kgcash']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='pvptot' type='hidden' value='".$rowc['pvptot']."' />".$rowc['pvptot']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='datecash' type='hidden' value='".$rowc['datecash']."' />".$rowc['datecash']."
						</td>
						
						<td class='BorderInfDch' align='right'>
		<input name='kgdifer' type='hidden' value='".$rowc['kgdifer']."' />".$rowc['kgdifer']."
						</td>
						
						<td class='BorderInfDch' align='left' width='120px'>
		<input name='coment' type='hidden' value='".$rowc['coment']."' />".$rowc['coment']."
						</td>

						<td colspan=2 align='center' class='BorderInf'>
										<input type='submit' value='BORRAR' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
										
			</form>
										
					</tr>");
					
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
	global $campos2;

	if($_POST['oculto1']){
		$defaults = $_POST;
				$defaults = array ('seccion' => $_POST['seccion'],
								   'Orden' => $ordenar,
								   'producto' => $producto,
								   'campo2' => $campos2,
								   'dy' => '',
								   'dm' => '',
								   'dd' => '',
								   'dw' => '',);
		} elseif($_POST['oculto']){
					$defaults = $_POST;
		} else {
				$defaults = array ('seccion' => $_POST['seccion'],
								   'Orden' => $ordenar,
								   'producto' => $producto,
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
						'`nsemana` DESC' => 'N. WEEK 53-01',
						'`nsemana` ASC' => 'N. WEEK 01-53',
															);
						
	$campos2 = array (	'`id`' => 'FILTRO FECHAS',
						'`nsemana`' => 'Nº WEEK',
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
						BORRAR DATOS STOCK ".$_sec."
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

function accion_Borrar_01(){

	global $db;
	global $rowout;
	global $tablastock3;

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	
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
		$text = "- STOCK BORRAR 1 ".$ActionTime.". ".$tablastock3.$pro.$value;

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
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Stocks.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>