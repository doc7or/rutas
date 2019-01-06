<?php
	include("../lib/core.lib.php");
	$obj_vehiculo= new class_vehiculo;
	$id=$_REQUEST['id'];
	$largo=$_REQUEST['largo'];
	$ancho=$_REQUEST['ancho'];
	$alto=$_REQUEST['alto'];
	$id_carga=$_REQUEST['id_carga'];
	$udp_vehiculo=$obj_vehiculo->update_medidas($id,$alto,$ancho,$largo);

	if($udp_vehiculo){ ?><script type="text/javascript" > $("#<?php echo $id_carga; ?>").html('<img  src="../images/accept.png"   />'); </script>
<?php  }else{ ?><script type="text/javascript" > $("#<?php echo $id_carga; ?>").html('<img  src="../images/exclamation.png"   />'); </script>
<?php }  ?>

  