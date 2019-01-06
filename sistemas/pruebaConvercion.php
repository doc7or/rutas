<?php
function convertir_especiales_html($str){
   if (!isset($GLOBALS["carateres_latinos"])){
      $todas = get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES);
      $etiquetas = get_html_translation_table(HTML_SPECIALCHARS, ENT_NOQUOTES);
      $GLOBALS["carateres_latinos"] = array_diff($todas, $etiquetas);
   }
   $str = strtr($str, $GLOBALS["carateres_latinos"]);
   return $str;
} 


$cadena='TELEVISOR CYBERLUX Mod.TVCX14JP 14" ';
		
	echo 'con htmlentities : '.htmlentities($cadena).'<br>';
	echo 'con htmlspecialchars : '.htmlspecialchars($cadena).'<br>';	
	echo 'con una funcion convertir_especiales_html : '.convertir_especiales_html($cadena).'<br>';	

	                                                                                     
?>
