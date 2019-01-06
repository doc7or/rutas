<?php
	include("../lib/core.lib.php");
	$obj_transportista= new class_transportista;
	$id_empresa=$_REQUEST['id_tabla'];
	$arr_transportista=$obj_transportista->get_transportista('','','','',$id_empresa,'','1',$_SESSION['id_sucursal']);
	
?>

   <select name="transportista" id="transportista" class="form_pool_proceso" >
      <option value="0">Seleccione...</option>
      <?php  
        for ($i=0; $i<sizeof($arr_transportista);$i++) { ?>
      <option value="<?php echo $arr_transportista[$i]['id'];?>">
      	<?php echo htmlentities($arr_transportista[$i]['nombre'].''.$arr_transportista[$i]['apellido']);?>
      </option>
      <?php }?>
    </select> 
                                          
