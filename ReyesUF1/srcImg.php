<?php
    $dni = $_GET['dni'];
    $link = mysqli_connect("localhost","root","") or die ("No conecto");
    mysqli_select_db($link, "reyes") or die ("No se puede seleccionar la tabla reyes");
    $sentencia = "SELECT foto FROM persona WHERE dni='$dni'";
    $res =mysqli_query($link, $sentencia) or die('Error en:'.$sentencia.'::'. mysqli_error($link));;
    $registro = mysqli_fetch_array($res, MYSQL_ASSOC);
    header("Content-Type: image/jpeg");
    echo $registro['foto'];
?>
