<?php 
	require_once('Libro.php');
	require_once('CrearPDF.php');

	BaseDatos::conectar();

	$test = new BDConsulta();

	$array = $test->consultar();

	BaseDatos::desconectar();

	//print_r($array);
	// foreach ($array as $key => $value) {
	// 	echo $key.' - '.$value.'<br/>';
	// }
	// foreach ($array as $lib => $key) {
	// 	echo 'libro: '.$key.'<br/>';
	// }
	$pdf = new CrearPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	foreach ($array as $value) {
		//$nom = $value->getNom()
		$pdf->Cell(30,10,$value->getNom(),0,0,'L');
		$pdf->Cell(60,10,$value->getTitulo(),0,0,'L');
		$pdf->Cell(10,10,$value->getNumPag(),0,0,'L');
		$pdf->Cell(10,10, '',0,1,'R');
	}
	$pdf->Output();
 ?>