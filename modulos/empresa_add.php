<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,6')) header('Location: ../lib/common/logout.php');
$obj_empresa= new class_empresa;
$obj_cod_area_telefono = new class_cod_area_telefono;

$obj_log = new class_log;


//ADICION DE EMPRESAS
if($_REQUEST['accion']){
	//die('vamos bien');
	//direccion,rif,telefono,responsable,telefono2,naturaleza,tipo,adelanto,id_sucursal
	$rif=$_REQUEST['rif'];
	$descripcion=$_REQUEST['descripcion'];
	$direccion=$_REQUEST['direccion'];
	$telefono=$_REQUEST['cod_area'].'-'.$_REQUEST['telefono'];
	$telefono2=$_REQUEST['cod_area2'].'-'.$_REQUEST['telefono2'];
	$responsable=$_REQUEST['responsable'];
	$tipo=$_REQUEST['tipo'];
	$naturaleza=$_REQUEST['naturaleza'];
	$id_sucursal=$_SESSION['id_sucursal'];
	$adelanto=$_REQUEST['adelanto'];
	$especial=$_REQUEST['especial'];
	
	$res_add_empresa=$obj_empresa->add_empresa($descripcion,$direccion,$rif,$telefono,$responsable,$telefono2,$naturaleza,$tipo,$adelanto,$id_sucursal,$especial);
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=16;
	$id_registro=$res_add_empresa;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=2;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
	header('Location: empresa_list.php');
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
		  <div id="header" >
          
          </div>
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
                                <td width="20%" ><a href="empresa_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
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
                          <td  colspan="3" class="form_titulo_acme"  align="center">Agregar Empresa</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="210"></td>
                          <td ></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Rif:</td>
                          <td ><select name="naturaleza" id="naturaleza" class="form_pool_rif"  onfocus="message_help(14)"   onchange="existence('empresa','rif','rif','id','','naturaleza','naturaleza','id_sucursal','<?php echo $_SESSION['id_sucursal']?>')"  >
                              <option value="1">N</option>
                              <option value="2">J</option>
                              <option value="3" >V</option>
                            </select>
                            -
                            <input name="rif" type="text" class="form_caja_rif" id="rif"  maxlength="10"  onfocus="message_help(13)" onchange="existence('empresa','rif','rif','id','','naturaleza','naturaleza','id_sucursal','<?php echo $_SESSION['id_sucursal']?>')" onkeypress="return acceptNumRif(event)" />                          </td>
                          <td  rowspan="10"  class="tr_mensaje_ayuda"  id="tr_message"></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Nombre :</td>
                          <td ><input name="descripcion" type="text" class="form_caja" id="descripcion"  maxlength="50"  onfocus="message_help(17)"   />                          </td>
                        </tr>
                        <tr >
                          <td  class="form_label">Direcci&oacute;n :</td>
                          <td ><input name="direccion" type="text" class="form_caja" id="direccion"  maxlength="50"  onfocus="message_help(16)"   />                          </td>
                        </tr>
                      
                        <tr>
                          <td  class="form_label" >Telefono :</td>
                          <td>
                          <select name="cod_area" id="cod_area" class="form_pool_cod_area"  onfocus="message_help(18)"   >
                          	<?php
								$arr_cod_area_telefono=$obj_cod_area_telefono->get_cod_area_telefono();
								for ($i=0; $i<sizeof($arr_cod_area_telefono);$i++) { ?>
							  <option value="<?php echo $arr_cod_area_telefono[$i]['codigo']; ?>">
							  <?php echo $arr_cod_area_telefono[$i]['codigo'];?>                                              </option>
							  <?php }?>
                          </select>
-
<input name="telefono" type="text" class="form_caja_telefono" id="telefono"  maxlength="7"  onfocus="message_help(19)" onkeypress="return acceptNumRif(event)" /></td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Telefono 2 :</td>
                          <td>
                          <select name="cod_area2" id="cod_area2" class="form_pool_cod_area"  onfocus="message_help(18)"   >
                          <?php
								$arr_cod_area_telefono2=$obj_cod_area_telefono->get_cod_area_telefono();
								for ($i=0; $i<sizeof($arr_cod_area_telefono2);$i++) { ?>
							  <option value="<?php echo $arr_cod_area_telefono2[$i]['codigo']; ?>">
							  <?php echo $arr_cod_area_telefono2[$i]['codigo'];?>                                              </option>
							  <?php }?>
                          </select>
-
<input name="telefono2" type="text" class="form_caja_telefono" id="telefono2"  maxlength="7"  onfocus="message_help(19)" onkeypress="return acceptNumRif(event)" /></td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Responsable :</td>
                          <td><input name="responsable" type="text" class="form_caja" id="responsable"  maxlength="50"  onfocus="message_help(20)"   />                          </td>
                        </tr>
                        <tr>
                          <td  class="form_label">Tipo :</td>
                          <td><select name="tipo" id="tipo" class="form_pool"  onfocus="message_help(21)"  >
                              <option value="0">Seleccione...</option>
                              <option value="1">Transportista</option>
                              <option value="2">Escolta</option>
                            </select>                          </td>
                        </tr>
                        <tr>
                          <td  class="form_label">Adelanto :</td>
                          <td><select name="adelanto" id="adelanto" class="form_pool"  onfocus="message_help(22)"  >
                              <option value="0" selected="selected">0%</option>
                              <option value="20">20%</option>
                              <option value="40">40%</option>
                             
                            </select>                          </td>
                        </tr>
                         <tr>
                          <td  class="form_label">Especial :</td>
                          <td><select name="especial" id="especial" class="form_pool"  onfocus="message_help(23)"  >
                              <option value="0" selected="selected">0%</option>
                              <option value="20">20%</option>
                              <option value="40">40%</option>
                             
                            </select>                          </td>
                        </tr>
                        <tr >
                          <td  colspan="2" height="10" ></td>
                        </tr>
                        <tr class="error_mesaje_acme" >
                          <td  colspan="3" id="mensaje_error" ></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
                        </tr>
                        <tr>
                          <td  colspan="3" align="center" >
                              <input name="save"  type="button" class="form_botones" id="save" style="cursor:hand" value="Agregar"  onclick="cargaMyForm()"/>                          </td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" id="load_datos_help" ></td>
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
				my_form_column = new Array();			my_form_tipo = new Array();
				naturaleza=$('#naturaleza').val();
				if(naturaleza<3){
					my_form_column[0]='rif';				my_form_tipo[0]=8;
				}else{
					my_form_column[0]='rif';				my_form_tipo[0]=7;
				}
				
				my_form_column[1]='descripcion';		my_form_tipo[1]=1;
				my_form_column[2]='telefono';			my_form_tipo[2]=12;
				my_form_column[3]='naturaleza';			my_form_tipo[3]=1;
				my_form_column[4]='tipo';				my_form_tipo[4]=1;
				my_form_column[5]='direccion';			my_form_tipo[5]=1;
				//my_form_column[6]='responsable';		my_form_tipo[6]=11;
				telefono2=$("#telefono2").val();
				//alert(telefono2);
				if(telefono2.length>0){
					my_form_column[7]='telefono2';		my_form_tipo[7]=12;
				}
												
				valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
		}
</script>
</html>
