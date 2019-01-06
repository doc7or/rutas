<?php
	include("../lib/core.lib.php");
	$obj_guia_carga= new class_guia_carga;
	
	
//CONSULTAS Y PROCESOS ADELANTE
	//buscamos la guia de la que se etsa trabajando
	$arr_GC=$obj_guia_carga->getGCInf($_REQUEST['id']);
	//buscamoe el listado de clientes asociados en este  control de salida getListConSalDetCli($id_control_salida)
	$arr_GCD=$obj_guia_carga->getListGCDCli($_REQUEST['id']);
	
?>

<div id="resulTabla" >
                	<!--TABLA DE FILTROS -->
                     <table class="tablas_procesos_datos">
                        <tr>
                            <td class="form_label_proceso" colspan="8">DATOS DE LA GUIA DE CARGA</td>
                        </tr>
                        <tr>
                            <td width="13%" class="form_label_proceso" >Numero: </td>
                            <td width="13%" class="form_label_procesos_imp" ><?php echo $arr_GC[0]['id']; ?></td>
                            <td width="10%" class="form_label_proceso">Por Sucursal: </td>
                            <td width="14%" class="form_label_procesos_imp" ><?php echo $arr_GC[0]['id_por_sucursal']; ?></td>
                            <td width="10%" class="form_label_proceso">status: </td>
                            <td width="19%" class="form_label_procesos_imp" >&nbsp;</td>
                            <td width="8%" class="form_label_proceso">Fecha: </td>
                            <td width="13%" class="form_label_procesos_imp" ><?php echo $arr_GC[0]['fecha']; ?></td>
                        </tr>
                        <tr>
                          <td class="form_label_proceso" >Placa/Chofer: </td>
                          <td class="form_label_procesos_imp"  colspan="2"><?php echo $arr_GC[0]['placa'].' - '.$arr_GC[0]['t_nombre'].' - '.$arr_GC[0]['t_apellido']; ?></td>
                          
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                          <td class="form_label_proceso">Transporte: </td>
                          <td class="form_label_procesos_imp" colspan="3" ><?php echo htmlentities($arr_GC[0]['e_descripcion']); ?></td>
                         
                        </tr>
                        <tr>
                          <td class="form_label_proceso" colspan="8" ></td>
                         
                        </tr>
                        <tr>
                          <td  colspan="8"  class="error_mesaje_acme"   id="mensaje_error">Clientes y Facturas</td>
                         
                        </tr>
                        <tr>
                          <td colspan="8" >
                    		<!--TABLA DE LOS NOMBRES DE LOS CLIENTES--> 
                            
                                <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
       <?php for($iCli=0;$iCli<sizeof($arr_GCD);$iCli++){?>   
                                    <tr  >
                                      <td width="67%" align="left"  class="tabla_report_tit_left" >
									  		<?php echo 'Cliente : '.$arr_GCD[$iCli]['co_cli'].'   '.$arr_GCD[$iCli]['cliente']; ?></td>
                                      <td width="33%" align="left"  class="tabla_report_tit_left">&nbsp;</td>  	
                                    </tr>
                                    <!--declaro la tabla de abajo de las facturas-->
                                    <tr  > 
                                     <td width="33%" align="left"  colspan="2"> 
                                     	 <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
                                    
                                    
            <?php 
                //buscamos los datos de estas facturas getCSDCli($id_control_salida='',$cliente='')
                $arrGCDCli=$obj_guia_carga->getGCDInf($_REQUEST['id'],$arr_GCD[$iCli]['co_cli']);
				for($iFact=0;$iFact<sizeof($arrGCDCli);$iFact++){
            ?>
                                         
                                           <tr >
                                              <td width="67%" align="left"  class="tabla_report_tit_left" >
                                                <?php echo 'Control de Carga Numero : '.$arrGCDCli[$iFact]['fact_num'].'   Monto :'.$arrGCDCli[$iFact]['tot_neto']; ?></td>
                                              <td width="33%" align="left"  class="tabla_report_tit_left">&nbsp;</td>  	
                                            </tr>
                                            <!--declaro la tabla de abajo de los renglones-->
                                         	 <!--declaro la tabla de abajo de las facturas-->
                                            <tr  > 
                                             <td width="33%" align="left"  colspan="2"> 
                                                 <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
                                                      <tr  >
                                                        <td  class="tabla_pedidos_titulos" >Reng</td>
                                                        <td class="tabla_pedidos_titulos" >Articulo</td>
                                                       	<td  class="tabla_pedidos_titulos" >Cant</td>
                                                        <td class="tabla_pedidos_titulos" >Precio</td>
                                                        <td class="tabla_pedidos_titulos" >Neto</td>
                                                      </tr>
            <?php 
                //buscamos los datos de los renglones de esta nota de entrea
                $arrGCDReng=$obj_guia_carga->get_GCDRInf($arrGCDCli[$iFact]['id']);
				for($iReng=0;$iReng<sizeof($arrGCDReng);$iReng++){
					//llamado de las clases para filas impares y pares  tabla_renglones_ina_num
						  if ($iReng % 2){
							$clase_text = "tablas_renglones_imp_text";
							$clase_num = "tablas_renglones_imp_num";
							} else{
							$clase_text = "tablas_renglones_par_text";
							$clase_num = "tablas_renglones_par_num";
						  }
            ?>                                  
                                                         <tr >
                                                            <td class="<?php echo $clase_num; ?>" ><?php echo $arrGCDReng[$iReng]['reng_num']; ?></td>
                                                            <td class="<?php echo $clase_text; ?>" >
																	<?php echo $arrCSDReng[$iReng]['co_art'].'  '.$arrGCDReng[$iReng]['art_des']; ?></td>
                                                            <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['total_art'],0); ?></td>
                                                             <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['prec_vta'],2); ?></td>
                                                             <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['reng_neto'],2); ?></td>
                                                            
                                                        </tr>
                     								                            
             <?php  }//fin listado de renglones ?>                                    
                                                 </table>
                                             </td>
                                            </tr>
                                            <tr  >
                                              <td align="left"  colspan="2">&nbsp;</td>
                                            </tr>
                                    
       <?php  }//fin listado de facturas ?>
       									 </table>
       								 </td>    	
                                    </tr> 
                                    <!--fin de la declaracion de la tabla de facturas-->
	   <?php }//fin listado de clientes ?>
                                </table>
                            <!--TABLA DE LOS NOMBRES DE LOS CLIENTES--> 
                          
                          </td>
                        </tr>
                        <tr>
                          <td colspan="8" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="8" align="right" >
                          <table class="tablas_filtros" >
                              <tr align="center">
                                <td width="8%" >&nbsp;</td>
                                 <td width="57%" >
                                 		<!--<img  src="../images/tick.png" title="Volver al menu" alt="Volver al menu"  style="border:none"
                               onclick="completo('importe_','generalidad_','##','<?php echo sizeof($arr_factura_reng); ?>')" /><br />
                                  <font class="form_barra_text">Completo</font>-->
                                </td>
                                <td width="35%"  >	
                                		
                                     <!-- <input type="submit" style="background-image:url(../images/disk.png); height:16px; width:16px; border:0" value="" />
                                     -->  
                                		<img src="../images/arrow_rotate_anticlockwise.png" title="Publicar Guia/Control" alt="Publicar Guia/Control"  style="border:none" 
                                        onclick="simulHref('forma_guia_transporte_list.php?tipo=1&mod=1&pubicar=1&id=<?php echo $_REQUEST['id']; ?>')" />
                                        <br />
                                  		<font  class="form_barra_text"  >Publicar Guia / Control</font>
                                </td>
                               
                              </tr>
                          </table>
                          </td>
                        </tr>
                     </table>
                    <!--TABLA DE FILTROS -->
                	
       </div>
  
 