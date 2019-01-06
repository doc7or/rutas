<?php
	include("../lib/core.lib.php");
	$obj_zona= new class_zona;
	$id_estado=$_REQUEST['id_tabla'];
	$id_edit=$_REQUEST['id_edit'];
	$arr_zona=$obj_zona->get_zona('','',$id_estado,'1');
	
?>

   <select name="ciudad" id="ciudad" class="form_pool_proceso" >
      <option value="0">Seleccione...</option>
      <?php  
        for ($i=0; $i<sizeof($arr_zona);$i++) { ?>
      <option value="<?php echo $arr_zona[$i]['descripcion'];?>" <?php if($id_edit==$arr_zona[$i]['descripcion']) echo "selected"; ?> >
      	<?php echo $arr_zona[$i]['descripcion'];?>
      </option>
      <?php }?>
    </select> 
                                          
