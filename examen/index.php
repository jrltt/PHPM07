<?php
	session_start();
 	
 	/**
	* name: Joaquín Reyes Lettieri
	* contact: hola@jrltt.net
	* date: 27.02.14
	* versión: v1.0
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
	<?php $visual->showIndex(); ?>
</body>
</html>