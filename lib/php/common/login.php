<?php
include("../core.lib.php");

//LLAMADO DE LAS DIFERENTES CLASES
$obj_usuario= new class_usuario;
$obj_usuario_tipo = new class_usuario_tipo;
$obj_sucursal = new class_sucursal;
$obj_factura_temp_uso = new class_factura_temp_uso;



$login=$_REQUEST['login'];
$pass=$_REQUEST['pass'];


$arr_usuario=$obj_usuario->get_usuario($login,$pass);

	if ($arr_usuario) 
	{
	$_SESSION['id_usuario'] = $arr_usuario[0]['id'];
	$_SESSION['nombre'] = $arr_usuario[0]['nombre'];
	$_SESSION['apellido'] = $arr_usuario[0]['apellido'];
	$_SESSION['id_tipo_usuario'] = $arr_usuario[0]['id_tipo_usuario'] ;
	$_SESSION['login'] = $arr_usuario[0]['login'];
	$_SESSION['id_sucursal'] = $arr_usuario[0]['id_sucursal'];

	//BUSCAMOS LOS DATOS NECESARIOS DE LA SUCURSAL	
	$arr_sucursal=$obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
	$_SESSION['id_sucursal_profit'] = $arr_sucursal[0]['id_sucursal_profit'];
	$_SESSION['prefijo'] = $arr_sucursal[0]['prefijo'];
	$_SESSION['valor_num_prefijo'] = $arr_sucursal[0]['valor_num_prefijo'];
	$_SESSION['tipo_ruta'] = $arr_sucursal[0]['tipo'];
	
	
	//SELECCIONAMOS EL TIPO DE USUARIO
	$arr_usuario_tipo=$obj_usuario_tipo->get_usuario_tipo($_SESSION['id_tipo_usuario']);
	
	
		if($arr_usuario_tipo)
		{
		
	
			$_SESSION['tipo_usuario']=$arr_usuario_tipo[0]['descripcion'];
			
			$del_factura_temp_uso=$obj_factura_temp_uso->delete_factura_temp_uso($_SESSION['id_usuario']);	
		
		?>
	
	<script type="text/javascript" >
		window.location="../../modulos/home.php";
	</script>
	
	
	<?php
		}
	}else{
?>
	
	<script type="text/javascript" >
		window.location="../../index.php?error=true";
	</script>
	
	
	<?php
	
	}
?>
