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
	} else {
		form($tipoForm);
		menu();
	}
 ?>
