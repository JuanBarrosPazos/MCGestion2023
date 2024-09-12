<?php

	global $Seccion;
	switch (true) {
		case (isset($_POST['seccion'])):
			$Seccion = $_POST['seccion'];
			break;
		case (isset($defaults['seccion'])):
			$Seccion = $defaults['seccion'];
			break;
		default:
			$Seccion = '';
			break;
	}

	global $ProductosBotonera;
    $ProductosBotonera = "<form name='crear' action='ProductosCrear.php' method='POST' style='display: inline-block;' >
				<button type='submit' title='CREAR NUEVO PRODUCTO' class='botonverde imgButIco AddBlack'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
			<form name='crear' action='ProductosVer.php' method='POST' style='display: inline-block;' >
				<button type='submit' title='INICIO PRODUCTOS' class='botonverde imgButIco InicioBlack'>
				</button>
				<input type='hidden' name='seccion' value='".$Seccion."' />
				<input type='hidden' name='oculto2' value=1 />
			</form>
			<form name='crear' action='ProductosFeedbackVer.php' method='POST' style='display: inline-block;' >
				<button type='submit' title='INICIO FEEDBACK PRODUCTOS' class='botonverde imgButIco CachedBlack'>
				</button>
				<input type='hidden' name='seccion' value='".$Seccion."' />
				<input type='hidden' name='oculto2' value=1 />
			</form> ";

?>