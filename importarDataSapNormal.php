<?php
include("../lib/core.lib.php");
if (!inList($_SESSION['id_tipo_usuario'], '1,2'))
    header('Location: ../lib/common/logout.php');
//echo $usuario."  -- ".$clave." - ".$boton;
$tabla1="";
$tabla2="";

if (!empty($_POST['enviar'])) {
    mssql_query("BEGIN TRAN");
    $nombre_fichero = "/home/mervin/factura31102012.txt";
    $nombre_fichero1 = "/home/mervin/facturap31102012.txt";
//VERIFICAR SI AMBOS ARCHIBOS EXISTEN DE LO CONTRARIO TERMINA EL PROCESO
    if (file_exists($nombre_fichero) == false || file_exists($nombre_fichero1) == false) {
        die('ARCHIVO ' . $nombre_fichero . ' NO EXISTE');
    }
    $gestor = fopen($nombre_fichero, "r");
    $contenido = fread($gestor, filesize($nombre_fichero));
    $arreglo = explode("\n", $contenido);
    $resultado = Array();
    $facturas=array();
    $indice=0;
    $hora = date('H:i:s');
    //SE INSERTAR EN LA TABLA DE FACTURAS CREADA EN LA BASE DE DATOS DE RUTAS
    foreach ($arreglo as $linea) {
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
//echo "<br>".$query;
        $tabla1.='<tr><td>'.$d[0].'</td><td>'.$d[2].'</td><td>'.$d[4].'</td><td>'.$d[6].'</td></tr>';
        if (!mssql_query($query)){
            echo "ERROR AL INGRESRA FACTURA ".$d[1];
            mssql_query("ROLLBACK TRAN");
            exit(0);
        }else{

        }
        }
    }
    //              echo "<h2>Clientes Ingresados</h2><hr>";
    fclose($gestor);
//////////////////////////////////////// INSERTAR FACTURAS DETALLE//////////////////////////////////////////
    if (file_exists($nombre_fichero1) == false) {
        mssql_query("ROLLBACK TRAN");
        die('ARCHIVO ' . $nombre_fichero1 . ' NO EXISTE');
    }
    $gestor11 = fopen($nombre_fichero1, "r");
    $contenido11 = fread($gestor11, filesize($nombre_fichero1));
    $arreglo11 = explode("\n", $contenido11);
    $resultado11 = Array();
    
    foreach ($arreglo11 as $linea11) {
        $d11 = explode("|", $linea11);
        if ($d11[0] != '') {

            $cantidad_art = str_replace(array('.', ','), array('', '.'), $d11[2]);
            $total_art  = str_replace(array('.', ','), array('', '.'), $d11[4]);
            $precio_art = $total_art/$cantidad_art;
            $query11 = "INSERT INTO factura_detalle (factura,co_articulo,cantidad_art,co_almacen,precio_art,total_art,descuento_art,des_art) VALUES ('$d11[0]','$d11[1]',$cantidad_art,'$d11[3]',$precio_art,$total_art,'$d11[5]','$d11[6]')";
            $tabla2.='<tr><td>'.$d11[0].'</td><td>'.$d11[1].'</td><td>'.$d11[2].'</td><td>'.$d11[4].'</td></tr>';
            //    echo "<br>".$query11."--------";
            $resEmp11 = mssql_query($query11);
                    if (!mssql_query($query)){
            echo "ERROR AL INGRESRA FACTURA ".$d11[0];
            mssql_query("ROLLBACK TRAN");
            exit(0);
        }
        }
    }
    fclose($gestor11);
    
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

                <form name="form1" method="post" action="importarDataSap.php">
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
