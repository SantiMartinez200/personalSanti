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
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="../../QuienVino/index.php">
        <div class="redondo">
          <img src="../Multimedia/logo.png" class="logo">
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
          <img src="../Multimedia/sliders2.svg" alt="" class="img-fluid config"
            style="margin-right: 5px;">
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
        <!--<form action="listarAsistencias.php" method="POST">
          <label for="campo">
            <h3 class="text-light">Filtrar por alumno</h3>
          </label>
          <div class="d-flex "><input id="campo" class="form-control form-control-lg" type="text" name="dni">
          </div>
        </form>-->
        <table class="table table-hover text-center">
          <thead>
            <tr>
              <th colspan="6" class="bg-primary text-white ">
                <h4>Asistencias</h4>
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
                    <?php echo ($value[4]); ?>
                  </td>
                  <td>
                    <a class="link-dark table__item__link" href="eliminarAsistencia.php?id=<?php print($value[0]);?>">Eliminar</a>
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
  <script src="./JS/confirmDelete.js"></script>
</body>

</html>