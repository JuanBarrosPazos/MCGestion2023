<?php

print("
		<select name='dy' title='SELECCIONAR AÑO..' class='botonverde' style='vertical-align: middle'>
			<option value=''>YEAR</option>");
				
	global $db;
	global $t1; 		$t1 = "`".$_SESSION['clave']."status`";
	$sqly =  "SELECT * FROM $t1 WHERE `stat` = 'open' ORDER BY `year` DESC ";
	$qy = mysqli_query($db, $sqly);
		 
	if(!$qy){
			print("* ".mysqli_error($db)."<br/>");
	} else {
							
		while($rowsy = mysqli_fetch_assoc($qy)){
					print ("<option value='".$rowsy['ycod']."' ");
					if($rowsy['ycod'] == @$defaults['dy']){
									print ("selected = 'selected'");
																		}
									print ("> ".$rowsy['year']." </option>");
		}
	}  

?>
