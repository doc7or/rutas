<?php 
/*
*Desarrollador: Mervin Mujica
*Fecha: 4-8-2011
*/
include("../lib/core.lib.php");

if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
//--- G  E  T
$obj_empresa= new class_empresa;
$arr_empresa=$obj_empresa->get_empresa('','',1,'','','','',1);
$obj_sucursal= new class_sucursal;
$arr_sucursal=$obj_sucursal->get_sucursal('');
//--- F  I  N     G  E  T


$titulo='Anular Orden de Pago';
$forma='nomina.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" rel="shortcut icon" href="../images/icono.ico">
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>
<script language="javascript">
function enviar(numero,sucursal,id_nomina){
	var sucur=document.getElementById('id_sucursal').value.split('|');
	//alert(sucur[1]);
	//document.getElementById('id_sucursal').value=sucur[0];
	imprimir_cheque(numero,sucursal,id_nomina,sucur[1]);
}
</script>
</head>

<body id="todo"> 
<div id="capa_superior" style="display:none; background-color:  #848484;" align="center"></div>
            <div id="capa_superior1" class="sombra12" style="display:none; "> </div>
    <div id="contenedor" >
		  <div id="header" ></div>
  <div id="menu" >
    <?php include ("../lib/common/menu_superior.php");?>
  </div>
<div id="contenido" > 
          	<div id="menu_visual" ></div>
            <div id="espacio_trabajo" >
            <br/>
            <span class="form_titulo">Anular Orden de Pago</span>
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <form name="form1" id="form1" action="anular_orden_pago.php" method="post"  >
              <input type="hidden" name="monto_neto" id="monto_neto" value="0">
              <input type="hidden" name="iva" id="iva" value="0">
              <input type="hidden" name="monto_iva" id="monto_iva" value="0">
              <input type="hidden" name="retencion" id="retencion" value="0">
              <input type="hidden" name="retencion_monto" id="retencion_monto" value="0">
              <input type="hidden" name="pago_caja" id="pago_caja" value="0">
              <input type="hidden" name="pago_afiliado" id="pago_afiliado" value="0">
			  <input type="hidden" name="anulado" id="anulado" value="0">
               	 <table border="1" style="border-collapse:collapse;border-color:#00FFFF;">
               	<tr class="form_label"><td>Numero de Cheque:</td><td><input type="text" name="num_cheque" id="num_cheque"></td></tr>
				<tr class="form_label"><td>Monto Cheque:</td><td><input type="text" name="monto_orden" id="monto_orden" onkeypress="elim_Punto('monto_orden',0);" onkeyup="elim_Punto('monto_orden',1);"></td></tr>
				<tr class="form_label"><td>Fecha:</td><td><input type="text" name="fecha_desde" id="fecha_desde" readonly >
				<script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fecha_desde",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fecha_desde",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                </script></td></tr>
				<tr class="form_label"><td>Empresa:</td>	
				<td><input type="text" name="descripcion1" id="descripcion1" onkeyup="reiniciar(2);">&nbsp;<select name="descripcion" id="descripcion" class="form_pool" onchange="reiniciar(1);" >
                              <option value="0">...Seleccione...</option>
                 <?php  
                     for ($i=0; $i<sizeof($arr_empresa);$i++) { ?>
                      <option value="<?php echo $arr_empresa[$i]['descripcion'].'|'.$arr_empresa[$i]['id'];?>"> <?php echo $arr_empresa[$i]['descripcion'];?> </option>
                 <?php }?>
                 </select>
                </td>
                </tr>
                <tr>
                   <td  class="form_label" >Almacen de sucursal :</td>
                   <td>
                   <select name="id_sucursal" id="id_sucursal" class="form_pool"  >
                      <option value="|0">...Seleccione...</option>
                      <?php  
                          for ($i=0; $i<sizeof($arr_sucursal);$i++) { ?>
                      <option value="<?php echo $arr_sucursal[$i]['descripcion'].'|'.$arr_sucursal[$i]['id'];?>"><?php echo $arr_sucursal[$i]['descripcion'];?></option>
                      <?php }?>
                       </select>
                        </td>
                        </tr>
			    <tr class="form_label"><td>Banco:</td><td><select id="id_banco" name="id_banco" class="form_pool"><option value="0">...Seleccionar...</option><option value="Banesco" >Banesco</option><option value="Mercantil">Mercantil</option><option value="Provincial">Provincial</option><option value="Venezuela">Venezuela</option><option value="100% Banco" selected>100% Banco</option></select></select></td></tr>
				
				<tr class="form_label"><td>Observaciones:</td><td><textarea id="observaciones" name="observaciones" cols="25" rows="7"></textarea></td></tr>
				<tr style="background-color:#00FFFF;"><td colspan="2" align="center"><input type="button" class="form_botones" name="imprimir_cheq" id="imprimir_cheq" value="Imprimir" onclick="enviar('',document.getElementById('id_sucursal').value,0);">&nbsp;&nbsp;<input type="reset" class="form_botones" name="limpiar" id="limpiar" value="Limpiar" ></td></tr>
				</table>
               	<table border="0">
               	 <?php
               	 echo $imprimir;
               	 ?>
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
