<?php 
	require_once('Vistas.php');
	require_once('BaseDatos.php');
	require_once('CrearPDF.php');
	require_once('ListaLibro.php');
 	require_once('Libro.php');
 	require_once('Autor.php');

	$visual = new Vistas();

	if (isset($_GET['menu'])){
		switch ($_GET['menu']) {

			case 'crear':
				//me conecto a la BBDD
				BaseDatos::conectar();
				$test = new BDConsulta();
				$array = $test->consultar();
				BaseDatos::desconectar();
				//genero el pdf con el array que devuelve la consulta
				//instancio un objeto y con la funcion crear le paso el array de Libros
				$pdf = new CrearPDF();
				$pdf->crear($array);
				
				break;
			
			default:
				# code...
				break;
		}
	} else {
		$visual->showIndex();
	}
	
 ?>