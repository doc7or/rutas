<?php 
class class_vehiculo_tipo {

/*
TABLA vehiculo_tipo
CAMPOS 	
id					identificador unico
descripcion			abreviatura del tipo de vehiculo
detalle				nombre largo
caleta				caleta
metraje_min			minimoen metros cubicos
metraje_max			maximo en metros cubicos
tipo_item			tipo de item, si es vechiculo o escolta hasta la fecha soo esos dos tipos de item hay
status				status del tipo de vehiculo si etsa eliminado ono
*/


	function get_list_vehiculo_tipo($id='',$status=''){
		$sQuery="SELECT
					*
					FROM
					vehiculo_tipo
					WHERE tipo_item = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($status) {	$sQuery.=" AND status in($status) ";}
		$sQuery.="ORDER BY
					 descripcion  ASC ";

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
	
		function get_vehiculo_tipo($id='',$descripcion='',$detalle='',$caleta='',$metraje_min='',$metraje_max='',$status=''){
		$sQuery="SELECT * FROM vehiculo_tipo WHERE tipo_item = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($descripcion) {	$sQuery.="AND descripcion = '$descripcion' ";	}
		if($detalle) {	$sQuery.="AND detalle = '$detalle' ";	}
		if($caleta) {	$sQuery.="AND caleta = '$caleta' ";	}
		if($metraje_min) {	$sQuery.="AND metraje_min = '$metraje_min' ";	}
		if($metraje_max) {	$sQuery.="AND metraje_max = '$metraje_max' ";	}
		if($status) {	$sQuery.="AND vehiculo.status in($status) ";}
		
		
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
	
	function get_item($id=''){
		$sQuery="SELECT * FROM vehiculo_tipo WHERE status = '1' ORDER BY orden";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		
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
	
	
	function add_vehiculo_tipo($descripcion='',$detalle='',$caleta='',$metraje_min='',$metraje_max='',$tipo_item='')
	{
		$query = "INSERT INTO vehiculo_tipo (descripcion, detalle,caleta, metraje_min, metraje_max,tipo_item) 
				  VALUES ('$descripcion', '$detalle','$caleta', '$metraje_min', '$metraje_max','$tipo_item')";
		$result=mssql_query($query);
		$val_id_control=$this->get_vehiculo_tipo('',$descripcion,$detalle,$caleta,$metraje_min,$metraje_max);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
	}
	
	

	function update_vehiculo_tipo($id,$descripcion, $detalle,$caleta,$metraje_min, $metraje_max )
	{
		$query = "UPDATE vehiculo_tipo SET descripcion='$descripcion', detalle='$detalle' , caleta='$caleta' ,metraje_min='$metraje_min', metraje_max='$metraje_max' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function delete_def_vehiculo_tipo($id)
	{
		$query = "DELETE FROM  vehiculo_tipo WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
	function delete_vehiculo_tipo($id)
	{
		$query = "UPDATE vehiculo_tipo set status=0 WHERE id = '$id'";
	
		$result=mssql_query($query);
	}
	
}
?>
