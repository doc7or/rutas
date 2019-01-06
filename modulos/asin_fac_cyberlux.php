<?php
	//include("../lib/core_cyberlux.lib.php");
	include("../lib/core.lib.php");
	$obj_cyberlux_factura= new class_cyberlux_factura;
	$obj_cyberlux_clientes= new class_cyberlux_clientes;
	

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
	
	
	$arr_cyberlux_factura=$obj_cyberlux_factura->get_cyberlux_factura_1($factura);
	
      //  print_r($arr_cyberlux_factura);
	if(sizeof($arr_cyberlux_factura)>0){ 
		//fact_num,tot_bruto,co_cli,cli_des
		//$arr_cyberlux_clientes=$obj_cyberlux_clientes->get_cyberlux_clientes($arr_cyberlux_factura[0]['co_cli']); //***cometado mervin 1-12-2012
		//$arr_cyberlux_factura[0]['factura_nombre1']//se reemplazo la linea 36 por esta(37)
		//$cliente=remplazaCharSpecial($arr_cyberlux_clientes[0]['cli_des']);//se quito esta variable $arr_cyberlux_clientes[0]['cli_des'] y se coloco la actual 22-09-2011    //****comenta mervin 1-12-2012
		$cliente=$arr_cyberlux_factura[0]['cli_des'];
		//die($cliente.'ayuda diosito') ;
                
                //TOT_BRUTO = MONTO SIN IVA
                //TOT_NET =MONTO TOTAL CON IVA
	?>

	<script language="javascript">
		idc=$("#<?php echo $fac_con; ?>").val();
		
		$("#<?php echo $fac_mon; ?>"+idc).val('<?php echo $arr_cyberlux_factura[0]['tot_bruto'] ; ?>');
		$("#<?php echo $fac_cli; ?>"+idc).val('<?php echo $cliente ; ?>');
		$("#<?php echo $fac_num; ?>"+idc).attr("readonly", true);
		alert('diosito');
			
		$("#<?php echo $carga_factura; ?>").load('asin_fac_uso.php?parametros=<?php echo $parametros_recividos; ?>');	
    </script>

<?php
	
	}else{ 
?>
	<script language="javascript">
		idc=$("#<?php echo $fac_con; ?>").val();
		$("#<?php echo $fac_num; ?>"+idc).val('');
		//alert('kniunhuhi');
    </script>

<?php } ?>

