<?php

	global $rutaindex;		
	global $menuArticulos;		global $menuContaBasic;		
	global $menuContacto;		global $menuAgenda;

	/************	SI EXISTE EL CONSTRUCTOR DE TABLAS ARTICULOS BLOG	*****************/
	
	if(file_exists($rutaindex."../Mod_Contenidos/index.php")){
		$menuArticulos = "<a href='".$rutaindex."../Mod_Contenidos/index.php'>
								<i class='ic ico19'></i><span>CONTENIDOS</span>
							</a>";
	} else { 
		$menuArticulos = "<a href='#'>
								<i class='ic ico19'></i><span>CATEGORIA 2</span>
							</a>
						<ul class='nav-flyout'>
							<li>
								<a href='#' ".$topcat2.">
									<i class='ic ico19b'></i>OTRO LINK
								</a>
							</li>
							<li>
								<a href='#'>
									<i class='ic ico19b'></i>OTRO LINK
								</a>
							</li>
						</ul>";
		} 

	/************	COMPROBAMOS QUE EXISTE CONTA BASIC	*****************/

	if(file_exists($rutaindex."../Mod_Conta/index.php")){
		$menuContaBasic = "<a href='".$rutaindex."../Mod_Conta/index.php'>
								<i class='ic ico20'></i><span>CONTA BASIC</span>
							</a>";
	} else { 
		$menuContaBasic = "<a href='#'>
								<i class='ic ico20'></i><span>CATEGORIA 3</span>
							</a>
						<ul class='nav-flyout'>
							<li>
								<a href='#' ".$topcat3.">
									<i class='ic ico20b'></i>OTRO LINK
								</a>
							</li>
							<li>
								<a href='#'>
									<i class='ic ico20b'></i>OTRO LINK
								</a>
							</li>
						</ul>";
		} 

	/************	COMPROBAMOS LAS TABLAS AGENDA	*****************/

	if(file_exists($rutaindex."../Mod_Agenda/index.php")){
		$menuAgenda = "<a href='".$rutaindex."../Mod_Agenda/index.php'>
							<i class='ic ico19'></i><span>AGENDA</span>
						</a>";
	} else { 
		$menuAgenda = "<a href='#'>
							<i class='ic ico19'></i><span>CATEGORIA 4</span>
						</a>
						<ul class='nav-flyout'>
							<li>
								<a href='#' ".$topcat4.">
									<i class='ic ico19b'></i>OTRO LINK
								</a>
							</li>
							<li>
								<a href='#'>
									<i class='ic ico19b'></i>OTRO LINK
								</a>
							</li>
						</ul>";
	}


	/************	COMPROBAMOS LAS TABLAS GESTION	*****************/

	if(file_exists($rutaindex."../Mod_Gestion/Admin_index.php")){
		$menuContacto = "<a href='".$rutaindex."../Mod_Gestion/Admin_index.php'>
								<i class='ic ico10'></i><span>MCGESTION</span>
							</a>";
	} else { 
		$menuContacto = "<a href='#'>
								<i class='ic ico10'></i><span>CATEGORIA 5</span>
							</a>
						<ul class='nav-flyout'>
							<li>
								<a href='#' ".$topcat5.">
									<i class='ic ico10b'></i>OTRO LINK
								</a>
							</li>
							<li>
								<a href='#'>
									<i class='ic ico10b'></i>OTRO LINK
								</a>
							</li>
						</ul>";
		}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	print("<li>
				<a href='#'>
					<i class='ic ico13'></i><span>EMPLEADOS</span>
				</a>
			<ul class='nav-flyout'>
				<li>
					<a href='".$rutaadmin."Admin_Ver.php' ".$topcat0.">
						<i class='ic ico15b'></i>GESTION ADMIN
					</a>
				</li>");

	if ($_SESSION['Nivel'] == 'admin') {
	print("		<li>
					<a href='".$rutaadmin."Admin_Crear.php'>
						<i class='ic ico14b'></i>CREAR ADMIN
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Feedback_Ver.php'>
						<i class='ic ico19b'></i>GESTION BAJAS
					</a>
				</li>
				<li>
					<a href='".$rutabbdd."export_log.php'>
						<i class='ic ico02b'></i>USERS.LOG
					</a>
				</li>
			</ul>
		</li>
			");
	}else{print("</ul></li>");}

	if ($_SESSION['Nivel'] == 'admin') {
	print("
		<li>
			<a href='#'>
			<i class='ic ico12'></i><span>QR CODE</span>
			</a>
			<ul class='nav-flyout'>
			<li>
			<a href='".$rutaqrgen."indexqrg.php' ".$topcat1.">
				<i class='ic ico20b'></i>QR GENERADOR
			</a>
		</li>
		<li>
			<a href='".$rutacam."indexcam.php'>
				<i class='ic ico20b'></i>QR SCANNER
			</a>
		</li>
	</ul>
		</li>

		<li>
			".$menuArticulos."
		</li>
	
		<li>
			".$menuContaBasic."
		</li>

		<li>
			".$menuAgenda."
		</li>
	
		<li>
			".$menuContacto."
		</li>
		");
	}else{	print("
		<li>
			<a href='#'>
			<i class='ic ico12'></i><span>CATEGORIA 1</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' ".$topcat1.">
						<i class='ic ico13b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico15b'></i>OTRO LINK
					</a>
				</li>
			</ul>
		</li>
		");
	}

	print("<li>
				<a href='".$rutaindex."Mail_Php/index.php' target='_blank'>
					<i class='ic ico16'></i>NOTIFICACIONES
				</a>
			</li>
	
	<li style='text-align:center;'>
		<a href='#'>
			<form name='cerrar' action='".$rutaadmin."mcgexit.php' method='post'>
		<input type='submit' value='CLOSE SESSION' style='margin-top:-2px; margin-left:6px;' class='botonverde'/>
		<input type='hidden' name='cerrar' value=1 />
			</form>
		</a>
	</li>
				</ul>
			</nav>
		</aside>
	</section>
</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL ADMIN
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");

?>