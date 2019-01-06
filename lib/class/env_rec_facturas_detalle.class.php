<?php 
class class_env_rec_facturas_detalle {
/*

TABLA env_rec_facturas_detalle
CAMPOS id,id_env_rec_facturas,id_factura,monto_factura,cliente,liq_amarilla,liq_azul,liq_blanca,fecha_liquidacion_factura

id							identificador de la factura de un control
id_env_rec_facturas					identifica el control al q pertenece
id_factura						identificador de la guia




*/



	
	function get_env_rec_facturas_detalle($id_env_rec_facturas='',$id_factura=''){
		$sQuery="SELECT * FROM env_rec_facturas_detalle WHERE 1 = 1";
		if($id_env_rec_facturas) {	$sQuery.=" AND id_env_rec_facturas = '$id_env_rec_facturas' ";	}
		
		
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
	
	
	
	function add_env_rec_facturas_detalle($id_env_rec_facturas='',$id_factura='')
	{
		
		$query = "INSERT INTO env_rec_facturas_detalle (id_env_rec_facturas,id_factura) 
		VALUES ('$id_env_rec_facturas','$id_factura')";
		
		
	echo($query);		  
		$result=mssql_query($query);
		
		return $result;
	}
	
	function anular_env_rec_facturas_detalle($id_env_rec_facturas)
	{
		$query = "UPDATE env_rec_facturas_detalle SET status='2' 
				  WHERE  id_env_rec_facturas = '$id_env_rec_facturas'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function liquidar_factura($id='',$liq_amarilla='',$liq_azul='',$liq_blanca='',$status='')
	{
		$query = "UPDATE env_rec_facturas_detalle SET liq_amarilla='$liq_amarilla', liq_azul='$liq_azul', liq_blanca='$liq_blanca', status='$status' 
				  WHERE  id = '$id'";
	//	die($query);
		$result=mssql_query($query);
		return $result;
	}
	

	

	
}
?>
