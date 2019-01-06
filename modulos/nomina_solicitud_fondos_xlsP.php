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



$id=$_REQUEST['id'];
$id_sucursal=$_SESSION['id_sucursal'];

$arr_nomina=$obj_nomina->get_nomina($id);
$arr_nomina_detalle=$obj_nomina_detalle->get_nomina_detalle($id);
///RESPUESTA DEL QUERY QUE DA COMO RESULTADO LAS GUIAS Q TIENE LA NOMINA Q SE CONSULTA EN EL $arr_nomina_detalle ESTO SE HACE MAS ABAJO


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

$titulo='Nomina de Transportistas';
$forma='nomina.php';
if($_REQUEST['formato']==1){
	header("Content-Type: application/vnd.ms-excel");
	header("Content-disposition: attachment;filename=solicitud_fondos.xls ");
}else{
	header("Content-Type: application/vnd.ms-word");
	header("Content-disposition: attachment;filename=solicitud_fondos.doc");
}
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");

?>
<style type="text/css">
<!--
.style11 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.style14 {font-family: Arial, Helvetica, sans-serif}
.style15 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.style16 {font-size: 12px}
.style17 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style19 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>


<table class="tablas_listados_nomina" >
  <!--ENCABEZADOS-->
  <tr class="tabla_barra_opciones" >
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td ><!--ENCABEZADO DE LA SOLICITUD DE DINERO DE CADA SUCURSAL-->
      <table align="center" width="98%">
          <tr>
            <td width="22%" align="center" rowspan="4"><img src="http://10.10.1.11:8080/transporte/images/img_nemartiz.png" width="134" height="87" /></td>
            <td width="78%" class="form_titulo style14 style16">Solicitud de Adelanto de Fondos para pago de Servicios de Transporte efectuados a :</td>
        </tr>
          <tr>
            <td class="form_titulo style14 style16"> PRO-HOME, C.A </td>
        </tr>
       <tr>
                              	<td class="form_titulo_nomina">
                                	<?php echo 'Nomina '.$arr_nomina[0]['id_por_sucursal'].' Fecha '.muestraFechaSola($arr_nomina[0]['fecha'],'es')?>                             
                                </td>
                              </tr><tr>
            <td class="form_titulo style14 style16">&nbsp;</td>
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
    <td ><!--TABLA DE DERALLE DE LA SOLICITUD DE FONDOS-->
        <table align="center" width="100%">
          <tr class="tablas_listados_encabezados_sub_0" >
            <td width="28%"><span class="style11">Afiliado Madis</span></td>
            <td width="9%"><span class="style11">Monto Neto</span></td>
            <td width="9%"><span class="style11">Tasa IVA %</span></td>
            <td width="9%"><span class="style11">Monto IVA</span></td>
            <td width="9%"><span class="style11">% Retenci&oacute;n ISLR</span></td>
            <td width="9%"><span class="style11">Monto Retenci&oacute;n ISLR</span></td>
            <td width="9%"><span class="style11">Pago con Caja</span></td>
            <td width="9%"><span class="style11">Total a Pagar al Afiliado</span></td>
            <td width="9%"><span class="style11">Total a Facturar por afiliado</span></td>
            <td width="9%"><span class="style11">Firma</span></td>
          </tr>
          <?php 
		 //variables para los totales generales
		$tgmonto=0;//total del monto
		$tgreparto_monto=0;//total del monto
		$tgrepartol_monto=0;//total del monto
		$tgdesvio=0;//total de desvio
		$tgdesvioc=0;//total de desvio corto
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
			
					if ($ie % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
												
										$guiaEmpresa[$ie]=delCharEnd($guiaEmpresa[$ie],1);	
										$arr_contol_salida_empresa=$obj_control_salida->get_all_data_gcs($guiaEmpresa[$ie]);
										
										$temonto=0;//total del monto
										$tereparto_monto=0;//total del monto
										$terepartol_monto=0;//total del monto
										$tedesvio=0;//total de desvio
										$tedesvioc=0;//total de desvio corto
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
											$tereparto_monto+=$arr_contol_salida_empresa[$ige]['reparto_monto'];
											$terepartol_monto+=$arr_contol_salida_empresa[$ige]['repartol_monto'];
											$tedesvio+=$arr_contol_salida_empresa[$ige]['desvio_monto'];
											$tedesvioc+=$arr_contol_salida_empresa[$ige]['desvioc_monto'];
											
											
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
										 //la manera nueva sera esta 
										 if($contador_0>$contador_20+$contador_40) $empresa_especial=0;
											if($contador_20>$contador_0+$contador_40) $empresa_especial=20;
											if($contador_40>$contador_0+$contador_20) $empresa_especial=40;
													
										 
										 
										 $smn=$temonto+$tereparto_monto+$terepartol_monto+$tedesvio+$tedesvioc+$tecaleta+$teepsp-$teepsm;
										 $especial=($smn*$empresa_especial)/100;
										 $mn=$especial+$smn;
										 
									?>
          <!--	LAS EMPRESAS	-->
          <tr class="<?php echo $clase;?>">
            <td ><span class="style15">
            <?php 
								  		
										
										echo htmlentities($arr_empresa[0]['descripcion']);
								   ?>
            </span> </td>
            <td ><div align="right" class="style15">
              <?php
											//
											$fecha=guardafecha($arr_nomina[0]['fecha'],'es');
												$arr_iva=$obj_iva->get_iva('',$arr_empresa[0]['naturaleza'],$fecha);
												if($arr_empresa[0]['id']!=8){
													$smn=$temonto+$tereparto_monto+$terepartol_monto+$tedesvio+$tedesvioc+$tecaleta+$teepsp-$teepsm;
													$iva=$arr_iva[0]['valor'];
													$iva=$iva + 100;
													$iva=$iva / 100;
													$smn=$smn/$iva;
													//echo $iva=$arr_iva[0]['valor'];
												}else{
													$smn=$temonto+$tereparto_monto+$terepartol_monto+$tedesvio+$tedesvioc+$tecaleta+$teepsp-$teepsm;
												
													//echo $iva=0;
												}
											//$smn=$temonto+$tedesvio+$tecaleta+$teepsp-$teepsm;
											echo number_format($smn,2,',','.');
											$gmn= $gmn+$smn;
										?>
            </div></td>
            <td ><div align="right" class="style15">
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
											
 													
                                                ?>
            </div></td>
            <td ><div align="right" class="style15">
                <?php
										
											$miva=($smn*$iva)/100;
											echo number_format($miva,2,',','.');
											$gmiva+=$miva;
										
										?>
            </div></td>
            <td ><div align="right" class="style15">
                <?php
												if($arr_empresa[0]['naturaleza']==2 && $id<415){
													if(inList($arr_nomina[0]['id_sucursal'],'1,2'))
														echo $retencion=3;
													else
														echo $retencion=0;
												}else{
													echo $retencion=0;
												}
 													
                                                ?>
            </div></td>
            <td ><div align="right" class="style15">
                <?php
										
											$mretencion=($smn*$retencion)/100;
											echo number_format($mretencion,2,',','.');
											$gmretencion+=$mretencion;
										
										?>
            </div></td>
            <td ><div align="right" class="style15">
                <?php 
									  echo number_format($tecaja,2,',','.'); 
									  $gtecaja+=$tecaja;
									  
									  ?>
            </div></td>
            <td ><div align="right" class="style15">
                <?php
											
											$tpa=($smn+$miva)-($mretencion+$tecaja);
											if($tpa>=0) $tpa=$tpa;
											else $tpa=0;
											echo number_format($tpa,2,',','.');
											$gtpa+=$tpa;
										?>
            </div></td>
            <td ><div align="right" class="style15">
                <?php
										echo number_format($tpa,2,',','.');	
											$tpc=($mn+$miva);
									//		echo number_format($tpc,2,',','.');
										$gtpc+=$tpc;
										
										?>
            </div></td>
            <td >&nbsp;</td>
          </tr>
          <!--	LAS EMPRESAS	-->
          <?php   }//fin del ciclo para las empresas involucradas ie  ?>
          <tr >
            <td class="form_botones" ><div align="right" class="style11">Totales: </div></td>
            <td class="form_botones" ><div align="right" class="style11">
                <?php 
									echo number_format($gmn,2,',','.'); 
									?>
            </div></td>
            <td class="form_botones" ><div align="center" class="style11">-</div></td>
            <td class="form_botones" ><div align="right" class="style11">
                <?php
										
											echo number_format($gmiva,2,',','.');
										
										?>
            </div></td>
            <td class="form_botones" ><div align="center" class="style11">-</div></td>
            <td class="form_botones" ><div align="right" class="style11">
                <?php
											echo number_format($gmretencion,2,',','.');
										
										?>
            </div></td>
            <td class="form_botones" ><div align="right" class="style11">
                <?php 
									  echo number_format($gtecaja,2,',','.');
									  
									  ?>
            </div></td>
            <td class="form_botones" ><div align="right" class="style11">
                <?php
											echo number_format($gtpa,2,',','.');
										?>
            </div></td>
            <td class="form_botones" ><div align="right" class="style11">
                <?php
										
											echo number_format($gtpc,2,',','.');
										
										?>
            </div></td>
            <td ><span class="style14"></span></td>
          </tr>
           <tr >
                          <td class="form_botones" ><div align="right">Gastos Administrativos:  </div></td>
                          <td class="form_botones" ><div align="right">
                            -
                          </div></td>
                          <td class="form_botones" ><div align="center">-</div></td>
                          <td class="form_botones" ><div align="right">
                            -
                          </div></td>
                          <td class="form_botones" ><div align="center">-</div></td>
                          <td class="form_botones" ><div align="right">
                            -
                          </div></td>
                          <td class="form_botones" ><div align="right">
                            -
                          </div></td>
                          <td class="form_botones" ><div align="right">
                            <?php
                            echo number_format($gtpa*0.0472,2,',','.');
                            ?>
                          </div></td>
                          <td class="form_botones" ><div align="right">
                              <?php
                              $nueva=$gtpa+($gtpa*0.0472);
                             // $gtpc=$gtpa;
                            echo number_format($nueva,2,',','.');
							$gtpc=$nueva;
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
            <td >&nbsp;</td>
          </tr>
          <tr >
            <td colspan="10" align="center" ><table width="80%">
                <tr class="tablas_listados_encabezados_totales"   >
                  <td colspan="4"><div class="style11" >Factura por emitir a Cyberlux </div></td>
                </tr>
                <tr class="tablas_listados_encabezados_totales"   >
                  <td width="43%"><div align="center" class="style11">Descripcion</div></td>
                  <td width="9%"><div align="center" class="style11">%</div></td>
                  <td width="16%"><div align="center" class="style11">Monto</div></td>
                  <td width="32%"><div align="center" class="style11">Calculo</div></td>
                </tr>
                <tr  >
                  <td width="43%" class="tablas_listados_datos_imp"><div align="center" class="style15">Monto Base</div></td>
                  <td width="9%" class="tablas_listados_datos_imp"><div align="center" class="style15">- </div></td>
                  <td width="16%" class="tablas_listados_datos_imp"><div align="right" class="style15">
                      <?php
											//
											echo number_format($gtpc,2,',','.');
										
										?>
                  </div></td>
                  <td width="32%" class="tablas_listados_datos_imp"><div align="center" class="style15">Sumatoria Total a Facturar por afiliado</div></td>
                </tr>
                <tr  >
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">Monto  Factor</div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">- </div></td>
                  <td class="tablas_listados_datos_imp"><div align="right" class="style15">
                      <?php
										$fecha_nomina=guardaFechaSola($arr_nomina[0]['fecha']);
												//if($fecha_nomina>=20090515) $varfactor=1;
												//else $varfactor=0.9925; comentado ya q la fecha paso y solo se tomara la del valor 1   
												$varfactor=1;
												
											$fgtpc=$gtpc/$varfactor;
											echo $for_fgtpc=number_format ($fgtpc, 2, ',', '.');
										
										
										?>
                  </div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">Monto Base / <?php echo $varfactor; ?></div></td>
                </tr>
                
				<!--ESTA SECCION ES LA DEL CALCULO DEL IVA-->
				<tr  >
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">Iva</div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">
				  <?php 
				  	
                                                //if($fecha_nomina>=20090401) $varIvaCam=12;
												//else $varIvaCam=9;comentado las dos lineas por mervin y puesto el iva en 12%
											$varIvaCam=12;
					echo $varIvaCam;
				  ?>
				  
				  
				  </div></td>
                  <td class="tablas_listados_datos_imp"><div align="right" class="style15">
                      <?php
											//
											$iva_fgtpc=$fgtpc*$varIvaCam/100;
											echo $for_iva_fgtpc=number_format ($iva_fgtpc, 2, ',', '.');
										
										?>
                  </div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15"> Monto Factor*<?php echo $varIvaCam; ?>%</div></td>
                </tr>
                
				<!--ESTA SECCION ES LA DEL CALCULO DEL IVA-->
				
				<tr  >
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">Retencion</div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">3</div></td>
                  <td class="tablas_listados_datos_imp"><div align="right" class="style15">
                      <?php
											//
											$ret_fgtpc=$fgtpc*0.03;
											echo $for_ret_fgtpc=number_format ($ret_fgtpc, 2, ',', '.');
										
										?>
                  </div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15"> Monto Factor*3%</div></td>
                </tr>
				<tr  >
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">Retencion</div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">1,5</div></td>
                  <td class="tablas_listados_datos_imp"><div align="right" class="style15">
                      <?php
											//
											$ret=1.5;
											$ret_fgtpc=$fgtpc*$ret/100;
											echo $for_ret_fgtpc=number_format ($ret_fgtpc, 2, ',', '.');
										
										?>
                  </div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15"> Monto Factor*1,5%</div></td>
                </tr>
                <tr  >
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">Monto a Facturar</div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15">-</div></td>
                  <td class="tablas_listados_datos_imp"><div align="right" class="style15">
                      <?php
											//
											$monfac_fgtpc=$fgtpc+$iva_fgtpc;
											echo $for_monfac_fgtpc=number_format ($monfac_fgtpc, 2, ',', '.');
											
										?>
                  </div></td>
                  <td class="tablas_listados_datos_imp"><div align="center" class="style15"> Monto Factor+Iva</div></td>
                </tr>
            </table></td>
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
                          <td >&nbsp;</td>
                        </tr>
                        <tr >
                          <td colspan="10" >
                          	<table width="100%">
                            	<tr>
                                	<td width="79%">
                                    	<span class="form_titulo_procesos style14 style16"><strong>Favor realizar TRANSFERENCIA a la cuenta corriente a nombre de TRANSPORTE MADI'S, C.A., # <span class="form_titulo_procesos"><?php echo $_SESSION['sucursal_cuenta']?></span> del 100% Banco en calidad de adelanto, por la cantidad de</strong></span><span class="style17">:                                    </span></td>
                              <td width="21%" align="center"><span class="style19">
                              <?php
										
												echo number_format($gtpa,2,',','.');
											
										?>
                              </span> </td>
                              </tr>
                            </table>
                          </td>
                          
                        </tr>
        </table>
      <!--TABLA DE DERALLE DE LA SOLICITUD DE FONDOS-->
    </td>
  </tr>
</table>

