<?php

require('../lib/php/fpdf/fpdf.php');
define('FPDF_FONTPATH','../font/');

//require($_SERVER['DOCUMENT_ROOT']."/rutas/lib/core.lib.php");
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/cheques.class.php");
//require('formato_cheque.php');
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/numerosALetras.class.php");
//$pdf=new PDF('L','mm','Legal');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
var $sucursal;
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function mes($mes){
	switch ($mes){
		case 1:return "ENERO";break;
		case 2:return "FEBRERO";break;
		case 3:return "MARZO";break;
		case 4:return "ABRIL";break;
		case 5:return "MAYO";break;
		case 6:return "JUNIO";break;
		case 7:return "JULIO";break;
		case 8:return "AGOSTO";break;
		case 9:return "SEPTIEMBRE";break;
		case 10:return "OCTUBRE";break;
		case 11:return "NOVIEMBRE";break;
		case 12:return "DICIEMBRE";break;
		default:return 0;
	}
}

function Header1($arreglo){
$num_a_letras=new numerosALetras();
$this->SetLeftMargin(7);
//$consul=new consultas();
/*$sql="select * from plantel";	
$resul=$consul->consulta($sql);
$row=mysql_fetch_array($resul);*/

//RECORTAR 25 DE LA AXIZA Y SI QUEDA MUY LARGA LA IMPRESION

$monto_mostrar=str_replace(".","",$arreglo["monto_final"]);
list($entero,$decimal)=explode(",",$monto_mostrar);
$entero=rtrim(strtoupper($num_a_letras->convertir($entero)));
$decimal_aux=$decimal;
$this->SetFont('Arial','',12);
if (empty($decimal_aux)){
	$decimal_aux=00;
	$this->Text(155,38,'**'.$arreglo["monto_final"].'.00**');
}else{
	$this->Text(155,38,'**'.$arreglo["monto_final"].'**');
}
$this->SetFont('Arial','',10);
$decimal=strtoupper($num_a_letras->convertir('0.'.$decimal));
$decimal=str_replace('CERO ','',$decimal);

$empresa=strtoupper($arreglo["descripcion"]);
$this->Text(65,50,'***'.$empresa.'***');

$this->Text(55,57,$entero);

$this->Text(48,63,'CON '.$decimal_aux.'/100');
$fecha_desde=explode('/',$arreglo["fecha_desde"]);
$this->Text(19,70,'VALENCIA '.$fecha_desde[0].' DE '.$this->mes($fecha_desde[1]).'                '.$fecha_desde[2]);

$this->Text(125,96,'***NO ENDOSABLE***');

$this->Text(25,175,$arreglo["observaciones"],0,'C',false);

if (empty($decimal_aux)){//se creo este if de nuevo por apuro
	$decimal_aux=00;
	$this->Text(154,175,$arreglo["monto_final"].'.00',1,0,'R');
}else{
	$this->Text(154,175,$arreglo["monto_final"],1,0,'R');
}
$this->Text(155,150,strtoupper($arreglo["num_cheque"]));
$this->Text(40,150,strtoupper($arreglo["banco"]));
$this->Text(92,150,strtoupper($arreglo["sucursal"]));


$this->Text(30,135,'INVERSIONES NEMARTIZ , C.A');

	//$this->I mage('images/secretaria.jpg',25,8,40,20);

	$this->Ln(0);
}//fin funcion header

function Row($data,$band)
{ 
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{

		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//$this->SetFillColor(200,200,200);
		//$this->SetDrawColor(128,0,0);
			if ($band==0){
			$this->SetDrawColor(0,0,0);
	$x=7;
	$this->SetX(7);
	//$this->SetDrawColor(0,0,0);
		//Draw the border
		//$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
		}else{
				//$this->SetDrawColor(255,255,255);
	$this->SetDrawColor(0,0,0);
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
		}
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{

	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
function Footer()
{
    //Posición: a 1,5 cm del final
    //$this->SetY(-15);
    //Arial italic 8
    //$this->SetFont('Arial','I',10);
    //Número de página
   // $this->Text(32,280,$this->sucursal);
  //  $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$descripcion=explode('|',$_GET['descripcion']);//esta variable contiene el id_de la empresa y su nombre ya que se concatenaron los datos y se encuentran en $_GET['descripcion']
$sucur=explode('|',$_GET['sucursal']);//esta variable contiene el id_de la empresa y su nombre ya que se concatenaron los datos y se encuentran en $_GET['descripcion']

$arreglo=array("descripcion"=>"$descripcion[0]","monto_neto"=>"$_GET[monto_neto]","iva"=>"$_GET[iva]","monto_iva"=>"$_GET[monto_iva]","retencion"=>"$_GET[retencion]","retencion_monto"=>"$_GET[retencion_monto]","pago_caja"=>"$_GET[pago_caja]","pago_afiliado"=>"$_GET[pago_afiliado]","sucursal"=>"$sucur[0]","num_cheque"=>"$_GET[num_cheque]","banco"=>"$_GET[banco]","monto_final"=>"$_GET[monto_final]","observaciones"=>"$_GET[observaciones]","fecha_desde"=>"$_GET[fecha_desde]");
$cheques=new class_cheque();
$arr_cheques=$cheques->get_cheque(0,$descripcion[1],$_GET['id_nomina']);
if ($arr_cheques[0]['id']==0){
$fecha_desde=explode('/',$arreglo["fecha_desde"]);
$fecha_realizacion=explode('/',$_GET["fecha_realizacion"]);
$monto_mostrar=str_replace(".","",$arreglo["monto_final"]);
$monto_mostrar=str_replace(",",".",$monto_mostrar);
$validar=$cheques->add_cheque(trim($arreglo["num_cheque"]),$arreglo["banco"],$monto_mostrar,$descripcion[1],$arreglo["observaciones"],0,$_SESSION['id_tipo_usuario'],$fecha_desde[2]."/".$fecha_desde[1]."/".$fecha_desde[0].' 00:00:00',$_GET['num_sucursal'],$_GET['id_nomina'],$_GET["fecha_realizacion"].' 00:00:00');
if ($validar!=1)
	echo 'ERROR AL INGRESAR EL CHEQUE';
	
}else{
	$validar=1;
}
//echo "val   ".$validar;
$pdf=new PDF_MC_Table('P','mm','A4');

$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//$pdf->SetFont('Times','',10);
if ($validar==1)
$pdf->Header1($arreglo);
else echo $validar;
$pdf->AliasNbPages();

$pdf->Output();
?>
