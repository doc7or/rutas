<?php
include("../lib/core.lib.php");
if (!inList($_SESSION['id_tipo_usuario'], '1,2'))
    header('Location: ../lib/common/logout.php');
//echo $usuario."  -- ".$clave." - ".$boton;
$tabla1="";
$tabla2="";

if (!empty($_POST['enviar'])) {

      mssql_query("BEGIN TRAN"); 
   $nombre_fichero = "/home/renebriceno/Escritorio/sap_archivos/factura.txt";
    $nombre_fichero1 = "/home/renebriceno/Escritorio/sap_archivos/facturap.txt";
//VERIFICAR SI AMBOS ARCHIBOS EXISTEN DE LO CONTRARIO TERMINA EL PROCESO
    if (file_exists($nombre_fichero) == false || file_exists($nombre_fichero1) == false) {
        die('ARCHIVO ' . $nombre_fichero . ' NO EXISTE');
    }
    $conta=0;
    $gestor = fopen($nombre_fichero, "r");
    //$contenido = fread($gestor, filesize($nombre_fichero));
    //$arreglo = Array();
    //$arreglo = explode("\n", $contenido);
    $resultado = Array();
    $facturas=array();
    $indice=0;
    $hora = date('H:i:s');
    //SE INSERTAR EN LA TABLA DE FACTURAS CREADA EN LA BASE DE DATOS DE RUTAS
   // print_r($arreglo);
     while(!feof($gestor)){
         $linea=  fgets($gestor);
        $d = explode("|", $linea);
         if (!empty($d[0])){
        $fecha = str_split($d[3], 2); //se divide el campo de 2 en 2 ya que envian el dato de la fecha todo junto ej: 20121003 - en vez de 2012-10-03
       
        $monto_fac = str_replace(array('.', ','), array('', '.'), $d[4]);
        $query = "INSERT INTO facturas (cliente,factura,des_cliente,fecha_fac,monto_fac,co_vendedor,des_vendedor) VALUES ('$d[1]','$d[0]','".str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "<"),
        ' ',$d[2])."','" . $fecha[0] . $fecha[1] . "-" . $fecha[2] . "-" . $fecha[3] . " " . $hora . "',$monto_fac,'$d[5]','$d[6]')";
//echo "<br>".$query."   c = ".$conta;
$consul="select * from facturas where factura='".$d[0]."'";
$resultado=mssql_query($consul);
        $tabla1.='<tr><td>'.$d[0].'</td><td>'.$d[2].'</td><td>'.$d[4].'</td><td>'.$d[6].'</td></tr>';
        if (!mssql_query($query)){
            echo "ERROR AL INGRESRA FACTURA ".$d[1];
            mssql_query("ROLLBACK TRAN");
            exit(0);
        }else{

        }

        }
    }

if (!copy($nombre_fichero,'../sistemas/respaldos/factura'.date('Ymd H:i:s'))){
$mensaje="Error al respaldar el archivo de facturas";
}else{
$mensaje="Respaldado el archivo de facturas";
}
$tabla1.='<tr><td colspan="4" align="center"><span style="font-weight:bold;font-size:16px;">'.$mensaje.'</span></td></tr>';
    //              echo "<h2>Clientes Ingresados</h2><hr>";
    fclose($gestor);
//////////////////////////////////////// INSERTAR FACTURAS DETALLE//////////////////////////////////////////
    
    if (file_exists($nombre_fichero1) == false) {
        mssql_query("ROLLBACK TRAN");
        die('ARCHIVO ' . $nombre_fichero1 . ' NO EXISTE');
    }
    $gestor11 = fopen($nombre_fichero1, "r");
    //$contenido11 = fread($gestor11, filesize($nombre_fichero1));
    //$arreglo11=Array();
  //  $arreglo11 = explode("\n", $contenido11);
    $resultado11 = Array();
    $conta2=0;
         while(!feof($gestor11)){
         $linea11=  fgets($gestor11);
        $d11 = explode("|", $linea11);
        if ($d11[0] != '') {

            $cantidad_art = str_replace(array('.', ','), array('', '.'), $d11[2]);
            $total_art  = str_replace(array('.', ','), array('', '.'), $d11[4]);
            $precio_art = $total_art/$cantidad_art;

                ++$conta2;
$consul="select id from facturas where factura='".$d11[0]."' order by id desc";
//echo $consul."<br>";
$resultado=mssql_query($consul);
if (mssql_num_rows($resultado)>=1){
    $datos_factura= mssql_fetch_array($resultado);
                $query11 = "INSERT INTO factura_detalle (factura,co_articulo,cantidad_art,co_almacen,precio_art,total_art,descuento_art,des_art,id_factura) VALUES ('$d11[0]','$d11[1]',$cantidad_art,'$d11[3]',$precio_art,$total_art,'$d11[5]','".str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "<"),
        ' ',$d11[6])."',".$datos_factura['id'].")";
            //        echo "<br>".$query11."--------"."   c = ".$conta2;
            $tabla2.='<tr><td>'.$d11[0].'</td><td>'.$d11[1].'</td><td>'.$d11[2].'</td><td>'.$d11[4].'</td></tr>';
                   if (!mssql_query($query11)){
            echo "ERROR AL INGRESRA FACTURA DETALLE ".$d11[0];
            mssql_query("ROLLBACK TRAN");
            exit(0);
        }
	}
        }
    }
    fclose($gestor11);
if (!copy($nombre_fichero1,'../sistemas/respaldos/facturap'.date('Ymd H:i:s'))){
$mensaje="Error al respaldar el archivo de facturas detalle";
}else{
$mensaje="Respaldado el archivo de facturas detalle";
}
$tabla2.='<tr><td colspan="4" align="center"><span style="font-weight:bold;font-size:16px;">'.$mensaje.'</span></td></tr>';
    mssql_query("COMMIT TRAN");
    //consulta y while para trerse todas las facturas entre las fechas del 1/10/2012 y hoy para actualizar todas las facturas viejas de SAP
/*
    $consulta_fac="select b.id_factura as id_factura,b.id as id_con_det,a.id as id_con,a.id_sucursal as id_sucursal from control_salida as a inner join control_salida_detalle as b on a.id=b.id_control_salida where (fecha BETWEEN '2012/11/01 00:00:00' AND '2012/12/31 23:59:59') and a.tipo=1";
       mssql_query("BEGIN TRAN");
    //echo $consulta_fac."<br>";
    $resul_fac=  mssql_query($consulta_fac);
    $renglon=0;
    $contador=0;
    while($facturas_f=  mssql_fetch_array($resul_fac)){ 
    $fac_aux="";
    //SE INSERTA EN LA TABLA DE CON_SAL_DET_RENG TODOS LOS ARTICULOS DE LAS FACTURAS
              switch (trim($facturas_f['id_sucursal'])){
             case "18":$pre_fijo='0092';break;
             case "2":$pre_fijo='00900';break;
             case "22":$pre_fijo='00';break;
             case "1":$pre_fijo='0091';break;
         }
            $consulta="select * from facturas as a inner join factura_detalle as b on a.factura=b.factura where a.factura='".trim($pre_fijo.$facturas_f['id_factura'])."'";
            echo $consulta."  ".$facturas_f['id_sucursal']."a<br>";
            $result=  mssql_query($consulta);
            if (mssql_num_rows($result)>0){
                while($fila=  mssql_fetch_assoc($result)){
                switch ($fila['co_almacen']) {
                    case '1110':$fila['co_almacen']='NPT';break;
                    case '1140':$fila['co_almacen']='HPT';break;
                    case '1120':$fila['co_almacen']='ALMAR';break;
                    case '1130':$fila['co_almacen']='PFJ';break;
                }
                if ($fac_aux!=$fila['factura']){
                    $fac_aux=$fila['factura'];
                    $consulta2="update control_salida set monto_facturas=".$fila['monto_fac']." where id=".$facturas_f['id_con'];
                    $consulta3="update control_salida_detalle set id_factura='".$fila['factura']."', co_cli='".$fila['cliente']."',co_ven='".$fila['co_vendedor']."',monto_factura=".$fila['monto_fac'].",ven_des='".$fila['des_vendedor']."',fec_emis='".$fila['fecha_fac']."' where id=".$facturas_f['id_con_det'];
                    $renglon=0;
                }    
                
                    $id_con_detalle=$facturas_f['id_con_det'];


                $consulta0 = "INSERT INTO con_sal_det_reng (co_art,total_art,co_alma,reng_num,fact_num,id_con_detalle,prec_vta,porc_desc,reng_neto,art_des,status_web) VALUES ('".$fila['co_articulo']."',".$fila['total_art'].",'".$fila['co_almacen']."',".$renglon.",'".$fila['factura']."',".$id_con_detalle.",".$fila['precio_art'].",'".$fila['descuento_art']."',".$fila['total_art'].",'".$fila['des_art']."','1')";
                ++$renglon;
                if (!empty($fila["factura"])){
                $result0=  mssql_query($consulta0);
                $result2=  mssql_query($consulta2);
                $result3=  mssql_query($consulta3); 
                if ($result0 && $result2 && $result3){
                    echo "ingresada factura ".$fila['factura']."<br>";
                    ++$contador;
                    echo $consulta0."     ".$consulta2."     ".$consulta3."     ".$contador."<br>";
                }else{
                    echo "ERROR AL INGRESAR FACTURA  ".$fila['factura']."<BR>";
                    mssql_query("ROLLBACK TRAN");
                    exit(0);
                }
                }
                
                }
                                
              //  

            }
            
    }
    mssql_query("COMMIT TRAN");
    echo $contador;
        */
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../css/cyberlux.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" media="all"  href="../lib/js/calendar/skins/aqua/aqua.css"  title="win2k-cold-1" />
        <title><?php echo SYSTEM_NAME; ?></title>
        <script type="text/javascript" src="../lib/js/jquery/jquery-1.2.1.js"></script>
        <script type="text/javascript" src="../lib/js/funciones.js"></script>
        <script type="text/javascript" src="../lib/js/funct_form_val.js"></script>
        <script type="text/javascript" src="../lib/js/calendar/calendar.js"></script>
        <script type="text/javascript" src="../lib/js/calendar/lang/calendar-es.js"></script>
        <script type="text/javascript" src="../lib/js/calendar/calendar-setup.js"></script>
        <script type="text/javascript" >
            function importar_data(){
                document.form1.submit();
            }
        </script>
    </head>

    <body id="todo">
        <div id="contenedor" >
            <div id="header" ></div>
            <div id="menu" >
<?php include ("../lib/common/menu_superior.php"); ?>
            </div>
            <div id="contenido" > 

                <form name="form1" method="post" action="importarDataSapPrimera.php">
                    <br>
                        <div style="margin-left: 10px;width: 500px;padding: 20px;" class="redondear">
                            <table width="100%">

                                <tr>
                                    <td  align="center">
                                        <button name="enviar" value="enviar" style="width: 200px;height: 100px;color:#00ffff;background-color: black; font-size: 18px;">Importar Data </button>
                                    </td>
                                </tr>
                            </table>
                            <br>
                                <table width="100%">
                                    <tr><td colspan="4">Datos de la Factura</td></tr>
                                    <tr>
                                        <td><b>Numero Factura</b></td><td><b>Cliente</b></td><td><b>Monto</b></td><td><b>Vendedor</b></td>
                                        <?php echo $tabla1; ?>
                                    </tr>
                                </table>
                                <br></br>
                                <table width="100%">
                                    <tr><td colspan="4">Detalles de la Factura</td></tr>
                                    <tr>
                                        <td><b>Numero Factura</b></td><td><b>Codigo Art</b></td><td><b>Cantidad Art</b></td><td><b>Precio Art</b></td>
                                        <?php echo $tabla2; ?>
                                    </tr>
                                </table>                    
                        </div>
                </form>
            </div>
            <div id="footer" >
<?php include ("../lib/common/footer.php"); ?>
            </div>
        </div>
    </body>

