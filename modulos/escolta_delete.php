<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,2,6')) header('Location: ../lib/common/logout.php');

$obj_escolta= new class_escolta;
$obj_empresa= new class_empresa;
$id=$_REQUEST['id'];
$arr_escolta=$obj_escolta->get_escolta($id);
$arr_empresa=$obj_empresa->get_empresa($arr_escolta[0]['id_empresa']);
$obj_cod_area_telefono = new class_cod_area_telefono;
$obj_log = new class_log;

	if($_REQUEST['acc']=='del'){
	$del_escolta=$obj_escolta->delete_escolta($id);
	
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=19;
	$id_registro=$res_add_empresa;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=3;
	$res_add_log=$obj_log->add_log($fecha,$id_log_tipo,$id,$id_usuario,$id_log_tabla,$fecha_control);
	header('Location: escolta_list.php');
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
                    <td colspan="6"><table class="tabla_opciones" >
                        <tr >
                          <td width="72%">&nbsp;</td>
                          <td width="28%"><table class="tabla_opciones" >
                              <tr align="center">
                                <td width="20%" >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%"  >&nbsp;</td>
                                <td width="20%" ><a href="escolta_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_maestros" >
                        <tr >
                          <td  colspan="3" class="form_titulo_acme"  align="center">Eliminar Escolta</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="360"></td>
                          <td width="1" ></td>
                      </tr>
                        <tr >
                          <td  class="form_label">Cedula :</td>
                          <td >
                            <div class="form_label_view" > <?php echo htmlentities($arr_escolta[0]['rif']);?> </div>                          </td>
                          
                        </tr>
                        <tr >
                          <td  class="form_label">Nombre :</td>
                          <td >
                          	<div class="form_label_view" > <?php echo htmlentities($arr_escolta[0]['nombre']);?> </div>
                         
                          </td>
                        </tr>
                        <tr>
                          <td  class="form_label">Apellido :</td>
                          
                          <td>
                          <div class="form_label_view" > <?php echo htmlentities($arr_escolta[0]['apellido']);?> </div>
                          
                          </td>
                        </tr>
                          <tr>
                          <td  class="form_label" >Telefono :</td>
                          <td>
                          <div class="form_label_view" > <?php echo htmlentities($arr_escolta[0]['telefono']);?> </div>
                        </td>
                        </tr>
                        <tr>
                          <td  class="form_label" >Telefono 2 :</td>
                          <td>
                           <div class="form_label_view" > <?php echo htmlentities($arr_escolta[0]['telefono2']);?> </div>
                       </td>
                        </tr>
                        <tr>
                          <td  class="form_label">Direcci&oacute;n :</td>
                          <td>
                          <div class="form_label_view" > <?php echo htmlentities($arr_escolta[0]['direccion']);?> </div>
                         </td>
                        </tr>
                        <tr>
                          <td  class="form_label">Empresa :</td>
                          <td>
                           <div class="form_label_view" > <?php echo htmlentities($arr_empresa[0]['descripcion']);?> </div>
                         
                          </td>
                        </tr>
                        <tr class="error_mesaje_acme" >
                          <td  colspan="3" id="mensaje_error" ></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" ></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
                        </tr>
                        <tr>
                          <td  colspan="3" align="center" >
                          <input name="save"  type="button" class="form_botones" id="save" style="cursor:hand" value="Eliminar"   onclick="confirmDelete('este escolta', '?id=<?php echo $id; ?>&acc=del')"//></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" id="load_datos_help" ></td>
                        </tr>
                    </table></td>
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
<script type="text/javascript">

//DECLARACION DE ARAY DEL FORM
		function cargaMyForm(){
			
				//DECLARACION DE ARAY DEL FORM
												
				var myForm='form1'; // nombre del forulario
				var myPase='accion';//campo que se usa para el pase seguro
				var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
				my_form_column = new Array();			my_form_tipo = new Array();
				my_form_column[0]='rif';				my_form_tipo[0]=7;
				my_form_column[1]='nombre';				my_form_tipo[1]=9;
				my_form_column[2]='apellido';			my_form_tipo[2]=9;
				my_form_column[3]='telefono';			my_form_tipo[3]=12;
				
				my_form_column[5]='direccion';			my_form_tipo[5]=1;
				my_form_column[6]='id_empresa';			my_form_tipo[6]=1;
				telefono2=$("#telefono2").val();
				//alert(telefono2);
				if(telefono2.length>0){
					my_form_column[7]='telefono2';		my_form_tipo[7]=12;
				}
												
				valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
		}
</script>
</html>
