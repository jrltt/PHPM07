<?php 
	require_once('View.php');
	require_once('Receta.php');
	require_once('Ingrediente.php');
	require_once('bd.php');

	$visual = new View();

	if( isset($_GET['receta']) ) {
		//instancio el objeto receta
		$receta = new Receta();
		//recojo su ID
		$receta->setIDReceta($_GET['receta']);
		//instancio obj ingrediente
		$ingrediente = new Ingrediente();
		//recojo su ID
		$ingrediente->setIDIngrediente($_GET['ingrediente']);
		//conexion BD
		BD::conectar();
		$insert = new BDInsertar();
		//con la funcion ingrediente x receta
		$insert->inIngreOnRece($receta,$ingrediente);
		BD::desconectar();
		//echo $receta.'<br/>'.$ingrediente;
	} else {
		$visual->formIng();
	}
 ?>