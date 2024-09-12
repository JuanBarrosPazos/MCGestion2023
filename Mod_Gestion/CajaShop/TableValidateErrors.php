<?php

	global $LogText;
	if($errors){

		if(isset($_POST['selec_pro'])){
			$defaults = array ( 'kgcash1' => '',
								'kgcash2' => '00',);
		}else{ }

		print("<table align='center'>
				<tr>
					<th style='text-align:center'>
						<font style='color:#F1BD2D;' >* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
				</tr>
				<tr>
					<td style='text-align:left !important'>");
			global $KeyErrors;
			for($a=0; $c=count($errors), $a<$c; $a++){
				print("<font style='color:#F1BD2D;' >**</font>  ".$errors [$a]."</br>");

				if($KeyErrors == 1){
					$LogText = $LogText."- ".$errors[$a]."\n\t";
					$RefOperShop = $_SESSION['oper'];
					$LogTextcarro = "	* PAGO 01 =>\t
									* SESSION OPER ".$RefOperShop."\t
									* ERRORES ".$errors [$a]."\t\n";
				}elseif($KeyErrors == 2){
					$RefOperShop = $_SESSION['oper'];
					if($_POST['producto'] == ''){ $tpro = 'TODOS LOS PRODUCTOS';}
					else{$tpro = $_POST['producto'];}
					$LogTextcarro = "	* SELECT PRO ERRORS =>\t
									* SESSION OPER ".$RefOperShop."\t
									* SECCION ".$_POST['seccion']."\t
									* PRODUCTO ".$_POST['proname']."\t	
									* ERROR ".$errors [$a]."\n";
				}elseif($KeyErrors == 3){
					$RefOperShop = $_SESSION['oper'];
					if($_POST['producto'] == ''){ $tpro = 'TODOS LOS PRODUCTOS';}
					else{$tpro = $_POST['producto'];}
					$LogTextcarro = "	* MODIF PRO ERRORES =>\t
									* SESSION OPER ".$RefOperShop."\t
									* SECCION ".$_POST['seccion']."\t
									* PRODUCTO ".$_POST['proname']."\t	
									* ERRORS ".$errors [$a]."\n";
				}else{ }
				log_info();
			}
		print("</td></tr></table>");
	}else{ }

?>