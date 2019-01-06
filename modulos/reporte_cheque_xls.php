<?php
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/cheques.class.php");
include("../lib/core.lib.php");
//if(!inList($_SESSION['id_tipo_usuario'],'2,3,4,6')) header('Location: ../lib/common/logout.php');

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



$titulo='Reporte de Cheques';
	header("Content-Type: application/vnd.ms-excel");
	header("Content-disposition: attachment;filename=nomina_transportistas_reducido.xls ");

header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
?>
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
