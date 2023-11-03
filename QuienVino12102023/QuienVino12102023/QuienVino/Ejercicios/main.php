<?php
require("./QuienVino12102023/QuienVino/Clases/Persona.php");
require("./QuienVino12102023/QuienVino/Clases/Alumno.php");
$alumno1 = new Alumno("Santiago","Martinez","45387761","2023-11-28");
//echo($alumno1->calcularSituacion(40,10,10));
$funcion = Alumno::calcularSituacion(40,10,10);
echo ($funcion);

?>