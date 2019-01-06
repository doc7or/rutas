<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,6,2,3,4,7')) header('Location: ../lib/common/logout.php');
$id=$_REQUEST['id'];
$obj_empresa= new class_empresa;
$obj_log = new class_log;
$arr_empresa=$obj_empresa->get_empresa($id);
if($arr_empresa[0]['naturaleza']==1)	$naturaleza='N';
if($arr_empresa[0]['naturaleza']==2)	$naturaleza='J';
$rif=$naturaleza.'-'.$arr_empresa[0]['rif'];

	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=18;
	$id_registro=$res_add_empresa;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=2;
	$res_add_log=$obj_log->add_log($fecha,$id_log_tipo,$id,$id_usuario,$id_log_tabla,$fecha_control);

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
		  <div id="header" >
          
          </div>
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
                          <td colspan="6"><table class="tabla_opciones" >
                              <tr >
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%" ><a href="empresa_list.php" ><img  src="../images/listado.png"  title="Volver al listado de empresas" alt="Volver al listado"  style="border:none" /></a></td>
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
                                        <td  colspan="3" class="form_titulo_acme"  align="center">Empresa</td>
                                  </tr>
                                    <tr >
                                        <td width="150"></td>
                                        <td width="361"></td>
                                      <td width="0" ></td>
                                  </tr>
									<tr >
                                        <td  class="form_label">Rif:</td>
                                  <td >
                                            <div class="form_label_view" >
                                       			<?php echo htmlentities($rif);?>                                            </div>                                       </td>
                                            
                                    </tr>
                                    <tr >
                                        <td  class="form_label">Nombre :</td>
                          <td >
                                           <div class="form_label_view" >
                                       			<?php echo htmlentities($arr_empresa[0]['descripcion']);?>                                            </div>                                        </td>
                                    </tr>
                                    <tr >
                                        <td  class="form_label">Direcci&oacute;n :</td>
                          <td >
                                           <div class="form_label_view" >
                                       			<?php echo htmlentities($arr_empresa[0]['direccion']);?>                                            </div>                                        </td>
                                    </tr>
                                    
                                   <tr>
                                        <td  class="form_label" >Telefono :</td>
                                        <td>
                                            <div class="form_label_view" >
                                       			<?php echo htmlentities($arr_empresa[0]['telefono']);?>                                            </div>                                        </td>
                                    </tr>
                                     <tr>
                                        <td  class="form_label" >Telefono 2 :</td>
                                        <td>
                                            <div class="form_label_view" >
                                       			<?php echo htmlentities($arr_empresa[0]['telefono2']);?>                                            </div>                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label">Responsable :</td>
                                        <td>
                                           <div class="form_label_view" >
                                       			<?php echo htmlentities($arr_empresa[0]['responsable']);?>                                            </div>                               
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label">Tipo :</td>
                                        <td>
                                          <div class="form_label_view" >
                                          		<?php if($arr_empresa[0]['tipo']==1) 
														echo htmlentities('Transportista');
													  else 
													  {
													  	if($arr_empresa[0]['tipo']==2)
															echo htmlentities('Escolta');
														else
															echo htmlentities('Debe definir el tipo de esta empresa');
													  }
												?>
                                       	  </div>                               
                                     </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label">Adelanto :</td>
                                        <td>
                                          <div class="form_label_view" >
                                       			<?php echo htmlentities($arr_empresa[0]['adelanto']);?>                                            </div>                               
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="form_label">Especial :</td>
                                        <td>
                                          <div class="form_label_view" >
                                       			<?php echo htmlentities($arr_empresa[0]['especial']);?>                                            </div>                               
                                        </td>
                                    </tr>
                                    <tr class="error_mesaje_acme" >
                                        <td  colspan="3" id="mensaje_error" ></td>
                                    </tr>
                                   <tr >
                                        <td  colspan="3" height="10" ></td>
                                    </tr>
                                  <tr >
                                        <td  colspan="3" height="10" >&nbsp;</td>
                                  </tr>
                                    <tr>
                                        <td  colspan="3" align="center" >
                                       </td>
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
