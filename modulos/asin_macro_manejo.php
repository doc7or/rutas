<?php
//DECLARACIONES DE LAS LIBRERIAS
	include("../lib/core.lib.php");
	$obj_guia_carga= new class_guia_carga;

//RECEPCION DE PARAMETROS

//VALIDACION EN EL SERVIDOR QUE PASEN POR LO MENOS UR ARTICULO DEL PEDIDO
//variable global analizar
$bNF=0;

//buscamos llos renglones de este pedido que vamos a insertar
	$cr=0;
	for($i=0;$i<$_REQUEST['totalReng'];$i++){
		//validamos que tenga valor positovo mayor a cero
		if($_REQUEST['importe_'.$i]>0){
			$posPositiva[$cr]=$i;//guadamos la posicion de este valor positivo
			$cr++;	//contador de renglones		
		}
	}
	if($_REQUEST['totalReng']==$cr){
		$bNF=1;
	}

?>
<!--PRIMER ESCENARIO-->
<?php
//validamos que sea la primera intencion de insertar la guia de carga
if($_REQUEST['idGuiaCarga']=='' && $cr>0){
	// si es la primera insercion y  hay filas q insertar
	//buscar el nuevo id por sucursal  get_nips_guia($id_sucursal='')
	$nips=$obj_guia_carga->get_nips_guia($_SESSION['id_sucursal']);
	
	//insertamos la nueva guia de carga ------   add_guia_carga($id_por_sucursal='', $id_sucursal='', $id_transportista='', $id_empresa='', $placa='', $fecha='', $status='', $id_user='')
	$newGC=$obj_guia_carga->add_guia_carga($nips,$_SESSION['id_sucursal'],$_REQUEST['transportista'],$_REQUEST['empresa_transportista'],$_REQUEST['vehiculo_placa'],date('Y-m-d h:i:s'),'1',$_SESSION['id_usuario']);
	
/* DATOS DE LA NOTA DE ENTREGA
	insertamos la nota de enrega asoociada a este guia de carga  o detalle de la carga  
		add_guia_carga_det($id_guia='', $fact_num='', $tot_bruto='', $co_cli='', $descrip='', $fec_emis='', $co_ven='', $co_tran='', $tot_neto='', $cli_des='')
	donde esta la informacion de la nota de entrega   
		echo trim($arr_not_ent[0]['co_cli']).'##'.trim($arr_not_ent[0]['co_ven']).'##'.$arr_not_ent[0]['cli_des'].'##'.$arr_not_ent[0]['tot_bruto'].'##'.$arr_not_ent[0]['descrip'].'##'.$arr_not_ent[0]['fec_emis'].'##'.trim($arr_not_ent[0]['co_tran']).'##'.$arr_not_ent[0]['tot_neto'] 
 */
	$GCDdata=split('##',$_REQUEST['generali_not_ent']);
	$newGCD=$obj_guia_carga->add_guia_carga_det($newGC,$_REQUEST['fact_num'],$GCDdata[3],$GCDdata[0],$GCDdata[4],$GCDdata[5],$GCDdata[1],$GCDdata[6],$GCDdata[7],$GCDdata[2]);
	
//RECORREMOS LLOS VALORES A INSERTAR
	for($i=0;$i<$cr;$i++){
		//validamos que tenga valor positovo mayor a cero OJO ESTO ES IMNESEARIO PERO POSIA
			if($_REQUEST['importe_'.$posPositiva[$i]]>0){
/* DATOS DE LA NOTA DE ENTREGA RENGLON ES PARA LOS DETALLE S DE LA MMISMA
	insertamos los detalles de la nota de entrega asociados 
		add_guia_carga_det_reng($id_guia_det='', $pediente='', $co_art='', $total_art='', $co_alma='', $reng_num='', $fact_num='', $prec_vta='', $porc_desc='', $reng_neto='', $art_des ='')
	donde esta la informacion del detalle  
		format($arr_not_ent_reng[$i]['pendiente'],0).'##'.$arr_not_ent_reng[$i]['reng_num'].'##'.$arr_not_ent_reng[$i]['fact_num'].'##'.$arr_not_ent_reng[$i]['co_art'].'##'.$arr_not_ent_reng[$i]['prec_vta'].'##'.$arr_not_ent_reng[$i]['art_des'].'##'.$arr_not_ent_reng[$i]['total_art'].'##'.$arr_not_ent_reng[$i]['co_alma'].'##'.$arr_not_ent_reng[$i]['porc_desc'].'##'.$arr_not_ent_reng[$i]['reng_neto']
 */
			//descomponemos la variable generalidad
			$detalleReng[$i]=split('##',$_REQUEST['generalidad_'.$posPositiva[$i]]);
			//insercion como tal
			$newGCDR=$obj_guia_carga->add_guia_carga_det_reng($newGCD, $detalleReng[$i][0], $detalleReng[$i][3], $detalleReng[$i][6], $detalleReng[$i][7], $detalleReng[$i][1], $detalleReng[$i][2], $detalleReng[$i][4],$detalleReng[$i][8], $detalleReng[$i][9], $detalleReng[$i][5]);
						
			//AQUI SE PARA UNA ACTUALIZACION DE EL HTML QUE SE VE DEL PEDIDO PARA Q SEA BIEN DINAMICA LA COSA	//muestraPen importe_ generalidad_
		//	$muestraPendiente= $detalleReng[$i][0]-$_REQUEST['importe_'.$posPositiva[$i]];
			//$generalidaVal=$muestraPendiente.'##'.$detalleReng[$i][1].'##'.$detalleReng[$i][2].'##'.$detalleReng[$i][3].'##'.$detalleReng[$i][4].$detalleReng[$i][5].'##'.$detalleReng[$i][6].$detalleReng[$i][7].'##'.$detalleReng[$i][8];
		
		}
	}//VALIDAMOS LA CAJA ASINCRONAMENTE Y QUE SEA LA PRIMERA VEZ QUE SE INSERTA O CRE ESTA GUIA DE CARGA DE LO CONTRARIO
	
	$idGuiaCarga=$newGC;
?>
<script type="text/javascript" >
			$("#idGuiaCarga").val('<?php echo $newGC; ?>');
   </script>
<?php
} ?>
<!--SEGUNDO ESCENARIO-->
<?php 
if($_REQUEST['idGuiaCarga']!='' && $cr>0){ 
// si no es la primera insercion y  hay filas q insertar osea solo se inserta renglones  
//insertamos la factura que esta asociada a aesta guia de transporte para su creacion  
/* DATOS DE LA NOTA DE ENTREGA
	insertamos la nota de enrega asoociada a este guia de carga  o detalle de la carga  
		add_guia_carga_det($id_guia='', $fact_num='', $tot_bruto='', $co_cli='', $descrip='', $fec_emis='', $co_ven='', $co_tran='', $tot_neto='', $cli_des='')
	donde esta la informacion de la nota de entrega   
		echo trim($arr_not_ent[0]['co_cli']).'##'.trim($arr_not_ent[0]['co_ven']).'##'.$arr_not_ent[0]['cli_des'].'##'.$arr_not_ent[0]['tot_bruto'].'##'.$arr_not_ent[0]['descrip'].'##'.$arr_not_ent[0]['fec_emis'].'##'.trim($arr_not_ent[0]['co_tran']).'##'.$arr_not_ent[0]['tot_neto'] 
 */
	$GCDdata=split('##',$_REQUEST['generali_not_ent']);
	$newGCD=$obj_guia_carga->add_guia_carga_det($_REQUEST['idGuiaCarga'],$_REQUEST['fact_num'],$GCDdata[3],$GCDdata[0],$GCDdata[4],$GCDdata[5],$GCDdata[1],$GCDdata[6],$GCDdata[7],$GCDdata[2]);
																																																																										
//RECORREMOS LLOS VALORES A INSERTAR
	for($i=0;$i<$cr;$i++){
//validamos que tenga valor positovo mayor a cero OJO ESTO ES IMNESEARIO PERO POSIA
			if($_REQUEST['importe_'.$posPositiva[$i]]>0){
			
			/* DATOS DE LA NOTA DE ENTREGA RENGLON ES PARA LOS DETALLE S DE LA MMISMA
	insertamos los detalles de la nota de entrega asociados 
		add_guia_carga_det_reng($id_guia_det='', $pediente='', $co_art='', $total_art='', $co_alma='', $reng_num='', $fact_num='', $prec_vta='', $porc_desc='', $reng_neto='', $art_des ='')
	donde esta la informacion del detalle  
		format($arr_not_ent_reng[$i]['pendiente'],0).'##'.$arr_not_ent_reng[$i]['reng_num'].'##'.$arr_not_ent_reng[$i]['fact_num'].'##'.$arr_not_ent_reng[$i]['co_art'].'##'.$arr_not_ent_reng[$i]['prec_vta'].'##'.$arr_not_ent_reng[$i]['art_des'].'##'.$arr_not_ent_reng[$i]['total_art'].'##'.$arr_not_ent_reng[$i]['co_alma'].'##'.$arr_not_ent_reng[$i]['porc_desc'].'##'.$arr_not_ent_reng[$i]['reng_neto']
 */
			//descomponemos la variable generalidad
			$detalleReng[$i]=split('##',$_REQUEST['generalidad_'.$posPositiva[$i]]);
			//insercion como tal
			$newGCDR=$obj_guia_carga->add_guia_carga_det_reng($newGCD, $detalleReng[$i][0], $detalleReng[$i][3], $detalleReng[$i][6], $detalleReng[$i][7], $detalleReng[$i][1], $detalleReng[$i][2], $detalleReng[$i][4],$detalleReng[$i][8], $detalleReng[$i][9], $detalleReng[$i][5]);
						
			
			
			//AQUI SEE ARA UNA ACTUALIZACION DE EL HTML QUE SE VE DEL PEDIDO PARA Q SEA BIEN DINAMICA LA COSA	//muestraPen importe_ generalidad_
			//$muestraPendiente= $detalleReng[$i][0]-$_REQUEST['importe_'.$posPositiva[$i]];
			//$generalidaVal=$muestraPendiente.'##'.$detalleReng[$i][1].'##'.$detalleReng[$i][2].'##'.$detalleReng[$i][3].'##'.$detalleReng[$i][4].$detalleReng[$i][5].'##'.$detalleReng[$i][6].$detalleReng[$i][7].'##'.$detalleReng[$i][8];
	
		}
	}//VALIDAMOS LA CAJA ASINCRONAMENTE Y QUE SEA LA PRIMERA VEZ QUE SE INSERTA O CRE ESTA GUIA DE CARGA DE LO CONTRARIO
	
	//editamos el tranporte y datos del mismo udpGuiaTransData($id,$id_transportista,$id_empresa,$placa)
	$udpGTD=$obj_guia_carga->udpGuiaTransData($_REQUEST['idGuiaCarga'],$_REQUEST['transportista'],$_REQUEST['empresa_transportista'],$_REQUEST['vehiculo_placa']);

	$idGuiaCarga=$_REQUEST['idGuiaCarga'];

} ?>
<!--TERCER ESCENARIO-->
<?php 
if($_REQUEST['idGuiaCarga']!='' && $cr==0){ 
    // si no es la primera insercion y no hay filas q insertar solo se editan las cabezeras de transporte solo se editan los valores de transporte
	//editamos el tranporte y datos del mismo udpGuiaTransData($id,$id_transportista,$id_empresa,$placa)
	$udpGTD=$obj_guia_carga->udpGuiaTransData($_REQUEST['idGuiaCarga'],$_REQUEST['transportista'],$_REQUEST['empresa_transportista'],$_REQUEST['vehiculo_placa']);
 } 
 
 
?>


<!--ESCENARIO FINAL DE RESULTADOS-->
   <script type="text/javascript" >   	
   		$("#filtroResul").html('<img src="../images/ajax-loader.gif"  align="baseline" />');
		$("#filtroResul").html('Se inserto la  factura <?php echo $_REQUEST['fact_num']; ?> de la empresa <?php echo $textEmpresaMost; ?>');
		$("#resulAccion").html('<img src="../images/ajax-loader.gif"  align="baseline" />');
	//	alert('asin_GC_cyberlux.php?id=<?php echo $idGuiaCarga; ?>');
		$("#resulAccion").load('asin_GC_cyberlux.php?id=<?php echo $idGuiaCarga; ?>');
   </script>
<!--ESCENARIO FINAL DE RESULTADOS-->
