<?php
	include("../lib/core.lib.php");
	$obj_tabulador_costo= new class_tabulador_costo;
	$obj_vehiculo= new class_vehiculo;
	$obj_zona= new class_zona;
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$desvio_ids=$_REQUEST['desvio_ids'];//zona destino
	$vehiculo=$_REQUEST['vehiculo'];//vehiculo
	$destino=$_REQUEST['destino'];//destino
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$arr_vehiculo=$obj_vehiculo->get_vehiculo('','','','','',$vehiculo);
	$arr_tabulador_costo=$obj_tabulador_costo->get_list_tabulador_desvio($desvio_ids,$arr_vehiculo[0]['id_tipo'],$_SESSION['id_sucursal']);// el cuarto parametro 

	$arr_desvios=$obj_tabulador_costo->get_desvios();
	$arr_zona_destino=$obj_zona->get_zona($destino);//se busca estado destino


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	echo '<table  class="tablas_procesos_datos">';
	echo '<tr class="tablas_listados_encabezados"><td>Desvio</td><td>Estado</td><td>Monto</td><td>Porcentaje</td><td>Calculo</td></tr>';

	 $estado_ref=''; $tot_des_cor=0;	$tot_des_lar=0;
	 for ($i=0; $i<sizeof($arr_tabulador_costo);$i++) {
	 		if ($i % 2){	$clase = "tablas_listados_datos_par_menor";
			} else{		$clase = "tablas_listados_datos_imp_menor";
												}
	 	//calculo de porcentajes a usar
	 	if($estado_ref!=$arr_tabulador_costo[$i]['id_estado']){
	 		$estado_ref=$arr_tabulador_costo[$i]['id_estado'];
	 		$val_des_apl=$arr_desvios[1]['monto'];//se usa la 1 que es el desvio largo
	 		$tot_des_lar+=(($arr_tabulador_costo[$i]['costo']*$val_des_apl)/100); //calculamos en largo primero siempre porque es diferente
	 		if($estado_ref==$arr_zona_destino[0]['id_estado']){
	 			$tot_des_lar=$tot_des_lar-(($arr_tabulador_costo[$i]['costo']*$val_des_apl)/100);//se resta el valor del largo sumado pues no era largo sino destino
	 			$val_des_apl=$arr_desvios[0]['monto'];//se usa la 1 que es el desvio corto pues el largo ya se uso en el destino
	 			$tot_des_cor+=(($arr_tabulador_costo[$i]['costo']*$val_des_apl)/100);//se calcula el corto
	 		}	
	 		//totalizamos
	 	}else{
	 		$val_des_apl=$arr_desvios[0]['monto'];//se usa la 1 que es el desvio corto
	 		$tot_des_cor+=(($arr_tabulador_costo[$i]['costo']*$val_des_apl)/100);//se calcula el corto
	 	}
	 	//se calcula el valor a mostrar

	 	echo '<tr class="'.$clase.'"><td>'.$arr_tabulador_costo[$i]['descripcion'];
	 	echo '</td><td>'.$arr_tabulador_costo[$i]['estado'];
		echo '</td><td align="right">'.number_format($arr_tabulador_costo[$i]['costo'],2,',','.');
		echo '</td><td align="right">'.$val_des_apl.'%';
		echo '</td><td align="right">'.number_format((($arr_tabulador_costo[$i]['costo']*$val_des_apl)/100),2,',','.');'</td></tr>';
	  }

	echo '</table>';

	/////////////////////////////////////////////////////////////////////////////////////////////////////
	echo '<script type="text/javascript" >';
	echo '$("#valor_desvio").val('.$tot_des_lar.');';
	echo '$("#valor_desvio_c").val('.$tot_des_cor.');';	
	echo 'calcular_totales();';	
	echo '</script>';
		

                                          
