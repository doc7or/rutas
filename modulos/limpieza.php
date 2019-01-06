<?php
	include("../lib/core.lib.php");
	
	
	$obj_vehiculo= new class_vehiculo;
	$arr_vehiculo=$obj_vehiculo->get_vehiculo();
	
	for($i=0;$i<sizeof($arr_vehiculo);$i++){
		echo $arr_vehiculo[$i]['placa'];
		echo'<br>';
		$id=$arr_vehiculo[$i]['id'];
		$telefono=rehtmlspecialchars($arr_vehiculo[$i]['placa']);
		
		$query = "UPDATE vehiculo SET placa='$placa'  WHERE  id = '$id'";
		$result=mssql_query($query);
		
		
	}
	
	echo '<br>Despues de la convercion <br><br>';
	$arr_vehiculo=$obj_vehiculo->get_vehiculo();

	for($i=0;$i<sizeof($arr_vehiculo);$i++){
		echo $arr_vehiculo[$i]['placa'];
		echo'<br>';
	}
	
?>
                        
