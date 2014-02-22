<?php 
	require_once('Vistas.php');
	require_once('BaseDatos.php');
	//require_once('BDBorrar.php');
	require_once('ListaLibro.php');
	$visual = new Vistas();
	if ( isset($_GET['libro']) ) {
		if ( $_GET['libro'] != 0) {
			$libro = new ListaLibro();
			$libro->setLibID($_GET['libro']);
			BaseDatos::conectar();
			$borrar = new BDBorrar();
			$borrar->borrarLibro($libro);
			BaseDatos::desconectar();
			$visual->msjFinal();
		} else {
			echo '<h1>Ha habido un error al borrar, vuelve a intentarlo</h1>';
			echo '<a href="borrarLibro.php">Volver a BorrarLibro</a>';
		}
	} else {
		$visual->borrarLibro();
	}
 ?>