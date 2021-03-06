<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2')) header('Location: ../lib/common/logout.php');
$obj_sucursal=new class_sucursal;
$obj_vehiculo= new class_vehiculo;
$obj_empresa= new class_empresa;
$obj_escolta= new class_escolta;
$obj_ruta_base= new class_ruta_base;
$obj_tabulador_costo= new class_tabulador_costo;
$obj_transportista= new class_transportista;
$obj_zona= new class_zona;
$obj_estado= new class_estado;
$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle= new class_control_salida_detalle;
$obj_control_salida_detalle_post= new class_control_salida_detalle_post;
$obj_control_post= new class_control_post;


//cargo los listados porteriores ala salida
$arr_add_control_post=$obj_control_post->get_control_post('','1');//eventos posterior a la salida que suman
$arr_min_control_post=$obj_control_post->get_control_post('','2');//eventos posterior a la salida que restan


$id=$_REQUEST['id'];
$arr_control_salida=$obj_control_salida->get_control_salida($id);
$arr_transportista=$obj_transportista->get_transportista($arr_control_salida[0]['id_transportista']);
$arr_empresa=$obj_empresa->get_empresa($arr_transportista[0]['id_empresa']);
///datos del scolta
if($arr_control_salida[0]['id_escolta'])
{
	$arr_escolta=$obj_escolta->get_escolta($arr_transportista[0]['id_escolta']);
	$arr_empresa_escolta=$obj_empresa->get_empresa($arr_escolta[0]['id_empresa']);
	$esclata=$arr_escolta[0]['nombre'].' '.$arr_escolta[0]['apellido']; 
	$empresa_escolta=$arr_empresa_escolta[0]['descripcion'];
}
else
{	$esclata=''; $empresa_escolta='';	}

$id_control_salida=$arr_control_salida[0]['id'];//tomo el valor del id del contro de salida
if($_REQUEST['acc']=='Editar'){

	$arr_control_salida_detalle=$obj_control_salida_detalle->get_control_salida_detalle($arr_control_salida[0]['id']);
	$status_general='3';//supongo q la quia sera liquidada
	$status_uso='1';//suponemos q el trasportista y el vehiculo seran activados para volver a transportar, esto quiere decir q sus facturas han sido liquidadas asi podra usarse de nuevo este transportista y vehiculo
	for($i=0;$i<sizeof($arr_control_salida_detalle);$i++){
		$status=1;

		$parametros=$_REQUEST['liq_azul_'.$i].','.$_REQUEST['liq_blanca_'.$i].','.$_REQUEST['liq_amarilla_'.$i];
		
		if(inList('1',$parametros))  $status=3;
		else {
			$status_general=1;//si alguna de las facturas no se liquida ponemos el status de la gia como activa
			$status_uso='3';//mantenemos en uso a trasportista y al camion
		}
		$obj_control_salida_detalle->liquidar_factura($arr_control_salida_detalle[$i]['id'],$_REQUEST['liq_amarilla_'.$i],$_REQUEST['liq_azul_'.$i],$_REQUEST['liq_blanca_'.$i],$status);	
		
	} 
	
	if(sizeof($arr_control_salida_detalle)==0){
		$status_general=1;//si no hay facturas
	}
	
	//cambio el status de la guia de  transporte bien sea a activa o liquidada
	$obj_control_salida->change_status_control_salida($arr_control_salida[0]['id'],$status_general);
	//edito los comentarios posteriores a la salida q viene a ser el valor verdadero a cambiar fuera del status
	$obj_control_salida-> update_control_salida($arr_control_salida[0]['id'],$_REQUEST['observaciones_post']);
	
	
	//busco la cedula del transportista para asi editar y cambiar de estatus al transportista que puede estar o no e varias sucursales;
	$arr_transportista=$obj_transportista->get_transportista($arr_control_salida[0]['id_transportista']);
	$change_status_transportista=$obj_transportista->change_status_transportista($arr_transportista[0]['rif'],$status_uso);//cambio su estatus a en servivio o activo
	
	//cambio el estatus del vehiculo
	$change_status_vehiculo=$obj_vehiculo->change_status_vehiculo($arr_control_salida[0]['placa'],$status_uso);//cambio su estatus a en servivio o activo
	
	//se anexa o edita los costos porteriores a la salida de el transportista ADDICION
	
	for($i=0;$i<sizeof($arr_add_control_post);$i++){
		if($_REQUEST['act_post_ad_'.$i]){

			//busco si existe o no un detalle posterior para esta guia
			$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$id_control_salida,$arr_add_control_post[$i]['id']);
			if(sizeof($arr_control_salida_detalle_post)==0){
			
				$new_control_salida_detalle_post=$obj_control_salida_detalle_post->add_control_salida_detalle_post($id_control_salida,$arr_add_control_post[$i]['id'],$_REQUEST['mon_post_ad_'.$i]);
			}//si se encontro o no el posterior
			else{
				$editar_control_salida_detalle_post=$obj_control_salida_detalle_post->edit_control_salida_detalle_post($arr_control_salida_detalle_post[0]['id'],$_REQUEST['mon_post_ad_'.$i]);
				;
			
				
			}//si se encontro o no el posterior
		}
		
	}
	//se anexa o edita los costos porteriores a la salida de el transportista RESTA
	
	for($i=0;$i<sizeof($arr_min_control_post);$i++){
		if($_REQUEST['act_post_mi_'.$i]){

			//busco si existe o no un detalle posterior para esta guia
			$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$id_control_salida,$arr_min_control_post[$i]['id']);
			if(sizeof($arr_control_salida_detalle_post)==0){
			
				$new_control_salida_detalle_post=$obj_control_salida_detalle_post->add_control_salida_detalle_post($id_control_salida,$arr_min_control_post[$i]['id'],$_REQUEST['mon_post_mi_'.$i]);
			}//si se encontro o no el posterior
			else{
				$editar_control_salida_detalle_post=$obj_control_salida_detalle_post->edit_control_salida_detalle_post($arr_control_salida_detalle_post[0]['id'],$_REQUEST['mon_post_mi_'.$i]);
				;
			
				
			}//si se encontro o no el posterior
		}
		
	}
	
	
	
	
	header('Location: forma_guia_transporte_list.php?tipo=1');
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

<style type="text/css">
<!--
.style3 {width: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal;}
-->
</style>
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
                <table align="center" width="95%" >
                  <tr class="tabla_barra_opciones" >
                    <td colspan="2"><table class="tabla_opciones" >
                        <tr >
                          <td width="72%" class="form_titulo_procesos" >Editar Guia de Transporte</td>
                          <td width="28%"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="20%" >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%" ><a href="forma_guia_transporte_list.php?tipo=1" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center"><table class="tablas_procesos" >
                        <tr class="error_mesaje_acme" >
                          <td align="center"  ></td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td ><!--DATOS ENCABEZADO-->
                              <table class="tablas_procesos_datos">
                                <tr>
                                  <td class="form_label_proceso" colspan="4">Transporte
                                      <input type="hidden" id="id_guia" name="id_guia" value=<?php echo $id; ?> /></td>
                                </tr>
                                <tr>
                                  <td  class="form_label_proceso">Fecha: </td>
                                  <td width="37%" class="form_label_procesos_imp" ><?php echo muestrafecha($arr_control_salida[0]['fecha_salida'],'es');?> </td>
                                  <td    class="form_label_proceso">No. Control</td>
                                  <td  class="form_label_procesos_imp" ><?php 
						  			//buscamos el prefijo de la sucursal
						  			$arr_sucursal=$obj_sucursal->get_sucursal($arr_control_salida[0]['id_sucursal']);
									$linea=$arr_sucursal[0]['prefijo'];
								//decidimos si imprimimos la nueva numeracion o la vieja
								if ($arr_control_salida[0]['id_sucursal']==1){
									if($arr_control_salida[0]['id_por_sucursal_new']){
										//completaSpaciosStrins($str,$cuantos,$valor,$pos)
										$numero_formateado=completaSpaciosStrins(0,4,$arr_control_salida[0]['id_por_sucursal_new'],'1');
										
										$num_guia=$linea.' '.$numero_formateado;//numero correlativo de cada sucursal
									}else{
										$num_guia=$arr_control_salida[0]['id_por_sucursal'];//numero correlativo de cada sucursal	
									}
								}
								else
									$num_guia=$arr_control_salida[0]['id_por_sucursal'];//numero correlativo de cada sucursal 
								echo $num_guia; 
						  
						  		
								
							?></td>
                                </tr>
                                <tr>
                                  <td  class="form_label_proceso">Empresa: </td>
                                  <td class="form_label_procesos_imp" ><div class="form_label_view" > <?php echo htmlentities($arr_empresa[0]['descripcion']);?> </div></td>
                                  <td    class="form_label_proceso">Transportista: </td>
                                  <td  class="form_label_procesos_imp" id="id_carga_transportista"><div class="form_label_view" > <?php echo htmlentities($arr_transportista[0]['nombre'].' '.$arr_transportista[0]['apellido']);?> </div></td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Vehiculo: </td>
                                  <td  class="form_label_procesos_imp" id="id_carga_vehiculo"><div class="form_label_view" > <?php echo htmlentities($arr_control_salida[0]['placa']);?> </div></td>
                                  <td class="tr_mensaje_ayuda" colspan="2" id="vehiculo_mensaje">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso" colspan="4">Escolta</td>
                                </tr>
                                <tr>
                                  <td width="16%" class="form_label_proceso">Empresa: </td>
                                  <td   class="form_label_procesos_imp" ><div class="form_label_view" ><?php echo htmlentities($empresa_escolta);?></div></td>
                                  <td  width="16%"  class="form_label_proceso">Escolta: </td>
                                  <td  class="form_label_procesos_imp"	 id="id_carga_escolta"><div class="form_label_view" ><?php echo htmlentities($escolta);?></div></td>
                                </tr>
                              </table>
                            <!--DATOS ENCABEZADO-->
                          </td>
                        </tr>
                        <tr >
                          <td  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr>
                          <td  id="seccion_ruta"><table  class="tablas_procesos_datos">
                              <tr>
                                <td class="form_label_proceso" colspan="4">Datos del destino</td>
                              </tr>
                              <tr>
                                <td width="16%" class="form_label_proceso">Ruta: </td>
                                <td  colspan="2"><div class="form_label_view" > <?php echo htmlentities($arr_control_salida[0]['ruta']);?> </div></td>
                                <td width="5%" rowspan="2"   class="tr_mensaje_ayuda"  id="tr_message"></td>
                              </tr>
                              <tr>
                                <td class="form_label_proceso">Desvio: </td>
                                <td   colspan="2"><div class="form_label_view" > <?php echo htmlentities($arr_control_salida[0]['desvio']);?> </div></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><!--TABLA DE LAS FACTURAS -->
                              <table class="tablas_procesos_datos">
                                <tr>
                                  <td class="form_label_proceso" colspan="4">Facturas a Transportar</td>
                                </tr>
                                <tr>
                                  <td colspan="4"><!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->
                                      <table  id="tabla_facturas" width="100%" cellpadding="0">
                                        <tr>
                                          <td width="42%" class="form_label_proceso"><div align="center">CLIENTE</div></td>
                                          <td width="19%" class="form_label_proceso"><div align="center">NO. FACTURA</div></td>
                                          <td width="22%" class="form_label_proceso"><div align="center">MONTO</div></td>
                                          <td width="17%" class="form_label_proceso"><div align="center">LIQUIDACI&Oacute;N</div></td>
                                        </tr>
                                        <?php 
												$arr_control_salida_detalle=$obj_control_salida_detalle->get_control_salida_detalle($arr_control_salida[0]['id']);
												for($i=0;$i<sizeof($arr_control_salida_detalle);$i++){
													if ($i % 2){
													$clase = "tablas_listados_datos_par";
												} else{
													$clase = "tablas_listados_datos_imp";
														}
											?>
                                        <tr class="<?php echo $clase;?>">
                                          <td align="left"><div class="form_label_edit_guia" > <?php echo htmlentities($arr_control_salida_detalle[$i]['cliente']);?> </div></td>
                                          <td align="center"><div class="form_label_edit_guia" > <?php echo $arr_control_salida_detalle[$i]['id_factura'];?> </div></td>
                                          <td  align="right"><div class="form_label_edit_guia" > <?php echo $arr_control_salida_detalle[$i]['monto_factura'];
											  	$total+=$arr_control_salida_detalle[$i]['monto_factura'];
											  ?> &nbsp;&nbsp;&nbsp;</div></td>
                                          <td align="center" id="fac_img_0"><table width="100%" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td bgcolor="#C1C1FF" align="center"><input type="checkbox" id="liq_azul_<?php echo $i; ?>" value="1" name="liq_azul_<?php echo $i; ?>" <?php if($arr_control_salida_detalle[$i]['liq_azul']=='1') echo 'checked'; ?>   class="form_check_proceso"  />
                                                </td>
                                                <td bgcolor="#FFFFFF" align="center"><input type="checkbox" id="liq_blanca_<?php echo $i; ?>" value="1" name="liq_blanca_<?php echo $i; ?>"  class="form_check_proceso"   <?php if($arr_control_salida_detalle[$i]['liq_blanca']=='1') echo 'checked'; ?>   />
                                                </td>
                                                <td bgcolor="#FFCC00" align="center"><input name="liq_amarilla_<?php echo $i; ?>" type="checkbox" value="1" class="style3" id="liq_amarilla_<?php echo $i; ?>"  <?php if($arr_control_salida_detalle[$i]['liq_amarilla']=='1') echo 'checked'; ?>  />
                                                </td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <?php } ?>
                                      </table>
                                    <!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->
                                  </td>
                                </tr>
                                <tr>
                                  <td><table width="100%" cellpadding="0">
                                      <tr>
                                        <td colspan="2" class="form_label_subtotales" align="right" >Monto Total en Facturas:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="22%" align="center"><div class="form_label_view" > <?php echo $total;?> </div></td>
                                        <td width="17%">&nbsp;</td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                            <!--TABLA DE LAS FACTURAS -->
                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr>
                          <td align="center"><!--DATOS DEL COSTO DEL VIAJE-->
                              <table class="tablas_procesos_datos">
                                <tr>
                                  <td class="form_label_proceso" colspan="4">Datos del Costo del Viaje</td>
                                </tr>
                                <tr>
                                  <td width="21%" class="form_label_proceso">Valor del Viaje: </td>
                                  <td class="form_label_procesos_imp" colspan="1"><div class="form_label_view" ><?php echo $arr_control_salida[0]['monto'];?></div></td>
                                  <td colspan="2" class="form_label_proceso" ></td>
                                </tr>
                                <tr>
                                  <td width="21%" class="form_label_proceso">Valor de Escolta: </td>
                                  <td  width="29%" class="form_label_procesos_imp" ><div class="form_label_view" ><?php echo $arr_control_salida[0]['escolta_monto'];?></div></td>
                                  <td  width="24%"  class="form_label_proceso">Caleta: </td>
                                  <td width="26%" class="form_label_procesos_imp"><div class="form_label_view" ><?php echo $arr_control_salida[0]['caleta'];?></div></td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Desvio: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" ><?php echo $arr_control_salida[0]['desvio_monto'];?></div></td>
                                  <td class="form_label_proceso">Caleta Esecial: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" ><?php echo $arr_control_salida[0]['caleta_especial'];?></div></td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Adelanto: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" ><?php echo $arr_control_salida[0]['adelanto'];?></div></td>
                                  <td class="form_label_proceso">Devolución: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" ><?php echo $arr_control_salida[0]['devolucion_monto'];?></div></td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Total Sin Escolta: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" >
                                    <?php 
								  				echo $tsines=$arr_control_salida[0]['monto']+$arr_control_salida[0]['desvio_monto']+$arr_control_salida[0]['desvio_monto']+$arr_control_salida[0]['caleta']+$arr_control_salida[0]['caleta_especial']+$arr_control_salida[0]['devolucion_monto'];
								?>
                                  </div></td>
                                  <td class="form_label_proceso">Total Con Escolta: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" ><?php echo  $tsines=$tsines+$arr_control_salida[0]['escolta_monto'];?></div></td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso" colspan="4">Pagos realizados a la salida (Pagos con Caja)</td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Adelanto: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" ><?php echo $arr_control_salida[0]['caja_adelanto'];?></div></td>
                                  <td class="form_label_proceso">Caleta: </td>
                                  <td  class="form_label_procesos_imp"><div class="form_label_view" ><?php echo $arr_control_salida[0]['caja_caleta'];?></div></td>
                                </tr>
                              </table>
                            <!--DATOS DEL COSTO DEL VIAJE-->
                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr>
                          <td align="center"><!--DATOS DEL COSTO DEL VIAJE-->
                              <table class="tablas_procesos_datos">
                                <tr>
                                  <td width="21%" class="form_label_proceso">Observaciones: </td>
                                  <td width="79%" class="form_label_procesos_imp"><div class="form_label_view" ><?php echo htmlentities($arr_control_salida[0]['observaciones']);?></div></td>
                                </tr>
                              </table>
                            <!--DATOS DEL COSTO DEL VIAJE-->
                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr>
                          <td class="form_label_proceso" colspan="4">EVENTOS POSTERIORES A LA SALIDA.</td>
                        </tr>
                        <tr>
                          <td><!--TABLA QUE CONTENDRA LOS EVENTOS POSTERIORES A LA SALIDA-->
                              <table  width="100%" cellpadding="1" cellspacing="1">
                                <tr>
                                  <td width="50%" valign="top"><!--TABLA QUE CONTENDRA LOS EVENTOS POSTERIORES A LA SALIDA QUE SUMAN-->
                                      <table   width="100%" cellpadding="0">
                                        <tr>
                                          <td colspan="3" class="form_label_proceso"> Aumentan el valor del viaje </td>
                                        </tr>
                                        <tr>
                                          <td width="15%"  class="form_label_proceso"><div align="center">ACT.</div></td>
                                          <td width="57%" class="form_label_proceso"><div align="center">MOTIVO</div></td>
                                          <td width="28%"  class="form_label_proceso"><div align="center">MONTO</div></td>
                                        </tr>
                                        <?php 
															
															for($pa=0;$pa<sizeof($arr_add_control_post);$pa++){
															//busco datos para esta relacionguia evento posterior de haberlo se colocara en la caja de monto el valor correspondiente
															$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$id_control_salida,$arr_add_control_post[$pa]['id']);
																if ($pa % 2){
																$clase = "tablas_listados_datos_par";
															} else{
																$clase = "tablas_listados_datos_imp";
																	}
																	if(sizeof($arr_control_salida_detalle_post)==0)
																	{
																		$monto=0;
																	}else{
																		$monto=$arr_control_salida_detalle_post[0]['monto'];
																	}
														?>
                                        <tr class="<?php echo $clase;  ?>">
                                          <td  align="center"><input type="checkbox" id="act_post_ad_<?php echo $pa; ?>" value="1" name="act_post_ad_<?php echo $pa; ?>" class="form_check_proceso"  />
                                          </td>
                                          <td align="center"class="form_label_procesos_imp"><div class="form_label_view_post" ><?php echo htmlentities($arr_add_control_post[$pa]['descripcion']); ?></div></td>
                                          <td align="center"><input name="mon_post_ad_<?php echo $pa; ?>" type="text" class="form_caja_proceso_numero_menor" id="mon_post_ad_<?php echo $pa; ?>" value="<?php echo $monto; ?>"    maxlength="9" onkeypress="return acceptNumFloat(event)" /></td>
                                        </tr>
                                        <?php } ?>
                                      </table>
                                    <!--TABLA QUE CONTENDRA LOS EVENTOS POSTERIORES A LA SALIDA QUE SUMAN-->
                                  </td>
                                  <td valign="top"><!--TABLA QUE CONTENDRA LOS EVENTOS POSTERIORES A LA SALIDA QUE RESTAN-->
                                      <table   width="100%" cellpadding="0">
                                        <tr>
                                          <td colspan="3" class="form_label_proceso"> Disminuyen el valor del viaje </td>
                                        </tr>
                                        <tr>
                                          <td width="15%"  class="form_label_proceso"><div align="center">ACT.</div></td>
                                          <td width="62%" class="form_label_proceso"><div align="center">MOTIVO</div></td>
                                          <td width="23%"  class="form_label_proceso"><div align="center">MONTO</div></td>
                                        </tr>
                                        <?php 
															
															for($pm=0;$pm<sizeof($arr_min_control_post);$pm++){
															
															$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$id_control_salida,$arr_min_control_post[$pm]['id']);
															
															if ($pm % 2){
																$clase = "tablas_listados_datos_par";
															} else{
																$clase = "tablas_listados_datos_imp";
																	}
																	if(sizeof($arr_control_salida_detalle_post)==0)
																	{
																		$monto=0;
																	}else{
																		$monto=$arr_control_salida_detalle_post[0]['monto'];
																	}
														?>
                                        <tr class="<?php echo $clase;  ?>">
                                          <td  align="center"><input type="checkbox" id="act_post_mi_<?php echo $pm; ?>" value="1" name="act_post_mi_<?php echo $pm; ?>" class="form_check_proceso"  />
                                          </td>
                                          <td class="form_label_procesos_imp"><div class="form_label_view_post" ><?php echo htmlentities($arr_min_control_post[$pm]['descripcion']); ?></div></td>
                                          <td align="center"><input name="mon_post_mi_<?php echo $pm; ?>" type="text" class="form_caja_proceso_numero_menor" id="mon_post_mi_<?php echo $pm; ?>"   maxlength="9" onkeypress="return acceptNumFloat(event)"  value="<?php echo $monto; ?>"  /></td>
                                        </tr>
                                        <?php } ?>
                                      </table>
                                    <!--TABLA QUE CONTENDRA LOS EVENTOS POSTERIORES A LA SALIDA QUE RESTAN-->
                                  </td>
                                </tr>
                              </table>
                            <!--TABLA QUE CONTENDRA LOS EVENTOS POSTERIORES A LA SALIDA-->
                          </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr>
                          <td align="center"><!--DETALLES DE LOS GASTOS POSTERIORES A LA SALIDA DEL CAMNION-->
                              <table class="tablas_procesos_datos">
                                <tr>
                                  <td width="29%" class="form_label_proceso">Observaciones posteriores a la salida del camion: </td>
                                  <td width="71%" class="form_label_procesos_imp"><textarea id="observaciones_post" name="observaciones_post" class="form_text_proceso_ruta"><?php echo htmlentities($arr_control_salida[0]['observaciones_post']);?></textarea></td>
                                </tr>
                              </table>
                            <!--DETALLES DE LOS GASTOS POSTERIORES A LA SALIDA DEL CAMNION-->
                          </td>
                        </tr>
                        <tr >
                          <td  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td height="5"   id="campo de mensajes" align="justify"><font color="#000000" style="font-weight:bold; font-size:9px">Importante:</font> <strong><font color="#FF0000" style=" font-size:9px" >Debe checar &nbsp;en la  casilla de activaci&oacute;n (ACT.) de cada evento, sea para restar o sumar; y luego  introducir el monto de correspondiente. Si la casilla de activaci&oacute;n no es  seleccionada este monto no afectara en nada la gu&iacute;a por lo tanto no aumentara  ni disminuir&aacute; el valor de la misma.</font></strong> </td>
                        </tr>
                        <tr >
                          <td height="5"  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr >
                          <td  align="center"><input type="hidden" id="id_guia" name="id_guia" value="<?php echo $id;?>" /></td>
                        </tr>
                        <!--CARGA DE LA FACTURA-->
                        <!--ENVIO DE FORMULARIO-->
                        <tr>
                          <td align="center" id="botonera_activa" >
                          <?php if(inList($_SESSION['id_tipo_usuario'],'1,2')) { ?>
                          <input name="acc"  type="submit" class="form_botones" id="acc" style="cursor:hand" value="Editar"  />
                          <?php } ?>
                          </td>
                        </tr>
                        <!--ENVIO DE FORMULARIO-->
                        <tr >
                          <td height="10"  id="id_carga_factura"></td>
                        </tr>
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
