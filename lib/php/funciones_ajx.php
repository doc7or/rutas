<?php
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/cheques.class.php");
include("../lib/core.lib.php");
$opc=$_GET['opc'];

switch ($opc){
	case 1:
		anular_cheque($_GET["dat1"]);
		break;
	case 2:
		
		break;
}

function anular_cheque($id){
	$cheques=new class_cheque();
	$result=$cheques->consulta_Sql_Cheque('update cheques set status=1 where num_cheque='.$id);
	$cheque_valores=$cheques->get_cheque($id);
	if ($cheque_valores[0]['status']==1){
		echo 'alert*alert-html*El Cheque N-'.$id.' Fue ANULADO*<a href="javascript:return;"><img style="border: medium none;" alt="Eliminar" title="Eliminar" src="../images/inactivo.png"></a>';
	}else{
		echo "alert*alert*Error al Anular el Cheque N-$id";
	}
}
?>
