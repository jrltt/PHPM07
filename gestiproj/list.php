<?php 
	/*
	* Pagina que muestra lista: 
	* - personas para añadir a un proyecto 
	* - ? proyecto concreto y sus integrantes
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
	<div class="wrap">
		<?php 
			/* Conexion con la BBDD */
			$link = mysqli_connect("localhost", "root", "1234") or die ('No se puede conectar con mysql'.mysqli_error($link));
			mysqli_select_db($link, "reyes") or die ('No se puede seleccionar la tabla reyes');
			/* para proyectos */
			$sentPro = "SELECT * FROM proyecto";
			$queryPro = mysqli_query($link, $sentPro) or die ('Error en '.$sentPro.' - '.mysqli_error($link));
			/* para personas sin proyecto asignado */
			$sentPerNoPro = "SELECT * FROM persona WHERE nomProjec IS NULL";
			//$sentPerNoPro = "SELECT * FROM persona";
			$queryPerNoPro = mysqli_query($link, $sentPerNoPro) or die ('Error en '.$sentPerNoPro.' - '. mysqli_error($link));
			/* para personas con proyecto asignado */
			$sentPerPro = "SELECT * FROM persona WHERE nomProjec IS NOT NULL";
			$queryPerPro = mysqli_query($link, $sentPerPro) or die ('Error en '.$sentPerPro.' - '. mysqli_error($link));

			// se repite codigo, buscar la forma de optimizar esto ...
		?>
		<form action="add.php" method="get" name="lista" id="lista">
			<label for="proyectos">Seleccionar un proyecto:</label>
			<select name="proyectos" id="proyectos">
			<?php while ( $fila = mysqli_fetch_array($queryPro, MYSQL_ASSOC)) { ?>
				<option value='<?php echo $fila['nombre']; ?>' name='proyectos'><?php echo $fila['nombre']." - ".$fila['di']."/".$fila['df']." - ".$fila['presu']."$"; ?></option>
			<?php } ?>
			</select>
			<label for="perSin">Personas sin proyecto asignado:</label>
			<?php while ( $fila = mysqli_fetch_array($queryPerNoPro, MYSQL_ASSOC)) { ?>		
				<ul>
				 	<li><input type='checkbox' name='per[]' id='perCheckbox' value='<?php echo $fila['dni']; ?>'></li>
				 	<li><img src="srcImg.php?dni=<?php echo $fila['dni'];?>" width=50 height=50 alt="<?php echo $fila['nombre'];?>"/></li>
		 			<li>DNI: <?php echo $fila['dni'];?></li>
				 	<li>Nombre: <?php echo $fila['nombre'];?></li>
				</ul>

			<?php } ?>

			<div class="clear"></div> 
		 	<label for="perCon">Actualizar personas con proyecto:</label>
			
			<?php while ( $fila = mysqli_fetch_array($queryPerPro, MYSQL_ASSOC)) { ?>
				<ul>
					<li><input type='checkbox' name='per[]' id='perCheckbox' value='<?php echo $fila['dni']; ?>'></li>
				 	<li><img src="srcImg.php?dni=<?php echo $fila['dni'];?>" width=50 height=50 alt="<?php echo $fila['nombre'];?>"/></li>
		 			<li>DNI: <?php echo $fila['dni'];?></li>
				 	<li>Nombre: <?php echo $fila['nombre'];?></li>
					<li>Proyecto: <?php echo $fila['nomProjec']; ?></li>
				</ul>

			<?php  } ?>	
			<input type="submit" value="Actualizar">
			<input type="hidden" name="tipo" value="add">
		</form>
		<?php mysqli_close($link); ?>
		<?php menu(); ?>
	</div>
</body>
</html>