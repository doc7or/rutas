<?php 
class class_iva {

/*
TABLA iva
CAMPOS 	
id
valor

///////////////////////////////////
status este campo 1 indica q esta usada 2 que fue usada pero se puede volver a usar esto es por si hubo algun detalle en l envio de las ivas en algun control de salida anterior
///////////////////////////////////
*/


	function get_iva($id='',$naturaleza='',$fecha=''){
		$sQuery="SELECT * FROM iva WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($naturaleza)  {	$sQuery.="AND naturaleza = '$naturaleza' ";	}
		if($fecha)  {	$sQuery.="  AND fecha_ini < '$fecha' AND   fecha_fin > '$fecha' ";	}
		
		//Date BETWEEN '06-Jan-1999' AND '10-Jan-1999' rango de fechas pero para esta consulta no aplica
	//echo $sQuery;
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
	
	function add_iva($fact_num,$tot_bruto,$status)
	{
		$query = "INSERT INTO iva (fact_num,tot_bruto,status) 
				  VALUES ('$fact_num','$tot_bruto','$status')";
		$result=mssql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	}
	
	
	function update_iva($fact_num,$status)
	{
		$query = "UPDATE iva SET status='$status' 
				  WHERE  fact_num = '$fact_num'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	
	
	
}
?>

