<?php

	$kgin1 = $_POST['kgin1'];		        $kgin2 = $_POST['kgin2'];
	global $kgin;					        $kgin = $kgin1.".".$kgin2;
	$kgin = floatval($kgin);		        $kgin = number_format($kgin,2,".","");
	
	$kgbad1 = $_POST['kgbad1'];		        $kgbad2 = $_POST['kgbad2'];	
	global $kgbad; 					        $kgbad = $kgbad1.".".$kgbad2;
	$kgbad = floatval($kgbad);		        $kgbad = number_format($kgbad,2,".","");
	
	$kgcash1 = $_POST['kgcash1'];	        $kgcash2 = $_POST['kgcash2'];
	global $kgcash;					        $kgcash = $kgcash1.".".$kgcash2;
	$kgcash = floatval($kgcash);	        $kgcash = number_format($kgcash,2,".","");
	
	$pvp1 = $_POST['pvp1'];			        $pvp2 = $_POST['pvp2'];	
	global $psiva;					        $psiva = $pvp1.".".$pvp2;
	$psiva = floatval($psiva);		        $psiva = number_format($psiva,2,".","");
	
	global $ivaop;					        $ivaop = $_POST['iva'];
	global $ivae;					        $ivae = $psiva * ($ivaop / 100);
				                            //$ivaef = "&nbsp; + ".$ivae." €.";
	
	global $entrada;				        $entrada = $kgin;
	$entrada = floatval($entrada);	        $entrada = number_format($entrada,2,".","");
	
	global $perecedero;						$perecedero = $kgbad;
	$perecedero = floatval($perecedero);	$perecedero = number_format($perecedero,2,".","");

	global $diferencia; 					$diferencia = ($entrada - $perecedero) - $CajaShop;
	//$diferencia = floatval($diferencia);	$diferencia = number_format($diferencia,2,".","");
	
	global $CajaShop;						$CajaShop = $kgcash;
	$CajaShop = floatval($CajaShop);		$CajaShop = number_format($CajaShop,2,".","");

	global $pvp;					        $pvp = $psiva + $ivae;
	$pvp = floatval($pvp);			        $pvp = number_format($pvp,2,".","");
	
	global $pvptot;					        $pvptot = $CajaShop * $pvp;
	$pvptot = floatval($pvptot);	        $pvptot = number_format($pvptot,2,".","");


?>