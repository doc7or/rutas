<?php
	include("../lib/core.lib.php");
	$obj_tabulador_costo= new class_tabulador_costo;
	$obj_log = new class_log;
	$id=$_REQUEST['id'];
	$costo=$_REQUEST['valor'];
	
	$udp_tabulador_costo=$obj_tabulador_costo->update_tabulador_costo($id,$costo);
		$arr_tabulador_costo=$obj_tabulador_costo->get_tabulador_costo($id);
		
			$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
			$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
			$id_log_tipo=17;
			$id_registro=$id;
			$id_usuario=$_SESSION['id_usuario'];
			$id_log_tabla=8;
			$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
		

?>