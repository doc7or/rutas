<?php 
include("../lib/core.lib.php");
//	if(inList($_SESSION['usuario'],'')) header('Location: ../lib/common/logout.php');
//llamado de las clases
/*$obj_pedidos= new class_pedidos();//llamado de la tabla de clientes 
$obj_reng_ped= new class_reng_ped();//ren_ped
$obj_not_ent= new class_not_ent();//llamado de notas de entrega
$obj_reng_nde= new class_reng_nde();//renglones de notas de entrega
$obj_general= new class_general();//general
$obj_art= new class_art();//articulo
$obj_st_almac= new class_st_almac();//st_alma
$obj_pistas= new class_pistas();//pistas

//general
$arr_transportista=$obj_general->get_transpor();

//recepcion de parametros
$pedido=$_REQUEST['pedido'];
$transportista=$_REQUEST['transportista'];
$op=$_REQUEST['op'];
if($pedido){
	$arr_pedidos=$obj_pedidos->get_pedidos_list($pedido,'','','',$_SESSION['sucursal']);
	if($arr_pedidos[0]['fact_num']){
		$arr_reng_ped=$obj_reng_ped->get_reng_ped_list_art($arr_pedidos[0]['fact_num']);
	}
}

$val_permitido=0;
for($i=0;$i<sizeof($arr_reng_ped);$i++){
	if($_REQUEST['sel_art_'.$i]){
		$item_sel=1;
		
		if($_REQUEST['cant_art_'.$i]>$arr_reng_ped[$i]['pendiente'] || !is_numeric($_REQUEST['cant_art_'.$i]) || $_REQUEST['cant_art_'.$i]<1){
			$val_permitido=1;			
		}else{
			//PROVECHAMOS PARA NO REPETIR ESTE PROCESO MAS ABAJO CALCULAMOS  DATPS QUE VAN A SER PARA LA NOTA DE ENTREGA COMO TAL			
			 $tot_bruto+= ($_REQUEST['cant_art_'.$i]*$arr_reng_ped[$i]['prec_vta']);
		}
	} 
}


if($op=='Rechazar Nota'){
	header('Location: nota_entrega.php');	
}
if($op=='Conformar Nota' && $item_sel && $val_permitido==0 && $transportista){
	$nota_lista=1;
	
}

//PROCESO DE INSERCIOM DE UNA NOTA DE ENTREGA DE PROFIT WEB
if($op=='Finalizar Nota'){
	//DETERMINAMOS CUAL SERA LA NUEVA NOTA DE ENTREGA
	//REGLA DE LA PRIMERA VEZ DE NOTA DE ENTREGAS WEB MOVIL
	/*
		01 LB 	 5000000
		02 LM 	15000000
		03 MAR	35000000
		04 PFJ	45000000
		05 PTC	55000000
	*//*
	switch($_SESSION['sucursal']) {  
    	case 01: $fact_num=5000000; break;	
		case 02: $fact_num=15000000; break;
		case 03: $fact_num=35000000; break;
		case 04: $fact_num=45000000; break;
		case 05: $fact_num=55000000; break;
	}
	
	//SE MANDA A BUSCAR EL ULTIMO IDENTIFICACDOR DE LA LAS NOTAS DE ENTREGA DE ESTA SUCURSAL
	$last_ne=$obj_not_ent->get_not_ent_last($_SESSION['sucursal']);
	//OBTENEMOS ASI EL NUEVO NUMERO DE ORDEN DE ENTTEGA A USAR
//	echo $last_ne[0]['fact_num'].'<br>';
	if($last_ne[0]['fact_num'] >= $fact_num)	$fact_num=$last_ne[0]['fact_num']+1;
	//echo $last_ne[0]['fact_num'].'   '.$fact_num.'   '.$pedido;
	
	//INSERTAMOS LA NOTA DE ENTREGA add_not_ent($fact_num,$contrib,$status,$comentario,$descrip,$saldo,$fec_emis,$fec_venc,$co_cli,$co_ven,$co_tran,$forma_pag,$tot_bruto,$tot_neto,$iva,$moneda,$co_sucu,$tasag,$impresa)
	//datos de la nota de ntrega necesarios
	$iva=$tot_bruto*($arr_pedidos[0]['tasag']/100) ;
	$saldo=$tot_bruto+$iva ;
	$descrip='P#'.$pedido.' - '.$arr_pedidos[0]['descrip'];
	$fechaa=date('Y-m-d h:i:s');
	
	$new_ne=$obj_not_ent->add_not_ent($fact_num,$arr_pedidos[0]['contrib'],0,$arr_pedidos[0]['comentario'],$descrip,$saldo,$fechaa,$fechaa,$arr_pedidos[0]['co_cli'],$arr_pedidos[0]['co_ven'],$transportista,$arr_pedidos[0]['forma_pag'],$tot_bruto,$saldo,$iva,$arr_pedidos[0]['moneda'],$arr_pedidos[0]['co_sucu'],$arr_pedidos[0]['tasag'],$arr_pedidos[0]['impresa']);
	
	//INSERCION DE EL DETALLE DE LA NOTA DE ENTREGA
	$reng_num=0;
	for($i=0;$i<sizeof($arr_reng_ped);$i++){
		if($_REQUEST['sel_art_'.$i]){
			$item_sel=1;
			
			if($_REQUEST['cant_art_'.$i]<=$arr_reng_ped[$i]['pendiente'] || is_numeric($_REQUEST['cant_art_'.$i]) || $_REQUEST['cant_art_'.$i]>=1){
				//PROCESOS DE INSERCION DE LAS NOTAS DE RENGLONES DE NOTAS DE ENTREGA  add_reng_nde($fact_num,$co_art,$total_art,$prec_vta,$reng_neto,$reng_num,$co_alma,$porc_desc,$tipo_doc,$reng_doc,$num_doc,$pendiente,$uni_venta,$tipo_imp,$cos_pro_un,$ult_cos_un,$ult_cos_om,$cos_pro_om,$prec_vta2,$cant_imp,$comentario,$fecha_lote,$co_alma2)
				$reng_neto=$_REQUEST['cant_art_'.$i]*$arr_reng_ped[$i]['prec_vta'];
				$reng_num++;
				//busco el articulo que necesitamos
				$arr_art=$obj_art->get_art($arr_reng_ped[$i]['co_art']);
				//echo $fact_num.'<br>';
				$new_reng_nde=$obj_reng_nde->add_reng_nde($fact_num,$arr_reng_ped[$i]['co_art'],$_REQUEST['cant_art_'.$i],$arr_reng_ped[$i]['prec_vta'],$reng_neto,$reng_num,$arr_reng_ped[$i]['co_alma'],$arr_reng_ped[$i]['porc_desc'],'P',$arr_reng_ped[$i]['reng_num'],$arr_reng_ped[$i]['fact_num'],$_REQUEST['cant_art_'.$i],'UNI',$arr_reng_ped[$i]['tipo_imp'],$arr_art[0]['cos_pro_un'],$arr_art[0]['ult_cos_un'],$arr_art[0]['ult_cos_om'],$arr_art[0]['cos_pro_om'],$arr_reng_ped[$i]['prec_vta'],$arr_reng_ped[$i]['cant_imp'],$arr_reng_ped[$i]['comentario'],$fechaa,$arr_reng_ped[$i]['co_alma']);
				
				//DISMINUCION DE LOS RENGLONES DE LOS PEDIDOS
				$pendiente=$arr_reng_ped[$i]['pendiente']-$_REQUEST['cant_art_'.$i];
				$new_pendiente_reng_ped=$obj_reng_ped->update_pendiente_reng_ped($arr_reng_ped[$i]['fact_num'],$arr_reng_ped[$i]['reng_num'],$pendiente);
				//DISMINUCION DE EL st_amac
					//busco el articulo en el almacen get_st_almac($co_art,$co_alma)
						$arr_st_almac=$obj_st_almac->get_st_almac($arr_reng_ped[$i]['co_art'],$arr_reng_ped[$i]['co_alma']);
							$stock_act_st_almac=$arr_st_almac[0]['stock_act'] - $_REQUEST['cant_art_'.$i];
							$stock_com_st_almac=$arr_st_almac[0]['stock_com'] - $_REQUEST['cant_art_'.$i];
					//lo edito update_st_almac($co_art,$co_alma,$stock_act,$stock_com);
						$udp_st_almac=$obj_st_almac->update_st_almac($arr_reng_ped[$i]['co_art'],$arr_reng_ped[$i]['co_alma'],$stock_act_st_almac,$stock_com_st_almac);
				//DISMINUCION DE EL art
					//busco el articulo 
						$arr_art=$obj_art->get_art($arr_reng_ped[$i]['co_art']);
							$stock_act_art=$arr_art[0]['stock_act'] - $_REQUEST['cant_art_'.$i];
							$stock_com_art=$arr_art[0]['stock_com'] - $_REQUEST['cant_art_'.$i];
					//lo edito update_art($co_art,$stock_act,$stock_com);
						$udp_art=$obj_art->update_art($arr_reng_ped[$i]['co_art'],$stock_act_art,$stock_com_art);
				
					
					
			}//FIN SI CANTIDADES SON COHERENTES
		}//FIN SI ESTA SELECCIONADO EL RENGLON
	}//FIN DE RENGLONES DE PEDIDOS DE EL PEDIDO
	
	
	//BUSCAMOS SI HAY RENGLONESN DISPONIBLES PARA EL PEDIDO DE NO HABERLO QUIERE DECIR QUE SE DESPACHARON TODOS SUS RENGLONES Y AHORA SE DEBE APORBAR COMPLEAMENTE EL PEDIDO
		$arr_reng_ped=$obj_reng_ped->get_reng_ped_list_art($arr_pedidos[0]['fact_num']);
		$cuantos_reng_pedidos=sizeof($arr_reng_ped);
		if($cuantos_reng_pedidos==0){
			//ponemos el pedido como aprobado total mente status 2
			$status_pedido=2;
		}else{
			//ponemos el pedido parcialmente rocesado status 1
			$status_pedido=1;
		}
		//actualizamos el status update_status_pedidos($fact_num,$status);
		$new_status_pedido=$obj_pedidos->update_status_pedidos($arr_pedidos[0]['fact_num'],$status_pedido);
	
	
	//INSERTAMOS LAS PISTAS	
		//obtencion del nombre del equpo
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']).'  ip '.$_SERVER['REMOTE_ADDR'] ;
		//llamada a la insercion como tal add_pistas($usuario_id,$usuario,$fecha,$empresa,$co_sucu,$tabla,$num_doc,$codigo,$tipo_op,$maquina)
		//insercion en la nota de entrega
		$new_pista_not_ent=$obj_pistas->add_pistas($_SESSION['employee_i'],$_SESSION['last_name'],date('Y-m-d h:i:s'),'CYERLUX',$_SESSION['sucursal'],'NOT_ENT',$fact_num,'','I',$hostname);
		//insercion en el pedido
		$new_pista_pedidos=$obj_pistas->add_pistas($_SESSION['employee_i'],$_SESSION['last_name'],date('Y-m-d h:i:s'),'CYERLUX',$_SESSION['sucursal'],'PEDIDOS',$pedido,'','M',$hostname);
		
		//REDIRECCIONAMOS A LA PAGINA PARA  LA IMPRECION
		header('Location: nota_entrega_imp.php?fact_num='.$fact_num);
		
}
//PROCESO DE INSERCIOM DE UNA NOTA DE ENTREGA DE PROFIT WEB


*/


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux_movil.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script language="javascript" src="../lib/js/jquery/jquery.js"></script>
<script language="javascript" src="../lib/js/jquery/form.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
</head>
<body class="thrColLiqHdr">
<!--ESTE ES EL BODY-->
	<div id="container">
    <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
        <div id="header">
        <!--ESTE ES EL HEADER-->
        <!--ESTE ES EL HEADER-->
        </div>
        <div id="mainContent">
             <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <br />   
              <form name="form1" id="form1" action="" method="post"   >
		  <table width="100%" align="center" class="tablas_listados_datos" >
		               <tr>
                      <td  colspan="2" class="tabla_barra_opciones"  ><table class="tabla_opciones" >
                        <tr >
                          <td width="76%" align="left"><table width="80%" class="tablas_filtros" >
                            <tr>
                              <td width="77" valign="center" class="form_label" title="Guias por sucursal" > Opciones</td>
                              <td width="183" valign="center" class="form_label" title="Guias por sucursal" > Filtros
                                <input name="tipo" type="hidden" id="tipo"  class="form_caja_proceso" value="<?php echo $tipo;?>" /></td>
                            </tr>
                            <tr>
                              <td valign="center" class="form_label" title="Esatdo de la  guia">Pedido</td>
                              <td>
                              	<input name="pedido" id="pedido" type="text" class="form_text_proceso"  value="<?php echo $pedido; ?>"/>
                              </td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr >
                          <td align="left"><table class="tablas_filtros" >
                            <tr align="center">
                              <td width="20%" >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  ><a href="menu_visual.php" ><img  src="../images/listado.png"  title="Volver al menu" alt="Volver al menu"  style="border:none" /></a></td>
                              <td width="20%" ><img src="../images/view.png" title="Buscar" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" /></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
		    <tr>
		      <td  colspan="2" align="left" height="10" class="tablas_pedidos_resg">&nbsp;</td>
	        </tr>
		     <tr>
		      <td  colspan="2" height="10" align="left" class="tablas_pedidos_bolg" >Transportista&nbsp;&nbsp;:&nbsp;</td>
		      
	        </tr>
             <tr>
		      <td  colspan="2" height="10" align="left" class="tablas_pedidos_bolg" >
                    <select name="transportista" id="transportista" class="tabla_pedidos_pool_cli"   >
                           <option value="0">Seleccione...</option>
                              <?php  
                                for ($i=0; $i<sizeof($arr_transportista);$i++) { 
								?>
	                             <option value="<?php echo $arr_transportista[$i]['co_tran'];?>" <?php if($arr_transportista[$i]['co_tran']==$transportista){  echo 'selected'; } ?>> <?php echo substr(htmlentities($arr_transportista[$i]['resp_tra']),0,35); ?> </option>
                              <?php }?>
                              

                            </select> 

              </td>
		      
	        </tr>
            <tr>
		      <td  colspan="2" height="10" align="left" class="tablas_pedidos_bolg" >Pedido&nbsp;&nbsp;:&nbsp;<?php echo $arr_pedidos[0]['fact_num']; ?></td>
		      
	        </tr>
            
            <tr>
		     
		      <td colspan="2" height="10" align="left" class="tablas_pedidos_bolg" >Fecha&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $arr_pedidos[0]['fec_emis']; ?></td>
	        </tr>
             <tr >
		          <td align="left" class="tablas_pedidos_bolg" >Cliente &nbsp;:&nbsp;<span class="form_label_procesos_imp"><?php echo $arr_pedidos[0]['co_cli'].' - '.$arr_pedidos[0]['cli_des']; ?></span></td>
	            </tr>
   		    <tr>
		      <td  colspan="2" align="left"><table class="tabla_opciones" >
		       
		        <tr >
		          <td  align="left" >&nbsp;</td>
	            </tr>
                <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">Conforme la Nota y Luego Finalize</td>
                        </tr>
						<tr >
                          <td  align="left" >
                           
                               <?php if($nota_lista){?>
                            	<input type="submit" name="op" id="op" value="Finalizar Nota" class="form_boton_grande"  >
                                <input type="submit" name="op" id="op" value="Rechazar Nota" class="form_boton_grande"  >                                
                            <?php }else{ ?> 
                            	<input type="submit" name="op" id="op" value="Conformar Nota" class="form_boton_grande"  >
                         	<?php } ?>
                         </td>
                        </tr>
		        <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr >
		          <td  align="left" >
                  <table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
		            <tr  >
		              <td width="5" class="tabla_pedidos_titulos" > Sel</td>
                      <td width="120" class="tabla_pedidos_titulos" >Producto</td>
		              <td width="51" class="tabla_pedidos_titulos" > <?php if($nota_lista) echo 'Imp'; else echo 'Cant'; ?> </td>
		              <td width="48" class="tabla_pedidos_titulos" >P.Ven</td>
		              
	                </tr>
		            <!--AQUI VA LAS COSAS DE EL PEDIDO0 TANTO LA DIVISION POR LINEAS COMO LOS PRODUCTOS EN SI-->
		            <?php // for($il=0;$il<sizeof($arr_lin_art);$il++){?>
		           <!-- <tr >
		              <td colspan="4" class="tabla_pedidos_titulos_sub" ><?php // echo strtoupper($arr_lin_art[$il]['lin_des']); ?></td>
	                </tr>-->
		            <!--AQUI ESTARA EL LSIADO DE ARTICULOS-->
		            <?php  
									 	//BUSCAMOS LOS DETALLES O RENGLONES SEGUN ESTAS TABLAS DE EL PEDIDO
									//	$arr_t_xreng_ped=$obj_xreng_ped->get_xreng_ped_detallado_art1($fact_num,$arr_lin_art[$il]['co_lin']);
									 	//RECOREMOS EL DETALLE DE ESTE PAEDIDO
									 	for($i=0;$i<sizeof($arr_reng_ped);$i++){
										
										//llamado de las clases para filas impares y pares
										  if ($i % 2){
											$clase = "tablas_pedidos_datos_par";
											} else{
											$clase = "tablas_pedidos_datos_imp";
										 }
										?>
		            <tr >
                     <td   class="<?php echo $clase; ?>"  align="center">
                      	<input name="sel_art_<?php echo $i; ?>" id="sel_art_<?php echo $i; ?>" value="<?php echo number_format($arr_reng_ped[$i]['pendiente'],0,',','.'); ?>" type="checkbox" class="tabla_pedidos_caja"   <?php if($nota_lista) echo 'readonly' ; ?>    <?php if($_REQUEST['sel_art_'.$i]) echo 'checked'; ?>  />
                      
                      	
                      </td>
		              <td class="<?php echo $clase; ?>" width="120">
                      	<font class="tablas_pedidos_txt"><?php echo $arr_reng_ped[$i]['art_des']; ?><br />
		                </font> <font class="tablas_pedidos_bol"><?php echo $arr_reng_ped[$i]['co_art']; ?>&nbsp;</font>/          			
                        <font class="tablas_pedidos_bol"><?php echo number_format($arr_reng_ped[$i]['pendiente']); ?>&nbsp;</font>/
                        <br /><font class="tablas_pedidos_bol">
							<?php if(trim($arr_reng_ped[$i]['porc_desc'])){ echo $arr_reng_ped[$i]['porc_desc'].'%'; } else { echo '0%'; } ?>
                         </font>
                        
                       </td>
		              <td   class="<?php echo $clase; ?>" width="51" align="center">
                      	<input name="cant_art_<?php echo $i; ?>" id="cant_art_<?php echo $i; ?>" 
                        	value="<?php if($_REQUEST['cant_art_'.$i] && $_REQUEST['sel_art_'.$i]) echo $_REQUEST['cant_art_'.$i]; 
									else {  
										if($nota_lista) echo 0;
										else echo number_format($arr_reng_ped[$i]['pendiente'],0,',','.'); 
									} ?>" 
                            type="text" class="tabla_pedidos_caja"   <?php if($nota_lista) echo 'readonly'; ?>     />
                        <input name="h_cant_art_<?php echo $i; ?>" id="h_cant_art_<?php echo $i; ?>" value="<?php echo $_REQUEST['cant_art_'.$i]; ?>" type="hidden"/>
                      	
                      </td>
		              <td   class="<?php echo $clase; ?>" width="48"><div align="right"><?php echo number_format($arr_reng_ped[$i]['prec_vta'],2,',','.'); ?>&nbsp;&nbsp;</div></td>
		              
	                </tr>
		            <?php } ?>
		            <?php // } ?>
		            </table></td>
	            </tr>
		        <tr >
		          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
	            </tr>
		        <!--TABLA DE LOS TOTALES-->
		        <tr >
		          <td  align="left" ><table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
		            <tr  >
		              <td width="210" class="tabla_pedidos_totales"  >Sub Total&nbsp;: </td>
		              <td width="100" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_pedidos[0]['tot_bruto'],2,'.',','); ?>&nbsp;&nbsp;</div></td>
	                </tr>
		            <tr  >
		              <td width="250" class="tabla_pedidos_totales" >I.V.A&nbsp;:</td>
		              <td width="60" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_pedidos[0]['iva'],2,'.',','); ?>&nbsp;&nbsp;</div></td>
	                </tr>
		            <tr  >
		              <td width="250" class="tabla_pedidos_totales" >Total&nbsp;:</td>
		              <td width="60" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_pedidos[0]['tot_neto'],2,'.',','); ?>&nbsp;&nbsp;</div></td>
	                </tr>
		            </table></td>
	            </tr>
		        <!--TABLA DE LOS TOTALES-->
		        <tr >
		          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
	            </tr>
                 <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">Conforme la Nota y Luego Finalize</td>
                        </tr>
						<tr >
                          <td  align="left" >
                               <?php if($nota_lista){?>
                            	<input type="submit" name="op" id="op" value="Finalize Nota" class="form_boton_grande"  >
                                <input type="submit" name="op" id="op" value="Rechazar Nota" class="form_boton_grande"  >                                
                            <?php }else{ ?> 
                            	<input type="submit" name="op" id="op" value="Conformar Nota" class="form_boton_grande"  >
                         	<?php } ?>
                         </td>
                        </tr>
		        <tr>
                	<td>&nbsp;</td>
                </tr>
                 <tr >
		          <td align="left" class="tablas_pedidos_bolg" >Observaciones</td>
	            </tr>
		        <tr >
		          <td  align="left" ><span class="form_label_procesos_imp">
		            <?php  echo $arr_pedidos[0]['descrip'];?>
		            </span></td>
	            </tr>
	          </table></td>
	        </tr>
	      </table>
    </form>
             
            <br />
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
        </div>
        <div id="footer">
        <!--ESTE ES EL FOOTER-->
        <!--ESTE ES EL FOOTER-->
        </div>
     <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
    </div>
<!--ESTE ES EL BODY-->
</body>
</html>
