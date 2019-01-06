<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'7,5,6')) header('Location: ../lib/common/logout.php');
$obj_vehiculo= new class_vehiculo;
$placa='';
$id_tipo='';
$id_empresa='';
//$id_sucursal=$_SESSION['id_sucursal'];

$obj_sucursal = new class_sucursal;

if(inList($_SESSION['id_tipo_usuario'],'3,4,6')){
	$arr_sucursal = $obj_sucursal->get_sucursal();
}else{
	$arr_sucursal = $obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
}

if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
else $id_sucursal=$_SESSION['id_sucursal'];


if(inList($_SESSION['id_tipo_usuario'],'1,3')) $status='1,2,3';
else $status='0,1,2,3';
$arr_vehiculo=$obj_vehiculo->get_list_vehiculo($placa,$id_tipo,$id_empresa,$status,$id_sucursal);
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
                    <td  colspan="2" class="form_titulo" >Listado de Edicion de longitudes para Vehículos</td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados" >
                        <!--ENCABEZADOS-->
                      <tr class="tabla_barra_opciones" >
                          <td colspan="9"><table class="tabla_opciones" >
                              <tr >
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >
                                     
                                      </td>
                                      <td width="20%" ><a href="vehiculo_list.php" ><img src="../images/listado.png" title="Descargar en Excel listado de vehiculo" alt="Descargar Excel" style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="9"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="6%" >Tipo</td>
                          <td width="31%" >Empresa</td>
                          <td width="20%" >Placa</td>
                          <td width="10%" >Largo</td>
                           <td width="10%" >Ancho</td>
                            <td width="10%" >Alto</td>
                           <td width="5%" >Act</td>
                          <td width="5%"  align="center">Res</td>
                      </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                       
                            <?php 
										for($i=0; $i<sizeof($arr_vehiculo); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo[$i]['tipo']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo[$i]['empresa']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo[$i]['placa']); ?></td>
                          <td bordercolor="#993366" >
						  <input name="largo_<?php echo $i; ?>" id="largo_<?php echo $i; ?>" type="text" value="<?php echo $arr_vehiculo[$i]['largo']; ?>"  class="form_caja_proceso_medida" onKeyPress="return acceptNumFloat(event)" maxlength="4" /></td>
                          <td bordercolor="#993366" >
                          <input name="ancho_<?php echo $i; ?>" id="ancho_<?php echo $i; ?>" type="text" value="<?php echo $arr_vehiculo[$i]['ancho']; ?>" class="form_caja_proceso_medida" onKeyPress="return acceptNumFloat(event)" maxlength="4"  /></td>
                          <td bordercolor="#993366" ><input name="alto_<?php echo $i; ?>" id="alto_<?php echo $i; ?>" type="text" value="<?php echo $arr_vehiculo[$i]['alto']; ?>"  class="form_caja_proceso_medida" onKeyPress="return acceptNumFloat(event)" maxlength="4"  /></td>                        
                         <td align="center" bordercolor="#993366" ><img src="../images/arrow_rotate_anticlockwise.png" title="Ver" alt="Ver" style="border:none"  
  onclick="udp_medidas('largo_...ancho_...alto_','<?php echo $i; ?>','asin_vehiculo_udp_medida.php','<?php echo $arr_vehiculo[$i]['id']; ?>','resultado_')" /></td>
                          <td bordercolor="#993366" id="resultado_<?php echo $i; ?>">&nbsp;</td>
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
