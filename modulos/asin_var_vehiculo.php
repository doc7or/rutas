<?php
	include("../lib/core.lib.php");
	$obj_vehiculo= new class_vehiculo;
	$id_empresa=$_REQUEST['id_tabla'];
	
	$arr_vehiculo=$obj_vehiculo->get_list_vehiculo('','',$id_empresa);
	

	if($id_empresa!='i'){	?>
    
   <select name="vehiculo" id="vehiculo" class="form_pool" >
      <option value="0">Seleccione...</option>
      <?php  
        for ($i=0; $i<sizeof($arr_vehiculo);$i++) { ?>
      <option value="<?=$arr_vehiculo[$i]['placa']?>">
      	<?php echo $arr_vehiculo[$i]['placa'].' ... '.$arr_vehiculo[$i]['descripcion'];?>
      </option>
      <?php }?>
    </select>                                        
    <?php }else{ ?>

 <input name="vehiculo" type="text" class="form_caja" id="vehiculo" maxlength="50"  value="Indique Placa...."  onclick="clear_caja('vehiculo')"/>
<?php } ?> 