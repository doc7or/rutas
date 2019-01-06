<?php 
include("../lib/core.lib.php");
if(($_SESSION['id_tipo_usuario']!=1) || $_SESSION['id_tipo_usuario']=='') header('Location: ../lib/common/logout.php');
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
                                        <td  colspan="3" class="form_titulo_acme"  align="center">Agregar Vehículo</td>
                                  </tr>
                                    <tr >
                                        <td width="150"></td>
                                        <td width="210"></td>
                                        <td ></td>
                                    </tr>
									
                                    <tr >
                                        <td  class="form_label">Placa :</td>
                                        <td >
                                            <input name="placa" type="text" class="form_caja" id="placa"  maxlength="50" />                                        </td>
                                             <td  rowspan="3"  class="tr_mensaje_ayuda"  id="tr_message"></td>
                                    </tr>
                                    <tr>
                                        <td height="24"  class="form_label" >Tipo :</td>
                        				  <td>
                                            
                                            <select name="id_tipo" id="id_tipo" class="form_pool" >
                                              <option value="0">Seleccione...</option>
                                              <?php  
                                                for ($i=0; $i<sizeof($arr_vehiculo_tipo);$i++) { ?>
                                              <option value="<?php echo $arr_vehiculo_tipo[$i]['id'];?>">
                                              	<?php echo $arr_vehiculo_tipo[$i]['sucursal'].'  '.$arr_vehiculo_tipo[$i]['descripcion'];?>                                </option>
                                              <?php }?>
                                            </select>                                        </td>
                                    </tr>
                                       <tr>
                                        <td height="24"  class="form_label" >Empresa :</td>
                        				  <td>
                                            
                                            <select name="id_empresa" id="id_empresa" class="form_pool" >
                                              <option value="0">Seleccione...</option>
                                              <?php  
                                                for ($i=0; $i<sizeof($arr_empresa);$i++) { ?>
                                              <option value="<?php echo $arr_empresa[$i]['id'];?>">
                                              <?php echo $arr_empresa[$i]['descripcion'];?>                                              </option>
                                              <?php }?>
                                            </select>                                        </td>
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
                                         <script type="text/javascript">
												//DECLARACION DE ARAY DEL FORM
												
												var myForm='form1'; // nombre del forulario
												var myPase='accion';//campo que se usa para el pase seguro
												var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
												my_form_column = new Array();			my_form_tipo = new Array();
												my_form_column[0]='placa';				my_form_tipo[0]=1;
												my_form_column[1]='id_tipo';				my_form_tipo[1]=1;
												my_form_column[2]='id_empresa';			my_form_tipo[2]=1;
												
                                            </script>
                                            <input name="save"  type="button" class="form_botones" id="save" style="cursor:hand" value="Agregar"  onclick="valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage)"/>                                        </td>
                                    </tr>
                                    <tr >
                                        <td  colspan="3" height="10" ></td>
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
</html>
