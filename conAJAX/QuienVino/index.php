<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../QuienVino/styleIndex.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="index.php"><div class="redondo">
        <img src="./Multimedia/logo.png" class="logo">
      </div></a>
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
              <li><a class="dropdown-item text-dark" href="./ABM/Profesor/ABM_Profesor.php">Profesor</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Contacto</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="#">Instagram</a></li>
              <li><a class="dropdown-item text-dark" href="#">Facebook</a></li>
              <li><a class="dropdown-item text-dark" href="#">Linkedin</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container d-flex justify-content-center w-50 bg-light text-center mt-5 rounded p-2">
    <form action="./index.php" class="form-control rounded  p-3" method="POST">
      <div class="row"><label for="dni">
          <h1>Ingrese el DNI<h1>
        </label></div>
      <div class="row"><input class="form-control border-3" type="number" name="dni" id="dni"></div>
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
                echo "<div class='alert alert-success mt-3'>Se ha registrado la asistencia de: $n $a </div>";
              }
              $conectarDB->killConn();
            } else {
              echo "<script>alert('El campo está vacio'); window.location='./index.php'</script>";
              $conectarDB->killConn();
            }
          }
        }
        ?>
        <div>
    </form>
  </div>

</body>
<script src="../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>

</html>

<!--           primero, poner un nombre correcto al tp
               De 100 clases
              //ej; alumno vino 33 no pasa 30%
              Profesor falta 20 veces? entonces son 80 clases. 100-20
              Registrar las Inasistencias del profesor.
              ¿¿tabla asistencia profesor??

              
                  




-->