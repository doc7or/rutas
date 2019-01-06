<?php


function validate($cc){
$doubledNumber  = "";
$odd            = false;
	for($i = strlen($cc)-1; $i >=0; $i--){
		$doubledNumber .= ($odd) ? $cc[$i]*2 : $cc[$i];
		$odd            = !$odd;
	}
$sum = 0;
	for($i = 0; $i < strlen($doubledNumber); $i++)
		$sum += (int)$doubledNumber[$i];
		return (($sum % 10 ==0) && ($sum != 0));
 }
function cvv($cvv) {
	if (!is_numeric($cvv) || strlen($cvv) < 3)
		return true;
return false;
} 
function check($value) {
	if (empty($value) || strlen($value) < 4) 
		return true;
return false;
}
function datecheck($luna, $an) {
	if ($luna < 01 || $luna > 31 || !is_numeric($luna) || $an < 08 || $an > 20 || !is_numeric($an))
		return true;
return false;
}
function query_str($params) {
$str = '';
	foreach ($params as $key => $value) {
		$str .= (strlen($str) < 1) ? '' : '&';
		$str .= $key . '=' . rawurlencode($value);
	}
return ($str);
}


 ?>

 