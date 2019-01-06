<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$obj_vehiculo= new class_vehiculo;
$obj_vehiculo_tipo= new class_vehiculo_tipo;
$arr_vehiculo_tipo = $obj_vehiculo_tipo->get_list_vehiculo_tipo();
$obj_empresa= new class_empresa;
$arr_empresa = $obj_empresa->get_empresa();

//insercion de vehiculos
if($_REQUEST['save']){
	//die('vamos bien');
	$placa=$_REQUEST['placa'];
	$id_tipo=$_REQUEST['id_tipo'];
	$id_empresa=$_REQUEST['id_empresa'];
	$res_add_vehiculo=$obj_vehiculo->add_vehiculo($placa,$id_tipo,$id_empresa);
	header('Location: vehiculo_list.php');
}
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

    <div id="contenedor" >
		  <div id="header" ></div>
  <div id="menu" >
          	<?php include ("../lib/common/menu_superior.php");?>
          </div>
		  <div id="contenido" > 
          	<div id="menu_visual" ></div>
            <div id="espacio_trabajo" >
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
			  <form name="form1" id="form1" action="" method="post"  >
   				<br />
				  <table align="center" width="80%" >
						
                        <tr class="tabla_barra_opciones" >
                          <td colspan="6"><div align="center">
                            <table class="tabla_opciones" >
                              <tr >
                                <td width="46%"><div align="center"></div></td>
                                <td width="54%"><div align="center"></div></td>
                              </tr>
                              <tr >
                                <td><div align="center"><a href="vehiculo_list.php"><img src="../images/ico_vehiculo2.png" width="84" height="84" /></div></td>
                                <td><div align="center"><a href="vehiculo_tipo_list.php"><img src="../images/ico_tipo_vehiculo.png" width="84" height="84" /></a></div></td>
                                </tr>
                            </table>
                          </div></td>
                        </tr>
						
						<tr>
							<td  colspan="2" align="left">&nbsp;</td>
					</tr>
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
