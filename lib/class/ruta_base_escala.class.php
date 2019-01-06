<?php 
class class_ruta_base_escala {
/*
FROM
ruta_base_escala_escala
CAMPOS 	id,id_ruta_base,posicion,id_zona
*/

	function get_ruta_base_escala($id='',$id_ruta_base=''){
	
		$sQuery="SELECT ruta_base_escala.id,ruta_base_escala.id_ruta_base,ruta_base_escala.posicion,ruta_base_escala.id_zona,
					zona.descripcion AS zona
					FROM
					ruta_base_escala
					Inner Join zona ON ruta_base_escala.id_zona = zona.id 
				WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_ruta_base) {	$sQuery.="AND id_ruta_base = '$id_ruta_base' ";	}
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
	
	
	
	function add_ruta_base_escala($id_ruta_base,$posicion,$id_zona)
	{
		$query = "INSERT INTO ruta_base_escala (id_ruta_base,posicion,id_zona) 
				  VALUES ('$id_ruta_base','$posicion','$id_zona')";
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	}
	
	
	function update_ruta_base_escala($id_ruta_base,$posicion,$id_zona)
	{
		$query = "UPDATE ruta_base_escala SET id_ruta_base='$id_ruta_base' , posicion='$posicion', id_zona='$id_zona' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	

	function delete_ruta_base_escala($id)
	{
		$query = "DELETE FROM  ruta_base_escala WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
