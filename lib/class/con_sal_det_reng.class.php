<?php 
class class_con_sal_det_reng {
/*

TABLA con_sal_det_reng
CAMPOS id,co_art,total_art,co_alma,reng_num,fact_num,id_con_detalle,prec_vta,porc_desc,reng_neto,art_des 

id					identificador
co_art				codgo del articulo
total_art			total de artiulos segun el renglon de la factura correspondiente
co_alma				codigo de la sucursar profit
reng_num			numero de ubicacion en la factura
fact_num			numero de la factura
id_con_detalle		control de destalle identificador
prec_vta			recio de venta de la tabla de reng_fact
porc_desc			porcentaje de descuento de la tabla de reng_fact
reng_neto			renglon neto 
art_des

		
		

*/
	//BUSQUEDAS Y CONSULTAS	
	
	//BUSCAMOS  LOS RENGLONES A SUBR A LA WEB id_con_sal_det_reng,co_art,total_art,co_alma,reng_num,fact_num,id_con_detalle,prec_vta,porc_desc,reng_neto,art_des top(40) 
	function get_con_sal_det_reng_web($id_con_detalle){
		$sQuery="SELECT id,co_art,total_art,co_alma,reng_num,fact_num,id_con_detalle,prec_vta,porc_desc,reng_neto,art_des  FROM con_sal_det_reng WHERE status_web = '1'  ";
		
			if($id_con_detalle) {	$sQuery.=" AND  id_con_detalle IN ($id_con_detalle) ";	}
		$sQuery.=" ORDER BY id ";	
//echo "<br>".$sQuery."<br>";
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

	
	//buscamos cuantas guias hay en status 1 solamente
	function get_con_sal_det_reng($status_web,$no_status_web,$id_con_detalle){
		$sQuery="SELECT COUNT(id) AS cuantos FROM con_sal_det_reng WHERE id_con_detalle = '$id_con_detalle' ";	
		if($status_web)	{ $sQuery.=" AND status_web = '$status_web' ";	}
		if($no_status_web)	{ $sQuery.=" AND status_web <> '$no_status_web' ";	}
		//echo $sQuery;
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$row=mssql_fetch_array($result);
		//die ('este es'.$row['cuantos']);
		return($row['cuantos']);
			
	}
	
	//BUSQUEDAS Y CONSULTAS	

	//ADDICIONES
	
	function add_con_sal_det_reng($co_art='',$total_art='',$co_alma='',$reng_num='',$fact_num='',$id_con_detalle='',$prec_vta='',$porc_desc='',$reng_neto='',$art_des='')
	{	 
	
		
		$query = "INSERT INTO con_sal_det_reng (co_art,total_art,co_alma,reng_num,fact_num,id_con_detalle,prec_vta,porc_desc,reng_neto,art_des) 
		VALUES ('$co_art','$total_art','$co_alma','$reng_num','$fact_num','$id_con_detalle','$prec_vta','$porc_desc','$reng_neto','$art_des')";
		
		//,fecha_salida,'$fecha_salida'
	//die($query);		  
		$result=mssql_query($query);
		
		return($result);
	}
	
	//ADDICIONES
	
	//ACTUALIZACIONES
	//funcion generica
	function update_con_sal_det_reng_fech_salida($id,$fecha_salida)
	{
		$query = "UPDATE con_sal_det_reng SET fecha_salida='$fecha_salida' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	//funcion de actualizacon simple de status
	function update_con_sal_det_reng_status_web($id,$status_web)
	{
		$query = "UPDATE con_sal_det_reng SET status_web='$status_web' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	//ACTUALIZACIONES
	
	
}
?>
