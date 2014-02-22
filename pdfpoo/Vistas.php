<?php 
	require_once('ListaLibro.php');
	class Vistas
	{	
		//Constructor vacio
		public function __construct() {}

		public function showIndex()
		{
		?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Indice Libreria</title>
			</head>
			<body>
				<ul>
					<li><a href="form-autor.php">Añadir autor</a></li>
					<li><a href="form-libro.php">Añadir libro</a></li>
					<li><a href="index.php?menu=crear">Mostrar listado en PDF</a></li>
					<li><a href="borrarLibro.php">Elimnar libro</a></li>
				</ul>
			</body>
			</html>
		<?php
		}

		/**
		* Funcion que muestra el formulario para
		* añadir Autor
		*/
		public function formAutor()
		{
		?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Formulario de Autor</title>
			</head>
			<body>
				<form action="form-autor.php" method="POST">
					<label for="nomAutor">Nombre del Autor:</label>
					<input type="text" name="nomAutor">
					<input type="submit" value="Añadir">
				</form>
			</body>
			</html>
		<?php	
		}

		public function formLibro()
		{
				BaseDatos::conectar();
				$consulta = new BDConsulta();
				$arrayAutores = $consulta->mostrarAutores();
				BaseDatos::desconectar();
		?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Formulario de Libro</title>
			</head>
			<body>
				<form action="form-libro.php" method="POST">
					<label for="nomLibro">Nombre del Libro:</label>
					<input type="text" name="nomLibro">
					<label for="numPag">Número de páginas:</label>
					<input type="text" name="numPag">
					<select name="autor" id="autor">
						<?php  
							foreach ($arrayAutores as $autor ) {
								echo '<option value="'.$autor->getAutID().'">'.$autor->getAutNom().'</option>';
							}
						?>
					</select>
					<input type="submit" value="Añadir">
				</form>
			</body>
			</html>
		<?php
		}

		public function borrarLibro() 
		{
			BaseDatos::conectar();
			$consulta = new BDConsulta();
			$arrayLibros = $consulta->consultar();
			BaseDatos::desconectar();
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Borrar libro</title>
			</head>
			<body>
				<form action="borrarLibro.php" method="GET">
					<select name="libro" id="libro">
						<option value="0"></option>
						<?php 
							foreach ($arrayLibros as $libro) {
								echo '<option value="'.$libro->getLibID() .'">'.$libro->getNom().' - '.$libro->getTitulo().'</option>';
							}
						 ?>
					</select>
					<input type="submit" value="Eliminar">
				</form>
			</body>
			</html>
			<?php
		}
		public function msjFinal()
		{
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Mensaje final</title>
			</head>
			<body>
				<h1>Se ha realizado correctamanete!</h1>	
			</body>
			</html>
			<?php
		}
	}
 ?>