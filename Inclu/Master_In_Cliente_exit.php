<?php


if ($_SESSION['Nivel'] == 'cliente') {
						
		print("
		
		<div style='clear:both'></div>
				
		<div class='MenuVertical'>
		
				 <!-- Comienza ul global -->
				
		<ul id='MenuBar1' class='MenuBarVertical'>
		
		  
	<!-- MENU CLIENTES -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTION VER & CLIENTES</a>
    <ul>

      	<li><a href='cliente_Modificar_01.php'>CLIENTE MODIFICAR</a></li>
      	<li><a href='cliente_Borrar_01.php'>CLIENTE BORRAR</a></li>
      	<li><a href='caja_00.php'>TIENDA</a></li>
		<li><a href='ventas.php'>HISTORICO COMPRAS</a></li>  
      </ul>
    </li>

	<!-- Fin MENU CLIENTES-->

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