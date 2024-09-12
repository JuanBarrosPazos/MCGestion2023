<?php

    global $defaults;       global $ordenar;    	global $ProductoValor;      global $Seccion;

    if($ArrayProductosVer == 1){

        switch (true) {
            case (isset($_POST['seccion'])):
                $Seccion = $_POST['seccion'];
                break;
            case (isset($_GET['seccion'])):
                $Seccion = $_GET['seccion'];
                break;
            default:
                $Seccion = '';
                break;
        }
    
    }elseif($ArrayProductosCrear == 1){

        if((isset($_POST['oculto1']))&&($_POST['seccion']!="")){
            //$defaults = $_POST;
            $defaults = array (	'seccion' => $_POST['seccion'],'valor' => '','nombre' => '',
                                'ref' => '','nsemana' => $semana,
                                'datekgin' => '', 'kgin1' => '0','kgin2' => '00',
                                'pvp1' => '0','pvp2' => '00',
                                'iva' =>  '21','psiva' => '0.00',
                                'pvp' => '0.00','pvptot' => '0.00',
                                'datekgbad' => '','kgbad1' => '0','kgbad2' => '00',
                                'datecash' => $date,'kgcash1' => '0','kgcash2' => '00',
                                'coment' => '',
                                'myimg1' => '','myimg2' => '','myimg3' => '','myimg4' => '',);
        }elseif(isset($_POST['oculto'])){
            $defaults = array (	'seccion' => $_POST['seccion'],'valor' => $ProductoValor,
                                'nombre' => $_POST['nombre'],'ref' => $_POST['ref'],
                                'nsemana' => $semana,
                                'datekgin' => $_POST['datekgin'],
                                'kgin1' => $_POST['kgin1'],'kgin2' => $_POST['kgin2'],
                                'pvp1' => $_POST['pvp1'],'pvp2' => $_POST['pvp2'],
                                   'iva' =>  $_POST['iva'],
                                   'psiva' => $psiva,'pvp' => $pvp,'pvptot' => $pvptot,
                                'datekgbad' => $_POST['datekgbad'],'kgbad1' => '0','kgbad2' => '00',
                                'datecash' => $date,'kgcash1' => '0','kgcash2' => '00',
                                'coment' => $_POST['coment'],
                                'myimg1' => @$_POST['myimg1'],'myimg2' => @$_POST['myimg2'],
                                'myimg3' => @$_POST['myimg3'],'myimg4' => @$_POST['myimg4'],);
        }else{ 	$defaults = array (	'seccion' => '','valor' => '','nombre' => '',
                                    'ref' => '','nsemana' => $semana,
                                    'datekgin' => '','kgin1' => '0','kgin2' => '00',
                                    'pvp1' => '0','pvp2' => '00',
                                    'iva' =>  '21','psiva' => '0.00',
                                    'pvp' => '0.00','pvptot' => '0.00',
                                    'datekgbad' => '','kgbad1' => '0','kgbad2' => '00',
                                    'datecash' => $date,'kgcash1' => '0','kgcash2' => '00',
                                    'coment' => '',
                                    'myimg1' => '','myimg2' => '','myimg3' => '','myimg4' => '',);
        }

    	$iva = array ('' => 'IVA','21' => '21 %','10' => '10 %','4' => '4 %',);

    }elseif($ArrayProductosModificar ==1){

        	if($_POST['oculto2']){
				$defaults = array ( 'id' => $_POST['id'],'seccion' => $_POST['seccion'],
									'valor1' => $_POST['valor'],'valor2' => $_POST['valor'],
								   	'nombre' => $_POST['nombre'],'ref' => $_POST['ref'],);
            }elseif($_POST['oculto']){
                        $defaults = array ( 'id' => $_POST['id'],'seccion' => $_POST['seccion'],
                                            'valor1' => $_POST['valor1'],'valor2' => $_POST['valor2'],
                                            'nombre' => $_POST['nombre'],'ref' => $_POST['ref'],);
            }else{ $defaults = $_POST; }

    }elseif($ArrayProductosModificarImg == 1){

        	if(isset($_POST['myimg1'])){ 
                    $_SESSION['GestMyImg'] = $_SESSION['myimg1'];
                    $_SESSION['imgcamp'] = "myimg1";
            }else{ }
            if(isset($_POST['myimg2'])){ 
                    $_SESSION['GestMyImg'] = $_SESSION['myimg2'];
                    $_SESSION['imgcamp'] = "myimg2";
            }else{ }
            if(isset($_POST['myimg3'])){ 
                    $_SESSION['GestMyImg'] = $_SESSION['myimg3'];
                    $_SESSION['imgcamp'] = "myimg3";
            }else{ }
            if(isset($_POST['myimg4'])){ 
                    $_SESSION['GestMyImg'] = $_SESSION['myimg4'];
                    $_SESSION['imgcamp'] = "myimg4";
            }else{ }

            if(isset($_POST['oculto2'])){
                        $_SESSION['GestMyImg'] = $_SESSION['myimg1'];
                        $_SESSION['imgcamp'] = "myimg1";
                        $defaults = array ( 'seccion' => $_POST['seccion'],
                                            'id' => $_POST['id'],
                                            'valor' => $_POST['valor'],
                                            'nombre' => $_POST['nombre'],
                                            'ref' => $_POST['ref'],											
                                            'myimg' => $_POST['myimg1'],);
            }elseif((isset($_POST['myimg1']))||(isset($_POST['myimg2']))||(isset($_POST['myimg3']))||(isset($_POST['myimg4']))){
                        $defaults = array ( 'seccion' => $_SESSION['miseccion'],
                                            'id' => $_SESSION['miid'],
                                            'valor' => $_SESSION['mivalor'],
                                            'nombre' => $_SESSION['minombre'],
                                            'ref' => $_SESSION['miref'],											
                                            'myimg' => $_SESSION['GestMyImg'],);
            }elseif(isset($_POST['imagenmodif'])){
                        $defaults = array ( 'seccion' => $_SESSION['miseccion'],
                                            'id' => $_SESSION['miid'],
                                            'valor' => $_SESSION['mivalor'],
                                            'nombre' => $_SESSION['minombre'],
                                            'ref' => $_SESSION['miref'],											
                                            'myimg' => $_SESSION['GestMyImg'],);
            }

    }elseif($ArrayProductosBorrar == 1){

        if(isset($_POST['oculto2'])){
            $defaults = array ( 'id' => $_POST['id'],
                                'seccion' => $_POST['seccion'],
                                'valor' => $_POST['valor'],
                                   'nombre' => $_POST['nombre'],
                                   'ref' => $_POST['ref'],
                                   'coment' => $_POST['coment'],);
        }elseif(isset($_POST['oculto'])){
            $defaults = array ( 'id' => $_POST['id'],
                                'seccion' => $_POST['seccion'],
                                'valor' => $_POST['valor'],
                                   'nombre' => $_POST['nombre'],
                                   'ref' => $_POST['ref'],
                                   'coment' => $_POST['coment'],);
        }else{ $defaults = $_POST; }
    
    }elseif($ArrayProductosVerFeed == 1){

        if((isset($_POST['oculto1']))||(isset($_POST['oculto2']))){
            $defaults = array ('seccion' => @$_POST['seccion'],
                                'Orden' => $ordenar,);
        }elseif(isset($_POST['oculto'])){
            $defaults = $_POST;
        }elseif(isset($_GET['seccion'])){	
            $defaults = array ('seccion' => $_GET['seccion'],
                                'Orden' => $ordenar,);
        }else{	
            $defaults = array ('seccion' => '',
                                'Orden' => $ordenar,);
        }
    
    }elseif($ArrayProductosRecuperarFeed == 1){

        if(isset($_POST['oculto2'])){
            $defaults = array ( 'id' => $_POST['id'],
                                'seccion' => $_POST['seccion'],
                                'valor' => $_POST['valor'],
                                   'nombre' => $_POST['nombre'],
                                   'ref' => $_POST['ref'],
                                'borrado' => $_POST['borrado'],
                                   'coment' => $_POST['coment'],);
        }elseif(isset($_POST['oculto'])){
            $defaults = array ( 'id' => $_POST['id'],
                                'seccion' => $_POST['seccion'],
                                'valor' => $_POST['valor'],
                                   'nombre' => $_POST['nombre'],
                                   'ref' => $_POST['ref'],
                                'borrado' => $_POST['borrado'],
                                   'coment' => $_POST['coment'],);
        }else{ $defaults = $_POST; }
    
    }elseif($ArrayProductosBorrarFeed == 1){

        if(isset($_POST['oculto2'])){
            $defaults = array ( 'id' => $_POST['id'],
                                'seccion' => $_POST['seccion'],
                                'valor' => $_POST['valor'],
                                'nombre' => $_POST['nombre'],
                                'ref' => $_POST['ref'],
                                'coment' => $_POST['coment'],
                                'borrado' => $_POST['borrado'],
                                'myimg1' => $_POST['myimg1'],
                                'myimg2' => $_POST['myimg2'],
                                'myimg3' => $_POST['myimg3'],
                                'myimg4' => $_POST['myimg4'],);
        }elseif(isset($_POST['oculto'])){
            $defaults = array ( 'id' => $_POST['id'],
                                'seccion' => $_POST['seccion'],
                                'valor' => $_POST['valor'],
                                'nombre' => $_POST['nombre'],
                                'ref' => $_POST['ref'],
                                'coment' => $_POST['coment'],
                                'borrado' => $_POST['borrado'],
                                'myimg1' => $_POST['myimg1'],
                                'myimg2' => $_POST['myimg2'],
                                'myimg3' => $_POST['myimg3'],
                                'myimg4' => $_POST['myimg4'],);
        }else{ $defaults = $_POST; }
    
    }elseif($ArrayStockModificar == 1){

		if(isset($_POST['oculto2'])){

			$nc = strlen(trim($_POST['psiva']));
			$nc = $nc - 3;
			$pvp1 = substr($_POST['psiva'],0,$nc);
			$pvp2 = substr($_POST['psiva'],-2,2);
	
			$nkgin = strlen(trim($_POST['kgin']));
			$nkgin = $nkgin - 3;
			$kgin1 = substr($_POST['kgin'],0,$nkgin);
			$kgin2 = substr($_POST['kgin'],-2,2);
	
			$nkgbad = strlen(trim($_POST['kgbad']));
			$nkgbad = $nkgbad - 3;
			$kgbad1 = substr($_POST['kgbad'],0,$nkgbad);
			$kgbad2 = substr($_POST['kgbad'],-2,2);
	
			$nkgcash = strlen(trim($_POST['kgcash']));
			$nkgcash = $nkgcash - 3;
			$kgcash1 = substr($_POST['kgcash'],0,$nkgcash);
			$kgcash2 = substr($_POST['kgcash'],-2,2);
	
			$entrada = $kgin1.".".$kgin2;
			$entrada = floatval($entrada);	        $entrada = number_format($entrada,2,".","");

			$perecedero = $kgbad1.".".$kgbad2;
			$perecedero = floatval($perecedero);	$perecedero = number_format($perecedero,2,".","");

			$CajaShop = $kgcash1.".".$kgcash2;
			$CajaShop = floatval($CajaShop);	    $CajaShop = number_format($CajaShop,2,".","");
	
			//$ivaef = "&nbsp; + ".$_POST['ivae']." €.";
			$pvp = $_POST['pvp'];
			$pvp = floatval($pvp);	    			$pvp = number_format($pvp,2,".","");

			$pvptot = $_POST['pvptot'];
			$pvptot = floatval($pvptot);	    	$pvptot = number_format($pvptot,2,".","");

			$defaults = array ( 'seccion' => $_POST['seccion'],'id' => $_POST['id'],
								'nsemana' => $_POST['nsemana'],
								'producto' => $_POST['producto'],'proname' => $_POST['proname'],
								'pvp1' => $pvp1,'pvp2' => $pvp2,
							   	'psiva' =>  $_POST['psiva'],
							   	'iva' =>  $_POST['iva'],'ivae' =>  $_POST['ivae'],
								'pvp' => $pvp,'pvptot' => $pvptot,
								'kgin1' => $kgin1,'kgin2' => $kgin2,
								'datekgin' => $_POST['datekgin'],
								'kgbad1' => $kgbad1,'kgbad2' => $kgbad2,
								'datekgbad' => $_POST['datekgbad'],
								'kgcash1' => $kgcash1,'kgcash2' => $kgcash2,
								'datecash' => $_POST['datecash'],'stock' => $_POST['stock'],
								'coment' => $_POST['coment'],);

        }elseif(isset($_POST['oculto'])){
                    require 'FormatNumber.php';
                    $defaults = $_POST;
                    $defaults['stock'] = $diferencia;
                    $defaults['pvptot'] = $pvptot;
        }else{ }
	
        $iva = array ( '' => 'IVA','21' => '21 %','10' => '10 %','4' => '4 %',);

    }elseif($ArrayStockPerecederos == 1){
        
		if(isset($_POST['oculto2'])){

			$nc = $RowSelectProductos['psiva'];
			$nc = $nc - 3;
	
			$nkgin = $RowSelectProductos['kgin'];
			$nkgin = $nkgin - 3;
	
			$pvp = $RowSelectProductos['pvp'];
			$pvp = floatval($pvp);	    			$pvp = number_format($pvp,2,".","");

			$pvptot = $RowSelectProductos['pvptot'];
			$pvptot = floatval($pvptot);	    	$pvptot = number_format($pvptot,2,".","");

			$defaults = array ( 'seccion' => $_POST['seccion'],
								'id' => $_POST['id'],
								'producto' => $_POST['producto'],
								'proname' => $_POST['proname'],
								'datekgbad' => $_POST['datekgbad'],
								'kgbad1' => '0','kgbad2' => '00',);

        }elseif(isset($_POST['oculto'])){
                    $defaults = $_POST;
        }else{ }
        
        $iva = array ( '' => 'IVA','21' => '21 %','10' => '10 %','4' => '4 %',);

    }else{ }

?>