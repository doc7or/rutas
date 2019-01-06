<?php


	define("USER","sa");
	define("PASS", "123456");
	define("SERVER","10.10.3.22");
	define("DB", "rutas");

$link=mssql_connect(SERVER,USER,PASS) or die("Cound not connect to Server");

//if($link) { echo 'si se conecta'; }
mssql_select_db(DB,$link) or die( "Could not open database");

$resul=mssql_query('select * from vehiculo_tipo');
$i=0;
	while($fila=mssql_fetch_array($resul)){
      $tipo_vehiculo[$i]=$fila['id'];
      ++$i;
    }
$resul1=mssql_query('select * from sucursal');

    //se debe correr en ambas tablas tabulador_costo y tabulador_costo_aprobatorio ya que primero se guarda en tabulador_costo_aprobatorio y luego se pasa a tabulador_costo

$id_zona=115;

	while($fila1=mssql_fetch_array($resul1)){
		//echo "id_zona: ".$fila['id_zona']."  costo: ".$fila['costo']."  id_item: ".$fila['id_item']."  id_sucursal:  ".$fila['id_sucursal']."<br>";
      for($j=0;$j<$i;$j++){
        //100=cantaura   |

       $resultado=mssql_query('insert into tabulador_costo_aprobatorio(id_zona,costo,id_item,id_sucursal) values('.$id_zona.',0,'.$tipo_vehiculo[$j].','.$fila1['id'].')');
       echo " bueno ". mssql_rows_affected($link) ."  -  ".$tipo_vehiculo[$j]."    -    $id_zona  <br>";
      }
	}

    $resul1=mssql_query('select * from sucursal');
    	while($fila1=mssql_fetch_array($resul1)){
		//echo "id_zona: ".$fila['id_zona']."  costo: ".$fila['costo']."  id_item: ".$fila['id_item']."  id_sucursal:  ".$fila['id_sucursal']."<br>";
      for($j=0;$j<$i;$j++){
        //100=cantaura   |101-LECHERIA

       $resultado=mssql_query('insert into tabulador_costo(id_zona,costo,id_item,id_sucursal) values('.$id_zona.',0,'.$tipo_vehiculo[$j].','.$fila1['id'].')');
       echo " bueno ". mssql_rows_affected($link) ."  -  ".$tipo_vehiculo[$j]."<br>";
      }
	}

?>
