<?php 
	require_once('persona.php');
	require_once('GUIpersona.php');
	require_once('BBDDpers.php');
	
	//creo una persona
	$per1 = new Persona("Aroon","curioso","19860406");
	//instancio la interfaz grafica
	$visual = new GUIpersona($per1);
	//la muestro
	$visual->show();
	//instancio un elemento de BBDD y le paso la persona
	$toSave = new BBDDpers($per1);
	//utilizo la funcion para guardar
	$toSave->guardar();
	//creo otra
	$per2 = new Persona('Maooooo','femenino','19900619');
	//asigno la nueva persona
	$visual->setPersona($per2);
	//la vuelvo a mostrar
	$visual->show();
	//lo vuelvo a instanciar para guardar el segundo
	$toSave = new BBDDpers($per2);
	$toSave->guardar();
 ?>