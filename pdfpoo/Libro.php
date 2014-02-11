<?php 
	class Libro 
	{
		private $autnom;
		private $libtitulo;
		private $libnumpag;

		/* Constructor vacio, sin nada implementado */
		public function __construc() {}

		/**
		* Metodo toString
		*/
		public function __toString() 
		{
			return $this->autnom.' - '.$this->libtitulo;
		}
		/**
		* Funcion que devuelve el nombre del Autor
		*/
		public function getNom()
		{
			return $this->autnom;
		}

		public function getTitulo()
		{
			return $this->libtitulo;
		}
		public function getNumPag()
		{
			return $this->libnumpag;
		}
	}

	class BaseDatos
	{
		//conecto
		protected static $conexion;

		public static function conectar()
		{
			if ( self::$conexion == null ) {
				try {
					self::$conexion = new PDO ("mysql:host=localhost;dbname=test", "root", "1234");
				} catch (PDOException $e) {
					echo 'Error en la conexion: '. $e->getMessage();
				}
			}
		}

		public static function desconectar()
		{
			self::$conexion = null;
		}

	}

	class BDConsulta extends BaseDatos
	{
		//atributo a devolver
		private $arrayLibros;

		public function consultar()
		{
			try {
				//el nombre de las columnas deben ser iguales que los nombres de los atributos de la clase
				$resultado = parent::$conexion->query("SELECT autnom,libtitulo,libnumpag FROM test.autor JOIN test.libro ON autor.autid=libro.autlid");
				//genero el mapeo
				$resultado->setFetchMode(PDO::FETCH_CLASS,'Libro');
				$i = 0;
				while ( $libro = $resultado->fetch() ) {
					$arrayLibros[$i++] = $libro;
				}
			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
			return $arrayLibros;
		}
	}
 ?>