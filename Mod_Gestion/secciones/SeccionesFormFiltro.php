<?php

    global $FormTitulo;		global $FormAction;     global $FormInp;	global $FormBoton;
	global $feed;
    if($feed == 1){
        $FormAction = "SeccionesVer.php";
        $FormInp = "INICIO SECCIONES";
		$FormBoton = "InicioBlack";
    }else{
        $FormAction = "SeccionesFeedVer.php";
        $FormInp = "INICIO FEEDBACK SECCIONES";
		$FormBoton = "CachedBlack";
    }

    global $ordenar; 
	$ordenar = array ('`id` ASC' => 'ID Ascendente','`id` DESC' => 'ID Descendente',
						'`nombre` ASC' => 'Nombre Ascendente','`nombre` DESC' => 'Nombre Descendente',
						'`valor` ASC' => 'Valor Ascenedente','`valor` DESC' => 'Valor Descendente',
																);
	print("<table align='center' style=\"border:0px;margin-top:4px\">
                <tr>
                	<th>
			<form name='crear' action='SeccionesCrear.php' method='POST' style='display: inline-block;' >
				<button type='submit' title='CREAR NUEVA SECCION' class='botonverde imgButIco AddBlack'></button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
			<form name='crear' action='".$FormAction."' method='POST' style='display: inline-block;' >
				<button type='submit' title='".$FormInp."' class='botonazul imgButIco ".$FormBoton."'></button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
					</th>
                </tr>
				<tr>
					<th style='color:#F1BD2D;' >".$FormTitulo."</th>
				</tr>
				<tr>
					<td align='center'>
			<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<button type='submit' title='VER SECCIONES' class='botonazul imgButIco BuscaBlack'></button>
						<input type='hidden' name='todo' value=1 />
			<select name='Orden' class='botonazul' >
				<option value='`id` ASC' >ORDENAR POR</option>");
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