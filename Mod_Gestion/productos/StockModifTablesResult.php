<?php

    require '../Inclu/error_hidden.php';

	global $TableStockModif;
	$TableStockModif = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2 >
						<div style='display:inline-block; margin: 0.4em 0.1em 0.1em 0.1em;'>
							NUEVOS DATOS
						</div>
		<form name='crear' action='ProductosVer.php' method='POST' style='display: inline-block; float:right;' >
				<button type='submit' title='INICIO PRODUCTOS' class='botonverde imgButIco InicioBlack'>
				</button>
				<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
					<input type='hidden' name='oculto2' value=1 />
			</form>
					</th>
				</tr>
				<tr>
					<td style='text-align:right;' >WEEK</td>
					<td>".$RowSelectProductos['nsemana']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>PRODUCT REF</td>
					<td>".$_POST['producto']."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>PRODUCT NAME</td>
					<td>".$RowSelectProductos['nombre']."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>FECHA ENTRADA</td>
					<td>".$_POST['datekgin']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA PERECEDEROS</td>
					<td>".$datekgbad."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT ENTRADA</td>
					<td>".$kgin."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>STOCK</td>
					<td>".$diferencia."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>PERECEDEROS</td>
					<td>".$RowSelectProductos['kgbad']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>PVP NETO</td>
					<td>".$psiva." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TIPO IVA</td>
					<td>".$_POST['iva']." %</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IVA €</td>
					<td>".$ivae." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>PVP €</td>
					<td>".$pvp." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DATE CASH</td>
					<td>".$date."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>CAJA TOT €</td>
					<td>".$pvptot." €</td>
				</tr>
				<tr>
					<td colspan=2 style='text-align:center;'>COMENTARIOS</td>
				</tr>
				<tr>
					<td colspan=2 width=200px>".$_POST['coment']."</td>
				</tr>
			</table>";	 

	global $TablePerecederos;
	$TablePerecederos = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2 >
						<div style='display:inline-block; margin: 0.4em 0.1em 0.1em 0.1em;'>
							NUEVOS DATOS
						</div>
		<form name='crear' action='ProductosVer.php' method='POST' style='display: inline-block; float:right;' >
				<button type='submit' title='INICIO PRODUCTOS' class='botonverde imgButIco InicioBlack'>
				</button>
				<input name='seccion' type='hidden' value='".$_POST['seccion']."' />
					<input type='hidden' name='oculto2' value=1 />
			</form>
					</th>
				</tr>
				<tr>
					<td style='text-align:right;' >WEEK</td>
					<td>".$RowSelectProductos['nsemana']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>PRODUCT REF</td>
					<td>".$_POST['producto']."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>PRODUCT NAME</td>
					<td>".$RowSelectProductos['nombre']."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>UNIT € PSIVA</td>
					<td>".$RowSelectProductos['psiva']." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TIPO IVA</td>
					<td>".$RowSelectProductos['iva']." %</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IVA €</td>
					<td>".$RowSelectProductos['ivae']." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT € PVP</td>
					<td>".$RowSelectProductos['pvp']." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA ENTRADA</td>
					<td>".$RowSelectProductos['datekgin']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT ENTRADA</td>
					<td>".$RowSelectProductos['kgin']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>STOCK</td>
					<td>".$Stock."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>VENTAS</td>
					<td>".$RowSelectProductos['kgcash']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT PERECEDEROS</td>
					<td>".$perecedero."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA PERECEDEROS</td>
					<td>".$datekgbad."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DATE CASH</td>
					<td>".$date."</td>
				</tr>
			</table>";	 


?>