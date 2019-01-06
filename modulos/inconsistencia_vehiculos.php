<?php 
include("../lib/core.lib.php");
if(!inList($_SESSION['id_tipo_usuario'],'6,3')) header('Location: ../lib/common/logout.php');
$obj_vehiculo= new class_vehiculo;
$placa='';
$id_tipo='';
$id_empresa='';
$id_sucursal='';
if(inList($_SESSION['id_tipo_usuario'],'6,3')) $status='1,2,3';
else $status='0,1,2,3';
$arr_vehiculo=$obj_vehiculo->get_list_vehiculo_inc($placa,$id_tipo,$id_empresa,$status,$id_sucursal);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>

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
                <table align="center" width="90%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" >Inconsistencia de Vehículos</td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left"><table class="tablas_listados" >
                        <!--ENCABEZADOS-->
                        <tr class="tabla_barra_opciones" >
                          <td colspan="6">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="10" colspan="6"></td>
                        </tr>
                        <tr class="tablas_listados_encabezados">
                          <td width="19%" >Tipo</td>
                          <td width="37%" >Empresa</td>
                          <td width="28%" >Placa</td>
                          <td width="28%" >Sucursal</td>
                          <td width="28%" >Estado</td>
                        </tr>
                        <!--ENCABEZADOS-->
                        <!--DATOS-->
                        <?php 
										$placa='';
										for($i=0; $i<sizeof($arr_vehiculo); $i++){	
										
										$arr_vehiculo=$obj_vehiculo->get_list_vehiculo_inc($placa,$id_tipo,$id_empresa,$status,$id_sucursal);		
        
										if ($i % 2){
											$clase = "tablas_listados_datos_par";
										} else{
											$clase = "tablas_listados_datos_imp";
												}
										if($placa_prueba==$arr_vehiculo[$i]['placa'])
										{	$color="#FFFF00"; }
										else
										{	$color="#FFFFFF"; }
										
									$placa_prueba=$arr_vehiculo[$i]['placa'];
									?>
                        <tr class="<?php echo $clase;?>">
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo[$i]['tipo']); ?></td>
                          <td bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo[$i]['empresa']); ?></td>
                          <td bgcolor="<?php echo $color; ?>" ><?php echo htmlentities($arr_vehiculo[$i]['placa']); ?></td>
                          <td  bordercolor="#993366" ><?php echo htmlentities($arr_vehiculo[$i]['sucursal']); ?></td>
                          <td align="center" bordercolor="#993366" >
						 <?php if($arr_vehiculo[$i]['status']==1){ ?>
                              <img src="../images/activo.png"  title="Activo" alt="Activo"  />
                              <?php }
							  if($arr_vehiculo[$i]['status']==2){ ?>
                              <img src="../images/inactivo.png"  title="Inactivo" alt="Inactivo"  />
                              <?php  }  
                              
							  if($arr_vehiculo[$i]['status']==0){ ?>
                              <img  src="../images/exclamation.png"  title="Eliminado" alt="Eliminado"  />
                              <?php  }  
                               
							  if($arr_vehiculo[$i]['status']==3){ ?>
                              <img   src="../images/lorry_go.png" title="En Servicio" alt="En Servicio"  />
                              <?php  } ?>                           </td>
                        </tr>
                        <?php } ?>
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
