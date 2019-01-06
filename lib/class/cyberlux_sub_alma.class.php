<?php 
class class_cyberlux_sub_alma {

/*
TABLA sub_alma
CAMPOS 	co_sub,des_sub
*/


	function get_cyberlux_sub_alma($co_sub=''){
		$sQuery="SELECT co_sub,des_sub FROM sub_alma WHERE 1 = 1 ";
		if($co_sub) {	$sQuery.="AND co_sub = '$co_sub' ";	}
		
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

