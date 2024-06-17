<?php
 
    global $FormTitulo;
	global $KeyFeedback;
	global $accion;
	global $valor;
	global $BotonFeed;

	if($KeyFeedback == 1){
		$accion = "Cliente_Ver.php";
		$valor = "GESTION DE CLIENTES";
		$BotonFeed = "";
	} else {
		$accion = "Cliente_Crear.php";
		$valor = "CREAR CLIENTE";
		$BotonFeed = "<form name='boton' action='Feedback_Cliente_Ver.php' method='post' style='display: inline-block;' >
						<input type='submit' value='GESTION FEEDBACK' />
						<input type='hidden' name='volver' value=1 />
					 </form>";
		}

    global $ordenar;
	$ordenar = array (	'`id` ASC' => 'ID Ascendente',
						'`id` DESC' => 'ID Descendente',
						'`Nombre` ASC' => 'Nombre Ascendente',
						'`Nombre` DESC' => 'Nombre Descendente',
						'`Apellidos` ASC' => 'Apellidos Ascenedente',
						'`Apellidos` DESC' => 'Apellidos Descendente',
						'`Email` ASC' => 'Dirección de Email Ascendente',
						'`Email` DESC' => 'Dirección de Email Descendente',
						'`Tlf1` ASC' => 'Teléfono 1 Ascendente',
						'`Tlf1` DESC' => 'Teléfono 1 Descendente',
						'`Tlf2` ASC' => 'Teléfono 2 Ascendente',
						'`Tlf2` DESC' => 'Teléfono 2 Descendente',);

	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=3 width=100%>".$FormTitulo."</th>
				</tr>
				<tr>
					<th colspan=3 width=100% class='BorderInf'>
						<form name='boton' action='".$accion."' method='post' style='display: inline-block;' >
								<input type='submit' value='".$valor."' />
								<input type='hidden' name='volver' value=1 />
						</form>
						".$BotonFeed."
					</th>
				</tr>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td align='right'>
						<input type='submit' value='CONSULTA' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td>NOMBRE:</td>
					<td>
			<input type='text' name='Nombre' size=20 maxlenth=10 value='".@$defaults['Nombre']."' required />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>APELLIDO:</td>
					<td>
		<input type='text' name='Apellidos' size=20 maxlenth=10 value='".@$defaults['Apellidos']."' required />
					</td>
				</tr>");
						
	print ("</form>	
				<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<tr>
					<td align='center'>
						<input type='submit' value='CONSULTAR TODOS...' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td>	
						ORDENAR:
					</td>
					<td>
						<select name='Orden'>");
				foreach($ordenar as $option => $label){
					print ("<option value='".$option."' ");
					if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
													print ("> $label </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
                    </form>	

					<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
					<tr>
						<td colspan='3' align='center'>
							<input type='submit' value='REFRESCAR VISTA DESPUES DE MODIFICAR DATOS...' />
							<input type='hidden' name='todo' value=1 />
						</td>
					</tr>
						</form>														
				</table>");



?>