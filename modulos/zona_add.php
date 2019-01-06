<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,6')) header('Location: ../lib/common/logout.php');
$obj_zona= new class_zona;
if(inList($_SESSION['id_tipo_usuario'],'1')) $status='1';
else $status='0,1';
$arr_zona=$obj_zona->get_list_zona('');
$obj_estado= new class_estado;
$arr_estado= $obj_estado -> get_estado('');
$obj_log = new class_log;
$obj_sucursal= new class_sucursal;
$obj_vehiculo_tipo= new class_vehiculo_tipo;
$obj_tabulador_costo= new class_tabulador_costo;

//inserciond e zonas
if($_REQUEST['accion']){
	//die('vamos bien');
	$descripcion=$_REQUEST['descripcion'];
	$id_estado=$_REQUEST['id_estado'];
	
	$res_add_zona=$obj_zona->add_zona($descripcion,$id_estado);
	
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=18;
	$id_registro=$res_add_zona;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=15;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);

	//ESTA ES UNA OPCION QUE SE CREARA AUTOMATICAMENTE CUANDO SE CRREE UNA ZONA SE CREARAN LOS DIFERENTES TABULADORES DE COSTOS PARA LAS DIREFENTES SUCAURSALES Y TIPOS DE ITENS (tipos de vehiculos, escoltas)
	
	$arr_sucursal= $obj_sucursal ->get_sucursal();
	$arr_item= $obj_vehiculo_tipo ->get_item();
	//for por zonas
	for($i=0;$i<sizeof($arr_sucursal);$i++){
		for($j=0;$j<sizeof($arr_item);$j++){
			$obj_tabulador_costo->add_tabulador_costo($id_registro,$arr_sucursal[$i]['id'],$arr_item[$j]['id'],$costo=0);
		}
	}

	header('Location: zona_list.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="Last-Modified" content="0"> 
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate"> 
<meta http-equiv="Pragma" content="no-cache">

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
                                <td width="20%" ><a href="zona_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
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
                          <td  colspan="3" class="form_titulo_acme"  align="center">Agregar Zona Nuevo</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="210"></td>
                          <td ></td>
                        </tr>
                        <tr >
                          <td  class="form_label" height="10">Nombre :</td>
                          <td ><input name="descripcion" id="descripcion" type="text" class="form_caja"  maxlength="50" onfocus="message_help(12)" onchange="existence('zona','descripcion','descripcion','id','','id_estado','id_estado','','')" onkeypress="return acceptAlfaNombres(event)"/>
                          </td>
                          <td rowspan="3"  class="tr_mensaje_ayuda" id="tr_message"></td>
                        </tr>
                        <tr>
                          <td  class="form_label"  height="10">Estado :</td>
                          <td><select name="id_estado" id="id_estado" class="form_pool" onfocus="message_help(0)" onchange="existence('zona','descripcion','descripcion','id','','id_estado','id_estado','','')">
                              <option value="0">Seleccione...</option>
                              <?php  
                                                for ($i=0; $i<sizeof($arr_estado);$i++) { ?>
                              <option value="<?php echo $arr_estado[$i]['id']; ?>"> <?php echo $arr_estado[$i]['descripcion'];?> </option>
                              <?php }?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"></td>
                        </tr>
                        <tr>
                          <td  colspan="2" align="center"  ><input type="hidden" id="accion" name="accion" value="" /></td>
                        </tr>
                        <tr  class="error_mesaje_acme" >
                          <td  colspan="3" height="10"   id="mensaje_error" ></td>
                        </tr>
                        <tr>
                          <td  colspan="3" align="center" ><script type="text/javascript">
												//DECLARACION DE ARAY DEL FORM
												
												var myForm='form1'; // nombre del forulario
												var myPase='accion';//campo que se usa para el pase seguro
												var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
												my_form_column = new Array();			my_form_tipo = new Array();
												my_form_column[0]='descripcion';		my_form_tipo[0]=11;
												my_form_column[1]='id_estado';			my_form_tipo[1]=1;
											
											
												
												
                                            </script>
                              <input name="save" type="button" class="form_botones" id="save" style="cursor:hand" value="Agregar" onclick="valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage)" />
                          </td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" id="load_datos_help" ></td>
                        </tr>
                        <tr >
                                      <td  colspan="3" height="10"  id="campo de mensajes" align="justify">
                                      <font color="#000000" style="font-weight:bold; font-size:9px">Importante:</font> <font color="#FF0000" style=" font-size:9px">Este proceso de creaci&oacute;n de zonas es esta  vinculado directamente los valores de tabulador, de lo cual se desprende que al  finalizar esta creaci&oacute;n debe dirigirse; al modulo de tabulador, donde deber&aacute; editar  el tabulador de esta zona para cada tipo de vehicul&oacute;, motivado a que el valor por  defecto ser&aacute; 0 (cero) Bfs. </font>                                      </td>
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
