<?php 
	Class Empresa 
	{
		private $empid;
		private $empnom;

		
		public function getEmpID() 
		{
			return $this->empid;
		}

		public function getNomEmp() 
		{
			return $this->empnom;
		}
		public function __toString() 
		{
			return $this->empnom;
		}
	} ?>