<?php

    global $defaults;       global $Ordenar;    	global $ProductoValor;      global $Seccion;

   if($ArraySeccionGeneral == 1){

        if((isset($_POST['oculto2']))||(isset($_POST['borrar']))){

                    $defaults = array ( 'id' => $_POST['id'],
                                        'valor' => $_POST['valor'],
                                        'nombre' => $_POST['nombre'],);

        }else{ $defaults = $_POST; }
    
    }elseif($ArraySeccionCrear == 1){

        global $SeccionNombre;		global $SeccionValor; 
        if(isset($_POST['oculto'])){
            //$SeccionNombre = trim(str_replace(' ', '', $_POST['nombre']));
            //$SeccionNombre = strtoupper(trim($SeccionNombre));
            //$SeccionValor = trim(str_replace(' ', '', $_POST['nombre']));
            //$SeccionValor = strtolower(trim($SeccionValor));
                $defaults = array ('valor' => $SeccionValor,
                                    'nombre' => $SeccionNombre,);
        }else{  $defaults = array ( 'valor' => '',
                                    'nombre' => '',);
         }
    
    }elseif($ArraySeccionModificar == 1){

        if(isset($_POST['oculto2'])){
                    $defaults = array ( 'id' => $_POST['id'],
                                        'valor1' => $_POST['valor'],
                                        'valor2' => $_POST['valor'],
                                        'nombre' => $_POST['nombre'],);
        }elseif(isset($_POST['modifica'])){
                    $defaults = array ( 'id' => $_POST['id'],
                                        'valor1' => $_POST['valor1'],
                                        'valor2' => $_POST['valor2'],
                                        'nombre' => $_POST['nombre'],);
        }else{  $defaults = $_POST; }
    
    }else{ }
        

?>