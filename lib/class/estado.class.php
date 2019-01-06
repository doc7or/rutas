<?php 
class class_estado{

/*
TABLA estado
CAMPOS 	id,descripcion
*/


	function get_estado($id='',$descripcion=''){
		$sQuery="SELECT * FROM estado WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($descripcion) {	$sQuery.="AND descripcion = '$descripcion' ";}
	//	die($sQuery);
	   $sQuery.="ORDER BY	descripcion ASC ";
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
	
	function get_list_estado($id=''){
		$sQuery="SELECT
					*
				FROM
					estado
				WHERE
					1 = 1
				";
	   if($id) {	$sQuery.="AND estado.id = '$id' ";	}
	   $sQuery.="ORDER BY
					estado.descripcion ASC ";


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
	
	function add_estado($descripcion)
	{
		$query = "INSERT INTO estado (descripcion) 
				  VALUES ('$descripcion')";
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	}
	
	
	function update_estado($id,$descripcion)
	{
		$query = "UPDATE estado SET descripcion='$descripcion' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function delete_estado($id)
	{
		$query = "DELETE FROM  estado WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
