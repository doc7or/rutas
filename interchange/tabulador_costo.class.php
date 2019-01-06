<?php 
class class_tabulador_costo{

/*

TABLA tabulador_costo, recargos
CAMPOS 	
	tabulador id,id_zona,id_sucursal,id_item,costo
	recargos id,descripcion,monto,forma
	desvios id,descripcion,monto	
*/
	function get_recargos($id=''){
		$sQuery="SELECT * FROM recargos WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		$sQuery.="ORDER BY id ";
		//echo $sQuery;
		//die();
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
			//echo "valor ".$valor." key ".$key;
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
		
	}	

	function get_desvios($id=''){
		$sQuery="SELECT * FROM desvios WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		$sQuery.="ORDER BY id ";
		//echo $sQuery;
		//die();
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
			//echo "valor ".$valor." key ".$key;
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
		
	}	


	function get_list_tabulador_costo($id='',$id_sucursal='',$id_zona='',$id_item=''){
		$sQuery="SELECT
					tabulador_costo.id,tabulador_costo.id_zona,tabulador_costo.id_sucursal,
					tabulador_costo.id_item,tabulador_costo.costo,
					zona.id_estado AS zona_estado, zona.descripcion AS zona, 
					estado.descripcion AS estado
				FROM
					tabulador_costo
					Inner Join zona ON tabulador_costo.id_zona = zona.id
					Inner Join estado ON zona.id_estado = estado.id
				
				WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";}
		if($id_zona) {	$sQuery.="AND id_zona = '$id_zona' ";}
		if($id_estado) {	$sQuery.="AND zona.id_estado = '$id_estado' ";}
		$sQuery.="  ORDER BY
					tabulador_costo.id_sucursal, estado.descripcion, zona.descripcion  ASC 
				 ";
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


function get_list_tabulador_desvio($ids_zona,$id_item,$id_sucursal){
		$sQuery="SELECT tabulador_costo.*,zona.descripcion,zona.id_estado,estado.descripcion AS estado
				FROM tabulador_costo
				INNER JOIN zona ON tabulador_costo.id_zona=zona.id
				INNER JOIN estado ON zona.id_estado=estado.id
				WHERE tabulador_costo.id_zona 
				IN ($ids_zona) 
				AND tabulador_costo.id_item='$id_item'  
				AND tabulador_costo.id_sucursal='$id_sucursal'
				ORDER BY zona.id_estado,tabulador_costo.costo DESC ";

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

	
		function get_tabulador_costo($id='',$id_zona='',$id_sucursal='',$id_item=''){
		$sQuery="SELECT * FROM tabulador_costo WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_zona) {	$sQuery.="AND id_zona = '$id_zona' ";}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";}
		if($id_item) {	$sQuery.="AND id_item = '$id_item' ";}
		//echo $sQuery;
		//die();
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
			//echo "valor ".$valor." key ".$key;
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
	}
	
	function get_tabulador_costo_aprobatorio($id='',$id_zona='',$id_sucursal='',$id_item=''){
		$sQuery="SELECT * FROM tabulador_costo_aprobatorio WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_zona) {	$sQuery.="AND id_zona = '$id_zona' ";}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";}
		if($id_item) {	$sQuery.="AND id_item = '$id_item' ";}
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
		return($res_array);
			
	}
	
		function get_tabulador_costo2($id='',$id_zona='',$id_sucursal='',$id_item=''){
		$sQuery="SELECT * FROM tabulador_costo_aprobatorio WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($id_zona) {	$sQuery.="AND id_zona = '$id_zona' ";}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";}
		if($id_item) {	$sQuery.="AND id_item = '$id_item' ";}
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
		return($res_array);
			
	}
	
	
	
	
	function add_recargos($id='',$descripcion='',$monto='',$forma='')
	{
		$query = "INSERT INTO recargos (id,descripcion,monto,forma) 
				  VALUES ('$id','$descripcion','$monto','$forma')";
		$result=mssql_query($query);
		
		return $result;
	}
	
	
	
	function add_tabulador_costo($id_zona='',$id_sucursal='',$id_item='',$costo)
	{
		$query = "INSERT INTO tabulador_costo (id_zona,id_sucursal,id_item,costo) 
				  VALUES ('$id_zona','$id_sucursal','$id_item','$costo')";
		$result=mssql_query($query);
		$add_tca=$this->add_tabulador_costo_aprobatorio($id_zona,$id_sucursal,$id_item,$costo);
		return $result;
	}

	function add_tabulador_costo_aprobatorio($id_zona='',$id_sucursal='',$id_item='',$costo)
	{
		$query = "INSERT INTO tabulador_costo_aprobatorio (id_zona,id_sucursal,id_item,costo) 
				  VALUES ('$id_zona','$id_sucursal','$id_item','$costo')";
		$result=mssql_query($query);
		
		return $result;
	}
	
	
	function update_tabulador_costo($id='',$costo='')
	{
		$query = "UPDATE tabulador_costo_aprobatorio SET costo='$costo' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
	//	die($query);
		return $result;
	}
	
	function update_recargos($id,$descripcion,$monto,$forma)
	{
		$query = "UPDATE recargos SET descripcion='$descripcion',  monto='$monto', forma='$forma'
				  WHERE  id = '$id'";
		$result=mssql_query($query);
	//	die($query);
		return $result;
	}

	function update_desvios($id,$descripcion,$monto)
	{
		$query = "UPDATE desvios SET descripcion='$descripcion',  monto='$monto' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
		return $result;
	}

	
	function update_tabulador_costo_sucursal($id='',$id_sucursal='')
	{
		$query = "UPDATE tabulador_costo SET id_sucursal='$id_sucursal' 
				  WHERE  id = '$id'";
		$result=mssql_query($query);
	//	die($query);
		return $result;
	}
	
	
	function delete_tabulador_costo($placa)
	{
		$query = "DELETE FROM  tabulador_costo WHERE placa = '$placa'";
		$result=mssql_query($query);
	}
	
}
?>
