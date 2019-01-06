<?php 
class class_cod_area_telefono{

/*
TABLA cod_area_telefono
CAMPOS 	id,codigo
*/


	function get_cod_area_telefono($id='',$codigo=''){
		$sQuery="SELECT * FROM cod_area_telefono WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($codigo) {	$sQuery.="AND codigo = '$codigo' ";}
		$sQuery.="ORDER BY codigo ";
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
	

}
?>
