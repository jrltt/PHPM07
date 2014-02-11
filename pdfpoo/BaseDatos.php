<?php 
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
		private $consulta; //array de autores que se devolvera al usar la funcion mostrarAutores

		public function consultar()
		{
			try {
				//el nombre de las columnas deben ser iguales que los nombres de los atributos de la clase
				$resultado = parent::$conexion->query("SELECT autnom,libtitulo,libnumpag FROM test.autor JOIN test.libro ON autor.autid=libro.autlid");
				//genero el mapeo
				$resultado->setFetchMode(PDO::FETCH_CLASS,'Libro');
				$i = 0;
				while ( $libro = $resultado->fetch() ) {
					$consulta[$i++] = $libro;
				}
			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
			return $consulta;
		}

		/*
		* Metodo para mostrar los autores
		* @return array de autores
		*/
		public function mostrarAutores()
		{
			try {
				$query = parent::$conexion->query("SELECT * FROM test.autor");
				$query->setFetchMode(PDO::FETCH_CLASS,'Autor');
				$i = 0;
				while ( $autor = $query->fetch() ) {
					$consulta[$i++] = $autor;
				}
			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
			return $consulta;
		}
	}

	require_once ('Autor.php');
	require_once ('Libro.php');

	class BDInsertar extends BaseDatos
	{
		/**
		* Metodo para insertar el autor en la BBDD
		*/
		public function insertAutor($paramAutor)
		{
			try {

				$stmt = parent::$conexion->prepare("INSERT INTO test.autor(autnom) VALUES (:autnom)");
				$stmt->bindParam(':autnom', $paramAutor->getAutNom());
				$stmt->execute();

			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
		}
		/**
		* Metodo para insertar el libros en la BBDD
		*/
		public function insertLibro($paramLibro)
		{
			try {

				$stmt = parent::$conexion->prepare("INSERT INTO test.libro(libtitulo,libnumpag,autlid) VALUES (:libtitulo, :libnumpag, :autlid)");
				$stmt->bindParam( ':libtitulo', $paramLibro->getTitulo() );
				$stmt->bindParam( ':libnumpag', $paramLibro->getNumPag() );
				$stmt->bindParam( ':autlid', $paramLibro->getAutID() );
				$stmt->execute();

			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
		}
	}
?>