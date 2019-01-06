<?php 
include("../lib/core.lib.php");
if(inList($_SESSION['id_usuario'],'')) header('Location: ../lib/common/logout.php');
//llamado de las clases
$obj_clientes= new class_clientes();//llamado de la tabla de clientes 
$obj_lin_art= new class_lin_art();//llamado de la clase de linea de articulos
$obj_art4= new class_art4();//clase de art4 o articulos de linea blanca para pedidos de tierra
$obj_tmp= new class_tmp();//clase de anejo de la p tabla de temporrales de pedidos
$obj_descuentos= new class_descuentos();//llamado de tabla de descuentos
$obj_xpedidos= new class_xpedidos();//xpedidos
$obj_xreng_ped= new class_xreng_ped();//xren_ped
$obj_bitacora= new class_bitacora();//llamado a la clase bitacora
$obj_pedidos= new class_pedidos();//pedidos
$obj_reng_ped= new class_reng_ped();//ren_ped
$obj_tpedidos= new class_tpedidos();//tpedidos
$obj_treng_ped= new class_treng_ped();//tren_ped
//llamado de las clases

//CONSULTAS PREVIAS A LA CARGA DE LA DATA

//AQUI SE CONSULTAN LOS CLIENTES DEL VENDEDR
$arr_clientes=$obj_clientes->get_list_clientes($_SESSION['uname']);//SE BUSCAN LOS cLIENTES	
//AQUI SE CONSULTARAN LAS LINEAS POR SER BLANCA AHORAQ CONSULTAREMOS SOLO LA LINEA BLANCA
$arr_lin_art=$obj_lin_art->get_lin_art('01,02,04');
//CONSULTAMOS LOS DESCUENTOS EXISTENTES
$arr_descuentos=$obj_descuentos->get_descuentos();

//CONSULTAS PREVIAS A LA CARGA DE LA DATA

//POSTERIORES AL SUBMIT

//obntengo los valores de las cajas 
$Menu1 = $_POST['op'];
$observaciones = $_POST['observaciones'];
$cliente = $_POST['cliente'];
//optengo la fecja de hoy para insertar en el pedido 
$fecha = date('Y-m-d');
//OPTENEMOS LOS VALORES DEL FORMULARIO
$arr_clientes_de=$obj_clientes->get_list_clientes('',$cliente);//BUSCO EL CLIENTE EN CONCRETO SELECCIONADO


//POSTERIORES AL SUBMIT


$Menu1 = trim($Menu1);
switch($Menu1) {  
   case "Ace.Client/Sub-Tot.":	
   
		//ELIMINAMOS LOS TEMPORALES EXISTENTES DEL USUARIO O VENDEDOR EN ESTE CASO
		$del_tmp=$obj_tmp->delete_tmp($_SESSION['uname']);
		
		//RECORRIDO POR TODO EL FORMULARIO HECHO DINAMICAMENTE
		foreach($_POST as $nombre_campo => $valor){ 
	 	    if ($valor <> "" && $valor <> "Terminar" && $valor>0  && $nombre_campo <> "cliente" && $nombre_campo <> "observaciones" && substr($nombre_campo,0,1) <> "X" && $nombre_campo<>"op"){ 
			  $l1   = $nombre_campo;//obtiene el codigo del articulo
			  $l2   = $valor;
			  //BUSCAMOS EL ARTICULO QL CUAL PERTENCESE ESTE CODIGO
			  $arr_art4_c=$obj_art4->get_art4($l1);
		      $l4    = $arr_art4_c[0]['prec_vta3'] * $l2;
			  //AHORA INSERTAMOS NUEVAMENTE EN LA TABLA TEMPORAL
			  
			    if ($l4>0) {
					//add_tmp($co_art,$total_art,$co_ven,$reng_neto)
					$add_tmp_new=$obj_tmp->add_tmp($l1,$l2,$_SESSION['uname'],$l4);
				}
			 } 
		}
		//cfreo los sucesivos foreach se deberiam menter en el mismp anterior
		//ESTE FOREACH TRABAJA EN FUNCION AL DESCUENTO desc
	    foreach($_POST as $nombre_campo => $valor){ 
	 	    if (substr($nombre_campo,0,1) == "X" && $valor!="0"){ 
			  	$l1= substr($nombre_campo,1);
			  	//editamos el campo de ser necesario PARA EL DESCUENTO
				//update_tmp($co_art='',$co_ven='',$desc='')
			  	$udp_tmp=$obj_tmp->update_tmp($l1,$_SESSION['uname'],$valor);
			 }
		} 
		//ESTE FOREACH TRABAJA EN FUNCION AL RENGLON NETO reng_neto
       foreach($_POST as $nombre_campo => $valor){ 
	   
	 	    if (substr($nombre_campo,0,1) == "P" && $valor<>""){ 
			//ahora vamos con los precios de los articulos
			  $l1     = substr($nombre_campo,1);
			  $arr_esp_tmp=$obj_tmp->get_esp_tmp($l1,$_SESSION['uname']);
			  $np     = $arr_esp_tmp[0]['total_art']*$valor;
			  //buscamos el precio tipo 5 para este tipo de carga
			  $arr_esp_art4=$obj_art4->get_esp_art4($l1,'');
			 //actulizzamos nuevamente ek temporal
				$udp_tmp=$obj_tmp->update_tmp_reng_neto($l1,$_SESSION['uname'],'',$np);
			 }
	   } 
		//obrtengop el total neto de lo que va del pedido	   
	   $arr_neto_tmp=$obj_tmp->get_neto_tmp($_SESSION['uname']);
       $Total    = number_format($arr_neto_tmp,2,".",",");
   	   $Mensaje = "Sub-Total: $Total, Cliente: $cliente, $arr_clientes_de[0]['cli_des']";	
	  
   break;    		    
	  
   case "Terminar":     
   		//seleccionamos el total de los articulos por codigo que tiene este  vendedor en la tabla de tempral 
  		$bus_tmp=$obj_tmp->get_art_tmp('',$_SESSION['uname']);
		$cuantos  = sizeof($bus_tmp);
		if ($cuantos >0) {// si hay temporales en la tabla tmp para el usuario
 		if (!empty($_SESSION['uname'])){//si la sesion no esta activa
		
			//borramos los temporales de la stablas xrengron pedidos xpedidos delete_xpedidos($co_ven) delete_xreng_ped($co_ven)
			$del_xpedido=$obj_xpedidos->delete_xpedidos($_SESSION['uname']);
			$del_xreng_ped=$obj_xreng_ped->delete_xreng_ped($_SESSION['uname']);
			//insertamos ahora en xpedidos y obtenemos su indicador
			//volvemos a la foma que actualmente uso para pase de parametos 25052009
			$fact_num='';
			$co_cli=$cliente;
			$fec_emis=$fecha;
			$tot_bruto=0.00;
			$iva=0.00;
			$tot_neto=0.00;
			$descrip=$observaciones;
			$co_ven=$_SESSION['uname'];
			$cli_des=$cliente;
			//inserto el pedido
			$fact_num =  $obj_xpedidos->add_xpedidos($co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$cli_des);
			$Total    = 0;
		    $Iva      = 0;
			
	      
			 //buscamos en la tabla tmp por vendedor y ordenamos por codifo de articulo
			 $arr_tmp_x=$obj_tmp->get_tmp('',$co_ven);
			 for($ix=0;$ix<sizeof($arr_tmp_x);$ix++){
				// echo  'esto si es <br>';
				 //insertamos en al tabla de resnglones x
				 //$fact_num,$co_art,$total_art,$prec_vta,$reng_neto,$reng_num,$tipo_imp,$co_ven,$desc
				 
				  ///consegimos el descuento que va atener el renglon neto y asi poder netear el valor realmente
				 if($arr_tmp_x[$ix]['desc']==0) {	
				 	//como el porcentaje de descuento le damos unon porq sera el neto completo son descuento
				 	$porc_neto=1; 	
				}else {		
					  //BUSCAMOS EL DESCUENTO Q PERTENECE ESTE ARTIDULO get_descuentos($id='')
			  		$arr_esp_art=$obj_descuentos->get_descuentos($arr_tmp_x[$ix]['desc']);
					//si no es cero es decir hayd escuento entonces le restamos a 100 el descuento eso no sdara por ejemplo 100-12.5=87.5 eso entre 100 nos 
					//da 0.875 que nos permitira mulrimplicar el neto para obtenero el valor real del neto ahora descontado 	
					$porc_neto=(100-$arr_esp_art[0]['valor_numerico'])/100;	
				}
				 
				 $reng_num = $ix + 1;
				 $tipo_imp='';
				 $reng_neto=$arr_tmp_x[$ix]['reng_neto']*$porc_neto;// aqui multipplicamos por el bneto para obtenert el neto verdadero
				 $reng_neto_puro=$arr_tmp_x[$ix]['reng_neto'];// aolos dejamos el neto verdadero
				 $Total = $Total + $reng_neto;
				 $Iva   = $Iva + ($reng_neto* 0)/100; 
				 $prec_vta=$reng_neto_puro/$arr_tmp_x[$ix]['total_art'];
				 //se hace el inser correspondiente en los renglones de pedido x 
				 //add_xreng_ped($fact_num,$co_art,$total_art,$prec_vta,$reng_neto,$reng_num,$tipo_imp,$co_ven,$desc)
				 $new_xreng=$obj_xreng_ped->add_xreng_ped($fact_num,$arr_tmp_x[$ix]['co_art'],$arr_tmp_x[$ix]['total_art'],$prec_vta,$reng_neto,$reng_num,$tipo_imp,$co_ven,$arr_tmp_x[$ix]['desc']);
			}
			 
		    $Totalg = $Total + $Iva;
			//actualizamos la tabla de xpedidos con los totales de los articulos estos son los parametros ($fact_num,$tot_bruto,$iva,$tot_neto,$descrip
			$udp_xpedidos=$obj_xpedidos->update_xpedidos($fact_num,$Total,$Iva,$Totalg,$observaciones);			
			//y caemos e la opcionde donde se me mostraran los datos finales del pedido osaea como la factura
		 }else {//si no se a logeado
			 $Mensaje="Cierre Session e Inicie Session de Nuevo";
 		   
		  }	
  		 } else{//mandamos un mensaje si no existen datos cargados para este usuario
			  $Mensaje="No ha Procesado Ninguna Venta";
		   
		 }
		 
		//HACEMOS LA CARGA DE LOS DATOS A USAR SI ES LA OOPCION DE TERMINAR
		$arr_t_xpedidos=$obj_xpedidos->get_xpedidos($fact_num);
		//BUSCAMOS EL CLIENTE QUE CORRESPONDE  A ESTE PEDIDO
		$arr_t_clientes=$obj_clientes->get_list_clientes('',$arr_t_xpedidos[0]['co_cli']);
		
		
		
		
		 
	break;    
	
	case "Finalizar":
		
		$hora_trun = date("H:i a");//la hora tuncada hasta el minuto
		$sucu   = "04";//sucursal
		$QueDes = "";
		
		
	    $co_ven    = $_SESSION['uname'];//recivi ek identificador del vendedor
		$hoy    = getdate();//la fecha de hot
		$fecha  = "$hoy[year]-$hoy[mon]-$hoy[mday]";//la descomponemos para guardarla enla base de datos
		$tiempo = time (); //devuekve ek tiempo actual segundos
		$hora   = date ( "h:i:s" , $Tiempo ); // formateo la hora
		$IP     = $REMOTE_ADDR; //ip de donde se conecta  el usuario
		$HOST   = gethostbyaddr($_SERVER['REMOTE_ADDR']); //PHP 5			
		$NAV    = $HTTP_USER_AGENT;// navegador
		//SELECCIONAMOS TODOS LOS XPEDIOSOS DEL VENDEDOR ACTUALMENTE get_xpedidos($fact_num='',$co_ven='')
		$arr_f_xpedidos=$obj_xpedidos->get_xpedidos('',$co_ven);
		
		
		//DATOS DEL PEDIDO X
		$fact_num=$arr_f_xpedidos[0]['fact_num'];//NUMERO DE EL PEDIDO O LLAMADO NUMERO FACTURA
		$co_cli=$arr_f_xpedidos[0]['co_cli'];//CODIGO DEL CLIENTE
		$fec_emis=$arr_f_xpedidos[0]['fec_emis'];//FECHA DE EMISION
		$tot_bruto=$arr_f_xpedidos[0]['tot_bruto'];//TOTAL BRUTO
		$iva=$arr_f_xpedidos[0]['iva'];//IVA
		$tot_neto=$arr_f_xpedidos[0]['tot_neto'];//total neto
		$descrip=$arr_f_xpedidos[0]['descrip'];//descrip
		$tipo=$sucu;//tipo
		$hora=$hora_trun;//la hora truncada
		$co_sucu=$sucu;//co_sucu
		//DATOS DEL PEDIDO X
		
		
		///creamo s variable que pasaremos para imprimirse si es un envio o para la bitacora
		$detalle_proceso = "Elaboro Un Pedido, #. $fact_num";		
		
		//insertamos la bitacora add_bitacora($co_ven,$hora,$fecha,$proceso,$ip,$host,$navegador)
		$new_bitacora=$obj_bitacora->add_bitacora($co_ven,$hora,$fecha,$detalle_proceso,$IP,$HOST,$NAV);

		//INSERTAMOS EN LA TABLA DE PEDIDOS
		//add_pedidos($fact_num,$co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$tipo,$hora,$co_sucu);
		$new_pedidos=$obj_pedidos->add_pedidos($fact_num,$co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$tipo,$hora,$co_sucu);
		
		//INSERTAMOS EN LA TABLA DE TPEDIDOS
		//add_tpedidos($fact_num,$co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$tipo,$hora,$co_sucu);
		$new_tpedidos=$obj_tpedidos->add_tpedidos($fact_num,$co_cli,$fec_emis,$tot_bruto,$iva,$tot_neto,$descrip,$co_ven,$tipo,$hora,$co_sucu);
	
		//BUSCAMOS LOS RENGLONES DE LOS PEDIDOS DE X
		$arr_f_xreng_ped=$obj_xreng_ped->get_xreng_ped($fact_num);
	    
	    
		$cont  = 0;
	    for($i=0;$i<sizeof($arr_f_xreng_ped);$i++) { 
			  $xco_art = $arr_f_xreng_ped[$i]['co_art'];
			  $xtotal_art = $arr_f_xreng_ped[$i]['total_art'];
			  $xprec_vta = $arr_f_xreng_ped[$i]['prec_vta'];
			  $xreng_neto = $arr_f_xreng_ped[$i]['reng_neto'];
			  $xdesc = $arr_f_xreng_ped[$i]['desc'];	
				//BUSCAMOS EL DESCUENTO Q PERTENECE ESTE ARTIDULO get_descuentos($id='')
			  $arr_esp_art=$obj_descuentos->get_descuentos($xdesc);
				  if ($xdesc>0) {
					$QueDes .= '['.$xco_art.' | '.$arr_esp_art[0]['descripcion'].']';
					}
				
				
			  //BUSCAMOS LOS DATOS DE EL ARTICULO
			  $arr_f_art4=$obj_art4->get_camp8_art4($xco_art);
			  $can_stock       = $arr_f_art4[0]['stock_act'] - $xtotal_art;//par contar o descontar al stock
			  $TPE2      = "PFJ";//indica la sucursal
			  
			  //ACTUALIZAMOS LA TABLA DE ARTICULOS CON EL NUEVO STOCK
			  $udp_stock_act=$obj_art4->update_stock_act_art4($xco_art,$can_stock);
			   
			  $cont++; 
			  //INSERTAMOS EN LA TABLA TRENG_PED y RENG PED
			  $new_f_treng_ped=$obj_treng_ped->add_treng_ped($fact_num,$xco_art,$xtotal_art,$xprec_vta,$xreng_neto,$cont,$TPE2,$arr_esp_art[0]['valor_formula']);
			  $new_f_reng_ped=$obj_reng_ped->add_reng_ped($fact_num,$xco_art,$xtotal_art,$xprec_vta,$xreng_neto,$cont,$TPE2,$arr_esp_art[0]['valor_formula']);
		}		
		//actualizamoss el string q ue contiene los codigos de articuilos y el descuento en pedidos y en t pedidos 
		$udp_f_d_tpedidos=$obj_tpedidos->update_tpedidos_desc($QueDes,$fact_num);
		$udp_f_d_pedidos=$obj_pedidos->update_pedidos_desc($QueDes,$fact_num);
		//eliminamos los temprales de el vendedor
		$del_f_tmp=$obj_tmp->delete_tmp($co_ven);
		//eliminamos tambien los pedidos de las  tablas x
		$del_f_xreng_ped=$obj_xreng_ped->delete_xreng_ped_factura($fact_num);
		$del_f_xpedidos=$obj_xpedidos->delete_xpedidos_factura($fact_num);
		
		
	break;
  	    


}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="Author" CONTENT="Roberth Navarro para Cyberlux de  Venezuela">
    <meta name="Language" CONTENT="Spanish">
    <meta name="Robots" CONTENT="All">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<META NAME="title" CONTENT="<?php echo SYSTEM_NAME; ?>">
    
    
<link REV="made" href="mailto:roberthmnp@gmail.com">
<link href="../css/fastWareHouse_movil.css" rel="stylesheet" type="text/css" />
<title><?php echo SYSTEM_NAME; ?></title>
<script language="javascript" src="../lib/js/jquery/jquery.js"></script>
<script language="javascript" src="../lib/js/jquery/form.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<script type="text/javascript" src="../lib/js/funct_form_val.js"></script>

</head>
<body class="thrColLiqHdr">
<!--ESTE ES EL BODY-->
	<div id="container">
    <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
        <div id="header">
        <!--ESTE ES EL HEADER-->
        <!--ESTE ES EL HEADER-->
        </div>
        <div id="mainContent">
             <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
             
                
              <form name="form1" id="form1" action="" method="post"  >
               
               <?php if(($Menu1!='Terminar') && ($Menu1!='Finalizar')){?>
                  <table width="100%" align="center" class="tablas_listados_datos" >
                    <tr>
                      <td  colspan="2" class="tabla_barra_opciones"  >
                      <table class="tabla_opciones" >
                        <tr >
                          <td width="63%" align="left">Opciones</td>
                          <td width="37%"><table class="tabla_opciones" >
                            <tr align="center">
                              <td width="20%" >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%" ><a href="menu_visual.php" ><img  src="../images/listado.png"  title="Volver al menu" alt="Volver al menu"  style="border:none" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td  colspan="2" align="left" height="10" class="tablas_pedidos_resg">Por favor verifique antes de guardar</td>
                    </tr>
                    <tr>
                      <td  colspan="2" align="left"><table class="tabla_opciones" >
                        <tr >
                          <td align="left" class="tablas_pedidos_bolg" >Observaciones</td>
                         
                        </tr>
                        <tr >
                          <td  align="left" ><span class="form_label_procesos_imp">
                            <textarea id="observaciones" name="observaciones" class="tabla_pedido_tarea"><?php  echo $observaciones;?></textarea>
                          </span></td>
                        </tr>
                        <tr >
                          <td align="left" class="tablas_pedidos_bolg" >Cliente </td>
                        </tr>
                        <tr >
                          <td align="left" >
                          <select name="cliente" id="cliente" class="tabla_pedidos_pool_cli"   >
                           
                              <?php  
                                for ($i=0; $i<sizeof($arr_clientes);$i++) { 
								$Nombre = substr($arr_clientes[$i]['cli_des'],0,30);?>
	                             <option value="<?php echo $arr_clientes[$i]['co_cli'];?>" <?php if($arr_clientes[$i]['co_cli']==$cliente){  echo 'selected'; } ?>> <?php echo $Nombre;?> </option>
                              <?php }?>
                              

                            </select> 
                          </td>
                        </tr>
                        <tr >
                          <td align="left" class="tablas_pedidos_bolg" >Proceso del pedido</td>
                         
                        </tr>
                        <tr >
                          <td  align="left" ><span class="form_label_procesos_imp"><?php  echo $Mensaje;?>
                          </span></td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">Guardar antes de salir</td>
                        </tr>
						<tr >
                          <td  align="left" >
                            <input type="submit" name="op" id="op" value="Ace.Client/Sub-Tot." class="form_boton_grande"  >
                            <input type="submit" name="op" id="op" value="Terminar" class="form_boton_grande"  >
                            
                         </td>
                        </tr>
                        <tr >
                          <td  align="left" >&nbsp;</td>
                        </tr>
                        <tr >
                          <td  align="left" >
                          	<table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
                        		<tr  >
                                  <td width="147" class="tabla_pedidos_titulos" >Producto</td>
                                  <td width="32" class="tabla_pedidos_titulos" >Cant</td>
                                  <td width="45" class="tabla_pedidos_titulos" >P.Ven</td>
                                  <td width="54" class="tabla_pedidos_titulos" >Total</td>
                                 
                                </tr>
                                <!--AQUI VA LAS COSAS DE EL PEDIDO0 TANTO LA DIVISION POR LINEAS COMO LOS PRODUCTOS EN SI-->
                                <?php for($il=0;$il<sizeof($arr_lin_art);$il++){?>
                                    <tr >
                                      <td colspan="4" class="tabla_pedidos_titulos_sub" ><?php echo strtoupper($arr_lin_art[$il]['lin_des']); ?></td>
                                     </tr>
                                     <!--AQUI ESTARA EL LSIADO DE ARTICULOS-->
                                     <?php  
									 	//consulto los articulos por el id de esta linea
									 	$arr_art4=$obj_art4->get_art4('',$arr_lin_art[$il]['co_lin']);
									 	for($ip=0;$ip<sizeof($arr_art4);$ip++){
										
										//variables usadas en el sintones vfnet
										 $Pre = number_format($arr_art4[$ip]['prec_vta1'],2,'.',',');
										 //defino el nombre del campo que va acontener el codigo de articulo
										  $codigo    = $arr_art4[$ip]['co_art'];//aun no lo veo necesario
										  //defino el nombre del campo que va acontener el valor del articulo
										  $xdes      = "X";
										  $xdes      .= $arr_art4[$ip]['co_art'];
										 
										  //defino el nombre del campo que va acontener el descuento de articulo
										  $xnpre     = "P";
										  $xnpre    .= $arr_art4[$ip]['co_art'];			  
										  $Total_Art = "";
										  //llamado de las clases para filas impares y pares
										  if ($ip % 2){
											$clase = "tablas_pedidos_datos_par";
											} else{
											$clase = "tablas_pedidos_datos_imp";
										 }
									?>
                                            <tr >
                                              <td class="<?php echo $clase; ?>"  width="165" >
                                              	<font class="tablas_pedidos_txt"><?php echo $arr_art4[$ip]['art_des']; ?></font><br />
                                                <font class="tablas_pedidos_bol"><?php echo $arr_art4[$ip]['co_art']; ?></font>&nbsp;
                                                <font class="tablas_pedidos_res"><?php echo $arr_art4[$ip]['campo6']; ?></font>
                                                </td>
                                              <?php 
											  	//buscamos en el temporal si existe este articulo previamente cargado
												$arr_tmp=$obj_tmp->get_tmp($arr_art4[$ip]['co_art'],$_SESSION['uname']);
												//variables del vfnet
												   $desc         = $arr_tmp[0]['desc'];//optengo la descripcion del teporal
												   $pvp_original = $arr_art4[$ip]['prec_vta3'];//obtengo el precio original de productor
												   //calclos que aun no se que hacen
												   if ($arr_tmp[0]['total_art'] > 0) $Total_Art = $arr_tmp[0]['total_art'];			  
												   if ($arr_tmp[0]['reng_neto'] > 0)  $pvp_original = $arr_tmp[0]['reng_neto']/$arr_tmp[0]['total_art'];
											  ?>
                                              <td   class="<?php echo $clase; ?>" align="center"  width="35" ><samp><input name="<?php echo $codigo; ?>" id="<?php echo $codigo; ?>" type="text" value="<?php echo $Total_Art; ?>"  maxlength="4" class="tabla_pedidos_caja"></samp></td>
                                              <td   class="<?php echo $clase; ?>" width="50">
                                              	<select name="<?php echo $xdes; ?>" id="<?php echo $xdes; ?>" class="tabla_pedidos_pool"   >
                                                   <option value="0"></option>
                                                  <?php  
                                                    for ($j=0; $j<sizeof($arr_descuentos);$j++) { ?>
                                                     <option value="<?php echo $arr_descuentos[$j]['id'];?>" <?php if($desc==$arr_descuentos[$j]['id']) echo 'selected'; ?>> <?php echo  $arr_descuentos[$j]['descripcion'];?> </option>
                                                  <?php }?>
                                                  
                    
                                                </select> 
                                              </td>
                                              <td  class="<?php echo $clase; ?>" width="50" ><input disabled="disabled" name="<?php echo $xnpre; ?>" id="<?php echo $xnpre; ?>" type="text" value="<?php echo $pvp_original; ?>"  maxlength="7" class="tabla_pedidos_nume"></td>
                                            </tr>
                                     <?php } ?>
                                    
                                <?php } ?>  
                            </table>
                          </td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
                        </tr>

                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">Guardar antes de salir</td>
                        </tr>
						<tr >
                          <td  align="left" >
                            <input type="submit" name="op" id="op" value="Ace.Client/Sub-Tot." class="form_boton_grande"  >
                            <input type="submit" name="op" id="op" value="Terminar" class="form_boton_grande"  >
                            
                         </td>
                        </tr>
                      
                        
                        
                      </table></td>
                    </tr>
                  </table>
                  
                  <?php }
				  	if($Menu1=='Terminar'){
				  ?>
                  <table width="100%" align="center" class="tablas_listados_datos" >
                    <tr>
                      <td  colspan="2" class="tabla_barra_opciones"  >
                      <table class="tabla_opciones" >
                        <tr >
                          <td width="63%" align="left">Opciones</td>
                          <td width="37%"><table class="tabla_opciones" >
                            <tr align="center">
                              <td width="20%" >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%" ><a href="menu_visual.php" ><img  src="../images/listado.png"  title="Volver al menu" alt="Volver al menu"  style="border:none" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td  colspan="2" align="left" height="10" class="tablas_pedidos_resg">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="47%" height="10" align="left" class="tablas_pedidos_bolg" >Pedido : <?php echo $arr_t_xpedidos[0]['fact_num']; ?></td>
                      <td width="53%" height="10" align="left" class="tablas_pedidos_bolg" >Fecha : <?php echo $arr_t_xpedidos[0]['fec_emis']; ?></td>
                    </tr>
                    <tr>
                      <td  colspan="2" align="left">
                      <table class="tabla_opciones" >
                       
                       
                        <tr >
                          <td align="left" class="tablas_pedidos_bolg" >Observaciones</td>
                         
                        </tr>
                        <tr >
                          <td  align="left" ><span class="form_label_procesos_imp">
                            <?php  echo $arr_t_xpedidos[0]['descrip'];?>
                          </span></td>
                        </tr>
                        <tr >
                          <td align="left" class="tablas_pedidos_bolg" >Cliente </td>
                        </tr>
                        <tr >
                          <td align="left" >
                         	<?php echo $arr_t_clientes[0]['co_cli'].' - '.$arr_t_clientes[0]['cli_des']; ?>
                          </td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">Para Finalizar el pedido</td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg"><?php echo $Mensaje; ?></td>
                        </tr>
                        
						<tr >
                          <td  align="left" ><input type="submit" name="op" id="op" value="Finalizar" class="form_boton_grande"  >
                            
                         </td>
                        </tr>
                        <tr >
                          <td  align="left" >&nbsp;</td>
                        </tr>
                        <tr >
                          <td  align="left" >
                          	<table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
                        		<tr  >
                                  <td width="147" class="tabla_pedidos_titulos" >Producto</td>
                                  <td width="32" class="tabla_pedidos_titulos" >Cant</td>
                                  <td width="45" class="tabla_pedidos_titulos" >P.Ven</td>
                                  <td width="54" class="tabla_pedidos_titulos" >Total</td>
                                 
                                </tr>
                                <!--AQUI VA LAS COSAS DE EL PEDIDO0 TANTO LA DIVISION POR LINEAS COMO LOS PRODUCTOS EN SI-->
                                <?php for($il=0;$il<sizeof($arr_lin_art);$il++){?>
                                    <tr >
                                      <td colspan="4" class="tabla_pedidos_titulos_sub" ><?php echo strtoupper($arr_lin_art[$il]['lin_des']); ?></td>
                                     </tr>
                                     <!--AQUI ESTARA EL LSIADO DE ARTICULOS-->
                                     <?php  
									 	//BUSCAMOS LOS DETALLES O RENGLONES SEGUN ESTAS TABLAS DE EL PEDIDO
										$arr_t_xreng_ped=$obj_xreng_ped->get_xreng_ped_detallado_art4($fact_num,$arr_lin_art[$il]['co_lin']);

									 	//RECOREMOS EL DETALLE DE ESTE PAEDIDO
									 	for($itx=0;$itx<sizeof($arr_t_xreng_ped);$itx++){
										
										//llamado de las clases para filas impares y pares
										  if ($itx % 2){
											$clase = "tablas_pedidos_datos_par";
											} else{
											$clase = "tablas_pedidos_datos_imp";
										 }
									?>
                                             <tr >
                                              <td class="<?php echo $clase; ?>" width="147">
                                              	<font class="tablas_pedidos_txt"><?php echo $arr_t_xreng_ped[$itx]['art_des']; ?><br></font>
                                                <font class="tablas_pedidos_bol"><?php echo $arr_t_xreng_ped[$itx]['co_art']; ?>&nbsp;|&nbsp;</font>
                                                 <font class="tablas_pedidos_res">
                                                 <?php 
													if($arr_t_xreng_ped[$itx]['desc']) {
														$arr_esp_art=$obj_descuentos->get_descuentos($arr_t_xreng_ped[$itx]['desc']);
												 		echo $arr_esp_art[0]['descripcion']; }
													else echo $arr_t_xreng_ped[$itx]['desc'].'%';
												?>
                                                 </font>
                                              </td>
                                              <td   class="<?php echo $clase; ?>" width="32"><div align="right"><?php echo $arr_t_xreng_ped[$itx]['total_art']; ?>&nbsp;</div></td>
                                              <td   class="<?php echo $clase; ?>" width="45"><div align="right"><?php echo number_format($arr_t_xreng_ped[$itx]['prec_vta'],2,',','.'); ?>&nbsp;</div></td>
                                              <td  class="<?php echo $clase; ?>"  width="54"><div align="right">
											  		<?php echo number_format($arr_t_xreng_ped[$itx]['reng_neto'],2,',','.'); ?>&nbsp;</div>
                                             </td>
                                            </tr>
                                     <?php } ?>
                                    
                                <?php } ?>  
                            </table>
                          </td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
                        </tr>
                        <!--TABLA DE LOS TOTALES-->
                        <tr >
                          <td  align="left" >
                          	<table class="tabla_pedidos" width="310" cellpadding="0" cellspacing="0">
                            	<tr  >
                                  <td width="210" class="tabla_pedidos_totales"  >Sub Total&nbsp;: </td>
                                   <td width="100" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_t_xpedidos[0]['tot_bruto'],2,'.',','); ?>&nbsp;</div></td>
                                </tr>
                                <tr  >
                                  <td width="250" class="tabla_pedidos_totales" >I.V.A&nbsp;:</td>
                                   <td width="60" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_t_xpedidos[0]['iva'],2,'.',','); ?>&nbsp;</div></td>
                                </tr>
                                <tr  >
                                  <td width="250" class="tabla_pedidos_totales" >Total&nbsp;:</td>
                                   <td width="60" class="tablas_pedidos_txt" ><div align="right"><?php echo number_format($arr_t_xpedidos[0]['tot_neto'],2,'.',','); ?>&nbsp;</div></td>
                                </tr>
                            </table>
            			  </td>
                       </tr>	                
                       <!--TABLA DE LOS TOTALES-->     
            
 <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">Para Finalizar el pedido</td>
                        </tr>
						<tr >
                          <td  align="left" ><input type="submit" name="op" id="op" value="Finalizar" class="form_boton_grande" /></td>
                        </tr>
                      
                        
                        
                      </table></td>
                    </tr>
                  </table>
                  <?php }if($Menu1=='Finalizar'){ ?>
                  <table width="100%" align="center" class="tablas_listados_datos" >
                    <tr>
                      <td  colspan="2" class="tabla_barra_opciones"  >
                      <table class="tabla_opciones" >
                        <tr >
                          <td width="63%" align="left">Opciones</td>
                          <td width="37%"><table class="tabla_opciones" >
                            <tr align="center">
                              <td width="20%" >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%"  >&nbsp;</td>
                              <td width="20%" ><a href="menu_visual.php" ><img  src="../images/listado.png"  title="Volver al menu" alt="Volver al menu"  style="border:none" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td  colspan="2" align="left" height="10" class="tablas_pedidos_resg">&nbsp;</td>
                    </tr>
                   
                    <tr>
                      <td  colspan="2" align="left">
                      <table class="tabla_opciones" >
                       
                       
                        <tr >
                          <td align="left" class="tablas_pedidos_bolg" >&nbsp;</td>
                         
                        </tr>
                   
                        <tr >
                          <td  align="left" >Su pedido se ha completado con &eacute;xito con el numero .: <font class="tablas_pedidos_bol"><?php echo $fact_num; ?></font>,&nbsp; esperando solo su an&aacute;lisis por cr&eacute;dito y  cobranzas. </td>
                        </tr>
                        <tr >
                          <td align="left" class="tablas_pedidos_bolg" >&nbsp;</td>
                        </tr>
                        <tr >
                          <td align="left" >&nbsp;</td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
                        </tr>
                        <tr >
                          <td  align="left"  class="tablas_pedidos_bolg">&nbsp;</td>
                        </tr>
                        <!--TABLA DE LOS TOTALES-->	                
                       <!--TABLA DE LOS TOTALES-->
						<tr >
                          <td  align="left" >&nbsp;</td>
                        </tr>
                      
                        
                        
                      </table></td>
                    </tr>
                  </table>
                  <?php } ?>
                  
                  
            </form>
            <br />
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
        </div>
        <div id="footer">
        <!--ESTE ES EL FOOTER-->
        <!--ESTE ES EL FOOTER-->
        </div>
     <!--ESTE ES EL CONTENEDOR PRINCIPAL-->
    </div>
<!--ESTE ES EL BODY-->
</body>
</html>
