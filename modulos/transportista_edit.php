<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,6')) header('Location: ../lib/common/logout.php');
$obj_transportista= new class_transportista;
$obj_empresa= new class_empresa;
$id=$_REQUEST['id'];
$arr_transportista=$obj_transportista->get_transportista($id);
$arr_empresa=$obj_empresa->get_empresa('','',1,$_SESSION['id_sucursal'],'','','',1);
$obj_cod_area_telefono = new class_cod_area_telefono;
$obj_log = new class_log;
//adicion de transportistas
if($_REQUEST['accion']){
	//die('vamos bien');
	$rif=$_REQUEST['rif'];
	$nombre=$_REQUEST['nombre'];
	$apellido=$_REQUEST['apellido'];
	$direccion=$_REQUEST['direccion'];
	$telefono=$_REQUEST['cod_area'].'-'.$_REQUEST['telefono'];
	$telefono2=$_REQUEST['cod_area2'].'-'.$_REQUEST['telefono2'];
	$id_empresa=$_REQUEST['id_empresa'];
	$status=$_REQUEST['status'];
	
	$res_add_transportista=$obj_transportista->update_transportista($id,$rif,$nombre,$apellido,$telefono,$id_empresa,$telefono2,$direccion,$status);
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=17;
	$id_registro=$id;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=10;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
	
	header('Location: transportista_list.php');
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
                                <td width="20%" ><a href="transportista_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
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
                          <td  colspan="3" class="form_titulo_acme"  align="center">Editar transportista</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="210"></td>
                          <td ></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Cedula :</td>
                          <td ><input name="rif" type="text" class="form_caja" id="rif"  maxlength="8"  onkeypress="return acceptNum(event)"  onfocus="message_help(1)" value="<?php echo $arr_transportista[0]['rif'];	?>"   onchange="existence('transportista','rif','rif','id','<?php echo $arr_transportista[0]['id']?>','','','id_sucursal','<?php echo $_SESSION['id_sucursal']?>')" />
                          </td>
                          <td  rowspan="8"  class="tr_mensaje_ayuda"  id="tr_message"></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Nombre :</td>
                          <td ><input name="nombre" type="text" class="form_caja" id="nombre"  maxlength="50"  onfocus="message_help(0)"  onKeyPress="return acceptAlfaNombres(event)" value="<?php echo htmlentities($arr_transportista[0]['nombre']);	?>"/>
                          </td>
                        </tr>
                        <tr>
                          <td  class="form_label">Apellido :</td>
                          <td><input name="apellido" type="text" class="form_caja" id="apellido"  maxlength="50"  onfocus="message_help(0)"  onKeyPress="return acceptAlfaNombres(event)" value="<?php echo htmlentities($arr_transportista[0]['apellido']);	?>"/>
                          </td>
                        </tr>
                          <tr>
                          <td  class="form_label" >Telefono :</td>
                          <td>
                          <select name="cod_area" id="cod_area" class="form_pool_cod_area"  onfocus="message_help(18)"   >
                          	<?php
								$telefono=split('-',$arr_transportista[0]['telefono']);
								$arr_cod_area_telefono=$obj_cod_area_telefono->get_cod_area_telefono();
								for ($i=0; $i<sizeof($arr_cod_area_telefono);$i++) { ?>
							  <option value="<?php echo $arr_cod_area_telefono[$i]['codigo']; ?>" <?php if($telefono[0]==$arr_cod_area_telefono[$i]['codigo']) echo "selected"; ?>>
							  <?php echo $arr_cod_area_telefono[$i]['codigo'];?>                                              </option>
							  <?php }?>
                          </select>
-
<input name="telefono" type="text" class="form_caja_telefono" id="telefono"  maxlength="7"  onfocus="message_help(19)" onkeypress="return acceptNumRif(event)" value="<?php echo $telefono[1]; ?>" /></td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Telefono 2 :</td>
                          <td>
                          <select name="cod_area2" id="cod_area2" class="form_pool_cod_area"  onfocus="message_help(18)"   >
                          <?php
						  		$telefono2=split('-',$arr_transportista[0]['telefono2']);
								$arr_cod_area_telefono2=$obj_cod_area_telefono->get_cod_area_telefono();
								for ($i=0; $i<sizeof($arr_cod_area_telefono2);$i++) { ?>
							  <option value="<?php echo $arr_cod_area_telefono2[$i]['codigo']; ?>" <?php if($telefono2[0]==$arr_cod_area_telefono2[$i]['codigo']) echo "selected"; ?>>
							  <?php echo $arr_cod_area_telefono2[$i]['codigo'];?>                                              </option>
							  <?php }?>
                          </select>
-
<input name="telefono2" type="text" class="form_caja_telefono" id="telefono2"  maxlength="7"  onfocus="message_help(19)" onkeypress="return acceptNumRif(event)" value="<?php echo $telefono2[1]; ?>"  /></td>
                        </tr>
                        <tr>
                          <td  class="form_label">Direcci&oacute;n :</td>
                          <td><input name="direccion" type="text" class="form_caja" id="direccion"  maxlength="50"  onfocus="message_help(0)" value="<?php echo $arr_transportista[0]['direccion']; ?>"  /></td>
                        </tr>
                        <tr>
                          <td  class="form_label">Empresa :</td>
                          <td><select name="id_empresa" id="id_empresa" class="form_pool"  onfocus="message_help(24)"  >
                              <option value="0">Seleccione...</option>
                              <?php  
                                              for ($i=0; $i<sizeof($arr_empresa);$i++) { ?>
                              <option value="<?php echo $arr_empresa[$i]['id'];?>" <?php if($arr_transportista[0]['id_empresa']==$arr_empresa[$i]['id']) echo "selected"; ?>> <?php echo $arr_empresa[$i]['descripcion'];?> </option>
                              <?php }?>
                              
                            </select>
                          </td>
                        </tr>
						 <tr>
							<td height="24"  class="form_label" >Estado :</td>
							<td>
								
								<select name="status" id="status" class="form_pool" onfocus="message_help(29)">
								  <option value="1" <?php if($arr_transportista[0]['status']=='1') echo 'selected'; ?>>Activo</option>
								  <option value="2" <?php if($arr_transportista[0]['status']=='2') echo 'selected'; ?>>Inactivo</option>
								  <option value="0" <?php if($arr_transportista[0]['status']=='0') echo 'selected'; ?>>Eliminado</option>
								  <option value="3" <?php if($arr_transportista[0]['status']=='3') echo 'selected'; ?>>En servicio</option>
								</select>                                        
							</td>
                                    </tr>
                        <tr class="error_mesaje_acme" >
                          <td  colspan="3" id="mensaje_error" ></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" ></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
                        </tr>
                        <tr>
                          <td  colspan="3" align="center" >
                          <input name="save"  type="button" class="form_botones" id="save" style="cursor:hand" value="Editar"  onclick="cargaMyForm()"/></td>
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
				my_form_column[0]='rif';				my_form_tipo[0]=7;
				my_form_column[1]='nombre';				my_form_tipo[1]=11;
				my_form_column[2]='apellido';			my_form_tipo[2]=11;
				my_form_column[3]='telefono';			my_form_tipo[3]=12;
				
				my_form_column[5]='direccion';			my_form_tipo[5]=1;
				my_form_column[6]='id_empresa';			my_form_tipo[6]=1;
				telefono2=$("#telefono2").val();
				//alert(telefono2);
				if(telefono2.length>0){
					my_form_column[7]='telefono2';		my_form_tipo[7]=12;
				}
												
				valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
		}
</script>
</html>
