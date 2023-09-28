<?php
//$consulta = "SELECT * FROM usuarios WHERE username='$usuario' AND pass='$contrasena'";
if (!empty($_POST["ingresar"])) {
  if (empty($_POST["username"]) && empty($_POST["pass"])) {
    echo '<div class="alert alert-danger mb-0">Los campos estan vacios</div>';
  }else{
    $usuario = $_POST["username"];
    $contrasena = $_POST["pass"];
    $db = Conexion::connect();
    $query=("SELECT * FROM usuarios WHERE username='$usuario' AND pass='$contrasena'");
    $Ejecutar = mysqli_query($db,$query);

    if ($Ejecutar->fetch_object()){
      header('location: ../../TRABAJO_PRACTICO/Index/home.php');
    }else{
        echo '<div class="alert alert-danger mb-0">Acceso Denegado.</div>'; 
    }
  }
} else {
  
}






?>