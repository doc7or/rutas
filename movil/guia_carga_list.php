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
                            <td valign="center" class="form_label" title="Guias por sucursal" > Opciones</td>
                            <td valign="center" class="form_label" title="Guias por sucursal" > Filtros
                              <input name="tipo" type="hidden" id="tipo"  class="form_caja_proceso" value="<?php echo $tipo;?>" /></td>
                           
                          </tr>
                          <tr>
                            <td width="77" valign="center" class="form_label" title="Fechas del pedido" rowspan="2">Fecha</td>
                            <td width="183">
                            
                            <select name="desde_dia" id="desde_dia" class="form_pool_dia_mes" onfocus="message_help(0)">
                                <?php  
                                      for ($i=1; $i<=31;$i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i==$desde_dia) echo "selected";  ?>> <?php echo $i;?></option>
                                <?php }?>
                              </select>/
                              <select name="desde_mes" id="desde_mes" class="form_pool_dia_mes" onfocus="message_help(0)">
                                <?php  
                                      for ($i=1; $i<=12;$i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i==$desde_mes) echo "selected";  ?>> <?php echo $i;?></option>
                                <?php }?>
                              </select>/
                              <select name="desde_ano" id="desde_ano" class="form_pool_ano" onfocus="message_help(0)">
                                <?php  
                                      for ($i=2008; $i<=date('Y');$i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i==$desde_ano) echo "selected";  ?>> <?php echo $i;?></option>
                                <?php }?>
                              </select>
                            </td>
                           
                          </tr>
                          <tr>
                           
                            <td>
                            
                             <select name="hasta_dia" id="hasta_dia" class="form_pool_dia_mes" onfocus="message_help(0)">
                                <?php  
                                      for ($i=1; $i<=31;$i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i==$hasta_dia) echo "selected";  ?>> <?php echo $i;?></option>
                                <?php }?>
                              </select>/
                              <select name="hasta_mes" id="hasta_mes" class="form_pool_dia_mes" onfocus="message_help(0)">
                                <?php  
                                      for ($i=1; $i<=12;$i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i==$hasta_mes) echo "selected";  ?>> <?php echo $i;?></option>
                                <?php }?>
                              </select>/
                              <select name="hasta_ano" id="hasta_ano" class="form_pool_ano" onfocus="message_help(0)">
                                <?php  
                                      for ($i=2008; $i<=date('Y');$i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i==$hasta_ano) echo "selected";  ?>> <?php echo $i;?></option>
                                <?php }?>
                              </select>
                                     
                                     </td>
                          
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
                  <tr class="tabla_opciones" >
                    <td align="left"><table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
                      <tr  >
                        <td width="55" class="tabla_pedidos_titulos" >Guia</td>
                        <td width="162" class="tabla_pedidos_titulos" >Chofer</td>
                        <td width="65" class="tabla_pedidos_titulos" >Placa</td>
                        
                      </tr>
                      <!--AQUI VA LAS COSAS DE EL PEDIDO0 TANTO LA DIVISION POR LINEAS COMO LOS PRODUCTOS EN SI-->
                      <?php for($i=0;$i<sizeof($arr_GC);$i++){
					 //llamado de las clases para filas impares y pares
										  if ($i % 2){
											$clase = "tablas_pedidos_datos_par";
											} else{
											$clase = "tablas_pedidos_datos_imp";
										 }	
										 $url='guia_carga_view.php?id=';
										 
						?> 
                      <tr >
                        <td class="<?php echo $clase; ?>" width="55" ><a href="<?php echo $url.$arr_GC[$i]['id']; ?>"><div><?php echo $arr_GC[$i]['id_por_sucursal']; ?></div></a></td>
                        <td  class="<?php echo $clase; ?>" width="162" align="left"><a href="<?php echo $url.$arr_GC[$i]['id']; ?>"><div>&nbsp;<?php echo $arr_GC[$i]['t_nombre'].' '.$arr_GC[$i]['t_apellido']; ?></div></a></td>
                        <td  class="<?php echo $clase; ?>" width="65" ><a href="<?php echo $url.$arr_GC[$i]['id']; ?>"><div align="center"><?php echo $arr_GC[$i]['placa']; ?></div></a></td>
                        
                      </tr>
                      <?php } ?>
                     
                      <!--AQUI ESTARA EL LSIADO DE ARTICULOS-->
                    </table></td>
                  </tr>
                  <tr>
                    <td   align="left" >&nbsp;</td>
                  </tr>
                  <tr>
                    <td   align="left" >&nbsp;</td>
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
