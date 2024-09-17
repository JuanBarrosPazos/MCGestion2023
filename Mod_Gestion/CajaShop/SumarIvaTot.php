<?php

    global $db;     global $db_name;

    global $RefOperShop;	$RefOperShop = $_SESSION['oper'];
    global $SqlCajaShopOper;    
    $SqlCajaShopOper =  "SELECT * FROM $CajaShop WHERE `oper` = '$RefOperShop' ";
	
    global $QrySqlCajaShopOper;
    $QrySqlCajaShopOper = mysqli_query($db, $SqlCajaShopOper);
    $CountSqlCajaShopOper = mysqli_num_rows($QrySqlCajaShopOper);
    //global $rowc;   $rowrc = mysqli_fetch_assoc($QrySqlCajaShopOper);

    //global $ProName;		$ProName =strtolower($rowrc['proname']);
	//global $ClientRef;		$ClientRef = $rowrc['refclient'];

	/////////////////////	
	/* PARA SUMAR IVA */
	global $sumaivae;
	if(!$QrySqlCajaShopOper){print("* ERROR SQL SUMAR IVA ".$LError." ".mysqli_error($db).".</br>");
	}else{
		$qivae = mysqli_query($db, $SqlCajaShopOper);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivae = 0;
			for($i=0; $i<$rowivae; $i++){ $verivae = mysqli_fetch_array($qivae);
						$sumaivae = $sumaivae + $verivae['ivae'];
							}
			$sumaivae = floatval($sumaivae);		$sumaivae = number_format($sumaivae,2,".","");
		}
	/* FIN PARA SUMAR IVA */
	/////////////////////////

	/////////////////////	
	/* PARA SUMAR PVPTOT */
	global $sumapvptot;
	if(!$QrySqlCajaShopOper){ print("* ERROR SQL SUMAR PVPTOT L.179||L.403||L.1164||L.1251||L.1570 ".mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $SqlCajaShopOper);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0;
			for($i=0; $i<$rowpvptot; $i++){ $verpvptot = mysqli_fetch_array($qpvptot);
						$sumapvptot = $sumapvptot + $verpvptot['pvptot'];
							}
			$sumapvptot = floatval($sumapvptot);
			$sumapvptot = number_format($sumapvptot,2,".","");
			}
	/* FIN PARA SUMAR PVPTOT */
	/////////////////////////

?>