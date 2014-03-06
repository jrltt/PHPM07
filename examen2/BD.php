<?php 
	/**
	*	Autor: Joaquín Reyes Lettieri
	*	Contacto: hola@jrltt.net
	*	Fecha: 06.03.14
	*	Version: v1.0
	*/
	require_once('.php');
	
	Class BD
	{
		
		protected static $conexion;

		public static function conectar()
		{
			if ( self::$conexion == null ) {
				try {
					self::$conexion = new PDO ("mysql:host=localhost;dbname=", "root", "1234");
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
	/**
	* Clase para insertar en la BD
	*/
	class BDInsertar extends BD
	{
		public function ins($param)
		{
			try {
				
				$stmt = parent::$conexion->exec(
					"INSERT INTO  
					VALUES ('','')");

			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
		}	
	}
	/**
	* Clase para consultar la BD
	*/
	class BDConsulta extends BD
	{
		//atributo a devolver
		private $consulta; 

		public function con()
		{
			try {
				$resultado = parent::$conexion->query("SELECT , FROM ");
				$resultado->setFetchMode(PDO::FETCH_CLASS,'');
				$i = 0;
				while ( $algo = $resultado->fetch() ) {
					$consulta[$i++] = $algo;
				}
			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
			return $consulta;
		}
	
	}
 ?>