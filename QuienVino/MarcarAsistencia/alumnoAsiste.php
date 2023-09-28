<?php
include("../../QuienVino/BD/conn.php");
$conectarDB = Conexion::connect();
date_default_timezone_set('America/Argentina/Buenos_Aires');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar DNI</title>
    <link rel="stylesheet" href="../../QuienVino/MarcarAsistencia/CSS/styleAsis.css">
    <link rel="stylesheet" href="../../QuienVino/Resources/css/bootstrap.min.css" />
  </head>

  <body>
    <div>
      <div class="container mt-2">
        <div class="container col-10">
          <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
            <h2 class="container__title">Registrar Asistencia de alumno</h2>
          </div>
          <form class="form text-center p-3 mb-2 bg-light text-black col-12" action="alumnoAsiste.php" method="POST">
            <div class="row">
              <div class="col">
                <label for="" class="container__label">
                  <p class="text-dark">Dni:</p>
                </label>
                <div><input type="number" class="container__input" name="dni"></div>
              </div>
              <div class="col mt-3 d-flex justify-content-center">
                <div><input type="submit" value="Registrar Asistencia" class="btn btn-outline-primary"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-primary"><a href="../../../QuienVino/index.php">Volver al
              inicio</a></button>
        </div>
  </body>

  </html>
  <?php
} else {
  if (isset($_POST["dni"])) {
    if (!empty($_POST["dni"])) {
      $consultarDni = $_POST["dni"];
      $query = mysqli_query($conectarDB, "SELECT * FROM alumno WHERE dni='$consultarDni'");
      $trayendo = mysqli_fetch_object($query);
      $queryAsistencias = mysqli_query($conectarDB, "SELECT fecha_asistencia FROM alumno as a INNER JOIN asistencia as asis ON a.dni=asis.dni AND a.dni=$consultarDni");
      $trayendoAsis = mysqli_fetch_object($queryAsistencias);
      if ($trayendo == NULL) {
        //var_dump($trayendo);
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Alumno NO registrado.</title>
          <link rel="stylesheet" href="../../QuienVino/Resources/css/bootstrap.min.css" />
          <link rel="stylesheet" href="../../QuienVino/styleIndex.css">
        </head>

        <body>
          <div class="p-3 mb-2 bg-light text-dark">
            <h1 class="h1title">Alumno no registrado.</h1>
            <h3 class="h3title">¿Desea registrar el alumno?</h3>
          </div>
          <div class="regresar-container">
            <button type="button" class="btn btn-light"><a href="../../../QuienVino/index.php">Regrésame al
                inicio.</a></button>
            <button type="button" class="btn btn-light"><a href="../../QuienVino/MarcarAsistencia/consultaDNI.php">
                Dejame consultar otro DNI.</a></button>
            <button type="button" class="btn btn-light"><a
                href="../../QuienVino/ABM/Alumno/ABM_Alumno.php?dni=<?php echo ($consultarDni) ?>">
                Deseo registrar el alumno. </a></button>
            <div>
        </body>

        </html>
        <?php
      } elseif ($trayendo != NULL){ ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Consultar DNI</title>
          <link rel="stylesheet" href="../../QuienVino/styleIndex.css">
          <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
        </head>

        <body>
          <?php
          $fecha_actual = date("Y-m-d H:i:s");
          $insertarAsistencia = mysqli_query($conectarDB, "INSERT INTO asistencia (id,dni,fecha_asistencia) VALUES (null,'$consultarDni','$fecha_actual')");
          ?>
          <div class="p-3 mb-2 bg-light text-dark">
            <h1 class="h1title">Asistencia registrada.</h1>
          </div>
          <?php
          $queryAsistencias = $conectarDB->query("SELECT * FROM alumno as a INNER JOIN asistencia as asis ON a.dni=asis.dni WHERE asis.dni='$consultarDni'");
          ?>
          <div class="d-flex justify-content-center">
            <div class="col-10 text-center">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th colspan="5" class="bg-primary text-white">Asistencias de:
                      <?php $row = $queryAsistencias->fetch_all();
                      echo($row[0][1] . " " . $row[0][2]); ?>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">ID de Asistencia</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha y Hora</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  forEach($row as $eachRow => $value) {
                    ?>
                    <tr>
                      <td>
                        <?php echo($value[4]); ?>
                      </td>
                      <td>
                        <?php echo($value[0]); ?>
                      </td>
                      <td>
                        <?php echo($value[1]); ?>
                      </td>
                      <td>
                        <?php echo($value[2]); ?>
                      </td>
                      <td>
                        <?php echo($value[6]); ?>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="container">
            <div class="row m-5">
              <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary"><a href="../../QuienVino/index.php">Volver al
                    inicio</a></button>
              </div>
              <div class="col d-flex justify-content-start">
                <button type="button" class="btn btn-primary"><a
                    href="../../QuienVino/MarcarAsistencia/alumnoAsiste.php">Registrar
                    otra asistencia</a></button>
              </div>
            </div>
          </div>
        </body>
        <?php
        $queryAsistencias->close();
      } 
    } else {
      echo "<script>alert('El campo está vacio'); window.location='../MarcarAsistencia/consultaDNI.php'</script>";
    }
  }

}
?>