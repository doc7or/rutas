
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>

</head>

<body id="todo">

    <div id="contenedor" >
		 
 
		
            
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <form name="form1" id="form1" action="" method="post"  >
                <table align="center" width="95%" >
                  <tr class="tabla_barra_opciones" >
                    <td colspan="2"><table class="tabla_opciones" >
                        <tr >
                          <td width="72%" class="form_titulo_procesos" >Proforma Principal Edicion</td>
                          <td width="28%"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="20%" >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%" ><a href="vehiculo_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center"><table class="tablas_procesos" >
                        <tr class="error_mesaje_acme" >
                          <td align="center"  ></td>
                        </tr>
                        
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td ><!--DATOS ENCABEZADO-->
                              <table class="tablas_procesos_datos">
                                <tr>
                                  <td width="16%" class="form_sub_titulo_menor"> Fecha: </td>
                                  <td class="form_label_procesos_imp" width="33%" ><?php echo date('d/m/Y');?> </td>
                                  <td class="form_sub_titulo_menor" width="17%"> Fecha Proforma:</td>
                                  <td class="form_label_procesos_imp" width="34%"><input type="text" class="form_caja_proceso" /></td>
                                </tr>
                                <tr>
                                  <td class="form_sub_titulo_menor">Proveedor</td>
                                  <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="sougon" /></td>
                                  <td class="form_sub_titulo_menor">No  Proforma</td>
                                  <td class="form_label_procesos_imp"><input type="text" class="form_caja_proceso" value="256987" /></td>
                                </tr>
                                <tr>
                                  <td class="form_sub_titulo_menor">Origen</td>
                                  <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="China" /></td>
                                  <td class="form_sub_titulo_menor">BL</td>
                                  <td class="form_label_procesos_imp"><input type="text" class="form_caja_proceso" value="2548sees158" /></td>
                                </tr>
                              </table>
                          <!--DATOS ENCABEZADO-->                          </td>
                        </tr>
                        <tr >
                          <td  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><!--TABLA DE LAS FACTURAS -->
                              <table class="tablas_procesos_datos">
                               <tr>
                                  <td class="form_sub_titulo_menor">Detalle de la orden de compra</td>
                                </tr>
                               
                                <tr>
                                	<td>
                                    	<!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->
                                        <table  id="tabla_facturas" width="100%" cellpadding="0">
                                        	<tr>
                                              <td width="32%" class="form_sub_titulo_menor"><div align="center">CODIGO</div></td>
                                              <td width="32%" class="form_sub_titulo_menor"><div align="center"><strong>DESCRIPCIÓN</strong></div></td>
                                              <td width="36%" class="form_sub_titulo_menor"><div align="center"><strong>CANTIDAD</strong></div></td>
                                              <td width="25%" class="form_sub_titulo_menor"><div align="center"><strong>MONTO</strong></div></td>
                                             
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Ma4512"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Aire acondicionado 9000" readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="1000" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value="15000"  readonly="readonly"/></td>
                                              
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Ma4513"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Aire split 12000"  readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="1500" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value="15000"  readonly="readonly"/></td>
                                              
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Ma4514"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Split 20000"  readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="900" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value="25980"  readonly="readonly"/></td>
                                              
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Ma4569"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Aire 4 Toneladas"  readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="300" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value="30000"  readonly="readonly"/></td>
                                              
                                          </tr>
                                        </table>
                                        <!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->                                    </td>
                                </tr>
                              </table>
                            <!--TABLA DE LAS FACTURAS -->                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                         <tr>
                                	<td>
                                    	<!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->
                                      <table  id="tabla_facturas2" width="100%" cellpadding="0">
                                          <tr class="tablas_respuesta">
                                            <td  colspan="3"><div align="left" >Preforma Aprobada</div></td>
                                            <td width="38%" align="center"><img  src="../imagenes_importa/accept.png" alt=""/></td>
                                        </tr>
                                          <tr  class="tablas_respuesta">
                                            <td   colspan="3"><div align="left">Proforma Dividida</div></td>
                                            <td align="center"><img  src="../imagenes_importa/arrow_out_g.png"/><img  src="../imagenes_importa/arrow_out.png" alt=""/></td>
                                          </tr>
                                          <tr>
                                            <td width="16%" class="form_sub_titulo_menor">Proformas:</td>
                                            <td class="form_label_procesos_imp"  colspan="3">256987-1,256987-2, 256987-3,256987-4,256987-5,256987-6,256987-7</td>
                                          
                                        </tr>
                                    
                                          <tr  class="tablas_respuesta">
                                            <td   colspan="3"><div align="left"><strong>Aprobación</strong> de Cadivi</div></td>
                                            <td align="center"><img  src="../imagenes_importa/asterisk_yellow_g.png"/><img  src="../imagenes_importa/asterisk_yellow.png"/></td>
                                          </tr>
                                    	  <tr>
                                            <td class="form_sub_titulo_menor">En la fecha:</td>
                                    	    <td width="35%" class="form_label_procesos_imp" >18/11/2008</td>
                                    	    <td width="11%" class="form_sub_titulo_menor">AAD No</td>
                                    	    <td class="form_label_procesos_imp">258779864</td>
                                  	    </tr>
                                         <tr>
                                            <td class="form_sub_titulo_menor">Aprobado el:</td>
                                    	    <td class="form_label_procesos_imp" >23/11/2008</td>
                                    	    <td class="form_sub_titulo_menor">&nbsp;</td>
                                    	    <td class="form_label_procesos_imp">&nbsp;</td>
                                  	    </tr>
                                          <tr  class="tablas_respuesta">
                                            <td   colspan="3"><div align="left">Embarcado</div></td>
                                            <td align="center"><img  src="../imagenes_importa/arrow_down_g.png"/><img  src="../imagenes_importa/arrow_down.png"/></td>
                                          </tr>
                                    	  <tr>
                                            <td class="form_sub_titulo_menor">En la fecha:</td>
                                    	    <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="18/11/2008" /></td>
                                    	    <td class="form_sub_titulo_menor">Naviera</td>
                                    	    <td class="form_label_procesos_imp"><select name="transportista2" id="transportista2" class="form_pool_proceso" >
                                              <option value="0">Seleccione...</option>
                                            </select></td>
                                  	    </tr>
                                          <tr  class="tablas_respuesta">
                                            <td   colspan="3"><div align="left">BL</div></td>
                                            <td align="center"><img  src="../imagenes_importa/bl_g.png" alt=""/><img  src="../imagenes_importa/bl.png"/></td>
                                          </tr>
                                    	  <tr> </tr>
                                    	  <tr>
                                            <td class="form_sub_titulo_menor">Recibido el:</td>
                                    	    <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="21/11/2008" /></td>
                                    	    <td class="form_sub_titulo_menor">Numero</td>
                                    	    <td class="form_label_procesos_imp"><input type="text" class="form_caja_proceso" value="26548936" /></td>
                                  	    </tr>
                                         <tr  class="tablas_respuesta">
                                            <td   colspan="3"><div align="left">Almacenado</div></td>
                                            <td align="center"><img  src="../imagenes_importa/hourglass_add_g.png"/><img  src="../imagenes_importa/hourglass_add.png"/><img  src="../imagenes_importa/hourglass_delete.png"/></td>
                                          </tr>
                                             <tr>
                                            <td class="form_sub_titulo_menor">En la fecha:</td>
                                    	    <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="29/11/2008" /></td>
                                    	    <td class="form_sub_titulo_menor">&nbsp;</td>
                                    	    <td class="form_label_procesos_imp">&nbsp;</td>
                                           </tr>
                                          <tr  class="tablas_respuesta">
                                            <td   colspan="3"><div align="left">Nacionalizado</div></td>
                                            <td align="center"><img  src="../imagenes_importa/house_g.png" alt=""/><img  src="../imagenes_importa/house.png"/></td>
                                          </tr>
                                           <tr>
                                            <td class="form_sub_titulo_menor">En la fecha:</td>
                                    	    <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="25/11/2008" /></td>
                                    	    <td class="form_sub_titulo_menor">&nbsp;</td>
                                    	    <td class="form_label_procesos_imp">&nbsp;</td>
                                           </tr>
                                           <tr>
                                            <td class="form_sub_titulo_menor">R Sidunea:</td>
                                    	    <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="2008 - 4596678" /></td>
                                    	    <td class="form_sub_titulo_menor">Referencia</td>
                                    	    <td class="form_label_procesos_imp"><input type="text" class="form_caja_proceso" value="152547882214" /></td>
                                        </tr>
                                         <tr>
                                            <td class="form_sub_titulo_menor">foma 0086:</td>
                                    	    <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="9500" /></td>
                                    	    <td class="form_sub_titulo_menor">50% Taza</td>
                                    	    <td class="form_label_procesos_imp"><input type="text" class="form_caja_proceso" value="4750" /></td>
                                        </tr>
                                         <tr>
                                            <td class="form_sub_titulo_menor">Impuesto Municiopal:</td>
                                   	       <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="3500" /></td>
                                    	    <td class="form_sub_titulo_menor">&nbsp;</td>
                                   	        <td class="form_label_procesos_imp">&nbsp;</td>
                                        </tr>
                                    	
                                           <tr  class="tablas_respuesta">
                                            <td   colspan="3"><div align="left">Enviado a Sucursales</div></td>
                                            <td align="center"><img  src="../imagenes_importa/lorry_go_g.png"/><img  src="../imagenes_importa/lorry_go.png"/></td>
                                          </tr>
                                           
                                    	   <tr>
                                            <td class="form_sub_titulo_menor">Eniado el:</td>
                                    	    <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="29/11/2008" /></td>
                                    	    <td class="form_sub_titulo_menor">&nbsp;</td>
                                    	    <td class="form_label_procesos_imp">&nbsp;</td>
                                           </tr>
                                        </table>                                      <!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->                                    </td>
                         </tr
                        >
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <!--CARGA DE LA FACTURA-->
                        <tr >
                          <td  align="center"></td>
                        </tr>
                        <!--CARGA DE LA FACTURA-->
                        <!--ENVIO DE FORMULARIO-->
                        <tr>
                          <td align="center" >
                          	<input name="save" type="button" class="form_botones" id="save" style="cursor:hand" value="Guardar"/>                          </td>
                        </tr>
                        <!--ENVIO DE FORMULARIO-->
                        <tr >
                          <td height="10"  id="id_carga_factura"></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
              </form>
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
         
		
		  
	</div>
</body>
<script language="javascript">
	$("#seccion_ruta").addClass('not_display');
</script>
</html>
