<?php
	include("../lib/core.lib.php");

	$obj_control_salida_detalle= new class_control_salida_detalle;
	$obj_factura_temp_uso= new class_factura_temp_uso;
	
	/* PARSAMETROS ENVIADOS DESDE EL JS
		parametros[0]=num_fac_ing;//numero ingresado de la factura
		parametros[1]=','+fac_num;//id del campo de la factura
		parametros[2]=','+carga_factura;//id donde se cargaran los asincronos en load
		parametros[3]=','+fac_con;//id del camp q tiene la posicion de la factura
		parametros[4]=','+cf;//id del campo contador de las facturas
		parametros[5]=','+fac_img;//id donde se cargara la imagen
		parametros[6]=','+fac_mon;//id del campo donde se carga el monto
		parametros[7]=','+fac_cli;//id del campo donde se carga el cliente
	*/
	
	$parametros_recividos=$_REQUEST['parametros'];
	
	//se descompone la variable parametros
	$parametros=split(",",$parametros_recividos);
	$factura=$parametros[0];
	$fac_num=$parametros[1];
	$carga_factura=$parametros[2];
	$fac_con=$parametros[3];
	$cf=$parametros[4];
	$fac_img=$parametros[5];
	$fac_mon=$parametros[6];
	$fac_cli=$parametros[7];
	
	//se vuelve a cargar la variable de paarametros
	$parametros_recividos=$factura.','.$fac_num.','.$carga_factura.','.$fac_con.','.$cf.','.$fac_img.','.$fac_mon.','.$fac_cli;
	
	//el segundo parametro es uno porq indica q la factuira esta activa es de cr esta ya registrada satisfactoriamente
	// get_control_salida_detalle($id_control_salida='',$status='',$id_factura='',$tipo='',$get_fact='')
	$arr_control_salida_detalle=$obj_control_salida_detalle->get_control_salida_detalle('','',$factura,2,'2');
	$arr_factura_temp_uso=$obj_factura_temp_uso->get_factura_temp_uso($factura,'',2);
	if(sizeof($arr_control_salida_detalle)>0 ||  sizeof($arr_factura_temp_uso)>0){ ?>
	<script language="javascript">		
		idc=$("#<?php echo $fac_con; ?>").val();
		$("#<?php echo $fac_num; ?>"+idc).val('');
    </script>
<?php	}else{ ?>
	<script language="javascript">
		alert('fsfs');
		idc=$("#<?php echo $fac_con; ?>").val();
		$("#<?php echo $carga_factura; ?>").load('asin_tras_cyberlux.php?parametros=<?php echo $parametros_recividos; ?>');
    </script>
<?php }  ?>

