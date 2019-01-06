<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');

//LLAMADO DE LAS CLASES NECESARIAS////
$obj_sucursal=new class_sucursal;
$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle= new class_control_salida_detalle;
$obj_transportista= new class_transportista;
$obj_empresa= new class_empresa;
$obj_estado= new class_estado;
$obj_zona= new class_zona;
$fecha=date('d-m-Y');
$fecha_desde=$_REQUEST['fecha_desde'];
$fecha_hasta=$_REQUEST['fecha_hasta'];

$estado=$_REQUEST['estado'];
$ciudad=$_REQUEST['ciudad'];
// valor inicial de ruta la variable quiery q va a ayudar a buscar 

//hacemos el proceso de carga de data de la zona
if($estado!=0 && $ciudad=='0'){//si no hay zona pero si estado
 //si hay estado bucamos las zonas de este estado
 $arr_zona=$obj_zona->get_zona('','',$estado);
 //recorremos este arreglo
 for($i=0;$i<sizeof($arr_zona);$i++){
	if($i==0){///if $i =0
		$ruta=" AND ( ruta LIKE '%".$arr_zona[$i]['descripcion']."%' ";
	}
	else{
		$ruta.=" OR ruta LIKE '%".$arr_zona[$i]['descripcion']."%' ";
	}
 }
 $ruta.=" ) ";
}
if($ciudad!='0'){
	$ruta=" AND ( ruta LIKE '%".$ciudad."%' )";
}


$id=$_REQUEST['id'];
if(inList($_SESSION['id_tipo_usuario'],'1,2')){		$id_sucursal=$_SESSION['id_sucursal'];	}
else{	$id_sucursal=$_REQUEST['id_sucursal'];	}
$tipo=$_REQUEST['tipo'];

if($_REQUEST['id_por_sucursal']!='0' && $_REQUEST['id_por_sucursal']!='No Guia') 
$id_por_sucursal=$_REQUEST['id_por_sucursal'];

if($_REQUEST['placa']!='0' && $_REQUEST['placa']!='Placa') 
$placa=$_REQUEST['placa'];

if($_REQUEST['transportista']!='0' && $_REQUEST['transportista']!='Transportista') 
$id_transportista=$_REQUEST['transportista'];


if($_REQUEST['empresa']!='0' && $_REQUEST['empresa']!='Empresa') 
$id_empresa=$_REQUEST['empresa'];


$status=$_REQUEST['status'];

//listado de transportistas

$arr_transportista=$obj_transportista->get_transportista('','','','','','','',$_SESSION['id_sucursal']);

//listado de empresas
$arr_empresa=$obj_empresa->get_empresa('','','',$_SESSION['id_sucursal']);



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




if(!$id_por_sucursal)

$rango= " AND fecha >= '$r_desde' AND fecha <= '$r_hasta' ";

																
$arr_control_salida=$obj_control_salida->get_control_salida_list_xls($id,$id_sucursal,$tipo,$status,$id_por_sucursal,$rango,$placa,$id_transportista ,$id_empresa,$ruta);



$titulo='Listado de guias';	
$filename='listado_guias';
//die();
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
header("Content-disposition: attachment;filename=".$filename.".xls ");



?>
<style type="text/css">
<!--
.style4 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: small; color: #FFFFFF; }
.style7 {font-family: Arial, Helvetica, sans-serif; font-size: x-small; }
-->
</style>

<div align="center">
  <table class="tablas_listados"  border="1">
    <!--ENCABEZADOS-->
    <tr class="tabla_barra_opciones" >
      <td colspan="11" align="left" bgcolor="#CCCCCC"><span class="form_titulo"><?php echo $titulo; 
							  
						?></span></td>
    </tr>
    <tr>
      <td height="10" colspan="11"></td>
    </tr>
    <tr class="tablas_listados_encabezados">
      <td width="4%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">No</div></td>
      <td width="8%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Guia</div></td>
      <td width="11%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Fecha</div></td>
      <td width="11%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Factura IVA</div></td>
      <td width="11%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Factura Transportado</div></td>
      <td width="11%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Flete</div></td>
      <td width="11%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Placa</div></td>
      <td width="15%" bordercolor="#000000" bgcolor="#FFCC00" ><div align="center" class="style4">Chofer</div></td>
      <td width="48%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Factura / Status</div></td>
      <td width="14%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Destino</div></td>
      <td width="14%" bordercolor="#000000" bgcolor="#FFCC00"  ><div align="center" class="style4">Estatus</div></td>
    </tr>
    <!--ENCABEZADOS-->
    <!--DATOS-->
    <?php 
										for($i=0; $i<sizeof($arr_control_salida); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
    <tr class="<?php echo $clase;?>">
      <td bordercolor="#000000" ><span class="style7"><?php echo $i+1; ?></span></td>
      <td bordercolor="#000000" ><span class="style7"><?php echo htmlentities($arr_control_salida[$i]['id_por_sucursal']); ?></span></td>
      <td bordercolor="#000000" ><span class="style7"><?php echo muestraFechaSola($arr_control_salida[$i]['fecha_salida'],'es'); ?></span></td>
      <td bordercolor="#000000"  align="right"><span class="style7"><?php echo number_format($arr_control_salida[$i]['monto_facturas']*1.09, 2, ',', '.') ;  ?>&nbsp;&nbsp;</span></td>
      <td bordercolor="#000000"  align="right"><span class="style7"><?php echo  number_format($arr_control_salida[$i]['monto_facturas'], 2, ',', '.');  ?>&nbsp;&nbsp;</span></td>
      <td bordercolor="#000000"  align="right"><span class="style7">
       <?php $monto_guia=$arr_control_salida[$i]['monto']+$arr_control_salida[$i]['desvio_monto']+$arr_control_salida[$i]['desvioc_monto']+$arr_control_salida[$i]['caleta']+$arr_control_salida[$i]['caleta_especial']+$arr_control_salida[$i]['devolucion_monto']+$arr_control_salida[$i]['reparto_monto']+$arr_control_salida[$i]['repartol_monto']; 
                                  $total_monto=$total_monto+$monto_guia; 
                                  echo number_format($monto_guia, 2, ',', '.');?>&nbsp;&nbsp;
      </span></td>
      <td bordercolor="#000000" ><span class="style7"><?php echo $arr_control_salida[$i]['placa']; ?></span></td>
      <td bordercolor="#000000" ><span class="style7"><?php echo htmlentities($arr_control_salida[$i]['t_nombre'].' '.$arr_control_salida[$i]['t_apellido']); ?></span></td>
      <td bordercolor="#000000" ><span class="style7">
        <?php 
			echo delCharEnd($string=$obj_control_salida_detalle->get_control_salida_string_xls($arr_control_salida[$i]['id']),2);
		?>
      </span></td>
      <td bordercolor="#000000"><span class="style7"><?php echo $arr_control_salida[$i]['ruta']; ?></span></td>
      <td bordercolor="#000000"><span class="style7">
      <?php if($arr_control_salida[$i]['status']==1) { echo "Activo";  }	
	  		if($arr_control_salida[$i]['status']==2) { echo "Anulado" ; } 
			if($arr_control_salida[$i]['status']==3) { echo "Liquidado"; }  
			if($arr_control_salida[$i]['status']==4) { echo "Pagada" ;} 
		?>        
      </span></td>
    </tr>
    <?php } ?>
    <tr><td><?php echo $i; ?></td></tr>
    <!--DATOS-->
    <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
  </table>
  <p>&nbsp;</p>
</div>
