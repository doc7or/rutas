<?php 
class class_ruta_base {
/*
FROM
ruta_base
CAMPOS 	id,descripcion,salida,llegada,tipo_sucursal
*/

	function get_ruta_base($id='',$tipo_sucursal=''){
	
		$sQuery="SELECT *			
				FROM
					ruta_base
				WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($tipo_sucursal) {	$sQuery.="AND tipo_sucursal = '$tipo_sucursal' ";	}
		$sQuery.="ORDER BY descripcion ";
		
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
	
	
	
	function add_ruta_base($descripcion,$salida,$llegada)
	{
		$query = "INSERT INTO ruta_base (descripcion,salida,llegada,id_sucursal) 
				  VALUES ('$descripcion','$salida','$llegada','$id_sucursal')";
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	}
	
	
	function update_ruta_base($id,$descripcion,$salida,$llegada,$id_sucursal)
	{
		$query = "UPDATE ruta_base SET descripcion='$descripcion' , salida='$salida', llegada='$llegada' , id_sucursal='$id_sucursal'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	

	function delete_ruta_base($id)
	{
		$query = "DELETE FROM  ruta_base WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
