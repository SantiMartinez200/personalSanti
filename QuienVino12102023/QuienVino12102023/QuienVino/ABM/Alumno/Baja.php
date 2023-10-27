<?php
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
$DB = new Conexion;
$id = $_GET["dni"];
echo ($id);
$sql = Alumno::deleteAlumno($id);
$ejecutar = $DB->ejecutar($sql);
if ($ejecutar) {
  $DB->killConn();
  header("Location: ../Alumno/ABM_Alumno.php");
}

?>