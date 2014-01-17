<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Indice</title>
</head>
<body>
	<?php $hola = 'proyecto'; ?>
	<form action="add.php?tipo=proyecto" method="GET">
		<input type="submit" value="enviar">
	</form>
	<ul>
		<li><a href="add.php?tipo=proyecto">Proyecto</a></li>
		<li><a href="add.php?tipo=persona">Persona</a></li>
		<li><a href="<?php echo "add.php?tipo=$hola"; ?>">hola</a></li>
		<li><a href=""></a></li>
	</ul>
	<?php 
	echo 'Test array asociativos<br/>';
	$errores = array (
			'dni' => 'soy el error de DNI',
			'nombre' => 'Soy el error de nombre',
			'file' => 'soy el error de archivo'
		);
	?>
	<h1>error de dni: <?php echo $errores => dni; ?></h1>
	<?php foreach ($errores as $error) {
		//echo $msj.'<br/>';
		echo '<br/>'.$error;
	} ?>
</body>
</html>