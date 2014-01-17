<?php 
	/*
	* Pagina que muestra lista: 
	* - personas para añadir a un proyecto 
	* - proyecto concreto y sus integrantes
	*/
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Asignar personas a proyectos</title>
	<style>
	label {
		display: block;
	}
		</style>
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

		// se repite codigo, buscar la forma de optimizar esto
	?>
	<form action="listpro.php" method="get" name="lista">
		<table>
			<tr>
				<th>Nombre proyecto</th>
				<th>Integrantes</th>
				<th>Clear</th>
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
							<li><?php echo $filaPersona['dni']; ?></li>
							<li><?php echo $filaPersona['nombre']; ?></li>
							<!-- <li><?php //echo '<img src="srcImg.php?dni='.$filaPersona['dni'].'" width=50 />'; ?></li> -->
							<li><img src="srcImg.php?dni=<?php echo $filaPersona['dni'];?>" width=50 /></li>
						</ul>	
					
				<?php 
					} 
				?>
				</td>
				<td>
					<img src='http://wlrhoa.com/Graphics/trash-icon.gif' width=20/>
				</td>
			</tr>
		<?php } ?>

		</table>
	</form>
	<?php mysqli_close($link); ?>
</body>
</html>