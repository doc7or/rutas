<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,3,4,6,7')) header('Location: ../lib/common/logout.php');
$id=$_REQUEST['id'];
$obj_sucursal= new class_sucursal;
$obj_estado= new class_estado;
$arr_estado= $obj_estado -> get_estado();
$obj_cod_area_telefono = new class_cod_area_telefono;
$obj_log = new class_log;
$obj_zona= new class_zona;
$arr_sucursal=$obj_sucursal->get_list_sucursal($id);

//busca las zona y el estado
$arr_zona= $obj_zona -> get_list_zona($arr_sucursal[0]['ciudad'],'','');

$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=18;
	$id_registro=$id;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=7;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);



$arr_sucursal=$obj_sucursal->get_sucursal($id);
if($arr_sucursal[0]['naturaleza']==1)	$naturaleza='N';
if($arr_sucursal[0]['naturaleza']==2)	$naturaleza='J';
$rif=$naturaleza.'-'.$arr_sucursal[0]['rif'];


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
                                      <td width="20%" ><a href="sucursal_list.php" ><img  src="../images/listado.png"  title="Volver al listado de las sucursales" alt="Volver al listado"  style="border:none" /></a></td>
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
                                        <td  colspan="3" class="form_titulo_acme"  align="center">Sucursal</td>
                                    </tr>
                                    <tr >
                                        <td width="150"></td>
                                        <td width="358"></td>
                                        <td width="3" ></td>
                                    </tr>
                                        <tr >
                          <td  class="form_label">Rif:</td>
                          <td ><div class="form_label_view" ><?php echo htmlentities($rif);?></div>                       </td>
                          
                        </tr>
                                    <tr >
                                        <td  class="form_label">Nombre :</td>
                                        <td >
                                        <div class="form_label_view" ><?php echo htmlentities($arr_sucursal[0]['descripcion']);?></div>
                                                                                  </td>
                                    </tr>
                                      <tr>
                                        <td  class="form_label" >Telefono :</td>
                                        <td>
                                        <div class="form_label_view" ><?php echo htmlentities($arr_sucursal[0]['telefono']);?></div>
                                        </td>
                          </tr>
                        <tr>
                          <td  class="form_label" >Telefono 2 :</td>
                          <td>
                           <div class="form_label_view" ><?php echo htmlentities($arr_sucursal[0]['telefono2']);?></div>
                          </td>
                          </tr>
                                   <tr>
                          <td  class="form_label" >Responsable :</td>
                          <td>
                           <div class="form_label_view" ><?php echo htmlentities($arr_sucursal[0]['responsable']);?></div>
                                             </td>
                        </tr>
                                    <tr>
                                        <td  class="form_label">Direccion :</td>
                                        <td>
                                         <div class="form_label_view" ><?php echo htmlentities($arr_sucursal[0]['direccion']);?></div>
                                       </td>
                                    </tr>
                                    <tr>
                                      <td  class="form_label" >Estado :</td>
                                      <td>
                                     
                                    <div class="form_label_view" ><?php echo htmlentities($arr_zona[0]['estado']);?></div>                                     </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label" >Ciudad / Zona :</td>
                                        <td id="id_carga">
                                            <div class="form_label_view" ><?php echo htmlentities($arr_zona[0]['descripcion']);?></div>                                        </td>
                                    </tr>
                                     <tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="mensaje_error" ></td>
                                    </tr>
                                   <tr >
                                        <td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td  colspan="3" align="center" >&nbsp;</td>
                                    </tr>
                                    <tr >
                                        <td  colspan="3" height="10" >
                                        	                                      </td>
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
