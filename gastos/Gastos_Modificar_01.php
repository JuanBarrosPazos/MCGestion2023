<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

								if($_POST['todo']){
										show_form();							
										ver_todo();
										accion_Ver_01();
										}
								
								elseif($_POST['show_formcl']){
									
										if($form_errors = validate_form()){
											show_form($form_errors);

												} else {
													process_form();
													accion_Ver_01();
													}
									}
									
								else {
										show_form();
										}
								
				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	$errors = array();
	
	if ( (strlen(trim($_POST['factnum'])) == '') && (strlen(trim($_POST['factnif'])) == '')  && (strlen(trim($_POST['factnom'])) == '')){
		$errors [] = " UNO DE LOS TRES CAMPOS ES OBLIGATORIO";
		}
	
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	
	show_form();

	global $dyt1;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {	$dy1 = $_POST['dy'];
															$dyt1 = "20".$_POST['dy'];
																	}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {	$dm1 = "/".$_POST['dm']."/";
																	}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {	$dd1 = $_POST['dd'];
																	}

	$fil = "%".$dy1.$dm1.$dd1."%";

	$orden = $_POST['Orden'];
	
	// RAZON SOCIAL
	if ($_POST['factnom'] == ''){$fnom = 'ññ';}
	else{$fnom = "%".$_POST['factnom']."%";}
	global $factnom;
	$factnom = $_POST['factnom'];
	
	// NIF
	if ($_POST['factnif'] == ''){$fnif = 'ññ';}
	else{$fnif = $_POST['factnif'];}
	global $factnif;
	$factnif = $_POST['factnif'];
	
	// FACTURA Nº
	if ($_POST['factnum'] == ''){$fnum = 'ññ';}
	else{$fnum = $_POST['factnum'];}
	global $factnum;
	$factnum = $_POST['factnum'];
	
	require "../config/TablesNames.php";
	$sqlc =  "SELECT * FROM $gst_gastos WHERE `factnum` = '$fnum' AND `factdate` LIKE '$fil' OR `factnif` = '$fnif' AND  `factdate` LIKE '$fil' OR `factnom` LIKE '$fnom' AND  `factdate` LIKE '$fil' ORDER BY $orden ";
 	
	$qc = mysqli_query($db, $sqlc);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

if(!$qc){print(mysqli_error($db).".</br>");
}
else{
	$qpvptot = mysqli_query($db, $sqlc);
	$rowpvptot = mysqli_num_rows($qpvptot);
	$sumapvptot = 0;
		  for($i=0; $i<$rowpvptot; $i++)
										{
											$ver = mysqli_fetch_array($qpvptot);

	$sumapvptot = $sumapvptot + $ver['factpvptot'];
											}
}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////


/////////////////////	
/* PARA SUMAR IVA */

if(!$qc){print(mysqli_error($db).".</br>");
}
else{
	$qivae = mysqli_query($db, $sqlc);
	$rowivae = mysqli_num_rows($qivae);
	$sumaivae = 0;
		  for($i=0; $i<$rowivae; $i++)
										{
											$ver = mysqli_fetch_array($qivae);

	$sumaivae = $sumaivae + $ver['factivae'];
											}
}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br>");
		} else {
			
			if(mysqli_num_rows($qc) == 0){
							print ("<table align='center' style=\"border:0px\">
										<tr>
											<td align='center'>
												<font color='#FF0000'>
														NINGÚN DATO SE CIÑE A ESTOS CRITERIOS.
													</br>
														INTENTELO CON OTROS PARÁMETROS.
												</font>
											</td>
										</tr>
									</table>");

				} else { 	
							
							print ("<table align='center'>
									<tr>
										<th colspan=12 class='BorderInf'>
									".mysqli_num_rows($qc)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												ID
										</th>																			
										
										<th class='BorderInfDch'>
												NUMERO
										</th>																			
										
										<th class='BorderInfDch'>
												FECHA
										</th>																			
										
										<th class='BorderInfDch'>
												RAZON SOCIAL
										</th>
										
										<th class='BorderInfDch'>
												NIF / CIF
										</th>
										
										<th class='BorderInfDch'>
												IVA %
										</th>																			
										
										<th class='BorderInfDch'>
												IVA €
										</th>																			
										
										<th class='BorderInfDch'>
												SUBTOTAL
										</th>										

										<th class='BorderInfDch'>
												TOTAL
										</th>
										
										<th class='BorderInfDch'>
												DESCRIPCION
										</th>
										
										<th colspan='2' class='BorderInfDch'>

										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
 			
			print (	"<tr align='center'>
									
	<form name='modifica' action='Gastos_Modificar_02.php' method='POST'>
	
	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$gst_gastos."' />
	<input name='refprovee' type='hidden' value='".$rowc['refprovee']."' />
	
						<td class='BorderInfDch' align='center'>
	<input name='id' type='hidden' value='".$rowc['id']."' />".$rowc['id']."
						</td>

						<td class='BorderInfDch' align='center'>
	<input name='factnum' type='hidden' value='".$rowc['factnum']."' />".$rowc['factnum']."
						</td>
	
						<td class='BorderInfDch' align='left'>
	<input name='factdate' type='hidden' value='".$rowc['factdate']."' />".$rowc['factdate']."
						</td>
						
						<td class='BorderInfDch' align='center'>
	<input name='factnom' type='hidden' value='".$rowc['factnom']."' />".$rowc['factnom']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='factnif' type='hidden' value='".$rowc['factnif']."' />".$rowc['factnif']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factiva' type='hidden' value='".$rowc['factiva']."' />".$rowc['factiva']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factivae' type='hidden' value='".$rowc['factivae']."' />".$rowc['factivae']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvp' type='hidden' value='".$rowc['factpvp']."' />".$rowc['factpvp']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvptot' type='hidden' value='".$rowc['factpvptot']."' />".$rowc['factpvptot']."
						</td>

						<td class='BorderInfDch' align='right' width='180px'>
	<input name='coment' type='hidden' value='".$rowc['coment']."' />".$rowc['coment']."
						</td>

						<td class='BorderInfDch' align='right'>
										<input type='submit' value='MODIF DATOS' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
																			
		</form>
						<td align='center' class='BorderInf'>			
<form name='ver' action='Gastos_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

					<input name='id' type='hidden' value='".$rowc['id']."' />
					<input name='dyt1' type='hidden' value='".$dyt1."' />
					<input name='vname' type='hidden' value='".$gst_gastos."' />
					<input name='refprovee' type='hidden' value='".$rowc['refprovee']."' />
					<input name='coment' type='hidden' value='".$rowc['coment']."' />
					<input name='factpvptot' type='hidden' value='".$rowc['factpvptot']."' />
					<input name='factpvp' type='hidden' value='".$rowc['factpvp']."' />
					<input name='factivae' type='hidden' value='".$rowc['factivae']."' />
					<input name='factiva' type='hidden' value='".$rowc['factiva']."' />
					<input name='factnif' type='hidden' value='".$rowc['factnif']."' />
					<input name='factnom' type='hidden' value='".$rowc['factnom']."' />
					<input name='factdate' type='hidden' value='".$rowc['factdate']."' />
					<input name='factnum' type='hidden' value='".$rowc['factnum']."' />
						
								<input type='submit' value='MODIF DOCS' />
								<input type='hidden' name='oculto2' value=1 />
</form>						
					</td>
					</tr>");
								}  

									print("		<tr>
										<td colspan='12' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										
										<td colspan='3' class='BorderInf' align='right'>
												TOTALES
										</td>
																				
										<td colspan='3' class='BorderInf' align='right'>
												IVA SOPORTADO €
										</td>
										
										<td colspan='2' class='BorderInfDch' align='left'>
												".$sumaivae." .€
										</td>
										
										<td class='BorderInf' align='right'>
												TOTAL €
										</td>
										
										<td colspan='2' class='BorderInf' align='left'>
												".$sumapvptot." .€
										</td>
										
										<td class='BorderInf' align='right'>

										</td>
																				
								</tr>
						</table>
								");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	if($_POST['show_formcl']){
		$defaults = $_POST;
		}
	elseif($_POST['todo']){
		$defaults = $_POST;
		} else {global $ordenar;
				$defaults = array ('factnom' => '',
								   'factnif' => '',
								   'factnum' => '',
								   'Orden' => $ordenar,
								   						);
														}
	
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
										
	if ($errors){
		print("<font color='#FF0000'>
				Solucione estos errores: </font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."</br>");
			}
		}		
	
	$ordenar = array (	
						'`factnum` ASC' => 'Nº Factura Asc',
						'`factnum` DESC' => 'Nº Factura Desc',
						'`factnif` ASC' => 'NIF Asc',
						'`factnif` DESC' => 'NIF Desc',
						'`factnom` ASC' => 'Razon Social Asc',
						'`factnom` DESC' => 'Razon Social Desc',
																);
	
	print("
			<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=2>
						CONSULTAR GASTOS
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='FILTRO GASTOS' />
						<input type='hidden' name='show_formcl' value=1 />
					</td>
					
					<td class='BorderSup'>

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
					
				<tr>					
					<td>
					</td>	
					<td>	
						Nº FACTURA
	<div style='float:right'>
	<input type='text' name='factnum' size=22 maxlength=20 value='".$defaults['factnum']."' />
	</div>
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						NIF
	<div style='float:right'>
	<input type='text' name='factnif' size=22 maxlength=10 value='".$defaults['factnif']."' />
	</div>
					</td>
				</tr>
				
				<tr>
					<td class='BorderInf'>
					</td>
					<td class='BorderInf'>	
						RAZON SOCIAL
	<div style='float:right'>
	<input type='text' name='factnom' size=22 maxlength=22 value='".$defaults['factnom']."' />
	</div>
					</td>
				</tr>
	
						");
						
	print ("	</form>	
				
				<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center' class='BorderSup'>
						<input type='submit' value='TODOS LOS GASTOS' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td class='BorderSup'>	

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
							
				"); /* Fin del print */
	
	}	/* Fin show_form(); */

	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function ver_todo(){
		
	global $db;
	global $db_name;

	$orden = $_POST['Orden'];

	global $dyt1;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {	$dy1 = $_POST['dy'];
															$dyt1 = "20".$_POST['dy'];
																	}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {	$dm1 = "/".$_POST['dm']."/";
																	}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {	$dd1 = $_POST['dd'];
																	}

	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $gst_gastos WHERE `factdate` LIKE '$fil' ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
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

	$sumapvptot = $sumapvptot + $ver['factpvptot'];
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

	$sumaivae = $sumaivae + $ver['factivae'];
											}
}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb) == 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>.");

				} else { 	print ("<table align='center'>
										<th colspan=12 class='BorderInf'>
									".mysqli_num_rows($qb)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												ID
										</th>																			
										
										<th class='BorderInfDch'>
												NUMERO
										</th>																			
										
										<th class='BorderInfDch'>
												FECHA
										</th>																			
										
										<th class='BorderInfDch'>
												RAZON SOCIAL
										</th>
										
										<th class='BorderInfDch'>
												NIF / CIF
										</th>
										
										<th class='BorderInfDch'>
												IVA %
										</th>																			
										
										<th class='BorderInfDch'>
												IVA €
										</th>																			
										
										<th class='BorderInfDch'>
												SUBTOTAL
										</th>										

										<th class='BorderInfDch'>
												TOTAL
										</th>
										
										<th class='BorderInfDch'>
												DESCRIPCION
										</th>
										
										<th colspan='2' class='BorderInfDch'>

										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

	
			print (	"<tr align='center'>
									
	<form name='modifica' action='Gastos_Modificar_02.php' method='POST'>

	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$gst_gastos."' />
	<input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />

						<td class='BorderInfDch' align='center'>
	<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>

						<td class='BorderInfDch' align='center'>
	<input name='factnum' type='hidden' value='".$rowb['factnum']."' />".$rowb['factnum']."
						</td>
	
						<td class='BorderInfDch' align='left'>
	<input name='factdate' type='hidden' value='".$rowb['factdate']."' />".$rowb['factdate']."
						</td>
						
						<td class='BorderInfDch' align='center'>
	<input name='factnom' type='hidden' value='".$rowb['factnom']."' />".$rowb['factnom']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='factnif' type='hidden' value='".$rowb['factnif']."' />".$rowb['factnif']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factiva' type='hidden' value='".$rowb['factiva']."' />".$rowb['factiva']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factivae' type='hidden' value='".$rowb['factivae']."' />".$rowb['factivae']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />".$rowb['factpvp']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />".$rowb['factpvptot']."
						</td>

						<td class='BorderInfDch' align='left' width='180px'>
	<input name='coment' type='hidden' value='".$rowb['coment']."' />".$rowb['coment']."
						</td>
										
						<td class='BorderInfDch' align='right'>
								<input type='submit' value='MODIF DATOS' />
								<input type='hidden' name='oculto2' value=1 />
						</td>
																			
		</form>
						<td align='center' class='BorderInf'>			
<form name='modifica' action='Gastos_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

					<input name='id' type='hidden' value='".$rowb['id']."' />
					<input name='dyt1' type='hidden' value='".$dyt1."' />
					<input name='vname' type='hidden' value='".$gst_gastos."' />
					<input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />
					<input name='coment' type='hidden' value='".$rowb['coment']."' />
					<input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />
					<input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />
					<input name='factivae' type='hidden' value='".$rowb['factivae']."' />
					<input name='factiva' type='hidden' value='".$rowb['factiva']."' />
					<input name='factnif' type='hidden' value='".$rowb['factnif']."' />
					<input name='factnom' type='hidden' value='".$rowb['factnom']."' />
					<input name='factdate' type='hidden' value='".$rowb['factdate']."' />
					<input name='factnum' type='hidden' value='".$rowb['factnum']."' />
						
								<input type='submit' value='MODIF DOCS' />
								<input type='hidden' name='oculto2' value=1 />
		</form>						
					</td>
					</tr>");
					
								} /* Fin del while.*/ 

									print("		<tr>
										<td colspan='12' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										
										<td colspan='3' class='BorderInf' align='right'>
												TOTALES
										</td>
																				
										<td colspan='3' class='BorderInf' align='right'>
												IVA SOPORTADO €
										</td>
										
										<td colspan='2' class='BorderInfDch' align='left'>
												".$sumaivae." .€
										</td>
										
										<td class='BorderInf' align='right'>
												TOTAL €
										</td>
										
										<td colspan='2' class='BorderInf' align='left'>
												".$sumapvptot." .€
										</td>
										
										<td class='BorderInf' align='right'>

										</td>
																				
								</tr>
						</table>
								");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Gastos.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Ver_01(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	
	global $orden;
	if(!isset($_POST['Orden'])){
		$orden = "`id` ASC";
	} else { $orden = $_POST['Orden']; }
	
	if ($_POST['todo']){$nombre = "TODOS LOS USUARIOS ".$orden;}

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	global $text;
	$text = "- CLIENTE VER ".$ActionTime.". ".$nombre." ".$apellido;
	
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