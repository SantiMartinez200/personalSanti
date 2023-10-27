<?php
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABM ALUMNO</title>
  <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../QuienVino/styleIndex.css">
</head>

<body>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button"
              data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/listarAsistencias.php">Listar
                  asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/contarAsistencias.php">Contar
                  asistencias</a></li>
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
    <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
      <h2 class="container__title">Registrar Alumno</h2>
    </div>

    <form class="form text-center p-3 mb-2 bg-light text-black col-12 rounded" action="Alta.php" method="POST">
      <div class="row">
        <div class="col">
          <label for="nombre" class="container__label">Nombre:</label>
          <div class="d-flex justify-content-center"><input type="text" class="container__input" name="nombre"
              id="nombre"></div>
        </div>
        <div class="col"><label for="apellido" class="container__label">Apellido:</label>
          <div class="d-flex justify-content-center"><input type="text" class="container__input" name="apellido"
              id="apellido"></div>
        </div>
      </div>
      <div class="row">
        <?php //////////////////////////////////////// ?>
        <div class="col">
          <label for="identificacion" class="container__label">DNI:</label>
          <div><input type="number" class="container__input" name="dni" id="identificacion"></div>
        </div>
        <?php //////////////////////////////////////// ?>
        <div class="col">
          <label for="fechado" class="container__label">Fecha de nacimiento:</label>
          <div><input type="date" class="container__input" name="fechaNacimiento" id="fechado"></div>
        </div>
      </div>
      <div class="col-12 text-center">
        <input type="submit" value="Registrar Alumno" class="btn btn-outline-primary">
      </div>
    </form>
  </div>
  <div class="d-flex justify-content-center">
    <div class="col-10 text-center">
      <table class="table table-hover">
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
          if ($listado->num_rows <> NULL) {
            while ($row = mysqli_fetch_assoc($listado)) { ?>
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
                  <?php print($row["fecha_nacimiento"]); ?>
                </td>
                <td><a href="../../ABM/Alumno/Modificacion.php?dni=<?php echo ($row["dni"]) ?>"
                    class="link-dark table__item__modify">Actualizar</a>
                  <a href="../../ABM/Alumno/Baja.php?dni=<?php echo ($row["dni"]) ?>"
                    class="link-dark table__item__link">Eliminar</a>
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
    <script src="../../../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
    <script src="../../../QuienVino/ABM/Alumno/JS/confirmDelete.js"></script>

  </div>
  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
</body>

</html>