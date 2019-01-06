<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');

$obj_control_salida= new class_control_salida;
$obj_sucursal = new class_sucursal;
if(inList($_SESSION['id_tipo_usuario'],'3,4,6')){
	$arr_sucursal = $obj_sucursal->get_sucursal();
}else{
	$arr_sucursal = $obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
}


$obj_estado= new class_estado;
$obj_zona= new class_zona;

$estado=$_REQUEST['estado'];
$ciudad=$_REQUEST['ciudad'];


$arr_estado= $obj_estado -> get_estado();
$arr_zona=$obj_zona->get_list_zona('',$ciudad,$estado);


// valor inicial de ruta la variable quiery q va a ayudar a buscar 

//hacemos el proceso de carga de data de la zona




$tipo=$_REQUEST['tipo'];
$fecha=date('d-m-Y');
if($_REQUEST['id_por_sucursal']!='' && $_REQUEST['id_por_sucursal']!='No Guia')	$id_por_sucursal=$_REQUEST['id_por_sucursal'];
	
$fecha_desde=$_REQUEST['fecha_desde'];
$fecha_hasta=$_REQUEST['fecha_hasta'];
$tipo=$_REQUEST['tipo'];
$status=$_REQUEST['status'];
$id_sucursal=$_REQUEST['id_sucursal'];

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
                         
                        <tr class="tabla_barra_opciones" >
                          <td width="35%" colspan="6"><table class="tabla_opciones" >
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
                                       <td width="39%">&nbsp;</td>
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
                               	  <tr>
                               	    <td valign="center" class="form_label" title="Esatdo de la  guia">Ruta</td>
                               	    <td><select name="estado" id="estado" class="form_pool_proceso"   onchange="load_pool('id_carga','asin_pool_zona_listado.php','estado')"  onfocus="message_help(10)" >
                               	      <option value="0">Seleccione Estado...</option>
                               	      <?php  
                                                for ($i=0; $i<sizeof($arr_estado);$i++) { ?>
                               	      <option value="<?php echo $arr_estado[$i]['id']; ?>" <?php if($estado==$arr_estado[$i]['id']){ echo "selected"; } ?>> <?php echo $arr_estado[$i]['descripcion']; ?></option>
                               	      <?php }?>
                           	        </select></td>
                               	    <td id="id_carga"><select name="ciudad" id="ciudad" class="form_pool_proceso"   onfocus="message_help(11)" >
                               	      <option value="0">Seleccione Zona	...</option>
                           	        </select></td>
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
                        
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                             <tr class="tablas_listados_encabezados">
                          <td width="41%" >Estado</td>
                          <td width="44%" >Zona</td>
                          <td width="20%"  align="center">Total</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                       
                            <?php 
										for($i=0; $i<sizeof($arr_zona); $i++){			
        
										if ($i % 2){
											if($arr_zona[$i]['status']==1)	$clase = "tablas_listados_datos_par";
											else $clase = "tablas_listados_datos_par_del";
										} else{
											if($arr_zona[$i]['status']==1)	$clase = "tablas_listados_datos_imp";
											else $clase = "tablas_listados_datos_imp_del";
										}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_zona[$i]['estado']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_zona[$i]['descripcion']); ?></td>
                          
                         
                          <td bordercolor="#993366">
                          <?php
                          	
						
							 //recorremos este arreglo
						
							$ruta=" AND ( ruta LIKE '%".$arr_zona[$i]['descripcion']."%' ) ";
							if(!inList($_SESSION['id_tipo_usuario'],'3,4,6')){
								$id_sucursal=$_SESSION['id_sucursal'];
								$arr_control_salida=$obj_control_salida->get_control_salida_list_day($id,$id_sucursal,$tipo,$status,$rango,$id_por_sucursal,$tipo,$status,$ruta);
							}else{
								$id_sucursal=$_REQUEST['id_sucursal'];
								if($_REQUEST['id_sucursal']){
									$arr_control_salida=$obj_control_salida->get_control_salida_list_day($id,$id_sucursal,$tipo,$status,$rango,$id_por_sucursal,$tipo,$status,$ruta);
								}
							}
							echo sizeof($arr_control_salida	);
						  ?>
                          </td>
                      </tr>
                        <?php } ?>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
							$total_monto=0;
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
                        <?php } ?>
                        <!--DATOS-->
                        <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
                    </table></td>
                  </tr>                  
              		<tr>
                    	<td>&nbsp;</td>
                    </tr>
              		<tr>
              		  <td></td>
           		  </tr>
              		<tr>
              		  <td></td>
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
<?php if($estado){?>
	<script language="javascript">
    	load_pool('id_carga','asin_pool_zona_listado.php','estado','<?php echo $ciudad; ?>');
    </script>
<?php } ?>
