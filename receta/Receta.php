<?php 
	Class Receta 
	{
		private $recid;
		private $recnom;
		private $recIng;

		//constructor
		public function __construc(){}
		/**
		* Funcion para printar
		*/
		public function __toString()
		{
			return 'id:'.$this->recid . '<br/>nombre:'. $this->recnom;
		}
		/**
		* Funcion para poner nombre a la receta
		*/
		public function setRecNom($param)
		{
			$this->recnom = $param;
		}
		public function setIDReceta($param)
		{
			$this->recid = $param;
		}
		/**
		* Funcion que devuelve el nombre
		* @return nombre de la recea
		*/
		public function getRecNom()
		{
			return $this->recnom;
		}
		/**
		* Funcion que devuelve el ID de la receta
		*/
		public function getRecID()
		{
			return $this->recid;
		}
	}
 ?>