<?php
session_start();

	require '../Inclu/Admin_Inclu_popup.php';

		require '../Conections/conection.php';

?>

<script type="text/javascript">
<!--
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>

<?php

	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){
				
							
							if($_POST['oculto2']){
													process_form();
													accion_Ver_02();
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

function process_form(){
	
	global $db;
	global $db_name;
	global $vname;
	
	$vname = $_POST['vname'];
//	print("** ".$_POST['vname']." / ".$_POST['dyt1']);
	
		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `id` = '$_POST[id]'";
		$qc = mysqli_query($db, $sqlc);
		$countc = mysqli_num_rows($qc);
		$rowsc = mysqli_fetch_assoc($qc);
	
		$ext_permitidas = array('pdf','PDF');
		
		$extension1 = substr($rowsc['myimg1'],-3);
		// print($extension1);
		// $extension1 = end(explode('.', $_FILES['myimg1']['name']) );
		$ext_correcta1 = in_array($extension1, $ext_permitidas);
		if(!$ext_correcta1){ $myimg1 = $rowsc['myimg1'];}
		else{$myimg1 = 'pdf.png';}

		$extension2 = substr($rowsc['myimg2'],-3);
		// print($extension2);
		// $extension2 = end(explode('.', $_FILES['myimg2']['name']) );
		$ext_correcta2 = in_array($extension2, $ext_permitidas);
		if(!$ext_correcta2){ $myimg2 = $rowsc['myimg2'];}
		else{$myimg2 = 'pdf.png';}

		$extension3 = substr($rowsc['myimg3'],-3);
		// print($extension3);
		// $extension3 = end(explode('.', $_FILES['myimg3']['name']) );
		$ext_correcta3 = in_array($extension3, $ext_permitidas);
		if(!$ext_correcta3){ $myimg3 = $rowsc['myimg3'];}
		else{$myimg3 = 'pdf.png';}

		$extension4 = substr($rowsc['myimg4'],-3);
		// print($extension4);
		// $extension4 = end(explode('.', $_FILES['myimg4']['name']) );
		$ext_correcta4 = in_array($extension4, $ext_permitidas);
		if(!$ext_correcta4){ $myimg4 = $rowsc['myimg4'];}
		else{$myimg4 = 'pdf.png';}

	print("<table class='detalle' align='center'>
				<tr>
					<th colspan=4 class='BorderInf'>
							RAZON SOCIAL ".strtoupper($_POST['factnom']).".
							NIF ".$_POST['factnif']."
							</br> 
							DOCS FACT Nº: ".$_POST['factnum']."
					</th>
				</tr>
				
        <tr>
		
          <td class='img1'>
		  <img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg1."'  onclick=\"MM_showHideLayers('contenedor','','show','foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" onload=\"MM_showHideLayers('foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" /> 
<a style='font-size:14px' href='../gastos/docgastos_".$_POST['dyt1']."/".$rowsc['myimg1']."' target='_blank'>
				DOWNLOAD 1
			</a>
		  </td>
		  
          <td class='img1'>
		  <img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg2."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','show','foto3A','','hide','foto4A','','hide')\" /> 
<a style='font-size:14px' href='../gastos/docgastos_".$_POST['dyt1']."/".$rowsc['myimg2']."' target='_blank'>
				DOWNLOAD 2
			</a>
		  </td>
		  
          <td class='img1'>
		  <img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg3."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','show','foto4A','','hide')\" /> 
<a style='font-size:14px' href='../gastos/docgastos_".$_POST['dyt1']."/".$rowsc['myimg3']."' target='_blank'>
				DOWNLOAD 3
			</a>
		  </td>
		  
          <td class='img1'>
		  <img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg4."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','hide','foto4A','','show')\" /> 
<a style='font-size:14px' href='../gastos/docgastos_".$_POST['dyt1']."/".$rowsc['myimg4']."' target='_blank'>
				DOWNLOAD 4
			</a>
		  </td>
       </tr>
       
			<div id='foto1A' class='img2'> 
				<img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg1."' /> 
			</div>
			
            <div id='foto2A' class='img2'> 
				<img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg2."' /> 
			</div>
			
            <div id='foto3A' class='img2'> 
				<img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg3."' /> 
			</div>
			
            <div id='foto4A' class='img2'> 
				<img src='../gastos/docgastos_".$_POST['dyt1']."/".$myimg4."' /> 
			</div>
		
		<tr>
					<td colspan=4 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
	</table>
	
<div style='clear:both'></div>

<!-- Inicio footer -->
<div id='footer' style='margin-top:425px'>&copy; Juan Barr&oacute;s Pazos 2001.</div>
<!-- Fin footer -->
</div>

		");	

			}	
			
/////////////////////////////////////////////////////////////////////////////////////////////////

function accion_Ver_02(){

	global $db;
	global $rowout;
	
	global $nombre;
	global $apellido;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
	global $text;
	$text = "- CLIENTE DETALLES ".$ActionTime.". ".$nombre." ".$apellido;

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
	
	function desconexion(){

			print("<form name='cerrar' action='mcgexit.php' method='post'>
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

	//require '../Inclu/Admin_Inclu_02.php';
		
?>