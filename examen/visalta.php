<?php 
	require_once('View.php');
	require_once('Empresa.php');
	require_once('Visitant.php');
	require_once('BD.php');

	$visual = new View();
	if( isset($_GET['visnom']) ) {
		$regExpNom = '/^[a-zA-Z]{2,}/';
		if ( preg_match($regExpNom, $_GET['visnom'])) {
			$array = $_GET['visdia'];
			$i = 0;
			$arrayDias = array (0,0,0,0) ;
			foreach ($array as $dia) {
				if ($dia == 'visdia1' || $dia == 'visdia2' || $dia == 'visdia3' || $dia == 'visdia4' ) {
					$arrayDias[$i] = 1;
				}
				$i++;
			}
			print_r($arrayDias);
			$visitante = new Visitant();
			$visitante->setVisNom($_GET['visnom']);
			$visitante->setVisData($_GET['visdatan']);
			$visitante->setDia1($arrayDias[0]);
			$visitante->setDia2($arrayDias[1]);
			$visitante->setDia3($arrayDias[2]);
			$visitante->setDia4($arrayDias[3]);
			$visitante->setEmp($_GET['empid']);
			BD::conectar();
			$insert = new BDInsertar();
			$insert->insertarVisitante($visitante);
			BD::desconectar();
			$visual->theEnd();
		} else {	
			$_SESSION['error'] = 'Ha habido un error en el nombre';
			$visual->formVis();
		}
	} else {
		$visual->formVis();
	}
 ?>