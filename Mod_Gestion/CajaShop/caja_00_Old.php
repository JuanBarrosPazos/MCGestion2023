<?php

session_start();

	global $rutaHeader;		$rutaHeader = "../";
	require $rutaHeader.'Inclu/Inclu_Header.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){
	master_index();
	require "../config/TablesNames.php";	
			
/*#1* ok*/	if(isset($_POST['init_compra'])){ init_compra();
											  show_form();
											  subtotal();
											  log_info();
/*#2* ok*/	}elseif(isset($_POST['oculto'])){ show_form();
											  process_form();
			}elseif(isset($_POST['selec_pro'])){		
					if($form_errors = validate_form()){
							show_form();
							process_form($form_errors);
							log_info();													
					}else{	show_form();
							selec_pro();
							log_info();													
							subtotal();	
								}
/*#3* ok*/	}elseif(isset($_POST['modif_pro'])){ show_form();
												 modif_pro();	
												 log_info();													
			}elseif(isset($_POST['modif_pro2'])){		
					if($form_errors = validate_form()){
							show_form();
							modif_pro($form_errors);
							log_info();													
					}else{	show_form();
							modif_pro2();	
							log_info();
							subtotal();
								}
/*#4* ok*/	}elseif(isset($_POST['elim_pro'])){ show_form();
												elim_pro();
										 		log_info();													
			}elseif(isset($_POST['elim_pro2'])){ show_form();
										  		 elim_pro2();
												 log_info();													
											$oper = $_SESSION['oper'];
											$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
											$qrc = mysqli_query($db, $rc);
											$count = mysqli_num_rows($qrc);
											if($count > 0){	subtotal();	}
/*#5* ok*/	}elseif(isset($_POST['subtotal'])){ show_form();
											$oper = $_SESSION['oper'];
											$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
											$qrc = mysqli_query($db, $rc);
											$count = mysqli_num_rows($qrc);
											if($count > 0){	subtotal();	}
										  		log_info();													
/*#6* ok*/	}elseif(isset($_POST['recup_compra'])){	show_form();
													recup_compra();
													log_info();													
			}elseif(isset($_POST['recup_compra2'])){ 
												$_SESSION['oper'] = $_POST['oper'];
												show_form();
												global $KeySubTotal;
												if($KeySubTotal==1){ }else{ subtotal(); }
												log_info();													
/*#7* ok*/	}elseif(isset($_POST['cancel_compra'])){ show_form();
													 cancel_compra();
												 	 log_info();													
			}elseif(isset($_POST['cancel_compra2'])){ show_form();
													  cancel_compra2();	
													  fcancel_1();
													  fcancel_2();
													  log_info();													
/*#8* ok*/	}elseif((isset($_POST['modif_client']))){ show_form();
													  show_formcl();	
													  subtotal();
													  log_info();
			}elseif(isset($_POST['selec_client'])){	show_form();
													show_formcl();	
													subtotal();
													log_info();
			}elseif(isset($_POST['todocl'])){ show_form();							
											  //show_formcl();
											  ver_todocl();
											  log_info();													
			}elseif(isset($_POST['show_formcl'])){
					if($form_errors = validate_formcl()){
							show_form();
							show_formcl($form_errors);
							subtotal();
							log_info();													
					}else{	show_form();
							show_formcl();
							selec_client();
							subtotal();
							log_info();													
								}
			}elseif(isset($_POST['selec_client2'])){ selec_client2();
													 show_form();
													 global $KeySubTotal;
												if($KeySubTotal==1){ }else{ subtotal(); }
													 log_info();													
/*#9* ok*/	}elseif(isset($_POST['pago'])){	show_form();
											pago2();	
			}elseif(isset($_POST['pago2'])){				
					if($form_errors = validate_pago2()){
							show_form();
							pago2($form_errors);
							log_info();													
					}else{	show_form();
							pago3();
							log_info();													
								}
			}elseif(isset($_POST['pago3'])){ show_form();
											 pago3();	
											 log_info();													
			}else {	show_form(); }

		}else{ require "../Inclu/AccesoDenegado.php"; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_pago2(){

	$errors = array();

	if (strlen($_POST['efectivo']) != 0){
	if ((strlen($_POST['paypal']) != 0) || (strlen($_POST['visa']) != 0) || (strlen($_POST['mastercar']) != 0)){
				$errors [] = " SELECCIONE SOLO UNA FORMA DE PAGO";}
		}

	elseif (strlen($_POST['paypal']) != 0){
	if ((strlen($_POST['efectivo']) != 0) || (strlen($_POST['visa']) != 0) || (strlen($_POST['mastercar']) != 0)){
				$errors [] = " SELECCIONE SOLO UNA FORMA DE PAGO";}
		}

	elseif (strlen($_POST['visa']) != 0){
	if ((strlen($_POST['efectivo']) != 0) || (strlen($_POST['paypal']) != 0) || (strlen($_POST['mastercar']) != 0)){
				$errors [] = " SELECCIONE SOLO UNA FORMA DE PAGO";}
		}

	elseif (strlen($_POST['mastercar']) != 0){
	if ((strlen($_POST['efectivo']) != 0) || (strlen($_POST['paypal']) != 0) || (strlen($_POST['visa']) != 0)){
				$errors [] = " SELECCIONE SOLO UNA FORMA DE PAGO";}
		}
	
	else{$errors [] = " SELECCIONE UNA FORMA DE PAGO";}
				
		return $errors;

} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function pago2($errors=[]){
	global $db;				global $db_name;
	require "../config/TablesNames.php";

	global $defaults;		global $LogText;	global $oper;
	if(isset($_POST['pago2'])){
			$defaults = array ( 'efectivo' => $_POST['efectivo'],
								'paypal' => $_POST['paypal'],
								'visa' => $_POST['visa'],
								'mastercar' => $_POST['mastercar']);
	}else{	$defaults = array ( 'efectivo' => $_POST['efectivo'],
								'paypal' => $_POST['paypal'],
								'visa' => $_POST['visa'],
								'mastercar' => $_POST['mastercar']);
			$oper = $_SESSION['oper'];
			$LogText = $LogText."* PAGO 01 =>\t* SESSION OPER ".$oper."\t\n";
				}
	
			global $KeyErrors;	$KeyErrors = 1;
			require 'TableValidateErrors.php';
			
			$oper = $_SESSION['oper'];	

			$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
			$qrc = mysqli_query($db, $rc);
	
			$rowrc = mysqli_fetch_assoc($qrc);
			global $proname;		$proname =strtolower($rowrc['proname']);
			global $ClientRef;		$ClientRef = $rowrc['refclient'];

	/////////////////////	
	/* PARA SUMAR IVA */
	global $sumaivae;		global $verivae;
	if(!$qrc){ print("* ERROR SQL SUMAR IVA L.195 ".mysqli_error($db).".</br>");
	}else{
		$qivae = mysqli_query($db, $rc);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivae = 0.00;
			for($i=0; $i<$rowivae; $i++){ $verivae = mysqli_fetch_array($qivae);
						$sumaivae = $sumaivae + $verivae['ivae'];
					}
		$sumaivae = floatval($sumaivae);	$sumaivae = number_format($sumaivae,2,".","");
		}
	/* FIN PARA SUMAR IVA */
	/////////////////////////

	/////////////////////	
	/* PARA SUMAR PVPTOT */
	global $sumapvptot;		global $verpvptot;
	if(!$qrc){print("* ERROR SQL SUMAR PVPTOT L.212 ".mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $rc);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0.00;
		  	for($i=0; $i<$rowpvptot; $i++){$verpvptot = mysqli_fetch_array($qpvptot);
						$sumapvptot = $sumapvptot + $verpvptot['pvptot'];
					}
		$sumapvptot = floatval($sumapvptot);	$sumapvptot = number_format($sumapvptot,2,".","");
		}
	/* FIN PARA SUMAR PVPTOT */
	/////////////////////////
							
		global $ClientRef;
		if($ClientRef == ''){ 
			print("<table align='center'>
					<tr>
						<td class='BorderInf'>
					<font color='#990000'>HA DE SELECCIONAR UN CLIENTE</font>
						</td>
					</tr>
					<tr>
						<td align='center'>
				<form name='selec_client' method='post' action='$_SERVER[PHP_SELF]'>
					<input type='submit' value='SELECIONAR CLIENTE' />
					<input type='hidden' name='selec_client' value=1 />
				</form></td></tr></table>");
		}else{
			print("<table align='center'>										
					<tr>
						<td align='center' colspan='12' class='BorderInf'>SUS DATOS</td>
					</tr>
					<tr>
						<th class='BorderInfDch'>ID</th>
						<th class='BorderInfDch'>Nivel</th>
						<th class='BorderInfDch'>Referencia</th>
						<th class='BorderInfDch'>Nombre</th>
						<th class='BorderInfDch'>Apellidos</th>
						<th class='BorderInfDch'></th>
						<th class='BorderInf'>DNI</th>
						<th class='BorderInfDch'></th>
						<th class='BorderInfDch'>EMAIL</th>
						<th class='BorderInfDch'>DIRECCION</th>
						<th class='BorderInfDch'>TLF 1</th>
						<th class='BorderInf'>TLF 2</th>
					</tr>");				
				
			$oper = $_SESSION['oper'];

			$rdcl =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
				$qdcl = mysqli_query($db, $rdcl);
				$rowdcl = mysqli_fetch_assoc($qdcl);
				$ClientRef = $rowdcl['refclient'];

			$ncl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ";
				$qncl = mysqli_query($db, $ncl);
				$rowncl = mysqli_fetch_assoc($qncl);
				$_SESSION['nclient'] = $rowncl['Nivel'];
				if(mysqli_num_rows($qncl) == 0){
					$ncl =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ";
						$qncl = mysqli_query($db, $ncl);
						$rowncl = mysqli_fetch_assoc($qncl);
						$_SESSION['nclient'] = $rowncl['Nivel'];
				}else{ }
			
			global $height;
			if($ClientRef != ''){
				if(($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){$height = 'height=530px';
				}else{ $height = 'height=250px';}
	
			if($_SESSION['nclient'] == 'cliente'){
				$dtcl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
				$qdtcl = mysqli_query($db, $dtcl);
				$height = 'height=530px';
			}elseif(($_SESSION['nclient'] == 'admin') || ($_SESSION['nclient'] == 'plus') || ($_SESSION['nclient'] == 'user') || ($_SESSION['nclient'] == 'caja')){
				$dtcl =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
				$qdtcl = mysqli_query($db, $dtcl);}

			while($rowdtcl = mysqli_fetch_assoc($qdtcl)){
				if(($rowdtcl['Nivel'] == 'admin') || ($rowdtcl['Nivel'] == 'plus') || ($rowdtcl['Nivel'] == 'user') || ($rowdtcl['Nivel'] == 'caja')){
						$ruta = '../Admin/img_admin/';
				}elseif($rowdtcl['Nivel'] == 'cliente'){
						$ruta = '../AdminClientesShop/img_cliente/';
				}

				print("<tr align='center'>
						<td class='BorderInfDch'>
					<input name='id' type='hidden' value='".$rowdtcl['id']."' />".$rowdtcl['id']."
						</td>
						<td class='BorderInfDch'>
					<input name='Nivel' type='hidden' value='".$rowdtcl['Nivel']."' />".$rowdtcl['Nivel']."
						</td>
						<td class='BorderInfDch'>
					<input name='ref' type='hidden' value='".$rowdtcl['ref']."' />".$rowdtcl['ref']."
						</td>
						<td class='BorderInfDch'>
					<input name='Nombre' type='hidden' value='".$rowdtcl['Nombre']."' />".$rowdtcl['Nombre']."
						</td>
						<td class='BorderInfDch'>
					<input name='Apellidos' type='hidden' value='".$rowdtcl['Apellidos']."' />".$rowdtcl['Apellidos']."
						</td>
						<td class='BorderInfDch'>
					<input name='myimg' type='hidden' value='".$rowdtcl['myimg']."' />
							<img src='".$ruta."".$rowdtcl['myimg']."' height='40px' width='30px' />
						</td>
						<td class='BorderInf'>
					<input name='dni' type='hidden' value='".$rowdtcl['dni']."' />".$rowdtcl['dni']."
						</td>
						<td class='BorderInfDch'>
					<input name='ldni' type='hidden' value='".$rowdtcl['ldni']."' />".$rowdtcl['ldni']."
						</td>
						<td class='BorderInfDch'>
					<input name='Email' type='hidden' value='".$rowdtcl['Email']."' />".$rowdtcl['Email']."
						</td>
						<td class='BorderInfDch'>
					<input name='Direccion' type='hidden' value='".$rowdtcl['Direccion']."' />".$rowdtcl['Direccion']."
						</td>
						<td class='BorderInfDch'>
					<input name='Tlf1' type='hidden' value='".$rowdtcl['Tlf1']."' />".$rowdtcl['Tlf1']."
						</td>
						<td class='BorderInf'>
					<input name='Tlf2' type='hidden' value='".$rowdtcl['Tlf2']."' />".$rowdtcl['Tlf2']."
						</td>
					</tr>");			
				} // FIN WHILE 
			} // FIN if($ClientRef != '')
		print("</form></table>");
		} // FIN ELSE

	$oper = $_SESSION['oper'];
	$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
	$qrc = mysqli_query($db, $rc);
		
	global $campo;		global $datos;
	if(!$qrc){ print("* ERROR SQL L.356 ".mysqli_error($db).".</br>");
	}else{
		$qcp = mysqli_query($db, $rc);
		$rowcp = mysqli_num_rows($qcp);
		for($i=0; $i<$rowcp; $i++){ $campo = mysqli_fetch_array($qcp);
			$titut ="\n |  SECCION   |    REF PROD    |     PRO NAME     | CARRO";
			$datos =$datos."\n | ".$campo['vseccion']." | ".$campo['producto']." | ".$campo['proname']." | ".$campo['kgcash'];
		} // FIN FOR
	}
			
	global $oper;	$oper = $_SESSION['oper'];
	if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';
	}else{ $LogText = $LogText.$_POST['producto']; }
		
	$LogText = $LogText."* PAGO 2 =>\t* SESSION OPER: ".$oper."\t* REF CAJA: ".$campo['refcaja']."\t* REF CLIENT: ".$campo['refclient']."\t* NAME CLIENT: ".$campo['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot."".$titut.$datos;
						
	global $ClientRef;
	print("	<form name='pago2'  action='$_SERVER[PHP_SELF]' method='POST'>");
		if($ClientRef != ''){ 
		print("<table align='center'>
				<tr>
					<td align='center' colspan='4' class='BorderInf'>
						<font color='#990000'>FORMA DE PAGO</font>
					</td>
				</tr>
				<tr>
					<td align='center'>
					<input type='checkbox' id='efectivo' name='efectivo' value='efectivo' ");
					//if($defaults['efectivo'] == 'efectivo') {print(" checked=\"checked\"");}
		print("</td>
				<td>EFECTIVO</td>
				<td align='center'>
					<input type='checkbox' id='paypal' name='paypal' value='paypal' ");
					//if($defaults['paypal'] == 'paypal') {print(" checked=\"checked\"");}
		print("</td>
				<td>PAY PAL</td>
			</tr>
			<tr>
				<td align='center'>
					<input type='checkbox' id='visa' name='visa' value='visa' ");
					//if($defaults['visa'] == 'visa') {print(" checked=\"checked\"");}
		print("</td>
				<td> VISA</td>
				<td align='center'>
					<input type='checkbox' id='mastercar' name='mastercar' value='mastercar' ");
					//if($defaults['mastercar'] == 'mastercar') {print(" checked=\"checked\"");}
		print("</td>
				<td>MASTERCAR</td>
			</tr>
			</table>");
				}
		print("<table align='center'>
				<tr style='font-size:14px'>
					<th colspan=10 class='BorderInf'>
						SUS DATOS, FORMA DE PAGO & SUBTOTAL COMPRA ".$_SESSION['oper']." 
					</th>
				</tr>
				<tr style='font-size:10px'>
					<th class='BorderInfDch'>REF CAJA</th>			
					<th class='BorderInfDch'>REF CLIENT</th>
					<th class='BorderInfDch'>OPER SESION</th>			
					<th class='BorderInfDch'>FECHA</th>				
					<th class='BorderInfDch'>SECCION</th>										
					<th class='BorderInfDch'>PRODUCTO</th>
					<th class='BorderInfDch'>UNI</th>
					<th class='BorderInfDch'>IVA€</th>
					<th class='BorderInfDch'>PVP</th>
					<th class='BorderInfDch'>SUBTOT</th>
				</tr>");
									
		while($rowrc = mysqli_fetch_assoc($qrc)){
			$proname =strtolower($rowrc['proname']);
			global $ClientRef;		$ClientRef = $rowrc['refclient'];
			print (	"<tr align='center'>
				<input name='id' type='hidden' value='".$rowrc['id']."' />
				<input name='ini' type='hidden' value='".$rowrc['ini']."' />
				<input name='cname' type='hidden' value='".$rowrc['cname']."' />
				<input name='clname' type='hidden' value='".$rowrc['clname']."' />
				<input name='psiva' type='hidden' value='".$rowrc['psiva']."' />
				<input name='iva' type='hidden' value='".$rowrc['iva']."' />
				<input name='nsemana' type='hidden' value='".$rowrc['nsemana']."' />
				<input name='proname' type='hidden' value='".$rowrc['proname']."' />
					<td class='BorderInfDch' align='left'>
				<input name='refcaja' type='hidden' value='".$rowrc['refcaja']."' />".$rowrc['refcaja']."
					</td>
					<td class='BorderInfDch' align='left'>
				<input name='refclient' type='hidden' value='".$rowrc['refclient']."' />".$rowrc['refclient']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='oper' type='hidden' value='".$rowrc['oper']."' />".$rowrc['oper']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='datecash' type='hidden' value='".$rowrc['datecash']."' />".$rowrc['datecash']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='vseccion' type='hidden' value='".$rowrc['vseccion']."' />".$rowrc['vseccion']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='producto' type='hidden' value='".$rowrc['producto']."' />".$proname."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='kgcash' type='hidden' value='".$rowrc['kgcash']."' />".$rowrc['kgcash']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='ivae' type='hidden' value='".$rowrc['ivae']."' />".$rowrc['ivae']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='pvp' type='hidden' value='".$rowrc['pvp']."' />".$rowrc['pvp']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='pvptot' type='hidden' value='".$rowrc['pvptot']."' />".$rowrc['pvptot']."
						</td>
					</tr>");
		} // FIN WHILE
			print("<tr>
					<td colspan='10' class='BorderInf'></td>
				</tr>
					<td colspan='2' class='BorderInf'></td>
					<td colspan='2' class='BorderInf' align='right'>TOTAL IVA</td>
					<td colspan='2' class='BorderInfDch' align='left'>".$sumaivae." €</td>
					<td colspan='2' class='BorderInf' align='right'>TOTAL €</td>
					<td class='BorderInfDch' align='right'>".$sumapvptot."</td>
					<td class='BorderInf'>");
		if($ClientRef != ''){ print("
			<div align='center' >
				<form name='pago' method='post' action='$_SERVER[PHP_SELF]'>
					<input type='submit' value='PAGAR & SALIR' />
					<input type='hidden' name='pago2' value=1 />
				</form>	
			</div>");
		}
			print("</td></table>");
} // FIN pago2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function pago3(){
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	$oper = $_SESSION['oper'];
	$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
	$qrc = mysqli_query($db, $rc);

	/////////////////////	
	/* PARA SUMAR IVA */
	global $sumaivae;		global $verivae;
	if(!$qrc){ print("* ERROR SQL SUMAR IVA L.510 ".mysqli_error($db).".</br>");
	}else{
		$qivae = mysqli_query($db, $rc);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivae = 0;
			for($i=0; $i<$rowivae; $i++){ $verivae = mysqli_fetch_array($qivae);
						$sumaivae = $sumaivae + ($verivae['ivae'] * $verivae['kgcash']);
							}
			$sumaivae = floatval($sumaivae);
			$sumaivae = number_format($sumaivae,2,".","");
	}
	/* FIN PARA SUMAR IVA */
	/////////////////////////

	/////////////////////	
	/* PARA SUMAR PVPTOT */
	global $sumapvptot;		global $verpvptot;
	if(!$qrc){print("* ERROR SQL SUMAR PVPTOT L.527 ".mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $rc);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0;
			for($i=0; $i<$rowpvptot; $i++){ $verpvptot = mysqli_fetch_array($qpvptot);
						$sumapvptot = $sumapvptot + $verpvptot['pvptot'];
							}
			$sumapvptot = floatval($sumapvptot);
			$sumapvptot = number_format($sumapvptot,2,".","");
	}
	/* FIN PARA SUMAR PVPTOT */
	/////////////////////////

	if(!$qrc){ print("* ERROR SQL L.504 ".mysqli_error($db).".</br>");
	}else{
		$qcp = mysqli_query($db, $rc);
		$rowcp = mysqli_num_rows($qcp);
			for($i=0; $i<$rowcp; $i++){ $campo = mysqli_fetch_array($qcp);
				global $campo;
				$titut ="\n |  SECCION   |    REF PROD    |     PRO NAME     | CARRO";
				global $datos;
				$datos = $datos."\n | ".$campo['vseccion']." | ".$campo['producto']." | ".$campo['proname']." | ".$campo['kgcash'];
			} // FIN FOR
	}
		
		global $LogText;	global $oper;	$oper = $_SESSION['oper'];
		if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';
		}else{ $LogText = $LogText.$_POST['producto'];}

		$LogText = $LogText."	* PAGO COMPLET =>\t* SESSION OPER: ".$oper."\t* REF CAJA: ".$campo['refcaja']."\t* REF CLIENT: ".$campo['refclient']."\t* NAME CLIENT: ".$campo['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot." ".$titut.$datos;
						
	global $pago;
	$pago = strtoupper($_POST['efectivo']).strtoupper($_POST['paypal']).strtoupper($_POST['visa']).strtoupper($_POST['mastercar']);
		
		print("<table align='center'>
				<tr>
					<td align='center' class='BorderInf'>
						<font color='#990000'>FORMA DE PAGO</font>
					</td>
					<td>".$pago."</td>
				</tr>");

		print ("<table align='center'>
					<tr style='font-size:14px'>
						<th colspan=9 class='BorderInf'>
					SUS DATOS. FORMA DE PAGO & SUBTOTAL COMPRA ".$_SESSION['oper']."
						</th>
						<th>
				<div style='float:right'>
					<form action='' method='get'> 
					<input type='button' name='imprimir' value='IMPRIMIR' onClick='window.print();'/>
					</form>
				</div>	
						</th>
					</tr>
					<tr style='font-size:10px'>
						<th class='BorderInfDch'>REF CAJA</th>			
						<th class='BorderInfDch'>REF CLIENT</th>
						<th class='BorderInfDch'>OPER SESION</th>		
						<th class='BorderInfDch'>FECHA</th>				
						<th class='BorderInfDch'>SECCION</th>										
						<th class='BorderInfDch'>PRODUCTO</th>
						<th class='BorderInfDch'>UNI</th>
						<th class='BorderInfDch'>IVA€</th>
						<th class='BorderInfDch'>PVP</th>
						<th class='BorderInfDch'>SUBTOT</th>
					</tr>");
									
	while($rowrc = mysqli_fetch_assoc($qrc)){
		$proname =strtolower($rowrc['proname']);
		global $ClientRef;	$ClientRef = $rowrc['refclient'];
	
		print (	"<tr align='center'>
			<input name='id' type='hidden' value='".$rowrc['id']."' />
			<input name='ini' type='hidden' value='".$rowrc['ini']."' />
			<input name='cname' type='hidden' value='".$rowrc['cname']."' />
			<input name='clname' type='hidden' value='".$rowrc['clname']."' />
			<input name='psiva' type='hidden' value='".$rowrc['psiva']."' />
			<input name='iva' type='hidden' value='".$rowrc['iva']."' />
			<input name='nsemana' type='hidden' value='".$rowrc['nsemana']."' />
			<input name='proname' type='hidden' value='".$rowrc['proname']."' />
					<td class='BorderInfDch' align='left'>
			<input name='refcaja' type='hidden' value='".$rowrc['refcaja']."' />".$rowrc['refcaja']."
					</td>
					<td class='BorderInfDch' align='left'>
			<input name='refclient' type='hidden' value='".$rowrc['refclient']."' />".$rowrc['refclient']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='oper' type='hidden' value='".$rowrc['oper']."' />".$rowrc['oper']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='datecash' type='hidden' value='".$rowrc['datecash']."' />".$rowrc['datecash']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='vseccion' type='hidden' value='".$rowrc['vseccion']."' />".$rowrc['vseccion']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='producto' type='hidden' value='".$rowrc['producto']."' />".$proname."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='kgcash' type='hidden' value='".$rowrc['kgcash']."' />".$rowrc['kgcash']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='ivae' type='hidden' value='".$rowrc['ivae']."' />".$rowrc['ivae']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='pvp' type='hidden' value='".$rowrc['pvp']."' />".$rowrc['pvp']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='pvptot' type='hidden' value='".$rowrc['pvptot']."' />".$rowrc['pvptot']."
					</td>
				</tr> ");
		} // FIN WHILE
						
		print("<tr>
					<td colspan='10' class='BorderInf'></td>
				</tr>
				<tr>
					<td colspan='3' class='BorderInf'></td>
					<td colspan='2' class='BorderInf' align='right'>TOTAL IVA</td>
					<td colspan='2' class='BorderInfDch' align='left'>".$sumaivae." €	</td>
					<td colspan='2' class='BorderInf' align='right'>TOTAL €	</td>
					<td class='BorderInfDch' align='right'>".$sumapvptot."</td>
				</tr>
			</table>");

	print("	<table align='center'>										
				<tr>
					<td align='center' colspan='12' class='BorderInf'>SUS DATOS</td>
				</tr>
				<tr>
					<th class='BorderInfDch'>ID</th>
					<th class='BorderInfDch'>NIVEL</th>
					<th class='BorderInfDch'>REFERENCIA</th>
					<th class='BorderInfDch'>NOMBRE</th>
					<th class='BorderInfDch'>APELLIDOS</th>
					<th class='BorderInfDch'></th>
					<th class='BorderInf'>DNI</th>
					<th class='BorderInfDch'></th>
					<th class='BorderInfDch'>EMAIL</th>
					<th class='BorderInfDch'>DIRECCION</th>
					<th class='BorderInfDch'>TLF 1</th>
					<th class='BorderInf'>TLF 2</th>
				</tr>");				

	$oper = $_SESSION['oper'];
	$rdcl =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
		$qdcl = mysqli_query($db, $rdcl);
		$rowdcl = mysqli_fetch_assoc($qdcl);
		$ClientRef = $rowdcl['refclient'];
		// print("* ".$rowdcl['refclient']);
	
	$ncl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ";
		$qncl = mysqli_query($db, $ncl);
		$rowncl = mysqli_fetch_assoc($qncl);
		$_SESSION['nclient'] = $rowncl['Nivel'];
		// print(" ".$_SESSION['nclient']);

	if(mysqli_num_rows($qncl) == 0){
		$ncl =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ";
			$qncl = mysqli_query($db, $ncl);
			$rowncl = mysqli_fetch_assoc($qncl);
			$_SESSION['nclient'] = $rowncl['Nivel'];
			// print(" ".$_SESSION['nclient']);
	}else{ }

	global $height;
	if($ClientRef != ''){
		if(($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $height = 'height=530px';
		}else{ $height = 'height=250px'; }
	
		if($_SESSION['nclient'] == 'cliente'){
			$dtcl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
			$qdtcl = mysqli_query($db, $dtcl);
			$height = 'height=530px';
		}elseif(($_SESSION['nclient'] == 'admin') || ($_SESSION['nclient'] == 'plus') || ($_SESSION['nclient'] == 'user') || ($_SESSION['nclient'] == 'caja')){
			$dtcl =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
			$qdtcl = mysqli_query($db, $dtcl);}
			while($rowdtcl = mysqli_fetch_assoc($qdtcl)){
				if (($rowdtcl['Nivel'] == 'admin') || ($rowdtcl['Nivel'] == 'plus') || ($rowdtcl['Nivel'] == 'user') || ($rowdtcl['Nivel'] == 'caja')){ $ruta = '../Admin/img_admin/'; }
				if ($rowdtcl['Nivel'] == 'cliente'){$ruta = '../AdminClientesShop/img_cliente/';}
				print("<tr align='center'>
						<td class='BorderInfDch'>
					<input name='id' type='hidden' value='".$rowdtcl['id']."' />".$rowdtcl['id']."
						</td>
						<td class='BorderInfDch'>
					<input name='Nivel' type='hidden' value='".$rowdtcl['Nivel']."' />".$rowdtcl['Nivel']."
						</td>
						<td class='BorderInfDch'>
					<input name='ref' type='hidden' value='".$rowdtcl['ref']."' />".$rowdtcl['ref']."
						</td>
						<td class='BorderInfDch'>
					<input name='Nombre' type='hidden' value='".$rowdtcl['Nombre']."' />".$rowdtcl['Nombre']."
						</td>
						<td class='BorderInfDch'>
					<input name='Apellidos' type='hidden' value='".$rowdtcl['Apellidos']."' />".$rowdtcl['Apellidos']."
						</td>
						<td class='BorderInfDch'>
					<input name='myimg' type='hidden' value='".$rowdtcl['myimg']."' />
							<img src='".$ruta."".$rowdtcl['myimg']."' height='40px' width='30px' />
						</td>
						<td class='BorderInf'>
					<input name='dni' type='hidden' value='".$rowdtcl['dni']."' />".$rowdtcl['dni']."
						</td>
						<td class='BorderInfDch'>
					<input name='ldni' type='hidden' value='".$rowdtcl['ldni']."' />".$rowdtcl['ldni']."
						</td>
						<td class='BorderInfDch'>
					<input name='Email' type='hidden' value='".$rowdtcl['Email']."' />".$rowdtcl['Email']."
						</td>
						<td class='BorderInfDch'>
					<input name='Direccion' type='hidden' value='".$rowdtcl['Direccion']."' />".$rowdtcl['Direccion']."
						</td>
						<td class='BorderInfDch'>
					<input name='Tlf1' type='hidden' value='".$rowdtcl['Tlf1']."' />".$rowdtcl['Tlf1']."
						</td>
						<td class='BorderInf'>
					<input name='Tlf2' type='hidden' value='".$rowdtcl['Tlf2']."' />".$rowdtcl['Tlf2']."
						</td>
					</tr>");			
				} // FIN WHILE
			} // FIN IF
		print("</form></table>");
						
	global $pago;
	$pago = strtoupper($_POST['efectivo']).strtoupper($_POST['paypal']).strtoupper($_POST['visa']).strtoupper($_POST['mastercar']);

	global $semana;		$semana = date('W');	
	global $date;		$date = date('Y-m-d');
	global $ATime;		$ATime = date('H:i:s');
	global $datecash;	$datecash = $date."/".$ATime;

	$oper = $_SESSION['oper'];
	$vnt =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper'";
	$qvnt = mysqli_query($db, $vnt);
	$rowcvnt = mysqli_num_rows($qvnt);
	
	for($i=0; $i<$rowcvnt; $i++){
		$rowvnt = mysqli_fetch_assoc($qvnt);
		$vnt = "INSERT INTO `$db_name`.$modvn (`ini`, `cname`, `refcaja`, `clname`, `refclient`, `oper`, `nsemana`, `datecash`, `vseccion`, `producto`, `proname`, `kgcash`, `psiva`, `iva`, `ivae`, `pvp`, `pvptot`, `pago` ) VALUES ('$rowvnt[ini]', '$rowvnt[cname]', '$rowvnt[refcaja]', '$rowvnt[clname]', '$rowvnt[refclient]',  '$rowvnt[oper]', '$rowvnt[nsemana]', '$datecash', '$rowvnt[vseccion]', '$rowvnt[producto]', '$rowvnt[proname]', '$rowvnt[kgcash]', '$rowvnt[psiva]', '$rowvnt[iva]', '$rowvnt[ivae]', '$rowvnt[pvp]', '$rowvnt[pvptot]', '$pago' )";
		if(mysqli_query($db, $vnt)){
		}else{print("* ERROR SQL L.793 ".mysqli_error($db)."<br>");}
	} /* FIN DEL FOR */

	$cc2 =  "DELETE FROM `$db_name`.$CajaShop WHERE `oper` = '$oper' ";
	if(mysqli_query($db, $cc2)){ print("* COMPRA PAGADA.");
	}else{ print("* ERROR SQL L.803 ".mysqli_error($db)."<br>");}	

} // FIN pago3()
										
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_formcl($errors=[]){
	// MUESTRA EL FORMULARIO DE SELECCION DE CLIENTE PARA UNA COMPRA
	global $db;		global $db_name;
	require "../config/TablesNames.php";
	
	global $k;
	if(isset($_POST['modif_client'])){ $_SESSION['KeyCreaCliente'] = 1; }else{ $_SESSION['KeyCreaCliente'] = 0; }
	echo "** KeyCreaCliente = ".$_SESSION['KeyCreaCliente']."<br>";
	/* SE PASAN LOS VALORES POR DEFECTO Y SE DEVUELVEN LOS QUE HA ESCRITO EL USUARIO */
	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }
	
	global $ordenar;	global $defaults;
	if((isset($_POST['selec_client']))||(isset($_POST['init_compra']))||(isset($_POST['recup_compra']))||(isset($_POST['recup_compra2']))){ 
			$defaults = array ('Nombre' => '',
								'barra01' => '','barra02' => '',
								'sala01' => '','sala02' => '',
								'terraza01' => '','terraza02' => '',
								'Orden' => '',
								'cnivela' => '','cnivel' => '',);
	}elseif(isset($_POST['show_formcl'])){
			$defaults = array ('Nombre' => $_POST['Nombre'],
								'barra01' => $_POST['barra01'],'barra02' => $_POST['barra02'],
								'sala01' => $_POST['sala01'],'sala02' => $_POST['sala02'],
								'terraza01' => $_POST['terraza01'],'terraza02' => $_POST['terraza02'],
								'Orden' =>  '',
								'cnivela' => @$_POST['cnivela'],'cnivel' => '');
	}elseif(isset($_POST['todocl'])){ 
			$defaults = array ('Nombre' => '',
								'barra01' => '','barra02' => '',
								'sala01' => '','sala02' => '',
								'terraza01' => '','terraza02' => '',
								'Orden' =>  $orden,
								'cnivela' => '','cnivel' => @$_POST['cnivel']);
	}else{	$defaults = array ('Nombre' => '',
								'barra01' => '','barra02' => '',
								'sala01' => '','sala02' => '',
								'terraza01' => '','terraza02' => '',
								'Orden' => $orden,
								'cnivela' => '','cnivel' => '',);
				}

	$ordenar = array('`id` ASC' => 'ID ASC','`id` DESC' => 'ID DSC',
					 '`Nombre` ASC' => 'Nombre ASC','`Nombre` DESC' => 'Nombre DSC',
					 '`Apellidos` ASC' => 'Apellido ASC','`Apellido` DESC' => 'Apellido DSC',);

	require 'TableValidateErrors.php';
	
	print("<table align='center' style='border:0px;margin-top:4px;'>
				<tr>
					<th colspan=3 class='BorderSup'>
						SELECCIONE CLIENTE PARA COMPRA: ".$_SESSION['oper']."
					</th>
				</tr>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td align='right'>
					<input type='checkbox' name='cnivela' value='yes' ");
					if($defaults['cnivela'] == 'yes'){ print(" checked='checked'"); }
			print(" />
					</td>
					<td colspan='2'>BUSCAR EN ADMINISTRADORES</td>
				</tr>
				<tr>
					<td style='text-align:left; vertical-align: top !important;'>
						<input type='submit' value='CONSULTA CLIENTES' />
						<input type='hidden' name='show_formcl' value=1 />
					</td>
					<td colspan=2>
						<div style='float:left'>
						<select name='barra01' style='min-width: 142px; margin: 0.1em !important;'>
							<option value=''>BARRA 01</option>");
			// CONSTRUYE EL SELECT DE CLIENTES BARRA 01
			$SqlB01 =  "SELECT * FROM $ClientesShop WHERE `Nombre` LIKE 'barra01%' ORDER BY `ref` ASC ";
				$qSqlB01 = mysqli_query($db, $SqlB01);
					if(!$qSqlB01){ print("* ERROR SQL L.903 ".mysqli_error($db)."</br>");
					}else{ while($rowsb1 = mysqli_fetch_assoc($qSqlB01)){
									print ("<option value='".$rowsb1['ref']."' ");
									if($rowsb1['ref'] == $defaults['barra01']){
														print ("selected = 'selected'");
												}
							print (">".ucfirst($rowsb1['Nombre'])." ".ucfirst($rowsb1['Apellidos'])."</option>");
								}
							} 
					print ("</select></div>
						<div style='float:left'>
						<select name='barra02' style='min-width: 142px; margin: 0.1em !important;'>
							<option value=''>BARRA 02</option>");
			// CONSTRUYE EL SELECT DE CLIENTES BARRA 02
			$SqlB02 =  "SELECT * FROM $ClientesShop WHERE `Nombre` LIKE 'barra02%' ORDER BY `ref` ASC ";
				$qSqlB02 = mysqli_query($db, $SqlB02);
					if(!$qSqlB02){ print("* ERROR SQL L.919 ".mysqli_error($db)."</br>");
					}else{ while($rowsb2 = mysqli_fetch_assoc($qSqlB02)){
									print ("<option value='".$rowsb2['ref']."' ");
									if($rowsb2['ref'] == $defaults['barra02']){
														print ("selected = 'selected'");
											}
							print (">".ucfirst($rowsb2['Nombre'])." ".ucfirst($rowsb2['Apellidos'])."</option>");
								}
							} 
					print ("</select></div>
								<div style='clear:both'></div>
						<div style='float:left'>
						<select name='sala01' style='min-width: 142px; margin: 0.1em !important;'>
							<option value=''>SALA 01</option>");
			// CONSTRUYE EL SELECT DE CLIENTES SALA 01
			$SqlS01 =  "SELECT * FROM $ClientesShop WHERE `Nombre` LIKE 'sala01%' ORDER BY `ref` ASC ";
				$qSqlS01 = mysqli_query($db, $SqlS01);
					if(!$qSqlS01){ print("* ERROR SQL L.935 ".mysqli_error($db)."</br>");
					}else{ while($rowss1 = mysqli_fetch_assoc($qSqlS01)){
									print ("<option value='".$rowss1['ref']."' ");
									if($rowss1['ref'] == $defaults['sala01']){
														print ("selected = 'selected'");
											}
							print (">".ucfirst($rowss1['Nombre'])." ".ucfirst($rowss1['Apellidos'])."</option>");
								}
							} 
					print ("</select></div>
						<div style='float:left'>
						<select name='sala02' style='min-width: 142px; margin: 0.1em !important;'>
							<option value=''>SALA 02</option>");
			// CONSTRUYE EL SELECT DE CLIENTES SALA 02
			$SqlS02 =  "SELECT * FROM $ClientesShop WHERE `Nombre` LIKE 'sala02%' ORDER BY `ref` ASC ";
				$qSqlS02 = mysqli_query($db, $SqlS02);
					if(!$qSqlS02){ print("* ERROR SQL L.951 ".mysqli_error($db)."</br>");
					}else{ while($rowss2 = mysqli_fetch_assoc($qSqlS02)){
									print ("<option value='".$rowss2['ref']."' ");
									if($rowss2['ref'] == $defaults['sala02']){
														print ("selected = 'selected'");
											}
							print (">".ucfirst($rowss2['Nombre'])." ".ucfirst($rowss2['Apellidos'])."</option>");
								}
							} 
					print ("</select></div>
								<div style='clear:both'></div>
						<div style='float:left'>
						<select name='terraza01' style='min-width: 142px; margin: 0.1em !important;'>
							<option value=''>TERRAZA 01</option>");
			// CONSTRUYE EL SELECT DE CLIENTES TERRAZA 01
			$SqlT01 =  "SELECT * FROM $ClientesShop WHERE `Nombre` LIKE 'terraza01%' ORDER BY `ref` ASC ";
				$qSqlT01 = mysqli_query($db, $SqlT01);
					if(!$qSqlT01){ print("* ERROR SQL L.968 ".mysqli_error($db)."</br>");
					}else{ while($rowst1 = mysqli_fetch_assoc($qSqlT01)){
									print ("<option value='".$rowst1['ref']."' ");
									if($rowst1['ref'] == $defaults['terraza01']){
														print ("selected = 'selected'");
											}
							print (">".ucfirst($rowst1['Nombre'])." ".ucfirst($rowst1['Apellidos'])."</option>");
								}
							} 
					print ("</select></div>
						<div style='float:left'>
						<select name='terraza02' style='min-width: 142px; margin: 0.1em !important;'>
							<option value=''>TERRAZA 02</option>");
			// CONSTRUYE EL SELECT DE CLIENTES TERRAZA 02
			$SqlT02 =  "SELECT * FROM $ClientesShop WHERE `Nombre` LIKE 'terraza02%' ORDER BY `ref` ASC ";
				$qSqlT02 = mysqli_query($db, $SqlT02);
					if(!$qSqlT02){ print("* ERROR SQL L.983 ".mysqli_error($db)."</br>");
					}else{ while($rowst2 = mysqli_fetch_assoc($qSqlT02)){
									print ("<option value='".$rowst2['ref']."' ");
									if($rowst2['ref'] == $defaults['terraza02']){
														print ("selected = 'selected'");
											}
							print (">".ucfirst($rowst2['Nombre'])." ".ucfirst($rowst2['Apellidos'])."</option>");
								}
							} 
					print ("</select></div>
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' class='BorderInf'>NOMBRE</td>
					<td colspan=2 class='BorderInf'>
			<input type='text' name='Nombre' size=20 maxlength=10 value='".$defaults['Nombre']."' />
				</form>
					</td>
				</tr>
				<tr>
			<!-- *** INICIO OCULTAR TODOS LOS CLIENTES
				<tr>
					<td align='center'>
				<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
						<input type='submit' value='TODOS LOS CLIENTES' />
						<input type='hidden' name='todocl' value=1 />
					</td>
					<td>ORDENAR POR</td>
					<td>
						<select name='Orden'>");
			// CONSTRUYE EL SELECT DE ORDENAR DATOS
			/*
			foreach($ordenar as $option => $label){
				print ("<option value='".$option."' ");
					if($option == $defaults['Orden']){ print ("selected = 'selected'"); }
							print ("> $label </option>");
				}
			*/
	print("</select>
					</td>
				</tr>
				<tr>
					<td align='right'>
					<input type='checkbox' name='cnivel' value='yes' ");
					//if($defaults['cnivel'] == 'yes') {print(" checked=\"checked\"");}
			print(" />
					</td>
					<td colspan='2'>BUSCAR EN ADMINISTRADORES</td>
				</form></tr> 
			*** FIN OCULTAR VER TODOS LOS CLIENTES --> 
				</table>"); 

	// DATOS LOG			
	global $LogText;
	$LogText = $LogText."* CONSLUTAR CLIENTE =>\t* SESSION OPER ".$_SESSION['oper']."\t\t\t";
	switch (true) {
		case (isset($_POST['todocl'])): $LogText = $LogText.'TODOS LOS CLIENTES';
			break;
		case ($defaults['Nombre'] != ''): $LogText = $LogText."* REF CLIENTE ".$defaults['Nombre']."\t\t\t";
			break;
		case ($defaults['barra01'] == ''): $LogText = $LogText."* SECCION ".$defaults['barra01']."\t\t\t";
			break;
		case ($defaults['barra02'] == ''): $LogText = $LogText."* SECCION ".$defaults['barra02']."\t\t\t";
			break;
		case ($defaults['sala01'] == ''): $LogText = $LogText."* SECCION ".$defaults['sala01']."\t\t\t";
			break;
		case ($defaults['sala02'] == ''): $LogText = $LogText."* SECCION ".$defaults['sala02']."\t\t\t";
			break;
		case ($defaults['terraza01'] == ''): $LogText = $LogText."* SECCION ".$defaults['terraza01']."\t\t\t";
			break;
		case ($defaults['terraza02'] == ''): $LogText = $LogText."* SECCION ".$defaults['terraza02']."\t\t\t";
			break;
		default: $LogText = $LogText."";
			break;
	}
	
} // FIN function show_formcl

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_formcl(){
		// VALIDA EL FORMULARIO DE show_formcl($errors=[])
		global $db;		global $db_name;
		require '../config/TablesNames.php';

		global $CountInput; $CountInput = 0;		global $SqlText; $SqlText = "";		global $SqlRefClient;
		if($_POST['barra01'] != ''){ $CountInput = $CountInput + 1;	$SqlRefClient = $_POST['barra01'];
									 $SqlText = " WHERE `refclient` = '$SqlRefClient' "; }else{ }
		if($_POST['barra02'] != ''){ $CountInput = $CountInput + 1;	$SqlRefClient = $_POST['barra02'];
									 $SqlText = " WHERE `refclient` = '$SqlRefClient' "; }else{ }
		if($_POST['sala01'] != ''){ $CountInput = $CountInput + 1;	$SqlRefClient = $_POST['sala01'];
									$SqlText = " WHERE `refclient` = '$SqlRefClient' "; }else{ }
		if($_POST['sala02'] != ''){ $CountInput = $CountInput + 1;	$SqlRefClient = $_POST['sala02'];
									$SqlText = " WHERE `refclient` = '$SqlRefClient' "; }else{ }
		if($_POST['terraza01'] != ''){ $CountInput = $CountInput + 1;	$SqlRefClient = $_POST['terraza01'];
									   $SqlText = " WHERE `refclient` = '$SqlRefClient' "; }else{ }
		if($_POST['terraza02'] != ''){ $$CountInput = $CountInput + 1;	$SqlRefClient = $_POST['terraza02'];
									   $SqlText = " WHERE `refclient` = '$SqlRefClient' "; }else{ }
		global $CountCajaShop;
		if($CountInput<1){ $SqlCajaShop = "";
		}else{
			$SqlCajaShop = "SELECT * FROM $CajaShop $SqlText ";
			echo "<br><br><br>** ".$SqlCajaShop."<br>";
				$QrCajaShop = mysqli_query($db, $SqlCajaShop);
				$RowCajaShop = mysqli_fetch_array($QrCajaShop);
				$CountCajaShop = mysqli_num_rows($QrCajaShop);
			echo "** \$_SESSION['KeyCreaCliente'] = ".$_SESSION['KeyCreaCliente']." & \$CountCajaShop = ".$CountCajaShop."<br>";
		}
		
		$errors = array();

		if((strlen(trim($_POST['Nombre'])) == 0)&&($_POST['barra01'] == '')&&($_POST['barra02'] == '')&&($_POST['sala01'] == '')&&($_POST['sala02'] == '')&&($_POST['terraza01'] == '')&&($_POST['terraza02'] == '')){
			$errors [] = " UNO DE LOS CAMPOS ES OBLIGATORIO";
		}elseif($CountInput > 1){
			$errors [] = " SÓLO UNA ZONA DEL LOCAL";
		}elseif(($CountCajaShop >= 1)&&($_SESSION['KeyCreaCliente']<1)){
			$errors [] = " YA EXISTE UNA CUENTA ABIERTA PARA ESTE CLIENTE";
			$errors [] = " CLIENTE ".ucfirst($SqlRefClient)." CUENTA ".$RowCajaShop['oper'];
		}

		return $errors;

	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function selec_client(){
	// PROCESA EL FORMULARIO DE function show_formcl($errors=[])
	// SELECCIONA UN CLIENTE EN LA TABLA CLIENTES O ADMIN Y MUESTRA LA TABLA
	global $db;			global $db_name;
	require "../config/TablesNames.php";
	
	global $orden;
	if(!isset($_POST['Orden'])){ $orden = "`id` ASC"; }else{ $orden = $_POST['Orden']; }

	global $ZonLocValue;	global $CountZonLoc;	$CountZonLoc = 1;
	switch (true) {
		case (strlen(trim($_POST['barra01']))>0): $ZonLocValue = $_POST['barra01'];
			break;
		case (strlen(trim($_POST['barra02']))>0): $ZonLocValue = $_POST['barra02'];
			break;
		case (strlen(trim($_POST['sala01']))>0): $ZonLocValue = $_POST['sala01'];
			break;
		case (strlen(trim($_POST['sala02']))>0): $ZonLocValue = $_POST['sala02']; 
			break;
		case (strlen(trim($_POST['terraza01']))>0): $ZonLocValue = $_POST['terraza01'];
			break;
		case (strlen(trim($_POST['terraza02']))>0): $ZonLocValue = $_POST['terraza02'];
			break;
		default: $ZonLocValue = ''; $CountZonLoc = 0;
			break;
	}

	global $CountNomPost;	$CountNomPost = trim(str_replace(' ', '', $_POST['Nombre']));
							$CountNomPost = strlen(trim($CountNomPost));
	global $NomSql;	global $ZonLocSql;	global $OperSql;	global $LogText;

	if ($CountZonLoc < 1){ $ZonLocSql = "";	$LogText = $LogText.'';
	}else{ 	$ZonLocSql = " `ref` LIKE '%".$ZonLocValue."%' "; 
			$LogText = $LogText."* ZONA DEL LOCAL ".strtoupper($ZonLocValue)."\n\t\t\t\t\t\t";
		}
	
	if($CountNomPost < 1){ $NomSql = "";	$OperSql = "";	$LogText = $LogText.'';	
	}else{ 	$NomSql = "(`Nombre` LIKE '%".$_POST['Nombre']."%' OR `Apellidos` LIKE '%".$_POST['Nombre']."%') "; 
			$LogText = $LogText."* NOMBRE ".$_POST['Nombre']."\n\t\t\t\t\t\t";
		}
	//echo "** ".$ZonLocValue."<br>";
	// ASIGNA UNA CONSULTA SQL
	global $a;
	switch (true) {
		case (($CountNomPost < 1)&&($CountZonLoc < 1)): $a = "";
			break;
		case (($CountNomPost > 0)&&($CountZonLoc < 1)): $a = "WHERE $NomSql";
			break;
		case (($CountNomPost > 0)&&($CountZonLoc > 0)): $a = "WHERE ($NomSql $OperSql OR $ZonLocSql)";
														$OperSql = " OR "; 
			break;
		case (($CountNomPost < 1)&&($CountZonLoc > 0)): $a = "WHERE $ZonLocSql";
			break;
		default: $a = "";
			break;
	}

	if(!isset($_POST['cnivela'])){
		$sqlb =  "SELECT * FROM $ClientesShop $a ORDER BY `Nombre` ASC  ";
			echo "* L.1049 NO ADMIN: ".$sqlb."<br>";
		$LogText = $LogText."* CONSULTA CLIENTE TABLA CLIENTES =>\t* SESSION OPER ".$_SESSION['oper']."\n\t\t\t\t\t\t";
	}elseif(strlen($_POST['cnivela']) != 0){
		$sqlb =  "SELECT * FROM $Admin $a ORDER BY `Nombre` ASC ";
			echo "* 1054 SI ADMIN: ".$sqlb."<br>";
		$LogText = $LogText."* CONSULTA CLIENTE TABLA ADMIN =>\t* SESSION OPER ".$_SESSION['oper']."\n\t\t\t\t\t\t";
	} // FIN ELSE

		$qb = mysqli_query($db, $sqlb);
	if(!$qb){ print("* ERROR SQL L.1050/1054 ".mysqli_error($db)."</br>");
	}else{	if(mysqli_num_rows($qb)== 0){
				print("<table align='center' style=\"border:0px\">
							<tr>
								<td align='center'><font color='#FF0000'>NO HAY DATOS</font></td>
							</tr>
						</table>");
		}else{ require 'TablaSelectCliente.php'; } // FIN ELSE

			} // FIN ELSE QUERY
	} // FIN function selec_cliente()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function selec_client2(){
	// PROCESA EL FORMULARIO DE function selec_client() Y SELECCIONA AL CLIENTE
	global $db;		global $db_name;	
	require "../config/TablesNames.php";

	global $ruta;
	if (($_POST['Nivel'] == 'admin') || ($_POST['Nivel'] == 'plus') || ($_POST['Nivel'] == 'user') || ($_POST['Nivel'] == 'caja')){ $ruta = '../Admin/img_admin/'; }
	if ($_POST['Nivel'] == 'cliente'){ $ruta = '../AdminClientesShop/img_cliente/'; }

	$_SESSION['nclient'] = $_POST['Nivel'];
	global $tabla;
	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=15 class='BorderInf'>HA SELECCIONADO</th>
				<tr>
					<th class='BorderInfDch'>ID</th>
					<th class='BorderInfDch'>REFERENCIA</th>
					<th class='BorderInfDch'>NIVEL</th>
					<th class='BorderInfDch'>NOMBRE</th>
					<th class='BorderInfDch'>APELLIDO</th>
					<th class='BorderInfDch'></th>
				</tr>
				<tr align='center'>
					<td class='BorderInfDch'>".$_POST['id']."</td>
					<td class='BorderInfDch'>".ucfirst($_POST['ref'])."</td>
					<td class='BorderInfDch'>".ucfirst($_POST['Nivel'])."</td>
					<td class='BorderInfDch'>".ucfirst($_POST['Nombre'])."</td>
					<td class='BorderInfDch'>".ucfirst($_POST['Apellidos'])."</td>
					<td class='BorderInfDch'>
						<img src='".$ruta."".$_POST['myimg']."' height='40px' width='30px' />
					</td>
				</tr>
			</table>";
		
		global $oper;	$oper = $_SESSION['oper'];
	$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' LIMIT 1 ";
		$qrc = mysqli_query($db, $rc);
		$rowrc = mysqli_fetch_assoc($qrc);

	$clname = $_POST['Nombre']." ".$_POST['Apellidos'];	
			
		global $LogText;	global $Comentarios;
		global $DateTime;	$DateTime =" Time: ".date('y.m.d')." / ".date('H.i.s')."<br>";
	if($rowrc['oper'] == $oper){
		$sql = "UPDATE `$db_name`.$CajaShop SET `refclient` = '$_POST[ref]', `clname` = '$clname' WHERE `oper` = '$oper' ";
		if(mysqli_query($db, $sql)){
			if($rowrc['refclient']==""){
				$Comentarios = $rowrc['coment']."* Init Ref Cliente: ".ucfirst($_POST['ref']). $DateTime;
			}elseif($rowrc['refclient']!=$_POST['ref']){ 
				$Comentarios = $rowrc['coment']."* Modif. Ref Cliente: ".ucfirst($rowrc['refclient'])." x ".ucfirst($_POST['ref']).$DateTime;
			}else{ $Comentarios = $rowrc['coment']; }
			$sql2 = "UPDATE `$db_name`.$CajaShop SET `coment` = '$Comentarios' WHERE `oper` = '$oper' AND `ini` = 1 LIMIT 1 ";
			if(mysqli_query($db, $sql2)){ }else{ print("* ERROR SQL L.1172 ".mysqli_error($db)."</br>"); }

			print($tabla);

			// DATOS LOG
			$LogText = $LogText."* SELECCIONADO CLIENTE =>\t* SESSION OPER ".$oper."\n\t\t\t\t\t\t";
			switch (true) {
				case (isset($_POST['refclient'])): 
					$LogText = $LogText."* REF CLIENTE ".$_POST['refclient']."\n\t\t\t\t\t\t";
				case (isset($_POST['Nivel'])):
					$LogText = $LogText."* NIVEL ".$_POST['Nivel']."\n\t\t\t\t\t\t";
				case (isset($_POST['Nombre'])):
					$LogText = $LogText."* NOMBRE ".$_POST['Nombre']."\n\t\t\t\t\t\t";
				case (isset($_POST['Apellidos'])):
					$LogText = $LogText."* APELLIDOS ".$_POST['Apellidos']."\n\t\t\t\t\t\t";
					break;
				default: $LogText = $LogText.'';
					break;
			}
		}else{ print("* ERROR SQL L.1185 ".mysqli_error($db)."</br>"); }
	} // FIN IF
		
} // FIN function selec_cliente2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todocl(){
	// MUESTRA TODOS LOS CLIENTES DE LA TABLA CLIENTES O ADMIN.
	// ESTÁ ANULADA EN function show_formcl($errors=[])
	global $db;		global $db_name;	
	require "../config/TablesNames.php";
	$orden = $_POST['Orden'];
	global $doc;
	if(isset($_POST['doc'])){ $doc = $_POST['doc']; }else{ $doc = ''; }
		
		global $LogText;	
	if(!isset($_POST['cnivel'])){
		$sqlb =  "SELECT * FROM $ClientesShop ORDER BY $orden ";
			$qb = mysqli_query($db, $sqlb);
			$LogText = $LogText."* CONSLUTAR TODO TABLA CLIENTES =>\t* SESSION OPER ".$_SESSION['oper']."\n";
	}elseif(isset($_POST['cnivel'])){
		$sqlb =  "SELECT * FROM $Admin ORDER BY $orden ";
			$qb = mysqli_query($db, $sqlb);
			$LogText = $LogText."* CONSLUTAR TODO TABLA ADMIN =>\t* SESSION OPER ".$_SESSION['oper']."\n";
	}else{ }
	
	if(!$qb){ print("* ERROR SQL L.1048/1054 ".mysqli_error($db)."</br>");
	}else{ if(mysqli_num_rows($qb)== 0){
			print ("<table align='center'>
					<tr>
						<td><font color='#FF0000'>NO HAY DATOS</font></td>
					</tr>
				</table>.");
		}else{ require 'TablaSelectCliente.php'; } // FIN ELSE

		} // FIN ELSE
	} // FIN function ver_todocl()
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){

	$errors = array();

		global $kgcash;		global $kgin;
		if($_POST['kgcash1'] > $_POST['stock1']){
			$errors [] = "UNIT CAJA: SIN SUFICIENTE STOCK";
		}else{ }

		if($_POST['kgcash1'] == $_POST['stock1']){
			$errors [] = "UNIT CAJA: SIN SUFICIENTE STOCK";
		}else{ }

		if(strlen(trim($_POST['kgcash1'])) == 0){
			$errors [] = "UNIT CAJA: CAMPO OBLIGATORIO";
		}elseif(!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgcash1'])){
			$errors [] = "UNIT CAJA: CARACTERES NO VALIDOS";
		}elseif(!preg_match('/^[0-9]+$/',$_POST['kgcash1'])){
			$errors [] = "UNIT CAJA: >SOLO NUMEROS";
		}elseif($kgcash > $kgin){
			$errors [] = "MAS DE CAJA QUE DE ENTRADA";
		}else{ }
			
		if(strlen(trim($_POST['kgcash2'])) == 0){
			$errors [] = "DEC CAJA CAMPO OBLIGATORIO";
		}elseif(!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['kgcash2'])){
			$errors [] = "DEC CAJA CARACTERES NO VALIDOS";
		}elseif(!preg_match('/^[0-9]+$/',$_POST['kgcash2'])){
			$errors [] = "DEC CAJA SOLO NUMEROS";
		}else{ }
			
		return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function init_compra(){
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	$refcaja = $_SESSION['ref'];
	$refcj2 = substr($refcaja,2,2);
	$oper = $refcj2.date('ymd').date('His');
	$_SESSION['oper'] = $oper;
	
	global $semana;		$semana = date('W');	
	global $date;		$date = date('Y-m-d');
	global $ATime;		$ATime = date('H:i:s');
	global $datecash;	$datecash = $date."/".$ATime;
	
	$ic2 =  "SELECT * FROM $CajaShop WHERE `kgcash` = '0.00'";
		$qic2 = mysqli_query($db, $ic2);
		$rowic2 = mysqli_fetch_assoc($qic2);
	global $LogText;
	if(mysqli_num_rows($qic2) >= 1){
		$ic3 =  "DELETE FROM $CajaShop WHERE `kgcash` = '0.00' AND `refcaja` = '$refcaja' ";
		if(mysqli_query($db, $ic3)){ }else{ print("* ERROR SQL L.1308 ".mysqli_error($db)."<br>"); }
		$LogText = $LogText."\n\t* CANCEL COMPRA AUTO Kg 0,00. SESSION OPER: ".$rowic2['oper']."\t* CAJA REF ".$rowic2['refcaja']."\t* CAJA NAME ".$rowic2['cname']."\t* CAJA DATE W.".$rowic2['nsemana']." / D.".$rowic2['datecash']."\n";
	}else{ }

	global $ini;	$ini = 1;
	global $DateTime;	$DateTime =" Time: ".date('y.m.d')."/".date('H.i.s')."<br>";
	$CajaShopName = $_SESSION['Nombre']." ".$_SESSION['Apellidos'];
	$Comentarios = "* Init Caja: ".$CajaShopName." / ".ucfirst($refcaja).$DateTime;
	$ic = "INSERT INTO `$db_name`.$CajaShop (`ini`,`cname`, `refcaja`, `clname`, `refclient`, `oper`, `nsemana`, `datecash`, `vseccion`, `producto`, `proname`, `kgcash`, `psiva`, `iva`, `ivae`, `pvp`, `pvptot`, `pago`, `coment`) VALUES ('$ini', '$CajaShopName', '$refcaja', '', '', '$oper', '$semana', '$datecash', '', '', '', 0.00, 0.00, 0, 0.00, 0.00, 0.00, '', '$Comentarios')";
			
	if(mysqli_query($db, $ic)){
		$LogText = $LogText."\t* INIT COMPRA NEW. SESSION OPER: ".$oper."\t* CAJA REF ".$refcaja."\t* CAJA NAME ".$CajaShopName."\t* CAJA DATE W.".$semana." / D.".$datecash."\n";
	}else{ print("* ERROR SQL L.1236 ".mysqli_error($db)."<br>"); }

} // FIN function init_compra()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function cancel_compra(){
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	$oper = $_SESSION['oper'];		
	$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
	$qrc = mysqli_query($db, $rc);

	/////////////////////	
	/* PARA SUMAR IVA */
	global $sumaivae;
	if(!$qrc){print("* ERROR SQL SUMAR IVA L.1259 ".mysqli_error($db).".</br>");
	}else{
		$qivae = mysqli_query($db, $rc);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivae = 0;
				for($i=0; $i<$rowivae; $i++){ $verivae = mysqli_fetch_array($qivae);
							$sumaivae = $sumaivae + $verivae['ivae'];
								}
				$sumaivae = floatval($sumaivae);		$sumaivae = number_format($sumaivae,2,".","");
			}
	/* FIN PARA SUMAR IVA */
	/////////////////////////

	/////////////////////	
	/* PARA SUMAR PVPTOT */
	global $sumapvptot;
	if(!$qrc){print("* ERROR SQL SUMAR PVPTOT L.1276 ".mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $rc);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0;
				for($i=0; $i<$rowpvptot; $i++){ $verpvptot = mysqli_fetch_array($qpvptot);
							$sumapvptot = $sumapvptot + $verpvptot['pvptot'];
								}
				$sumapvptot = floatval($sumapvptot);		$sumapvptot = number_format($sumapvptot,2,".","");
			}
	/* FIN PARA SUMAR PVPTOT */
	/////////////////////////
							
	print("<table align='center'>
			<tr style='font-size:14px'>
				<th colspan=12 class='BorderInf'>
					SUBTOTAL COMPRA ".$_SESSION['oper']." 
				</th>
			</tr>
			<tr style='font-size:10px'>
				<th class='BorderInfDch'>REF CAJA</th>				
				<th class='BorderInfDch'>REF CLIENT</th>
				<th class='BorderInfDch'>OPER SESION</th>					
				<th class='BorderInfDch'>FECHA</th>				
				<th class='BorderInfDch'>SECCION</th>										
				<th class='BorderInfDch'>PRODUCTO</th>
				<th class='BorderInfDch'>CARRO</th>
				<th class='BorderInfDch'>PVP</th>
				<th class='BorderInfDch'>IVA€</th>
				<th class='BorderInfDch'>SUBT</th>
				<th class='BorderInf'></th>
			</tr>");

	$oper = $_SESSION['oper']; 	global $txt;
	global $LogText;		$LogText = $LogText."* CANCEL COMPRA 1 =>\t".$txt."\n";

	while($rowrc = mysqli_fetch_assoc($qrc)){
		$proname = strtolower($rowrc['proname']);
		print("<tr align='center'>
					<td class='BorderInfDch' align='left'>".$rowrc['refcaja']."</td>
					<td class='BorderInfDch' align='left'>".$rowrc['refclient']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['oper']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['datecash']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['vseccion']."</td>
					<td class='BorderInfDch' align='right'>".$proname."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['kgcash']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['pvp']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['ivae']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['pvptot']."</td>
					<td align='right'>");

		if($rowrc['ini'] == '1'){
				print("<div style='float:left;margin-right:6px'>
						<form name='cancel_compra2'  action='$_SERVER[PHP_SELF]' method='POST'>
							<input name='id' type='hidden' value='".$rowrc['id']."' />
							<input name='cname' type='hidden' value='".$rowrc['cname']."' />
							<input name='proname' type='hidden' value='".$rowrc['proname']."' />
							<input name='psiva' type='hidden' value='".$rowrc['psiva']."' />
							<input name='iva' type='hidden' value='".$rowrc['iva']."' />
							<input name='refcaja' type='hidden' value='".$rowrc['refcaja']."' />
							<input name='refclient' type='hidden' value='".$rowrc['refclient']."' />
							<input name='oper' type='hidden' value='".$rowrc['oper']."' />
							<input name='nsemana' type='hidden' value='".$rowrc['nsemana']."' />
							<input name='datecash' type='hidden' value='".$rowrc['datecash']."' />
							<input name='vseccion' type='hidden' value='".$rowrc['vseccion']."' />
							<input name='producto' type='hidden' value='".$rowrc['producto']."' />
							<input name='kgcash' type='hidden' value='".$rowrc['kgcash']."' />
							<input name='pvp' type='hidden' value='".$rowrc['pvp']."' />
							<input name='ivae' type='hidden' value='".$rowrc['ivae']."' />
							<input name='pvptot' type='hidden' value='".$rowrc['pvptot']."' />
								<input type='submit' value='ELIMINAR COMPRA' />
								<input type='hidden' name='cancel_compra2' value=1 />
						</form></div>");
		}else{ }
			print("</td></tr>");
	} // FIN WHILE
										
		print("<tr>
				<td colspan='12' class='BorderInf'></td>
			</tr>
				<td colspan='3' class='BorderInf'></td>
				<td colspan='2' class='BorderInf' align='right'>TOTAL IVA</td>
				<td colspan='2' class='BorderInfDch' align='left'>".$sumaivae." €</td>
				<td colspan='2' class='BorderInf' align='right'>TOTAL €</td>
				<td class='BorderInfDch' align='right'>".$sumapvptot."</td>
				<td class='BorderInf'></td>
			</tr>
		</table>");

	}// FIN function cancel_compra()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function cancel_compra2(){
	global $db; 	global $db_name;
	require "../config/TablesNames.php";

	$oper = $_SESSION['oper'];		
		$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
		$qrc = mysqli_query($db, $rc);

	/////////////////////	
	/* PARA SUMAR IVA */
	global $sumaivae;
	if(!$qrc){print("* ERROR SQL SUMAR IVA L.1397 ".mysqli_error($db).".</br>");
	}else{
		$qivae = mysqli_query($db, $rc);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivae = 0;
			for($i=0; $i<$rowivae; $i++){ $verivae = mysqli_fetch_array($qivae);
						$sumaivae = $sumaivae + $verivae['ivae'];
												}
			}
			$sumaivae = floatval($sumaivae);		$sumaivae = number_format($sumaivae,2,".","");
	/* FIN PARA SUMAR IVA */
	/////////////////////////

	/////////////////////	
	/* PARA SUMAR PVPTOT */
	if(!$qrc){print("* ERROR SQL SUMAR PVPTOT L.1413 ".mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $rc);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0;
			for($i=0; $i<$rowpvptot; $i++){ $verpvptot = mysqli_fetch_array($qpvptot);
						$sumapvptot = $sumapvptot + $verpvptot['pvptot'];
					}
			}
			$sumapvptot = floatval($sumapvptot);		$sumapvptot = number_format($sumapvptot,2,".","");
	/* FIN PARA SUMAR PVPTOT */
	/////////////////////////

	if(!$qrc){ print("*ERROR SQL L.1374 ".mysqli_error($db).".</br>");
	}else{
		$qcp = mysqli_query($db, $rc);
		$rowcp = mysqli_num_rows($qcp);
		global $campo;	global $datos;
		for($i=0; $i<$rowcp; $i++){ $campo = mysqli_fetch_array($qcp);
			$titut ="\n |  SECCION   |    REF PROD    |     PRO NAME     | CARRO";
			$datos = $datos."\n | ".$campo['vseccion']." | ".$campo['producto']." | ".$campo['proname']." | ".$campo['kgcash'];
			}
		}
			
		$oper = $_SESSION['oper'];
		global $LogText;	global $campo;
		if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';}
		else{ $LogText = $LogText.$_POST['producto'];}
				
		$LogText = $LogText."* CANCEL COMPRA 2 =>\t* SESSION OPER: ".$oper."\t* REF CAJA: ".@$campo['refcaja']."\t* REF CLIENT: ".@$campo['refclient']."\t* NAME CLIENT: ".@$campo['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot."".@$titut.$datos;
						
	print ("<table align='center'>
			<tr style='font-size:14px'>
				<th colspan=11 class='BorderInf'>HA CANCELADO LA COMPRA ".$_SESSION['oper']."</th>
			</tr>
			<tr style='font-size:10px'>
				<th class='BorderInfDch'>REF CAJA</th>
				<th class='BorderInfDch'>REF CLIENT</th>
				<th class='BorderInfDch'>OPER SESION</th>
				<th class='BorderInfDch'>FECHA</th>
				<th class='BorderInfDch'>SECCION</th>										
				<th class='BorderInfDch'>PRODUCTO</th>
				<th class='BorderInfDch'>CARRO</th>
				<th class='BorderInfDch'>IVA€</th>
				<th class='BorderInfDch'>PVP</th>
				<th class='BorderInfDch'>SUBT</th>
			</tr>");

	$rc2 =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
	$qrc2 = mysqli_query($db, $rc2);

	while($rowrc2 = mysqli_fetch_assoc($qrc2)){
		$proname =strtolower($_POST['proname']);
		print (	"<tr align='center'>
					<td class='BorderInfDch' align='left'>".$rowrc2['refcaja']."</td>
					<td class='BorderInfDch' align='left'>".$rowrc2['refclient']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc2['oper']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc2['datecash']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc2['vseccion']."</td>
					<td class='BorderInfDch' align='right'>".$proname."</td>
					<td class='BorderInfDch' align='right'>".$rowrc2['kgcash']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc2['ivae']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc2['pvp']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc2['pvptot']."</td>
					<td class='BorderInfDch' align='right'></td>
				</tr>");
	} // FIN WHILE
						
		print("<tr>
				<td colspan='11' class='BorderInf'></td>
			</tr>
				<td colspan='3' class='BorderInf'></td>
				<td colspan='2' class='BorderInf' align='right'>TOTAL IVA</td>
				<td colspan='2' class='BorderInfDch' align='left'>".$sumaivae." €</td>
				<td colspan='2' class='BorderInf' align='right'>TOTAL €</td>
				<td class='BorderInfDch' align='right'>".$sumapvptot."</td>
			</table>");
	} // FIN function cancel_compra2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* SUMA COMPRA CANCELADA A STOCKS */
	function fcancel_1(){
		global $db;		global $db_name;
		require "../config/TablesNames.php";

		global $semana;		$semana = date('W');	
		global $date;		$date = date('Y-m-d');
		global $ATime;		$ATime = date('H:i:s');
		global $datecash;	$datecash = $date."/".$ATime;
	
		$oper = $_SESSION['oper'];
			$vnt =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper'";
			$qvnt = mysqli_query($db, $vnt);
			$rowcvnt = mysqli_num_rows($qvnt);
		
		global $seccx;		global $refpro;		global $LogText; 
		for($i=0; $i<$rowcvnt; $i++){
			$rowvnt = mysqli_fetch_assoc($qvnt);
			$seccx = $rowvnt['vseccion']; 	$seccx = "`".$seccx."`";
			$refpro = $rowvnt['producto'];
			if($rowvnt['producto']!=""){
				$cs1 = "SELECT * FROM $Productos WHERE `valor` = '$rowvnt[producto]' AND `stock` > 0 ";
					$qcs1 = mysqli_query($db, $cs1);
					$rowcs1 = mysqli_fetch_assoc($qcs1);
				/* SUMA AL STOCK LA EL CARRO CANCELADO */
				$cuadraiva = $rowcs1['ivae'] - $rowvnt['ivae'];
					$cuadraiva = floatval($cuadraiva);	$cuadraiva = number_format($cuadraiva,2,".","");
				$cuadrakgcash = $rowcs1['kgcash'] - $rowvnt['kgcash'];
					$cuadrakgcash = floatval($cuadrakgcash);	$cuadrakgcash = number_format($cuadrakgcash,2,".","");
				$cuadrastock = $rowcs1['stock'] + $rowvnt['kgcash'];
					$cuadrastock = floatval($cuadrastock);	$cuadrastock = number_format($cuadrastock,2,".","");
				$cuadrapvptot = $rowcs1['pvptot'] - $rowvnt['pvptot'];
					$cuadrapvptot = floatval($cuadrapvptot);	$cuadrapvptot = number_format($cuadrapvptot,2,".","");

				$vnt = "UPDATE `$db_name`.$Productos SET `ivae` = $cuadraiva, `kgcash` = '$cuadrakgcash', `stock` = '$cuadrastock', `pvptot` = '$cuadrapvptot' WHERE $Productos.`valor` = '$rowvnt[producto]' AND `stock` > 0  LIMIT 1 ";

				if(mysqli_query($db, $vnt)){
					print( "* ACTUALIZADO STOCK ".$seccx." / ".$Productos."</br>" );
					$LogText = $LogText."\n* FCANCEL 1 ACTUALIZADO STOCK ".$seccx." ".$Productos.".";
				}else{ print("* ERROR SQL L.1539 ".mysqli_error($db));
							}
			}else{ }
		} /* FIN DEL FOR */

} /* FIN fcancel_1() */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/*	FUNCION QUE CANCELA LA COMPRA */
function fcancel_2(){
	global $db;			global $db_name;
	require "../config/TablesNames.php";

	$oper = $_SESSION['oper'];
		$cc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper'";
		$qcc = mysqli_query($db, $cc);

	if(!$qcc){print("* ERROR SQL L.1599 ".mysqli_error($db).".</br>");
	}else{
		$qcp = mysqli_query($db, $cc);
		$rowcp = mysqli_num_rows($qcp);
		for($i=0; $i<$rowcp; $i++){ $campo = mysqli_fetch_array($qcp);
											
			global $campo;
			$titut ="\n |  SECCION   |    REF PROD    |     PRO NAME     | CARRO";
			global $datos;
			$datos = $datos."\n | ".$campo['vseccion']." | ".$campo['producto']." | ".$campo['proname']." | ".$campo['kgcash'];
		} // FIN FOR
	} // FIN ELSE
			
		global $sumaivae;	global $sumapvptot;
		global $LogText;	global $oper;		$oper = $_SESSION['oper'];
		if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';}
		else{ $LogText = $LogText.$_POST['producto']; }
		
		$LogText = $LogText."* FCANCEL 4 =>\t* SESSION OPER: ".$oper."\t* REF CAJA: ".@$campo['refcaja']."\t* REF CLIENT: ".@$campo['refclient']."\t* NAME CLIENT: ".@$campo['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot." ".@$titut.@$datos;
						
	if(mysqli_num_rows($qcc) >= 1){
		$cc2 =  "DELETE FROM $CajaShop WHERE `oper` = '$oper' ";
		if(mysqli_query($db, $cc2)){ unset($_SESSION['oper']);
									 print("* COMPRA CANCELADA.");
		}else{ print("* ERROR SQL L.1619 ".mysqli_error($db)."<br>"); }
	}else{ }

} // FIN fcancel_2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function recup_compra(){
	global $db;			global $db_name;
	require "../config/TablesNames.php";

	unset($_SESSION['oper']);

	$rc =  "SELECT * FROM $CajaShop WHERE `ini` > '0' ORDER BY `oper` ASC ";
		$qrc = mysqli_query($db, $rc);
		$count = mysqli_num_rows($qrc);
		
	if($count < 1){print("<div align='center' style='margin-bottom:120px; margin-top:20px;'>
								NO HAY COMPRAS PENDIENTES
						</div>");
	}else{ print ("<table align='center'>
					<tr style='font-size:12px'>
						<th colspan=10 class='BorderInf'>SESIONES COMPRAS ABIERTAS</th>
					</tr>
					<tr style='font-size:12px'>
						<th class='BorderInfDch'>CAJERO/A</th>
						<th class='BorderInfDch'>REF CAJA</th>				
						<th class='BorderInfDch'>OPER SESION</th>		
						<th class='BorderInfDch'>FECHA</th>			
						<th class='BorderInfDch'>REF CLIENTE</th>										
						<th class='BorderInfDch'>CARRO</th>										
						<th colspan='2' class='BorderInf'></th>
					</tr>");
									
	global $inix;	global $oper;	global $ClientRef;
	while($rowrc = mysqli_fetch_assoc($qrc)){
		$ClientRef = $rowrc['refclient'];
		$inix = $rowrc['ini'];
		$oper = $rowrc['oper'];
		//if($rowrc['ini'] != '1'){ $rowrc['cname'] = '';	$rowrc['datecash'] = ''; }

		// SUMO LOS PRODUCTOS QUE HAY EN CADA COMPRA
		/*
		$a = "SELECT SUM(`kgcash`) AS 'sumapro' FROM $CajaShop WHERE `oper` = '$rowrc[oper]'";
		$b = mysqli_query($db, $a);
		$c = mysqli_fetch_assoc($b);
		echo "** ".$c['sumapro']."<br>";
		*/
		$SqlSum = "SELECT * FROM $CajaShop WHERE `oper` = '$rowrc[oper]' ";
			$SqlSumQuery = mysqli_query($db, $SqlSum);
			$SqlSumNum = mysqli_num_rows($SqlSumQuery);
		global $SumaResult;	$SumaResult = 0.00;
		for($i=0; $i<$SqlSumNum; $i++){ 
			$SumaProductos = mysqli_fetch_array($SqlSumQuery);
			$SumaResult = $SumaResult + $SumaProductos['kgcash'];
			}
		//echo "** ".$SqlSumNum."<br>";		//echo "** ".$SumaResult."<br>";
		$SumaResult = floatval($SumaResult);		$SumaResult = number_format($SumaResult,2,".","");

		print("<tr align='center'>
					<td class='BorderInfDch' align='left'>".$rowrc['cname']."</td>
					<td class='BorderInfDch' align='left'>".$rowrc['refcaja']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['oper']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['datecash']."</td>
					<td class='BorderInfDch' align='right'>".$rowrc['refclient']."</td>
					<td class='BorderInfDch' align='right'>".$SumaResult."</td>
					<td class='BorderInf'>");
		if($rowrc['ini'] == '1'){
			print("<div style='float:left; margin-right:4px'>
				<form name='recup_compra2' method='post' action='$_SERVER[PHP_SELF]'>
					<input name='cname' type='hidden' value='".$rowrc['cname']."' />
					<input name='refcaja' type='hidden' value='".$rowrc['refcaja']."' />
					<input name='oper' type='hidden' value='".$rowrc['oper']."' />
					<input name='datecash' type='hidden' value='".$rowrc['datecash']."' />
					<input name='refclient' type='hidden' value='".$rowrc['refclient']."' />
					<input name='vseccion' type='hidden' value='".$rowrc['vseccion']."' />
					<input name='producto' type='hidden' value='".$rowrc['producto']."' />
					<input name='kgcash' type='hidden' value='".$rowrc['kgcash']."' />
						<input type='submit' value='RECUPERAR ESTA COMPRA' />
						<input type='hidden' name='recup_compra2' value=1 />
				</form>
					</div>
					<div style='float:left;margin-right:4px'>
				<form name='coment_client' action='CompraComent.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=320px')\">
						<input name='oper' type='hidden' value='".$oper."' />
						<input type='submit' value='VER COMENTARIOS' />
						<input type='hidden' name='coment_client' value=1 />
				</form>
					</div>");			
		}else{ }

		print("	</td>");

		if($ClientRef != ""){
			$ncl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ";
				$qncl = mysqli_query($db, $ncl);
				$rowncl = mysqli_fetch_assoc($qncl);
			if(mysqli_num_rows($qncl) == 0){
				$ncl2 =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ";
					$qncl2 = mysqli_query($db, $ncl2);
					$rowncl2 = mysqli_fetch_assoc($qncl2);
					$_SESSION['nclient'] = $rowncl2['Nivel'];
			}else{ $_SESSION['nclient'] = $rowncl['Nivel']; }
		}else{ }

	global $ClientRef;	global $height;
	if($ClientRef != ''){
		if(($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'plus')){ $height = 'height=530px'; }
		else { $height = 'height=250px'; }

		if($_SESSION['nclient'] == 'cliente'){
			$dtcl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
			$qdtcl = mysqli_query($db, $dtcl);
			$height = 'height=530px';
		}elseif(($_SESSION['nclient'] == 'admin')||($_SESSION['nclient'] == 'plus')||($_SESSION['nclient'] == 'user') || ($_SESSION['nclient'] == 'caja')){
			$dtcl =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
			$qdtcl = mysqli_query($db, $dtcl);}

		while($rowdtcl = mysqli_fetch_assoc($qdtcl)){
			print("	<td class='BorderInf'>");
			global $inix;
			if($inix == 1){
				print("<div style='float:left;margin-right:4px'>
						<form name='data_client' action='Cliente_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=320px,".$height."')\">
							<input name='id' type='hidden' value='".$rowdtcl['id']."' />
							<input name='Nivel' type='hidden' value='".$rowdtcl['Nivel']."' />
							<input name='ref' type='hidden' value='".$rowdtcl['ref']."' />
							<input name='Nombre' type='hidden' value='".$rowdtcl['Nombre']."' />
							<input name='Apellidos' type='hidden' value='".$rowdtcl['Apellidos']."' />
							<input name='myimg' type='hidden' value='".$rowdtcl['myimg']."' />
							<input name='doc' type='hidden' value='".$rowdtcl['doc']."' />
							<input name='dni' type='hidden' value='".$rowdtcl['dni']."' />
							<input name='ldni' type='hidden' value='".$rowdtcl['ldni']."' />
							<input name='Email' type='hidden' value='".$rowdtcl['Email']."' />
							<input name='Usuario' type='hidden' value='".$rowdtcl['Usuario']."' />
							<input name='Password' type='hidden' value='".$rowdtcl['Password']."' />
							<input name='Direccion' type='hidden' value='".$rowdtcl['Direccion']."' />
							<input name='Tlf1' type='hidden' value='".$rowdtcl['Tlf1']."' />
							<input name='Tlf2' type='hidden' value='".$rowdtcl['Tlf2']."' />
							<input name='lastin' type='hidden' value='".$rowdtcl['lastin']."' />
							<input name='lastout' type='hidden' value='".$rowdtcl['lastout']."' />
							<input name='visitadmin' type='hidden' value='".$rowdtcl['visitadmin']."' />
								<input type='submit' value='DATOS CLIENTE' />
								<input type='hidden' name='data_client' value=1 />
						</form>
							</div>");
			} // FIN IF
		print("</td>");
				} /* FIN DEL WHILE */
			} // FIN IF
				global $ClientRef;
				if($ClientRef == ''){ print("<td class='BorderInf'></td>"); }
					print("</tr>");
		} // FIN WHILE
		print("	</table>");
	} // FIN ELSE $count >= 1

	global $LogText;		$LogText = $LogText."* CONSULTA RECUPERAR COMPRAS 1 =>";

} /* FIN  recup_compra() */


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function subtotal(){
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	$oper = $_SESSION['oper'];		
	$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
		//echo "* ".$rc."<br>";
		$qrc = mysqli_query($db, $rc);

	/////////////////////	
	/* PARA SUMAR IVA */
	global $sumaivae;
	if(!$qrc){print("* ERROR SQL SUMAR IVA L.1805 ".mysqli_error($db).".</br>");
	}else{
		$qivae = mysqli_query($db, $rc);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivae = 0;
			for($i=0; $i<$rowivae; $i++){ $verivae = mysqli_fetch_array($qivae);
						$sumaivae = $sumaivae + $verivae['ivae'];
							}
			$sumaivae = floatval($sumaivae);		$sumaivae = number_format($sumaivae,2,".","");
		}
	/* FIN PARA SUMAR IVA */
	/////////////////////////

	/////////////////////	
	/* PARA SUMAR PVPTOT */
	global $sumapvptot;
	if(!$qrc){ print("* ERROR SQL SUMAR PVPTOT L.1822 ".mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $rc);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0;
			for($i=0; $i<$rowpvptot; $i++){ $verpvptot = mysqli_fetch_array($qpvptot);
						$sumapvptot = $sumapvptot + $verpvptot['pvptot'];
							}
			$sumapvptot = floatval($sumapvptot);
			$sumapvptot = number_format($sumapvptot,2,".","");
			}
	/* FIN PARA SUMAR PVPTOT */
	/////////////////////////

	if(!$qrc){print("* ERROR SQL L.1798 ".mysqli_error($db).".</br>");
	}else{
		$qcp = mysqli_query($db, $rc);
		$rowcp = mysqli_num_rows($qcp);
		for($i=0; $i<$rowcp; $i++){
		global $campo;		$campo = mysqli_fetch_array($qcp);
		global $titut;		$titut ="\n |  SECCION   |    REF PROD    |     PRO NAME     | CARRO";
		global $datos;		
		$datos =$datos."\n | ".$campo['vseccion']." | ".$campo['producto']." | ".$campo['proname']." | ".$campo['kgcash'];
			} // FIN FOR
	}
			
		global $LogText;	global $oper;	$oper = $_SESSION['oper'];
		if(!isset($_POST['producto'])){ $LogText = $LogText.'TODOS LOS PRODUCTOS'; }
		else{ $LogText = $LogText.$_POST['producto']; }
		
		$LogText = $LogText."* SUBTOTAL =>\t* SESSION OPER: ".$oper."\t* REF CAJA: ".$campo['refcaja']."\t* REF CLIENT: ".$campo['refclient']."\t* NAME CLIENT: ".$campo['clname']."\t* IVA TOT: ".$sumaivae."\t	* PVP TOT: ".$sumapvptot."".$titut.$datos;
						
		print ("<table align='center'>
					<tr style='font-size:13px'>
						<th colspan=12 class='BorderInf'>
							SUBTOTAL COMPRA ".$_SESSION['oper']." 
						</th>
					</tr>
					<tr style='font-size:10px'>
						<th class='BorderInfDch'>REF CAJA</th>		
						<th class='BorderInfDch'>REF CLIENT</th>
						<th class='BorderInfDch'>FECHA</th>
						<th class='BorderInfDch'>SECCION</th>
						<th class='BorderInfDch'>PRODUCTO</th>
						<th class='BorderInfDch'>STOCK</th>
						<th class='BorderInfDch' bgcolor='#DCEDED'>CARRO</th>
						<th class='BorderInfDch'>PVP</th>
						<th class='BorderInfDch'>IVA€</th>
						<th class='BorderInfDch' bgcolor='#DCEDED'>SUBT</th>
						<th colspan='2' class='BorderInf'>
								<form name='cancel_compra' method='post' action='$_SERVER[PHP_SELF]'>
											<input type='submit' value='CANCELAR COMPRA' />
											<input type='hidden' name='cancel_compra' value=1 />
								</form>	
						</th>
					</tr>");
									
	global $rowStock;
	while($rowrc = mysqli_fetch_assoc($qrc)){
		$proname = ucwords(strtolower($rowrc['proname']));

		if($rowrc['producto'] != ''){
			$fil = "%".$rowrc['producto']."%";
			$sstk =  "SELECT * FROM $Productos WHERE `valor` LIKE '$fil' LIMIT 1";
				$qst = mysqli_query($db, $sstk);
				$rowStock = mysqli_fetch_assoc($qst);
				$rowStock = $rowStock['stock'];
		}else{ $rowStock = 0.00; }

		print ("<tr align='center'>
						<td class='BorderInfDch' align='left'>".$rowrc['refcaja']."</td>
						<td class='BorderInfDch' align='left'>".$rowrc['refclient']."</td>
						<td class='BorderInfDch' align='right'>".$rowrc['datecash']."</td>
						<td class='BorderInfDch' align='right'>".$rowrc['vseccion']."</td>
						<td class='BorderInfDch' align='right'>".$proname."</td>
						<td class='BorderInfDch' align='right'>".$rowStock."</td>
						<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>".$rowrc['kgcash']."</td>
						<td class='BorderInfDch' align='right'>".$rowrc['pvp']."</td>
						<td class='BorderInfDch' align='right'>".$rowrc['ivae']."</td>
						<td bgcolor='#DCEDED' class='BorderInfDch' align='right'>".$rowrc['pvptot']."</td>");
		if($rowrc['producto'] != ''){
			print("<td colspan='2' class='BorderInfDch' align='right' width='184px'>
					<div style='float:left;margin-right:3px'>
				<form name='modif_pro' action='$_SERVER[PHP_SELF]' method='POST'>
					<input name='id' type='hidden' value='".$rowrc['id']."' />
					<input name='oper' type='hidden' value='".$rowrc['oper']."' />
					<input name='refcaja' type='hidden' value='".$rowrc['refcaja']."' />
					<input name='cname' type='hidden' value='".$rowrc['cname']."' />
					<input name='proname' type='hidden' value='".$rowrc['proname']."' />
					<input name='psiva' type='hidden' value='".$rowrc['psiva']."' />
					<input name='iva' type='hidden' value='".$rowrc['iva']."' />
					<input name='nsemana' type='hidden' value='".$rowrc['nsemana']."' />
					<input name='refclient' type='hidden' value='".$rowrc['refclient']."' />
					<input name='datecash' type='hidden' value='".$rowrc['datecash']."' />
					<input name='vseccion' type='hidden' value='".$rowrc['vseccion']."' />
					<input name='producto' type='hidden' value='".$rowrc['producto']."' />
					<input name='stock' type='hidden' value='".$rowStock."' />
					<input name='kgcashx' type='hidden' value='".$rowrc['kgcash']."' />
					<input name='pvp' type='hidden' value='".$rowrc['pvp']."' />
					<input name='ivae' type='hidden' value='".$rowrc['ivae']."' />
					<input name='pvptot' type='hidden' value='".$rowrc['pvptot']."' />
						<input type='submit' value='MODIF' />
						<input type='hidden' name='modif_pro' value=1 />
				</form>
					</div>
					<div style='float:left;margin-right:3px'>
				<form name='elim_pro'  action='$_SERVER[PHP_SELF]' method='POST'>
					<input name='id' type='hidden' value='".$rowrc['id']."' />
					<input name='cname' type='hidden' value='".$rowrc['cname']."' />
					<input name='proname' type='hidden' value='".$rowrc['proname']."' />
					<input name='psiva' type='hidden' value='".$rowrc['psiva']."' />
					<input name='iva' type='hidden' value='".$rowrc['iva']."' />
					<input name='refcaja' type='hidden' value='".$rowrc['refcaja']."' />	
					<input name='refclient' type='hidden' value='".$rowrc['refclient']."' />
					<input name='oper' type='hidden' value='".$rowrc['oper']."' />	
					<input name='nsemana' type='hidden' value='".$rowrc['nsemana']."' />	
					<input name='datecash' type='hidden' value='".$rowrc['datecash']."' />
					<input name='vseccion' type='hidden' value='".$rowrc['vseccion']."' />	
					<input name='producto' type='hidden' value='".$rowrc['producto']."' />
					<input name='kgcash' type='hidden' value='".$rowrc['kgcash']."' />	
					<input name='ivae' type='hidden' value='".$rowrc['ivae']."' />			
					<input name='pvp' type='hidden' value='".$rowrc['pvp']."' />	
					<input name='pvptot' type='hidden' value='".$rowrc['pvptot']."' />
							<input type='submit' value='BORRA' />
							<input type='hidden' name='elim_pro' value=1 />
					</div>
				</form>
					<div style='float:left;margin-right:3px'>
				<form name='ver' action='Productos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=640px')\">
					<input name='seccion' type='hidden' value='".$rowrc['vseccion']."' />
					<input name='id' type='hidden' value='".$rowrc['id']."' />
					<input name='valor' type='hidden' value='".$rowrc['producto']."' />
					<input name='nombre' type='hidden' value='".$rowrc['proname']."' />
					<input name='ref' type='hidden' value='".$rowrc['producto']."' />
							<input type='submit' value='IMAGENES' />
							<input type='hidden' name='oculto2' value=1 />
					</div>
				</form>");
		}else{ print("<td colspan='2' class='BorderInf'>"); }
		print("</td></tr>");
	} // FIN WHILE
			print("<tr><td colspan='12' class='BorderInf'></td></tr>
				<tr>
					<td colspan='4' class='BorderInf'>");
										
		global $oper;		$oper = $_SESSION['oper'];
		$rdcl =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
			$qdcl = mysqli_query($db, $rdcl);
			$rowdcl = mysqli_fetch_assoc($qdcl);
			$ClientRef = $rowdcl['refclient'];
		if(($rowdcl['oper']!="")&&($rowdcl['refclient']!="")&&($rowdcl['kgcash']>0)){
			print("<div style='float:left;margin-right:6px'>
					<form name='selec_client' method='post' action='$_SERVER[PHP_SELF]'>
						<input name='refclient' type='hidden' value='".$rowdcl['refclient']."' />
						<input type='submit' value='MODIFICAR CLIENTE' />
						<input type='hidden' name='selec_client' value=1 />
						<input type='hidden' name='modif_client' value=1 />
					</form>	
				</div>");
		}else{ }

		if($rowdcl['refclient']==""){ $ClientRef = "";
		}else{
			$ClientRef = $rowdcl['refclient'];
			$ncl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ";
				$qncl = mysqli_query($db, $ncl);
				$rowncl = mysqli_fetch_assoc($qncl);
				$countcl = mysqli_num_rows($qncl);
			if($countcl == 0){
					$ncl =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ";
						$qncl = mysqli_query($db, $ncl);
						$rowncl = mysqli_fetch_assoc($qncl);
						$_SESSION['nclient'] = $rowncl['Nivel'];
			}else{ $_SESSION['nclient'] = $rowncl['Nivel']; }
		}

		if($oper == ''){
		}elseif($ClientRef != ''){
			global $height;
			if(($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $height = 'height=530px';
			}else{ $height = 'height=260px'; }
	
			if($_SESSION['nclient'] == 'cliente'){
				$dtcl =  "SELECT * FROM $ClientesShop WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
					$qdtcl = mysqli_query($db, $dtcl);
					$height = 'height=530px';
			}elseif(($_SESSION['nclient'] == 'admin') || ($_SESSION['nclient'] == 'plus') || ($_SESSION['nclient'] == 'user') || ($_SESSION['nclient'] == 'caja')){
				$dtcl =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
					$qdtcl = mysqli_query($db, $dtcl);}
					$rowdtcl = mysqli_fetch_assoc($qdtcl);
				if($rowdtcl['doc']=='local'){ $height = 'height=260px'; }else{ $height = 'height=530px'; }

				print("<div style='float:left;margin-right:4px'>
				<form name='data_client' action='Cliente_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=320px,".$height."')\">
					<input name='id' type='hidden' value='".$rowdtcl['id']."' />
					<input name='Nivel' type='hidden' value='".$rowdtcl['Nivel']."' />
					<input name='ref' type='hidden' value='".$rowdtcl['ref']."' />
					<input name='Nombre' type='hidden' value='".$rowdtcl['Nombre']."' />
					<input name='Apellidos' type='hidden' value='".$rowdtcl['Apellidos']."' />
					<input name='myimg' type='hidden' value='".$rowdtcl['myimg']."' />
					<input name='doc' type='hidden' value='".$rowdtcl['doc']."' />
					<input name='dni' type='hidden' value='".$rowdtcl['dni']."' />
					<input name='ldni' type='hidden' value='".$rowdtcl['ldni']."' />
					<input name='Email' type='hidden' value='".$rowdtcl['Email']."' />
					<input name='Usuario' type='hidden' value='".$rowdtcl['Usuario']."' />
					<input name='Password' type='hidden' value='".$rowdtcl['Password']."' />
					<input name='Direccion' type='hidden' value='".$rowdtcl['Direccion']."' />
					<input name='Tlf1' type='hidden' value='".$rowdtcl['Tlf1']."' />
					<input name='Tlf2' type='hidden' value='".$rowdtcl['Tlf2']."' />
					<input name='lastin' type='hidden' value='".$rowdtcl['lastin']."' />
					<input name='lastout' type='hidden' value='".$rowdtcl['lastout']."' />
					<input name='visitadmin' type='hidden' value='".$rowdtcl['visitadmin']."' />
						<input type='submit' value='DATOS CLIENTE' />
						<input type='hidden' name='data_client' value=1 />
				</form>
					</div>");
		} // FIN elseif($ClientRef != '')
		print("<div style='float:left;margin-right:6px'>
			<form name='coment_client' action='CompraComent.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=320px')\">
				<input name='oper' type='hidden' value='".$oper."' />
				<input type='submit' value='VER COMENTARIOS' />
				<input type='hidden' name='coment_client' value=1 />
			</form>
				</div>
			</td>
			<td colspan='3' class='BorderInf' align='right'>TOTAL IVA</td>
			<td bgcolor='#DCEDED' class='BorderInfDch' align='left'>".$sumaivae." €</td>
			<td colspan='2' class='BorderInf' align='right'>TOTAL €</td>
			<td bgcolor='#DCEDED' class='BorderInfDch' align='left'>".$sumapvptot."</td>
			<td class='BorderInf'>");

		$rdx =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
			$qdx = mysqli_query($db, $rdx);
			$rowdx = mysqli_fetch_assoc($qdx);
		if($oper == ''){
		}elseif($rowdx['producto'] != ''){
			print("<div align='center' >
					<form name='pago' method='post' action='$_SERVER[PHP_SELF]'>
						<input type='submit' value='FORMA DE PAGO' />
						<input type='hidden' name='pago' value=1 />
					</form>	
				</div>");
		}else{ }// FIN PRIMER ELSE
		print("</td></tr></table>");
		
} // FIN function subtotal()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function selec_pro(){
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	$sqlx =  "SELECT * FROM $Secciones WHERE `valor` = '$_POST[seccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);
	global $_SecName;		$_SecName = $rowseccion['nombre'];
	global $_SecValue;		$_SecValue = $rowseccion['valor'];
	global $oper; 			$oper = $_SESSION['oper'];
	
	// SELECCIONO LOS VALORES DE LA OPERACION
	$sqloper =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
		$qoper = mysqli_query($db, $sqloper);
		global $noper;	$noper = mysqli_num_rows($qoper);
		$rowrOper = mysqli_fetch_assoc($qoper);
		global $ClientRef;		$ClientRef = $rowrOper['refclient'];
		global $ClientName;		$ClientName = $rowrOper['clname'];

	// SELECCIONO LOS VALORES DEL PRODUCTO
	$sqlProduc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' AND `producto` = '$_POST[valor]' LIMIT 1";
		$qProduc = mysqli_query($db, $sqlProduc);
		$rowProduc = mysqli_fetch_assoc($qProduc);
		$countProduc = mysqli_num_rows($qProduc);
		global $rowProduckgcash;
	if($countProduc > 0){ $rowProduckgcash = $rowProduc['kgcash'];
	}else{ $rowProduckgcash = 0.00; }

	global $refcaja;	$refcaja = $_SESSION['ref'];
	global $semana;		$semana = date('W');	
	global $date;		$date = date('Y-m-d');
	global $ATime;		$ATime = date('H:i:s');
	global $datecash;	$datecash = $date."/".$ATime;

	global $kgcash;		$kgcash = 0.00;		global $pvptot;		global $ivae;	global $ivav;
	$kgcash1 = $_POST['kgcash1'];		$kgcash2 = $_POST['kgcash2'];
	$kgcash = $kgcash1.".".$kgcash2;
	$kgcash = floatval($kgcash);		$kgcash = number_format($kgcash,2,".","");

	$pvp = $_POST['pvp'];
	$pvp = floatval($pvp);				$pvp = number_format($pvp,2,".","");
	$pvptot = $kgcash * $pvp ;
	$pvptot = floatval($pvptot);		$pvptot = number_format($pvptot,2,".","");
	
	$ivaop = $_POST['iva'];
	$ivae = $_POST['psiva']*($ivaop/100);
	$ivae = floatval($ivae);			$ivae = number_format($ivae,2,".","");
	$ivav = $ivae * $kgcash;
	$ivav = floatval($ivav);			$ivav = number_format($ivav,2,".","");
	global $tabla;
	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>HA SELECCIONADO</th>
				</tr>
				<tr>
					<td>SECCION</td><td>".$rowseccion['nombre']."</td>
					<td>PRODUCT REF</td><td>".$_POST['valor']."</td>
				</tr>				
				<tr>
					<td>PRODUCT NAME</td><td>".$_POST['proname']."</td>
					<td>UNIT VENTA</td><td>".$kgcash."</td>
				</tr>
				<tr>
					<td>PVP SIN IVA</td><td>".$_POST['psiva']." €</td>
					<td>TIPO IVA</td><td>".$_POST['iva']." %</td>
				</tr>
				<tr>
					<td>IVA €</td><td>".$ivav." €</td>
					<td>UNIT € PVP</td><td>".$_POST['pvp']." €</td>
				</tr>
				<tr>
					<td colspan='2'></td>
					<td>CAJA TOT €</td><td>".$pvptot." €</td>
				</tr>
			</table>";	 

		/* RESTA LA COMPRA AL STOCKS */														
		global $refpro;		$refpro = $_POST['valor']; 
		$cs1 = "SELECT * FROM $Productos WHERE `valor` = '$refpro' AND `stock` > 0 ";
			$qcs1 = mysqli_query($db, $cs1);
			$rowcs1 = mysqli_fetch_assoc($qcs1);
		global $cuadrakgcash;	global $cuadrapvptot;	global $cuadrastock;	global $cuadraiva;
		if(mysqli_num_rows($qcs1) > 0){
			/* RESTA AL STOCK LA NUEVA ENTRADA */
			$cuadrakgcash = $rowcs1['kgcash'] + $kgcash;
				$cuadrakgcash = floatval($cuadrakgcash);
				$cuadrakgcash = number_format($cuadrakgcash,2,".","");
			$cuadrapvptot = $rowcs1['pvptot'] + $pvptot;
				$cuadrapvptot = floatval($cuadrapvptot);
				$cuadrapvptot = number_format($cuadrapvptot,2,".","");
			$cuadrastock = $rowcs1['stock'] - $kgcash;
				$cuadrastock = floatval($cuadrastock);
				$cuadrastock = number_format($cuadrastock,2,".","");
			$cuadraiva = $rowcs1['ivae'] + $ivav;
				$cuadraiva = floatval($cuadraiva);
				$cuadraiva = number_format($cuadraiva,2,".","");
		// ACTUALIZA LOS VALORES DE LA TABLA PRODUCTOS
		$cs2 = "UPDATE `$db_name`.$Productos SET `ivae` = $cuadraiva, `kgcash` = '$cuadrakgcash', `stock` = '$cuadrastock', `pvptot` = '$cuadrapvptot', `datecash` = '$datecash' WHERE $Productos.`valor` = '$refpro' AND `stock` > 0  LIMIT 1 ";
		//echo "*L.2147 ".$cs2."<br>";
		global $LogText;		global $seccx2;
		if(mysqli_query($db, $cs2)){
			//print( "*L.2147 ACTUALIZADO STOCK ".$seccx2." ".$Productos."</br>" );
			$LogText = $LogText."\n* ACTUALIZADO STOCK RESTADO ".$kgcash."".$seccx2." ".$Productos."";
		}else{ print("* ERROR SQL L.2147 ".mysqli_error($db)); }
	}else{ }

	if(($rowrOper['oper'] == $oper)&&($rowrOper['kgcash'] == 0.00)){
		if($rowrOper['clname']==""){ $clname = "`clname` = '$rowrOper[cname]',"; }else{ $clname = ""; }
		if($rowrOper['refclient']==""){ $clref = "`refclient` = '$rowrOper[refcaja]',"; }else{ $clref = ""; }
		$sql = "UPDATE `$db_name`.$CajaShop SET $clname $clref `datecash` = '$datecash', `vseccion` = '$_POST[seccion]', `producto` = '$_POST[valor]', `proname` = '$_POST[proname]', `kgcash` = '$kgcash', `psiva` = '$_POST[psiva]',`iva` = '$_POST[iva]', `ivae` = '$ivav', `pvp` = '$_POST[pvp]', `pvptot` = '$pvptot' WHERE `oper` = '$oper' LIMIT 1 ";
		//echo "* L.2156 ".$sql."<br>";
		if(mysqli_query($db, $sql)){ 
			print($tabla);
			if(!isset($_POST['producto'])){ $LogText = $LogText.'TODOS LOS PRODUCTOS';
			}else{ $LogText = $LogText.$_POST['producto']; }
			$LogText = $LogText."* SELECT PRO =>\t* SESSION OPER ".$oper."\t* REF CLIENTE ".$ClientRef."\t* SECCION ".$_POST['seccion']."\t* PRODUCTO ".$_POST['proname']."\t* UNIT CAJA ".$kgcash."\t* PVP ".$_POST['pvp']."\t* PVPTOT ".$pvptot."\n";
		}else{ print("* ERROR SQL L.2202 ".mysqli_error($db)."</br>"); }
		
	}elseif((@$rowProduc['producto'] == $_POST['valor'])){
		$sql = "UPDATE `$db_name`.$CajaShop SET `datecash` = '$datecash', `kgcash` = '$cuadrakgcash', `psiva` = '$_POST[psiva]', `ivae` = '$cuadraiva', `pvp` = '$_POST[pvp]', `pvptot` = '$cuadrapvptot' WHERE `oper` = '$oper' AND `producto` = '$_POST[valor]'  LIMIT 1 ";
		//echo "*2169 ".$sql."<br>";
		if(mysqli_query($db, $sql)){ 
			print($tabla);
			if(!isset($_POST['producto'])){ $LogText = $LogText.'TODOS LOS PRODUCTOS';
			}else{ $LogText = $LogText.$_POST['producto']; }
			$LogText = $LogText."* SELECT PRO =>\t* SESSION OPER ".$oper."\t* REF CLIENTE ".$ClientRef."\t* SECCION ".$_POST['seccion']."\t* PRODUCTO ".$_POST['proname']."\t* UNIT CAJA ".$kgcash."\t* PVP ".$_POST['pvp']."\t* PVPTOT ".$pvptot."\n";
		}else{ print("* ERROR SQL L.2219 ".mysqli_error($db)."</br>"); }

	}else{
		if($noper >= 1){ $ini = 0; }else{ $ini = 1; }
		
		$sql = "INSERT INTO `$db_name`.$CajaShop (`ini`, `cname`, `refcaja`, `clname`, `refclient`, `oper`, `nsemana`, `datecash`, `vseccion`, `producto`, `proname`, `kgcash`, `psiva`, `iva`, `ivae`, `pvp`, `pvptot`, `pago`) VALUES ('$ini', '$rowrOper[cname]', '$refcaja', '$ClientName', '$ClientRef', '$rowrOper[oper]', '$semana', '$datecash', '$_POST[seccion]', '$_POST[valor]', '$_POST[proname]', '$kgcash', '$_POST[psiva]', '$_POST[iva]', '$ivav', '$_POST[pvp]', '$pvptot', '')";
		//echo "* ".$sql."<br><br>";
		if(mysqli_query($db, $sql)){ 
			print( $tabla );
			if(!isset($_POST['producto'])){ $LogText = $LogText.'TODOS LOS PRODUCTOS'; }
			else{ $LogText = $LogText.$_POST['producto'];}
			$LogText = $LogText."* SELECT PRO =>\t* SESSION OPER ".$oper."\t* REF CLIENTE ".$ClientRef."\t* SECCION ".$_POST['seccion']."\t* PRODUCTO ".$_POST['proname']."\t* UNIT CAJA ".$kgcash."\t* PVP ".$_POST['pvp']."\t* PVPTOT ".$pvptot."\n";
		}else{ print("* ERROR SQL L.2234 ".mysqli_error($db)."</br>"); }
	}
	
	} // FIN function selec_pro()
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form($errors=[]){
	global $db;		global $kgcash1;		global $kgcash2;
	require "../config/TablesNames.php";

	if(isset($_POST['oculto'])){
			$defaults = array ( 'kgcash1' => '',
								'kgcash2' => '00',);
	}else{ }

	if(isset($_POST['selec_pro'])){
			$defaults = array ( 'kgcash1' => $kgcash1,
								'kgcash2' => $kgcash2,);
	}else{	$defaults = array ( 'kgcash1' => '',
								'kgcash2' => '00',);
				}

	global $LogText;
	global $KeyErrors;	$KeyErrors = 2;

	require 'TableValidateErrors.php';

	$fil = "%".$_POST['producto']."%";

	$sqlc =  "SELECT * FROM $Productos WHERE `valor` LIKE '$fil' ";
		//echo "* ".$sqlc."<br>";
		$qc = mysqli_query($db, $sqlc);
	
	$sqlx =  "SELECT * FROM $Secciones WHERE `valor` = '$_POST[seccion]'";
		$q = mysqli_query($db, $sqlx);
		$rowseccion = mysqli_fetch_assoc($q);

	global $kgcash;	global $kgcash1;	global $kgcash2;
	if(isset($_POST['stock'])){
		$nkgcash = strlen(trim($_POST['stock']));
		$nkgcash = $nkgcash - 3;
		$kgcashx = $_POST['stock'];
		$kgcash1 = substr($_POST['stock'],0,$nkgcash);
		$kgcash2 = substr($_POST['stock'],-2,2);
	}else{ }

	global $kgcash;	
	if(isset($_POST['kgcash1'])){
		$kgcash1 = $_POST['kgcash1'];	
		$kgcash2 = $_POST['kgcash2'];
		$kgcash = $kgcash1.".".$kgcash2;
		$kgcash = floatval($kgcash);
		$kgcash = number_format($kgcash,2,".","");
	}else{ }
	
	if(!$qc){ print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr align='center'>
							<td>
								<font color='red'><b>SELECCIONE UNA SECCION</font>
							</td>
						</tr>
					</table>");
	}else{
		if(mysqli_num_rows($qc)== 0){
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
					<tr align='center'>
						<td>
							<font color='red'><b>NO HAY DATOS EN ".$rowseccion['nombre']."</font>
						</td>
					</tr>
				</table>");
		}else{ print("<table align='center'>
						<tr style='font-size:14px'>
							<th colspan=10 class='BorderInf'>
								PRODUCTOS SECCION ".$rowseccion['nombre']."
							</th>
						</tr>
						<tr style='font-size:12px'>
							<th class='BorderInfDch'>REF PRO</th>	
							<th class='BorderInfDch'>NAME PRO</th>
							<th class='BorderInfDch'>PVPN</th>
							<th class='BorderInfDch'>IVA%</th>
							<th class='BorderInfDch'>IVA€</th>
							<th class='BorderInfDch'>PVP.€</th>
							<th class='BorderInfDch'>STOCK</th>
							<th class='BorderInfDch'>UNIT COMPRA</th>
							<th class='BorderInfDch'>DESCRIPCION</th>
							<th class='BorderInf'></th>
						</tr>");
			while($rowc = mysqli_fetch_assoc($qc)){
				if($rowc['valor'] != ''){
					print (	"<tr align='center'>
						<form name='modifica'  action='$_SERVER[PHP_SELF]' method='POST'>
							<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
								<td class='BorderInfDch' align='right'>
							<input name='valor' type='hidden' value='".$rowc['valor']."' />".$rowc['valor']."
						</td>
						<td class='BorderInfDch' align='left'>
					<input name='proname' type='hidden' value='".$rowc['nombre']."' />".$rowc['nombre']."
						</td>
						<td class='BorderInfDch' align='right'>
					<input name='psiva' type='hidden' value='".$rowc['psiva']."' />".$rowc['psiva']."
						</td>
						<td class='BorderInfDch' align='right'>
					<input name='iva' type='hidden' value='".$rowc['iva']."' />".$rowc['iva']." %
						</td>
						<td class='BorderInfDch' align='right'>
					<input name='ivae' type='hidden' value='".$rowc['ivae']."' />".$rowc['ivae']."
						</td>
						<td class='BorderInfDch' align='right'>
					<input name='pvp' type='hidden' value='".$rowc['pvp']."' />".$rowc['pvp']."
						</td>
						<td class='BorderInfDch' align='right'>
					<input name='stock' type='hidden' value='".$rowc['stock']."' />".$rowc['stock']."
						</td>
						<td class='BorderInfDch' align='right'>
					<input name='kgcash1' type='number' size='6' maxlength='2' value='".$defaults['kgcash1']."' style='text-align:right' />
					,
					<input name='kgcash2' type='number' size='6' maxlength='2' value='".$defaults['kgcash2']."' />
						</td>
						<td width='160px' class='BorderInfDch' align='left'>
					<input name='coment' type='hidden' value='".$rowc['coment']."' />".$rowc['coment']."
						</td>");
											
			$nstock = strlen(trim($rowc['stock']));		$nstock = $nstock - 3;
			$stockx = $rowc['stock'];
			$stock1 = substr($rowc['stock'],0,$nstock);
			$stock2 = substr($rowc['stock'],-2,2);
			print("<input name='stock1' type='hidden' value='".$stock1."' />
					<input name='stock2' type='hidden' value='".$stock2."' />
						<td width='146px' align='center' class='BorderInfDch'>
						<div style='float:left;margin-right:3px'>
							<input type='submit' value='COMPRAR' />
							<input type='hidden' name='selec_pro' value=1 />
						</div>
				</form>
				<form name='ver' action='Productos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px, height=640px')\">
					<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
					<input name='id' type='hidden' value='".$rowc['id']."' />
					<input name='valor' type='hidden' value='".$rowc['valor']."' />
					<input name='nombre' type='hidden' value='".$rowc['nombre']."' />
					<input name='ref' type='hidden' value='".$rowc['ref']."' />
						<div style='float:left;margin-right:1px'>
							<input type='submit' value='IMAGENES' />
							<input type='hidden' name='oculto2' value=1 />
						</div>
				</form></td></tr>");
			}else{ }
				} // FIN DEL WHILE
				print("</table>");
			} // FIN DEL SEGUNDO ANIDADO IF
		} // FIN DEL PRIMER ELSE
		
	}	// FIN process_form();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif_pro($errors=[]){
	global $db;			global $db_name;
	require "../config/TablesNames.php";

	global $semana;		$semana = date('W');	
	global $date;		$date = date('Y-m-d');
	global $ATime;		$ATime = date('H:i:s');
	global $datecash;	$datecash = $date."/".$ATime;

	$nkgcashx = strlen(trim($_POST['kgcashx']));
	$nkgcashx = $nkgcashx - 3;
	$kgcashx = $_POST['kgcashx'];
	global $kgcash1x;		$kgcash1x = substr($_POST['kgcashx'],0,$nkgcashx);
	global $kgcash2x;		$kgcash2x = substr($_POST['kgcashx'],-2,2);
			
	$nstock = strlen(trim($_POST['stock']));
	$nstock = $nstock - 3;
	$stockx = $_POST['stock'];
	$stock1 = substr($_POST['stock'],0,$nstock);
	$stock2 = substr($_POST['stock'],-2,2);

	$_SESSION['modif1e'] = $kgcash1x;		$_SESSION['modif1d'] = $kgcash2x;
	unset ($_SESSION['modif2e']);			unset ($_SESSION['modif2d']);

	if(isset($_POST['modif_pro'])){
				$defaults = array ( 'kgcash1' => $kgcash1x,
									'kgcash2' => $kgcash2x,);
	}elseif(isset($_POST['modif_pro2'])){
				$defaults = array ( 'kgcash1' => $_SESSION['modif1e'],
									'kgcash2' => $_SESSION['modif1d'],);
	}
	global $KeyErrors;		$KeyErrors == 3;	global $LogText;

	require 'TableValidateErrors.php';

	$fil = "%".$_POST['producto']."%";
 	$sqlc = "SELECT * FROM $Productos WHERE `valor` LIKE '$fil' ";
	$qc = mysqli_query($db, $sqlc);
	
	$sqlx =  "SELECT * FROM $Secciones WHERE `valor` = '$_POST[vseccion]'";
	$q = mysqli_query($db, $sqlx);
	$rowseccion = mysqli_fetch_assoc($q);

		print ("<table align='center'>
				<tr style='font-size:14px'>
					<th colspan=12 class='BorderInf'>
							MODIFICARÁ EL PRODUCTO ".$_SESSION['oper']." 
					</th>
				</tr>
				<tr style='font-size:10px'>
					<th class='BorderInfDch'>REF CAJA</th>
					<th class='BorderInfDch'>REF CLIENT</th>
					<th class='BorderInfDch'>OPER SESION</th>
					<th class='BorderInfDch'>FECHA</th>	
					<th class='BorderInfDch'>SECCION</th>										
					<th class='BorderInfDch'>PRODUCTO</th>
					<th class='BorderInfDch'>STOCK</th>
					<th class='BorderInfDch'>CARRO</th>
					<th class='BorderInfDch'>IVA€</th>
					<th class='BorderInfDch'>PVP</th>
					<th class='BorderInfDch'></th>
					<th class='BorderInf'></th>
				</tr>");
				
		print("<tr align='center'>
			<form name='modifica'  action='$_SERVER[PHP_SELF]' method='POST'>
				<input name='id' type='hidden' value='".$_POST['id']."' />
				<input name='cname' type='hidden' value='".$_POST['cname']."' />
				<input name='proname' type='hidden' value='".$_POST['proname']."' />
				<input name='psiva' type='hidden' value='".$_POST['psiva']."' />
				<input name='iva' type='hidden' value='".$_POST['iva']."' />
					<td class='BorderInfDch' align='left'>
				<input name='refcaja' type='hidden' value='".$_POST['refcaja']."' />".$_POST['refcaja']."
					</td>
					<td class='BorderInfDch' align='left'>
				<input name='refclient' type='hidden' value='".$_POST['refclient']."' />".$_POST['refclient']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='oper' type='hidden' value='".$_POST['oper']."' />".$_POST['oper']."
					</td>
				<input name='nsemana' type='hidden' value='".$_POST['nsemana']."' />
					<td class='BorderInfDch' align='right'>
				<input name='datecash' type='hidden' value='".$_POST['datecash']."' />".$_POST['datecash']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='vseccion' type='hidden' value='".$_POST['vseccion']."' />".$_POST['vseccion']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='producto' type='hidden' value='".$_POST['producto']."' />".$_POST['producto']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='stock' type='hidden' value='".$_POST['stock']."' />".$_POST['stock']."
				<input name='stock1' type='hidden' value='".$stock1."' />
				<input name='stock2' type='hidden' value='".$stock2."' />
				<input name='kgcashx' type='hidden' value='".$_POST['kgcashx']."' />
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='kgcash1' type='number' size='6' maxlength='2' value='".$defaults['kgcash1']."' style='text-align:right' />
				,
				<input name='kgcash2' type='number' size='6' maxlength='2' value='".$defaults['kgcash2']."' />
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='ivae' type='hidden' value='".$_POST['ivae']."' />".$_POST['ivae']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='pvp' type='hidden' value='".$_POST['pvp']."' />".$_POST['pvp']."
					</td>
					<td class='BorderInfDch' align='right'>
				<input name='pvptot' type='hidden' value='".$_POST['pvptot']."' />".$_POST['pvptot']."
					</td>
					<td colspan=2 align='center' class='BorderInf'>
						<div style='float:left;margin-right:6px'>
							<input type='submit' value='MODIFICAR' />
							<input type='hidden' name='modif_pro2' value=1 />
						</div>
						</td>
				</form>
			</tr>");
					
		global $oper;		$oper = $_SESSION['oper'];
		if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';}
		else{ $LogText = $LogText.$_POST['producto']; }
		$LogText = $LogText."* MODIF PRO =>\t* SESSION OPER ".$oper."\t* REF CLIENTE ".$_POST['refclient']."\t* SECCION ".$_POST['vseccion']."\t* PRODUCTO ".$_POST['producto']."\t	* UNIT CAJA ".$_POST['kgcashx']."\t* PVP ".$_POST['pvp']."\t* PVPTOT ".$_POST['pvptot']."\n";
		print("</table>");
		
	}	// FIN process_form();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif_pro2(){
	global $db;		global $db_name;	
	require "../config/TablesNames.php";
	
	global $secc2;		$secc2 = ucwords($_POST['vseccion']);
	
	global $semana;		$semana = date('W');	
	global $date;		$date = date('Y-m-d');
	global $ATime;		$ATime = date('H:i:s');
	global $datecash;	$datecash = $date."/".$ATime;

	$kgcash1 = $_POST['kgcash1'];	
	$kgcash2 = $_POST['kgcash2'];
	global $kgcash;		$kgcash = $kgcash1.".".$kgcash2;

	$_SESSION['modif2e'] = $_POST['kgcash1'];
	$_SESSION['modif2d'] = $_POST['kgcash2'];
	
	global $kgcashold;
	$kgcashold = $_SESSION['modif1e'].".".$_SESSION['modif1d'];
	$kgcashold = trim($kgcashold);
	
	if(($_SESSION['modif2e'] > $_SESSION['modif1e'])&&($_SESSION['modif2d'] > $_SESSION['modif1d'])){
		print("** MAS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." > ".$kgcashold." = ".$mdf."</br>");
	}elseif(($_SESSION['modif2e'] > $_SESSION['modif1e'])&&($_SESSION['modif2d'] < $_SESSION['modif1d'])){
		print("** MAS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." > ".$kgcashold." = ".$mdf."</br>");
	}elseif(($_SESSION['modif2e'] == $_SESSION['modif1e'])&&($_SESSION['modif2d'] > $_SESSION['modif1d'])){
		print("** MAS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." > ".$kgcashold." = ".$mdf."</br>");
	}elseif(($_SESSION['modif2e'] > $_SESSION['modif1e'])&&($_SESSION['modif2d'] == $_SESSION['modif1d'])){
		print("** MAS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." > ".$kgcashold." = ".$mdf."</br>");
	}elseif(($_SESSION['modif2e'] < $_SESSION['modif1e'])&&($_SESSION['modif2d'] < $_SESSION['modif1d'])){
		print("* MENOS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." < ".$kgcashold." = ".$mdf."</br>");
	}elseif(($_SESSION['modif2e'] < $_SESSION['modif1e'])&&($_SESSION['modif2d'] > $_SESSION['modif1d'])){
		print("* MENOS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." < ".$kgcashold." = ".$mdf."</br>");
	}elseif(($_SESSION['modif2e'] == $_SESSION['modif1e'])&&($_SESSION['modif2d'] < $_SESSION['modif1d'])){
		print("* MENOS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." < ".$kgcashold." = ".$mdf."</br>");
	}elseif(($_SESSION['modif2e'] < $_SESSION['modif1e'])&&($_SESSION['modif2d'] == $_SESSION['modif1d'])){
		print("* MENOS COMPRA QUE ANTES. ");
		global $mdf;
		$mdf = $kgcash - $kgcashold;
		print("* ".$kgcash." < ".$kgcashold." = ".$mdf."</br>");
	}

	$pvp = $_POST['pvp'];	$pvp = floatval($pvp);	$pvp = number_format($pvp,2,".","");
	$pvptot = $kgcash * $pvp ;
	$pvptot = floatval($pvptot);		$pvptot = number_format($pvptot,2,".","");
	
	$_SESSION['pvptotold'] = $_POST['pvptot'];
	$pvptotold = $_POST['pvptot'];			$pvptotold = trim($pvptotold);		
	$pvptotold = floatval($pvptotold);		$pvptotold = number_format($pvptotold,2,".","");
	
	$cuadrapvptot = $pvptot - $pvptotold;
	$cuadrapvptot  = floatval($cuadrapvptot);	$cuadrapvptot  = number_format($cuadrapvptot,2,".","");
	
	$ivaop = $_POST['iva'];		$ivaop  = floatval($ivaop);		$ivaop  = number_format($ivaop ,2,".","");
	$ivae = $_POST['psiva'] * ($ivaop / 100);
	$ivae  = floatval($ivae);	$ivaop  = number_format($ivaop ,2,".","");
	$ivav = $ivae * $kgcash;	$ivav  = floatval($ivav);		$ivav  = number_format($ivav ,2,".","");

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 >HA MODIFICADO EL PRODUCTO</th>
				</tr>
				<tr>
					<td style='text-align:right'>SECCION</td><td>".$secc2."</td>
				</tr>
				<tr>
					<td style='text-align:right'>PRODUCT REF</td><td>".$_POST['producto']."</td>
				</tr>				
				<tr>
					<td style='text-align:right'>PRODUCT NAME</td><td>".$_POST['proname']."</td>
				</tr>				
				<tr>
					<td style='text-align:right'>UNIT VENTA</td><td>".$kgcash."</td>
				</tr>
				<tr>
					<td style='text-align:right'>PVP SIN IVA</td><td>".$_POST['psiva']." €</td>
				</tr>
				<tr>
					<td style='text-align:right'>TIPO IVA</td><td>".$_POST['iva']." %</td>
				</tr>
				<tr>
					<td style='text-align:right'>IVA €</td><td>".$ivav." €</td>
				</tr>
				<tr>
					<td style='text-align:right'>UNIT € PVP</td><td>".$_POST['pvp']." €</td>
				</tr>
				<tr>
					<td style='text-align:right'>CAJA TOT €</td><td>".$pvptot." €</td>
				</tr>
			</table>";	/* Final de la variable*/ 
		
	$oper = $_SESSION['oper'];

	$rc =  "SELECT * FROM $CajaShop WHERE `oper` = '$oper' ";
		//echo "* ".$rc,"<br>";
		$qrc = mysqli_query($db, $rc);
		$rowrc = mysqli_fetch_assoc($qrc);
		
	$sql = "UPDATE `$db_name`.$CajaShop SET `kgcash` = '$kgcash', `ivae` = '$ivav', `pvptot` = '$pvptot' WHERE `id` = '$_POST[id]' AND `oper` = '$oper'  LIMIT 1 ";
		
	global $LogText;
	if(mysqli_query($db, $sql)){ 
		print( $tabla );
		$oper = $_SESSION['oper'];
		if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';
		}else{ $LogText = $LogText.$_POST['producto'];}
		$LogText = $LogText."* MODIF PRO 2 =>\t* SESSION OPER ".$oper."\t* REF CLIENTE ".$_POST['refclient']."\t* SECCION ".$_POST['vseccion']."\t	* PRODUCTO ".$_POST['producto']."\t	* UNIT CAJA ".$kgcash."\t* PVP ".$_POST['pvp']."\t* PVPTOT ".$pvptot."\n";

	}else{ print("* ERROR SQL L.2666 ".mysqli_error($db)."</br>"); }
	
	/* SUMAN O RESTA COMPRA MODIFICADA A STOCKS	*/														
	global $db;		global $db_name;
	global $seccx;	$seccx = $_POST['vseccion'];	$seccx = "`".$seccx."`";
	global $refpro;	$refpro = $_POST['producto']; /* ref pro */

	$cs1 = "SELECT * FROM $Productos WHERE `valor` = '$refpro' AND `stock` > 0 ";
		$qcs1 = mysqli_query($db, $cs1);
		$rowcs1 = mysqli_fetch_assoc($qcs1);
	
	if(mysqli_num_rows($qcs1) > 0){
	/* SUMA O RESTA AL STOCK EL CARRO MODIFICADO */
		$cuadrastock = $rowcs1['kgcash'] + $mdf;
		$cuadrapvptot = $rowcs1['pvptot'] + $cuadrapvptot;
		$cuadrastock1 = $rowcs1['stock'] - $mdf;
	/* ACTUALIZO TABLA DE PRODUCTOS */
		$cs2 = "UPDATE `$db_name`.$Productos SET `ivae` = '$ivav', `kgcash` = '$cuadrastock', `stock` = '$cuadrastock1', `pvptot` = '$cuadrapvptot' WHERE $Productos.`valor` = '$refpro' AND `stock` > 0  LIMIT 1 ";
		if(mysqli_query($db, $cs2)){
			print("* MODIF PRO 2 ACTUALIZADO STOCK ".$seccx." ".$Productos."</br>" );
			$LogText = $LogText."\t* MODIF PRO 2 ACTUALIZADO STOCK ".$seccx." ".$Productos.".\n";
		}else{ print("* ERROR SQL L.2697 ".mysqli_error($db)."<br>"); }
	}else{ }

}	/* FIN modifica_pro2() */	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function elim_pro(){
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	global $semana;		$semana = date('W');	
	global $date;		$date = date('Y-m-d');
	global $ATime;		$ATime = date('H:i:s');
	global $datecash;	$datecash = $date."/".$ATime;
		
	$nkgcash = strlen(trim($_POST['kgcash']));
	$nkgcash = $nkgcash - 3;
	$kgcashx = $_POST['kgcash'];
	$kgcash1 = substr($_POST['kgcash'],0,$nkgcash);
	$kgcash2 = substr($_POST['kgcash'],-2,2);
	$kgcash = $kgcash1.",".$kgcash2;
		
	/*
	$fil = "%".$_POST['producto']."%";
 	$sqlc =  "SELECT * FROM $Productos WHERE `valor` LIKE '$fil' ";
		$qc = mysqli_query($db, $sqlc);
	
	$sqlx =  "SELECT * FROM $Secciones WHERE `valor` = '$_POST[vseccion]'";
		$q = mysqli_query($db, $sqlx);
		$rowseccion = mysqli_fetch_assoc($q);
	*/
	print("<table align='center'>
			<tr style='font-size:14px'>
				<th colspan=12 class='BorderInf'>
					ELIMINARÁ EL PRODUCTO EN ".$_SESSION['oper']." 
				</th>
			</tr>
			<tr style='font-size:10px'>
				<th class='BorderInfDch'>REF CAJA</th>					
				<th class='BorderInfDch'>REF CLIENT</th>
				<th class='BorderInfDch'>OPER SESION</th>					
				<th class='BorderInfDch'>FECHA</th>					
				<th class='BorderInfDch'>SECCION</th>										
				<th class='BorderInfDch'>PRODUCTO</th>
				<th class='BorderInfDch'>CARRO</th>
				<th class='BorderInfDch'>IVA€</th>
				<th class='BorderInfDch'>PVP</th>
				<th class='BorderInfDch'>SUBT</th>
				<th class='BorderInf'></th>
			</tr>");
				
		print (	"<tr align='center'>
		<form name='modifica'  action='$_SERVER[PHP_SELF]' method='POST'>
			<input name='id' type='hidden' value='".$_POST['id']."' />
			<input name='cname' type='hidden' value='".$_POST['cname']."' />
			<input name='proname' type='hidden' value='".$_POST['proname']."' />
			<input name='psiva' type='hidden' value='".$_POST['psiva']."' />
			<input name='iva' type='hidden' value='".$_POST['iva']."' />
					<td class='BorderInfDch' align='left'>
			<input name='refcaja' type='hidden' value='".$_POST['refcaja']."' />".$_POST['refcaja']."
					</td>
					<td class='BorderInfDch' align='left'>
			<input name='refclient' type='hidden' value='".$_POST['refclient']."' />".$_POST['refclient']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='oper' type='hidden' value='".$_POST['oper']."' />".$_POST['oper']."
					</td>
			<input name='nsemana' type='hidden' value='".$_POST['nsemana']."' />
					<td class='BorderInfDch' align='right'>
			<input name='datecash' type='hidden' value='".$_POST['datecash']."' />".$_POST['datecash']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='vseccion' type='hidden' value='".$_POST['vseccion']."' />".$_POST['vseccion']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='producto' type='hidden' value='".$_POST['producto']."' />".$_POST['producto']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='kgcash' type='hidden' value='".$_POST['kgcash']."' />".$_POST['kgcash']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='ivae' type='hidden' value='".$_POST['ivae']."' />".$_POST['ivae']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='pvp' type='hidden' value='".$_POST['pvp']."' />".$_POST['pvp']."
					</td>
					<td class='BorderInfDch' align='right'>
			<input name='pvptot' type='hidden' value='".$_POST['pvptot']."' />".$_POST['pvptot']."
					</td>
					<td colspan=2 align='center' class='BorderInf'>
						<div style='float:left;margin-right:6px'>
							<input type='submit' value='ELIMINAR PRODUCTO' />
							<input type='hidden' name='elim_pro2' value=1 />
						</div>
					</td>
			</form>
				</tr>");

		global $LogText;	global $oper;	$oper = $_SESSION['oper'];
		if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';
		}else{ $LogText = $LogText.$_POST['producto'];}
		$LogText = $LogText."* ELIMINAR PRO 01 =>* SESSION OPER ".$oper."\t* REF CLIENTE ".$_POST['refclient']."\t* SECCION ".$_POST['vseccion']."\t* PRODUCTO ".$_POST['producto']."\t* UNIT CAJA ".$_POST['kgcash']."\t* PVP ".$_POST['pvp']."\t* PVPTOT ".$_POST['pvptot']."\n";

		print("</table>");
		
	} // FINAL process_form();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function elim_pro2(){
	global $db;		global $db_name;	
	require "../config/TablesNames.php";
	
	global $semana;		$semana = date('W');	
	global $date;		$date = date('Y-m-d');
	global $ATime;		$ATime = date('H:i:s');
	global $datecash;	$datecash = $date."/".$ATime;
	
	$secc2 = ucwords($_POST['vseccion']);

	global $kgcash;					$kgcash = $_POST['kgcash'];
	$kgcash  = floatval($kgcash);	$kgcash = number_format($kgcash,2,".","");

	global $pvp;					$pvp = $_POST['pvp'];
	$pvp  = floatval($pvp);			$pvp = number_format($pvp,2,".","");
	global $pvptot;					$pvptot = $kgcash * $pvp ;
	$pvptot = floatval($pvptot);	$pvptot = number_format($pvptot,2,".","");
	
	global $ivaop;					$ivaop = $_POST['iva'];
	$ivaop = floatval($ivaop);		$ivaop = number_format($ivaop,2,".","");
	global $ivae;					$ivae = $_POST['psiva'] * ($ivaop / 100);
	$ivae = floatval($ivae);		$ivae = number_format($ivae,2,".","");
	global $ivav;					$ivav = $ivae * $kgcash;
	$ivav = floatval($ivav);		$ivav = number_format($ivav,2,".","");

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
								HA ELIMINADO EL PRODUCTO
					</th>
				</tr>
				<tr>
					<td>SECCION</td><td>".$secc2."</td>
					<td>PRODUCT REF</td><td>".$_POST['producto']."</td>
				</tr>				
				<tr>
					<td>PRODUCT NAME</td><td>".$_POST['proname']."</td>
					<td>UNIT VENTA</td><td>".$kgcash."</td>
				</tr>
				<tr>
					<td>PVP SIN IVA</td><td>".$_POST['psiva']." €</td>
					<td>TIPO IVA</td><td>".$_POST['iva']." %
					</td>
				</tr>
				<tr>
					<td>IVA €</td><td>".$ivav." €</td>
					<td>UNIT € PVP</td><td>".$_POST['pvp']." €</td>
				</tr>
				<tr>
					<td colspan='2'></td>
					<td>CAJA TOT €</td><td>".$pvptot." €</td>
				</tr>
			</table>";
		
	$oper = $_SESSION['oper'];

	$rx =  "SELECT * FROM `$db_name`.$CajaShop WHERE `oper` = '$oper' AND `id` = '$_POST[id]' LIMIT 1 ";
	$qrx = mysqli_query($db, $rx);
	$rowrx = mysqli_fetch_assoc($qrx);
	if($rowrx['ini'] == 1){
		$rx2 = "UPDATE `$db_name`.$CajaShop SET `ini` = '1' WHERE `oper` = '$oper' AND `ini` <> 1 LIMIT 1 ";
		if(mysqli_query($db, $rx2)){ }else{ }
	}else{ }

	$sql = "DELETE FROM `$db_name`.$CajaShop WHERE `id` = '$_POST[id]' AND `oper` = '$oper'  LIMIT 1 ";
		
	global $LogText;	global $oper;
	if(mysqli_query($db, $sql)){
		print( $tabla );
		$oper = $_SESSION['oper'];
		if($_POST['producto'] == ''){ $LogText = $LogText.'TODOS LOS PRODUCTOS';
		}else{ $LogText = $LogText.$_POST['producto'];}
		$LogText = $LogText."* ELIMINAR PRO 02 =>* SESSION OPER ".$oper."\t* REF CLIENTE ".$_POST['refclient']."\t* SECCION ".$_POST['vseccion']."\t* PRODUCTO ".$_POST['producto']."\t* UNIT CAJA ".$_POST['kgcash']."\t* PVP ".$_POST['pvp']."\t* PVPTOT ".$_POST['pvptot']."\n";
	}else{ print("* ERROR SQL L.2866 ".mysqli_error($db)."</br>"); }
	
		/* SUMAN COMPRA CANCELADA A STOCKS	*/														
		global $refpro;		$refpro = $_POST['producto']; /* ref pro */
		$cs1 = "SELECT * FROM $Productos WHERE `valor` = '$refpro' AND `stock` > 0 ";
		$qcs1 = mysqli_query($db, $cs1);
		$rowcs1 = mysqli_fetch_assoc($qcs1);
		
		if(mysqli_num_rows($qcs1) > 0){
			/* SUMA AL STOCK AL CARRO CANCELADO */
			$cuadrakgcash = $rowcs1['kgcash'] - $kgcash;
			$cuadrapvptot = $rowcs1['pvptot'] - $_POST['pvptot'];
			$cuadrastock = $rowcs1['stock'] + $kgcash;
			$cuadraivae = $rowcs1['ivae'] - $ivav;
		/* ACTUALIZO TABLA DE PRODUCTOS */
		$cs2 = "UPDATE `$db_name`.$Productos SET `ivae` = '$cuadraivae', `kgcash` = '$cuadrakgcash', `stock` = '$cuadrastock', `pvptot` = '$cuadrapvptot' WHERE $Productos.`valor` = '$refpro' AND `stock` > 0  LIMIT 1 ";

			if(mysqli_query($db, $cs2)){
				print( "* ELIM PRO 2 ACTUALIZADO STOCK ".$Productos." ".$Productos." ".$cuadrastock."</br>" );
				$LogText = $LogText."\t* ELIM PRO 2 ACTUALIZADO STOCK ".$Productos." ".$Productos.".\n";
			}else{ print("* ERROR SQL L.2890 ".mysqli_error($db)."<br>"); }

		}else{ }
		
	} /* FIN function elimina_pro2()  */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	if(!isset($_SESSION['oper'])){ $_SESSION['oper'] = $_SESSION['ref']; }else{ }

	print("<table align='center' style='border:0px; margin-top:4px;'>
			<tr>
				<td align='center'>* CAJA SESION ".$_SESSION['oper']."</td>
			</tr>
			<tr>
				<td>
					<div align='center' style='float:left; margin-right:6px'>
			<form name='init_compra' method='post' action='$_SERVER[PHP_SELF]'>
				<input type='submit' value='NUEVA COMPRA' />
				<input type='hidden' name='init_compra' value=1 />
			</form>	
					</div>	
					<div style='float:left;margin-right:6px'>
			<form name='recup_compra' method='post' action='$_SERVER[PHP_SELF]'>
						<input type='submit' value='RECUPERAR COMPRAS' />
						<input type='hidden' name='recup_compra' value=1 />
			</form>	
				</div>");
	
	if((isset($_POST['init_compra']))||(isset($_POST['recup_compra2']))||(isset($_POST['cancel_compra']))||(isset($_POST['selec_client']))||(isset($_POST['selec_pro']))||(isset($_POST['subtotal']))||(isset($_POST['modif_pro2']))||(isset($_POST['modif_pro']))||(isset($_POST['elim_pro']))||(isset($_POST['elim_pro2']))||(isset($_POST['selec_client2']))||(isset($_POST['oculto1']))||(isset($_POST['oculto']))||(isset($_POST['todocl']))||(isset($_POST['show_formcl']))||(isset($_POST['pago']))){
				print("</div>
					<!--
						<div style='float:left;margin-right:6px'>
							<form name='cancel_compra' method='post' action='$_SERVER[PHP_SELF]'>
								<input type='submit' value='CANCEL COMPRA' />
								<input type='hidden' name='cancel_compra' value=1 />
							</form>	
						</div>
					-->
						<div style='float:left;margin-right:6px'>
							<form name='selec_client' method='post' action='$_SERVER[PHP_SELF]'>
								<input type='submit' value='SELECCIONAR CLIENTE' />
								<input type='hidden' name='selec_client' value=1 />
								</form>	
						</div>
						<div style='float:left;margin-right:6px'>
							<form name='subtotal' method='post' action='$_SERVER[PHP_SELF]'>
								<input type='submit' value='SUBTOTAL' />
								<input type='hidden' name='subtotal' value=1 />
							</form>	
						</div>
					<td>
				</tr>");
	}else{ }
				
	print("</table>");
		
	global $ordenar;		global $producto;
	if(isset($_POST['oculto1'])){
		$defaults = $_POST;
		$defaults = array ('seccion' => $_POST['seccion'],
							'Orden' => $ordenar,
							'producto' => $producto,);
	}elseif(isset($_POST['oculto'])){
			$defaults = $_POST;
	}else{	$defaults = array ('seccion' => @$_POST['seccion'],
								'Orden' => $ordenar,
								'producto' => $producto, );
				}
	/*	*/								
	if((isset($_POST['init_compra']))||(isset($_POST['recup_compra2']))||(isset($_POST['cancel_compra']))||(isset($_POST['selec_client']))||(isset($_POST['selec_pro']))||(isset($_POST['subtotal']))||(isset($_POST['modif_pro2']))||(isset($_POST['modif_pro']))||(isset($_POST['elim_pro']))||(isset($_POST['elim_pro2']))||(isset($_POST['selec_client2']))||(isset($_POST['oculto1']))||(isset($_POST['oculto']))||(isset($_POST['todocl']))||(isset($_POST['show_formcl']))||(isset($_POST['pago']))){
	
		global $_SecName;		global $_SecValue;
		if(isset($_POST['seccion'])){
			$sqlx =  "SELECT * FROM $Secciones WHERE `valor` = '$_POST[seccion]'";
			$q = mysqli_query($db, $sqlx);
			$rowseccion = mysqli_fetch_assoc($q);
			$_SecName = $rowseccion['nombre'];
			$_SecValue = $rowseccion['valor'];
		}else{ }

		// SI NO HAY CLIENTE SE MUESTRA EL FORMULARIO PARA SELECCIONAR UN CLIENTE
		$oper = $_SESSION['oper'];
		$sqlClName =  "SELECT * FROM `$db_name`.$CajaShop WHERE `oper` = '$oper' AND `ini` = 1 AND `clname` = '' AND `refclient` = ''  LIMIT 1 ";
			$sqlClNameQry = mysqli_query($db, $sqlClName);
			$sqlClNumsRow = mysqli_num_rows($sqlClNameQry);
			//echo "** ".$sqlClNumsRow."<br>";
		global $KeyShowFormCl;		global $KeySubTotal;
		if((isset($_POST['modif_client']))||(isset($_POST['selec_client']))||(isset($_POST['recup_compra']))||(isset($_POST['show_formcl']))||(isset($_POST['todocl']))){
				$KeyShowFormCl = 1;
		}else{ $KeyShowFormCl = 0; }
		if(($sqlClNumsRow>0)&&($KeyShowFormCl<1)){ show_formcl();	$KeySubTotal = 1; }else{ }
		if(($KeyShowFormCl<1)&&(!isset($_POST['init_compra']))){
			$KeySubTotal = 0;
			print("<table align='center' style=\"border:0px;margin-top:4px\">
					<tr>
						<td>
						<div style='float:left'>
							<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
								<input type='submit' value='SELECCIONE UNA SECCION' />
								<input type='hidden' name='oculto1' value=1 />
						</div>
						<div style='float:left'>
				<select name='seccion'>");

			$sqlb =  "SELECT * FROM $Secciones ORDER BY `valor` ASC ";
			$qb = mysqli_query($db, $sqlb);
		
			if(!$qb){ print("* ERROR SQL L.3021 ".mysqli_error($db)."</br>");
			}else{
				while($rows = mysqli_fetch_assoc($qb)){
							print ("<option value='".$rows['valor']."' ");
							if($rows['valor'] == $defaults['seccion']){
												print ("selected = 'selected'");
									}
						print ("> ".$rows['nombre']." </option>");
						}
					} 
			print ("</select></div></form></td></tr></table>");	

			if((isset($_POST['oculto1']))||(isset($_POST['oculto']))){
				if($_POST['seccion'] == ''){ 
					print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
							<tr align='center'>
								<td><font color='red'><b>SELECCIONE UNA SECCION</font></td>
							</tr>
						</table>");
				}else{ }

				if ($_POST['seccion'] != ''){
				print("<table align='center' style='border:0px;margin-top:4px'>
						<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
							<tr>
							<td>
							<div style='float:left'>
								<input type='submit' value='SELECCIONE PRODUCTO' />
								<input type='hidden' name='oculto' value=1 />
							</div>
								<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
							<div style='float:left'>
								<select name='producto'>");

				global $db;		global $db_name;
				//$sqlp = "SELECT * FROM $Productos ORDER BY `valor` ASC ";
				$sqlp = "SELECT * FROM $Productos WHERE `vseccion` = '$_SecValue' ORDER BY `valor` ASC";
				$qp = mysqli_query($db, $sqlp);
				if(!$qp){
						print("* ERROR SQL L.3062 ".mysqli_error($db)."</br>");
				}else{
					while($rowp = mysqli_fetch_assoc($qp)){
						print ("<option value='".$rowp['valor']."' ");
							if($rowp['valor'] == $defaults['producto']){ print ("selected = 'selected'"); }
								print ("> ".$rowp['nombre']." </option>");
						}
				} 
			print ("</select></div></form></td></tr></table>"); 
					} // FIN IF SELECCIONE UN PRODUCTO
				} // FIN IF OCULTO1 OCULTO2
			} // FIN IF VER FORMULARIO SECCIONES
		}// // FIN PRIMER IF

	} // FIN function show_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function log_info(){

		global $LogText;
	
		global $text;	$text = "\n- CAJA CARRO: ".$LogText;
		
		require '../logs/LogInfo.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaindex;          $rutaindex = '../';
		global $rutaOut;            $rutaOut = $rutaindex.'../';
		require '../Inclu_Menu/rutaindex.php';
		global $caja;        $caja = '';
	
		require '../Inclu_Menu/Master_Index.php';
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	require '../Inclu/Inclu_Footer.php';
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>