<?php

	print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 style='text-align:right;' >
			<div style='display:block; margin: 0.4em 0.1em 0.1em 0.1em; text-align:center; width:100%;color:#F1BD2D;'>
							".strtoupper($_POST['seccion'])." MODIFICAR PERECEDEROS
			</div>
			<form name='crear' action='ProductosVer.php' method='POST' style='display: inline-block;' >
				<button type='submit' title='INICIO PRODUCTOS' class='botonazul imgButIco InicioBlack'>
				</button>
				<input type='hidden' name='id' value='".$_POST['id']."' />
				<input type='hidden' name='seccion' value='".$_POST['seccion']."' />
				<input type='hidden' name='oculto2' value=1 />
			</form>
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;'>
					<input type='hidden' name='seccion' value='".$_POST['seccion']."' />
					<input type='hidden' name='id' value='".$_POST['id']."' />
					<input type='hidden' name='producto' value='".$defaults['producto']."' />
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
						<td style='text-align:right;'>PRECIO SIN IVA</td>
						<td>".$RowSelectProductos['psiva']."&nbsp; €</td>
					</tr>
					<tr>
						<td style='text-align:right;'>TIPO DE IVA</td>
						<td>".$RowSelectProductos['iva']." %</td>
					</tr>
					<tr>
						<td style='text-align:right;'>€ PVP</td>
						<td>".$RowSelectProductos['pvp']."</td>
					</tr>
					<tr>
						<td style='text-align:right;'>FECHA ENTRADA</td>
						<td>".$RowSelectProductos['datekgin']."</td>
					</tr>
					<tr>
						<td style='text-align:right;'>FECHA PERECEDEROS</td>
						<td>
	<input type='date' name='datekgbad' min='".$MinDate."' max='".$MaxDate."' value='".$defaults['datekgbad']."' title='FECHA PERECEDEROS MAXIMO 3 MESES' />
						</td>
					</tr>
					<tr>
						<td style='text-align:right;'>PERECEDEROS </td>
						<td>
	<input name='kgbad1' type='number' size='5' maxlength='2' value='".$defaults['kgbad1']."' style='text-align:right;' />
	,
	<input name='kgbad2' type='number' size='5' maxlength='2' value='".$defaults['kgbad2']."' />
						</td>
					</tr>
					<tr>
						<td colspan=2 style='text-align:right;'>
							<button type='submit' title='MODIFICAR' class='botonverde imgButIco SaveBlack'>
							</button>
								<input type='hidden' name='oculto' value=1 />
				</form>														
						</td>
					</tr>

					<tr>
						<td colspan=2 style='text-align:center; color:#F1BD2D;' class='BorderSup'>
							RESUMEN ENTRADAS STOCK
						</td>
					</tr>
					<tr>
						<td style='text-align:right;'>PERECEDEROS </td>
						<td>".$RowSelectProductos['kgbad']."</td>
					</tr>
					<tr>
						<td style='text-align:right;'>UNIDADES CAJA </td>
						<td>".$RowSelectProductos['kgcash']."</td>
					</tr>
					<tr>
						<td style='text-align:right;' >STOCK </td>
						<td>".$RowSelectProductos['stock']."</td>
					</tr>
					<tr>
						<td style='text-align:right;'>UNIT ENTRADA </td>
						<td>".$RowSelectProductos['kgin']."</td>
				</tr>
			</table>");


?>