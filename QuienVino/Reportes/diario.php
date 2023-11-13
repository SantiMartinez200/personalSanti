<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte diario</title>
  <link rel="stylesheet" href="../Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../styleIndex.css">
  <link rel="stylesheet" href="../Resources/css/sweetalert2.min.css" />
</head>

<body>
  <script src="../Resources/js/bootstrap.bundle.min.js"></script>
  <script src="../Resources/js/sweetalert2.all.min.js"></script>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" overflow="hidden">
    <div class="container-fluid">
      <a href="../../QuienVino/index.php">
        <div class="redondo">
          <img src="../Multimedia/logo2.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>Reportes</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../Control/listarAsistencias.php">Listar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="../Control/contarAsistencias.php">Contar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="../Control/asistenciasTardiasIndex.php">Asistencias
                  tardías</a></li>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reportes</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./diario.php">Reporte de asistencias</a>
              </li>
              <li><a class="dropdown-item text-dark" href="./promocionados.php">Reporte de
                  promocionados</a></li>
              <li><a class="dropdown-item text-dark" href="./regulares.php">Reporte de
                  regulares</a></li>
              <li><a class="dropdown-item text-dark" href="./libres.php">Reporte de libres</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
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
  </nav>

  <div class="container d-flex justify-content-center w-50 bg-light text-center mt-5 rounded p-2">
    <form action="tablaDiario.php" class="form-control rounded  p-3" method="POST">
      <div class="row"><label for="calendario">
          <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
            <h1>Seleccionar día de reporte<h1>
          </div>
        </label>
      </div>
      <div class="row"><input class="form-control border-3 text-center" type="date" name="calendario" id="calendario"
          max="<?php echo date("Y-m-d") ?>">
      </div>
      <input type="submit" class="btnMostrar btn btn-outline-primary mt-2" value="Generar Tabla">
    </form>
  </div>
  <?php
  if (isset($_GET["err"])) {
    if (!empty($_GET["err"])) {
      switch ($_GET["err"]) {
        case 'empty':
          echo "<script>
                              const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'info',
  title: 'Ingrese una fecha'
})  

                            </script>";
          break;

        default:

          break;
      }

    }
  }
  ?>
</body>

</html>
<!-- tablaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->