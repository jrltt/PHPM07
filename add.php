<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Añadir personas a un proyecto</title>
</head>
<body>
	<?php 
		$tmp = $_GET['tipo'];
		if ( $tmp == 'persona') {
			echo '<h1>PERSONA</h1>';
		} else if ($tmp == 'proyecto'){
			echo '<h1>PROYECTO!</h1>';
		} else {
			echo '<h1>otro</h1>';
		}
	?>
</body>
</html>