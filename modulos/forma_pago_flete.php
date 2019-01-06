<?php 
include("../lib/core.lib.php");
if($_SESSION['id_tipo_usuario']!=1) header('Location: ../lib/common/logout.php');
$obj_vehiculo= new class_vehiculo;
$obj_vehiculo_tipo= new class_vehiculo_tipo;
$arr_vehiculo_tipo = $obj_vehiculo_tipo->get_list_vehiculo_tipo();
$obj_empresa= new class_empresa;
$arr_empresa = $obj_empresa->get_empresa();
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
                    <td colspan="6"><table class="tabla_opciones" >
                        <tr >
                          <td width="72%" class="form_titulo_procesos" >Pago de Fletes</td>
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
                          <td ><!--ENCABEZADO DE LA FORMA DE REACION DE FLETE-->
                              <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                                <tr>
                                  <td width="17%" align="center"><img src="../images/img_nemartiz.png" alt="" width="90" height="58"     /></td>
                                  <td width="55%">&nbsp;</td>
                                  <td width="28%" > No <font class="tablas_procesos_correlativos"><?php echo 57;?></font> </td>
                                </tr>
                              </table>
                            <!--ENCABEZADO DE LA FORMA DE REACION DE FLETE-->
                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td >
                          <!--DATOS ENCABEZADO-->
                              <table class="tablas_procesos_datos">
                                <tr>
                                  <td width="15%" class="form_label_proceso"> Fecha: </td>
                                  <td class="form_label_procesos_imp" colspan="3"><?php echo date('d/m/Y');?> </td>
                                </tr>
                                <tr>
                                  <td width="15%" class="form_label_proceso">Desde: </td>
                                  <td  width="35%" class="form_label_procesos_imp" ><input name="factura_8" type="text" class="form_caja_proceso_numero" id="factura_10" value="12/10/2008" readonly="readonly" /></td>
                                   <td  width="15%"  class="form_label_proceso">Hasta: </td>
									<td width="35%" class="form_label_procesos_imp"><input name="factura_9" type="text" class="form_caja_proceso_numero" id="factura_11" value="17/10/2008" readonly="readonly" /></td>
                                </tr>
                                
                                <tr>
                                  <td class="form_label_proceso">Responsabe: </td>
								  <td  class="form_label_procesos_imp">
                                  <select name="tipo3" id="tipo3" class="form_pool_proceso" >
                                      <option value="0">Seleccione...</option>
                                      <?php  
                                                                for ($i=0; $i<sizeof($arr_usuario_tipo);$i++) { ?>
                                      <option value="<?=$arr_usuario_tipo[$i]['id']?>"> <?php echo $arr_usuario_tipo[$i]['descripcion'];?> </option>
                                      <?php }?>
                                    </select>                                  </td> 
                                    <td  width="15%"  class="form_label_proceso">Transportista: </td>
									<td width="35%" class="form_label_procesos_imp"><select name="tipo" id="tipo" class="form_pool_proceso" >
                                      <option value="0">Seleccione...</option>
                                      <?php  
                                                                for ($i=0; $i<sizeof($arr_usuario_tipo);$i++) { ?>
                                      <option value="<?=$arr_usuario_tipo[$i]['id']?>"> <?php echo $arr_usuario_tipo[$i]['descripcion'];?> </option>
                                      <?php }?>
                                    </select></td>
                                </tr>
                              </table>
                          <!--DATOS ENCABEZADO-->                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        
                        <tr >
                          <td height="5"  align="center">
                          <!--TABLA DE LAS FACTURAS -->
                          <table class="tablas_procesos_datos">
                        <tr>
                          <td width="10%" class="form_label_proceso"><div align="center">No Guia</div></td>
                          <td width="13%" class="form_label_proceso"><div align="center">Fecha</div></td>
                          <td width="34%" class="form_label_proceso"><div align="center">Destino</div></td>
                          <td width="14%" class="form_label_proceso"><div align="center">Monto</div></td>
                          <td width="14%" class="form_label_proceso"><div align="center">Adelanto</div></td>
                          <td width="15%" class="form_label_proceso"><div align="center">Restante</div></td>
                            </tr>
                        <tr>
                          <td><div align="center">256</div></td>
                          <td ><div align="center">12/10/2008</div></td>
                          <td >Valencia  – Cumana</td>
                          <td ><div align="right">Bfs.  950,00</div></td>
                          <td ><div align="right">Bfs.  150,00</div></td>
                          <td ><div align="right">Bfs.  800,00</div></td>
                        </tr>
                        <tr class="tablas_listados_datos_par">
                          <td><div align="center">259</div></td>
                          <td ><div align="center">12/10/2008</div></td>
                          <td >Valencia  -  Caracas</td>
                          <td ><div align="right">Bfs.  350,00</div></td>
                          <td ><div align="right">Bfs.  50,00</div></td>
                          <td ><div align="right">Bfs.  300,00</div></td>
                        </tr>
                        <tr>
                          <td><div align="center">260</div></td>
                          <td ><div align="center">15/10/2008</div></td>
                          <td >Valencia  -  San Carlos</td>
                          <td ><div align="right">Bfs.  250,00</div></td>
                          <td ><div align="right">Bfs.  50,00</div></td>
                          <td ><div align="right">Bfs.  200,00</div></td>
                        </tr>
                        <tr class="tablas_listados_datos_par">
                          <td><div align="center">265</div></td>
                          <td ><div align="center">17/10/2008</div></td>
                          <td >Valencia  -  Barinas</td>
                          <td ><div align="right">Bfs. 800,00</div></td>
                          <td ><div align="right">Bfs.  100,00</div></td>
                          <td ><div align="right">Bfs.  700,00</div></td>
                        </tr>
                        <tr>
                          <td colspan="3"  class="form_label_subtotales"  align="right" ><strong>Totales Específicos:&nbsp;&nbsp;&nbsp;</strong></td>
                          
                          <td ><div align="right">Bfs.  2.350,00</div></td>
                          <td ><div align="right">Bfs.  350,00</div></td>
                          <td ><div align="right">Bfs.  2.000,00</div></td>
                        </tr>
                        <tr>
                          <td colspan="5"  class="form_label_subtotales"  align="right" ><strong>Total a Pagar:&nbsp;&nbsp;&nbsp;</strong> </td>
                          
                          <td ><div align="right">Bfs.  2.000,00</div></td>
                        </tr>
                              </table>                          
                            <!--TABLA DE LAS FACTURAS -->
                         </td>
                      </tr>
                       
                        <tr >
                          <td height="5"  align="center">
                          	<img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td height="5"  align="center">
                          	<!--DATOS DEL COSTO DEL VIAJE-->
                            <table class="tablas_procesos_datos">
                              <tr>
                                <td width="21%"  class="form_label_proceso">Forma de pago: </td>
                                <td width="36%" class="form_label_procesos_imp"><select name="tipo2" id="tipo2" class="form_pool_proceso" >
                                  <option value="0">Seleccione...</option>
                                  <?php  
                                                                for ($i=0; $i<sizeof($arr_usuario_tipo);$i++) { ?>
                                  <option value="<?=$arr_usuario_tipo[$i]['id']?>"> <?php echo $arr_usuario_tipo[$i]['descripcion'];?> </option>
                                  <?php }?>
                                </select></td>
                                <td width="14%" class="form_label_proceso">Numero:</td>
                                <td width="29%" class="form_label_procesos_imp"><input name="factura_" type="text" class="form_caja_proceso_numero" id="factura_" value="" readonly="readonly" /></td>
                              </tr>
                            </table>
                            <!--DATOS DEL COSTO DEL VIAJE-->                                  
                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center">
                          	<img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr>
                       	  <td align="center">
                           <!--DATOS DEL COSTO DEL VIAJE-->
                            <table class="tablas_procesos_datos">
                              <tr>
                                <td width="21%" class="form_label_proceso">Observaciones: </td>
                                <td width="79%" class="form_label_procesos_imp"><textarea id="ruta2" name="ruta2" class="form_text_proceso_ruta"></textarea></td>
                              </tr>
                            </table>
                            <!--DATOS DEL COSTO DEL VIAJE-->        
                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        
                        <!--ENVIO DE FORMULARIO-->
                        <tr>
                          <td align="center" ><input name="save" type="submit" class="form_botones" id="save" style="cursor:hand" value="Agregar"/>
                          </td>
                        </tr>
                        <!--ENVIO DE FORMULARIO-->
                        <tr >
                          <td height="10" ></td>
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
</html>
