<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');
$obj_empresa= new class_empresa;

$obj_sucursal = new class_sucursal;

$id_sucursal=$_REQUEST['id_sucursal'];

if($id_sucursal){
	$arr_sucursal = $obj_sucursal->get_sucursal($_SESSION['id_sucursal']);
}


$titulo='Listado de empresas';	
$filename='listado_empresas';
//die();
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
header("Content-disposition: attachment;filename=".$filename.".xls ");




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


</head>

<body id="todo">
<table class="tablas_listados" >
  <!--ENCABEZADOS-->
  <tr  bgcolor="#CC9900" >
    <td width="55%" ><font color="#FFFFFF" ><strong>Empresa</strong></font></td>
    <td width="20%" ><font color="#FFFFFF"><strong>Rif</strong></font></td>
    <td width="10%" ><font color="#FFFFFF"><strong>Telefono</strong></font></td>
    <td width="15%"  align="center"><font color="#FFFFFF"><strong>Direccion</strong></font></td>
  </tr>
  <tr  bgcolor="#FFCC00">
    <td colspan="4" ><strong>Transportistas</strong></td>
  </tr>
  <tr  bgcolor="#666666">
    <td colspan="4" ><strong style="color:#FFF">Juridicas</strong></td>
  </tr>
  <!--ENCABEZADOS-->
  <!--DATOS-->
  <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];

							$arr_empresa=$obj_empresa->get_empresa('',2,1,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
  <tr >
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['descripcion']); ?></td>
    <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
    <td bordercolor="#993366"><?php echo htmlentities($arr_empresa[$i]['direccion']); ?></td>
  </tr>
  <?php } ?>
  <tr  bgcolor="#666666">
    <td colspan="4" ><strong style="color:#FFF">Naturales</strong></td>
  </tr>
  <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];
							
							$arr_empresa=$obj_empresa->get_empresa('','1,3',1,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
  <tr >
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['descripcion']); ?></td>
    <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
    <td bordercolor="#993366"><?php echo htmlentities($arr_empresa[$i]['direccion']); ?></td>
  </tr>
  <?php } ?>
  <tr bgcolor="#FFCC00">
    <td colspan="4" ><strong>Escoltas</strong></td>
  </tr>
 <tr  bgcolor="#666666">
    <td colspan="4" ><strong style="color:#FFF">Juridicas</strong></td>
  </tr>
  <!--ENCABEZADOS-->
  <!--DATOS-->
  <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];
							
							$arr_empresa=$obj_empresa->get_empresa('',2,2,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
  <tr >
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['descripcion']); ?></td>
    <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
    <td bordercolor="#993366"><?php echo htmlentities($arr_empresa[$i]['direccion']); ?></td>
  </tr>
  <?php } ?>
  <tr  bgcolor="#666666">
    <td colspan="4" ><strong style="color:#FFF">Naturales</strong></td>
  </tr>
  <?php 
							if($_REQUEST['id_sucursal']!='0' && $_REQUEST['id_sucursal']!='')	$id_sucursal=$_REQUEST['id_sucursal'];
							else $id_sucursal=$_SESSION['id_sucursal'];
							
							
							$arr_empresa=$obj_empresa->get_empresa('',1,2,$id_sucursal);							
							for($i=0; $i<sizeof($arr_empresa); $i++){			
	
							if ($i % 2){
								$clase = "tablas_listados_datos_par";
							} else{
								$clase = "tablas_listados_datos_imp";
									}
									?>
  <tr >
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['descripcion']); ?></td>
    <td bordercolor="#993366" ><?php 
								if($arr_empresa[$i]['naturaleza']==1)	$naturaleza='N';
								if($arr_empresa[$i]['naturaleza']==2)	$naturaleza='J';
								if($arr_empresa[$i]['naturaleza']==3)	$naturaleza='V';
								$rif=$naturaleza.'-'.$arr_empresa[$i]['rif'];
								echo htmlentities($rif); 
							?></td>
    <td bordercolor="#993366" ><?php echo htmlentities($arr_empresa[$i]['telefono']); ?></td>
    <td bordercolor="#993366"><?php echo htmlentities($arr_empresa[$i]['direccion']); ?></td>
  </tr>
  <?php } ?>
  <!--DATOS-->
  <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
</table> 
  
</html>
