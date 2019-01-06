<?php

require('../lib/php/fpdf/fpdf.php');
define('FPDF_FONTPATH','../font/');
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/cheques.class.php");
//require($_SERVER['DOCUMENT_ROOT']."/rutas/lib/core.lib.php");

//require('formato_cheque.php');
require($_SERVER['DOCUMENT_ROOT']."/RUTAS/lib/class/numerosALetras.class.php");
//$pdf=new PDF('L','mm','Legal');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

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

function Header1(){

$this->SetLeftMargin(7);
//$consul=new consultas();
/*$sql="select * from plantel";	
$resul=$consul->consulta($sql);
$row=mysql_fetch_array($resul);*/

	//Title
	$this->Image('../images/logo_empresa.jpg',18,7,25,12);
	//$this->Image('images/sol de proyecto venezuela3.jpg',300,8,40,20);
	/*if ($tipo_repor=="Por Desincorporar" || $tipo_repor=="Desincorporado"){
	
	$titulo="de Items ";
	$titulo.=$tipo_repor;
	//echo "keuwhfiouwehof";
	}*/
	$this->SetFillColor(200,200,200);
	$this->SetFont('Arial','',16);
	$this->SetY(6);
	//$this->SetX(20);
	$this->Cell(0,6,'Reporte de Cheque',0,1,'C');
	$this->SetFont('Arial','',8);
	/*
	$this->SetY(15);
	$this->SetX(13);
	$this->Cell(20,5,'DATOS DEL PRODUCTO',0,1,'C');
	
	$this->SetY(20);
	$this->SetX(7);
	$this->Cell(20,5,'CODIGO',1,1,'C');	
	$this->SetY(25);
	$this->SetX(7);
	$this->Cell(20,5,$uno,1,1,'C');	
	
	$this->SetY(20);
	$this->SetX(27);
	$this->Cell(55,5,'DESCRIPCION',1,1,'C');
	$this->SetY(25);
	$this->SetX(27);
	$this->Cell(55,5,$dos,1,1,'C');	
	
	$this->SetY(20);
	$this->SetX(82);
	$this->Cell(30,5,'CANTIDAD TOTAL',1,1,'C');
	$this->SetY(25);
	$this->SetX(82);
	$this->Cell(30,5,$tres,1,1,'C');	
	
	$this->SetY(20);
	$this->SetX(112);
	$this->Cell(35,5,'CANTIDAD RESTANTE',1,1,'C');
	$this->SetY(25);
	$this->SetX(112);
	$this->Cell(35,5,$cuatro,1,1,'C');	
		
	$this->SetY(20);
	$this->SetX(147);
	$this->Cell(20,5,'PRECIO',1,1,'C');
	$this->SetY(25);
	$this->SetX(147);
	$this->Cell(20,5,$cinco,1,1,'C');	
		
	$this->SetY(30);
	$this->SetX(7);
	$this->Cell(0,6,'DATOS DE SOLICITUDES POR DEPARTAMENTO DEL PRODUCTO',0,1,'L');*/
	///N
	$this->SetY(25);
	$this->SetX(7);
	$this->Cell(10,5,'N',1,1,'C');	
	
	$this->SetY(25);
	$this->SetX(17);
	$this->Cell(18,5,'N CHEQUE',1,1,'C');	

	$this->SetY(25);
	$this->SetX(35);
	$this->Cell(62,5,'EMPRESA',1,1,'C');	

	$this->SetY(25);
	$this->SetX(97);
	$this->Cell(30,5,'BANCO',1,1,'C');		
		///ef
	$this->SetY(25);
	$this->SetX(127);
	$this->Cell(25,5,'MONTO',1,1,'C');

	$this->SetY(25);
	$this->SetX(152);
	$this->Cell(20,5,'FECHA',1,1,'C');
	
	$this->SetY(25);
	$this->SetX(172);
	$this->Cell(30,5,'SUCURSAL',1,1,'C');
			///fecha nacimiento

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
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$cheques=new class_cheque();

//echo "val   ".$validar;
$pdf=new PDF_MC_Table('P','mm','A4');
$pdf->SetWidths(array(10,18,62,30,25,20,30));
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);	
$pdf->Header1();
$arreglo=array("empresa"=>"$_GET[descripcion_final]","banco"=>"$_GET[banco]","monto_final"=>"$_GET[monto_concatenada]","fecha_desde"=>"$_GET[fecha_concatenada]");
$arr_cheques=$cheques->get_cheque($_GET['codigo_cheque'],$_GET['descripcion_final'],0,$_GET['id_sucursal'],$_GET['banco'],$_GET['monto_concatenada'],$_GET['fecha_concatenada'],$_GET['fecha_nomina_concatenada'],$_GET['acc']);
$i=0;
if ($arr_cheques[0]['id']!=0){
while ($i<sizeof($arr_cheques)){
	if (is_numeric($arr_cheques[$i]['id_empresa']))
		$nom_empresa=$cheques->consulta_General_Matriz('select descripcion from empresa where id='.$arr_cheques[$i]['id_empresa']);
	else 
		$nom_empresa[0]['descripcion']=strtoupper($arr_cheques[$i]['id_empresa']);
	if ($arr_cheques[$i]['id_revisado']!=0)
		$nom_sucursal=$cheques->consulta_General_Matriz('select descripcion from sucursal where id='.$arr_cheques[$i]['id_revisado']);
	else
		$nom_sucursal[0]['descripcion']='Vacio';
		$desc_anulado="";
	if ($arr_cheques[$i]['status']==1)
		$desc_anulado=" (ANULADO)";
	$pdf->Row(array(($i+1),$arr_cheques[$i]['num_cheque'],$nom_empresa[0]['descripcion'].$desc_anulado,$arr_cheques[$i]['banco'],$arr_cheques[$i]['monto'],$arr_cheques[$i]['fecha'],strtoupper($nom_sucursal[0]['descripcion'])),1);
	$i++;
}
}else{
$pdf->SetY(70);
$pdf->SetTextColor(255,0,0);

	$pdf->SetX(20);
	$pdf->SetFontSize(23); 
	$pdf->write(5,"            N O   H A Y   R E G I S T R O S      ");
	}

$pdf->Output();
?>
