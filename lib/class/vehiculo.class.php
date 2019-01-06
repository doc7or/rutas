<?php 
class class_vehiculo{

/*

TABLA vehiculo
CAMPOS 	
id					identificador de el ceheciculo identificador unico
placa				placa del vehiculo
marca				marca del vehicuo
id_tipo				tipo de vehiculo al q pertencece este 
observacion			cualquier detalle del vehidulo asi como cuando sea auditado el 
					auditor podra activar o no el vehiculo
id_empresa			empresa a la q pertenece este vehiculo
status 				0 eliminado 1 autorizado 2 no autorizado	3 en uso
id_sucursal			indentificador de la sucursal a la que este inscrito el vehiculo

*/


	function get_list_vehiculo($placa='',$id_tipo='',$id_empresa='',$status='',$id_sucursal='',$id=''){
		$sQuery="SELECT
					vehiculo.*,
					vehiculo_tipo.descripcion AS tipo,vehiculo_tipo.metraje_min,vehiculo_tipo.metraje_max, vehiculo_tipo.detalle,
					empresa.descripcion AS empresa
					FROM
					vehiculo
					Inner Join vehiculo_tipo ON vehiculo.id_tipo = vehiculo_tipo.id
					Inner Join empresa ON vehiculo.id_empresa = empresa.id
				WHERE 1 = 1 ";
		if($placa) {	$sQuery.="AND vehiculo.placa = '$placa' ";	}
		if($id_tipo) {	$sQuery.="AND vehiculo.id_tipo = '$id_tipo' ";}
		if($id_empresa) {	$sQuery.="AND vehiculo.id_empresa = '$id_empresa' ";}
		if($status) {	$sQuery.="AND vehiculo.status in($status) ";}
		if($id_sucursal) {	$sQuery.="AND vehiculo.id_sucursal = '$id_sucursal' ";}
		if($id) {	$sQuery.="AND vehiculo.id = '$id' ";}
		$sQuery.="ORDER BY
					vehiculo.placa  ASC ";


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
	
	function get_list_vehiculo_inc($placa='',$id_tipo='',$id_empresa='',$status='',$id_sucursal='',$id=''){
		$sQuery="SELECT
					vehiculo.*,
					vehiculo_tipo.descripcion AS tipo,vehiculo_tipo.metraje_min,vehiculo_tipo.metraje_max, vehiculo_tipo.detalle,
					empresa.descripcion AS empresa,
					sucursal.descripcion	AS sucursal
					
					FROM
					vehiculo
					Inner Join vehiculo_tipo ON vehiculo.id_tipo = vehiculo_tipo.id
					Inner Join empresa ON vehiculo.id_empresa = empresa.id
					Inner Join sucursal ON vehiculo.id_sucursal = sucursal.id
				WHERE 1 = 1 ";
		if($placa) {	$sQuery.="AND vehiculo.placa = '$placa' ";	}
		if($id_tipo) {	$sQuery.="AND vehiculo.id_tipo = '$id_tipo' ";}
		if($id_empresa) {	$sQuery.="AND vehiculo.id_empresa = '$id_empresa' ";}
		if($status) {	$sQuery.="AND vehiculo.status in($status) ";}
		if($id_sucursal) {	$sQuery.="AND vehiculo.id_sucursal = '$id_sucursal' ";}
		if($id) {	$sQuery.="AND vehiculo.id = '$id' ";}
		$sQuery.="ORDER BY
					vehiculo.placa, vehiculo_tipo.descripcion  ASC ";


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
	
	function get_pool_vehiculo($placa='',$id_tipo='',$id_empresa='',$status='',$id_sucursal='',$id=''){
		$sQuery="SELECT
					vehiculo.*,
					vehiculo_tipo.descripcion AS tipo,vehiculo_tipo.metraje_min,vehiculo_tipo.metraje_max, vehiculo_tipo.detalle
					
					FROM
					vehiculo
					Inner Join vehiculo_tipo ON vehiculo.id_tipo = vehiculo_tipo.id
					
				WHERE 1 = 1 ";
		if($placa) {	$sQuery.="AND vehiculo.placa = '$placa' ";	}
		if($id_tipo) {	$sQuery.="AND vehiculo.id_tipo = '$id_tipo' ";}
		if($id_empresa) {	$sQuery.="AND vehiculo.id_empresa = '$id_empresa' ";}
		if($status) {	$sQuery.="AND vehiculo.status in($status) ";}
		if($id_sucursal) {	$sQuery.="AND vehiculo.id_sucursal = '$id_sucursal' ";}// se comento por solicitud de diolennis para q punto fijo pudiera ver los camiones tipo NPR,tambien se comento en la clase de transportistas para q saliera el transportista por camion y se coloco tipo 2 en la tabla sucursales de rutas, y la tabla tabulador costo se modifico get_tabulador_costo quitando la sucursal para q punto fijo tomara todos los costos del tabulaldor
		if($id) {	$sQuery.="AND vehiculo.id = '$id' ";}
		$sQuery.="ORDER BY
					vehiculo.placa  ASC ";


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
	
	function get_vehiculo($placa='',$id_tipo='',$id_empresa='',$status='',$id_sucursal='',$id=''){
		$sQuery="SELECT * FROM vehiculo WHERE 1 = 1 ";
		if($placa) {	$sQuery.="AND placa = '$placa' ";	}
		if($id_tipo) {	$sQuery.="AND id_tipo = '$id_tipo' ";}
		if($id_empresa) {	$sQuery.="AND id_empresa = '$id_empresa' ";}
		if($status) {	$sQuery.="AND status = '$status' ";}
		if($id_sucursal) {	$sQuery.="AND vehiculo.id_sucursal = '$id_sucursal' ";}
		if($id) {	$sQuery.="AND vehiculo.id = '$id' ";}
		//echo $sQuery;
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
	
	function get_vehiculo_placa($id=''){
		$sQuery="SELECT * FROM vehiculo WHERE 1 = 1 ";
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
	
	
	function add_vehiculo($placa='',$id_tipo='',$id_empresa='',$status='',$id_sucursal='',$observacion='',$marca='')
	{
		$query = "INSERT INTO vehiculo (placa,id_tipo,id_empresa,status,id_sucursal,observacion,marca) 
				  VALUES ('$placa','$id_tipo','$id_empresa','$status','$id_sucursal','$observacion','$marca')";
		//die($query);
		$result=mssql_query($query);
		$val_id_control=$this->get_vehiculo($placa,$id_tipo,$id_empresa,$status,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
	}
	
	
	function update_vehiculo($id='',$placa='',$id_tipo='',$id_empresa='',$status='',$observacion='',$marca='')
	{
		$query = "UPDATE vehiculo SET placa='$placa', id_tipo='$id_tipo', id_empresa='$id_empresa', status='$status', observacion='$observacion', marca='$marca' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	function update_medidas($id='',$alto='',$ancho='',$largo='')
	{
		$query = "UPDATE vehiculo SET ancho='$ancho', largo='$largo', alto='$alto' 
				  WHERE  id = '$id'";
		///die ($query);	
		$result=mssql_query($query);
		return $result;
	}
	
	function change_status_vehiculo($placa,$status)
	{
		$query = "UPDATE vehiculo set status='$status' WHERE placa = '$placa'";
	//	die ($query);
		$result=mssql_query($query);
		return $result;
	}
	
	function delete_vehiculo($id)
	{
		$query = "UPDATE vehiculo set status=0 WHERE id = '$id'";
	//	die ($query);
		$result=mssql_query($query);
		return $result;
	}
	
	function delete_def_vehiculo($placa)
	{
		$query = "DELETE FROM  vehiculo WHERE placa = '$placa'";
		$result=mssql_query($query);
	}
	
}
?>
