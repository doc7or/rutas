<?php 


/*
	ARCHIVO INTROMISIVO DE FACTURAS 
	VERSION 1.0
	ROBERTH NAVARRO
	04062009
	COMMENT: ESTE ARCHIVO INTENTARA BUSCAR DE LA MANERA MAS OPTIMA Y RAPIDA A NIVEL DE ALGORITMO ENCONTRAR LAS POSIBLES REPETICIONES QUE ESXIAN EN DOS VECTORES DADOS
*/

//VARIABLES MYSQL
	//VARIABLES MYSQL LOCAL
		define("USER_LOCAL","root");//MYSQL
		define("PASS_LOCAL","");//MYSQL	
		define("SERVER_LOCAL","127.0.0.1");//MYSQL
		define("DB_LOCAL","cyber");
	//MYSQL REMOTO
		define("USER_REMOTE","UsEr_08_Vf");
		define("PASS_REMOTE","325_UsEr_08");
		define("SERVER_REMOTE","69.20.61.52");
		define("DB_REMOTE","cyber");
//VARIABLES MSSQL
	//SQL SERVER 10.10.1.7
		define("USER","sa");//define("USER","sa");
		define("PASS","123456");//define("PASS","123456");
		define("SERVER","10.10.1.7");
		define("DB","CYBERLUX");
		define("DB_TRANSPORTE","transporte");
	//MSSQL SERVER LOCAL
		define("USER_MSSQL_LOCAL","sa");//define("USER","sa");
		define("PASS_MSSQL_LOCAL","123456");//define("PASS","123456");
		define("SERVER_MSSQL_LOCAL","127.0.0.1");
		define("DB_MSSQL_LOCAL","CYBERLUX");
		define("DB_MSSQL_TRANSPORTE","transporte");


//FUNCIONES VARIAS USO


//FUNCIONES VARIAS USO

//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES
	
	//FUNCETIONES DE MYSQL
		function my_conect_local(){
			$my_connection = mysql_connect(SERVER_LOCAL,USER_LOCAL,PASS_LOCAL);
			$my_SelectedDB = mysql_select_db(DB_LOCAL);
			return $my_connection;
		}
		function my_conect_remote(){
			$my_connection = mysql_connect(SERVER_REMOTE,USER_REMOTE,PASS_REMOTE);
			$my_SelectedDB = mysql_select_db(DB_REMOTE);
			return $my_connection;
		}
	//FUNCETIONES DE MSSQL
		function ms_conect_local(){
			$ms_connection = mssql_connect(SERVER_MSSQL_LOCAL,USER_MSSQL_LOCAL,PASS_MSSQL_LOCAL);
			$ms_SelectedDB = mssql_select_db(DB_MSSQL_LOCAL);
			return $ms_connection;
		}
		function ms_conect_remote(){
			$ms_connection = mssql_connect(SERVER,USER,PASS);
			$ms_SelectedDB = mssql_select_db(DB);
			return $ms_connection;
		}
		function ms_conect_remote_trans(){
			$ms_connection = mssql_connect(SERVER,USER,PASS);
			$ms_SelectedDB = mssql_select_db(DB_TRANSPORTE);
			return $ms_connection;
		}
		
//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES


//FUNCIONES NETAS DE CONSULTAS DE LAS BASES DE DATOS

//FUNCION QUE BUSCA LAS FACTURAS ANULADAS EN PROFIT
function get_facturas_anuladas($fact_num,$top){
		$conect=ms_conect_remote();		
		$sQuery="SELECT ";
		if($top) $sQuery.=" TOP 1 ";
		$sQuery.=" fact_num FROM factura WHERE  anulada=1 ";
		if($fact_num) {	$sQuery.=" AND fact_num >= '$fact_num' ";	}
		$sQuery.=" ORDER BY fact_num ";
		//echo($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
}

//FUNCION QUE BUSCA LAS FACTURAS TRANSPORTADAS TOP 1
function get_facturas_trans($fact_num,$top){
		$conect=ms_conect_remote_trans();		
		$sQuery="SELECT ";
		if($top) $sQuery.=" TOP 1 ";
		$sQuery.="  control_salida_detalle.id_factura,
					control_salida.id
					FROM control_salida_detalle 
					Inner Join control_salida ON control_salida_detalle.id_control_salida = control_salida.id
					WHERE  control_salida_detalle.id_factura<>'' AND control_salida_detalle.tipo=1 AND control_salida_detalle.status<>'2' 
					";
		if($fact_num) {	$sQuery.=" AND control_salida_detalle.id_factura >= '$fact_num' ";	}
		$sQuery.=" ORDER BY control_salida_detalle.id_factura";
	//	echo($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$i=0;
		while($row=mssql_fetch_array($result)){
			foreach($row as $key=>$value){
				$res_array[$i][$key]=$value;
			}
			$i++;
		}
		return($res_array);
			
}


//FUNCIONES NETAS DE CONSULTAS DE LAS BASES DE DATOS

//SECCION DE ALGORITMOS FINALES

//VALICACION DE CONECCIONES
$arr_facturas_trans=get_facturas_trans('',1);
$arr_facturas_anuladas=get_facturas_anuladas($arr_facturas_trans[0]['id_factura'],'');
$arr_facturas_trans=get_facturas_trans('','');
echo 'transportre  '.sizeof($arr_facturas_trans).'  ----  '.$arr_facturas_trans[0]['id_factura'].'<br>';
echo 'profit  '.sizeof($arr_facturas_anuladas).'  ----  '.$arr_facturas_anuladas[0]['fact_num'].'<br>';


$cp=0;
$inicio=0;
for($i=0;$i<sizeof($arr_facturas_anuladas);$i++)
{
	for($j=$inicio;$j<=sizeof($arr_facturas_trans);$j++){
		if($arr_facturas_anuladas[$i]['fact_num']==$arr_facturas_trans[$j]['id_factura']){
			$arr_encontrados[$cp]['id_factura']=$arr_facturas_anuladas[$i]['fact_num'];
			$arr_encontrados[$cp]['id_control_salida']=$arr_facturas_anuladas[$i]['id_control_salida'];
			$inicio=$j;
			$j=sizeof($arr_facturas_trans);
			$cp=$cp+1;
			
		}if($arr_facturas_anuladas[$i]['fact_num']<$arr_facturas_trans[$j]['id_factura']){
			//echo $arr_facturas_anuladas[$i]['fact_num'].'---'.$arr_facturas_trans[$j]['id_factura'].'<br>';
			$inicio=$j;
			$j=sizeof($arr_facturas_trans);
		}
		
	}
}
echo "total de coinsidencias ".$cp;
//SECCION DE ALGORITMOS FINALES

/*header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, post-check=0");
header("Content-disposition: attachment;filename=inconsistencias.xls");*/
$url='forma_guia_transporte_popup.php?id=';	
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
  <link rel="stylesheet" type="text/css" media="all" href="../lib/js/calendar/skins/aqua/aqua.css" title="win2k-cold-1" />
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
          	<div id="menu_visual" ></div>
            <div id="espacio_trabajo" >
              <!--AQUI VA EL CONTENIDO CAMBIANTE Y DEMAS COMO TAL EL FORMULARIO DEL SISTEMA-->
              <form name="form1" id="form1" action="" method="post"  >
                <br />
                <table align="center" width="98%" >
                  <tr>
                    <td  colspan="2" class="form_titulo" >
                    	<?php echo $titulo; 
							  
						?>
                    </td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="center" height="10"></td>
                  </tr>
                  <tr>
                    <td  colspan="2" align="left">
                    
                    <table border="1" bordercolor="#333333">
	<tr>
    	<td>INCONSISTENCIAS </td>
    </tr>
    <?php for($j=0;$j<sizeof($arr_encontrados);$j++){ ?>
    <tr>
    	<td onclick="popup_basic('<?php echo $url.$arr_encontrados[$j]['id_control_salida']; ?>');" ><?php echo $arr_encontrados[$j]['id_factura']; ?></td>
       
    </tr>
    <?php } ?>
</table>
<BR />

<table border="1" bordercolor="#333333">
	<tr>
    	<td>TRANSPORTE </td>
        <td>PROFIT </td>
    </tr>
    <?php for($j=0;$j<sizeof($arr_facturas_trans);$j++){ ?>
    <tr>
    	<td><?php echo $arr_facturas_trans[$j]['id_factura']; ?></td>
        <td><?php echo $arr_facturas_anuladas[$j]['fact_num']; ?></td>
    </tr>
    <?php } ?>
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
