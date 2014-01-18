<?php 
	/*
	* Funcion que recibe las personas a añadir a un proyecto y lo actualiza
	* en la BBDD
	*
	* Autor: Joaquín Reyes Lettieri
	*/
 ?>
 <?php require_once('menu.php'); ?>
 <?php 
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
 	menu();
 ?>
