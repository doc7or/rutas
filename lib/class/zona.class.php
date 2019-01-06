<?php 
class class_zona {

/*
TABLA zona
CAMPOS 	
id				identificador
descripcion		nombre de la zona
id_estado		identificador de estado
status			estatus activo o eliminado
*/


	function get_zona($id='',$descripcion='',$id_estado='',$status=''){
		$sQuery="SELECT * FROM zona WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($descripcion) {	$sQuery.="AND descripcion = '$descripcion' ";}
		if($id_estado){ $sQuery.="AND id_estado = '$id_estado' ";}
		if($status) {	$sQuery.=" AND status = '$status' ";}
		$sQuery.="ORDER BY descripcion ASC ";
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
	
	function get_list_zona($id='',$descripcion='',$id_estado='',$status=''){
		$sQuery="SELECT
					zona.*,
					estado.descripcion  AS estado
				FROM
					zona
					Inner Join estado ON zona.id_estado = estado.id
				WHERE
					status = '1'
				";
	   if($id) {	$sQuery.="AND zona.id = '$id' ";	}
	   if($status) {	$sQuery.=" AND zona.status in($status) ";}
	   if($descripcion) {	$sQuery.="AND zona.descripcion = '$descripcion' ";}
		if($id_estado){ $sQuery.="AND zona.id_estado = '$id_estado' ";}
	   $sQuery.="ORDER BY
					estado.descripcion ASC,
					zona.descripcion ASC ";
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
	
	function add_zona($descripcion,$id_estado)
	{
		$query = "INSERT INTO zona (descripcion,id_estado,status) 
				  VALUES ('$descripcion','$id_estado','1')";
		//die($query);		  
		$result=mssql_query($query);
		$val_id_control=$this->get_zona('',$descripcion,$id_estado);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
	}
	
	
	function update_zona($id,$descripcion,$id_estado)
	{
		$query = "UPDATE zona SET descripcion='$descripcion' , id_estado='$id_estado'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	

	function delete_zona($id)
	{
		$query = "UPDATE zona set status=0 WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
	function delete_def_zona($id)
	{
		$query = "DELETE FROM  zona WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
