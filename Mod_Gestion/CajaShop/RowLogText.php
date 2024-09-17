<?php

	global $LogText;	global $RowLogText;	global $titut;	global $datos;
	
	if(!$QrySqlCajaShopOper){
		print("* ERROR SQL ".$LError." ".mysqli_error($db).".</br>");
        $LogText = "";
	}else{
		$QryLogText = mysqli_query($db, $SqlCajaShopOper);
		$CountLogText = mysqli_num_rows($QryLogText);
		for($i=0; $i<$CountLogText; $i++){
			$RowLogText = mysqli_fetch_array($QryLogText);
			$titut ="\n |  SECCION   |    REF PROD    |     PRO NAME     | CARRO";
			$datos =$datos."\n | ".$RowLogText['vseccion']." | ".$RowLogText['producto']." | ".$RowLogText['proname']." | ".$RowLogText['kgcash'];
		} // FIN FOR

		switch (true) {
			case ($LogTextKey == 1):
				$LogText = $LogText."* PAGO 2 =>\t* SESSION OPER: ".$_SESSION['oper']."\t* REF CAJA: ".$RowLogText['refcaja']."\t* REF CLIENT: ".$RowLogText['refclient']."\t* NAME CLIENT: ".$RowLogText['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot."".$titut.$datos;
				break;
			case ($LogTextKey == 2):
				$LogText = $LogText."	* PAGO COMPLET =>\t* SESSION OPER: ".$RefOperShop."\t* REF CAJA: ".$RowLogText['refcaja']."\t* REF CLIENT: ".$RowLogText['refclient']."\t* NAME CLIENT: ".$RowLogText['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot." ".$titut.$datos;
				break;
			case ($LogTextKey == 3):
				$LogText = $LogText."* CANCEL COMPRA 2 =>\t* SESSION OPER: ".$RefOperShop."\t* REF CAJA: ".$RowLogText['refcaja']."\t* REF CLIENT: ".$RowLogText['refclient']."\t* NAME CLIENT: ".$RowLogText['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot."".@$titut.$datos;
				break;
			case ($LogTextKey == 4):
				$LogText = $LogText."* FCANCEL 4 =>\t* SESSION OPER: ".$_SESSION['oper']."\t* REF CAJA: ".$RowLogText['refcaja']."\t* REF CLIENT: ".$RowLogText['refclient']."\t* NAME CLIENT: ".$RowLogText['clname']."\t* IVA TOT: ".$sumaivae."\t* PVP TOT: ".$sumapvptot." ".$titut.$datos;
				break;
			case ($LogTextKey == 5):
				$LogText = $LogText."* SUBTOTAL =>\t* SESSION OPER: ".$_SESSION['oper']."\t* REF CAJA: ".$RowLogText['refcaja']."\t* REF CLIENT: ".$RowLogText['refclient']."\t* NAME CLIENT: ".$RowLogText['clname']."\t* IVA TOT: ".$sumaivae."\t	* PVP TOT: ".$sumapvptot."".$titut.$datos;
				break;
			default:
				$LogText = $LogText;
				break;
		}
	}

?>