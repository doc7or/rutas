<?php 
include("../lib/core.lib.php");

$obj_estado= new class_estado;
$arr_estado= $obj_estado -> get_estado(); 

?>
<table  class="tablas_procesos_datos_menor" vspace="0" >
	<tr>
    	<td class="form_titulo_menor" >
        	Desvio
        </td>
    </tr>
    <tr>
        
        <td>
        <select name="estado"  id="estado" class="form_pool_proceso" onchange="load_pool('id_carga','asin_pool_zona_menor.php','estado')" >
            <option value="0">Estado ...</option>
            <?php  
                  for ($i=0; $i<sizeof($arr_estado);$i++) { ?>
            <option value="<?php echo $arr_estado[$i]['id']; ?>"> <?php echo $arr_estado[$i]['descripcion']; ?> </option>
            <?php }?>
          </select>                                      </td>
      </tr>
      <tr>
       
          <td id="id_carga">
              <select name="ciudad" id="ciudad" class="form_pool_proceso" >
                <option value="0">Ciudad / Zona...</option>
               </select>                                        
           </td>
      </tr>
</table>