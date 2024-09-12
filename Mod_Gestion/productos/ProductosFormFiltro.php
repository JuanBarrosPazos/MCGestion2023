<?php

		global $FormTitulo;		global $FormAction;     global $FormInp;	global $BotonForm;
		global $feed;
		if($feed == 1){
			$FormAction = "ProductosVer.php";
			$FormInp = "INICIO PRODUCTOS";
			$BotonForm = "InicioBlack";
		}else{
			$FormAction = "ProductosFeedbackVer.php";
			$FormInp = "FEEDBACK PRODUCTOS";
			$BotonForm = "CachedBlack";
		}
		print("<table align='center' style='border:0px;margin-top:4px; text-align:center;'>
                <tr>
                	<th>
			<form name='crear' action='ProductosCrear.php' method='POST' style='display: inline-block;' >
				<button type='submit' title='CREAR NUEVO PRODUCTO' class='botonazul imgButIco AddBlack'>
				</button>
					<input type='hidden' name='oculto2' value=1 />
			</form>
			<form name='crear' action='".$FormAction."' method='POST' style='display: inline-block;' >
				<button type='submit' title='".$FormInp."' class='botonazul imgButIco ".$BotonForm."'>
				</button>");

		if(isset($_POST['seccion'])){
			echo "<input type='hidden' name='seccion' value='".$_POST['seccion']."' />";
		}elseif(isset($_GET['seccion'])){
			echo "<input type='hidden' name='seccion' value='".$_GET['seccion']."' />";
		}else{ }
					
		print("<input type='hidden' name='oculto2' value=1 />
				</form>
					</th>
                </tr>
				<tr>
					<th>".$FormTitulo." ".$SecNameName."</th>
				</tr>		
				<tr>
					<td>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<button type='submit' title='".$FormInp."' class='botonverde imgButIco BuscaBlack'>
				</button>
					<input type='hidden' name='oculto1' value=1 />
						<select name='seccion' class='botonverde' >");

	require "../config/TablesNames.php";
	$sqs1 =  "SELECT * FROM $Secciones ORDER BY `valor` ASC ";
	$qb = mysqli_query($db, $sqs1);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	}else{
		while($rows = mysqli_fetch_assoc($qb)){
				print ("<option value='".$rows['valor']."' ");
				if($rows['valor'] == $defaults['seccion']){print ("selected = 'selected'");}
				print ("> ".$rows['nombre']." </option>");
				}
	}
		print ("</select>
					</td>
				</tr>
					</form>	
			</table>"); 

?>