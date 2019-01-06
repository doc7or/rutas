<?php 
class class_cyberlux_clientes {

/*
TABLA clientes
CAMPOS 	co_cli,cli_des
*/


	function get_cyberlux_clientes($co_cli=''){
		$sQuery="SELECT cli_des,co_cli FROM clientes WHERE 1 = 1 ";
		if($co_cli) {	$sQuery.="AND co_cli = '$co_cli' ";	}
		
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

