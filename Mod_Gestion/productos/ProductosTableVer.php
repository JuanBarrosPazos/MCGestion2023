<?php

    global $KeyProductosVer;	

	if(!$qb){ print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr align='center'>
							<td><font color='red'><b>SELECCIONE UNA SECCION</font></td>
						</tr>
					</table>");
	}else{
		if(mysqli_num_rows($qb) < 1){
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
					<tr align='center'>
						<td style='color:#F1BD2D;'>NO HAY DATOS</td>
					</tr>
				</table>");
		}else{ print ("<table align='center'>
						<tr>
							<th colspan=6 >
								PRODUCTOS SECCION ".strtoupper($RowSelectSecciones['nombre'])."
							</th>
						</tr>
						<tr>
							<th class='BorderSupDch'>NOMBRE</th>	
							<th class='BorderSupDch'>PVN€</th>	
							<th class='BorderSupDch'>IVA%</th>		
							<th class='BorderSupDch'>IVA€</th>		
							<th class='BorderSupDch'>PVP€</th>		
							<th class='BorderSup'>STOCK</th>	
						</tr>");
		$count = 1;
		while($rowb = mysqli_fetch_assoc($qb)){
			if(($count%2)==0){ $bgcolor = ""; }else{ $bgcolor = "bgcolor='#454545'"; }
			if($rowb['psiva']==''){ $rowb['psiva']=0.00;}else{ }
			if($rowb['iva']==''){ $rowb['iva']=0.00;}else{ }
			if($rowb['ivae']==''){ $rowb['ivae']=0.00;}else{ }
			if($rowb['pvp']==''){ $rowb['pvp']=0.00;}else{ }
			if($rowb['stock']==''){ $rowb['stock']=0.00;}else{ }
	
		print("<tr ".$bgcolor.">
					<td class='BorderSupDch' align='left'>".$rowb['nombre']."</td>
					<td class='BorderSupDch' align='right'>".$rowb['psiva']." €</td>
					<td class='BorderSupDch' align='right'>".$rowb['iva']." %</td>
					<td class='BorderSupDch' align='right'>".$rowb['ivae']." €</td>
					<td class='BorderSupDch' align='right'>".$rowb['pvp']." €</td>
					<td class='BorderSup' align='right'>".$rowb['stock']."</td>
				</tr>
				<tr ".$bgcolor.">
					<td colspan=6 style='text-align:right;' class='BorderSup' >
		<form name='ver' action='ProductosVerImg.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px, height=640px')\" style='display:inline-block;'>");

		require 'ProductosInputRowb.php';
		
		print("<button type='submit' title='VER IMAGENES PRODUCTO' class='botonverde imgButIco DetalleBlack'>
				</button>
					<input type='hidden' name='oculto2' value=1 />");

    if($KeyProductosVer == 2){

        print("<input type='hidden' name='borrado' value='".$rowb['borrado']."' />
				<input type='hidden' name='profeedback' value=1 />
            </form>
		<form name='ver' action='ProductosVerDetalles.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=380px, height=650px')\" style='display:inline-block;'>");

		require 'ProductosInputRowb.php';
				
		print("<button type='submit' title='DETALLES DEL PRODUCTO' class='botonazul imgButIco DatosBlack'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
					<input type='hidden' name='borrado' value='".$rowb['borrado']."' />
					<input type='hidden' name='profeedback' value=1 />
			</form>
		<form name='oculto2' action='ProductosFeedbackRecuperar.php' method='POST' style='display:inline-block'>");
    
        require 'ProductosInputRowb.php';
                
        print("<button type='submit' title='RECUPERAR PRODUCTO' class='botonverde imgButIco RestoreBlack'>
                </button>
				<input type='hidden' name='borrado' value='".$rowb['borrado']."' />
				<input type='hidden' name='oculto2' value=1 />
            </form>
        <form name='oculto2' action='ProductosFeedbackBorrar.php' method='POST' style='display:inline-block;'>
            <input type='hidden' name='borrado' value='".$rowb['borrado']."' />");
    
        require 'ProductosInputRowb.php';
                
        print("<button type='submit' title='ELIMINAR PRODUCTO FEEDBACK' class='botonrojo imgButIco DeleteBlack'>
                </button>
				<input type='hidden' name='borrado' value='".$rowb['borrado']."' />
				<input type='hidden' name='oculto2' value=1 />
            </form>");

    }elseif($KeyProductosVer == 1){

	    print("</form>
           <form name='ver' action='ProductosModificarImg.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px, height=640px')\" style='display:inline-block;'>");

	    require 'ProductosInputRowb.php';
		
	    print("<button type='submit' title='MODIFICAR IMAGENES PRODUCTO' class='botonlila imgButIco FotoBlack'>
	    		</button>
					<input type='hidden' name='oculto2' value=1 />
	    	</form>
		<form name='ver' action='ProductosVerDetalles.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=380px, height=650px')\" style='display:inline-block;'>");

		require 'ProductosInputRowb.php';
			
		print("<button type='submit' title='DETALLES DEL PRODUCTO' class='botonazul imgButIco DatosBlack'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
		<form name='oculto2' action='ProductosModificar.php' method='POST' style='display:inline-block;'>");

	    require 'ProductosInputRowb.php';
			
		print("<button type='submit' title='MODIFICAR REFERENCIA O NOMBRE' class='botonlila imgButIco DatosBlack'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
		<form name='oculto2' action='StockModificar.php' method='POST' style='display:inline-block;'>");

		require 'ProductosInputRowb.php';
			
		print("<button type='submit' title='MODIFICAR STOCK' class='botonlila imgButIco DatosGrey'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
		<form name='oculto2' action='StockModifPerecederos.php' method='POST' style='display:inline-block;'>");

		require 'ProductosInputRowb.php';
			
		print("<button type='submit' title='MODIFICAR PREDECEDEROS O CAJA' class='botonlila imgButIco DatosWhite'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
		<form name='oculto2' action='ProductosBorrar.php' method='POST' style='display:inline-block;'>");

		require 'ProductosInputRowb.php';
			
		print("<button type='submit' title='BORRAR PRODUCTO' class='botonrojo imgButIco DeleteBlack'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
			</form>");

    }else{ }

		print("</td></tr>");

		$count ++;
        
	} // FIN WHILE 

		print("</table>");

		} // FIN SEGUNDO ELSE
	} // FIN PRIMER ESLE

?>