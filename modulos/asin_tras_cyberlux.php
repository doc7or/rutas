<?php
	include("../lib/core_cyberlux.lib.php");
	$obj_cyberlux_tras_alm= new class_cyberlux_tras_alm;
	$obj_cyberlux_sub_alma= new class_cyberlux_sub_alma;
	

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
	
	
	$arr_cyberlux_tras_alm=$obj_cyberlux_tras_alm->get_cyberlux_tras_alm($factura);
	if(sizeof($arr_cyberlux_tras_alm)>0){ 
		//fact_num,tot_bruto,co_cli,cli_des
		$arr_cyberlux_sub_alma_ori=$obj_cyberlux_sub_alma->get_cyberlux_sub_alma($arr_cyberlux_tras_alm[0]['alm_orig']);
		$arr_cyberlux_sub_alma_des=$obj_cyberlux_sub_alma->get_cyberlux_sub_alma($arr_cyberlux_tras_alm[0]['alm_dest']);
	?>
	<script language="javascript">
		idc=$("#<?php echo $fac_con; ?>").val();
				
		$("#<?php echo $fac_cli; ?>"+idc).val('<?php echo $arr_cyberlux_sub_alma_ori[0]['des_sub'] ; ?>');
		$("#<?php echo $fac_mon; ?>"+idc).val('<?php echo $arr_cyberlux_sub_alma_des[0]['des_sub'] ; ?>');
		$("#<?php echo $fac_num; ?>"+idc).attr("readonly", true);
		
			
		$("#<?php echo $carga_factura; ?>").load('asin_fac_uso_tras.php?parametros=<?php echo $parametros_recividos; ?>');	
    </script>

<?php
	
	}else{ 
?>
	<script language="javascript">
		idc=$("#<?php echo $fac_con; ?>").val();
		$("#<?php echo $fac_num; ?>"+idc).val('');
		
    </script>

<?php } ?>

