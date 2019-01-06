<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1')) header('Location: ../lib/common/logout.php');
$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle_post= new class_control_salida_detalle_post;
$obj_control_post= new class_control_post;
$obj_nomina= new class_nomina;
$obj_nomina_detalle= new class_nomina_detalle;
$obj_sucursal=new class_sucursal;


$id=$_REQUEST['id'];
$id_sucursal=$_SESSION['id_sucursal'];
$tipo=$_REQUEST['tipo'];
$fecha=guardafecha($_REQUEST['fecha_hasta'].' 23:59:59','es');
$status='3';//esto aplica para las guias liquidadas
if($fecha){
	$arr_control_salida=$obj_control_salida->list_aprov_nomina($id,$_SESSION['id_sucursal'],$tipo,$status,$fecha);
	$fecha_caja=muestraFechaSola($fecha,'es');
}
else{
	$fecha_caja=date("d-m-Y");
}
$titulo='Proceso de Generaci&oacute;n de Nomina';
if($_REQUEST['acc']=='1'){
$crear_nomina=0;
	//COMPRUEBO Q POR LO MENOS HAYA UNA GUIA PARA NOMINARLA
	for($i=0;$i<sizeof($arr_control_salida);$i++){
		if($_REQUEST['check_'.$i]){
			//AQUI ES DONDE SE REGISTRARAN LAS COSAS PARA LAS NOMINAS DIEFERENTES REGISTRIS TANTO DETALLADO COMO EL GENERAL O NOMINA PRINCIPAL
			$crear_nomina=1;
			$i=sizeof($arr_control_salida);		
		}
		
	}
	
	if($crear_nomina==1){
		$id_por_sucursal=$obj_nomina->get_nomina_id_sucursal($_SESSION['id_sucursal']);
	
		$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
		$fecha_hasta=guardafecha($_REQUEST['fecha_hasta'],'es');//obtengo la fecha hasta la cual se va a realizar la nomina

		$new_nomina=$obj_nomina->add_nomina($id_por_sucursal,$_SESSION['id_sucursal'],$fecha,$fecha_hasta);	
		
		
		for($i=0;$i<sizeof($arr_control_salida);$i++){
			if($_REQUEST['check_'.$i]){
				$status_general=4;//se establese el estatus de pagado a la guia
				//AQUI ES DONDE SE REGISTRARAN LAS COSAS PARA LAS NOMINAS DIEFERENTES REGISTRIS TANTO DETALLADO COMO EL GENERAL O NOMINA PRINCIPAL
				$new_nomina_detalle=$obj_nomina_detalle->add_nomina_detalle($new_nomina,$arr_control_salida[$i]['id']);	
				
				//cambio el status de la guia de  transporte bien sea a pagada o nomu¡inada
				$obj_control_salida->change_status_control_salida($arr_control_salida[$i]['id'],$status_general);			
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
                                      <img src="../images/page_word.png"  style="border:none; cursor:pointer" onclick="filtros('nomina_xls.php','fecha_hasta')"  alt="Descargar Word"   title="Descargar Word"/>
                                      </td>
                                      <td width="20%"  >
                                      <input type="hidden" name="acc" id="acc" />
                                      <img src="../images/disk.png" title="Guardar" alt="Guardar" style="border:none; cursor:pointer" onclick="submitFrom('form1','acc')"  /></td>
                                      <td width="20%"  ><img src="../images/accept.png" title="Checar Todas" alt="Checar Todas" style="border:none; cursor:pointer" onclick="checarTodos('check_','<?php echo sizeof($arr_control_salida); ?>')"  /></td>
                                      <td width="20%"  ><img  src="../images/accept_g.png" title="Deshecar Todas" alt="Deshecar Todas" style="border:none; cursor:pointer" onclick="unChecarTodos('check_','<?php echo sizeof($arr_control_salida); ?>')"  /></td>
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
                          <td >Selec.</td>
                          <td >Guia</td>
                          <td >Ruta</td>
                          <td >Fecha</td>
                          <td >Veh&iacute;culo</td>
                          <td >Monto Bruto</td>
                          <td >Desvio</td>
                          <td >Caleta</td>
                          <td >Pago Caja</td>
                          <td >Repartos</td>
                          <td >EPS A</td>
                          <td >EPS D</td>
                          <td >Saldo</td>
                      </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
							for($i=0; $i<sizeof($arr_control_salida); $i++){	
							$total[$i]=0;		
							$total_salida[$i]=0;

							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									
								//VERIFICAMOS QUE IPO DE QUIA SERA LA QUE VASMOS A LLAMAR
							if($arr_control_salida[$i]['tipo']=='1'){	$url='forma_guia_transporte_popup.php?id=';	}
							if($arr_control_salida[$i]['tipo']=='2'){	$url='forma_guia_traslado_popup.php?id=';	}
							if($arr_control_salida[$i]['tipo']=='3'){	$url='forma_guia_nota_entrega_popup.php?id=';	}
						?>
                        <tr class="<?php echo $clase;?>">
                        	<td  align="center"><input type="checkbox" id="check_<?php echo $i; ?>" value="1" name="check_<?php echo $i; ?>" class="form_check_proceso"  />
                                                </td>
                          <td bordercolor="#993366" onclick="popup_basic('<?php echo $url.$arr_control_salida[$i]['id']; ?>');" style="cursor:pointer" >
						  	 <?php 
						  			//buscamos el prefijo de la sucursal
						  			$arr_sucursal=$obj_sucursal->get_sucursal($arr_control_salida[$i]['id_sucursal']);
									$linea=$arr_sucursal[0]['prefijo'];
								//decidimos si imprimimos la nueva numeracion o la vieja
								if ($arr_control_salida[$i]['id_sucursal']!=2){
									if($arr_control_salida[$i]['id_por_sucursal_new']){
										//completaSpaciosStrins($str,$cuantos,$valor,$pos)
										$numero_formateado=completaSpaciosStrins(0,4,$arr_control_salida[$i]['id_por_sucursal_new'],'1');
										
										$num_guia=$linea.' '.$numero_formateado;//numero correlativo de cada sucursal
									}else{
										$num_guia=$arr_control_salida[$i]['id_por_sucursal'];//numero correlativo de cada sucursal	
									}
								}
								else
									$num_guia=$arr_control_salida[$i]['id_por_sucursal'];//numero correlativo de cada sucursal 
								echo $num_guia; 
						  
						  		
								
							?>
							<?php // echo $arr_control_salida[$i]['id_por_sucursal']; ?>
                          </td>
                          <td bordercolor="#993366" ><?php echo $arr_control_salida[$i]['ruta']; ?></td>
                          <td bordercolor="#993366" ><?php echo muestraFechaSola($arr_control_salida[$i]['fecha_salida'],'es'); ?></td>
	                      <td bordercolor="#993366" ><?php echo $arr_control_salida[$i]['placa']; ?></td>
                          <td bordercolor="#993366" >
					  	  <div align="right"><?php echo number_format($arr_control_salida[$i]['monto'],2,',','.'); 
								$total[$i]+=$arr_control_salida[$i]['monto']; 
								
							?>				  	        </div></td>
                           <td bordercolor="#993366" >
					   	   <div align="right"><?php
					   	   		$Desvio[$i]=$arr_control_salida[$i]['desvio_monto']+$arr_control_salida[$i]['desvioc_monto'];	
					   	   		echo number_format($Desvio[$i],2,',','.'); 
								$total[$i]+=$Desvio[$i]; 
								
							?>				   	         </div></td>
                          <td bordercolor="#993366" >
						  	<div align="right">
						  	  <?php 
								$caleta=$arr_control_salida[$i]['caleta'];
								if(inList($arr_control_salida[$i]['tipo'],'2,3'))
									$caleta=0;
											
							 	echo  number_format($caleta,2,',','.'); 
								$total[$i]+=$caleta;
								?>
				  	        </div></td>
                          <td bordercolor="#993366" >
						  	<div align="right">
						  	  <?php 
								$caja[$i]=$arr_control_salida[$i]['caja_adelanto']+$arr_control_salida[$i]['caja_caleta'];
								echo number_format($caja[$i],2,',','.'); 
								$total[$i]-=$caja[$i]; 
							
							?>
				  	        </div></td>
							<td bordercolor="#993366" >
						   	   <div align="right">
						   	   	<?php 
						   	   		$Reparto[$i]=$arr_control_salida[$i]['reparto_monto']+$arr_control_salida[$i]['repartol_monto'];
						   	   	echo number_format($Reparto[$i],2,',','.'); 
									$total[$i]+=$Reparto[$i]; ?>	
								</div></td>                         
                           <td bordercolor="#993366" >
						  	 <div align="right">
						  	   <?php 
								$arr_control_post_mas=$obj_control_post->get_control_post('','1');
								$epsp[$i]=0;
								for($j=0;$j<sizeof($arr_control_post_mas);$j++)
								{
									$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$arr_control_salida[$i]['id'],$arr_control_post_mas[$j]['id']);
									$epsp[$i]+=$arr_control_salida_detalle_post[0]['monto'];
									
								}
								
								echo number_format($epsp[$i],2,',','.'); 
								$total[$i]+=$epsp[$i]; 
								
								
							?>
				  	         </div></td>
                         
                          <td bordercolor="#993366" >
						  	<div align="right">
						  	  <?php 
								$arr_control_post_min=$obj_control_post->get_control_post('','2');
								$epsm[$i]=0;
								for($j=0;$j<sizeof($arr_control_post_min);$j++)
								{
									$arr_control_salida_detalle_post=$obj_control_salida_detalle_post->get_control_salida_detalle_post('',$arr_control_salida[$i]['id'],$arr_control_post_min[$j]['id']);
									$epsm[$i]+=$arr_control_salida_detalle_post[0]['monto'];
									
								}
								
								echo number_format($epsm[$i],2,',','.');
								$total[$i]-=$epsm[$i];
								
							?>
				  	        </div></td>
                           <td bordercolor="#993366" >
					   	    <div align="right"><?php echo number_format($total[$i],2,',','.'); ?>				   	         </div></td>
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
