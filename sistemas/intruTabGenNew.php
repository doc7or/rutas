<?php
/*
	ARCHIVO INTROMISIVO DE TABULADORES
	VERSION 1.0
	ROBERTH NAVARRO
	03102009
*/

//VARIABLES MYSQL
	//VARIABLES MYSQL LOCAL
		define("USER_LOCAL","root");//MYSQL
		define("PASS_LOCAL","");//MYSQL	
		define("SERVER_LOCAL","127.0.0.1");//MYSQL
		define("DB_LOCAL","cyber");
	//MYSQL REMOTO
		define("USER_REMOTE","wakang");
		define("PASS_REMOTE","Runningdvd");
		define("SERVER_REMOTE","69.20.61.52");
		define("DB_REMOTE","cybernew");
//VARIABLES MSSQL
	//SQL SERVER 10.10.1.7
		define("USER","sa");//define("USER","sa");
		define("PASS","123456");//define("PASS","123456");
		//define("SERVER","10.10.1.7");
		//define("SERVER","200.71.190.46");
		define("SERVER","10.10.3.22");
		define("DB","transporte");
	//MSSQL SERVER LOCAL
		define("USER_MSSQL_LOCAL","sa");//define("USER","sa");
		define("PASS_MSSQL_LOCAL","123456");//define("PASS","123456");
		define("SERVER_MSSQL_LOCAL","127.0.0.1");
		define("DB_MSSQL_LOCAL","CYBERSYS");

//FUNCIONES VARIAS USO

//FUNCIONES DE LIMPIAR CARACTERES
function rehtmlspecialchars($arg){
	//$arg = str_replace("", "<", $arg);
	//$arg = str_replace(" ", "_", $arg);
	$arg = str_replace("/", "", $arg);
	$arg = str_replace("&", "", $arg);
	$arg = str_replace("'", "", $arg);
	$arg = str_replace("#", "", $arg);
	$arg = str_replace("(", "", $arg);
	$arg = str_replace(")", "", $arg);
	$arg = str_replace(".", "-", $arg);
	
	return $arg;
	}


//FUNCIONES VARIAS USO

//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES
//FUNCETIONES DE MYSQL
		function my_conect_local(){
			$my_connection = mysql_connect(SERVER_LOCAL,USER_LOCAL,PASS_LOCAL);
			
				$my_SelectedDB = mysql_select_db(DB_LOCAL);
			
			
			return $my_connection;
		}
		function my_conect_remote(){
			$my_connection = mysql_connect(SERVER_REMOTE,USER_REMOTE,PASS_REMOTE);
			
				$my_SelectedDB = mysql_select_db(DB_REMOTE);
		
			return $my_connection;
		}
	//FUNCETIONES DE MSSQL
		function ms_conect_local(){
			$ms_connection = mssql_connect(SERVER_MSSQL_LOCAL,USER_MSSQL_LOCAL,PASS_MSSQL_LOCAL);

				$ms_SelectedDB = mssql_select_db(DB_MSSQL_LOCAL);
						
			return $ms_connection;
		}
		function ms_conect_remote(){
			$ms_connection = mssql_connect(SERVER,USER,PASS);
			
				$ms_SelectedDB = mssql_select_db(DB);
						
			return $ms_connection;
		}
		
//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES


	
//FUNCION QUE BUSCA LOS ARTICULOS  WEB
function getTabApro($id_sucursal=''){
		$conect=ms_conect_remote();	
		$sQuery="SELECT * 
					FROM tabulador_costo_aprobatorio 
					WHERE id_sucursal='$id_sucursal' ORDER BY id ";	
		die($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
	}
	





//FUNCION QUE EDITA ESTE PEDIDO PARA QUE TENGA EL ID DE PROFIT
function updTabulador($id_sucursal='',$id_zona='',$costo='',$id_item='')
	{	$conect=ms_conect_remote();		
		$query = "UPDATE tabulador_costo SET costo=$costo 
				  WHERE  id_sucursal='$id_sucursal'  AND id_zona='$id_zona' AND id_item='$id_item' ";
		
		//die($query);
		$result=mssql_query($query) ;
		return $result;
	}
//identificacion de la sucursal
/*
1	hoover
2	planta
18	punto fijo
22  margarita


*/
$id_sucursal=2;
$arrTabApro=getTabApro($id_sucursal);
echo sizeof($arrTabApro);
for($i=0;$i<sizeof($arrTabApro);$i++){	
	$udp1=updTabulador($id_sucursal,$arrTabApro[$i]['id_zona'],$arrTabApro[$i]['costo'],$arrTabApro[$i]['id_item']);
	echo $arrTabApro[$i]['id'].'  --  '.$arrTabApro[$i]['costo'].'<br>';
}





?>







