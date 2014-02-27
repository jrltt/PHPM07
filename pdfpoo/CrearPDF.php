<?php 
require('fpdf.php');
require_once('ListaLibro.php');

class CrearPDF extends FPDF
{

	function Header ()
	{
		$this->SetFont('Times','B',15);
		//$this->Cell(80);
		// Título
		$this->Cell(190,10,'Listado de libros',1,0,'L');
		// Salto de línea
		$this->Ln(15);
		$this->SetFont('Times','IU',13);
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
		$this->SetFont('Times','I',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	/**
	* Funcion para crear un pdf
	* @paramArray array de la clase Libro
	*/
	public function crear($paramArray)
	{
		$pdf = new CrearPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		foreach ($paramArray as $value) {
			//$nom = $value->getNom()
			$pdf->Cell(30,10,$value->getNom(),0,0,'L');
			$pdf->Cell(60,10,$value->getTitulo(),0,0,'L');
			$pdf->Cell(10,10,$value->getNumPag(),0,0,'L');
			$pdf->Cell(10,10, '',0,1,'R');
		}
		$pdf->Output();
	}
}
 ?>
