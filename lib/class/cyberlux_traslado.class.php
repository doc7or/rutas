<?php 
class class_cyberlux_traslado {

/*
TABLA traslado
CAMPOS 	fact_num,tot_bruto,co_cli
*/


	function get_cyberlux_traslado($fact_num=''){
		$sQuery="SELECT fact_num,tot_bruto,co_cli FROM traslado WHERE 1 = 1 ";
		if($fact_num) {	$sQuery.="AND fact_num = '$fact_num' ";	}
		
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

