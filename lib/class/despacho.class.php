<?php 
class class_sucursal {

/*
TABLA sucursal
CAMPOS 	id,descripcion,ciudad,direccion
*/


	function get_sucursal($id='',$descripcion=''){
		$sQuery="SELECT * FROM sucursal WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($descripcion) {	$sQuery.="AND descripcion = '$descripcion' ";}
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
	
	function get_list_sucursal($id=''){
		$sQuery="SELECT
				sucursal.id,sucursal.descripcion,sucursal.ciudad,sucursal.direccion,
				zona.descripcion AS zona
				FROM
				sucursal
				Inner Join zona ON sucursal.ciudad = zona.id
				WHERE
					1 = 1
				";
	   if($id) {	$sQuery.="AND sucursal.id = '$id' ";	}
	   $sQuery.="ORDER BY
					sucursal.descripcion ASC ";

		
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
	
	function add_sucursal($descripcion,$ciudad,$direccion)
	{
		$query = "INSERT INTO sucursal (descripcion,ciudad,direccion) 
				  VALUES ('$descripcion','$ciudad','$direccion')";
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	}
	
	
	function update_sucursal($id,$descripcion,$ciudad)
	{
		$query = "UPDATE sucursal SET descripcion='$descripcion', ciudad='$ciudad'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function delete_sucursal($id)
	{
		$query = "DELETE FROM  sucursal WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
