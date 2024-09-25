<?php
session_start();
 
	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if(($_SESSION['Nivel']=='admin')||($_SESSION['Nivel']=='user')||($_SESSION['Nivel']=='plus')||($_SESSION['Nivel']=='cliente')||($_SESSION['Nivel']=='caja')){
 		
	if(isset($_POST['salir'])){ UserLog();
							  	salir();
	}elseif($_POST['cerrar']){  master_index();
								desconex(); }

}else{ require '../Inclu/table_permisos.php';}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function UserLog(){

	global $db; 		global $db_name;

	global $userid; 	$userid = $_SESSION['id'];

	global $dateadout; 	$dateadout = date('Y-m-d H:i:s');
	global $dir;		global $logdocu;
	global $table_name;	global $logdate;	
	if(($_SESSION['Nivel']=='cliente')||($_SESSION['Nivel']=='caja')){
			$logdate = date('Y_m_d');			
			$table_name = "`".$_SESSION['clave']."clientesweb`";
			$logdocu = trim($_SESSION['Nombre'])."_".trim($_SESSION['Apellidos']);
			$dir = "../../Mod_Gestion/logs/Clientes";
	}else{
		$logdate = date('Y_m_d');
		$table_name = "`".$_SESSION['clave']."admin`";
		$logdocu = $_SESSION['ref'];
		$dir = "../Users/".$_SESSION['ref']."/log";
	}

	$SqlAdminOut = "UPDATE `$db_name`.$table_name SET `lastout` = '$dateadout' WHERE $table_name.`id` = '$userid' LIMIT 1 ";
	if(mysqli_query($db, $SqlAdminOut)){ 
	}else{ 
		print("</br><font color='#F1BD2D'>* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."</br>";
	}
	
	global $ActionTime;		$ActionTime = date('H:i:s');
	global $LogText;
	$LogText = "** ".$ActionTime.PHP_EOL."\t ** CIERRE SESION USUARIO: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']." => ".$dateadout.PHP_EOL."\t\tREFERENCIA: ".$_SESSION['ref']." NIVEL: ".$_SESSION['Nivel'].PHP_EOL;

	// PASA LOG A MOD_ADMIN O MOD_GESTION CLIENTE
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $LogText);
		fclose($log);

	// PASA LOG AL SISTEMA SOLO INICIO Y CIERRE DE SESION...
		$filename = "../LogsAcceso/LogsAcceso_".$logdate.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $LogText);
		fclose($log);

} // FIN FUNCION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function desconex(){

		print("<table style='margin:8.0em auto 8.0em auto; border:none !important;' >
					<form name='salir' action='$_SERVER[PHP_SELF]' method='post'>
						<tr>
							<td valign='bottom' align='center'>
				<input type='submit' value='CONFIRME CERRAR SESION' class='botonverde' />
							<input type='hidden' name='salir' value=1 />
					</form>	
							</td>
						</tr>								
				</table>
		<embed src='../audi/sesion_close_confirm.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
		</embed>");
	
			} 
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function salir() {	

	print("<table align='center' style='text-align:center; border:none !important;'>
				<tr>
					<th>
						HA CERRADO SESION
					</th>
				</tr>
	<embed src='../audi/sesion_close.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>
			</table>");
			
		global $RedirUrl;	
		if(($_SESSION['Nivel']=='cliente')||($_SESSION['Nivel']=='caja')){ 
				$RedirUrl = "../../Mod_Gestion/index.php";
		}else{ $RedirUrl = "../index.php?salir=1"; }
		global $redir;
		$redir = "<script type='text/javascript'>
					function redir(){ window.location.href='".$RedirUrl."'; }
					setTimeout('redir()',6000);
				</script>";
		print ($redir);

		unset($_SESSION['id']);				unset($_SESSION['ref']);
		unset($_SESSION['Nivel']);			unset($_SESSION['Nombre']);
		unset($_SESSION['Apellidos']); 		unset($_SESSION['dni']);
		unset($_SESSION['ldni']);			unset($_SESSION['Email']);
		unset($_SESSION['Usuario']);		unset($_SESSION['Password']);
		unset($_SESSION['Direccion']);		unset($_SESSION['Tlf1']);
		unset($_SESSION['Tlf2']);			unset($_SESSION['myimg']);
		unset($_SESSION['lastin']);			unset($_SESSION['lastout']);
		unset($_SESSION['visitadmin']);		unset($_SESSION['GestMyImg']);
		unset($_SESSION['nclient']);

		//print("HA CERRADO SESION</br>");
			
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>