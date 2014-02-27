<?php 
	require_once('persona.php');
	/*
	* Clase grafica de interfaz de usuario de la clase persona
	*/
	class GUIpersona 
	{

		private $persona;

		/*
		* Constructor
		*/
		public function __construct($p) 
		{
			$this->persona = $p;
		}

		/*
		* Funcion para mostrar una persona
		*/
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
		
		/*
		* Funcion para cambiar la persona a mostrar información
		*/
		public function setPersona($param)
		{
			$this->persona = $param;
		}

	}
 ?>