<?php 
include("../lib/core.lib.php");
//echo $_SESSION['id_tipo_usuario'];
if(!inList($_SESSION['id_tipo_usuario'],'1,2')) header('Location: ../lib/common/logout.php');

//LAMADO DE LAS CLASES NECESARIAS PARA ESTE PROCESO
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
$obj_factura_temp_uso= new class_factura_temp_uso;
$obj_conexiones= new class_conexiones;
$obj_cyberlux_factura= new class_cyberlux_factura;
$obj_log = new class_log;
$obj_con_sal_det_reng = new class_con_sal_det_reng;
//LAMADO DE LAS CLASES NECESARIAS PARA ESTE PROCESO

//SE BORRA EL TEMPORAR DE FACTURAS EN USO
$del_factura_temp_uso=$obj_factura_temp_uso->delete_factura_temp_uso($_SESSION['id_usuario']);	//elimina el temporal de facturas usadas por el usuario

//INSERCION DE LA GUIA PARA LA SUCURSAL
if($_REQUEST['accion']){
	//BUSCAMOS EN NUEVO VALOR DEL ID POR  SUCURSAÑL Y LO Q ES EL CAMPO ID PO SUCURSASL NEW QUE ES EL CAMPO USADO PARA LOS NUEVOS DORMATOS
	$id_por_sucursal=$obj_control_salida->get_control_salida_id_sucursal($_SESSION['id_sucursal']);
	$id_por_sucursal_new=$obj_control_salida->get_control_salida_id_sucursal_new($_SESSION['id_sucursal']);
	
	//OBTENEMOS LOS VALORES QUE IREMOS A PASAR A LA GUIA QUE SE CREE
	$id_sucursal=$_SESSION['id_sucursal'];
	$id_transportista=$_REQUEST['transportista'];
	$placa=$_REQUEST['vehiculo_placa'];	
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_salida=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$status=1;
	$id_escolta=$_REQUEST['escolta'];		
	$ruta=$_REQUEST['ruta'];			
	$desvio=$_REQUEST['desvio'];			
	$monto_facturas=$_REQUEST['monto_facturas'];	
	$monto=$_REQUEST['valor_viaje'];	
	$escolta_monto=$_REQUEST['valor_escolta'];	
	$caleta=$_REQUEST['valor_caleta'];
	$desvio_monto=$_REQUEST['valor_desvio'];	
	$caleta_especial=$_REQUEST['valor_caleta_especial'];
	$adelanto=$_REQUEST['valor_adelanto'];		
	$devolucion_monto=$_REQUEST['valor_devolucion'];		
	$caja_adelanto=$_REQUEST['caja_adelanto'];		
	$caja_caleta=$_REQUEST['caja_caleta'];		
	$observaciones=$_REQUEST['observaciones'];	
	$id_empresa=$_REQUEST['empresa_transportista'];
	
	//BUSCO DATOS RELACIONADOS A LA EMPRESA
	$arr_empresa=$obj_empresa->get_empresa($id_empresa);
	
	$status_web=1;//indica que el estatus de la guia es oara subierse a la web osea q se creo una guia q se puede subir a la web
	$tipo=1;//indica que la quia es tipo guia de transporte
	
	//PROCESO DE INSERCION DE LA NUEBA GUIA DE TRANSPORTE
	$new_control_salida=$obj_control_salida->add_control_salida($id_por_sucursal,$id_sucursal,$id_transportista,$placa,$fecha,$fecha_salida,$status,$caleta,$caleta_especial,$monto,$ruta,$desvio,$desvio_monto,$devolucion_monto,$adelanto,$observaciones,$id_escolta,$escolta_monto,$monto_facturas,$caja_caleta,$caja_adelanto,$tipo,$id_empresa,$arr_empresa[0]['especial'],$id_por_sucursal_new,$status_web);	
		
	//DETERMINAMOS LAS ITERACIONES QUE SE DEBEN HACER POR LAS CANTIDADES DE FACTURAS SELECCIONADAS
	$cf=$_REQUEST['cf'];
	//SE REALIZA EL RECORRIDO DE LAS FACTIRAS
	for($i=0;$i<=$cf;$i++){
		if($_REQUEST['fac_sta_'.$i]==1){//SI LA FACTURA ES ACTIVA
					
			//nos conectamos al servidor de cyberlux para buscar los datos necesarios que nos competan		
			$conexion_cyberlux=$obj_conexiones->ms_conect();
			//bucamos los datos de esta factura para insertarlos en la base de datos de tranporte
			$id_control_salida=$new_control_salida;//id del control SE PUEDE DECLARAR ANTES DE LA CONEXION A CBERLUX
			$id_factura= $_SESSION['valor_num_prefijo'].$_REQUEST['fac_num_'.$i];
			//mandamos a buscar como tal y llenos este vector
			$arr_cyberlux_factura=$obj_cyberlux_factura->get_cyberlux_factura_comp($id_factura);
			//mandamos a buscar los renglones de esta factura
			$arr_cyberlux_factura_reng=$obj_cyberlux_factura->get_cyberlux_factura_reng($id_factura);
			
			//cerrramos la conexion a cyberlux
			mssql_close($conexion_cyberlux);//cerra,os esta coneccion
			
			//nos conectamos nuevamente a trampote			
			$conexion_transporte=$obj_conexiones->ms_conect_transporte();

			//add_control_salida_detalle($id_control_salida='' , $id_factura='' , $monto_factura='' , $cliente='' , $liq_amarilla='' , $liq_azul='' , $liq_blanca='' , $fecha_liquidacion_factura='' , $tipo='' , $co_ven='' , $ven_des='' , $co_cli='' , $status_web='')
			$new_control_salida_detalle=$obj_control_salida_detalle->add_control_salida_detalle($id_control_salida,$arr_cyberlux_factura[0]['fact_num'],$arr_cyberlux_factura[0]['tot_bruto'],rehtmlspecialchars($arr_cyberlux_factura[0]['cli_des']),'','','','',1,$arr_cyberlux_factura[0]['co_ven'],$arr_cyberlux_factura[0]['ven_des'],$arr_cyberlux_factura[0]['co_cli'],1);
			
			//aqui vemos a pasar los datos de este esta factura sus renglones
			for($j=0;$j<sizeof($arr_cyberlux_factura_reng);$j++){
				//insertamos los renglones de las  factra que buscamos 
				//add_con_sal_det_reng($co_art='', $total_art='', $co_alma='', $reng_num='', $fact_num='', $id_con_detalle='', $prec_vta='', $porc_desc='', $reng_neto='', $art_des='')	
				
				$new_con_sal_det_reng=$obj_con_sal_det_reng->add_con_sal_det_reng($arr_cyberlux_factura_reng[$j]['co_art'],$arr_cyberlux_factura_reng[$j]['total_art'],$arr_cyberlux_factura_reng[$j]['co_alma'],$arr_cyberlux_factura_reng[$j]['reng_num'],$arr_cyberlux_factura_reng[$j]['fact_num'],$new_control_salida_detalle,$arr_cyberlux_factura_reng[$j]['prec_vta'],$arr_cyberlux_factura_reng[$j]['porc_desc'],$arr_cyberlux_factura_reng[$j]['reng_neto'],rehtmlspecialchars($arr_cyberlux_factura_reng[$j]['art_des']));
			}
			//limpiamps nuevamente las temporales de factiras			
			$del_factura_temp_uso=$obj_factura_temp_uso->delete_factura_temp_uso($_SESSION['id_usuario']);		

		}//finalizamos la condicion if
	}//finalizamos el for
	
	//buscamos el transportista para ponerlo en servicio
	$arr_transportista=$obj_transportista->get_transportista_rif($id_transportista);//busco la cedula del transportista para asi editar y cambiar de estatus al transportista que puede estar o no e varias sucursales;
	$change_status_transportista=$obj_transportista->change_status_transportista($arr_transportista[0]['rif'],'3');//cambio su estatus a en servivio
	
	//cambio el estatus del vehiculo
	$arr_vehiculo=$obj_vehiculo->get_vehiculo_placa($_REQUEST['vehiculo']);//busco el vehiculo que necesito
	$change_status_vehiculo=$obj_vehiculo->change_status_vehiculo($arr_vehiculo[0]['placa'],'3');//cambio su estatus a en servivio
	
	//log
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=16;
	$id_registro=$res_add_empresa;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=1;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
	
	//SECCCION DE CREACION DE DATOS EN LA WEBPARA MODULO 48 HORAS
		 
		
	//SECCCION DE CREACION DE DATOS EN LA WEBPARA MODULO 48 HORAS
		
	
	header('Location: forma_guia_transporte_imp.php?id='.$id_control_salida);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
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
                <table align="center" width="95%" >
                  <tr class="tabla_barra_opciones" >
                    <td colspan="2"><table class="tabla_opciones" >
                        <tr >
                          <td width="72%" class="form_titulo_procesos" >Guia Transporte
                          </td>
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
                                  <td class="form_label_proceso" colspan="4">Transporte</td>
                                </tr>
                                <tr>
                                  <td  class="form_label_proceso">Fecha: </td>
								  <td class="form_label_procesos_imp" ><?php echo date('d/m/Y h:i:s a');?>                                  </td>
                                  <td    class="form_label_proceso">&nbsp;</td>
							      <td  class="form_label_procesos_imp" >                                  </td>
                                </tr>
                                <tr>
                                      <td class="form_label_proceso">Vehiculo: </td>
                                <td  class="form_label_procesos_imp" id="id_carga_vehiculo">
                               <?php $arr_vehiculo=$obj_vehiculo->get_pool_vehiculo('','','','1',$_SESSION['id_sucursal'],''); ?>
                               <select name="vehiculo" id="vehiculo" class="form_pool_proceso" onchange="carga_data_vehiculo('vehiculo','vehiculo_tipo','vehiculo_capacidad','vehiculo_mensaje','seccion_ruta')" >
                                 <option value="0">Seleccione...</option>
                                 <?php  
                                for ($i=0; $i<sizeof($arr_vehiculo);$i++) { ?>
                                 <option value="<?php echo $arr_vehiculo[$i]['id'];?>"> <?php echo htmlentities($arr_vehiculo[$i]['placa'].' --- '.$arr_vehiculo[$i]['tipo']);?> </option>
                                 <?php }?>
                               </select>
                               <input type="hidden"  name="vehiculo_placa" id="vehiculo_placa" value="" />
                         <input type="hidden"  name="vehiculo_tipo" id="vehiculo_tipo" value="" />
                                        <input type="hidden"  name="vehiculo_capacidad" id="vehiculo_capacidad" value="" />                				  </td>
                                  <td    class="form_label_proceso">Transportista: </td>
								   <td  class="form_label_procesos_imp" id="id_carga_transportista">
                                    <select name="transportista" id="transportista" class="form_pool_proceso" >
                                    	<option value="0">Seleccione...</option>
                                    </select>                                   </td>
                                </tr>
                                <tr>
                                                                 <td  class="form_label_proceso">Empresa: </td>
								  <td class="form_label_procesos_imp" >
                                  	<input name="empresa_transportista_nombre" type="text" id="empresa_transportista_nombre"  class="form_caja_proceso" readonly="readonly"
                                     />
                                     <input name="empresa_transportista" id="empresa_transportista"   class="form_caja_proceso"  type="hidden" />                                  </td>

                                  <td class="tr_mensaje_ayuda" colspan="2" id="vehiculo_mensaje">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso" colspan="4">Escolta</td>
                                </tr>
                                 <tr>
                                  <td width="16%" class="form_label_proceso">Empresa: </td>
									<td   class="form_label_procesos_imp" >
                                   
                                    	<select name="empresa_escolta" id="empresa_escolta" class="form_pool_proceso" onChange="load_pool('id_carga_escolta','asin_pool_escolta.php','empresa_escolta')" >
                                      <option value="0">Seleccione...</option>
                                      <?php
									  		$arr_empresa_esc=$obj_empresa->get_empresa('','',2);
									  		for ($i=0; $i<sizeof($arr_empresa_esc);$i++) { ?>
                                      <option value="<?php echo $arr_empresa_esc[$i]['id']; ?>"> <?php echo htmlentities($arr_empresa_esc[$i]['descripcion']);?> </option>
                                      <?php }?>
                                    </select>                                  </td>
                                  <td  width="17%"  class="form_label_proceso">Escolta: </td>
									<td  class="form_label_procesos_imp"	 id="id_carga_escolta">
                                     
                                    	<select name="escolta" id="escolta" class="form_pool_proceso" >
                                      <option value="0">Seleccione...</option>
                                      <?php  
                                                        for ($i=0; $i<sizeof($arr_usuario_tipo);$i++) { ?>
                                      <option value="<?=$arr_usuario_tipo[$i]['id']?>"> <?php echo $arr_usuario_tipo[$i]['descripcion'];?> </option>
                                      <?php }?>
                                  </select></td>
                                </tr>
                              </table>
                            <!--DATOS ENCABEZADO-->
                          </td>
                        </tr>
                        <tr >
                          <td  align="center"><img src="../images/img_line_separadora.png" width="100%" height="1" /></td>
                        </tr>
                        <tr>
                        	<td  id="seccion_ruta">
                            	<table  class="tablas_procesos_datos">
                                    	 <tr>
                                              <td class="form_label_proceso" colspan="4">Datos del destino</td>
                                            </tr>
                                    	<tr>
                                          <td width="16%" class="form_label_proceso">Ruta: </td>
                                          <td  colspan="2">
                                          <textarea id="id_ruta" name="id_ruta" class="form_text_proceso_ruta" style="display:none" ></textarea>
                                          <textarea id="h_ruta" name="h_ruta" class="form_text_proceso_ruta" style="display:none" ></textarea>
                                          
                                          <textarea id="ruta" name="ruta"  readonly="readonly"  class="form_text_proceso_ruta"   onclick="load_page('tr_message','asin_table_ruta.php','ruta')" ></textarea></td>
                                          <td width="40%" rowspan="2"   class="tr_mensaje_ayuda"  > 
                                          <div id="tr_message" class="espacio_ruta">
                                          </div>                                         </td>
                                      </tr>
                                        <tr>
                                          <td class="form_label_proceso">Desvio: </td>
                                          <td   colspan="2">
                                         
                                          <textarea id="desvio" name="desvio"  readonly="readonly" class="form_text_proceso_ruta"  onclick="load_page('tr_message','asin_desvio.php','ruta')" >
                                            </textarea></td>
                                  </tr>
                                    </table>
                          </td>
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
                                	<td colspan="4">
                                    	<!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->
                                        <table  id="tabla_facturas" width="100%" cellpadding="0">
                                        	<tr>
                                              <td width="44%" class="form_label_proceso"><div align="center">CLIENTE</div></td>
                                              <td width="24%" class="form_label_proceso"><div align="center">NO. FACTURA</div></td>
                                              <td width="25%" class="form_label_proceso"><div align="center">MONTO</div></td>
                                              <td width="7%" class="form_label_proceso"><div align="center"></div></td>
                                            </tr>
                                            <tr id="factura_0">
                                            	
                                              <td align="center">
                                              	<input type="hidden" id="fac_sta_0" name="fac_sta_0"  />
                                                <input type="hidden" id="fac_con_0" name="fac_con_0" value="0"  />
                                                <input type="hidden" id="cf" name="cf" value="0"  />                                             
                                                 
                                                <input name="fac_cli_0"  id="fac_cli_0" type="text" class="form_caja_proceso_cliente" value="" readonly="readonly"/>                                   
                                               </td>
                                              <td align="center">

                                              	<input name="fac_num_0"  id="fac_num_0" type="text" class="form_caja_proceso_numero" value="" onChange="cargar_factura('fac_num_','id_carga_factura','fac_con_0','cf','fac_img_','fac_mon_','fac_cli_')" onKeyPress="return acceptNum(event)"/></td>
                                              <td align="center">
                                              	<input name="fac_mon_0"  id="fac_mon_0" type="text" class="form_caja_proceso_numero" value=""  readonly="readonly"/></td>
                                              <td align="center" id="fac_img_0"><img src="../images/pluss.png" alt="" /></td>
                                            </tr>
                                        	
                                        </table>
                                        <!--TABLA CARGA FACTURAS EN ESTA TABLA SE CARGARAN LAS  FACTURAS-->
                                    </td>
                                </tr>
                                <tr>
                                	<td>
                                    	<table width="100%" cellpadding="0">
                                        	<tr>
                                              <td colspan="2" class="form_label_subtotales" align="right"  width="68%" >Monto Total en Facturas:&nbsp;&nbsp;&nbsp;</td>
                                              <td width="25%" align="center">
                                                                                            
                                              <input name="monto_facturas" type="text" class="form_caja_proceso_numero" id="monto_facturas" value="0" readonly="readonly" />
                                              </td>
                                              <td width="7%">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
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
                                  <td class="form_label_procesos_imp" colspan="1">
                                  
                                  	<input name="valor_viaje" type="text" class="form_caja_proceso_numero" id="valor_viaje" value="0" readonly="readonly" /></td>                                  <td  width="24%"  class="form_label_proceso">Amarre: </td>
                                  <td width="26%" class="form_label_procesos_imp">
                                  	<input name="valor_amarre" type="text" class="form_caja_proceso_numero" id="valor_amarre" value="0"  readonly="readonly"  />                                  </td>
                                </tr>
                                <tr>
                                  <td width="21%" class="form_label_proceso">Valor de Escolta: </td>
                                  <td  width="29%" class="form_label_procesos_imp" >

                                  	<input name="valor_escolta" type="text" class="form_caja_proceso_numero" id="valor_escolta" value="0"  readonly="readonly"  />                                  </td>
                                  <td  width="24%"  class="form_label_proceso">Caleta: </td>
                                  <td width="26%" class="form_label_procesos_imp">
                                  	<input name="valor_caleta" type="text" class="form_caja_proceso_numero" id="valor_caleta" value="0"  readonly="readonly"  />                                  </td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Desvio: </td>
                                  <td  class="form_label_procesos_imp">

                                  	<input name="valor_desvio" type="text" class="form_caja_proceso_numero" id="valor_desvio" value="0"  readonly="readonly"   />                                  </td>
                                  <td class="form_label_proceso">Caleta Esecial: </td>
                                  <td  class="form_label_procesos_imp">
                                  	<input name="valor_caleta_especial" type="text" class="form_caja_proceso_numero" id="valor_caleta_especial" value="0" />                                  </td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Adelanto: </td>
                                  <td  class="form_label_procesos_imp">
                                                                                                      
                                  	<input name="valor_adelanto" type="text" class="form_caja_proceso_numero" id="valor_adelanto" value="0"  readonly="readonly"   />                                  </td>
                                  <td class="form_label_proceso">Devolución: </td>
                                  <td  class="form_label_procesos_imp">
                                  	<input name="valor_devolucion" type="text" class="form_caja_proceso_numero" id="valor_devolucion" value="0"  />                                  </td>
                                </tr>
                                 <tr>
                                  <td class="form_label_proceso">Total Sin Escolta: </td>
                                  <td  class="form_label_procesos_imp">
                                                                                                      
                                  	<input name="valor_sin_escolta" type="text" class="form_caja_proceso_numero" id="valor_sin_escolta" value="0"  readonly="readonly"   />                                  </td>
                                  <td class="form_label_proceso">Total Con Escolta: </td>
                                  <td  class="form_label_procesos_imp">
                                  	<input name="valor_con_escolta" type="text" class="form_caja_proceso_numero" id="valor_con_escolta" value="0"  readonly="readonly"   />                                  </td>
                                </tr>
                                <tr>
                                  <td class="form_label_proceso" colspan="4">Pagos realizados a la salida (Pagos con Caja)</td>
                                  
                                </tr>
                                <tr>
                                  <td class="form_label_proceso">Adelanto: </td>
                                  <td  class="form_label_procesos_imp">
                                  
                                  		<input name="caja_adelanto" type="text" class="form_caja_proceso_numero" id="caja_adelanto" value="0"  maxlength="6" onKeyPress="return acceptNumFloat(event)"  />
                                  </td>
                                  <td class="form_label_proceso">Caleta: </td>
                                  <td  class="form_label_procesos_imp"><input name="caja_caleta" type="text" class="form_caja_proceso_numero" id="caja_caleta" value="0"    maxlength="6" onKeyPress="return acceptNumFloat(event)"   /></td>
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
                                  <td width="79%" class="form_label_procesos_imp">
                                  
                                  <textarea id="observaciones" name="observaciones" class="form_text_proceso_ruta"></textarea></td>
                                </tr>
                              </table>
                            <!--DATOS DEL COSTO DEL VIAJE-->
                          </td>
                        </tr>
                        <!--CARGA DE LA FACTURA-->
                        <tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="mensaje_error" ></td>
                         </tr>
                        <tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="carga_monto" ></td>
                         </tr>
                        <tr >
                          <td  align="center"><input type="hidden" id="accion" name="accion" value="" /></td>
                        </tr>
                        <!--CARGA DE LA FACTURA-->
                        <!--ENVIO DE FORMULARIO-->
                        <tr>
                          <td align="center" id="botonera_activa" >
                         
                        <input name="save" type="button" class="form_botones" id="save" style="cursor:hand" value="Guardar e Imprimir"  onclick="cargaMyForm()"/>
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
<script language="javascript">
	$("#seccion_ruta").addClass('not_display');
</script>
<script type="text/javascript">

					//DECLARACION DE ARAY DEL FORM
							function cargaMyForm(){
								var myForm='form1'; // nombre del forulario
								var myPase='accion';//campo que se usa para el pase seguro
								var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
								my_form_column = new Array();							my_form_tipo = new Array();
												

												
								//my_form_column[0]='empresa_transportista';				my_form_tipo[0]=1;
								my_form_column[1]='transportista';						my_form_tipo[1]=1;
								my_form_column[2]='vehiculo';							my_form_tipo[2]=1;
								//my_form_column[3]='empresa_escolta';					my_form_tipo[3]=1;
								//my_form_column[4]='escolta';							my_form_tipo[4]=1;
								my_form_column[5]='ruta';								my_form_tipo[5]=1;
								//my_form_column[6]='desvio';								my_form_tipo[6]=1;
								my_form_column[7]='monto_facturas';						my_form_tipo[7]=6;
								my_form_column[8]='valor_viaje';						my_form_tipo[8]=6;
								my_form_column[9]='valor_escolta';						my_form_tipo[9]=6;
								my_form_column[10]='valor_caleta';						my_form_tipo[10]=6;
								my_form_column[11]='valor_desvio';						my_form_tipo[11]=6;
								my_form_column[12]='valor_caleta_especial';				my_form_tipo[12]=6;
								my_form_column[13]='valor_adelanto';				    my_form_tipo[13]=6;
								my_form_column[14]='valor_devolucion';					my_form_tipo[14]=6;
								my_form_column[15]='caja_adelanto';						my_form_tipo[15]=6;
								my_form_column[16]='caja_caleta';						my_form_tipo[16]=6;
								//my_form_column[17]='observaciones';					my_form_tipo[17]=1;
								//my_form_column[18]='fecha_salida';						my_form_tipo[18]=1;
									
								//fac_cli_0,fac_num_0,fac_mon_0,
								//fac_sta_0,fac_con_0,cf
								cf=$("#cf").val();
								cc=17;								
								for(i=0;i<=cf;i++){

									if($("#fac_num_"+i).val() && i>0){
									
										cc++;	my_form_column[cc]='fac_cli_'+i;	my_form_tipo[cc]=1;
										cc++;	my_form_column[cc]='fac_num_'+i;	my_form_tipo[cc]=5;
										cc++;	my_form_column[cc]='fac_mon_'+i;	my_form_tipo[cc]=1;
									}
									if(i==0){
									
										cc++;	my_form_column[cc]='fac_cli_'+i;	my_form_tipo[cc]=1;
										cc++;	my_form_column[cc]='fac_num_'+i;	my_form_tipo[cc]=5;
										cc++;	my_form_column[cc]='fac_mon_'+i;	my_form_tipo[cc]=1;
									}
								}
											
												//onclick="valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage)"
							//manda a ejecuitar la fucnion de validacion de documentos
								valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
							}							
												
</script>
</html>
