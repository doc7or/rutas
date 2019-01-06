<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$obj_transportista= new class_transportista;
$id_empresa=$_REQUEST['id_empresa'];
$arr_transportista=$obj_transportista->get_list_transportista('',$id_empresa,$_SESSION['id_sucursal']);

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
header("Content-disposition: attachment;filename=transportistas.xls ");
?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<table align="center"  >
                  <tr>
                    <td  colspan="4" class="form_titulo" ><strong>Listado de transportistas</strong></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left">&nbsp;</td>
                  </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados"  >
                          <td width="25%"  bgcolor="#CC9900"  align="center"><span class="style1">Empresa</span></td>
                          <td width="30%"  bgcolor="#CC9900"  align="center"><span class="style1">Nombre</span></td>
                          <td width="15%"  bgcolor="#CC9900"  align="center"><span class="style1">cedula</span></td>
                          <td width="15%"  bgcolor="#CC9900"  align="center"><span class="style1">telefono</span></td>
                          <td width="15%"  bgcolor="#CC9900"  align="center"><span class="style1">Direccion</span></td>
  </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_transportista); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>" bordercolor="#000000"  >
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_transportista[$i]['empresa']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_transportista[$i]['apellido'].'  '.$arr_transportista[$i]['nombre']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_transportista[$i]['rif']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_transportista[$i]['telefono']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_transportista[$i]['direccion']); ?></td>
                      </tr>
                        <?php } ?>
                        <!--DATOS-->
                        <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
                    </table>
