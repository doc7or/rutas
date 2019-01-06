<?php 
class class_cyberlux_pedidos {
/*
	CLASE DE MANEJO Y CONSULTAS DE LA TABLA DE PEDIDOS DE PROFIT
	
	TABLA pedidos
	CAMPOS 	fact_num,tot_bruto,co_cli
	
*/


	function get_cyberlux_pedidos($fact_num=''){
		$sQuery="SELECT 
					pedidos.fact_num,pedidos.tot_bruto,pedidos.co_cli,pedidos.co_ven,
					clientes.cli_des,clientes.co_cli AS cli_cod 					
				 FROM 	pedidos 
				 		Inner Join clientes ON pedidos.co_cli = clientes.co_cli 						
				 WHERE anulada = 0 ";
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
	
	//datod completos
	function get_cyberlux_pedidos_comp($fact_num=''){
		$sQuery="SELECT 
					pedidos.fact_num,pedidos.tot_bruto,pedidos.tot_neto,pedidos.co_cli, pedidos.co_ven, pedidos.descrip,pedidos.fec_emis,
					clientes.cli_des,clientes.co_cli AS cli_cod,
					vendedor.ven_des,vendedor.co_ven AS ven_cod
				 FROM 	pedidos 
				 		Inner Join clientes ON pedidos.co_cli = clientes.co_cli
						Inner Join vendedor ON pedidos.co_ven = vendedor.co_ven
				 WHERE anulada = 0 ";
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
	
	//FUNCION PARA LA CONSULTA DE LOS RESNGLONES DE LA pedidos
	function get_cyberlux_pedidos_reng($fact_num=''){
		$sQuery="SELECT 
					reng_ped.*,
					art.*
				 FROM 	reng_ped 
				 		Inner Join art ON reng_ped.co_art = art.co_art
				 WHERE 1=1 ";
		if($fact_num) {	$sQuery.="AND reng_ped.fact_num = '$fact_num' ";	}
		$sQuery.=" ORDER BY reng_ped.reng_num ";
		
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

