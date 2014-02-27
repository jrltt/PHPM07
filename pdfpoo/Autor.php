<?php 
	class Autor
	{
		private $autid;
		private $autnom;

		public function __construct() {}

		/**
		* Metodo toString para poder utilizar echo con los objetos Autor
		*/
		public function __toString() 
		{
			return $this->autid.' - '.$this->autnom;
		}
		/**
		* Funcion que devuelve el ID del Autor
		*/
		public function getAutID(){
			return $this->autid;
		}
		/**
		* Funcion que devuelve el nombre del autor
		*/
		public function getAutNom(){
			return $this->autnom;
		}
		/**
		* Poner nombre al Autor
		*/
		public function setNom($param)
		{
			$this->autnom = $param;
		}
	}
 ?>