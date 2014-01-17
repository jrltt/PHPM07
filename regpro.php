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
<?php require_once('insert.php') ?>
<?php require_once('menu.php'); ?>

<?
	/*
	* Funcion que muestra el formulario
	*/
	function form ($erNomPro, $erFechas, $erPres) 
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
				<spam class="status"><?php echo $erFechas; ?></spam>
			</label>
			<label for="fin">Fecha fin
				<input type="date" name="fin" id="fin">
				<spam class="status"><?php echo $erFechas; ?></spam>
			</label>
			<label for="pres">Presupuesto
				<input type="number" name="pres">
				<span class="status"><?php echo $erPres; ?></span>
			</label>
			<input type="submit" value="Crear">
		</form>
		<?php menu(); ?>
	</body>
	</html>
<?php
	} // final funcion form

	/*
	* Funcion que recibe la fecha del input:date y la transforma para insertarla en la BBDD
	* @return: la fecha en formato d/m/Y
	*/
	function pasarFecha($param)
	{
		date_default_timezone_set('Europe/Madrid');
		$fechaIn = strtotime($param);
		$ahora = time();
		$tmpFecha = explode('-', $param, 3);
		$fechaOrd = "$tmpData[2]-$tmpData[1]-$tmpData[0]";
		return $fechaOrd;
	}

	/*
	* Funcion sacada de php.net para validar fechas
	*/
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
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

		/* Comprobar el nombre */
		// $regExpNom = '/^[0-9]{3,10}/';
		// if (preg_match($regExpNom, $_POST['f_in'])) {
		// 	$_SESSION['f_in'] = $_POST['f_in'];
		// } else {
		// 	$erFecha = 'Ha habido un error. Min.3/Máx.10';
		// }

		/* comprobar que las fechas sean numero y que la f_fi no sea menor que f_in */
		 $erFechas = 'mal';

		/* comprobar que el presupuesto sean números */
		$regExpNum = '/^[0-9]{6}$/';
		if ( preg_match($regExpNum, $_GET['pres'])) {
			$_SESSION['pres'] = $_GET['pres'];
		} else {
			$erPres = 'El presupuesto solo puede tener números. Max.6 digitos';
		}

		/* Si ha habido algun error */
		if ($erNomPro || $erPres) {
			form($erNomPro, $erFechas, $erPres);
		} else {
			success('proyecto');
		}
	} else {
		form($erNomPro, $erFechas, $erPres);
	}
 ?>
