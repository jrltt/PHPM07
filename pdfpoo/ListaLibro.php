<?php 
	/**
	* Clase que se utiliza para mostrar la lista
	* de libros en el PDF
	*/
	class ListaLibro 
	{
		private $libid;
		private $libtitulo;
		private $libnumpag;
		private $autnom;

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
		* funcion que devuelve el ID del libro
		*/
		public function getLibID()
		{
			return $this->libid;
		}
		public function setLibID($param)
		{
			$this->libid = $param;
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