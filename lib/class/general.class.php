<?php 
class class_general {

/*
ESTA CLASE HARA: 
	*	HACER BUSQUEDAS DE MANERAS GENERALES O DINAMICAS SIN IMPORTAR LA TABLA O EL CAMPO
	*	BUSQUEDAS EN DIFERENTES TABLAS LAS CUALES SE HARIA DIFICIL DE ENCAJAR EN UNA CLASE RELACIONADA A UNA TABLA EN PARTICULAR
*/

	// busa en una tabla en especifico por algun campo el valor dado de haverlo devolvera un numero >0 de lo comtrario 0
	function get_dinamic($tabla='',$campo='',$valor_campo='',$id_tabla_edit='', $valor_id_tabla_edit='',$id_tabla_add='', $valor_id_tabla_add='',$id_sucursal='',$valor_sucursal=''){
		/*  PARAMETROS DE LA FUNCION
			$tabla					ESTE ES EL NOMBRE DE LA TABLA Q SE VA A USAR
			$campo					EL CAMPO DELA TABLA Q SE DESEA BUSCAR
			$valor_campo			EL VALOR DEL CAMPO A BUSCAR
			$id_tabla_edit			CAMPO DE LA TABLA POR EL CUAL SE VA A COMPARAR Q NO SEA IGUAL SE USA PARA LA EDICION
			$valor_id_tabla_edit	VALOR DEL CAMPO POR EL CUAL SE VA A EDITAR
			$id_tabla_add			CAMPO DE LA TABLA POR EL CUAL SE VA A COMPARAR Q SEA IGUAL SE USA PARA LA ADDICION
			$valor_id_add			VALOR DEL CAMPO POR EL CUAL SE VA A ADICCION
			$id_sucursal			ID DEL CAMPO DE SUCURSAL DE LA TABLA DADA
			$valor_sucursal			VALOR DE LA SUCURSA
		*/
		$sQuery="SELECT * FROM $tabla WHERE $campo='$valor_campo' ";
		if($valor_id_tabla_edit!='') $sQuery.="  AND $id_tabla_edit<>'$valor_id_tabla_edit' ";
		if($valor_id_tabla_add!='') $sQuery.="  AND $id_tabla_add='$valor_id_tabla_add' ";
		if($valor_sucursal!='') $sQuery.="  AND $id_sucursal='$valor_sucursal' ";
		
		//echo($sQuery);
		$result=mssql_query($sQuery) or die(mssql_min_error_severity());
		$respuesta=mssql_num_rows($result);
		return($respuesta);
	}
	
	
	
}
?>
