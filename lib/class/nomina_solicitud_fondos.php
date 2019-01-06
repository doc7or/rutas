<?php 
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/cheques.class.php");
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$cheques=new class_cheque();
$obj_control_salida= new class_control_salida;
$obj_nomina= new class_nomina;
$obj_sucursal= new class_sucursal;
$obj_nomina_detalle= new class_nomina_detalle;
$obj_empresa =new class_empresa;
$obj_transportista= new class_transportista;
$obj_control_post= new class_control_post;
$obj_nomina_detalle= new class_nomina_detalle;
$obj_control_salida_detalle_post= new class_control_salida_detalle_post;
$obj_iva= new class_iva;
$obj_vehiculo= new class_vehiculo;
/**********************************************************************************************
*Modificado el:1-08-2011
*Programador: Mervin Mujica.
*
**********************************************************************************************/
$id=$_REQUEST['id'];
$datos_sucursal=$obj_sucursal->get_sucursal($_GET[id_sucursal]);
$id_sucursal=$_SESSION['id_sucursal'];
//die('este esel id'.$id);
$arr_nomina=$obj_nomina->get_nomina($id);
$arr_nomina_detalle=$obj_nomina_detalle->get_nomina_detalle($id);
//if(inList($arr_nomina[0]['id_sucursal'],'1,2'))

///RESPUESTA DEL QUERY QUE DA COMO RESULTADO LAS GUIAS Q TIENE LA NOMINA Q SE CONSULTA EN EL $arr_nomina_detalle ESTO SE HACE MAS ABAJO
/*
		guia
		id,id_por_sucursal,id_sucursal,id_transportista,placa,fecha,fecha_salida,status,caleta,caleta_especial,monto,desvio,ruta,desvio_monto,devolucion_monto,
		adelanto,observaciones,fecha_liquidacion,id_escolta,escolta_monto,caja_adelanto,caja_caleta,monto_facturas,tipo,observaciones_post
		empresa
		empresa.id as empresa_id, empresa.rif as empresa_rif, empresa.telefono as empresa_telefono, empresa.responsable as empresa_responsable, empresa.naturaleza as 
		empresa_naturaleza, empresa.adelanto as empresa_adelanto, empresa.especial as empresa_especial,  empresa.descripcion as empresa_descripcion,
		transportista
		transportista.id as transportista_id, transportista.rif as transportista_rif, transportista.telefono as transportista_telefono, transportista.nombre as transportista_nombre , transportista.apellido as transportista_apellido 	
		*/
		

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
		
		//BUSCO LA DATA NECESARIA DE LA QUIA EN Q VA LA NOMINA SELECCIONADA
		//$arr_contol_salida=$obj_control_salida->get_all_data_gcs($arr_nomina_detalle[$i]['id_guia']);
		
		
		
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





//die();


$titulo='Solicitud de Fondos';
$forma='nomina.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" rel="shortcut icon" href="../images/icono.ico">
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>

</head>

<body id="todo"> 
<div id="capa_superior" style="display:none; background-color:  #848484;" align="center"></div>
            <div id="capa_superior1" class="sombra12" style="display:none; "></div>
            <div id="contenedor">
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
                    <td  colspan="2" class="form_titulo" >
                    	<?php echo $titulo; 
							  
						?>
                    </td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados_nomina" >
                        <!--ENCABEZADOS-->
                      <tr class="tabla_barra_opciones" >
                          <td><table class="tabla_opciones" >
                              <tr >
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  ><a href="nomina_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
                                      <td width="20%"  ><a href="nomina_solicitud_fondos_xls.php?id=<?php echo $id; ?>&amp;formato=2" ><img src="../images/page_word.png" alt="Descargar Word"  style="border:none" title="Descargar Word" /></a></td>
                                      <td width="20%" >
                                      
                                      	<a href="nomina_solicitud_fondos_xls.php?id=<?php echo $id; ?>&formato=1" ><img src="../images/excel.png" alt="Descargar Excel"  style="border:none" title="Descargar Excel" /></a></td>
                                  </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10"></td>
                        </tr>
                        <tr>
                          <td >
                          
                          	<!--ENCABEZADO DE LA SOLICITUD DE DINERO DE CADA SUCURSAL-->
                            <table align="center" width="98%">
                       	  <tr>
                                	<td width="22%" align="center" rowspan="4"><img src="../images/img_nemartiz.png" width="134" height="87" /></td>
                                  <td width="78%" class="form_titulo_nomina">Solicitud de Adelanto de Fondos para pago de Servicios de Transporte efectuados a :</td>
                              </tr>
                              <tr>
                              	<td class="form_titulo_nomina">
                                	CYBERLUX DE VENEZUELA, C.A   (<?php echo htmlentities($_SESSION['sucursal_detalle']); ?>)                              
                                </td>
                              </tr>
                              <tr>
                              	<td class="form_titulo">&nbsp;</td>
                             </tr>
                             <tr>   
                                <td>&nbsp;</td>
							</tr>			
                            </table>
                            
                            
                            <!--ENCABEZADO DE LA SOLICITUD DE DINERO DE CADA SUCURSAL-->
                          
                          </td>
                        </tr>
                        <tr>
                          <td >&nbsp;</td>
                        </tr>
                        <tr>
                          <td >
                          <!--TABLA DE DERALLE DE LA SOLICITUD DE FONDOS-->
                          	<table align="center" width="100%">
                            	<tr class="tablas_listados_encabezados_sub_0" >
                               	  <td width="28%"><input type="hidden" name="fecha_realizacion" id="fecha_realizacion" value="<?=$_GET['fecha_realizacion']?>">Afiliado Nemartiz</td>
                                    <td width="9%">Monto Neto</td>
                                    <td width="9%">Tasa IVA %</td>
                                    <td width="9%">Monto IVA</td>
                                    <td width="9%">% Retención ISLR</td>
                                    <td width="9%">Monto Retención ISLR</td>
                                    <td width="9%">Pago con Caja</td>
                                    <td width="9%">Total a Pagar al Afiliado</td>
                                    <td width="9%">Total a Facturar por afiliado</td>
                              </tr>
                               <?php 
		 //variables para los totales generales
		$tgmonto=0;//total del monto
		$tgdesvio=0;//total de desvio
		$tgcaleta=0;//total caleta
		$tgcaja=0;//total caja
		$tgepsp=0;//tota evnetos posteriores a lsalida positivos
		$tgepsm=0;//total eventos posteriones a la salida negativos
		$tgsaldo=0;//total saldo
		$i=0;//variable utilizada para dar nombres diferentes a cada campo
											
            for($ie=0;$ie<sizeof($aEmpresa);$ie++){
			$ct=0;
            $aTransportista =  array();
			$contador_0=0;
			$contador_20=0;
			$contador_40=0;
			
					if ($ie % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
												
										$guiaEmpresa[$ie]=delCharEnd($guiaEmpresa[$ie],1);	
										$arr_contol_salida_empresa=$obj_control_salida->get_all_data_gcs($guiaEmpresa[$ie]);
										
										$temonto=0;//total del monto
										$tedesvio=0;//total de desvio
										$tecaleta=0;//total caleta
										$tecaja=0;//total caja
										$teepsp=0;//tota evnetos posteriores a lsalida positivos
										$teepsm=0;//total eventos posteriones a la salida negativos
										$tesaldo=0;//total saldo
										
										 for($ige=0;$ige<sizeof($arr_contol_salida_empresa);$ige++){
										 	//aqui realizaremos la carga de los contadores de el especial para saber que especial se tomara
											 //aqui aumento los contadores de las especiales para que calcule segun  lo especial de la emoresa su nomina
											if($arr_contol_salida_empresa[$ige]['especial']==0)	$contador_0++;
											if($arr_contol_salida_empresa[$ige]['especial']==20)	$contador_20++;
											if($arr_contol_salida_empresa[$ige]['especial']==40)	$contador_40++;
											
											$temonto+=$arr_contol_salida_empresa[$ige]['monto'];
											$tedesvio+=$arr_contol_salida_empresa[$ige]['desvio_monto'];
											//CALCULO DE LA CALETA Q ES ESPECIAL
											$caleta=$arr_contol_salida_empresa[$ige]['caleta'];
											if(inList($arr_contol_salida_empresa[$ige]['tipo'],'2,3'))
												$caleta=0;
											$tecaleta+=$caleta;
											
											$tecaja+=$arr_contol_salida_empresa[$ige]['caja_adelanto']+$arr_contol_salida_empresa[$ige]['caja_caleta'];
											
											//EPS A
											$arr_control_post_mas=$obj_control_post->get_control_post('','1');
											$epsp=0;
											for($j=0;$j<sizeof($arr_control_post_mas);$j++)
											{
												$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('', $arr_contol_salida_empresa[$ige]['id'],$arr_control_post_mas[$j]['id']);
												$teepsp+=$arr_control_salida_detalle_post[0]['monto'];												
											}
									    	
											//EPS D
											$arr_control_post_mas=$obj_control_post->get_control_post('','2');
											$epsm=0;
											for($j=0;$j<sizeof($arr_control_post_mas);$j++)
											{
												$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('', $arr_contol_salida_empresa[$ige]['id'],$arr_control_post_mas[$j]['id']);
												$teepsm+=$arr_control_salida_detalle_post[0]['monto'];												
											}						
											
										 }//fin del for para las guias de la empresa en la q este for ige
										 
										 //CALCULOS PARA LA SOLICITUD DE FONDOS
										 $arr_empresa=$obj_empresa->get_empresa($aEmpresa[$ie]);
										 //aqui busco la empresa para saber el especial esto se hacia hasta el cambio a la las empresas que cambian de tratamiento especial
										 //la manera nueva sera esta 
										 if($contador_0>$contador_20+$contador_40) $empresa_especial=0;
											if($contador_20>$contador_0+$contador_40) $empresa_especial=20;
											if($contador_40>$contador_0+$contador_20) $empresa_especial=40;
													
										 $arr_cheques=$cheques->get_cheque(0,$arr_empresa[0]['id'],$id);//se consulta la tabla cheques para saber si ya fue realizado un cheque por la orden de pago de la empresa.
										 if ($arr_cheques[0]['id']!=0){
										 	$parametros=str_replace('|','!',$arr_cheques[0]['banco']).'|'.$arr_cheques[0]['num_cheque'].'|'.$arr_cheques[0]['monto'].'|'.str_replace('|','',$arr_cheques[0]['observaciones']).'|'.$arr_cheques[0]['fecha'];//banco|num_cheque|monto|observaciones
										 	$boton='cheque_Validado('.$i.',\''.$datos_sucursal[0][descripcion].'\',\''.$parametros.'\','.$id.');';
										 	$imagen='<img alt="Ver Cheque" title="ver cheque" src="../images/papel_impreso.png" />';
										 }else{
										 	$boton='imprimir_Comprobante_cheque('.$i.',\''.$datos_sucursal[0][descripcion].'\','.$id.','.$_GET[id_sucursal].');';
										 	$imagen='<img alt="Imprimir Cheque" title="Imprimir cheque" src="../images/impresora.png" />';
										 }
										// echo $arr_cheques[0]['id'].' ch';
										 $smn=$temonto+$tedesvio+$tecaleta+$teepsp-$teepsm;
										 $especial=($smn*$empresa_especial)/100;
										 $mn=$especial+$smn;
										 
									?>
                      	 <!--	LAS EMPRESAS	-->
                        <tr class="<?php echo $clase;?>">
                               	  <td ><?php 
								  		
										$auxiliar=htmlentities($arr_empresa[0]['descripcion']);
										echo htmlentities($auxiliar);
                                    	echo '<input type="hidden" name="descripcion'.$i.'" id="descripcion'.$i.'" value="'.$auxiliar.'|'.$arr_empresa[0]['id'].'">';
								   ?>                                  </td>
                                    <td ><div align="right">
									     <?php
											//
											$fecha=guardafecha($arr_nomina[0]['fecha'],'es');
												$arr_iva=$obj_iva->get_iva('',$arr_empresa[0]['naturaleza'],$fecha);
												if($arr_empresa[0]['id']!=8){
													$smn=$temonto+$tedesvio+$tecaleta+$teepsp-$teepsm;
													$iva=$arr_iva[0]['valor'];
													$iva=$iva + 100;
													$iva=$iva / 100;
													$smn=$smn/$iva;
													//echo $iva=$arr_iva[0]['valor'];
												}else{
													$smn=$temonto+$tedesvio+$tecaleta+$teepsp-$teepsm;
												
													//echo $iva=0;
												}
											//$smn=$temonto+$tedesvio+$tecaleta+$teepsp-$teepsm;
											echo number_format($smn,2,',','.');
											echo '<input type="hidden" name="monto_neto'.$i.'" id="monto_neto'.$i.'" value="'.number_format($smn,2,',','.').'">';
											$gmn= $gmn+$smn;
										?>
                                    
                                    
                                    </div></td>
                                    <td ><div align="right">
                                      <?php
									  
									  			$fecha=guardafecha($arr_nomina[0]['fecha'],'es');
												$arr_iva=$obj_iva->get_iva('',$arr_empresa[0]['naturaleza'],$fecha);
												if($arr_empresa[0]['id']!=8){
													if(inList($arr_nomina[0]['id_sucursal'],'1,2'))
														echo $iva=$arr_iva[0]['valor'];
													else
														echo $iva=0;
												}else{
													echo $iva=0;
												}
											echo '<input type="hidden" name="iva'.$i.'" id="iva'.$i.'" value="'.$iva.'">';	
 													
                                                ?>
                                    </div></td>
                                    <td ><div align="right">
                                      <?php
										
											$miva=($smn*$iva)/100;
											echo number_format($miva,2,',','.');
											$gmiva+=$miva;
										echo '<input type="hidden" name="monto_iva'.$i.'" id="monto_iva'.$i.'" value="'.number_format($miva,2,',','.').'">';
										?>
                                    </div></td>
                                    <td ><div align="right">
                                      <?php
												if($arr_empresa[0]['naturaleza']==2 && $id<415){
												//se hace conntra la nomina 415 para qu no altere las demas ya hechas
													if(inList($arr_nomina[0]['id_sucursal'],'1,2'))
														echo $retencion=3;
													else
														echo $retencion=0;
														
												}else{
													echo $retencion=0;
												}
 													echo '<input type="hidden" name="retencion'.$i.'" id="retencion'.$i.'" value="'.$retencion.'">';
                                                ?>
                                    </div></td>
                                    <td ><div align="right">
                                      <?php
										
											$mretencion=($smn*$retencion)/100;
											echo number_format($mretencion,2,',','.');
											$gmretencion+=$mretencion;
										echo '<input type="hidden" name="retencion_monto'.$i.'" id="retencion_monto'.$i.'" value="'.number_format($mretencion,2,',','.').'">';
										?>
                                    </div></td>
                                    <td ><div align="right">
                                      <?php 
									  echo number_format($tecaja,2,',','.'); 
									  $gtecaja+=$tecaja;
									  echo '<input type="hidden" name="pago_caja'.$i.'" id="pago_caja'.$i.'" value="'.number_format($tecaja,2,',','.').'">';
									  ?>
                                    </div></td>
                                    <td ><div align="right">
                                      <?php
											
											$tpa=($smn+$miva)-($mretencion+$tecaja);
											if($tpa>=0) $tpa=$tpa;
											else $tpa=0;
											echo number_format($tpa,2,',','.');
											echo '<input type="hidden" name="pago_afiliado'.$i.'" id="pago_afiliado'.$i.'" value="'.number_format($tpa,2,',','.').'">';
											$gtpa+=$tpa;
										?>
                                    </div></td>
                                    <td ><div align="right">
                                      <?php
											echo number_format($tpa,2,',','.');
											$tpc=($mn+$miva);
											//echo number_format($tpc,2,',','.');
											echo '<input type="hidden" name="pago_afiliado'.$i.'" id="pago_afiliado'.$i.'" value="'.number_format($tpa,2,',','.').'">';
											$gtpc+=$tpc;
										
										?>
                                    </div></td>
                                    <td align="center">
                                    <?php
                                    
                                    	echo '<button type="button"  name="imprimir'.$i.'" id="imprimir'.$i.'" onclick="'.$boton.'">'.$imagen.'</button>';
                                    	++$i; 
                                    ?>
                                    </td>
                              </tr>
                       
			
		              
                        	 <!--	LAS EMPRESAS	-->
                        <?php   }//fin del ciclo para las empresas involucradas ie  ?>	
                        <tr >
                          <td class="form_botones" ><div align="right">Totales:  </div></td>
                          <td class="form_botones" ><div align="right">
                            <?php 
									echo number_format($gmn,2,',','.'); 
									?>
                          </div></td>
                          <td class="form_botones" ><div align="center">-</div></td>
                          <td class="form_botones" ><div align="right">
                            <?php
										
											echo number_format($gmiva,2,',','.');
										
										?>
                          </div></td>
                          <td class="form_botones" ><div align="center">-</div></td>
                          <td class="form_botones" ><div align="right">
                            <?php
											echo number_format($gmretencion,2,',','.');
										
										?>
                          </div></td>
                          <td class="form_botones" ><div align="right">
                            <?php 
									  echo number_format($gtecaja,2,',','.');
									  
									  ?>
                          </div></td>
                          <td class="form_botones" ><div align="right">
                            <?php
											echo number_format($gtpa,2,',','.');
										?>
                          </div></td>
                          <td class="form_botones" ><div align="right">
                            <?php
										
											echo number_format($gtpc,2,',','.');
										
										?>
                          </div></td>
                        </tr>
                        <tr >
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                        </tr>
                        <tr >
                          <td colspan="9" align="center" >
                          
                          		<table width="80%">
                               	    <tr class="tablas_listados_encabezados_totales"   >
                                    	<td colspan="4"><div >Factura por emitir a Cyberlux
</div></td>
                                    </tr>
                                    <tr class="tablas_listados_encabezados_totales"   >
                                    	
                                   	  	  <td width="43%"><div align="center">Descripcion</div></td>
                                   	  <td width="9%"><div align="center">%</div></td>
                                          <td width="16%"><div align="center">Monto</div></td>
                                          <td width="32%"><div align="center">Calculo</div></td>
                                      </tr>
                                      <tr  >
                                   	  	<td width="43%" class="tablas_listados_datos_imp"><div align="center">Monto Base</div></td>
                                       	<td width="9%" class="tablas_listados_datos_imp">
                                          	<div align="center">-                                            </div>                                        </td>
                                        <td width="16%" class="tablas_listados_datos_imp"><div align="right">
                                        <?php
											//
											echo number_format($gtpc,2,',','.');
										
										?>
                                        </div></td>
                                        <td width="32%" class="tablas_listados_datos_imp"><div align="center">
                                        =(Sumatoria Total a Facturar por afiliado)</div></td>
                                      </tr>
                                      <tr  >
                                        <td class="tablas_listados_datos_imp"><div align="center">Monto  Factor</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center">- </div></td>
                                        <td class="tablas_listados_datos_imp"><div align="right">
                                          <?php
											//
												$fecha_nomina=guardaFechaSola($arr_nomina[0]['fecha']);
												if($fecha_nomina>=20090515) $varfactor=1;
												else $varfactor=0.9925;
												
											$fgtpc=$gtpc/$varfactor;
											echo $for_fgtpc=number_format ($fgtpc, 2, ',', '.');
										
										?>
                                        </div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center"> =(Monto Base / <?php echo $varfactor; ?>)</div></td>
                                      </tr>
                                      
									 <!--ESTA SECCION ES LA DEL CALCULO DEL IVA-->
									  <tr  >
                                        <td class="tablas_listados_datos_imp"><div align="center">Iva</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center">
										<?php 
												
												if($fecha_nomina>=20090401) $varIvaCam=12;
												else $varIvaCam=9;
												echo $varIvaCam;
										  ?>
										</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="right">
                                          <?php
											//
											$iva_fgtpc=$fgtpc*$varIvaCam/100;
											echo $for_iva_fgtpc=number_format ($iva_fgtpc, 2, ',', '.');
										
										?>
                                        </div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center"> =(Monto Factor)*<?php echo $varIvaCam; ?>%</div></td>
                                      </tr>
									  <!--ESTA SECCION ES LA DEL CALCULO DEL IVA-->
									  
                                      <tr  >
                                        <td class="tablas_listados_datos_imp"><div align="center">Retencion</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center">3</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="right">
                                          <?php
											//
											$ret_fgtpc=$fgtpc*0.03;
											echo $for_ret_fgtpc=number_format ($ret_fgtpc, 2, ',', '.');
										
										?>
                                        </div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center"> =(Monto Factor)*3%</div></td>
                                      </tr>
                                      <tr  >
                                        <td class="tablas_listados_datos_imp"><div align="center">Monto a Facturar</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center">-</div></td>
                                        <td class="tablas_listados_datos_imp"><div align="right">
                                          <?php
											//
											$monfac_fgtpc=$fgtpc+$iva_fgtpc;
											echo $for_monfac_fgtpc=number_format ($monfac_fgtpc, 2, ',', '.');
											
										?>
                                        </div></td>
                                        <td class="tablas_listados_datos_imp"><div align="center"> =(Monto Factor)+Iva</div></td>
                                      </tr>
                                </table>                          </td>
                        </tr>
                        <tr >
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                          <td >&nbsp;</td>
                        </tr>
                        <tr >
                          <td colspan="9" >
                          	<table width="100%">
                            	<tr>
                                	<td width="79%">
                                    	<span class="form_titulo_procesos">Favor realizar DEPOSITO a la cuenta corriente a nombre del INVERSIONES NEMARTIZ, C.A., # <?php echo $_SESSION['sucursal_cuenta']?> del Banco Banesco en calidad de adelanto, por la cantidad de</span>:                                    </td>
                              <td width="21%" align="center" class="form_label_subtotales"><?php
											//
											
												echo number_format($gtpa,2,',','.');
											
											
											
										
										?>                                    	                                   </td>
                              </tr>
                            </table>
                          </td>
                          
                        </tr>
                            </table>
                          <!--TABLA DE DERALLE DE LA SOLICITUD DE FONDOS-->
                          </td>
                        </tr>
                        
		
                    
                    
                    </table>
                    
                    </td>
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
