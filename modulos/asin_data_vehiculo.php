<?php
	
	include("../lib/core.lib.php");
	$obj_vehiculo= new class_vehiculo;
	$obj_empresa= new class_empresa;
	//die('llego');
	$id=$_REQUEST['id'];
	$id_vehiculo=$_REQUEST['id_vehiculo'];
	$vehiculo_tipo=$_REQUEST['vehiculo_tipo'];
	$vehiculo_capacidad=$_REQUEST['vehiculo_capacidad'];
	$vehiculo_mensaje=$_REQUEST['vehiculo_mensaje'];
	$seccion_ruta=$_REQUEST['seccion_ruta'];
	
	$arr_vehiculo=$obj_vehiculo->get_list_vehiculo('','','','','',$id);
	
	if(sizeof($arr_vehiculo)>0){
	$arr_empresa=$obj_empresa->get_empresa($arr_vehiculo[0]['id_empresa']);
		?>
        <script type="text/javascript" >
			//alert('id_empresa <?php echo $arr_empresa[0]['prueba']; ?> desc_emprersa ');
			$("#<?php echo $vehiculo_tipo; ?>").val('<?php echo $arr_vehiculo[0]['id_tipo'];?>');
			$("#vehiculo_placa").val('<?php echo $arr_vehiculo[0]['placa'];?>');
			$("#<?php echo $vehiculo_capacidad; ?>").val('<?php echo $arr_vehiculo[0]['metraje_min'].",".$arr_vehiculo[0]['metraje_max'];?>');
			$("#<?php echo $vehiculo_mensaje; ?>").html('<?php echo "Vehiculo con Capacidad Minima de: ".$arr_vehiculo[0]['metraje_min']." m3, y Maxima de: ".$arr_vehiculo[0]['metraje_max']." m3.";?>');
			$("#<?php echo $seccion_ruta; ?>").removeClass('not_display');
			$("#empresa_transportista_nombre").val('<?php echo $arr_empresa[0]['descripcion']; ?>');
			$("#empresa_transportista").val('<?php echo $arr_empresa[0]['id']; ?>');
			//alert('asin_pool_transportista.php?id_tabla=<?php echo $arr_empresa[0]['id']; ?>');
			$("#id_carga_transportista").load('asin_pool_transportista.php?id_tabla=<?php echo $arr_empresa[0]['id']; ?>');

        </script>
        <?php 
	}
?>