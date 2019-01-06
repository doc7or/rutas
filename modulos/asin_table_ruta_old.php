<?php
	include("../lib/core.lib.php");
	$obj_ruta_base= new class_ruta_base;
	$obj_ruta_base_escala= new class_ruta_base_escala;
	
	$arr_ruta_base=$obj_ruta_base->get_ruta_base('',$_SESSION['tipo_ruta']);
	$id_llamada=$_REQUEST['id_llamada'];
	
?>



<table  class="tablas_procesos_datos_menor" vspace="0" >
	<?php 
		
		for($i=0;$i<sizeof($arr_ruta_base);$i++){	?>
            <tr id="tr_ruta_base_<?php echo $i; ?>"  class="form_titulo_menor" >
          <td  style="cursor:pointer" onclick="mostrar_fila('tr_ruta_base_escala_','<?php echo sizeof($arr_ruta_base); ?>','<?php echo $i; ?>','<?php echo $id_llamada;?>')" >
                    <?php	echo htmlentities($arr_ruta_base[$i]['descripcion']);	 ?>                </td>
  </tr>  
            <tr id="tr_ruta_base_escala_<?php echo $i; ?>">
                <td>
                    <table width="150"  class="tablas_procesos_datos_menor">
          <tr class="form_sub_titulo_menor">
                            <td width="20%">Pos</td>
                          <td width="80%">Zona</td>
                      </tr>
						<?php 
							$arr_ruta_base_escala='';
							$arr_ruta_base_escala=$obj_ruta_base_escala->get_ruta_base_escala('',$arr_ruta_base[$i]['id']);
							for($j=0;$j<sizeof($arr_ruta_base_escala);$j++){
						?>
                            <tr style="cursor:pointer" onclick="carga_ruta('<?php echo $id_llamada;?>','<?php echo $arr_ruta_base_escala[$j]['posicion'].','. htmlentities($arr_ruta_base_escala[$j]['zona']).','.$arr_ruta_base_escala[$j]['id_zona'];?>')">
                                <td ><?php echo	htmlentities($arr_ruta_base_escala[$j]['posicion']);	?></td>
                                <td ><?php echo htmlentities($arr_ruta_base_escala[$j]['zona'])	?></td>
                            </tr>
                        <?php } ?>
                    </table>
              </td>
            </tr>    	
        
    <?php } ?>
</table>

<script type="text/javascript">
	oculta_filas('tr_ruta_base_escala_','<?php echo sizeof($arr_ruta_base); ?>');
</script>
