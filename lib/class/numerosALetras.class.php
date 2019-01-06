<?php
class numerosALetras{
	/*function num2letras($num, $fem = true, $dec = true) {
//if (strlen($num) > 14) die("El número introducido es demasiado grande");
   $matuni[2]  = "dos";
   $matuni[3]  = "tres";
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";
   $matuni[6]  = "seis";
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";
   $matuni[9]  = "nueve";
   $matuni[10] = "diez";
   $matuni[11] = "once";
   $matuni[12] = "doce";
   $matuni[13] = "trece";
   $matuni[14] = "catorce";
   $matuni[15] = "quince";
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";
   $matuni[18] = "dieciocho";
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte";
   $matunisub[2] = "dos";
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";
   $matunisub[5] = "quin";
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";
   $matunisub[8] = "ocho";
   $matunisub[9] = "nove";
   $matdec[2] = "veint";
   $matdec[3] = "treinta";
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";
   $matdec[6] = "sesenta";
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";
   $matdec[9] = "noventa";
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';
   $matsub[7]  = 'mill';
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';
   $matsub[13] = 'bill';
   $matsub[15] = 'mill';
   $matmil[4]  = 'millones';
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';
   $num = trim((string)@$num);
   if ($num[0] == '-') {
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }
      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else
            $ent .= $n;
      }else
         break;
   }
  
   $ent = '     ' . $ent;
  
   if ($dec and $fra and ! $zeros) {
      $fin = ' coma';
      for ($n = 0; $n < strlen($fra); $n++) {
         if (($s = $fra[$n]) == '0')
            $fin .= ' cero';
         elseif ($s == '1')
            $fin .= $fem ? ' una' : ' un';
         else
            $fin .= ' ' . $matuni[$s];
      }
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
  
   while ( ($num = substr($ent, -3)) != '   ') {
     
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
     
      $n = $num[0];
      if ($n == 1) {
         $t = ' ciento' . $t;
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
     
      if ($sub == 1) {
      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . 'ón';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }  
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   return ucfirst($tex);
}*/
/*
function unidad($numuero){
switch ($numuero)
{
case 9:
{
$numu = "NUEVE";
break;
}
case 8:
{
$numu = "OCHO";
break;
}
case 7:
{
$numu = "SIETE";
break;
}
case 6:
{
$numu = "SEIS";
break;
}
case 5:
{
$numu = "CINCO";
break;
}
case 4:
{
$numu = "CUATRO";
break;
}
case 3:
{
$numu = "TRES";
break;
}
case 2:
{
$numu = "DOS";
break;
}
case 1:
{
$numu = "UN";
break;
}
case 0:
{
$numu = "";
break;
}
}
return $numu;
}

function decena($numdero){

if ($numdero >= 90 && $numdero <= 99)
{
$numd = "NOVENTA ";
if ($numdero > 90)
$numd = $numd."Y ".($this->unidad($numdero - 90));
}
else if ($numdero >= 80 && $numdero <= 89)
{
$numd = "OCHENTA ";
if ($numdero > 80)
$numd = $numd."Y ".($this->unidad($numdero - 80));
}
else if ($numdero >= 70 && $numdero <= 79)
{
$numd = "SETENTA ";
if ($numdero > 70)
$numd = $numd."Y ".($this->unidad($numdero - 70));
}
else if ($numdero >= 60 && $numdero <= 69)
{
$numd = "SESENTA ";
if ($numdero > 60)
$numd = $numd."Y ".($this->unidad($numdero - 60));
}
else if ($numdero >= 50 && $numdero <= 59)
{
$numd = "CINCUENTA ";
if ($numdero > 50)
$numd = $numd."Y ".($this->unidad($numdero - 50));
}
else if ($numdero >= 40 && $numdero <= 49)
{
$numd = "CUARENTA ";
if ($numdero > 40)
$numd = $numd."Y ".($this->unidad($numdero - 40));
}
else if ($numdero >= 30 && $numdero <= 39)
{
$numd = "TREINTA ";
if ($numdero > 30)
$numd = $numd."Y ".($this->unidad($numdero - 30));
}
else if ($numdero >= 20 && $numdero <= 29)
{
if ($numdero == 20)
$numd = "VEINTE ";
else
$numd = "VEINTI".($this->unidad($numdero - 20));
}
else if ($numdero >= 10 && $numdero <= 19)
{
switch ($numdero){
case 10:
{
$numd = "DIEZ ";
break;
}
case 11:
{
$numd = "ONCE ";
break;
}
case 12:
{
$numd = "DOCE ";
break;
}
case 13:
{
$numd = "TRECE ";
break;
}
case 14:
{
$numd = "CATORCE ";
break;
}
case 15:
{
$numd = "QUINCE ";
break;
}
case 16:
{
$numd = "DIECISEIS ";
break;
}
case 17:
{
$numd = "DIECISIETE ";
break;
}
case 18:
{
$numd = "DIECIOCHO ";
break;
}
case 19:
{
$numd = "DIECINUEVE ";
break;
}
}
}
else
$numd = $this->unidad($numdero);
return $numd;
}

function centena($numc){
if ($numc >= 100)
{
if ($numc >= 900 && $numc <= 999)
{
$numce = "NOVECIENTOS ";
if ($numc > 900)
$numce = $numce.($this->decena($numc - 900));
}
else if ($numc >= 800 && $numc <= 899)
{
$numce = "OCHOCIENTOS ";
if ($numc > 800)
$numce = $numce.($this->decena($numc - 800));
}
else if ($numc >= 700 && $numc <= 799)
{
$numce = "SETECIENTOS ";
if ($numc > 700)
$numce = $numce.($this->decena($numc - 700));
}
else if ($numc >= 600 && $numc <= 699)
{
$numce = "SEISCIENTOS ";
if ($numc > 600)
$numce = $numce.($this->decena($numc - 600));
}
else if ($numc >= 500 && $numc <= 599)
{
$numce = "QUINIENTOS ";
if ($numc > 500)
$numce = $numce.($this->decena($numc - 500));
}
else if ($numc >= 400 && $numc <= 499)
{
$numce = "CUATROCIENTOS ";
if ($numc > 400)
$numce = $numce.($this->decena($numc - 400));
}
else if ($numc >= 300 && $numc <= 399)
{
$numce = "TRESCIENTOS ";
if ($numc > 300)
$numce = $numce.($this->decena($numc - 300));
}
else if ($numc >= 200 && $numc <= 299)
{
$numce = "DOSCIENTOS ";
if ($numc > 200)
$numce = $numce.($this->decena($numc - 200));
}
else if ($numc >= 100 && $numc <= 199)
{
if ($numc == 100)
$numce = "CIEN ";
else
$numce = "CIENTO ".($this->decena($numc - 100));
}
}
else
$numce = $this->decena($numc);

return $numce;
}

function miles($nummero){
if ($nummero >= 1000 && $nummero < 2000){
$numm = "MIL ".($this->centena($nummero%1000));
}
if ($nummero >= 2000 && $nummero <10000){
$numm = $this->unidad(Floor($nummero/1000))." MIL ".($this->centena($nummero%1000));
}
if ($nummero < 1000)
$numm = $this->centena($nummero);

return $numm;
}

function decmiles($numdmero){
if ($numdmero == 10000)
$numde = "DIEZ MIL";
if ($numdmero > 10000 && $numdmero <20000){
$numde = $this->decena(Floor($numdmero/1000))."MIL ".($this->centena($numdmero%1000));
}
if ($numdmero >= 20000 && $numdmero <100000){
$numde = $this->decena(Floor($numdmero/1000))." MIL ".($this->miles($numdmero%1000));
}
if ($numdmero < 10000)
$numde = $this->miles($numdmero);

return $numde;
}

function cienmiles($numcmero){
if ($numcmero == 100000)
$num_letracm = "CIEN MIL";
if ($numcmero >= 100000 && $numcmero <1000000){
$num_letracm = $this->centena(Floor($numcmero/1000))." MIL ".($this->centena($numcmero%1000));
}
if ($numcmero < 100000)
$num_letracm = $this->decmiles($numcmero);
return $num_letracm;
}

function millon($nummiero){
if ($nummiero >= 1000000 && $nummiero <2000000){
$num_letramm = "UN $this->millon ".($this->cienmiles($nummiero%1000000));
}
if ($nummiero >= 2000000 && $nummiero <10000000){
$num_letramm = $this->unidad(Floor($nummiero/1000000))." MILLONES ".($this->cienmiles($nummiero%1000000));
}
if ($nummiero < 1000000)
$num_letramm = $this->cienmiles($nummiero);

return $num_letramm;
}

function decmillon($numerodm){
if ($numerodm == 10000000)
$num_letradmm = "DIEZ MILLONES";
if ($numerodm > 10000000 && $numerodm <20000000){
$num_letradmm = $this->decena(Floor($numerodm/1000000))."MILLONES ".($this->cienmiles($numerodm%1000000));
}
if ($numerodm >= 20000000 && $numerodm <100000000){
$num_letradmm = $this->decena(Floor($numerodm/1000000))." MILLONES ".($this->millon($numerodm%1000000));
}
if ($numerodm < 10000000)
$num_letradmm = $this->millon($numerodm);

return $num_letradmm;
}

function cienmillon($numcmeros){
if ($numcmeros == 100000000)
$num_letracms = "CIEN MILLONES";
if ($numcmeros >= 100000000 && $numcmeros <1000000000){
$num_letracms = $this->centena(Floor($numcmeros/1000000))." MILLONES ".($this->millon($numcmeros%1000000));
}
if ($numcmeros < 100000000)
$num_letracms = $this->decmillon($numcmeros);
return $num_letracms;
}

function milmillon($nummierod){
if ($nummierod >= 1000000000 && $nummierod <2000000000){
$num_letrammd = "MIL ".($this->cienmillon($nummierod%1000000000));
}
if ($nummierod >= 2000000000 && $nummierod <10000000000){
$num_letrammd = $this->unidad(Floor($nummierod/1000000000))." MIL ".($this->cienmillon($nummierod%1000000000));
}
if ($nummierod < 1000000000)
$num_letrammd = $this->cienmillon($nummierod);

return $num_letrammd;
}


function convertir($numero){
$numf = $this->milmillon($numero);
return $numf;
}
*/
	/*
	function centimos()
{
	global $importe_parcial;

	$importe_parcial = number_format($importe_parcial, 2, ".", "") * 100;

	if ($importe_parcial > 0)
		$num_letra = " con ".$this->decena_centimos($importe_parcial);
	else
		$num_letra = "";

	return $num_letra;
}

function unidad_centimos($numero)
{
	switch ($numero)
	{
		case 9:
		{
			$num_letra = "nueve céntimos";
			break;
		}
		case 8:
		{
			$num_letra = "ocho céntimos";
			break;
		}
		case 7:
		{
			$num_letra = "siete céntimos";
			break;
		}
		case 6:
		{
			$num_letra = "seis céntimos";
			break;
		}
		case 5:
		{
			$num_letra = "cinco céntimos";
			break;
		}
		case 4:
		{
			$num_letra = "cuatro céntimos";
			break;
		}
		case 3:
		{
			$num_letra = "tres céntimos";
			break;
		}
		case 2:
		{
			$num_letra = "dos céntimos";
			break;
		}
		case 1:
		{
			$num_letra = "un céntimo";
			break;
		}
	}
	return $num_letra;
}

function decena_centimos($numero)
{
	if ($numero >= 10)
	{
		if ($numero >= 90 && $numero <= 99)
		{
			  if ($numero == 90)
				  return "noventa céntimos";
			  else if ($numero == 91)
				  return "noventa y un céntimos";
			  else
				  return "noventa y ".$this->unidad_centimos($numero - 90);
		}
		if ($numero >= 80 && $numero <= 89)
		{
			if ($numero == 80)
				return "ochenta céntimos";
			else if ($numero == 81)
				return "ochenta y un céntimos";
			else
				return "ochenta y ".$this->unidad_centimos($numero - 80);
		}
		if ($numero >= 70 && $numero <= 79)
		{
			if ($numero == 70)
				return "setenta céntimos";
			else if ($numero == 71)
				return "setenta y un céntimos";
			else
				return "setenta y ".$this->unidad_centimos($numero - 70);
		}
		if ($numero >= 60 && $numero <= 69)
		{
			if ($numero == 60)
				return "sesenta céntimos";
			else if ($numero == 61)
				return "sesenta y un céntimos";
			else
				return "sesenta y ".$this->unidad_centimos($numero - 60);
		}
		if ($numero >= 50 && $numero <= 59)
		{
			if ($numero == 50)
				return "cincuenta céntimos";
			else if ($numero == 51)
				return "cincuenta y un céntimos";
			else
				return "cincuenta y ".$this->unidad_centimos($numero - 50);
		}
		if ($numero >= 40 && $numero <= 49)
		{
			if ($numero == 40)
				return "cuarenta céntimos";
			else if ($numero == 41)
				return "cuarenta y un céntimos";
			else
				return "cuarenta y ".$this->unidad_centimos($numero - 40);
		}
		if ($numero >= 30 && $numero <= 39)
		{
			if ($numero == 30)
				return "treinta céntimos";
			else if ($numero == 91)
				return "treinta y un céntimos";
			else
				return "treinta y ".$this->unidad_centimos($numero - 30);
		}
		if ($numero >= 20 && $numero <= 29)
		{
			if ($numero == 20)
				return "veinte céntimos";
			else if ($numero == 21)
				return "veintiun céntimos";
			else
				return "veinti".$this->unidad_centimos($numero - 20);
		}
		if ($numero >= 10 && $numero <= 19)
		{
			if ($numero == 10)
				return "diez céntimos";
			else if ($numero == 11)
				return "once céntimos";
			else if ($numero == 11)
				return "doce céntimos";
			else if ($numero == 11)
				return "trece céntimos";
			else if ($numero == 11)
				return "catorce céntimos";
			else if ($numero == 11)
				return "quince céntimos";
			else if ($numero == 11)
				return "dieciseis céntimos";
			else if ($numero == 11)
				return "diecisiete céntimos";
			else if ($numero == 11)
				return "dieciocho céntimos";
			else if ($numero == 11)
				return "diecinueve céntimos";
		}
	}
	else
		return $this->unidad_centimos($numero);
}

function unidad($numero)
{
	switch ($numero)
	{
		case 9:
		{
			$num = "nueve";
			break;
		}
		case 8:
		{
			$num = "ocho";
			break;
		}
		case 7:
		{
			$num = "siete";
			break;
		}
		case 6:
		{
			$num = "seis";
			break;
		}
		case 5:
		{
			$num = "cinco";
			break;
		}
		case 4:
		{
			$num = "cuatro";
			break;
		}
		case 3:
		{
			$num = "tres";
			break;
		}
		case 2:
		{
			$num = "dos";
			break;
		}
		case 1:
		{
			$num = "uno";
			break;
		}
	}
	return $num;
}

function decena($numero)
{
	if ($numero >= 90 && $numero <= 99)
	{
		$num_letra = "noventa ";
		
		if ($numero > 90)
			$num_letra = $num_letra."y ".$this->unidad($numero - 90);
	}
	else if ($numero >= 80 && $numero <= 89)
	{
		$num_letra = "ochenta ";
		
		if ($numero > 80)
			$num_letra = $num_letra."y ".$this->unidad($numero - 80);
	}
	else if ($numero >= 70 && $numero <= 79)
	{
			$num_letra = "setenta ";
		
		if ($numero > 70)
			$num_letra = $num_letra."y ".$this->unidad($numero - 70);
	}
	else if ($numero >= 60 && $numero <= 69)
	{
		$num_letra = "sesenta ";
		
		if ($numero > 60)
			$num_letra = $num_letra."y ".$this->unidad($numero - 60);
	}
	else if ($numero >= 50 && $numero <= 59)
	{
		$num_letra = "cincuenta ";
		
		if ($numero > 50)
			$num_letra = $num_letra."y ".$this->unidad($numero - 50);
	}
	else if ($numero >= 40 && $numero <= 49)
	{
		$num_letra = "cuarenta ";
		
		if ($numero > 40)
			$num_letra = $num_letra."y ".$this->unidad($numero - 40);
	}
	else if ($numero >= 30 && $numero <= 39)
	{
		$num_letra = "treinta ";
		
		if ($numero > 30)
			$num_letra = $num_letra."y ".$this->unidad($numero - 30);
	}
	else if ($numero >= 20 && $numero <= 29)
	{
		if ($numero == 20)
			$num_letra = "veinte ";
		else
			$num_letra = "veinti".$this->unidad($numero - 20);
	}
	else if ($numero >= 10 && $numero <= 19)
	{
		switch ($numero)
		{
			case 10:
			{
				$num_letra = "diez ";
				break;
			}
			case 11:
			{
				$num_letra = "once ";
				break;
			}
			case 12:
			{
				$num_letra = "doce ";
				break;
			}
			case 13:
			{
				$num_letra = "trece ";
				break;
			}
			case 14:
			{
				$num_letra = "catorce ";
				break;
			}
			case 15:
			{
				$num_letra = "quince ";
				break;
			}
			case 16:
			{
				$num_letra = "dieciseis ";
				break;
			}
			case 17:
			{
				$num_letra = "diecisiete ";
				break;
			}
			case 18:
			{
				$num_letra = "dieciocho ";
				break;
			}
			case 19:
			{
				$num_letra = "diecinueve ";
				break;
			}
		}
	}
	else
		$num_letra = $this->unidad($numero);

	return $num_letra;
}

function centena($numero)
{
	if ($numero >= 100)
	{
		if ($numero >= 900 & $numero <= 999)
		{
			$num_letra = "novecientos ";
			
			if ($numero > 900)
				$num_letra = $num_letra.$this->decena($numero - 900);
		}
		else if ($numero >= 800 && $numero <= 899)
		{
			$num_letra = "ochocientos ";
			
			if ($numero > 800)
				$num_letra = $num_letra.$this->decena($numero - 800);
		}
		else if ($numero >= 700 && $numero <= 799)
		{
			$num_letra = "setecientos ";
			
			if ($numero > 700)
				$num_letra = $num_letra.$this->decena($numero - 700);
		}
		else if ($numero >= 600 && $numero <= 699)
		{
			$num_letra = "seiscientos ";
			
			if ($numero > 600)
				$num_letra = $num_letra.$this->decena($numero - 600);
		}
		else if ($numero >= 500 && $numero <= 599)
		{
			$num_letra = "quinientos ";
			
			if ($numero > 500)
				$num_letra = $num_letra.$this->decena($numero - 500);
		}
		else if ($numero >= 400 && $numero <= 499)
		{
			$num_letra = "cuatrocientos ";
			
			if ($numero > 400)
				$num_letra = $num_letra.$this->decena($numero - 400);
		}
		else if ($numero >= 300 && $numero <= 399)
		{
			$num_letra = "trescientos ";
			
			if ($numero > 300)
				$num_letra = $num_letra.$this->decena($numero - 300);
		}
		else if ($numero >= 200 && $numero <= 299)
		{
			$num_letra = "doscientos ";
			
			if ($numero > 200)
				$num_letra = $num_letra.$this->decena($numero - 200);
		}
		else if ($numero >= 100 && $numero <= 199)
		{
			if ($numero == 100)
				$num_letra = "cien ";
			else
				$num_letra = "ciento ".$this->decena($numero - 100);
		}
	}
	else
		$num_letra = $this->decena($numero);
	
	return $num_letra;
}

function cien()
{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
		$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1 && $importe_parcial <= 9.99)
		$car = 1;
	else if ($importe_parcial >= 10 && $importe_parcial <= 99.99)
		$car = 2;
	else if ($importe_parcial >= 100 && $importe_parcial <= 999.99)
		$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	$num_letra = $this->centena($parcial).$this->centimos();
	
	return $num_letra;
}

function cien_mil()
{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
		$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1000 && $importe_parcial <= 9999.99)
		$car = 1;
	else if ($importe_parcial >= 10000 && $importe_parcial <= 99999.99)
		$car = 2;
	else if ($importe_parcial >= 100000 && $importe_parcial <= 999999.99)
		$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	if ($parcial > 0)
	{
		if ($parcial == 1)
			$num_letra = "mil ";
		else
			$num_letra = $this->centena($parcial)." mil ";
	}
	
	return $num_letra;
}


function millon()
{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
		$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1000000 && $importe_parcial <= 9999999.99)
		$car = 1;
	else if ($importe_parcial >= 10000000 && $importe_parcial <= 99999999.99)
		$car = 2;
	else if ($importe_parcial >= 100000000 && $importe_parcial <= 999999999.99)
		$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	if ($parcial == 1)
		$num_letras = "un millón ";
	else
		$num_letras = $this->centena($parcial)." millones ";
	
	return $num_letras;
}

function convertir_a_letras($numero)
{
	global $importe_parcial;
	
	$importe_parcial = $numero;
	
	if ($numero < 1000000000)
	{
		if ($numero >= 1000000 && $numero <= 999999999.99)
			$num_letras = $this->millon().$this->cien_mil().$this->cien();
		else if ($numero >= 1000 && $numero <= 999999.99)
			$num_letras = $this->cien_mil().$this->cien();
		else if ($numero >= 1 && $numero <= 999.99)
			$num_letras = $this->cien();
		else if ($numero >= 0.01 && $numero <= 0.99)
		{
			if ($numero == 0.01)
				$num_letras = "un céntimo";
			else
				$num_letras = $this->convertir_a_letras(($numero * 100)."/100")." céntimos";
		}
	}
	return $num_letras;
}*/
		var $resultado;
		var $antes_con_despues='con';
		var $despues = 'decimales';
		var $antes_sin_despues='';
		
		function numerosALetras($valor=''){
				if(is_numeric($valor))
					return $this->convertir($valor);
				return false;
			}
	
		function centenas($centenas){
				$valores = array(0=>'cero',1=>'uno',2=>'dos',3=>'tres',4=>'cuatro',5=>'cinco',6=>'seis',
				7=>'siete',8=>'ocho',9=>'nueve',10=>'diez',11=>'once',12=>'doce',13=>'trece',14=>'catorce',
				15=>'quince',16=>'dieciseis',17=>'diecisiete',18=>'dieciocho',19=>'diecinueve',20=>'veinte',30=>'treinta',40=>'cuarenta',50=>'cincuenta',
				60=>'sesenta',70=>'setenta',80=>'ochenta',90=>'noventa',100=>'ciento',
				101=>'quinientos',102=>'setecientos',103=>'novecientos');
		
				switch($centenas){
						case '1': return $valores[100]; break;
						case '5': return $valores[101]; break;
						case '7': return $valores[102]; break;
						case '9': return $valores[103]; break;
						default: return $valores[$centenas];
					}
			}
		
		function unidades($unidad){
				$valores = array(0=>'cero',1=>'uno',2=>'dos',3=>'tres',4=>'cuatro',5=>'cinco',6=>'seis',
				7=>'siete',8=>'ocho',9=>'nueve',10=>'diez',11=>'once',12=>'doce',13=>'trece',14=>'catorce',
				15=>'quince',16=>'dieciseis',17=>'diecisiete',18=>'dieciocho',19=>'diecinueve',20=>'veinte',30=>'treinta',40=>'cuarenta',50=>'cincuenta',
				60=>'sesenta',70=>'setenta',80=>'ochenta',90=>'noventa',100=>'ciento',
				101=>'quinientos',102=>'setecientos',103=>'novecientos'
				);
			
				return $valores[$unidad];
			}
	
		
		function decenas($decena){
				$valores = array(0=>'cero',1=>'uno',2=>'dos',3=>'tres',4=>'cuatro',5=>'cinco',6=>'seis',
				7=>'siete',8=>'ocho',9=>'nueve',10=>'diez',11=>'once',12=>'doce',13=>'trece',14=>'catorce',
				15=>'quince',16=>'dieciseis',17=>'diecisiete',18=>'dieciocho',19=>'diecinueve',20=>'veinte',30=>'treinta',
				40=>'cuarenta',50=>'cincuenta',60=>'sesenta',70=>'setenta',80=>'ochenta',90=>'noventa',
				100=>'ciento',101=>'quinientos',102=>'setecientos',103=>'novecientos');
		
				return $valores[$decena];
			}
	
	
		function evalua($valor){
				if($valor==0)
					return 'cero';
					
				$decimales = 0;
				$letras = '';
				while($valor!=0){
						// Validamos si supera los 100 millones
						if($valor>=1000000000)
							return 'L&iacute;mite de aplicaci&oacute;n exedido.';
						
						//$this->centenas de Millón
						if (($valor<1000000000) and ($valor>=100000000)){
								if ((intval($valor/100000000)==1) and (($valor-(intval($valor/100000000)*100000000))<1000000))
										$letras.=(string)'cien millones ';
									else{
										$letras.=$this->centenas(intval($valor/100000000));
										If ((intval($valor/100000000)<>1) and (intval($valor/100000000)<>5) and (intval($valor/100000000)<>7) and (intval($valor/100000000)<> 9))
												$letras.=(string)'ciento ';
											else
												$letras.=(string)' ';
									}
								$valor=$valor-(Intval($valor/100000000)*100000000);
							}
			
						//$this->decenas de Millón
						if(($valor<100000000) and ($valor>=10000000)){
								if(intval($valor/1000000)<16){
										$tempo=$this->decenas(intval($valor/1000000));
										$letras.=(string)$tempo;
										$letras.=(string)' millones ';
										$valor=$valor-(intval($valor/1000000)*1000000);
									}else{
										$letras.=$this->decenas(intval($valor/10000000)*10);
										$valor=$valor-(intval($valor/10000000)*10000000);
										if ($valor>1000000)
											$letras.=$letras.' y ';
									}
							}
			
						//$this->unidades de $this->millon
						if(($valor<10000000) and ($valor>=1000000)){
									$tempo=(intval($valor/1000000));
									if($tempo==1)
											$letras.=(string)' un mill&oacute;n ';
										else{
											$tempo= $this->unidades(intval($valor/1000000));
											$letras.=(string)$tempo;
											$letras.=(string)" millones ";
										}
								$valor=$valor-(intval($valor/1000000)*1000000);
							}
			
						//$this->centenas de Millar
						if(($valor<1000000) and ($valor>=100000)){
								$tempo=(intval($valor/100000));
								$tempo2=($valor-($tempo*100000));
								if(($tempo==1) and ($tempo2<1000))
										$letras.=(string) 'cien mil ';
									else{
										$tempo=$this->centenas(intval($valor/100000));
										$letras.=(string)$tempo;
										$tempo=(intval($valor/100000));
										if(($tempo <> 1) and ($tempo <> 5) and ($tempo <> 7) and ($tempo <> 9))
												$letras.=(string)'ciento ';
											else
												$letras.=(string)' ';
									}
								$valor=$valor-(intval($valor/100000)*100000);
							}
			
						//$this->decenas de Millar
						if(($valor<100000) and ($valor>=10000)){
								$tempo=(intval($valor/1000));
								if($tempo<16){
										$tempo=$this->decenas(intval($valor/1000));
										$letras.=(string)$tempo;
										$letras.=(string)' mil ';
										$valor=$valor-(intval($valor/1000)*1000);
									}else{
										$tempo=$this->decenas(intval($valor/10000)*10);
										$letras.=(string) $tempo;
										$valor=$valor-(intval(($valor/10000))*10000);
										if($valor>1000)
												$letras.=(string)' y';
											else
												$letras.=(string)' mil ';
									}
							}
			
			
						//$this->unidades de Millar
						if(($valor<10000) and ($valor>=1000)){
								$tempo=intval($valor/1000);
								if($tempo==1)
									$letras.=(string)'';//'un';
									else{
										$tempo=$this->unidades(intval($valor/1000));
										$letras.=(string) $tempo;
									}
                                    $palabras=explode(' ', $letras);
                                    if ($palabras[count($palabras)-1]=='y')$letras.=' un';
								$letras.=(string)' mil ';
								$valor=$valor-(intval($valor/1000)*1000);
							}
			
						//$this->centenas
						if(($valor<1000) and ($valor>99)){
								if ((intval($valor/100)==1) and (($valor-(intval($valor/100)*100))<1))
										$letras.='cien ';
									else{
										$temp=(intval($valor/100));
										
										$l2=$this->centenas($temp);
										//echo $l2."   vneruiohgvireho";
										$letras.=(string) $l2;
										if((intval($valor/100)<>1) and (intval($valor/100)<>5) and (intval($valor/100)<>7) and (intval($valor/100)<>9))
												$letras.=' ciento ';
											else
												$letras.=(string)' ';
									}
								$valor=$valor-(intval($valor/100)*100);
							}
			
						//$this->decenas
						if(($valor<100) and ($valor>9)){
								if($valor<16){
										$tempo=$this->decenas(intval($valor));
										$letras.=$tempo;
										$Numer =$valor-Intval($valor);
									}else{
										$tempo=$this->decenas(Intval(($valor/10))*10);
										$letras.=(string)$tempo;
										$valor=$valor-(Intval(($valor/10))*10);
										if($valor>0.99)
											$letras.=(string)' y ';
									}
							}
			
						//$this->unidades
						if(($valor<10) And ($valor>0.99)){
								$tempo=$this->unidades(intval($valor));
								$letras.=(string)$tempo;
								$valor=$valor-intval($valor);
							}
			
						//Decimales
						if($decimales<=0)
							if(($letras <> "Error en Conversi&oacute;n a Letras") and (strlen(trim($letras))>0))
								$letras .= (string) ' ';
					return $letras;
				}
			}
		
		function convertir($valor){
				ob_start();
				$tt = $valor;
				$valor = intval($tt);
				$decimales = $tt - intval($tt);
				
				$decimales = substr($decimales,strpos($decimales,'.'),3)*(100);
				$decimales= round($decimales);

				//Parte entera
				print $this->evalua($valor);
				
				//Parte Decimal
				if($decimales){
						print " $this->antes_con_despues ";
						print $this->evalua($decimales);
						print " $this->despues";
					}else{
						print " $this->antes_sin_despues ";
					}
				return $this->resultado = $texto = ob_get_clean();
			}
	}
?>