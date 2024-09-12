<?php

	print("<input type='hidden' name='zonaseccion' value='".$defaults['zonaseccion']."' />
			<input type='hidden' name='seccion' value='".$defaults['seccion']."' />
				<div style='float:left'>
					<select name='Orden' class='botonlila' style='min-width: 142px;'>");
				foreach($Ordenar as $option => $label){
					print ("<option value='".$option."' ");
					if($option == $defaults['Orden']){ print ("selected = 'selected'"); }
					print ("> $label </option>");
				}	
						
	print("</select>
				</div>
				<div style='float:left'>
					<select name='dy' class='botonlila' >");
					foreach($dy as $optiondy => $labeldy){
						print ("<option value='".$optiondy."' ");
						if($optiondy == $defaults['dy']){ print ("selected = 'selected'"); }
						print ("> $labeldy </option>");
					}	

	print("</select>
				</div>
				<div style='float:left'>
					<select name='dm' class='botonlila' >");
					foreach($dm as $optiondm => $labeldm){
						print ("<option value='".$optiondm."' ");
						if($optiondm == $defaults['dm']){ print ("selected = 'selected'"); }
						print ("> $labeldm </option>");
					}	
																
	print("</select>
				</div>
				<div style='float:left'>
					<select name='dd' class='botonlila' >");
					foreach($dd as $optiondd => $labeldd){
						print ("<option value='".$optiondd."' ");
							if($optiondd == $defaults['dd']){ print ("selected = 'selected'"); }
							print ("> $labeldd </option>");
					}	
																
	print("</select>
				</div>");

?>