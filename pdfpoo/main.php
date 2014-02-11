<?php 
	require_once('Libro.php');
	require_once('BaseDatos.php');
	require_once('CrearPDF.php');
	require_once('Autor.php');
?>

<?php
	$tmpNombre = "Marcos Romaura";
	$autor = new Autor();
	$autor->setNom($tmpNombre);
	
	BaseDatos::conectar();

	$insert = new BDInsertar();
	$insert->insertAutor($autor);

	$test = new BDConsulta();
	$array = $test->consultar();
	//recogo los autores
	$arrayAutores = $test->mostrarAutores();

	BaseDatos::desconectar();

	foreach($arrayAutores as $autorBD) {
		echo $autorBD.'<br/>';
	}
	$id = $arrayAutores[2]->getAutID();
	echo $id;

	//Para crear un PDF desde PHP
	// $pdf = new CrearPDF();
	// $pdf->AliasNbPages();
	// $pdf->AddPage();
	// $pdf->SetFont('Times','',12);
	// foreach ($array as $value) {
	// 	//$nom = $value->getNom()
	// 	$pdf->Cell(30,10,$value->getNom(),0,0,'L');
	// 	$pdf->Cell(60,10,$value->getTitulo(),0,0,'L');
	// 	$pdf->Cell(10,10,$value->getNumPag(),0,0,'L');
	// 	$pdf->Cell(10,10, '',0,1,'R');
	// }
	// $pdf->Output();


 ?>