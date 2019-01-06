<?php 
include("../lib/core.lib.php");
//llamado de las clases
$obj_guia_carga= new class_guia_carga;
 

//buscamos la guia de la que se etsa trabajando
	$arr_GC=$obj_guia_carga->getGCInf($_REQUEST['id']);
//buscamoe el listado de clientes asociados en este  control de salida getListConSalDetCli($id_control_salida)
	$arr_GCD=$obj_guia_carga->getListGCDCli($_REQUEST['id']);
//luego del eenviod e el scaneo



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>

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
                <table align="center" width="90%" >
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
                    <td  colspan="2" align="left"><table align="center" class="tablas_listados" >
                      <tr>
                        <td class="tabla_barra_opciones"  >
                        <table class="tabla_opciones" >
                          <tr >
                            <td width="76%" align="left"><table width="80%" class="tablas_filtros" >
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
                        <td   align="left" class="form_titulo_procesos">Guias de Carga</td>
                      </tr>
                      <tr>
                        <td   align="left" ></td>
                      </tr>
                      <tr>
                        <td   align="left" ><!--TABLA DE FILTROS -->
                          <table class="tablas_procesos_datos">
                            <tr>
                              <td class="form_label_proceso" colspan="4">DATOS DE LA GUIA DE CARGA&nbsp;&nbsp;:&nbsp;&nbsp;<span class="form_label_procesos_imp">
							  <?php echo $arr_GC[0]['id_por_sucursal']; ?></span></td>
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
                              <td colspan="4" ><!--TABLA DE LOS NOMBRES DE LOS CLIENTES-->
                                <table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
                                  <?php
	   		//inicializamos el indice de esscaneo
			$iSSe =0;
	   		for($iCli=0;$iCli<sizeof($arr_GCD);$iCli++){?>
                                  <tr  >
                                    <td width="67%" align="left"  class="form_label_subtotales" colspan="2" ><?php echo 'Cliente : '.$arr_GCD[$iCli]['co_cli'].'   '.$arr_GCD[$iCli]['cliente']; ?></td>
                                  </tr>
                                  <!--declaro la tabla de abajo de las facturas-->
                                  <tr  >
                                    <td width="33%" align="left"  colspan="2"><table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
                                      <?php 
                //buscamos los datos de estas facturas getCSDCli($id_control_salida='',$cliente='')
                $arrGCDCli=$obj_guia_carga->getGCDInf($_REQUEST['id'],$arr_GCD[$iCli]['co_cli']);
				for($iFact=0;$iFact<sizeof($arrGCDCli);$iFact++){
					
            ?>
                                      <tr >
                                        <td width="67%" align="left"  class="tabla_report_tit_left"  onclick="popup_basic('<?php echo 'guia_carga_popup.php?id='.$arrGCDCli[$iFact]['id']; ?>');" style="cursor:pointer" >Control de Carga Numero : <?php echo $arrGCDCli[$iFact]['fact_num']; ?> <?php echo '   Monto :'.$arrGCDCli[$iFact]['tot_neto']; ?></td>
                                      </tr>
                                      <!--declaro la tabla de abajo de los renglones-->
                                      <!--declaro la tabla de abajo de las facturas-->
                                      <tr  >
                                        <td  align="left"><table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
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
                                            <td class="<?php echo $clase_text; ?>" ><?php echo $arrGCDReng[$iReng]['co_art'].'  '.$arrGCDReng[$iReng]['art_des']; ?></td>
                                            <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['total_art'],0);
																		//buscamos el contep de los mismos
																		 $cont=$obj_guia_carga->getGCDRSelCon($arrGCDReng[$iReng]['id']);
																		 echo ' ('.$cont.') ';
																 ?></td>
                                          </tr>
                                          <?php  }//fin listado de renglones ?>
                                        </table></td>
                                      </tr>
                                      <tr  >
                                        <td align="left" colspan="3" >&nbsp;</td>
                                      </tr>
                                      <?php  
	   			//incrementamos el indice de escaneo
					$iSSe++;
	   
	   			}//fin listado de facturas ?>
                                    </table></td>
                                  </tr>
                                  <!--fin de la declaracion de la tabla de facturas-->
                                  <?php }//fin listado de clientes ?>
                                </table>
                                <!--TABLA DE LOS NOMBRES DE LOS CLIENTES-->
                                <input name="iscan" type="hidden" id="iscan"  class="form_caja_proceso" value="<?php echo $iSSe;?>" /></td>
                            </tr>
                            <tr>
                              <td colspan="4" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="4" align="right" >&nbsp;</td>
                            </tr>
                          </table>
                          <!--TABLA DE FILTROS --></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><div align="center"></div></td>
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
<?php if($estado){?>
	<script language="javascript">
    	load_pool('id_carga','asin_pool_zona_listado.php','estado','<?php echo $ciudad; ?>');
    </script>
<?php } ?>
