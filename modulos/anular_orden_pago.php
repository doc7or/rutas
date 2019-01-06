<?php 
/*
*Desarrollador: Mervin Mujica
*Fecha: 3-8-2011
*/
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/cheques.class.php");
include("../lib/core.lib.php");
//require(APPROOT."lib/class/sucursal.class.php");
//require(APPROOT."lib/class/usuario.class.php");
//require(APPROOT."lib/class/usuario_tipo.class.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
//echo "post  ".$_POST["num_cheque"];
$cheques=new class_cheque();
if (trim($_POST["num_cheque"])!='' && $_POST["boton"]==1){
	
	$cheque_valores=$cheques->get_cheque($_POST["num_cheque"]);
	//echo $cheque_valores[0]['id_sucursal'];
	if ($cheque_valores!=0){
		$sucursal=new class_sucursal();
		$sucursal_valores=$sucursal->get_sucursal($cheque_valores[0]['id_sucursal']);
		
		switch ($cheque_valores[0]['status']){
			case 0:$estado='<span style="color:green;">Valido</span>';break;
			case 1:$estado='<span style="color:orange;">Anulado</span>';break;
		}
		
		$imprimir='<tr class="tablas_listados_encabezados"><td>Numero</td><td>Banco</td><td>Monto</td><td>Empresa</td><td>Observaciones</td><td>Estado</td><td>Fecha</td></tr>';
		$imprimir.='<tr class="form_label"><td>'.$cheque_valores[0]['num_cheque'].'</td><td>'.$cheque_valores[0]['banco'].'</td><td>'.$cheque_valores[0]['monto'].'</td><td>'.$sucursal_valores[0]['descripcion'].'</td><td>'.$cheque_valores[0]['observaciones'].'</td><td>'.$estado.'</td><td>'.$cheque_valores[0]['fecha'].'</td></tr>';
		if ($cheque_valores[0]['status']==0)$imprimir.='<tr class="form_label"><td colspan="7" align="center"><input style="width:150px;height:50px;font-weight:bold;" type="button" name="anular_cheq" id="anular_cheq" value="Anular Cheque" onclick="enviar_Formulario(2,\'num_cheque_escon\');"><input type="hidden" name="num_cheque_escon" id="num_cheque_escon" value="'.$cheque_valores[0]['num_cheque'].'"></td></tr>';
	
	}else{
		$imprimir='<h3>El Cheque N-'.$_POST["num_cheque"].' No fue Encontrado</h3>';
	}
}

if ($_POST["boton"]==2){
	$result=$cheques->consulta_Sql_Cheque('update cheques set status=1 where num_cheque='.$_POST["num_cheque_escon"]);
	$cheque_valores=$cheques->get_cheque($_POST["num_cheque_escon"]);
	if ($cheque_valores[0]['status']==1){
		$imprimir='<h3>El Cheque N-'.$_POST["num_cheque_escon"].' Fue ANULADO</h3>';
	}else{
		$imprimir='<h3>Error al Anular el Cheque N-'.$_POST["num_cheque_escon"].'</h3>';
	}
}
$titulo='Anular Orden de Pago';
$forma='nomina.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>

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
              <input type="hidden" name="boton" id="boton" value="1">
               <table border="0">
               	 <tr><td class="form_label">Ingrese el Numero de Cheque:</td><td><input type="text" name="num_cheque" id="num_cheque"></td><td><img onclick="enviar_Formulario(1,'num_cheque')" style="border: medium none; cursor: pointer;" alt="Buscar" title="Buscar listado de Ordenes de Pago " src="../images/view.png"></td></tr>
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
