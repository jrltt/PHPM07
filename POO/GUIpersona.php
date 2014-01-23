<?php 
	require_once('persona.php');

	class GUIpersona 
	{

		private $persona;

		public function __construct($p) 
		{
			$this->persona = $p;
		}

		public function show()
		{
?>
		<!doctype html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Document</title>
		</head>
		<body>
			<?php  
				$nameShow = $this->persona->getNombre();
				$genShow = $this->persona->getGenero();
				$edadShow = $this->persona->getEdad();
 			?>
 			<?php echo "Nombre: $nameShow - Genero: $genShow - Edad: $edadShow <br/>";?>
		</body>
		</html>
<?php	}

		public function setPersona($param)
		{
			$this->persona = $param;
		}

	}
 ?>