<?php 


	/**
	* devuelve la fecha en formato americano mes-dia-año
	*/
	function muestrafecha($fecha){
		$fecha= split(' ', $fecha);
		list($y,$m,$d)= split('[/.-]', $fecha[0]);
		//2008-03-09 12:44:21 or 2008-03-09
		$convert_date=$m.'-'.$d.'-'.$y;
        return $convert_date;
	}
	
	/**
	* devuelve la fecha en formato mysql año-mes-dia la misma puede venir asi d/m/y h:m:s am o solo feha y hora o solo fecha
	*/
	function rango_fecha_sola($fecha='',$idioma=''){
		
			list($d,$m,$y)= split('[/.-]', $fecha);//por defecto se supone n español por eso la nomenclatura inical $d $m $y
			if($idioma=='es')	$convert_date=$y.'-'.$m.'-'.$d;//si es español
			if($idioma=='in')	$convert_date=$y.'-'.$d.'-'.$m;//si es ingles
			
		
        return $convert_date;
	}
		
	/**
	* devuelve la fecha en formato mysql año-mes-dia
	*/
	function guardafecha($fecha){
		list($d,$m,$y)= split('[/.-]', $fecha);
		$convert_date=$y.'-'.$m.'-'.$d;
        return $convert_date;
	}
	
	/**
	* devuelve un vector con el dia enla posicion 0 y la hora en la posicion 1 desde un datetime en mysql
	*/
	function fecha_hora($fecha){
		list($d,$h)= split(' ', $fecha);
		$convert_date[0]=$d;
		$convert_date[1]=$h;
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

?>