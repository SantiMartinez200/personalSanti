<?php
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
if (isset($_GET["dni"])) {
  if (!empty($_GET["dni"])) {
    if (!$_POST) { ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Alumno</title>
        <link rel="stylesheet" href="../../../QuienVino/styleIndex.css">
        <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
      </head>

      <body>
        <style>
          body {
            background-color: rgb(61, 61, 61);
          }
        </style>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          <div class="container-fluid">
            <a href="../../../QuienVino/index.php">
              <div class="redondo">
                <img src="../../../QuienVino/Multimedia/logo.png" class="logo">
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
            <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
              <h2 class="container__title">Modificar Alumno</h2>
            </div>
            <form class="form text-center p-3 mb-2 bg-light text-black col-12" action="../Alumno/modificacionControl.php"
              method="POST">
              <?php
              if (mysqli_fetch_assoc($listado) != NULL) {
                mysqli_free_result($listado);
                $sql = Alumno::getAlumno($dni);
                $ejecutar = $conectarDB->ejecutar($sql);
                $listado = $ejecutar;
                while ($row = mysqli_fetch_assoc($listado)) { ?>
                  <input class="container__input" type="hidden" name="dniOriginal" id="iddni"
                    value="<?php print($row["dni"]); ?>">
                  <div class="row d-flex justify-content-center p-3">
                    <div class="col d-flex p-3"><label for="iddni" class="p-2">DNI:</label><input class="container__input"
                        type="number" name="dniToCatch" id="iddni" value="<?php print($row["dni"]); ?>"></div>
                    <div class="col d-flex p-3"><label for="idnombre" class="p-2">Nombre:</label><input type="text" id="idnombre"
                        class="container__input" name="nombre" value="<?php print($row["nombre"]); ?>"></div>
                    <div class="col d-flex p-3"><label for="idapellido" class="p-2">Apellido:</label><input type="text"
                        id="idapellido" class="container__input" name="apellido" value="<?php print($row["apellido"]); ?> "></div>
                    <div class="col d-flex p-3"><label for="idfecha" class="p-2">Fecha de nacimiento:</label><input type="date"
                        id="idfecha" class="container__input" name="fechaNacimiento"
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
          <script src="../../../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
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

    </html>
    <?php
  } else {
    echo "<script>alert('No borre la id que va a actualizar.'); window.location='ABM_Alumno.php'</script>";
  }
} else {
  echo "<script>alert('No se puede acceder a esta página sin actualizar un alumno.'); window.location='ABM_Alumno.php'</script>";
}