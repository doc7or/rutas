<?php 
//Evitamos ataques de scripts de otros sitios
//if(eregi("conn.lib.php", $_SERVER["PHP_SELF"]) || eregi("conn.lib.php", $HTTP_SERVER_VARS["PHP_SELF"])) die("Access denied!");
////CONEXION CON LA BASE DE DATOS
//echo "server" .SERVER ."usuario" .USER."pass" .PASS;

$link=mssql_connect(SERVER,USER,PASS) or die("No se pudo conectar al Servidor Sql Server");

//if($link) { echo 'si se conecta'; }
mssql_select_db(DB,$link) or die( "Could not open database");


//servidor

/*$host="localhost";
$QQ="teneriar";
$p="tsv020711";
/*
$host="localhost";
$QQ="";
$p=""; 

$db=mysql_connect($host,$QQ,$p)
or die('counter CONNECT error: '.mysql_errno().', '.mysql_error());
//mysql_select_db("teneria")
mysql_select_db("teneriar_sistelme")
or die('counter CONNECT error: '.mysql_errno().', '.mysql_error());*/
?>