<?php 
	class Libro 
	{
		private $libid;
		private $libtitulo;
		private $libnumpag;
		private $autlid;

		/* Constructor vacio, sin nada implementado */
		public function __construc() {}

		/**
		* Metodo toString
		*/
		public function __toString() 
		{
			return $this->autnom.' - '.$this->libtitulo;
		}
		public function setLibTit($param)
		{
			$this->libtitulo = $param;
		}
		public function setLibNumPag($param)
		{
			$this->libnumpag = $param;
		}
		public function setAutID($param)
		{
			$this->autlid = $param;
		}
		/**
		* Funcion que devuelve el ID del Autor
		*/
		public function getAutID()
		{
			return $this->autlid;
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