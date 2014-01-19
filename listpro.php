<?php 
	/*
	* Pagina que muestra lista: 
	* - personas para añadir a un proyecto 
	* - proyecto concreto y sus integrantes
	*/
?>
<?php require_once('funciones.php'); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Asignar personas a proyectos</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php 
		/* Conexion con la BBDD */
		$link = mysqli_connect("localhost", "root", "1234") or die ('No se puede conectar con mysql'.mysqli_error($link));
		mysqli_select_db($link, "reyes") or die ('No se puede seleccionar la tabla reyes');
		/* para proyectos */
		$sentPro = "SELECT * FROM proyecto";
		$queryPro = mysqli_query($link, $sentPro) or die ('Error en '.$sentPro.' - '.mysqli_error($link));
		/* para personas sin proyecto asignado */
		$sentPerNoPro = "SELECT * FROM persona WHERE nomProjec IS NULL";
		$queryPerNoPro = mysqli_query($link, $sentPerNoPro) or die ('Error en '.$sentPerNoPro.' - '. mysqli_error($link));
		
		/* para personas con proyecto asignado */
		// $sentPerPro = "SELECT * FROM persona WHERE nomProjec IS NOT NULL";
		// $queryPerPro = mysqli_query($link, $sentPerPro) or die ('Error en '.$sentPerPro.' - '. mysqli_error($link));

	?>
	<form action='add.php' method="get" name="lista">
		<table border="1">
			<tr>
				<th>Nombre proyecto</th>
				<th>Integrantes</th>
			</tr>
			<?php while ( $fila = mysqli_fetch_array($queryPro, MYSQL_ASSOC)) { ?>
			<tr>
				<td>
					<h1><?php echo $fila['nombre'];?></h1> 
					<ul>
						<li>Fecha inicio: <?php echo $fila['di']; ?></li>
						<li>Fecha fin: <?php echo $fila['df']; ?></li>
						<li>Presupuesto: <?php echo $fila['presu']; ?>$</li>
					</ul>
				</td>
				<td>
				<?php 
					$nomPro = $fila['nombre'];
					$sentPerPro = "SELECT * FROM persona WHERE nomProjec='$nomPro'";
					$queryPerPro = mysqli_query($link, $sentPerPro) or die ('Error en '.$sentPerPro.' - '. mysqli_error($link));
					while ( $filaPersona = mysqli_fetch_array($queryPerPro, MYSQL_ASSOC)) {
				?>
					
						<ul>
							<li><input type="checkbox" name="quitar[]" id="persona" value='<?php echo $filaPersona['dni'];?>'></li>
							<li><?php echo $filaPersona['dni']; ?></li>
							<li><?php echo $filaPersona['nombre']; ?></li>
							<li><img src="srcImg.php?dni=<?php echo $filaPersona['dni'];?>" width=50 /></li>
						</ul>	
					
				<?php 
					} 
				?>
				</td>

			</tr>
		<?php } ?>
		</table>
		<input type="submit" value="Enviar">
	  	<input type="hidden" name="tipo" value="remove">
	</form>
	<ul>
	<h3>Personas sin proyecto asignado:</h3>
		<?php while ( $fila = mysqli_fetch_array($queryPerNoPro, MYSQL_ASSOC)) { ?>
			<li><?php echo $fila['dni']." - ".$fila['nombre']." - <img src=srcImg.php?dni=".$fila['dni']." width=50 height=50 alt=".$fila['nombre']."/>" ." - Proyecto: ".$fila['nomProjec'] ; ?> </li>
		<?php } ?>
	</ul>
	<?php mysqli_close($link); ?>
	<?php menu(); ?>
</body>
</html>