<?php

/*//SECCCION DE CREACION DE DATOS EN LA WEBPARA MODULO 48 HORA
	//llenado de los vectores de datos a subir
		//buscamos los controles en status web 1 
			$arr_cs_sub=$obj_control_salida->get_control_salida_web($id_sucursal);//controles de salida q debemos subir
			for($i=0;$i<sizeof($arr_cs_sub);$i++){
				if($i==0){	$guias_busqueda="'".$arr_cs_sub[$i]['id']."'";	}
				else {	$guias_busqueda.=','."'".$arr_cs_sub[$i]['id']."'";	}
			
			}
			//echo ($guias_busqueda);
		//buscamos los controles detalle en status web 1
			$arr_csd_sub=$obj_control_salida_detalle->get_con_det_web($guias_busqueda);//buscamos los controles de salida detalle q debemos subir a la web 
			for($i=0;$i<sizeof($arr_csd_sub);$i++){
				if($i==0){	$guiasd_busqueda="'".$arr_csd_sub[$i]['id']."'";	}
				else {	$guiasd_busqueda.=','."'".$arr_csd_sub[$i]['id']."'";	}
			
			}
			//echo ($guiasd_busqueda);
		//buscamos los controles detalle renglones en status web 1
		
			$arr_csdr_sub=$obj_con_sal_det_reng->get_con_sal_det_reng_web($guiasd_busqueda);//buscamos los controles de salida detalle mas sus renglines q debemos subir a la web 
			for($i=0;$i<sizeof($arr_csdr_sub);$i++){
				if($i==0){	$guiasdr_busqueda="'".$arr_csdr_sub[$i]['id']."'";	}
				else {	$guiasdr_busqueda.=','."'".$arr_csdr_sub[$i]['id']."'";	}
			
			}
			//die($guiasdr_busqueda);
			
	//llenado de los vectores de datos a subir
		
	//proceso de subir los datos a la web
		//coneccion a cyber en la web cyber o la web vfnet
			$conexion_cyber_web=$obj_conexiones->my_conect();
			//insercion de las guias  add_vfnet_control_salida($id_por_sucursal='', $placa='', $fecha='', $fecha_salida='', $monto_facturas='', $id_por_sucursal_new='', $id_control_salida='', $ruta='');
			for($i=0;$i<sizeof($arr_cs_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				$arr_cs_sub[$i]['web']=$obj_vfnet_csdr->add_vfnet_control_salida($arr_cs_sub[$i]['id_por_sucursal'],$arr_cs_sub[$i]['placa'],$arr_cs_sub[$i]['fecha'], $arr_cs_sub[$i]['fecha_salida'],$arr_cs_sub[$i]['monto_facturas'],$arr_cs_sub[$i]['id_por_sucursal_new'],$arr_cs_sub[$i]['id'],$arr_cs_sub[$i]['ruta']);
				
			}
			
			//insercion de las guias detalle
			for($i=0;$i<sizeof($arr_csd_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				$arr_csd_sub[$i]['web']=$obj_vfnet_csdr->add_vfnet_control_salida_detalle($arr_csd_sub[$i]['id'],$arr_csd_sub[$i]['id_factura'],$arr_csd_sub[$i]['monto_factura'],rehtmlspecialchars($arr_csd_sub[$i]['cliente']),$arr_csd_sub[$i]['monto_factura'],$arr_csd_sub[$i]['co_ven'],$arr_csd_sub[$i]['id_control_salida'],$arr_csd_sub[$i]['ven_des'],$arr_csd_sub[$i]['co_cli'],$id_sucursal);
				}
			
			//insercion de las guias detalle renglOnes
			for($i=0;$i<sizeof($arr_csdr_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				$arr_csdr_sub[$i]['web']=$obj_vfnet_csdr->add_vfnet_con_sal_det_reng($arr_csdr_sub[$i]['id'],$arr_csdr_sub[$i]['co_art'],$arr_csdr_sub[$i]['total_art'],$arr_csdr_sub[$i]['co_alma'] ,$arr_csdr_sub[$i]['reng_num'],$arr_csdr_sub[$i]['fact_num'],$arr_csdr_sub[$i]['id_con_detalle'],$arr_csdr_sub[$i]['prec_vta'],$arr_csdr_sub[$i]['porc_desc'],$arr_csdr_sub[$i]['reng_neto'],$arr_csdr_sub[$i]['art_des']);
			}
		
	//proceso de subir los datos a la web
	
	//cerrramos la conexion a conexion_cyber_web
	mssql_close($conexion_cyber_web);//cerra,os esta coneccion
			
	
	
	//SECCION DE ACTUALZACION DE LA DATA EN TRANSPORTE
	//proceso de subir los datos a la web
		//coneccion a transporte para actualizar los datos
			$conexion_transporte=$obj_conexiones->ms_conect_transporte();
			
			//insercion de las guias detalle renglnes
			for($i=0;$i<sizeof($arr_csdr_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				if($arr_csdr_sub[$i]['web']>0) 
				{	//aptualizamos la tabla de renglones de controles de salida detalle
					$udp_st_csdr=$obj_con_sal_det_reng->update_con_sal_det_reng_status_web($arr_csdr_sub[$i]['id'],'2');					
				}	
			}
			
			//insercion de las guias detalle
			for($i=0;$i<sizeof($arr_csd_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				if($arr_csd_sub[$i]['web']>0) 
				{	//aptualizamos la tabla de renglones de controles de salida detalle
					$udp_st_csd=$obj_control_salida_detalle->change_status_control_salida_detalle_web($arr_csd_sub[$i]['id'],'2');							
				}
				//bucamos si los renglones todos estan en status web subido
				$c_nw_csdr=$obj_con_sal_det_reng->get_con_sal_det_reng('1','',$arr_csd_sub[$i]['id']);
				if($c_nw_csdr==0){
					//lo ponemos en 3 que es el status que dice q sus niveles estan arriba
					$udp_st_csd=$obj_control_salida_detalle->change_status_control_salida_detalle_web($arr_csd_sub[$i]['id'],'3');
				}			
			}
			
			//insercion de las guias  add_vfnet_control_salida($id_por_sucursal='', $placa='', $fecha='', $fecha_salida='', $monto_facturas='', $id_por_sucursal_new='', $id_control_salida='', $ruta='');
			for($i=0;$i<sizeof($arr_cs_sub);$i++){
				//insertamos en la web y llenamos el campo quse necesitamos para saber si esto se subio
				if($arr_cs_sub[$i]['web']>0)
				{	//aptualizamos la tabla de renglones de controles de salida detalle
					$udp_st_cs=$obj_control_salida->change_status_control_salida_web($arr_cs_sub[$i]['id'],'2');							
				}
					//bucamos si los renglones todos estan en status web subido
				$c_nw_csd=$obj_control_salida_detalle->get_con_sal_det('','3',$arr_cs_sub[$i]['id']);
				if($c_nw_csd==0){
					//lo ponemos en 3 que es el status que dice q sus niveles estan arriba
					$udp_st_cs=$obj_control_salida->change_status_control_salida_web($arr_cs_sub[$i]['id'],'3');
				}			
				
			}
				
	//proceso de subir los datos a la web*/

?>