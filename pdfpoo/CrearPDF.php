<?php 
require('fpdf.php');

class CrearPDF extends FPDF
{
	function Header ()
	{
		$this->SetFont('Arial','B',15);
		//$this->Cell(80);
		// Título
		$this->Cell(190,10,'Listado de libros',1,0,'L');
		// Salto de línea
		$this->Ln(15);
		$this->SetFont('Arial','IU',13);
		$this->Cell(30,10,'Autor',0,0,'L');
		$this->Cell(60,10, 'Titulo del libro',0,0,'L');
		$this->Cell(10,10, 'Num.pag',0,0,'L');
		$this->Ln(10);
	}
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
 ?>
