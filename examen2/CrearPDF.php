<?php 

	/**
	*	Autor: Joaquín Reyes Lettieri
	*	Contacto: hola@jrltt.net
	*	Fecha: 06.03.14
	*	Version: v1.0
	*/

	require('fpdf.php');
	require_once('.php');

	/**
	* Clase para crear PDF de Recetas
	*/
	class CrearPDF extends FPDF
	{
		function Header ()
		{
			$this->SetFont('Times','B',15);
			// Título
			$this->Cell(190,10,'Recetas',1,0,'L');
			// Salto de línea
			$this->Ln(15);
			$this->SetFont('Times','IU',13);
			$this->Cell(40,10,'Receta',0,0,'L');
			$this->Cell(60,10, 'Ingredientes',0,0,'L');
			//$this->Cell(10,10, 'Unidad',0,0,'L');
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

		public function makePDF($param)
		{
			$pdf = new CrearPDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			// foreach ($paramReceta as $receta) {
			// 	$pdf->Cell(40,10,$receta->getRecNom(),0,0,'L');
			// 	$pdf->Cell(60,10,$receta->getRecIng().' '.$receta->getUnidad(),0,0,'L');
			// 	//$pdf->Cell(10,10,,0,0,'L');
			// 	$pdf->Cell(10,10, '',0,1,'R');
			// }
			$pdf->Output();
		}
	}
 ?>