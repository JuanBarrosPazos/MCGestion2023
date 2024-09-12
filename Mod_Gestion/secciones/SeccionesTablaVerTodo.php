<?php

    global $FormAction;     global $FormAction1;    global $FormAction2;  
    global $FormInp;        global $FormBoton;		global $LogText;	

    global $feed;
    if($feed == 1){
        $FormAction = "SeccionesVer.php";
        $FormInp = "INICIO SECCIONES";
		$FormBoton = "InicioBlack";

        $FormAction1 = "SeccionesRecuperar.php";
        $FormInp1 = "RECUPERAR FEEDBACK SECCION";
		$FormBoton1 = "RestoreBlack";
        $FormAction2 = "SeccionesFeedBorrar.php";
        $FormInp2 = "BORRAR FEEDBACK SECCIONES";
		$FormBoton2 = "DeleteWhite";

    }else{
        $FormAction = "SeccionesFeedVer.php";
        $FormInp = "INICIO FEEDBACK SECCIONES";
		$FormBoton = "CachedBlack";

        $FormAction1 = "SeccionesModificar.php";
        $FormInp1 = "MODIFICAR SECCIONES";
		$FormBoton1 = "InicioBlack";
        $FormAction2 = "SeccionesBorrar.php";
        $FormInp2 = "BORRAR SECCIONES";
		$FormBoton2 = "DeleteWhite";
    }

	if(!$QrySelectSecciones){
			print("<font color='#F1BD2D'>:.53: </font>".mysqli_error($db)."</br>");
	}else{
			if(mysqli_num_rows($QrySelectSecciones)== 0){
				print ("<table align='center'>
							<tr>
								<td style='text-align:center;'>
                                   <span style='color:#F1BD2D; display:block;'>NO HAY DATOS</span>
                   <form name='crear' action='".$FormAction."' method='POST' style='display: block;' >
                       <button type='submit' title='".$FormInp."' class='botonazul imgButIco ".$FormBoton."'>
                       </button>
                           <input type='hidden' name='oculto2' value=1 />
                   </form>
                                   </td>
							</tr>
						</table>");

			global $RedirUrl;	$RedirUrl = $FormAction;
			global $RedirTime;	$RedirTime = 6000;
			require '../Inclu/AutoRedirUrl.php';
			global $Redir;      print ($Redir);
				
			// DATOS LOG...
			$LogText = $LogText."* NO HAY DATOS. REDIRECCIONADO A ".$FormInp."\n\t";

			}else{ $CountSelectSecciones = (mysqli_num_rows($QrySelectSecciones));
					print ("<table align='center'  style='text-align:center;'>
							<tr>
								<th colspan=4 >".$CountSelectSecciones." SECCIONES </th>
							</tr>
							<tr>
								<th class='BorderSupDch'>ID</th>
								<th class='BorderSupDch'>VALOR</th>
								<th class='BorderSupDch'>NOMBRE</th>
								<th class='BorderSup'></th>
							</tr>");
			
			while($RowSelectSecciones = mysqli_fetch_assoc($QrySelectSecciones)){
 			
	if ($RowSelectSecciones['valor'] == '0'){

	}elseif($RowSelectSecciones['valor'] != '0'){	
			print (	"<tr>
						<td class='BorderSupDch'>".$RowSelectSecciones['id']."</td>
						<td class='BorderSupDch' style='text-align:left;' >".$RowSelectSecciones['valor']."</td>
						<td class='BorderSupDch' style='text-align:left;' >".$RowSelectSecciones['nombre']."</td>
						<td class='BorderSup'>
            <form name='crear' action='".$FormAction1."' method='POST' style='display: inline-block;' >
                <button type='submit' title='".$FormInp1."' class='botonazul imgButIco ".$FormBoton1."'>
                </button>
					<input type='hidden' name='id' value='".$RowSelectSecciones['id']."' />
					<input type='hidden' name='valor' value='".$RowSelectSecciones['valor']."' />
					<input type='hidden' name='nombre' value='".$RowSelectSecciones['nombre']."' />
					<input type='hidden' name='oculto2' value=1 />
			</form>

            <form name='crear' action='".$FormAction2."' method='POST' style='display: inline-block;' >
                <button type='submit' title='".$FormInp2."' class='botonrojo imgButIco ".$FormBoton2."'>
                </button>
					<input type='hidden' name='id' value='".$RowSelectSecciones['id']."' />
					<input type='hidden' name='valor' value='".$RowSelectSecciones['valor']."' />
					<input type='hidden' name='nombre' value='".$RowSelectSecciones['nombre']."' />
					<input type='hidden' name='oculto2' value=1 />
			</form>
						</td>
					</tr>");
	} // FIN  ELSEIF
				} // FIN WHILE

		print("</table>");

				} // FIN SEGUNDO ELSE

			} // FIN PRIMER ELSE


?>