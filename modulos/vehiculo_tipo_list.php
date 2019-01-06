<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$obj_vehiculo= new class_vehiculo_tipo;
if(inList($_SESSION['id_tipo_usuario'],'1')) $status='1';
else $status='0,1';
//echo $status;
$arr_vehiculo_tipo=$obj_vehiculo->get_list_vehiculo_tipo('',$status);

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
                <br />
                <table align="center" width="90%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" >Listado de Tipo de Vehículo</td>
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
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  ><img src="../images/excel.png" title="Descargar en Excel el listado de tipo de vehiculo" alt="Descargar Excel" /></td>
                                      <td width="20%" ><?php if(inList($_SESSION['id_tipo_usuario'],'6,1')) {?><a href="vehiculo_tipo_add.php" ><img src="../images/pluss.png" title="Adicionar tipo de vehiculo" alt="Adicionar" style="border:none" /></a><?php } ?></td>
                                  </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="9%" >Codigo</td>
                          <td width="34%" >Nombre</td>
                          <td width="15%" >Metraje Min (m3)</td>
                          <td width="15%" >Metraje Max (m3)</td>
                          <td width="15%" >Valor de la Caeta</td>
                          <td width="12%"  align="center">Opciones</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_vehiculo_tipo); $i++){			
        
										if ($i % 2){
											if($arr_vehiculo_tipo[$i]['status']==1)	$clase = "tablas_listados_datos_par";
											else $clase = "tablas_listados_datos_par_del";
										} else{
											if($arr_vehiculo_tipo[$i]['status']==1)	$clase = "tablas_listados_datos_imp";
											else $clase = "tablas_listados_datos_imp_del";
										}
										//		
									?>
                        <tr class="<?php echo $clase;?>" >
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo_tipo[$i]['descripcion']); ?></td>
                           <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo_tipo[$i]['detalle']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo_tipo[$i]['metraje_min']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo_tipo[$i]['metraje_max']); ?></td>
                           <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo_tipo[$i]['caleta']); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                            <tr align="center">
                              <td width="33%" ><a href="vehiculo_tipo_view.php?id=<?php echo $arr_vehiculo_tipo[$i]['id'];  ?>"><img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a></td>
                              <td width="33%" >
                              <a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'6')) echo 'vehiculo_tipo_list.php' ; else echo 'vehiculo_tipo_edit.php?id='.$arr_vehiculo_tipo[$i]['id'] ; ?>">
                             <img src="../images/edit.png" title="Editar" alt="Editar"  style="border:none" /></a></td>
                              <td width="33%" >
                               <a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'vehiculo_tipo_list.php' ; else echo 'vehiculo_tipo_delete.php?id='.$arr_vehiculo_tipo[$i]['id'] ; ?>"><img src="../images/delete.png" title="Eliminar" alt="Eliminar"  style="border:none" /></a></td>
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
                    </table><tr> <td  colspan="2" align="left">&nbsp;</td>
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
                        <td class="form_label">Descargar Excel</td>
                        <td class="form_label"><div align="center"><img src="../images/excel.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Adicionar</td>
                        <td class="form_label"><div align="center"><img src="../images/pluss.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Editar</td>
                        <td class="form_label"><div align="center"><img src="../images/edit.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Eliminar</td>
                        <td class="form_label"><div align="center"><img src="../images/delete.png" width="16" height="16" /></div></td>
                          </tr>
                      </table>    
                  </div>
                  <p>&nbsp;</p>
                </tr>
                    <p>&nbsp;</p></td>
                    <p>&nbsp;</p></td>
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
