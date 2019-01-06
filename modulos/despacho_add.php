<?php 
include("../lib/core.lib.php");
$obj_sucursal= new class_sucursal;
$obj_estado= new class_estado;
$arr_estado= $obj_estado -> get_estado();

//insercion de sucursals
if($_REQUEST['accion']){
	$descripcion=$_REQUEST['descripcion'];
	$ciudad=$_REQUEST['ciudad'];
	$direccion=$_REQUEST['direccion'];
	
	$res_add_sucursal=$obj_sucursal->add_sucursal($descripcion,$ciudad,$direccion);
	header('Location: sucursal_list.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>

</head>

<body id="todo">

    <div id="contenedor" >
		  <div id="header" ></div>
  <div id="menu" >
          	<?php include ("../lib/common/menu_superior.php");?>
          </div>
		  <div id="contenido" > 
          	<div id="menu_visual" ></div>
            <div id="espacio_trabajo" >
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
			  <form name="form1" id="form1" action="" method="post"  >
   				<br />
				  <table align="center" width="80%" >
						
                        <tr class="tabla_barra_opciones" >
                          <td colspan="2"><table class="tabla_opciones" >
                              <tr >
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%" ><a href="sucursal_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
						<tr>
							<td  colspan="2" align="center" height="10"></td>
						</tr>
						<tr>
							<td  colspan="2" align="left">
								<table class="tablas_maestros" >
                                	<tr >
                                        <td  colspan="3" class="form_titulo_acme"  align="center">Agregar sucursal</td>
                                    </tr>
                                    <tr >
                                        <td width="150"></td>
                                        <td width="210"></td>
                                        <td ></td>
                                    </tr>
                                    <tr >
                                        <td  class="form_label">Nombre :</td>
                                        <td >
                                            <input name="descripcion" type="text" class="form_caja" id="descripcion"  maxlength="50" value=""  onfocus="message_help(0)"  onKeyPress="return acceptAlfaNombres(event)"/>                                        </td>
                                        <td  rowspan="4"  class="tr_mensaje_ayuda"  id="tr_message"></td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label">Direccion :</td>
                                        <td>
                                        	<textarea id="direccion" name="direccion" class="form_text" onfocus="message_help(9)" ></textarea></td>
                                    </tr>
                                    <tr>
                                      <td  class="form_label" >Estado :</td>
                                      <td>
                                      <select name="estado" id="estado" class="form_pool" onchange="load_pool('id_carga','asin_pool_zona.php','estado')"  onfocus="message_help(10)" >
                                          <option value="0">Seleccione...</option>
                                          <?php  
                                                for ($i=0; $i<sizeof($arr_estado);$i++) { ?>
                                          <option value="<?php echo $arr_estado[$i]['id']; ?>"> <?php echo $arr_estado[$i]['descripcion']; ?> </option>
                                          <?php }?>
                                        </select>                                      </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label" >Ciudad / Zona :</td>
                                        <td id="id_carga">
                                            <select name="ciudad" id="ciudad" class="form_pool"  onfocus="message_help(11)" >
                                              <option value="0">Seleccione...</option>
                                             </select>                                        
                                         </td>
                                    </tr>
                                     <tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="mensaje_error" ></td>
                                    </tr>
                                   <tr >
                                        <td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td  colspan="3" align="center" >
                                         <script type="text/javascript">
												//DECLARACION DE ARAY DEL FORM
												
												var myForm='form1'; // nombre del forulario
												var myPase='accion';//campo que se usa para el pase seguro
												var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
												my_form_column = new Array();			my_form_tipo = new Array();
												my_form_column[0]='descripcion';		my_form_tipo[0]=11;
												my_form_column[1]='direccion';			my_form_tipo[1]=1;
												my_form_column[2]='estado';				my_form_tipo[2]=1;
												my_form_column[3]='ciudad';				my_form_tipo[3]=1;
												
											
												
												
                                            </script>
                                            <input name="save"  type="button" class="form_botones" id="save" style="cursor:hand" value="Agregar"  onclick="valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage)"/>                                        </td>
                                    </tr>
                                    <tr >
                                        <td  colspan="3" height="10" ></td>
                                    </tr>
								</table>
						  </td>
						</tr>
                      
					   
						
			
			
					</table>
					</form>
			<!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
            </div>
		  </div>
		  <div id="footer" >
		  	<?php include ("../lib/common/footer.php"); ?>
          </div>
	</div>
</body>
</html>
