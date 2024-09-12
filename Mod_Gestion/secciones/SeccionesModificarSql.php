<?php

	global $LogText;

	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE SE MODIFICA	****************/
	/***********************************************************************/
	global $db;		global $db_name;
	require "../config/TablesNames.php";

	global $nombre;		$nombre = $_POST['nombre'];
	global $valor;		$valor = $_POST['valor2'];
	global $Title;
	if(trim($_POST['valor1'] != $_POST['valor2'])){
		/*
		print("Valor 1 ".$_POST['valor1']." y Valor Nuevo ".$_POST['valor2']." 
		<font color='#FF0000'>NO SON IGUALES</font>");
		*/
		
	/*****************	MODIFICA VARIABLE DE SECCIONES	*****************/
	$sqlc = "UPDATE `$db_name`.$Secciones SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE $Secciones.`id` = '$_POST[id]' LIMIT 1 ";
	if(mysqli_query($db, $sqlc)){

		$Title = "NUEVOS DATOS";
		require 'SeccionesTablaResult.php';
		print($TablaResultados);

		global $RedirUrl;	$RedirUrl = "SeccionesVer.php";
		global $RedirTime;	$RedirTime = 6000;
		require '../Inclu/AutoRedirUrl.php';
		global $Redir;      print ($Redir);

		$LogText = $LogText."* UPDATE BBDD ".strtoupper($Secciones)." ID ".$_POST['id']." DATOS ".$_POST['valor1']." POR ".$_POST['valor2']." / ".$_POST['nombre']."\n\t";
	
	}else{  print("* ERROR SQL L.21 ".mysqli_error($db))."</br>";
			$LogText = $LogText."* ERROR SQL L.21 ".mysqli_error($db)."\n\t";
	}

	/*****************	MODIFICA VARIABLE EN LA TABLA PRODUCTOS	 *****************/
	$sqlc = "UPDATE `$db_name`.$Productos SET `vseccion` = '$_POST[valor2]' WHERE $Productos.`vseccion` = '$_POST[valor1]' ";
	if(mysqli_query($db, $sqlc)){
			$LogText = $LogText."* UPDATE BBDD ".strtoupper($Productos)." DATOS ".$_POST['valor1']." POR ".$_POST['valor2']." / ".$_POST['nombre']."\n\t";
	}else{  print("* ERROR SQL L.40 ".mysqli_error($db))."</br>";
			$LogText = $LogText."* ERROR SQL L.40 ".mysqli_error($db)."\n\t";
	}

	/*****************	MODIFICA VARIABLE EN LA TABLA PRODUCTOS FEED  *****************/
	$sqlc = "UPDATE `$db_name`.$ProductosFeed SET `vseccion` = '$_POST[valor2]' WHERE $ProductosFeed.`vseccion` = '$_POST[valor1]' ";
	if(mysqli_query($db, $sqlc)){
			$LogText = $LogText."* UPDATE BBDD ".strtoupper($ProductosFeed)." DATOS ".$_POST['valor1']." POR ".$_POST['valor2']." / ".$_POST['nombre']."\n\t";
	}else{  print("* ERROR SQL L.48 ".mysqli_error($db))."</br>";
			$LogText = $LogText."* ERROR SQL L.48 ".mysqli_error($db)."\n\t";
	}

	/*****************	MODIFICA VARIABLE EN LAS TABLAS VENTAS  *****************/
	/* DETECTO LAS TABLAS VENTAS EN INFORMATION_SCHEMA.TABLES */
	global $table_name_tbventasshop;		
	$table_name_tbventasshop = $_SESSION['clave']."ventasshop_20";
	global $SqlSchema;
	$SqlSchema = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME LIKE '$table_name_tbventasshop%' ";
	echo "** ".$SqlSchema."<br>";
	$QrySchema = mysqli_query($db, $SqlSchema);
	$CountSchema = mysqli_num_rows($QrySchema);

	echo "<p>TABLAS VENTAS SHOP EN BBDD: ".$_SESSION['clave']."ventasshop_ : ".$CountSchema."</p>";

	global $Valor1;		$Valor1 = $_POST['valor1'];
	global $Valor2;		$Valor2 = $_POST['valor2'];

	/* FIN DETECTO LAS TABLAS VENTAS */
	if($CountSchema<1){ 
		echo "<p>NO HAY DATOS EN INFORMATION_SCHEMA.TABLES ".$table_name_tbventasshop."</p>";
		$LogText = $LogText."* NO HAY DATOS EN INFORMATION_SCHEMA.TABLES ".$table_name_tbventasshop."\n\t";
	}else{
		global $a; 		$a = 1;
		global $date;	$date = date('y');
		while ($a <= $CountSchema){
			$TableName = $table_name_tbventasshop.$date;
			//echo"<p>TABLA NOMBRE: ".$TableName."</p>";
			$SqlVentasShop =  "SELECT * FROM `$db_name`.$TableName WHERE $TableName.`vseccion` = '$Valor1' ";
			$QryVentasShop = mysqli_query($db, $SqlVentasShop);
			$RowVentasShop = mysqli_fetch_assoc($QryVentasShop);
			if(mysqli_num_rows($QryVentasShop)>0){
				$LikeValor = "%".$Valor1."%";
				$SqlUpdateVentasShop = "UPDATE `$db_name`.$TableName SET `vseccion` = '$Valor2' WHERE $TableName.`vseccion` LIKE '$LikeValor' ";
				if(mysqli_query($db, $SqlUpdateVentasShop)){ 
					//print("MODIFICADAS VARIABLES EN ".$VentasShop.": ".$_POST['valor1']." POR ".$_POST['valor2']."<br>");
					$LogText = $LogText."* UPDATE ".$VentasShop." ID ".$RowVentasShop['id']." DATOS ".$_POST['valor1']." POR ".$_POST['valor2']."\n\t";
				}else{ print("* ERROR SQL L.85 ".mysqli_error($db))."</br>"; 
						$LogText = $LogText."* ERROR SQL L.85 ".mysqli_error($db)."\n\t";
				}

			}else{ echo "<p>NO HAY DATOS ".$Valor1." EN ".$TableName."</p>"; 
				$LogText = $LogText."* NO HAY DATOS ".$Valor1." EN ".$TableName."\n\t";
			}

				$a ++;	$date = $date-1;
		} // FIN WHILE
	} // FIN ELSE

	/*****************	RENOMBRA LA CARPETA DE IMAGENES  *****************/
	$carpeta = "../imgpro/"."imgpro".$_POST['valor1'];
		$carpeta2 = "../imgpro/"."imgpro".$_POST['valor2'];
		rename($carpeta, $carpeta2);
		$LogText = $LogText."* MODIFICADO EL DIRECTORIO ".$carpeta."/ POR ".$carpeta2."\n\t";

	/* FIN DEL IF */
	/***********************************************************************/
	/*************	SI EL VALOR DE LA VARIABLE NO CAMBIA	****************/
	/***********************************************************************/
	}elseif(trim($_POST['valor1'] == $_POST['valor2'])){

	/************  MODIFICA EL NOMBRE EN SECCIONES  *****************/
	$sqlc = "UPDATE `$db_name`.$Secciones SET `valor` = '$_POST[valor2]', `nombre` = '$_POST[nombre]' WHERE $Secciones.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
		$LogText = $LogText."* UPDATE BBDD ".strtoupper($Secciones)." ID ".$_POST['id']." DATOS ".$_POST['valor2']." / ".$_POST['nombre']."\n\t";
		$Title = "NUEVOS DATOS";
		require 'SeccionesTablaResult.php';
		print($TablaResultados);

		global $RedirUrl;	$RedirUrl = "SeccionesVer.php";
		global $RedirTime;	$RedirTime = 6000;
		require '../Inclu/AutoRedirUrl.php';
		global $Redir;      print ($Redir);

	}else{	print("* ERROR SQL L.114 ".mysqli_error($db))."</br>";
			$LogText = $LogText."* ERROR SQL L.114 ".mysqli_error($db)."\n\t";
	}

	} /* FINAL CONDICIONAL IF BBDD*/

?>