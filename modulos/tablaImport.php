
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />

</head>




<body id="todo">
    
		<div id="contenido" >
        	<div id="filtro" >
            	
            </div>
            <div id="filtroResul" ></div>
            <div id="filtroSuges" ></div>
        <div id="resul" >
            	<div id="resulTabla" >
                	<!--TABLA DE FILTROS -->
                     <table class="tablas_procesos_datos">
                        <tr>
                            <td class="form_label_proceso" colspan="8">DATOS DEL PEDIDO</td>
                        </tr>
                        <tr>
                            <td width="10%" class="form_label_proceso" >Numero: </td>
                            <td width="16%" class="form_label_procesos_imp" >&nbsp;</td>
                            <td width="10%" class="form_label_proceso">Cond Pago: </td>
                            <td width="14%" class="form_label_procesos_imp" >&nbsp;</td>
                            <td width="10%" class="form_label_proceso">status: </td>
                            <td width="19%" class="form_label_procesos_imp" >&nbsp;</td>
                            <td width="8%" class="form_label_proceso">Fecha: </td>
                            <td width="13%" class="form_label_procesos_imp" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="form_label_proceso" >Cliente:</td>
                          <td class="form_label_procesos_imp" colspan="3" >&nbsp;</td>
                          
                          
                          <td class="form_label_procesos_imp">&nbsp;</td>
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                          <td class="form_label_proceso">Entrega:</td>
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="form_label_proceso" >Vendedor: </td>
                          <td class="form_label_procesos_imp"  colspan="2">&nbsp;</td>
                          
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                          <td class="form_label_proceso">Transporte: </td>
                          <td class="form_label_procesos_imp" colspan="3" >&nbsp;</td>
                         
                        </tr>
                        <tr>
                          <td class="form_label_proceso" >Descripcion: </td>
                          <td class="form_label_procesos_imp" colspan="2" >&nbsp;</td>
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                          <td class="form_label_proceso">&nbsp;</td>
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                          <td class="form_label_proceso">&nbsp;</td>
                          <td class="form_label_procesos_imp" >&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="form_label_proceso" colspan="8" >&nbsp;</td>
                         
                        </tr>
                        <tr>
                          <td class="form_label_procesos_imp" colspan="8" >
                    		<!--TABLA DE RENGLONES -->
                    		<table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
                    		  <tr  >
                    		    <td width="31" class="tabla_pedidos_titulos" >Web</td>
                    		    <td width="31" class="tabla_pedidos_titulos" >Profit</td>
                    		    <td width="367" class="tabla_pedidos_titulos" >Cliente</td>
                    		    <td width="31" class="tabla_pedidos_titulos" >Origen</td>
                    		    <td width="105" class="tabla_pedidos_titulos" >Vendedor</td>
                    		    <td width="147" class="tabla_pedidos_titulos" >Monto</td>
                  		    </tr>
                    		  <!--AQUI VA LAS COSAS DE EL PEDIDO0 TANTO LA DIVISION POR LINEAS COMO LOS PRODUCTOS EN SI-->
                    		  <?php 
				 	$total=0;
				 	for($i=0;$i<sizeof($arr_pedidos);$i++){
					 //llamado de las clases para filas impares y pares
										  if ($i % 2){
											$clase = "tablas_pedidos_datos_par";
											$clase_cajas = "tablas_pedidos_datos_par_num";
											} else{
											$clase = "tablas_pedidos_datos_imp";
											$clase_cajas = "tablas_pedidos_datos_imp_num";
										 }	
										 $url='pedido_popup.php?fact_num=';
										 $total=$total+$arr_pedidos[$i]['tot_neto'];
				?>
                    		  <tr >
                    		    <td class="<?php echo $clase_cajas; ?>" width="31" onclick="popup_basic('<?php echo $url.$arr_pedidos[$i]['fact_num']; ?>');" style="cursor:pointer"><?php echo $arr_pedidos[$i]['fact_num']; ?></td>
                    		    <td class="<?php echo $clase_cajas; ?>" width="31" ><?php echo $arr_pedidos[$i]['fact_num_profit']; ?></td>
                    		    <td  class="<?php echo $clase; ?>" width="367" align="left">&nbsp;<?php echo $arr_pedidos[$i]['cli_des']; ?></td>
                    		    <td class="<?php echo $clase; ?>" width="31" ><?php 
						if($arr_pedidos[$i]['origen']=='m') $origen='movil';
						if($arr_pedidos[$i]['origen']=='w') $origen='web';
						echo $origen; ?></td>
                    		    <td  class="<?php echo $clase; ?>" width="105" ><div align="center"><?php echo $arr_pedidos[$i]['co_ven']; ?></div></td>
                    		    <td  class="<?php echo $clase_cajas; ?>" width="147" ><div align="right"><?php echo number_format($arr_pedidos[$i]['tot_neto'],2,',','.'); ?>&nbsp;</div></td>
                  		    </tr>
                    		  <?php } ?>
                    		  <tr  class="tabla_pedidos_titulos_sub" >
                    		    <td class="<?php echo $clase; ?>" ><div align="center" class="tablas_pedidos_bolg"><?php echo $i; ?></div></td>
                    		    <td  class="<?php echo $clase; ?>"  align="right"  colspan="4"><div align="right" class="tablas_pedidos_bolg">Total:&nbsp;&nbsp;</div></td>
                    		    <td  class="<?php echo $clase; ?>" ><div align="right" class="tablas_pedidos_bolg"><?php echo number_format($total,2,',','.'); ?>&nbsp;</div></td>
                  		    </tr>
                    		  <!--AQUI ESTARA EL LSIADO DE ARTICULOS-->
                  		  </table>                    		<!--TABLA DE RENGLONES -->      
                          
                          </td>
                        </tr>
                     </table>
                    <!--TABLA DE FILTROS -->
                	
           	</div>
          </div>
            <div id="resulAccion" ></div>
            <div id="resulGrafic" ></div>
            <div id="cargaAsinc" ></div>
        </div>
		<div id="footer" >
		 
		</div>
	</div>
</body>
</html>
