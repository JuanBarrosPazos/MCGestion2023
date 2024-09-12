<?php
 
	
	$errors = array();

	/* VALIDAMOS EL CAMPO my_img */

	$limite = 500 * 1024;
	global $ext_permitidas;
	$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP');
	global $extension;
	$extension = substr(@$_FILES['myimg']['name'],-3);
	if(($extension == "peg")||($extension == "PEG")){
		$extension = substr($_FILES['myimg']['name'],-4);
	} else{ }
// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	/* $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg|bmp)$/', $_POST['myimg']); */

	global $img2;
	if(isset($_POST['modifica'])){
		if(strlen(trim ($_POST['myimg'])) == 0){
			$errors [] = "Ha de seleccionar un archivo.";
					$img2 = 'untitled.png';
		}else{ }
	}else{ }
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* 	VALIDAMOS EL CAMPO my_img */

	if((isset($_POST['imagenmodif'])) || (isset($_POST['oculto']))){
		
	$limite = 500 * 1024;
	global $ext_permitidas;
	$ext_permitidas = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG');
	global $extension;
	$extension = substr($_FILES['myimg']['name'],-3);
	if(($extension == "peg")||($extension == "PEG")){
			$extension = substr($_FILES['myimg']['name'],-4);
	}else{ }

	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);
	$tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png|jpg)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
			$img2 = 'untitled.png';
		}elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			$img2 = 'untitled.png';
		}elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			$img2 = 'untitled.png';
		}elseif($_FILES['myimg']['size'] > $limite){
			$tamanho = $_FILES['myimg']['size'] / 1024;
			$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
			$img2 = 'untitled.png';
		}elseif($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
			$errors [] = "La carga del archivo se ha interrumpido.";
			$img2 = 'untitled.png';
		}elseif($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
			$errors [] = "Es archivo no se ha cargado.";
			$img2 = 'untitled.png';
		}
	}else{ }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO NIVEL. */
	
	if(strlen(trim($_POST['Nivel'])) == 0){
		$errors [] = "NIVEL: Este campo es obligatorio.";
	}else{ }
	
	/* VALIDAMOS EL CAMPO NOMBRE. */
	
	if(strlen(trim($_POST['Nombre'])) == 0){
		$errors [] = "NOMBRE: Este campo es obligatorio.";
	}elseif(strlen(trim($_POST['Nombre'])) < 3){
		$errors [] = "NOMBRE: Escriba más de dos carácteres.";
	}elseif(!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['Nombre'])){
		$errors [] = "NOMBRE: Solo se admite texto.";
	}else{ }
		
	/* VALIDAMOS EL CAMPO APELLIDOS. */
	
	if(strlen(trim($_POST['Apellidos'])) == 0){
		$errors [] = "APELLIDOS: Este campo es obligatorio.";
	}elseif(strlen(trim($_POST['Apellidos'])) < 4){
		$errors [] = "APELLIDOS: Escriba más de 3 carácteres.";
	}elseif(!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['Apellidos'])){
		$errors [] = "APELLIDOS: Solo se admite texto";
	}else{ }
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO  NUMERO DNI/NIF */
	global $sqldni; 	global $qdni;

	require "../config/TablesNames.php";
	$sqldni =  "SELECT * FROM `$db_name`.$ClientesWeb WHERE $ClientesWeb.`dni` = '$_POST[dni]'";
	$qdni = mysqli_query($db, $sqldni);
	$rowdni = mysqli_fetch_assoc($qdni);
	
	if(@$_POST['id'] == @$rowdni['id']){

	}elseif(mysqli_num_rows($qdni)!= 0){
		$errors [] = "NUMERO DNI/NIF: Ya Existe.";
	}else{ }
		
	if($_POST['doc'] == 'DNI'){

		if(strlen(trim($_POST['dni'])) == 0){
			$errors [] = "NUMERO DNI/NIF: Campo Obligatorio.";
		}elseif(!preg_match('/^[\d]+$/',$_POST['dni'])){
			$errors [] = "NUMERO DNI/NIF: Sólo Números.";
		}elseif(strlen(trim($_POST['dni'])) < 8){
			$errors [] = "NUMERO DNI/NIF: Más de 7 Carácteres.";
		}
	}else{ }
	
	/* VALIDAMOS EL CAMPO  
							NUMERO NIE/NIF  XYZ - 
							NIF ESPECIAL KLM - 
							NIF PERSONAS JURIDICAS Y ENTIDADES EN GENERAL 
	*/

	/* VALIDACION COMUN A TODAS LAS OPCIONES */
	
	if(($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd') || ($_POST['doc'] == 'NIFepenr')){

		if(strlen(trim($_POST['dni'])) == 0){
			$errors [] = "NUMERO NIE/NIF: Campo obligatorio.";
		}elseif(strlen(trim($_POST['dni'])) < 8){
			$errors [] = "NUMERO NIE/NIF: Más de 7 carácteres.";
		}elseif(!preg_match('/\b[a-zA-Z]/',$_POST['dni'])){
			$errors [] = "NUMERO NIE/NIF: Falta la Letra";
		}elseif(!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,\/:\.\*]+$/',$_POST['dni'])){
			$errors [] = "NUMERO NIE/NIF: Sin caracteres especiales";
		}elseif(!preg_match('/^[^a-z]+$/',$_POST['dni'])){
			$errors [] = "NUMERO NIE/NIF: Solo mayusculas";
		}elseif($_POST['doc'] == 'NIE'){
			/* SE VALIDAN LAS LETRAS DEL CAMPO NUMERO NIE/NIF */	
			if(preg_match('/^[^XYZ]+$/',$_POST['dni'])){
				// SOLO SE ADMINTE XYZ //
				$errors [] = "NUMERO NIE/NIF: Letra Invalida Solo X,Y,Z.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFespecial'){
			if(preg_match('/^[^KLM]+$/',$_POST['dni'])){
				// SOLO SE ADMINTE KLM //
				$errors [] = "NUMERO NIF Especial: Letra Invalida Solo K,L,M.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFsa'){
			if(preg_match('/^[^A]+$/',$_POST['dni'])){
				// SOLO SE ADMITE A //
				$errors [] = "NUMERO NIF Sociedad An&oacute;nima: Letra Invalida Solo A.  ";
			}else{ }
		}elseif($_POST['doc'] == 'NIFsrl'){
			if(preg_match('/^[^B]+$/',$_POST['dni'])){
				// SOLO SE ADMITE B //
				$errors [] = "NUMERO NIF Sociedad Respons Limitada: Letra Invalida Solo B.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFscol'){
			if(preg_match('/^[^C]+$/',$_POST['dni'])){	
				// SOLO SE ADMITE C //
				$errors [] = "NUMERO NIF Sociedad Colectiva: Letra Invalida Solo C.";
			}
		}elseif($_POST['doc'] == 'NIFscom'){
			if(preg_match('/^[^D]+$/',$_POST['dni'])){
					// SOLO SE ADMITE D //
					$errors [] = "NUMERO NIF Sociedad Comanditaria: Letra Invalida Solo D.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFcbhy'){	
			if(preg_match('/^[^E]+$/',$_POST['dni'])){
				// SOLO SE ADMITE E //
				$errors [] = "NUMERO NIF Comunidad Bienes y Herencias Yacentes: Letra Invalida Solo E.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFscoop'){	
			if(preg_match('/^[^F]+$/',$_POST['dni'])){
				// SOLO SE ADMITE F //
				$errors [] = "NUMERO NIF Sociedades Cooperativas: Letra Invalida Solo F.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFasoc'){
			if(preg_match('/^[^G]+$/',$_POST['dni'])){
				// SOLO SE ADMITE G //
				$errors [] = "NUMERO NIF Asociaciones: Letra Invalida Solo G.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFcpph'){	
			if(preg_match('/^[^H]+$/',$_POST['dni'])){
				// SOLO SE ADMITE H //
				$errors [] = "NUMERO NIF Comunidad Propietarios Propiedad Horizontal: Letra Invalida Solo H.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFsccspj'){	
			if(preg_match('/^[^J]+$/',$_POST['dni'])){
				// SOLO SE ADMITE J //
				$errors [] = "NUMERO NIF Sociedad Civil, con o sin Personalidad Juridica: Letra Invalida Solo J.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFee'){	
			if(preg_match('/^[^N]+$/',$_POST['dni'])){
				// SOLO SE ADMITE N //
				$errors [] = "NUMERO NIF Entidad Extranjera: Letra Invalida Solo N.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFcl'){
			if(preg_match('/^[^P]+$/',$_POST['dni'])){
				// SOLO SE ADMITE P //
				$errors [] = "NUMERO NIF Corporación Local: Letra Invalida Solo P.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFop'){
			if(preg_match('/^[^Q]+$/',$_POST['dni'])){
				// SOLO SE ADMITE Q //
				$errors [] = "NUMERO NIF Organismo Publico: Letra Invalida Solo Q.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFcir'){	
			if(preg_match('/^[^R]+$/',$_POST['dni'])){
				// SOLO SE ADMITE R //
				$errors [] = "NUMERO NIF Congregaciones Instituciones Religiosas: Letra Invalida Solo R.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFoaeca'){	
			if(preg_match('/^[^S]+$/',$_POST['dni'])){
				// SOLO SE ADMITE S //
				$errors [] = "NUMERO NIF Organos Admin Estado y Comunidades Autónomas: Letra Invalida Solo S.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFute'){	
			if(preg_match('/^[^U]+$/',$_POST['dni'])){
				// SOLO SE ADMITE U //
				$errors [] = "NUMERO NIF Unión Temporal de Empresas: Letra Invalida Solo U.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFotnd'){
			if(preg_match('/^[^V]+$/',$_POST['dni'])){
				// SOLO SE ADMITE V //
				$errors [] = "NUMERO NIF Otros Tipos no Definidos: Letra Invalida Solo V.";
			}else{ }
		}elseif($_POST['doc'] == 'NIFepenr'){
			if(preg_match('/^[^W]+$/',$_POST['dni'])){
				// SOLO SE ADMITE W //
				$errors [] = "NUMERO NIF Establecimientos Permanentes Entidades no Residentes: Letra Invalida Solo W.";
			}else{ }
		}else{ }
		
	}else{ } /* FIN PRIMER CONDICIONAL IF DEL CAMPO NUMERO */
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS LA LETRA DE CONTROL DEL DNI */

			/* DEFINO EL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL DNI */
		
						$letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
						$dni = $_POST['dni'];
						$indice = intval($_POST['dni'])%23;
						$letra = $letras[$indice];
	
			/* FIN DEL ALGORITMO DE DEFINICION DEL LA LETRA CONTROL DEL DNI */
	
	if($_POST['doc'] == 'DNI'){
		if(strlen(trim($_POST['ldni'])) == 0){
			$errors [] = "Letra DNI: Campo obligatorio.";
		}elseif(!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
			$errors [] = "LETRA CONTROL DNI: Solo texto";
		}elseif(!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
			$errors [] = "LETRA CONTROL DNI: Solo mayusculas";
		}elseif(trim($_POST['ldni'] != $letra)){
			$errors [] = "LETRA CONTROL DNI: Letra no correcta. $letra is ok.";
		}else{ }
	}else{ }
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS LA LETRA DE CONTROL DE NIE EXTRANJEROS NORMAL Y ESPECIALES */
	
		/* DEFINO DEL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL NIE NORMAL */

		// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
					$dni2 = $_POST['dni'];
					$dni2 = strtoupper($dni2);
				 
					$letra2 = substr($dni2, -1, 1);
					$numero = substr($dni2, 0, 8);
 
		// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
	
					$numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);	
				 
					$modulo = (int) $numero % 23;
					$letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
					$letra2 = substr($letras_validas, $modulo, 1);
		//	print ("ESTA ES LA LETRA NIE $letra2 </br>");
	
		/* FIN DE LA FUNCION PARA EL CALCULO DE LA LETRA CONTROL DEL NIE NORMAL */


		/* DEFINO EL ALGORITMO PARA EL CALCULO DE LA LETRA CONTROL DEL NIE/NIF ESPECIAL */

		global $num1;	global $num2;	global $num3;	global $num4;
		global $num5;	global $num6;	global $num7;

		if(strlen(trim($_POST['dni'])) == 0){ }
		else{	$dni3 = $_POST['dni'];
			
				$num1 = $dni3[1];
				$num2 = $dni3[2];
				$num3 = $dni3[3];
				$num4 = $dni3[4];
				$num5 = $dni3[5];
				$num6 = $dni3[6];
				$num7 = $dni3[7];
			}
			
			$sumaa = $num2 + $num4 + $num6 ;
			// print ("LA SUMA A: $num2 + $num4 + $num6 = $sumaa </br>");
			
			$sumab1 = $num1 * 2;
			$sumab1 = "$sumab1";
			if($sumab1 < 10){ 	$sumab1st = "0$sumab1";
								$sumab1tot = ($sumab1st[0] + $sumab1st[1]);
														}
								elseif($sumab1 > 9){ 	$sumab1st = "$sumab1";
														$sumab1tot = ($sumab1st[0] + $sumab1st[1]);}
			$sumab3 = $num3 * 2;
			$sumab3 = "$sumab3";
			if($sumab3 < 10){ 	$sumab3st = "0$sumab3";
								$sumab3tot = ($sumab3st[0] + $sumab3st[1]);
														}
								elseif($sumab3 > 9){ 	$sumab3st = "$sumab3";
														$sumab3tot = ($sumab3st[0] + $sumab3st[1]);}
			$sumab5 = $num5 * 2;
			$sumab5 = "$sumab5";
			if($sumab5 < 10){ 	$sumab5st = "0$sumab5";
								$sumab5tot = ($sumab5st[0] + $sumab5st[1]);
														}
								elseif($sumab5 > 9){ 	$sumab5st = "$sumab5";
														$sumab5tot = ($sumab5st[0] + $sumab5st[1]);}
			$sumab7 = $num7 * 2;
			$sumab7 = "$sumab7";
			if($sumab7 < 10){ 	$sumab7st = "0$sumab7";
								$sumab7tot = ($sumab7st[0] + $sumab7st[1]);
														}
								elseif($sumab7 > 9){ 	$sumab7st = "$sumab7";
														$sumab7tot = ($sumab7st[0] + $sumab7st[1]);}
			
			$sumab = $sumab1tot + $sumab3tot + $sumab5tot + $sumab7tot;
			
			/* 
			print ("LA SUMA B: ( $num1 x 2 = $sumab1 => $sumab1st[0] + $sumab1st[1] = $sumab1tot ) + ( $num3 x 2 = $sumab3 => $sumab3st[0] + $sumab3st[1] = $sumab3tot ) + ( $num5 x 2 = $sumab5 => $sumab5st[0] + $sumab5st[1] = $sumab5tot ) + ( $num7 x 2 = $sumab7 => $sumab7st[0] + $sumab7st[1] = $sumab7tot ) = ($sumab1tot + $sumab3tot + $sumab5tot + $sumab7tot) =$sumab </br>");
			*/
			
			$sumatot = $sumaa + $sumab;
			// print ("SUMA A $sumaa + SUMA B $sumab = SUMA TOTAL $sumatot </br>");
			
			$sumatotc = $sumatot;
			
			if(@$sumatotc[1] == 0){	$sumacont = 0;
										// print ("TOTAL SUMA CONTROL = $sumacont </br>");
													}
													
				else{	$sumacont = 10 - $sumatotc[1];
								// print ("TOTAL SUMA CONTROL = 10 - $sumatotc[1] = $sumacont </br>");
														}
														
			$nifcontrolnumero = "0123456789";
			$nifcontrolletra = "JABCDEFGHI";
			 
			$nifnumero = $nifcontrolnumero[$sumacont];
			$nifletra = $nifcontrolletra[$sumacont];
			
			// print ("NUMERO: $nifnumero </br>");
			// print ("LETRA: $nifletra </br>");


		/* FIN DEL LA FUNCION PARA EL CALCULO DE LA LETRA CONTROL DEL NIE/NIF ESPECIAL */


		/* CONDICIONAL PARA TODOS LOS NIE/NIF */
		
	if(($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd') || ($_POST['doc'] == 'NIFepenr')){
		if(strlen(trim($_POST['ldni'])) == 0){
		$errors [] = "LETRA CONTROL NIE/NIF: Campo obligatorio.";
		/* CONDICIONAL PARA TODOS LOS NIE/NIF CON LETRA DE CONTROL */
		}elseif(($_POST['doc'] == 'NIE') || ($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFepenr')){		
			if(!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
				$errors [] = "LETRA CONTROL NIE/NIF: Solo texto.";
			}elseif(!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
				$errors [] = "LETRA CONTROL NIE/NIF: Solo mayusculas.";
				/* CONDICIONAL PARA VALIDAR LA LETRA CONTROL DEL NIE/NIF NORMAL*/
			}elseif($_POST['doc'] == 'NIE'){
				if(trim($_POST['ldni'] != $letra2)){
					$errors [] = "LETRA CONTROL NIE Extranjeros: Letra no correcta.";
				}else{ }
			/* CONDICIONAL PARA VALIDAR LA LETRA CONTROL DEL NIF ESPECIAL Y OTROS CON LETRA */
			}elseif(($_POST['doc'] == 'NIFespecial') || ($_POST['doc'] == 'NIFee') || ($_POST['doc'] == 'NIFcl') || ($_POST['doc'] == 'NIFop') || ($_POST['doc'] == 'NIFcir') || ($_POST['doc'] == 'NIFoaeca') || ($_POST['doc'] == 'NIFepenr')){
				if(trim($_POST['ldni'] != $nifletra)){
					$errors [] = "LETRA CONTROL NIF Especial: Letra no correcta.";
				}else{ }
			}else{ }
		/* FIN CONDICIONAL PARA TODOS LOS NIE/NIF CON LETRA DE CONTROL */
		/* CONDICIONAL PARA TODOS LOS NIF CON NUMERO DE CONTROL */
		}elseif(($_POST['doc'] == 'NIFsa') || ($_POST['doc'] == 'NIFsrl') || ($_POST['doc'] == 'NIFscol') || ($_POST['doc'] == 'NIFscom') || ($_POST['doc'] == 'NIFcbhy') || ($_POST['doc'] == 'NIFscoop') || ($_POST['doc'] == 'NIFasoc') || ($_POST['doc'] == 'NIFcpph') || ($_POST['doc'] == 'NIFsccspj') || ($_POST['doc'] == 'NIFute') || ($_POST['doc'] == 'NIFotnd')){
			if(!preg_match('/^[\d]+$/',$_POST['ldni'])){
				$errors [] = "NUMERO CONTROL NIF Especial : Sólo números.";
				/* CONDICIONAL PARA VALIDAR EL NUMERO DE CONTROL */
			}else{
				if(trim($_POST['ldni'] != $nifnumero)){
					$errors [] = "NUMERO CONTROL NIF Especial: Numero incorrecto.";
				}else{ }
			}
		}else{ } /* fIN CONDICIONAL PARA TODOS LOS NIF CON NUMERO DE CONTROL */
	}else{ } /* FIN PRIMER IF */
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	/* Validamos el campo mail. */
	
	global $sqlml; 		global $qml;

	require "../config/TablesNames.php";
	$sqlml =  "SELECT * FROM `$db_name`.$ClientesWeb WHERE $ClientesWeb.`Email` = '$_POST[Email]'";
	$qml = mysqli_query($db, $sqlml);
	$rowml = mysqli_fetch_assoc($qml);

	if(@$_POST['id'] == @$rowml['id']){

	}elseif(mysqli_num_rows($qml)!= 0){
		$errors [] = "MAIL: Ya Existe.";
	}else{ }
		
	if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "MAIL: Este campo es obligatorio.";
	}elseif(strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "MAIL: Escriba más de cinco carácteres.";
	}elseif(!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "MAIL: Esta dirección no es válida.";
	}else{ }
		
/* if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Email'] , $rowd['Email']))){}
			elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
				$errors [] = "MAIL: No se puede registrar con este Mail.";
				}	
	
	elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
		$errors [] = "MAIL: No se puede registrar con este Mail.";
		}	
*/
	/* Validamos el campo usuario. */
	
	global $sqlus; 		global $qus;

	require "../config/TablesNames.php";
	$sqlus =  "SELECT * FROM `$db_name`.$ClientesWeb WHERE $ClientesWeb.`Usuario` = '$_POST[Usuario]'";
		$qus = mysqli_query($db, $sqlus);
		$rowus = mysqli_fetch_assoc($qus);

	if(@$_POST['id'] == @$rowus['id']){

	}elseif(mysqli_num_rows($qus)!= 0){
		$errors [] = "USUARIO: Ya Existe.";
	}else{ }

	if(strlen(trim($_POST['Usuario'])) == 0){
		$errors [] = "USUARIO: Este campo es obligatorio.";
	}elseif(strlen(trim($_POST['Usuario'])) < 3){
		$errors [] = "USUARIO: Escriba más de tres caracteres.";
	}elseif(!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+]+$/',$_POST['Usuario'])){
		$errors [] = "USUARIO: No se admiten carácteres especiales.";
	}elseif(trim($_POST['Usuario'] != $_POST['Usuario2'])){
		$errors [] = "USUARIO: No son iguales los dos campos usuario.";
	}else{ }
		
/*	
	if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Usuario'] , $rowd['Usuario']))){}
			elseif(!strcasecmp($_POST['Usuario'] , $rowd['Usuario'])){
				$errors [] = "USUARIO: No se puede registrar con este nombre de usuario.";
	}elseif(!strcasecmp($_POST['Usuario'] , $rowd['Usuario'])){
		$errors [] = "USUARIO: No se puede registrar con este nombre de usuario.";
	}	
*/
	/* Validamos el campo password. */
	
	if(strlen(trim($_POST['Password'])) == 0){
		$errors [] = "PASSWORD: Este campo es obligatorio.";
	}elseif(strlen(trim($_POST['Password'])) < 3){
		$errors [] = "PASSWORD: Escriba más de tres caracteres.";
	}elseif(!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+]+$/',$_POST['Password'])){
		$errors [] = "PASSWORD: No se admiten carácteres especiales.";
	}elseif(trim($_POST['Password'] != $_POST['Password2'])){
		$errors [] = "PASSWORD: No son iguales los dos campos password.";
	}else{ }
	
	/* Validamos el campo Dirección. */
	
	if(strlen(trim($_POST['Direccion'])) == 0){
		$errors [] = "DIRECCION: Este campo es obligatorio.";
	}elseif(!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+]+$/',$_POST['Direccion'])){
		$errors [] = "DIRECCION: No se admiten carácteres especiales.";
	}else{ }
		
	/* VALIDAMOS EL CAMPO  Tlf1 */
	 
	global $db; 		global $db_name;

	$sqltlf1 =  "SELECT * FROM `$db_name`.$ClientesWeb WHERE $ClientesWeb.`Tlf1` = '$_POST[Tlf1]' OR $ClientesWeb.`Tlf2` = '$_POST[Tlf1]' ";
	$qtlf1 = mysqli_query($db, $sqltlf1);
	$rowtlf1 = mysqli_fetch_assoc($qtlf1);
	$countlf1 = mysqli_num_rows($qtlf1);

	if(@$_POST['id'] == @$rowtlf1['id']){

	}elseif($countlf1 != 0){
		$errors [] = "TELEFONO 1: YA EXISTE";
	}else{ }

	if(strlen(trim($_POST['Tlf1'])) == 0){
		$errors [] = "TELEFONO 1: CAMPO OBLIGATORIO";
	}elseif((trim($_POST['Tlf1'])) == (trim($_POST['Tlf2']))){
					$errors [] = "Teléfono 1 y 2: SON IGUALES";
	}elseif(!preg_match('/^[\d]+$/',$_POST['Tlf1'])){
		$errors [] = "TELEFONO 1: SOLO NUMEROS";
	}elseif(strlen(trim($_POST['Tlf1'])) < 9){
		$errors [] = "TELEFONO 1: NO MENOS DE 9 NUMEROS";
	}else{ }
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* VALIDAMOS EL CAMPO Tlf2 */
	
	if(strlen(trim($_POST['Tlf2'])) > 0){

		$sqltlf2 =  "SELECT * FROM `$db_name`.$ClientesWeb WHERE $ClientesWeb.`Tlf1` = '$_POST[Tlf2]' OR$ClientesWeb.`Tlf2` = '$_POST[Tlf2]'";
		$qtlf2 = mysqli_query($db, $sqltlf2);
		$rowtlf2 = mysqli_fetch_assoc($qtlf2);
		$countlf2 = mysqli_num_rows($qtlf2);
		
		if(@$_POST['id'] == @$rowtlf2['id']){

		}elseif($countlf2 > 0){
				$errors [] = "TELEFONO 2: YA EXISTE";
		}elseif(!preg_match('/^[\d]+$/',$_POST['Tlf2'])){
				$errors [] = "TELEFONO 2: SOLO NUMEROS";
		}elseif(strlen(trim($_POST['Tlf2'])) < 9){
				$errors [] = "TELEFONO 2: NO MENOS DE 9 NUMEROS";
		}else{ }

	}else{ }
	
/* La función devuelve el array errors. */
	
?>