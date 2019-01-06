<?php 
class class_cyberlux_not_ent {

/*
TABLA not_ent
CAMPOS 	fact_num,tot_bruto,co_cli
*/


	function get_cyberlux_not_ent($fact_num=''){
		$sQuery="SELECT 
					not_ent.fact_num,not_ent.tot_bruto,not_ent.co_cli,not_ent.descrip,not_ent.fec_emis,not_ent.co_ven,not_ent.co_tran,not_ent.tot_neto,
					clientes.cli_des 					
				 FROM 	not_ent 
				 		Inner Join clientes ON not_ent.co_cli = clientes.co_cli 						
				 WHERE 1=1 ";
		if($fact_num) {	$sQuery.="AND not_ent.fact_num = '$fact_num' ";	}
		
		//echo($sQuery);
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
	
	//datod completos
	function get_cyberlux_not_ent_comp($fact_num=''){
		$sQuery="SELECT 
					not_ent.fact_num,not_ent.tot_bruto,not_ent.tot_neto,not_ent.co_cli, not_ent.co_ven, not_ent.descrip,not_ent.fec_emis,
					clientes.cli_des,
					vendedor.ven_des 
				 FROM 	not_ent 
				 		Inner Join clientes ON not_ent.co_cli = clientes.co_cli
						Inner Join vendedor ON not_ent.co_ven = vendedor.co_ven
				 WHERE 1=1 ";
		if($fact_num) {	$sQuery.="AND fact_num = '$fact_num' ";	}
		
		//echo($sQuery);
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
	
	//FUNCION PARA LA CONSULTA DE LOS RESNGLONES DE LA not_ent
	function get_cyberlux_not_ent_reng($fact_num=''){
		$sQuery="SELECT 
					reng_nde.pendiente,reng_nde.co_art,reng_nde.total_art,reng_nde.co_alma,reng_nde.reng_num,reng_nde.fact_num,reng_nde.prec_vta,reng_nde.porc_desc,reng_nde.reng_neto,
					art.art_des
				 FROM 	reng_nde 
				 		Inner Join art ON reng_nde.co_art = art.co_art
				 WHERE 1=1 ";
		if($fact_num) {	$sQuery.="AND reng_nde.fact_num = '$fact_num' ";	}
		$sQuery.=" ORDER BY reng_nde.reng_num ";
		
		//echo($sQuery);
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

