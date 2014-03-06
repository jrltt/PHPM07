<?php 
	/**
	*	Autor: Joaquín Reyes Lettieri
	*	Contacto: hola@jrltt.net
	*	Fecha: 06.03.14
	*	Version: v1.0
	*/
	require_once('BD.php');
	require_once('.php');

	Class View 
	{
		public function index() 
		{
			?>
			<ul>
				<li><a href=".php"><a></li>
				<li><a href=".php"></a></li>
				<li><a href="vispdf.php"></a></li>
				<li><a href=""></a></li>
				<li><a href=""></a></li>
				<li><a href="index.php">Inicio</a></li>
			</ul>
			<?php
		}
		public function theEnd() {
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>ok</title>
			</head>
			<body>
				<h1>Insertado correctamente</h1>
				<?php $this->index(); ?>
			</body>
			</html>
			<?php
		}
		public function form()
		{
			
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title></title>
				<link rel="stylesheet" href="style.css">
			</head>
			<body>
			<div class="wrap">
				<h1></h1>
				<div class="menu">
					<?php $this->index(); ?>
				</div>
				<form action="visalta.php" method="get">
					<label for=""></label>
					<input type="text">
					<input type="submit" value="Añadir">
				</form>
			</div>
			</body>
			</html>
			<?php
		}
		
	}
 ?>