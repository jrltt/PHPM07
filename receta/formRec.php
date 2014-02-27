<?php 
	require_once('View.php');
	require_once('Receta.php');
	require_once('bd.php');

	$visual = new View();

	if( isset($_GET['nomrec']) ) {
		$receta = new Receta();
		$receta->setRecNom($_GET['nomrec']);
		BD::conectar();
		$insert = new BDInsertar();
		$insert->insertReceta($receta);
		BD::desconectar();
		echo '<h1>'.$_GET['nomrec'].' insertado correctamente</h1>';
	} else {
		$visual->formRec();
	}
 ?>