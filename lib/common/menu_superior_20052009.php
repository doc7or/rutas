<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN_ROOT; ?>css/cyberlux_menu_superior.css">
<script type="text/javascript" src="<?php echo DOMAIN_ROOT; ?>lib/js/anylink.js"></script>

<form id="buscador" name="buscador" method="post" target="principal" action="">
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0"  bgcolor="#000000">
  <tr >
    <td class="nav" width="5"><!--<img src="../images/menu/menu_01.gif" />--></td>
    <td class="nav"  valign="center">
    <!--TD Q CONTIENE EL MENU-->
    <!--VALIDACIONES DE TIPO DE CLIENTES ESTO CARGA LOS LINK PRINCIPALES DE EL MENU DE LOS Q SE DESPRENDERAN LOS SUB MENUS-->
    
    <!--VALIDACIONES DE TIPO DE CLIENTES-->
      <a href="" class="nav" onMouseover="dropdownmenu(this, event, 'anylinkmenu_1')" >MAESTROS</a>
			<div id="anylinkmenu_1" class="anylinkcss_rep">
			  
    <a  href="<?php echo DOMAIN_ROOT;?>modulos/cambiar_clave.php" target="">Cambiar Clave</a>
     <?php if(inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')){?>
     <a  href="<?php echo DOMAIN_ROOT;?>modulos/empresa_list.php" target="">Empresas</a>
	 <a  href="<?php echo DOMAIN_ROOT;?>modulos/escolta_list.php" target="">Escoltas</a>
     <a  href="<?php echo DOMAIN_ROOT;?>modulos/sucursal_list.php" target="">Sucursal</a>
     <a  href="<?php echo DOMAIN_ROOT;?>modulos/transportista_list.php" target="">Transportistas</a> 
     <a  href="<?php echo DOMAIN_ROOT;?>modulos/tabulador_costo_list.php" target="">Tabulador</a> 
     <a  href="<?php echo DOMAIN_ROOT;?>modulos/usuario_list.php" target="">Usuarios</a> 
     <a  href="<?php echo DOMAIN_ROOT;?>modulos/vehiculo_index.php" target="">Vehiculos</a> 
     <a  href="<?php echo DOMAIN_ROOT;?>modulos/zona_list.php" target="">Zonas</a>
	 <?php } ?> 
                
                  
            </div>
     
      &nbsp;|&nbsp;
	  <a href="" class="nav" onMouseover="dropdownmenu(this, event, 'anylinkmenu_2')">PROCESOS</a>
      <div id="anylinkmenu_2" class="anylinkcss_rep">
      		
             <?php
			 	 
			 	 if(inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')){
			 ?>
             	<a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list.php?tipo=1" target="">Forma Guia de Transporte</a>
            	<a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list.php?tipo=2" target="">Forma Guia de Traslado</a>
                <a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list.php?tipo=3" target="">Forma Guia Nota de Entrega</a>
                <a  href="<?php echo DOMAIN_ROOT;?>modulos/nomina_list.php" target="">Nomina</a>
                
                <!-- <a  href="<?php echo DOMAIN_ROOT;?>modulos/mov_facturas_list.php" target="">Movimientos de Facturas</a> -->
                
                
                
         
               <?php } ?>
        </div>
        
        &nbsp;|&nbsp; 
        <a href="" class="nav" onMouseover="dropdownmenu(this, event, 'anylinkmenu_3')">REPORTES</a>
<div id="anylinkmenu_3" class="anylinkcss_rep">
            	
                <a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list_xls.php?tipo=1" target="">Forma Guias de Trasnporte</a>
                <a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list_xls.php?tipo=2" target="">Forma Guias de Traslado</a>
                <a  href="<?php echo DOMAIN_ROOT;?>modulos/forma_guia_transporte_list_xls.php?tipo=3" target="">Forma Notas de Entrega</a>
                <?php if(inList($_SESSION['id_tipo_usuario'],'3,6')){ ?>
                	<a  href="<?php echo DOMAIN_ROOT;?>modulos/inconsistencia_vehiculos.php" target="">Inconsistencia de vehiculos</a>
				<?php } ?>
                <?php if(inList($_SESSION['id_tipo_usuario'],'3,4,6,7')){ ?>
                <a  href="<?php echo DOMAIN_ROOT;?>modulos/guias_diarias.php" target="">Guias diarias</a>
                <?php } ?>
                <?php if(!inList($_SESSION['id_tipo_usuario'],'')){ ?>
                <a  href="<?php echo DOMAIN_ROOT;?>modulos/seguro_list.php" target="">Seguro</a>
                <?php } ?>
			</div>
			&nbsp;|&nbsp;
	  		<a href="<?php echo DOMAIN_ROOT;?>/lib/common/logout.php" target="_parent" class="nav">SALIR</a>	  
      <!--TD Q CONTIENE EL MENU-->
      </td>
    <td align="right" valign="middle" background="../images/menu/menu_02.gif">
    <!-- <input name="id" type="text" class="estilo1" id="id" size="8" maxlength="11"/>&nbsp;<input name="Submit" type="submit" class="estilo1" value="Find" style="height:18px"  onclick="javascript:buscar();">-->
	</td>
    <td class="nav" width="5"><!--<img src="../images/menu/menu_03.gif" />--></td>
  </tr>
</table>
</form>
