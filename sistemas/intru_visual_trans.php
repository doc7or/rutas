<?php 
include("../lib/core2.lib.php");
//if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');
$obj_vehiculo= new class_vehiculo;
$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle= new class_control_salida_detalle;
$obj_conexiones= new class_conexiones;
$obj_cyberlux_factura= new class_cyberlux_factura;//facturas cyberlux
$obj_con_sal_det_reng = new class_con_sal_det_reng;
$obj_vfnet_csdr = new class_vfnet_csdr;
$obj_sucursal= new class_sucursal;
//buscamos las sucursales
$arr_sucursal = $obj_sucursal->get_sucursal();

//INSERCION DE LA GUIA PARA LA SUCURSAL
$id_sucursal=$_REQUEST['id_sucursal'];
if($id_sucursal){
	
	
	//SECCCION DE CREACION DE DATOS EN LA WEBPARA MODULO 48 HORA
	//llenado de los vectores de datos a subir
		//buscamos los controles en status web 1 
			$arr_cs_sub=$obj_control_salida->get_control_salida_web($id_sucursal);//controles de salida q debemos subir
			for($i=0;$i<sizeof($arr_cs_sub);$i++){
				if($i==0){	$guias_busqueda="'".$arr_cs_sub[$i]['id']."'";	}
				else {	$guias_busqueda.=','."'".$arr_cs_sub[$i]['id']."'";	}
			
			}
			//echo ($guias_busqueda);
		//buscamos los controles detalle en status web 1
		if($arr_cs_sub){
			$arr_csd_sub=$obj_control_salida_detalle->get_con_det_web($guias_busqueda);//buscamos los controles de salida detalle q debemos subir a la web 
		for($i=0;$i<sizeof($arr_csd_sub);$i++){
				if($i==0){	$guiasd_busqueda="'".$arr_csd_sub[$i]['id']."'";	}
				else {	$guiasd_busqueda.=','."'".$arr_csd_sub[$i]['id']."'";	}
			
			}
			//echo ($guiasd_busqueda);
		//buscamos los controles detalle renglones en status web 1
		if($arr_csd_sub){
			$arr_csdr_sub=$obj_con_sal_det_reng->get_con_sal_det_reng_web($guiasd_busqueda);//buscamos los controles de salida detalle mas sus renglines q debemos subir a la web 
			for($i=0;$i<sizeof($arr_csdr_sub);$i++){
				if($i==0){	$guiasdr_busqueda="'".$arr_csdr_sub[$i]['id']."'";	}
				else {	$guiasdr_busqueda.=','."'".$arr_csdr_sub[$i]['id']."'";	}
			
			}
			//die($guiasdr_busqueda);
		}//si hay detalles
		}//si existian controles de salida
	//llenado de los vectores de datos a subir
		
	//proceso de subir los datos a la web
		//coneccion a cyber en la web cyber o la web vfnet
			$conexion_cyber_web=$obj_conexiones->my_conect();
			//insercion de las guias  add_vfnet_control_salida($id_por_sucursal='', $placa='', $fecha='', $fecha_salida='', $monto_facturas='', $id_por_sucursal_new='', $id_control_salida='', $ruta='');
			for($i=0;$i<sizeof($arr_cs_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				$arr_cs_sub[$i]['web']=$obj_vfnet_csdr->add_vfnet_control_salida($arr_cs_sub[$i]['id_por_sucursal'],$arr_cs_sub[$i]['placa'],$arr_cs_sub[$i]['fecha'], $arr_cs_sub[$i]['fecha_salida'],$arr_cs_sub[$i]['monto_facturas'],$arr_cs_sub[$i]['id_por_sucursal_new'],$arr_cs_sub[$i]['id'],$arr_cs_sub[$i]['ruta']);
				
			}
			
			//insercion de las guias detalle
			for($i=0;$i<sizeof($arr_csd_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				$arr_csd_sub[$i]['web']=$obj_vfnet_csdr->add_vfnet_control_salida_detalle($arr_csd_sub[$i]['id'],$arr_csd_sub[$i]['id_factura'],$arr_csd_sub[$i]['monto_factura'],rehtmlspecialchars($arr_csd_sub[$i]['cliente']),$arr_csd_sub[$i]['monto_factura'],$arr_csd_sub[$i]['co_ven'],$arr_csd_sub[$i]['id_control_salida'],$arr_csd_sub[$i]['ven_des'],$arr_csd_sub[$i]['co_cli'],$id_sucursal);
				}
			
			//insercion de las guias detalle renglOnes
			for($i=0;$i<sizeof($arr_csdr_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				$arr_csdr_sub[$i]['web']=$obj_vfnet_csdr->add_vfnet_con_sal_det_reng($arr_csdr_sub[$i]['id'],$arr_csdr_sub[$i]['co_art'],$arr_csdr_sub[$i]['total_art'],$arr_csdr_sub[$i]['co_alma'] ,$arr_csdr_sub[$i]['reng_num'],$arr_csdr_sub[$i]['fact_num'],$arr_csdr_sub[$i]['id_con_detalle'],$arr_csdr_sub[$i]['prec_vta'],$arr_csdr_sub[$i]['porc_desc'],$arr_csdr_sub[$i]['reng_neto'],$arr_csdr_sub[$i]['art_des']);
			}
		
	//proceso de subir los datos a la web
	
	//cerrramos la conexion a conexion_cyber_web
	mysql_close($conexion_cyber_web);//cerra,os esta coneccion
			
	
	
	//SECCION DE ACTUALZACION DE LA DATA EN TRANSPORTE
	//proceso de subir los datos a la web
		//coneccion a transporte para actualizar los datos
			$conexion_transporte=$obj_conexiones->ms_conect_transporte();
			
			//insercion de las guias detalle renglnes
			for($i=0;$i<sizeof($arr_csdr_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				if($arr_csdr_sub[$i]['web']>0) 
				{	//aptualizamos la tabla de renglones de controles de salida detalle
					$udp_st_csdr=$obj_con_sal_det_reng->update_con_sal_det_reng_status_web($arr_csdr_sub[$i]['id'],'2');					
				}	
			}
			
			//insercion de las guias detalle
			for($i=0;$i<sizeof($arr_csd_sub);$i++){
				//insertamos en la web y llenamos el campo que necesitamos para saber si esto se subio
				if($arr_csd_sub[$i]['web']>0) 
				{	//aptualizamos la tabla de renglones de controles de salida detalle
					$udp_st_csd=$obj_control_salida_detalle->change_status_control_salida_detalle_web($arr_csd_sub[$i]['id'],'2');							
				}
				//bucamos si los renglones todos estan en status web subido
				$c_nw_csdr=$obj_con_sal_det_reng->get_con_sal_det_reng('1','',$arr_csd_sub[$i]['id']);
				if($c_nw_csdr==0){
					//lo ponemos en 3 que es el status que dice q sus niveles estan arriba
					$udp_st_csd=$obj_control_salida_detalle->change_status_control_salida_detalle_web($arr_csd_sub[$i]['id'],'3');
				}			
			}
			
			//insercion de las guias  add_vfnet_control_salida($id_por_sucursal='', $placa='', $fecha='', $fecha_salida='', $monto_facturas='', $id_por_sucursal_new='', $id_control_salida='', $ruta='');
			for($i=0;$i<sizeof($arr_cs_sub);$i++){
				//insertamos en la web y llenamos el campo quse necesitamos para saber si esto se subio
				if($arr_cs_sub[$i]['web']>0)
				{	//aptualizamos la tabla de renglones de controles de salida detalle
					$udp_st_cs=$obj_control_salida->change_status_control_salida_web($arr_cs_sub[$i]['id'],'2');							
				}
					//bucamos si los renglones todos estan en status web subido
				$c_nw_csd=$obj_control_salida_detalle->get_con_sal_det('','3',$arr_cs_sub[$i]['id']);
				if($c_nw_csd==0){
					//lo ponemos en 3 que es el status que dice q sus niveles estan arriba
					$udp_st_cs=$obj_control_salida->change_status_control_salida_web($arr_cs_sub[$i]['id'],'3');
				}			
				
			}
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
		            <td  colspan="2" class="form_titulo" >Listado de empresas</td>
	              </tr>
		          <tr>
		            <td  colspan="2" align="center" height="10"></td>
	              </tr>
		          <tr>
		            <td  colspan="2" align="left"><table class="tablas_listados" >
		              <!--ENCABEZADOS-->
		              <tr class="tabla_barra_opciones" >
		                <td width="100%"><table class="tabla_opciones" >
		                  <tr >
		                    <td width="72%"><table width="80%" class="tablas_filtros" >
		                      <tr>
		                        <td width="17%" valign="center" class="form_label" title="Guias por sucursal">Sucursal</td>
		                        <td width="44%"><select name="id_sucursal" id="id_sucursal" class="form_pool_proceso" onfocus="message_help(0)">
		                        
		                          <?php  
                                                                    for ($i=0; $i<sizeof($arr_sucursal);$i++) { ?>
		                          <option value="<?php echo $arr_sucursal[$i]['id']; ?>" <?php if($id_sucursal==$arr_sucursal[$i]['id']) echo "selected";  ?>> <?php echo $arr_sucursal[$i]['descripcion'];?></option>
		                          <?php }?>
		                          </select></td>
		                        <td width="39%">&nbsp;</td>
	                          </tr>
		                      </table></td>
		                    <td width="28%"><table class="tabla_opciones" >
		                      <tr align="center">
		                        <td width="20%" >&nbsp;</td>
		                        <td width="20%"  >&nbsp;</td>
		                        <td width="20%"  ><img  src="../images/aprobar.gif" title="Subir data" alt="Subir data" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')" />
		                          <input type="hidden" name="acc" id="acc" /></td>
		                        <td width="20%"  >&nbsp;</td>
		                        <td width="20%" >&nbsp;</td>
	                          </tr>
		                      </table></td>
	                      </tr>
		                  </table></td>
	                  </tr>
		              <tr>
		                <td height="10"></td>
	                  </tr>
		              <!--ENCABEZADOS-->
		              <!--DATOS-->
		             
		              <!--DATOS-->
		              <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
		              </table></td>
	              </tr>
		          <tr>
		            <td  colspan="2" align="left">&nbsp;</td>
	              </tr>
		          <tr>
		            <td  colspan="2" align="left"><div align="center">
		              <p>&nbsp;</p>
		              </div></td>
	              </tr>
	            </table>
		        <p>&nbsp;</p>
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
