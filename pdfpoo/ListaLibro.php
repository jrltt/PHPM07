<?php 
	class ListaLibro 
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
 ?>