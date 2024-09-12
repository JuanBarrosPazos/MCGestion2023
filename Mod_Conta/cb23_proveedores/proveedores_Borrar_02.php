<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		//print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
		master_index();

		if (isset($_POST['oculto2'])){
								show_form();
								DelTemp();
								info_01();
		} elseif(isset($_POST['borra'])){
							process_form();
							info_02();
			} else { show_form(); }

	} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $PersonsBlackTit;	$PersonsBlackTit = "VER TODOS LOS PROVEEDORES";
	require '../Inclu/BotoneraVar.php';
	global $closeButton;

	print("<table class='tableForm' >
			<tr>
				<th colspan=3 >HA BORRADO AL PROVEEDOR</th>
			</tr>
			<tr>
				<td style='width: 120px; text-align: right;' >RAZON SOCIAL</td>
				<td style='width: 120px;' >".$_POST['rsocial']."</td>
				<td rowspan='4' style='width: 100px; text-align: center;' >
		<img src='../cb23_Docs/img_proveedores/".$_POST['myimg']."' height='120px' width='90px' />
				</td>
			</tr>
			<tr>
				<td style='text-align: right;' >DOCUMENTO</td><td>".$_POST['doc']."</td>
			</tr>				
			<tr>
				<td style='text-align: right;' >NUMERO</td><td>".$_POST['dni']."</td>
			</tr>				
			<tr>
				<td style='text-align: right;' >CONTROL</td><td>".$_POST['ldni']."</td>
			</tr>				
			<tr>
				<td style='text-align: right;' >MAIL</td><td colspan='2'>".$_POST['Email']."</td>
			</tr>
			<tr>
				<td style='text-align: right;' >REFERENCIA</td><td colspan='2'>".$_POST['ref']."</td>
			</tr>
			<tr>
				<td style='text-align: right;' >PAIS</td><td colspan='2'>".$_POST['Direccion']."</td>
			</tr>
			<tr>
				<td style='text-align: right;' >TELEFONO 1</td><td>".$_POST['Tlf1']."</td>
			</tr>
			<tr>
				<td style='text-align: right;' >TELEFONO 2</td><td colspan='2'>".$_POST['Tlf2']."</td>
			</tr>
			<tr>
				<td colspan='3' style='text-align: right;' >
				".$PersonsBlack."
					<a href='proveedores_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
				".$closeButton."
	
				</td>
			</tr>
		</table>" );

		global $db; 		global $db_name;	
		global $vname; 		$vname = "`".$_SESSION['clave']."proveedoresfeed`";
		
		$sql = "INSERT INTO `$db_name`.$vname (`ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$_POST[ref]', '$_POST[rsocial]', '$_POST[myimg]', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
		if(mysqli_query($db, $sql)){

			global $vnamed; 		$vnamed = "`".$_SESSION['clave']."proveedores`";
			$sqld = "DELETE FROM `$db_name`.$vnamed WHERE $vnamed.`id` = '$_POST[id]' LIMIT 1 ";
			if(mysqli_query($db, $sqld)){
				// NADA
			}else{
				print("</br><font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 87: </font></br> ".mysqli_error($db))."</br>";
				show_form ();
				global $texerror; 		$texerror = "\n\t ".mysqli_error($db);
			}

		} else { print("</br><font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 83: </font></br> ".mysqli_error($db))."</br>";
					show_form ();
					global $texerror; 		$texerror = "\n\t ".mysqli_error($db);
				}
				
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='proveedores_Ver.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);

	} // FIN function process_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function DelTemp(){

		//$delTempImg = "../cb23_Docs/temp/".$_POST['myimg'];
		//if( file_exists($delTempImg)){unlink($delTempImg);}

		global $ruta; 	$ruta ="../cb23_Docs/temp/";
		//print("RUTA: ".$ruta.".</br>");
		global $rutag; 	$rutag = "../cb23_Docs/temp/{*}";
		//print("RUTA G: ".$rutag.".</br>");
		$directorio = opendir($ruta);
		global $num; 	$num=count(glob($rutag,GLOB_BRACE));

		if($num > 0){

			$DirTemp = "../cb23_Docs/temp";
			if(file_exists($DirTemp)){ 
					$dir1 = $DirTemp."/";
					$handle1 = opendir($dir1);
					// BORRA LOS ARCHIVOS DENTRO DEL DIRECTORIO
					while ($file1 = readdir($handle1)){
						if (is_file($dir1.$file1)){unlink($dir1.$file1);}
									}
						//rmdir ($DirTemp); // BORRA EL DIRECTORIO
			} else {}
			
		}else{ }
	
	} // FIN function DelTemp()


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){
	
	$_SESSION['xid'] = $_POST['id'];

	global $DeleteWhiteTit;		$DeleteWhiteTit = "BORRAR DATOS PROVEEDOR";
	global $PersonsBlackTit;	$PersonsBlackTit = "VER TODOS LOS PROVEEDORES";
	require '../Inclu/BotoneraVar.php';
	global $closeButton;

	print("
			<table class='tableForm' >
				<tr>
					<th colspan=3 >BORRARÁ EL PROVEEDOR</th>
				</tr>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td style='width:120px; text-align:right;'>ID</td>
					<td style='width:120px;'>
			<input type='hidden' name='id' value='".$_POST['id']."' />".$_POST['id']."
					</td>
					<td rowspan='4' style='width:100px; text-align:center;'>
			<input type='hidden' name='myimg' value='".$_POST['myimg']."' />
			<img src='../cb23_Docs/img_proveedores/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >REFERENCIA</td>
					<td>
			<input type='hidden' name='ref' value='".$_POST['ref']."' />".$_POST['ref']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >RAZON SOCIAL</td>
					<td>
			<input type='hidden' name='rsocial' value='".$_POST['rsocial']."' />".$_POST['rsocial']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >DOCUMENTO</td>
					<td>
			<input type='hidden' name='doc' value='".$_POST['doc']."' />".$_POST['doc']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >NÚMERO</td>
					<td colspan=2>
			<input type='hidden' name='dni' value='".$_POST['dni']."' />".$_POST['dni']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >CONTROL</td>
					<td colspan=2>
			<input type='hidden' name='ldni' value='".$_POST['ldni']."' />".$_POST['ldni']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >MAIL</td>
					<td colspan=2>
			<input type='hidden'' name='Email' value='".$_POST['Email']."' />".$_POST['Email']."
					</td>
				</tr>	
				<tr>
					<td style='text-align:right;' >DIRECCIÓN</td>
					<td colspan=2>
			<input type='hidden' name='Direccion' value='".$_POST['Direccion']."' />".$_POST['Direccion']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >TELÉFONO 1</td>
					<td colspan=2>
			<input type='hidden' name='Tlf1' value='".$_POST['Tlf1']."' />".$_POST['Tlf1']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;' >TELÉFONO 2</td>
					<td colspan=2>
			<input type='hidden' name='Tlf2' value='".$_POST['Tlf2']."' />".$_POST['Tlf2']."
					</td>
				</tr>
				<tr>
					<td colspan='3'  align='right' valign='middle' >
				<!--
					<input type='submit' value='BORRAR DATOS' class='botonrojo' />
				-->
				".$DeleteWhite.$closeButton."
						<input type='hidden' name='borra' value=1 />
		</form>	
				".$PersonsBlack."													
					<a href='proveedores_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
				".$closeButton."
					</td>
				</tr>
			</table>"); /* Fin del print */
	
	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaProveedores;	$rutaProveedores = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	global $db;
	global $orden;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cb23_Docs/log";
				}

	global $text;
	$text = "\n- PROVEEDOR ELIMINAR SELECCIONADO ".$ActionTime.".\n\tID: ".$_SESSION['xid'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".\n\tEmail: ".$_POST['Email'].".\n\tDireccion: ".$_POST['Direccion'].".\n\tTlf 1: ".$_POST['Tlf1'].".\n\tTlf 2: ".$_POST['Tlf2'].".";			

	global $texerror;
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $db;
	global $orden;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cb23_Docs/log";
				}

	global $text;
	$text = "\n- PROVEEDOR ELIMINADO ".$ActionTime.".\n\tID: ".$_SESSION['xid'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".\n\tEmail: ".$_POST['Email'].".\n\tDireccion: ".$_POST['Direccion'].".\n\tTlf 1: ".$_POST['Tlf1'].".\n\tTlf 2: ".$_POST['Tlf2'].".";			

	global $texerror;
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
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

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>