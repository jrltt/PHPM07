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

	$grafico = new Graph();
	BD::conectar();
	$bd = new BDConsulta();
	$ingredientes = $bd->conRecNum();
	BD::desconectar();
	$img = $_GET['img'];
	if( $img == 'pie') {
		$grafico->crearPie($ingredientes);
	} else if ( $img == 'normal') {
		$grafico->crearGraph($ingredientes);
	} else if ( $img == 'otro') {
		$grafico->crearGrafico($ingredientes);
	}
?>