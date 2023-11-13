<?php
include("../BD/conn.php");
include("../Clases/Persona.php");
include("../Clases/Alumno.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de asistencias</title>
  <link rel="stylesheet" href="../Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../styleIndex.css">
</head>

<body>
  <script src="../Resources/js/sweetalert2.all.min.js"></script>
  <script src="../Resources/js/jquery-3.7.1.min.js"></script>
  <script src="./JS/confirmDelete.js"></script>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="../../QuienVino/index.php">
        <div class="redondo">
          <img src="../Multimedia/logo2.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>Asistencias</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./listarAsistencias.php">Listar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="./contarAsistencias.php">Contar asistencias</a></li>
               <li><a class="dropdown-item text-dark" href="./asistenciasTardiasIndex.php">Asistencias tardías</a></li>
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
              <li><a class="dropdown-item text-dark"
                  href="https://www.instagram.com/santiago_martinez03/?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D">Instagram</a>
              </li>
              <li><a class="dropdown-item text-dark" href="https://www.facebook.com/fede.garcia.37604/">Facebook</a>
              </li>
              <li><a class="dropdown-item text-dark"
                  href="https://www.linkedin.com/in/santiago-mart%C3%ADnez-681b38238/">Linkedin</a></li>
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
          <li><a class="dropdown-item text-dark" href="../Control/parametros.php">Parámetros</a></li>
          <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
        </ul>
      </div>
    </div>
  </nav>
  <?php
  //var_dump($alumnos);
  ?>


  <div class="d-flex justify-content-center">
    <div class="col-10">
      <div class="container m-2">
        <div class="w-100 position-relative start-0 bg-primary text-light rounded border text-center form-control">
          <div class="d-flex align-items-center justify-content-center p-3 w-100">
            <label for="dni" class="text-left round pr-5">
              <h3 class="text-light mx-2">Buscar por DNI</h3>

            </label>

            <input type="text" name="dni" id="dni" class="form-control w-75 " onkeyup="buscarFetch(this.value)"
              autofocus>
          </div>
        </div>
        <div class="d-block overflow">
          <div id="buscar" class="text-center" style="height: auto"></div>
        </div>
        <table class="table table-hover text-center w-100" id="vaciar">
          <thead>
            <tr>
              <th colspan="6" class="bg-primary text-white ">
                <h2>Asistencias</h2>
              </th>
            </tr>
            <tr>
              <th scope="col">ID de Asistencia</th>
              <th scope="col">DNI</th>
              <th scope="col">Apellido</th>
              <th scope="col">Nombre</th>
              <th scope="col">Fecha y Hora</th>
              <th scope="col">Operacion</th>
            </tr>
          </thead>
          <tbody id="tableInfo">

            <?php
            $conectarDB = new Conexion();
            $consulta = Alumno::listarAlumnosConAsistencias();
            $traerDatos = $conectarDB->ejecutar($consulta);
            $resultado = $traerDatos->fetch_all();
            if ($resultado == NULL) {
              ?>
            </tbody>
          </table>
          <div class="alert alert-warning">
            <h3>Aún no hay alumnos que tengan asistencias</h3>
          </div>
          <?php
            } else {
              foreach ($resultado as $eachResult => $value) {
                ?>
            <tr>
              <td>
                <?php echo ($value[0]); ?>
              </td>
              <td>
                <?php echo ($value[1]); ?>
              </td>
              <td>
                <?php echo ($value[3]); ?>
              </td>
              <td>
                <?php echo ($value[2]); ?>
              </td>
              <td>
                <?php
                $originalDate = $value[4];
                $newDate = date("d/m/Y H:i", strtotime($originalDate));
                echo ($newDate);
                ?>
              </td>
              <td>
                <a class="link-dark table__item__link" onclick='alerta_eliminar(<?php echo ($value[0]) ?>)'>Eliminar</a>
              </td>
            </tr>
            <?php
              }
            }

            ?>
        </tbody>
        </table>
        <?php
        ?>

      </div>

    </div>
  </div>
  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <script src="../../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
  <script src="./JS/fetchJs.js"></script>
  <?php

  ?>
</body>

</html>