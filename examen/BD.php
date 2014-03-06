<?php 
	require_once('Visitant.php');
	Class BD
	{
		
		protected static $conexion;

		public static function conectar()
		{
			if ( self::$conexion == null ) {
				try {
					self::$conexion = new PDO ("mysql:host=localhost;dbname=mwc14a", "root", "1234");
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
	class BDInsertar extends BD
	{
		/**
		* Metodo para insertar el autor en la BBDD
		*/
		public function insertarVisitante($paramVis)
		{
			try {
				$visnom = $paramVis->getNom();
				$visdatan = $paramVis->getData();
				$visdia1 = $paramVis->getDia1();
				$visdia2 =$paramVis->getDia2();
				$visdia3 =$paramVis->getDia3();
				$visdia4 =$paramVis->getDia4();
				$empid = $paramVis->getEmp();
				$stmt = parent::$conexion->exec(
					"INSERT INTO visitant(visnom,visdatan,visdia1,visdia2,visdia3,visdia4,empid) 
					VALUES ('$visnom','$visdatan','$visdia1','$visdia2','$visdia3','$visdia4','$empid')");

			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
		}	
	}
	class BDConsulta extends BD
	{
		//atributo a devolver
		private $consulta; 

		public function conEmpresas()
		{
			try {
				$resultado = parent::$conexion->query("SELECT empid,empnom FROM empresa");
				$resultado->setFetchMode(PDO::FETCH_CLASS,'Empresa');
				$i = 0;
				while ( $empresa = $resultado->fetch() ) {
					$consulta[$i++] = $empresa;
				}
			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
			return $consulta;
		}

		public function conVis() {
			try {
				$resultado = parent::$conexion->query(
					// "SELECT visnom,visdia1,visdia2,visdia3,visdia4,empid, empnom 
					// FROM visitant, empresa"
				"SELECT visnom,visdia1,visdia2,visdia3,visdia4,visitant.empid, empnom 
				FROM visitant, empresa 
				WHERE visitant.empid = empresa.empid
				ORDER BY empnom");
				$resultado->setFetchMode(PDO::FETCH_CLASS,'Visitant');
				$i = 0;
				while ( $vis = $resultado->fetch() ) {
					$consulta[$i++] = $vis;
				}
			} catch (PDOException $e) {
				echo 'Error en el query: '. $e->getMessage();
			}
			return $consulta;
		}
	
	}
 ?>