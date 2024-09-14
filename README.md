# ** PROYECTO INICIADO EN EL AÑO 2012 **
## * DESCRIPCION GENERAL *
### GESTOR DE STOCK, VENTAS, ADMINISTRADORES Y CLIENTES.
- Esta aplicación implementa tres modulos.
- Mod_Admin para la gestión de administradores en sus distintos niveles de acceso.
- Mod_Conta para la gestión de ingresos, gastos, clientes, proveedores y balances.
- Mod_Gestion para la gestión del flujo de caja y almacén.
- Enfocada actualmente al servicio en hostelería, se podría implementar en cualquier sector.
- Podríamos crear secciones, productos, fechas de perecederos, modificar los stocks y los precios de los productos, su iva, etc...
- Realizar una comanda en una mesa o zona del local, modificarla, mover la comanda a otra zona del local, hasta el momento de finalizar la facturación.
----
## CUESTIONES PENDIENTES
- OJO $KeyBorraUser NO LA LLAMA NADIE...
- LOGS PRODUCTOS, LOGS CAJA...
- REFRESCAR CONSULTAS REDIR AUTO CON VARIABLES POR GET...
- CREAR UNA FUNCIÓN QUE INCLUYA EL TOTAL DE LAS VENTAS EN INGRESOS... VOLCADO DIARIO Y ACTUALIZACIÓN...
- QUEDA PENDIENTE SI LOS PERECEDEROS ENTRAN EN LA TABLA GASTOS CON BASE IMPONIBLE Y SIN IVA...
- EN LA VALIDACIÓN DE IMÁGENES LOS ARCHIVOS PSD Y OTROS NO SE CONSIGUEN VALIDAR ???
- Ojo al $txt no se define en ningún sitio. La defino global $txt para evitar el error.
----
# ** ÚLTIMA VERSIÓN:
## * MCGestion2023 V24.09.13
- PENDIENTE FEEDBACK Y BORRAR CLIENTES WEB
* OPTIMIZACIÓN DEL CÓDIGO EN GENERAL...
* HE PERDIDO MIS CLAVES EN CLIENTES WEB...
* CREACION DE CLIENTES WEB DESDE INDEX PARA CLIENTES NO REGISTRADOS...
* REFORMATEADAS LOS DOCUMENTOS DE CONDICIONES LEGALES Y AUTO WINDOW.CLOSE...
* CONSULTA A SCHEMAS Y WHILE DE LAS TABLAS VENTAS EN CLIENTE MODIFICAR...
* AJUSTES EN REF CLIENTE WEB AL MODIFICAR LOS DATOS DEL CLIENTE...
* MODIFICAR REF CLIENTE WEB Y NOMBRE CLIENTE EN LAS TABLAS CLIENTE, VENTAS Y SHOP...
* AUTO REDIRECCIONAR Y CIERRE DE SESION AL MODIFICAR LA REFERENCIA CLIENTE...
* SOLUCIONADO ERROR EN CLOSE SESSION CLIENTES WEB, RUTA ERRONEA...
* AJUSTES GENERALES DE CODIGO EN CLIENTES WEB...
* FUNCION REDIR Y WINDOW.CLOSE EN DIRECTORIO INCLU/...
* ACCESO A CLIENTES WEB Y FOTO MENU CLIENTE.
* LOGS DE ACCESO Y CIERRE SESION CLIENTES WEB.
* MODIFICACIONES EN MOD_ADMIN Y MOD_CONTA...
----
## * MCGestion2023 V24.09.03
* LOGS Y COMPROBACIONES EN SECCIONES.
* SeccionesModificarSql.php WHILE MODIFICAR VENTAS CON CONSULTA A INFORMATION_SCHEMA.TABLES.
* OK CREAR, MODIFICAR, BORRAR, RECUPERAR Y BORRAR FEEDBACK.
* BORRAR LA SECCIÓN EN FEEDBACK, ELIMINACIÓN DE IMAGENES Y DIRECTORIO DE IMAGENES.
* OPTIMIZACIÓN DEL CÓDIGO EN SECCIONES...
----
## * MCGestion2023 V24.08.30
* OK OPTIMIZACIÓN DEL CÓDIGO EN PRODUCTOS Y STOCKS...
----
## * MCGestion2023 V24.08.27
* CONFIGURACIÓN GENERAL DE PRODUCTOS Y STOCKS...
* OK ProductosBorrar.php y Feedback_Productos_...
* OK ELIMINACIÓN IMAGENES DE LOS PRODUCTOS EN EL SERVIDOR.
* OK Productos_Ver.php, Productos_Modificar.php, Stock_Modificar.php y Stock_ModifPerecederos.php
* SE IMPLEMENTA LA FUNCION REDIR Y VARIABLE SECCIONES POR GET...
* SE ELIMINA EL DIRECTORIO STOCKS...
* OK Productos_Ver_02.php (imagenes de los productos) y Productos_Modificar_img.php
----
## * MCGestion2023 V24.08.20
* CONFIGURACIÓN GENERAL DE SECCIONES...
* INTEGRACIÓN DE MOD_CONTA 
* ELIMINACIÓN EN MOD_CONTA DEL DIRECTORIO GASTOS/, GEO_CLASS/, BBDD/, Conections/
* SOLUCIONADO ERROR EN LA CONFIGURACIÓN DE AYEAR.PHP ARRAY DE AÑOS Y YEAR.TXT AÑO ACTUAL
----
## * MCGestion2023 V24.08.19
  - AJUSTES DE CODIGO EN CAJA Y VENTAS
* SE GENERAN LAS CONSULTAS DE VENTAS Y LAS GRAFICAS ASOCIADAS
* SE MODIFICAN LOS ESTILOS CSS, LOS BOTONES Y LOS SELECT
* SE MODIFICAN LAS CONSULTAS PARA CONSTRUIR EL SELECT DE SECCIONES, SOLO CON PRODUCTOS
* SE ELIMINA LA TABLA STOCKS Y SE TRABAJA SOLO CON LA TABLA PRODUCTOS
* CAJA SE COMPRUEBAN LOS CALCULOS PARA AÑADIR, MODIFICAR Y ELIMINAR PRODUCTOS
* COMPROBACIÓN DE PAGO EN CAJA E INSERCIÓN DE DATOS EN LA TABLA DE VENTAS
* REESTRUCTURACIÓN DEL FORMULARIO SELECCIÓN DE CLIENTES / ZONAS DEL LOCAL
----
## * MCGestion2023 V24.07.18
  - AJUSTES DE CODIGO EN CLIENTES
  - CLIENTES DATOS POR DEFECTO EN LA BBDD
----
## * MCGestion2023 V24.07.17
  - AJUSTES DE CODIGO EN STOCKS
----
## * MCGestion2023 V24.07.16
  - MODIFICADA LA ESTRUCTURA DE LA BBDD
  - AJUSTES DE CODIGO EN SECCIONES Y PRODUCTOS
----
## * MCGestion2023 V24.07.11 & B
  - AJUSTES ARCHIVOS LOG Y CÓDIGO GENERAL.
----
## * MCGestion2023 V24.07.08
  - AJUSTES MENÚ NAVEGACION Y CÓDIGO.
----
## * MCGestion2023 V24.07.06
  - AJUSTES GENERALES DE CÓDIGO Y BBDD.
----
## * MCGestion2023 V24.06.18
  - RESET GIT Y AJUSTES GENERALES EN LA INSTALACIÓN.
----
## * MCGestion2023 V24.06.17
  - AJUSTES GENERALES EN LA NAVEGACIÓN DE LA APLICACIÓN.
----
## * MCGestion2023 V24.06.09
  - SE INTEGRA EL MÓDULO ADMIN BÁSICO.
  - CREACIÓN DE TABLAS Y DIRECTORIOS NECESARIOS PARA EL SISTEMA OK.
  - NAVEGACIÓN BÁSICA ENTRE LOS MÓDULOS ADMIN Y GESTIÓN OK.
----
