<?php
'SELECT nomina_detalle.id,nomina_detalle.id_nomina,nomina_detalle.id_guia,
	   control_salida.id AS cs_id ,control_salida.id_por_sucursal AS cs_id_por_sucursal ,control_salida.id_sucursal,control_salida.status
FROM nomina_detalle
	 Inner Join control_salida ON control_salida.id = nomina_detalle.id_guia
WHERE
	control_salida.status<>'4'
ORDER BY id_sucursal'
?>
