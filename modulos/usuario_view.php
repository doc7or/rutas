<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$id=$_REQUEST['id'];
$obj_usuario= new class_usuario;
$obj_log = new class_log;
$arr_usuario=$obj_usuario->get_list_usuario($id);
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=18;
	$id_registro=$id;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=11;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);

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
                    <td colspan="6"><table class="tabla_opciones" >
                        <tr >
                          <td width="72%">&nbsp;</td>
                          <td width="28%"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="20%" >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%" ><a href="usuario_list.php" ><img  src="../images/listado.png"  title="Volver al listado de usuarios" alt="Volver al listado"  style="border:none" /></a></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_maestros" >
                        <tr >
                          <td  colspan="2" class="form_titulo_acme"  align="center">Usuario</td>
                        </tr>
                        <tr >
                          <td  colspan="2" height="10" ></td>
                        </tr>
                        <tr >
                          <td width="150" class="form_label">Cedula :</td>
                          <td ><div class="form_label_view" > <?php echo $arr_usuario[0]['cedula'];?> </div></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Nombre :</td>
                          <td ><div class="form_label_view" > <?php echo $arr_usuario[0]['nombre'];?> </div></td>
                        </tr>
                        <tr>
                          <td  class="form_label">Apellido :</td>
                          <td><div class="form_label_view" > <?php echo $arr_usuario[0]['apellido'];?> </div></td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Usuario :</td>
                          <td><div class="form_label_view" > <?php echo $arr_usuario[0]['login'];?> </div></td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Email :</td>
                          <td><div class="form_label_view" > <?php echo $arr_usuario[0]['email'];?> </div></td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Tipo :</td>
                          <td><div class="form_label_view" > <?php echo $arr_usuario[0]['tipo_usuario'];?> </div></td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Almacen de sucursal :</td>
                          <td><div class="form_label_view" > <?php echo $arr_usuario[0]['sucursal'];?> </div></td>
                        </tr>
                        <tr class="error_mesaje_acme" >
                          <td  colspan="2" align="center"  ></td>
                        </tr>
                        <tr >
                          <td  colspan="2" height="10" ></td>
                        </tr>
                        <tr >
                          <td  colspan="2" height="10" ></td>
                        </tr>
                    </table></td>
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
