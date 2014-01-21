<?php 
	/*
	* Pagina para registrar personas con un formulario
	* que comprueba que todo este correcto. Si esta bien envia
	* a la página success.php, en caso contrario vuelve a printar
	* el formulario, mostrando donde esta el error
	*/
 ?>
<?php session_start(); ?>
<?php require_once('success.php') ?>
<?
	/*
	* Funcion que muestra el formulario
	* $paramTipo: tipo de formulario a mostrar.
	*/
	function form ($paramTipo) 
	{
?>
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Formulario de registro de Personas</title>
		<style>
			label {
				display: block;
				margin-right: 20px;
			}
			.status {
				font-style: italic;
				color: red;
			}
		</style>
	</head>
	<body>
		<h1>Formulario de registro de personas</h1>
		<form action="register.php" method="POST" enctype="multipart/form-data" id="reg">
			<label for="dni">DNI
				<input type="text" name="dni">
				<span class="status"><?php echo $_SESSION['erDni']; ?></span>
			</label>
			<label for="name">Nombre
				<input type="text" name="name">
				<span class="status"><?php echo $_SESSION['erNom']; ?></span>
			</label>
			<label for="img">Avatar
				<input type="file" name="img">
			</label>
			<input type="submit" value="Crear">
		</form>
		<form action='register.php?=<?php echo $paramTipo; ?>'></form>
	</body>
	</html>
<?php
	} // final funcion form
?>
<?php 
	//recogo el tipo de formulario que se solicita, solo puede llegar por un GET
	$tipo = $_GET['tipo'];

	/* Comprobación de los datos introducidos */
	if ( isset($_POST['dni']) || isset($_POST['nomPro']) ) {
		if ( $tipo == 'persona') {
			/* Comprobar el DNI 
			* sacado de: http://computersandprogrammers.blogspot.com.es/2012/12/expresion-regular-reconocer-dni.html
			*/
			$regExpDni = '/^([0-9]{8})([-]?)([a-zA-Z])$/';
			if (preg_match($regExpDni, $_POST['dni'])) {
				$_SESSION['dni'] = $_POST['dni'];
			} else {
				$_SESSION['erDni'] = 'Ha habido un error. Solo funciona con DNI';
			}

			/* Comprobar el nombre */
			$regExpNom = '/^[a-zA-Z]{3,10}/';
			if (preg_match($regExpNom, $_POST['name'])) {
				$_SESSION['name'] = $_POST['name'];
			} else {
				$$_SESSION['erNom'] = 'Ha habido un error. Min.3/Máx.10';
			}

			/* Si ha habido algun error */
			if (isset($_SESSION['erDni']) || isset($_SESSION['erNom'])) {
				form($tipo);
			} else { 
				success($tipo);
			}
		} else {
			success($tipo);
		}
	} else {
		form($tipo);
	}
 ?>
