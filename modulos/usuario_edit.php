<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,6')) header('Location: ../lib/common/logout.php');
$id=$_REQUEST['id'];
$obj_usuario= new class_usuario;
$obj_log = new class_log;
$arr_usuario=$obj_usuario->get_list_usuario($id);
$obj_usuario_tipo= new class_usuario_tipo;
$arr_usuario_tipo= $obj_usuario_tipo -> get_usuario_tipo('');
$obj_sucursal= new class_sucursal;
$arr_sucursal=$obj_sucursal->get_sucursal('');

if($_REQUEST['accion']){
	
	$cedula=$_REQUEST['cedula'];
	$nombre=$_REQUEST['nombre'];
	$apellido=$_REQUEST['apellido'];
	$login=$_REQUEST['login'];
	$pass=$_REQUEST['pass'];
	$id_tipo_usuario=$_REQUEST['id_tipo_usuario'];
	$status=$_REQUEST['status'];
	$email=$_REQUEST['email'];
	$id_sucursal=$_REQUEST['id_sucursal'];
	
	$res_edit_usuario=$obj_usuario->update_usuario($id,$cedula,$nombre,$apellido,$login,$pass,$id_tipo_usuario,$status,$email,$id_sucursal);
	
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=17;
	$id_registro=$id;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=11;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
	
	header('Location: usuario_list.php');
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
                          <td colspan="2"><table class="tabla_opciones" >
                              <tr >
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%" ><a href="usuario_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
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
                                	<tr  class="form_titulo_acme"  >
                                        <td  colspan="3" class="form_titulo_acme"  align="center">Editar Usuario</td>
                                        
                                  </tr>
                                    <tr >
                                        <td width="150"  height="10" >
                                        	<input name="id" id="id" type="hidden" value="<?php echo $arr_usuario[0]['id']; ?>" />
                                        </td>
                                   
                                        <td width="210"></td>
                                        <td ></td>
                                    </tr>
									<tr >
                                        <td   class="form_label">Cedula :</td>
                                        <td  >
                                      <input name="cedula" type="text" class="form_caja" id="cedula"  maxlength="50" value="<?php echo $arr_usuario[0]['cedula'];?>"  onfocus="message_help(1)" onchange="existence('usuario','cedula','cedula','id','<?php echo $arr_usuario[0]['id']; ?>','','','','')" onKeyPress="return acceptNumCed(event)"/>                                        </td>
                                       <td rowspan="8" class="tr_mensaje_ayuda" id="tr_message">
                                                                                    	
                                      </td>     
                                  </tr>
                                    <tr >
                                        <td  class="form_label">Nombre :</td>
                                        <td >
                                            <input name="nombre" type="text" class="form_caja" id="nombre"  maxlength="50" value="<?php echo $arr_usuario[0]['nombre'];?>"  onfocus="message_help(0)"  onKeyPress="return acceptAlfaNombres(event)"/>                                        </td>
                                           
                                    </tr>
                                    <tr>
                                        <td  class="form_label"><label id="label_nombre">Apellido :</label></td>
                                        <td>
                                            <input name="apellido" type="text" class="form_caja" id="apellido"  maxlength="50" value="<?php echo $arr_usuario[0]['apellido'];?>"  onfocus="message_help(0)"  onKeyPress="return acceptAlfaNombres(event)"/>  </td>
                                            
                                    </tr>
                                    
                                   <tr>
                                        <td  class="form_label" >Usuario :</td>
                                        <td>
                                            <input name="login" type="text" class="form_caja" id="login"  maxlength="50" value="<?php echo $arr_usuario[0]['login'];?>"  onfocus="message_help(6)"   onchange="existence('usuario','login','login','id','<?php echo $arr_usuario[0]['id']; ?>','','','','')"  onKeyPress="return acceptNumAlfaMail(event)" /></td>
                                            
                                    </tr>
                                    <tr>
                                        <td  class="form_label" >Email :</td>
                                        <td>
                                            <input name="email" type="text" class="form_caja" id="email"  maxlength="50" value="<?php echo $arr_usuario[0]['email'];?>"  onfocus="message_help(2)"  onKeyPress="return acceptNumAlfaMail(event)"/>                                        </td>
                                           
                                    </tr>
                                    <tr>
                                        <td  class="form_label" >Tipo :</td>
                                        <td>
                                            
                                            <select name="id_tipo_usuario" id="id_tipo_usuario" class="form_pool"  onfocus="message_help(3)"  >
                                              <option value="0">Seleccione...</option>
                                              <?php  
                                                for ($i=0; $i<sizeof($arr_usuario_tipo);$i++) { ?>
                                              <option value="<?php echo $arr_usuario_tipo[$i]['id'];?>" <?php if ($arr_usuario[0]['id_tipo_usuario']==$arr_usuario_tipo[$i]['id']) echo 'selected' ; ?>  >
                                              <?php echo $arr_usuario_tipo[$i]['descripcion'];?>                                              </option>
                                              <?php }?>
                                            </select>                                        </td>
                                            
                                    </tr>
                                    <?php if($_SESSION['id_tipo_usuario']=='6'){?>
                                    <tr>
                                        <td  class="form_label" >Almacen de sucursal :</td>
                                        <td>
                                            
                                            <select name="id_sucursal" id="id_sucursal" class="form_pool"  onfocus="message_help(4)"  >
                                              <option value="0">Seleccione...</option>
                                              <?php  
                                                for ($i=0; $i<sizeof($arr_sucursal);$i++) { ?>
                                              <option value="<?php echo $arr_sucursal[$i]['id'];?>" <?php if ($arr_usuario[0]['id_sucursal']==$arr_sucursal[$i]['id']) echo 'selected' ; ?>>
                                              <?php echo $arr_sucursal[$i]['descripcion'];?>                                              </option>
                                              <?php }?>
                                            </select>                                        </td>
                                    </tr>
                                    <?php } ?>
                                           <tr>
                                        <td  class="form_label" >Estatus :</td>
                                        <td>
                                            
                                        <select name="status" id="status" class="form_pool"  onfocus="message_help(5)" >
                                          <option value="0">Seleccione...</option>
                                          <option value="1" <?php if ($arr_usuario[0]['status']==1) echo 'selected' ; ?>>Activo</option>
                                          <option value="2" <?php if ($arr_usuario[0]['status']==2) echo 'selected' ; ?>>Inactivo</option>
                                        </select>
                                        </td>
                                    </tr>
                                     <tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="mensaje_error" ></td>
                                    </tr>
                                   <tr >
                                        <td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td  colspan="3" align="center" >
                                        	
                                            <input name="edit"  type="button" class="form_botones" id="edit" style="cursor:hand" value="Editar"  onclick="cargaMyForm()"/>                                        </td>
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
				my_form_column[0]='cedula';				my_form_tipo[0]=7;
				my_form_column[1]='nombre';				my_form_tipo[1]=11;
				my_form_column[2]='apellido';			my_form_tipo[2]=11;
				my_form_column[3]='login';				my_form_tipo[3]=10;
				my_form_column[4]='email';				my_form_tipo[4]=4;
				my_form_column[5]='id_tipo_usuario';	my_form_tipo[5]=1;
	//			my_form_column[6]='id_sucursal';		my_form_tipo[6]=1;
				my_form_column[7]='status';				my_form_tipo[7]=1;
		
		valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
	}
	
	
</script>
</html>
