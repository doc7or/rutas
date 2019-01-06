<?php 
include("../lib/core.lib.php");
//llamado de las clases
$obj_guia_carga= new class_guia_carga;
 
//buscamoe el listado de clientes asociados en este  control de salida getListConSalDetCli($id_control_salida)
	$arr_GCD=$obj_guia_carga->getListGCDCli('',$_REQUEST['id']);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>


</head>

<body id="todo">
<table class="tabla_pedido" width="900px" align="center"  cellpadding="0" cellspacing="0">
  
  
  <?php
	   		//inicializamos el indice de esscaneo
			$iSSe =0;
	   		for($iCli=0;$iCli<sizeof($arr_GCD);$iCli++){?>
  <tr  >
    <td width="67%" align="left"  class="impre_titulo1" colspan="2" ><?php echo 'Cliente : '.$arr_GCD[$iCli]['co_cli'].'   '.$arr_GCD[$iCli]['cliente']; ?></td>
  </tr>
  <!--declaro la tabla de abajo de las facturas-->
  <tr  >
    <td  align="center"  colspan="2"><table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
      <?php 
                //buscamos los datos de estas facturas getCSDCli($id_control_salida='',$cliente='')
                $arrGCDCli=$obj_guia_carga->getGCDInf('','',$_REQUEST['id']);
				for($iFact=0;$iFact<sizeof($arrGCDCli);$iFact++){
					
            ?>
      <tr >
        <td width="67%" align="left"  class="impre_titulo2" ><?php echo 'Control de Carga Numero : '.$arrGCDCli[$iFact]['fact_num']; ?></td>
      </tr>
      <!--declaro la tabla de abajo de los renglones-->
      <!--declaro la tabla de abajo de las facturas-->
      <tr  >
        <td  align="left"><table class="tabla_pedido" width="100%" cellpadding="0" cellspacing="0">
          <tr  >
            <td class="impre_titulo3" >Articulo</td>
            <td  class="impre_titulo3" >Cant</td>
          </tr>
          <?php 
                //buscamos los datos de los renglones de esta nota de entrea
                $arrGCDReng=$obj_guia_carga->get_GCDRInf($arrGCDCli[$iFact]['id']);
				for($iReng=0;$iReng<sizeof($arrGCDReng);$iReng++){
					//llamado de las clases para filas impares y pares  tabla_renglones_ina_num
						  if ($iReng % 2){
							$clase_text = "impre_renglones_imp_text";
							$clase_num = "impre_renglones_imp_num";
							} else{
							$clase_text = "impre_renglones_par_text";
							$clase_num = "impre_renglones_par_num";
						  }
            ?>
          <tr >
            <td height="18" class="<?php echo $clase_text; ?>" ><?php echo $arrGCDReng[$iReng]['co_art'].'  '.$arrGCDReng[$iReng]['art_des']; ?></td>
            <td class="<?php echo $clase_num; ?>" ><?php echo number_format($arrGCDReng[$iReng]['total_art'],0);
																		//buscamos el contep de los mismos
																		 $cont=$obj_guia_carga->getGCDRSelCon($arrGCDReng[$iReng]['id']);
																		 echo ' ('.$cont.') ';
																 ?></td>
          </tr>

<!--AQUI SE CARGARAN LOS SERIALES-->
	<?php if($cont){ ?>
         
          <tr  >
            <td colspan="2" align="left" class="impre_titulo5" >Seriales</td>
          </tr>
          <tr  >
            <td align="left" colspan="2" >
            <p style="height:10px">
            	
				 <?php
				 		$arrSerial=$obj_guia_carga->getGCDRSelAll($arrGCDReng[$iReng]['id']);
                       //buscamos los seriales
					   $salto=1;
					   
					   for($isel=0;$isel<sizeof($arrSerial);$isel++){ 
					   $longNum=strlen(sizeof($arrSerial));
					   
					   ?>
                       
						<font class="impre_serial" >
							<?php 
								$contador=$isel+1; 
								$strCont=completStr($contador,$longNum,'0');
								echo $strCont.'.) '.$arrSerial[$isel]['serial'];	?>&nbsp;</font>&nbsp;&nbsp;
				<?php 	$salto++;
						if($salto>4){ echo '<p style="height:10px">'; $salto=1; }
				 } ?>
            </td>
          </tr>
           <tr  >
            <td colspan="2" align="left" height="10"></td>
          </tr>
    <?php }else{ ?>
          <tr  >
            <td colspan="2" align="left" class="impre_titulo6" >Este Producto  No Incluye Seriales</td>
          </tr>
           <tr  >
            <td colspan="2" align="left" height="10"></td>
          </tr>
    
    <?php } ?>
<!--AQUI SE CARGARAN LOS SERIALES-->

          <?php  }//fin listado de renglones ?>
        </table></td>
      </tr>
      
      <?php  
	   			//incrementamos el indice de escaneo
					$iSSe++;
	   
	   			}//fin listado de facturas ?>
    </table></td>
  </tr>
  <!--fin de la declaracion de la tabla de facturas-->
  <?php }//fin listado de clientes ?>
  <tr>
  	<td align="center">
    	<input type="button" class="form_botones" value="Imprimir" onClick="window.print()">

  	</td>
  </tr>
</table>
</body>
</html>
