<?php
	include("../lib/core.lib.php");
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
	
	$new_factura_temp_uso=$obj_factura_temp_uso->add_factura_temp_uso($factura,$_SESSION['id_usuario'],1); 
	?>
	<script language="javascript">
		avilita_add_factura('<?php echo $parametros_recividos; ?>');	
	</script>

