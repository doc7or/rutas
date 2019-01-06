<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');

//LLAMADO DE LAS CLASES NECESARIAS////
$obj_sucursal=new class_sucursal;
$obj_control_salida= new class_control_salida;
$obj_transportista= new class_transportista;
$obj_empresa= new class_empresa;
$fecha=date('d-m-Y');
$fecha_desde=$_REQUEST['fecha_desde'];
$fecha_hasta=$_REQUEST['fecha_hasta'];


$id=$_REQUEST['id'];
$id_sucursal=$_SESSION['id_sucursal'];
$tipo=$_REQUEST['tipo'];

if($_REQUEST['id_por_sucursal']!='0' && $_REQUEST['id_por_sucursal']!='No Guia') 
$id_por_sucursal=$_REQUEST['id_por_sucursal'];

if($_REQUEST['placa']!='0' && $_REQUEST['placa']!='Placa') 
$placa=$_REQUEST['placa'];

if($_REQUEST['transportista']!='0' && $_REQUEST['transportista']!='Transportista') 
$id_transportista=$_REQUEST['transportista'];


if($_REQUEST['empresa']!='0' && $_REQUEST['empresa']!='Empresa') 
$id_empresa=$_REQUEST['empresa'];


$status=$_REQUEST['status'];

//listado de transportistas

$arr_transportista=$obj_transportista->get_transportista('','','','','','','',$_SESSION['id_sucursal']);

//listado de empresas
$arr_empresa=$obj_empresa->get_empresa('','','',$_SESSION['id_sucursal']);



if($fecha_desde)
{
	if($fecha_hasta)
	{	$r_desde=rango_fecha($fecha_desde,'es','1');
		$r_hasta=rango_fecha($fecha_hasta,'es','2');		
	}
	else
	{	$r_desde=rango_fecha($fecha_desde,'es','1');
		$r_hasta=rango_fecha($fecha_desde,'es','2');		
	}
}
else
{	
	
	$r_desde=rango_fecha($fecha,'es','1');
	$r_hasta=rango_fecha($fecha,'es','2');		
}




if(!$id_por_sucursal)

$rango= " AND fecha >= '$r_desde' AND fecha <= '$r_hasta' ";

																
$arr_control_salida=$obj_control_salida->get_control_salida_list($id,$id_sucursal,$tipo,$status,$id_por_sucursal,$rango,$placa,$id_transportista ,$id_empresa);

if ($tipo=='1') {	$titulo='Listado de Gu&iacute;as de Transporte';	$forma='forma_guia_transporte.php';	$forma_view='forma_guia_transporte_view.php?id='; $forma_edit='forma_guia_transporte_edit.php?id='; $forma_anul='forma_guia_transporte_anular.php?id='; }
if ($tipo=='2') {	$titulo='Listado de Gu&iacute;as de Traslado';	$forma='forma_guia_traslado.php';	$forma_view='forma_guia_traslado_view.php?id='; $forma_edit='forma_guia_traslado_edit.php?id=';  $forma_anul='forma_guia_traslado_anular.php?id='; }
if ($tipo=='3') {	$titulo='Listado de Gu&iacute;as Nota de Entrega';	$forma='forma_guia_nota_entrega.php';	$forma_view='forma_guia_nota_entrega_view.php?id='; $forma_edit='forma_guia_nota_entrega_edit.php?id=';  $forma_anul='forma_guia_nota_entrega_anular.php?id='; }

if(!inList($_SESSION['id_tipo_usuario'],'1,2')) {
	$forma='forma_guia_transporte_list.php?tipo='.$tipo;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>

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
                <br />
                <table align="center" width="90%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" >
                    	<?php echo $titulo; 
							  
						?>
                    </td>
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
                                 <tr class="form_label" >
									<td>Opciones</td>
                                    <td>Filtro 1</td>
                                    <td>Filtro 2</td>
                                 </tr>
                                  <tr>
                                    <td width="17%" class="form_label"  valign="center"title="Guias por sucursal"> Guia</td>
                                    <td width="44%"><input name="id_por_sucursal" type="text" id="id_por_sucursal"  class="form_caja_proceso"  value="<?php if($id_por_sucursal) echo $id_por_sucursal; else echo 'No Guia'; ?>" title="ingrese el numero de guia que desea consultar" onclick="clear_caja('id_por_sucursal')"  
                                    onkeypress="return acceptNum(event)"/></td>
                                    <td width="39%">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td valign="center" class="form_label" title="Fecha de Creacion de la Guia desde - hasta">Fecha</td>
                                    <td><input name="fecha_desde" type="text" id="fecha_desde"  class="form_caja_proceso" readonly="readonly" value="<?php echo $fecha_desde;?>"
                                     />
                                        <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fecha_desde",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fecha_desde",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                  </script>                                    </td>
                                    <td><input name="fecha_hasta" type="text" id="fecha_hasta"  class="form_caja_proceso" readonly="readonly" value="<?php echo $fecha_hasta;?>"
                                     />
                                        <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fecha_hasta",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fecha_hasta",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                  </script>                                    </td>
                                  </tr>

                                  <tr>
                                    <td valign="center" class="form_label" title="Esatdo de la  guia">Estado</td>
                                    <td><select name="status" id="status" class="form_pool_proceso" onfocus="message_help(0)">
                                      <option value="0" <?php if($status=='0') echo "selected";  ?>>Seleccione...</option>
                                      <option value="1" <?php if($status=='1') echo "selected";  ?>>Activa</option>
                                      <option value="3" <?php if($status=='3') echo "selected";  ?>>Liquidada</option>
                                      <option value="4" <?php if($status=='4') echo "selected";  ?>>Pagada</option>
                                      <option value="2" <?php if($status=='2') echo "selected";  ?>>Anulada</option>
                                    </select></td>
                                    <td><input name="tipo" type="hidden" id="tipo"  class="form_caja_proceso" value="<?php echo $tipo;?>"
                                     /></td>
                                  </tr>
                                  <tr>
                                    <td valign="center" class="form_label" title="Esatdo de la  guia">Asignado</td>
                                    <td>
                                    <select name="transportista" id="transportista" class="form_pool_proceso"  onchange="load_pool('id_transportista')" onfocus="message_help(0)">
                                      <option value="0">Seleccione...</option>
                              <?php  
                               for ($i=0; $i<sizeof($arr_transportista); $i++) 
							   { ?>
                              <option value="<?php echo $arr_transportista[$i]['id']; ?>" <?php if($id_transportista==$arr_transportista[$i]['id']) echo 'selected'; ?>> 
							  <?php echo $arr_transportista[$i]['nombre']; ?> </option><?php }?>
                                    </select></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td valign="center" class="form_label" title="Esatdo de la  guia">Empresa</td>
                                    <td><select name="empresa" id="empresa" class="form_pool_proceso"  onchange="load_pool('id_empresa')" onfocus="message_help(0)">
                                      <option value="0">Seleccione...</option>
                              <?php  
                               for ($i=0; $i<sizeof($arr_empresa); $i++) 
							   { ?>
                              <option value="<?php echo $arr_empresa[$i]['id']; ?>"<?php if($id_empresa==$arr_empresa[$i]['id']) echo 'selected'; ?>> 
							  <?php echo $arr_empresa[$i]['descripcion']; ?> </option><?php }?>
                                    </select></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                                <td width="28%" valign="top" bgcolor="#FFFFFF"><table width="97%" height="11%" class="tabla_opciones" >
            <tr align="center">
                                      <td width="20%" height="37" >&nbsp;</td>
                                      <td width="20%"  ><img src="../images/page_word.png"  style="border:none; cursor:pointer" onclick="filtros('forma_guia_transporte_list_doc.php','id_por_sucursal,fecha_desde,fecha_hasta,status,placa,transportista,empresa')"  alt="Descargar Word"   title="Descargar Word"/></td>
                                      <td width="20%"  ><img src="../images/excel.png"  style="border:none; cursor:pointer" onclick="filtros('forma_guia_transporte_list_xls.php','id_por_sucursal,fecha_desde,fecha_hasta,status,placa,transportista,empresa')"  alt="Descargar Word"   title="Descargar Word"/></td>
                                      <td width="20%"  >
                                      <img src="../images/view.png" title="Buscar" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" /><input type="hidden" name="acc" id="acc" />                                      </td>
                                      <td width="20%" >
                                      
                                      	<a href="<?php echo $forma;?>" ><img src="../images/pluss.png" title="Adicionar" alt="Adicionar" style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="9%" >Guia</td>
                          <td width="34%" >Asignado</td>
                          <td width="23%" >Fecha</td>
                     <td width="19%" >Monto</td>
                      
                          
                          
                          <td width="15%"  align="center">Opciones</td>
                      </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_control_salida); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" >
                           <?php 
						  			//buscamos el prefijo de la sucursal
						  			$arr_sucursal=$obj_sucursal->get_sucursal($arr_control_salida[$i]['id_sucursal']);
									$linea=$arr_sucursal[0]['prefijo'];
								//decidimos si imprimimos la nueva numeracion o la vieja
								if ($arr_control_salida[$i]['id_sucursal']==1){
									if($arr_control_salida[$i]['id_por_sucursal_new']){
										//completaSpaciosStrins($str,$cuantos,$valor,$pos)
										$numero_formateado=completaSpaciosStrins(0,4,$arr_control_salida[$i]['id_por_sucursal_new'],'1');
										
										$num_guia=$linea.' '.$numero_formateado;//numero correlativo de cada sucursal
									}else{
										$num_guia=$arr_control_salida[$i]['id_por_sucursal'];//numero correlativo de cada sucursal	
									}
								}
								else
									$num_guia=$arr_control_salida[$i]['id_por_sucursal'];//numero correlativo de cada sucursal 
								echo $num_guia; 
						  
						  		
								
							?>
						  
                         </td>
                          <td bordercolor="#993366" ><?php echo $arr_control_salida[$i]['ruta']; ?></td>
                          <td bordercolor="#993366" ><?php echo muestrafecha($arr_control_salida[$i]['fecha_salida'],'es'); ?>
						  </td>
                           <td bordercolor="#993366" align="right" ><?php  $arr_control_salida[$i]['monto']; 
						  $total_monto=$total_monto+$arr_control_salida[$i]['monto']; ?>                            <?php echo $arr_control_salida[$i]['monto']= number_format($arr_control_salida[$i]['monto'], 2, ',', '.');?></td>
                         
                         
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                            <tr align="center">
                              <td width="33%" >
                              	<?php if($arr_control_salida[$i]['status']==1) {  ?>
                                	<img  src="../images/activo.png" alt="Activo"  style="border:none"title="Activo" />
                                <?php }	if($arr_control_salida[$i]['status']==2) {  ?>
                                	<img src="../images/inactivo.png" title="Anulado" alt="Anulado" style="border:none" />
                                <?php } if($arr_control_salida[$i]['status']==3) {  ?>
                                	<img src="../images/liquidado.png" title="Liquidado" alt="Liquidado" style="border:none" />
                                <?php }  if($arr_control_salida[$i]['status']==4) {  ?>
                                	<img  src="../images/script.png" title="Pagada" alt="Pagada" style="border:none" />
                                <?php } ?>                                                             </td>
                              <td width="33%" ><a href="<?php echo $forma_view.$arr_control_salida[$i]['id'];  ?>"><img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a></td>
                              <td width="33%" ><a href="<?php if(!inList($arr_control_salida[$i]['status'],'2')) echo $forma_edit.$arr_control_salida[$i]['id'];  ?>"><img src="../images/edit.png" title="Editar" alt="Editar" style="border:none" /></a></td>
                              <td width="33%" ><a href="<?php if(!inList($arr_control_salida[$i]['status'],'2,4')) echo $forma_anul.$arr_control_salida[$i]['id'];  ?>"><img src="../images/exclamation.png" title="Anular" alt="Anular"  style="border:none"   /></a></td>
                            </tr>
                          </table></td>
                      </tr>
                        <?php } ?>
                         <tr >
                          <td   colspan="2" class="form_label_subtotales"> Total guias: <?php echo $i; ?></td>
                          <td align="right"  colspan="2" class="form_label_subtotales">Total en Bs F:   
                          
                        
                          
                          <?php echo $monto_total= number_format($total_monto, 2, ',', '.');?>                          </td>
                          <td width="15%"  align="center">&nbsp;</td>
                      </tr>

                        <!--DATOS-->
                        <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
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
