<?php 
	require_once('View.php');
	require_once('bd.php');
	require_once('CrearPDF.php');
	require("pChart2.1.4/class/pData.class.php");
	require("pChart2.1.4/class/pDraw.class.php");
	require("pChart2.1.4/class/pImage.class.php");
	include("pChart2.1.4/class/pPie.class.php");

	require_once('Grafico.php');
	require_once('Receta.php');


	$visual = new View();
	if ( isset($_GET['menu']) ) {
		
		if( $_GET['menu'] == 'pdf' ) {
			BD::conectar();
			$bd = new BDConsulta();
			$recetas = $bd->conRecetaCompleta();
			BD::desconectar();
			$pdf = new CrearPDF();
			$pdf->makePDF($recetas);
		} else if ( $_GET['menu'] == 'grafo' ) {
			BD::conectar();
			$bd = new BDConsulta();
			$ingredientes = $bd->conRecNum();
			BD::desconectar();
			$grafico = new Graph();
			$grafico->crearGraph($ingredientes);
			//$grafico->crearPie($ingredientes);
			//$grafico->crearGrafico($ingredientes);
		}
		else if ( $_GET['menu'] == 'listgraf' ) {

			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>imagenes</title>
			</head>
			<body>
				<h1>hola</h1>
				<img src="imgGra.php?img=pie" alt="">
				<h1>img 2</h1>
				<img src="imgGra.php?img=normal" alt="">
				<h3>
					img 4
				</h3>
				<img src="imgGra.php?img=otro" alt="">

			</body>
			</html>
			<?php
		}
	} else {
		?>
		<!doctype html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Indice</title>
			<link rel="stylesheet" href="style.css">
		</head>
		<body>
			<div class="wrap">
				<h1>Recetas</h1>
					<?php $visual->showIndex(); ?>
			</div>
		</body>
		</html>
		<?php
	}
 ?>