<?php

	if ($_SESSION['Nivel'] == 'admin') {	
		
		print("

<div style='clear:both'></div>
		
<div class='MenuVertical'>

		<!-- *************************** -->
		<!-- Comienza el menu Tutoriales -->
		<!-- *************************** -->

 <!-- Comienza ul global -->
 		
<ul id='MenuBar1' class='MenuBarVertical'>

  <li class='MenuBarItemSubmenu'>
  <a href='#'>MENU APP</a>
  <ul>
 
<!-- MENU ADMINISTRADORES -->

	<li>
  		<a href='../../Mod_Admin/Admin/Admin_Ver.php'>MODULO ADMIN</a>
    </li>

	<!-- Fin MENU ADMINISTRADORES -->
 
<!-- MENU PROVEEDORES -->

  <li><a href='#' class='MenuBarItemSubmenu'>PROVEEDORES</a>
    <ul>

<li><a href='Provee_Ver.php'>PROV. CONSULTAR</a></li>  
<li><a href='Provee_Crear.php'>PROV. CREAR</a></li> 
<li><a href='Provee_Modificar_01.php'>PROV. MODIFICAR</a></li>
<li><a href='Provee_Borrar_01.php'>PROV. BORRAR</a></li>
<li><a href='Provee_Modificar_Feed_01.php'>PROV.  FEED MODIF</a></li>
<li><a href='Provee_Borrar_Feed_01.php'>PROV.  FEED BORRAR</a></li>

    </ul>
  </li>

	<!-- Fin MENU PROVEEDORES -->
	
	<!-- MENU CLIENTES -->

  	<li>
  		<a href='../Admin_clientes/cliente_Ver.php' class='MenuBarItemSubmenu'>CLIENTES</a>
    </li>

	<!-- Fin MENU CLIENTES-->
 
    <!-- Inicio GESTIÓN DE GASTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>GASTOS & VENTAS</a>
    <ul>
    
	<li><a href='../caja/ventas.php'>VENTAS CONSULTAR</a></li>  
    <li><a href='../gastos/Gastos_Ver.php'>GASTOS CONSULTAR</a></li>
    <li><a href='../gastos/Gastos_Crear.php'>GASTOS CREAR DATOS</a></li>
    <li><a href='../gastos/Gastos_Modificar_01.php'>GASTOS MODIFICAR</a></li>
    <li><a href='../gastos/Gastos_Borrar_01.php'>GASTOS ELIMINAR</a></li>

      </ul>
    </li>
	
	<!-- Fin GESTIÓN DE GASTOS -->

    <!-- Inicio STOCKS -->

  <li><a href='#' class='MenuBarItemSubmenu'>STOCKS</a>
    <ul>
    
      <li><a href='../stocks/Stock_Ver.php'>VER</a></li>
      <li><a href='../stocks/Stock_Crear.php'>CREAR DATOS</a></li>
      <li><a href='../stocks/Stock_Modificar_01.php'>MODIFICAR DATOS</a></li>
      <li><a href='../stocks/Stock_Borrar_01.php'>ELIMINAR DATOS</a></li>
      <li><a href='../stocks/Feedback_Stock_Ver.php'>FEEDBACK VER</a></li>
      <li><a href='../stocks/Feedback_Stock_Recuperar_01.php'>FEED RECUPERA</a></li>
      <li><a href='../stocks/Feedback_Stock_Borrar_01.php'>FEED BORRAR</a></li>

      </ul>
    </li>
	
	<!-- Fin STOCKS -->
    
    
  <!-- Inicio PRODUCTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>PRODUCTOS</a>
    <ul>

   <li><a href='../productos/Productos_Ver.php'>VER</a></li>
   <li><a href='../productos/Productos_Crear.php'>CREAR</a></li>
   <li><a href='../productos/Productos_Modificar_01.php'>MODIFICAR</a></li>
   <li><a href='../productos/Productos_Borrar_01.php'>BORRAR</a></li>
   <li><a href='../productos/Feedback_Productos_Ver.php'>FEEDBACK VER</a></li>
   <li><a href='../productos/Feedback_Productos_Recuperar_01.php'>FEED RECUPERA</a></li>
   <li><a href='../productos/Feedback_Productos_Borrar_01.php'>FEED BORRAR</a></li>

      </ul>
    </li>
 
  <!-- Fin PRODUCTOS -->


  <!-- Inicio SECCIONES -->

  <li><a href='#' class='MenuBarItemSubmenu'>SECCIONES</a>
    <ul>

     <li><a href='../secciones/Secciones_Ver.php'>VER</a></li>
     <li><a href='../secciones/Secciones_Crear.php'>CREAR</a></li>
     <li><a href='../secciones/Secciones_Modificar_01.php'>MODIFICAR</a></li>
     <li><a href='../secciones/Secciones_Borrar_01.php'>ELIMINAR</a></li>
     <li><a href='../secciones/Secciones_Recupera_01.php'>RECUPERAR</a></li>
     <li><a href='../secciones/Secciones_Feed_Borrar_01.php'>FEED BORRAR</a></li>
     <li><a href='../secciones/Tablas_Ver.php'>TABLE NAMES</a></li>

      </ul>
    </li>
  <!-- Fin SECCIONES -->

	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>CAJA</a>
			<ul>
			
 			<li><a href='Stock_Ver.php'>VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

  	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../../Mod_Admin/Admin/mcgexit.php' method='post'>
						<input type='submit' value='CLOSE SESION' />
						<input type='hidden' name='cerrar' value=1 />
				</form>	
	</li>

</ul>
 <!-- Final ul global -->
 

<script type='text/javascript'>
<!--
var MenuBar1 = new Spry.Widget.MenuBar('MenuBar1', {imgRight:'MenuVerticalTutor/SpryMenuBarRightHover.gif'});
//-->
  </script>
  
<!-- *************************** -->
<!-- Finaliza el menu Tutoriales -->
<!-- *************************** -->
</div>

	");

	} elseif ($_SESSION['Nivel'] == 'plus') {
						
		print("
		
		<div style='clear:both'></div>
				
		<div class='MenuVertical'>
		
				 <!-- Comienza ul global -->
				
		<ul id='MenuBar1' class='MenuBarVertical'>
		
		  <li class='MenuBarItemSubmenu'>
		  <a href='#'>MENU APP</a>
		  <ul>
		  
 
<!-- MENU PROVEEDORES -->

  <li><a href='#' class='MenuBarItemSubmenu'>PROVEEDORES</a>
    <ul>

<li><a href='Provee_Ver.php'>PROV. CONSULTAR</a></li>  
<li><a href='Provee_Crear.php'>PROV. CREAR</a></li> 
<li><a href='Provee_Modificar_01.php'>PROV. MODIFICAR</a></li>
<li><a href='Provee_Borrar_01.php'>PROV. BORRAR</a></li>
<li><a href='Provee_Modificar_Feed_01.php'>PROV.  FEED MODIF</a></li>
<li><a href='Provee_Borrar_Feed_01.php'>PROV.  FEED BORRAR</a></li>

    </ul>
  </li>

	<!-- Fin MENU PROVEEDORES -->
	
	<!-- MENU CLIENTES -->

  	<li>
  		<a href='../Admin_clientes/cliente_Ver.php' class='MenuBarItemSubmenu'>CLIENTES</a>
    </li>

	<!-- Fin MENU CLIENTES-->
 
    <!-- Inicio GESTIÓN DE GASTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>GASTOS & VENTAS</a>
    <ul>
    
	<li><a href='../caja/ventas.php'>VENTAS CONSULTAR</a></li>  
    <li><a href='../gastos/Gastos_Ver.php'>GASTOS CONSULTAR</a></li>
    <li><a href='../gastos/Gastos_Crear.php'>GASTOS CREAR DATOS</a></li>
    <li><a href='../gastos/Gastos_Modificar_01.php'>GASTOS MODIFICAR</a></li>
    <li><a href='../gastos/Gastos_Borrar_01.php'>GASTOS ELIMINAR</a></li>

      </ul>
    </li>
	
	<!-- Fin GESTIÓN DE GASTOS -->

	<!-- Inicio STOCKS -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>STOCKS</a>
			<ul>
			
<li><a href='../stocks/Stock_Ver.php'>VER</a></li>
<li><a href='../stocks/Stock_Crear.php'>CREAR DATOS</a></li>
<li><a href='../stocks/Stock_Modificar_01.php'>MODIFICAR DATOS</a></li>
<li><a href='../stocks/Stock_Borrar_01.php'>ELIMINAR DATOS</a></li>
<li><a href='../stocks/Feedback_Stock_Ver.php'>FEEDBACK VER</a></li>
<li><a href='../stocks/Feedback_Stock_Recuperar_01.php'>FEED RECUPERA</a></li>
			  </ul>
			</li>
		<!-- Fin STOCKS -->
			
  <!-- Inicio PRODUCTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>PRODUCTOS</a>
    <ul>

   <li><a href='../productos/Productos_Ver.php'>VER</a></li>
   <li><a href='../productos/Productos_Crear.php'>CREAR</a></li>
   <li><a href='../productos/Productos_Modificar_01.php'>MODIFICAR</a></li>
   <li><a href='../productos/Productos_Borrar_01.php'>BORRAR</a></li>
   <li><a href='../productos/Feedback_Productos_Ver.php'>FEEDBACK VER</a></li>
   <li><a href='../productos/Feedback_Productos_Recuperar_01.php'>FEED RECUPERA</a></li>

      </ul>
    </li>
 
  <!-- Fin PRODUCTOS -->

	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>CAJA</a>
			<ul>
			
 			<li><a href='Stock_Ver.php'>VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

  	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../../Mod_Admin/Admin/mcgexit.php' method='post'>
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
	
	} elseif ($_SESSION['Nivel'] == 'user') { 
						
		print("
				<div style='clear:both'></div>
						
				<div class='MenuVertical'>
				
				 <!-- Comienza ul global -->
				
		<ul id='MenuBar1' class='MenuBarVertical'>
		
		  <li class='MenuBarItemSubmenu'>
		  <a href='#'>MENU APP</a>
		  <ul>
		  
 
	<!-- MENU CLIENTES -->

  <li><a href='#' class='MenuBarItemSubmenu'>CLIENTES</a>
    <ul>

<li><a href='../Admin_clientes/cliente_Ver.php'>CLIENTES CONSULTAR</a></li>  
<li><a href='../Admin_clientes/cliente_Crear.php'>CLIENTES CREAR</a></li> 
<li><a href='../Admin_clientes/cliente_Modificar_01.php'>CLIENTES MODIFICAR</a></li>

      </ul>
    </li>

	<!-- Fin MENU CLIENTES-->
 
			<!-- Inicio STOCKS -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>STOCKS</a>
			<ul>
			
			  <li><a href='Stock_Ver.php'>VER STOCKS</a></li>
			  <li><a href='Stock_Crear.php'>CREAR DATOS</a></li>
		
			  </ul>
			</li>
		<!-- Fin STOCKS -->
			

	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>CAJA</a>
			<ul>
			
 			<li><a href='Stock_Ver.php'>VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

  	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../../Mod_Admin/Admin/mcgexit.php' method='post'>
						<input type='submit' value='CLOSE SESION' />
						<input type='hidden' name='cerrar' value=1 />
				</form>	
	</li>
	
		</ul>
		 <!-- Final ul global -->
		 
		
		<script type='text/javascript'>
		<!--
		var MenuBar1 = new Spry.Widget.MenuBar('MenuBar1', {imgRight:'MenuVerticalTutor/SpryMenuBarRightHover.gif'});
		//-->
		  </script>
		  
		</div>
		
	");
	
	}	 elseif ($_SESSION['Nivel'] == 'caja') { 
						
		print("
				<div style='clear:both'></div>
						
				<div class='MenuVertical'>
				
				 <!-- Comienza ul global -->
				
		<ul id='MenuBar1' class='MenuBarVertical'>
		
		  <li class='MenuBarItemSubmenu'>
		  <a href='#'>MENU APP</a>
		  <ul>
		  
 
	<!-- MENU CLIENTES -->

  <li><a href='#' class='MenuBarItemSubmenu'>CLIENTES</a>
    <ul>

		<li><a href='../Admin_clientes/cliente_Ver.php'>CLIENTES CONSULTAR</a></li>  
		<li><a href='../Admin_clientes/cliente_Crear.php'>CLIENTES CREAR</a></li> 
		<li><a href='../Admin_clientes/cliente_Modificar_01.php'>CLIENTES MODIFICAR</a></li>

      </ul>
    </li>

	<!-- Fin MENU CLIENTES-->
 
 	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>CAJA</a>
			<ul>
			
     		<li><a href='Stock_Ver.php'>VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

 	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../../Mod_Admin/Admin/mcgexit.php' method='post'>
						<input type='submit' value='CLOSE SESION' />
						<input type='hidden' name='cerrar' value=1 />
				</form>	
	</li>
	
		</ul>
		 <!-- Final ul global -->
		 
		
		<script type='text/javascript'>
		<!--
		var MenuBar1 = new Spry.Widget.MenuBar('MenuBar1', {imgRight:'MenuVerticalTutor/SpryMenuBarRightHover.gif'});
		//-->
		  </script>
		  
		</div>
		
	");
	
	}	
	
	?>