<?php 
	require_once('persona.php');

	class Base
	{
		//statico, por muchas conexiones que hagamos, siempre sera la misma
		protected static $conexion;
		
		/*
		* metodo para conectar a la BBDD
		* @return la conexion con el la bbdd
		*/
		public static function conectar()
		{
			if ( self::$conexion == null ) { //corta la conexion
				try 
				{
					self::$conexion = new PDO("mysql:host=localhost;dbname=test", "root", "1234");
				}
				catch (PDOException $e)
				{
					echo $e->getMessage();
				}
			}

		}
		/*
		* Pone la conexion a null
		*/
		public static function desconectar() 
		{
			self::$conexion = null;
		}
	}

	class BDSave extends Base 
	{
		//atribuo de la clase persona para guardar en la BBDD
		private $perSave;

		/*
		* Constructor por defecto de BDSave
		* @param recibe la persona a guardar
		*/
		public function __construct($param)
		{
			$this->perSave = $param;
		}
		/*
		* Funcion que se conecta con la BBDD y guarda la persona*/
		public function guardar() 
		{
			try {
				$nomSave = $this->perSave->getNombre();
				$fnSave = $this->perSave->getFNacimiento();
				$genSave = $this->perSave->getGenero();
				// llamo a la funcion conectar de la clase Base
				parent::conectar();
				parent::$conexion->exec("INSERT INTO test.persona(nombre,fn,genero) VALUES ('$nomSave','$fnSave','$genSave')");
			} catch (PDOException $e) {
				echo 'Error: '.$e->getMessage();
			}
		}
	}

	/*
	*	Clase que devuelve la consulta en un array de personas
	*/
	class BDConsultar extends Base 
	{
		private $perArray;

		public function mostrar()
		{
			$sql = "SELECT * FROM test.persona";
			$count = 0;
			try {
				parent::conectar();
				foreach (parent::$conexion->query($sql) as $persona ) {
					$perArray[$count++] = 'ID:'.$persona['id'].' - Nombre:'.$persona['nombre'];
				}

			} catch (PDOException $e) {
				echo 'Error: '. $e->getMessage();
			}
			return $perArray;
		}
	}
 ?>