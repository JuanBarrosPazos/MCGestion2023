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

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'cliente'){
				
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
							
							if($_POST['oculto2']){
													process_form();
												//	accion_Ver_02();
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
	
		$secc1 = "imgpro".$_POST['seccion'];
		$secc1 = "`".$secc1."`";

		$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `producto` = '$_POST[valor]'";
		$qc = mysqli_query($db, $sqlc);
		$countc = mysqli_num_rows($qc);
		$rowsc = mysqli_fetch_assoc($qc);
	
	print("<table class='detalle' align='center'>
				<tr>
					<th colspan=4 class='BorderInf'>
							SECCION ".strtoupper($_POST['seccion']).".
							</br> 
							IMAGENES DEL PRODUCTO ".strtoupper($_POST['valor'])."
					</th>
				</tr>
				
        <tr>
		
          <td class='img1'>
		  <img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg1']."'  onclick=\"MM_showHideLayers('contenedor','','show','foto1Ab','','show','foto2Ab','','hide','foto3Ab','','hide','foto4Ab','','hide')\" onload=\"MM_showHideLayers('foto1Ab','','show','foto2Ab','','hide','foto3Ab','','hide','foto4Ab','','hide')\" /> 
		  </td>
		  
          <td class='img1'>
		  <img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg2']."' onclick=\"MM_showHideLayers('foto1Ab','','hide','foto2Ab','','show','foto3Ab','','hide','foto4Ab','','hide')\" /> 
		  </td>
		  
          <td class='img1'>
		  <img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg3']."' onclick=\"MM_showHideLayers('foto1Ab','','hide','foto2Ab','','hide','foto3Ab','','show','foto4Ab','','hide')\" /> 
		  </td>
		  
          <td class='img1'>
		  <img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg4']."' onclick=\"MM_showHideLayers('foto1Ab','','hide','foto2Ab','','hide','foto3Ab','','hide','foto4Ab','','show')\" /> 
		  </td>
       </tr>
       
			<div id='foto1Ab' class='img2'> 
				<img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg1']."' /> 
			</div>
			
            <div id='foto2Ab' class='img2'> 
				<img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg2']."' /> 
			</div>
			
            <div id='foto3Ab' class='img2'> 
				<img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg3']."' /> 
			</div>
			
            <div id='foto4Ab' class='img2'> 
				<img src='../imgpro/imgpro".$_POST['seccion']."/".$rowsc['myimg4']."' /> 
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
<div id='footer' style='margin-top:415px'>&copy; Juan Barr&oacute;s Pazos 2001.</div>
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