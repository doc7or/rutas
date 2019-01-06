<?php 
class class_control_salida_detalle_post {
/*

TABLA control_salida_detalle_post
CAMPOS 

id					identificador unico
id_control_salida	id del contro de salida
id_control_post		procedmien to posterior		
monto				valor o monto del procedimiento



*/



	
	function get_control_salida_detalle_post($id='',$id_control_salida='',$id_control_post='',$monto=''){
		$sQuery="SELECT * FROM control_salida_detalle_post WHERE 1 = 1";
		if($id)	{ $sQuery.=" AND id = '$id' ";	}
		if($id_control_salida) {	$sQuery.=" AND id_control_salida = '$id_control_salida' ";	}
		if($id_control_post)	{ $sQuery.=" AND id_control_post = '$id_control_post' ";	}
		if($monto)	{ $sQuery.=" AND monto = '$monto' ";	}
		
		$sQuery.=" ORDER BY id DESC ";
	//	echo($sQuery);
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
	
	
	
	function add_control_salida_detalle_post($id_control_salida='',$id_control_post='',$monto='')
	{
		
		$query = "INSERT INTO control_salida_detalle_post(id_control_salida,id_control_post,monto) 
		VALUES ('$id_control_salida','$id_control_post','$monto')";
		
		
	//	die($query);		  
		$result=mssql_query($query);
		
		return $result;
	}
	
	
	function edit_control_salida_detalle_post($id,$monto)
	{
		$query = "UPDATE control_salida_detalle_post set monto='$monto' WHERE id = '$id'";
		//die($query);
		$result=mssql_query($query);
	}
	
	

	

	
}
?>
