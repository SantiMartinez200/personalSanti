<?php
include(".././BD/conn.php");
include("../Clases/Asistencia.php");
?>
<script src="../Resources/js/sweetalert2.all.min.js"> </script>
<script src="../Resources/js/jquery-3.7.1.min.js"> </script>
<?php
$DB = new Conexion();
$idEliminar = $_POST["id"];
echo $idEliminar;
$sql = Asistencia::deleteAsistencia($idEliminar);
$ejecutar = $DB->ejecutar($sql);
if ($ejecutar) {
  $DB->killConn();
  header("Location: ../index.php");
}

?>


?>