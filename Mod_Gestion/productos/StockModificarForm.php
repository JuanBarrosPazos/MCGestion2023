<?php

	print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 style='text-align:right;' >
			<div style='display:block; margin: 0.4em 0.1em 0.1em 0.1em; text-align:center; width:100%;color:#F1BD2D;'>
							MODIFICAR STOCK EN ".strtoupper($_POST['seccion'])."
			</div>
			<form name='crear' action='ProductosVer.php' method='POST' style='display: inline-block;' >
				<button type='submit' title='INICIO PRODUCTOS' class='botonazul imgButIco InicioBlack'>
				</button>
				<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
					<input type='hidden' name='oculto2' value=1 />
			</form>
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;'>
				<button type='submit' title='MODIFICAR' class='botonverde imgButIco SaveBlack'>
				</button>
					<input type='hidden' name='oculto' value=1 />
					<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
					<input name='id' type='hidden' value='".$_POST['id']."' />
					<input name='producto' type='hidden' value='".$defaults['producto']."' />
					<input name='nsemana' type='hidden' value='".$_POST['nsemana']."' />
						</th>
					</tr>
					<tr>
						<td style='text-align:right;'>ID</td>
						<td>".$_POST['id']."</td>
					</tr>
					<tr>
						<td style='text-align:right;'>PRODUCTO</td>
						<td>".$defaults['producto']."</td>
					</tr>
					<tr>
						<td style='text-align:right;'>WEEK</td>
						<td>".$_POST['nsemana']."</td>
						</tr>
						<tr>
							<td style='text-align:right;'>UNIT ENTRADA</td>
						<td>
		<input name='kgin1' type='number' size='5' maxlength='2' value='".$defaults['kgin1']."' style='text-align:right;' />
		,
		<input name='kgin2' type='number' size='5' maxlength='2' value='".$defaults['kgin2']."' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>PRECIO SIN IVA</td>
					<td>
		<input name='pvp1' type='number' size='5' maxlength='5' value='".$defaults['pvp1']."' style='text-align:right;' />
		,
		<input name='pvp2' type='number' size='5' maxlength='2' value='".$defaults['pvp2']."' />
		&nbsp; €
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TIPO DE IVA</td>
					<td>
						<select name='iva'>");
						foreach($iva as $optioniva => $labeliva){ 
							print ("<option value='".$optioniva."' ");
							if($optioniva == $defaults['iva']){ print ("selected = 'selected'"); }
									print ("> $labeliva </option>");
						}	
	
		print ("</select>
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>€ PVP</td>
					<td>
			<input name='pvp' type='hidden' value='".$pvp."' />".$pvp."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA ENTRADA</td>
					<td>".$_POST['datekgin']."</td>
			<input name='datekgin' type='hidden' value='".$_POST['datekgin']."' />
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA PERECEDEROS</td>
					<td>
	<input type='date' name='datekgbad' min='".$MinDate."' max='".$MaxDate."' value='".$defaults['datekgbad']."' title='FECHA PERECEDEROS MAXIMO 3 MESES' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DATE CASH</td>
					<td>
		<input name='datecash' type='hidden' value='".$defaults['datecash']."' />".$_POST['datecash']."
						</td>
					</tr>
					<tr>
						<td style='text-align:right;'>STOCK</td>
						<td>".$defaults['stock']."</td>
					</tr>
					<tr>
						<td colspan=2 style='text-align:center;'>COMENTARIOS</td>
					</tr>
					<tr>
						<td colspan=2 >
			<textarea cols='46' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment'>".$defaults['coment']."</textarea>
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 200 characters            
				</div>
		</form>														
					</td>
				</tr>
			</table>"); 

?>