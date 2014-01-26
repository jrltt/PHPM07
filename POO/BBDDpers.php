<?php 
	require_once('persona.php');

	class BBDDpers
	{
		//Atributo
		private $perSave;
		
		/*
		* Constructor por defecto
		*/
		public function __construct($param)
		{
			$this->perSave = $param;
		}

		/*
		* Función para guardar la persona en la BBDD
		*/
		public function guardar()
		{
			//Conexion con la BBDD
			$link = mysqli_connect("localhost", "root", "1234") or die ('Error'.mysqli_error($link));
			mysqli_select_db($link, "test") or die ('Error, no se puede conectar');
			//variables a guardar en la bbdd
			$nomSave = $this->perSave->getNombre();
			$fnSave = $this->perSave->getFNacimiento();
			$genSave = $this->perSave->getGenero();
			$sentencia = "INSERT INTO test.persona(nombre,fna,genero) VALUES ('$nomSave','$fnSave','$genSave')";
			mysqli_query($link,$sentencia) or die ('Error en: '.$sentencia.' - '.mysqli_error($link) );
			mysqli_close($link);
		}
	}
 ?>