<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asistencias tardías</title>
  <link rel="stylesheet" href="../Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../styleIndex.css">
  <link rel="stylesheet" href="../Resources/css/sweetalert2.min.css" />
</head>

<body>
  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <script src="../../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
  <script src="../../QuienVino/Resources/js/sweetalert2.all.min.js"></script>
  <script src="../../QuienVino/Resources/js/jquery-3.7.1.min.js"></script>
  <script src="./JS/confirmDeleteTardio.js"></script>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" overflow="hidden">
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
    <form action="asistenciasTardiasIndex.php" class="form-control rounded  p-3" method="POST">
      <div class="row"><label for="dni">
          <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
            <h1>Registre una asistencia tardía<h1>
          </div>

        </label></div>
      <div class="row"><input class="form-control border-3" type="number" name="dni" id="dni">
      </div>
      <div class="row"><input class="form-control border-3 text-center" type="date" name="fecha_tardia"
          id="fecha_tardia" max="<?php echo date("Y-m-d") ?>">
      </div>
      <input type="submit" class="btnMostrar btn btn-outline-primary mt-2" value="Registrar Asistencia">
    </form>
  </div>
</body>

</html>
<?php
////////////////////////////////VALIDACIONES////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  date_default_timezone_set("America/Argentina/Buenos_Aires");
  include("../BD/conn.php");
  include("../Clases/Persona.php");
  include("../Clases/Alumno.php");
  include("../Clases/Parametro.php");
  if (isset($_POST["dni"]) && isset($_POST["fecha_tardia"])) {
    if (!empty($_POST["dni"]) && !empty($_POST["fecha_tardia"])) {
      $fechaTardia = $_POST["fecha_tardia"];
      $dni = $_POST["dni"];
      $conectarDB = new Conexion;
      $conectarDB->connect();
      $paramQuery = Parametro::traerParametros();
      $paramExecute = $conectarDB->ejecutar($paramQuery);
      $paramList = $paramExecute->fetch_all();
      $horafija = "";
      if ($paramList <> NULL) {
        $horafija = $paramList[0][6];
      } else {
        echo ("<script>window.location='./parametros.php?err=noParams'</script>");
        $conectarDB->killConn();
      }
      $queryVerificar = Alumno::verificarIngresoAsistencia($dni, $fechaTardia);
      $fechaTardiaISO = date("Y-m-d", strtotime($fechaTardia));
      if ($queryVerificar == false) {
        try {
          $fechaTardia = $fechaTardia . ' ' . $horafija;
          $query = Alumno::insertarAsistencia($dni, $fechaTardia);
          $ejecutar = $conectarDB->ejecutar($query);
        } catch (mysqli_sql_exception $e) {
          if (str_contains($e, 'Cannot add or update a child row')) {
            echo "<script>window.location='asistenciasTardiasIndex.php?conf=fatal'</script>";
          } else {
            die(print_r("<script>window.location='asistenciasTardiasIndex.php?conf=err2'</script>"));
          }
        }

        ?>
        <script>
          var dni = <?php echo ($dni) ?>;
          var fecha = <?php echo (json_encode($fechaTardiaISO)) ?>;
          console.log(fecha);
          window.location = "asistenciasTardiasIndex.php?conf=true" + "&dni=" + dni + "&fecha=" + fecha;
        </script>
        <?php
      } else {
        ?>
        <script>
          var fecha = <?php echo (json_encode($fechaTardiaISO)) ?>;
          var dni = <?php echo ($dni) ?>;
          window.location = "asistenciasTardiasIndex.php?conf=false" + "&dni=" + dni + "&fecha=" + fecha;
        </script>
        <?php
      }
    } else {
      echo "<script>window.location='asistenciasTardiasIndex.php?conf=err1'</script>";
    }
  } else {
    echo "<script>window.location='asistenciasTardiasIndex.php?conf=err2'</script>";
  }
} else {
  if (isset($_GET["conf"])) {
    include("../BD/conn.php");
    include("../Clases/Persona.php");
    include("../Clases/Alumno.php");
    include("../Clases/Parametro.php");
    switch ($_GET["conf"]) {
      case 'true':
        $dni = $_GET["dni"];
        $conectarDB = new Conexion;
        $conectarDB->connect();
        $alumno = Alumno::getAlumno($dni);
        $ejecutarAlumno = $conectarDB->ejecutar($alumno);
        $listarAlumno = $ejecutarAlumno->fetch_all();
        $n = $listarAlumno[0][1];
        $a = $listarAlumno[0][2];
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
  icon: 'success',
  title: 'Se ha registrado la asistencia de: $n $a'
})  

                            </script>";
        $date = Date("Y-m-d H:i:s");
        $f = $_GET["fecha"];
        $newDate = date('d/m/Y H:i', strtotime($f));
        $birthday = Alumno::cumple($date, $dni);
        $execBirthday = $conectarDB->ejecutar($birthday);
        $listBirthday = $execBirthday->fetch_all();
        if ($listBirthday != NULL) {
          echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Hoy $n $a cumple años!',
                          'Se ha registrado HOY la asistencia de $n $a para el $newDate',
                          'info'
                        )};
                        fireSweetAlert();</script>";
        }
        break;
      case 'false':
        $f = $_GET["fecha"];
        $dni = $_GET["dni"];
        $conectarDB = new Conexion;
        $conectarDB->connect();
        $alumno = Alumno::getAlumno($dni);
        $ejecutarAlumno = $conectarDB->ejecutar($alumno);
        $listarAlumno = $ejecutarAlumno->fetch_all();
        $n = $listarAlumno[0][1];
        $a = $listarAlumno[0][2];
        $dateAsis = Alumno::getAsistencia($dni, $f);
        $execDateAsis = $conectarDB->ejecutar($dateAsis);
        $fetchDateAsis = $execDateAsis->fetch_all();
        $newDate = date('d/m/Y H:i', strtotime($fetchDateAsis[0][4]));
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
  icon: 'error',
  title: '$n $a YA TIENE asistencia registrada el $newDate',
})  

                            </script>";
        $date = Date("Y-m-d H:i:s");


        $birthday = Alumno::cumple($date, $dni);
        $execBirthday = $conectarDB->ejecutar($birthday);
        $listBirthday = $execBirthday->fetch_all();
        if ($listBirthday != NULL) {
          echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Hoy $n $a cumple años!',
                          '$n $a YA TIENE asistencia registrada el $newDate',
                          'info'
                        )};
                        fireSweetAlert();</script>";
        }
        break;
      case 'err1':
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
  title: 'Valores invalidos o vacios'
})  

                            </script>";
        break;
      case 'err2':
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
  icon: 'question',
  title: 'No se pudo cargar la asistencia'
})  

                            </script>";
        break;
      case 'fatal':
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
  icon: 'question',
  title: 'No se encontró el DNI'
})  

                            </script>";
        break;
    }
    $conf = $_GET["conf"];
    if ($conf == 'true' || $conf == 'false') {
      $date = $_GET["fecha"];
      ?>
      <div class="d-flex justify-content-center">
        <div class="col-10">
          <div class="container m-2">
            <table class="table table-hover text-center w-100">
              <thead>
                <tr>
                  <th colspan="6" class="bg-primary text-white ">
                    <?php
                    if ($conf == 'true') {
                      ?>
                      <h2>Asistencia Registrada</h2>
                      <?php
                    } else {
                      ?>
                      <h2>Asistencia Previa</h2>
                      <?php
                    }
                    ?>
                  </th>
                </tr>
                <tr>
                  <th scope="col">ID de Asistencia</th>
                  <th scope="col">DNI</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Fecha y Hora</th>
                  <th scope="col">Operación</th>
                </tr>
              </thead>
              <tbody id="tableInfo">
                <?php
                $consulta = Alumno::getAsistencia($dni, $date);
                $ejecutar = $conectarDB->ejecutar($consulta);
                $fetchAll = $ejecutar->fetch_all();
                foreach ($fetchAll as $value) {
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
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php
    }
  }
}
?>