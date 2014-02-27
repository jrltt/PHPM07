<?php 
	require_once('bd.php');
	require_once('Receta.php');
	require_once('Ingrediente.php');
	
	Class View
	{
		public function __construct(){}
		/**
		* Funcion que muestra el Menu principal
		*/
		public function showIndex()
		{
			?>
					<ul class="menu">
						<li><a href="formRec.php">Añadir receta</a></li>
						<li><a href="formIng.php">Añadir ingredientes a receta</a></li>
						<li><a href="main.php?menu=pdf">Crear PDF con lista de recetas e ingredientes</a></li>
						<li><a href="main.php?menu=grafo">Ver gráfico de números de recete¡as por inrgediente</a></li>
						<li><a href="main.php?menu=listgraf">graficos</a></li>
						<li><a href="main.php">Inicio</a></li>
					</ul>
				
			<?php
		}
		/**
		* Funcion que muestra el formulario para insertar Receta
		*/
		public function formRec()
		{
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Formulario de añadir receta</title>
				<link rel="stylesheet" href="style.css">
			</head>
			<body>
			<div class="wrap">
				<h1>Crear receta</h1>
				<div class="menu">
					<?php $this->showIndex(); ?>
				</div>
				<form action="formRec.php" method="get">
					<label for="nomrec">Nombre de la receta:</label>
					<input type="text" name="nomrec">
					<input type="submit" value="Añadir">
				</form>
			</div>
			</body>
			</html>
			<?php
		}
		public function formIng()
		{
			BD::conectar();
			$consulta = new BDConsulta();
			$recetas = $consulta->conReceta();
			$ingredientes = $consulta->conIngredientes();
			BD::desconectar();
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Añadir ingredientes a una receta</title>
				<link rel="stylesheet" href="style.css">
			</head>
			<body>
			<div class="wrap">
				<h1>Añadir ingrediente a una receta</h1>
				<div class="menu">
					<?php $this->showIndex(); ?>
				</div>
				<form action="formIng.php" method="get">
					<label for="receta">Receta:</label>
					<select name="receta" id="receta">
						<?php 
							foreach ($recetas as $receta) {
								echo '<option value="'.$receta->getRecID().'">'.$receta->getRecNom().'</option>';
							}
						 ?>
					</select>
					<label for="ingrediente">Ingrediente:</label>
					<select name="ingrediente" id="ingrediente">
						<?php 
							foreach ($ingredientes as $ingre) {
								echo '<option value="'.$ingre->getIngID().'">'.$ingre->getIngNom().' '.$ingre->getUnidad().'</option>';
							}
						 ?>
					</select>
					<input type="submit" value="Añadir">
				</form>
				</div>
			</body>
			</html>
			<?php
		}

	}
 ?>