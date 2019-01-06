<?php
	include("../lib/core_cyberlux.lib.php");
	$obj_cyberlux_not_ent= new class_cyberlux_not_ent;
	
	//get_cyberlux_not_ents($fact_num='')
	$arr_not_ent=$obj_cyberlux_not_ent->get_cyberlux_not_ent($_REQUEST['id']);
	//get_cyberlux_not_ents_reng($fact_num='');
	$arr_not_ent_reng=$obj_cyberlux_not_ent->get_cyberlux_not_ent_reng($_REQUEST['id']);
	
?>
<div id="resulTabla" >
                	<!--TABLA DE FILTROS -->
                	<div id="resulTabla2" >
                	  <!--TABLA DE FILTROS -->
                	  <table class="tablas_procesos_datos">
                	    <tr>
                	      <td class="form_label_proceso" colspan="8">DATOS CONTROL DE CARGA</td>
              	      </tr>
                	    <tr>
                	      <td width="10%" class="form_label_proceso" >Numero: </td>
                	      <td width="16%" class="form_label_procesos_imp" ><?php echo $arr_not_ent[0]['fact_num']; ?></td>
                	      <td width="10%" class="form_label_proceso">Cond Pago: </td>
                	      <td width="14%" class="form_label_procesos_imp" >&nbsp;</td>
                	      <td width="10%" class="form_label_proceso">status: </td>
                	      <td width="19%" class="form_label_procesos_imp" >&nbsp;</td>
                	      <td width="8%" class="form_label_proceso">Fecha: </td>
                	      <td width="13%" class="form_label_procesos_imp" >&nbsp;</td>
              	      </tr>
                	    <tr>
                	      <td class="form_label_proceso" >Cliente:</td>
                	      <td class="form_label_procesos_imp" colspan="3" ><?php echo $arr_not_ent[0]['co_cli'].'  '.$arr_not_ent[0]['cli_des']; ?></td>
                	      <td class="form_label_procesos_imp">&nbsp;</td>
                	      <td class="form_label_procesos_imp" >&nbsp;</td>
                	      <td class="form_label_proceso">Entrega:</td>
                	      <td class="form_label_procesos_imp" >&nbsp;</td>
              	      </tr>
                	    <tr>
                	      <td class="form_label_proceso" >Vendedor: </td>
                	      <td class="form_label_procesos_imp"  colspan="2"><?php echo $arr_not_ent[0]['co_ven']; ?></td>
                	      <td class="form_label_procesos_imp" >&nbsp;</td>
                	      <td class="form_label_proceso">Transporte: </td>
                	      <td class="form_label_procesos_imp" colspan="3" >&nbsp;</td>
              	      </tr>
                	    <tr>
                	      <td class="form_label_proceso" >Descripcion: </td>
                	      <td class="form_label_procesos_imp" colspan="2" ><?php echo $arr_not_ent[0]['descrip']; ?></td>
                	      <td class="form_label_procesos_imp" >&nbsp;</td>
                	      <td class="form_label_proceso">&nbsp;</td>
                	      <td class="form_label_procesos_imp" >&nbsp;</td>
                	      <td class="form_label_proceso">&nbsp;</td>
                	      <td class="form_label_procesos_imp" >&nbsp;</td>
              	      </tr>
                	    <tr>
                	      <td class="form_label_proceso" colspan="8" >&nbsp;</td>
              	      </tr>
                	    <tr>
                	      <td  colspan="8"  class="error_mesaje_acme"   id="mensaje_error">&nbsp;</td>
              	      </tr>
                	    <tr>
                	      <td colspan="8" ><!--TABLA DE RENGLONES -->
                	        <table class="tabla_not_ents" width="100%" cellpadding="0" cellspacing="0">
                	          <tr  >
                	            <td  class="tabla_pedidos_titulos" >Reng</td>
                	            <td class="tabla_pedidos_titulos" >Articulo</td>
                	            <td class="tabla_pedidos_titulos" >Precio</td>
                	            <td  class="tabla_pedidos_titulos" >Cant</td>
                	            <!--<td  class="tabla_pedidos_titulos" >Pendi</td>-->
                	            <td class="tabla_pedidos_titulos" >Imp</td>
                	            <td class="tabla_pedidos_titulos" >Neto</td>
                	            <td width="36" class="tabla_pedidos_titulos" >Iva</td>
                	            <td width="351" class="tabla_pedidos_titulos" >Descripcion</td>
              	            </tr>
                	          <!--AQUI VA LAS COSAS DE EL not_ent0 TANTO LA DIVISION POR LINEAS COMO LOS PRODUCTOS EN SI-->
                	          <?php 
				 	$total=0;
				 	for($i=0;$i<sizeof($arr_not_ent_reng);$i++){
					 //llamado de las clases para filas impares y pares  tabla_renglones_ina_num
						  if ($i % 2){
							$clase_text = "tablas_renglones_imp_text";
							$clase_num = "tablas_renglones_imp_num";
							} else{
							$clase_text = "tablas_renglones_par_text";
							$clase_num = "tablas_renglones_par_num";
						  }
						/*if($arr_not_ent_reng[$i]['pendiente']<1){
							$clase_text = "tablas_renglones_nod_text";
							$clase_num = "tablas_renglones_nod_num";
						}*/
										
				?>
                	          <tr >
                	            <td class="<?php echo $clase_num; ?>" width="36" ><?php echo $arr_not_ent_reng[$i]['reng_num']; ?>&nbsp;</td>
                	            <td class="<?php echo $clase_text; ?>" width="266" ><?php echo $arr_not_ent_reng[$i]['art_des']; ?></td>
                	            <td class="<?php echo $clase_num; ?>" width="91" ><?php echo number_format($arr_not_ent_reng[$i]['prec_vta'],2,',','.'); ?>&nbsp; </td>
                	            <td  class="<?php echo $clase_num; ?>" width="49" ><?php echo number_format($arr_not_ent_reng[$i]['total_art'],0); ?>&nbsp; </td>
                	           <!-- <td  class="<?php echo $clase_num; ?>" width="49" id="muestraPen<?php echo $i; ?>" ><?php //echo number_format($arr_not_ent_reng[$i]['pendiente'],0); ?>&nbsp; </td>-->
                	            <td  class="<?php echo $clase_num; ?>" width="54" >
                	              <input type="text" name="importe_<?php echo $i; ?>" id="importe_<?php echo $i; ?>" value="0"  
                                    onkeypress="return acceptNum(event)" 
                                    onchange="valIntruMan('generalidad_<?php echo $i; ?>',0,'importe_<?php echo $i; ?>')"
                                    class="form_caja_tabulador"/>
                	              <!--CAJA DE GENERALIDAD DE EL CAMPO-->
                	              <input type="hidden" name="generalidad_<?php echo $i; ?>" id="generalidad_<?php echo $i; ?>" 
                                    value="<?php echo number_format($arr_not_ent_reng[$i]['pendiente'],0).'##'.$arr_not_ent_reng[$i]['reng_num'].'##'.$arr_not_ent_reng[$i]['fact_num'].'##'.trim(htmlspecialchars($arr_not_ent_reng[$i]['co_art'])).'##'.$arr_not_ent_reng[$i]['prec_vta'].'##'.trim(htmlspecialchars($arr_not_ent_reng[$i]['art_des'])).'##'.$arr_not_ent_reng[$i]['total_art'].'##'.$arr_not_ent_reng[$i]['co_alma'].'##'.$arr_not_ent_reng[$i]['porc_desc'].'##'.$arr_not_ent_reng[$i]['reng_neto']; ?>" />
                	             
                	              &nbsp; </td>
                	            <td  class="<?php echo $clase_num; ?>" width="80" ><?php echo number_format($arr_not_ent_reng[$i]['reng_neto'],2,',','.'); ?>&nbsp; </td>
                	            <td  class="<?php echo $clase_num; ?>" width="36" ><?php echo $arr_not_ent_reng[$i]['tipo_imp']; ?>&nbsp;</td>
                	            <td  class="<?php echo $clase_text; ?>" width="351" >&nbsp; <?php echo $arr_not_ent_reng[$i]['comentario']; ?></td>
              	            </tr>
                	          <?php } ?>
                	          <!--AQUI ESTARA EL LSIADO DE ARTICULOS-->
              	          </table>
                	        <!--TABLA DE RENGLONES --></td>
              	      </tr>
                	    <tr>
                	      <td colspan="8" >&nbsp;</td>
              	      </tr>
                	    <tr>
                	      <td colspan="2" ><input type="hidden" name="generali_not_ent" id="generali_not_ent" value="<?php echo trim($arr_not_ent[0]['co_cli']).'##'.trim($arr_not_ent[0]['co_ven']).'##'.$arr_not_ent[0]['cli_des'].'##'.$arr_not_ent[0]['tot_bruto'].'##'.$arr_not_ent[0]['descrip'].'##'.$arr_not_ent[0]['fec_emis'].'##'.trim($arr_not_ent[0]['co_tran']).'##'.$arr_not_ent[0]['tot_neto'] ; ?>"  />
                	        <input type="hidden" name="validador" id="validador" value="0"  />
                	        <input type="hidden" name="totalReng" id="totalReng" value="<?php echo sizeof($arr_not_ent_reng); ?>"  /></td>
                	      <td colspan="3"></td>
                	      <td colspan="3" align="right"><!--carpeta de occioneds-->
                	        <!--carpeta de occioneds-->
                	        <table class="tablas_filtros" >
                	          <tr align="center">
                	            <td width="8%" >&nbsp;</td>
                	            <td width="57%" ><img  src="../images/tick.png" title="Volver al menu" alt="Volver al menu"  style="border:none"
                               onclick="completo('importe_','generalidad_','##','<?php echo sizeof($arr_not_ent_reng); ?>')" /><br />
                	              <font class="form_barra_text">Completo</font></td>
                	            <td width="35%"  ><!-- <input type="submit" style="background-image:url(../images/disk.png); height:16px; width:16px; border:0" value="" />
                                     -->
                	              <img  src="../images/disk.png" title="Volver al menu" alt="Volver al menu"  style="border:none" 
                                        onclick="cargaMyForm()" /> <br />
                	              <font  class="form_barra_text"  >Add a la Guia / Control</font></td>
              	            </tr>
              	          </table></td>
              	      </tr>
              	    </table>
                	  <!--TABLA DE FILTROS -->
              	  </div>
                	<!--TABLA DE FILTROS -->
                	
       	   </div>
 