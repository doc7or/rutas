<?php
/*
	ARCHIVO INTROMISIVO DE CONTROLES DE SALIDA
	VERSION 1.0
	ROBERTH NAVARRO
	04062009
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
	//MSSQL SERVER LOCAL
		define("USER_MSSQL_LOCAL","sa");//define("USER","sa");
		define("PASS_MSSQL_LOCAL","123456");//define("PASS","123456");
		define("SERVER_MSSQL_LOCAL","127.0.0.1");
		define("DB_MSSQL_LOCAL","CYBERLUX");

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
		
//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES


//FUNCIONES NETAS DE CONSULTAS DE LAS BASES DE DATOS

//FUNCION QUE BUSCA LOS PEDIDOS TEMPORALES QUE HAY PARA SUBIR AL PROFIT
function get_tpedidos($fact_num='',$co_ven=''){
		$conect=my_conect_remote();		
		$sQuery="SELECT * FROM tpedidos WHERE  1=1 ";
		if($fact_num) {	$sQuery.=" AND fact_num = '$fact_num' ";	}
		if($co_ven) {	$sQuery.=" AND co_ven = '$co_ven' ";	}
		
	//	echo($sQuery);
		$result=mysql_query($sQuery) or die(mysql_error());
		$i=0;
		while($row=mysql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
}

//FUNCION QUE BUSCA LOS RENG_TEMP TEMPORALES QUE HAY PARA SUBIR AL PROFIT
function get_treng_pedidos($fact_num='',$co_ven=''){
		$conect=my_conect_remote();		
		$sQuery="SELECT * FROM treng_ped WHERE  1=1 ";
		if($fact_num) {	$sQuery.=" AND fact_num = '$fact_num' ";	}
		if($co_ven) {	$sQuery.=" AND co_ven = '$co_ven' ";	}
		$sQuery.=" ORDER BY reng_num ";
	//	echo($sQuery);
		$result=mysql_query($sQuery) or die(mysql_error());
		$i=0;
		while($row=mysql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
}

//FUNCION QUE EDITA ESTE PEDIDO PARA QUE TENGA EL ID DE PROFIT
function update_pedidos_profit($fact_num_profit,$fact_num)
	{	$conect=my_conect_remote();		
		$query = "UPDATE pedidos SET fact_num_profit='$fact_num_profit' 
				  WHERE  fact_num = '$fact_num'";
		//die($query);
		$result=mysql_query($query)  or die(mysql_error());
		return $result;
	}


//FUNCION QUE ELIMUNA EL TPEDIDO SEGUN SU FACTURA
function del_tpedidos($fact_num=''){
		$conect=my_conect_remote();		
		$query = "DELETE FROM  tpedidos WHERE fact_num = '$fact_num'"; 
		$result=mysql_query($query);
				
}

//FUNCION QUE ELIMUNA EL TPEDIDO RENGLONES SEGUN SU FACTURA
function del_treng_pedidos($fact_num=''){
		$conect=my_conect_remote();		
		$query = "DELETE FROM  treng_ped WHERE fact_num = '$fact_num'"; 
		$result=mysql_query($query);
				
}

//FUNCION DE INSERCION DE LOS TPEDIDOS EN LA TABLA DE PEDISDOS PROPIAMENTE DICHA DE EL PROFIT
function add_pedidos_profit($fact_num,$contrib,$status,$comentario,$descrip,$saldo,$fec_emis,$fec_venc,$co_cli,$co_ven,$co_tran,$forma_pag,$tot_bruto,$tot_neto,$iva,$moneda,$campo5,$co_sucu,$tasag,$impresa){
		$conect=ms_conect_remote();	
		$query = "INSERT 
				 INTO pedidos (fact_num,contrib,status,comentario,descrip,saldo,fec_emis,fec_venc,co_cli,co_ven,co_tran,forma_pag,tot_bruto,tot_neto,iva,moneda,campo5,co_sucu,tasag,impresa) 
				  VALUES ('$fact_num','$contrib','$status','$comentario','$descrip','$saldo','$fec_emis','$fec_venc','$co_cli','$co_ven','$co_tran','$forma_pag','$tot_bruto','$tot_neto','$iva','$moneda','$campo5','$co_sucu','$tasag','$impresa')";
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	
			
	}
	
//FUNCION DE INSERCION DE LOS TRENG_PED EN LA TABLA DE RENG_PED PROPIAMENTE DICHA DE EL PROFIT
function add_reng_ped_profit($fact_num,$reng_num,$co_art,$co_alma,$total_art,$uni_venta,$prec_vta,$porc_desc,$tipo_imp,$reng_neto,$pendiente,$prec_vta2,$fec_lote){
		$conect=ms_conect_remote();	
		$query = "INSERT 
				 INTO reng_ped (fact_num,reng_num,co_art,co_alma,total_art,uni_venta,prec_vta,porc_desc,tipo_imp,reng_neto,pendiente,prec_vta2,fec_lote) 
				  VALUES ('$fact_num','$reng_num','$co_art','$co_alma','$total_art','$uni_venta','$prec_vta','$porc_desc','$tipo_imp','$reng_neto','$pendiente','$prec_vta2','$fec_lote')";
	//	echo ($query);
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	
			
	}


//FUNCTIN DE BUSQUEDA DE LOS PEDIDOS PARA SABER CUAL ES EL ULTIMO PEDIDO QUE SE A BAJADO
function get_pedidos_profit($co_sucu){
		$conect=ms_conect_remote();
		
		$sQuery="SELECT TOP(1) fact_num FROM pedidos WHERE co_sucu='$co_sucu' ";
		if($co_sucu=='01'){ $sQuery.="	AND fact_num < 3195177	"; }//CON ESTO EVITAMOS LOS PEDIDOS BASURA Q AY ACTUALMENTE EN LA BD DE PROFIT
		$sQuery.=" ORDER BY fact_num DESC ";
//	echo $sQuery;
		//die();
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
$conect_my_remote=my_conect_remote();
$conect_ms_remote=ms_conect_remote();

//pregutamos si se dan las conecciones
if($conect_my_remote && $conect_ms_remote){

	//obtengo los registros de los tpedidos
	$arr_tpedidos=get_tpedidos();
	//recorremos estos tedidos sizeof($arr_tpedidos)
	for($i=0;$i<sizeof($arr_tpedidos);$i++){
		$ultimo_fact_num=get_pedidos_profit($arr_tpedidos[$i]['co_sucu']);
		//obtengo el id del  nuevo pedido
		$new_fact_num=$ultimo_fact_num[0]['fact_num']+1;
		//insertamos el nuevo pedido en la base de datos add_pedidos_profit($fact_num,$contrib,$status,$comentario,$descrip,$saldo,$fec_emis,$fec_venc,$co_cli,$co_ven,$co_tran,$forma_pag,$tot_bruto,$tot_neto,$iva,$moneda,$campo5,$co_sucu,$tasag)
		//cargamos algunos datos en variables necesarios
		$descrip='Nro.Web: '.$arr_tpedidos[$i]['fact_num'].' ***NETO**** ';
		if($arr_tpedidos[$i]['tot_bruto']>$arr_tpedidos[$i]['tot_neto'])	$saldo=$arr_tpedidos[$i]['tot_bruto']; else	$saldo=$arr_tpedidos[$i]['tot_neto'];  
		//INSERCION
		$new_pedido=add_pedidos_profit($new_fact_num,true,'0',$arr_tpedidos[$i]['descrip'],$descrip,$saldo,$arr_tpedidos[$i]['fec_emis'],$arr_tpedidos[$i]['fec_emis'],$arr_tpedidos[$i]['co_cli'],$arr_tpedidos[$i]['co_ven'],'000',30,$arr_tpedidos[$i]['tot_bruto'],$arr_tpedidos[$i]['tot_neto'],$arr_tpedidos[$i]['iva'],'BSF','WEB',$arr_tpedidos[$i]['co_sucu'],9,false);
		//busca los renglones de este pedido e treng_ped
		$arr_treng_pedidos=get_treng_pedidos($arr_tpedidos[$i]['fact_num']);
		for($j=0;$j<sizeof($arr_treng_pedidos);$j++){
			//adicionamos cada renglon de este pedido add_reng_ped_profit($fact_num,$reng_num,$co_art,$co_alma,$total_art,$uni_venta,$prec_vta,$porc_desc,$tipo_imp,$reng_neto,$pendiente,$prec_vta2,$fec_lote)
			if($arr_tpedidos[$i]['co_sucu']=='01' || $arr_tpedidos[$i]['co_sucu']=='02') $tipo_imp='1';	else $tipo_imp='6';
		  $new_reng_ped=add_reng_ped_profit($new_fact_num,$arr_treng_pedidos[$j]['reng_num'],$arr_treng_pedidos[$j]['co_art'],$arr_treng_pedidos[$j]['co_alma'],$arr_treng_pedidos[$j]['total_art'],'UNI',$arr_treng_pedidos[$j]['prec_vta'],$arr_treng_pedidos[$j]['porc_desc'],$tipo_imp,$arr_treng_pedidos[$j]['reng_neto'],$arr_treng_pedidos[$j]['total_art'],$arr_treng_pedidos[$j]['prec_vta'],$arr_tpedidos[$i]['fec_emis']);
		}
		//eliminamos el pedido del_tpedidos($fact_num='') del_treng_pedidos($fact_num='')
		
		$delete_tpedidos=del_tpedidos($arr_tpedidos[$i]['fact_num']);
		$delete_treng_ped=del_treng_pedidos($arr_tpedidos[$i]['fact_num']);
		
		//EDITAREMOS LOS PEDIDOS CON EL NUMERO DE PROFIT Q HEMOS OBTENIDO DE LA INSERCION
		
		
		echo 'Se a bajado con exito pedido: '.$arr_tpedidos[$i]['fact_num'].'<br>';
		
		//sera bueno par ael futuro saber a donde fue a parar este pedido en el profit por ahora no se hace necesario SE APROVO
		$udp_pedido_profit=update_pedidos_profit($new_fact_num,$arr_tpedidos[$i]['fact_num']);
		
	}

	echo 'cotizaiones bajadas'.$i;

}else{
	echo 'Por favor intente de nuevo la conexion a fallado';
}



//SECCION DE ALGORITMOS FINALES

?>




