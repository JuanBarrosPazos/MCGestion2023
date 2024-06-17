<?php

    global $FormTitulo;

    global $ordenar;
	$ordenar = array (	'`id` ASC' => 'ID Ascendente',
						'`id` DESC' => 'ID Descendente',
						'`nombre` ASC' => 'Nombre Ascendente',
						'`nombre` DESC' => 'Nombre Descendente',
						'`valor` ASC' => 'Valor Ascenedente',
						'`valor` DESC' => 'Valor Descendente',
																);
	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>".$FormTitulo."</th>
				</tr>
			<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<tr>
					<td align='center'>
						<input type='submit' value='VER SECCIONES' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>ORDENAR POR:</td>
					<td>
			<select name='Orden'>");
				foreach($ordenar as $option => $label){ print ("<option value='".$option."' ");
					if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
									print ("> $label </option>");
												}	
        print ("</select>
					</td>
				</tr>
            		</form>														
    			</table>");

?>