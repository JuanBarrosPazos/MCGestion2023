<?php

	$errors = array();

    if(/*(strlen(trim($_POST['valor'])) == 0)||*/(strlen(trim($_POST['nombre'])) == 0)){
        /*if(strlen(trim($_POST['valor'])) == 0){
            $errors [] = "VALOR: CAMPO OBLIGATORIO";
        }else{ }*/
        if(strlen(trim($_POST['nombre'])) == 0){
            $errors [] = "NOMBRE: CAMPO OBLIGATORIO";
        }else{ }
    }else{
        if(mysqli_num_rows($QrySelectSecciones2) > 0){ 
            $errors [] = "LOS DATOS DE ESTA SECCIÓN SON LOS MISMOS";
        }elseif(mysqli_num_rows($QrySelectSecciones) > 0){ 
            $errors [] = "ESTA SECCION YA EXISTE";
        }else{ }
    }
        
    /*
    if(strlen(trim($_POST['valor'])) < 4){
            $errors [] = "VALOR: MAS DE 3 CARACTERES";
    }elseif(!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['valor'])){
            $errors [] = "VALOR: SOLO TEXTO";
    }elseif(!preg_match('/^[a-z]+$/',$_POST['valor'])){
            $errors [] = "VALOR: MINUSCULAS SIN ESPACIOS NI ACENTOS";
        }
    */   
    if(strlen(trim($_POST['nombre'])) < 5){
            $errors [] = "NOMBRE: MAS DE 4 CARACTERES";
    }elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['nombre'])){
            $errors [] = "NOMBRE: SOLO TEXTO";
    }/*elseif (!preg_match('/^[A-Z\s]+$/',$_POST['nombre'])){
            $errors [] = "NOMBRE: MAYUSCULAS SIN ACENTOS";
        }*/
    else{ }

?>