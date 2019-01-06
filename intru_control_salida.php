<?php

 	$HOST     	= "10.10.1.7";	
	$USERNAME 	= "sa";
	$PASSWORD = "123456";
	$DBNAME   = "WEB";
	$DBNAME_2 = "CYBERLUX2";
	$DBNAME_cy = "CYBERLUX";
	$DBTRANSP  = "transporte";
	
	
$connection = mssql_connect($HOST, $USERNAME, $PASSWORD);
$SelectedDB = mssql_select_db($DBTRANSP);

$filas=get_control_salida_mov();
//echo "select * from clientes where cli_des like '$Filtro%' order by cli_des";

	//BUSQUEDA DE DATOS EN ESPECIFICO DE LA GUAIE EN ESTE CASO EL ID, ID_SUCURSAL, LA PLACA
	function get_control_salida_mov(){
		$sQuery="SELECT id, id_sucursal, placa FROM control_salida WHERE placa <> 'NULL' AND id_empresa is NULL ";
	
	/*	for($i=0;$i<sizeof($numrows);$i++){
			$res_array[$i]['id']=$numrows[$i]['id'];
			$res_array[$i]['id_sucursal']=$numrows[$i]['id_sucursal'];
			$res_array[$i]['placa']=$numrows[$i]['placa'];
			
			//
			$vQuery="SELECT id_empresa FROM vehiculo WHERE placa = '".$res_array[$i]['placa']."' AND id_sucursal= '".$res_array[$i]['id_sucursal']."' ";
			$resultv=mssql_query($vQuery) or die(mssql_min_error_severity());
			$numrowsv=mssql_fetch_array($resultv);
			
			$res_array[$i]['id_empresa']=$numrowsv[0]['id_empresa'];
			
		}*/
		
		
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		
		for($i=0;$i<sizeof($res_array);$i++){
		
			$vQuery="SELECT id_empresa FROM vehiculo WHERE placa = '".$res_array[$i]['placa']."' AND id_sucursal= '".$res_array[$i]['id_sucursal']."' ";
			//echo $vQuery.'<br>';
			$resultv=mssql_query($vQuery) or die(mssql_min_error_severity());
			$j=0;
				while($row=mssql_fetch_array($resultv)){
					foreach($row as $key=>$value){
						$res_v[$j][$key]=$value;
					}
					$j++;
				}
			
			$res_array[$i]['id_empresa']=$res_v[0]['id_empresa'];
		}
		
		
		return($res_array);
			
	}
echo '<br>';	
echo $num_filas=sizeof($filas);
echo '<br>';
//die();
?>

    

<?php
for($i=0;$i<sizeof($filas);$i++){
	 echo $filas[$i]['id'].'  ---  ';  
	 echo $filas[$i]['id_sucursal'].'  ---  ';
	 echo $filas[$i]['placa'].'  ---  ';
	 echo $filas[$i]['id_empresa'].'  ---  ';
	 echo '<br>';
	 $query = "UPDATE control_salida SET id_empresa='".$filas[$i]['id_empresa']."'
				  WHERE  id = '".$filas[$i]['id']."'";
		$result=mssql_query($query);
}
?>

<?php
//die();

/*$SelectedDB = mssql_select_db($DBNAME_cy);

for($i=0;$i<$filas;$i++){
	
	$udp=update_mov_ban($filas[$i]['mov_num'],$filas[$i]['idb']);
	
}


function update_mov_ban($mov_num,$idb)
	{
		$query = "UPDATE mov_ban SET idb='$idb'  
				  WHERE  mov_num = '$mov_num'";
		$result=mssql_query($query);
		return $result;
	}

*/

?>
