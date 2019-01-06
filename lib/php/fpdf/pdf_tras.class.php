<?php
class PDF_TRAS extends FPDF
{
//Cabecera de página
function Header()
{
    global $title;

    $this->Ln(20);
}

function Footer()
{
	//Posición: a 1,5 cm del final
   /* $this->SetY(-50);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
*/
 
	
}

function headerImagen($num_guia,$link)
{

	//$this->Image('../images/encabezado.jpg',10,8,200);
	$this->SetFont('Times','B',14);	
	$this->SetXY(175,17);
	$this->Cell(10,10,'No: ');//etiqueta nota
	$this->SetFont('Times','B',14);
	$this->SetTextColor(255,0,0);
	$this->SetXY(190,17);
	//die('esta es la guia'.$num_guia);
   	$this->Cell(10,10,$num_guia,0,0,0,0,$link);//numero de la guia o control de salida
	$this->SetTextColor(0,0,0);
}

function footerImagen()
{

	$this->Image('../images/pie.jpg',10,240,200);
	
}

////////////////SECCION IMPRECION DEL COMPROBANTE DE SALIDA////////////////////
function dataControlEncabezado($num_guia,$fecha,$transporte,$chofer,$telefonos_chofer,$placa,$vehiculo,$destino,$desvio,$link)
{
	$label_num_guia=utf8_decode('Nro. de Guia:   ');//etiqueta de nmero de guia
	
	$this->SetFont('Arial','B',12);
	$this->SetXY(140,60);
   	$this->Cell(40,10,$label_num_guia.' '.$num_guia,0,0,0,0,$link);//numero de la guia o control de salida
	
	
		//ETIQUETAS DE DETALLLES///
		$this->SetFont('Arial','',10);
		$this->SetXY(25,60);
		$this->Cell(40,10,'Fecha');//etiqueta de la fecha
		$this->SetXY(25,65);
		$this->Cell(40,10,'Transporte');//etiqueta del Transporte
		$this->SetXY(25,70);
		$this->Cell(40,10,'Chofer');//etiqueta de la fecha
		$this->SetXY(120,70);
		$this->Cell(40,10,'Telefonos');//etiqueta de los telefonos
		$this->SetXY(25,75);
		$this->Cell(40,10,'Placa');//etiqueta de la placa
		$this->SetXY(120,75);
		$this->Cell(40,10,'Vehiculo');//etiqueta del tipo de vehiculo
		/*$this->SetXY(25,85);
		$this->Cell(40,10,'Escolta');//estqueta de escolta
		$this->SetXY(120,85);
		$this->Cell(40,10,'Telefonos');//etiqueta de ls telefonos de el escolta
		$this->SetXY(25,90);
		$this->Cell(40,10,'Destino');//etiqueta del destino*/
		$this->SetXY(25,80);
		$this->Cell(40,10,'Destino');//etiqueta del destino1
		$this->SetXY(25,85);
		$this->Cell(40,10,'Desvio');//etiqueta del destino1
		//ETIQUETAS DE DETALLLES///
		
		
		///DATOS //
		$this->SetFont('Arial','B',9);
		$this->SetXY(45,60);
		$this->Cell(40,10,$fecha);//fecha
		$this->SetXY(45,65);
		$this->Cell(40,10,$transporte);//fecha
		$this->SetXY(45,70);
		$this->Cell(40,10,$chofer);//fecha
		$this->SetXY(140,70);
		$this->Cell(40,10,$telefonos_chofer);//telefonos chofer
		$this->SetXY(45,75);
		$this->Cell(40,10,$placa);//placa
		$this->SetXY(140,75);
		$this->Cell(40,10,$vehiculo);//vehiculo
		$this->SetXY(45,82);
		$this->MultiCell(120,3,utf8_decode($destino));//destino se usa multi cell por los posibles saltos de linea
		$this->SetXY(45,85);
		$this->MultiCell(120,10,utf8_decode($desvio));//destino se usa multi cell por los posibles saltos de linea
		
		///DATOS //
	
	//LINEAS DIVISOPRIAS DE MODULOS//1
	$this->Line(22,95,203,95);
	//LINEAS DIVISOPRIAS DE MODULOS//2
	$this->Line(22,179,203,179);
	//LINEAS DIVISOPRIAS DE MODULOS//3
	$this->Line(22,229,203,229);
	  
}

function dataControlDetalle($id_factura,$monto_factura,$cliente,$i){
//	die($id_factura.'----'.$monto_factura.'----'.$cliente.'----'.$i);
	
	//rectangulo de las Facturas
	$this->Rect(25, 100, 175, 65,'');//rectangulo de la fattuta
	//seccion de titulos de las facturas
	$this->SetFont('Arial','B',12);	
	$this->SetXY(25,100);
	$this->Cell(100,5,'Origen',1,0,'C',0);//etiqueta nota
	$this->SetXY(125,100);
	$this->Cell(25,5,'Traslado',1,0,'C',0);//etiqueta nota
	$this->SetXY(150,100);
	$this->Cell(50,5,'Destino',1,0,'C',0);//etiqueta nota
	

	$y_inicual=105;
	$y_actual=$y_inicual+($i*4);
	//esto va para el detalle
	$this->SetFont('Arial','',9);	
	$this->SetXY(25,$y_actual);
	$this->MultiCell(100,4,'  '.utf8_decode($cliente),1,'');//Detalle de origen
	$this->SetXY(125,$y_actual);
	$this->Cell(25,4,$id_factura,1,0,'C',0);//Detalle de faturas numero de la factura
	$this->SetXY(150,$y_actual);
	$this->Cell(50,4,utf8_decode($monto_factura),1,'');//Detalle de destino
		
	//MONTO FINAL	
	/*$this->SetFont('Arial','B',12);	
	$this->SetXY(115,165);
	$this->Cell(40,10,'Monto sin I.V.A: ');//etiqueta nota*/
	
	



}

function dataControlDetalleTotalizador($monto_sin_iva){
	///monto final
	$this->SetFont('Arial','B',12);	
	$this->SetXY(150,165);
	$this->Cell(50,10,number_format($monto_sin_iva,2,",",".").' ',0,0,'R');//Detalle monto sin iva
}


function dataControlPie($flete,$adelanto,$caleta_c,$caleta_p,$desvio_monto,$observaciones){
	//DETALLES BASES PIE//
	//rectangulo de la nota
	$this->Rect(102, 185, 100, 35,'');//rectangulo de la nota
	$this->SetFont('Arial','B',10);	
	$this->SetXY(104,185);
	$this->Cell(40,10,'Nota: ');//etiqueta nota
	
	//ETIQUETAS DE DETALLLES///
	$this->SetFont('Arial','',10);
	$this->SetXY(25,185);
	$this->Cell(40,10,'Flete');//etiqueta flete
	$this->SetXY(25,190);
	$this->Cell(40,10,'Adelanto');//etiqueta /caleta cancelada
	$this->SetXY(25,195);
	$this->Cell(40,10,'Caleta Cancelada');//etiqueta de la fecha
	$this->SetXY(25,200);
	$this->Cell(40,10,'Caleta Pendiente');//etiqueta de la caleta pendiente
	$this->SetXY(25,205);
	$this->Cell(40,10,'Desvio');//etiqueta de la desvio
	$this->SetFont('Arial','B',10);
	$this->SetXY(25,210);
	$this->Cell(40,10,'Saldo');//etiqueta de la desvio

	//ETIQUETAS DE DETALLLES///
	
	
	///DATOS //
	$this->SetFont('Arial','B',10);
	$this->SetXY(55,185);
	$this->Cell(40,10,number_format($flete,2,",",".").' ',0,0,'R');//fflete
	$this->SetXY(55,190);
	$this->Cell(40,10,number_format($adelanto,2,",","").' ',0,0,'R');//fflete
	$this->SetXY(55,195);
	$this->Cell(40,10,number_format($caleta_c,2,",",".").' ',0,0,'R');//caleta cancelada
	$this->SetXY(55,200);
	$this->Cell(40,10,number_format(0,2,",",".").' ',0,0,'R');//caleta pendiente
	$this->SetXY(55,205);
	$this->Cell(40,10,number_format($desvio_monto,2,",",".").' ',0,0,'R');//caleta pendiente
	//$saldo=($desvio_monto+$caleta_p+$flete)-$adelanto;
	$saldo=($desvio_monto+$flete)-$adelanto;
	$this->SetXY(55,210);
	$this->Cell(40,10,number_format($saldo,2,",",".").' ',0,0,'R');//caleta pendiente
	
	///DATOS //
	
	//observacion o nota
	$this->SetFont('Arial','',9);	
	$this->SetXY(116,188);
	$this->MultiCell(80,3,$observaciones);//etiqueta nota
	

}

////////////////SECCION IMPRECION DEL COMPROBANTED DE SALIDA////////////////////



}//finde la claase

?>