<?php


if ($_SESSION['Nivel'] == 'cliente') {
						
		print("
		
		<div style='clear:both'></div>
				
		<div class='MenuVertical'>
		
				 <!-- Comienza ul global -->
				
		<ul id='MenuBar1' class='MenuBarVertical'>
		
		  
	<!-- MENU CLIENTES -->

  <li><a href='#' class='MenuBarItemSubmenu'>CLIENTES</a>
    <ul>

   	 	<li><a href='clientes/cliente_Modificar_01.php'>CLIENTE VER & MODIFICAR</a></li>
    	<li><a href='clientes/caja_00.php'>TIENDA</a></li>
		<li><a href='clientes/ventas.php'>HISTORICO COMPRAS</a></li>  

      </ul>
    </li>

	<!-- Fin MENU CLIENTES-->


  	<li style='text-align:left'>
  				<form name='cerrar' action='clientes/mcgexit.php' method='post'>
						<input type='submit' value='CLOSE SESION' />
						<input type='hidden' name='cerrar' value=1 />
				</form>	
	</li>
	
		</ul>
		 <!-- Final ul global -->
		 
		
		<script type='text/javascript'>
		<!--
		var MenuBar1 = new Spry.Widget.MenuBar('MenuBar1', {imgRight:'MenuVerticalTutor/SpryMenuBarRightHover.gif'});
		-->
		  </script>
		  
		</div>
		
	");
	
	}
		
	?>