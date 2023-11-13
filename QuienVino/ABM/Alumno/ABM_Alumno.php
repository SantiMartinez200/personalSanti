<?php
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
include("../../Clases/Asistencia.php");
include("../../Clases/Parametro.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABM ALUMNO</title>
  <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../QuienVino/styleIndex.css">
  <link rel="stylesheet" href="../../Resources/css/sweetalert2.min.css">
</head>

<body>
  <script src="../../Resources/js/sweetalert2.all.min.js"></script>
  <script src="../../Resources/js/jquery-3.7.1.min.js"></script>
  <script src="../../Control/JS/fetchJsAlumno.js"></script>
  <script src="../../Control/JS/confirmDelete2.js"></script>
  <script src="../../../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="../../../QuienVino/index.php">
        <div class="redondo">
          <img src="../../../QuienVino/Multimedia/logo2.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>Registros</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button"
              data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/listarAsistencias.php">Listar
                  asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/contarAsistencias.php">Contar
                  asistencias</a></li>
              <li><a class="dropdown-item text-dark"
                  href="../../../QuienVino/Control/asistenciasTardiasIndex.php">Asistencias tardías</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown text-light">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button"
              data-bs-toggle="dropdown">Registros</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./ABM_Alumno.php">Alumno</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown">Contacto</a>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reportes</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../../Reportes/diario.php">Reporte de asistencias</a>
              </li>
              <li><a class="dropdown-item text-dark" href="../../Reportes/promocionados.php">Reporte de
                  promocionados</a></li>
              <li><a class="dropdown-item text-dark" href="../../Reportes/regulares.php">Reporte de
                  regulares</a></li>
              <li><a class="dropdown-item text-dark" href="../../Reportes/libres.php">Reporte de libres</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="nav-item dropstart">
        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <img src="../../../QuienVino/Multimedia/sliders2.svg" alt="" class="img-fluid config"
            style="margin-right: 5px;">
        </a>
        <ul class="dropdown-menu text-dark">
          <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/parametros.php">Parámetros</a></li>
          <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
        </ul>
      </div>
    </div>

  </nav>

  <div class="container col-10">


    <form class="form text-center p-3 mb-2 bg-light text-black col-12 rounded" action="Alta.php" method="POST">
      <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
        <h2 class="container__title">Registrar Alumno</h2>
      </div>
      <div class="row">
        <div class="col">
          <label for="nombre" class="container__label">Nombre:</label>
          <div class="d-flex justify-content-center"><input type="text"
              class="container__input form-control w-50 border border-dark" name="nombre" id="nombre"></div>
        </div>
        <div class="col"><label for="apellido" class="container__label">Apellido:</label>
          <div class="d-flex justify-content-center "><input type="text"
              class="container__input form-control w-50 border border-dark" name="apellido" id="apellido"></div>
        </div>
      </div>
      <div class="row">
        <?php //////////////////////////////////////// ?>
        <div class="col">
          <label for="identificacion" class="container__label">DNI:</label>
          <div class="d-flex justify-content-center"><input type="number"
              class="container__input form-control w-50 border border-dark" name="dni" id="identificacion"></div>
        </div>
        <?php //////////////////////////////////////// ?>
        <div class="col">
          <label for="fechado" class="container__label">Fecha de nacimiento:</label>
          <div class="d-flex justify-content-center"><input type="date"
              class="container__input form-control w-50 border border-dark" name="fechaNacimiento" id="fechado"></div>
        </div>
      </div>
      <div class="col-12 text-center">
        <input type="submit" value="Registrar Alumno" class="btn btn-outline-primary">
      </div>
    </form>
  </div>
  <div class="d-flex justify-content-center">
    <div class="col-10 text-center">
      <div class="w-100 position-relative start-0 bg-primary text-light rounded border text-center form-control">
        <div class="d-flex align-items-center justify-content-center p-3 w-100">
          <label for="dni" class="text-left round pr-5">
            <h3 class="text-light mx-2">Buscar por DNI</h3>
          </label>
          <input type="number" name="dni" id="dni" class="form-control w-75 " onkeyup="buscarFetch(this.value)"
            autofocus>
        </div>
      </div>
      <div class="d-block overflow">
        <div id="buscar" class="text-center" style="height: auto"></div>
      </div>
      <table class="table table-hover" id="vaciar">
        <thead>
          <tr>
            <th colspan="5" class="bg-primary text-white rounded">Alumnos</th>
          </tr>
          <tr>
            <th scope="col">DNI</th>
            <th scope="col">Apellido</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">Operación</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $BD = new Conexion();
          $query = Alumno::listarAlumnos();
          $ejecutar = $BD->ejecutar($query);
          $listado = $ejecutar;
          $obj = $listado->fetch_all();
          //var_dump($obj);
          if ($listado <> NULL) {
            foreach ($listado as $row) { ?>
              <tr>
                <td>
                  <?php print($row["dni"]); ?>
                </td>
                <td>
                  <?php print($row["apellido"]); ?>
                </td>
                <td>
                  <?php print($row["nombre"]); ?>
                </td>
                <td>
                  <?php
                  $originalDate = $row["fecha_nacimiento"];
                  $newDate = date("d/m/Y", strtotime($originalDate));
                  echo ($newDate);
                  ?>
                </td>
                <td><a href="../../ABM/Alumno/Modificacion.php?dni=<?php echo ($row['dni']) ?>"
                    class="link-dark table__item__modify">Actualizar</a>
                  <a onclick="alumno_eliminar(<?php echo ($row['dni']) ?>)" class="link-dark table__item__link">Eliminar</a>
                  <?php

                  date_default_timezone_set("America/Argentina/Buenos_Aires");
                  $trimmedDate = date("Y-m-d");
                  $date = date("Y-m-d H:i:s");
                  $verificarFechaAsistencia = Alumno::verificarIngresoAsistencia($row['dni'], $trimmedDate);
                  if ($verificarFechaAsistencia == True) {
                    ?>
                    <img src="../../../QuienVino/Multimedia/check-all.svg" alt="">
                    <?php
                  } else {
                    ?>
                    <a href="../../ABM/Alumno/asistirAlumno.php?dni=<?php echo ($row['dni']) ?>&date=<?php print($date) ?>"
                      class="link-dark table__item__asist"><img src="../../../QuienVino/Multimedia/plus-circle-fill.svg"
                        alt="">
                      <?php
                      if (isset($_GET["var"]) && isset($_GET["birthday"])) {
                        if ($_GET["birthday"] == 1 || $_GET["birthday"] == true) {
                          echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Hoy es su cumpleaños!',
                          'se ha registrado su asistencia.',
                          'info',
                        )};
                        </script>
                        ";
                          echo '<script>' . $_GET['var'] . '</script>';
                        }
                      } elseif (isset($_GET["var"])) {
                        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Se ha registrado la asistencia!',
                          '',
                          'success',
                        )};
                        </script>
                        ";
                        echo '<script>' . $_GET['var'] . '</script>';
                        ?>
                      </a>
                      <?php
                      }
                  }
                  ?>
                </td>
              </tr>
              <?php
            }
          } else {
            ?>
          </tbody>
        </table>
        <div class="alert alert-warning">
          <h3>Aún no hay alumnos registrados.</h3>
        </div>
        <?php
          }
          $BD->killConn();
          ?>
      </tbody>
      </table>
    </div>
  </div>
  </div>

  <div class="d-flex justify-content-center">
    <a href="../../../QuienVino/index.php"><button type="button" class="btn btn-light text-primary">Volver al
        inicio</button></a>
  </div>
  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <?php
  if (isset($_GET['var'])) {
    $sweetAlert = $_GET['var'];
    $errno = substr($sweetAlert, -1);
    $ejec = substr($sweetAlert, 0, -8);
    switch ($errno) {
      case 1:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Ya existe un alumno con ese DNI',
                          '',
                          'error',
                        )};
                        </script>
                        ";
        echo '<script>' . $ejec . '</script>';
        break;
      case 2:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Error desconocido',
                          'Intenta verificar las fechas o campos',
                          'question',
                        )};
                        </script>
                        ";
        echo '<script>' . $ejec . '</script>';
        break;
      case 3:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Error en los campos de texto',
                          'No se deben ingresar caracteres especiales ni numeros',
                          'error',
                        )};
                        </script>
                        ";
        echo '<script>' . $ejec . '</script>';
        break;
      case 4:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Error en los campos',
                          'Intenta ingresando valores mas cortos, o valores positivos.',
                          'info',
                        )};
                        </script>
                        ";
        echo '<script>' . $ejec . '</script>';
        break;
      case 5:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Ingresaste algún campo vacío',
                          'Completa todos los campos',
                          'info',
                        )};
                        </script>
                        ";
        echo '<script>' . $ejec . '</script>';
        break;
      case 6:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Operación exitosa!',
                          '',
                          'success',
                        )};
                        </script>
                        ";
        echo '<script>' . $ejec . '</script>';
        break;

    }
  }
  if (isset($_GET["err"])) {
    if (!empty($_GET["err"])) {
      switch ($_GET["err"]) {
        case 'Late':
          echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Imposible registrar la asistencia!',
                          'El alumno ha llegado tarde.',
                          'error'
                        )};
                        fireSweetAlert();</script>";
          break;
        case 'noParams':
          echo "<script>Swal.fire('Imposible cargar la asistencia!', 'Configure los parámetros del sistema.', 'warning');</script>";
          break;
        case 'noParamsRegister':
          echo "<script>Swal.fire('Imposible registrar alumno!', 'Configure los parámetros del sistema.', 'warning');</script>";
          break;
        case 'noParamsModify':
          echo "<script>Swal.fire('Imposible modificar alumno!', 'Configure los parámetros del sistema.', 'warning');</script>";
          break;
      }

    }
  }
  ?>
</body>

</html>