<?php 
class class_control_salida_detalle {
/*

TABLA control_salida_detalle
CAMPOS id,id_control_salida,id_factura,monto_factura,cliente,liq_amarilla,liq_azul,liq_blanca,fecha_liquidacion_factura

id							identificador de la factura de un control
id_control_salida			identifica el control al q pertenece
id_factura					numero de factura de profit
monto_factura				monto de esta factura
cliente						cliente al q pertenece
liq_amarilla				
liq_azul
liq_blanca
fecha_liquidacion_factura	fecha en q se liquida
status						esta determina si esta anulada o no esta facrura 1 si esta activa , 2 anulada,	3	liquidada,	4	enviada,	5	recivida.
tipo						determina si es 1 factura de compras ordinarias, 2 traslados de mercancia, 3 notas de entrega



*/

		//BUSCAMOS LD DATOS NECESARIOS PA RA LA WEB id_control_salida_detalle,id_factura,monto_factura,cliente,monto_facturas,co_ven,id_control_salida,ven_des,co_cli top(20) 
			function get_con_det_web($id_control_salida){
		$sQuery="SELECT id,id_factura,monto_factura,cliente,monto_factura,co_ven,id_control_salida,ven_des,co_cli,CONVERT(VARCHAR, fec_emis, 120) AS fec_emis
				
				FROM control_salida_detalle
				
				WHERE status_web='1' AND status<>'2'  ";
		if($id_control_salida) {	$sQuery.=" AND  id_control_salida IN ($id_control_salida) ";	}
		$sQuery.=" ORDER BY id ";		
		
		
	//echo $sQuery;
		
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


		//datos de las facturas por sucursal para el envio de las mismas de vuelta a acyberlux para su posterior reenvio al bvendedor
	function get_fac_suc_env($id_sucursal='',$fecha=''){
		$sQuery="SELECT 
				control_salida_detalle.*,
				control_salida.id as guia_id,control_salida.id_sucursal as guia_id_sucursal, control_salida.id_por_sucursal  as guia_id_por_sucursal,
				 control_salida.tipo   as guia_tipo 
				FROM control_salida_detalle
				Inner Join control_salida ON control_salida_detalle.id_control_salida=control_salida.id
				WHERE 1=1 
				AND control_salida_detalle.tipo= '1'  
				AND control_salida_detalle.status= '3'  
				AND control_salida.id_sucursal= '$id_sucursal'  
				AND control_salida.fecha<= '$fecha' 
				"
				;
		$sQuery.=" ORDER BY control_salida.id_por_sucursal DESC ";
	//	echo $sQuery;
		
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
	
	//devuelve string con las facturas de la guia
	function get_control_salida_string($id_control_salida=''){
		$sQuery="SELECT id_factura FROM control_salida_detalle WHERE 1 = 1";
		if($id_control_salida) {	$sQuery.=" AND id_control_salida = '$id_control_salida' ";	}
		
		$sQuery.=" ORDER BY id DESC ";
	//	die($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		 for($i=0;$i<sizeof($res_array);$i++)
			{
				$fact.=$res_array[$i]['id_factura'].', ';
			}
		return($fact);
			
	}
        
        function obtener_facturas_hoover($id_control_salida=''){
           		$sQuery="SELECT cliente FROM control_salida_detalle WHERE 1 = 1";
		if($id_control_salida) {	$sQuery.=" AND id_control_salida = '$id_control_salida' ";	}
		
		$sQuery.=" ORDER BY id DESC ";
	//	die($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
                                    $row=mssql_fetch_array($result);    
                                    return $row['cliente'];
        }
        
        function monto_factura($factura){
            $consulta="select * from facturas where factura='".$factura."'";
            $result=  mssql_query($consulta);
           // return $consulta;
            if ($result){
                $dat=  mssql_fetch_array($result);
                return $dat['monto_fac'];
            }else{
                return "00";
            }
        }
	
	//devuelve string con las facturas de la guia
	function get_control_salida_string_xls($id_control_salida=''){
		$sQuery="SELECT id_factura,status,cliente FROM control_salida_detalle WHERE 1 = 1";
		if($id_control_salida) {	$sQuery.=" AND id_control_salida = '$id_control_salida' ";	}
		
		$sQuery.=" ORDER BY id DESC ";
	//	die($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		 for($i=0;$i<sizeof($res_array);$i++)
			{
				$fact.=$res_array[$i]['id_factura'];
					if($res_array[$i]['status']==1) { $nombre_status="Activo"; }	
					if($res_array[$i]['status']==2) { $nombre_status="Anulado"; }
					if($res_array[$i]['status']==3) {  $nombre_status="Liquidado"; }
				$fact.=', '.$nombre_status;
				$fact.=', '.$res_array[$i]['cliente'].'<br>';
				 		  
			}
		return($fact);
			
	}
	
	
	function get_control_salida_detalle($id_control_salida='',$status='',$id_factura='',$tipo='',$get_fact=''){
		$sQuery="SELECT * FROM control_salida_detalle WHERE 1 = 1";
		if($id_control_salida) {	$sQuery.=" AND id_control_salida = '$id_control_salida' ";	}
		if($status)	{ $sQuery.=" AND status = '$status' ";	}
		if($get_fact)	{ $sQuery.=" AND status <> '$get_fact' ";	}
		if($id_factura)	{ $sQuery.=" AND id_factura = '$id_factura' ";	}
		if($tipo)	{ $sQuery.=" AND tipo = '$tipo' ";	}
		$sQuery.=" ORDER BY id DESC ";
	//	die($sQuery);
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
	
	
	function get_control_salida_detalle_id($id_control_salida='',$status='',$id_factura='',$tipo='',$get_fact=''){
		$sQuery="SELECT id FROM control_salida_detalle WHERE 1 = 1";
		if($id_control_salida) {	$sQuery.=" AND id_control_salida = '$id_control_salida' ";	}
		if($status)	{ $sQuery.=" AND status = '$status' ";	}
		if($get_fact)	{ $sQuery.=" AND status <> '$get_fact' ";	}
		if($id_factura)	{ $sQuery.=" AND id_factura = '$id_factura' ";	}
		if($tipo)	{ $sQuery.=" AND tipo = '$tipo' ";	}
		$sQuery.=" ORDER BY id DESC ";
	//	die($sQuery);
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
	
	//buscamos cuantas guias hay en status 1 solamente
	function get_con_sal_det($status_web,$no_status_web,$id_control_salida){
		$sQuery="SELECT COUNT(id) AS cuantos FROM control_salida_detalle WHERE id_control_salida = '$id_control_salida' ";	
		if($status_web)	{ $sQuery.=" AND status_web = '$status_web' ";	}
		if($no_status_web)	{ $sQuery.=" AND status_web <> '$no_status_web' ";	}
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$row=mssql_fetch_array($result);
		return($row['cuantos']);
			
	}
	
	
	function add_control_salida_detalle($id_control_salida='',$id_factura='',$monto_factura='',$cliente='',$liq_amarilla='',$liq_azul='',$liq_blanca='',$fecha_liquidacion_factura='',$tipo='',$co_ven='',$ven_des='',$co_cli='',$status_web='',$fec_emis='')
	{
		
		$query = "INSERT INTO control_salida_detalle
		(id_control_salida,id_factura,monto_factura,cliente,liq_amarilla,liq_azul,liq_blanca,fecha_liquidacion_factura,status,tipo,co_ven,ven_des,co_cli,status_web,fec_emis) 
		VALUES ('$id_control_salida','$id_factura','$monto_factura','$cliente','$liq_amarilla','$liq_azul','$liq_blanca','$fecha_liquidacion_factura',1,1,'$co_ven','$ven_des','$co_cli','$status_web','$fec_emis')";
		
		//echo ($query);		  
	
		$result=mssql_query($query);
		$val_id_control_detalle=$this->get_control_salida_detalle_id($id_control_salida,1,$id_factura,$tipo);
		
		return $val_id_control_detalle[0]['id'];
	}
	
	function anular_control_salida_detalle($id_control_salida)
	{
		$query = "UPDATE control_salida_detalle SET status='2' 
				  WHERE  id_control_salida = '$id_control_salida'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function liquidar_factura($id='',$liq_amarilla='',$liq_azul='',$liq_blanca='',$status='')
	{
		$query = "UPDATE control_salida_detalle SET liq_amarilla='$liq_amarilla', liq_azul='$liq_azul', liq_blanca='$liq_blanca', status='$status' 
				  WHERE  id = '$id'";
	//	die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	
	function change_status_control_salida_detalle($id,$status)
	{
		$query = "UPDATE control_salida_detalle SET status='$status' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	//startus web actualizacon
	function change_status_control_salida_detalle_web($id,$status_web)
	{
		$query = "UPDATE control_salida_detalle SET status_web='$status_web' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}

	

	
}
?>
