<?php
include("../BD/conn.php");
include("../Clases/Parametro.php");

if(isset($_GET["codigo"])){
  if(!empty($_GET["codigo"])){
    $codigo = $_GET["codigo"];
    $conectarDB = new Conexion();
    $conectarDB->connect();
    $sql = Parametro::deleteParametros($codigo);
    $ejecutar = $conectarDB->ejecutar($sql);
    if ($ejecutar) {
      $conectarDB->killConn();
      header("Location: parametros.php?err=deleted");
    }else{
      header("Location: parametros.php?err=notDeleted");
    }
  }
}



?>