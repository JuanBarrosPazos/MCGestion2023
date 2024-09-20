<?php

	require '../config/ayear.php';
	
	global $dm;
	$dm = array ('' => 'MES','01' => '01','02' => '02','03' => '03','04' => '04','05' => '05','06' => '06',
					'07' => '07','08' => '08','09' => '09','10' => '10','11' => '11','12' => '12',);
	global $dd;
	$dd = array ('' => 'DÍA','01' => '01','02' => '02','03' => '03','04' => '04','05' => '05',
					'06' => '06','07' => '07','08' => '08','09' => '09','10' => '10','11' => '11',
					'12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17',
					'18' => '18','19' => '19','20' => '20','21' => '21','22' => '22','23' => '23',
					'24' => '24','25' => '25','26' => '26','27' => '27','28' => '28','29' => '29',
					'30' => '30','31' => '31',);
	global $Ordenar;
	if($_SESSION['Nivel']=='cliente'){
		$Ordenar = array ('' => 'ORDENAR',
						'`oper` ASC' => 'Operacion Asc',
						'`oper` DESC' => 'Operacion Desc',
						'`refcaja` ASC' => 'Ref Caja Asc',
						'`refcaja` DESC' => 'Ref Caja Desc',);
	}else{
		$Ordenar = array ('' => 'ORDENAR',
						'`oper` ASC' => 'Operacion Asc',
						'`oper` DESC' => 'Operacion Desc',
						'`clname` ASC' => 'Nombre Cliente Asc',
						'`clname` DESC' => 'Nombre Cliente Desc',
						'`refclient` ASC' => 'Ref Cliente Asc',
						'`refclient` DESC' => 'Ref Cliente Desc',
						'`refcaja` ASC' => 'Ref Caja Asc',
						'`refcaja` DESC' => 'Ref Caja Desc',);
	}									

	global $ZonaLocal;
	$ZonaLocal = array( 'todo' => 'VER TODO',
						'barra01' => 'BARRA 01',
						'barra02' => 'BARRA 02',
						'sala01' => 'SALA 01',
						'sala02' => 'SALA 02',
						'terraza01' => 'TERRAZA 01',
						'terraza02' => 'TERRAZA 02',);

	global $ZonaSeccion;
	$ZonaSeccion = array('1' => 'ZONA LOCAL O CLIENTE','2' => 'SECCION O PRODUCTO',);


?>