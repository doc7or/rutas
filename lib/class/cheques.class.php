<?php
@session_start();
ob_start();
//El config_var va en el mismo directorio del core.lib
//require($_SERVER['DOCUMENT_ROOT']."/rutas/lib/config_var.php"); 
//El conex va en el mismo directorio del corelib
//require($_SERVER['DOCUMENT_ROOT']."/rutas/lib/conn.php"); 
	define("USER","ps");
	define("PASS", "#hGbkWpdeSD;");
	define("SERVER","192.168.0.11");
	define("DB", "rutas");
	define("DB_CYBERLUX", "CYBERLUX");
	
	$link=mssql_connect(SERVER,USER,PASS) or die("Could not connect to Server");

//if($link) { echo 'si se conecta'; }
mssql_select_db(DB,$link) or die( "Could not open database");
/*
*Programador: Mervin Mujica
*Fecha: 2-8-2011
*Descripcion: clase creada para manipular la informacion de los cheques
*/
class class_cheque {

/*
TABLA cheque
CAMPOS 	

id						identificador dela columna
num_cheque				numero del cheque
banco					nombre del banco del cual sera emitido el cheque
monto					cantidad por la cual sera emitido el cheque
id_empresa				numero del id que identifica a la empresa de transporte a la cual se le entregara el cheque
observaciones			prefijo q usan las facturas en las chequees lb lm etc
status					numero que identifica el estado del cheque (anulado,cobrado)
usuario					numero del id del usuario que emitio el cheque
fecha					fecha en la que sera cobrado el cheque
id_revisado				numero de la cheque por la cual sera emitido el cheque 

*/


	function get_cheque($id=0,$id_empresa='0',$id_nomina=0,$sucursal=0,$banco='',$monto='',$fecha='',$fecha_realizado_nomina='',$anulado=1000,$orden=''){
		$sQuery="SELECT  id, num_cheque, banco, monto, id_empresa, observaciones, status, usuario,convert(varchar(10), fecha, 103) as fecha, id_revisado, id_nomina FROM cheques WHERE 1 = 1 ";
		if($id!=0) {	$sQuery.="AND num_cheque = $id ";	}
		if($id_empresa!='0') {	
			if (is_numeric($id_empresa))
				$sQuery.="AND id_empresa = '$id_empresa' ";	
			else
				$sQuery.="AND id_empresa like '".strtoupper($id_empresa)."%' ";	

		}
		if($id_nomina!=0) {	$sQuery.="AND id_nomina = $id_nomina ";	}
		if($sucursal!=0) {	$sQuery.="AND id_revisado = $sucursal ";/* id_revisado es el campo q almacena el id de la sucursal a la q le pertenece el cheque*/	}
		if($banco!='') {	$sQuery.="AND banco = '$banco' ";	}
		if($monto!='') {$montos=explode('|',$monto);	$sQuery.="AND monto between $montos[0] and $montos[1] ";	}
		if(trim($fecha)!='') {	
			$fechas=explode('|',$fecha);
			$fecha1=explode('/',$fechas[0]);
			$fecha2=explode('/',$fechas[1]);	
			$sQuery.="AND fecha between '$fecha1[2]/$fecha1[1]/$fecha1[0] 00:00:00' and '$fecha2[2]/$fecha2[1]/$fecha2[0] 23:59:59' ";	
		}
		if(trim($fecha_realizado_nomina)!='') {	
			$fechas=explode('|',$fecha_realizado_nomina);
			$fecha1=explode('/',$fechas[0]);
			$fecha2=explode('/',$fechas[1]);	
			$sQuery.="AND fecha_realizado_nomina between '$fecha1[2]/$fecha1[1]/$fecha1[0] 00:00:00' and '$fecha2[2]/$fecha2[1]/$fecha2[0] 23:59:59' ";	
		}
                if ($anulado!=1000){
                    $sQuery.="AND status = ".$anulado;
                }
                $sQuery.=$orden;
	 //echo($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		if (mssql_num_rows($result)!=0){
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;;
		}
		return($res_array);
		}else return ($res_array[0]['id']=mssql_num_rows($result));
	}
	
	
	function add_cheque($num_cheque=0,$banco='',$monto=0,$id_empresa='0',$observaciones='',$status=0,$usuario=0,$fecha='',$id_revisado=0,$id_nomina=0,$fecha_realizado_nomina='')
	{
		$query = "INSERT INTO cheques (num_cheque,banco,monto,id_empresa,observaciones,status,usuario,fecha,id_revisado,id_nomina,fecha_realizado_nomina) 
				  VALUES ($num_cheque,'$banco',$monto,'".strtoupper($id_empresa)."','".strtoupper($observaciones)."',$status,$usuario,'$fecha',$id_revisado,$id_nomina,'$fecha_realizado_nomina')";
		//echo $query;
		$result=mssql_query($query) or die(mssql_min_error_severity());
		 
		//return mssql_rows_affected($link);
		//$rows = mssql_rows_affected($link);
		if ($result){
			return 1;
		}else {return " |  INSERT INTO cheques (num_cheque,banco,monto,id_empresa,observaciones,status,usuario,fecha,id_revisado,id_nomina,fecha_realizado_nomina) VALUES ($num_cheque,'$banco',$monto,$id_empresa,'$observaciones',$status,$usuario,'$fecha',$id_revisado,$id_nomina,'$fecha_realizado_nomina')";
		}
	}
	
	//
	function update_cheque($num_cheque_v=0,$num_cheque_n=0,$banco='',$monto=0,$id_empresa='0',$observaciones='',$status=0,$usuario=0,$fecha='',$id_revisado=0)
	{
		$query = "UPDATE cheques SET num_cheque=$num_cheque_n, banco='$banco', monto=$monto, id_empresa='$id_empresa', observaciones='$observaciones', status=$status, usuario=$usuario, fecha='$fecha', id_revisado=$id_revisado
				  WHERE  num_cheque = '$num_cheque_v'";
		//die($query);
		$result=mssql_query($query);
		return $result;
	}
	
	
	function delete_cheque($id)
	{
		$query = "UPDATE cheques SET status=0 WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
	function delete_def_cheque($id)
	{
		$query = "DELETE FROM  cheques WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
	function consulta_Sql_Cheque($sql){
		$result=mssql_query($sql);
		//echo $sql;
		if ($result){
		//return mssql_rows_affected($link);
		return 1;
		}else return 0;
	}
	
	function consulta_General_Matriz($sql){
		//$result=mssql_query($sql);
		//echo $sql;
		$result=mssql_query($sql) or die(mssql_min_error_severity());
		$i=0;
		if (mssql_num_rows($result)!=0){
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return ($res_array);
		}else return 0;
	}
	
}

?>