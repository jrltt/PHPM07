<?php 
	require_once('persona.php');
	require_once('GUIpersona.php');
	require_once('base.php');
	
	//forma de llamar a una funcion 
	Base::conectar();
	//creo una persona
	$per1 = new Persona("Albert","algo","19860406");
	//instancio la interfaz grafica
	$visual = new GUIpersona($per1);
	//la muestro
	$visual->show();
	//instancio un elemento de BBDD y le paso la persona
	$toSave = new BDSave($per1);
	//utilizo la funcion para guardar
	$toSave->guardar();
	$array = BDConsultar::mostrar();
	foreach ($array as $key) {
		echo $key.'<br/>';
	}
	Base::desconectar();
	
 ?>