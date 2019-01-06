<?php 
class class_control_salida_status {
/*

TABLA control_salida_status
CAMPOS 
id					
descripcion
*/


	function get_control_salida_status($id=''){
		$sQuery="SELECT * FROM control_salida_status WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		//die($sQuery);
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
	
	
	function get_control_salida_status_id_sucursal($id_sucursal=''){
		$sQuery="SELECT * FROM control_salida_status WHERE 1 = 1";
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id DESC ";
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_row($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		
		if($res_array[0]['id_por_sucursal'])	
		{	
			$new_id_por_sucursal=$res_array[0]['id_por_sucursal'];
			$new_id_por_sucursal++;
		}
		else
		{	
		
			$new_id_por_sucursal=1;
		}
		
		return($new_id_por_sucursal);
			
	}
	
	
	
	function add_control_salida_status($id_por_sucursal='NULL',$id_sucursal='NULL',$id_transportista='NULL',$placa='NULL',$fecha='NULL',$fecha_salida='NULL',$status='NULL',$caleta='NULL',$caleta_especial='NULL',$monto='NULL',$ruta='NULL',$desvio='NULL',$devio_monto='NULL',$devolucion_monto='NULL',$adelanto='NULL',$observaciones='NULL',$id_escolta='NULL',$escolta_monto='NULL',$monto_facturas='NULL',$caja_caleta='NULL',$caja_adelanto='NULL')
	{
		
		$query = "INSERT INTO control_salida_status (id_por_sucursal,id_sucursal,id_transportista,placa,fecha,fecha_salida,status,caleta,caleta_especial,monto,ruta,desvio,devio_monto,devolucion_monto,adelanto,observaciones,id_escolta,escolta_monto,monto_facturas,caja_caleta,caja_adelanto) 
		VALUES ('$id_por_sucursal','$id_sucursal','$id_transportista','$placa','$fecha','$fecha_salida','$status','$caleta','$caleta_especial','$monto','$ruta','$desvio','$devio_monto','$devolucion_monto','$adelanto','$observaciones','$id_escolta','$escolta_monto','$monto_facturas','$caja_caleta','$caja_adelanto')";
		
		
		die($query);		  
		$result=mssql_query($query);
		
		return $new_pet_id;
	}
	
	
	function update_control_salida_status($id,$descripcion,$id_estado)
	{
		$query = "UPDATE control_salida_status SET descripcion='$descripcion' , id_estado='$id_estado'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	

	
}
?>
