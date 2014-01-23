<?php 
	require_once('persona.php');
	require_once('GUIpersona.php');
	require_once('BBDDpers.php');
	
	$per1 = new Persona("Pedro","masculino","1985");
	$visual = new GUIpersona($per1);
	$visual->show();
	$per2 = new Persona('Maria','femenino','1990');
	$visual->setPersona($per2);
	$visual->show();
 ?>