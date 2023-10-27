<!DOCTYPE html>
<html lang="en">
<!--  COUNT DE LAS ASISTENCIAS, HACER EL NUMERO PARAMETRIZABLE
Menú Configuración, que aparezca DIAS DE CLASE, guardarlos en la base de datos, comparamos porcentaje con el valor cargado y el valor de las asistencias. -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="./Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="styleIndex.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="index.php">
        <div class="redondo">
          <img src="./Multimedia/logo.png" class="logo">
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
          <img src="./Multimedia/sliders2.svg" alt="" class="img-fluid config"
            style="margin-right: 5px;">
        </a>
        <ul class="dropdown-menu text-dark">
          <li><a class="dropdown-item text-dark" href="./Control/parametros.php">Parámetros</a></li>
          <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
        </ul>
      </div>
    </div>
    
  </nav>
  <div class="container  d-flex justify-content-center mt-5">
    <div class="imgindex d-flex justify-content-center align-items-center w-25">
      <img src="./Multimedia/logo.png" class="logoindex">
    </div>
  </div>
  <div class="container d-flex justify-content-center w-50 bg-light text-center mt-5 rounded p-2">
    <form action="./index.php" class="form-control rounded  p-3" method="POST">
      <div class="row"><label for="dni">
          <h1>Ingrese el DNI<h1>
        </label></div>
      <div class="row"><input class="form-control border-3" type="number" name="dni" id="dni"> </div>
      <input type="submit" class="btn btn-dark mt-2" value="Registrar Asistencia">
      <div class="row">
        <?php
        include("./BD/conn.php");
        include("./Clases/Persona.php");
        include("./Clases/Alumno.php");
        $conectarDB = new Conexion();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if (isset($_POST["dni"])) {
            if (!empty($_POST["dni"])) {
              $consultarDni = $_POST["dni"]; //traer el alumno
              if (($consultarDni >= 99999999) || ($consultarDni <= 0)) {
                echo "<div class='alert alert-danger mt-3'>El valor del DNI es inválido.";
              } else {
                $consulta = Alumno::getAlumno($consultarDni);
                $traerAlumno = $conectarDB->ejecutar($consulta);
                $alumnos = $traerAlumno->fetch_all(); //acomodar en array
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $date = date("Y-m-d H:i:s");
                if ($alumnos == NULL) {
                  echo "<div class='alert alert-danger mt-3'>El DNI no ha sido encontrado.</div>";
                } else {
                  $n = $alumnos[0][1];
                  $a = $alumnos[0][2];
                  $trimmedDate = date("Y-m-d");
                  $verificarFechaAsistencia = Alumno::verificarIngresoAsistencia($consultarDni, $trimmedDate);
                  if ($verificarFechaAsistencia == False) {
                    echo "<div class='alert alert-success mt-3'>Se ha registrado la asistencia de: $n $a </div>";
                    $consulta = Alumno::insertarAsistencia($consultarDni, $date);
                    $cargarAsistencia = $conectarDB->ejecutar($consulta);
                  } else {
                    echo "<div class='alert alert-danger mt-3'>El alumno: $n $a Ya ha asistido hoy.</div>";
                  }




                }
                $conectarDB->killConn();
              }

            } else {
              echo "<script>alert('El campo está vacio'); window.location='./index.php'</script>";
              $conectarDB->killConn();
            }
          }
        }
        ?>
      </div>
    </form>
    <?php
    ?>
  </div>

  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <script src="../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
</body>


</html>

<!--           primero, poner un nombre correcto al tp
               De 100 clases
              //ej; alumno vino 33 no pasa 30%
              Profesor falta 20 veces? entonces son 80 clases. 100-20
              Registrar las Inasistencias del profesor.
              ¿¿tabla asistencia profesor??

              
                  




-->