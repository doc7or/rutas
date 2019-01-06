<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$obj_vehiculo= new class_vehiculo;
$obj_control_salida= new class_control_salida;
$obj_transportista= new class_transportista;
$placa='';
$id_tipo='';
$id_empresa='';
$id_sucursal=$_SESSION['id_sucursal'];
if(inList($_SESSION['id_tipo_usuario'],'1,3')) $status='1,2,3';
else $status='0,1,2,3';
$arr_vehiculo=$obj_vehiculo->get_list_vehiculo($placa,$id_tipo,$id_empresa,$status,$id_sucursal);
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
header("Content-disposition: attachment;filename=vehiculos.xls ");
?>
<style type="text/css">
<!--
.style4 {font-family: Arial, Helvetica, sans-serif}
.style7 {color: #CCCCCC}
.style8 {
	color: #000000;
	font-weight: bold;
}
-->
</style>


<table width="40%" border="1"  class="tablas_listados style4 style7">
                      <!--ENCABEZADOS-->
                     
<tr>
                        <td height="10" colspan="4"><span class="style8">Listado de Veh&iacute;culo</span></td>
                      </tr>
                      <tr>
                        <td height="10" colspan="4">&nbsp;</td>
                      </tr>
                      <tr class="tablas_listados_encabezados"  >
                        <td width="16%"  bgcolor="#CC9900">Tipo</td>
                        <td width="30%"  bgcolor="#CC9900">Empresa</td>
                        <td width="20%"  bgcolor="#CC9900">Placa</td>
                        <td width="34%"  bgcolor="#CC9900">Transportistas</td>
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
						<?php 
								//buscamos el listado de id de transportistas asociados get_control_salida_trans_placa($placa='',$id_sucursal='')
								$arr_id_trans=$obj_control_salida->get_control_salida_trans_placa($arr_vehiculo[$i]['placa'],$id_sucursal);
								for($j=0;$j<sizeof($arr_id_trans);$j++){
									
									$arr_transportista=$obj_transportista->get_transportista($arr_id_trans[$j]['id_transportista']);
									echo $arr_transportista[0]['nombre'].' '.$arr_transportista[0]['apellido'].'<br>';
								}
								
								 
							?></td>
                      </tr>
                      <?php } ?>
                      <!--DATOS-->
                      <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
                    </table>
            
