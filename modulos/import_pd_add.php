<?php 
include("../lib/core.lib.php");

$obj_vehiculo= new class_vehiculo;
$obj_empresa= new class_empresa;
$obj_escolta= new class_escolta;
$obj_ruta_base= new class_ruta_base;
$obj_tabulador_costo= new class_tabulador_costo;
$obj_transportista= new class_transportista;
$obj_zona= new class_zona;
$obj_estado= new class_estado;

?>
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
		  <div id="header" ></div>
  <div id="menu" >
          	<?php include ("../lib/common/menu_superior.php");?>
          </div>
		  <div id="contenido" > 
          	<div id="menu_visual" ></div>
            <div id="espacio_trabajo" >
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <form name="form1" id="form1" action="" method="post"  >
                <table align="center" width="95%" >
                  <tr class="tabla_barra_opciones" >
                    <td colspan="2"><table class="tabla_opciones" >
                        <tr >
                          <td width="72%" class="form_titulo_procesos" >Proforma Dividida</td>
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
                                  <td width="18%" class="form_sub_titulo_menor"> Fecha: </td>
                                  <td class="form_label_procesos_imp" width="31%" ><?php echo date('d/m/Y');?> </td>
                                  <td class="form_sub_titulo_menor" width="17%"> Fecha Proforma:</td>
                                  <td class="form_label_procesos_imp" width="34%"><input type="text" class="form_caja_proceso" /></td>
                                </tr>
                                <tr>
                                  <td class="form_sub_titulo_menor">Proforma Principal</td>
                                  <td class="form_label_procesos_imp" ><input type="text" class="form_caja_proceso" value="256987" /></td>
                                  <td class="form_sub_titulo_menor">No  Proforma</td>
                                  <td class="form_label_procesos_imp"><input type="text" class="form_caja_proceso" value="256987-1" /></td>
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
                                              <td width="5%" class="form_sub_titulo_menor"><div align="center"><strong></strong></div></td>
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Ma4m54"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_2"  id="fac_mon_2" type="text" class="form_caja_proceso_numero" value="Aire split 12000"  readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="300" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center"><input name="fac_mon_3"  id="fac_mon_3" type="text" class="form_caja_proceso_numero" value="10000"  readonly="readonly"/></td>
                                              <td align="center" id="fac_img_0">&nbsp;</td>
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Marm54"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Aire split 12000"  readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="1200" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value="40000"  readonly="readonly"/></td>
                                              <td align="center" id="fac_img_0">&nbsp;</td>
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Ma4514"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Split 20000"  readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="400" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value="25000"  readonly="readonly"/></td>
                                              <td align="center" id="fac_img_0">&nbsp;</td>
                                            </tr>
                                            <tr id="factura_0">
                                            	<td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Ma59876"  readonly="readonly"/></td>
                                              <td align="center"><input name="fac_mon_"  id="fac_mon_" type="text" class="form_caja_proceso_numero" value="Aire 4 Toneladas"  readonly="readonly"/></td>
                                              <td align="center">
                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="100" onchange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" /></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value="20000"  readonly="readonly"/></td>
                                              <td align="center" id="fac_img_0"><img src="../images/pluss.png" alt="" /></td>
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
                                    	<!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS--></td>
                      </tr
                        ><tr >
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
		  </div>
		  <div id="footer" >
		  	<?php include ("../lib/common/footer.php"); ?>
          </div>
	</div>
</body>
<script language="javascript">
	$("#seccion_ruta").addClass('not_display');
</script>
</html>
