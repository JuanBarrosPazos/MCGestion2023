<?php

    global $dy1;	global $dyt1;	global $dm1;	global $dd1;

    global $db;		global $db_name;
 	require "../config/TablesNames.php";

	// SELECCIONA SIN REPETICION, EL VALOR DE LAS SECCIONES EN LA TABLA VENTAS DEL AÑO CORRESPODIENTE
	$SqlVentasShopSeccion =  "SELECT DISTINCT $VentasShop.`vseccion` FROM $VentasShop ORDER BY `vseccion` ASC ";
    echo "**** ".$SqlVentasShopSeccion."<br>";
	$QryVentasShopSeccion = mysqli_query($db, $SqlVentasShopSeccion);
	$CountVentasShopSeccion = mysqli_num_rows($QryVentasShopSeccion);

	print("<tr><td>
        <form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;'>
		<button type='submit' title='CONSULTAR SECCIONES' class='botonlila imgButIco InicioBlack' style='float:left;'></button>
		<input type='hidden' name='formseccion' value=1 />");

	require 'VentasShowFormDate.php';

	print("</td>
			</tr>
			<tr>
			<td colspan=2 style='text-align:center'>");

	// INICIO LA CUNSULTA NO ES 0
	if($CountVentasShopSeccion>0){

	print("<select name='seccion' style='vertical-align: top !important; margin: 0.2em 0.2em 0.1em 0.2em; min-width:10.0em;' class='botonverde'>
				<option value=''>SECCIONES</option>");
	if(!$QryVentasShopSeccion){ 
				print("* ERROR SQL L.9 ".mysqli_error($db)."</br>");
	}else{
		while($RowVentasShopSeccion = mysqli_fetch_assoc($QryVentasShopSeccion)){
			// CONSULTA EN SECCIONES CON PRODUCTOS
			$SqlSecciones =  "SELECT * FROM $Secciones WHERE `valor`='$RowVentasShopSeccion[vseccion]' ORDER BY `valor` ASC ";
			//$sqlb =  "SELECT * FROM $Secciones ORDER BY `valor` ASC ";
			$QrySecciones = mysqli_query($db, $SqlSecciones);
				// IMPRIME EL SELECT DESPLEGABLE CON LAS SECCIONES
			if(!$QrySecciones){ print("* ERROR SQL L.2562 ".mysqli_error($db)."</br>");
			}else{ 	$RowsSecciones = mysqli_fetch_assoc($QrySecciones);
					print ("<option value='".$RowsSecciones['valor']."' ");
					if($RowsSecciones['valor'] == $defaults['seccion']){ print ("selected = 'selected'"); }
						print ("> ".$RowsSecciones['nombre']." </option>");
			}
		} // FIN PRIMER WHILE
	} // FIN ELSE CONSULTA $SqlProductoSeccion

	print ("</select></form>");	

    if(((isset($_POST['formseccion']))&&($_POST['seccion']!=''))
			||(isset($_POST['formproducto'])&&(isset($_POST['producto'])))
		){
        // SELECCIONA SIN REPETICION, EL VALOR DE LOS PRODUCTOS EN LA TABLA VENTAS DEL AÑO CORRESPODIENTE
	print("<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;' >
        <button type='submit' title='CONSULTAR PRODUCTOS' class='botonazul imgButIco BuscaBlack' ></button>
			<input type='hidden' name='formproducto' value=1 />
			<input type='hidden' name='zonaseccion' value='".$defaults['zonaseccion']."' />
			<input type='hidden' name='seccion' value='".$defaults['seccion']."' />
			<input type='hidden' name='Orden' value='".$defaults['Orden']."' />
			<input type='hidden' name='dy' value='".$defaults['dy']."' />
			<input type='hidden' name='dm' value='".$defaults['dm']."' />
			<input type='hidden' name='dd' value='".$defaults['dd']."' />
	    <select name='producto' style='vertical-align: top !important; margin: 0.2em 0.2em 0.1em -0.1em; min-width:10.0em;' class='botonazul' >
			<option value=''>PRODUCTOS</option>");
    	    $sqlp = "SELECT * FROM $Productos WHERE `vseccion` = '$_POST[seccion]' ORDER BY `valor` ASC";
			$qp = mysqli_query($db, $sqlp);
			    if(!$qp){
			    		print("* ERROR SQL L.2589 ".mysqli_error($db)."</br>");
			    }else{
			    	while($rowp = mysqli_fetch_assoc($qp)){
			    		print ("<option value='".$rowp['valor']."' ");
			    			if($rowp['valor'] == $defaults['producto']){ print ("selected = 'selected'"); }
			    				print ("> ".$rowp['nombre']." </option>");
			    	}
			    } 
		print ("</select></form>");

        if((isset($_POST['formproducto']))&&($_POST['producto']=='')){
            print("<tr align='center'>
                        <td colspan=2 class='BorderInf' >
                            <font style='color:#F1BD2D;' ><b>SELECCIONE UN PRODUCTO</font>
                        </td>
                    </tr>");
        }else{ }

	}elseif((isset($_POST['formseccion']))&&($_POST['seccion']=='')){
        print("<tr align='center'>
                    <td colspan=2 class='BorderInf' >
                        <font style='color:#F1BD2D;' ><b>SELECCIONE UNA SECCION</font>
                    </td>
                </tr>");
    }else{ }

	 // FIN LA CUNSULTA NO ES 0
	}else{
		print("<font style='color:#F1BD2D;' ><b>NO HAY SECCIONES EN ".strtoupper($VentasShop)."</font>");
	}
	
	print("</td></tr></table>");




?>