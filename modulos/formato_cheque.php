<?php
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

function Header1($arreglo){
$num_a_letras=new numerosALetras();
$this->SetLeftMargin(7);
//$consul=new consultas();
/*$sql="select * from plantel";	
$resul=$consul->consulta($sql);
$row=mysql_fetch_array($resul);*/
$monto_mostrar=str_replace(".","",$arreglo["monto_final"]);
list($entero,$decimal)=explode(",",$monto_mostrar);
$entero=rtrim(strtoupper($num_a_letras->convertir($entero)));
$decimal=strtoupper($num_a_letras->convertir('0.'.$decimal));
$decimal=str_replace('CERO ','',$decimal);
$this->Cell(0,10,$arreglo["monto_final"],0,0,'R');
$this->SetY(35);
$this->Cell(0,10,'***'.strtoupper($arreglo["descripcion"]).'***',0,0,'C');
$this->Ln(5);
$this->Cell(0,10,$entero.' '.$decimal,0,0,'C');
$this->Ln(5);
$this->Cell(0,10,'CON 00/100',0,0,'C');
$this->Ln(5);
$this->Cell(0,10,'VALENCIA 20 DE NOVIEMBRE DEL 2011',0,0,'C');
$this->SetY(60);
$this->Cell(0,10,'***NO ENDOSABLE***',0,0,'R');
$this->SetY(70);
$this->Cell(0,10,'COMPROBANTE DE EGRESO',1,0,'C');
$this->SetY(80);
//$this->SetX(5);
$this->Rect(7,80,193,100);
$this->MultiCell(0,100,$arreglo["observaciones"],1,'C',false);
$this->Cell(0,10,'TOTAL A PAGAR   '.$arreglo["monto_final"],1,0,'R');
$this->Ln(10);
$this->Cell(50,15,'CHEQUE NO.  ',1,0,'L');
$this->Cell(50,15,'BANCO   ',1,0,'L');
$this->Rect(107,190,93,25);
//$this->MultiCell(93,20,'FIRMA Y SELLO DEL BENEFICIADO',1,0,'L',false);
$this->Ln(5);
$this->Cell(50,15,strtoupper($arreglo["num_cheque"]),0,0,'L');
$this->Cell(50,15,strtoupper($arreglo["banco"]),0,0,'L');
$this->Text(111,195,'FIRMA Y SELLO DEL BENEFICIARIO');
$this->Text(111,210,'R.I.F.');
$this->Ln(10);
$this->Cell(100,15,'DEBITESE A:   ',1,0,'L');
$this->Rect(107,215,93,20);
$this->Ln(5);
$this->SetX(20);
$this->Cell(100,15,'INVERSIONES NEMARTIZ , C.A',0,0,'L');
$this->Ln(10);
$this->Cell(50,15,'PREPARADO',1,0,'L');
$this->Cell(50,15,'REVISADO',1,0,'L');
$this->Text(145,220,'AUTORIZADO');
$this->Ln(5);
$this->Cell(50,15,'',0,0,'L');
$this->Cell(50,15,strtoupper($arreglo["sucursal"]),0,0,'L');
	//Title
	//$this->Image('images/secretaria.jpg',25,8,40,20);
	//$this->Image('images/sol de proyecto venezuela3.jpg',300,8,40,20);
	/*if ($tipo_repor=="Por Desincorporar" || $tipo_repor=="Desincorporado"){
	
	$titulo="de Items ";
	$titulo.=$tipo_repor;
	//echo "keuwhfiouwehof";
	}*/
	/*$this->SetFillColor(200,200,200);
	$this->SetFont('Arial','',16);
	$this->SetY(2);
	//$this->SetX(20);
	$this->Cell(0,6,'Reporte de Producto',0,1,'C');
	$this->SetFont('Arial','',8);
	
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
	$this->Cell(0,6,'DATOS DE SOLICITUDES POR DEPARTAMENTO DEL PRODUCTO',0,1,'L');
	///N
	$this->SetY(35);
	$this->SetX(7);
	$this->Cell(50,5,'INSTITUCION',1,1,'C');	

	$this->SetY(35);
	$this->SetX(57);
	$this->Cell(70,5,'DEPARTAMENTO',1,1,'C');	

	$this->SetY(35);
	$this->SetX(127);
	$this->Cell(40,5,'CANTIDAD SOLICITADA',1,1,'C');	
		///ef
	$this->SetY(35);
	$this->SetX(167);
	$this->Cell(40,5,'FECHA SOLICITUD',1,1,'C');	//32 SERIAL
	/*$this->SetY(38);
	$this->SetX(89);
	$this->Cell(10,10,'99999999999999999',0,1,'L');*/
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

?>