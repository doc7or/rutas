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
	$arr_GC=$obj_guia_carga->getGCInf('',$rango);


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
                            <td width="20%"  ><a href="menu_visual.php" ><img  src="../images/listado.png"  title="Volver al menu" alt="Volver al menu"  style="border:none" /></a></td>
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
                    <td   align="left" >&nbsp;</td>
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
                            <td class="form_label_proceso" colspan="8">DATOS DE LA GUIA DE CARGA</td>
                        </tr>
                        <tr>
                            <td width="13%" class="form_label_proceso" >Numero: </td>
                            <td width="13%" class="form_label_procesos_imp" ><?php echo $arr_GC[0]['id']; ?></td>
                            <td width="10%" class="form_label_proceso">Por Sucursal: </td>
                            <td width="14%" class="form_label_procesos_imp" ><?php echo $arr_GC[0]['id_por_sucursal']; ?></td>
                            <td width="10%" class="form_label_proceso">status: </td>
                            <td width="19%" class="form_label_procesos_imp" >&nbsp;</td>
                            <td width="8%" class="form_label_proceso">Fecha: </td>
                            <td width="13%" class="form_label_procesos_imp" ><?php echo $arr_GC[0]['fecha']; ?></td>
                        </tr>
                        <tr>
                          <td class="form_label_proceso" >Placa/Chofer: </td>
                          <td class="form_label_procesos_imp"  colspan="2"><?php echo $arr_GC[0]['placa'].' - '.$arr_GC[0]['t_nombre'].' - '.$arr_GC[0]['t_apellido']; ?></td>
                          
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                          <td class="form_label_proceso">Transporte: </td>
                          <td class="form_label_procesos_imp" colspan="3" ><?php echo htmlentities($arr_GC[0]['e_descripcion']); ?></td>
                         
                        </tr>
                        <tr>
                          <td class="form_label_proceso" colspan="8" ></td>
                         
                        </tr>
                        <tr>
                          <td  colspan="8"  class="error_mesaje_acme"   id="mensaje_error">Clientes y Facturas</td>
                         
                        </tr>
                        <tr>
                          <td colspan="8" >
                    		<!--TABLA DE LOS NOMBRES DE LOS CLIENTES--> 
                            
                                <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
       <?php for($iCli=0;$iCli<sizeof($arr_GCD);$iCli++){?>   
                                    <tr  >
                                      <td width="67%" align="left"  class="tabla_report_tit_left" >
									  		<?php echo 'Cliente : '.$arr_GCD[$iCli]['co_cli'].'   '.$arr_GCD[$iCli]['cliente']; ?></td>
                                      <td width="33%" align="left"  class="tabla_report_tit_left">&nbsp;</td>  	
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
                                              <td width="67%" align="left"  class="tabla_report_tit_left" >
                                                <?php echo 'Control de Carga Numero : '.$arrGCDCli[$iFact]['fact_num'].'   Monto :'.$arrGCDCli[$iFact]['tot_neto']; ?></td>
                                              <td width="33%" align="left"  class="tabla_report_tit_left">&nbsp;</td>  	
                                            </tr>
                                            <!--declaro la tabla de abajo de los renglones-->
                                         	 <!--declaro la tabla de abajo de las facturas-->
                                            <tr  > 
                                             <td width="33%" align="left"  colspan="2"> 
                                                 <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
                                                      <tr  >
                                                        <td  class="tabla_pedidos_titulos" >Reng</td>
                                                        <td class="tabla_pedidos_titulos" >Articulo</td>
                                                       	<td  class="tabla_pedidos_titulos" >Cant</td>
                                                        <td class="tabla_pedidos_titulos" >Precio</td>
                                                        <td class="tabla_pedidos_titulos" >Neto</td>
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
                                                            <td class="<?php echo $clase_num; ?>" ><?php echo $arrGCDReng[$iReng]['reng_num']; ?></td>
                                                            <td class="<?php echo $clase_text; ?>" >
																	<?php echo $arrCSDReng[$iReng]['co_art'].'  '.$arrGCDReng[$iReng]['art_des']; ?></td>
                                                            <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['total_art'],0); ?></td>
                                                             <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['prec_vta'],2); ?></td>
                                                             <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['reng_neto'],2); ?></td>
                                                            
                                                        </tr>
                     								                            
             <?php  }//fin listado de renglones ?>                                    
                                                 </table>
                                             </td>
                                            </tr>
                                            <tr  >
                                              <td align="left"  colspan="2">&nbsp;</td>
                                            </tr>
                                    
       <?php  }//fin listado de facturas ?>
       									 </table>
       								 </td>    	
                                    </tr> 
                                    <!--fin de la declaracion de la tabla de facturas-->
	   <?php }//fin listado de clientes ?>
                                </table>
                            <!--TABLA DE LOS NOMBRES DE LOS CLIENTES--> 
                          
                          </td>
                        </tr>
                        <tr>
                          <td colspan="8" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="8" align="right" >
                          <table class="tablas_filtros" >
                              <tr align="center">
                                <td width="8%" >&nbsp;</td>
                                 <td width="57%" >
                                 		<!--<img  src="../images/tick.png" title="Volver al menu" alt="Volver al menu"  style="border:none"
                               onclick="completo('importe_','generalidad_','##','<?php echo sizeof($arr_factura_reng); ?>')" /><br />
                                  <font class="form_barra_text">Completo</font>-->
                                </td>
                                <td width="35%"  >	
                                		
                                     <!-- <input type="submit" style="background-image:url(../images/disk.png); height:16px; width:16px; border:0" value="" />
                                     -->  
                                		<img src="../images/arrow_rotate_anticlockwise.png" title="Publicar Guia/Control" alt="Publicar Guia/Control"  style="border:none" 
                                        onclick="simulHref('forma_guia_transporte_list.php?tipo=1&mod=1&pubicar=1&id=<?php echo $_REQUEST['id']; ?>')" />
                                        <br />
                                  		<font  class="form_barra_text"  >Publicar Guia / Control</font>
                                </td>
                               
                              </tr>
                          </table>
                          </td>
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
