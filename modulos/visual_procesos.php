<?php 
include("../lib/core.lib.php");
if($_SESSION['id_usuario']=='') header('Location: ../index.php');
//echo $_SESSION['id_tipo_usuario'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script language="javascript">
	function validar()
	{
		var login = $("#losgin").val();
		if(login=='')
		{
			document.form1.login.focus();
			return false;
		}
	}
</script>
<style type="text/css">
<!--
.Estilo1 {color: #000000}
-->
</style>
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
              <div align="center">
                <p>
                  <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
                </p>
                <table width="679" border="0">
                  <tr>
                    <th bgcolor="#EBE9ED" class="form_titulo Estilo1" scope="col"><div align="center">Procesos</div></th>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <table width="414" height="130" border="0">
                  <tr>
                    <th width="130" height="126" scope="col"><p align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list.php?tipo=1" target=""><img src="../images/ico_forma_transporte.png" width="84" height="84" /></a></p>
                    <p align="center">&nbsp;</p></th>
                    <th width="130" scope="col"><p align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list.php?tipo=2" target=""><img src="../images/ico_forma_traslado.png" width="84" height="84" /></a></p>
                    <p align="center">&nbsp;</p></th>
                    <th width="132" scope="col"><p align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list.php?tipo=3" target=""><img src="../images/ico_forma_nota_entrega.png" width="84" height="84" /></a></p>
                    <p align="center">&nbsp;</p></th>
                    <th width="132" scope="col"><p align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/nomina_list.php" target=""><img src="../images/ico_nomina.png" width="84" height="84" /></a></p>
                    <p align="center">&nbsp;</p></th>
                  </tr>
     </table>
                              
                              
                              
                      
            
         
                              
                              
                              
                              
     <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
                </div>
            </div>
	  </div>
  <div id="footer" >
		  	<?php include ("../lib/common/footer.php"); ?>
          </div>
	</div>
</body>
</html>
