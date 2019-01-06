<?php 
class class_cyberlux_tras_alm {

/*
TABLA tras_alm
CAMPOS 	
tras_num,alm_orig,alm_dest

*/


	function get_cyberlux_tras_alm($tras_num=''){
		$sQuery="SELECT tras_num,alm_orig,alm_dest FROM tras_alm WHERE anulada = 'False' ";
		if($tras_num) {	$sQuery.="AND tras_num = '$tras_num' ";	}
		
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
	
	


}
?>

