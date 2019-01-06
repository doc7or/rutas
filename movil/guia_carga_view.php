<?php 
include("../lib/core.lib.php");
//llamado de las clases
$obj_guia_carga= new class_guia_carga;
 
//PROCESAMIENTO POR FECHAS
if($_REQUEST['desde_dia']) $desde_dia=$_REQUEST['desde_dia']; else $desde_dia=date('d'); 
if($_REQUEST['desde_mes']) $desde_mes=$_REQUEST['desde_mes']; else $desde_mes=date('m'); 
if($_REQUEST['desde_ano']) $desde_ano=$_REQUEST['desde_ano']; else $desde_ano=date('Y'); 
if($_REQUEST['hasta_dia']) $hasta_dia=$_REQUEST['hasta_dia']; else $hasta_dia=date('d'); 
if($_REQUEST['hasta_mes']) $hasta_mes=$_REQUEST['hasta_mes']; else $hasta_mes=date('m'); 
if($_REQUEST['hasta_ano']) $hasta_ano=$_REQUEST['hasta_ano']; else $hasta_ano=date('Y');


$fecha_desde=$desde_dia.'/'.$desde_mes.'/'.$desde_ano;
$fecha_hasta=$hasta_dia.'/'.$hasta_mes.'/'.$hasta_ano;


$fecha=date('d/m/Y');

if($fecha_desde)
{
	if($fecha_hasta)
	{	$r_desde=rango_fecha($fecha_desde,'es','1');
		$r_hasta=rango_fecha($fecha_hasta,'es','2');		
	}
	else
	{	$r_desde=rango_fecha($fecha_desde,'es','1');
		$r_hasta=rango_fecha($fecha_desde,'es','2');		
	}
}
else
{	
	
	$r_desde=rango_fecha($fecha,'es','1');
	$r_hasta=rango_fecha($fecha,'es','2');		
}

$rango= " AND guia_carga.fecha >= '$r_desde' AND guia_carga.fecha <= '$r_hasta' ";

//buscamos la guia de la que se etsa trabajando
	$arr_GC=$obj_guia_carga->getGCInf($_REQUEST['id'],$rango);
//buscamoe el listado de clientes asociados en este  control de salida getListConSalDetCli($id_control_salida)
	$arr_GCD=$obj_guia_carga->getListGCDCli($_REQUEST['id']);
//luego del eenviod e el scaneo
$vecScan='';
for($i=0;$i<$_REQUEST['iscan'];$i++){
	if($_REQUEST['serial_'.$i]){
		//obtenemos un vector de lo scaneado
		$vecScan=split('###',$_REQUEST['serial_'.$i]);
		// se hace lo demas que es el insercion en la bd como tal
		$arrGCDReng=$obj_guia_carga->get_GCDRBas($_REQUEST['idFactSca_'.$i]);
		// lo recorremos para tomar los valores verdadeeros de el scan
		for($j=0;$j<sizeof($arrGCDReng);$j++){
		//empesamos el comparativo 
			for($k=0;$k<sizeof($vecScan);$k++){
			//buscamos linea por linea					
					if(strstr($vecScan[$k],trim($arrGCDReng[$j]['co_art'])) && (strlen(trim($arrGCDReng[$j]['co_art'])+3)<strlen(trim($vecScan[$k])))) {	
						//contamos los detalles de del renglon osea el escaneo para no pasar mas de la cuenta y bloquear
						if($cGCDRS=$obj_guia_carga->getGCDRSelCon($arrGCDReng[$j]['id'],'1')<$arrGCDReng[$j]['total_art']){
						//aqui si vamos unsertando claro esta si no existe este  de exisrtir mandaremos un reporte de error		
						$arrGCDRSel=$obj_guia_carga->getGCDRSelAll('',$vecScan[$k]);
						if(sizeof($arrGCDRSel)==0){	 $addGCDRSel=$obj_guia_carga->add_guia_carga_det_reng_sel($arrGCDReng[$j]['id'], $vecScan[$k],'1');	}
						//si existe seria bueno reportarlo	
						}else{
							//se edita un nuevo campo de sobrecarga
							$udpGCS=$obj_guia_carga->udpGCDScan($arrGCDReng[$j]['id'],$arrGCDReng[$j]['sobrecarga'].$vecScan[$k].'###');
						}
					}
			}	
		}
		
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux_movil.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<title><?php echo SYSTEM_NAME; ?></title>
<script language="javascript" src="../lib/js/jquery/jquery.js"></script>
<script language="javascript" src="../lib/js/jquery/form.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>

</head>
<body class="thrColLiqHdr">
<!--ESTE ES EL BODY-->
	<div id="container">
    <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
        <div id="header">
        <!--ESTE ES EL HEADER-->
        <!--ESTE ES EL HEADER-->
        </div>
        <div id="mainContent">
             <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <br />   
              <form name="form1" id="form1" action="" method="post"  >
                <table align="center" class="tablas_general" >
                  <tr>
                    <td class="tabla_barra_opciones"  ><table class="tabla_opciones" >
                      <tr >
                        <td width="76%" align="left">
                        <table width="80%" class="tablas_filtros" >
                          <tr>
                            <td width="77" valign="center" class="form_label" title="Guias por sucursal" > Opciones</td>
                            <td width="183" valign="center" class="form_label" title="Guias por sucursal" > Filtros
                              <input name="tipo" type="hidden" id="tipo"  class="form_caja_proceso" value="<?php echo $tipo;?>" /></td>
                           
                          </tr>
                          
                        </table></td>
                        
                      </tr>
                      <tr >
                        <td align="left"><table class="tablas_filtros" >
                          <tr align="center">
                            <td width="20%" >&nbsp;</td>
                            <td width="20%"  >&nbsp;</td>
                            <td width="20%"  >&nbsp;</td>
                            <td width="20%"  ><a href="guia_carga_list.php" ><img  src="../images/listado.png"  title="Volver al menu" alt="Volver al menu"  style="border:none" /></a></td>
                            <td width="20%" ><img src="../images/view.png" title="Buscar" alt="Buscar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" /></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td   align="center" height="10"></td>
                  </tr>
                  
                  <tr>
                    <td   align="left" class="tablas_pedidos_bolg">Guias de Carga</td>
                  </tr>
                  
                  <tr>
                    <td   align="left" >
                    
                    
                    
                    
                    
                    </td>
                  </tr>
                  <tr>
                    <td   align="left" >
                    
                    
                    
                        	<!--TABLA DE FILTROS -->
                     <table class="tablas_procesos_datos">
                        <tr>
                            <td class="form_label_proceso" colspan="4">DATOS DE LA GUIA DE CARGA&nbsp;&nbsp;:&nbsp;&nbsp;<span class="form_label_procesos_imp"><?php echo $arr_GC[0]['id_por_sucursal']; ?></span></td>
                        </tr>
                        <tr>
                            
                            <td width="10%" class="form_label_proceso">status: </td>
                            <td width="19%" class="form_label_procesos_imp" >&nbsp;</td>
                            <td width="8%" class="form_label_proceso">Fecha: </td>
                            <td width="13%" class="form_label_procesos_imp" ><?php echo $arr_GC[0]['fecha']; ?></td>
                        </tr>
                        <tr>
                          <td class="form_label_proceso" >Placa/Chofer: </td>
                          <td class="form_label_procesos_imp"  colspan="3"><?php echo $arr_GC[0]['placa'].' - '.$arr_GC[0]['t_nombre'].' - '.$arr_GC[0]['t_apellido']; ?></td>
                          
                      </tr>
                      <tr>    
                          <td class="form_label_proceso">Transporte: </td>
                          <td class="form_label_procesos_imp" colspan="3" ><?php echo htmlentities($arr_GC[0]['e_descripcion']); ?></td>
                         
                        </tr>
                        <tr>
                          <td class="form_label_proceso" colspan="4" ></td>
                         
                        </tr>
                        <tr>
                          <td  colspan="4"  class="error_mesaje_acme"   id="mensaje_error">Clientes y Facturas</td>
                         
                        </tr>
                        <tr>
                          <td colspan="4" >
                    		<!--TABLA DE LOS NOMBRES DE LOS CLIENTES--> 
                            
                                <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
       <?php
	   		//inicializamos el indice de esscaneo
			$iSSe =0;
	   		for($iCli=0;$iCli<sizeof($arr_GCD);$iCli++){?>   
                                    <tr  >
                                      <td width="67%" align="left"  class="tabla_report_tit_left0" colspan="2" >
									  		<?php echo 'Cliente : '.$arr_GCD[$iCli]['co_cli'].'   '.$arr_GCD[$iCli]['cliente']; ?></td>
                                       	
                                    </tr>
                                    <!--declaro la tabla de abajo de las facturas-->
                                    <tr  > 
                                     <td width="33%" align="left"  colspan="2"> 
                                     	 <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
                                    
                                    
            <?php 
                //buscamos los datos de estas facturas getCSDCli($id_control_salida='',$cliente='')
                $arrGCDCli=$obj_guia_carga->getGCDInf($_REQUEST['id'],$arr_GCD[$iCli]['co_cli']);
				for($iFact=0;$iFact<sizeof($arrGCDCli);$iFact++){
					
            ?>
                                         
                                           <tr >
                                              <td width="67%" align="left"  class="tabla_report_tit_left" colspan="2" >
                                                <?php echo 'Control de Carga Numero : '.$arrGCDCli[$iFact]['fact_num'].'   Monto :'.$arrGCDCli[$iFact]['tot_neto']; ?></td>
                                              	
                                            </tr>
                                            <!--declaro la tabla de abajo de los renglones-->
                                         	 <!--declaro la tabla de abajo de las facturas-->
                                            <tr  > 
                                             <td  align="left"  colspan="2"> 
                                                 <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
                                                      <tr  >
                                                        
                                                        <td class="tabla_pedidos_titulos" >Articulo</td>
                                                       	<td  class="tabla_pedidos_titulos" >Cant</td>
                                                       
                                                      </tr>
            <?php 
                //buscamos los datos de los renglones de esta nota de entrea
                $arrGCDReng=$obj_guia_carga->get_GCDRInf($arrGCDCli[$iFact]['id']);
				for($iReng=0;$iReng<sizeof($arrGCDReng);$iReng++){
					//llamado de las clases para filas impares y pares  tabla_renglones_ina_num
						  if ($iReng % 2){
							$clase_text = "tablas_renglones_imp_text";
							$clase_num = "tablas_renglones_imp_num";
							} else{
							$clase_text = "tablas_renglones_par_text";
							$clase_num = "tablas_renglones_par_num";
						  }
            ?>                                  
                                                         <tr >
                                                            
                                                            <td class="<?php echo $clase_text; ?>" >
																	<?php echo $arrGCDReng[$iReng]['co_art'].'  '.$arrGCDReng[$iReng]['art_des']; ?></td>
                                                            <td class="<?php echo $clase_num; ?>" >
																<?php echo number_format($arrGCDReng[$iReng]['total_art'],0);
																		//buscamos el contep de los mismos
																		 $cont=$obj_guia_carga->getGCDRSelCon($arrGCDReng[$iReng]['id']);
																		 echo ' ('.$cont.') ';
																 ?>
                                                            </td>
                                                            
                                                            
                                                        </tr>
                     								                            
             <?php  }//fin listado de renglones ?>                                    
                                                 </table>
                                             </td>
                                            </tr>
                  							<tr><td colspan="4"  align="left"  class="tablas_pedidos_bolg">Seccion de Escaneo</td></tr>
                                            <tr><td  colspan="4" align="left"  ><textarea id="serial_<?php echo $iSSe; ?>" name="serial_<?php echo $iSSe; ?>" class="tabla_ruta_tarea"></textarea>
                                              <span class="form_label">
                                              <input name="idFactSca_<?php echo $iSSe; ?>" type="hidden" id="idFactSca_<?php echo $iSSe; ?>"  class="form_caja_proceso" value="<?php echo $arrGCDCli[$iFact]['id'];?>" />
                                              </span></td></tr>
                  							<tr><td  colspan="4" align="left"  ><input type="submit" name="op" id="op" value="Guardar" class="form_boton_grande" /></td></tr>
                  
                                            <tr  >
                                              <td align="left" colspan="4" >&nbsp;</td>
                                            </tr>
                                    
       <?php  
	   			//incrementamos el indice de escaneo
					$iSSe++;
	   
	   			}//fin listado de facturas ?>
       									 </table>
                                         
       								 </td>    	
                                    </tr> 
                                    <!--fin de la declaracion de la tabla de facturas-->
	   <?php }//fin listado de clientes ?>
                                </table>
                            <!--TABLA DE LOS NOMBRES DE LOS CLIENTES--> 
                         <input name="iscan" type="hidden" id="iscan"  class="form_caja_proceso" value="<?php echo $iSSe;?>" /> 
                          </td>
                        </tr>
                        <tr>
                          <td colspan="4" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" align="right" >&nbsp;</td>
                        </tr>
                     </table>
                    <!--TABLA DE FILTROS -->
                    
                    
                    
                    </td>
                  </tr>
                </table>
        </form>
            <br />
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
        </div>
        <div id="footer">
        <!--ESTE ES EL FOOTER-->
        <!--ESTE ES EL FOOTER-->
        </div>
     <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
    </div>
<!--ESTE ES EL BODY-->
</body>
</html>
