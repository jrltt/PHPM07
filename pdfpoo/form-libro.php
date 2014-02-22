<?php 
	require_once('Vistas.php');
	require_once('BaseDatos.php');
 	require_once('Autor.php');
 	require_once('Libro.php');

 	$visual = new Vistas();

 	if(isset($_POST['autor'])) {
 		$libro = new Libro();
 		$libro->setLibTit( $_POST['nomLibro'] );
 		$libro->setLibNumPag( $_POST['numPag'] );
 		$libro->setAutID( $_POST['autor'] );
 		
 		BaseDatos::conectar();
		$insert = new BDInsertar();
		$insert->insertLibro($libro);
		BaseDatos::desconectar();

		$visual->msjFinal();

 	} else {
 		$visual->formLibro();
 	}

 ?>