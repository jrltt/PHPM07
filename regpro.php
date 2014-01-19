<?php 
	/*
	* Pagina para registrar proyectos a travez de un formulario
	* que comprueba que todo sea correcto. Si esta bien envia
	* a la página success.php, en caso contrario vuelve a printar
	* el formulario, indicando el error.
	*
	* Autor: Joaquín Reyes Lettieri
	* Version: 1.0
	* Fecha: 15.01.14
	*/
 ?>
<?php session_start(); ?>
<?php //require_once('insert.php') ?>
<?php require_once('funciones.php'); ?>

<?
	/*
	* Funcion que muestra el formulario
	*/
	function formPro ($erNomPro, $erFechaOrden, $erPres) 
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
		<h1>Formulario de registro de proyectos</h1>
		<form action="regpro.php" method="GET" id="reg">
			<label for="nomPro">Nombre del proyecto
				<input type="text" name="nomPro">
				<span class="status"><?php echo $erNomPro; ?></span>
			</label>
			<label for="ini">Fecha inicio
				<input type="date" name="ini" id="ini">
				<spam class="status"><?php //echo $erFechaFormat; ?></spam>
			</label>
			<label for="fin">Fecha fin
				<input type="date" name="fin" id="fin">
				<spam class="status"><?php echo $erFechaOrden; ?></spam>
			</label>
			<label for="pres">Presupuesto
				<input type="number" name="pres">
				<span class="status"><?php echo $erPres; ?></span>
			</label>
			<input type="submit" value="Crear">
			<input type="hidden" name="tipo" value="regProyecto">
		</form>
		<?php menu(); ?>
	</body>
	</html>
<?php
	} // final funcion form
?>
<?php 
	/* Comprobación de los datos introducidos */
	if (isset($_GET['nomPro'])) {
		/* 
		* Comprobar el nombre del proyecto, permite letras y numeros.
		* Min.2/Max.10
		*/
		$regExpDni = '/^[a-zA-Z0-9]{2,10}$/';
		if (preg_match($regExpDni, $_GET['nomPro'])) {
			$_SESSION['nomPro'] = $_GET['nomPro'];
		} else {
			$erNomPro = 'Min.2/Max.10 - Permite letras y números';
		}

		/* primero compruebo que las fechas esten bien introducidas y si estan bien escritas las compara entre ellas */
		// if ( validateDate($_GET['ini'], 'd-m-Y ') || validateDate($_GET['ini'], 'Y-m-d') ) {
		// 	$erFechaFormat= 'Formato erroneo. Permitido d-m-Y o Y-m-d';
		// } 
		// if ( validateDate($_GET['fin'], 'd-m-Y') || validateDate($_GET['fin'], 'Y-m-d') ) {
		// 	$erFechaFormat= 'Formato erroneo. Permitido d-m-Y o Y-m-d';
		// }
		// Algo estoy haciendo mal que no consigo comprobar que escriba bien la fecha desde firefox


		$feIn = new DateTime ($_GET['ini']);
		$feFi = new DateTime ($_GET['fin']);
		if ( $feIn > $feFi) {
			$erFechaOrden = 'La fecha de fin no puede ser anterior a la fecha de Inicio';
		} else {
			$_SESSION['ini'] = $_GET['ini'];
			$_SESSION['fin'] = $_GET['fin'];
		}

		/* comprobar que el presupuesto sean números */
		$regExpNum = '/^[0-9]{3,6}/';
		if ( preg_match($regExpNum, $_GET['pres'])) {
			$_SESSION['pres'] = $_GET['pres'];
		} else {
			$erPres = 'El presupuesto solo puede tener números. Max.6 digitos';
		}


		/* Si ha habido algun error */
		if ($erNomPro || $erFechaOrden || $erPres) {
			//echo 'si hay error: '.$_GET['ini'];
			formPro($erNomPro, $erFechaOrden, $erPres);
		} else {
			success('regProyecto');
		}
	} else {
		formPro($erNomPro, $erFechaOrden, $erPres);
	}
 ?>
