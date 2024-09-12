<?php

	require '../Inclu/error_hidden.php';
	
	global $TablaResultCrear;
	$TablaResultCrear = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 style='text-align:right;' >".$ProductosBotonera."</th>
				</tr>				
				<tr>
					<th colspan=2>SE HA CREADO EN ".$_POST['seccion']."</th>
				</tr>
				<tr>
					<td style='text-align:right;'>DATE CASH</td><td>".$date."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>WEEK</td><td>".$semana."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>VALOR</td>
					<td>".$ProductoValor."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>NOMBRE</td>
					<td>".$_POST['nombre']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>REFERENCIA</td>
					<td>".$_POST['ref']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT ENTRADA</td><td>".$kgin."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT € PSIVA</td><td>".$psiva." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TIPO IVA</td><td>".$_POST['iva']." %</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IVA €</td><td>".$ivae." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT € PVP</td><td>".$pvp." €</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA ENTRADA</td><td>".$date."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT PERECEDEROS</td><td>".$kgbad."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA PERECEDEROS</td><td>".$_POST['datekgbad']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>UNIT CAJA</td><td>".$kgcash."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>DATE CASH</td><td>".$date."</td>
				</tr>
				<tr>
					<td colspan=2>COMENTARIOS</td>
				</tr>
				<tr>
					<td colspan=2 style='text-align:left;' width=250px>".$_POST['coment']."</td>
				</tr>
			</table>";

    global $TablaResultBorrar;
	$TablaResultBorrar = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<td colspan=2 style='text-align:right;' >".$ProductosBotonera."</td>
				</tr>
				<tr>
					<th colspan=2 style='color:#F1BD2D;'>
						DATOS DEL PRODUCTO BORRADO
					</th>
				</tr>
				<tr>
					<td style='text-align:right;' >SECCION</td>
					<td>".$_POST['seccion']."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>ID</td>
					<td>".$_POST['id']."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>VALOR</td>
					<td>".$_POST['valor']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>NOMBRE</td>
					<td>".$_POST['nombre'].	"</td>
				</tr>
				<tr>
					<td style='text-align:right;'>REFERENCIA</td>
					<td>".$_POST['ref']."</td>
				</tr>
				<tr>
					<td colspan=2 style='text-align:center;'>COMENTARIOS</td>
				</tr>
				<tr>
					<td colspan=2 width=250px>".$_POST['coment']."</td>
				</tr>
			</table>";	

	global $TablaResultModif;
	$TablaResultModif = "<table align='center' style='margin-top:1.0em; max-width:280px;'>
                <tr>
					<th colspan=2 style='text-align:right;' >".$ProductosBotonera."</th>
                </tr>
				<tr>
					<th colspan=2 >NUEVOS DATOS</th>
				</tr>
				<tr>
					<td style='text-align:right;' >ID</td>
					<td>".$_POST['id']."</td>
				</tr>				
				<tr>
					<td style='text-align:right;'>VALOR</td>
					<td>".$_POST['valor2']." x ".$_POST['valor1']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>NOMBRE</td>
					<td>".$_POST['nombre']."</td>
				</tr>
				<tr>
					<td style='text-align:right;'>REFERENCIA</td>
					<td>".$_POST['ref']."</td>
				</tr>
			</table>";	

?>