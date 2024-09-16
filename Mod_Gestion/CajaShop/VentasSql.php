<?php

	global $dy1;	global $dyt1;	global $dm1;	global $dd1;
	/*
	if((!isset($_POST['dy']))){ $dy1 = '';
							$dyt1 = date('Y'); 
							}else{ $dy1 = $_POST['dy'];
													  $dy1 = $dy1;
													  $dyt1 = "20".$_POST['dy'];echo "** HOLA MUNDO2 ".$dyt1."<br>";
																		}
	if(!isset($_POST['dm'])){ $dm1 = '';}else{ 	$dm1 = $_POST['dm'];
											 	$dm1 = "-".$dm1."-";}
	if(!isset($_POST['dd'])){ $dd1 = '';}else{ 	$dd1 = $_POST['dd'];
											 	$dd1 = $dd1."/"; }

	*/

	global $FiltroFecha;	$FiltroFecha = "`datecash` LIKE '%".$dy1.$dm1.$dd1."%'";

	global $Orden;
	if((!isset($_POST['Orden']))||($_POST['Orden']=='')){ $Orden = "`datecash` ASC"; }else{ $Orden = $_POST['Orden']; }

	// ASIGNA CONSULTAS SQL
	require "../config/TablesNames.php";

	global $SqlOrdenar;			$SqlOrdenar = " ORDER BY $Orden";
	global $SqlOrden;			// $SqlOrden = "";
	global $SelectSum;			$SelectSum = "SELECT SUM(`pvptot`) AS ";
	global $SelectSumFrom;		$SelectSumFrom = "FROM $VentasShop WHERE `pago` = ";
	global $SqlSumaInvita;		$SqlSumaInvita = "$SelectSum 'sumainvita' $SelectSumFrom 'invitacion' ";
	global $SqlSumaPersonal; 	$SqlSumaPersonal = "$SelectSum 'sumapersonal' $SelectSumFrom 'personal' ";
	global $SqlSumaSinpagar;	$SqlSumaSinpagar = "$SelectSum 'sumasinpagar' $SelectSumFrom 'sinpagar' ";
	global $SqlSumaEfectivo;	$SqlSumaEfectivo = "$SelectSum 'sumaefectivo' $SelectSumFrom 'efectivo' ";
	global $SqlSumaTarjeta;		$SqlSumaTarjeta = "$SelectSum 'sumatarjeta' $SelectSumFrom 'tarjeta' ";
	global $SqlSumaBizum;		$SqlSumaBizum = "$SelectSum 'sumabizum' $SelectSumFrom 'bizum' ";

	if(isset($_POST['show_formcl'])){
		switch (true) {
			case (($_POST['zonalocal']=='todo')&&(strlen(trim($_POST['Nombre']))<1)): 
				$SqlOrden = " $FiltroFecha ";
				break;

			case ((($_POST['zonalocal']=='barra01')||($_POST['zonalocal']=='barra02')||($_POST['zonalocal']=='sala01')||($_POST['zonalocal']=='sala02')||($_POST['zonalocal']=='terraza01')||($_POST['zonalocal']=='terraza02'))&&(strlen(trim($_POST['Nombre']))<1)):
				$SqlOrden = " $FiltroFecha AND `clname` LIKE '$_POST[zonalocal]%' ";
				break;

			case ((($_POST['zonalocal']=='barra01')||($_POST['zonalocal']=='barra02')||($_POST['zonalocal']=='sala01')||($_POST['zonalocal']=='sala02')||($_POST['zonalocal']=='terraza01')||($_POST['zonalocal']=='terraza02'))&&(strlen(trim($_POST['Nombre']))>0)):
				$LikeNombre = "LIKE '%".$_POST['Nombre']."%'";
				$SqlOrden = " $FiltroFecha AND (`clname` LIKE '$_POST[zonalocal]%' OR `cname` $LikeNombre OR `refcaja` $LikeNombre OR `refclient` $LikeNombre OR `oper` $LikeNombre) ";
				break;

			case (($_POST['zonalocal']=='')&&(strlen(trim($_POST['Nombre']))>0)):
				$LikeNombre = "LIKE  '%".$_POST['Nombre']."%'";
				$SqlOrden = " $FiltroFecha AND (`clname` $LikeNombre OR `cname` $LikeNombre OR `refcaja` $LikeNombre OR `refclient` $LikeNombre OR `oper` $LikeNombre)";
				break;
			default:
				$SqlOrden = " $FiltroFecha ";
				break;
		}

	}elseif((isset($_POST['seccion']))||(isset($_POST['producto']))){
		switch (true) {
			case (($_POST['seccion']=='')&&(!isset($_POST['producto']))): 
					$SqlOrden = "$FiltroFecha";
				break;
			case (($_POST['seccion']!='')&&(!isset($_POST['producto']))): 
					$SqlOrden = " $FiltroFecha AND `vseccion` = '$_POST[seccion]' ";
				break;
			case (($_POST['seccion']=='')&&($_POST['producto']!='')): 
					$SqlOrden = " $FiltroFecha AND `producto` = '$_POST[producto]' ";
				break;
			case (($_POST['seccion']!='')&&($_POST['producto']!='')): 
					$SqlOrden = " $FiltroFecha AND (`vseccion` = '$_POST[seccion]' AND `producto` = '$_POST[producto]') ";
				break;
			default:
					$SqlOrden = " $FiltroFecha ";
				break;
		} // FIN SWITCH
	}else{ }

	$SqlSelectVentasShop =  "SELECT * FROM $VentasShop WHERE $SqlOrden $SqlOrdenar";
	echo "** CONSULTA SQL QC : ".$SqlSelectVentasShop."<br>";
	
	$SqlSumaInvita = $SqlSumaInvita." AND ".$SqlOrden;
		//echo "** SqlSumaInvita ".$SqlSumaInvita."<br>";
	$SqlSumaPersonal = $SqlSumaPersonal." AND ".$SqlOrden;
		//echo "** SqlSumaPersonal ".$SqlSumaPersonal."<br>";
	$SqlSumaSinpagar = $SqlSumaSinpagar." AND ".$SqlOrden;
	$SqlSumaEfectivo = $SqlSumaEfectivo." AND ".$SqlOrden;
	$SqlSumaTarjeta = $SqlSumaTarjeta." AND ".$SqlOrden;
	$SqlSumaBizum = $SqlSumaBizum." AND ".$SqlOrden;

	global $qc;     $qc = mysqli_query($db, $SqlSelectVentasShop);

?>