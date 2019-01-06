<?php 
session_start();
session_unset();
session_destroy();

include("../lib/core.lib.php");

$error=$_REQUEST['error'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SYSTEM_NAME; ?></title>
<script language="javascript" src="../lib/js/jquery/jquery.js"></script>
<script language="javascript" src="../lib/js/jquery/form.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>

<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
</head>

<body id="todo">
<form name="form1" id="form1" action="../lib/common/login.php" method="post" onsubmit="validar()" >
<div id="contenedor" >
		  <div id="header_index" >
          	<!--AQUI VA EL FOOTER ADEMAS DEL EL MENU HORIZONTAL-->
          	
            
            <!--AQUI VA EL FOOTER ADEMAS DEL EL MENU HORIZONTAL-->
          </div>
		  <div id="contenido" >
            <div  id="area_login">
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->

                  <table align="center" class="tablas_login" >
                        <tr>
                            <td width="46%" >Usuario:</td>
                      <td width="54%">
                                <input name="login" id="login" type="text" class="form_caja"   value="" />        
				<input type="hidden" id="tipo_ingreso" name="tipo_ingreso" value="1" />
			        </td>
                        </tr>
                        <tr>
                            <td >Clave/Password :</td>
                            <td>
                                <input name="pass" id="pass" type="password"  class="form_caja"  value="" />     <input type="hidden" id="accion" name="accion" value="" />           </td>
                        </tr>
                        <tr>
                            <td colspan="2"  class="error_mesaje" align="center" >
                                <?php if($error) { echo 'Error en el usuario o clave'; }?>                </td>
                        </tr>
                        	<tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="mensaje_error" ></td>
                                    </tr>
                        <tr>
                            <td colspan="2" >
                            	 <script type="text/javascript">
												//DECLARACION DE ARAY DEL FORM
												
												var myForm='form1'; // nombre del forulario
												var myPase='accion';//campo que se usa para el pase seguro
												var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
												my_form_column = new Array();			my_form_tipo = new Array();
												my_form_column[0]='login';				my_form_tipo[0]=1;
												my_form_column[1]='pass';				my_form_tipo[1]=1;
												
												
                                 </script>
                                 <input style="cursor:hand" name="logeo" id="logeo" type="button"  value="Entrar" class="form_botones"  onclick="valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage)"/>                </td>
                        </tr>
                    </table>

              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
            </div>
  		  </div>
		  <div id="footer" ></div>
</div>
</form>
</body>
</html>



