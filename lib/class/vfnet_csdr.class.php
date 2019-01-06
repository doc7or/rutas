<?php 
class class_vfnet_csdr {

/*
CLASE GENERICA DE CONECCIONES A VF NET EN ESTA CLASE ESTAREMOS INSERTANTO EN LAS TABLAS DE CONTROLES SAIDA Y DETALES Y RENGLONES PARA QUE EN LA WEB PODAMOS MANEJAR ESTOS DATOS

TABLA con_sal_det_reng
CAMPOS id, id_con_sal_det_reng, co_art, total_art, co_alma, reng_num, fact_num, id_control_salida_detalle, prec_vta, porc_desc, reng_neto, art_des

TABLA control_salida
CAMPOS id, id_por_sucursal, placa, fecha, fecha_salida, monto_facturas, id_por_sucursal_new, id_control_salida, ruta

TABLA control_salida_detalle
CAMPOS id, id_control_salida_detalle, id_factura, monto_factura, cliente, monto_facturas, co_ven, id_control_salida, ven_des, co_cli
*/


	//INSERCION EN LA TABLA DE CONROLES DE SALIDA DETALLE RENGLONES
	function add_vfnet_con_sal_det_reng($id_con_sal_det_reng='', $co_art='', $total_art='', $co_alma='', $reng_num='', $fact_num='', $id_control_salida_detalle='', $prec_vta='', $porc_desc='', $reng_neto='', $art_des=''){
		
		$query = "INSERT INTO con_sal_det_reng (id_con_sal_det_reng, co_art, total_art, co_alma, reng_num, fact_num, id_control_salida_detalle, prec_vta, porc_desc, reng_neto, art_des) 
				  VALUES ('$id_con_sal_det_reng','$co_art','$total_art','$co_alma','$reng_num','$fact_num','$id_control_salida_detalle','$prec_vta','$porc_desc','$reng_neto','$art_des')";
		//die($query);
//echo "<br>".$query;
		$result=mysql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
			
	}

	//INSERCION EN LA TABLA DE CONROLES DE SALIDA 
	function add_vfnet_control_salida($id_por_sucursal='', $placa='', $fecha='', $fecha_salida='', $monto_facturas='', $id_por_sucursal_new='', $id_control_salida='', $ruta=''){
		
		$query = "INSERT INTO control_salida (id_por_sucursal, placa, fecha, fecha_salida, monto_facturas, id_por_sucursal_new, id_control_salida, ruta) 
				  VALUES ('$id_por_sucursal','$placa','$fecha','$fecha_salida','$monto_facturas','$id_por_sucursal_new','$id_control_salida','$ruta')";
	//	die($query);
//echo "<br>".$query;
		$result=mysql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
			
	}
	
	//INSERCION EN LA TABLA DE CONROLES DE SALIDA DETALLE
	function add_vfnet_control_salida_detalle($id_control_salida_detalle='', $id_factura='', $monto_factura='', $cliente='', $monto_facturas='', $co_ven='', $id_control_salida='', $ven_des='', $co_cli='',$id_sucursal='',$fec_emis=''){
		
		$query = "INSERT INTO control_salida_detalle (id_control_salida_detalle, id_factura, monto_factura, cliente, co_ven, id_control_salida, ven_des, co_cli, id_sucursal,fec_emis) 
				  VALUES ('$id_control_salida_detalle','$id_factura','$monto_factura','$cliente','$co_ven','$id_control_salida','$ven_des','$co_cli','$id_sucursal','$fec_emis')";
//	die($query);		
//echo "<br>".$query;
		$result=mysql_query($query);
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
			
	}

	
	


}
?>

