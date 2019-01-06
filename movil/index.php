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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux_movil.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<title><?php echo SYSTEM_NAME; ?></title>
<script language="javascript" src="../lib/js/jquery/jquery.js"></script>
<script language="javascript" src="../lib/js/jquery/form.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>

</head>
<body class="thrColLiqHdr">
<!--ESTE ES EL BODY-->
	<div id="container">
    <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
        <div id="header">
        <!--ESTE ES EL HEADER-->
        <!--ESTE ES EL HEADER-->
        </div>
        <div id="mainContent">
             <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <br />   
              <form name="form1" id="form1" action="../lib/common/login.php" method="post"  >
                <table width="265" align="center" class="tablas_login" >
                  <tr>
                    <td width="253">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table align="center" class="tablas_login">
                      <tr>
                        <td align="left">Usuario o Numero:</td>
                      </tr>
                      <tr>
                        <td  align="left"><input name="login" id="login" type="text" class="form_caja"   value="" />
                          <input type="hidden" id="tipo_ingreso" name="tipo_ingreso" value="2" /></td>
                      </tr>
                      <tr>
                        <td align="left">Password o Contraseña:</td>
                      </tr>
                      <tr>
                        <td align="left"><input name="pass" id="pass" type="password"  class="form_caja"  value="" />
                          <input type="hidden" id="accion" name="accion" value="" /></td>
                      </tr>
                      <tr>
                        <td   class="error_mesaje" align="center" ><?php if($error) { echo 'Error en el usuario o clave'; }?></td>
                      </tr>
                      <tr class="error_mesaje_acme" >
                        <td  id="mensaje_error" ></td>
                      </tr>
                      <tr>
                        <td  align="left" ><script type="text/javascript">
                                                                //DECLARACION DE ARAY DEL FORM
                                                                
                                                                var myForm='form1'; // nombre del forulario
                                                                var myPase='accion';//campo que se usa para el pase seguro
                                                                var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
                                                                my_form_column = new Array();			my_form_tipo = new Array();
                                                                my_form_column[0]='login';				my_form_tipo[0]=1;
                                                                my_form_column[1]='pass';				my_form_tipo[1]=1;
                                                                
                                                                
                                                 </script>
                          <input style="cursor:hand" name="logeo" id="logeo" type="submit"  value="Iniciar sesion"
                                                  class="form_botones"  /></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
            </form>
            <br />
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
        </div>
        <div id="footer">
        <!--ESTE ES EL FOOTER-->
        <!--ESTE ES EL FOOTER-->
        </div>
     <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
    </div>
<!--ESTE ES EL BODY-->
</body>
</html>
