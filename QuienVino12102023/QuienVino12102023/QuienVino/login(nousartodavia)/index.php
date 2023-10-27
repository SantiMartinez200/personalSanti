<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesion</title>
  <link rel="stylesheet" href="../../TRABAJO_PRACTICO/Login/CSS/styleLogin.css">
  <link rel="stylesheet" href="../../TRABAJO_PRACTICO/css/bootstrap.min.css">
</head>

<body>
  <br><br><br><br><br><br><br><br>
  
  <div class="containerLogin">
    <h2 class="container__title">Inicie Sesión</h2>
    <form class="container__form" action="#" method="POST">
      <label for="" class="container__label">Usuario:</label><input type="text" class="container__input"
        name="username">
      <label for="" class="container__label">Contraseña:</label><input type="password" class="container__input"
        name="pass">
      <input type="submit" name="ingresar" value="login" class="btn btn-outline-dark">
      <?php
      ?>
    </form>
    <div class="err">
    <?php
    include("../TRABAJO_PRACTICO/BD/conn.php");
    include("../TRABAJO_PRACTICO/loginControlador.php");
    ?>
  </div>
  </div>

</body>

</html>