<?php 
class class_web_control_salida_detalle {

/*
TABLA	control_salida_detalle
CAMPOS 	id,id_control_salida_detalle,id_factura,monto_factura,cliente,monto_factura,co_ven,id_control_salida,ven_des,co_cli

id									NUMERO DE IDENTIFICACION
id_control_salida_detalle			NUMERO DE IDENTIFICACION DEL DETALLE DEL CONTROL DE SALIDA SISTRANS
id_factura							NUMERO DE LA FACTURA
cliente								DESCRIOCION DEL CLIENTE
monto_factura						MONTO DE LA FACTURA
co_ven								CODIGO DEL VENDEDOR
id_control_salida					IDENTICADOR DEL CONTROL DE SALIDA DE EL SISTRANS	
ven_des								DESCRIPCION DEL VENDEDOR
co_cli								CODIGO DEL CLIENTE	

*/

	//////////////////////////////////////////////////////////////////////////
	////////////////////////SELECTS SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	//FUNCION DE BUSQUEDA DEL USUARIO MAS QUE TODO ESTE ES PARA LOS LOGEOS
	function get_control_salida_detalle($fact_num='',$co_ven='',$rango='',$co_cli=''){
		$sQuery="SELECT * FROM control_salida_detalle WHERE  1=1 ";
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
	
	//FUNCION DE BUSQUEDA DATOS DEL PEDIDO PARA UN LISTADO DE LOS control_salida_detalle Y SUS CLIENTES
	function get_control_salida_detalle_list($fact_num='',$co_ven='',$rango='',$co_cli=''){
		$sQuery="SELECT control_salida_detalle.*, clientes.cli_des 
				FROM control_salida_detalle 
				Inner Join clientes ON control_salida_detalle.co_cli = clientes.co_cli 
				WHERE  1=1 ";
		if($fact_num) {	$sQuery.=" AND control_salida_detalle.fact_num = '$fact_num' ";	}
		if($co_ven) {	$sQuery.=" AND control_salida_detalle.co_ven = '$co_ven' ";	}
		if($co_cli) {	$sQuery.=" AND control_salida_detalle.co_cli = '$co_cli' ";	}
		
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
	
	function add_control_salida_detalle($fact_num,$co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$tipo,$hora,$co_sucu)
	{		
		$query = "INSERT INTO control_salida_detalle (fact_num,co_cli,fec_emis,tot_bruto,iva,tot_neto,descrip,co_ven,tipo,hora,co_sucu) 
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
	function update_control_salida_detalle_desc($desc,$fact_num)
	{			
		$query = "UPDATE control_salida_detalle SET `desc`='$desc' 
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
	
	function desactivar_control_salida_detalle($id)
	{
		$query = "UPDATE control_salida_detalle set status=0 WHERE id = $id'";
		$result=mysql_query($query);
		return $result;
	}
	function delete_control_salida_detalle($co_ven)
	{
		$query = "DELETE FROM  control_salida_detalle WHERE co_ven = '$co_ven'"; 
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


