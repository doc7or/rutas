<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,6')) header('Location: ../lib/common/logout.php');
$id=$_REQUEST['id'];
$obj_vehiculo= new class_vehiculo;
$obj_vehiculo_tipo= new class_vehiculo_tipo;
$arr_vehiculo_tipo = $obj_vehiculo_tipo->get_list_vehiculo_tipo();
$obj_empresa= new class_empresa;
$arr_vehiculo = $obj_vehiculo->get_vehiculo('','','','','',$id);
$arr_empresa = $obj_empresa->get_empresa('','','1', $_SESSION['id_sucursal']);
$obj_sucursal= new class_sucursal;
$arr_sucursal=$obj_sucursal->get_sucursal('');
$obj_log = new class_log;


//insercion de vehiculos
if($_REQUEST['accion']){
	//die('vamos bien');
	$arr_vehiculo = $obj_vehiculo->get_vehiculo('','','','','',$id);
	$placa=$_REQUEST['placa'];
	$id_tipo=$_REQUEST['id_tipo'];
	$id_empresa=$_REQUEST['id_empresa'];
	if(($_SESSION['id_tipo_usuario']=='3') && (inList($arr_vehiculo[0]['status'],'1,2'))){
		$status=$_REQUEST['status'];	}
	else{
		$status=$arr_vehiculo[0]['status'];
	}
		
	
	if($_SESSION['id_tipo_usuario']==6){
		$id_sucursal=$_REQUEST['id_sucursal'];
	}else{
		$id_sucursal=$_SESSION['id_sucursal'];
	}
	$observacion=$_REQUEST['observacion'];
	$marca=$_REQUEST['marca'];
	$status=$_REQUEST['status'];
	
	$res_udp_vehiculo=$obj_vehiculo->update_vehiculo($id,$placa,$id_tipo,$id_empresa,$status,$observacion,$marca);
	
	
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=17;
	$id_registro=$id;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=13;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
	
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
                                      <td width="20%" ><a href="vehiculo_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
						<tr>
							<td  colspan="2" align="center" height="10"></td>
						</tr>
						<tr>
							<td  colspan="2" align="left">
								<table class="tablas_maestros" >
                                	<tr >
                                        <td  colspan="3" class="form_titulo_acme"  align="center">Editar Vehículo</td>
                                  </tr>
                                    <tr >
                                        <td width="150"></td>
                                        <td width="210"></td>
                                        <td ></td>
                                    </tr>
									
                                    <tr >
                                        <td  class="form_label">Placa :</td>
                                        <td >
                                            <input name="placa" readonly type="text" class="form_caja" id="placa"  maxlength="7"  onkeypress="return acceptNumAlfa(event)"  onfocus="message_help(26)" onchange="existence('vehiculo','placa','placa','id','<?php echo $arr_vehiculo[0]['id']; ?>','','','id_sucursal','<?php echo $_SESSION['id_sucursal']?>')" value="<?php echo trim($arr_vehiculo[0]['placa']); ?>" />                                        </td>
                                             <td  rowspan="6"  class="tr_mensaje_ayuda"  id="tr_message"></td>
                                    </tr>
                                    <tr >
                                        <td  class="form_label">Marca :</td>
                                        <td >
                                            <input name="marca" type="text" class="form_caja" id="marca"  maxlength="50"  onfocus="message_help(27)"  value="<?php echo $arr_vehiculo[0]['marca']; ?>"/>                                        </td>
                                            
                                    </tr>
                                    <tr>
                                        <td height="24"  class="form_label" >Tipo :</td>
                        				  <td>
                                            
                                            <select name="id_tipo" id="id_tipo" class="form_pool" onfocus="message_help(31)" >
                                              <option value="0">Seleccione...</option>
                                              <?php  
                                                for ($i=0; $i<sizeof($arr_vehiculo_tipo);$i++) { ?>
                                              <option value="<?php echo $arr_vehiculo_tipo[$i]['id'];?>" <?php if($arr_vehiculo[0]['id_tipo']==$arr_vehiculo_tipo[$i]['id']) echo "selected"; ?> >
                                              	<?php echo $arr_vehiculo_tipo[$i]['sucursal'].'  '.$arr_vehiculo_tipo[$i]['descripcion'];?>                                </option>
                                              <?php }?>
                                            </select>                                        </td>
                                    </tr>
                                       <tr>
                                        <td height="24"  class="form_label" >Empresa :</td>
                        				  <td>
                                            <select name="id_empresa" id="id_empresa" class="form_pool" onfocus="message_help(29)">
                                              <option value="0">Seleccione...</option>
                                              <?php  
                                                for ($i=0; $i<sizeof($arr_empresa);$i++) { ?>
                                              <option value="<?php echo $arr_empresa[$i]['id'];?>" <?php if($arr_vehiculo[0]['id_empresa']==$arr_empresa[$i]['id']) echo "selected"; ?>>
                                              <?php echo $arr_empresa[$i]['descripcion'];?>                                              </option>
                                              <?php }?>
                                            </select>                                        </td>
                                    </tr>
									   <tr>
                                        <td height="24"  class="form_label" >Estado :</td>
                        				  <td>
                                            
                                            <select name="status" id="status" class="form_pool" onfocus="message_help(29)">
                                              <option value="1" <?php if($arr_vehiculo[0]['status']=='1') echo 'selected'; ?>>Activo</option>
                                              <option value="2" <?php if($arr_vehiculo[0]['status']=='2') echo 'selected'; ?>>Inactivo</option>
											  <option value="0" <?php if($arr_vehiculo[0]['status']=='0') echo 'selected'; ?>>Eliminado</option>
											  <option value="3" <?php if($arr_vehiculo[0]['status']=='3') echo 'selected'; ?>>En servicio</option>
                                            </select>                                        </td>
                                    </tr>
                                     <tr >
                                        <td  class="form_label">Observaci&oacute;n :</td>
                                        <td >
                                        <textarea name="observacion" id="observacion" class="form_text"  onfocus="message_help(30)" ><?php echo $arr_vehiculo[0]['observacion']; ?></textarea>
                                                                                    </td>
                                            
                                  </tr>
                                   <?php if(($_SESSION['id_tipo_usuario']=='3') && (inList($arr_vehiculo[0]['status'],'1,2'))){?>
                                        <tr>
                                            <td  class="form_label" >Activaci&oacute;n :</td>
                                            <td>
                                                
                                                <select name="status" id="status" class="form_pool"  onfocus="message_help(32)"  >
                                                  <option value="1" <?php if($arr_vehiculo[0]['status']==1) echo "selected"; ?>>Activo</option>
                                                  <option value="2" <?php if($arr_vehiculo[0]['status']==2) echo "selected"; ?>>Inactivo</option>
                                                                                                 
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                     <tr class="error_mesaje_acme" >
                                        <td  colspan="2" align="center"  ></td>
                                    </tr>
                                  <tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="mensaje_error" ></td>
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
								</table>
						  </td>
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
					my_form_column[0]='placa';				my_form_tipo[0]=13;
					my_form_column[1]='id_tipo';			my_form_tipo[1]=1;
					my_form_column[2]='id_empresa';			my_form_tipo[2]=1;
				//	my_form_column[4]='marca';				my_form_tipo[4]=1;
						
			valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
		}
		
	</script>
</html>
