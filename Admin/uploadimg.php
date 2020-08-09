<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ejercicio Capitulo 4B</title>
</head>

<body>

<?php


if($_POST['oculto']){

	if($form_errors = validate_form()){
		show_form($form_errors);
		} else {
			process_form();
			}
	} else {
		show_form();
		}

/////////////////////////////////////////////////////////////////////////////////////////

 function validate_form(){
	 
	$errors = array();

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP');
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	$tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
		$errors [] = "Ha de seleccionar un archivo.";
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

/////////////////////////////////////////////////////////////////////////////////////////////////

 function process_form(){
	 
			$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			$safe_filename = trim(str_replace('..', '', $safe_filename));

		  $nombre = $_FILES['myimg']['name'];
		  $nombre_tmp = $_FILES['myimg']['tmp_name'];
		  $tipo = $_FILES['myimg']['type'];
		  $tamano = $_FILES['myimg']['size'];
		  
			$destination_file = 'img_admin/'.$safe_filename;
			
	 print("<table align='center'>
	 				
				<tr>
					<th colspan=2 style='color:green' align='center'>
						Archivo seleccionado.
					</th>
				</tr>

	 			<tr>
					<td style='color:Blue' width='200px'>
							Archivo seleccionado: 
					</td>
					<td>"
						.$safe_filename.
	 				"</td>
				</tr>
				
				
			</table>
			
			</br></br>");
			
	      	if( file_exists( 'img_admin/'.$nombre) ){
							print("El archivo ya existe: ".$nombre.". Seleccione otra imagen."
							);
			}
			
			elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
				
							print("El archivo se ha guardado en: ".$destination_file);
			}
			
			else {
							print("No se ha podido guardar el archivo en el direcctorio img_admin/");
			}

			show_form();			
			
	 		}

///////////////////////////////////////////////////////////////////////////////////////////////////

 function show_form($errors=''){
	
	if ($_POST['oculto']){
		$defaults = $_POST;
		} else {
			$defaults = array('myimg' => $_POST['myimg']);
			}

		$color = array('yellow','white');
		
	if($errors){
			
		print("<table border=0>
					<tr>
						<th>
							<font color='red' size=4px><b>Solucione estos errores</b></font>
						</th>
					</tr>");
					
		for($a=0, $ci=0; $c=count($errors), $a<$c; $a++, $ci=1-$ci){
			print("<tr bgcolor=\"".$color[$ci]."\">
						<td align='center'>"
							.$errors[$a].
				  		"</td>
				   </tr>"
					);
			}
			print("</table>");
			
		} 
	
	 print("<form name='form1' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

			<table border=0 align='center'>
				
	 			<tr>
					<th colspan=2 style='color:green'>
						Upload archivo.
					</th>
				</tr>
				
				<tr>
					<td style='color:blue' width='150px'>
							 Seleccione el archivo:
					</td>
					<td>	 
							<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>
					");					
					
					botones_form();
							
				
		print("</table> <!-- Fin de la tabla -->
		
					</form> <!-- Fin del formulario -->
					
						");
	
		   } 
		 
////////////////////////////////////////////////////////////////////////////////////////////////

function botones_form(){
	print("<tr align='center'>
					<td colspan=2 style=\"padding-top:24px\">		
								
						<input type='submit' value='Upload Archivo' />
					
						
			<!-- Utilizamos el campo hidden para procesar el formulario -->

						<input type='hidden' name='oculto' value=1 />
					</td>
			</tr>"); 
		} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////
		
?>

</body>
</html>