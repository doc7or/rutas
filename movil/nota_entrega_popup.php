<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['usuario'],'')) header('Location: ../lib/common/logout.php');
//llamado de las clases
$obj_vendedor= new class_vendedor();//llamado de la tabla de vendedores
$obj_clientes= new class_clientes();//llamado de la tabla de vendedores
$obj_not_ent= new class_not_ent();//llamado de notas de entrega
$obj_reng_nde= new class_reng_nde();//renglones de notas de entrega

//recepcion de parametros
$fact_num=$_REQUEST['fact_num'];

$arr_not_ent=$obj_not_ent->get_not_ent_list($fact_num,$vendedor,$rango);



//buscamos los renglones de los not_ent
$arr_reng_nde=$obj_reng_nde->get_reng_nde_list_art($arr_not_ent[0]['fact_num']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux_movil.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script language="javascript" src="../lib/js/jquery/jquery.js"></script>
<script language="javascript" src="../lib/js/jquery/form.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
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
              <form name="form1" id="form1" action="nota_entrega_imp.php?fact_num=<?php echo $fact_num; ?>" method="post"   >
		  <table width="100%" align="center" class="tablas_listados_datos" >
		                        <tr>
                      <td  colspan="2" class="tabla_barra_opciones"  ><table class="tabla_opciones" >
                        <tr >
                          <td width="63%" align="left">Opciones</td>
                          <td width="37%"><table class="tabla_opciones" >
                            <tr align="center">
                              <td width="20%" >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  ></td>
                              <td width="20%" ><a href="reporte_nota_entrega.php" ><img  src="../images/listado.png"  title="Volver al menu" alt="Volver al menu"  style="border:none" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>

		    <tr>
		      <td  colspan="2" align="left" height="10" class="tablas_pedidos_resg">&nbsp;</td>
	        </tr>
		    <tr>
		      <td  colspan="2" height="10" align="left" class="tablas_pedidos_bolg" >No. Nota&nbsp;:&nbsp;<?php echo $arr_not_ent[0]['fact_num']; ?></td>
		      
	        </tr>
           
            <tr>
		     
		      <td colspan="2" height="10" align="left" class="tablas_pedidos_bolg" >Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $arr_not_ent[0]['fec_emis']; ?></td>
	        </tr>
		    <tr>
		      <td  colspan="2" align="left"><table class="tabla_opciones" >
		        <tr >
		          <td align="left" class="tablas_pedidos_bolg" >Observaciones</td>
	            </tr>
		        <tr >
		          <td  align="left" ><span class="form_label_procesos_imp">
		            <?php  echo $arr_not_ent[0]['descrip'];?>
		            </span></td>
	            </tr>
		        <tr >
		          <td align="left" class="tablas_pedidos_bolg" >Cliente </td>
	            </tr>
		        <tr >
		          <td align="left" ><span class="form_label_procesos_imp"><?php echo $arr_not_ent[0]['co_cli'].' - '.$arr_not_ent[0]['cli_des']; ?></span></td>
	            </tr>
                 
		        <tr >
		          <td  align="left" >&nbsp;</td>
	            </tr>
		        <tr >
		          <td  align="left" ><table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
		            <tr  >
		              <td width="113" class="tabla_pedidos_titulos" >Producto</td>
		              <td width="37" class="tabla_pedidos_titulos" > Cant</td>
		              <td width="56" class="tabla_pedidos_titulos" >P.Ven</td>
		              <td width="72" class="tabla_pedidos_titulos" >Total.</td>
	                </tr>
		            <!--AQUI VA LAS COSAS DE EL PEDIDO0 TANTO LA DIVISION POR LINEAS COMO LOS PRODUCTOS EN SI-->
		            <?php // for($il=0;$il<sizeof($arr_lin_art);$il++){?>
		           <!-- <tr >
		              <td colspan="4" class="tabla_pedidos_titulos_sub" ><?php // echo strtoupper($arr_lin_art[$il]['lin_des']); ?></td>
	                </tr>-->
		            <!--AQUI ESTARA EL LSIADO DE ARTICULOS-->
		            <?php  
									 	//BUSCAMOS LOS DETALLES O RENGLONES SEGUN ESTAS TABLAS DE EL PEDIDO
									//	$arr_t_xreng_nde=$obj_xreng_nde->get_xreng_nde_detallado_art1($fact_num,$arr_lin_art[$il]['co_lin']);
									 	//RECOREMOS EL DETALLE DE ESTE PAEDIDO
									 	for($i=0;$i<sizeof($arr_reng_nde);$i++){
										
										//llamado de las clases para filas impares y pares
										  if ($i % 2){
											$clase = "tablas_pedidos_datos_par";
											} else{
											$clase = "tablas_pedidos_datos_imp";
										 }
										?>
		            <tr >
		              <td class="<?php echo $clase; ?>" width="113">
                      	<font class="tablas_pedidos_txt"><?php echo $arr_reng_nde[$i]['art_des']; ?><br />
		                </font> <font class="tablas_pedidos_bol"><?php echo $arr_reng_nde[$i]['co_art']; ?></font>
                      </td>
		              <td   class="<?php echo $clase; ?>" width="37"><div align="right"><?php echo number_format($arr_reng_nde[$i]['total_art'],0); ?>&nbsp;</div></td>
		              <td   class="<?php echo $clase; ?>" width="56"><div align="right"><?php echo number_format($arr_reng_nde[$i]['prec_vta'],2,',','.'); ?>&nbsp;</div></td>
		              <td  class="<?php echo $clase; ?>"  width="72"><div align="right"><?php echo number_format($arr_reng_nde[$i]['reng_neto'],2,',','.'); ?>&nbsp;</div></td>
	                </tr>
		            <?php } ?>
		            <?php // } ?>
		            </table></td>
	            </tr>
		        <tr >
		          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
	            </tr>
		        <!--TABLA DE LOS TOTALES-->
		        <tr >
		          <td  align="left" ><table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
		            <tr  >
		              <td width="210" class="tabla_pedidos_totales"  >Sub Total&nbsp;: </td>
		              <td width="100" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_not_ent[0]['tot_bruto'],2,'.',','); ?>&nbsp;&nbsp;</div></td>
	                </tr>
		            <tr  >
		              <td width="250" class="tabla_pedidos_totales" >I.V.A&nbsp;:</td>
		              <td width="60" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_not_ent[0]['iva'],2,'.',','); ?>&nbsp;&nbsp;</div></td>
	                </tr>
		            <tr  >
		              <td width="250" class="tabla_pedidos_totales" >Total&nbsp;:</td>
		              <td width="60" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_not_ent[0]['tot_neto'],2,'.',','); ?>&nbsp;&nbsp;</div></td>
	                </tr>
		            </table></td>
	            </tr>
		        <!--TABLA DE LOS TOTALES-->
		        <tr >
		          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
	            </tr>
		        <tr >
		          <td  align="left"  class="tablas_pedidos_bolg"><input type="submit" name="op" id="op" value="Imprimir Nota" class="form_boton_grande"  > </td>
	            </tr>
		        <tr >
		          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
	            </tr>
		        </table></td>
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
