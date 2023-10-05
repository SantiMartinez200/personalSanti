<?php
include("../../TRABAJO_PRACTICO/BD/conn.php");
$conectarDB = Conexion::connect();
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
    <div class="container mt-2">
      <div class="container col-10">
        <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-danger text-white rounded">
          <h2 class="container__title">Registrar Asistencia</h2>
        </div>

        <form class="form text-center p-3 mb-2 bg-light text-black col-12" action="consultaDNI.php" method="POST">
          <div class="row">
            <div class="col">
              <label for="" class="container__label"><p class="text-dark">Dni:</p></label><div><input type="number" class="container__input" name="dni"></div>
            </div>
            <div class="col mt-3 d-flex justify-content-center">
              <div><input type="submit" value="Registrar Asistencia" class="btn btn-outline-danger"></div>
            </div>
          </div>
        </form>
      </div>
      <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-danger"><a href="../../../QuienVino/index.php">Volver al
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
          <link rel="stylesheet" href="../../QuienVino/MarcarAsistencia/CSS/styleAsis.css">
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
      } elseif (($trayendo != NULL) && ($trayendoAsis != NULL)) { ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Consultar DNI</title>
          <link rel="stylesheet" href="../../TRABAJO_PRACTICO/MarcarAsistencia/CSS/styleAsis.css">
          <link rel="stylesheet" href="../../TRABAJO_PRACTICO/css/bootstrap.css" />
        </head>

        <body>
          <?php
          date_default_timezone_set('America/Argentina/Buenos_Aires');
          $fecha_actual = date("Y-m-d H:i:s");
          //var_dump($fecha_actual);
          $insertarAsistencia = mysqli_query($conectarDB, "INSERT INTO asistencia (id,dni,fecha_asistencia) VALUES (null,'$consultarDni','$fecha_actual')");
          ?>
          <div class="p-3 mb-2 bg-light text-dark">
            <h1 class="h1title">Asistencia registrada.</h1>
            <h3 class="h3title">Este es el listado de asistencias del alumno.</h3>
          </div>
          <?php
          $queryAsistencias = $conectarDB->query("SELECT * FROM alumno as a INNER JOIN asistencia as asis ON a.dni=asis.dni WHERE asis.dni='$consultarDni'");
          //echo $row_cnt;
          ?>
          <div class="container-tableAlumnos">
            <div class="table-title">
              <p> Asistencias de:
                <?php $row = $queryAsistencias->fetch_assoc();
                print($row["nombre"] . " " . $row["apellido"]);
                $queryAsistencias->free_result(); ?>
              </p>
            </div>
            <div class="table-header">ID de Asistencia</div>
            <div class="table-header">DNI</div>
            <div class="table-header">NOMBRE</div>
            <div class="table-header">APELLIDO</div>
            <div class="table-header">Fecha & Hora</div>

            <?php
            $queryAsistencias = $conectarDB->query("SELECT * FROM alumno as a INNER JOIN asistencia as asis ON a.dni=asis.dni WHERE asis.dni='$consultarDni'");
            while ($row = mysqli_fetch_assoc($queryAsistencias)) { ?>
              <div class="table-item">
                <?php echo ($row["id"]); //id asistencia ?>
              </div>
              <div class="table-item">
                <?php print($row["dni"]); ?>
              </div>
              <div class="table-item">
                <?php print($row["nombre"]); ?>
              </div>
              <div class="table-item">
                <?php print($row["apellido"]); //dni ?>
              </div>
              <div class="table-item">
                <?php print($row["fecha_asistencia"]); ?>
              </div>
              <?php

            }
            ?>
          </div>
          <div class="regresar-container">
            <button type="button" class="btn btn-light"><a href="../../QuienVino/index.php">Volver al
                inicio</a></button>
            <button type="button" class="btn btn-light"><a href="../../QuienVino/MarcarAsistencia/consultaDNI.php">Registrar
                otra asistencia</a></button>
            <div>
        </body>
        <?php
        $queryAsistencias->free_result();
      } elseif (($trayendo != NULL) && ($trayendoAsis == NULL)) { ?>
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
          <?php
          date_default_timezone_set('America/Argentina/Buenos_Aires');
          $fecha_actual = date("Y-m-d H:i:s");
          //var_dump($fecha_actual);
          $insertarAsistencia = mysqli_query($conectarDB, "INSERT INTO asistencia (id,dni,fecha_asistencia) VALUES (null,'$consultarDni','$fecha_actual')");
          ?>
          <div class="p-3 mb-2 bg-light text-dark">
            <h1 class="h1title">Asistencia registrada.</h1>
            <h3 class="h3title">Se ha registrado por primera vez la asistencia del alumno.</h3>
          </div>
          <?php
          $queryAsistencias = $conectarDB->query("SELECT * FROM alumno as a INNER JOIN asistencia as asis ON a.dni=asis.dni WHERE asis.dni='$consultarDni'");
          //echo $row_cnt;
          ?>
          <div class="container-tableAlumnos">
            <div class="table-title">
              <p> Asistencias de:
                <?php $row = $queryAsistencias->fetch_assoc();
                print($row["nombre"] . " " . $row["apellido"]);
                $queryAsistencias->free_result(); ?>
              </p>
            </div>
            <div class="table-header">ID de Asistencia</div>
            <div class="table-header">DNI</div>
            <div class="table-header">NOMBRE</div>
            <div class="table-header">APELLIDO</div>
            <div class="table-header">Fecha & Hora</div>

            <?php
            $queryAsistencias = $conectarDB->query("SELECT * FROM alumno as a INNER JOIN asistencia as asis ON a.dni=asis.dni WHERE asis.dni='$consultarDni'");
            while ($row = mysqli_fetch_assoc($queryAsistencias)) { ?>
              <div class="table-item">
                <?php echo ($row["id"]); //id asistencia ?>
              </div>
              <div class="table-item">
                <?php print($row["dni"]); ?>
              </div>
              <div class="table-item">
                <?php print($row["nombre"]); ?>
              </div>
              <div class="table-item">
                <?php print($row["apellido"]); //dni ?>
              </div>
              <div class="table-item">
                <?php print($row["fecha_asistencia"]); ?>
              </div>
              <?php

            }
            ?>
          </div>
          <div class="regresar-container">
            <button type="button" class="btn btn-light"><a href="../../QuienVino/index.php">Volver al
                inicio</a></button>
            <button type="button" class="btn btn-light"><a href="../../QuienVino/MarcarAsistencia/consultaDNI.php">Registrar
                otra asistencia</a></button>
            <div>
        </body>
        <?php
        $queryAsistencias->free_result();
      }
    } else {
      echo "<script>alert('El campo está vacio'); window.location='../MarcarAsistencia/consultaDNI.php'</script>";
    }
  }



}
?>