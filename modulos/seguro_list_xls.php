<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_tipo_usuario'],'')) header('Location: ../lib/common/logout.php');

$obj_control_salida= new class_control_salida;
$obj_control_salida_detalle= new class_control_salida_detalle;
$obj_sucursal = new class_sucursal;
$arr_sucursal = $obj_sucursal->get_sucursal();


$id_sucursal=$_SESSION['id_sucursal'];
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
if($_REQUEST['id_sucursal']!='0' ) $id_sucursal=$_REQUEST['id_sucursal'];



if($id_sucursal && $mes && $anio)
{
	if ($id_sucursal==1 && $mes==10 && $anio==2012)
                    $arr_control_salida=$obj_control_salida->get_seguro_1($mes,$anio,$id_sucursal);
            else
	$arr_control_salida=$obj_control_salida->get_seguro($mes,$anio,$id_sucursal);
}
$titulo='Listado de Seguro';	
$forma_view='forma_guia_transporte_view.php?id=';  
$filename='reporte_seguro'.$id_sucursal.$mes.$anio;
//die();
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
header("Content-disposition: attachment;filename=".$filename.".xls ");




?>
<style type="text/css">
<!--
.style4 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: small; color: #FFFFFF; }
.style7 {font-family: Arial, Helvetica, sans-serif; font-size: x-small; }
-->
</style>


<table class="tablas_listados"  border="1">
  <!--ENCABEZADOS-->
  <tr class="tabla_barra_opciones" >
    <td colspan="9" align="left" bgcolor="#CCCCCC"><span class="form_titulo"><?php echo $titulo; 
							  
						?></span></td>
  </tr>
  <tr>
    <td height="10" colspan="9"></td>
  </tr>
  <tr class="tablas_listados_encabezados">
    <td width="4%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">No</div></td>
    <td width="8%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">Guia</div></td>
    <td width="11%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">Fecha</div></td>
    <td width="11%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">Placa</div></td>
    <td width="15%" bordercolor="#000000" bgcolor="#FF6600" ><div align="center" class="style4">Chofer</div></td>
    <td width="48%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">Facturas</div></td>
        <td width="11%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">Transportado</div></td>
        <td width="11%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">Con IVA</div></td>

     <td width="14%" bordercolor="#000000" bgcolor="#FF6600"  ><div align="center" class="style4">Destino</div></td>
  </tr>
  <!--ENCABEZADOS-->
  <!--DATOS-->
  <?php 
										for($i=0; $i<sizeof($arr_control_salida); $i++){			
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
									?>
  <tr class="<?php echo $clase;?>">
  	<td bordercolor="#000000" ><span class="style7"><?php echo $i+1; ?></span></td>
    <td bordercolor="#000000" ><span class="style7"><?php echo htmlentities($arr_control_salida[$i]['id_por_sucursal']); ?></span></td>
    <td bordercolor="#000000" ><span class="style7"><?php echo muestraFechaSola($arr_control_salida[$i]['fecha_salida'],'es'); ?></span></td>
    <td bordercolor="#000000" ><span class="style7"><?php echo $arr_control_salida[$i]['placa']; ?></span></td>
    <td bordercolor="#000000" ><span class="style7"><?php echo htmlentities($arr_control_salida[$i]['t_nombre'].' '.$arr_control_salida[$i]['t_apellido']); ?></span></td>
    <td bordercolor="#000000" ><span class="style7">
      <?php 
     if ($id_sucursal=="1" && $mes==10 && $anio==2012){
        $factur=$obj_control_salida_detalle->obtener_facturas_hoover($arr_control_salida[$i]['id']);
        $factur1=  explode('LM', $factur);
        $factur1[0]="";
        $factur=  implode(" ", $factur1);
        echo $factur;
        $dat_fac=  explode(",", $factur);
    }else{
      $factur=delCharEnd($string=$obj_control_salida_detalle->get_control_salida_string($arr_control_salida[$i]['id']),2);
      $dat_fac=array();
      $dat_fac=explode(',',$factur);
      echo $factur;// se imprime el numero de factura
    }

		?>
    </span></td>
    <td bordercolor="#000000"  align="right"><span class="style7"><?php
    
    //SE PUSO EL PREFIJO SEGUN COMO INGRESAN LOS NUMEROS DE LA FACTURA LOS USUARIOS EN CADA SUCURSAL
    if ($id_sucursal=="18"){
        $pre_fijo='00920';
    }else if ($id_sucursal=="2"){
        $pre_fijo='00900';
    }else if ($id_sucursal=="22"){
        $pre_fijo='00';
    }else if ($id_sucursal=="1"){
        $pre_fijo='0091';
    }
    $total_guia_factura=0;
    for ($ij=0;$ij<count($dat_fac);$ij++){
        if ($sucursal=="1")
            $dat_fac[$ij]=str_pad($dat_fac[$ij], 6, "0", STR_PAD_LEFT);
        $total_guia_factura+=$obj_control_salida_detalle->monto_factura(trim($dat_fac[$ij]));
   // echo  number_format($arr_control_salida[$i]['monto_facturas'], 2, ',', '.');  CODIGO VIEJO
        //echo $total_guia_factura." pre ".$pre_fijo.$dat_fac[$ij];
    }
     echo $total_guia_factura;
    ?>&nbsp;&nbsp;</span></td>
           <td bordercolor="#000000"  align="right"><span class="style7">
		<?php 
				if($arr_control_salida[$i]['fecha']>='2009-04-01 00:00:00') $iva=0.12; else $iva=0.09;
				echo number_format($total_guia_factura*$iva, 2, ',', '.') ;  
		?>&nbsp;&nbsp;
        
      </span></td>
    <td bordercolor="#000000"><span class="style7"><?php echo $arr_control_salida[$i]['ruta']; ?></span></td>
  </tr>
  <?php } ?>
  <!--DATOS-->
  <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
</table>

