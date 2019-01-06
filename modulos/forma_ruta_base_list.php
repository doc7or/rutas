<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6')) header('Location: ../lib/common/logout.php');

$obj_ruta_base= new class_ruta_base;
$arr_ruta_base=$obj_ruta_base->get_ruta_base('');
$obj_zona= new class_zona;
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
                    <td  colspan="2" class="form_titulo" >Listado de Rutas Bases</td>
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
                                      <td width="20%"  ><img src="../images/excel.png" title="Descargar Excel" alt="Descargar Excel" /></td>
                                      <td width="20%" ><a href="forma_ruta_base.php" ><img src="../images/pluss.png" title="Adicionar" alt="Adicionar" style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="20%" >Nombre</td>
                          <td width="33%" >Zona (Salida / Llegada)</td>
                          
                          
                          <td width="15%"  align="center">Opciones</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_ruta_base); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_ruta_base[$i]['descripcion']); ?></td>
                          <td bordercolor="#993366" >
						  	<?php 
								
							//	$arr_zona=class_zona::get_list($arr_ruta_base[$i]['llegada']);
								echo $arr_ruta_base[$i]['zona_salida'].' - '.$arr_ruta_base[$i]['zona_llegada']; 
							?>
                          </td>
                         
                         
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" ><img src="../images/view.png" title="Ver" alt="Ver" /></td>
                                <td width="33%" ><img src="../images/edit.png" title="Editar" alt="Editar" /></td>
                                <td width="33%" ><img src="../images/delete.png" title="Eliminar" alt="Eliminar"/></td>
                              </tr>
                          </table></td>
                      </tr>
                      <tr  id="tr_<?php echo $i; ?>">
                      	<td colspan="3" align="center">
                        	<!--AQUI SE COLOCARAN LAS TABLAS DE DETALLE DE LA RUTA-->
                            <table width="323">
                       	  <tr>
                                	<td width="81" class="tablas_listados_encabezados">Nivel</td>
                                  <td width="230" class="tablas_listados_encabezados">Zona</td>
                              </tr>
                                <tr>
                                	<td class="tablas_listados_encabezados_sub">Salida</td>
                                  <td class="tablas_listados_datos_imp">Valencia</td>
                              </tr>
                                <tr>
                                	<td>&nbsp;</td>
                                    <td class="tablas_listados_datos_par">San Carlos</td>
                          </tr >
                                <tr>
                                  <td>&nbsp;</td>
                                  <td class="tablas_listados_datos_imp">Acariguia</td>
                            </tr >
                                <tr>
                                  <td>&nbsp;</td>
                                  <td class="tablas_listados_datos_par">Achaguas</td>
                             </tr >
                                <tr>
                                  <td>&nbsp;</td>
                                  <td class="tablas_listados_datos_imp">Barinas</td>
                                </tr
                            >
                                <tr>
                                  <td>&nbsp;</td>
                                  <td class="tablas_listados_datos_par">El Piñal</td>
                                </tr
                            >
                                <tr>
                                  <td class="tablas_listados_encabezados_sub">Llegada</td>
                                  <td class="tablas_listados_datos_imp">San Cristobal</td>
                                </tr
                            >
                          </table>
                            <!--AQUI SE COLOCARAN LAS TABLAS DE DETALLE DE LA RUTA-->
                        </td>
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
