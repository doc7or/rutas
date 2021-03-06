<?php
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,6')) header('Location: ../lib/common/logout.php');
if(($_SESSION['id_tipo_usuario']!=1 && $_SESSION['id_tipo_usuario']!=2) || $_SESSION['id_tipo_usuario']=='') header('Location: ../lib/common/logout.php');
//DECLARACION DE LLAMADAS DE CLASES NECESARIAS 
$pdf=new PDF_NOTA();//CLASE Q MANEJARA LOS FPDF
$obj_vehiculo= new class_vehiculo;
$obj_sucursal=new class_sucursal;
$obj_empresa= new class_empresa;
$obj_escolta= new class_escolta;
$obj_transportista= new class_transportista;
$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle= new class_control_salida_detalle;

$id_control_salida=$_REQUEST['id'];

//CONSULTA DE LA INFORMACION
$arr_control_salida=$obj_control_salida->get_control_salida($id_control_salida);
$arr_transportista=$obj_transportista->get_transportista($arr_control_salida[0]['id_transportista']);
$arr_empresa=$obj_empresa->get_empresa($arr_transportista[0]['id_empresa']);
//OBRTENIENDO LOS DATOS

//obtenemos el numero a mostrar de la guia
//$num_guia=$arr_control_salida[0]['id_por_sucursal'];//numero correlativo de cada sucursal
	//buscamos el prefijo de la sucursal
		$arr_sucursal=$obj_sucursal->get_sucursal($arr_control_salida[0]['id_sucursal']);
		$linea=$arr_sucursal[0]['prefijo'];
	//decidimos si imprimimos la nueva numeracion o la vieja
	if ($arr_control_salida[0]['id_sucursal']!=2){
		if($arr_control_salida[0]['id_por_sucursal_new']){
			//completaSpaciosStrins($str,$cuantos,$valor,$pos)
			$numero_formateado=completaSpaciosStrins(0,4,$arr_control_salida[0]['id_por_sucursal_new'],'1');
			
			$num_guia=$linea.' '.$numero_formateado;//numero correlativo de cada sucursal
		}else{
			$num_guia=$arr_control_salida[0]['id_por_sucursal'];//numero correlativo de cada sucursal	
		}
	}
	else
		$num_guia=$arr_control_salida[0]['id_por_sucursal'];//numero correlativo de cada sucursal 
//fin de encontrar en numero de quia

$fecha=split(' ',muestrafecha($arr_control_salida[0]['fecha_salida'],'es'));//fecha de creacion
$transporte=utf8_decode($arr_empresa[0]['descripcion']);//nombre de la emnpresa de transporte
$chofer=utf8_decode(strtoupper ($arr_transportista[0]['apellido'].' '.$arr_transportista[0]['nombre']));//telefono transportistas
$chofer_rif=utf8_decode(strtoupper($arr_transportista[0]['rif']));
$telefonos_chofer=$arr_transportista[0]['telefono'].'    '.$arr_transportista[0]['telefono2'];//telefonos transportista
$placa=$arr_control_salida[0]['placa'];//placa del vehiculo
$arr_vehiculo=$obj_vehiculo->get_list_vehiculo($placa,'','','',$_SESSION['id_sucursal']);//buscamos el vehiculo a partir de la placa
$vehiculo=$arr_vehiculo[0]['detalle'];//tipo de vehiculo se selecciona el detalle para ser mas especifico
$destino=$arr_control_salida[0]['ruta'];//la ruta de el flete o control de salida
$desvio=$arr_control_salida[0]['desvio'];//desvio de el flete o control
//OBTENGO EL ARREGLO DE LAS FACTURAS
$arr_control_salida_detalle=$obj_control_salida_detalle->get_control_salida_detalle($arr_control_salida[0]['id']);

//pie
$flete=$arr_control_salida[0]['monto'];
$adelanto=$arr_control_salida[0]['caja_adelanto'];
$reparto_c=$arr_control_salida[0]['reparto_cantidad'];
$reparto_m=$arr_control_salida[0]['reparto_monto'];
$repartol_c=$arr_control_salida[0]['repartol_cantidad'];
$repartol_m=$arr_control_salida[0]['repartol_monto'];
$desvio_monto=$arr_control_salida[0]['desvio_monto'];
$desvioc_monto=$arr_control_salida[0]['desvioc_monto'];
$observaciones=$arr_control_salida[0]['observaciones'];


ob_end_clean();
$pdf->SetMargins(15,20,20);
//utf8_decode('');
$pdf->AddPage();
$link='forma_guia_transporte_list.php?id='.$arr_control_salida[0]['id'].'&tipo=3';

if ($arr_control_salida[0]['id_sucursal']==2){
	//llamamos nuevamente al encabezado de imagen
	$pdf->headerImagen($num_guia,$link);
}

$pdf->dataControlEncabezado($num_guia,$fecha[0],$transporte,$chofer,$telefonos_chofer,$placa,$vehiculo,$destino,$desvio,$link,$chofer_rif);
//llmamamos los datos de detalle de cada factura
	
for($i=0; $i<sizeof($arr_control_salida_detalle); $i++){
	//die($arr_control_salida_detalle[$i]['id_factura'].'---'.$arr_control_salida_detalle[$i]['monto_factura'].'---'.$arr_control_salida_detalle[$i]['cliente'].'---'.$i);
	$almacenes= split('---', $arr_control_salida_detalle[$i]['cliente']);
	$ori=$almacenes[0];
	$des=$almacenes[1];
	
	$pdf->dataControlDetalle($arr_control_salida_detalle[$i]['id_factura'],$des,$ori,$i);
	//$monto_sin_iva+=$arr_control_salida_detalle[$i]['monto_factura'];
}
//$pdf->dataControlDetalleTotalizador($monto_sin_iva);
$pdf->dataControlPie($flete,$adelanto,$reparto_c,$reparto_m,$repartol_c,$repartol_m,$desvio_monto,$desvioc_monto,$observaciones);

/*if ($arr_control_salida[0]['id_sucursal']==2){
	//llamamos nuevamente al pie de imagen
	$pdf->footerImagen();
}*/

$pdf->Output();
?> 