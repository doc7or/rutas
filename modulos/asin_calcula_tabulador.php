<?php
	include("../lib/core.lib.php");
	$obj_tabulador_costo= new class_tabulador_costo;
	$obj_empresa= new class_empresa;
	$obj_vehiculo_tipo= new class_vehiculo_tipo;
	$obj_vehiculo= new class_vehiculo;
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$destino=$_REQUEST['destino'];//zona destino
	$vehiculo=$_REQUEST['vehiculo'];//vehiculo
	$empresa_transportista=$_REQUEST['empresa_transportista'];//identificador de la empresa
	$valor_viaje=$_REQUEST['valor_viaje'];//campo donde  se colocara el valor del viaje
	$valor_escolta=$_REQUEST['valor_escolta'];//campo donde se cargara el valor del escolta// el escolta deberia estar en la tabla de tabulador con un id de vehiculo 
											  //por ejemplo el 7 este id no le correspondera a los vehiculos sio a los escoltas punto a comvenir 
	$valor_adelanto=$_REQUEST['valor_adelanto'];//campo donde se cargara el valor del del adelanto
	$valor_caleta=$_REQUEST['valor_caleta'];//campo donde se cargara el valor del caleta
	$valor_amarre=$_REQUEST['valor_amarre'];//campo donde se cargara el valor_amarre
	
//	echo $vehiculo; die();
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$arr_vehiculo=$obj_vehiculo->get_vehiculo('','','','','',$vehiculo);
	$arr_tabulador_costo=$obj_tabulador_costo->get_tabulador_costo('',$destino,$_SESSION['id_sucursal'],$arr_vehiculo[0]['id_tipo']);// el cuarto parametro corresponde a la session de sucursal paso este 																									  por ahorita como uno para probar
	$arr_empresa=$obj_empresa->get_empresa($empresa_transportista);
	$arr_vehiculo_tipo=$obj_vehiculo_tipo->get_vehiculo_tipo($arr_vehiculo[0]['id_tipo']);
	$arr_tabulador_costo_escolta=$obj_tabulador_costo->get_tabulador_costo('',$destino,$_SESSION['id_sucursal'],10);//el diez es el identificador del escolta
	//echo "costo ".$arr_tabulador_costo[0]['costo']."";
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$viaje=$arr_tabulador_costo[0]['costo'];//costo del viaje
	$escolta=$arr_tabulador_costo_escolta[0]['costo'];//esto lo hago por ensimita de lo q es el costo del escolta motivado a q esto no esta aun en sistema
	$adelanto=($viaje/100)*$arr_empresa[0]['adelanto'];//calculo el adelanto
	$caleta=$arr_vehiculo_tipo[0]['caleta'];//obtengo la caleta
	$amarre=$arr_vehiculo_tipo[0]['amarre'];//obtengo la caleta

    if ($empresa_transportista==586 || $empresa_transportista==585){
      //se coloca en 0 la cuenta de el cobro ya que la empresa es cyberlux y esta solo se selecciona para cargar guias de transporte en las que el cliente corre con el gasto del transporte.
      $viaje=0;
      $escolta=0;
      $adelanto=0;
      $caleta=0;
      $amarre=0;
    }
?>
<script type="text/javascript" >
	
	$("#<?php echo $valor_viaje; ?>").val('<?php echo $viaje;?>');
	$("#<?php echo $valor_escolta; ?>").val('<?php echo $escolta;?>');
	$("#<?php echo $valor_adelanto; ?>").val('<?php echo $adelanto;?>');
	$("#<?php echo $valor_caleta; ?>").val('<?php echo $caleta;?>');
	$("#<?php echo $valor_amarre; ?>").val('<?php echo $amarre;?>');
	
	calcular_totales();	
</script>
                                          
