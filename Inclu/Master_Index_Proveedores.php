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
  <a href='#'>ADMINISTRACI&Oacute;N SISTEMA</a>
  <ul>
 
<!-- MENU ADMINISTRADORES -->

	<li>
  		<a href='../Admin/Admin_Ver.php' >GESTION ADMINISTRADORES</a>
    </li>

	<!-- Fin MENU ADMINISTRADORES -->
 
<!-- MENU PROVEEDORES -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTION PROVEEDORES</a>
    <ul>

<li><a href='Provee_Ver.php'>PROVEEDOR CONSULTAR</a></li>  
<li><a href='Provee_Crear.php'>PROVEEDOR CREAR</a></li> 
<li><a href='Provee_Modificar_01.php'>PROVEEDOR MODIFICAR</a></li>
<li><a href='Provee_Borrar_01.php'>PROVEEDOR BORRAR</a></li>
<li><a href='Provee_Modificar_Feed_01.php'>PROVEE. FEED MODIF</a></li>
<li><a href='Provee_Borrar_Feed_01.php'>PROVEE. FEED BORRAR</a></li>

    </ul>
  </li>

	<!-- Fin MENU PROVEEDORES -->
	
	<!-- MENU CLIENTES -->

  	<li>
  		<a href='../Admin_clientes/cliente_Ver.php' class='MenuBarItemSubmenu'>GESTION CLIENTES</a>
    </li>

	<!-- Fin MENU CLIENTES-->
 
    <!-- Inicio GESTIÓN DE GASTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN GASTOS & VENTAS</a>
    <ul>
    
	<li><a href='../caja/ventas.php'>VENTAS CONSULTAR</a></li>  
    <li><a href='../gastos/Gastos_Ver.php'>GASTOS CONSULTAR</a></li>
    <li><a href='../gastos/Gastos_Crear.php'>GASTOS CREAR DATOS</a></li>
    <li><a href='../gastos/Gastos_Modificar_01.php'>GASTOS MODIFICAR</a></li>
    <li><a href='../gastos/Gastos_Borrar_01.php'>GASTOS ELIMINAR</a></li>

      </ul>
    </li>
	
	<!-- Fin GESTIÓN DE GASTOS -->

    <!-- Inicio GESTIÓN DE STOCKS -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN DE STOCKS</a>
    <ul>
    
      <li><a href='../stocks/Stock_Ver.php'>STOCKS VER</a></li>
      <li><a href='../stocks/Stock_Crear.php'>STOCKS CREAR DATOS</a></li>
      <li><a href='../stocks/Stock_Modificar_01.php'>STOCKS MODIFICAR DATOS</a></li>
      <li><a href='../stocks/Stock_Borrar_01.php'>STOCKS ELIMINAR DATOS</a></li>
      <li><a href='../stocks/Feedback_Stock_Ver.php'>STOCKS FEEDBACK VER</a></li>
      <li><a href='../stocks/Feedback_Stock_Recuperar_01.php'>STOCKS FEED RECUPERA</a></li>
      <li><a href='../stocks/Feedback_Stock_Borrar_01.php'>STOCKS FEED BORRAR</a></li>

      </ul>
    </li>
	
	<!-- Fin GESTIÓN DE STOCKS -->
    
    
  <!-- Inicio GESTION DE PRODUCTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN DE PRODUCTOS</a>
    <ul>

   <li><a href='../productos/Productos_Ver.php'>PRODUCTOS VER</a></li>
   <li><a href='../productos/Productos_Crear.php'>PRODUCTOS CREAR</a></li>
   <li><a href='../productos/Productos_Modificar_01.php'>PRODUCTOS MODIFICAR</a></li>
   <li><a href='../productos/Productos_Borrar_01.php'>PRODUCTOS BORRAR</a></li>
   <li><a href='../productos/Feedback_Productos_Ver.php'>PRODUCTOS FEEDBACK VER</a></li>
   <li><a href='../productos/Feedback_Productos_Recuperar_01.php'>PRODUCTOS FEED RECUPERA</a></li>
   <li><a href='../productos/Feedback_Productos_Borrar_01.php'>PRODUCTOS FEED BORRAR</a></li>

      </ul>
    </li>
 
  <!-- Fin GESTION DE PRODUCTOS -->


  <!-- Inicio GESTION DE SECCIONES -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN DE SECCIONES</a>
    <ul>

     <li><a href='../secciones/Secciones_Ver.php'>SECCIONES VER</a></li>
     <li><a href='../secciones/Secciones_Crear.php'>SECCIONES CREAR</a></li>
     <li><a href='../secciones/Secciones_Modificar_01.php'>SECCIONES MODIFICAR</a></li>
     <li><a href='../secciones/Secciones_Borrar_01.php'>SECCIONES ELIMINAR</a></li>
     <li><a href='../secciones/Secciones_Recupera_01.php'>SECCIONES RECUPERAR</a></li>
     <li><a href='../secciones/Secciones_Feed_Borrar_01.php'>SECCIONES FEED BORRAR</a></li>
     <li><a href='../secciones/Tablas_Ver.php'>TABLE NAMES</a></li>

      </ul>
    </li>
  <!-- Fin GESTION DE SECCIONES -->

	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>GESTION DE CAJA</a>
			<ul>
			
 			<li><a href='Stock_Ver.php'>STOCKS VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

  	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
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
		  <a href='#'>ADMINISTRACI&Oacute;N SISTEMA</a>
		  <ul>
		  
 
<!-- MENU PROVEEDORES -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTION PROVEEDORES</a>
    <ul>

<li><a href='Provee_Ver.php'>PROVEEDOR CONSULTAR</a></li>  
<li><a href='Provee_Crear.php'>PROVEEDOR CREAR</a></li> 
<li><a href='Provee_Modificar_01.php'>PROVEEDOR MODIFICAR</a></li>
<li><a href='Provee_Borrar_01.php'>PROVEEDOR BORRAR</a></li>
<li><a href='Provee_Modificar_Feed_01.php'>PROVEE. FEED MODIF</a></li>
<li><a href='Provee_Borrar_Feed_01.php'>PROVEE. FEED BORRAR</a></li>

    </ul>
  </li>

	<!-- Fin MENU PROVEEDORES -->
	
	<!-- MENU CLIENTES -->

  	<li>
  		<a href='../Admin_clientes/cliente_Ver.php' class='MenuBarItemSubmenu'>GESTION CLIENTES</a>
    </li>

	<!-- Fin MENU CLIENTES-->
 
    <!-- Inicio GESTIÓN DE GASTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN GASTOS & VENTAS</a>
    <ul>
    
	<li><a href='../caja/ventas.php'>VENTAS CONSULTAR</a></li>  
    <li><a href='../gastos/Gastos_Ver.php'>GASTOS CONSULTAR</a></li>
    <li><a href='../gastos/Gastos_Crear.php'>GASTOS CREAR DATOS</a></li>
    <li><a href='../gastos/Gastos_Modificar_01.php'>GASTOS MODIFICAR</a></li>
    <li><a href='../gastos/Gastos_Borrar_01.php'>GASTOS ELIMINAR</a></li>

      </ul>
    </li>
	
	<!-- Fin GESTIÓN DE GASTOS -->

	<!-- Inicio GESTIÓN DE STOCKS -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN DE STOCKS</a>
			<ul>
			
<li><a href='../stocks/Stock_Ver.php'>STOCKS VER</a></li>
<li><a href='../stocks/Stock_Crear.php'>STOCKS CREAR DATOS</a></li>
<li><a href='../stocks/Stock_Modificar_01.php'>STOCKS MODIFICAR DATOS</a></li>
<li><a href='../stocks/Stock_Borrar_01.php'>STOCKS ELIMINAR DATOS</a></li>
<li><a href='../stocks/Feedback_Stock_Ver.php'>STOCKS FEEDBACK VER</a></li>
<li><a href='../stocks/Feedback_Stock_Recuperar_01.php'>STOCKS FEED RECUPERA</a></li>
			  </ul>
			</li>
		<!-- Fin GESTIÓN DE STOCKS -->
			
  <!-- Inicio GESTION DE PRODUCTOS -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN DE PRODUCTOS</a>
    <ul>

   <li><a href='../productos/Productos_Ver.php'>PRODUCTOS VER</a></li>
   <li><a href='../productos/Productos_Crear.php'>PRODUCTOS CREAR</a></li>
   <li><a href='../productos/Productos_Modificar_01.php'>PRODUCTOS MODIFICAR</a></li>
   <li><a href='../productos/Productos_Borrar_01.php'>PRODUCTOS BORRAR</a></li>
   <li><a href='../productos/Feedback_Productos_Ver.php'>PRODUCTOS FEEDBACK VER</a></li>
   <li><a href='../productos/Feedback_Productos_Recuperar_01.php'>PRODUCTOS FEED RECUPERA</a></li>

      </ul>
    </li>
 
  <!-- Fin GESTION DE PRODUCTOS -->

	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>GESTION DE CAJA</a>
			<ul>
			
 			<li><a href='Stock_Ver.php'>STOCKS VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

  	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
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
		  <a href='#'>ADMINISTRACI&Oacute;N SISTEMA</a>
		  <ul>
		  
 
	<!-- MENU CLIENTES -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTION CLIENTES</a>
    <ul>

<li><a href='../Admin_clientes/cliente_Ver.php'>CLIENTES CONSULTAR</a></li>  
<li><a href='../Admin_clientes/cliente_Crear.php'>CLIENTES CREAR</a></li> 
<li><a href='../Admin_clientes/cliente_Modificar_01.php'>CLIENTES MODIFICAR</a></li>

      </ul>
    </li>

	<!-- Fin MENU CLIENTES-->
 
			<!-- Inicio GESTIÓN DE STOCKS -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>GESTIÓN DE STOCKS</a>
			<ul>
			
			  <li><a href='Stock_Ver.php'>VER STOCKS</a></li>
			  <li><a href='Stock_Crear.php'>STOCKS CREAR DATOS</a></li>
		
			  </ul>
			</li>
		<!-- Fin GESTIÓN DE STOCKS -->
			

	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>GESTION DE CAJA</a>
			<ul>
			
 			<li><a href='Stock_Ver.php'>STOCKS VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

  	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
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
		  <a href='#'>ADMINISTRACI&Oacute;N SISTEMA</a>
		  <ul>
		  
 
	<!-- MENU CLIENTES -->

  <li><a href='#' class='MenuBarItemSubmenu'>GESTION CLIENTES</a>
    <ul>

		<li><a href='../Admin_clientes/cliente_Ver.php'>CLIENTES CONSULTAR</a></li>  
		<li><a href='../Admin_clientes/cliente_Crear.php'>CLIENTES CREAR</a></li> 
		<li><a href='../Admin_clientes/cliente_Modificar_01.php'>CLIENTES MODIFICAR</a></li>

      </ul>
    </li>

	<!-- Fin MENU CLIENTES-->
 
 	<!-- Inicio CAJA -->
		
		  <li><a href='#' class='MenuBarItemSubmenu'>GESTION DE CAJA</a>
			<ul>
			
     		<li><a href='Stock_Ver.php'>STOCKS VER</a></li>
      		<li><a href='../caja/caja_00.php'>INICIO CAJA</a></li>
		
			  </ul>
			</li>
	<!-- Fin CAJA -->

 	</ul>
  </li>
  
  <!-- FIN MENU ADMINISTRADORES -->

  	<li style='text-align:left'>
  				<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
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