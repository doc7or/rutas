<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');

$obj_escolta= new class_escolta;
$id_empresa=$_REQUEST['id_empresa'];

$obj_sucursal = new class_sucursal;

if(inList($_SESSION['id_tipo_usuario'],'3,4,6')){
	$arr_sucursal = $obj_sucursal->get_sucursal();
}else{
	$arr_sucursal = $obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
}

if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
else $id_sucursal=$_SESSION['id_sucursal'];

$arr_escolta=$obj_escolta->get_list_escolta('',$id_empresa,$id_sucursal);
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
                    <td  colspan="2" class="form_titulo" >Listado de escoltas</td>
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
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  ><img src="../images/view.png" title="Buscar Escolta" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" />
                                      <input type="hidden" name="acc" id="acc" /></td>
                                      <td width="20%"  ><img src="../images/excel.png" title="Descargar en Excel listado de escoltas" alt="Descargar Excel" /></td>
                                      <td width="20%" >
                                      <a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,2,6')) echo 'escolta_list.php' ; else echo 'escolta_add.php' ; ?>" ><img src="../images/pluss.png" title="Adicionar Escolta" alt="Adicionar" style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="25%"  align="center">Empresa</td>
                          <td width="30%"  align="center">Nombre</td>
                          <td width="15%"  align="center">cedula</td>
                          <td width="15%"  align="center">telefono</td>
                          <td width="15%"  align="center">Opciones</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_escolta); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_escolta[$i]['empresa']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_escolta[$i]['apellido'].'  '.$arr_escolta[$i]['nombre']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_escolta[$i]['rif']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_escolta[$i]['telefono']); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" ><a href="escolta_view.php?id=<?php echo $arr_escolta[$i]['id'];  ?>"><img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a></td>
                                <td width="33%" >
                                <a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,2,6')) echo 'escolta_list.php' ; else echo 'escolta_edit.php?id='.$arr_escolta[$i]['id'] ; ?>"><img src="../images/edit.png" title="Editar" alt="Editar"  style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,2,6')) echo 'escolta_list.php' ; else echo 'escolta_delete.php?id='.$arr_escolta[$i]['id'] ; ?>"><img src="../images/delete.png" title="Eliminar" alt="Eliminar"  style="border:none" /></a></td>
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
                        <td class="form_label">Buscar</td>
                        <td class="form_label"><div align="center"><img src="../images/view.png" width="16" height="16" /></div></td>
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
