<?php 
class class_web_con_sal_det_reng {

/*
TABLA	con_sal_det_reng
CAMPOS 	id,id_con_sal_det_reng,co_art,total_art,co_alma,reng_num,fact_num,id_con_detalle,prec_vta,porc_desc,reng_neto,art_des



id							NUMERO DE IDENTIFICACION
id_con_sal_det_reng			NUMERO DE SU SIMIL EN SISTRANS
co_art						CODIGO DEL ARTICULO
total_art					TOTAL DE ARTICULOS
co_alma						CODIGO DE ALMACEN
reng_num					NUMERO DEL RENGLON
fact_num					FACTURA NUMERO
id_control_salida_detalle	IDENIFICADOR DEL EL CONTROL DE SALIDA DETALLE
prec_vta					PRECIO DE VENTA 
porc_desc					PORCENTAJE DE DE DSCUENTO
reng_neto					RENGLON NETO DE LA LINEA
art_des						ARTICULO DESCRICION


*/

	//////////////////////////////////////////////////////////////////////////
	////////////////////////SELECTS SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	//FUNCION DE BUSQUEDA DEL USUARIO MAS QUE TODO ESTE ES PARA LOS LOGEOS
	function get_con_sal_det_reng($fact_num='',$co_ven='',$rango='',$co_cli=''){
		$sQuery="SELECT * FROM con_sal_det_reng WHERE  1=1 ";
		if($fact_num) {	$sQuery.=" AND fact_num = '$fact_num' ";	}
		if($co_ven) {	$sQuery.=" AND co_ven = '$co_ven' ";	}
		if($co_cli) {	$sQuery.=" AND co_cli = '$co_cli' ";	}
		if($rango)	{	$sQuery.=$rango;	}
	//	echo($sQuery);
		$result=mysql_query($sQuery) or die(mysql_error());
		$i=0;
		while($row=mysql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
	}
	
	//FUNCION DE BUSQUEDA DATOS DEL PEDIDO PARA UN LISTADO DE LOS con_sal_det_reng Y SUS CLIENTES
	function get_con_sal_det_reng_list($fact_num='',$co_ven='',$rango='',$co_cli=''){
		$sQuery="SELECT con_sal_det_reng.*, clientes.cli_des 
				FROM con_sal_det_reng 
				Inner Join clientes ON con_sal_det_reng.co_cli = clientes.co_cli 
				WHERE  1=1 ";
		if($fact_num) {	$sQuery.=" AND con_sal_det_reng.fact_num = '$fact_num' ";	}
		if($co_ven) {	$sQuery.=" AND con_sal_det_reng.co_ven = '$co_ven' ";	}
		if($co_cli) {	$sQuery.=" AND con_sal_det_reng.co_cli = '$co_cli' ";	}
		
		if($rango)	{	$sQuery.=$rango;	}
		//echo($sQuery);
		$result=mysql_query($sQuery) or die(mysql_error());
		$i=0;
		while($row=mysql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
	}
	
	
	//////////////////////////////////////////////////////////////////////////
	////////////////////////SELECTS SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	////////---------------------------------------------------------/////////
	
	//////////////////////////////////////////////////////////////////////////
	////////////////////////INSERTS SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	function add_con_sal_det_reng($fact_num,$co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$tipo,$hora,$co_sucu)
	{		
		$query = "INSERT INTO con_sal_det_reng (fact_num,co_cli,fec_emis,tot_bruto,iva,tot_neto,descrip,co_ven,tipo,hora,co_sucu) 
				  VALUES ('$fact_num','$co_cli','$fec_emis','$tot_bruto','$iva','$tot_neto','$descrip','$co_ven','$tipo','$hora','$co_sucu')";
	//	echo ($query);
		$result=mysql_query($query) or die(mysql_error());
		$new_pet_id = mysql_insert_id();
		return $new_pet_id;
	}
	
	//////////////////////////////////////////////////////////////////////////
	////////////////////////INSERTS SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	////////---------------------------------------------------------/////////
	
	//////////////////////////////////////////////////////////////////////////
	////////////////////////UPDATES SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	//FUNCION QUE CUENTA LAS VISITAS Y COLOCA EL ULTIMO LOGEO DEL USUARIO
	function update_con_sal_det_reng_desc($desc,$fact_num)
	{			
		$query = "UPDATE con_sal_det_reng SET `desc`='$desc' 
				  WHERE  fact_num = '$fact_num'";
		//die($query);
		$result=mysql_query($query)  or die(mysql_error());
		return $result;
	}

	
	//////////////////////////////////////////////////////////////////////////
	////////////////////////UPDATES SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	////////---------------------------------------------------------/////////
	
	//////////////////////////////////////////////////////////////////////////
	////////////////////////DELETES SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	function desactivar_con_sal_det_reng($id)
	{
		$query = "UPDATE con_sal_det_reng set status=0 WHERE id = $id'";
		$result=mysql_query($query);
		return $result;
	}
	function delete_con_sal_det_reng($co_ven)
	{
		$query = "DELETE FROM  con_sal_det_reng WHERE co_ven = '$co_ven'"; 
		$result=mysql_query($query);
	}
	
	//////////////////////////////////////////////////////////////////////////
	////////////////////////UPDATES SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	////////---------------------------------------------------------/////////
	
	//////////////////////////////////////////////////////////////////////////
	///////////////SPECIFIT AND GENERAL SECTION///////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////
	///////////////SPECIFIT AND GENERAL SECTION///////////////////////////////
	//////////////////////////////////////////////////////////////////////////
}
?>


