<?php
include("../lib/core.lib.php");
if(inList($_SESSION['usuario'],'')) header('Location: ../lib/common/logout.php');
//DECLARACION DE LLAMADAS DE CLASES NECESARIAS 
$pdf=new PDF();//CLASE Q MANEJARA LOS FPDF
$obj_not_ent= new class_not_ent();//llamado de notas de entrega
$obj_reng_nde= new class_reng_nde();//renglones de notas de entrega
$obj_general= new class_general();//general
$obj_art= new class_art();//articulo
$obj_st_almac= new class_st_almac();//st_alma
$obj_pistas= new class_pistas();//pistas


$fact_num=$_REQUEST['fact_num'];

//CONSULTA DE LA INFORMACION
$arr_not_ent=$obj_not_ent->get_not_ent_imp($fact_num);
$arr_reng_nde=$obj_reng_nde->get_reng_nde_list_imp($fact_num);
//OBRTENIENDO LOS DATOS

//DATOS COMO TAL YA DEFINIDOS PARA LA NOTA DE ENTREGA
//$fecha=muestrafecha($arr_not_ent[0]['fec_emis'],'es');//fecha de creacion
$fecha=$arr_not_ent[0]['fec_emis'];//fecha de creacion
$transporte=utf8_decode($arr_not_ent[0]['des_tran']);//nombre de la emnpresa de transporte
$detalle=utf8_decode($arr_not_ent[0]['descrip']);//descripcion de la nota de entrega
$cliente=utf8_decode($arr_not_ent[0]['cli_des']);//cliente
$cliente_rif=$arr_not_ent[0]['rif'];//cliente_rif
$cliente_nit=$arr_not_ent[0]['nit'];//cliente_nit
$cliente_direccion=$arr_not_ent[0]['direc1'];//cliente direccion
$cliente_tel=$arr_not_ent[0]['telefonos'];//cliente telefonos
$cliente_fax=$arr_not_ent[0]['fax'];//cliente fax
$vendedor_cod=$arr_not_ent[0]['co_ven'];//venddedor codigo
$vendedor_des=$arr_not_ent[0]['ven_des'];//venddedor descripcion
$condicion_pago=$arr_not_ent[0]['cond_des'];//condicion de pago
//DATOS COMO TAL YA DEFINIDOS PARA LA NOTA DE ENTREGA

ob_end_clean();
$pdf->SetMargins(15,20,20);

$pdf->AddPage();
$link='reporte_nota_entrega.php';

//LLAMAMOS LOS DATOS DE EL ENCABEZADO
$pdf->dataNotEntEnc($fact_num,$fecha,$cliente,$cliente_rif,$cliente_nit,$cliente_direccion,$cliente_tel,$cliente_fax,$vendedor_cod,$vendedor_des,$condicion_pago,$link);
//llmamamos los datos de detalle de cada factura
	
for($i=0; $i<sizeof($arr_reng_nde); $i++){
	//llamamos a la creacion de la tala de detalle de esta nota
	$pdf->dataNotEntDet($arr_reng_nde[$i]['co_art'],$arr_reng_nde[$i]['art_des'],$arr_reng_nde[$i]['total_art'],$arr_reng_nde[$i]['prec_vta'],$arr_reng_nde[$i]['reng_neto'],$i);
	$monto_sin_iva+=$arr_control_salida_detalle[$i]['monto_factura'];
}
$pdf->dataNotEntPie($monto_sin_iva,$transporte,$detalle);


$pdf->Output();
?> 