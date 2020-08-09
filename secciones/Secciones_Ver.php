<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';

		require '../Conections/conection.php';

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

								if($_POST['todo']){
										show_form();							
										ver_todo();
										accion_Ver_01();
										}
								
								else {
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

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if($_POST['todo']){
		$defaults = $_POST;
		} 
	
	$ordenar = array (	'`id` ASC' => 'ID Ascendente',
						'`id` DESC' => 'ID Descendente',
						'`nombre` ASC' => 'Nombre Ascendente',
						'`nombre` DESC' => 'Nombre Descendente',
						'`valor` ASC' => 'Valor Ascenedente',
						'`valor` DESC' => 'Valor Descendente',
																);

	print("
			<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>
						VER SECCIONES
					</th>
				</tr>
				
			<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center'>
						<input type='submit' value='VER SECCIONES' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>	
						Ordenar Por:
					</td>
					<td>

						<select name='Orden'>");
				
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("	</select>
					</td>
				</tr>
		
		</form>														
			
			</table>				
				"); 
	
			}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;

	$orden = $_POST['Orden'];

	$sqlb =  "SELECT * FROM `secciones` ORDER BY $orden ";
 	
	$qb = mysqli_query($db, $sqlb);
	
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
									

				} else { $nunrows = (mysqli_num_rows($qb) - 1);
							print ("<table align='center'>
									<tr>
										<th colspan=3 class='BorderInf'>
									SECCIONES : ".$nunrows."
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											VALOR
										</th>
										
										<th class='BorderInf'>
											NOMBRE
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
	if ($rowb['valor'] == '0'){}
				
	elseif($rowb['valor'] !== '0'){	
										
										
			print (	"<tr align='center'>
									
						<td class='BorderInfDch'>
													".$rowb['id']."
						</td>
						
						<td class='BorderInfDch' align='left'>
													".$rowb['valor']."
						</td>
						
						<td class='BorderInf' align='left'>
													".$rowb['nombre']."
						</td>
							
										</tr>
										
									");
	} /* FIN DEL CONDICIONAL ELSEIF*/
				} /* Fin del while.*/ 

						print("</table>");

						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Ver_01(){

	global $db;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	$logname = $_SESSION['Nombre'];	
	$logape = $_SESSION['Apellidos'];	
	$logname = trim($logname);	
	$logape = trim($logape);	
	$logdocu = $logname."_".$logape;
	$logdate = date('Y_m_d');
	$logtext = "- SECCIONES VER TODAS ".$ActionTime."\n";
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