<?php

	global $LogText;
	if($errors){

		print("	<table align='center' style='color:#F1BD2D; font-size: 1.0em !important;'>
				<tr>
					<th style='text-align:center'>
						** SOLUCIONE ESTOS ERRORES **
					</th>
				</tr>
				<tr>
					<td style='text-align:left !important'>");
	
			for($a=0; $c=count($errors), $a<$c; $a++){
					print("** ".$errors [$a]."</br>");
					$LogText = $LogText."- ".$errors[$a]."\n\t";
				}
			print("</td>
				</tr>
			</table>");
		}else{ }

?>