<?php 
class class_transportista {

/*
TABLA transportista
CAMPOS 	
id				Identificador de transportista
rif				Rif o cedula se usaran solo cedulas
nombre			nombre del tranportisa
apellido		apelliido del transportista
telefono		Telefono
id_empresa		Id de la empresa
telefono2		telefono 2
direccion		direccion
status			status de la empresa si esta eliminada i diferentes estatus dode esta pueda estar como por 			
				aprobar aprobada o demas: 1 activa	0 eliminada
id_sucursal		identificador de la sucursal
*/


	function get_transportista($id='',$rif='',$nombre='',$apellido='',$id_empresa='',$direccion='',$status='',$id_sucursal=''){
		$sQuery="SELECT * FROM transportista WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($rif) {	$sQuery.="AND rif = '$rif' ";	}
		if($nombre) {	$sQuery.="AND nombre = '$nombre' ";	}
		if($apellido) {	$sQuery.="AND apellido = '$apellido' ";	}
		if($id_empresa) {	$sQuery.="AND id_empresa = '$id_empresa' ";	}
		if($direccion) {	$sQuery.="AND direccion = '$direccion' ";	}
		if($status) {	$sQuery.="AND status in($status) ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}// se comento por solicitud de diolennis para q punto fijo pudiera ver los transportistas
	  
	   
	   $sQuery.="ORDER BY apellido, nombre ASC ";

	//	echo $sQuery;
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
	
	function get_transportista_rif($id=''){
		$sQuery="SELECT rif FROM transportista WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
			
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
	
	function get_list_transportista($id='',$id_empresa='',$id_sucursal='',$status=''){
		$sQuery="SELECT
				transportista.*,
				empresa.descripcion AS empresa
				FROM
				transportista
				Inner Join empresa ON transportista.id_empresa = empresa.id
				WHERE
					1 = 1
				";
	   if($id) {	$sQuery.="AND transportista.id = '$id' ";	}
	   if($id_empresa) {	$sQuery.="AND transportista.id_empresa = '$id_empresa' ";	}
	   if($id_sucursal) {	$sQuery.="AND transportista.id_sucursal = '$id_sucursal' ";	}
	   if($status){	$sQuery.="AND transportista.status = '$status'"; 	}	else	{	$sQuery.="AND transportista.status <> 0 ";	}
	   
	   $sQuery.="ORDER BY empresa.descripcion, transportista.apellido, transportista.nombre ASC ";
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
	
	function add_transportista($rif='',$nombre='',$apellido='',$telefono='',$id_empresa='',$telefono2='',$direccion='',$status='',$id_sucursal='')
	{
		$query = "INSERT INTO transportista (rif,nombre,apellido,telefono,id_empresa,telefono2,direccion,status,id_sucursal) 
				  VALUES ('$rif','$nombre','$apellido','$telefono','$id_empresa','$telefono2','$direccion','$status','$id_sucursal')";
		$result=mssql_query($query);
		$val_id_control=$this->get_transportista('',$rif,$nombre,$apellido,$id_empresa,$direccion,$status,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
		
	}
	
	
	function update_transportista($id='',$rif='',$nombre='',$apellido='',$telefono='',$id_empresa='',$telefono2='',$direccion='',$status='')
	{
		$query = "UPDATE transportista SET 
							rif='$rif',nombre='$nombre',apellido='$apellido',telefono='$telefono', id_empresa='$id_empresa' , telefono2='$telefono2',direccion='$direccion' , status='$status'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	function change_status_transportista($rif,$status)
	{
		$query = "UPDATE transportista SET status='$status' WHERE rif = '$rif'";
		
		$result=mssql_query($query);
	}
	
	function delete_transportista($id)
	{
		$query = "UPDATE transportista SET status=0 WHERE id = '$id'";
		
		$result=mssql_query($query);
	}
	
	function delete_def_transportista($id)
	{
		$query = "DELETE FROM  transportista WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
	
}
?>
