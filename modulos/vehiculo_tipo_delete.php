<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,6')) header('Location: ../lib/common/logout.php');
$id=$_REQUEST['id'];
$obj_vehiculo= new class_vehiculo;
$obj_vehiculo_tipo= new class_vehiculo_tipo;
$arr_vehiculo_tipo = $obj_vehiculo_tipo->get_vehiculo_tipo($id);
$obj_empresa= new class_empresa;
$arr_empresa = $obj_empresa->get_empresa();
$obj_log = new class_log;


if($_REQUEST['acc']=='del'){

	$del_vehiculo_tipo=$obj_vehiculo_tipo->delete_vehiculo_tipo($id);
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=19;
	$id_registro=$id;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=14;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
	header('Location: vehiculo_tipo_list.php');
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
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>

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
                                <td width="20%" ><a href="vehiculo_tipo_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
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
                          <td  colspan="3" class="form_titulo_acme"  align="center">Eliminar Tipo de Vehículo</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="358"></td>
                          <td width="3" ></td>
                      </tr>
                        <tr >
                          <td  class="form_label">Nombre :</td>
                          <td >
                              <div class="form_label_view" > <?php echo $arr_vehiculo_tipo[0]['descripcion'];?> </div>
                                                 </td>
                         
                        </tr>
                        <tr >
                          <td  class="form_label">Detalle :</td>
                          <td >
                          	<div class="form_label_view" > <?php echo $arr_vehiculo_tipo[0]['detalle'];?> </div>
                          </td>
                        </tr>
                        <tr >
                          <td  class="form_label">Caleta :</td>
                          <td >
                          <div class="form_label_view" > <?php echo $arr_vehiculo_tipo[0]['caleta'];?> </div>
                                                  </td>
                        </tr>
                        <tr >
                          <td  class="form_label">m3 Min:</td>
                          <td >
                          <div class="form_label_view" > <?php echo $arr_vehiculo_tipo[0]['metraje_min'];?> </div>
                                                </td>
                        </tr>
                        <tr >
                          <td  class="form_label">m3 Max :</td>
                          <td >
                          <div class="form_label_view" > <?php echo $arr_vehiculo_tipo[0]['metraje_max'];?> </div>
                                                   </td>
                        </tr>
                        <tr class="error_mesaje_acme" >
                          <td  colspan="2" align="center"  ></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" ></td>
                        </tr>
                       <tr >
                                        <td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td  colspan="3" align="center" ><input name="Eliminar" type="button" class="form_botones" id="Eliminar" style="cursor:hand" value="Eliminar" onclick="confirmDelete('este tipo de vehiculo', '?id=<?php echo $id; ?>&amp;acc=del')"/></td>
                                    </tr>
                                    <tr >
                                      <td  colspan="3" height="10" id="load_datos_help" ></td>
                                    </tr>
                                    <tr >
                                      <td  colspan="3" height="10"  id="campo de mensajes" align="justify">
                                     
                                      </td>
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
