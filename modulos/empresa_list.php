<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');
$obj_empresa= new class_empresa;

$obj_sucursal = new class_sucursal;

$id_sucursal=$_REQUEST['id_sucursal'];

if(inList($_SESSION['id_tipo_usuario'],'3,4,6')){
	$arr_sucursal = $obj_sucursal->get_sucursal();
}else{
	$arr_sucursal = $obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
}

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
                    <td  colspan="2" class="form_titulo" >Listado de empresas</td>
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
                                      <td width="20%"  ><img src="../images/view.png" title="Buscar Empresa" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" />
                                      <input type="hidden" name="acc" id="acc" /></td>
                                      <td width="17%"  >
                                      <a <?php if($id_sucursal){?>href="empresa_list_xls.php?id_sucursal=<?php echo $id_sucursal; ?>" <?php } ?>>
                                      <img src="../images/excel.png" title="Descargar en Excel el listado de las Empresas" alt="Descargar Excel" style="border:none"   />
                                      </a>
                                      </td>
                                      <td width="23%" >
                                      <a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6,2')) echo 'empresa_list.php' ; else echo 'empresa_add.php' ; ?>" ><img src="../images/pluss.png" title="Adicionar Empresa" alt="Adicionar" style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="55%" >Empresa</td>
                          <td width="20%" >rif</td>
                          <td width="10%" >telefono</td>
                          <td width="15%"  align="center">Opciones</td>
                        </tr>
                        <tr class="tablas_listados_encabezados_sub_0">
                          <td colspan="4" >Transportistas</td>
                        </tr>
                        <tr class="tablas_listados_encabezados_sub">
                          <td colspan="4" >Juridicas</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];

							$arr_empresa=$obj_empresa->get_empresa('',2,1,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo $arr_empresa[$i]['id'].' - '; echo htmlentities($arr_empresa[$i]['descripcion']); 
						  ?></td>
                          <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" >
                                <a href="empresa_view.php?id=<?php echo $arr_empresa[$i]['id'];  ?>"><img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_edit.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/edit.png" title="Editar" alt="Editar"  style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_delete.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/delete.png" title="Eliminar" alt="Eliminar"  style="border:none" /></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <?php } ?>
                        <tr class="tablas_listados_encabezados_sub">
                          <td colspan="4" >Naturales</td>
                        </tr>
                        <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];
							
							$arr_empresa=$obj_empresa->get_empresa('','1,3',1,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo $arr_empresa[$i]['id'].' - '; echo htmlentities($arr_empresa[$i]['descripcion']); 
						  ?></td>
                          <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" ><a href="empresa_view.php?id=<?php echo $arr_empresa[$i]['id'];  ?>"><img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_edit.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/edit.png" title="Editar" alt="Editar"  style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_delete.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/delete.png" title="Eliminar" alt="Eliminar"  style="border:none" /></a><a href="empresa_delete.php?id=<?php echo $arr_empresa[$i]['id'];  ?>"></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <?php } ?>
                        <tr class="tablas_listados_encabezados_sub_0">
                          <td colspan="4" >Escoltas</td>
                        </tr>
                        <tr class="tablas_listados_encabezados_sub">
                          <td colspan="4" >Juridicas</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];
							
							$arr_empresa=$obj_empresa->get_empresa('',2,2,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo $arr_empresa[$i]['id'].' - '; echo htmlentities($arr_empresa[$i]['descripcion']); 
						  ?></td>
                          <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" ><a href="empresa_view.php?id=<?php echo $arr_empresa[$i]['id'];  ?>"><img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_edit.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/edit.png" title="Editar" alt="Editar"  style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_delete.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/delete.png" title="Eliminar" alt="Eliminar"  style="border:none" /></a><a href="empresa_delete.php?id=<?php echo $arr_empresa[$i]['id'];  ?>"></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <?php } ?>
                        <tr class="tablas_listados_encabezados_sub">
                          <td colspan="4" >Naturales</td>
                        </tr>
                        <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];
							
							
							$arr_empresa=$obj_empresa->get_empresa('',1,2,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo $arr_empresa[$i]['id'].' - '; echo htmlentities($arr_empresa[$i]['descripcion']); 
						  ?></td>
                          <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
                          <td bordercolor="#993366"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="33%" ><a href="empresa_view.php?id=<?php echo $arr_empresa[$i]['id'];  ?>"><img src="../images/view.png" title="Ver" alt="Ver" style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_edit.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/edit.png" title="Editar" alt="Editar"  style="border:none" /></a></td>
                                <td width="33%" ><a href="<?php if(!inList($_SESSION['id_tipo_usuario'],'1,6')) echo 'empresa_list.php' ; else echo 'empresa_delete.php?id='.$arr_empresa[$i]['id'] ; ?>"><img src="../images/delete.png" title="Eliminar" alt="Eliminar"  style="border:none" /></a><a href="empresa_delete.php?id=<?php echo $arr_empresa[$i]['id'];  ?>"></a></td>
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
                  <tr>
                    <td  colspan="2" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><div align="center">
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
                      <p>&nbsp;</p>
                    </div></td>
                  </tr>
                </table>
                <p>&nbsp;</p>
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
