<?php 
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/cheques.class.php");
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'2,3,4,6')) header('Location: ../lib/common/logout.php');

$obj_control_salida= new class_control_salida;
$obj_empresa =new class_empresa;
$obj_sucursal = new class_sucursal;
if(inList($_SESSION['id_tipo_usuario'],'3,4,6')){
	$arr_sucursal = $obj_sucursal->get_sucursal();
	$arr_empresa = $obj_empresa->get_empresa();
}else{
	$arr_sucursal = $obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
	$arr_empresa = $obj_empresa->get_empresa('','','',$_SESSION['id_sucursal']);
}

$cheques=new class_cheque();
if (trim($_GET["buscar"])=='buscar'){
//echo "vfsdvdf  ".$_GET[acc];
	if (trim($_GET['codigo_cheque'])!='')$codigo_cheque=$_GET['codigo_cheque'];
	else$codigo_cheque=0;
	$cheque_valores=$cheques->get_cheque($_GET['codigo_cheque'],$_GET['descripcion_final'],0,$_GET['id_sucursal'],$_GET['banco'],$_GET['monto_concatenada'],$_GET['fecha_concatenada'],$_GET['fecha_nomina_concatenada'],$_GET['acc']);
	//echo $cheque_valores[0]['id_sucursal'];
	if ($cheque_valores[0]['id']!=0){
		$i=0;
		while ($i<sizeof($cheque_valores)){
		
		/*switch ($cheque_valores[0]['status']){
			case 0:$estado='<span style="color:green;">Valido</span>';break;
			case 1:$estado='<span style="color:orange;">Anulado</span>';break;
		}*/
		if (is_numeric($cheque_valores[$i]['id_empresa']))
		$nom_empresa=$cheques->consulta_General_Matriz('select descripcion from empresa where id='.$cheque_valores[$i]['id_empresa']);
	else 
		$nom_empresa[0]['descripcion']=strtoupper($cheque_valores[$i]['id_empresa']);
	if ($cheque_valores[$i]['id_revisado']!=0)
		$nom_sucursal=$cheques->consulta_General_Matriz('select descripcion from sucursal where id='.$cheque_valores[$i]['id_revisado']);
	else
		$nom_sucursal[0]['descripcion']='Vacio';
		//"nomina_solicitud_fondos_pdf.php?descripcion="+"&monto_neto="+"&iva="+"&monto_iva="+"&retencion="+"&retencion_monto="+"&pago_caja="+"&pago_afiliado="+"&sucursal="+sucursal+"&num_cheque="+document.getElementById("num_cheque").value+"&banco="+document.getElementById("id_banco").value+"&observaciones="+document.getElementById("observaciones").value+"&monto_final="+document.getElementById("monto_orden").value+'&id_nomina='+id_nomina+'&fecha_desde='+document.getElementById('fecha_desde').value+'&num_sucursal='+id_sucursal;
		
		$enlace_pdf='<a title="Crear PDF" style="text-decoration: none;" href="nomina_solicitud_fondos_pdf.php?descripcion='.$nom_empresa[0]['descripcion'].'|'.$cheque_valores[$i]['id_empresa'].'&monto_neto=0&iva=0&monto_iva=0&retencion=0&retencion_monto=0&pago_caja=0&pago_afiliado=0&sucursal='.$nom_sucursal[0]['descripcion'].'&num_cheque='.$cheque_valores[$i]['num_cheque'].'&banco='.$cheque_valores[$i]['banco'].'&observaciones='.$cheque_valores[$i]['observaciones'].'&monto_final='.$cheque_valores[$i]['monto'].'&id_nomina='.$cheque_valores[$i]['id_nomina'].'&fecha_desde='.$cheque_valores[$i]['fecha'].'&num_sucursal='.$cheque_valores[$i]['id_revisado'].'"><img style="border: medium none;" src="../images/icono_pdf.png" width="16" height="16" /></a>';
		if ($cheque_valores[$i]['status']==0)$enlace_anular='<a onclick="anular('.$cheque_valores[$i]['num_cheque'].',\'capa'.$i.'\');" href="javascript:return;"><img style="border: medium none;" alt="anular" title="Anular" src="../images/delete.png"></a>';
		else $enlace_anular='<a href="javascript:alert(\'Cheque n-'.$cheque_valores[$i]['num_cheque'].' anulado\');"><img style="border: medium none;" alt="anulado" title="Anulado" src="../images/inactivo.png"></a>';
		$imprimir.='<tr class="form_label"><td>'.$cheque_valores[$i]['num_cheque'].'</td><td>'.$nom_empresa[0]['descripcion'].'</td><td>'.$cheque_valores[$i]['banco'].'</td><td>'.$cheque_valores[$i]['monto'].'</td><td>'.$cheque_valores[$i]['fecha'].'</td><td>'.$nom_sucursal[0]['descripcion'].'</td><td align="center"><div style="position:relative;padding:auto;margin:auto;" align="center"><div id="capa'.$i.'" style="float:left;">'.$enlace_anular.'</div>&nbsp;&nbsp;<div style="position:relative;width:17px;float:left">'.$enlace_pdf.'</div></div></td></tr>';
		
		$i++;
		}
	}else{
		$imprimir='<tr><td colspan="6" align="center"><h5>No se encontraron resultado</h5></td></tr>';
	}
}


$titulo='Reporte de Cheques';
//reporte_cheque.php?fecha_concatenada=&monto_concatenada=&fecha_nomina_concatenada=&descripcion_final=&id_sucursal=0&fecha_desde=&fecha_hasta=&descripcion1=&descripcion=0&banco=&monto_desde=&monto_hasta=&codigo_cheque=&fecha_desde_nomina=&fecha_hasta_nomina=&acc=1000&buscar=buscar

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" rel="shortcut icon" href="../images/icono.ico">
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>

<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/ajax_m.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>
<script language="javascript">
	function enviar(num){
	var resp;
	var validar=/^[0-9]{0,}$/;
	var validar1=/^[0-9\,\.]{1,}$/;
	/*if (!validar.test(document.getElementById("num_cheque").value)){
		alert("Debe ingresar un numero valido en el campo numero de cheque.");
		return;
	}*/
	if (num==1){
		document.form1.action="reporte_cheque_pdf.php";
	}else if (num==2){
		document.form1.action="reporte_cheque.php";
	}else if (num==3){
        document.form1.action="reporte_cheque_xls.php";
    }
	
	if (document.getElementById("anulado_chec1").checked==false)
        document.getElementById("acc").value='1000';
	else
		document.getElementById("acc").value='1';
	if ((document.getElementById("fecha_desde").value!="" && document.getElementById("fecha_hasta").value=='') || (document.getElementById("fecha_desde").value=="" && document.getElementById("fecha_hasta").value!='') ){
		alert('Debe ingresar un rango de fecha correcta');
		return;
		
	}else{
		if (document.getElementById("fecha_desde").value!="" && document.getElementById("fecha_hasta").value!='')
		document.getElementById('fecha_concatenada').value=document.getElementById("fecha_desde").value+'|'+document.getElementById("fecha_hasta").value;
	}
	
	if ((document.getElementById("monto_desde").value!="" && document.getElementById("monto_hasta").value=='') || (document.getElementById("monto_desde").value=="" && document.getElementById("monto_hasta").value!='') ){
		alert('Debe ingresar un rango de montos correctos');
		return;
	}else{
		if (document.getElementById("monto_desde").value!="" && document.getElementById("monto_hasta").value!='')
		document.getElementById('monto_concatenada').value=document.getElementById("monto_desde").value+'|'+document.getElementById("monto_hasta").value;
	}
	if (!validar.test(document.getElementById("codigo_cheque").value)){
		alert("Debe ingresar un numero valido en el campo numero de cheque.");
		return;
	}
	if ((document.getElementById("fecha_desde_nomina").value!="" && document.getElementById("fecha_hasta_nomina").value=='') || (document.getElementById("fecha_desde_nomina").value=="" && document.getElementById("fecha_hasta_nomina").value!='') ){
		alert('Debe ingresar un rango de fecha correctos en el campo fecha nomina');
		return;
	}else{
		if (document.getElementById("fecha_desde_nomina").value!="" && document.getElementById("fecha_hasta_nomina").value!='')
		document.getElementById('fecha_nomina_concatenada').value=document.getElementById("fecha_desde_nomina").value+'|'+document.getElementById("fecha_hasta_nomina").value;
	}
	
	if (document.getElementById('descripcion').selectedIndex!=0)
		document.getElementById('descripcion_final').value=document.getElementById('descripcion').value;
	else
		document.getElementById('descripcion_final').value=document.getElementById('descripcion1').value;
            
        
			//alert(document.getElementById("anulado_chec").value);
    document.form1.submit();
	}
	
	function anular(id,div){
		var resp;
		divi=div;
		resp=confirm('Desea anular el cheque N-'+id);
		if (resp==true){
			//alert('fsdfsdfsdfs');
			general('../lib/php/funciones_ajx.php?dat1='+id+'&opc=1');
		}
	}
	
	function limpiar1(){
		//alert(document.form1.elements.length);
		for (i=0;i<document.form1.elements.length;i++){
			if (document.form1.elements[i].type=='hidden' || document.form1.elements[i].type=='text')
				document.form1.elements[i].value='';
			else if (document.form1.elements[i].type=='select-one')document.form1.elements[i].selectedIndex=0;
		}
	}
</script>
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
              <form name="form1" id="form1" method="GET"  >
                <br />
                <table align="center" width="100%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" ><?php echo $titulo; 
							  
						?> <input type="hidden" name="fecha_concatenada" id="fecha_concatenada" />
						 <input type="hidden" name="monto_concatenada" id="monto_concatenada" /></td>
						 <input type="hidden" name="fecha_nomina_concatenada" id="fecha_nomina_concatenada" />
						 <input type="hidden" name="descripcion_final" id="descripcion_final" /></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados" >
                        <!--ENCABEZADOS-->
                         
                        <tr class="tabla_barra_opciones" >
                          <td width="35%" colspan="6"><table class="tabla_opciones" >
                              <tr >
                                <td width="80%">
                                	<table width="80%" class="tablas_filtros" >
                               	  <tr>
                                        	<td width="17%" valign="center" class="form_label" title="Guias por sucursal">Sucursal</td>
                                    <td width="44%">
                                    <select name="id_sucursal" id="id_sucursal" class="form_pool_proceso">
                                      <option value="0" >Seleccione...</option>
                                      <?php  
                                                                    for ($i=0; $i<sizeof($arr_sucursal);$i++) { ?>
                                      <option value="<?php echo $arr_sucursal[$i]['id']; ?>" <?php if($_GET['id_sucursal']==$arr_sucursal[$i]['id']) echo "selected";  ?>> <?php echo $arr_sucursal[$i]['descripcion'];?> </option>
                                      <?php }?>
                                    </select></td>
                                       <td width="39%">&nbsp;</td>
                                      </tr>
                               	  <tr>
                               	    <td valign="center" class="form_label" title="Fecha de Creacion de la Guia desde - hasta">Fecha</td>
                               	    <td>
                                    
                                     <input name="fecha_desde" type="text" id="fecha_desde"  class="form_caja_proceso" readonly="readonly" value="<?php echo $_GET['fecha_desde'];?>"
                                     />
                                <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fecha_desde",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fecha_desde",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                </script>                                    </td>
                               	    <td><input name="fecha_hasta" type="text" id="fecha_hasta"  class="form_caja_proceso" readonly="readonly" value="<?php echo $_GET['fecha_hasta'];?>"
                                     />
                                          <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fecha_hasta",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fecha_hasta",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                </script>                                     </td>
                             	    </tr>
                               	  <tr>
                               	    <td valign="center" class="form_label" title="Tipo de guia">Empresa</td>
                               	    <td><input type="text" name="descripcion1" id="descripcion1" class="form_caja_proceso" onkeyup="reiniciar(2);" value="<?php echo $_GET['descripcion1'];?>" /></td>   
                               	    <td>                 
                                    <select name="descripcion" id="descripcion" class="form_pool_proceso" onchange="reiniciar(1);">
                                    <option value="0">...Seleccione...</option>
                                    <?php 
                                    $i=0;
                                    while($i<sizeof($arr_empresa)){
                                    	if($_GET['descripcion']==$arr_empresa[$i]['id']) $seleccion="selected";
                                    	else $seleccion='';
                                    	echo '<option value="'.$arr_empresa[$i]['id'].'" '.$seleccion.'  >'.$arr_empresa[$i]['descripcion'].'</option>';
                                    $i++;
                                    }
                                    	?>

                                      
                                   
                                    </select>
                                    </td>
                               	    
                             	    </tr>
                               	  <tr>
                               	    <td valign="center" class="form_label" title="Esatdo de la  guia">Banco</td>
                               	    <td>
                                    
                                    <select id="banco" name="banco" class="form_pool_proceso">
                                    <option value="">...Seleccionar...</option>
                                    <option value="Banesco" <?php if($_GET['banco']=='Banesco') echo "selected";  ?>>Banesco</option>
                                    <option value="Mercantil" <?php if($_GET['banco']=='Mercantil') echo "selected";  ?>>Mercantil</option>
                                    <option value="Provincial" <?php if($_GET['banco']=='Provincial') echo "selected";  ?>>Provincial</option>
                                    <option value="Venezuela" <?php if($_GET['banco']=='Venezuela') echo "selected";  ?>>Venezuela</option>
									<option value="100% Banco" <?php if($_GET['banco']=='100% Banco') echo "selected";  ?>>100% Banco</option>
                                    </select>
                                    </td>
                               	    <td>&nbsp;</td>
                             	    </tr>
                               	  	<tr>
                               	    <td valign="center" class="form_label" title="Esatdo de la  guia">Monto</td>
                               	    <td><input type="text" class="form_caja_proceso" id="monto_desde" name="monto_desde" onkeypress="elim_Punto('monto_desde',0);" onkeyup="elim_Punto('monto_desde',1);" value="<?php echo $_GET['monto_desde'];?>"></td>
                               	    <td><input type="text" class="form_caja_proceso" id="monto_hasta" name="monto_hasta" onkeypress="elim_Punto('monto_hasta',0);" onkeyup="elim_Punto('monto_hasta',1);" value="<?php echo $_GET['monto_hasta'];?>"></td>
                             	    </tr>
                             	    <tr>
                               	    <td valign="center" class="form_label" title="Esatdo de la  guia">N Cheque</td>
                               	    <td><input type="text" class="form_caja_proceso" id="codigo_cheque" name="codigo_cheque" value="<?php echo $_GET['codigo_cheque'];?>"></td>
									<td>&nbsp;</td>
                             	    </tr>
                             	    <tr>
                               	    <td valign="center" class="form_label" title="Fecha de Creacion de la Guia desde - hasta">Fecha Nomina</td>
                               	    <td>
                                    
                                     <input name="fecha_desde_nomina" type="text" id="fecha_desde_nomina"  class="form_caja_proceso" readonly="readonly" value="<?php echo $_GET['fecha_desde_nomina'];?>"
                                     />
                                <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fecha_desde_nomina",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fecha_desde_nomina",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                </script>                                    </td>
                               	    <td><input name="fecha_hasta_nomina" type="text" id="fecha_hasta_nomina"  class="form_caja_proceso" readonly="readonly" value="<?php echo $_GET['fecha_hasta_nomina'];?>"
                                     />
                               <script type="text/javascript">
                                    Calendar.setup({
                                        inputField     :    "fecha_hasta_nomina",     // id of the input field
                                        ifFormat       :    "%d/%m/%Y",      // format of the input field
                                        button         :    "fecha_hasta_nomina",  // trigger for the calendar (button ID)
                                        align          :    "Bl",           // alignment (defaults to "Bl")
                                        singleClick    :    true
                                    });
                                </script>
                                    </td>
                             	    </tr>
                                            <tr>
                               	    <td valign="center" class="form_label" title="Esatdo de la  guia">Anulado</td>
                               	    <td><input type="checkbox" class="form_caja_proceso" id="anulado_chec1" name="anulado_chec1" value="1" <?php if ($_GET['anulado_chec1']==1)    echo 'checked';?> /></td>
									<td>&nbsp;</td>
                             	    </tr>
                                </table>                                </td>
                                <td width="2%"  bgcolor="" >&nbsp;</td>
  <td width="18%" bgcolor="#FFFFFF" valign="top"><table class="tabla_opciones" >
                                    <tr align="center">
                                    
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%" >
                                      
                                      <input type="hidden" name="acc" id="acc" /></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                        </tr>
                        
                        <tr>
                          <td height="10" colspan="6" align="center">
                          			  <button onclick="enviar(2);"  class="form_botones" name="buscar" id="buscar" value="buscar"><img src="../images/view.png" width="16" height="16" /></button>&nbsp;&nbsp;
                                      <button onclick="enviar(1);"  class="form_botones"><img src="../images/icono_pdf.png" width="16" height="16" /></button>&nbsp;&nbsp;
                                      <button onclick="enviar(3);"  class="form_botones"><img src="../images/excel.png" width="16" height="16" /></button>&nbsp;&nbsp;
                                      <button type="button" name="limpiar" id="limpiar" onclick='limpiar1();'  class="form_botones" ><img src="../images/limpiar.png" width="16" height="16" /></button></td>
                        </tr>
                             
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                      
                    </table>
                    </td>
                  </tr>                  
              		<tr>
                    	<td>&nbsp;</td>
                    </tr>
              		<tr>
              		  <td></td>
           		  </tr>
              		<tr>
              		  <td></td>
           		  </tr>
                </table>
              </form>
              
              <form name="form2" id="form2" method="GET">
              <br />
                <table align="center" width="100%" >
              <tr class="tablas_listados_encabezados" >
                          <td width="7%" align="center">N</td>
                          <td width="33%" align="center">Empresa</td>
                          <td width="10%" align="center">Banco</td>
                          <td width="10%" align="center">Monto</td>
                          <td width="10%" align="center">Fecha</td>
                          <td width="15%" align="center">Sucursal</td>
                          <td width="15%"  align="center">Opciones</td>
                      </tr>
                      <?php
                      	echo $imprimir;
                      ?>
                      </table>
              </form>
              
              
              <!-- LEYENDE DE LOS ICONOS-->
              <div align="center">
                    <table width="200" border="0">
                      <tr>
                        <td class="tablas_listados_encabezados_sub">Descripcion</td>
                         <td class="tablas_listados_encabezados_sub">Imagen</td>
                          </tr>
                      <tr>
                        <td class="form_label">Buscar</td>
                        <td class="form_label"><div align="center"><img src="../images/view.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Descargar PDF</td>
                        <td class="form_label"><div align="center"><img src="../images/icono_pdf.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Limpiar Formulario</td>
                        <td class="form_label"><div align="center"><img src="../images/limpiar.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Cheque Anulado</td>
                        <td class="form_label"><div align="center"><img src="../images/inactivo.png" width="16" height="16" /></div></td>
                          </tr>
                      <tr>
                        <td class="form_label">Anular Cheque</td>
                        <td class="form_label"><div align="center"><img src="../images/delete.png" width="16" height="16" /></div></td>
                          </tr>
                          
                      </table>    
                  </div>
                  <p>&nbsp;</p>
                </tr>
                    <p>&nbsp;</p></td>
                  </tr>
                </table>
                
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
            </div>
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
