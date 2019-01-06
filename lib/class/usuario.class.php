<?php 
class class_usuario {

/*
TABLA usuario
CAMPOS 	id,cedula,nombre,apellido,login,pass,id_tipo_usuario,status,email,id_sucursal
*/


	function get_usuario($login='',$pass='',$id='',$cedula='',$nombre='',$apellido='',$id_tipo_usuario='',$status='',$email='',$id_sucursal=''){
		$sQuery="SELECT * FROM usuario WHERE status = 1 ";
		if($login) {	$sQuery.="AND login = '$login' ";	}
		if($pass) {	$sQuery.="AND pass = '$pass' ";}
		if($id) {	$sQuery.="AND id = '$id' ";}
		if($cedula) {	$sQuery.="AND cedula = '$cedula' ";}
		if($nombre) {	$sQuery.="AND nombre = '$nombre' ";}
		if($apellido) {	$sQuery.="AND apellido = '$apellido' ";}
		if($id_tipo_usuario) {	$sQuery.="AND id_tipo_usuario = '$id_tipo_usuario' ";}
		if($status) {	$sQuery.="AND status = '$status' ";}
		if($email) {	$sQuery.="AND email = '$email' ";}
		if($id_sucursal) {	$sQuery.="AND id_sucursal = '$id_sucursal' ";}
	//	die($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
	}
	
	
	function get_list_usuario($id='',$login='',$pass='',$cedula='',$nombre='',$apellido='',$id_tipo_usuario='',$status='',$email='',$id_sucursal=''){
		$sQuery="SELECT
					usuario.id,usuario.nombre,usuario.apellido,usuario.login,usuario.pass,usuario.cedula,
					usuario.id_tipo_usuario,usuario.status,usuario.email,usuario.id_sucursal,
					usuario_tipo.descripcion AS tipo_usuario,
					sucursal.descripcion AS sucursal
				FROM
					usuario
					Inner Join usuario_tipo ON usuario.id_tipo_usuario = usuario_tipo.id 
					Inner Join sucursal ON usuario.id_sucursal = sucursal.id 
				WHERE
					1 = 1
				";
	   if($login) {	$sQuery.="AND usuario.login = '$login' ";	}
		if($pass) {	$sQuery.="AND usuario.pass = '$pass' ";}
		if($id) {	$sQuery.="AND usuario.id = '$id' ";}
		if($cedula) {	$sQuery.="AND usuario.cedula = '$cedula' ";}
		if($nombre) {	$sQuery.="AND usuario.nombre = '$nombre' ";}
		if($apellido) {	$sQuery.="AND usuario.apellido = '$apellido' ";}
		if($_SESSION['id_tipo_usuario']!=6) {	$sQuery.="AND usuario.id_tipo_usuario <> '6' ";}
		if($status) {	$sQuery.="AND usuario.status = '$status' ";} 
		else {	 if($_SESSION['id_tipo_usuario']!=6) {	$sQuery.="AND usuario.status <> '0' ";}	}
		if($email) {	$sQuery.="AND usuario.email = '$email' ";}
		if($id_sucursal) {	$sQuery.="AND usuario.id_sucursal = '$id_sucursal' ";}
	   $sQuery.="ORDER BY
					usuario_tipo.descripcion ASC,
					usuario.nombre ASC ";


		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
				
			}
			$i++;
		}
		return($res_array);
	
	}
	
	function add_usuario($cedula,$nombre,$apellido,$login,$pass,$id_tipo_usuario,$status,$email,$id_sucursal)
	{
		$query = "INSERT INTO usuario (cedula,nombre,apellido,login,pass,id_tipo_usuario,status,email,id_sucursal) 
				  VALUES ('$cedula','$nombre','$apellido','$login','$pass','$id_tipo_usuario','$status','$email','$id_sucursal')";
	//	die($query);
		$result=mssql_query($query);
		$val_id_control=$this->get_usuario($login,$pass,'',$cedula,$nombre,$apellido,$id_tipo_usuario,$status,$email,$id_sucursal);
		$new_id=$val_id_control[0]['id'];
		return($new_id);
		
	}
	
	
	function update_usuario($id='',$cedula='',$nombre='',$apellido='',$login='',$pass='',$id_tipo_usuario='',$status='',$email='',$id_sucursal='')
	{
		$query = " UPDATE usuario SET cedula='$cedula' ";
		if($nombre) $query .= " , nombre='$nombre' ";
		if($apellido) $query .= " , apellido='$apellido'";
		if($login) $query .= " , login='$login' ";
		if($pass) $query .= " , pass='$pass'";
		if($id_tipo_usuario) $query .= " , id_tipo_usuario='$id_tipo_usuario' ";
		if($status) $query .= " , status='$status' ";
		if($email) $query .= " , email='$email' ";
		if($id_sucursal) $query .= " , id_sucursal='$id_sucursal' ";
		$query .= "  WHERE  id = '$id'";
	//die($query);	
		$result=mssql_query($query);
		return $result;
	}
	
	function update_clave_usuario($id='',$pass='',$pass_old='')
	{
		$query = " UPDATE usuario SET  pass='$pass' ";
		$query .= "  WHERE  id = '$id' AND pass='$pass_old'";
	//die($query);	
		$result=mssql_query($query);
	//	die($result);
		return $result;
	}
	
	function delete_usuario($id)
	{
		$query = "UPDATE usuario set status=0 WHERE id = '$id'";
	//	die ($query);
		$result=mssql_query($query);
		return $result;
	}
	function delete_def_usuario($id)
	{
		$query = "DELETE FROM  usuario WHERE id = '$id'";
		$result=mssql_query($query);
	}
	
}
?>
