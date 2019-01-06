<?php 
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////LIBRERIA DE FUNCIONES EN PHP VERSION 1.0//////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////SECCION DE MANEJO DE FECHA Y HORAS////////////////////////////////////////
	/**
	* devuelve la fecha en formato mysql año-mes-dia la misma puede venir asi d/m/y h:m:s am o solo feha y hora o solo fecha
	*/
	function guardafecha($fecha='',$idioma=''){
		if($fecha){
			$fecha= split(' ', $fecha);
			list($d,$m,$y)= split('[/.-]', $fecha[0]);//por defecto se supone n español por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$y.'-'.$m.'-'.$d;//si es español
			if($idioma=='in')	$convert_date=$y.'-'.$d.'-'.$m;//si es ingles
			if($fecha[1])	$convert_date.=' '.$fecha[1];//por si envian los segundos
			if($fecha[2])	$convert_date.=' '.$fecha[2];//por si envian am o pm
		}
		else $convert_date='';
        return $convert_date;
	}
	
	/**
	* devuelve la fecha en formato por idioma de mysql y mssql
	*/
	function muestrafecha($fecha,$idioma){
		if($fecha){
			$fecha= split(' ', $fecha);
			list($y,$m,$d)= split('[/.-]', $fecha[0]);//por defecto se supone n español por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$d.'/'.$m.'/'.$y;//si es español
			if($idioma=='in')	$convert_date=$m.'/'.$d.'/'.$y;//si es ingles
			if($fecha[1])	$convert_date.=' '.$fecha[1];//por si envian los segundos
			if($fecha[2])	$convert_date.=' '.$fecha[2];//por si envian am o pm
		}
		else $convert_date='';
        return $convert_date;
	}
	
	/**
	* devuelve la fecha solo la fecha sin hora en formato por idioma de mysql y mssql
	*/
	function muestraFechaSola($fecha,$idioma){
		if($fecha){
			$fecha= split(' ', $fecha);
			list($y,$m,$d)= split('[/.-]', $fecha[0]);//por defecto se supone n español por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$d.'/'.$m.'/'.$y;//si es español
			if($idioma=='in')	$convert_date=$m.'/'.$d.'/'.$y;//si es ingles
			
		}
		else $convert_date='';
        return $convert_date;
	}
	
	
	/**
	* devuelve la diferencia de fecha entre una fecha dada y la fecha actual
	*/
	function get_dif_date($fecha){
		$date2=date("Y-m-d");
		$s = strtotime($fecha)-strtotime($date2);
		$d = intval($s/86400);

		$dif_dias= $d; //Diferencia en dias

		return $dif_dias;
	}
	
	/**
		DEVUELVE LA SUMA O RESTA ENTRE FECHAS
	**/
	function suma_fechas($fecha,$ndias)
	{
		  if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
				  list($mes,$dia,$ano)=split("/", $fecha);
	 
		  if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
				  list($mes,$dia,$ano)=split("-",$fecha);
		
		 $nueva = mktime(0,0,0, $mes,$dia,$ano) + $ndias * 24 * 60 * 60;
		 $nuevafecha=date("m-d-Y",$nueva);
	
		 return ($nuevafecha);  
	}
	//$manyana        = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
	//$ultimo_mes     = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
	//$siguiente_anyo = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);
	
	//////////////////////////////////SECCION DE MANEJO DE CADENAS////////////////////////////////////////
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
	$arg = str_replace(" ", "", $arg);
	return $arg;
	}
	
	//////////////////////////////////SECCION DE MANEJO DE NUMEROS////////////////////////////////////////

	//REEMPLAZA CARACTERES ESPECIALES
	function remplazaCharSpecial($arg){
		$arg = str_replace("'", "", $arg);
		$arg = str_replace('"', "", $arg);
	return $arg;
	}
	
	//////////////////////////////////SECCION DE MANEJO DE NUMEROS////////////////////////////////////////

	
	//////////////////////////////////FUCNIONES VARIAS////////////////////////////////////////////////////
	function inList($arg,$list){
	//$arg	variable que se desean busacar en la lista $list
	//$list lista de valores en los q deve estar la variabe $arg
		$res=false;
		$list_div=split(",",$list);
		for($i=0;$i<sizeof($list_div);$i++)
		{
			if($arg==$list_div[$i]){
				$res=true;
				$i=sizeof($list_div);
			}
		}
		
		
	
	return $res;
	}
	//////////////////////////////////FUCNIONES VARIAS////////////////////////////////////////////////////
	
	///////////////////////////////////SECCION DE MANEJO VARIOS///////////////////////////////////////////

?>