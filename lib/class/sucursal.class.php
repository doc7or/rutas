<?php 
class class_sucursal {

/*
TABLA sucursal
CAMPOS 	

id						identificador de la sucursal
descripcion				nombre de la sucursal
ciudad					id_de la ciudad o zona
direccion				direccion de la sucursal
id_sucursal_profit		identificador de la sucursal en profit
prefijo					prefijo q usan las facturas en las sucursales lb lm etc
valor_num_prefijo		valor numerico de el prefijo
rif						rif de la sucursal
telefono				telefono
telefono2				segundo telefono
responsable				responsable de la sucursal
status					estatus de si esta eliminado activa o demas estaus q se vallan creando
naturaleza				naturaeza
tipo					QUE USARA DE RUTA
detalle					nombre largo para las nomina
cuenta					numero de cuenta de a empresa


*/


	function get_sucursal($id='',$descripcion='',$ciudad='',$rif='',$responsable='',$status=''){
		$sQuery="SELECT * FROM sucursal WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($descripcion) {	$sQuery.="AND descripcion = '$descripcion' ";}
		if($ciudad) {	$sQuery.="AND ciudad = '$ciudad' ";}
		if($rif) {	$sQuery.="AND rif = '$rif' ";}
		if($responsable) {	$sQuery.="AND responsable = '$responsable' ";}
		if($status) {	$sQuery.="AND status = '$status' ";}
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
	
	function get_list_sucursal($id='',$status=''){
		$sQuery="SELECT
				sucursal.* ,
				zona.descripcion AS zona
				FROM
				sucursal
				Inner Join zona ON sucursal.ciudad = zona.id
				WHERE
					1 = 1
				";
	   if($id) {	$sQuery.="AND sucursal.id = '$id' ";	}
	   if($status){	$sQuery.="AND sucursal.status = '$status'"; 	}	else	{	$sQuery.="AND sucursal.status <> 0 ";	}
	   $sQuery.="ORDER BY
					sucursal.descripcion ASC ";

	//	echo $sQuery ;
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
	
	function add_sucursal($descripcion='',$ciudad='',$direccion='',$rif='',$telefono='',$telefono2='',$responsable='',$status='',$naturaleza='')
	{
		$query = "INSERT INTO sucursal (descripcion,ciudad,direccion,rif,telefono,telefono2,responsable,status,naturaleza) 
				  VALUES ('$descripcion','$ciudad','$direccion','$rif','$telefono','$telefono2','$responsable','$status','$naturaleza')";
		$result=mssql_query($query);
		$val_id_control=$this->get_sucursal('',$descripcion,$ciudad,$rif,$responsable,1);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
	}
	
	
	function update_sucursal($id='',$descripcion='',$ciudad='',$direccion='',$rif='',$telefono='',$telefono2='',$responsable='')
	{
		$query = "UPDATE sucursal SET descripcion='$descripcion', ciudad='$ciudad', direccion='$direccion', rif='$rif', telefono='$telefono', telefono2='$telefono2', responsable='$responsable' 
				  WHERE  id = '$id'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	
	function delete_sucursal($id)
	{
		$query = "UPDATE sucursal SET status=0 WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
	function delete_def_sucursal($id)
	{
		$query = "DELETE FROM  sucursal WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
