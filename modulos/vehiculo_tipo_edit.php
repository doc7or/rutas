<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'6')) header('Location: ../lib/common/logout.php');
$id=$_REQUEST['id'];
$obj_vehiculo= new class_vehiculo;
$obj_vehiculo_tipo= new class_vehiculo_tipo;
$arr_vehiculo_tipo = $obj_vehiculo_tipo->get_vehiculo_tipo($id);
$obj_empresa= new class_empresa;
$arr_empresa = $obj_empresa->get_empresa();
$obj_log = new class_log;

if($_REQUEST['accion']){
	//die('vamos bien');
	$descripcion=$_REQUEST['descripcion'];
	$detalle=$_REQUEST['detalle'];
	$caleta=$_REQUEST['caleta'];
	$metraje_min=$_REQUEST['metraje_min'];
	$metraje_max=$_REQUEST['metraje_max'];
	
	$res_add_vehiculo_tipo=$obj_vehiculo_tipo->update_vehiculo_tipo($id,$descripcion,$detalle,$caleta,$metraje_min,$metraje_max);
	
	
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=17;
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
                          <td  colspan="3" class="form_titulo_acme"  align="center">Agregar Tipo de Vehículo</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="210"></td>
                          <td ></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Nombre :</td>
                          <td ><input name="descripcion" type="text" class="form_caja" id="descripcion"  maxlength="4" onchange="existence('vehiculo_tipo','descripcion','descripcion','id','<?php echo $arr_vehiculo_tipo[0]['id']; ?>','','','','')"  onfocus="message_help(26)" onkeypress="return acceptNumAlfa(event)" value="<?php echo $arr_vehiculo_tipo[0]['descripcion']; ?>"/>                          </td>
                          <td  rowspan="5"  class="tr_mensaje_ayuda"  id="tr_message"></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Detalle :</td>
                          <td ><textarea name="detalle" class="form_text" id="detalle"  onfocus="message_help(34)" ><?php echo $arr_vehiculo_tipo[0]['detalle']; ?></textarea>                          </td>
                        </tr>
                        <tr >
                          <td  class="form_label">Caleta :</td>
                          <td ><input name="caleta" type="text" class="form_caja" id="caleta"  maxlength="50"  onfocus="message_help(35)" value="<?php echo $arr_vehiculo_tipo[0]['caleta']; ?>" />                          </td>
                        </tr>
                        <tr >
                          <td  class="form_label">m3 Min:</td>
                          <td ><input name="metraje_min" type="text" class="form_caja" id="metraje_min"  maxlength="3"  onfocus="message_help(36)" value="<?php echo $arr_vehiculo_tipo[0]['metraje_min']; ?>" />                          </td>
                        </tr>
                        <tr >
                          <td  class="form_label">m3 Max :</td>
                          <td ><input name="metraje_max" type="text" class="form_caja" id="metraje_max"  maxlength="3"  onfocus="message_help(37)"  value="<?php echo $arr_vehiculo_tipo[0]['metraje_max']; ?>" />                          </td>
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
                                        <td  colspan="3" align="center" >
                                       
                                             <input name="save" type="button" class="form_botones" id="save" style="cursor:hand" value="Editar"   onclick="cargaMyForm()"/>                                     </td>
                                    </tr>
                                    <tr >
                                      <td  colspan="3" height="10" id="load_datos_help" ></td>
                                    </tr>
                                    <tr >
                                      <td  colspan="3" height="10"  id="campo de mensajes" align="justify">
                                      <font color="#000000" style="font-weight:bold; font-size:9px">Importante:</font> <font color="#FF0000" style=" font-size:9px">Este proceso de creaci&oacute;n de tipos de veh&iacute;culos es esta  vinculado directamente los valores de tabulador, de lo cual se desprende que al  finalizar esta creaci&oacute;n debe dirigirse; al modulo de tabulador, donde deber&aacute; editar  el tabulador de este vehicul&oacute; para cada zona, motivado a que el valor por  defecto ser&aacute; 0 (cero) Bfs. </font>
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
  <script type="text/javascript">
		//DECLARACION DE ARAY DEL FORM
		function cargaMyForm(){
			
				//DECLARACION DE ARAY DEL FORM
						
				var myForm='form1'; // nombre del forulario
				var myPase='accion';//campo que se usa para el pase seguro
				var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
				my_form_column = new Array();		my_form_tipo = new Array();
				my_form_column[0]='descripcion';	my_form_tipo[0]=1;
				my_form_column[1]='detalle';		my_form_tipo[1]=1;
				my_form_column[2]='caleta';			my_form_tipo[2]=1;
				my_form_column[3]='metraje_min';	my_form_tipo[3]=1;
				my_form_column[4]='metraje_max';	my_form_tipo[4]=1;
					
			valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
		}
		
		
	</script>
</html>
