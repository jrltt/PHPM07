<?php 
	/*
	* Falta crear el constructor de persona
	* y crear otro archivo php que se llame main.php y en este creamos la persona
	* y le damos diferentes valores y lo mostramos por pantalla
	*/

	class Persona {
		private $nombre;
		private $genero;
		private $fnacimiento;

		public function getNombre() 
		{
			return $this->nombre;
		}

		public function setNombre($param)
		{
			$this->nombre = $param;
		}

		public function getGenero()
		{
			return $this->genero;
		}

		public function setGenero($param)
		{
			$this->genero = $param;
		}

		public function getFNacimiento() 
		{
			return $this->fnacimiento;
		}

		public function setFNacimiento($param)
		{
			$this->fnacimiento = $param;
		}

		public function getEdad() {
			$now = Date('Y');
			return $now - $this->fnacimiento;
		}
	}

	$Pedro = new Persona();
	$Pedro->setNombre('Pedro Guiut');
	echo $Pedro->getNombre();
	$Pedro->setFNacimiento('1986');
	echo $Pedro->getEdad();
 ?>