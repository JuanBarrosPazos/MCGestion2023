<?php
global $db;     global $db_name;
/////////////////////	
/* PARA SUMAR IVA TOTAL
if(!$qc){print(mysqli_error($db).".</br>");
}else{
	$qivae = mysqli_query($db, $SqlSelectVentasShop);
	$rowivae = mysqli_num_rows($qivae);
	$sumaivae = 0;
		for($i=0; $i<$rowivae; $i++){ $ver = mysqli_fetch_array($qivae);
					$sumaivae = $sumaivae + $ver['ivae'];
						}
} 
*/
	global $sumaivae;
	$SqlSumaIva = "SELECT SUM(`ivae`) AS 'sumaivae' FROM $VentasShop WHERE $SqlOrden ";
    echo "** SqlSumaIva ".$SqlSumaIva."<br>";
	$QrySqlSumaIva = mysqli_query($db, $SqlSumaIva);
	$ResultSqlSumaIva = mysqli_fetch_assoc($QrySqlSumaIva);
	if($ResultSqlSumaIva['sumaivae']==''){ $ResultSqlSumaIva = 0.00;
	}else{ $ResultSqlSumaIva = $ResultSqlSumaIva['sumaivae']; }
	$sumaivae = floatval($ResultSqlSumaIva);
	$sumaivae = number_format($sumaivae,2,".","");
	//echo "** IVA REPERCUTIDO: ".$ResultSqlSumaIva."<br>";
/* FIN PARA SUMAR IVA */
/////////////////////	

/////////////////////
/* INICIO SUMAR IVA REPERCUTIDO */
    global $sumaivarepercutido;
    $SqlSumaIvaRep = "SELECT SUM(`ivae`) AS 'sumaivarep' FROM $VentasShop WHERE (`pago` = 'efectivo' OR `pago` = 'tarjeta' OR `pago` = 'bizum') AND $SqlOrden ";
    echo "** SqlSumaIvaRep ".$SqlSumaIvaRep."<br>";
    $QrySumaIvaRep = mysqli_query($db, $SqlSumaIvaRep);
    $ResultSumaIvaRep = mysqli_fetch_assoc($QrySumaIvaRep);
    if($ResultSumaIvaRep['sumaivarep']==''){ $ResultSumaIvaRep = 0.00;
    }else{ $ResultSumaIvaRep = $ResultSumaIvaRep['sumaivarep']; }
    $sumaivarepercutido = floatval($ResultSumaIvaRep);
    $sumaivarepercutido = number_format($sumaivarepercutido,2,".","");
//echo "** SUMA IVA REPERCUTIDO: - ".$ResultSumaInvita."<br>";
/* FIN SUMAR IVA REPERCUTIDO */
/////////////////////

/////////////////////
/* INICIO SUMAR IVA SOPORTADO */
    global $sumaivasoportado;
    $SqlSumaIvaSop = "SELECT SUM(`ivae`) AS 'sumaivasop' FROM $VentasShop WHERE (`pago` = 'invitacion' OR `pago` = 'personal' OR `pago` = 'sinpagar') AND $SqlOrden ";
    echo "** SqlSumaIvaSop ".$SqlSumaIvaSop."<br>";
    $QrySumaIvaSop = mysqli_query($db, $SqlSumaIvaSop);
    $ResultSumaIvaSop = mysqli_fetch_assoc($QrySumaIvaSop);
    if($ResultSumaIvaSop['sumaivasop']==''){ $ResultSumaIvaSop = 0.00;
    }else{ $ResultSumaIvaSop = $ResultSumaIvaSop['sumaivasop']; }
    $sumaivasoportado = floatval($ResultSumaIvaSop);
    $sumaivasoportado = number_format($sumaivasoportado,2,".","");
//echo "** SUMA IVA SOPORTADO: - ".$ResultSumaInvita."<br>";
/* FIN SUMAR IVA SOPORTADO */
/////////////////////

/////////////////////
/* INICIO SUMAR INVITACIONES */
	global $sumainvita;
	$QrySumaInvita = mysqli_query($db, $SqlSumaInvita);
	$ResultSumaInvita = mysqli_fetch_assoc($QrySumaInvita);
	if($ResultSumaInvita['sumainvita']==''){ $ResultSumaInvita = 0.00;
	}else{ $ResultSumaInvita = $ResultSumaInvita['sumainvita']; }
	$sumainvita = floatval($ResultSumaInvita);
	$sumainvita = number_format($sumainvita,2,".","");
	//echo "** SUMA INVITACIONES: - ".$ResultSumaInvita."<br>";
/* FIN SUMAR INVITACIONES */
/////////////////////

/////////////////////
/* INICIO SUMAR PERSONAL */
	global $sumapersonal;
	$QrySumaPersonal = mysqli_query($db, $SqlSumaPersonal);
	$ResultSumaPersonal = mysqli_fetch_assoc($QrySumaPersonal);
	if($ResultSumaPersonal['sumapersonal']==''){ $ResultSumaPersonal = 0.00;
	}else{ $ResultSumaPersonal = $ResultSumaPersonal['sumapersonal']; }
	$sumapersonal = floatval($ResultSumaPersonal);
	$sumapersonal = number_format($sumapersonal,2,".","");
	//echo "** SUMA PERSONAL: - ".$ResultSumaPersonal."<br>";
/* FIN SUMAR PERSONAL */
/////////////////////

/////////////////////
/* INICIO SUMAR SIN PAGAR */
	global $sumasinpagar;
	$QrySumaSinpagar = mysqli_query($db, $SqlSumaSinpagar);
	$ResultSumaSinpagar = mysqli_fetch_assoc($QrySumaSinpagar);
	if($ResultSumaSinpagar['sumasinpagar']==''){ $ResultSumaSinpagar = 0.00;
	}else{ $ResultSumaSinpagar = $ResultSumaSinpagar['sumasinpagar']; }
	$sumasinpagar = floatval($ResultSumaSinpagar);
	$sumasinpagar = number_format($sumasinpagar,2,".","");
	//echo "** SUMA SIN PAGAR: - ".$ResultSumaSinpagar."<br>";
/* FIN SUMAR SIN PAGAR */
/////////////////////

/////////////////////
/* INICIO SUMAR EFECTIVO */
	global $sumaefectivo;
	$QrySumaEfectivo = mysqli_query($db, $SqlSumaEfectivo);
	$ResultSumaEfectivo = mysqli_fetch_assoc($QrySumaEfectivo);
	if($ResultSumaEfectivo['sumaefectivo']==''){ $ResultSumaEfectivo = 0.00;
	}else{ $ResultSumaEfectivo = $ResultSumaEfectivo['sumaefectivo']; }
	$sumaefectivo = floatval($ResultSumaEfectivo);
	$sumaefectivo = number_format($sumaefectivo,2,".","");
	//echo "** SUMA EFECTIVO: + ".$ResultSumaEfectivo."<br>";
/* FIN SUMAR EFECTIVO */
/////////////////////

/////////////////////
/* INICIO SUMAR TARJETA */
	global $sumatarjeta;
	$QrySumaTarjeta = mysqli_query($db, $SqlSumaTarjeta);
	$ResultSumaTarjeta = mysqli_fetch_assoc($QrySumaTarjeta);
	if($ResultSumaTarjeta['sumatarjeta']==''){ $ResultSumaTarjeta = 0.00; 
	}else{ $ResultSumaTarjeta = $ResultSumaTarjeta['sumatarjeta']; }
	$sumatarjeta = floatval($ResultSumaTarjeta);
	$sumatarjeta = number_format($sumatarjeta,2,".","");
	//echo "** SUMA TARJETA: + ".$ResultSumaTarjeta."<br>";
/* FIN SUMAR TARJETA */
/////////////////////

/////////////////////
/* INICIO SUMAR BIZUM */
	global $sumabizum;
	$QrySumaBizum = mysqli_query($db, $SqlSumaBizum);
	$ResultSumaBizum = mysqli_fetch_assoc($QrySumaBizum);
	if($ResultSumaBizum['sumabizum']==''){ $ResultSumaBizum = 0.00; 
	}else{ $ResultSumaBizum = $ResultSumaBizum['sumabizum']; }
	$sumabizum = floatval($ResultSumaBizum);
	$sumabizum = number_format($sumabizum,2,".","");
	//echo "** SUMA BIZUM: + ".$ResultSumaBizum."<br>";
/* FIN SUMAR BIZUM */
/////////////////////

/////////////////////
/* INICIO CALCULO LIQUIDO CAJA */
	global $TotalCobrado;
	$TotalCobrado = $sumaefectivo + $sumatarjeta + $sumabizum;
		$TotalCobrado = floatval($TotalCobrado);
		$TotalCobrado = number_format($TotalCobrado,2,".","");
	global $TotalInvita;
		$TotalInvita =	$sumasinpagar + $sumapersonal + $sumainvita;
		$TotalInvita = floatval($TotalInvita);
		$TotalInvita = number_format($TotalInvita,2,".","");
	global $LiquidoCaja;
	$LiquidoCaja = $TotalCobrado - $TotalInvita;
		$LiquidoCaja = floatval($LiquidoCaja);
		$LiquidoCaja = number_format($LiquidoCaja,2,".","");
		//echo "** LIQUIDO CAJA CONSULTA: ".$LiquidoCaja."<br>";
/* FIN CALCULO LIQUIDO CAJA */
/////////////////////

/////////////////////	
/* PARA SUMAR PVPTOT
	global $sumapvptot;
	if(!$qc){print(mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $SqlSelectVentasShop);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0;
			for($i=0; $i<$rowpvptot; $i++){ $ver = mysqli_fetch_array($qpvptot);
						$sumapvptot = $sumapvptot + $ver['pvptot'];
			}
	}
 */
	$SqlSumaTot = "SELECT SUM(`pvptot`) AS 'sumatot' FROM $VentasShop WHERE $SqlOrden ";
	$QrySqlSumaTot = mysqli_query($db, $SqlSumaTot);
	$ResultSqlSumaTot = mysqli_fetch_assoc($QrySqlSumaTot);
	$sumapvptot = floatval($ResultSqlSumaTot['sumatot']);
	$sumapvptot = number_format($sumapvptot,2,".","");
	//echo "** SUMA TOTAL: ".$ResultSqlSumaTot['sumatot']."<br>";
/* FIN PARA SUMAR PVPTOT */
/////////////////////	

?>