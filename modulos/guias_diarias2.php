<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'3,4,6,7')) header('Location: ../lib/common/logout.php');

$obj_control_salida= new class_control_salida;
$obj_sucursal = new class_sucursal;
$arr_sucursal = $obj_sucursal->get_sucursal();


$tipo=$_REQUEST['tipo'];
$fecha=date('d-m-Y');
if($_REQUEST['id_por_sucursal']!='' && $_REQUEST['id_por_sucursal']!='No Guia')	$id_por_sucursal=$_REQUEST['id_por_sucursal'];
	
$fecha_desde=$_REQUEST['fecha_desde'];
$fecha_hasta=$_REQUEST['fecha_hasta'];
$tipo=$_REQUEST['tipo'];
$status=$_REQUEST['status'];

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

$id=$_REQUEST['id'];

if(!inList($_SESSION['id_tipo_usuario'],'3,4,6')){
	$id_sucursal=$_SESSION['id_sucursal'];
	$arr_control_salida=$obj_control_salida->get_control_salida_list_day($id,$id_sucursal,$tipo,$status,$rango,$id_por_sucursal,$tipo,$status);
}else{
	$id_sucursal=$_REQUEST['id_sucursal'];
	if($_REQUEST['id_sucursal']){
		$arr_control_salida=$obj_control_salida->get_control_salida_list_day($id,$id_sucursal,$tipo,$status,$rango,$id_por_sucursal,$tipo,$status);
	}
}

$titulo='Listado de Guias para seguimiento';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>

<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
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
                    <td  colspan="2" class="form_titulo" ><?php echo $titulo; 
							  
						?> </td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados" >
                        <!--ENCABEZADOS-->
                         <?php if(inList($_SESSION['id_tipo_usuario'],'3,4,6')){ ?>
                        <tr class="tabla_barra_opciones" >
                          <td colspan="6"><table class="tabla_opciones" >
                              <tr >
                                <td width="80%">
                                	<table width="80%" class="tablas_filtros" >
                               	  <tr>
                                        	<td width="17%" valign="center" class="form_label" title="Guias por sucursal">Sucursal</td>
                                    <td width="44%">
                                    <select name="id_sucursal" id="id_sucursal" class="form_pool_proceso" onfocus="message_help(0)">
                                      <option value="0">Seleccione...</option>
                                      <?php  
                                                                    for ($i=0; $i<sizeof($arr_sucursal);$i++) { ?>
                                      <option value="<?php echo $arr_sucursal[$i]['id']; ?>" <?php if($id_sucursal==$arr_sucursal[$i]['id']) echo "selected";  ?>> <?php echo $arr_sucursal[$i]['descripcion'];?> </option>
                                      <?php }?>
                                    </select></td>
                                       <td width="39%">
                                       		<input name="id_por_sucursal" type="text" id="id_por_sucursal"  class="form_caja_proceso"  value="<?php if($id_por_sucursal) echo $id_por_sucursal; else echo 'No Guia'; ?>" title="ingrese el numero de guia que desea consultar" onclick="clear_caja('id_por_sucursal')" onKeyPress="return acceptNum(event)"/>                                       </td>
                                      </tr>
                               	  <tr>
                               	    <td valign="center" class="form_label" title="Fecha de Creacion de la Guia desde - hasta">Fecha</td>
                               	    <td>
                                    
                                     <input name="fecha_desde" type="text" id="fecha_desde"  class="form_caja_proceso" readonly="readonly" value="<?php echo $fecha_desde;?>"
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
                                </script>                                     </td>
                             	    </tr>
                               	  <tr>
                               	    <td valign="center" class="form_label" title="Tipo de guia">Tipo</td>
                               	    <td>  
                                                                  
                                    <select name="tipo" id="tipo" class="form_pool_proceso" onfocus="message_help(0)">
                                      <option value="0"  <?php if($tipo=='0') echo "selected";  ?>>Seleccione...</option>
                                      <option value="1" <?php if($tipo=='1') echo "selected";  ?>>Transporte</option>
                                      <option value="2" <?php if($tipo=='2') echo "selected";  ?>>Traslado</option>
                                      <option value="3" <?php if($tipo=='3') echo "selected";  ?>>Nota de Entrega</option>
                                    </select>
                                    </td>
                               	    <td>&nbsp;</td>
                             	    </tr>
                               	  <tr>
                               	    <td valign="center" class="form_label" title="Esatdo de la  guia">Estado</td>
                               	    <td>
                                    
                                    <select name="status" id="status" class="form_pool_proceso" onfocus="message_help(0)">
                                      <option value="0" <?php if($status=='0') echo "selected";  ?>>Seleccione...</option>
                                      <option value="1" <?php if($status=='1') echo "selected";  ?>>Activa</option>
                                      <option value="3" <?php if($status=='3') echo "selected";  ?>>Liquidada</option>
                                      <option value="4" <?php if($status=='4') echo "selected";  ?>>Pagada</option>
                                      <option value="2" <?php if($status=='2') echo "selected";  ?>>Anulada</option>
                                    </select>
                                    </td>
                               	    <td>&nbsp;</td>
                             	    </tr>
                                </table>                                </td>
                                <td width="2%"  bgcolor="" >&nbsp;</td>
  <td width="18%" bgcolor="#FFFFFF" valign="top"><table class="tabla_opciones" >
                                    <tr align="center">
                                    
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%" ><img src="../images/view.png" title="Buscar" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" /><input type="hidden" name="acc" id="acc" /></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                        </tr>
                        <?php } ?> 
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="10%" >Guia</td>
                          <td width="49%" >Ruta</td>
                          <td width="26%" >Fecha</td>
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
										//VERIFICAMOS QUE IPO DE QUIA SERA LA QUE VASMOS A LLAMAR
										if($arr_control_salida[$i]['tipo']=='1'){	$url='forma_guia_transporte_popup.php?id=';	}
										if($arr_control_salida[$i]['tipo']=='2'){	$url='forma_guia_traslado_popup.php?id=';	}
										if($arr_control_salida[$i]['tipo']=='3'){	$url='forma_guia_nota_entrega_popup.php?id=';	}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366"  onclick="popup_basic('<?php echo $url.$arr_control_salida[$i]['id']; ?>');" style="cursor:pointer"  >
						  
						  <?php
								//BUSCAMOS LOS DATOS NECESARIOS DE LA SUCURSAL
									//echo $arr_control_salida[$i]['id_sucursal'];	
									$arr_sucursal=$obj_sucursal->get_sucursal($arr_control_salida[$i]['id_sucursal']);
									$linea=$arr_sucursal[0]['prefijo'];
								//decidimos si imprimimos la nueva numeracion o la vieja
								if ($arr_control_salida[$i]['id_sucursal']==2){
									if($arr_control_salida[$i]['id_por_sucursal_new'])
										$num_guia=$linea.' '.$arr_control_salida[$i]['id_por_sucursal_new'];//numero correlativo de cada sucursal
									else
										$num_guia=$arr_control_salida[$i]['id_por_sucursal'];//numero correlativo de cada sucursal	
								}
								else
									$num_guia=$arr_control_salida[$i]['id_por_sucursal'];//numero correlativo de cada sucursal 
								echo $num_guia; 
							?></td>
                          <td bordercolor="#993366" ><?php echo $arr_control_salida[$i]['ruta']; ?></td>
                          <td bordercolor="#993366" ><?php echo muestrafecha($arr_control_salida[$i]['fecha_salida'],'es'); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" ><?php if($arr_control_salida[$i]['status']==1) {  ?>
                                    <img  src="../images/activo.png" alt="Activo"  style="border:none"title="Activo" />
                                    <?php }	if($arr_control_salida[$i]['status']==2) {  ?>
                                    <img src="../images/inactivo.png" title="Anulado" alt="Anulado" style="border:none" />
                                    <?php } if($arr_control_salida[$i]['status']==3) {  ?>
                                    <img src="../images/liquidado.png" title="Liquidado" alt="Liquidado" style="border:none" />
                                    <?php }  if($arr_control_salida[$i]['status']==4) {  ?>
                                    <img  src="../images/script.png" title="Pagada" alt="Pagada" style="border:none" />
                                    <?php } ?>
                                </td>
                                <td width="33%" >
                                <?php
									if($arr_control_salida[$i]['tipo']==1){ $ruta='forma_guia_transporte_view.php?id='.$arr_control_salida[$i]['id'];  }
									if($arr_control_salida[$i]['tipo']==2){ $ruta='forma_guia_traslado_view.php?id='.$arr_control_salida[$i]['id'];  }
									if($arr_control_salida[$i]['tipo']==3){ $ruta='forma_guia_nota_entrega_view.php?id='.$arr_control_salida[$i]['id'];  }
                                ?>
                                <a href="<?php echo $ruta; ?>">
                                	<img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a>
                                </td>
                                
                            </tr>
                          </table></td>
                        </tr>
                        <?php } ?>
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
