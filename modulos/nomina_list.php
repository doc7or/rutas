<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');

$obj_control_salida= new class_control_salida;
$obj_nomina= new class_nomina;


$obj_sucursal = new class_sucursal;

if(inList($_SESSION['id_tipo_usuario'],'3,4,6')){
	$arr_sucursal = $obj_sucursal->get_sucursal();
}else{
	$arr_sucursal = $obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
}

$id=$_REQUEST['id'];
if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
else $id_sucursal=$_SESSION['id_sucursal'];

if($id_sucursal)	$arr_nomina=$obj_nomina->get_nomina('','',$id_sucursal);


$titulo='Listado de Ordenes de Pago';
if(!inList($_SESSION['id_tipo_usuario'],'1,2'))	$forma='nomina_list.php';
else 	$forma='nomina.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script></head>

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
                <br />
                <table align="center" width="90%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" ><?php echo $titulo; 
							  
						?> </td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados" >
                        <!--ENCABEZADOS-->
                        <tr class="tabla_barra_opciones" >
                          <td colspan="6"><table class="tabla_opciones" >
                              <tr >
                                <td width="72%"><table width="80%" class="tablas_filtros" >
                                  <tr>
                                    <td width="17%" valign="center" class="form_label" title="Guias por sucursal">Sucursal</td>
                                    <td width="44%"><select name="id_sucursal" id="id_sucursal" class="form_pool_proceso" onfocus="message_help(0)">
                                        <option value="0">Seleccione...</option>
                                        <?php  
                                                                    for ($i=0; $i<sizeof($arr_sucursal);$i++) { ?>
                                        <option value="<?php echo $arr_sucursal[$i]['id']; ?>" <?php if($id_sucursal==$arr_sucursal[$i]['id']) echo "selected";  ?>> <?php echo $arr_sucursal[$i]['descripcion'];?> </option>
                                        <?php }?>
                                    </select></td>
                                    <td width="39%">&nbsp;</td>
                                  </tr>

                                </table></td>
                                <td width="28%" valign="top" bgcolor="#FFFFFF"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  ><img src="../images/view.png" title="Buscar listado de Ordenes de Pago " alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" /><input type="hidden" name="acc" id="acc" /></td>
                                      <td width="20%" ><a href="<?php echo $forma;?>" ><img src="../images/pluss.png" title="Crear orden de pago " alt="Crear guia" style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="10%" >No.</td>
                          <td width="37%" >Fecha de Realizacion </td>
                          <td width="37%" >Fecha Final de Orden de Pago</td>
                          <td width="16%"  align="center">Opciones</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_nomina); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo $arr_nomina[$i]['id_por_sucursal']; ?></td>
                          <td bordercolor="#993366" ><?php echo muestraFechaSola($arr_nomina[$i]['fecha'],'es'); ?></td>
                          <td bordercolor="#993366" ><?php echo muestraFechaSola($arr_nomina[$i]['fecha_hasta'],'es'); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" ><a href="nomina_transportistas.php?id=<?php echo $arr_nomina[$i]['id'].'&id_por_sucursal='.$arr_nomina[$i]['id_por_sucursal'];  ?>"><img src="../images/user.png"  title="Ordenes de Pago de Transportistas" alt="Ordenes de Pago Transportistas" style="border:none" /></a></td>
                                 <td width="33%" ><a href="nomina_transportistas_reducido.php?id=<?php echo $arr_nomina[$i]['id'].'&id_por_sucursal='.$arr_nomina[$i]['id_por_sucursal'];  ?>"><img src="../images/user_send.png"  title="Ordenes de Pago de Transportistas con totales resumidos" alt="Ordenes de Pago Transportistas" style="border:none" /></a></td>
                                <td width="33%" ><a href="nomina_solicitud_fondos.php?id=<?php echo $arr_nomina[$i]['id'].'&id_por_sucursal='.$arr_nomina[$i]['id_por_sucursal'];  ?>&id_sucursal=<?php echo $id_sucursal;?>&fecha_realizacion=<?php echo muestraFechaSola($arr_nomina[$i]['fecha'],'es'); ?>"><img  src="../images/group.png" title="Solicitud de Fondos Cyberlux" alt="Solicitud de Fondos Cyberlux" style="border:none" /></a></td>
								<td width="33%" ><a href="nomina_solicitud_fondosP.php?id=<?php echo $arr_nomina[$i]['id'].'&id_por_sucursal='.$arr_nomina[$i]['id_por_sucursal'];  ?>&id_sucursal=<?php echo $id_sucursal;?>&fecha_realizacion=<?php echo muestraFechaSola($arr_nomina[$i]['fecha'],'es'); ?>"><img  src="../images/group.png" title="Solicitud de Fondos Pro-Home" alt="Solicitud de Fondos Pro-Home" style="border:none" /></a></td>
                                <td width="33%" ><a href="forma_guia_transporte_anular.php?id=<?php echo $arr_nomina[$i]['id'];  ?>"><img  src="../images/chart_organisation.png" title="Factura de Cobro" alt="Factura de Cobro"  style="border:none"   /></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <?php } ?>
                        <!--DATOS-->
                        <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->  </table><tr> <td  colspan="2" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                <td  colspan="2" align="left">
                  <div align="center">
                    <table width="200" border="0">
                      <tr>
                        <td class="tablas_listados_encabezados_sub">Descripcion</td>
                         <td class="tablas_listados_encabezados_sub">Imagen</td>
                          </tr>
                      <tr>
                        <td class="form_label">Buscar</td>
                        <td class="form_label"><div align="center"><img src="../images/view.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Descargar Excel</td>
                        <td class="form_label"><div align="center"><img src="../images/excel.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Ver Ordenes de Pago de transportistas</td>
                        <td class="form_label"><div align="center"><img src="../images/user.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Ver Ordenes de Pago de transportistas con totales resumidos</td>
                        <td class="form_label"><div align="center"><img src="../images/user_send.png" width="16" height="16" /></div></td>
                          </tr>
                     
                      <tr>
                        <td class="form_label">Ver solicitud de fondos</td>
                        <td class="form_label"><div align="center"><img src="../images/group.png" width="16" height="16" /></div></td>
                          </tr>
                          <tr>
                        <td class="form_label">Ver factura de cobro</td>
                        <td class="form_label"><div align="center"><img src="../images/chart_organisation.png" width="16" height="16" /></div></td>
                          </tr>
                          
                      </table>
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
