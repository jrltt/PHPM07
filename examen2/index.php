<?php
	session_start();
	/**
	*	Autor: Joaquín Reyes Lettieri
	*	Contacto: hola@jrltt.net
	*	Fecha: 06.03.14
	*	Version: v1.0
	*/

	require_once('View.php');

	$visual = new View();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
</head>
<body>
	<?php $visual->index(); ?>
</body>
</html>