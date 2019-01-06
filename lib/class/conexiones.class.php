<?php 
class class_conexiones{
/*
	NAME: 		CLASE DE CONEXIONES
	AUTHOR:		ROBERTH NAVARRO
	DATE:		17/07/2009 
	SUBJET:		SE CREA PARA LA CONECCION COM MULTIPLES BASE DE DATOS Y EN MUTIPLES SERVIDORES, PARA EVITAR LA UTILISACION DEL  ARCHIVO LOS ARCHIVOS DE CONEXCION ASI Q  EN ESTE CASO SE USA LA CONECCION DIRECTAMENTE	
*/



//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES
	
	//FUNCETIONES DE MYSQL esta coneccion es hacia 
		function my_conect(){
			$my_connection = mysql_connect(SERVER_MYSQL,USER_MYSQL,PASS_MYSQL);			
			$my_SelectedDB = mysql_select_db(DB_MYSQL);
			return $my_connection;
		}
	//FUNCETIONES DE MYSQL
	
	//FUNCETIONES DE MSSQL esta coneccion es a la base de datos de cyberlux
		
		function ms_conect(){
			$ms_connection = mssql_connect(SERVER,USER,PASS);
			$ms_SelectedDB = mssql_select_db(DB_CYBERLUX);
			return $ms_connection;
		}
		
		function ms_conect_transporte(){
			$ms_connection = mssql_connect(SERVER,USER,PASS);
			$ms_SelectedDB = mssql_select_db(DB);
			return $ms_connection;
		}
	//FUNCETIONES DE MSSQL
	
//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES


//FUNCIONES NETAS DE CONSULTAS DE LAS BASES DE DATOS

}

?>