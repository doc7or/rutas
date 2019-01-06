<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');

$obj_control_salida= new class_control_salida;
$obj_sucursal = new class_sucursal;
$arr_sucursal = $obj_sucursal->get_sucursal();


$id_sucursal=$_SESSION['id_sucursal'];
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
if($_REQUEST['id_sucursal'] ) $id_sucursal=$_REQUEST['id_sucursal'];

$xls='';
//echo 'despues de'.$id_sucursal;
if($id_sucursal && $mes && $anio)
{
	//echo 'si entra';
    	if ($id_sucursal==1 && $mes==10 && $anio==2012){
                    $arr_control_salida=$obj_control_salida->get_seguro_1($mes,$anio,$id_sucursal);
        $xls='seguro_list_xls.php?id_sucursal='.$id_sucursal.'&mes='.$mes.'&anio='.$anio;
        }else{
	$arr_control_salida=$obj_control_salida->get_seguro($mes,$anio,$id_sucursal);
	$xls='seguro_list_xls.php?id_sucursal='.$id_sucursal.'&mes='.$mes.'&anio='.$anio;
            }
}
$titulo='Listado de Seguro';	
$forma_view='forma_guia_transporte_view.php?id='; 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>

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
                                  <?php if(inList($_SESSION['id_tipo_usuario'],'3,6')){?>
                                  <tr>
                                    <td width="17%" valign="center" class="form_label" title="Guias por sucursal"> Sucursal</td>
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
                                  <?php } ?>
                                  <tr>
                                    <td valign="center" class="form_label" title="Fecha de Creacion de la Guia desde - hasta">Mes</td>
                                  <td><select name="mes" id="mes" class="form_pool_proceso" onfocus="message_help(0)">
                                    <option value="1" <?php if($mes=='1') echo "selected";  ?>>Enero</option>
                                    <option value="2" <?php if($mes=='2') echo "selected";  ?>>Febrero</option>
                                    <option value="3" <?php if($mes=='3') echo "selected";  ?>>Marzo</option>
                                    <option value="4" <?php if($mes=='4') echo "selected";  ?>>Abril</option>
                                    <option value="5" <?php if($mes=='5') echo "selected";  ?>>Mayo</option>
                                    <option value="6" <?php if($mes=='6') echo "selected";  ?>>Junio</option>
                                    <option value="7" <?php if($mes=='7') echo "selected";  ?>>Julio</option>
                                    <option value="8" <?php if($mes=='8') echo "selected";  ?>>Agosto</option>
                                    <option value="9" <?php if($mes=='9') echo "selected";  ?>>Septiembre</option>
                                    <option value="10" <?php if($mes=='10') echo "selected";  ?>>Octubre</option>
                                    <option value="11" <?php if($mes=='11') echo "selected";  ?>>Noviembre</option>
                                    <option value="12" <?php if($mes=='12') echo "selected";  ?>>Diciembre</option>
                                  </select>
                                                                 </td>
                                    <td>                                    </td>
                                  </tr>

                                  <tr>
                                    <td valign="center" class="form_label" title="Esatdo de la  guia">Año</td>
                                    <td>
                                    <select name="anio" id="anio" class="form_pool_ano2" onfocus="message_help(0)">
                                
                                <?php  
                                for ($i=2008; $i<date('Y')+1;$i++) { ?>
                                	<option value="<?php echo $i;?>" <?php if($anio==$i) echo "selected";  ?>> <?php echo $i;?></option>
                                <?php }?>
                              </select>
                                    
                                                             </td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                                <td width="28%" valign="top" bgcolor="#FFFFFF"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >
                                      <img src="../images/view.png" title="Buscar" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" /><input type="hidden" name="acc" id="acc" />
                                      </td>
                                      <td width="20%" ><a href="<?php echo $xls; ?>" ><img src="../images/excel.png" alt="Descargar Excel"  style="border:none" title="Descargar Excel" /></a></td>
                                  </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                        
                          <td  >Guia</td>
                          <td   >Fecha</td>
                          <td  >Destino</td>
                          <td  >Chofer</td>
                          <td  >Placa</td>
                        
                          
                          <td width="12%"  align="center">Opciones</td>
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
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_control_salida[$i]['id_por_sucursal']); ?></td>
                          <td bordercolor="#993366" ><?php echo muestraFechaSola($arr_control_salida[$i]['fecha_salida'],'es'); ?></td>
                          <td bordercolor="#993366" ><?php echo $arr_control_salida[$i]['ruta']; ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_control_salida[$i]['t_nombre'].' '.$arr_control_salida[$i]['t_apellido']); ?></td>
                           <td bordercolor="#993366" ><?php echo $arr_control_salida[$i]['placa']; ?></td>
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
                                <?php } ?>
                                                             </td>
                              <td width="33%" ><a href="<?php echo $forma_view.$arr_control_salida[$i]['id'];  ?>"><img src="../images/view.png" alt="Ver" style="border:none" title="Ver" /></a></td>
                              
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
