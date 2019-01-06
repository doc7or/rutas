<?php 
class class_factura {

/*
TABLA factura
CAMPOS 	fact_num,tot_bruto,status

///////////////////////////////////
status este campo 1 indica q esta usada 2 que fue usada pero se puede volver a usar esto es por si hubo algun detalle en l envio de las facturas en algun control de salida anterior
///////////////////////////////////
*/


	function get_factura($fact_num=''){
		$sQuery="SELECT * FROM factura WHERE status = 1 ";
		if($fact_num) {	$sQuery.="AND fact_num = '$fact_num' ";	}
		
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
	
	function add_factura($fact_num,$tot_bruto,$status)
	{
		$query = "INSERT INTO factura (fact_num,tot_bruto,status) 
				  VALUES ('$fact_num','$tot_bruto','$status')";
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	}
	
	
	function update_factura($fact_num,$status)
	{
		$query = "UPDATE factura SET status='$status' 
				  WHERE  fact_num = '$fact_num'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	
	
	
}
?>

