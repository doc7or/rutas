<?php 
class class_log_tipo {

/*
TABLA log_tipo
CAMPOS 	
id
descripcion
modo
tabla

*/


	function get_log_tipo($id='',$descripcion='',$modo, $tabla=''){
		$sQuery="SELECT * FROM log_tipo WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($descripcion) {	$sQuery.="AND descripcion = '$descripcion' ";}
		if($modo){ $sQuery.="AND modo = '$modo' ";}
		if($tabla){ $sQuery.="AND tabla = '$tabla' ";}
		
		
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
	
	function add_log_tipo($id='',$descripcion='',$modo, $tabla='')
	{
		$query = "INSERT INTO log_tipo (descripcion,modo,tabla) 
				  VALUES ('$descripcion','$modo','$tabla')";
		//die($query);		  
		$result=mssql_query($query);
		
		return $new_pet_id;
	}
	
	
	function update_log_tipo($id='',$descripcion='',$modo, $tabla='',$id_usuario='')
	{
		$query = "UPDATE log_tipo SET descripcion='$descripcion' , modo='$modo', tabla='$tabla'  
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	

	function delete_log_tipo($id)
	{
		$query = "DELETE FROM  log_tipo WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
