<?php 
class class_nomina_detalle {
/*

TABLA nomina_detalle
CAMPOS id,id_nomina,id_factura,monto_factura,cliente,liq_amarilla,liq_azul,liq_blanca,fecha_liquidacion_factura

id							identificador de la factura de un control
id_nomina					identifica el control al q pertenece
id_guia						identificador de la guia




*/



	
	function get_nomina_detalle($id_nomina='',$id_guia=''){
		$sQuery="SELECT * FROM nomina_detalle WHERE 1 = 1";
		if($id_nomina) {	$sQuery.=" AND id_nomina = '$id_nomina' ";	}
		if($status)	{ $sQuery.=" AND status = '$status' ";	}
		
		$sQuery.=" ORDER BY id DESC ";
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
	
	
	
	function add_nomina_detalle($id_nomina='',$id_guia='')
	{
		
		$query = "INSERT INTO nomina_detalle(id_nomina,id_guia) 
		VALUES ('$id_nomina','$id_guia')";
		
		
	//	die($query);		  
		$result=mssql_query($query);
		
		return $result;
	}
	
	function anular_nomina_detalle($id_nomina)
	{
		$query = "UPDATE nomina_detalle SET status='2' 
				  WHERE  id_nomina = '$id_nomina'";
		$result=mssql_query($query);
		return $result;
	}
	
	
	function liquidar_factura($id='',$liq_amarilla='',$liq_azul='',$liq_blanca='',$status='')
	{
		$query = "UPDATE nomina_detalle SET liq_amarilla='$liq_amarilla', liq_azul='$liq_azul', liq_blanca='$liq_blanca', status='$status' 
				  WHERE  id = '$id'";
	//	die($query);
		$result=mssql_query($query);
		return $result;
	}
	

	

	
}
?>
