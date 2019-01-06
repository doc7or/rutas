<?php 
class class_cyberlux_factura {

/*
TABLA factura
CAMPOS 	fact_num,tot_bruto,co_cli
*/


	function get_cyberlux_factura($fact_num=''){
		$sQuery="SELECT
					factura.fact_num,factura.tot_bruto,factura.co_cli,
					clientes.cli_des,clientes.co_cli AS cli_cod ,factura.nombre as factura_nombre1					
				 FROM 	factura 
				 		Inner Join clientes ON factura.co_cli = clientes.co_cli 						
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
        
    function get_cyberlux_factura_1($fact_num=''){
    	
        $consulta="select a.factura as fact_num,a.monto_fac as tot_bruto,a.cliente as co_cli,a.des_cliente as cli_des,a.cliente as cli_cod,des_cliente as factura_nombre1 from facturas as a";
		if($fact_num) {	$consulta.=" where a.factura = '$fact_num' ";	}
                //echo $consulta;
		//return $consulta;
		//die($sQuery);
		$result=mssql_query($consulta) or die(mssql_min_error_severity());
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
	function get_cyberlux_factura_comp($fact_num=''){
		$sQuery="SELECT 
					factura.fact_num,factura.tot_bruto,factura.tot_neto,factura.co_cli, factura.co_ven, factura.descrip,factura.fec_emis,
					clientes.cli_des,clientes.co_cli AS cli_cod,
					vendedor.ven_des,vendedor.co_ven AS ven_cod
				 FROM 	factura 
				 		Inner Join clientes ON factura.co_cli = clientes.co_cli
						Inner Join vendedor ON factura.co_ven = vendedor.co_ven
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
        
        	function get_cyberlux_factura_comp_1($fact_num=''){
		$sQuery="SELECT    a.id as fact_id,a.factura as fact_num,a.monto_fac as tot_bruto,a.monto_fac as tot_neto,a.cliente as co_cli, a.cliente as co_cli,'' as descrip,CONVERT( VARCHAR(10),a.fecha_fac,21 ) as fec_emis,
					a.des_cliente as cli_des,a.cliente as cli_cod,
					a.des_vendedor as ven_des,a.co_vendedor AS co_ven
				 FROM 	facturas as a  ";
		if($fact_num) {	$sQuery.="where a.factura = '$fact_num' ";	}
		
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
	
	//FUNCION PARA LA CONSULTA DE LOS RESNGLONES DE LA FACTURA
	function get_cyberlux_factura_reng($fact_num=''){
		$sQuery="SELECT 
					reng_fac.co_art,reng_fac.total_art,reng_fac.co_alma,reng_fac.reng_num,reng_fac.fact_num,reng_fac.prec_vta,reng_fac.porc_desc,reng_fac.reng_neto,
					art.art_des
				 FROM 	reng_fac 
				 		Inner Join art ON reng_fac.co_art = art.co_art
				 WHERE 1=1 ";
		if($fact_num) {	$sQuery.="AND reng_fac.fact_num = '$fact_num' ";	}
		$sQuery.=" ORDER BY reng_fac.reng_num ";
		
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
        
        	function get_cyberlux_factura_reng_1($fact_num=''){
		$sQuery="SELECT 
					b.co_articulo as co_art,b.cantidad_art as total_art,b.co_almacen as co_alma,b.factura as fact_num,b.precio_art as prec_vta,b.descuento_art as porc_desc,b.total_art as reng_neto,
					b.des_art as art_des
				 FROM 	factura_detalle as b
				 WHERE 1=1 ";
		if($fact_num) {	$sQuery.="AND b.id_factura = '$fact_num' ";	}
		$sQuery.=" ";
		
		echo ($sQuery);
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

