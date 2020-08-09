<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
		
$sqld =  "SELECT * FROM `admin` WHERE `Email` = '$_POST[Email]' OR `Usuario` = '$_POST[Usuario]'";
 	
	$qd = mysqli_query($db, $sqld);
	
	$rowd = mysqli_fetch_assoc($qd);

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();


						if($_POST['oculto']){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
										//	accion_Stock_Crear();
											}
							
							} else {
										show_form();
								}
				}
					else { 
					
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

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;

	$errors = array();
	

		///////////////////////////////////////////////////////////////////////////////////
	
	if(strlen(trim($_POST['factnum'])) == 0){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnum'])) < 5){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}

	elseif (!preg_match('/^[A-Z,0-9\s]+$/',$_POST['factnum'])){
$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}

/*
	
	if(strlen(trim($_POST['factdate'])) == 0){
		$errors [] = "FECHA <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factdate'])) < 5){
		$errors [] = "FECHA <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Caracteres no válidos.</font>";
		}
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}
*/

	 /*VALIDAMOS EL CAMPO factnom */
	
	if(strlen(trim($_POST['factnom'])) == 0){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnom'])) < 5){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}

	 /*VALIDAMOS EL CAMPO factnif */
	
	if(strlen(trim($_POST['factnif'])) == 0){
		$errors [] = "NIF/CIF <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnif'])) < 5){
		$errors [] = "NIF/CIF <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[A-Z,0-9\s]+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}

	/* Validamos el campo iva. */
	
	if($_POST['factiva'] == ''){
		$errors [] = "IVA: <font color='#FF0000'>SELECCIONE EL TIPO DE IVA</font>";
		}
					
	/* VALIDAMOS EL CAMPO factivae */
	
		if(strlen(trim($_POST['factivae1'])) == 0){
			$errors [] = "IVA € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae1'])){
			$errors [] = "IVA € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae1'])){
			$errors [] = "IVA € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factivae2'])) == 0){
			$errors [] = "IVA € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae2'])){
			$errors [] = "IVA € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae2'])){
			$errors [] = "IVA € <font color='#FF0000'>SOLO NUMEROS</font>";
			}
	/* VALIDAMOS EL CAMPO factpvp */
	
		if(strlen(trim($_POST['factpvp1'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvp2'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	/* VALIDAMOS EL CAMPO factpvptot */
	
		if(strlen(trim($_POST['factpvptot1'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot1'])){
			$errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot1'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvptot2'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot2'])){
			$errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot2'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	 /*VALIDAMOS EL CAMPO coment. */
		
	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "COMENTARIOS <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['coment'])) < 20){
		$errors [] = "COMENTARIOS <font color='#FF0000'>Más de 20 carácteres.</font>";
		}
		
	elseif (strlen(trim($_POST['coment'])) > 19){

	if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ €]+$/',$_POST['coment'])){
		$errors [] = "COMENTARIOS  <font color='#FF0000'>A escrito caracteres no permitidos. { } [ ] ¿ ? < > ¡ ! @ # ...</font>";
		}
	}

	 /*VALIDAMOS EL CAMPO dy & dm & dd */
		
	if(trim($_POST['dy']) == ''){
		$errors [] = "YEAR <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dm']) == ''){
		$errors [] = "MONTH <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dd']) == ''){
		$errors [] = "DAY <font color='#FF0000'>Campo obligatorio.</font>";
		}

////////////////

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;

	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;

	$fiva = $_POST['factiva'];
	
	$civae = $factpvp * ($fiva / 100);
	$civae = number_format($civae,2);
	if(trim($factivae) !== trim($civae)){
			$errors [] = "IVA € <font color='#FF0000'>Cantidad no correcta</font> ".$civae." OK";
	}
	
	$cftot = $factpvp + $civae;
	$cftot = number_format($cftot,2);
	if(trim($factpvptot) !== trim($cftot)){
			$errors [] = "TOTAL € <font color='#FF0000'>Cantidad no correcta</font> ".$cftot." OK";
	}
	
////////////////////
	
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	
	global $dyt1;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {$dy1 = $_POST['dy'];
														$dy1 = $dy1;
														$dyt1 = "20".$_POST['dy'];
																		}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {$dm1 = $_POST['dm'];
												$dm1 = "/".$dm1."/";}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {$dd1 = $_POST['dd'];
												$dd1 = $dd1;}

	global $factdate;
	$factdate = $_POST['dy']."/".$_POST['dm']."/".$_POST['dd'];

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;

	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;

	$vname = "gastos_".$dyt1;
	$vname = "`".$vname."`";

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						SE HA GRABADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr>
					<td>
						NUMERO
					</td>
					<td>"
						.$_POST['factnum'].
					"</td>
					<td>	
						FECHA
					</td>
					<td>"
						.$factdate.
					"</td>
				</tr>
				
				<tr>
					<td>
						RAZON SOCIAL
					</td>
					<td>"
						.$_POST['factnom'].
					"</td>
					<td>
						NIF / CIF
					</td>
					<td>"
						.$_POST['factnif'].
					"</td>
				</tr>
								
				<tr>
					<td>
						IVA %
					</td>
					<td>"
						.$_POST['factiva'].
					"</td>
					<td>
						IVA €
					</td>
					<td width=250px>"
						.$factivae.
					"</td>
				</tr>
								
				<tr>
					<td>
						SUBTOTAL
					</td>
					<td>"
						.$factpvp.
					"</td>
					<td>
						TOTAL
					</td>
					<td>"
						.$factpvptot.
					"</td>
				</tr>
								
				<tr>
					<td>
						DESCRIPCION
					</td>
					<td colspan='3'>"
						.$_POST['coment'].
					"</td>
				</tr>

			</table>
				
		";	
		
		/////////////
		
		global $db;
		global $db_name;


	$sqla = "UPDATE `$db_name`.$vname  SET `factnum` = '$_POST[factnum]', `factdate` = '$factdate', `factnom` =  '$_POST[factnom]', `factnif` = '$_POST[factnif]', `factiva` = '$_POST[factiva]', `factivae` = '$factivae', `factpvp` = '$factpvp',  `factpvptot` = '$factpvptot', `coment` = '$_POST[coment]' WHERE $vname.`id` = '$_POST[id]'  ";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
					} else {
							print("* MODIFIQUE LA ENTRADA: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}

					}
	
//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $db;
	global $db_name;
	
	$sqlx =  "SELECT * FROM `proveedoresfeed` WHERE `ref` = '$_POST[proveedores]'";
	$qx = mysqli_query($db, $sqlx);
	$rowprovee = mysqli_fetch_assoc($qx);
	$_rsocial = $rowprovee['rsocial'];
	$_ref = $rowprovee['ref'];
	$_dni = $rowprovee['dni'];
	$_ldni = $rowprovee['ldni'];
	global $_dnil;
	$_dnil = $_dni.$_ldni;
	

	if($_POST['oculto2']){
		
		$datex = $_POST['factdate'];
		$dyx = substr($_POST['factdate'],0,2);
		$dmx = substr($_POST['factdate'],3,2);
		$ddx = substr($_POST['factdate'],-2,2);

		$ivae = strlen(trim($_POST['factivae']));
		$ivae = $ivae - 3;
		$ivaex = $_POST['factivae'];
		$ivae1 = substr($_POST['factivae'],0,$ivae);
		$ivae2 = substr($_POST['factivae'],-2,2);

		$factpvp = strlen(trim($_POST['factpvp']));
		$factpvp = $factpvp - 3;
		$factpvpx = $_POST['factpvp'];
		$factpvp1 = substr($_POST['factpvp'],0,$factpvp);
		$factpvp2 = substr($_POST['factpvp'],-2,2);
		
		$factpvptot = strlen(trim($_POST['factpvptot']));
		$factpvptot = $factpvptot - 3;
		$factpvptotx = $_POST['factpvptot'];
		$factpvptot1 = substr($_POST['factpvptot'],0,$factpvptot);
		$factpvptot2 = substr($_POST['factpvptot'],-2,2);
		
		$dnie = strlen(trim($_POST['factnif']));
		$dnie = $dnie - 1;
		$dnix = $_POST['factnif'];
		$dninx = substr($_POST['factnif'],0,$dnie);
		$dnilx = substr($_POST['factnif'],-1,1);
		$dninx = trim($dninx);
		$dnilx = trim($dnilx);
		$fil1 = "%".$dninx."%";
		$fil2 = "%".$dnilx."%";

		$sx =  "SELECT * FROM `proveedoresfeed` WHERE `dni` LIKE '$fil1' LIMIT 1 ";
		$qx = mysqli_query($db, $sx);
		$rowpv = mysqli_fetch_assoc($qx);
		$_rsocial = $rowpv['rsocial'];
		$_ref = $rowpv['ref'];
		$_dni = $rowpv['dni'];
		$_ldni = $rowpv['ldni'];
		global $_dnil;
		$_dnil = $_dni.$_ldni;
	
				$defaults = array ( 'id' => $_POST['id'],
									'proveedores' => $_POST['refprovee'],
									'dy' => $dyx,
									'dm' => $dmx,
									'dd' => $ddx,
									'factnum' => $_POST['factnum'],
								//	'factdate' => $_POST['factdate'],
								   	'factnom' => $_POST['factnom'],
								   	'factnif' => $_POST['factnif'],
								   	'factiva' => $_POST['factiva'],
									'factivae1' => $ivae1,	
									'factivae2' => $ivae2,	
									'factpvp1' => $factpvp1,	
									'factpvp2' => $factpvp2,	
									'factpvptot1' => $factpvptot1,	
									'factpvptot2' => $factpvptot2,	
									'coment' => $_POST['coment'],	
																	);
								   											}
	if($_POST['oculto']){
		$defaults = $_POST;
		} 

	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."</br>");
			}
		}
		
	$factiva = array (	'' => 'IVA',
						'21' => '21 %',
						'10' => '10 %',
						'4' => '4 %',
									);

	require '../config/ayear.php';
								
	$dm = array (	'' => 'MONTH',
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
	
	$dd = array (	'' => 'DAY',
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
										

				
////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

								MODIFICAR GASTO					
 
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

<input name='id' type='hidden' value='".$defaults['id']."' />

				<tr>
					<td>
					<div style='float:left'>
						<input type='submit' value='SELECCIONE PROVEEDOR' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					</td>
					
					<td>
					<div style='float:left'>

						<select name='proveedores'>");

						
	global $db;
	$sqlb =  "SELECT * FROM `proveedoresfeed` ORDER BY `rsocial` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == $defaults['proveedores']){
															print ("selected = 'selected'");
																								}
													print ("> ".$rows['rsocial']." </option>");
		}

	}  

	print ("	</select>
					</div>
				</td>
			</tr>
			
				<tr>
					<td>
						NUMERO
					</td>
					<td>

<input type='text' name='factnum' size=22 maxlength=20 value='".$defaults['factnum']."' />

					</td>
				</tr>
									
				<tr>
					<td>						
						FECHA
					</td>
					<td>
					
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

						<select style='margin-left:12px' name='dm'>");

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

						<select style='margin-left:12px' name='dd'>");

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
						RAZON SOCIAL
					</td>
					<td>
<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						NIF/CIF
					</td>
					<td>
<input type='hidden' name='factnif'value='".$defaults['factnif']."' />".$defaults['factnif']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						IVA %
					</td>
					<td>
						<select name='factiva'>");

				foreach($factiva as $optionfactiva => $labelfactiva){
					
					print ("<option value='".$optionfactiva."' ");
					
					if($optionfactiva == $defaults['factiva']){
															print ("selected = 'selected'");
																								}
													print ("> $labelfactiva </option>");
												}	
	
	print ("</select>
					
					</td>
				</tr>

				<tr>
					<td>						
						IVA €
					</td>
					<td>
<input style='text-align:right' type='text' name='factivae1' size=5 maxlength=5 value='".$defaults['factivae1']."' />
,
<input type='text' name='factivae2' size=2 maxlength=2 value='".$defaults['factivae2']."' />
.€
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						SUBTOTAL €
					</td>
					<td>
<input style='text-align:right' type='text' name='factpvp1' size=5 maxlength=5 value='".$defaults['factpvp1']."' />
,
<input type='text' name='factpvp2' size=2 maxlength=2 value='".$defaults['factpvp2']."' />
.€
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						TOTAL €
					</td>
					<td>
<input style='text-align:right' type='text' name='factpvptot1' size=5 maxlength=5 value='".$defaults['factpvptot1']."' />
,
<input type='text' name='factpvptot2' size=2 maxlength=2 value='".$defaults['factpvptot2']."' />
.€
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>
						DESCRIPCIÓN
					</td>
					<td>
					
<textarea cols='35' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment'>".$defaults['coment']."</textarea>
	
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 200 characters            
				</div>

					</td>
				</tr>

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR GASTO' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				
						"); 
		}

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Stock_Crear(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTO CREAR ".$ActionTime.". ".$secc.".\n\t Pro Name: ".$_POST['nombre'].".\n\t Pro Valor: ".$_POST['valor'].".\n\t Pro Ref: ".$_POST['ref'].".\n\t Coment: ".$_POST['coment'];

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
	
	function master_index(){
		
				require '../Inclu/Master_Index_Gastos.php';
		
				} /* Fin funcion master_index.*/

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