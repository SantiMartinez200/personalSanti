<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="./Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./Resources/css/sweetalert2.min.css" />
  <link rel="stylesheet" href="styleIndex.css">
</head>

<body>

  <script src="./Resources/js/sweetalert2.all.min.js"></script>
  <script src="./Resources/js/jquery-3.7.1.min.js"></script>
  <script src="./Control/JS/confirmDeleteIndex.js"></script>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="index.php">
        <div class="redondo">
          <img src="./Multimedia/logo2.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>¿QuienVino?</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./Control/listarAsistencias.php">Listar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="./Control/contarAsistencias.php">Contar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="./Control/asistenciasTardiasIndex.php">Asistencias
                  tardías</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Registros</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./ABM/Alumno/ABM_Alumno.php">Alumno</a></li>
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
              <li><a class="dropdown-item text-dark" href="./Reportes/diario.php">Reporte de asistencias</a>
              </li>
              <li><a class="dropdown-item text-dark" href="./Reportes/promocionados.php">Reporte de
                  promocionados</a></li>
              <li><a class="dropdown-item text-dark" href="./Reportes/regulares.php">Reporte de
                  regulares</a></li>
              <li><a class="dropdown-item text-dark" href="./Reportes/libres.php">Reporte de libres</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="nav-item dropstart">
        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <img src="./Multimedia/sliders2.svg" alt="" class="img-fluid config" style="margin-right: 5px;">
        </a>
        <ul class="dropdown-menu text-dark">
          <li><a class="dropdown-item text-dark" href="./Control/parametros.php">Parámetros</a></li>
          <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
        </ul>
      </div>
    </div>
  </nav>
  <div class="container  d-flex justify-content-center mt-5">

    <img src="./Multimedia/logo2.png" class="logoindex">

  </div>
  <div class="container d-flex justify-content-center w-50 bg-light text-center mt-5 rounded p-2">
    <form action="./index.php" class="form-control rounded  p-3" method="POST">
      <div class="row"><label for="dni">
          <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
            <h1>Ingrese el DNI<h1>
          </div>

        </label></div>
      <div class="row"><input class="form-control border-3" type="number" name="dni" id="dni" autofocus="autofocus">
      </div>
      <input type="submit" class="btnMostrar btn btn-outline-primary mt-2" value="Registrar Asistencia">
      <div class="row">
        <?php
        $k = False;
        include("./BD/conn.php");
        include("./Clases/Persona.php");
        include("./Clases/Alumno.php");
        include("./Clases/Asistencia.php");
        include("./Clases/Parametro.php");
        $conectarDB = new Conexion();
        $conectarDB->connect();
        $traerParametros = Parametro::traerParametros();
        $execParams = $conectarDB->ejecutar($traerParametros);
        $listParams = $execParams->fetch_all();
        if ($listParams == NULL) {
          $conectarDB->killConn();
          echo ("<script>window.location='./Control/parametros.php?err=noParams'</script>");
        } 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if (isset($_POST["dni"])) {
            if (!empty($_POST["dni"])) {
              $consultarDni = $_POST["dni"]; //traer el alumno
              if (($consultarDni >= 99999999) || ($consultarDni <= 0)) {
                echo "<script>Swal.fire('El DNI es inválido!', 'Ingrese un DNI válido.', 'error');</script>";
              } else {
                $consulta = Alumno::getAlumno($consultarDni);
                $traerAlumno = $conectarDB->ejecutar($consulta);
                $alumnos = $traerAlumno->fetch_all(); //acomodar en array
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $date = date("Y-m-d H:i:s");
                if ($alumnos == NULL) {
                  echo "<script>
                              const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: 'El DNI no ha sido encontrado.'
})  

setTimeout(function(){
  window.location = 'index.php';
},1500);



                            </script>";
                } else {
                  $n = $alumnos[0][1];
                  $a = $alumnos[0][2];
                  $trimmedDate = date("Y-m-d");
                  $verificarFechaAsistencia = Alumno::verificarIngresoAsistencia($consultarDni, $trimmedDate);
                  ////////////////////////////////
                  $traerParametros = Parametro::traerParametros();
                  $execParams = $conectarDB->ejecutar($traerParametros);
                  $listParams = $execParams->fetch_all();
                  //var_dump($listParams);
                  $time = date("H:i");
                  //var_dump($time);
                  if ($listParams <> NULL) {
                    $horaInicial = $listParams[0][6];
                    $minutosASumar = intval($listParams[0][5]);
                    $fechaHora = DateTime::createFromFormat('H:i:s', $horaInicial);
                    $fechaHora->add(new DateInterval('PT' . $minutosASumar . 'M'));
                    $horaResultante = $fechaHora->format('H:i');
                    if ($time <= $horaResultante) {
                    } else {
                      $conectarDB->killConn();
                      echo "<script>window.location='index.php?err=Late&hora=$horaResultante';</script>";
                    }
                  } else {
                    echo "<script>window.location='index.php?err=noParams';</script>";
                    $conectarDB->killConn();
                  }

                  ////////////////////////////////
                  function verificador($verificarFechaAsistencia, $conectarDB, $consultarDni, $n, $a, $date)
                  {
                    if ($verificarFechaAsistencia == False) {
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

                      $consulta = Alumno::insertarAsistencia($consultarDni, $date);
                      $cargarAsistencia = $conectarDB->ejecutar($consulta);
                      $birthday = Alumno::cumple($date, $consultarDni);
                      $execBirthday = $conectarDB->ejecutar($birthday);
                      $listBirthday = $execBirthday->fetch_all();
                      if ($listBirthday != NULL) {
                        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Hoy $n $a cumple años!',
                          'Se ha registrado su asistencia',
                          'info'
                        )};
                        fireSweetAlert();</script>";
                      }
                      return True;
                    } else {
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
  title: '$n $a ya ha asistido hoy.'
})  

                            </script>";
                      return False;
                    }
                  }
                  $result = verificador($verificarFechaAsistencia, $conectarDB, $consultarDni, $n, $a, $date);
                  if ($result == True) {
                    ?>
                  </div>
              </div>
              </form>
              <div class="d-flex justify-content-center">
                <div class="col-10">
                  <div class="container m-2">
                    <table class="table table-hover text-center w-100">
                      <thead>
                        <tr>
                          <th colspan="6" class="bg-primary text-white ">
                            <h2>Asistencia Registrada</h2>
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
                        $consulta = Alumno::getAsistencia($consultarDni, $date);
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
                  } else {
                    $birthday = Alumno::cumple($date, $consultarDni);
                    $execBirthday = $conectarDB->ejecutar($birthday);
                    $listBirthday = $execBirthday->fetch_all();
                    if ($listBirthday != NULL) {
                      echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Hoy $n $a cumple años!',
                          '$n $a YA HA ASISTIDO hoy.',
                          'info'
                        )};
                        fireSweetAlert();</script>";
                    }
                    ?>
              </div>
              </div>
              </form>
              <div class="d-flex justify-content-center">
                <div class="col-10">
                  <div class="container m-2">
                    <table class="table table-hover text-center w-100">
                      <thead>
                        <tr>
                          <th colspan="6" class="bg-primary text-white ">
                            <h2>Asistencia de hoy</h2>
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
                        $trimmedDate = date("Y-m-d");
                        $consulta = Alumno::getAsistencia($consultarDni, $trimmedDate);
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
                $conectarDB->killConn();
              }
            } else {
              echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'El campo está vacío!',
                          'Ingrese un DNI.',
                          'error'
                        )};
                        fireSweetAlert();</script>";
              ?>
        </div>
        </form>
        <?php
        $conectarDB->killConn();
            }
          }
        }
        ?>
  </div>
  </form>
  </div>
  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <script src="../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
  <?php
  if (isset($_GET["err"])) {
    if (!empty($_GET["err"])) {
      switch ($_GET["err"]) {
        case 'Late':
          echo "<script>Swal.fire('Imposible cargar la asistencia!', 'El alumno ha llegado tarde.', 'error');</script>";
          break;
        case 'noParams':
          echo "<script>Swal.fire('Imposible cargar la asistencia!', 'Configure los parámetros del sistema.', 'warning');</script>";
          break;
      }

    }
  }
  ?>
</body>

</html>