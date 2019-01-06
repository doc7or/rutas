<?php 
class class_factura_temp_uso {

/*
TABLA factura_temp_uso
CAMPOS 	
fact_num
id_user
tipo

///////////////////////////////////
esta tabla contendra lasfacturas temporales de los diferentes usuarios
esto permitira no repetirfacturas en la misma misma orden y no tomar facturas usadas por otros usuariis en el mismo instante
uego de crear uuna gia se debe borrarlas facturas en uso de un deteminado usuario
///////////////////////////////////
*/


	function get_factura_temp_uso($fact_num='',$id_user='',$tipo=''){
		$sQuery="SELECT * FROM factura_temp_uso WHERE 1 = 1 ";
		if($fact_num) {	$sQuery.="AND fact_num = '$fact_num' ";	}
		if($id_user)  {	$sQuery.="AND id_user = '$id_user' ";	}
		if($tipo)  {	$sQuery.="AND tipo = '$tipo' ";	}
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
	
	function add_factura_temp_uso($fact_num='',$id_user='',$tipo='')
	{
		$query = "INSERT INTO factura_temp_uso (fact_num,id_user,tipo) 
				  VALUES ('$fact_num','$id_user','$tipo')";
		$result=mssql_query($query);
		
		return $result;
	}
	
	
	function update_factura_temp_uso($id_user)
	{
		$query = "UPDATE factura_temp_uso SET status='$status' 
				  WHERE  id_user = '$id_user'";
		$result=mssql_query($query);
		return $result;
	}
	
	function delete_factura_temp_uso($id_user)
	{
		$query = "DELETE FROM  factura_temp_uso WHERE id_user = '$id_user'";
		$result=mssql_query($query);
	}
	
	
	
}
?>

