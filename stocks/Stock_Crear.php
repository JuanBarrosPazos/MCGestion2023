<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus') || ($_SESSION['Nivel'] == 'user')){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();
					
						if($_POST['oculto']){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
									
										} else {	process_form();
													cuadra_stock();
													accion_Stock_Crear();
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
	
	require "../config/TablesNames.php";

	$sqlx =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];

	$semana = date('W');

	$date = date('Y-m-d');

	global $fechakgbad;
	global $datekgbad;
	$datekgbad = array ('SIN FECHA' => 'NO INSERTAR FECHA',
						''.$fechakgbad.'' =>'INSERTARFECHA');

	$kgin1 = $_POST['kgin1'];	
	$kgin2 = $_POST['kgin2'];
	global $kgin;	
	$kgin = $kgin1.".".$kgin2;
	
	$kgbad1 = $_POST['kgbad1'];	
	$kgbad2 = $_POST['kgbad2'];	
	global $kgbad;
	$kgbad = $kgbad1.".".$kgbad2;
	
	$kgcash1 = $_POST['kgcash1'];	
	$kgcash2 = $_POST['kgcash2'];
	global $kgcash;	
	$kgcash = $kgcash1.".".$kgcash2;
	
	$entrada = $kgin;
	$perecedero = $kgbad;
	$caja = $kgcash;
	global $diferencia;

	$pvp1 = $_POST['pvp1'];	
	$pvp2 = $_POST['pvp2'];	
	$psiva = $pvp1.".".$pvp2;
	
	$ivaop = $_POST['iva'];
	$ivae = $psiva * ($ivaop / 100);
	$ivaef = "&nbsp; + ".$ivae." €.";
	
	global $pvp;
	$pvp = $psiva + $ivae;
	
	$pvptot = $caja * $pvp;

	$diferencia = ($entrada - $perecedero) - $caja;
	
	if (($entrada - $perecedero) < 0){ $diferencia = '-' .$diferencia;}
		
	require "../config/TablesNames.php";

	$sqlp2 =  "SELECT * FROM $secc WHERE `valor` = '$_POST[producto]' ";
	$qp2 = mysqli_query($db, $sqlp2);
	$rowp2 = mysqli_fetch_assoc($qp2);
	global $proname;
	$proname = $rowp2['nombre'];

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SE HA GRABADO EN ".$rowseccion['nombre']."
					</th>
				</tr>
												
				<tr>
					<td>						
						WEEK
					</td>
					<td>"
						.$semana.
					"</td>
				</tr>

				<tr>
					<td>
						PRODUCT REF
					</td>
					<td>"
						.$_POST['producto'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						PRODUCT NAME
					</td>
					<td>"
						.$proname.
					"</td>
				</tr>				
				
				<tr>
					<td>						
						UNIT ENTRADA
					</td>
					<td>"
						.$kgin.
					"</td>
				</tr>
				
				<tr>
					<td>						
						UNIT € PSIVA
					</td>
					<td>"
						.$psiva.
					" €
					</td>
				</tr>
				
				<tr>
					<td>						
						TIPO IVA
					</td>
					<td>"
						.$_POST['iva'].
						" %
					</td>
				</tr>
				
				<tr>
					<td>						
						IVA €
					</td>
					<td>"
						.$ivae.
					" €
					</td>
				</tr>
				
				<tr>
					<td>						
						UNIT € PVP
					</td>
					<td>"
						.$pvp.
					" €
					</td>
				</tr>
				
				<tr>
					<td>
						FECHA ENTRADA
					</td>
					<td>"
						.$date.
					"</td>
				</tr>
				
				<tr>
					<td>						
						UNIT PERECEDEROS
					</td>
					<td>"
						.$kgbad.
					"</td>
				</tr>
				
				<tr>
					<td>
						FECHA PERECEDEROS
					</td>
					<td>"
						.$_POST['datekgbad'].
					"</td>
				</tr>
				
				<tr>
				
					<td>						
						UNIT CAJA
					</td>
					<td>"
						.$kgcash.
					"</td>
				</tr>
				
				<tr>
					<td>						
						CAJA TOT €
					</td>
					<td>"
						.$pvptot.
					" €
					</td>
				</tr>
				
				<tr>
					<td>						
						DATE CASH
					</td>
					<td>"
						.$date.
					"</td>
				</tr>
				
				<tr>
					<td>
						COMENTARIOS.
					</td>
					<td width=200px>"
						.$_POST['coment'].
					"</td>
				</tr>
			</table>";	 
		
	require "../config/TablesNames.php";

	$sql = "INSERT INTO `$db_name`.$tablastock3 ( `nsemana`,`producto`, `proname`, `psiva`, `iva`, `ivae`, `pvp`, `kgin`, `datekgin`, `kgbad`, `datekgbad`, `kgcash`, `pvptot`, `datecash`, `kgdifer`, `coment`) VALUES ( '$semana', '$_POST[producto]', '$proname', '$psiva', '$_POST[iva]', '$ivae', '$pvp', '$kgin',  '$date',  '$kgbad', '$_POST[datekgbad]', '$kgcash', '$pvptot', '$date', '$diferencia', '$_POST[coment]')";
		
	if(mysqli_query($db, $sql)){
								print( $tabla );
				} else {
				print("	</br>
							<font color='#FF0000'>
								* ERROR: </font></br> ".mysqli_error($db))."
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

	if(mysqli_query($db, $sqlc3)){
									print( "" );
				} else {
				print("<font color='#FF0000'>
						* DATOS NO VALIDOS: </font>".mysqli_error($db))."</br>";
							}

} // FIN FUNCTION	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function cuadra_stock(){

	global $refpro;
	$refpro = $_POST['producto']; /* ref pro */

	require "../config/TablesNames.php";

	$cs1 = "SELECT * FROM $tablastock3 WHERE `producto` = '$refpro' AND `kgdifer` > 0 ";
	$qcs1 = mysqli_query($db, $cs1);
	$rowcs1 = mysqli_fetch_assoc($qcs1);
	
	if(mysqli_num_rows($qcs1) > 1){
	
/////////////////// RESTA AL STOCK LA NUEVA ENTRADA //////////

	$cuadrastock = $rowcs1['kgin'] - $rowcs1['kgdifer'];
	$cuadrastock1 = $rowcs1['kgdifer'] - $rowcs1['kgdifer'];
	$coment = $rowcs1['coment']."</br>* Status: ".$rowcs1['kgin']."-(".$rowcs1['kgbad']."+".$rowcs1['kgcash'].")=".$rowcs1['kgdifer']."</br> Descontadas ".$rowcs1['kgdifer']." Unidades del stock.";

	require "../config/TablesNames.php";

	$cs2 = "UPDATE `$db_name`.$tablastock3 SET `kgin` = '$cuadrastock', `kgdifer` = '$cuadrastock1', `coment` = '$coment' WHERE $tablastock3.`id` = '$rowcs1[id]' LIMIT 1 ";

	if(mysqli_query($db, $cs2)){	
global $texcs1;
$texcs1 = "\n\t Restadas ".$rowcs1['kgdifer']." Unid del stock ID: ".$rowcs1['id'].".";
					} else {
				print("	</br><font color='#FF0000'>* ERROR: </font> ".mysqli_error($db));
									}

/////////////// AÑADE AL STOCK LA DIFERENCIA ANTERIOR ////////////

	require "../config/TablesNames.php";

	$cs4 = "SELECT * FROM $tablastock WHERE `producto` = '$refpro' AND `kgdifer` > 0 ";
	$qcs4 = mysqli_query($db, $cs4);
	$rowcs4 = mysqli_fetch_assoc($qcs4);

	$cuadrastock2 = $rowcs4['kgin'] + $rowcs1['kgdifer'];
	$cuadrastock3 = $rowcs4['kgdifer'] + $rowcs1['kgdifer'];
	$coment2 = $_POST['coment']."</br>* Status: ".$rowcs4['kgin']."-(".$rowcs4['kgbad']."+".$rowcs4['kgcash'].")=".$rowcs4['kgdifer']."</br> Añadidas ".$rowcs1['kgdifer']." Unit de la entrada, ID: ".$rowcs1['id'];

	$cs3 = "UPDATE `$db_name`.$tablastock SET `kgin` = '$cuadrastock2', `kgdifer` = '$cuadrastock3', `coment` = '$coment2' WHERE $tablastock.`id` = '$rowcs4[id]' LIMIT 1 ";

	if(mysqli_query($db, $cs3)){
	global $texcs2;
	$texcs2 = "\n\t Sumadas  ".$rowcs1['kgdifer']." Unid del stock ID: ".$rowcs1['id']." en ID: ".$rowcs4['id'];
					} else {
				print("	</br><font color='#FF0000'>* ERROR: </font> ".mysqli_error($db));
								}
	global $textcs3;
	$textcs3 = $texcs1.$texcs2;
	
///////////// ACTUALIZO TABLA DE PRODUCTOS ///////

	global $pvp;

	require "../config/TablesNames.php";

	$sqlc2 = "UPDATE `$db_name`.$secc SET `psiva` = $rowcs4[psiva], `iva` = $rowcs4[iva], `ivae` = $rowcs4[ivae], `pvp` = '$pvp', `stock` = '$cuadrastock3' WHERE $secc.`valor` = '$_POST[producto]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc2)){ print( "" );
		} else { print("<font color='#FF0000'>
						* DATOS NO VALIDOS: </font>".mysqli_error($db))."</br>";
					}

///////////// ACTUALIZO TABLA FEEDBACK PRODUCTOS ///////

	require "../config/TablesNames.php";

	$sqlc3 = "UPDATE `$db_name`.$tablafeedpro2 SET `psiva` = $rowcs4[psiva], `iva` = $rowcs4[iva], `ivae` = $rowcs4[ivae], `pvp` = '$pvp', `stock` = '$cuadrastock3' WHERE $tablafeedpro2.`valor` = '$_POST[producto]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc3)){ print( "" );
		} else { print("<font color='#FF0000'>
						* DATOS NO VALIDOS: </font>".mysqli_error($db))."</br>";
					}
		} else {print(""); }
	
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function show_form($errors=[]){
	
	global $producto;
	global $campos2;

	if($_POST['oculto1']){
				$defaults = array (	'seccion' => $_POST['seccion'],
								   	'producto' => $producto,
								   	'proname' => $_POST['proname'],
								   	'campo2' => $campos2,
									'pvp1' => '',
									'pvp2' => '00',
								   	'psiva' => '',
								   	'iva' =>  '',
									'pvp' => '',
									'pvptot' => '',
									'kgin1' => '',
									'kgin2' => '00',
									'kgbad1' => '00',
									'kgbad2' => '00',
									'kgcash1' => '00',
									'kgcash2' => '00',
								   				);
						} 
		
			elseif($_POST['oculto']){
				$defaults = $_POST;
				} else {global $psiva;
						global $pvp;
						global $pvptot;
						$defaults = array ( 'seccion' => $_POST['seccion'],
											'producto' => $producto,
											'pvp1' => $_POST['pvp1'],
											'pvp2' => $_POST['pvp2'],
											'psiva' => $psiva,
											'iva' =>  $_POST['iva'],
											'pvp' => $pvp,
											'pvptot' => $pvptot,
											'kgin1' => $_POST['kgin1'],
											'kgin2' => $_POST['kgin2'],
											'kgbad1' => $_POST['kgbad1'],
											'kgbad2' => $_POST['kgbad2'],
											'datekgbad' => '',
											'kgcash1' => $_POST['kgcash1'],
											'kgcash2' => $_POST['kgcash2'],
											'kgdifer' => '',
											'coment' => '',
														);
															}
	
	if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>*</font>  ".$errors [$a]."</br>");
			}
		}
						
////////////////

	require "../config/TablesNames.php";
	$sqlx =  "SELECT * FROM $gst_secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

	global $_sec;
	$_sec = $rowseccion['nombre'];

////////////////

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						GRABAR SOCKS EN ".$rowseccion['nombre']."
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
	$sqlb =  "SELECT * FROM $gst_secciones ORDER BY `valor` ASC ";
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
				
	if ($_POST['oculto1'] || $_POST['oculto'] ) {
	if ($_POST['seccion'] == '') { 
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
												}	

//////////////////////////

	$fechakgbad = date('Y-m-d');

	$datekgbad = array ('SIN FECHA' => 'NO INSERTAR FECHA',
						''.$fechakgbad.'' => 'INSERTAR FECHA'
															);														
/*
	if (($entrada - $perecedero) < 0){ $diferencia = '-' .$diferencia;}
*/

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
	
	global $pvp;
	$pvp = $psiva + $ivae;
	
	$pvptot = $caja * $pvp;

	$iva = array (	'' => 'IVA',
					'21' => '21 %',
					'10' => '10 %',
					'4' => '4 %',
									);

	$entrada = $kgin;
	$perecedero = $kgbad;
	$caja = $kgcash;
	$diferencia = ($entrada - $perecedero) - $caja;

/////////////////////////
				
	if ($_POST['seccion'] != '') { 
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							DATOS NUEVO PRODUCTO STOCK
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
		<input name='nsemana' type='hidden' value='".$_POST['nsemana']."' />".$semana."
					</td>
				</tr>
									
				<tr>
					<td>						
						UNIT ENTRADA
					</td>
					<td>

	<input style='text-align:right' name='kgin1' type='number' size='2' maxlength='2' value='".$defaults['kgin1']."' />
	,
	<input name='kgin2' type='number' size='2' maxlength='2' value='".$defaults['kgin2']."' />
	
					</td>
				</tr>
					
				<tr>
					<td>						
						€ PVP SIN IVA
					</td>
					<td>
	<input style='text-align:right' name='pvp1' type='number' size='5' maxlength='5' value='".$defaults['pvp1']."' />
	,
	<input name='pvp2' type='number' size='2' maxlength='2' value='".$defaults['pvp2']."' />
	 &nbsp; €
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
	
	print ("</select>
					
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
		<input name='datekgin' type='hidden' value='".$_POST['datekgin']."' />".$date."
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
				</tr>
					
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
						DATE CASH
					</td>
					<td>
		<input name='datecash' type='hidden' value='".$_POST['datecash']."' />".$date."
					</td>
				</tr>

				<tr>
					<td>
						COMENTARIOS:
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
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
											<input type='submit' value='GRABAR DATOS' />
											<input type='hidden' name='oculto' value=1 />
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

function accion_Stock_Crear(){

	global $db;
	global $rowout;
	global $pvp;
	global $proname;
	global $textcs3;

	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'user'){ $dir = 'User';}
	
	$semana = date('W');
	$date = date('Y-m-d');
	
global $text;
$text = "- STOCK CREAR ".$ActionTime.". ".$secc.".\n\t SEMANA: ".$semana."/".$date.".\n\t Pro Ref: ".$_POST['producto'].".\n\t Pro Name: ".$proname.".\n\t UNIDADES: ".$_POST['kgin'].".\n\t €/PVP ".$pvp.".\n\t COMENT: ".$_POST['coment'];

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text.$textcs3."\n";
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