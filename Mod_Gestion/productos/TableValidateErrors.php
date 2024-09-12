<?php

	global $LogText;	global $ArrayProductosModificarImg;
	global $TableOpen;	global $TableClose;	
	global $ColSpan;	global $Clase;		global $TrTitulo;		global $Style;

	if($ArrayProductosModificarImg == 1){
		$TableOpen = "";			$TableClose = "";
		$ColSpan = "colspan=4"; 	$Clase = "class='BorderSup'";
		$Style = " style='text-align:center !important;'";
	}else{
		$TableOpen = "<table align='center'>";
		$TableClose = "</table>";
		$ColSpan = ""; 		$Clase = "";
		$Style = "style='text-align:left !important; padding-top:0.8em;'";
	}

	if($errors){
		$TrTitulo = "";
		print($TableOpen."
				<tr>
					<th ".$ColSpan." ".$Clase." ".$Style.">
						<font color='#F1BD2D'>** SOLUCIONE ESTOS ERRORES **</font><br/>
					</th>
				</tr>
				<tr>
					<td ".$ColSpan." ".$Style." >");
	
			for($a=0; $c=count($errors), $a<$c; $a++){
					print("<font color='#F1BD2D'>** ".$errors [$a]."</font></br>");
					$LogText = $LogText."- ".$errors[$a]."\n\t";
			}
			print("</td>
				</tr>".$TableClose);

	}else{ $TrTitulo = "<tr>
							<th colspan=4 class='BorderSup' style='padding-top:0.8em; color:#F1BD2D;'>
									SELECCIONE UNA NUEVA IMAGEN
							</th>
						</tr>";
		}

?>