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
								
				}
					else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	$errors = array();
	
	if ( (strlen(trim($_POST['nombre'])) == '') && (strlen(trim($_POST['refoper'])) == '')  && (strlen(trim($_POST['refclient'])) == '')){
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

	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {$dy1 = $_POST['dy'];
														$dy1 = $dy1;
														global $dyt1;
														$dyt1 = "20".$_POST['dy'];
																		}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {$dm1 = $_POST['dm'];
												$dm1 = "-".$dm1."-";}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {$dd1 = $_POST['dd'];
												$dd1 = $dd1."/";}

	$fil = "%".$dy1.$dm1.$dd1."%";

	$orden = $_POST['Orden'];
	
	if ($_POST['nombre'] == ''){$nom = 'ññ';}
	else{$nom = "%".$_POST['nombre']."%";}
	global $nombre;
	$nombre = $_POST['nombre'];
	
	if ($_POST['refoper'] == ''){$rop = 'ññ';}
	else{$rop = $_POST['refoper'];}
	global $refoper;
	$refoper = $_POST['refoper'];
	
	if ($_POST['refclient'] == ''){$rfc = 'ññ';}
	else{$rfc = $_POST['refclient'];}
	global $refclient;
	$refclient = $_POST['refclient'];
	
	require "../config/TablesNames.php";
	$sqlc =  "SELECT * FROM $ventas WHERE `refclient` = '$rfc' AND  `datecash` LIKE '$fil' OR `oper` = '$rop' AND  `datecash` LIKE '$fil' OR `clname` LIKE '$nom' AND  `datecash` LIKE '$fil' ORDER BY $orden ";
 	
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

	$sumapvptot = $sumapvptot + $ver['pvptot'];
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

	$sumaivae = $sumaivae + ($ver['ivae'] * $ver['kgcash']);
											}
}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
		} else {
			
			if(mysqli_num_rows($qc)== 0){
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

				} else { print ("<table align='center'>
									<tr>
										<th colspan=12 class='BorderInf'>
									".mysqli_num_rows($qc)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
											CJ. NAME
										</th>																			
										
										<th class='BorderInfDch'>
											REF CAJA
										</th>																			
										
										<th class='BorderInfDch'>
											CL. NAME
										</th>
										
										<th class='BorderInfDch'>
											REF CLIENT
										</th>
										
										<th class='BorderInfDch'>
											OPER SESION
										</th>																			
										
										<th class='BorderInfDch'>
											FECHA
										</th>																			
										
										<th class='BorderInfDch'>
											SECCION
										</th>										

										<th class='BorderInfDch'>
											PRODUCTO
										</th>
										
										<th class='BorderInfDch'>
											CARRO
										</th>
										
										<th class='BorderInfDch'>
											IVA€
										</th>
										
										<th class='BorderInfDch'>
											PVP
										</th>
										
										<th class='BorderInf'>
											SUBT
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
 			
			print (	"<tr align='center'>
									
	<input name='id' type='hidden' value='".$rowc['id']."' />
	<input name='proname' type='hidden' value='".$rowc['proname']."' />
	<input name='psiva' type='hidden' value='".$rowc['psiva']."' />
	<input name='iva' type='hidden' value='".$rowc['iva']."' />

						<td class='BorderInfDch' align='center'>
	<input name='cname' type='hidden' value='".$rowc['cname']."' />".$rowc['cname']."
						</td>
	
						<td class='BorderInfDch' align='left'>
	<input name='refcaja' type='hidden' value='".$rowc['refcaja']."' />".$rowc['refcaja']."
						</td>
						
						<td class='BorderInfDch' align='center'>
	<input name='clname' type='hidden' value='".$rowc['clname']."' />".$rowc['clname']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='refclient' type='hidden' value='".$rowc['refclient']."' />".$rowc['refclient']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='oper' type='hidden' value='".$rowc['oper']."' />".$rowc['oper']."
						</td>
						
	<input name='nsemana' type='hidden' value='".$rowc['nsemana']."' />
						
						<td class='BorderInfDch' align='right'>
	<input name='datecash' type='hidden' value='".$rowc['datecash']."' />".$rowc['datecash']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='vseccion' type='hidden' value='".$rowc['vseccion']."' />".$rowc['vseccion']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='producto' type='hidden' value='".$rowc['producto']."' />".$rowc['producto']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='kgcash' type='hidden' value='".$rowc['kgcash']."' />".$rowc['kgcash']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='ivae' type='hidden' value='".$rowc['ivae']."' />".$rowc['ivae']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='pvp' type='hidden' value='".$rowc['pvp']."' />".$rowc['pvp']."
						</td>

						<td class='BorderInf' align='right'>
	<input name='pvptot' type='hidden' value='".$rowc['pvptot']."' />".$rowc['pvptot']."
						</td>
										
		</form>
					</tr>");
							
								} /* Fin del while.*/ 

									print("		<tr>
										<td colspan='12' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										
										<td  colspan='5' class='BorderInf' align='right'>
												TOTALES:
										</td>
																				
										<td colspan='2' class='BorderInf' align='right'>
												IVA REPERCUTIDO €
										</td>
										
										<td class='BorderInfDch' align='left'>
												".$sumaivae." .€
										</td>
										
										<td colspan='2' class='BorderInf' align='right'>
												TOTAL €
										</td>
										
										<td colspan='2' class='BorderInf' align='left'>
												".$sumapvptot." .€
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
				$defaults = array ('nombre' => '',
								   'refoper' => '',
								   'refclient' => '',
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
		
	$ordenar = array (	'`oper` ASC' => 'Operacion Asc',
						'`oper` DESC' => 'Operacion Desc',
						'`clname` ASC' => 'Nombre Cliente Asc',
						'`clname` DESC' => 'Nombre Cliente Desc',
						'`refclient` ASC' => 'Ref Cliente Asc',
						'`refclient` DESC' => 'Ref Cliente Desc',
						'`cname` ASC' => 'Nombre Caja Asc',
						'`cname` DESC' => 'Nombre Caja Des',
						'`refcaja` ASC' => 'Ref Caja Asc',
						'`refcaja` DESC' => 'Ref Caja Desc',
																);

	print("
			<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=2>
						CONSULTAR VENTAS
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='FILTRO VENTAS' />
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
						REF CLIENTE
	<div style='float:right'>
	<input type='text' name='refclient' size=22 maxlength=20 value='".$defaults['refclient']."' />
	</div>
					</td>
				</tr>
	
				<tr>
					<td>
					</td>
					<td>	
						REF OPERACION
	<div style='float:right'>
	<input type='text' name='refoper' size=22 maxlength=20 value='".$defaults['refoper']."' />
	</div>
					</td>
				</tr>
				
				<tr>
					<td class='BorderInf'>
					</td>
					<td class='BorderInf'>	
						NOMBRE CLIENTE
	<div style='float:right'>
	<input type='text' name='nombre' size=22 maxlength=20 value='".$defaults['nombre']."' />
	</div>
					</td>
				</tr>
				
	</form>	
				
	<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center' class='BorderSup'>
						<input type='submit' value='TODAS LAS VENTAS' />
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
							"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function ver_todo(){
		
	global $db;
	global $db_name;

	$orden = $_POST['Orden'];

	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {	$dy1 = $_POST['dy'];
															$dy1 = $dy1;
															global $dyt1;
															$dyt1 = "20".$_POST['dy'];
																	}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {	$dm1 = $_POST['dm'];
												$dm1 = "-".$dm1."-";
																	}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {	$dd1 = $_POST['dd'];
												$dd1 = $dd1."/";
																	}
																	
	$fil = "%".$dy1.$dm1.$dd1."%";
	
	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $ventas WHERE `datecash` LIKE '$fil' ORDER BY $orden ";
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
										<th colspan=12 class='BorderInf'>
									".mysqli_num_rows($qb)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
											CJ. NAME
										</th>																			
										
										<th class='BorderInfDch'>
											REF CAJA
										</th>																			
										
										<th class='BorderInfDch'>
											CL. NAME
										</th>
										
										<th class='BorderInfDch'>
											REF CLIENT
										</th>
										
										<th class='BorderInfDch'>
											OPER SESION
										</th>																			
										
										<th class='BorderInfDch'>
											FECHA
										</th>																			
										
										<th class='BorderInfDch'>
											SECCION
										</th>										

										<th class='BorderInfDch'>
											PRODUCTO
										</th>
										
										<th class='BorderInfDch'>
											CARRO
										</th>
										
										<th class='BorderInfDch'>
											IVA€
										</th>
										
										<th class='BorderInfDch'>
											PVP
										</th>
										
										<th class='BorderInf'>
											SUBT
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

			print (	"<tr align='center'>
									
<form name='ver' action='Cliente_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\">

	<input name='id' type='hidden' value='".$rowb['id']."' />
	<input name='proname' type='hidden' value='".$rowb['proname']."' />
	<input name='psiva' type='hidden' value='".$rowb['psiva']."' />
	<input name='iva' type='hidden' value='".$rowb['iva']."' />

						<td class='BorderInfDch' align='center'>
	<input name='cname' type='hidden' value='".$rowb['cname']."' />".$rowb['cname']."
						</td>
	
						<td class='BorderInfDch' align='left'>
	<input name='refcaja' type='hidden' value='".$rowb['refcaja']."' />".$rowb['refcaja']."
						</td>
						
						<td class='BorderInfDch' align='center'>
	<input name='clname' type='hidden' value='".$rowb['clname']."' />".$rowb['clname']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='refclient' type='hidden' value='".$rowb['refclient']."' />".$rowb['refclient']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='oper' type='hidden' value='".$rowb['oper']."' />".$rowb['oper']."
						</td>
						
	<input name='nsemana' type='hidden' value='".$rowb['nsemana']."' />
						
						<td class='BorderInfDch' align='right'>
	<input name='datecash' type='hidden' value='".$rowb['datecash']."' />".$rowb['datecash']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='vseccion' type='hidden' value='".$rowb['vseccion']."' />".$rowb['vseccion']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='producto' type='hidden' value='".$rowb['producto']."' />".$rowb['producto']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='kgcash' type='hidden' value='".$rowb['kgcash']."' />".$rowb['kgcash']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='ivae' type='hidden' value='".$rowb['ivae']."' />".$rowb['ivae']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='pvp' type='hidden' value='".$rowb['pvp']."' />".$rowb['pvp']."
						</td>

						<td class='BorderInf' align='right'>
	<input name='pvptot' type='hidden' value='".$rowb['pvptot']."' />".$rowb['pvptot']."
						</td>
										
		</form>
					</tr>");
								} /* Fin del while.*/ 

									print("		<tr>
										<td colspan='12' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										
										<td  colspan='5' class='BorderInf' align='right'>
												TOTALES:
										</td>
																				
										<td colspan='2' class='BorderInf' align='right'>
												IVA REPERCUTIDO €
										</td>
										
										<td class='BorderInfDch' align='left'>
												".$sumaivae." .€
										</td>
										
										<td colspan='2' class='BorderInf' align='right'>
												TOTAL €
										</td>
										
										<td colspan='2' class='BorderInf' align='left'>
												".$sumapvptot." .€
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
		
				require '../Inclu/Master_Index_Caja.php';
		
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