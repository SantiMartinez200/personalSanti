<?php
require("../BD/conn.php");
require("../Clases/Parametro.php");
?>
<!DOCTYPE html>
<html lang="en">
<!--  COUNT DE LAS ASISTENCIAS, HACER EL NUMERO PARAMETRIZABLE
Menú Configuración, que aparezca DIAS DE CLASE, guardarlos en la base de datos, comparamos porcentaje con el valor cargado y el valor de las asistencias. -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parámetros</title>
  <link rel="stylesheet" href="../Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../styleIndex.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="../index.php">
        <div class="redondo">
          <img src="../Multimedia/logo2.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>Parámetros de control</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav">
          <li class="nav-item dropdown text-light">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./listarAsistencias.php">Listar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="./contarAsistencias.php">Contar asistencias</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Registros</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../ABM/Alumno/ABM_Alumno.php">Alumno</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Contacto</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="https://www.instagram.com/santiago_martinez03/?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D">Instagram</a></li>
              <li><a class="dropdown-item text-dark" href="https://www.facebook.com/fede.garcia.37604/">Facebook</a></li>
              <li><a class="dropdown-item text-dark" href="https://www.linkedin.com/in/santiago-mart%C3%ADnez-681b38238/">Linkedin</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="nav-item dropstart">
        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <img src="../Multimedia/sliders2.svg" alt="" class="img-fluid config" style="margin-right: 5px;">
        </a>
        <ul class="dropdown-menu text-dark">
          <li><a class="dropdown-item text-dark" href="./parametros.php">Parámetros</a></li>
          <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
        </ul>
      </div>
    </div>
  </nav>

  <?php
  $conectarDB = new Conexion();
  $conectarDB->connect();
  $sql = Parametro::traerParametros();
  $ejecutar = $conectarDB->ejecutar($sql);
  $listadoParametros = $ejecutar->fetch_object();
  if ($listadoParametros <> NULL) {
    ?>
    <div class="container d-flex justify-content-center align-items-center w-75 bg-light text-center mt-5 rounded p-2">
      <form action="./actualizarParametros.php" class="form-control rounded  p-3" method="POST">
        <div class="row">
          <div class="bg-primary"><h2 class="form_control bg-primary text-light"><b>Parametros</b></div>
            <h2>
        </div>
        <div class="container d-flex justify-content-center">
          <div class="w-50 row">
            <div class="row">
              <label for="diasClases">
                <h4>Dias de clase</h4>
              </label>
              <input id="diasClases" type="number" class="form-control-lg text-center" name="1"
                value="<?php print($listadoParametros->dias_clases); ?>">
            </div>
            <div class="row">
              <label for="promedioPromocion">
                <h4>Promedio para promocionar</h4>
              </label>
              <input id="promedioPromocion" type="number" class="form-control-lg text-center" name="3"
                value="<?php print($listadoParametros->promedio_promocion); ?>">
            </div>
            <div class="row">
              <label for="promedioRegularidad">
                <h4>Promedio para regularizar</h4>
              </label>
              <input id="promedioRegularidad" type="number" class="form-control-lg text-center" name="4"
                value="<?php print($listadoParametros->promedio_regularidad); ?>">
            </div>
            <div class="row">
              <label for="edadRegistro">
                <h4>Edad mínima para registro</h4>
              </label>
              <input id="edadRegistro" type="number" class="form-control-lg text-center" name="2"
                value="<?php print($listadoParametros->edad_minima); ?>">
            </div>
            <div>
              <input type="submit" class="btn btn-outline-primary mt-5" value="Aplicar cambios">
            </div>
          </div>
        </div>
      </form>
    </div>
    <?php
  } else {
    ?>
    <div class="container d-flex justify-content-center align-items-center w-75 bg-light text-center mt-5 rounded p-2">

      <form action="./insertarParametros.php" class="form-control rounded  p-3" method="POST">
        <div class="row">
          <h2 class="form_control"><b>Cargue los parámetros en la base de datos.</b>
            <h2>
        </div>
        <div class="container d-flex justify-content-center">
          <div class="w-50 row">
            <div class="row">
              <label for="diasClases">
                <h4>Dias de clase</h4>
              </label>
              <input id="diasClases" type="number" class="form-control-lg text-center" name="1">
            </div>
            <div class="row">
              <label for="promedioPromocion">
                <h4>Promedio para promocionar</h4>
              </label>
              <input id="promedioPromocion" type="number" class="form-control-lg text-center" name="3">
            </div>
            <div class="row">
              <label for="promedioRegularidad">
                <h4>Promedio para regularizar</h4>
              </label>
              <input id="promedioRegularidad" type="number" class="form-control-lg text-center" name="4">
            </div>
            <div class="row">
              <label for="edadRegistro">
                <h4>Edad mínima para registro</h4>
              </label>
              <input id="edadRegistro" type="number" class="form-control-lg text-center" name="2">
            </div>
            <div>
              <input type="submit" class="btn btn-dark mt-5" value="Cargar Registros">
            </div>
          </div>
        </div>
      </form>
    </div>
    <?php
  }
  ?>

  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
</body>
<script src="../Resources/js/bootstrap.bundle.min.js"></script>

</html>