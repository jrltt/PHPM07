<?php 
	/*
	* Pagina que recibe las personas a añadir a un proyecto y las inserta
	* en la BBDD
	*
	* Autor: Joaquín Reyes Lettieri
	*/
 ?>
 <?php 
 	//recibe el proyecto seleccionado en list.php
 	$proyecto = $_GET['proyectos'];
 	//array de personas seleccionadas en el checkbox de list.php
 	$dniSel = $_GET['per'];
 	//conexion con la bbdd
 	$link = mysqli_connect("localhost", "root", "1234") or die ('No se puede conectar con la BBDD '.mysqli_error($link));
 	mysqli_select_db($link, "reyes") or die ('No se puede conectar con la tabla reyes');
 	//bucle dniseleccionados
 	foreach ($dniSel as $dni) {
 		//insert into persona(nomProj) values ($proyecto) where dni=$elementoArrayBucle;
		//$sentencia = "INSERT INTO persona(nomProjec) VALUES ('$proyecto') WHERE dni='$dni' ";
		$sentencia = "UPDATE persona SET nomProjec='$proyecto' WHERE dni='$dni'";
		$resultado = mysqli_query($link, $sentencia) or die ('Error en: '.$sentencia.' - '.mysqli_error($link));
		echo '<br/>La persona con dni:'.$dni.' se ha insertado en el proyecto: '.$proyecto;
 	}
 	//fin bucle
 	mysqli_close($link);
 ?>