<?php

	global $kgin;
	if((isset($_POST['kgin1']))&&(isset($_POST['kgin2']))){
		$kgin1 = $_POST['kgin1'];	
		$kgin2 = $_POST['kgin2'];
		$kgin = $kgin1.".".$kgin2;
		$kgin = floatval($kgin);
		$kgin = number_format($kgin,2,".","");
	}else{ $kgin = 0.00; }

	global $kgbad;
	if((isset($_POST['kgbad1']))&&(isset($_POST['kgbad2']))){
		$kgbad1 = $_POST['kgbad1'];	
		$kgbad2 = $_POST['kgbad2'];	
		$kgbad = $kgbad1.".".$kgbad2;
		$kgbad = floatval($kgbad);
		$kgbad = number_format($kgbad,2,".","");
	}else{ $kgbad = 0.00; }
	
	global $kgcash;
	if((isset($_POST['kgcash1']))&&(isset($_POST['kgcash2']))){
		$kgcash1 = $_POST['kgcash1'];	
		$kgcash2 = $_POST['kgcash2'];
		$kgcash = $kgcash1.".".$kgcash2;
		$kgcash = floatval($kgcash);
		$kgcash = number_format($kgcash,2,".","");
	}else{ $kgcash = 0.00; }
	
	global $psiva;
	if((isset($_POST['pvp1']))&&(isset($_POST['pvp2']))){
		$pvp1 = $_POST['pvp1'];	
		$pvp2 = $_POST['pvp2'];	
		$psiva = $pvp1.".".$pvp2;
		$psiva = floatval($psiva);
		$psiva = number_format($psiva,2,".","");
	}else{ $psiva = 0.00; }
	
	global $ivaef;	global $ivaop;	global $ivae;
	if(isset($_POST['iva'])){
		$ivaop = $_POST['iva'];
		$ivaop = intval($ivaop);
		$ivaop = number_format($ivaop,0);
		$ivae = $psiva * ($ivaop / 100);
		$ivae = floatval($ivae);
		$ivae = number_format($ivae,2,".","");
		$ivaef = "&nbsp; + ".$ivae." €";
	}else{ $ivaef = "&nbsp; + 0.00 €"; }
	
	global $pvp;		$pvp = $psiva + $ivae;
	global $entrada;	$entrada = $kgin;
	global $CajaShop;	$CajaShop = $kgcash;
	global $pvptot;		$pvptot = $CajaShop * $pvp;
	global $perecedero;	$perecedero = $kgbad;
	global $diferencia;	$diferencia = ($entrada - $perecedero) - $CajaShop;

	if (($entrada - $perecedero) < 0){ $diferencia = '-' .$diferencia;}

?>