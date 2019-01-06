<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'6')) header('Location: ../lib/common/logout.php');

$obj_tabulador_costo= new class_tabulador_costo;
$arr_tabulador_costo=$obj_tabulador_costo->get_tabulador_costo();

for($i=0;$i<sizeof($arr_tabulador_costo);$i++){
	echo $arr_tabulador_costo[$i]['costo'].'<br>';
	
}
?>
