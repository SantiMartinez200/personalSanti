<?php
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
if (isset($_GET["dni"])) {
  if (!$_POST) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Modificar Alumno</title>
      <link rel="stylesheet" href="../../styleIndex.css">
      <link rel="stylesheet" href="../../Resources/css/bootstrap.min.css" />
      <link rel="stylesheet" href="../../Resources/css/sweetalert2.min.css" />
    </head>

    <body>
      <script src="../../Resources/js/jquery-3.7.1.min.js"></script>
      <script src="../../Resources/js/sweetalert2.all.min.js"></script>
      <style>
        body {
          background-color: rgb(61, 61, 61);
        }
      </style>
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
              <li class="nav-item dropdown text-light">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/listarAsistencias.php">Listar
                      asistencias</a></li>
                  <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/contarAsistencias.php">Contar
                      asistencias</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown text-light">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Registros</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item text-dark" href="./ABM_Alumno.php">Alumno</a></li>
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
              <img src="../../Multimedia/sliders2.svg" alt="" class="img-fluid config" style="margin-right: 5px;">
            </a>
            <ul class="dropdown-menu text-dark">
              <li><a class="dropdown-item text-dark" href="../../Control/parametros.php">Parámetros</a></li>
              <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
            </ul>
          </div>
        </div>
      </nav>
      <div class="todo">
        <?php
        $dni = $_GET["dni"];
        //echo ($dni);
        $conectarDB = new Conexion();
        $sql = Alumno::getAlumno($dni);
        $ejecutar = $conectarDB->ejecutar($sql);
        $listado = $ejecutar;
        ?>
        <div class="container col-10 mt-5 rounded">

          <form class="form text-center p-3 mb-2 bg-light text-black col-12" action="../Alumno/modificacionControl.php"
            method="POST">
            <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
              <h2 class="container__title">Modificar Alumno</h2>
            </div>
            <?php
            if (mysqli_fetch_assoc($listado) != NULL) {
              mysqli_free_result($listado);
              $sql = Alumno::getAlumno($dni);
              $ejecutar = $conectarDB->ejecutar($sql);
              $listado = $ejecutar;
              while ($row = mysqli_fetch_assoc($listado)) { ?>
                <input class="container__input" type="hidden" name="dniOriginal" id="d" value="<?php print($row["dni"]); ?>">
                <div class="row d-flex justify-content-center p-3">
                  <div class="col d-flex p-3 "><label for="iddni" class="p-2">DNI:</label><input
                      class="container__input form-control w-50 border border-dark" type="number" name="dniToCatch" id="iddni"
                      value="<?php print($row["dni"]); ?>"></div>
                  <div class="col d-flex p-3"><label for="idnombre" class="p-2">Nombre:</label><input type="text" id="idnombre"
                      class="container__input form-control w-50 border border-dark" name="nombre"
                      value="<?php print($row["nombre"]); ?>"></div>
                  <div class="col d-flex p-3"><label for="idapellido" class="p-2">Apellido:</label><input type="text"
                      id="idapellido" class="container__input form-control w-50 border border-dark" name="apellido"
                      value="<?php print($row["apellido"]); ?> "></div>
                  <div class="col d-flex p-3"><label for="idfecha" class="p-2">Fecha de nacimiento:</label><input type="date"
                      id="idfecha" class="container__input form-control w-50 border border-dark" name="fechaNacimiento"
                      value="<?php echo date("Y-m-d", strtotime($row['fecha_nacimiento'])); ?>"></div>
                </div>
              <?php }
            } else {
              echo "<div class='alert alert-danger mt-3'>El DNI no ha sido encontrado.</div>";
            }
            ?>
            <input type="submit" value="Modificar Alumno" class="btn btn-outline-dark">
          </form>
        </div>
        <script src="../../Resources/js/bootstrap.bundle.min.js"></script>
      </div>
      <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
          -webkit-appearance: none;
        }
      </style>
    </body>

    </html>
    <?php
    $conectarDB->killConn();
  } ?>
  </body>
  <?php
  if (isset($_GET['var'])) {
    $sweetAlert = $_GET['var'];
    $errno = substr($sweetAlert, -1);
    $ejec = substr($sweetAlert, 0, -8);
    $dni = substr($sweetAlert, 0, -8);
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
                          'Alumno Actualizado!',
                          '',
                          'success',
                        )};
                        </script>
                        ";
        echo '<script>' . $ejec . '</script>';
        break;

    }
  }
  ?>

  </html>
  <?php
} else {
  echo "<script>alert('No se puede acceder a esta página sin actualizar un alumno.'); window.location='ABM_Alumno.php'</script>";
}