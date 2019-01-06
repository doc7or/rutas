<?php 
class class_guia_carga {
/*
CLASE DE MANEJO DE LAS TABLAS DE GUIAS DE CARGA CONN LAS CUALES SE HARAN EL PROCESO DE FACTURACION, PEDIDOS, Y GUIAS DE TRANSPORTE

TABLA guia_carga y guia_carga_reng
CAMPOS 

guia_carga indentificador de la guia de carga
id, id_por_sucursal, id_sucursal, id_transportista,  id_empresa, placa, fecha, status, id_user
	
id								identificacor unico
id_por_sucursal					identificacor por sucursal
id_sucursal						identificador de la sucursal
id_transportista				identificador de el transportista
id_empresa						identificador de la empresa
placa							placa del camion
fecha							fecha en que se genera la guia de carga	
status							status de la guia de carga
id_user							id_usuario creador
		

guia_carga_det  tabla que contiene los  detalles de los renglones es decir las notas de carga en profit

id, id_guia, fact_num, tot_bruto,  co_cli,  descrip, fec_emis, co_ven, co_tran, tot_neto, cli_des, scaneo

id								identificacod unico
id_guia							identificador de la guia
fact_num						nunmero de la factura de nota de entrega
tot_bruto						total bruto de la nota de entrega
co_cli							codigo del cliente
descrip							descripcion de la nota de entrega
fec_emis						fecha de emision de la nota de entrega profit
co_ven							codigo del vendedor
co_tran							codigo trasportista profit
tot_neto						total neto de la nota de entrega
cli_des							descriocion del cliente

guia_carga_det_reng  			tabla que contiene la onformacion del renglon detalle de la nota de entrega de  profit

 id, id_guia_det, pediente, co_art, total_art, co_alma, reng_num, fact_num, prec_vta, porc_desc, reng_neto, art_des 

id								identificador
id_guia_det						identificador de la guia detalle
pediente						pendiente de la informacion del renglon de pedido en profit
co_art							codigo de articulo en profit
total_art						total de articulos solicitados en el control de carga
co_alma							codigo del almacen de profit
reng_num						numero del renglon en profit
fact_num						factura numero de la nota de entrega eb profit
prec_vta						precio de venta en la nota de entrega
reng_neto						neto del renglon
art_des							descripcion del articulo 


guia_carga_det_reng_sel id, id_gcdr, serial, status


id
id_gcdr
serial
status

*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////SECCION DE BUSQUEDAS///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	//busqueda de datos de la guia de scaneo
	function getGCDRSelCon($id_gcdr='',$status=''){
		$sQuery="SELECT COUNT(id) AS conteo 
					FROM guia_carga_det_reng_sel 
					WHERE id_gcdr='$id_gcdr'  ";	
		if($status) {	$sQuery.=" AND status='$status' ";	}			
		//echo $sQuery;
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$row=mssql_fetch_array($result);
		return($row['conteo']);
	}
	
	//busqueda de datos de la guia de scaneo
	function getGCDRSelAll($id_gcdr='',$serial=''){
		$sQuery="SELECT serial FROM guia_carga_det_reng_sel WHERE status=1 ";	
		if($id_gcdr)	{ $sQuery.=" AND id_gcdr = '$id_gcdr' ";	}
		if($serial)	{ $sQuery.=" AND serial = '$serial' ";	}
		$sQuery.=" ORDER BY serial ";
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

	//get lista de clientes  que van en al guia id, id_guia, fact_num, tot_bruto,  co_cli,  descrip, fec_emis, co_ven, co_tran, tot_neto, cli_des 
	function getListGCDCli($id_guia='',$id=''){
		$sQuery="SELECT co_cli,cli_des AS cliente FROM guia_carga_det WHERE 1=1 ";	
		if($id_guia)	{ $sQuery.=" AND id_guia = '$id_guia' ";	}
		if($id)	{ $sQuery.=" AND id = '$id' ";	}
		$sQuery.=" GROUP BY co_cli,cli_des ";
		$sQuery.=" ORDER BY co_cli ";
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

	//get scaneo de la guia de carga
	function getGCDScan($id){
		$sQuery="SELECT scaneo FROM guia_carga_det WHERE 1=1 ";	
		if($id)	{ $sQuery.=" AND id = '$id' ";	}
		
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



//busqueda de guias con detalles
	function getGCInf($id='',$rango='')
	{
	    $sQuery="SELECT 
		guia_carga.id, guia_carga.id_por_sucursal, guia_carga.id_sucursal, guia_carga.id_empresa, guia_carga.placa,guia_carga.fecha , 
					transportista.nombre as t_nombre , transportista.apellido as t_apellido,
					empresa.descripcion as e_descripcion
					FROM guia_carga 
					Inner Join transportista ON guia_carga.id_transportista = transportista.id
					Inner Join empresa ON guia_carga.id_empresa = empresa.id
					WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND guia_carga.id = '$id' ";	}
		if($rango) {	$sQuery.=$rango;	}
		$sQuery.=" ORDER BY guia_carga.id ";
	 // echo ($sQuery);
		$result=mssql_query($sQuery) or die (mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
	}
	
//guia de carga detalles 
	function getGCDInf($id_guia='',$co_cli='',$id=''){
		$sQuery="SELECT  id, id_guia, fact_num, tot_bruto,  co_cli,  descrip, fec_emis, tot_neto, cli_des AS cliente   FROM guia_carga_det WHERE 1 = 1";
		if($id_guia) {	$sQuery.=" AND id_guia = '$id_guia' ";	}
		if($co_cli)	{ $sQuery.=" AND co_cli = '$co_cli' ";	}
		if($id)	{ $sQuery.=" AND id = '$id' ";	}
		$sQuery.=" ORDER BY id_factura DESC ";
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

//buscamos lod datos de lod renglones de la nota de entrega  id, id_guia_det, pediente, co_art, total_art, co_alma, reng_num, fact_num, prec_vta, porc_desc, reng_neto, art_des 
	function get_GCDRInf($id_guia_det){
		$sQuery="SELECT *
					FROM 
					guia_carga_det_reng WHERE 1 = '1'  ";
		
			if($id_guia_det) {	$sQuery.=" AND  id_guia_det IN ($id_guia_det) ";	}
		$sQuery.=" ORDER BY id ";	
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

//buscamos datos basicos del detalle rengloin
	function get_GCDRBas($id_guia_det){
		$sQuery="SELECT *
					FROM guia_carga_det_reng WHERE 1 = '1'  ";
		
			if($id_guia_det) {	$sQuery.=" AND  id_guia_det = $id_guia_det ";	}
		
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


	



//busqueda de guia de carga	
	function get_guia_carga($id='',$id_por_sucursal='',$id_sucursal=''  ){
		$sQuery="SELECT * FROM guia_carga WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_por_sucursal) {	$sQuery.="AND id_por_sucursal = '$id_por_sucursal' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		
	//	echo($sQuery);
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
	
//busqueda de guia de carga	 detalle
	function get_guia_carga_det($id='',$id_guia='',$fact_num='',$co_cli='',$co_ven='',$co_tran=''){
		$sQuery="SELECT * FROM guia_carga_det WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_guia) {	$sQuery.="AND id_guia = '$id_guia' ";	}
		if($fact_num) {	$sQuery.="AND fact_num = '$fact_num' ";	}
		if($co_cli) {	$sQuery.="AND co_cli = '$co_cli' ";	}
		if($co_ven) {	$sQuery.="AND co_ven = '$co_ven' ";	}
		if($co_tran) {	$sQuery.="AND co_tran = '$co_tran' ";	}
		
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
	
	
//buscamos el ultimo id por sucursal
	function get_guia_carga_id_sucursal($id_sucursal=''){
	
		$sQuery="SELECT * FROM guia_carga WHERE 1 = 1";
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id_por_sucursal DESC ";
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		
		if($res_array[0]['id_por_sucursal'])	
		{	
			$new_id_por_sucursal=$res_array[0]['id_por_sucursal'];
			$new_id_por_sucursal++;
		}
		else
		{	
		
			$new_id_por_sucursal=1;
		}
		
		return($new_id_por_sucursal);
			
	}
	
//buscamos el ultimo renglon de una determinada guia de carga
//buscamos el ultimo id por sucursal
	function get_reng_guia_carga($id_guia_carga=''){
	
		$sQuery="SELECT * FROM guia_carga_reng WHERE 1 = 1";
		if($id_guia_carga) {	$sQuery.=" AND id_guia_carga = '$id_guia_carga' ";	}
		$sQuery.=" ORDER BY reng_num DESC ";
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		
		if($res_array[0]['reng_num'])	
		{	
			$new_reng_num=$res_array[0]['reng_num'];
		}
		
		return($new_reng_num);
			
	}
	
	
	
	//busco el indice del nuevo id por sucursal de la guia de carga
	function get_nips_guia($id_sucursal=''){
	
		$sQuery="SELECT id_por_sucursal FROM guia_carga WHERE 1 = 1";
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id_por_sucursal DESC ";
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		
		if($res_array[0]['id_por_sucursal']){	$new_ips=$res_array[0]['id_por_sucursal']+1;   	}
		else {	$new_ips=1; }
		
		return($new_ips);
			
	}
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////SECCION DE INSERCIONES///////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
//inserccion de guia de carga	
	function add_guia_carga($id_por_sucursal='', $id_sucursal='', $id_transportista='', $id_empresa='', $placa='', $fecha='', $status='', $id_user='')
	{			
		$val_id_control=$this->get_guia_carga('',$id_por_sucursal,$id_sucursal);
		if($val_id_control){	$id_por_sucursal++;			}//si alguien registro antes el mismo id se crea uno nuevo
		
		$query = "INSERT INTO guia_carga (id_por_sucursal, id_sucursal, id_transportista,  id_empresa, placa, fecha, status, id_user) 
		VALUES ('$id_por_sucursal','$id_sucursal','$id_transportista','$id_empresa','$placa','$fecha','$status','$id_user')";
		
		$result=mssql_query($query);
		$val_id_control=$this->get_guia_carga('',$id_por_sucursal,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
	}
	
	
	//insercion de guia_carga_det
	function add_guia_carga_det($id_guia='', $fact_num='', $tot_bruto='', $co_cli='', $descrip='', $fec_emis='', $co_ven='', $co_tran='', $tot_neto='', $cli_des='')
	{			
		$query = "INSERT INTO guia_carga_det (id_guia, fact_num, tot_bruto,  co_cli,  descrip, fec_emis, co_ven, co_tran, tot_neto, cli_des) 
		VALUES ('$id_guia','$fact_num','$tot_bruto','$co_cli','$descrip','$fec_emis','$co_ven','$co_tran','$tot_neto','$cli_des')";
		
		$result=mssql_query($query);
		//busco el id de esta
		$val_id_control=$this->get_guia_carga_det('',$id_guia,$fact_num,$co_cli,$co_ven,$co_tran);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
	}

	
	//insercion de guia_carga_det_reng
	function add_guia_carga_det_reng($id_guia_det='', $pediente='', $co_art='', $total_art='', $co_alma='', $reng_num='', $fact_num='', $prec_vta='', $porc_desc='', $reng_neto='', $art_des ='')
	{			
		$query = "INSERT INTO guia_carga_det_reng (id_guia_det, pediente, co_art, total_art, co_alma, reng_num, fact_num, prec_vta, porc_desc, reng_neto, art_des ) 
		VALUES ('$id_guia_det', '$pediente', '$co_art', '$total_art', '$co_alma', '$reng_num', '$fact_num', '$prec_vta', '$porc_desc', '$reng_neto', '$art_des')";
		//echo $query;
		$result=mssql_query($query);
		
		return($result);
	}	
	
	//insercion de guia_carga_det_reng
	function add_guia_carga_det_reng_sel($id_gcdr='', $serial='', $status='')
	{			
		$query = "INSERT INTO guia_carga_det_reng_sel (id_gcdr, serial, status) 
		VALUES ('$id_gcdr', '$serial', '$status')";
		echo $query;
		$result=mssql_query($query);
		
		return($result);
	}	
	

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////SECCION DE ACTUALIZACIONES/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	function update_guia_carga_transporte($id,$id_transportista,$id_empresa,$placa)
	{
		$query = "UPDATE guia_carga SET id_transportista='$id_transportista', id_empresa='$id_empresa', placa='$placa' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	//EDITAMOS LA INFORMACION DE TRANSPORTE
	function udpGuiaTransData($id,$id_transportista,$id_empresa,$placa)
	{
		$query = "UPDATE guia_carga SET id_transportista='$id_transportista' , id_empresa='$id_empresa', placa='$placa'
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	//EDITAMOS LA INFORMACION SCANEADA
	function udpGCDScan($id,$scaneo)
	{
		$query = "UPDATE guia_carga_det SET scaneo='$scaneo' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	//EDITAMOS LA INFORMACION SCANEADA
	function udpGCDRSobrecarga($id,$sobrecarga)
	{
		$query = "UPDATE guia_carga_det_reng SET sobrecarga='$sobrecarga' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////SECCION DE ELIMINACIONES///////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	

	
}
?>
