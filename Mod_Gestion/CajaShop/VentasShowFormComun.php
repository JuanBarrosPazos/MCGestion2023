<?php

global $dy1;	global $dyt1;	global $dm1;	global $dd1;

/*
global $db;		global $db_name;
 require "../config/TablesNames.php";

// SELECCIONA SIN REPETICION, EL VALOR DE LAS SECCIONES EN LA TABLA VENTAS DEL AÑO CORRESPODIENTE
$SqlVentasShopSeccion =  "SELECT DISTINCT $VentasShop.`vseccion` FROM $VentasShop ORDER BY `vseccion` ASC ";
echo "**** ".$SqlVentasShopSeccion."<br>";
*/

print("<table align='center' style='border:0px; margin-top:4px;' class='PrintNone' >");

if($_SESSION['Nivel']=='cliente'){
			//if(($_POST['zonaseccion']==1)||(isset($_POST['show_formcl']))){
					require 'VentasShowFormZona.php';
			//}else{ }
}else{
		print("<tr>
				<td colspan=2 style='text-align:center;'>
		<form name='init_compra' method='post' action='caja_00.php' style='display:inline-block;'>
				<button type='submit' title='NUEVA COMPRA' class='botonverde imgButIco AddBlack'></button>
				<input type='hidden' name='init_compra' value=1 />
		</form>	
		<form name='recup_compra' method='post' action='caja_00.php' style='display:inline-block;'>
				<button type='submit' title='RECUPERAR COMPRAS' class='botonazul imgButIco CachedBlack'></button>
				<input type='hidden' name='recup_compra' value=1 />
		</form>
				</td>
			</tr>
			<tr>
				<th colspan=2 >CONSULTAR VENTAS</th>
			</tr>
            <tr>					
			<td colspan=2 style='text-align:center;' >
        <form name='zonaseccion' method='post' action='$_SERVER[PHP_SELF]'>
            <input type='hidden' name='formzonaseccion' value=1 />
            <button type='submit' title='SELECCINE ZONA DEL LOCAL O SECCION PRODUCTO' class='botonazul imgButIco InicioBlack'></button>
				<select name='zonaseccion' style='min-width: 142px; margin: 0.1em !important;' class='botonazul'>
						<option value=''>ZONA LOCAL O SECCION PRODUCTO</option>");
		// CONSTRUYE EL SELECT DE SECCION PRODUCTOS ZONA LOCAL
					foreach($ZonaSeccion as $optionZonaSeccion => $labelZonaSeccion){
						print ("<option value='".$optionZonaSeccion."' ");
						if($optionZonaSeccion == $defaults['zonaseccion']){ print ("selected = 'selected'"); }
						print ("> $labelZonaSeccion </option>");
					}	
			print ("</select>
		</form>	
			</td>
		</tr>");

    if(((isset($_POST['zonaseccion']))&&($_POST['zonaseccion']!=''))||(isset($_POST['show_formcl']))){

			if(($_POST['zonaseccion']==1)||(isset($_POST['show_formcl']))){
					require 'VentasShowFormZona.php';
			}elseif($_POST['zonaseccion']==2){
					require 'VentasShowFormSec.php';
			}else{ }

	}else{ print("<tr>
                    <td>
            <div style='margin: 0.1em auto 0.1em auto; text-align:center;'><font style='color:#F1BD2D;'>ZONA SECCION O PRODUCTO</font><br> SELECCIONE UN CRITERIO DE FILTRO</div> 
                    </td>
                </tr>");
    }

	} // FIN ELSE SI NO SON CLIENTES 
	         
?>