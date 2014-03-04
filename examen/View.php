<?php 
	require_once('BD.php');
	require_once('Visitant.php');
	Class View 
	{
		public function showIndex() 
		{
			?>
			<ul>
				<li><a href="visalta.php">Dar de alta a un visitante</a></li>
				<li><a href="visllistat.php">Ver lista  de visitantes por empresa</a></li>
				<li><a href="vispdf.php">Lista en formato</a></li>
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
				<?php $this->showIndex(); ?>
			</body>
			</html>
			<?php
		}
		public function formVis()
		{
			BD::conectar();
			$consulta = new BDConsulta();
			$empresa = $consulta->conEmpresas();
			BD::desconectar();
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Formulario de añadir visitante</title>
				<link rel="stylesheet" href="style.css">
			</head>
			<body>
			<div class="wrap">
				<h1>Dar de alta visitante</h1>
				<div class="menu">
					<?php $this->showIndex(); ?>
				</div>
				<form action="visalta.php" method="get">
					<label for="visnom">Nombre visitantes:</label>
					<input type="text" name="visnom">
					<?php echo '<span class="error">'.$_SESSION['error'].'</span>'; ?>
					<label for="visdatan">Fecha:</label>
					<input type="date" name="visdatan">
					<label for="visdia">Dias:</label>
					<input type="checkbox" name="visdia[]" value="visdia1">Dia 1
					<input type="checkbox" name="visdia[]" value="visdia2">Dia 2
					<input type="checkbox" name="visdia[]" value="visdia3">Dia 3
					<input type="checkbox" name="visdia[]" value="visdia4">Dia 4
					<label for="empid">Empresa</label>
					<select name="empid" id="empid">
						<?php 
							foreach ($empresa as $emp) {
								echo '<option value="'.$emp->getEmpID().'">'.$emp->getNomEmp().'</option>';
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
		public function listVis()
		{
			BD::conectar();
			$consulta = new BDConsulta();
			$array = $consulta->conVis();
			BD::desconectar();
			// echo'hola';
			// print_r($array);
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Lista de visitantes por empresa</title>
			</head>
			<body>
				<h1>Lista de visitantes por empresa</h1>
				<?php foreach ($array as $v) {
					$visi[$v->getEmp()] = array( [$v->getNom()] => array($v->getDia1(),$v->getDia2(),$v->getDia3(),$v->getDia4()));
				} 
				print_r(array_keys($visi));
				print_r(array_values($visi));
				?>
			</body>
			</html>
			<?php
		}
	}
 ?>