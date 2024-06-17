<?php
session_start();

	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){
		print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
		master_index();
			if(isset($_POST['todo'])){ 	show_form();							
										ver_todo();
										accion_Ver_01();
				} else { show_form();
						 ver_todo(); }
		} else { require "../Inclu/AccesoDenegado.php";	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['todo'])){
		$defaults = $_POST;
		} 
	
	$ordenar = array (	'`nombreseccion` ASC' => 'Nombre Ascendente',
						'`nombreseccion` DESC' => 'Nombre Descendente',
						'`id` ASC' => 'ID Ascendente',
						'`id` DESC' => 'ID Descendente',
						'`valortabla` ASC' => 'Valor Ascenedente',
						'`valortabla` DESC' => 'Valor Descendente',
					);

	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>VER NOMBRE DE TABLAS</th>
				</tr>
			<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<tr>
					<td align='center'>
						<input type='submit' value='VER TABLAS' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>Ordenar Por:</td>
					<td>
		<select name='Orden'>");
				foreach($ordenar as $option => $label){
					print ("<option value='".$option."' ");
					if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
													print ("> $label </option>");
												}	
		print ("</select>
					</td></tr>
				</form></table>"); 
	
			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $orden;
	if(!isset($_POST['Orden'])){
		$orden = "`id` ASC";
	} else { $orden = $_POST['Orden']; }

	require "../config/TablesNames.php";
	$sqlb =  "SELECT * FROM $nametables ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb) < 2){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>.");
									

				} else { 	$nunrows = (mysqli_num_rows($qb) - 1);
							print ("<table align='center'>
									<tr>
										<th colspan=3 class='BorderInf'>
									NUMERO DE TABLAS ".$nunrows."
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											VALOR TABLA
										</th>
										
										<th class='BorderInf'>
											NOMBRE SECCION
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			
	if ($rowb['valortabla'] == ''){}
				
				
	elseif($rowb['valortabla'] != ''){	
										
			print (	"<tr align='center'>
									
						<td class='BorderInfDch'>
													".$rowb['id']."
						</td>
						
						<td class='BorderInfDch' align='left'>
													".$rowb['valortabla']."
						</td>
						
						<td class='BorderInf' align='left'>
													".$rowb['nombreseccion']."
						</td>
							
										</tr>
										
									");
					
				}	/* FIN DEL CONDICIONAL ELSEIF */
					} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///
	
	function master_index(){
		
				require '../Inclu/Master_Index_Secciones.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Ver_01(){

	global $db;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = "- VER TABLAS TODAS ".$ActionTime."\n";
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