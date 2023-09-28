<?php
include("../../../QuienVino/BD/conn.php");
$database = Conexion::connect();
$id = $_GET["dni"];
echo ($id);
$deleteQuery = "DELETE FROM profesor WHERE dni_profesor='$id'";
$deleteFrom = mysqli_query($database,$deleteQuery);
if ($deleteFrom){
  header("Location: ../Profesor/ABM_Profesor.php");
}

?>