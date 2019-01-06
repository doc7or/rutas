<?php


	define("USER","sa");
	define("PASS", "123456");
	define("SERVER","10.10.3.22");
	define("DB", "rutas");
	define("DB_CYBERLUX", "CYBERLUX");

$link=mssql_connect(SERVER,USER,PASS) or die("Cound not connect to Server");

//if($link) { echo 'si se conecta'; }
mssql_select_db(DB,$link) or die( "Could not open database");

$resul=mssql_query('select * from tabulador_costo where id_item=17');


	while($fila=mssql_fetch_array($resul)){
		//echo "id_zona: ".$fila['id_zona']."  costo: ".$fila['costo']."  id_item: ".$fila['id_item']."  id_sucursal:  ".$fila['id_sucursal']."<br>";
       $resultado=mssql_query('insert into tabulador_costo(id_zona,costo,id_item,id_sucursal) values('.$fila['id_zona'].',0,33,'.$fila['id_sucursal'].')');
       echo " bueno ". mssql_rows_affected($link) ."<br>";
	}

    //se debe correr en ambas tablas tabulador_costo y tabulador_costo_aprobatorio ya que primero se guarda en tabulador_costo_aprobatorio y luego se pasa a tabulador_costo
    	while($fila=mssql_fetch_array($resul)){
		//echo "id_zona: ".$fila['id_zona']."  costo: ".$fila['costo']."  id_item: ".$fila['id_item']."  id_sucursal:  ".$fila['id_sucursal']."<br>";
       $resultado=mssql_query('insert into tabulador_costo_aprobatorio(id_zona,costo,id_item,id_sucursal) values('.$fila['id_zona'].',0,33,'.$fila['id_sucursal'].')');
       echo " bueno ". mssql_rows_affected($link) ."<br>";
	}
?>
