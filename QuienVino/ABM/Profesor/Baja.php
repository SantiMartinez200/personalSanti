<?php
include("../../../QuienVino/BD/conn.php");
$database = Conexion::connect();
$id = $_GET["id"];
echo ($id);
$deleteQuery = "DELETE FROM profesor WHERE id='$id'";
$deleteFrom = mysqli_query($database,$deleteQuery);
if ($deleteFrom){
  header("Location: ../Profesor/ABM_Profesor.php");
}

?>