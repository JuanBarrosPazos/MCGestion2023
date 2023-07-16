<?php
session_start();

	require '../Inclu/Admin_Inclu_popup.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

?>

<!--
<script type="text/javascript">
//
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//
</script>
-->

<?php

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){
				
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
							
			if($_POST['oculto2']){
									process_form();
								} 
								
			elseif(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
									process_form();
								} 

			elseif($_POST['imagenmodif']){
									process_form();
								} 
			elseif($_POST['cero']){
									process_form();
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

	$errors = array();


	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
	
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	$tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			}

		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			}

	elseif ($_FILES['myimg']['size'] > $limite){
	$tamanho = $_FILES['myimg']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
					
	return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function modifica_form(){
	
		global $db;
		global $db_name;
		global $img;
		global $imgcamp;

		$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
		$safe_filename = trim(str_replace('..', '', $safe_filename));

		$nombre = $_FILES['myimg']['name'];
		$nombre_tmp = $_FILES['myimg']['tmp_name'];
		$tipo = $_FILES['myimg']['type'];
		$tamano = $_FILES['myimg']['size'];

		$destination_file = "../imgpro/imgpro".$_SESSION['miseccion']."/".$safe_filename;
		
	    if( file_exists("../imgpro/imgpro".$_SESSION['miseccion']."/".$nombre) ){
			unlink("../imgpro/imgpro".$_SESSION['miseccion']."/".$nombre);
			}
			
		elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){

		// Eliminar el archivo antiguo untitled.png
		if($_SESSION['myimg'] != 'untitled.png' ){
		unlink("../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg']);
									}
		// Renombrar el archivo:
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		global $new_name;
		//	$new_name = $_SESSION['myimg'];
		date('H:i:s');
		date('Y_m_d');
		$dt = date('is');
		global $new_name;
		$new_name = $_SESSION['mivalor']."_".$dt.".".$extension;
		$rename_filename = "../imgpro/imgpro".$_SESSION['miseccion']."/".$new_name;								
		rename($destination_file, $rename_filename);
		

	global $imgcamp;
	$imgcamp = $_SESSION['imgcamp'];
	$imgcamp = "`".$imgcamp."`";

	global $mivalor;
	$mivalor = $_SESSION['mivalor'];

	require "../config/TablesNames.php";

	$sqla = "UPDATE `$db_name`.$secc2 SET $imgcamp = '$new_name'  WHERE $secc2.`producto` = '$mivalor' LIMIT 1 ";
		
		if(mysqli_query($db, $sqla)){}
		
		else { print("* ERROR ".mysqli_error($db));
				show_form ();
				global $texerror;
				$texerror = "\n\t ".mysqli_error($db);
			}
		}
						
		else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_SESSION['miseccion']."/");}

	} 
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	if($_POST['oculto2']){
		
		unset($_SESSION['myimg']);	
		unset($_SESSION['myimg1']);
		unset($_SESSION['myimg2']);
		unset($_SESSION['myimg3']);
		unset($_SESSION['myimg4']);	
		unset($_SESSION['miseccion']);	
		unset($_SESSION['miid']);	
		unset($_SESSION['mivalor']);	
		unset($_SESSION['minombre']);	
		unset($_SESSION['miref']);	
				
		$_SESSION['miseccion'] = $_POST['seccion'];
		$_SESSION['miid'] = $_POST['id'];
		$_SESSION['mivalor'] = $_POST['valor'];
		$_SESSION['minombre'] = $_POST['nombre'];
		$_SESSION['miref'] = $_POST['ref'];
	
		require "../config/TablesNames.php";
		$sqlc =  "SELECT * FROM `$db_name`.$secc2 WHERE `producto` = '$_POST[valor]'";
		$qc = mysqli_query($db, $sqlc);
		$countc = mysqli_num_rows($qc);
		$rowsc = mysqli_fetch_assoc($qc);
	
		$_SESSION['myimg1'] = $rowsc['myimg1'];
		$_SESSION['myimg2'] = $rowsc['myimg2'];
		$_SESSION['myimg3'] = $rowsc['myimg3'];
		$_SESSION['myimg4'] = $rowsc['myimg4'];
	
	} else {	$valor = $_SESSION['mivalor'];
													
		require "../config/TablesNames.php";
		$sqlc =  "SELECT * FROM `$db_name`.$secc2 WHERE `producto` = '$valor'";
		$qc = mysqli_query($db, $sqlc);
		$countc = mysqli_num_rows($qc);
		$rowsc = mysqli_fetch_assoc($qc);
									
		$_SESSION['myimg1'] = $rowsc['myimg1'];
		$_SESSION['myimg2'] = $rowsc['myimg2'];
		$_SESSION['myimg3'] = $rowsc['myimg3'];
		$_SESSION['myimg4'] = $rowsc['myimg4'];
	}

		print(" <table class='detalle' align='center'>
				<tr>
					<th colspan=4 class='BorderInf'>
							SECCION ".strtoupper($_SESSION['miseccion']).".
							</br> 
							IMAGENES DEL PRODUCTO ".$_SESSION['minombre']."
					</th>
				</tr>
				
        <tr>
          <td class='img1'>
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg1']."'  onclick=\"MM_showHideLayers('contenedor','','show','foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" onload=\"MM_showHideLayers('foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" /> 
			<input name='mimg1' type='hidden' value='".$_SESSION['myimg1']."' />
			<input type='submit' value='MODIF IMG 1' />
			<input type='hidden' name='mimg1' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg2']."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','show','foto3A','','hide','foto4A','','hide')\" /> 
			<input name='mimg2' type='hidden' value='".$_SESSION['myimg2']."' />
			<input type='submit' value='MODIF IMG 2' />
			<input type='hidden' name='mimg2' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg3']."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','show','foto4A','','hide')\" /> 
			<input name='mimg3' type='hidden' value='".$_SESSION['myimg3']."' />
			<input type='submit' value='MODIF IMG 3' />
			<input type='hidden' name='mimg3' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg4']."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','hide','foto4A','','show')\" /> 
			<input name='mimg4' type='hidden' value='".$_SESSION['myimg4']."' />
			<input type='submit' value='MODIF IMG 4' />
			<input type='hidden' name='mimg4' value=1 />
</form>		  
		  </td>
       </tr>");
       
$printimg =	"<div id='foto1A' class='img2'> 
				<img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg1']."' /> 
			</div>
			
            <div id='foto2A' class='img2'> 
				<img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg2']."' /> 
			</div>
			
            <div id='foto3A' class='img2'> 
				<img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg3']."' /> 
			</div>
			
            <div id='foto4A' class='img2'> 
				<img src='../imgpro/imgpro".$_SESSION['miseccion']."/".$_SESSION['myimg4']."' /> 
			</div>";
			
	if(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
					global $style;
					$style = 'margin-top:60px';
					show_form();
	} elseif($_POST['imagenmodif']){
					if($form_errors = validate_form()){
										global $style;
										$style = 'margin-top:60px';
										show_form($form_errors);
											} else {modifica_form();
													show_form();
												//	accion_Modificar_02();
																				}
	}
	elseif($_POST['cero']){	global $style;
							$style = 'margin-top:420px';
							print($printimg);
							
	} 
	else {	global $style;
			$style = 'margin-top:420px';
			print($printimg);
								}
	print("	
			<tr>
				<div>
					<td colspan=4 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' />
						<input type='hidden' name='oculto2' value=1 />
	</form>
				</div>
					</td>
			</tr>
	</table>
	
	<div style='clear:both'></div>
	
	<!-- Inicio footer -->
	<div id='footer' style=".$style.">&copy; Juan Barr&oacute;s Pazos 2012 - 2023.</div>
	<!-- Fin footer -->
	</div>

		");	 

			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

					
function show_form($errors=[]){
	
	global $db; 	
		
	if($_POST['mimg1']){$_SESSION['myimg'] = $_SESSION['myimg1'];
						$_SESSION['imgcamp'] = "myimg1";}
	if($_POST['mimg2']){$_SESSION['myimg'] = $_SESSION['myimg2'];
						$_SESSION['imgcamp'] = "myimg2";}
	if($_POST['mimg3']){$_SESSION['myimg'] = $_SESSION['myimg3'];
						$_SESSION['imgcamp'] = "myimg3";}
	if($_POST['mimg4']){$_SESSION['myimg'] = $_SESSION['myimg4'];
						$_SESSION['imgcamp'] = "myimg4";}

	if($_POST['oculto2']){
				$defaults = array ( 'seccion' => '',
									'id' => '',
									'valor' => '',
									'nombre' => '',
									'ref' => '',																														
									'myimg' => '',
													);
								   						}
								   
	elseif(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
				$defaults = array ( 'seccion' => $_SESSION['miseccion'],
									'id' => $_SESSION['miid'],
									'valor' => $_SESSION['mivalor'],
									'nombre' => $_SESSION['minombre'],
									'ref' => $_SESSION['miref'],																														
									'myimg' => $_SESSION['myimg'],
													);
														}

	elseif($_POST['imagenmodif']){
				$defaults = array ( 'seccion' => $_SESSION['miseccion'],
									'id' => $_SESSION['miid'],
									'valor' => $_SESSION['mivalor'],
									'nombre' => $_SESSION['minombre'],
									'ref' => $_SESSION['miref'],																														
									'myimg' => $_SESSION['myimg'],
													);
														}

if ($errors){
		print("<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font></br>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>** </font>".$errors [$a]."</br>");
			}
		}
	
	print(" <tr>
					<th colspan=4 class='BorderInf' style='padding-top:60px'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
			</tr>
				
			<tr>
					<th colspan=2 class='BorderInf'>
LA IMAGEN ACTUAL </br>".strtoupper($defaults['seccion'])." / ".strtoupper($defaults['nombre'])." / ".strtoupper($_SESSION['myimg']).".
</br></br>
<form name='cero' method='post' action='$_SERVER[PHP_SELF]'>
						<input type='submit' value='ACTUALIZAR VISTAS' />
						<input type='hidden' name='cero' value=1 />
</form>														

					</th>
			
					<th colspan=2 class='BorderInf'>
<img src='../imgpro/imgpro".$defaults['seccion']."/".$defaults['myimg']."' height='120px' width='90px' />
					</th>
			</tr>
			
			<tr>
					<td colspan=2>
							SELECCIONE IMAGEN	
					</td>
					<td colspan=2>
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		<input size=14 type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

			
				<tr align='center'>
					<td colspan=4 align='right'>
				
						<input type='submit' value='MODIFICAR IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
</form>														
						
					</td>
					
				</tr>
				
				<tr>
					<td class='BorderInf' colspan=4>
					</td>
				</tr>

				");
	
		}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
///

function accion_Ver_02(){

	global $db;
	global $rowout;
	
	global $nombre;
	global $apellido;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ $dir = 'Admin';}
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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


	//require '../Inclu/Admin_Inclu_02.php';
		
?>