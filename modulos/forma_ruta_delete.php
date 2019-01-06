<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1')) header('Location: ../lib/common/logout.php');

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
                          <td width="72%" class="form_titulo_procesos" >Creacion de Rutas Bases</td>
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
                      <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                      </tr>
                      <tr >
                        <td ><!--DATOS ENCABEZADO-->
                  <table class="tablas_procesos_datos">
                    <tr>
                      <td width="21%" class="form_label_proceso"> Nombre: </td>
                      <td width="79%" class="form_label_procesos_imp"><input name="factura_8" type="text" class="form_caja_proceso_ruta" id="factura_10" value="Ruta Valencia - Alta Gracias de Orituco" readonly="readonly" /></td>
                    </tr>
                  </table>
                          <!--DATOS ENCABEZADO-->
                        </td>
                      </tr>
                      <tr >
                        <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                      </tr>
                      <tr >
                        <td height="5"  align="center"><!--TABLA DE LAS FACTURAS -->
                  <table class="tablas_procesos_datos">
                    <tr>
                      <td width="40%" class="form_label_proceso"><div align="center">Estado</div></td>
                      <td width="22%" class="form_label_proceso"><div align="center">Zona</div></td>
                      <td width="24%" class="form_label_proceso"><div align="center">Adicione</div></td>
                    </tr>

                    <tr>
                      <td align="center"><select name="tipo" id="tipo" class="form_pool_proceso" >
                          <option value="0">Seleccione...</option>
                          <?php  
                                                    for ($i=0; $i<sizeof($arr_usuario_tipo);$i++) { ?>
                          <option value="<?=$arr_usuario_tipo[$i]['id']?>"> <?php echo $arr_usuario_tipo[$i]['descripcion'];?> </option>
                          <?php }?>
                      </select></td>
                      <td align="center"><select name="tipo" id="tipo" class="form_pool_proceso" >
                          <option value="0">Seleccione...</option>
                          <?php  
                                                    for ($i=0; $i<sizeof($arr_usuario_tipo);$i++) { ?>
                          <option value="<?=$arr_usuario_tipo[$i]['id']?>"> <?php echo $arr_usuario_tipo[$i]['descripcion'];?> </option>
                          <?php }?>
                      </select></td>
                      <td align="center"><div align="center"><img src="../images/pluss.png"  /></div></td>
                    </tr>
                  </table>
                          <!--TABLA DE LAS FACTURAS -->
                        </td>
                      </tr>
                      <tr >
                        <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                      </tr>
                      <tr>
                        <td align="center"><!--DATOS DEL COSTO DEL VIAJE-->
                  <!--DATOS DEL COSTO DEL VIAJE-->
                        </td>
                      </tr>
                      <!--CARGA DE LA FACTURA-->
                      <tr >
                        <td  align="center"></td>
                      </tr>
                      <!--CARGA DE LA FACTURA-->
                      <!--ENVIO DE FORMULARIO-->
                      <tr>
                        <td align="center" ><input name="save" type="submit" class="form_botones" id="save" style="cursor:hand" value="Guardar"/>
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
