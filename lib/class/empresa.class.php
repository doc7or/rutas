<?php 
class class_empresa {

/*
TABLA empresa
CAMPOS 	
id						identificador
descripcion				descripcion
direccion				direccion
rif						rif
telefono				telefono 1
responsable				responsable de la empresa
telefono2				telefono 2
naturaleza				naturaleza juridica  o  natural
tipo					tipo empresa transporte o escolta
adelanto				monto de adelanto por la empresa
id_sucursal				identificador de la sucursal
especial				si la empresa recivira un aumento o bono adiccional
status					status de la empresa si esta eliminada i diferentes estatus dode esta pueda estar como por 			
						aprobar aprobada o demas: 1 activa	0 eliminada


2	empresa
16	Nuevo
17	Edicion
18	Consulta
19	Eiminacion

*/


	function get_empresa($id='',$naturaleza='',$tipo='', $id_sucursal='',$descuento='',$especial='',$rif='',$status='',$descripcion=''){
		$sQuery="SELECT * FROM empresa WHERE 1=1 ";
		if($id) {	$sQuery.=" AND id = '$id' ";	}
		if($tipo) {	$sQuery.=" AND tipo = '$tipo' ";}
		if($naturaleza) {	$sQuery.=" AND naturaleza in($naturaleza) ";}
		if($id_sucursal) {	$sQuery.=" AND id_sucursal = '$id_sucursal'"; 	}
		if($descuento) {	$sQuery.=" AND descuento = '$descuento'"; 	}
		if($especial) {	$sQuery.=" AND especial = '$especial'"; 	}
		if($rif) {	$sQuery.=" AND rif = '$rif'"; 	}
		if($descripcion) {	$sQuery.=" AND descripcion = '$descripcion'"; 	}
		if($status){	$sQuery.=" AND status = '$status'"; 	}	//else	{	$sQuery.="AND status <> 0";	}
		$sQuery.=" ORDER BY descripcion ";
		//echo $sQuery;
		//die();
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		//$res_array[0]['prueba']=$sQuery;
		return($res_array);
			
	}
	
	
	
	function add_empresa($descripcion='',$direccion='',$rif='',$telefono='',$responsable='',$telefono2='',$naturaleza='',$tipo='',$adelanto='',$id_sucursal='',$especial='0')
	{
		$query = "INSERT INTO empresa (descripcion,direccion,rif,telefono,responsable,telefono2,naturaleza,tipo,adelanto,id_sucursal,especial,status) 
				  VALUES ('$descripcion','$direccion','$rif','$telefono','$responsable','$telefono2','$naturaleza','$tipo','$adelanto','$id_sucursal','$especial',1)";
	//	die($query);
		$result=mssql_query($query);
		$val_id_control=$this->get_empresa('',$naturaleza,$tipo, $id_sucursal,$descuento,$especial,$rif,1,$descripcion);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
		
	}
	
	
	function update_empresa($id='',$descripcion='',$direccion='',$rif='',$telefono='',$responsable='',$telefono2='',$naturaleza='',$tipo='',$adelanto='',$id_sucursal='',$especial='')
	{
		$query = "UPDATE empresa SET descripcion='$descripcion',direccion='$direccion',rif='$rif',telefono='$telefono',responsable='$responsable',telefono2='$telefono2',naturaleza='$naturaleza',tipo='$tipo',adelanto='$adelanto',id_sucursal='$id_sucursal' ,especial='$especial'    
				  WHERE  id = '$id'";
		//die($query);		  
		$result=mssql_query($query);
		return $result;
	}
	
	
	function delete_empresa($id)
	{
		$query = "UPDATE empresa SET status=0 WHERE id = '$id'";
		
		$result=mssql_query($query);
	}
	
	function delete_def_empresa($id)
	{
		$query = "DELETE FROM  empresa WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
