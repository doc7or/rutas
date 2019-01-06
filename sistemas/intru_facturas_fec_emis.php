<?php
/*
	ARCHIVO INTROMISIVO DE FACTURAS 
	VERSION 1.0
	ROBERTH NAVARRO
	04062009
	COMMENT: ESTE ARCHIVO INTENTARA BUSCAR DE LA MANERA MAS OPTIMA Y RAPIDA A NIVEL DE ALGORITMO ENCONTRAR LAS POSIBLES REPETICIONES QUE ESXIAN EN DOS VECTORES DADOS
*/

//VARIABLES MYSQL
	//VARIABLES MYSQL LOCAL
		define("USER_LOCAL","root");//MYSQL
		define("PASS_LOCAL","");//MYSQL	
		define("SERVER_LOCAL","127.0.0.1");//MYSQL
		define("DB_LOCAL","cyber");
	//MYSQL REMOTO
		define("USER_REMOTE","wakang");
		define("PASS_REMOTE","325_UsEr_08");
		define("SERVER_REMOTE","69.20.61.52");
		define("DB_REMOTE","cybernew");
//VARIABLES MSSQL
	//SQL SERVER 10.10.1.7
		define("USER","sa");//define("USER","sa");
		define("PASS","123456");//define("PASS","123456");
		define("SERVER","10.10.1.7");
		define("DB","CYBERLUX");
		define("DB_TRANSPORTE","transporte");
	//MSSQL SERVER LOCAL
		define("USER_MSSQL_LOCAL","sa");//define("USER","sa");
		define("PASS_MSSQL_LOCAL","123456");//define("PASS","123456");
		define("SERVER_MSSQL_LOCAL","127.0.0.1");
		define("DB_MSSQL_LOCAL","CYBERLUX");
		define("DB_MSSQL_TRANSPORTE","transporte");


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
	$arg = str_replace(")", "-", $arg);
	$arg = str_replace(".", "", $arg);
	
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
		function ms_conect_remote_trans(){
			$ms_connection = mssql_connect(SERVER,USER,PASS);
			$ms_SelectedDB = mssql_select_db(DB_TRANSPORTE);
			return $ms_connection;
		}
		
//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES


//FUNCIONES NETAS DE CONSULTAS DE LAS BASES DE DATOS

//FUNCION QUE BUSCA LAS FACTURAS ANULADAS EN PROFIT
function get_facturas_web(){
		$conect=my_conect_remote();		
		$sQuery="SELECT id_factura FROM control_salida_detalle WHERE fec_emis<>'' "; 
		//echo($sQuery);
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

//FUNCION DE ACTRUALIZACION DE LA FACTURA WEB
function udp_facturas_web($id_factura,$fec_emis){
		$conect=my_conect_remote();		
		$sQuery="UPDATE control_salida_detalle SET fec_emis='$fec_emis' WHERE id_factura='$id_factura'  "; 
		//echo($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		return($result);
			
}

//FUNCION QUE BUSCA LAS FACTURAS TRANSPORTADAS TOP 1
function get_facturas($fact_num){
		$conect=ms_conect_remote();		
		$sQuery="SELECT fec_emis FROM factura WHERE  anulada=0 ";
		if($fact_num) {	$sQuery.=" AND fact_num = '$fact_num' ";	}
		$sQuery.=" ORDER BY fact_num ";
		//echo($sQuery);
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

//FUNCIONES NETAS DE CONSULTAS DE LAS BASES DE DATOS

//SECCION DE ALGORITMOS FINALES

//VALICACION DE CONECCIONES
$arr_facturas_web=get_facturas_web();
$cv=0;
for($i=0;$i<sizeof($arr_facturas_web);$i++){
	$arr_fecha=get_facturas($arr_facturas_web[$i]['id_factura']);
	if($arr_fecha){
		$arr_fec_emis[$cv]['fec_emis']=$arr_fecha[0]['fec_emis'];
		$arr_fec_emis[$cv]['id_factura']=$arr_fecha[$i]['id_factura'];
		$cv++;
	}
}

for($i=0;$i<sizeof($arr_fec_emis);$i++){
	if($arr_fec_emis[$i]['id_factura']){
	//	$udo_fact=get_facturas_web($arr_fec_emis[$i]['id_factura'],$arr_fec_emis[$i]['fec_emis']);
	}
}






//SECCION DE ALGORITMOS FINALES

?>
