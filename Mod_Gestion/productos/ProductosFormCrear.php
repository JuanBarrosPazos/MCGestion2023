<?php

	print("<table align='center' style=\"margin-top:10px\">
			<tr>					
				<th colspan=2 >NUEVO PRODUCTO EN ".$defaults['seccion']."</th>
			</tr>
			<tr>								
				<td>
				</td>
			</tr>
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
		<input type='hidden' name='seccion' value='".$defaults['seccion']."' />
		<input type='hidden' name='valor' value='".$defaults['valor']."' />
		<input type='hidden' name='kgcash1' value='".$defaults['kgcash1']."' />
		<input type='hidden' name='kgcash2' value='".$defaults['kgcash2']."' />
		<input type='hidden' name='nsemana' value='".$defaults['nsemana']."' />
		<input type='hidden' name='pvp' value='".$pvp."' />
		<input type='hidden' name='datekgin' value='".$defaults['datekgin']."' />
		<input type='hidden' name='datecash' value='".$defaults['datecash']."' />
		<input type='hidden' name='kgbad1' value='".$defaults['kgbad1']."' />
		<input type='hidden' name='kgbad2' value='".$defaults['kgbad2']."' />
			<tr>
				<td style='text-align:right;'>NOMBRE <font color='#F1BD2D'>*</font></td>
				<td>
		<input type='text' name='nombre' size=38 maxlength=14 value='".$defaults['nombre']."' pattern='[A-Z0-9\s]{5,14}' placeholder='MAYUSCULAS O NUMEROS MINIMO 5' required />
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>REFERENCIA <font color='#F1BD2D'>*</font></td>
				<td>
		<input type='text' name='ref' size=38 maxlength=14 value='".$defaults['ref']."' pattern='[a-z0-9]{7,14}' placeholder='MINUSCULAS O _ \" SIN ESPACIOS\" MIN. 8' required />
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>WEEK</td>
				<td>".$semana."</td>
			</tr>
			<tr>
				<td style='text-align:right;'>UNIT ENTRADA<font color='#F1BD2D'>*</font></td>
				<td>
		<input name='kgin1' type='number' size='5' maxlength='2' value='".$defaults['kgin1']."' style='text-align:right;' />
		,
		<input name='kgin2' type='number' size='5' maxlength='2' value='".$defaults['kgin2']."' />
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>€ PVP SIN IVA<font color='#F1BD2D'>*</font></td>
				<td>
		<input name='pvp1' type='number' size='5' maxlength='5' value='".$defaults['pvp1']."' style='text-align:right;' />
		,
		<input name='pvp2' type='number' size='5' maxlength='2' value='".$defaults['pvp2']."' />
			&nbsp;€
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>TIPO DE IVA<font color='#F1BD2D'>*</font></td>
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
				<td style='text-align:right;'>PVP € </td>
				<td>".$pvp."</td>
			</tr>
			<tr>
				<td style='text-align:right;'>FECHA ENTRADA</td>
				<td>".$date."</td>
			</tr>
			<tr>
				<td style='text-align:right;'>FECHA PERECEDEROS</td>
				<td>
		<input type='date' name='datekgbad' min='".$MinDate."' max='".$MaxDate."' value='".$defaults['datekgbad']."' title='FECHA PERECEDEROS MAXIMO 3 MESES' />
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>DATE CASH</td>
				<td>".$date."</td>
			</tr>
			<tr>
				<td style='text-align:right;'>COMENTARIOS</td>
				<td>
		<textarea cols='35' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment' pattern='[A-Z0-9\.\,\s]{4,23}' placeholder='CARACTERES NO PERMITIDOS { } [ ] ¿ ? < > ¡ ! @ #'>".$defaults['coment']."</textarea>
		</br>
			<div id='infoc' align='center' style='color:#0080C0;'>
						Maximum 200 characters            
			</div>
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>FOTOGRAFÍA 1</td>
				<td>
		<input type='file' name='myimg1' value='".$defaults['myimg1']."' />						
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>FOTOGRAFÍA 2</td>
				<td>
		<input type='file' name='myimg2' value='".$defaults['myimg2']."' />						
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>FOTOGRAFÍA 3</td>
				<td>
		<input type='file' name='myimg3' value='".$defaults['myimg3']."' />						
				</td>
			</tr>
			<tr>
				<td style='text-align:right;'>FOTOGRAFÍA 4</td>
				<td>
		<input type='file' name='myimg4' value='".$defaults['myimg4']."' />						
				</td>
			</tr>
			<tr>
				<td colspan=2 style='text-align:right; vertical-align:middle;' >
			<button type='submit' title='CREAR PRODUCTO' class='botonverde imgButIco SaveBlack'>
			</button>
				<input type='hidden' name='oculto' value=1 />
	</form>														
				</td>
			</tr>
		</table>"); 

?>