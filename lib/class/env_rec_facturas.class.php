<?php 
class class_env_rec_facturas {
/*

TABLA env_rec_facturas
CAMPOS 

id					identificador del control
id_por_sucursal		identificador del control para una sucursal enenpecifico
id_sucursal			identificador de la sucursal
fecha				fecha de realizacion
fecha_hasta			fecha hasta la cual va el envio


*/


	function get_env_rec_facturas($id='',$id_por_sucursal='',$id_sucursal=''){
		$sQuery="SELECT * FROM env_rec_facturas WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_por_sucursal) {	$sQuery.="AND id_por_sucursal = '$id_por_sucursal' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		
		//echo ($sQuery);
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
	
	
	
	//PARA EL FORMATO DE REPORTE DE GUIAS
	function get_env_rec_facturas_list_2($id='',$id_sucursal=''){
		$sQuery="SELECT * FROM env_rec_facturas WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.="ORDER BY id_por_sucursal DESC ";
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
	
	function get_env_rec_facturas_id_sucursal($id_sucursal=''){
		$sQuery="SELECT * FROM env_rec_facturas WHERE 1 = 1";
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id DESC ";
		//echo $sQuery;
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		
		if($res_array[0]['id_por_sucursal'])	
		{	
			//echo ('entra aqui');
			$new_id_por_sucursal=$res_array[0]['id_por_sucursal'];
			$new_id_por_sucursal++;
		}
		else
		{	
			//echo ('entra aqui cero');
			$new_id_por_sucursal=1;
		}
		
	
		return($new_id_por_sucursal);
			
	}
	
	
	
	function add_env_rec_facturas($id_por_sucursal='',$id_sucursal='',$fecha='',$fecha_hasta='')
	{
		$val_id_control=$this->get_env_rec_facturas('',$id_por_sucursal,$id_sucursal);
		if($val_id_control){	$id_por_sucursal++;		}//si alguien registro antes el mismo id se crea uno nuevo
		
		$query = "INSERT INTO env_rec_facturas (id_por_sucursal,id_sucursal,fecha,fecha_hasta) 
		VALUES ('$id_por_sucursal','$id_sucursal','$fecha','$fecha_hasta')";
		
		//,fecha_salida,'$fecha_salida'
	//echo ($query);		  
	//die();
		$result=mssql_query($query);
		$val_id_control=$this->get_env_rec_facturas('',$id_por_sucursal,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		//$edit_control=$this->update_env_rec_facturas_fech_salida($new_id,$fecha_salida);
		return($new_id);
	}
	
	function update_env_rec_facturas_fech_salida($id,$fecha_salida)
	{
		$query = "UPDATE env_rec_facturas SET fecha_salida='$fecha_salida' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function update_env_rec_facturas($id,$observaciones_post)
	{
		$query = "UPDATE env_rec_facturas SET observaciones_post='$observaciones_post'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	function anular_env_rec_facturas($id)
	{
		$query = "UPDATE env_rec_facturas SET status='2' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	function change_status_env_rec_facturas($id='',$status='')
	{
		$query = "UPDATE env_rec_facturas SET status='$status' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	

	
}
?>
