<?php 
include("../lib/core.lib.php");

if(!inList($_SESSION['id_tipo_usuario'],'1')) header('Location: ../lib/common/logout.php');
$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle_post= new class_control_salida_detalle_post;
$obj_control_post= new class_control_post;
$obj_nomina= new class_nomina;
$obj_nomina_detalle= new class_nomina_detalle;


$id=$_REQUEST['id'];
$id_sucursal=$_SESSION['id_sucursal'];
$tipo=$_REQUEST['tipo'];
$fecha=guardafecha($_REQUEST['fecha_hasta'].' 23:59:59','es');
$status='3';//esto aplica para las guias liquidadas
if($fecha){
	$arr_control_salida=$obj_control_salida->list_aprov_nomina($id,$id_sucursal,$tipo,$status,$fecha);
	$fecha_caja=muestraFechaSola($fecha,'es');
}
else{
	$fecha_caja=date("d-m-Y");
}
$titulo='Proceso de Generaci&oacute;n de Nomina';
header("Content-Type: application/vnd.ms-word");
header("Content-disposition: attachment;filename=nomina_transportistas.doc");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");

?>
<style type="text/css">
<!--
.style12 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFFFFF; font-size: 10; }
.style14 {font-family: Arial, Helvetica, sans-serif; font-size: 10; }
.style15 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>

<form name="form1" id="form1" action="" method="post"  >
                <br />
                <table align="center" width="98%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" >
                    	<span class="style15"><?php echo $titulo; 
							  
						?></span>                    </td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados_nomina"  width="100%">
                        <!--ENCABEZADOS-->
                        <tr class="tablas_listados_encabezados">
                          <td width="6%" bgcolor="#D0A202" ><span class="style12">Selec.</span></td>
                          <td width="6%" bgcolor="#D0A202" ><span class="style12">Guia</span></td>
                          <td width="6%" bgcolor="#D0A202" ><span class="style12">Ruta</span></td>
                          <td width="8%" bgcolor="#D0A202" ><span class="style12">Fecha</span></td>
                          <td width="12%" bgcolor="#D0A202" ><span class="style12">Veh&iacute;culo</span></td>
                          <td width="7%" bgcolor="#D0A202" ><span class="style12">Monto Neto</span></td>
                          <td width="8%" bgcolor="#D0A202" ><span class="style12">Desvio</span></td>
                          <td width="8%" bgcolor="#D0A202" ><span class="style12">Caleta</span></td>
                          <td width="6%" bgcolor="#D0A202" ><span class="style12">Pago Caja</span></td>
                          <td width="6%" bgcolor="#D0A202" ><span class="style12">Repartos</span></td>
                          <td width="12%" bgcolor="#D0A202" ><span class="style12">EPS A</span></td>
                          <td width="15%" bgcolor="#D0A202" ><span class="style12">EPS D</span></td>
                          <td width="13%" bgcolor="#D0A202" ><span class="style12">Saldo</span></td>
                      </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_control_salida); $i++){	
										$total[$i]=0;		
										$total_salida[$i]=0;
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                        	<td  align="center"><input name="check_<?php echo $i; ?>" type="checkbox" class="form_check_proceso " id="check_<?php echo $i; ?>" value="1"  />                                                </td>
                          <td bordercolor="#993366" ><span class="style14"><?php echo $arr_control_salida[$i]['id_por_sucursal']; ?></span></td>
                          <td bordercolor="#993366" ><span class="style14"><?php echo $arr_control_salida[$i]['ruta']; ?></span></td>
                          <td bordercolor="#993366" ><span class="style14"><?php echo muestraFechaSola($arr_control_salida[$i]['fecha_salida'],'es'); ?></span></td>
	                      <td bordercolor="#993366" ><span class="style14"><?php echo $arr_control_salida[$i]['placa']; ?></span></td>
                          <td bordercolor="#993366" >
					  	  <div align="right" class="style14"><?php echo number_format($arr_control_salida[$i]['monto'],2,',','.'); 
								$total[$i]+=$arr_control_salida[$i]['monto']; 
								
							?>				  	        </div></td>
                           <td bordercolor="#993366" >
					   	   <div align="right" class="style14"><?php
					   	   		$Desvio[$i]=$arr_control_salida[$i]['desvio_monto']+$arr_control_salida[$i]['desvioc_monto'];	
					   	   		echo number_format($Desvio[$i],2,',','.'); 
								$total[$i]+=$Desvio[$i]; 
								
							?>				     </div></td>
                          <td bordercolor="#993366" >
						  	<div align="right" class="style14">
						  	  <?php 
								$caleta=$arr_control_salida[$i]['caleta'];
								if(inList($arr_control_salida[$i]['tipo'],'2,3'))
									$caleta=0;
								
									
							 	echo  number_format($caleta,2,',','.'); 
								$total[$i]+=$caleta;
								?>
				  	        </div></td>
                          <td bordercolor="#993366" >
						  	<div align="right" class="style14">
						  	  <?php 
								$caja[$i]=$arr_control_salida[$i]['caja_adelanto']+$arr_control_salida[$i]['caja_caleta'];
								echo number_format($caja[$i],2,',','.'); 
								$total[$i]-=$caja[$i]; 
							
							?>
				  	        </div></td>
				  	        <td bordercolor="#993366" >
						   	   <div align="right" class="style14">
						   	   	<?php 
						   	   		$Reparto[$i]=$arr_control_salida[$i]['reparto_monto']+$arr_control_salida[$i]['repartol_monto'];
						   	   	echo number_format($Reparto[$i],2,',','.'); 
									$total[$i]+=$Reparto[$i]; ?>	
								</div></td>                         
                           
                         
                           <td bordercolor="#993366" >
						  	 <div align="right" class="style14">
						  	   <?php 
								$arr_control_post_mas=$obj_control_post->get_control_post('','1');
								$epsp[$i]=0;
								for($j=0;$j<sizeof($arr_control_post_mas);$j++)
								{
									$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$arr_control_salida[$i]['id'],$arr_control_post_mas[$j]['id']);
									$epsp[$i]+=$arr_control_salida_detalle_post[0]['monto'];
									
								}
								
								echo number_format($epsp[$i],2,',','.'); 
								$total[$i]+=$epsp[$i]; 
								
								
							?>
				  	         </div></td>
                         
                          <td bordercolor="#993366" >
						  	<div align="right" class="style14">
						  	  <?php 
								$arr_control_post_min=$obj_control_post->get_control_post('','2');
								$epsm[$i]=0;
								for($j=0;$j<sizeof($arr_control_post_min);$j++)
								{
									$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$arr_control_salida[$i]['id'],$arr_control_post_min[$j]['id']);
									$epsm[$i]+=$arr_control_salida_detalle_post[0]['monto'];
									
								}
								
								echo number_format($epsm[$i],2,',','.');
								$total[$i]-=$epsm[$i];
								
							?>
				  	        </div></td>
                           <td bordercolor="#993366" >
					   	    <div align="right" class="style14"><?php echo number_format($total[$i],2,',','.'); ?>				   	         </div></td>
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