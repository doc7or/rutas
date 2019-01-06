<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$obj_control_salida= new class_control_salida;
$obj_nomina= new class_nomina;
$obj_nomina_detalle= new class_nomina_detalle;
$obj_empresa =new class_empresa;
$obj_transportista= new class_transportista;
$obj_control_post= new class_control_post;
$obj_nomina_detalle= new class_nomina_detalle;
$obj_control_salida_detalle_post= new class_control_salida_detalle_post;
$obj_iva= new class_iva;
$obj_vehiculo= new class_vehiculo;
$obj_sucursal=new class_sucursal;


$id=$_REQUEST['id'];
$id_sucursal=$_SESSION['id_sucursal'];
///die('este esel id'.$id);
$arr_nomina=$obj_nomina->get_nomina($id);
$arr_nomina_detalle=$obj_nomina_detalle->get_nomina_detalle($id);
		

$ce=0;	//CONTADOR DE EMPRESAS
$ct=0;	//CONTADOR DE TRANSPORTISTAS
$aTransportista[0]=0;//ARREGLO PARA LA CARGA DE LOS TRANSPORTISTAS

$aEmpresa[0]=0;//ARREGLO PARA LA CARGA DE LAS EMPRESAS

for($i=0;$i<sizeof($arr_nomina_detalle);$i++){
	if($i==0)	$id_glist_nomina_detalle=$arr_nomina_detalle[$i]['id_guia'];
	else $id_glist_nomina_detalle.=','.$arr_nomina_detalle[$i]['id_guia'];
}



$arr_contol_salida=$obj_control_salida->get_all_data_gcs($id_glist_nomina_detalle);

//echo sizeof($arr_contol_salida);

for($i=0;$i<sizeof($arr_contol_salida);$i++){
		$st=0;//SWICH DE TRANSPORTISTAS 
		$se=0;//SWICH DE EMPRESAS

		//busco la cantidad de empresas q existen haci hacer un arrreglo q se lleve los id de los diferentes empresas involucrados
		for($ie=0;$ie<sizeof($aEmpresa);$ie++){
			if($aEmpresa[$ie]==$arr_contol_salida[$i]['empresa_id']){
				$se=1;
				$guiaEmpresa[$ie].=$arr_contol_salida[$i]['id'].',';
			}
		}
		if($se==0)	{
			$aEmpresa[$ce]=$arr_contol_salida[$i]['empresa_id'];
			$guiaEmpresa[$ce]=$arr_contol_salida[$i]['id'].',';
			
			$ce++;
			$guiaEmpresa[$ce]='';
		}
		//busco la cantidad de empresas q existen haci hacer un arrreglo q se lleve los id de los diferentes empresas involucrados	
		
		
	
}//fin del for q recorre las guias



for($it=0;$it<sizeof($aTransportista);$it++){

			//	echo '<br>'.$aTransportista[$it].' --- '.$guiaTransportistas[$it];

}


$titulo='Nomina de Transportistas';
$forma='nomina.php';

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
                <table align="center" width="98%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" ><?php echo $titulo; 
							  
						?> </td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados_nomina" >
                        <!--ENCABEZADOS-->
                        <tr class="tabla_barra_opciones" >
                          <td colspan="6"><table class="tabla_opciones" >
                              <tr >
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  ><a href="nomina_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
                                      <td width="20%"  ><a href="nomina_transportistas_xls.php?id=<?php echo $id; ?>&amp;formato=2" ><img src="../images/page_word.png" alt="Descargar Word"  style="border:none" title="Descargar Word" /></a></td>
                                      <td width="20%" ><a href="nomina_transportistas_xls.php?id=<?php echo $id; ?>&formato=1" ><img src="../images/excel.png" alt="Descargar Excel"  style="border:none" title="Descargar Excel" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <?php 
		 //variables para los totales generales
		$tgmonto=0;//total del monto
		$tgdesvio=0;//total de desvio
		$tgdesvioc=0;//total de desvio corto
		$tgrepartc=0;//total de reparto cantidad
		$tgrepartom=0;//total de reparto monto
		$tgrepartolm=0;//total de reparto monto
		$tgcaleta=0;//total caleta
		$tgcaja=0;//total caja
		$tgepsp=0;//tota evnetos posteriores a lsalida positivos
		$tgepsm=0;//total eventos posteriones a la salida negativos
		$tgsaldo=0;//total saldo
		
										
            for($ie=0;$ie<sizeof($aEmpresa);$ie++){
			$ct=0;
            $aTransportista =  array();
			$contador_0=0;
			$contador_20=0;
			$contador_40=0;
            
        ?>
                        <!--	ENCABEZADO DE LAS EMPRESAS	-->
                        <tr>
                          <td  colspan="6" class="tablas_listados_encabezados_sub_0"><?php 
							
									//aqui puedo crear una taba q seria lo menjor
									
									$arr_empresa=$obj_empresa->get_empresa($aEmpresa[$ie]);
									echo htmlentities($arr_empresa[0]['descripcion'].'  -  Segun Nomina ('.$_REQUEST['id_por_sucursal'].')');
									
									/////////////////////////////////////////////////////////////////////////////
									
							 ?>
                          </td>
                        </tr>
                        <!--	ENCABEZADO DE LAS EMPRESAS	-->
                        <?php
								       $guiaEmpresa[$ie]=delCharEnd($guiaEmpresa[$ie],1);	
										$arr_contol_salida_empresa=$obj_control_salida->get_all_data_gcs($guiaEmpresa[$ie]);
										
										 for($ige=0;$ige<sizeof($arr_contol_salida_empresa);$ige++){
										 
										$temonto=0;//total del monto
										$tedesvio=0;//total de desvio
										$tedesvioc=0;//total de desvio corto
										$terepartc=0;//total de reparto cantidad
										$terepartom=0;//total de reparto monto
										$terepartolm=0;//total de reparto monto
										$tecaleta=0;//total caleta
										$tecaja=0;//total caja
										$teepsp=0;//tota evnetos posteriores a lsalida positivos
										$teepsm=0;//total eventos posteriones a la salida negativos
										$tesaldo=0;//total saldo
											
										 
										 $st=0;
										 
										 
										 
					//busco la cantidad de traanportistas q existen haci hacer un arrreglo q se lleve los id de los diferentes transportistas involucrados
											   for($it=0;$it<sizeof($aTransportista);$it++){
													if($aTransportista[$it]==$arr_contol_salida_empresa[$ige]['id_transportista']){
														$st=1;
														$guiaTransportistas[$it].=$arr_contol_salida_empresa[$ige]['id'].',';
														
													}
												}
												if($st==0)	{
													$aTransportista[$ct]=$arr_contol_salida_empresa[$ige]['transportista_id'];
													$guiaTransportistas[$ct]=$arr_contol_salida_empresa[$ige]['id'].',';
													$ct++;
													$guiaTransportistas[$ct]='';
												}
					//busco la cantidad de traanportistas q existen haci hacer un arrreglo q se lleve los id de los diferentes transportistas involucrados
										}//fin del for para las guias de la empresa en la q este for ige
								
					//COMIENZO EL FOR DE LOS TRANSPORTISTAS
					for($it=0;$it<sizeof($aTransportista);$it++){					 
								?>
                        <tr class="tablas_listados_encabezados_sub">
                          <td><?php 
							
									//aqui puedo crear una taba q seria lo menjor
									$arr_transportista=$obj_transportista->get_list_transportista($aTransportista[$it]);
									
									echo htmlentities($arr_transportista[0]['apellido'].' '.$arr_transportista[0]['nombre']);
									
									/////////////////////////////////////////////////////////////////////////////
								
							 ?>
                          </td>
                        </tr>
                        <!--	ENCABEZADO DE LOS TRANSPORTISTAS	-->
                        <!--	LOS TRANSPORTISTAS Y SUS GUIAS	-->
                        <!--	TR DE DETALLE DE GUIAS	-->
                        <tr>
                          <td  colspan="6" ><!--	GUIAS DE TRASNSPORTE	-->
                              <table width="100%" cellpadding="1" cellspacing="0.1" border="1" style="border-color:#333333; border-bottom:1; border-left:1">
                                <tr class="tablas_listados_encabezados"   >
                                  <td>Guia</td>
                                  <td >Ruta</td>
                                  <td >Fecha</td>
                                  <td >Veh&iacute;culo</td>
                                  <td >Monto Flete</td>
                                  <td >Desvio Estado</td>
                                  <td >Desvio Interno</td>
								  <td >Reparto Corto</td>
								  <td >Reparto Largo</td>
                                  <td >Caleta</td>
                                  <td >Pago Caja</td>
                                  <td >EPS A</td>
                                  <td >EPS D</td>
                                  <td >Saldo</td>
                                </tr>
                                <?php
									   $guiaTransportistas[$it]=delCharEnd($guiaTransportistas[$it],1);	
										$arr_contol_salida_transportistas=$obj_control_salida->get_all_data_gcs($guiaTransportistas[$it]);
									
									
											
									
										$tmonto=0;//total del monto
										$tdesvio=0;//total de desvio
										$tdesvioc=0;//total de desvio corto
										$trepartc=0;//total de reparto cantidad
										$trepartom=0;//total de reparto monto
										$trepartolm=0;//total de reparto monto
										$tcaleta=0;//total caleta
										$tcaja=0;//total caja
										$tepsp=0;//tota evnetos posteriores a lsalida positivos
										$tepsm=0;//total eventos posteriones a la salida negativos
										$tsaldo=0;//total saldo
										 for($igt=0;$igt<sizeof($arr_contol_salida_transportistas);$igt++){
										 //aqui aumento los contadores de las especiales para que calcule segun  lo especial de la emoresa su nomina
											if($arr_contol_salida_transportistas[$igt]['especial']==0)	$contador_0++;
											if($arr_contol_salida_transportistas[$igt]['especial']==20)	$contador_20++;
											if($arr_contol_salida_transportistas[$igt]['especial']==40)	$contador_40++;
										
										 $saldo=0;
										 
										if ($igt % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
												
										//VERIFICAMOS QUE IPO DE QUIA SERA LA QUE VASMOS A LLAMAR
										if($arr_contol_salida_transportistas[$igt]['tipo']=='1'){	$url='forma_guia_transporte_popup.php?id=';	}
										if($arr_contol_salida_transportistas[$igt]['tipo']=='2'){	$url='forma_guia_traslado_popup.php?id=';	}
										if($arr_contol_salida_transportistas[$igt]['tipo']=='3'){	$url='forma_guia_nota_entrega_popup.php?id=';	}
									?>
                                <tr class="<?php echo $clase;?>">
                                
                                  <td onclick="popup_basic('<?php echo $url.$arr_contol_salida_transportistas[$igt]['id']; ?>');" style="cursor:pointer" >
								   <?php 
						  			//buscamos el prefijo de la sucursal
						  			$arr_sucursal=$obj_sucursal->get_sucursal($arr_control_salida[$i]['id_sucursal']);
									$linea=$arr_sucursal[0]['prefijo'];
								//decidimos si imprimimos la nueva numeracion o la vieja
								if ($arr_contol_salida_transportistas[$igt]['id_sucursal']!=2){
									if($arr_contol_salida_transportistas[$igt]['id_por_sucursal_new']){
										//completaSpaciosStrins($str,$cuantos,$valor,$pos)
										$numero_formateado=completaSpaciosStrins(0,4,$arr_contol_salida_transportistas[$igt]['id_por_sucursal_new'],'1');
										
										$num_guia=$linea.' '.$numero_formateado;//numero correlativo de cada sucursal
									}else{
										$num_guia=$arr_contol_salida_transportistas[$igt]['id_por_sucursal'];//numero correlativo de cada sucursal	
									}
								}
								else
									$num_guia=$arr_contol_salida_transportistas[$igt]['id_por_sucursal'];//numero correlativo de cada sucursal 
								echo $num_guia; 
						  
						  		
								
							?>
								  <?php //echo $arr_contol_salida_transportistas[$igt]['id_por_sucursal'];  ?>
                                  </td>
                                  <td  ><?php echo $arr_contol_salida_transportistas[$igt]['ruta']; ?></td>
                                  <td  ><?php echo muestraFechaSola($arr_contol_salida_transportistas[$igt]['fecha_salida'],'es'); ?></td>
                                  <td  ><?php 
									  $arr_vehiculo=$obj_vehiculo->get_pool_vehiculo($arr_contol_salida_transportistas[$igt]['placa'],'','','',$arr_contol_salida_transportistas[$igt]['id_sucursal'],'');
									  
									  echo $arr_vehiculo[0]['placa'].' --- '.$arr_vehiculo[0]['tipo']; ?></td>
                                  <td><div align="right"><?php 
								  		echo number_format($arr_contol_salida_transportistas[$igt]['monto'],2,',','.'); 
										$saldo+= $arr_contol_salida_transportistas[$igt]['monto']; 
										$tmonto+=$arr_contol_salida_transportistas[$igt]['monto']; //total del monto
										
								
							?></div></td>
                                  <td  ><div align="right">
                                    <?php 
								echo number_format($arr_contol_salida_transportistas[$igt]['desvio_monto'],2,',','.');
						  		  
								$saldo+= $arr_contol_salida_transportistas[$igt]['desvio_monto']; 
								$tdesvio+=$arr_contol_salida_transportistas[$igt]['desvio_monto'];//total de desvio
										
								
							?>
                                  </div></td>
                                  <td  ><div align="right">
                                    <?php 
								echo number_format($arr_contol_salida_transportistas[$igt]['desvioc_monto'],2,',','.');
						  		  
								$saldo+= $arr_contol_salida_transportistas[$igt]['desvioc_monto']; 
								$tdesvioc+=$arr_contol_salida_transportistas[$igt]['desvioc_monto'];//total de desvio
										
								
							?>
                                  </div></td>
								  <td  ><div align="right">
                                    <?php 
								echo number_format($arr_contol_salida_transportistas[$igt]['reparto_monto'],2,',','.');
						  		$saldo+=$arr_contol_salida_transportistas[$igt]['reparto_monto']; 
						  		 $trepartom+=$arr_contol_salida_transportistas[$igt]['reparto_monto'];//total repartos		
								
							?>
                                  </div></td>
								  <td  ><div align="right">
                                    <?php 
								echo number_format($arr_contol_salida_transportistas[$igt]['repartol_monto'],2,',','.');
						  		  
								$saldo+=$arr_contol_salida_transportistas[$igt]['repartol_monto']; 
								$trepartolm+=$arr_contol_salida_transportistas[$igt]['repartol_monto'];//total de reparto monto
										
								
							?>
                                  </div></td>
                                  <td  ><div align="right">
                                      <?php 
							 	$caleta=$arr_contol_salida_transportistas[$igt]['caleta'];
								 
								if(inList($arr_contol_salida_transportistas[$igt]['tipo'],'2,3'))
									$caleta=0;
								
									
							 	echo  number_format($caleta,2,',','.');
								$saldo+= $caleta; 
								$tcaleta+=$caleta;//total caleta
										
							?>
                                  </div></td>
                                  <td  ><div align="right">
                                      <?php 
								$caja= $arr_contol_salida_transportistas[$igt]['caja_adelanto']+ $arr_contol_salida_transportistas[$igt]['caja_caleta'];
								echo number_format($caja,2,',','.'); 
								$saldo-= $caja; 
								$tcaja+=$caja;//total caja
										
							?>
                                  </div></td>
                                  <td  ><div align="right">
                                      <?php 
								$arr_control_post_mas=$obj_control_post->get_control_post('','1');
								$epsp=0;
								for($j=0;$j<sizeof($arr_control_post_mas);$j++)
								{
									$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('', $arr_contol_salida_transportistas[$igt]['id'],$arr_control_post_mas[$j]['id']);
									$epsp+=$arr_control_salida_detalle_post[0]['monto'];
									
								}
								
								echo number_format($epsp,2,',','.'); 
								$saldo+=$epsp; 
								$tepsp+=$epsp; //tota evnetos posteriores a lsalida positivos
										
							?>
                                  </div></td>
                                  <td  ><div align="right">
                                      <?php 
								$arr_control_post_min=$obj_control_post->get_control_post('','2');
								$epsm=0;
								for($j=0;$j<sizeof($arr_control_post_min);$j++)
								{
									$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('', $arr_contol_salida_transportistas[$igt]['id'],$arr_control_post_min[$j]['id']);
									$epsm+=$arr_control_salida_detalle_post[0]['monto'];
									
								}
								
								echo number_format($epsm,2,',','.');
								$saldo-=$epsm;
								$tepsm+=$epsm;//total eventos posteriones a la salida negativos
										
							?>
                                  </div></td>
                                  <td  ><div align="right">
                                    <?php 
									  		echo number_format($saldo,2,',','.'); 
											$tsaldo+=$saldo;//total saldo 
									?>
                                  </div></td>
                                </tr>
                                <?php }//fin guias transportistas  ?>
                                <!--FILA DE TOTALES  TRANSPORTISTAS-->
                                <tr>
                                  <td colspan="4" align="right" class="form_label_subtotales" > Totales por Transportistas:&nbsp;&nbsp; </td>
                                  <td class="form_pool_cod_area"><div align="right"> <?php 
								  			echo number_format($tmonto,2,',','.');
											$temonto+= $tmonto;
										?> </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 													
										echo number_format($tdesvio,2,',','.'); 
										$tedesvio+=$tdesvio;
									?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 													
										echo number_format($tdesvioc,2,',','.'); 
										$tedesvioc+=$tdesvioc;
									?>
                                  </div></td>
								  <td class="form_pool_cod_area"><div align="right">
                                    <?php 								
										echo number_format($trepartom,2,',','.'); 
										$terepartom+=$trepartom;
									?>
                                  </div></td>
								  <td class="form_pool_cod_area"><div align="right">
                                    <?php 																		
										echo number_format($trepartolm,2,',','.'); 
										$terepartolm+=$trepartolm;
									?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
                                    	echo number_format($tcaleta,2,',','.');
									 $tecaleta+=$tcaleta;
									 ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 									  
									  echo number_format($tcaja,2,',','.'); 
									  $tecaja+=$tcaja;
									  ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
									  echo number_format($tepsp,2,',','.'); 
									  $teepsp+=$tepsp;
									  ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
										echo number_format($tepsm,2,',','.'); 
									  $teepsm+=$tepsm;
									  ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
									  
									  echo number_format($tsaldo,2,',','.'); 
									  $tesaldo+=$tsaldo;//total saldo
									  ?>
                                  </div></td>
                                </tr>
                                <!--FILA DE TOTALES  TRANSPORTISTAS-->
                              </table>
                            <!--	GUIAS DE TRASNSPORTE	-->
                          </td>
                        </tr>
                        <!--	TR DE DETALLE DE GUIAS	-->
                        <!--	LOS TRANSPORTISTAS Y SUS GUIAS	-->
                        <tr>
                          <td  colspan="6" >&nbsp;</td>
                        </tr>
                        <?php  	}//FIN DE LOS TRANSPORTISTAS   ?>
                        <tr>
                          <td colspan="6"><!--FILA DE TOTALES  EMPRESAS-->
                              <table width="100%" >
                                <tr class="tablas_listados_encabezados_totales"   >
                                  <td  colspan="4"  >Total</td>
                                  <td width="57"  >Monto Flete</td>
                                  <td width="62"    >Desvio Estado</td>
                                  <td width="62"    >Desvio Interno</td>
                                  <td width="62"    >Reparto Corto</td>
                                  <td width="57"   >Reparto Largo</td>
                                  <td width="57"   >Caleta</td>
                                  <td width="64"     >Pago Caja</td>
                                  <td width="68"    >EPS A</td>
                                  <td width="57"     >EPS D</td>
                                  <td width="85"     >Saldo</td>
                                </tr>
                                <tr>
                                  <td colspan="4" align="right" class="form_label_subtotales" > Totales por Empresa:&nbsp;&nbsp; </td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php
									 echo number_format($temonto,2,',','.');
									 $tgmonto+=$temonto;
									  ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 									
									echo number_format($tedesvio,2,',','.'); 
										$tgdesvio+= $tedesvio; 
									?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 									
									echo number_format($tedesvioc,2,',','.'); 
										$tgdesvioc+= $tedesvioc; 
									?>
                                  </div></td>
								  <td class="form_pool_cod_area"><div align="right">
                                    <?php 									
										echo number_format($terepartom,2,',','.'); 
										$tgrepartom+= $terepartom; 
									?>
                                  </div></td>
								  <td class="form_pool_cod_area"><div align="right">
                                    <?php 									
										echo number_format($terepartolm,2,',','.'); 
										$tgrepartolm+= $terepartolm; 
									?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php  
									 	echo  number_format($tecaleta,2,',','.');  
									$tgcaleta+=$tecaleta; 
									?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
									  echo number_format($tecaja,2,',','.');
									  $tgcaja+=$tecaja;
									  ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
									  echo number_format($teepsp,2,',','.'); 
									  $tgepsp+=$teepsp;
									  ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
									  echo number_format($teepsm,2,',','.'); 
									  $tgepsm+=$teepsm;
									  ?>
                                  </div></td>
                                  <td class="form_pool_cod_area"><div align="right">
                                    <?php 
									  echo number_format($tesaldo,2,',','.'); 
									  $tgsaldo+=$tesaldo;//total saldo
									  ?>
                                  </div></td>
                                </tr>
                                <tr>
                                  <td colspan="11">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2"></td>
                                  <td colspan="9"><table width="100%">
                                      <tr class="tablas_listados_encabezados_totales"   >
                                        <td width="43%"><div align="center">Descripcion</div></td>
                                        <td width="9%"><div align="center">%</div></td>
                                        <td width="16%"><div align="center">Monto</div></td>
                                        <td width="32%"><div align="center">Calculo</div></td>
                                      </tr>
                                      <tr  >
                                        <td width="43%" class="tablas_listados_datos_imp"><div align="center">Sub Monto Neto</div></td>
                                        <td width="9%" class="tablas_listados_datos_imp"><div align="center">- </div></td>
                                        <td width="16%" class="tablas_listados_datos_imp"><div align="right">
                                            <?php
											//
											$fecha=guardafecha($arr_nomina[0]['fecha'],'es');
												$arr_iva=$obj_iva->get_iva('',$arr_empresa[0]['naturaleza'],$fecha);
												if($arr_empresa[0]['id']!=8){
													$smn=$temonto+$tedesvio+$tedesvioc+$terepartom+$terepartolm+$tecaleta+$teepsp-$teepsm;
													$iva=$arr_iva[0]['valor'];
													$iva=$iva + 100;
													$iva=$iva / 100;
													$smn=$smn/$iva;
													//echo $iva=$arr_iva[0]['valor'];
												}else{
													$smn=$temonto+$tedesvio+$tedesvioc+$terepartom+$terepartolm+$tecaleta+$teepsp-$teepsm;
												
													//echo $iva=0;
												}
											//$smn=$temonto+$tedesvio+$tecaleta+$teepsp-$teepsm;
											echo number_format($smn,2,',','.');
										?>
                                        </div></td>
                                        <td width="32%" class="tablas_listados_datos_imp"><div align="center"> =(Monto_Flete+Desvio Estado+Desvio Interno+Reparto Corto+Reparto Largo+Caleta+
                                          EPS_A)
                                          - (EPS_D)</div></td>
                                      </tr>
                                   
                                   
                                      <tr  >
                                        <td width="43%" class="tablas_listados_datos_imp"><div align="center">IVA</div></td>
                                        <td width="9%" class="tablas_listados_datos_imp"><div align="center">
                                            <?php
												//$fecha=guardafecha($arr_nomina[0]['fecha'],'es');
												//$arr_iva=$obj_iva->get_iva('',$arr_empresa[0]['naturaleza'],$fecha);
												if($arr_empresa[0]['id']!=8){
													echo $iva=$arr_iva[0]['valor'];
												}else{
													echo $iva=0;
												}
												
 													
                                            ?>
                                        </div></td>
                                        <td width="16%" class="tablas_listados_datos_imp"><div align="right">
                                            <?php
										
											$miva=($smn*$iva)/100;
											 echo number_format($miva,2,',','.');
										
										?>
                                        </div></td>
                                        <td width="32%" class="tablas_listados_datos_imp"><div align="center">=(Monto_neto)*IVA%</div></td>
                                      </tr>
                                      <tr  >
                                        <td width="43%" class="tablas_listados_datos_imp"><div align="center">Retencion</div></td>
                                        <td width="9%" class="tablas_listados_datos_imp"><div align="center">
                                            <?php
												if($arr_empresa[0]['naturaleza']==2 && $id<415){
													echo $retencion=3;
												}else{
													echo $retencion=0;
												}
 													
                                                ?>
                                        </div></td>
                                        <td width="16%" class="tablas_listados_datos_imp"><div align="right">
                                            <?php
										
											$mretencion=($smn*$retencion)/100;
											echo number_format($mretencion,2,',','.');
										?>
                                        </div></td>
                                        <td width="32%" class="tablas_listados_datos_imp"><div align="center">=(Monto_neto)*Retencion%</div></td>
                                      </tr>
                                      <tr  >
                                        <td width="43%" class="tablas_listados_datos_imp"><div align="center">Total a Pagar al Afiliado </div></td>
                                        <td width="9%" class="tablas_listados_datos_imp"><div align="center">-</div></td>
                                        <td width="16%" class="tablas_listados_datos_imp"><div align="right">
                                            <?php
											
											$tpa=($smn+$miva)-($mretencion+$tecaja);
											if($tpa>=0) $tpa=$tpa;
											else $tpa=0;
											echo number_format($tpa,2,',','.');
										?>
                                        </div></td>
                                        <td width="32%" class="tablas_listados_datos_imp"><div align="center">=(Monto_neto+Iva)- (Retencion+Pago_Caja)</div></td>
                                      </tr>
                                      <tr  >
                                        <td width="43%" class="tablas_listados_datos_imp"><div align="center">Total a facrurar por la empresa </div></td>
                                        <td width="9%" class="tablas_listados_datos_imp"><div align="center">-</div></td>
                                        <td width="16%" class="tablas_listados_datos_imp"><div align="right">
                                            <?php
										echo number_format($tpa,2,',','.');
											$tpc=($smn+$miva);
										//	echo number_format($tpc,2,',','.');
											$tgtnac+=$tpc;
										
										?>
                                        </div></td>
                                        <td width="32%" class="tablas_listados_datos_imp"><div align="center">=(Monto_neto+Iva)</div></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                            <!--FILA DE TOTALES  EMPRESAS-->
                          </td>
                        </tr>
                        <tr>
                          <td  colspan="6" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td  colspan="6" >&nbsp;</td>
                        </tr>
                        <?php   }//fin del ciclo para las empresas involucradas ie  ?>
                        <tr>
                          <td colspan="6"><!--FILA DE TOTALES  EMPRESAS-->
                              <table width="100%" >
                                <tr class="tablas_listados_encabezados_totales"   >
                                  <td  colspan="4"  >Total</td>
                                  <td width="66"  >Monto Neto</td>
                                  <td width="59"    >Desvio Estado</td>
                                  <td width="59"    >Desvio Interno</td>
								  <td width="59"    >Reparto Corto</td>
								  <td width="59"    >Reparto Largo</td>
                                  <td width="55"   >Caleta</td>
                                  <td width="73"     >Pago Caja</td>
                                  <td width="55"    >EPS A</td>
                                  <td width="55"     >EPS D</td>
                                  <td width="55"     >Saldo</td>
                                </tr>
                                <tr>
                                  <td colspan="4" align="right" class="form_label_subtotales" > Totales Generales:&nbsp;&nbsp; </td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgmonto,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgdesvio,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgdesvioc,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgrepartom,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgrepartolm,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgcaleta,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgcaja,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgepsp,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgepsm,2,',','.'); ?></div></td>
                                  <td class="form_pool_cod_area"><div align="right"><?php echo number_format($tgsaldo,2,',','.'); ?></div></td>
                                </tr>
                                <tr>
                                  <td colspan="11">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2"></td>
                                  <td colspan="9"><table width="100%" >
                                      <tr class="tablas_listados_encabezados_totales"   >
                                        <td width="43%" ><div align="center">Descripci&oacute;n</div></td>
                                        <td width="16%"><div align="center">Monto</div></td>
                                        <td width="32%"><div align="center">Calculo</div></td>
                                      </tr>
                                      <tr  >
                                        <td width="43%" class="tablas_listados_datos_imp"><div align="left">Monto nomina</div></td>
                                        <td width="16%" class="tablas_listados_datos_imp"><div align="right">
                                            <?php
										
											$tgmn=$tgtnac;
											echo number_format($tgmn,2,',','.');
										
										?>
                                        </div></td>
                                        <td width="32%" class="tablas_listados_datos_imp"><div align="left">Sumatoria de los Total Neto a facturar por la empesa</div></td>
                                      </tr>
                                      <tr  >
                                        <td class="tablas_listados_datos_imp"><div align="left">Monto nomina pendiente</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="right">
                                            <?php
										
											$tgmn=$tgtnac-$tgcaja;
											echo number_format($tgmn,2,',','.');
										
										?>
                                        </div></td>
                                        <td class="tablas_listados_datos_imp"><div align="left">Monto nomina - Pago Caja</div></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                            <!--FILA DE TOTALES  EMPRESAS-->
                          </td>
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
