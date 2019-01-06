<?php 
class class_escolta {

/*
TABLA escolta
CAMPOS 	
id				Identificador de escolta
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


	function get_escolta($id='',$rif='',$nombre='',$apellido='',$id_empresa='',$direccion='',$status='',$id_sucursal=''){
		$sQuery="SELECT * FROM escolta WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($rif) {	$sQuery.="AND rif = '$rif' ";	}
		if($nombre) {	$sQuery.="AND nombre = '$nombre' ";	}
		if($apellido) {	$sQuery.="AND apellido = '$apellido' ";	}
		if($id_empresa) {	$sQuery.="AND id_empresa = '$id_empresa' ";	}
		if($direccion) {	$sQuery.="AND direccion = '$direccion' ";	}
		if($status) {	$sQuery.="AND status = '$status' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";	}
	  
	   
	   $sQuery.="ORDER BY apellido, nombre ASC ";

		
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
	
	function get_list_escolta($id='',$id_empresa='',$id_sucursal='',$status=''){
		$sQuery="SELECT
				escolta.id,escolta.rif,escolta.nombre,escolta.apellido,escolta.telefono,escolta.id_empresa,
				empresa.descripcion AS empresa
				FROM
				escolta
				Inner Join empresa ON escolta.id_empresa = empresa.id
				WHERE
					1 = 1
				";
	   if($id) {	$sQuery.="AND escolta.id = '$id' ";	}
	   if($id_empresa) {	$sQuery.="AND escolta.id_empresa = '$id_empresa' ";	}
	   if($id_sucursal) {	$sQuery.="AND escolta.id_sucursal = '$id_sucursal' ";	}
	   if($status){	$sQuery.="AND escolta.status = '$status'"; 	}	else	{	$sQuery.="AND escolta.status <> 0";	}
	   
	   $sQuery.="ORDER BY empresa.descripcion, escolta.apellido, escolta.nombre ASC ";
//		die($sQuery);

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
	
	function add_escolta($rif='',$nombre='',$apellido='',$telefono='',$id_empresa='',$telefono2='',$direccion='',$status='',$id_sucursal='')
	{
		$query = "INSERT INTO escolta (rif,nombre,apellido,telefono,id_empresa,telefono2,direccion,status,id_sucursal) 
				  VALUES ('$rif','$nombre','$apellido','$telefono','$id_empresa','$telefono2','$direccion','$status','$id_sucursal')";
		$result=mssql_query($query);
		$val_id_control=$this->get_escolta('',$rif,$nombre,$apellido,$id_empresa,$direccion,$status,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
		
	}
	
	
	function update_escolta($id='',$rif='',$nombre='',$apellido='',$telefono='',$id_empresa='',$telefono2='',$direccion='')
	{
		$query = "UPDATE escolta SET 
							rif='$rif',nombre='$nombre',apellido='$apellido',telefono='$telefono', id_empresa='$id_empresa' , telefono2='$telefono2',direccion='$direccion' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function delete_escolta($id)
	{
		$query = "UPDATE escolta SET status=0 WHERE id = '$id'";
		
		$result=mssql_query($query);
	}
	
	function delete_def_escolta($id)
	{
		$query = "DELETE FROM  escolta WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
	
}
?>
