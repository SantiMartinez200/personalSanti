<?php
include(".././BD/conn.php");
include("../Clases/Asistencia.php");
$DB = new Conexion();
$idEliminar = $_GET["id"];
echo $idEliminar;
$sql = Asistencia::deleteAsistencia($idEliminar);
$ejecutar = $DB->ejecutar($sql);
if ($ejecutar) {
  $DB->killConn();
  header("Location: listarAsistencias.php");
}

?>


?>