<?php

		print("<tr align='center'>
					<td class='BorderInfDch' align='left'>".$RowCajaShopIni0['cname']."</td>
					<td class='BorderInfDch ocultatd440' align='left'>".$RowCajaShopIni0['refcaja']."</td>
					<td class='BorderInfDch' align='right'>".$RowCajaShopIni0['oper']."</td>
					<td class='BorderInfDch ocultatd440' align='right'>".$RowCajaShopIni0['datecash']."</td>
					<td class='BorderInfDch' align='right'>".strtoupper($RowCajaShopIni0['refclient'])."</td>
					<td class='BorderInfDch' align='right'>".$SumaResult."</td>
					<td class='BorderInf'>");

		if($RowCajaShopIni0['ini'] == 1){
			print("<div style='float:left;'>
				<form name='recup_compra2' method='post' action='$_SERVER[PHP_SELF]'>
					<input name='cname' type='hidden' value='".$RowCajaShopIni0['cname']."' />
					<input name='refcaja' type='hidden' value='".$RowCajaShopIni0['refcaja']."' />
					<input name='oper' type='hidden' value='".$RowCajaShopIni0['oper']."' />
					<input name='datecash' type='hidden' value='".$RowCajaShopIni0['datecash']."' />
					<input name='refclient' type='hidden' value='".$RowCajaShopIni0['refclient']."' />
					<input name='vseccion' type='hidden' value='".$RowCajaShopIni0['vseccion']."' />
					<input name='producto' type='hidden' value='".$RowCajaShopIni0['producto']."' />
					<input name='kgcash' type='hidden' value='".$RowCajaShopIni0['kgcash']."' />
				<button type='submit' title='RECUPERAR ESTA COMPRA' class='botonverde imgButIco CachedBlack' style='vertical-align:top;' ></button>
						<input type='hidden' name='recup_compra2' value=1 />
				</form>
					</div>
					<div style='float:left;'>
				<form name='coment_client' action='CompraComent.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=500px,height=320px')\">
						<input name='oper' type='hidden' value='".$RefOperShop."' />
					<button type='submit' title='COMENTARIOS COMPRA' class='botonazul imgButIco DatosBlack' style='vertical-align:top;' ></button>
						<input type='hidden' name='coment_client' value=1 />
				</form>
					</div>");			
		}else{ }

		global $ClientRef;	global $CssHeight;
		if($ClientRef != ""){
			$SqlClientesWebRef =  "SELECT * FROM $ClientesWeb WHERE `ref` = '$ClientRef' ";
				$QrySqlClientesWebRef = mysqli_query($db, $SqlClientesWebRef);
			if(mysqli_num_rows($QrySqlClientesWebRef) == 0){
				$SqlClientesWebRef =  "SELECT * FROM $Admin WHERE `ref` = '$ClientRef' ";
				$QrySqlClientesWebRef = mysqli_query($db, $SqlClientesWebRef);
			}else{ }
				$RowSqlClientesWebClient = mysqli_fetch_assoc($QrySqlClientesWebRef);
				$_SESSION['nclient'] = $RowSqlClientesWebClient['Nivel'];
        
		if(($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'plus')){ 
				$CssHeight = 'height=530px'; 
		}else { $CssHeight = 'height=290px'; }

		global $SqlClientesWebRef;
		if($_SESSION['nclient'] == 'cliente'){
			$SqlClientesWebRef =  "SELECT * FROM $ClientesWeb WHERE `ref` = '$ClientRef' ORDER BY `Nombre` ASC ";
			$CssHeight = 'height=530px';
		}elseif(($_SESSION['nclient']=='admin')||($_SESSION['nclient']=='plus')||($_SESSION['nclient']=='user')||($_SESSION['nclient']=='caja')){
			$SqlClientesWebRef =  "SELECT * FROM $Admin WHERE `ref`='$ClientRef' ORDER BY `Nombre` ASC ";
		}
		$QrySqlClientesWebRef = mysqli_query($db, $SqlClientesWebRef);

		while($RowSqlClientesWebClient = mysqli_fetch_assoc($QrySqlClientesWebRef)){
			if($RowSqlClientesWebClient['doc']=='local'){ $CssHeight = 'height=290px'; }else{ $CssHeight = 'height=530px'; }
			global $InixKey;
			if($InixKey == 1){
				print("<div style='float:left;'>
						<form name='data_client' action='ClienteVer02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=320px,".$CssHeight."')\">
				<input name='id' type='hidden' value='".$RowSqlClientesWebClient['id']."' />
				<input name='Nivel' type='hidden' value='".$RowSqlClientesWebClient['Nivel']."' />
				<input name='ref' type='hidden' value='".$RowSqlClientesWebClient['ref']."' />
				<input name='Nombre' type='hidden' value='".$RowSqlClientesWebClient['Nombre']."' />
				<input name='Apellidos' type='hidden' value='".$RowSqlClientesWebClient['Apellidos']."' />
				<input name='myimg' type='hidden' value='".$RowSqlClientesWebClient['myimg']."' />
				<input name='doc' type='hidden' value='".$RowSqlClientesWebClient['doc']."' />
				<input name='dni' type='hidden' value='".$RowSqlClientesWebClient['dni']."' />
				<input name='ldni' type='hidden' value='".$RowSqlClientesWebClient['ldni']."' />
				<input name='Email' type='hidden' value='".$RowSqlClientesWebClient['Email']."' />
				<input name='Usuario' type='hidden' value='".$RowSqlClientesWebClient['Usuario']."' />
				<input name='Password' type='hidden' value='".$RowSqlClientesWebClient['Password']."' />
				<input name='Direccion' type='hidden' value='".$RowSqlClientesWebClient['Direccion']."' />
				<input name='Tlf1' type='hidden' value='".$RowSqlClientesWebClient['Tlf1']."' />
				<input name='Tlf2' type='hidden' value='".$RowSqlClientesWebClient['Tlf2']."' />
				<input name='lastin' type='hidden' value='".$RowSqlClientesWebClient['lastin']."' />
				<input name='lastout' type='hidden' value='".$RowSqlClientesWebClient['lastout']."' />
				<input name='visitadmin' type='hidden' value='".$RowSqlClientesWebClient['visitadmin']."' />
					<button type='submit' title='DATOS CLIENTE' class='botonlila imgButIco InfoBlack' style='vertical-align:top;' ></button>
				<input type='hidden' name='data_client' value=1 />
			</form>
					</div>");
			} // FIN IF
		print("</td>");
				} /* FIN DEL WHILE */
				
		} // FIN if($ClientRef != '')

				global $ClientRef;
				if($ClientRef == ''){ print("</td>"); }
						print("</tr>");


?>