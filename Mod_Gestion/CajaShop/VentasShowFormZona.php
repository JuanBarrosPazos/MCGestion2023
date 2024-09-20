<?php

	//require 'VentasShowFormComun.php';
    print("<tr>
				<td style='text-align:right;'>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<button type='submit' title='FILTRO VENTAS' class='botonlila imgButIco BuscaBlack'></button>
				<input type='hidden' name='show_formcl' value=1 />
					</td>
					<td>");

	require 'VentasShowFormDate.php';

	print("</td></tr>");

	if($_SESSION['Nivel']!='cliente'){

		print("<tr>					
					<td></td>
					<td>
						<div style='float:left'>
					<select name='zonalocal' style='min-width: 142px; margin: 0.1em !important;' class='botonazul'>
							<option value=''>ZONA DEL LOCAL</option>");
			// CONSTRUYE EL SELECT DE ZONAS DEL LOCAL
						foreach($ZonaLocal as $optionZonaLocal => $labelZonaLocal){
							print ("<option value='".$optionZonaLocal."' ");
							if($optionZonaLocal == $defaults['zonalocal']){ print ("selected = 'selected'"); }
							print ("> $labelZonaLocal </option>");
						}	
				print ("</select>
				</div>
					<input type='text' name='Nombre' size=24 maxlength=16 value='".$defaults['Nombre']."' pattern='[a-zA-Z0-9\s]{3,16}' placeholder='CRITERIO DE BUSQUEDA' style='margin: 0.1em 0.1em 0.1em 0.6em; display: inline-block;' />
				</td>
			</tr>");
	// FIN SI NO ES CLIENTE
	}else{ }

	print("</form></table>");	

?>