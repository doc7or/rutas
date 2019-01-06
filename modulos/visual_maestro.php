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
                <table width="680" border="0">
                  <tr>
                    <th bgcolor="#EBE9ED" class="form_titulo Estilo1" scope="col"><div align="center">Maestros</div></th>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <table width="414" height="291" border="0">
                  <tr>
                    <th width="130" scope="col"><div align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/cambiar_clave.php" target=""><img src="../images/ico_cam_clave.png" width="84" height="84" /></a></div></th>
                    <th width="130" scope="col"><div align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/empresa_list.php" target=""><img src="../images/ico_empresas.png" width="84" height="84" /></a></div></th>
                    <th width="132" scope="col"><div align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/escolta_list.php" target=""><img src="../images/ico_escoltas.png" width="84" height="84" /></a></div></th>
                  </tr>
                  <tr>
                    <td><div align="center"> <a  href="<?php echo DOMAIN_ROOT;?>modulos/sucursal_list.php" target=""><img src="../images/ico_sucursal.png" width="84" height="84" /></a></div></td>
                    <td><div align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/transportista_list.php" target=""><img src="../images/ico_transportistas.png" width="84" height="84" /></a></div></td>
                    <td><div align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/tabulador_costo_list.php" target=""><img src="../images/ico_tabulador.png" width="84" height="84" /></a></div></td>
                  </tr>
                  <tr>
                    <td><div align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/usuario_list.php" target=""><img src="../images/ico_usuarios.png" width="84" height="84" /></a></div></td>
                    <td><div align="center"><a  href="<?php echo DOMAIN_ROOT;?>modulos/vehiculo_index.php" target=""><img src="../images/ico_vehiculos.png" width="84" height="84" /></a><a  href="<?php echo DOMAIN_ROOT;?>modulos/vehiculo_index.php" target=""></a></div></td>
                    <td><div align="center"> <a  href="<?php echo DOMAIN_ROOT;?>modulos/zona_list.php" target=""><img src="../images/ico_zonas.png" width="84" height="84" /></a> </div></td>
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
