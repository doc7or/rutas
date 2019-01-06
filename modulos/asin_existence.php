<?php
	include("../lib/core.lib.php");
	$obj_general= new class_general;
	
	$tabla=$_REQUEST['tabla'];
	$campo=$_REQUEST['campo'];
	$valor_campo=$_REQUEST['valor_campo'];
	$id_campo_carga=$_REQUEST['id_campo_carga'];
	$id_tabla_edit=$_REQUEST['id_tabla_edit'];
	$valor_id_tabla_edit=$_REQUEST['valor_id_tabla_edit'];
	$id_tabla_add=$_REQUEST['id_tabla_add'];
	$valor_id_tabla_add=$_REQUEST['valor_id_tabla_add'];
	$id_sucursal=$_REQUEST['id_sucursal'];
	$valor_sucursal=$_REQUEST['valor_sucursal'];
	
	//cuenta las ocurrencias encontradas
	$res_general=$obj_general->get_dinamic($tabla,$campo,$valor_campo,$id_tabla_edit, $valor_id_tabla_edit,$id_tabla_add, $valor_id_tabla_add,$id_sucursal,$valor_sucursal);
	if($res_general){
		?>
        <script type="text/javascript" >
			res_existence('<?php echo $id_campo_carga; ?>');
        </script>
        <?php 
	}
?>