<?php 
	Class Ingrediente
	{
		private $ingid;
		private $ingnom;
		private $unidad;
		private $numrec;

		public function __construc(){}

		public function __toString()
		{
			return 'id:'.$this->ingid.'<br/>nombre ingrediente:'.$this->ingnom . ' '.$this->unidad;
		}

		public function setIngNom($param)
		{
			$this->ingnom = $param;
		}
		public function setIDIngrediente($param)
		{
			$this->ingid = $param;
		}
		public function getIngNom()
		{
			return $this->ingnom;
		}
		public function getUnidad()
		{
			return $this->unidad;
		}
		public function getIngID()
		{
			return $this->ingid;
		}
		/**
		* Funcion que devuelve el numero de recetas
		* donde se utiliza un ingrediente
		*/
		public function getNumRec()
		{
			return $this->numrec;
		}
	}
 ?>