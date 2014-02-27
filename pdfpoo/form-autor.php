<?php 
	require_once('Vistas.php');
	require_once('BaseDatos.php');
	require_once('CrearPDF.php');
 	require_once('Libro.php');
 	require_once('Autor.php');

 	$visual = new Vistas();

 	if ( isset($_POST['nomAutor']) ) {
		//instancio un nuevo autor
		$autor = new Autor();
		$autor->setNom($_POST['nomAutor']);
		BaseDatos::conectar();
		$insert = new BDInsertar();
		$insert->insertAutor($autor);
		BaseDatos::desconectar();
		$visual->msjFinal();
	} else {
		$visual->formAutor();
	}
 ?>