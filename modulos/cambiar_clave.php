<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');

$obj_usuario= new class_usuario;
$_REQUEST['error'];

//inserciond e zonas
if($_REQUEST['accion']){
	$clave_actual=$_REQUEST['clave_actual'];
	$clave=$_REQUEST['clave'];
	$r_pass=$_REQUEST['r_pass'];

	$get=$obj_usuario->get_usuario('',$clave_actual,$_SESSION['id_usuario']);
	
	if(sizeof($get)>0) {
		$upd=$obj_usuario->update_clave_usuario($_SESSION['id_usuario'],$clave,$clave_actual);
		header('Location: ../index.php');
			}
	else	{
		header('Location: cambiar_clave.php?error=1');
		}
		
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
                                <td width="20%" >&nbsp;</td>
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
                          <td  colspan="3" class="form_titulo_acme"  align="center">Cambiar Clave</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="210"></td>
                          <td ></td>
                        </tr>
                        <tr >
                          <td  class="form_label" height="10">Clave Anterior :</td>
                          <td >
                         
                          <input name="clave_actual" type="password" class="form_caja" id="clave_actual"  maxlength="50" value=""  onfocus="message_help(0)"  onKeyPress="return acceptNumAlfaMail(event)"  /> 
                          </td>
                          <td rowspan="4"  class="tr_mensaje_ayuda" id="tr_message"></td>
                        </tr>
                        <tr>
                          <td  class="form_label"  height="10">Nueva Clave :</td>
                          <td><input name="clave" type="password" class="form_caja" id="clave"  maxlength="50" value=""  onfocus="message_help(7)"  onkeypress="return acceptNumAlfaMail(event)"    onchange="valida_rpass('r_pass','clave')" /></td>
                        </tr>
                        <tr>
                          <td  class="form_label"  height="10">Repita Clave :</td>
                          <td>
                          <input name="r_pass" type="password" class="form_caja" id="r_pass"  maxlength="50" value=""  onfocus="message_help(8)"  onKeyPress="return acceptNumAlfaMail(event)" onchange="valida_rpass('r_pass','clave')"  />
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"></td>
                        </tr>
                        <tr>
                          <td  colspan="2" align="center"  ><input type="hidden" id="accion" name="accion" value="" />
                         </td>
                        </tr>
                        <tr  class="error_mesaje_acme" >
                          <td  colspan="3" height="10"   id="mensaje_error" >
                          	<?php if($_REQUEST['error']){?>
                          		<font class="error_mesaje_acme">Error en la clave, ingrese una valida por favor</font>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td  colspan="3" align="center" >
						  
						  <script type="text/javascript">
												//DECLARACION DE ARAY DEL FORM
												
												var myForm='form1'; // nombre del forulario
												var myPase='accion';//campo que se usa para el pase seguro
												var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
												my_form_column = new Array();			my_form_tipo = new Array();
												my_form_column[0]='clave_nueva';		my_form_tipo[0]=1;
												my_form_column[1]='clave';				my_form_tipo[1]=1;
												my_form_column[2]='r_pass';				my_form_tipo[2]=1;
											
											
												
												
                                            </script>
                              <input name="save" type="button" class="form_botones" id="save" style="cursor:hand" value="Cambiar" onclick="valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage)" />
                          </td>
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
</html>
