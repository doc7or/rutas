<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'1,6')) header('Location: ../lib/common/logout.php');
$obj_tabulador_costo= new class_tabulador_costo;
$obj_log = new class_log;


if($_REQUEST['accion']){
	//die('vamos bien');
	$id=$_REQUEST['id'];
	$descripcion=$_REQUEST['descripcion'];
	$monto=$_REQUEST['monto'];
	$forma=$_REQUEST['forma'];
	$res_add_recargos=$obj_tabulador_costo->add_recargos($id,$descripcion,$monto,$forma);
	
	/*
	$fecha=	guardafecha(date('d/m/Y h:i:s a'),'es');//obtengo la fecha actual
	$fecha_control=$fecha;//obengo la fecha sumnistrada para cambiarla a sql
	$id_log_tipo=16;
	$id_registro=$res_add_vehiculo_tipo;
	$id_usuario=$_SESSION['id_usuario'];
	$id_log_tabla=25;
	$res_add_log=$obj_log-> add_log($fecha,$id_log_tipo,$id_registro,$id_usuario,$id_log_tabla,$fecha_control);
	*/
		//ESTA ES UNA OPCION QUE SE CREARA AUTOMATICAMENTE CUANDO SE CRREE UN TIPO DE VEHICULO SE CREARAN LOS DIFERENTES TABULADORES DE COSTOS PARA LAS DIREFENTES SUCAURSALES Y ZONAS
	
	
	header('Location: tabulador_recargos_list.php');
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
                                <td width="20%" ><a href="tabulador_recargos_list.php" ><img  src="../images/listado.png"  title="Volver al listado" alt="Volver al listado"  style="border:none" /></a></td>
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
                          <td  colspan="3" class="form_titulo_acme"  align="center">Agregar Tabulador Recargo</td>
                        </tr>
                        <tr >
                          <td width="150"></td>
                          <td width="210"></td>
                          <td ></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Id:</td>
                          <td ><input name="id" type="text" class="form_caja" id="metraje_max"  maxlength="3"  onchange="existence('recargos','descripcion','descripcion','id','','','','','')"   />                          </td>
						  <td  rowspan="5"  class="tr_mensaje_ayuda"  id="tr_message"></td>
					    </tr>
                        <tr >
                          <td  class="form_label">Descripcion :</td>
                          <td ><input name="descripcion" type="text" class="form_caja" id="descripcion"  maxlength="25" onchange="existence('recargos','descripcion','descripcion','id','','','','','')"   onkeypress="return acceptNumAlfa(event)" />                          </td>
                          
                        </tr>
                        <tr >
                          <td  class="form_label">Valor :</td>
                          <td ><input name="monto" type="text" class="form_caja" id="monto"  maxlength="8"  /></td>
                        </tr>
                        <tr >
                          <td  class="form_label">Forma :</td>
                          <td >
							<select name="forma" id="forma" class="form_pool"  >
								<option value="1">Monto</option>
								<option value="2">Porcentaje</option>
							</select>
						  
                        </tr>
                        <tr class="error_mesaje_acme" >
                          <td  colspan="2" align="center"  ></td>
                        </tr>
                        <tr >
                          <td  colspan="3" height="10" ></td>
                        </tr>
                       <tr >
								<td  colspan="3" height="10" ><input type="hidden" id="accion" name="accion" value="" /></td>
							</tr>
							<tr>
								<td  colspan="3" align="center" >
							   
									 <input name="save" type="button" class="form_botones" id="save" style="cursor:hand" value="Agregar"   onclick="cargaMyForm()"/>                                     </td>
							</tr>
							<tr >
							  <td  colspan="3" height="10" id="load_datos_help" ></td>
							</tr>
							<tr >
							  <td  colspan="3" height="10"  id="campo de mensajes" align="justify">
							  
							  </td>
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
				my_form_column = new Array();		my_form_tipo = new Array();
				my_form_column[0]='id';	my_form_tipo[0]=1;
				my_form_column[1]='descripcion';		my_form_tipo[1]=1;
				my_form_column[2]='monto';			my_form_tipo[2]=1;
				my_form_column[3]='forma';	my_form_tipo[3]=1;
					
			valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage);
		}
		
		
	</script>
</html>
