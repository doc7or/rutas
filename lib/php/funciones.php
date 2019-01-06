<?php 
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////LIBRERIA DE FUNCIONES EN PHP VERSION 1.0//////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////SECCION DE MANEJO DE FECHA Y HORAS////////////////////////////////////////
	/**
	* devuelve la fecha en formato mysql a�o-mes-dia la misma puede venir asi d/m/y h:m:s am o solo feha y hora o solo fecha
	*/
	function rango_fecha_sola($fecha='',$idioma=''){
		
			list($d,$m,$y)= split('[/.-]', $fecha);//por defecto se supone n espa�ol por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$y.'-'.$m.'-'.$d;//si es espa�ol
			if($idioma=='in')	$convert_date=$y.'-'.$d.'-'.$m;//si es ingles
			
		
        return $convert_date;
	}
	
	/**
	* devuelve la fecha en formato mysql a�o-mes-dia la misma puede venir asi d/m/y h:m:s am o solo feha y hora o solo fecha
	*/
	function rango_fecha($fecha='',$idioma='',$punto=''){
		
			list($d,$m,$y)= split('[/.-]', $fecha);//por defecto se supone n espa�ol por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$y.'-'.$m.'-'.$d;//si es espa�ol
			if($idioma=='in')	$convert_date=$y.'-'.$d.'-'.$m;//si es ingles
			
			if($punto=='1')	$convert_date.=' 00:00:00';//por si envian el origen o la fecha_desde
			if($punto=='2')	$convert_date.=' 23:59:59';//por si envian el final o la fecha__hasta
		
		
        return $convert_date;
	}
	
	
	
	/**
	* devuelve la fecha en formato mysql a�o-mes-dia la misma puede venir asi d/m/y h:m:s am o solo feha y hora o solo fecha
	*/
	function guardafecha($fecha='',$idioma=''){
		if($fecha){
			$fecha= split(' ', $fecha);
			list($d,$m,$y)= split('[/.-]', $fecha[0]);//por defecto se supone n espa�ol por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$y.'-'.$m.'-'.$d;//si es espa�ol
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
			list($y,$m,$d)= split('[/.-]', $fecha[0]);//por defecto se supone n espa�ol por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$d.'/'.$m.'/'.$y;//si es espa�ol
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
			list($y,$m,$d)= split('[/.-]', $fecha[0]);//por defecto se supone n espa�ol por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$d.'/'.$m.'/'.$y;//si es espa�ol
			if($idioma=='in')	$convert_date=$m.'/'.$d.'/'.$y;//si es ingles
			
		}
		else $convert_date='';
        return $convert_date;
	}
	
	/**
	* devuelve la fecha solo la fecha sin hora en formato por idioma de mysql y mssql
	*/
	function guardaFechaSola($fecha){
		if($fecha){
			$fecha= split(' ', $fecha);
			list($d,$m,$y)= split('[/.-]', $fecha[0]);//por defecto se supone n espa�ol por eso la nomenclatura inical $d $m $y
			if($m<10) $m='0'.$m;
			if($d<10) $d='0'.$d;
			$convert_date=$y.$m.$d;//si es espa�ol
			
			
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
	//$arg = str_replace(" ", "", $arg);
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
	
	function delCharEnd($str,$cuantos){
		$str=substr($str,0,-$cuantos);
	return $str;
	}
	
	function completaSpaciosStrins($str,$cuantos,$valor,$pos){
		//$str			caracter que vamos a usar para completar el espacio
		//$cuantos  	esspacios que debe tener la cadena resultante
		//$valor		campo que si vamos a colocar pero debemos completar
		//pos			derecha o izquierda
		
		$cuantos_valor=strlen($valor);//obtenemos la longitud del string oriinal
		$veces=$cuantos-$cuantos_valor;//veces que debemos colocar el caracter completador o rellenador
		
		$strComp='';
		//creamos la cadena ausar
		for($i=0;$i<$veces;$i++) {	$strComp.=$str;	}
		//decidimos si va a la izquierda o a la derecha
		if($pos=='1'){	
			//a la izquierda
			$strComp=$strComp.$valor;
		}else{
			//a la derecha
			$strComp=$valor.$strComp;
		}
		
		
	return $strComp;
	}
	
	//completar con cadena
	function completStr($strIn='',$pos='',$strCom='',$sen='') {
		
		while( strlen($strIn)  < $pos )	{
			if($sen==1)	$strIn = $strIn.$strCom;
			else $strIn = $strCom.$strIn;
		}
		return $strIn;
	}
	//////////////////////////////////FUCNIONES VARIAS////////////////////////////////////////////////////
	
	///////////////////////////////////SECCION DE MANEJO VARIOS///////////////////////////////////////////

?>