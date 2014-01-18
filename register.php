<?php 
	/*
	* Pagina para registrar personas con un formulario
	* que comprueba que todo este correcto. Si esta bien envia
	* a la página success.php, en caso contrario vuelve a printar
	* el formulario, mostrando donde esta el error
	*/
 ?>
<?php session_start(); ?>
<?php //require_once('insert.php'); ?>
<?php require_once('funciones.php'); ?>
<?php
	//envio por GET que formulario usar
	$tipoForm = $_GET['usa'];
	/* ArrayAsociativo con los mensajes de error */
	$errores = array (
			'dni' => 'Ha habido un error. Solo funciona con DNI',
			'name' => 'Ha habido un error en el nombre, solo permite letras. Min.3/Max.10',
		);
	/* Comprobación de los datos introducidos */
	
	if (isset($_POST['dni'])) {
		/* Comprobar el DNI 
		* sacado de: http://computersandprogrammers.blogspot.com.es/2012/12/expresion-regular-reconocer-dni.html
		* mirar la buena: http://nideaderedes.urlansoft.com/2011/10/21/funcion-en-php-para-calcular-si-un-dni-o-un-nie-son-validos/
		*/
		$regExpDni = '/^([0-9]{8})([-]?)([a-zA-Z])$/'; //cambiar por una que compruebe real 
		if (preg_match($regExpDni, $_POST['dni'])) {
			$_SESSION['dni'] = $_POST['dni'];
		} else {
			$_SESSION['error']['dni'] = $errores['dni']; ;
		}

		/* Comprobar el nombre */
		$regExpNom = '/^[a-zA-Z]{3,10}/';
		if (preg_match($regExpNom, $_POST['name'])) {
			$_SESSION['name'] = $_POST['name'];
		} else {
			$_SESSION['error']['name'] = $errores['name']; ;
		}

		/* Si ha habido algun error */
		if (is_null($_SESSION['error']['dni']) || is_null($_SESSION['error']['name']) ) {
			form($tipoForm);
			menu();
		} else {
			success('regPersona');
		}
	} else if (isset($_GET['nomPro'])) {
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
			form($tipoForm);
;
		} else {
			success('regProyecto');
		}
	}else {
		form($tipoForm);
		menu();
	}
 ?>
