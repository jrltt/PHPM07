<?php 
	Class BD
	{
		//conecto
		protected static $conexion;

		public static function conectar()
		{
			if ( self::$conexion == null ) {
				try {
					self::$conexion = new PDO ("mysql:host=localhost;dbname=reyes", "root", "1234");
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

	class BDConsulta extends BD
	{
		//atributo a devolver
		private $consulta; //array de autores que se devolvera al usar la funcion mostrarAutores

		public function conReceta()
		{
			try {
				//el nombre de las columnas deben ser iguales que los nombres de los atributos de la clase
				//$resultado = parent::$conexion->query("SELECT autnom,libid,libtitulo,libnumpag FROM test.autor JOIN test.libro ON autor.autid=libro.autlid");
				$resultado = parent::$conexion->query("SELECT recid,recnom FROM receta");
				//genero el mapeo
				$resultado->setFetchMode(PDO::FETCH_CLASS,'Receta');
				$i = 0;
				while ( $receta = $resultado->fetch() ) {
					$consulta[$i++] = $receta;
				}
			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
			return $consulta;
		}
		public function conRecetaCompleta()
		{
			try {
				//SELECT recnom, count(*) as numIngre FROM rexin JOIN receta ON receta.recid=rexin.recid group by recnom
				//$resultado = parent::$conexion->prepare("SELECT recnom, count(ingnom), unidad FROM receta JOIN rexin ON receta.recid=rexin.recid JOIN ingrediente ON ingrediente.ingid = rexin.ingid JOIN unidad ON ingrediente.unidad = unidad.tipo");
			}
		}

		public function conIngredientes()
		{
			try{
				$resultado = parent::$conexion->query("SELECT ingid,ingnom,unidad FROM ingrediente JOIN unidad ON ingrediente.unidad = unidad.tipo");
				$resultado->setFetchMode(PDO::FETCH_CLASS,'Ingrediente');
				$i = 0;
				while ( $ingre = $resultado->fetch() ) {
					$consulta[$i++] = $ingre;
				}

			} catch (PDOException $e) {
				echo 'error en el query de ingredientes: '.$e->getMessage();
			}

			return $consulta;
		}
	}

	require_once ('Receta.php');
	require_once('Ingrediente.php');

	class BDInsertar extends BD
	{
		/**
		* Metodo para insertar el autor en la BBDD
		*/
		public function insertReceta($paramReceta)
		{
			try {
				$nomRec = $paramReceta->getRecNom();
				$stmt = parent::$conexion->exec("INSERT INTO receta(recnom) VALUES ('$nomRec')");

			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
		}
		public function inIngreOnRece($paramRece,$paramIngre)
		{
			try {
				$idRec = $paramRece->getRecID();
				$idIngre = $paramIngre->getIngID();
				$insert = parent::$conexion->exec("INSERT INTO rexin(recid,ingid) VALUES ('$idRec','$idIngre')");
			} catch (PDOException $e) {
				echo 'error al insertar ingrediente x receta:'.$e->getMessage();
			}
		}
		
	}
 ?>