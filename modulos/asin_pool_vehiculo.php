<?php
	include("../lib/core.lib.php");
	$obj_vehiculo= new class_vehiculo;
	$id_empresa=$_REQUEST['id_tabla'];
	$arr_vehiculo=$obj_vehiculo->get_list_vehiculo('','',$id_empresa);
	
?>

   <select name="vehiculo" id="vehiculo" class="form_pool_proceso" onchange="carga_data_vehiculo('vehiculo','vehiculo_tipo','vehiculo_capacidad','vehiculo_mensaje','seccion_ruta')" >
      <option value="0">Seleccione...</option>
      <?php  
        for ($i=0; $i<sizeof($arr_vehiculo);$i++) { ?>
      <option value="<?php echo $arr_vehiculo[$i]['placa'];?>">
      	<?php echo htmlentities($arr_vehiculo[$i]['placa'].' --- '.$arr_vehiculo[$i]['tipo']);?>
      </option>
      <?php }?>
    </select> 
                <input type="hidden"  name="vehiculo_tipo" id="vehiculo_tipo" value="" />
                <input type="hidden"  name="vehiculo_capacidad" id="vehiculo_capacidad" value="" />                          
