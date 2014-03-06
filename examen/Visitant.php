<?php 
	Class Visitant
	{
		private $visid;
		private $visnom;
		private $visdatan;
		private $visfoto;
		private $visdia1;
		private $visdia2;
		private $visdia3;
		private $visdia4;
		private $empid;
		private $empnom;

		public function __construc(){}
		
		public function setVisNom($param) {
			$this->visnom = $param;
		}
		public function setVisData($param) {
			$this->visdatan = $param;
		}
		public function setDia1($param) {
			$this->visdia1 = $param;
		}
		public function setDia2($param) {
			$this->visdia2 = $param;
		}
		public function setDia3($param) {
			$this->visdia3 = $param;
		}
		public function setDia4($param) {
			$this->visdia4 = $param;
		}
		public function setEmp($param) {
			$this->empid = $param;
		}

		public function getNom() 
		{
			return $this->visnom;
		}
		public function getData() 
		{
			return $this->visdatan;
		}
		public function getDia1() 
		{
			return $this->visdia1;
		}
		public function getDia2() 
		{
			return $this->visdia2;
		}
		public function getDia3() 
		{
			return $this->visdia3;
		}
		public function getDia4() 
		{
			return $this->visdia4;
		}
		public function getEmp() 
		{
			return $this->empid;
		}
		public function getEmpNom()
		{
			return $this->empnom;
		}
	} 
?>