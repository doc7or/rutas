<?php
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,6')) header('Location: ../lib/common/logout.php');
//DECLARACION DE LLAMADAS DE CLASES NECESARIAS 
$pdf=new PDF();//CLASE Q MANEJARA LOS FPDF
$obj_sucursal=new class_sucursal;
$obj_vehiculo= new class_vehiculo;
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
$transporte=utf8_decode($arr_empresa[0]['id']);//nombre de la emnpresa de transporte
//$chofer=utf8_decode($arr_transportista[0]['nombre'].' '.$arr_transportista[0]['apellido']);//telefono transportistas
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
$caleta_c=$arr_control_salida[0]['caja_caleta'];
$caleta_p=$arr_control_salida[0]['caleta']-$caleta_c;
$desvio_monto=$arr_control_salida[0]['desvio_monto'];
$observaciones=$arr_control_salida[0]['observaciones'];


ob_end_clean();
$pdf->SetMargins(15,20,20);
//utf8_decode('');
$pdf->AddPage();
$link='forma_guia_transporte_list.php?id='.$arr_control_salida[0]['id'].'&tipo=1';

if ($arr_control_salida[0]['id_sucursal']==2){
	//llamamos nuevamente al encabezado de imagen
	$pdf->headerImagen($num_guia,$link);
}

$pdf->dataControlEncabezado($num_guia,$fecha[0],$transporte,$chofer,$telefonos_chofer,$placa,$vehiculo,$destino,$desvio,$link);
//llmamamos los datos de detalle de cada factura
	
for($i=0; $i<sizeof($arr_control_salida_detalle); $i++){
	//die($arr_control_salida_detalle[$i]['id_factura'].'---'.$arr_control_salida_detalle[$i]['monto_factura'].'---'.$arr_control_salida_detalle[$i]['cliente'].'---'.$i);
	$det_fact=$arr_control_salida_detalle[$i]['id_factura'];
        //SE COMENTA YA QUE LAS FACTURAS VAN MANUAL Y NO SE COLOCA EL PREFIJO DE LA SUCURSAL
        /*	if($_SESSION['valor_num_prefijo'])
	{
		$factura_id = substr ($det_fact, 2);    // devuelve la factura sin el valor numerico de la sucursal
		//$factura_mascara = substr ($det_fact, 0, 2); // devuelve la mascara numerica de la sucursal esto retorna el valor del string numerico , pero como ese valor ya sabemos es el mismo de la sucursal la mascara va a ser el valor de su prefijo osea la factura a imprimir ser a igual a $_SESSION['prefijo'].fatura_id
	}else{
		$factura_id = substr ($det_fact, 0);
	}
	$factura_mascara = $_SESSION['prefijo'];
	$factura_print=$factura_mascara.$factura_id ;
 */
        $factura_print=$det_fact ;// SE COLOCA EL NUMERO COMPLERTO DE LA FACRTURA HASTA QUE HAYA CONEXION CON EL SISTEMA Y SE PUEDA CONSULTAR
	//die('esta es la guardada'.$det_fact.'  esta es la mascara '.$factura_mascara.'  esta es el resto '.$factura_id .'  este es el valor final que se va a imprimir '.$factura_print);
	
	$pdf->dataControlDetalle($factura_print,$arr_control_salida_detalle[$i]['monto_factura'],$arr_control_salida_detalle[$i]['cliente'],$i);
	$monto_sin_iva+=$arr_control_salida_detalle[$i]['monto_factura'];
}
$pdf->dataControlDetalleTotalizador($monto_sin_iva);
$pdf->dataControlPie($flete,$adelanto,$caleta_c,$caleta_p,$desvio_monto,$observaciones);


/*if ($arr_control_salida[0]['id_sucursal']==2){
	//llamamos nuevamente al pie de imagen
	$pdf->footerImagen();
}*/

$pdf->Output();
?> 