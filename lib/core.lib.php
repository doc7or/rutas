<?php
//Evitamos ataques de scripts de otros sitios
if(eregi("core.lib.php", $_SERVER["PHP_SELF"]) || eregi("core.lib.php",  $_SERVER["PHP_SELF"])) die("Access denied!");

@session_start();
ob_start();
//El config_var va en el mismo directorio del core.lib
require("config_var.php"); 
//El conex va en el mismo directorio del corelib
require("conn.php"); 

//Carga de clases del sistema
require(APPROOT."lib/class/cod_area_telefono.class.php");
require(APPROOT."lib/class/con_sal_det_reng.class.php");
require(APPROOT."lib/class/conexiones.class.php");
require(APPROOT."lib/class/control_post.class.php");
require(APPROOT."lib/class/control_salida.class.php");
require(APPROOT."lib/class/control_salida_detalle.class.php");
require(APPROOT."lib/class/control_salida_extra.class.php");
require(APPROOT."lib/class/control_salida_extra_detalle.class.php");
require(APPROOT."lib/class/control_salida_detalle_post.class.php");
require(APPROOT."lib/class/control_salida_status.class.php");
require(APPROOT."lib/class/empresa.class.php");
require(APPROOT."lib/class/env_rec_facturas.class.php");
require(APPROOT."lib/class/env_rec_facturas_detalle.class.php");
require(APPROOT."lib/class/escolta.class.php");
require(APPROOT."lib/class/estado.class.php");
require(APPROOT."lib/class/factura_temp_uso.class.php");
require(APPROOT."lib/class/general.class.php");
require(APPROOT."lib/class/guia_carga.class.php");
require(APPROOT."lib/class/iva.class.php");
require(APPROOT."lib/class/log.class.php");
require(APPROOT."lib/class/log_tipo.class.php");
require(APPROOT."lib/class/nomina.class.php");
require(APPROOT."lib/class/nomina_detalle.class.php");
require(APPROOT."lib/class/ruta_base.class.php");
require(APPROOT."lib/class/ruta_base_escala.class.php");
require(APPROOT."lib/class/sucursal.class.php");
require(APPROOT."lib/class/tabulador_costo.class.php");
require(APPROOT."lib/class/transportista.class.php");
require(APPROOT."lib/class/usuario.class.php");
require(APPROOT."lib/class/usuario_tipo.class.php");
require(APPROOT."lib/class/vehiculo.class.php");
require(APPROOT."lib/class/vehiculo_tipo.class.php");
require(APPROOT."lib/class/zona.class.php");

//Carga de clases del sistema
require(APPROOT."lib/class/cyberlux_clientes.class.php");
require(APPROOT."lib/class/cyberlux_factura.class.php");
require(APPROOT."lib/class/cyberlux_sub_alma.class.php");
require(APPROOT."lib/class/cyberlux_tras_alm.class.php");
require(APPROOT."lib/class/cyberlux_not_ent.class.php");
require(APPROOT."lib/class/cyberlux_pedidos.class.php");
//carga de clases de vfnet
require(APPROOT."lib/class/vfnet_csdr.class.php");



//utilitarias
require(APPROOT."lib/php/funciones.php");
require(APPROOT."lib/php/fpdf/fpdf.php");
require(APPROOT."lib/php/fpdf/pdf.class.php");
require(APPROOT."lib/php/fpdf/pdf_tras.class.php");
require(APPROOT."lib/php/fpdf/pdf_nota.class.php");

?>

