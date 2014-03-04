<?php 
	require('fpdf.php');
	require_once('Visitant.php');
	require_once('Empresa.php');

	class VisPDF extends FPDF
	{
		function Header ()
		{
			$this->SetFont('Times','B',15);
			// Título
			$this->Cell(190,10,'Mobile World Congress 2014 - joaquin reyes lettieri',1,0,'L');
			// Salto de línea
			$this->Ln(15);
			$this->SetFont('Times','IU',13);
			$this->Cell(40,10,'Nombre',0,0,'L');
			$this->Cell(40,10, 'Edad',0,0,'L');
			$this->Cell(40,10, 'Empresa',0,0,'L');
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

		public function makePDF($paramTabla)
		{
			$pdf = new CrearPDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			foreach ($paramReceta as $receta) {
				$pdf->Cell(40,10,$receta->getRecNom(),0,0,'L');
				$pdf->Cell(60,10,$receta->getRecIng().' '.$receta->getUnidad(),0,0,'L');
				//$pdf->Cell(10,10,,0,0,'L');
				$pdf->Cell(10,10, '',0,1,'R');
			}
			$pdf->Output();
		}
	}
 ?>