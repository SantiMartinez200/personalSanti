<?php
include("../../../QuienVino/BD/conn.php");
$database = Conexion::connect();
$id = $_GET["dni"];
echo ($id);
$deleteQuery = "DELETE FROM alumno WHERE dni='$id'";
$deleteFrom = mysqli_query($database, $deleteQuery);
if ($deleteFrom) {
  header("Location: ../Alumno/ABM_Alumno.php");
}

?>