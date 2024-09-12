<?php

	global $LogText;
	if($errors){
		print("	<table align='center' style='color:#F1BD2D;' >
				<tr>
					<th style='text-align:center'>
						** SOLUCIONE ESTOS ERRORES **<br/>
					</th>
				</tr>
				<tr>
					<td style='text-align:left !important'>");

			$LogText = $LogText."\n\t** ERRORES DETECTADOS\n\t";
			for($a=0; $c=count($errors), $a<$c; $a++){
					print("** ".($a+1).". ".$errors [$a]."</br>");
					$LogText = $LogText."- ".($a+1).". ".$errors[$a]."\n\t";
				}
			print("</td>
				</tr>
			</table>");
		}else{ }

?>