<?php

    global $FormAction;     global $FormInp;        global $FormBoton;
	global $ColorBoton;		global $Title;

    global $Borrar;
    if($Borrar == 1){
        $FormInp = "BORRAR DATOS PERMANENTEMENTE";
		$FormBoton = "DeleteWhite";
		$ColorBoton = "botonrojo";
    }else{
        $FormInp = "RECUPERAR ESTA SECCIÓN";
		$FormBoton = "RestoreBlack";
		$ColorBoton = "botonverde";
   }

    global $Title;
	print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=2 style='color:#F1BD2D;'>
						".$Title."
					</th>
				</tr>
				<tr>
					<th colspan=2>
		<form name='crear' action='SeccionesFeedVer.php' method='POST' style='display:inline-block; float:right;'>
			<button type='submit' title='INICIO SECCIONES FEEDBACK' class='botonazul imgButIco CachedBlack'>
			</button>
				<input type='hidden' name='oculto2' value=1 />
		</form>
		<form name='crear' action='SeccionesVer.php' method='POST' style='display:inline-block; float:right;'>
			<button type='submit' title='INICIO SECCIONES' class='botonazul imgButIco InicioBlack'>
			</button>
				<input type='hidden' name='oculto2' value=1 />
		</form>
					</th>
				</tr>
				<tr>
					<td style='text-align:right;' >ID </td>
					<td>".$defaults['id']."</td>
				</tr>
				<tr>
					<td style='text-align:right;' >VALOR </td>
					<td>".$defaults['valor']."</td>
				</tr>
				<tr>
					<td style='text-align:right;' >NOMBRE </td>
					<td>".$defaults['nombre']."</td>
				</tr>
				<tr>
			<td colspan='2' style='text-align:right;'>
				<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						<input type='hidden' name='id' value='".$defaults['id']."' />
						<input type='hidden' name='valor' value='".$defaults['valor']."' />
						<input type='hidden' name='nombre' value='".$defaults['nombre']."' />
					<button type='submit' title='".$FormInp."' class='".$ColorBoton." imgButIco ".$FormBoton."'>
					</button>
						<input type='hidden' name='borrar' value=1 />
				</form>														
					</td>
				</tr>
			</table>");

?>