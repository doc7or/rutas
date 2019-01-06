<?php 
class class_control_salida {
/*

TABLA control_salida
CAMPOS 

id,id_por_sucursal,id_sucursal,id_transportista,placa,fecha,fecha_salida,status,caleta,caleta_especial,monto,desvio,ruta,desvio_monto,devolucion_monto,adelanto		
observaciones,fecha_liquidacion,id_escolta,escolta_monto,caja_adelanto,caja_caleta,monto_facturas,tipo,observaciones_post	

id					identificador del control
id_por_sucursal		identificador del control para una sucursal enenpecifico
id_sucursal			identificador de la sucursal
id_transportista	identificador del transportista
placa				placa del vehiculo
fecha				fecha de creacion del control
fecha_salida		fecha de salida del control
status				esta determina si esta anulada o no este control.  1 si esta activa , 2 anulada,	3	liquidada,	4	Pagada
caleta				valor de la caleta del viaje
caleta_especial		valor de la caleta especial
monto				monto del viaje segun la ruta especificada
desvio				zona de desvio
ruta				ruta del viaje
desvio_monto		monto del desvio
desvioc_monto		monto del desvio corto
devolucion_monto	monto de la devoluvion
adelanto			momnto del adelanto
observaciones		observacion
fecha_liquidacion	fecha de liquidacion de el control
id_escolta			iddentificador del escolta
escolta_monto		monto a pagar a escolta
caja_adelanto		monto pagado de adelanto a la salida esto se paga con caja y se usa para verificar la caja en posterior 
caja_caleta			monto pagado de caleta a la salida esto se paga con caja y se usa para verificar la caja en posterior 
monto_facturas		monto en facturas
tipo				indica si la guia es una guiia normal de transporte 1, un traslado entre sucursales 2, o una para nota de entrega 3
especial			valor del especial de la empresa en el momento dado de la guia osea al momento de su realizacion
reparto_cantidad	cantidad de repartos
reparto_monto		monto de repartos

/////campos de edicion q suman al costo del control
observaciones_post	las observaciones posteriores al envio, las cuales se complementaran con los 
					reguistros de la tabla de control_salida_detalle_post
					
//posteriores a la fecha de creacion
id_empresa		este identoficador indica la empresa a la q pertenece la guia en el momento					
		
		
		

*/
	//BUSQUEDA DE DATOS PARA LA WEB id_por_sucursal,placa,placa,fecha_salida,monto_facturas,id_por_sucursal_new,id_control_salida,ruta
	function get_control_salida_trans_placa($placa='',$id_sucursal=''){
		//necesaroios a buscar top(10)
		$sQuery="SELECT DISTINCT id_transportista 
		FROM control_salida WHERE 1=1 ";
		if($placa) {	$sQuery.="AND placa = '$placa' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		
 	//	echo ($sQuery);
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
		
	
	
	//BUSQUEDA DE DATOS PARA LA WEB id_por_sucursal,placa,placa,fecha_salida,monto_facturas,id_por_sucursal_new,id_control_salida,ruta
	function get_control_salida_web($id_sucursal){
		//necesaroios a buscar top(10)
		$sQuery="SELECT  id_por_sucursal, placa, placa, fecha_salida,monto_facturas,id_por_sucursal_new,id ,ruta ,CONVERT(VARCHAR, fecha, 120) AS fecha 
		FROM control_salida WHERE status_web = '1'  AND status <> '2'";
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id ";
 	//	echo ($sQuery);
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
		
	
	//BUSQUEDA DE DATOS EN ESPECIFICO DE LA GUAIE EN ESTE CASO EL ID, ID_SUCURSAL, LA PLACA
	function get_control_salida_mov(){
		$sQuery="SELECT id, id_sucursal, placa FROM control_salida WHERE placa > 'NULL' ";
	
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
		

	function get_control_salida($id='',$id_por_sucursal='',$id_sucursal='',  $tipo='', $id_por_sucursal_new=''){
		$sQuery="SELECT control_salida.*,empresa.descripcion,transportista.nombre,transportista.apellido,transportista.rif FROM control_salida 
				INNER JOIN empresa ON control_salida.id_empresa=empresa.id
				INNER JOIN transportista ON control_salida.id_transportista=transportista.id
				WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND control_salida.id = '$id' ";	}
		if($id_por_sucursal) {	$sQuery.="AND control_salida.id_por_sucursal = '$id_por_sucursal' ";	}
		if($id_sucursal) {	$sQuery.="AND control_salida.id_sucursal = '$id_sucursal' ";	}
		if($id_por_sucursal_new) {	$sQuery.="AND control_salida.id_por_sucursal_new = '$id_por_sucursal_new' ";	}
		if($tipo)	{	$sQuery.="AND tipo = '$tipo' ";	}
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
	//PARA EL LISTADO NORMAL DE GUIAS DIARIAS
	function get_control_salida_list_day($id='',$id_sucursal='',$tipo='',$status='',$rango='',$id_por_sucursal='',  $tipo='',$status='',$ruta=''){
		$sQuery="SELECT id,id_por_sucursal,id_por_sucursal_new,id_sucursal,monto, ruta,fecha_salida,status,tipo FROM control_salida WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		if($tipo)	{	$sQuery.="AND tipo = '$tipo' ";	}
		if($status)	{	$sQuery.="AND status = '$status' ";	}
		if($rango)	{	$sQuery.=$rango;	}
		if($id_por_sucursal)	{	$sQuery.=" AND id_por_sucursal = '$id_por_sucursal' ";	}
		if($tipo)	{	$sQuery.=" AND tipo = '$tipo' ";	}
		if($status)	{	$sQuery.=" AND status = '$status' ";	}
		if($ruta)	{	$sQuery.=$ruta;	}
		$sQuery.=" ORDER BY id_por_sucursal DESC ";
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


	//PARA EL LISTADO NORMAL DE GUIAS
	function get_control_salida_list($id='',$id_sucursal='',$tipo='',$status='', $id_por_sucursal='', $rango='',$placa='',		$id_transportista='',$id_empresa='',$ruta='' )
	{
	    $sQuery="SELECT * FROM control_salida WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		if($tipo)	{	$sQuery.="AND tipo = '$tipo' ";	}
		if($status)	{	$sQuery.="AND status = '$status' ";	}
		if($id_por_sucursal) {	$sQuery.="AND id_por_sucursal = '$id_por_sucursal' ";	}
		if($rango)	{	$sQuery.=$rango;	}
		if($placa) {	$sQuery.="AND placa = '$placa' ";	}
		if($id_transportista) {	$sQuery.="AND id_transportista = '$id_transportista' ";	}
		if($id_empresa) {	$sQuery.="AND id_empresa = '$id_empresa' ";	}
		if($ruta)	{	$sQuery.=$ruta;	}
		$sQuery.="ORDER BY id_por_sucursal DESC ";
	   //echo($sQuery);
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
	
	//PARA EL FORMATO DE REPORTE DE GUIAS
	function get_control_salida_list_xls($id='',$id_sucursal='',$tipo='',$status='', $id_por_sucursal='', $rango='',$placa='',		$id_transportista='',$id_empresa='',$ruta='' ){
		$sQuery="SELECT 
					control_salida.*,
					transportista.id as t_id,  transportista.nombre as t_nombre , transportista.apellido as t_apellido
				FROM control_salida
					Inner Join transportista ON control_salida.id_transportista = transportista.id
				WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND control_salida.id = '$id' ";	}
		if($id_sucursal) {	$sQuery.="AND control_salida.id_sucursal = '$id_sucursal' ";	}
		if($tipo)	{	$sQuery.="AND control_salida.tipo = '$tipo' ";	}
		if($status)	{	$sQuery.="AND control_salida.status = '$status' ";	}
		if($id_por_sucursal) {	$sQuery.="AND control_salida.id_por_sucursal = '$id_por_sucursal' ";	}
		if($rango)	{	$sQuery.=$rango;	}
		if($placa) {	$sQuery.="AND control_salida.placa = '$placa' ";	}
		if($id_transportista) {	$sQuery.="AND control_salida.id_transportista = '$id_transportista' ";	}
		if($id_empresa) {	$sQuery.="AND control_salida.id_empresa = '$id_empresa' ";	}
		if($ruta)	{	$sQuery.=$ruta;	}
		
		$sQuery.="ORDER BY id_por_sucursal DESC ";
	
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
	
	//PARA LA APROBACION DE NOMINA
	function list_aprov_nomina($id='',$id_sucursal='',$tipo='',$status='',$fecha=''){
		$sQuery="SELECT * FROM control_salida WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
		if($tipo)	{	$sQuery.="AND tipo = '$tipo' ";	}
		if($status)	{	$sQuery.="AND status = '$status' ";	}
		if($fecha)	{	$sQuery.="AND fecha <= '$fecha'  ";	}
		
		$sQuery.="ORDER BY id_por_sucursal DESC ";
		//echo $sQuery;
	//	die($sQuery);
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
	
	
	
	//datos de una guia, como empresa q  no se tienen en la misma
	function get_all_data_gcs($id='',$id_transportista='',$id_empresa=''){
		$sQuery="SELECT 
				control_salida.*,
				empresa.id as empresa_id, empresa.rif as empresa_rif, empresa.telefono as empresa_telefono, empresa.responsable as empresa_responsable, empresa.naturaleza as empresa_naturaleza, empresa.adelanto as empresa_adelanto, empresa.especial as empresa_especial,  empresa.descripcion as empresa_descripcion,
				transportista.id as transportista_id, transportista.rif as transportista_rif, transportista.telefono as transportista_telefono, transportista.nombre as transportista_nombre , transportista.apellido as transportista_apellido
				FROM control_salida
				Inner Join transportista ON control_salida.id_transportista = transportista.id
				Inner Join empresa ON control_salida.id_empresa = empresa.id
				
				WHERE 1=1";
		if($id) {	$sQuery.=" AND control_salida.id in($id) ";	}
		if($id_transportista) {	$sQuery.=" AND control_salida.id_transportista = '$id_transportista' ";	}
		if($id_empresa) {	$sQuery.=" AND empresa.id = '$id_empresa' ";	}
		$sQuery.=" ORDER BY empresa.naturaleza,empresa.descripcion,transportista.apellido,transportista.nombre,control_salida.id_por_sucursal DESC ";
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

	//PROPIA PARA EL LISTADO DE EL SEGURO
	function get_seguro($mes='',$anio='',$id_sucursal=''){
		$sQuery="SELECT 
				control_salida.*,
				transportista.id as t_id,  transportista.nombre as t_nombre , transportista.apellido as t_apellido
				FROM control_salida
				Inner Join transportista ON control_salida.id_transportista = transportista.id
				
				
				WHERE control_salida.tipo=1 AND control_salida.status<>'2' ";
		
		if($mes) {	$sQuery.=" AND month(control_salida.fecha)='$mes' ";	}
		if($anio) {	$sQuery.=" AND year(control_salida.fecha)='$anio' ";	}
		if($id_sucursal) {	$sQuery.=" AND control_salida.id_sucursal = '$id_sucursal' ";	}
		
		$sQuery.=" ORDER BY control_salida.id DESC ";
		//echo ($sQuery);
		
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
        
        	function get_seguro_1($mes='',$anio='',$id_sucursal=''){
		$sQuery="SELECT 
				control_salida.*,
				transportista.id as t_id,  transportista.nombre as t_nombre , transportista.apellido as t_apellido
				FROM control_salida
				Inner Join transportista ON control_salida.id_transportista = transportista.id
				
				
				WHERE control_salida.tipo=3 AND control_salida.status<>'2' ";
		
		if($mes) {	$sQuery.=" AND month(control_salida.fecha)='$mes' ";	}
		if($anio) {	$sQuery.=" AND year(control_salida.fecha)='$anio' ";	}
		if($id_sucursal) {	$sQuery.=" AND control_salida.id_sucursal = '$id_sucursal' ";	}
		
		$sQuery.=" ORDER BY control_salida.id DESC ";
		//echo ($sQuery);
		
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
	
	function get_control_salida_id_sucursal($id_sucursal='',$limite=0){
                                       if ($limite!=0)
                                           $consul="top 1";
                                       else $consul='';
		$sQuery="SELECT TOP 1 $consul * FROM control_salida WHERE 1 = 1";
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id_por_sucursal DESC ";
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
        //echo $sQuery;
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
	
	//busco el indice del nuevo id por sucursal new 
	function get_control_salida_id_sucursal_new($id_sucursal='',$limite=0){
	 if ($limite!=0)
                                           $consul="top 1";
                                       else $consul='';
		$sQuery="SELECT TOP 1 $consul * FROM control_salida WHERE 1 = 1";
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal' ";	}
		$sQuery.=" ORDER BY id_por_sucursal_new DESC ";
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		
		if($res_array[0]['id_por_sucursal_new'])	
		{	
			$new_id_por_sucursal_new=$res_array[0]['id_por_sucursal_new'];
			$new_id_por_sucursal_new++;
		}
		else
		{	
		
			$new_id_por_sucursal_new=1;
		}
		
		return($new_id_por_sucursal_new);
			
	}
	
	
	
	function add_control_salida($id_por_sucursal='',$id_sucursal='',$id_transportista='',$placa='',$fecha='',$fecha_salida='',$status='',$caleta='',$caleta_especial='',$monto='',$ruta='',$desvio='',$desvio_monto='',$desvioc_monto='',$devolucion_monto='',$adelanto='',$observaciones='',$id_escolta='',$escolta_monto='',$monto_facturas='',$caja_caleta='',$caja_adelanto='',$tipo='',$id_empresa='',$especial='',$id_por_sucursal_new='',$status_web='',$reparto_cantidad='',$reparto_monto='',$repartol_cantidad='',$repartol_monto='')
	{	 
		$val_id_control=$this->get_control_salida('',$id_por_sucursal,$id_sucursal,'',$id_por_sucursal_new);
		if($val_id_control){	$id_por_sucursal++;		$id_por_sucursal_new++;	}//si alguien registro antes el mismo id se crea uno nuevo
		
		$query = "INSERT INTO control_salida (id_por_sucursal,id_sucursal,id_transportista,placa,fecha,status,caleta,caleta_especial,monto,ruta,desvio,desvio_monto,desvioc_monto,devolucion_monto,adelanto,observaciones,id_escolta,escolta_monto,monto_facturas,caja_caleta,caja_adelanto,tipo,id_empresa,especial,id_por_sucursal_new,status_web,reparto_cantidad,reparto_monto,repartol_cantidad,repartol_monto) 
		VALUES ('$id_por_sucursal','$id_sucursal','$id_transportista','$placa','$fecha','$status','$caleta','$caleta_especial','$monto','$ruta','$desvio','$desvio_monto','$desvioc_monto','$devolucion_monto','$adelanto','$observaciones','$id_escolta','$escolta_monto','$monto_facturas','$caja_caleta','$caja_adelanto','$tipo','$id_empresa','$especial','$id_por_sucursal_new','$status_web','$reparto_cantidad','$reparto_monto','$repartol_cantidad','$repartol_monto')";
		
		//,fecha_salida,'$fecha_salida'
	
		$result=mssql_query($query);
		$val_id_control=$this->get_control_salida('',$id_por_sucursal,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		$edit_control=$this->update_control_salida_fech_salida($new_id,$fecha_salida);
		return($new_id);
	}
	
	function update_control_salida_fech_salida($id,$fecha_salida)
	{
		$query = "UPDATE control_salida SET fecha_salida='$fecha_salida' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function update_control_salida($id,$observaciones_post)
	{
		$query = "UPDATE control_salida SET observaciones_post='$observaciones_post'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	function anular_control_salida($id)
	{
		$query = "UPDATE control_salida SET status='2' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	function change_status_control_salida($id='',$status='')
	{
		$query = "UPDATE control_salida SET status='$status' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	
	//actualizamos el status web
	function change_status_control_salida_web($id='',$status_web='')
	{
		$query = "UPDATE control_salida SET status_web='$status_web' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	

	
}
?>
