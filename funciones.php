<?php 
	/*
	* Archivo que contiene todas las funciones del proyecto
	* Autor: Joaquín Reyes Lettieri
	* Version: 1.0
	* Fecha: 18.01.14
	*/
 ?>
<?php 
	/*
	* Muestra el menu principal
	*/
	function menu()
	{
?>
	<div class="menu">
		<h3>Menu</h3>
		<ul>
			<li><a href="index.php">Index</a></li>
			<li><a href="register.php">Registrar persona</a></li>
			<li><a href="regpro.php">Registrar proyecto</a></li>
			<li><a href="list.php">Añadir personas a proyectos</a></li>
			<li><a href="listpro.php">Gestionar proyectos</a></li>
		</ul>
	</div>
<?php
	}
?>

<?php
	
	/*
	* Funcion sacada de php.net para validar fechas
	* Devuelve true o false, segun como se inserte
	*/
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}


	/*
	* Funcion que añade cambios a la BBDD segun el tipo de formulario que recibe
	* la la funcion, puede ser tipo add: asigna proyecto a unos dni seleccionados
	* por el usuario o bien puede ser tipo remove: actualiza la BBDD y quita del 
	* proyecto a las personas seleccionadas.
	* La funcion hace una pequeña comprobación en el tipo:add para chekear que el proyecto
	* que se quiere añadir esta en la BBDD. No tengo claro que haga falta o no
	*/
	function add() 
	{
		if (isset($_GET['tipo'])) {
	 		$tipo = $_GET['tipo'];
	 		
	 		//conecto con la bbdd
	 		$link = mysqli_connect("localhost", "root", "1234") or die ('No se puede conectar con la BBDD '.mysqli_error($link));
			mysqli_select_db($link, "reyes") or die ('No se puede conectar con la tabla reyes');

	 		if ($tipo == 'add') { //formulario tipo:add, añadir personas a proyecto
				//compruebo que proyectos sea alguno de los que esta en la BBDD
				$proyecto = $_GET['proyectos'];
			 	$sentPro = "SELECT nombre FROM proyecto";
			 	$queryCheckPro = mysqli_query ($link, $sentPro) or die ('Error en '.$sentPro.' - '.mysqli_error($link)); 
			 	// no tengo claro si hace falta una comprobación porque salta un error de mysql, que el proyecto con nombre XXX no esta en la BBDD
			 	while ( $fila = mysqli_fetch_array($queryCheckPro, MYSQL_ASSOC)) {
			 		//compruebo si el proyecto esta en el array $fila
			 		if ( in_array($proyecto, $fila) ) $msjPro = 'ok';
			 		else $msjPro = 'nope';
			 	}
			 	echo $msjPro;

			 	//en el caso de los DNI no haria falta comprobarlos, porque si no se encuentra el dni no hace nada
			 	$dniSel = $_GET['per'];
				foreach ($dniSel as $dni) {
					//insert into persona(nomProj) values ($proyecto) where dni=$elementoArrayBucle;
					//$sentencia = "INSERT INTO persona(nomProjec) VALUES ('$proyecto') WHERE dni='$dni' ";
					$sentencia = "UPDATE persona SET nomProjec='$proyecto' WHERE dni='$dni'";
					$resultado = mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '.mysqli_error($link));
					echo '<br/>La persona con dni:'.$dni.' se ha ACTUALIZADO su informaci&oacute;n :: proyecto: '.$proyecto;
				 } //fin bucle
				 mysqli_close($link);
			} else if ( $tipo == 'remove') {
				$sentPer = "SELECT * FROM persona";
				$queryPer = mysqli_query($link, $sentPer) or die ('Error en '.$sentPer.' - '.mysqli_erro($link));
				//recogo las personas que se le tienen que quitar el proyecto
				$dniSel = $_GET['quitar'];
				foreach ($dniSel as $dni) {
					$sentencia = "UPDATE persona SET nomProjec=NULL WHERE dni='$dni'";
					$resultado = mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '.mysqli_error($link));
					echo '<br/> La persona con el dni '.$dni.' ya no tiene proyecto asignado';
				}
			}
	 	}
	}


	/*
	* Funcion que recibe los datos por variable de session y por $_FILES[] introducidos
	* por el usuario, para registrarlo en la BBDD
	*/
	function success($paramTipo)
	{
		//conexion con la bbdd
		$link = mysqli_connect("localhost", "root", "1234") or die ('No se puede conectar con mysql'.mysqli_error($link));
		//seleccion de la tabla
		mysqli_select_db($link, "reyes") or die ('No se puede conectar con la tabla persona');
		if ( $paramTipo == 'regPersona' ) {
			//guardo en variables la info a almacenar en la bbdd
			$dni = $_SESSION['dni'];
			$name = $_SESSION['name'];
			$img = $_FILES['img']['tmp_name'];

			if ( $img != "none" ) {
				$file = @imagecreatefromjpeg($img);
				ob_start();
				imagejpeg($file);
				$jpg = ob_get_contents();
				ob_end_clean();
				$jpg = str_replace('##', '##', mysqli_real_escape_string($link, $jpg));
				$sentencia = "INSERT INTO reyes.persona(dni,nombre,foto) VALUES ('$dni', '$name', '$jpg')";
				mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '. mysqli_error($link));
			} 
		} else if ($paramTipo == 'regProyecto' ) {
			$nomPro = $_SESSION['nomPro'];
			$fechaIn = $_SESSION['ini'];
			$fechaOut = $_SESSION['fin'];

			$pres = $_SESSION['pres'];
			$sentencia = "INSERT INTO reyes.proyecto(nombre,di,df,presu) VALUES ('$nomPro','$fechaIn', '$fechaOut', '$pres');";
			mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '. mysqli_error($link));
			
		}
		//finalizo la sessión
		session_destroy();
		//cierro la conexión con la bbdd
		mysqli_close($link);
		//con la funcion thatsAll imprimo el msj de OK y muestro un Log con info adicional
		thatsAll($paramTipo);
	}
?>

<?php	
	/*
	* Funcion que crea un html donde muestra un msj de OK 
	*/
	function thatsAll($paramForm) 
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
		</div>
	<?php menu(); ?>
	</body>
	</html>
<?php
	}
 ?>