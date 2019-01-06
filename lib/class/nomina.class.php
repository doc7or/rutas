<?php 
class class_nomina {
/*

TABLA nomina
CAMPOS 

id					identificador del control
id_por_sucursal		identificador del control para una sucursal enenpecifico
id_sucursal			identificador de la sucursal


*/


	function get_nomina($id='',$id_por_sucursal='',$id_sucursal=''){
		$sQuery="SELECT * FROM nomina WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_por_sucursal) {	$sQuery.="AND id_por_sucursal = '$id_por_sucursal' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id DESC ";
		//echo $sQuery;
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
	
	
	
	//PARA EL FORMATO DE REPORTE DE GUIAS
	function get_nomina_list_2($id='',$id_sucursal=''){
		$sQuery="SELECT * FROM nomina WHERE 1 = 1 ";
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
	
	function get_nomina_id_sucursal($id_sucursal=''){
		$sQuery="SELECT * FROM nomina WHERE 1 = 1";
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id DESC ";
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
			$new_id_por_sucursal=$res_array[0]['id_por_sucursal'];
			$new_id_por_sucursal++;
		}
		else
		{	
		
			$new_id_por_sucursal=1;
		}
		
		return($new_id_por_sucursal);
			
	}
	
	
	
	function add_nomina($id_por_sucursal='',$id_sucursal='',$fecha='',$fecha_hasta='')
	{
		$val_id_control=$this->get_nomina('',$id_por_sucursal,$id_sucursal);
		if($val_id_control){	$id_por_sucursal++;		}//si alguien registro antes el mismo id se crea uno nuevo
		
		$query = "INSERT INTO nomina (id_por_sucursal,id_sucursal,fecha,fecha_hasta) 
		VALUES ('$id_por_sucursal','$id_sucursal','$fecha','$fecha_hasta')";
		
		//,fecha_salida,'$fecha_salida'
	//die($query);		  
		$result=mssql_query($query);
		$val_id_control=$this->get_nomina('',$id_por_sucursal,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		//$edit_control=$this->update_nomina_fech_salida($new_id,$fecha_salida);
		return($new_id);
	}
	
	function update_nomina_fech_salida($id,$fecha_salida)
	{
		$query = "UPDATE nomina SET fecha_salida='$fecha_salida' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function update_nomina($id,$observaciones_post)
	{
		$query = "UPDATE nomina SET observaciones_post='$observaciones_post'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	function anular_nomina($id)
	{
		$query = "UPDATE nomina SET status='2' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	function change_status_nomina($id='',$status='')
	{
		$query = "UPDATE nomina SET status='$status' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	

	
}
?>
