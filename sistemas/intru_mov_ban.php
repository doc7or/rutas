<table>
<tr>
<td colspan="2">clientes en vivo en la tabla copi</td>
</tr>

<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">clientes en profit en la tabla copi</td>
</tr>
<?php

 $HOST     = "10.10.1.7";	
	$USERNAME = "sa";
	$PASSWORD = "123456";
	$DBNAME   = "WEB";
	$DBNAME_2 = "CYBERLUX2";
	$DBNAME_cy = "CYBERLUX";
	
	
$connection = mssql_connect($HOST, $USERNAME, $PASSWORD);
$SelectedDB = mssql_select_db($DBNAME);

$filas=get_clientes();
//echo "select * from clientes where cli_des like '$Filtro%' order by cli_des";

function get_clientes(){
		$sQuery="select mov_num,idb from mov_ban where idb>0  AND fecha>'2007-10-31' AND fecha<'2008-08-01'  ";
		
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
	
echo sizeof($filas);
die();

$SelectedDB = mssql_select_db($DBNAME_cy);

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



?>





</table>