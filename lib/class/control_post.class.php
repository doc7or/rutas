<?php 
class class_control_post {
/*

TABLA control_post
CAMPOS 

id					identificadir unico
descripcion			nombre o ddescripcion
tipo				1 suma 2 resta

*/


	function get_control_post($id='',$tipo=''){
		$sQuery="SELECT * FROM control_post WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($tipo) {	$sQuery.="AND tipo = '$tipo' ";	}
		
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
	
	
}
?>
