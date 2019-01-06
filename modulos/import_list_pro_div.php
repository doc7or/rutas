
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>

<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
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
                <table align="center" width="101%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" >Movimiento de Importacion (proformas Divididas)</td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table width="100%"  >
                        <!--ENCABEZADOS-->
        <tr class="tabla_barra_opciones" >
                          <td colspan="6"><table class="tabla_opciones" >
                              <tr >
                                <td width="72%">&nbsp;</td>
                                <td width="28%"><table class="tabla_opciones" >
                                    <tr align="center">
                                      <td width="20%" >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  >&nbsp;</td>
                                      <td width="20%"  ><img src="../images/excel.png" title="Descargar Excel" alt="Descargar Excel" /></td>
                                      <td width="20%" ><a href="usuario_add.php" ><img src="../images/pluss.png" title="Adicionar" alt="Adicionar" style="border:none" /></a></td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                      </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="21%" class="form_sub_titulo_menor" >Proforma</td>
                          <td width="14%" class="form_sub_titulo_menor" >Principal</td>
                          <td width="18%" class="form_sub_titulo_menor" >Fecha de Creacion</td>
                          
                          <td width="47%"  align="center" class="form_sub_titulo_menor">Estado</td>
                      </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        
                        <tr>
                          <td bordercolor="#993366" class="tablas_listados_datos_imp" >256987-1</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_imp" >256987</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_imp" >12/11/2008</td>
                        
<td bordercolor="#993366" class="tablas_listados_datos_imp"><table class="tabla_opciones" >
                              <tr align="center">
                                <td  ><img  src="../imagenes_importa/accept.png"/></td>
                               	<td  ><img  src="../imagenes_importa/aad_s.png"/></td>
                                <td  ><img  src="../imagenes_importa/page_g.png"/></td>
                                <td ><img  src="../imagenes_importa/arrow_down_g.png"/></td>
                                <td ><img  src="../imagenes_importa/bl_g.png"/></td>
                                <td ><img  src="../imagenes_importa/hourglass_add_g.png"/></td>
                                <td ><img  src="../imagenes_importa/house_g.png"/></td>
                                <td ><img  src="../imagenes_importa/lorry_go_g.png"/></td>
                      </tr>
                          </table></td>
                      </tr>
                        <tr>
                          <td bordercolor="#993366" class="tablas_listados_datos_par" >256987-2</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_par" >256987</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_par" >12/11/2008</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_par"><table class="tabla_opciones" >
                            <tr align="center">
                              <td  ><img  src="../imagenes_importa/accept.png"/></td>
                              <td  ><img  src="../imagenes_importa/aad.png"/></td>
                              <td  ><img  src="../imagenes_importa/page.png"/></td>
                              <td ><img  src="../imagenes_importa/arrow_down.png"/></td>
                              <td ><img  src="../imagenes_importa/bl.png"/></td>
                              <td ><img  src="../imagenes_importa/hourglass_add.png"/></td>
                              <td ><img  src="../imagenes_importa/house.png"/></td>
                              <td ><img  src="../imagenes_importa/lorry_go.png"/></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                       	  <td bordercolor="#000000" class="tablas_procesos_titulo"  >256987-3</td>
                          <td bordercolor="#993366" class="tablas_procesos_titulo"  >256987</td>
                          <td bordercolor="#993366" class="tablas_procesos_titulo" >13/11/2008</td>
                          
                          <td bordercolor="#993366" class="tablas_listados_datos_imp"><table class="tabla_opciones" >
                            <tr align="center">
                              <td  ><img  src="../imagenes_importa/accept.png"/></td>
                              <td  ><img  src="../imagenes_importa/aad.png"/></td>
                              <td  ><img  src="../imagenes_importa/page.png"/></td>
                              <td ><img  src="../imagenes_importa/arrow_down.png"/></td>
                              <td ><img  src="../imagenes_importa/bl.png"/></td>
                              <td ><img  src="../imagenes_importa/hourglass_delete.png"/></td>
                              <td ><img  src="../imagenes_importa/house.png"/></td>
                              <td ><img  src="../imagenes_importa/lorry_go_g.png"/></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td bordercolor="#993366" class="tablas_listados_datos_imp" >5589sde588-1</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_imp" >5589sde588</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_imp" >15/11/2008</td>
                          <td bordercolor="#993366" class="tablas_listados_datos_imp"><table class="tabla_opciones" >
                            <tr align="center">
                              <td  ><img  src="../imagenes_importa/accept.png"/></td>
                              <td  ><img  src="../imagenes_importa/aad_g.png"/></td>
                              <td  ><img  src="../imagenes_importa/page_g.png"/></td>
                              <td ><img  src="../imagenes_importa/arrow_down_g.png"/></td>
                              <td ><img  src="../imagenes_importa/bl_g.png"/></td>
                              <td ><img  src="../imagenes_importa/hourglass_add_g.png"/></td>
                              <td ><img  src="../imagenes_importa/house_g.png"/></td>
                              <td ><img  src="../imagenes_importa/lorry_go_g.png"/></td>
                            </tr>
                          </table></td>
                        </tr>
                        
                        <!--DATOS-->
                        <!--PAGINADOR
                                  <tr>
                                        <td colspan="8"></td>
                                  </tr>
                                    PAGINADOR-->
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
</html>
