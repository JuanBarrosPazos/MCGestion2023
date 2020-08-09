<?php
session_start();
 
		require 'Inclu/Inclu_Menu_00.php';

		require 'Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////

	$sql =  "SELECT * FROM `clientes` WHERE `Usuario` = '$_POST[Usuario]' AND `Password` = '$_POST[Password]'";
 	
	$q = mysqli_query($db, $sql);
	
	$row = mysqli_fetch_assoc($q);
	
	global $userid;
	global $uservisita;

	$_SESSION['ID'] = $row['ID'];
	$_SESSION['ref'] = $row['ref'];
	$_SESSION['Nivel'] = $row['Nivel'];
	$_SESSION['Nombre'] = $row['Nombre'];
	$_SESSION['Apellidos'] = $row['Apellidos'];
	$_SESSION['dni'] = $row['dni'];
	$_SESSION['ldni'] = $row['ldni'];
	$_SESSION['myimg'] = $row['myimg'];
	$_SESSION['Email'] = $row['Email'];
	$_SESSION['Usuario'] = $row['Usuario'];
	$_SESSION['Password'] = $row['Password'];
	$_SESSION['Direccion'] = $row['Direccion'];
	$_SESSION['Tlf1'] = $row['Tlf1'];
	$_SESSION['Tlf2'] = $row['Tlf2'];
	$_SESSION['lastin'] = $row['lastin'];
	$_SESSION['lastout'] = $row['lastout'];
	$_SESSION['visitadmin'] = $row['visitadmin'];
	
	$userid = $_SESSION['ID'];
	$uservisita = $_SESSION['visitadmin'];
	
///////////////////////////////////////////////////////////////////////////////////////////////
					
				if($_POST['oculto']){
					
						if($form_errors = validate_form()){
							suma_denegado ();
							show_form($form_errors);
								} else {
										admin_entrada();
										suma_acces();
										process_form();
									}
					 
					} 	
						elseif ($_POST['salir']){
												salir();
												show_form();
					}
						else {
								suma_visit();	
								show_form();
												}
				
/////////////////////////////////////////////////////////////////////////////////////////////////

function admin_entrada(){

	global $db;
	global $db_name;
	global $userid;
	global $uservisita;

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	$total = $uservisita + 1;
	$datein = date('Y-m-d/H:i:s');

	$sqladin = "UPDATE `$db_name`.`clientes` SET `lastin` = '$datein', `visitadmin` = '$total' WHERE `clientes`.`ID` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladin)){
			// print("* ");
				} else {
				print("</br>
				<font color='#FF0000'>
		* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."
				</br>";
							}
					
$logname = $_SESSION['Nombre'];	
$logape = $_SESSION['Apellidos'];	
$logname = trim($logname);	
$logape = trim($logape);	
$logdocu = $logname."_".$logape;
$logdate = date('Y_m_d');
$logtext = "\n** INICIO SESION => .".$datein.".\n \t User Ref: ".$_SESSION['ref'].".\n \t ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."\n \n";
$filename = "logs/".$dir."/".$logdate."_".$logdocu.".log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
	fclose($log);

	} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function show_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	
	$sqlv =  "SELECT * FROM `visitas`";
	$qv = mysqli_query($db, $sqlv);
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;

	$idv = 69;

	if(mysqli_query($db, $sqlv)){
			print(" 			
						<div style='clear:both'></div>
			
					<table align='right' style='margin-top:0px'>
		
						<tr>	
							<td align='right'>
								<font color='#59746A'>
									VISITAS:
								</font>
							</td>
							<td  align='right'>
								<font color='#59746A'>
														".$tot."
								</font>
							</td>
						</tr>
						
						<tr>
							<td>
								<font color='#59746A'>
									ACCESOS PERMITIDOS:
								</font>
							</td>
							<td align='right'>
								<font color='#59746A'>
														".$rowv['acceso']."
								</font>
							</td>
						</tr>

						<tr>
							<td>
								<font color='#59746A'>
									ACCESOS DENEGADOS:
								</font>
							</td>
							<td align='right'>
								<font color='#59746A'>
														".$rowv['deneg']."
								</font>
							</td>
							
						</tr>
					</table>
					</br>
								");
										} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						</br>");
						
							}

								}

/////////////////////////////////////////////////////////////////////////////////////////////////

function suma_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	

	$sqlv =  "SELECT * FROM `visitas`";
	$qv = mysqli_query($db, $sqlv);
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;

	$idv = 69;
	
	$sqlv = "UPDATE `$db_name`.`visitas` SET `admin` = '$sumavisit' WHERE `visitas`.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqlv)){
		/**/	print(" </br>");
										} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						</br>");
						
							}
								}

/////////////////////////////////////////////////////////////////////////////////////////////////

function suma_acces(){

	global $db;
	global $db_name;
	global $rowa;
	global $sumaacces;
	
	$sqla =  "SELECT * FROM `visitas`";
	$qa = mysqli_query($db, $sqla);
	
	$rowa = mysqli_fetch_assoc($qa);
	
	$_SESSION['acceso'] = $rowa['acceso'];
	
	$tota = $rowa['acceso'];

	global $sumaacces;
	$sumaacces = $tota + 1;

	
	$idv = 69;
	
	
	$sqla = "UPDATE `$db_name`.`visitas` SET `acceso` = '$sumaacces' WHERE `visitas`.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){ print ('</br>');
													} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						</br>");
						
							}

								}

/////////////////////////////////////////////////////////////////////////////////////////////////

function suma_denegado(){

	global $db;
	global $db_name;
	global $rowd;
	global $sumadeneg;

	$sqld =  "SELECT * FROM `visitas`";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);
	
	$_SESSION['deneg'] = $rowd['deneg'];
	
	$dng = $rowd['deneg'];
	
	global $sumadeneg;
	$sumadeneg = $dng + 1;
	
	$idd = 69;
	
	$sqld = "UPDATE `$db_name`.`visitas` SET `deneg` = '$sumadeneg' WHERE `visitas`.`idv` = '$idd' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){
		/**/	print("	</br>");
										} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						</br>");
						
							}

								}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	
	$errors = array();
	
	if (strlen(trim($_POST['Usuario'])) == 0){
		$errors [] = "Usuario: Campo obligatorio.";
		}
	
	if (strlen(trim($_POST['Password'])) == 0){
		$errors [] = "Password: Campo Obligatorio:";
		}
		
	global $sql;
 	
	global $q;
	
	global $row;
	
	if(trim($_POST['Usuario'] != $row['Usuario'])){
		$errors [] = "Nombre o Password incorrecto.";
		}
	
	elseif(trim($_POST['Password'] != $row['Password'])){
		$errors [] = "Nombre o Password incorrecto.";
		}

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
					
if ($_SESSION['Nivel'] == 'cliente'){				 
print("WELLCOME ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].". REF CLIENT: ".$_SESSION['ref']);
	
			master_index();
								
	global $db;
	
	global $nombre;
	global $apellido;
	
	$nombre = $_SESSION['Nombre'];
	$apellido = $_SESSION['Apellidos'];
	
		
	$sqlc =  "SELECT * FROM `clientes` WHERE `Nombre` = '$nombre' AND `Apellidos` = '$apellido'  ";
 	
	$qc = mysqli_query($db, $sqlc);
	
	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
					
			show_form();	
			
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

				} else { print ("<table align='center' style='margin-top:20px'>
									
								<tr>
									<td align='center' colspan='10' class='BorderInf'>
												ESTOS SON SUS DATOS DE USUARIO
									</td>
								</tr>
								
									<tr>
										<th class='BorderInfDch'>
											Referencia
										</th>
										
										<th class='BorderInfDch'>
											Nivel
										</th>
										
										<th class='BorderInfDch'>
											Nombre
										</th>
										
										<th class='BorderInfDch'>
											Apellidos
										</th>
										
										<th class='BorderInfDch'>
										</th>
										
										<th class='BorderInfDch'>
											Docu
										</th>
										
										<th class='BorderInf'>
											N&uacute;mero
										</th>
										
										<th class='BorderInfDch'>
										</th>
										
										<th class='BorderInfDch'>
											Usuario
										</th>
										
										<th class='BorderInf'>
											Password
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
				
			print (	"<tr align='center'>
									
	<form name='ver' action='clientes/Cliente_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=610px')\">

		<input name='ID' type='hidden' value='".$rowc['ID']."' />
		<input name='Email' type='hidden' value='".$rowc['Email']."' />
		<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
		<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
		<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
		<input name='lastin' type='hidden' value='".$rowc['lastin']."' />
		<input name='lastout' type='hidden' value='".$rowc['lastout']."' />
		<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />
		
						<td class='BorderInfDch'>
		<input name='ref' type='hidden' value='".$rowc['ref']."' />".$rowc['ref']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='Nivel' type='hidden' value='".$rowc['Nivel']."' />".$rowc['Nivel']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />".$rowc['Nombre']."
						</td>
							
						<td class='BorderInfDch'>
		<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />".$rowc['Apellidos']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
		<img src='Admin_clientes/img_cliente/".$rowc['myimg']."' height='40px' width='30px' />
						</td>
												
						<td class='BorderInfDch'>
		<input name='doc' type='hidden' value='".$rowc['doc']."' />".$rowc['doc']."
						</td>
													
						<td class='BorderInf'>
		<input name='dni' type='hidden' value='".$rowc['dni']."' />".$rowc['dni']."
						</td>
													
						<td class='BorderInfDch'>
		<input name='ldni' type='hidden' value='".$rowc['ldni']."' />".$rowc['ldni']."
						</td>
													
						<td class='BorderInfDch'>
		<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />".$rowc['Usuario']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='Password' type='hidden' value='".$rowc['Password']."' />".$rowc['Password']."
						</td>
						
					</tr>
					
					<tr>
						<td colspan=4 class='BorderInf'>
										&nbsp;
						</td>
						<td colspan=2 align='center' class='BorderInfDch'>
										<input type='submit' value='VER DETALLES' />
										<input type='hidden' name='oculto2' value=1 />
	</form>

				<td colspan=2 align='center' class='BorderInf'>
						
	<form name='modifica_dat' action='clientes/Cliente_Modificar_02.php' method='POST'\">
	
			<input name='ID' type='hidden' value='".$rowc['ID']."' />
			<input name='ref' type='hidden' value='".$rowc['ref']."' />
			<input name='Nivel' type='hidden' value='".$rowc['Nivel']."' />
			<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />
			<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />
			<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
			<input name='doc' type='hidden' value='".$rowc['doc']."' />
			<input name='dni' type='hidden' value='".$rowc['dni']."' />
			<input name='ldni' type='hidden' value='".$rowc['ldni']."' />
			<input name='Email' type='hidden' value='".$rowc['Email']."' />
			<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />
			<input name='Password' type='hidden' value='".$rowc['Password']."' />						
			<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
			<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
			<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
			<input name='lastin' type='hidden' value='".$rowc['lastin']."' />
			<input name='lastout' type='hidden' value='".$rowc['lastout']."' />
			<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />

										<input type='submit' value='MODIFICAR DATOS' />
										<input type='hidden' name='oculto2' value=1 />
	
	</form>

		</td>	
				</td>
	
				<td colspan=2 align='center' class='BorderInf'>
						
	<form name='modifica_img' action='clientes/Cliente_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px,height=560px')\">

			<input name='ID' type='hidden' value='".$rowc['ID']."' />
			<input name='ref' type='hidden' value='".$rowc['ref']."' />
			<input name='Nivel' type='hidden' value='".$rowc['Nivel']."' />
			<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />
			<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />
			<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
			<input name='doc' type='hidden' value='".$rowc['doc']."' />
			<input name='dni' type='hidden' value='".$rowc['dni']."' />
			<input name='ldni' type='hidden' value='".$rowc['ldni']."' />
			<input name='Email' type='hidden' value='".$rowc['Email']."' />
			<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />
			<input name='Password' type='hidden' value='".$rowc['Password']."' />						
			<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
			<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
			<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
			<input name='lastin' type='hidden' value='".$rowc['lastin']."' />
			<input name='lastout' type='hidden' value='".$rowc['lastout']."' />
			<input name='visitadmin' type='hidden' value='".$rowc['visitadmin']."' />

										<input type='submit' value='MODIFICAR IMAGEN' />
										<input type='hidden' name='oculto2' value=1 />
			</form>

		</td>	
					</tr>");
								} /* Fin del while.*/ 

						print("</table>");

						} /* Fin segundo else anidado en if */
		
			} /* Fin de primer else . */
					}	else { 
					
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
				
	}	/* Final process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array ('Usuario' => '',
								   'Password' => '');
								   }
	
	if ($errors){
		print("<font color='#FF0000'>Solucione estos errores:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* Campo </font>".$errors [$a]."</br>");
			}
		}
		
	print("".show_visit()."
			
			<div style='clear:both'></div>
			
			<table align='center' style=\"margin-top:2px; margin-bottom:8px\" >
				<tr>
					<th colspan=2 width=100% valign=\"bottom\" class='BorderInf'>
						<a href='clientes/Cliente_Crear.php'>
							CREAR NUEVO CLIENTE
						</a>
					</th>
				</tr>
				
				<tr>
					<th colspan=2 width=100% valign=\"bottom\" class='BorderInf'>
						DATOS DE ACCESO CLIENTE
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td>	
						USUARIO
					</td>
					<td>
<input type='Password' name='Usuario' size=20 maxlength=50 value='".$defaults['Usuario']."' />
					</td>
				</tr>
	
				<tr>
					<td>	
						PASSWORD
					</td>
					<td>
<input type='Password' name='Password' size=20 maxlength=50 value='".$defaults['Password']."' />
					</td>
				</tr>
	
				<tr>
					<td valign='middle' align='right' colspan='2'>
						<input type='submit' class='submit' value='ACCEDER' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					
				</tr>
				
		</form>	
				<tr>
					<th colspan=2 width=100% valign=\"bottom\" class='BorderSup'>
						<a href='Admin_index.php'>
							ACCESO ADMINISTRACION SISTEMA
						</a>
					</th>
				</tr>
				
					
			</table>
			
				"); 
	
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){

		require 'Inclu/Master_In_Clientes_00.php';
		
				}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='clientes/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
			
	function salir() {	unset($_SESSION['ID']);
						unset($_SESSION['Nivel']);
						unset($_SESSION['Nombre']);
						unset($_SESSION['Apellidos']);
						unset($_SESSION['dni']);
						unset($_SESSION['ldni']);
						unset($_SESSION['Email']);
						unset($_SESSION['Usuario']);
						unset($_SESSION['Password']);
						unset($_SESSION['Direccion']);
						unset($_SESSION['Tlf1']);
						unset($_SESSION['Tlf2']);
						unset($_SESSION['ref']);
						unset($_SESSION['myimg']);
						unset($_SESSION['lastin']);
						unset($_SESSION['lastout']);
						unset($_SESSION['visitadmin']);
				print("Se ha cerrado la sesión.</br>");
			}
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require 'Inclu/Inclu_Footer_01.php';

?>