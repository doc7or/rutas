<?php
//Evitamos ataques de scripts de otros sitios
if(eregi("config_var.lib.php", $_SERVER["PHP_SELF"]) || eregi("config_var.lib.php", $HTTP_SERVER_VARS["PHP_SELF"])) die("Access denied!");

//DIRECTORIO
	//define("APPROOT",$_SERVER['DOCUMENT_ROOT']."/transporte_desarrollo/");//desarrollo
	define("APPROOT",$_SERVER['DOCUMENT_ROOT']."/RUTAS/");//local
	//define("APPROOT",$_SERVER['DOCUMENT_ROOT']."/transporte/");//vivo
	//define("APPROOT",$_SERVER['DOCUMENT_ROOT']."/transporte/");//casa
//DIRECTORIO


// PARA LOS INVLUDES
	define("DOMAIN_ROOT", "http://".$_SERVER['SERVER_NAME']."/RUTAS/");//vivo
	//define("DOMAIN_ROOT", "http://".$_SERVER['SERVER_NAME'].":8080/transporte_desarrollo/");//desarrollo
	//define("DOMAIN_ROOT", "http://".$_SERVER['SERVER_NAME'].":8080/transporte/");//local
	//define("DOMAIN_ROOT", "http://".$_SERVER['SERVER_NAME']."/transporte/");//casa
// PARA LOS INVLUDES

//DEFINES DE LUGARES DE CARPETAS 
	//fuentes fpdf
	define('FPDF_FONTPATH',APPROOT.'font/');
	//Correo
	define("SEND_MAIL", "false"); //Activa � Desactiva el envio de Correo.
	//carpetas
	define("FOLDER_ATTACH", "files"); // atachment
//DEFINES DE LUGARES DE CARPETAS 

//DEFINES MENSAJES GENERALES
	//nomre sstema
	define("SYSTEM_NAME","Rutas"); // sistema
//DEFINES MENSAJES GENERALES

//DEFINE DE CONSTANTES DE BASES DE DATOS Y SERVIDORES

	//SERVIDOR LOCAL 0 127.0.0.1
	/*define("USER","sa");
	define("PASS", "123456");
	define("SERVER","127.0.0.1");
	define("DB", "transporte");
	define("DB_CYBERLUX", "CYBERLUX");*/
	//SERVIDOR LOCAL 0 127.0.0.1

	//SERVIDOR LOCAL 0 10.10.1.7
	
	define("USER","sa");
	define("PASS", "123456");
	define("SERVER","10.10.3.22");
	define("DB", "rutas");
	define("DB_CYBERLUX", "CYBERLUX");

	//SERVIDOR LOCAL 0 10.10.1.7

	//SERVODOR DE LA CASA
	/*define("USER","");
	define("PASS", "");
	define("SERVER","doc7or");
	define("DB", "transporte");
	define("DB_CYBERLUX", "CYBERLUX");*/
	
	//SERVODOR DE LA CASA
	
	//DECLARACION DE LAS VARIABLES PARA LAS CONEXIONES ADICIONALES 
	//VARIABLES MYSQL
		//VARIABLES MYSQL LOCAL
		/*define ("USER_MYSQL", "root");//MYSQL
		define ("PASS_MYSQL", "");//MYSQL	
		define ("SERVER_MYSQL", "127.0.0.1");//MYSQL
		define ("DB_MYSQL", "cyber");*/
		//VARIABLES MYSQL LOCAL
		//MYSQL REMOTO
		define ("USER_MYSQL", "silva_cyber");
		define ("PASS_MYSQL", "P2vRrVt3LU0G");
		define ("SERVER_MYSQL", "184.172.180.195");
		define ("DB_MYSQL", "silva_cyber");
		//MYSQL REMOTO	
	//VARIABLES MYSQL
	
	
//FUNCIONES VARIAS USO
	
//DEFINE DE CONSTANTES DE BASES DE DATOS Y SERVIDORES



?>
	
