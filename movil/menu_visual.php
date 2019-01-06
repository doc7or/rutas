<?php 
include("../lib/core.lib.php");
//if(inList($_SESSION['id_usuario'],'')) header('Location: ../lib/common/logout.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux_movil.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script language="javascript" src="../lib/js/jquery/jquery.js"></script>
<script language="javascript" src="../lib/js/jquery/form.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
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
              <form name="form1" id="form1" action="" method="post"  >
               
                  <table width="95%" align="center" class="tablas_listados_datos_imp" >
                    <tr>
                      <td align="left"><table class="tabla_opciones" >
                        <tr >
                          <td colspan="3" align="left" >Procesos</td>
                         
                        </tr>
                         <tr >
                          <td><a href="guia_carga_list.php">
<img src="../images/movil_nota_entrega.png" title="Guia de control de carga" alt="Guia de control de carga" style="border:none"   /></a></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr >
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr >
                          <td colspan="3" align="left">Otros</td>
                          
                        </tr>
                         <tr >
                          <td><a href="../lib/common/logout.php"><img src="../images/movil_logout.png" title="Cerrar sesion" alt="Cerrar sesion" style="border:none"   /></a></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
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
