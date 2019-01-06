<?php
	include("../lib/core.lib.php");
	$obj_escolta= new class_escolta;
	$id_empresa=$_REQUEST['id_tabla'];
	$arr_escolta=$obj_escolta->get_escolta('',$id_empresa);
	
?>

   <select name="escolta" id="escolta" class="form_pool_proceso" >
      <option value="0">Seleccione...</option>
      <?php  
        for ($i=0; $i<sizeof($arr_escolta);$i++) { ?>
      <option value="<?php echo $arr_escolta[$i]['id'];?>">
      	<?php echo htmlentities($arr_escolta[$i]['nombre'].''.$arr_transportista[$i]['apellido']);?>
      </option>
      <?php }?>
    </select> 
                                          
