<?php 
include("../lib/core.lib.php");
if($_SESSION['id_usuario']=='') header('Location: ../index.php');
//LLAMADO DE CLASES
$obj_vehiculo= new class_vehiculo;
$obj_empresa= new class_empresa;
//cargamos la data de los vehiculos

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
<title><?php echo SYSTEM_NAME; ?></title>
<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
<script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>

</head>




<body id="todo">
    <div id="contenedor" >
		<div id="header" ></div>
  		<div id="menu" >
          	<?php include ("../lib/common/menu_superior.php");?>
        </div>
  
		<div id="contenido" >
        <form name="form1" id="form1" method="post" action=""  >
        	<input type="hidden" value="" id="idGuiaCarga"  name="idGuiaCarga" />
   	    <div id="filtro" >
            	<div id="filtroTabla" >
                	<!--TABLA DE FILTROS -->
                	<!--TABLA DE FILTROS -->
                	<table class="tablas_procesos_datos">
                	  <tr>
                	    <td class="form_label_proceso" colspan="4">Transporte</td>
              	    </tr>
                	  <tr>
                	    <td class="form_label_proceso">Vehiculo: </td>
                	    <td  class="form_label_procesos_imp" id="id_carga_vehiculo">
						<?php $arr_vehiculo=$obj_vehiculo->get_pool_vehiculo('','','','1',$_SESSION['id_sucursal'],''); ?>
                	      <input type="hidden"  name="vehiculo_placa" id="vehiculo_placa" value="" />
                	      <input type="hidden"  name="vehiculo_tipo" id="vehiculo_tipo" value="" />
                	      <input type="hidden"  name="vehiculo_capacidad" id="vehiculo_capacidad" value="" />
                	      <select name="vehiculo" id="vehiculo" class="form_pool_proceso" onchange="carga_data_vehiculo('vehiculo','vehiculo_tipo','vehiculo_capacidad','vehiculo_mensaje','seccion_ruta')" >
                	        <option value="0">Seleccione...</option>
                	        <?php  
                                for ($i=0; $i<sizeof($arr_vehiculo);$i++) { ?>
                	        <option value="<?php echo $arr_vehiculo[$i]['id'];?>"> <?php echo htmlentities($arr_vehiculo[$i]['placa'].' --- '.$arr_vehiculo[$i]['tipo']);?></option>
                	        <?php }?>
              	        </select></td>
                	    <td    class="form_label_proceso">Transportista: </td>
                	    <td  class="form_label_procesos_imp" id="id_carga_transportista">
                        <select name="transportista" id="transportista" class="form_pool_proceso" >
                	      <option value="0">Seleccione...</option>
              	      </select></td>
              	    </tr>
                	  <tr>
                	    <td  class="form_label_proceso">Empresa: </td>
                	    <td class="form_label_procesos_imp" ><input name="empresa_transportista_nombre" type="text" id="empresa_transportista_nombre"  class="form_caja_proceso" readonly="readonly"
                                     />
                	      <input name="empresa_transportista" id="empresa_transportista"   class="form_caja_proceso"  type="hidden" /></td>
                	    <td class="tr_mensaje_ayuda" colspan="2" id="vehiculo_mensaje">&nbsp;</td>
              	    </tr>
                	  <tr>
                	    <td class="form_label_proceso" colspan="4">Control de Cargas</td>
              	    </tr>
                	  <tr>
                	    <td width="16%" class="form_label_proceso">Numero</td>
                	    <td   class="form_label_procesos_imp" colspan="3" >
                        	<input name="fact_num" type="text" 
                            id="fact_num"  class="form_caja_proceso" 
                            onchange="loadBasic('filtroResul','asin_not_ent_cyberlux.php',this.value)"
                            onKeyPress="return acceptNum(event)"
                            />&nbsp;
                       
                        </td>
                	   
              	    </tr>
              	  </table>
            	</div>
          </div>
          <!--DIV DE NUEVOS PROCESOS-->
                <div id="filtroResul"></div>
                <div id="filtroSuges"></div>
   </form>
                <div id="resul"></div>
                <div id="resulAccion"></div>
                <div id="resulGrafic" ></div>  
                <div id="cargaAsinc" ></div>
         
          <!--DIV DE NUEVOS PROCESOS-->
        </div>

		<div id="footer" >
		  <?php include ("../lib/common/footer.php"); ?>
		</div>
	</div>
</body>
  <script type="text/javascript">
		//DECLARACION DE ARAY DEL FORM
				function cargaMyForm(){
					
					var myForm='form1'; // nombre del forulario
					var myPase='accion';//campo que se usa para el pase seguro
					var myErrorMessage='mensaje_error'; //id donde se carga el error en el documento
					my_form_column = new Array();							my_form_tipo = new Array();
			
					my_form_column[0]='transportista';						my_form_tipo[0]=1;
					my_form_column[1]='vehiculo';							my_form_tipo[1]=1;
					
					cf=$("#totalReng").val();
					cc=2;
					
					//si hay por lo menos una entrada valida enviamos
					//declaracion de la variable de paso asincrona
					/*
						nombre: asinSubmitAsin
						divisores  ## de los strines mayores 
							idGuiaCarga@@vehiculo_placa@@vehiculo_tipo@@vehiculo_capacidad@@vehiculo@@transportista@@empresa_transportista@@pedido@@importe_@@generalidad_@@validador@@totalReng
							url				direccion del archivo
							campos			nombre del formulario
							idCarga			idCarga de el asincrono
							campoVal		campo de validacion
							url, campos, idCarga, campoVal   --> url##form##idCarga##campoVal   
						
						segundo divisor @@ de los string secundarios
							
						
					*/
					var url='asin_macro_manejo.php';
					var form='form1';
					var idCarga='cargaAsinc';
					var campoVal='';
					var strinSubmitAsin=url+'##'+form+'##'+idCarga+'##'+campoVal;
					var resp=valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage,strinSubmitAsin);
						
					
				}							
												
</script>
</html>
