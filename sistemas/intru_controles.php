<script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="../lib/js/funciones.js"></script>
<?php
/*
	ARCHIVO INTROMISIVO DE CONTROLES DE SALIDA
	VERSION 1.0
	ROBERTH NAVARRO
	04062009
*/
//VARIABLES DE CONECCION CASA
define("USER_CASA","");
define("PASS_CASA", "");
define("SERVER_CASA","doc7or");
define("DB_CASA", "transporte");
define("DB_CYBERLUX_CASA", "CYBERLUX");
//VARIABLES DE EL SERVIDOR
define("USER_SERVER","sa");
define("PASS_SERVER", "123456");
define("SERVER_SERVER","127.0.0.1");
//define("SERVER_SERVER","10.10.1.7");
define("DB_SERVER", "transporte");
define("DB_CYBERLUX_SERVER", "CYBERLUX");
////////////////////////////////////////////

//FUNCIONES VARIAS USO

//FUNCIONES DE LIMPIAR CARACTERES
function rehtmlspecialchars($arg){
	//$arg = str_replace("", "<", $arg);
	//$arg = str_replace(" ", "_", $arg);
	$arg = str_replace("/", "", $arg);
	$arg = str_replace("&", "", $arg);
	$arg = str_replace("'", "", $arg);
	$arg = str_replace("#", "", $arg);
	$arg = str_replace("(", "", $arg);
	$arg = str_replace(")", "-", $arg);
	$arg = str_replace(".", "", $arg);
	
	return $arg;
	}


//FUNCIONES VARIAS USO

//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES
	
	//FUNCETIONES DE MSSQL
		function ms_conect_casa(){
			$ms_connection = mssql_connect(SERVER_CASA,USER_CASA,PASS_CASA);
			$ms_SelectedDB = mssql_select_db(DB_CASA);
			return $ms_connection;
		}
		function ms_conect_server(){
			$ms_connection = mssql_connect(SERVER_SERVER,USER_SERVER,PASS_SERVER);
			$ms_SelectedDB = mssql_select_db(DB_SERVER);
			return $ms_connection;
		}
		
//FUNCIONES DE CONECCION A LAS BASES DE DATOS DE DIFERENTES LUGARES


//FUNCIONES NETAS DE CONSULTAS DE LAS BASES DE DATOS

//FUNCION DE BYUSQUEDA EN LA NOMINA DETALE DE TODAS LAS GUIAS Q SALEN YA EN NOMINA
function get_guias_nominadas(){
		$conect=ms_conect_server();		
		$sQuery="SELECT * FROM nomina_detalle WHERE  1=1 ORDER BY id_guia";
		
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

function get_guias_pagadas(){
		$conect=ms_conect_server();		
		$sQuery="SELECT  id, id_por_sucursal, id_sucursal, status, tipo FROM control_salida WHERE  status=4  ORDER BY id";
		
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

function get_guias_consistencia(){
		$conect=ms_conect_server();		
		$sQuery="SELECT     control_salida.id, control_salida.id_por_sucursal, control_salida.id_sucursal, control_salida.status,
		   nomina_detalle.id AS id_nom_det,nomina_detalle.id_guia
FROM      control_salida
		  Inner Join nomina_detalle ON control_salida.id = nomina_detalle.id_guia
WHERE     (control_salida.status = '2')
ORDER BY control_salida.id";
		
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


//FUNCION DE BYUSQUEDA EN LA NOMINA DETALE DE TODAS LAS GUIAS Q SALEN YA EN NOMINA
$arr_guias_nominadas=get_guias_nominadas();
$arr_guias_pagadas=get_guias_pagadas();
//SECCION DE ALGORITMOS Y RESPUESTAS DE ENTE INTRU CONTROLES
?>
<table border="1" width="94%">
<tr>
    	<td width="31%">Tipo</td>
        <td width="69%">Cantidad</td>
  </tr>
    <tr>
    	<td>Nominadas</td>
        <td><?php echo sizeof($arr_guias_nominadas);?></td>
    </tr>
    <tr>
    	<td>Pagadas</td>
        <td><?php echo sizeof($arr_guias_pagadas);?></td>
    </tr>
    <tr>
    	<td>Diferencia
			<?php 
				$nominadas=sizeof($arr_guias_nominadas);
				$pagadas=sizeof($arr_guias_pagadas);
				if($nominadas>$pagadas){
					$diferencia=$nominadas-$pagadas;
					echo '<br>Las guias NOMINADAS supera  a las PAGADAS en  '.$diferencia;
					$mayor=1;
				}else{
					$diferencia=$pagadas-$nominadas;
					echo '<br>Las guias PAGADAS supera  a las NOMINADAS en  '.$diferencia;
					$mayor=2;
				} 
				
			?>
        </td>
        <td>
        	<?php
				//se buscara ahora cuales son las guias que presentan esta inconsistencia
				//AQUI SE COMENSARA EL ALGORITMO
				$ind=0;
				for($i=0;$i<sizeof($arr_guias_pagadas);$i++)
				{
					for($j=$ind;$j<sizeof($arr_guias_nominadas);$j++)
					{
						if($arr_guias_pagadas[$i]['id']==$arr_guias_nominadas[$j]['id_guia'])
						{	$ind=$j+1; $arr_guias_pagadas[$i]['repetido']=1;	}
						
					}
				}
				$contador=1;
				for($i=0;$i<sizeof($arr_guias_pagadas);$i++)
				{
						if($arr_guias_pagadas[$i]['repetido']!=1)
						{	
							if($arr_guias_pagadas[$i]['tipo']==1){	$url='../modulos/forma_guia_transporte_popup.php?id=';	}
							if($arr_guias_pagadas[$i]['tipo']==2){	$url='../modulos/forma_guia_traslado_popup.php?id=';	}
							if($arr_guias_pagadas[$i]['tipo']==3){	$url='../modulos/forma_guia_nota_entrega_popup.php?id=';	}
							?>
                            <a href=""  onclick="popup_basic('<?php echo $url.$arr_guias_pagadas[$i]['id']; ?>');" style="cursor:pointer" >
							<?php echo $contador++.' - '.$arr_guias_pagadas[$i]['id_por_sucursal'].' - '.$arr_guias_pagadas[$i]['id_sucursal'].', ';	?>
                            </a>
							<?php
                        }
					
				}

		?>
        </td>
    </tr>
    <tr>
      <td>Diferencia
        <?php 
				$nominadas=sizeof($arr_guias_nominadas);
				$pagadas=sizeof($arr_guias_pagadas);
				if($nominadas>$pagadas){
					$diferencia=$nominadas-$pagadas;
					echo '<br>Las guias NOMINADAS supera  a las PAGADAS en  '.$diferencia;
					$mayor=1;
				}else{
					$diferencia=$pagadas-$nominadas;
					echo '<br>Las guias PAGADAS supera  a las NOMINADAS en  '.$diferencia;
					$mayor=2;
				} 
				
			?> por si aplica la diferencia en el lado contrario osea en viceversa</td>
      <td><?php
				//se buscara ahora cuales son las guias que presentan esta inconsistencia
				//AQUI SE COMENSARA EL ALGORITMO
				$ind=0;
				for($i=0;$i<sizeof($arr_guias_nominadas);$i++)
				{
					for($j=$ind;$j<sizeof($arr_guias_pagadas);$j++)
					{
						if($arr_guias_nominadas[$i]['id_guia']==$arr_guias_pagadas[$j]['id'])
						{	$ind=$j+1; 
							$arr_guias_nominadas[$i]['repetido']=1;	
							$arr_guias_nominadas[$i]['sucursal']=$arr_guias_pagadas[$j]['sucursal'];	
							$arr_guias_nominadas[$i]['id_por_sucursal']=$arr_guias_pagadas[$j]['id_por_sucursal'];		
						}
						
					}
				}
				for($i=0;$i<sizeof($arr_guias_nominadas);$i++)
				{
						if($arr_guias_nominadas[$i]['repetido']!=1)
						{	echo $arr_guias_nominadas[$i]['id_guia'].', ';	}
					
				}
				

		?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</table>
<br />
<?php
//SECCION DE ALGORITMOS Y RESPUESTAS DE ENTE INTRU CONTROLES

?>




