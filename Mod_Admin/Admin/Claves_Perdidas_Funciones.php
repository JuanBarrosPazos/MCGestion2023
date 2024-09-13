<?php

 function validate_form(){
	 
	global $sql; 		global $q; 		global $row;
	global $db; 		global $db_name;
		
	 $errors = array();
		 
	/* Validamos el campo mail. */
	
	if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "MAIL CAMPO OBLIGATORIO";
	}elseif(strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "MAIL MAS DE 5 CARACTERES";
	}elseif(!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "MAIL DIRECCION NO VALIDA";
	}
		
	/* Validamos el campo dni */
	
	if(strlen(trim($_POST['dni'])) == 0){
		$errors [] = "Nº DNI CAMPO OBLIGATORIO";
	}elseif (!preg_match('/^[\d]+$/',$_POST['dni'])){
		$errors [] = "Nº DNI SÓLO NÚMEROS";
	}elseif (strlen(trim($_POST['dni'])) < 8){
		$errors [] = "Nº DNI MAS DE 7 DIGITOS";
	}

	/* Validamos el campo ldni */
	
	if(strlen(trim($_POST['ldni'])) == 0){
		$errors [] = "Letra DNI CAMPO OBLIGATORIO";
	}elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
		$errors [] = "Letra DNI SOLO TEXTO";
	}elseif (!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
		$errors [] = "Letra DNI SOLO MAYUSCULAS";
	}

	/* Realizamos un condicional de validacion de campos Nombre y dni.*/
		
	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sql =  "SELECT * FROM `$db_name`.$table_name_a WHERE `Email` = '$_POST[Email]' AND `dni` = '$_POST[dni]' AND `ldni` = '$_POST[ldni]' ";
 	
	$q = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($q);
	$_SESSION['L_Email'] = @$row['Email'];
	$_SESSION['L_dni'] = @$row['dni'];
	$_SESSION['L_ldni'] = @$row['ldni'];

	if(trim($_POST['Email'] != $_SESSION['L_Email'])){
		$errors [] = "NO HAY DATOS";
	}elseif(trim($_POST['dni'] != $_SESSION['L_dni'])){
		$errors [] = "NO HAY DATOS";
	}elseif(trim($_POST['ldni'] != $_SESSION['L_ldni'])){
		$errors [] = "NO HAY DATOS";
	}elseif (@$row['Nivel'] == 'close'){
		$errors [] = "ACCESO RESTRINGIDO POR EL WEB MASTER";
	}
	 
	return $errors;

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto2'])){
		$defaults = array (	'Asunto' => 'SUS CLAVES DE ACCESO',
							'Email' => $_POST['Email'],
							'dni' => $_POST['dni'],	
							'ldni' => $_POST['ldni']);
	}elseif(isset($_POST['oculto'])){
		$defaults = $_POST;
	}else{
		$defaults = array (	'Asunto' => 'SUS CLAVES DE ACCESO',
							'Email' => '',
							'dni' => '',
							'ldni' => '');
	}

	if($errors){
		print("<table align='center'>
					<tr>
						<td style='text-align:'center'>
							<font color='#FF9900'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</td>
					</tr>
					<tr>
						<td style='text-align:left'>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF9900'>* </font>".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
		<embed src='../audi/user_lost.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
		</embed>
			</table>");

		}elseif(isset($_POST['oculto2']) != 1){
		print("<embed src='../audi/claves_lost_2.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
				</embed>");
				}
	
				print("<table align='center' style=\"border:0px;margin_bottom:6px;margin-top:14px\">

				<tr>
					<th style='color:#F1BD2D;'>".$defaults['Asunto']."</th>
				</tr>
				<tr>
					<td>
		<form name='Perdidos' method='post' action='$_SERVER[PHP_SELF]'>
			<input name='Asunto' type='hidden' value='".$defaults['Asunto']."' />
			<input type='email' name='Email' size=30 placeholder='MI EMAIL' value='".$defaults['Email']."' required/>
					</td>
				</tr>
				<tr>
					<td>
			<input type='text' name='dni' size=30 maxlength=8 pattern='[0-9]{8,8}' placeholder='NUM. DNI' value='".$defaults['dni']."' required/>
						</td>
				</tr>
				<tr>
					<td>
			<input type='text' name='ldni' size=30 maxlength=1 pattern='[A-Z]{1,1}' placeholder='LETRA DNI' value='".$defaults['ldni']."' required />
					</td>
				</tr>
				<tr>
					<td align='right'>
			<input type='submit' value='ENVIAR MIS CLAVES' class='botonverde' />
			<input type='hidden' name='oculto' value=1 />
		</form>	
			<a href='../index.php' class='botonverde' style='display:inline-block; float:left;'>
				INICIO CLIENTES
			</a>
					</td>
				</tr>
		</table>");
	
	}	/* Fin de la función show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	//$eml = "%".$_POST['Email']."%";
	$sqlc =  "SELECT * FROM `$db_name`.$table_name_a WHERE `Email` = '$_POST[Email]' AND `dni` = '$_POST[dni]' AND `ldni` = '$_POST[ldni]' ";
	$qc = mysqli_query($db, $sqlc);
	
	if(!$qc){print("Se ha producido un error: ".mysqli_error($db)."<br/><br/>");
			
		} else {	if(mysqli_num_rows($qc)== 0){
					print ("No hay datos.");
							
		} else { 	
			print ("<table align='center' style=\"border:0px;margin_bottom:4px;margin-top:4px\">");
			
			while($rowc = mysqli_fetch_assoc($qc)){
										
	print ("<tr>
				<td colspan=2 align='center'>
			<form name='modifica' action='$_SERVER[PHP_SELF]' method='POST'>

			<input name='Email' type='hidden' value='".$rowc['Email']."' />
			<input name='Usuario' type='hidden' value='".$rowc['Usuario']."' />
				<!-- \$rowc['Password'] PASA UN HASH \$rowc['Pass'] PASA EL PASWORD -->
			<input name='Password' type='hidden' value='".$rowc['Pass']."' />
			<input name='Asunto' type='hidden' value='".$_POST['Asunto']."' />".$_POST['Asunto']."
				</td>
			</tr>
			<tr>
				<td colspan=2 align='center'>
	<img src='../Users/".$rowc['ref']."/img_admin/".$rowc['myimg']."' height='60px' width='45px' />
				</td>
			</tr>
			<tr>
				<td colspan=2 align='center'>
	<input name='Nombre' type='hidden' value='".$rowc['Nombre']."' />".$rowc['Nombre']." ".$rowc['Apellidos'].".
			<input name='Apellidos' type='hidden' value='".$rowc['Apellidos']."' />
				</td>
			</tr>
			<!--
				<tr>
					<td colspan=2 align='center'>Usuario:<br>".$rowc['Usuario']."</td>
				</tr>
				<tr>
					<td colspan=2 align='center'>Password Hash<br>".$rowc['Password']."</td>
				</tr>
				<tr>
					<td colspan=2 align='center'>Pass:<br>".$rowc['Pass']."</td>
				</tr>
			-->
			<tr>
				<td colspan=2 align='center'>
			<input type='submit' value='CONFIRMAR Y ENVIAR MIS DATOS VIA MAIL' class='botonverde' />
			<input type='hidden' name='oculto2' value=1 />
				</td>
		</form>
			</tr>");
						} /* Fin del while.*/
	print("	<tr>
				<td colspan='2' align='center'>
					<a href='../index.php'>
						Volver Admin Access.
					</a>
				</td>
			</tr>
		</table>");
					} /* Fin segundo else anidado en if */
				} /* Fin de primer else . */

		}	/* Final de la función process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

 function process_Mail(){	 

	global $mensaje;
	$mensaje = '<html lang="es">
					 	<head>
							<meta charset="UTF-8">
							<meta http-equiv="X-UA-Compatible" content="IE=edge">
							<meta name="viewport" content="width=device-width, initial-scale=1.0">
							<title>Document</title>
							<style>
								body {
									font-family: "Times New Roman", Times, serif;
								}
								body a {
									text-decoration:none;
								}
								table a {
									color: #666666;
									text-decoration: none;
									font-family: "Times New Roman", Times, serif;
								}
								table a:hover {
									color: #FF9900;
									text-decoration: none;
								}
								tr {
									margin: 0px;
									padding: 0px;
								}
								td {
									margin: 0px;
									padding: 6px;
								}
								th {
									padding: 6px;
									margin: 0px;
									text-align: center;
									color: #666666;
								}
							</style>
					   	</head>
						<body bgcolor="#D7F0E7">
	<table font-family="Times New Roman" width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<th colspan="3">'.$_POST['Asunto'].'</th>
						</tr>
						<tr>
							<td align="right">Nombre:</td>
							<td width="12">&nbsp;</td>
							<td align="left">'.$_POST['Nombre'].'</td>
						</tr>
						<tr>
							<td align="right">Apellidos:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Apellidos'].'</td>
						</tr>
						<tr>
							<td align="right">Email:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Email'].'</td>
						</tr>
						<tr>
							<td align="right">Nombre de Usuario:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Usuario'].'</td>
						</tr>
						<tr>
							<td align="right">Password:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Password'].'</td>
						</tr>
						<tr>
						  	<td colspan="3" style="font-size:11px">
								<b>AVISO LEGAL</b>
								<br/>
		Este mensaje y los archivos que en su caso lleve adjuntos son privados y confidenciales y se dirigen exclusivamente a su destinatario. Por ello, se informa a quien lo reciba por error de que la informaci&oacute;n contenida en el mismo es reservada y su utilizaci&oacute;n, copia odistribuci&oacute;n est&aacute; prohibida, por lo que, en tal caso, le rogamos nos lo comunique por esta misma v&iacute;a o por tel&eacute;fono al n&uacute;mero 654 639 155 de Espa&ntilde;a y proceda a borrarlo de inmediato. JuanBarros.es advierte expresamente que el env&iacute;o de correos electr&oacute;nicos a trav&eacute;s de Internet no garantiza la confidencialidad de los mensajes ni su integridad y correcta recepci&oacute;n, por lo que JuanBarros.es no asume responsabilidad alguna en relaci&oacute;n con dichas circunstancias.
	<br/>
		Gracias.
	<br/>
	<br/>
		 <b>DISCLAIMER</b>
	<br/>
		This message and the attached files are private and confidential and intended exclusively for the addressee. As such, JuanBarros.es informs to whom it may receive it in error that it contains privileged information and its use, copy or distribution is prohibited. If it  has been received by error, please notify us via e-mail or by telephone 654 639 155 Spain  and delete it immediately. JuanBarros.es expressly warns that the use of Internet e-mail neither guarantees the confidentiality of the messages nor its integrity and proper receipt, and ,therefore, JuanBarros.es does not assume any responsibilities for those circumstances.
	<br/>
		 Thank you.
	<td>
	</tr>	
	</table>
		</body>
			</html>';
			
		# datos del mensaje
		
				$destinatario = $_POST['Email'];
				$titulo= $_POST['Asunto'];
				$remite= 'juanbarrospazos@hotmail.es';
				//$remitente= 'ADMINISTRADOR SISTEMA'; //sin tilde para evitar errores de servidor

		# cabeceras
		
				$cabecera = "Date: ".date("l j F Y, G:i")."\n";
				//$cabecera .="MIME-Version: 1.0\n";
				$cabecera .= 'MIME-Version: 1.0' . "\r\n";
				$cabecera .= 'Content-type: text/html; charset=UTF-8' . "\n";				
				$cabecera .= "From: ".$remite."<".$remite.">\n";
				$cabecera .= "Bcc: manuelpazos02@gmail.com \n";
				//$cabecera .="Return-path: ". $remite."\n";
				$cabecera .="Reply-To: ".$remite."\n";
				//$cabecera .="X-Mailer: PHP/". phpversion()."\n";
				//$cabecera .="Content-Type: multipart/mixed;"."\n";
				
				

				/* SOLO PARA ARCHIVOS ADJUNTOS. 
				Adjuntamos una imagen en el mensaje. 
				$adj1 = "\n"."--$separador"."\n"; 
				
				$adj1 .="Content-Type: image/gif;";
				$adj1 .=" name=\"Degra3A.gif\""."\n";
				$adj1 .="Content-Disposition: attachment; ";
				$adj1 .="filename=\"Degra3A.gif\""."\n";
				$adj1 .="Content-Transfer-Encoding: base64"."\r\n\r\n";
				
				$fp = fopen("Degra3A.gif", "r");
				$buff = fread($fp, filesize("Degra3A.gif"));
				fclose($fp);
				
				$adj1 .=chunk_split(base64_encode($buff));
				*/
								
				/* Le pasamos a la variable $mensaje el valor de $texto_html y $adj1, que es la imagen
				$mensaje= $texto_html.$adj1;
				*/
				
			if( mail($destinatario, $titulo, $mensaje, $cabecera)){
				
						print("<table align='center' style=\"margin-top:14px\">
								<tr>
									<td align='center'>
										<font color='#0080C0'>
											SUS DATOS HAN SIDO ENVIADOS.
											<br/>
											MUCHAS GRACIAS. ".$_POST['Nombre']." ".$_POST['Apellidos']."
										</font>
									</td>
								</tr>
								<tr>
									<td align='center'>
										<a href='../index.php'>
												Volver Admin Access.
										</a>
									</td>
								</tr>
							<table>
	<embed src='../audi/claves_lost_3.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
		</embed>");
						
			}else{
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr>
							<td align='center'>
								<font color='#FF9900'>
									EL MENSAJE NO HA PODIDO ENVIARSE,
									LO SENTIMOS MUCHO, ".$_POST['Nombre']." ".$_POST['Apellidos']."
									MUCHAS GRACIAS.
								</font>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
									Contactos Juan Barros
								</a>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<a href='../index.php'>
									Volver Admin Access.
								</a>
							</td>
						</tr>
					<table>
	<embed src='../audi/claves_lost_4.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
		</embed>");
														
					} /*Fin del if del mail*/
														
	 		}	/* Fin funcion process_Mail(); */
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
	} 

?>