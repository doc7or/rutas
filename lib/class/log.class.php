<?php 
class class_log {

/*
TABLA log
CAMPOS 	
id						IDENTIFICADOR
id_log_tabla			ID QUE IDENTIFICA EL NOMBRE DE LA TABLA USADA
id_log_tipo				IDENTIFICADOR Q DA LA ACCION REALIZADA
fecha					FEHCA EN LA QUE SE REALIZA EL LOG
id_usuario				IDENTIFICADOR DEL USUARIO
id_registro				IDENTIFICADOR DEL REGISTRO MODIFICADO DE LA TABLA USADA
fecha_control			FECHA QUE PODREMOS USAR PARA LOS REPORTES MOTIVADO Q HASTA LA FECHA NO E PODIDO LEER A PRECICION Y OFRMATEAR FECHAS EN MSSQL

1	control_salida	1
2	empresa	1
3	escolta	1
4	estado	1
5	iva	1
6	ruta_base	1
7	sucursal	1
8	tabulador_costo	1
9	tabulador_costo_aprobatorio	1
10	transportista	1
11	usuario	1
12	usuario_tipo	1
13	vehiculo	1
14	vehiculo_tipo	1
15	zona	1
16	Nuevo	2
17	Edicion	2
18	Consulta	2
19	Eiminacion	2
2o	eliminacion definitiva	2
21	Anulacion Guia	2


*/


	function get_log($id='',$fecha='',$id_log_tipo, $id_registro='',$id_usuario='',$id_log_tabla=''){
		$sQuery="SELECT * FROM log WHERE 1 = 1 ";
		if($id) {	$sQuery.="AND id = '$id' ";	}
		if($fecha) {	$sQuery.="AND fecha = '$fecha' ";}
		if($id_log_tipo){ $sQuery.="AND id_log_tipo = '$id_log_tipo' ";}
		if($id_registro){ $sQuery.="AND id_registro = '$id_registro' ";}
		if($id_usuario){ $sQuery.="AND id_usuario = '$id_usuario' ";}
		if($id_log_tabla){ $sQuery.="AND id_log_tabla = '$id_log_tabla' ";}
		
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
	
	function add_log($fecha='',$id_log_tipo, $id_registro='',$id_usuario='',$id_log_tabla='',$fecha_control='')
	{
		$query = "INSERT INTO log (fecha,id_log_tipo,id_registro,id_usuario,id_log_tabla,fecha_control) 
				  VALUES ('$fecha','$id_log_tipo','$id_registro','$id_usuario','$id_log_tabla','$fecha_control')";
		//die($query);		  
		$result=mssql_query($query);
		
		return $new_pet_id;
	}
	
	

	function delete_log($id)
	{
		$query = "DELETE FROM  log WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
