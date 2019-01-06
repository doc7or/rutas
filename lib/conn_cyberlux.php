<?php 
//Evitamos ataques de scripts de otros sitios
if(eregi("conn_cyberlux.php", $_SERVER["PHP_SELF"]) || eregi("conn_cyberlux.php", $HTTP_SERVER_VARS["PHP_SELF"])) die("Access denied!");
////CONEXION CON LA BASE DE DATOS
$link=mssql_connect(SERVER,USER,PASS) or die("Cound not connect to Database server");
$bd_cyberlux=mssql_select_db(DB_CYBERLUX,$link) or die( "Could not open database");


?>