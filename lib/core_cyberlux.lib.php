<?php
//Evitamos ataques de scripts de otros sitios
if(eregi("core_cyberlux.lib.php", $_SERVER["PHP_SELF"]) || eregi("core_cyberlux.lib.php", $HTTP_SERVER_VARS["PHP_SELF"])) die("Access denied!");

//El config_var va en el mismo directorio del core.lib
require("config_var.php"); 
//El conex va en el mismo directorio del corelib
require("conn_cyberlux.php"); 

//Carga de clases del sistema
require(APPROOT."lib/class/cyberlux_clientes.class.php");
require(APPROOT."lib/class/cyberlux_factura.class.php");
require(APPROOT."lib/class/cyberlux_not_ent.class.php");
require(APPROOT."lib/class/cyberlux_pedidos.class.php");
require(APPROOT."lib/class/cyberlux_sub_alma.class.php");
require(APPROOT."lib/class/cyberlux_tras_alm.class.php");


//utilitarias
require(APPROOT."lib/php/funciones.php");

?>

