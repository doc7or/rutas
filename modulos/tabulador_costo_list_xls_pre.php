<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$obj_tabulador_costo= new class_tabulador_costo;
$obj_zona= new class_zona;
$arr_zona=$obj_zona->get_list_zona('');

$obj_vehiculo_tipo= new class_vehiculo_tipo;
$arr_vehiculo_tipo = $obj_vehiculo_tipo->get_item();
$obj_tabulador_costo= new class_tabulador_costo;
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
header("Content-disposition: attachment;filename=tabulador.xls ");
?>
<style type="text/css">
<!--
.style4 {font-family: Arial, Helvetica, sans-serif}
.style7 {color: #CCCCCC}
-->
</style>

<table width="103%" class="tablas_listados style4 style7" border="1" >
  <!--ENCABEZADOS-->
  
  <tr class="tablas_listados_encabezados">
    <td colspan="2" bgcolor="#CC9900"  ><div align="center"><strong>Zona</strong></div></td>
    <td colspan="<?php echo sizeof($arr_vehiculo_tipo);?>" bgcolor="#CC9900"  ><div align="center"><strong>Item</strong></div></td>
  </tr>
  <tr class="tablas_listados_encabezados">
    <td width="10%" bgcolor="#CC9900"  ><strong>Estado</strong></td>
    <td width="10%" bgcolor="#CC9900"  ><strong>Zona</strong></td>
    <?php 
								for($i=0; $i<sizeof($arr_vehiculo_tipo); $i++){
								
								
							?>
    <td bgcolor="#CC9900"  ><strong><?php echo $arr_vehiculo_tipo[$i]['descripcion'];?></strong></td>
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
    <td bordercolor="#000000"   ><?php 
						  		if($estado!=$arr_zona[$i]['estado']) {
									$estado=$arr_zona[$i]['estado'];
						  			echo htmlentities($estado); 
								}
							?></td>
    <td bordercolor="#000000" ><?php echo htmlentities($arr_zona[$i]['descripcion']); ?></td>
    <?php 
							for($j=0; $j<sizeof($arr_vehiculo_tipo); $j++){
							$arr_tabulador_costo=$obj_tabulador_costo->get_tabulador_costo_aprobatorio('',$arr_zona[$i]['id'],$_SESSION['id_sucursal'],$arr_vehiculo_tipo[$j]['id']);
								
							?>
    <td bordercolor="#000000"  ><?php
											
											echo $arr_tabulador_costo[0]['costo'];
										?>    </td>
    <?php } ?>
  </tr>
  <?php } ?>
  <!--DATOS-->
  <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
</table>
