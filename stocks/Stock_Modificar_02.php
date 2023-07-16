<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require "../config/TablesNames.php";
	$sqld =  "SELECT * FROM $gst_admin WHERE `id` = '$_POST[id]'";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

							if ($_POST['oculto2']){
											show_form();
											accion_modifica_01();													
								}
							elseif($_POST['oculto']){
								
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else {
												process_form();
												accion_modifica_02();
												}
								
								} else {
											show_form();
									}

				} else { 
					
											require "../Inclu/AccesoDenegado.php";			

								
							}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;

	$kgin1 = $_POST['kgin1'];	
	$kgin2 = $_POST['kgin2'];
	global $kgin;	
	$kgin= $kgin1.".".$kgin2;
	
	$kgbad1 = $_POST['kgbad1'];	
	$kgbad2 = $_POST['kgbad2'];	
	global $kgbad;
	$kgbad = $kgbad1.".".$kgbad2;
	
	$kgcash1 = $_POST['kgcash1'];	
	$kgcash2 = $_POST['kgcash2'];
	global $kgcash;	
	$kgcash = $kgcash1.".".$kgcash2;
	
	$errors = array();
	
	
	if($_POST['producto'] == ''){
		$errors [] = "PRODUCTO: <font color='#FF0000'>NO HA SELECCIONADO NINGÚN PRODUCTO.</font>";
		}
	
	
	if($_POST['iva'] == ''){
		$errors [] = "IVA: <font color='#FF0000'>SELECCIONE EL TIPO DE IVA</font>";
		}
					
	
		if(strlen(trim($_POST['kgin1'])) == ''){
			$errors [] = "UNIT ENTRADA: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgin1'])){
			$errors [] = "UNIT ENTRADA: <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['kgin1'])){
			$errors [] = "UNIT ENTRADA: <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	
		if(strlen(trim($_POST['kgin2'])) == ''){
			$errors [] = "DEC ENTRADA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgin2'])){
			$errors [] = "DEC ENTRADA <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['kgin2'])){
			$errors [] = "DEC ENTRADA <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	
		if(strlen(trim($_POST['pvp1'])) == ''){
			$errors [] = "€ PVP SIN IVA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['pvp1'])){
			$errors [] = "€ PVP SIN IVA <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['pvp1'])){
			$errors [] = "€ PVP SIN IVA <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	
		if(strlen(trim($_POST['pvp2'])) == ''){
			$errors [] = "CENT PVP SIN IVA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['pvp2'])){
			$errors [] = "CENT PVP SIN IVA <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['pvp2'])){
			$errors [] = "CENT PVP SIN IVA <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	
					
		if(strlen(trim($_POST['kgbad1'])) == ''){
			$errors [] = "UNIT PERECEDEROS: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgbad1'])){
			$errors [] = "UNIT PERECEDEROS: <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['kgbad1'])){
			$errors [] = "UNIT PERECEDEROS: <font color='#FF0000'>SOLO NUMEROS</font>";
			}
			
		elseif($kgin < $kgbad){
		$errors [] = " <font color='#FF0000'>MAS PERECEDEROS QUE UNIT ENTRADA</font>";
			}

	
		if(strlen(trim($_POST['kgbad2'])) == ''){
			$errors [] = "DEC PERECEDEROS <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgbad2'])){
			$errors [] = "DEC PERECEDEROS <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['kgbad2'])){
			$errors [] = "DEC PERECEDEROS <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		
		if(strlen(trim($_POST['kgcash1'])) == 0){
			$errors [] = "UNIT CAJA: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgcash1'])){
			$errors [] = "UNIT CAJA: <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['kgcash1'])){
			$errors [] = "UNIT CAJA: <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		elseif($kgcash > $kgin){
			$errors [] = "<font color='#FF0000'>MAS DE CAJA QUE DE ENTRADA</font>";
			}
			
	
		if(strlen(trim($_POST['kgcash2'])) == 0){
			$errors [] = "DEC CAJA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgcash2'])){
			$errors [] = "DEC CAJA <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['kgcash2'])){
			$errors [] = "DEC CAJA <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	$vkgin = $kgin;
	$vkgbad = $kgbad;
	$vkgcash = $kgcash;
	$vdif = $vkgin - $vkgbad;
	$vtot = $vdif - $vkgcash;
	/* if (($vdif - $vkcash) < 0){ $vtot = '- ' .$vtot;} */
	
	if($kgcash > $vdif){
		$errors [] = 
					"CAJA:<font color='#FF0000'>
					MAS CAJA QUE: ENTRADA - PERECEDEROS ".$vdif.". 
					DIFER TOTAL ".$vtot.".
							</font>";
										}
			
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $_sec;

	require "../config/TablesNames.php";

	$sql =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sql);
	$rowseccion = mysqli_fetch_assoc($q);
	$_sec = $rowseccion['nombre'];

	$semana = date('W');
	$date = date('Y-m-d');
	$datekgbad = array ('SIN FECHA' => 'NO INSERTAR FECHA',
						''.$fechakgbad.'' => 'INSERTAR FECHA'
															);														
	$kgin1 = $_POST['kgin1'];	
	$kgin2 = $_POST['kgin2'];
	global $kgin;	
	$kgin= $kgin1.".".$kgin2;
	
	$kgbad1 = $_POST['kgbad1'];	
	$kgbad2 = $_POST['kgbad2'];	
	global $kgbad;
	$kgbad = $kgbad1.".".$kgbad2;
	
	$kgcash1 = $_POST['kgcash1'];	
	$kgcash2 = $_POST['kgcash2'];
	global $kgcash;	
	$kgcash = $kgcash1.".".$kgcash2;
	
	$pvp1 = $_POST['pvp1'];	
	$pvp2 = $_POST['pvp2'];	
	$psiva = $pvp1.".".$pvp2;
	
	$ivaop = $_POST['iva'];
	$ivae = $psiva * ($ivaop / 100);
	$ivaef = "&nbsp; + ".$ivae." €.";
	
	$entrada = $kgin;
	$perecedero = $kgbad;
	$caja = $kgcash;
	global $diferencia;
	$diferencia = ($entrada - $perecedero) - $caja;
	
	global $pvp;
	$pvp = $psiva + $ivae;
	
	$pvptot = $caja * $pvp;

	if (($entrada - $perecedero) < 0){ $diferencia = '-' .$diferencia;}

	require "../config/TablesNames.php";

	$sqlp2 =  "SELECT * FROM $secc WHERE `valor` = '$_POST[producto]' ";
	$qp2 = mysqli_query($db, $sqlp2);
	$rowp2 = mysqli_fetch_assoc($qp2);
	global $proname;
	$proname = $rowp2['nombre'];

	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2  class='BorderInf'>
						ESTOS SON LOS NUEVOS DATOS.
					</th>
				</tr>
				<tr>
					<td>WEEK</td>
					<td>".$_POST['nsemana']."</td>
				</tr>
				<tr>
					<td>PRODUCT REF</td>
					<td>".$_POST['producto']."</td>
				</tr>				
				<tr>
					<td>PRODUCT NAME</td>
					<td>".$proname."</td>
				</tr>				
				<tr>
					<td>UNIT ENTRADA</td>
					<td>".$kgin."</td>
				</tr>
				<tr>
					<td>UNIT € PSIVA</td>
					<td>".$psiva." €</td>
				</tr>
				<tr>
					<td>TIPO IVA
					</td>
					<td>".$_POST['iva']." %</td>
				</tr>
				<tr>
					<td>IVA €</td>
					<td>".$ivae." €</td>
				</tr>
				<tr>
					<td>UNIT € PVP</td>
					<td>".$pvp." €</td>
				</tr>
				<tr>
					<td>FECHA ENTRADA</td>
					<td>".$_POST['datekgin']."</td>
				</tr>
				<tr>
					<td>UNIT PERECEDEROS</td>
					<td>".$kgbad."</td>
				</tr>
				<tr>
					<td>FECHA PERECEDEROS</td>
					<td>".$_POST['datekgbad']."</td>
				</tr>
				<tr>
					<td>UNIT CAJA</td>
					<td>".$kgcash."</td>
				</tr>
				<tr>
					<td>CAJA TOT €</td>
					<td>".$pvptot." €
					</td>
				</tr>
				<tr>
					<td>DATE CASH</td>
					<td>".$date."</td>
				</tr>
				<tr>
					<td>STOCK</td>
					<td>".$diferencia."</td>
				</tr>
				<tr>
					<td>COMENTARIOS</td>
					<td width=200px>".$_POST['coment']."</td>
				</tr>
			</table>";	 


	require "../config/TablesNames.php";

	$sqlc = "UPDATE `$db_name`.$tablastock3 SET `nsemana` = '$_POST[nsemana]', `producto` = '$_POST[producto]', `proname` = '$proname', `psiva` = '$psiva', `iva` = '$_POST[iva]', `ivae` = '$ivae', `pvp` = '$pvp', `kgin` = '$kgin', `datekgin` = '$_POST[datekgin]', `kgbad` = '$kgbad', `datekgbad` = '$_POST[datekgbad]', `kgcash` = '$kgcash', `pvptot` = '$pvptot', `datecash` = '$date', `kgdifer` = '$diferencia', `coment` = '$_POST[coment]' WHERE $tablastock3.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ print( $tabla );
		} else { print("<font color='#FF0000'>
						* ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
			}
		
/////////////

	global $diferencia;
	global $pvp;

	require "../config/TablesNames.php";

	$sqlc2 = "UPDATE `$db_name`.$secc SET `psiva` = '$psiva', `iva` = '$_POST[iva]', `ivae` = '$ivae', `pvp` = '$pvp', `stock` = '$diferencia' WHERE $secc.`valor` = '$_POST[producto]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc2)){ print( "" );
			} else { print("<font color='#FF0000'>
						* DATOS NO VALIDOS: </font>".mysqli_error($db))."</br>";
				}

/////////////

	require "../config/TablesNames.php";

	$sqlc3 = "UPDATE `$db_name`.$tablafeedpro2 SET `psiva` = '$psiva', `iva` = '$_POST[iva]', `ivae` = '$ivae', `pvp` = '$pvp', `stock` = '$diferencia' WHERE $tablafeedpro2.`valor` = '$_POST[producto]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc3)){ print( "" );
		} else { print("<font color='#FF0000'>
						* DATOS NO VALIDOS: </font>".mysqli_error($db))."</br>";
					}

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
		
		$nc = strlen(trim($_POST['psiva']));
		$nc = $nc - 3;
		$pvpx = $_POST['psiva'];
		$pvp1 = substr($_POST['psiva'],0,$nc);
		$pvp2 = substr($_POST['psiva'],-2,2);

		$nkgin = strlen(trim($_POST['kgin']));
		$nkgin = $nkgin - 3;
		$kginx = $_POST['kgin'];
		$kgin1 = substr($_POST['kgin'],0,$nkgin);
		$kgin2 = substr($_POST['kgin'],-2,2);

		$nkgbad = strlen(trim($_POST['kgbad']));
		$nkgbad = $nkgbad - 3;
		$kgbadx = $_POST['kgbad'];
		$kgbad1 = substr($_POST['kgbad'],0,$nkgbad);
		$kgbad2 = substr($_POST['kgbad'],-2,2);

		$nkgcash = strlen(trim($_POST['kgcash']));
		$nkgcash = $nkgcash - 3;
		$kgcashx = $_POST['kgcash'];
		$kgcash1 = substr($_POST['kgcash'],0,$nkgcash);
		$kgcash2 = substr($_POST['kgcash'],-2,2);

	if($_POST['oculto2']){
		
			$ivaef = "&nbsp; + ".$_POST['ivae']." €.";
			
			$pvp = $_POST['pvp'];
			$pvptot = $_POST['pvptot'];
			
				$defaults = array ( 'seccion' => $_POST['seccion'],
									'id' => $_POST['id'],
									'nsemana' => $_POST['nsemana'],
									'producto' => $_POST['producto'],
								    'proname' => $_POST['proname'],
									'pvp1' => $pvp1,
									'pvp2' => $pvp2,
								   	'psiva' =>  $_POST['psiva'],
								   	'iva' =>  $_POST['iva'],
								   	'ivae' =>  $_POST['ivae'],
									'pvp' => $pvp,
									'pvptot' => $pvptot,
									'kgin1' => $kgin1,
									'kgin2' => $kgin2,
									'datekgin' => $_POST['datekgin'],
									'kgbad1' => $kgbad1,
									'kgbad2' => $kgbad2,
									'datekgbad' => $_POST['datekgbad'],
									'kgcash1' => $kgcash1,
									'kgcash2' => $kgcash2,
									'datecash' => $_POST['datecash'],
									'kgdifer' => $_POST['kgdifer'],
									'coment' => $_POST['coment'],
																		 );
								   											}
							
		elseif($_POST['oculto']){
						
				$kgin1 = $_POST['kgin1'];	
				$kgin2 = $_POST['kgin2'];
				global $kgin;	
				$kgin= $kgin1.".".$kgin2;
				
				$kgbad1 = $_POST['kgbad1'];	
				$kgbad2 = $_POST['kgbad2'];	
				global $kgbad;
				$kgbad = $kgbad1.".".$kgbad2;
				
				$kgcash1 = $_POST['kgcash1'];	
				$kgcash2 = $_POST['kgcash2'];
				global $kgcash;	
				$kgcash = $kgcash1.".".$kgcash2;
	
				$pvp1 = $_POST['pvp1'];	
				$pvp2 = $_POST['pvp2'];
				$psiva = $pvp1.".".$pvp2;
				
				$ivaop = $_POST['iva']; 
				$ivae = $psiva * ($ivaop / 100);
				$ivaef = "&nbsp; + ".$ivae." €.";
			
				$entrada = $kgin;
				$perecedero = $kgbad;
				$caja = $kgcash;
				
				global $pvp;
				$pvp = $psiva + $ivae;
				$pvptot = $caja * $pvp;
				
				global $diferencia;
				$diferencia = ($entrada - $perecedero) - $caja;

				$defaults = $_POST;
				$defaults['kgdifer'] = $diferencia;
				$defaults['pvptot'] = $pvptot;
	
															} 
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>** </font>".$errors [$a]."</br>");
			}
		}
		
	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	
	global $_sec;
	$_sec = $rowseccion['nombre'];

//////////////////////////
	
	$iva = array (	'' => 'IVA',
					'21' => '21 %',
					'10' => '10 %',
					'4' => '4 %',
									);

	$fechakgbad = date('Y-m-d');

	$datekgbad = array ('SIN FECHA' => 'NO INSERTAR FECHA',
						''.$fechakgbad.'' => 'INSERTAR FECHA'
															);														
/*
print("(Kg In ".$entrada." - Kg Bad ".$perecedero.") - Kg Cash ".$caja." = Total ".$diferencia);
*/
	if (($entrada - $perecedero) < 0){ $diferencia = '-' .$diferencia;}


/////////////////////////
	
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							MODIFICAR STOCK EN ".$rowseccion['nombre']."
					</th>
				</tr>
				
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						

			<tr>								
						<td>
				<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
						</td>
			</tr>

				<tr>
					<td>
						ID
					</td>
					<td>
				<input name='id' type='hidden' value='".$_POST['id']."' />".$_POST['id']."
					</td>
				</tr>

				<tr>
					<td>
						PRODUCTO:
					</td>
					<td>
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
		}

	} 

	print ("</select>
					</td>
				</tr>
				
				<tr>
					<td>						
						WEEK
					</td>
					<td>
	<input name='nsemana' type='hidden' value='".$_POST['nsemana']."' />".$_POST['nsemana']."
					</td>
				</tr>
									
				<tr>
					<td>						
						ENTRADA
					</td>
					<td>
						
	<input style='text-align:right' name='kgin1' type='number' size='2' maxlength='2' value='".$defaults['kgin1']."' />
	,
	<input name='kgin2' type='number' size='2' maxlength='2' value='".$defaults['kgin2']."' />
						
	</select>
					</td>
				</tr>
					
				<tr>
					<td>						
						UNIT PVP
					</td>
					<td>
	<input style='text-align:right' name='pvp1' type='number' size='5' maxlength='5' value='".$defaults['pvp1']."' />
	,
	<input name='pvp2' type='number' size='2' maxlength='2' value='".$defaults['pvp2']."' />
	 €
					</td>
				</tr>

				<tr>
					<td>						
						TIPO DE IVA
					</td>
					<td>
						<select name='iva'>");
						
				
				foreach($iva as $optioniva => $labeliva){
					
					print ("<option value='".$optioniva."' ");
					
					if($optioniva == $defaults['iva']){
															print ("selected = 'selected'");
																								}
													print ("> $labeliva </option>");
												}	
	
	print ("</select> ".$ivaef."
					
					</td>
				</tr>

				<tr>
					<td>
						€ PVP
					</td>
					<td>
		<input name='pvp' type='hidden' value='".$_POST['pvp']."' />".$pvp."
					</td>
				</tr>

				<tr>
					<td>
						FECHA ENTRADA
					</td>
					<td>
<input name='datekgin' type='hidden' value='".$_POST['datekgin']."' />".$_POST['datekgin']."
					</td>
				</tr>
								
				<tr>
					<td>						
						PERECEDEROS
					</td>
					<td>

	<input style='text-align:right' name='kgbad1' type='number' size='2' maxlength='2' value='".$defaults['kgbad1']."' />
	,
	<input name='kgbad2' type='number' size='2' maxlength='2' value='".$defaults['kgbad2']."' />
	 &nbsp; Unit.
	 
					</td>
				</tr>
	 ");

/////////////

if (($_POST['datekgbad'] == 'SIN FECHA') || ($_POST['datekgbad'] == 0)){
							
	print ("
				
				<tr>
					<td>
						FECHA PERECEDEROS
					</td>
					<td>
						<select name='datekgbad'>");
						
				
				foreach($datekgbad as $optiondatekgbad => $labeldatekgbad){
					
					print ("<option value='".$optiondatekgbad."' ");
					
					if($optiondatekgbad == $defaults['datekgbad']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldatekgbad </option>");
												}	
						
	print ("</select>
					</td>
				</tr>"
						);
								}
									else {
										
											print (	"<tr>
														<td>
															FECHA PERECEDEROS
														</td>
														<td>
<input name='datekgbad' type='hidden' value='".$_POST['datekgbad']."' />".$_POST['datekgbad']."
														</td>
													</tr>"
																	);
																		}
////////////////
				
	print ("				
				<tr>
					<td>						
						CAJA
					</td>
					<td>

	<input style='text-align:right' name='kgcash1' type='number' size='2' maxlength='2' value='".$defaults['kgcash1']."' />
	,
	<input name='kgcash2' type='number' size='2' maxlength='2' value='".$defaults['kgcash2']."' />
	 &nbsp; Unit.
	
					</td>
				</tr>

				<tr>
					<td>						
						TOT CASH €
					</td>
					<td>						
		<input name='pvptot' type='hidden' value='".$_POST['pvptot']."' />".$defaults['pvptot']."
					</td>
				</tr>
								
				<tr>
					<td>						
						DATE CASH
					</td>
					<td>
	<input name='datecash' type='hidden' value='".$_POST['datecash']."' />".$_POST['datecash']."
					</td>
				</tr>

				<tr>
					<td>
						STOCK
					</td>
					<td>"
						.$defaults['kgdifer'].
					"</td>
				</tr>

				<tr>
					<td>
						COMENTARIOS
					</td>
					<td>
					
	<textarea cols='35' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment'>".$defaults['coment']."</textarea>
	
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 200 characters            
				</div>

					</td>
				</tr>
				
				<tr height=40px>
					<td colspan='2' align='right'>
						<input type='submit' value='MODIFICAR' />
						<input type='hidden' name='oculto' value=1 />
						
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

function accion_modifica_02(){

	global $db;
	global $rowout;
	global $pvp;
	global $proname;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	
global $text;
$text = "- STOCK MODIFICAR 3 ".$ActionTime.". ".$secc.".\n\t ID: ".$_POST['id'].".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$proname.".\n\t €/PVP ".$_POST['pvp'].".\n\t UNIT IN:".$_POST['kgin'].".\n\t UNIT BAD:".$_POST['kgbad'].".\n\t UNIT CASH:".$_POST['kgcash'];

	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext =$text."\n";
	$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_modifica_01(){

	global $db;
	global $rowout;
	global $proname;
	global $_sec;
	$secc = $_sec;	

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
$text = "- STOCK MODIFICAR 2 ".$ActionTime.". ".$secc.".\n\t ID: ".$_POST['id'].".\n\t DATE IN:".$_POST['nsemana']."/".$_POST['datekgin'].".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$_POST['proname'].".\n\t €/PVP ".$_POST['pvp'].".\n\t UNIT IN:".$_POST['kgin'].".\n\t UNIT BAD:".$_POST['kgbad'].".\n\t UNIT CASH:".$_POST['kgcash'];

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