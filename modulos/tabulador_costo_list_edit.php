<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$obj_tabulador_costo= new class_tabulador_costo;
$obj_zona= new class_zona;
$arr_zona=$obj_zona->get_list_zona('');

$obj_vehiculo_tipo= new class_vehiculo_tipo;
$arr_vehiculo_tipo = $obj_vehiculo_tipo->get_item();
$obj_tabulador_costo= new class_tabulador_costo;

if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
else $id_sucursal=$_SESSION['id_sucursal'];

$obj_sucursal = new class_sucursal;

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
                <table align="center" width="95%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" >Listado de tabulador_costos</td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left">
                      <table width="103%" class="tablas_listados" >
                        <!--ENCABEZADOS-->
                        <tr class="tabla_barra_opciones" >
                          <td colspan="<?php echo sizeof($arr_vehiculo_tipo)+3;?>"><table width="179%" class="tabla_opciones" >
                            <tr >
                              <td width="72%"><table width="80%" class="tablas_filtros" >
                                <tr>
                                  <td width="17%" valign="center" class="form_label" title="Guias por sucursal">Sucursal</td>
                                  <td width="44%"><select name="id_sucursal" id="id_sucursal" class="form_pool_proceso" onfocus="message_help(0)">
                                    <option value="0">Seleccione...</option>
                                    <?php  
                                                                    for ($i=0; $i<sizeof($arr_sucursal);$i++) { ?>
                                    <option value="<?php echo $arr_sucursal[$i]['id']; ?>" <?php if($id_sucursal==$arr_sucursal[$i]['id']) echo "selected";  ?>> <?php echo $arr_sucursal[$i]['descripcion'];?></option>
                                    <?php }?>
                                  </select></td>
                                  <td width="39%">&nbsp;</td>
                                </tr>
                              </table></td>
                              <td width="28%"><table class="tabla_opciones" >
                                <tr align="center">
                                  <td width="20%" >&nbsp;</td>
                                  <td width="20%"  >&nbsp;</td>
                                  <td width="20%"  ><img src="../images/view.png" title="Buscar tabulador por sucursal" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" />
                                    <input type="hidden" name="acc" id="acc" /></td>
                                  <td width="20%"  ><a href="tabulador_costo_list_xls_apro.php" ><img src="../images/excel.png" title="Descargar en Excel el listado de tabulador" alt="Descargar Excel" style="border:none" /></a></td>
                                  <td width="20%" >&nbsp;</td>
                                </tr>
                              </table></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="2" colspan="12"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td colspan="2"  ><div align="center">Zona</div></td>
                          <td colspan="<?php echo sizeof($arr_vehiculo_tipo);?>"  ><div align="center">Item</div></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="10%"  >Estado</td>
                          <td width="10%"  >Zona</td>
                          <?php 
								for($i=0; $i<sizeof($arr_vehiculo_tipo); $i++){
								
								
							?>
                            
                          <td  ><?php echo $arr_vehiculo_tipo[$i]['descripcion'];?></td>
                          <?php } ?>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_zona); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par_menor";
										} else{
											$clase = "tablas_listados_datos_imp_menor";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366"   ><?php 
						  		if($estado!=$arr_zona[$i]['estado']) {
									$estado=$arr_zona[$i]['estado'];
						  			echo htmlentities($estado); 
								}
							?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_zona[$i]['descripcion']); ?></td>
                          <?php 
							for($j=0; $j<sizeof($arr_vehiculo_tipo); $j++){
							
							$arr_tabulador_costo=$obj_tabulador_costo->get_tabulador_costo2('',$arr_zona[$i]['id'],$id_sucursal,$arr_vehiculo_tipo[$j]['id']);
								
							?>
                          <td    ><input id="tabul_<?php echo $i; ?>_<?php echo $j; ?>" name="tabul_<?php echo $i; ?>_<?php echo $j; ?>" value="<?php echo $arr_tabulador_costo[0]['costo']; ?>" onchange="change_tabul('tabul_<?php echo $i; ?>_<?php echo $j; ?>','change_tabulador','asin_change_tabul.php', '<?php echo $arr_tabulador_costo[0]['id']; ?>')" class="form_caja_tabulador" title="<?php echo $arr_vehiculo_tipo[$j]['descripcion'];?>" alt="<?php echo $arr_vehiculo_tipo[$j]['descripcion'];?>" />      
                          </td>
                          <?php } ?>
                        </tr>
                        <?php } ?>
                        <tr >
                          <?php 
								for($i=0; $i<sizeof($arr_vehiculo_tipo); $i++){
								
								
							?>
                          <?php } ?>
                        </tr>
                        <tr >
                          <?php 
								for($i=0; $i<sizeof($arr_vehiculo_tipo); $i++){
								
								
							?>
                          <?php } ?>
                        </tr>
                        <!--DATOS-->
                        <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
                      </table>
                  <tr>
                    <td  colspan="2" align="left" id="change_tabulador"></td>
                  </tr>
                  <tr>
                <td  colspan="2" align="left">
                  
                </tr>
                    <p>&nbsp;</p></td>
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
