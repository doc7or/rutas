<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1')) header('Location: ../lib/common/logout.php');
$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle= new class_control_salida_detalle;
$obj_env_rec_facturas= new class_env_rec_facturas;
$obj_env_rec_facturas_detalle= new class_env_rec_facturas_detalle;

$id_sucursal=$_SESSION['id_sucursal'];
$tipo=$_REQUEST['tipo'];
$fecha=guardafecha($_REQUEST['fecha_hasta'].' 23:59:59','es');
$status='3';//esto aplica para las guias liquidadas
if($fecha){
	$arr_control_salida_detalle=$obj_control_salida_detalle->get_fac_suc_env($id_sucursal,$fecha);
	$fecha_caja=$_REQUEST['fecha_hasta'];
}
else{
	$fecha_caja=date("d-m-Y");
}
$titulo='Proceso de Envio de Facturas a Cyberlux';
if($_REQUEST['acc']=='1'){
$crear_envio=0;
	//COMPRUEBO Q POR LO MENOS HAYA UNA FACTURA PARA ENVIEARLA A CAMORUCO
	for($i=0;$i<sizeof($arr_control_salida_detalle);$i++){
		if($_REQUEST['check_'.$i]){
			//AQUI ES DONDE SE REGISTRARAN LAS FACTURAS PARA EL ENVIO
			$crear_envio=1;
			$i=sizeof($arr_control_salida_detalle);		
		}
		
	}
	
	if($crear_envio==1){
	 echo	$id_por_sucursal=$obj_env_rec_facturas->get_env_rec_facturas_id_sucursal($_SESSION['id_sucursal']);
	//die();
		$fecha=	guardafecha(date('d/m/Y h:i:s'),'es');//obtengo la fecha actual
		$fecha_hasta=guardafecha($_REQUEST['fecha_hasta'].' 23:59:59','es');//obtengo la fecha hasta la cual se va a realizar la nomina

		$new_env_rec_facturas=$obj_env_rec_facturas->add_env_rec_facturas($id_por_sucursal,$_SESSION['id_sucursal'],$fecha,$fecha_hasta);	
		
		
		for($i=0;$i<sizeof($arr_control_salida_detalle);$i++){
			if($_REQUEST['check_'.$i]){
				$status_general=4;//se establese el estatus de enviada para la factura
				//AQUI ES DONDE SE REGISTRARAN LAS FACTURAS QUE SE ENVIARAN A CAMORUCO
				$new_env_rec_facturas_detalle=$obj_env_rec_facturas_detalle->add_env_rec_facturas_detalle($new_env_rec_facturas,$arr_control_salida_detalle[$i]['id']);	
				
				//cambio el status de la guia de  transporte bien sea a pagada o nomu¡inada
				$obj_control_salida_detalle->change_status_control_salida_detalle($arr_control_salida_detalle[$i]['id'],$status_general);			
			}
			
		}
	}//fin del si
	
	header('Location: nomina_list.php');
	
	
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
  <link rel="stylesheet" type="text/css" media="all" href="../lib/js/calendar/skins/aqua/aqua.css" title="win2k-cold-1" />
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
                          <td colspan="12"><table class="tabla_opciones" >
                              <tr >
                                <td width="62%">
                                	<table class="tablas_filtros" >
                                    	<tr>
                                        	<td width="59%" valign="center">
                                           	  <input name="fecha_hasta" id="fecha_hasta" readonly="" size="20" type="text"  value="<?php echo $fecha_caja;?>" style="cursor: pointer" title="Date selector"    class="form_caja_proceso"/>
                      <img  src="../images/calendar_view_day.png" id="fecha_img" style="cursor: pointer; border: 1px solid #0099FF; margin-top:auto; margin-bottom:auto" title="Los resultados seran todos los menores a la fecha que seleccione" onMouseOver="this.style.background='#0099FF';" onMouseOut="this.style.background=''" />
                      <script type="text/javascript">
                                        Calendar.setup({
                                            inputField     :    "fecha_hasta",     // id of the input field
                                            ifFormat       :    "%d-%m-%Y",      // format of the input field
                                            button         :    "fecha_img",  // trigger for the calendar (button ID)
                                            align          :    "Bl",           // alignment (defaults to "Bl")
                                            singleClick    :    true
                                        });
                                    </script>                                            </td>
                                            <td width="21%"></td>
                                          <td width="20%"></td>
                                      </tr>
                                    </table>                                </td>
                                <td width="10%">&nbsp;</td>
                                <td width="28%"><table class="tablas_filtros" >
                                    <tr align="center">
                                      <td width="20%" >
                                      <img src="../images/page_word.png"  style="border:none; cursor:pointer" onclick="filtros('nomina_xls.php','fecha_hasta')"  alt="Descargar Word"   title="Descargar Word"/>                                      </td>
                                      <td width="20%"  >
                                      <input type="hidden" name="acc" id="acc" />
                                      <img src="../images/disk.png" title="Guardar" alt="Guardar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')"  /></td>
                                      <td width="20%"  ><img src="../images/accept.png" title="Checar Todas" alt="Checar Todas" style="border:none; cursor:pointer" onclick="checarTodos('check_','<?php echo sizeof($arr_control_salida_detalle); ?>')"  /></td>
                                      <td width="20%"  ><img  src="../images/accept_g.png" title="Deshecar Todas" alt="Deshecar Todas" style="border:none; cursor:pointer" onclick="unChecarTodos('check_','<?php echo sizeof($arr_control_salida_detalle); ?>')"  /></td>
                                      <td width="20%" ><img src="../images/view.png" title="Buscar" alt="Buscar" style="border:none; cursor:pointer" onclick="filtros('','fecha_hasta')"  /></td>
                                  </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="10" colspan="12"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="14%" >Selec.</td>
                          <td width="19%" >Guia</td>
                          <td width="15%" >Numero</td>
                          <td width="35%" >Cliente</td>
                          <td width="17%" >Monto</td>
                      </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										for($i=0; $i<sizeof($arr_control_salida_detalle); $i++){	
										$total[$i]=0;		
										$total_salida[$i]=0;
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
                        <tr class="<?php echo $clase;?>">
                        	<td  align="center"><input type="checkbox" id="check_<?php echo $i; ?>" value="1" name="check_<?php echo $i; ?>" class="form_check_proceso"  />                                                </td>
                          <td bordercolor="#993366" ><?php echo $arr_control_salida_detalle[$i]['guia_id_por_sucursal']; ?></td>
                          <td bordercolor="#993366" ><?php echo $arr_control_salida_detalle[$i]['id_factura']; ?></td>
                          <td bordercolor="#993366" ><?php echo $arr_control_salida_detalle[$i]['cliente']; ?></td>
	                      <td bordercolor="#993366" align="right" ><?php echo $arr_control_salida_detalle[$i]['monto_factura']; ?></td>
                        
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
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
            </div>
		  </div>
		  <div id="footer" >
		  	<?php include ("../lib/common/footer.php"); ?>
          </div>
	</div>
</body>
</html>
