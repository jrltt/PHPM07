<?php 
	/*
	* Pagina que muestra el msj de creación correcta
	* y lo inserta en la BBDD
	*/
?>
<?php //session_start(); ?>
<?php require_once('menu.php'); ?>
<?php 
	/*
	* Funcion que recibe los datos por variable de session y por $_FILES[] introducidos
	* por el usuario, para registrarlo en la BBDD
	*/
	function success($paramTipo)
	{
		//conexion con la bbdd
		$link = mysqli_connect("localhost", "root", "1234") or die ('No se puede conectar con mysql'.mysqli_error($link));
		$log .= '<br/>Conectado con la BBDD';
		//seleccion de la tabla
		mysqli_select_db($link, "reyes") or die ('No se puede conectar con la tabla persona');
		$log .= '<br/>Tabla seleccionada';
		if ( $paramTipo == 'persona' ) {
			$log .= '<br/>Formulario procedente de registro persona';
			//guardo en variables la info a almacenar en la bbdd
			$dni = $_SESSION['dni'];
			$log .= 'dni: '.$dni;
			$name = $_SESSION['name'];
			$log .= '<br/>name: '.$name;
			$img = $_FILES['img']['tmp_name'];
			$log .= '<br/>file: '.$img;

			if ( $img != "none" ) {
				$file = @imagecreatefromjpeg($img);
				ob_start();
				imagejpeg($file);
				$jpg = ob_get_contents();
				ob_end_clean();
				$jpg = str_replace('##', '##', mysqli_real_escape_string($link, $jpg));
				$sentencia = "INSERT INTO reyes.persona(dni,nombre,foto) VALUES ('$dni', '$name', '$jpg')";
				mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '. mysqli_error($link));
				if ( mysqli_affected_rows($link) > 0 ) {
					$log .= '<br/>Datos e imagen guardados en la BBDD correctamente';
				} else {
					$log .= '<br/>Ha habido un error al guardar la imagen en la BBDD';
				}
			} else { //este else en que momento funciona?
				//$sentencia = "INSERT INTO gestiproj.persona(dni,nombre) VALUES ('$dni', '$name')";
				//mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '. mysqli_error($link));
				$log .= '<br/>Error al subir el archivo al servidor';
			}
		} else if ($paramTipo == 'proyecto' ) {
			//$log .= 'Formulario procedente de proyecto';
			$nomPro = $_SESSION['nomPro'];
			//$log .= 'nompro: '. $nomPro;
			$fechaIn = $_SESSION['ini'];
			$fechaOut = $_SESSION['fin'];

			$pres = $_SESSION['pres'];
			$sentencia = "INSERT INTO reyes.proyecto(nombre,di,df,presu) VALUES ('$nomPro','$fechaIn', '$fechaOut', '$pres');";
			mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '. mysqli_error($link));
			if ( mysqli_affected_rows($link) > 0 ) {
				$log .= '<br/>Datos guardados en la BBDD correctamente';
			} else {
				$log .= '<br/>Ha habido un error al guardar el proyecto en la BBDD';
			}
		}
		//finalizo la sessión
		session_destroy();
		//cierro la conexión con la bbdd
		mysqli_close($link);
		$log .= '<br/>Conexión cerrada';
		//con la funcion thatsAll imprimo el msj de OK y muestro un Log con info adicional
		thatsAll($paramTipo, $log);
	}
		
	/*
	* Funcion que crea un html donde muestra un msj de OK y los datos del log
	* $paramForm: tipo de formulario de registro, persona o proyecto
	* $paramLog: log con la información de lo que ha hecho
	*/
	function thatsAll($paramForm, $paramLog) 
	{
?>
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>That's all folks!</title>
	</head>
	<body>
		<div class="head">
			<h1>Datos introducidos correctamente</h1>
			<h3>Formulario utilizado <?php echo $paramForm; ?></h3>
			<p>Log con información del proceso: <br/><span class="log"><?php echo $paramLog; ?></p>
		</div>
		<div class="menu">
			<ul>
				<li>Volver al indice</li>
				<li>Ver listado general</li>
			</ul>
		</div>
		<?php menu(); ?>
	</body>
	</html>
<?php
	}
 ?>