<?php 
class class_web_control_salida {

/*
TABLA	control_salida
CAMPOS 	id,id_por_sucursal,placa,fecha,fecha_salida,monto_facturas,id_por_sucursal_new,id_control_salida,ruta

id							NUMERO DE IDENTIFICACION
id_por_sucursal				NUMERO DE IDENTIFICACION DE LA SUCURSAL
placa						PLACA DE L VEHICULO
fecha						FECHA EN QUE SE REALIZO EL PEDIDO
fecha_salida				FECHA DE SALIDA DE  EL CAMION
monto_facturas				MONTO DE LAS FACTURAS
id_por_sucursal_new			IDENTIFICADOR DE LA SUCURSAL NUEVO
id_control_salida			IDENTIFICADOR DE ELE CONTROL DE SALIDA EN EL SISTRANS
ruta						RUTA DEL FLETE

*/

	//////////////////////////////////////////////////////////////////////////
	////////////////////////SELECTS SECTION///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	//FUNCION DE BUSQUEDA DEL USUARIO MAS QUE TODO ESTE ES PARA LOS LOGEOS
	function get_control_salida($fact_num='',$co_ven='',$rango='',$co_cli=''){
		$sQuery="SELECT * FROM control_salida WHERE  1=1 ";
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
	
	//FUNCION DE BUSQUEDA DATOS DEL PEDIDO PARA UN LISTADO DE LOS control_salida Y SUS CLIENTES
	function get_control_salida_list($fact_num='',$co_ven='',$rango='',$co_cli=''){
		$sQuery="SELECT control_salida.*, clientes.cli_des 
				FROM control_salida 
				Inner Join clientes ON control_salida.co_cli = clientes.co_cli 
				WHERE  1=1 ";
		if($fact_num) {	$sQuery.=" AND control_salida.fact_num = '$fact_num' ";	}
		if($co_ven) {	$sQuery.=" AND control_salida.co_ven = '$co_ven' ";	}
		if($co_cli) {	$sQuery.=" AND control_salida.co_cli = '$co_cli' ";	}
		
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
	
	function add_control_salida($fact_num,$co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$tipo,$hora,$co_sucu)
	{		
		$query = "INSERT INTO control_salida (fact_num,co_cli,fec_emis,tot_bruto,iva,tot_neto,descrip,co_ven,tipo,hora,co_sucu) 
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
	function update_control_salida_desc($desc,$fact_num)
	{			
		$query = "UPDATE control_salida SET `desc`='$desc' 
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
	
	function desactivar_control_salida($id)
	{
		$query = "UPDATE control_salida set status=0 WHERE id = $id'";
		$result=mysql_query($query);
		return $result;
	}
	function delete_control_salida($co_ven)
	{
		$query = "DELETE FROM  control_salida WHERE co_ven = '$co_ven'"; 
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


